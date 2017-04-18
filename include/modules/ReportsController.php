<?php
 
class ReportsController extends Controller {

    /*
     * return string
     * возвращаем SELECT часть запроса
     */
    protected function getSelectSQL()
    {
        $result = parent::getSelectSQL();

        $result[] = str_repeat($this->model->entity->getPrimaryKeyModelName(), 2) . '.level AS level';

        return $result;
    }

    /*
     * return string
     * возвращаем FROM часть запроса
     */
    protected function getFromSQL()
    {
        return 'reports ' . str_repeat($this->model->entity->getPrimaryKeyModelName(), 2);
    }

    /*
     * return string
     * возвращаем ORDER BY часть запроса
     */
    protected function getOrderSQL()
    {
         return 'path ASC';
    }

    /**
     * получаем значения полей фильтров и колонок вывода
     */
    protected function processParameters($parameters)
    {
        $result = array();

        foreach (json_decode($parameters) as $parameter) {
            $result[ $parameter->order_position ] = (array) $parameter;
        }

        ksort($result);

        return $result;
    }

/*
    public function actionList()
    {
        $sql = 'SELECT * FROM x_tasks WHERE top = 0 ORDER BY contact, id ASC';
        $reader = Yii::app()->db->createCommand($sql)->query();

        $parent_id = 0;
        $top = 0;
        $contact = '';

        foreach($reader as $i => $row) {
            if ($contact == $row['contact']) {
                $sql = 'UPDATE x_tasks SET title = trim(title), parent_id = ' . intval($parent_id) . ', top = ' . intval($top) . ' WHERE id = ' . intval($row['id']);
                $parent_id = $row['id'];
            } else {
                $top = $row['id'];
                $parent_id = $row['id'];
                $sql = 'UPDATE x_tasks SET title = trim(title), parent_id = ' . intval(0) . ', top = ' . intval($row['id']) . ' WHERE id = ' . intval($row['id']);
            }

            Yii::app()->db->createCommand($sql)->execute();

            $contact = $row['contact'];
        }
    }
*/

    //формирование отчета
    protected function _generateReport($sql, $output_parameters)
    {
        $list = Yii::app()->db->createCommand($sql)->queryAll();
        echo IO::create('PHPExcel', array('columns' => $output_parameters))->write('Reports', $list);
    }

    //операційний звіт по процесу продаж страхових продуктів
    protected function _generateReport1($sql, $output_parameters)
    {
        $Excel = PHPExcelAdapter::excel();

        //выводим таблицу по ячейкам
        $level = 1;
        $data = Yii::app()->db->createCommand($sql)->queryAll();

        if (is_array($data)) {

            $i = 0;
            $j = 2;
            foreach ($data as $k => $row) {

                foreach($output_parameters as $column) {
                    switch ($column['type']) {
                        case 'date':
                            $Excel->getActiveSheet()->setCellValueByColumnAndRow($i, $j, date('d.m.Y', strtotime($row[ $column['name'] ])));
                            break;
                        case 'datetime':
                            $Excel->getActiveSheet()->setCellValueByColumnAndRow($i, $j, date('d.m.Y H:i:s', strtotime($row[ $column['name'] ])));
                            break;
                        default:
                            $Excel->getActiveSheet()->setCellValueByColumnAndRow($i, $j, $row[ $column['name'] ]);
                            break;
                    }

                    $i++;
                }

                if ($k < sizeOf($data) - 1 && $row['level'] >= $data[ $k + 1 ]['level']) {
                    $i = 0;
                    $j++;
                }

                if ($level < $row['level']) {
                    $level = $row['level'];
                }
            }
        }

        //пишем заголовки
        $j = 0;
        for ($i=0; $i < $level; $i++) {
            foreach ($output_parameters as $column) {
                $Cell = $Excel->getActiveSheet()->getCellByColumnAndRow($j, 1);

                $Cell->setValue( $column['title'] );

                $j++;
            }
        }

        $range = ExcelAdapter::getColRange();

        //устанавливаем стили шапки
        $Excel->getActiveSheet()
            ->getStyle('A1:'.$range[ $j-1 ].'1')
            ->getFill()
            ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
            ->getStartColor()
            ->setRGB(ExcelAdapter::HBG);
        $Excel->getActiveSheet()->getStyle('A1:'.$range[ $j-1 ].'1')->getFont()->setBold(true);

        return PHPExcelAdapter::download($Excel, 'Reports.xlsx');
    }

    /**
     * Установка фильтров выборки
     */
    public function actionGenerate()
    {

        $this->model = $this->_models[0];

        //!!!как-то немного через одно место сценарий присваивается
        $this->model->setScenario('generate');

        $this->model->output_parameters = $this->processParameters($this->model->output_parameters);

        if (Yii::app()->request->isPostRequest) {

            if (isset($_POST['parameters']) && is_array($_POST['parameters'])) {

                $conditions = array('TRUE');

                //накладываем ограничения фильтрами
                foreach($_POST['parameters'] AS $name => $type) {
                    switch ($type) {
                        case 'boolean'://Boolean
                        case 'combobox'://Combobox
                        case 'treepicker'://Treepicker
                            if (isset($_POST['values'][ $name ]) && $_POST['values'][ $name ] != '') {
                                $conditions[] = $name . ' = ' . intval($_POST['values'][ $name ]);
                            }
                            break;
                        case 'text'://Text
                            if (isset($_POST['values'][ $name ]) && $_POST['values'][ $name ] != '') {
                                $conditions[] = $name . ' ILIKE ' . Yii::app()->db->quoteValue($_POST['values'][ $name ]);
                            }
                            break;
                        case 'date'://Date
                            if (isset($_POST['values'][ 'start' . $name ]) && $_POST['values'][ 'start' . $name ] != '') {
                                $conditions[] = 'DATE(' . $name . ') >= ' . Yii::app()->db->quoteValue($_POST['values'][ 'start' . $name ]);
                            }
                            if (isset($_POST['values'][ 'end' . $name ]) && $_POST['values'][ 'end' . $name ] != '') {
                                $conditions[] = 'DATE(' . $name . ') <= ' . Yii::app()->db->quoteValue($_POST['values'][ 'end' . $name ]);
                            }
                            break;
                        case 'integer'://Integer
                            if (isset($_POST['values'][ 'start' . $name ]) && $_POST['values'][ 'start' . $name ] != '') {
                                $conditions[] = $name . ' >= ' . Yii::app()->db->quoteValue($_POST['values'][ 'start' . $name ]);
                            }
                            if (isset($_POST['values'][ 'end' . $name ]) && $_POST['values'][ 'end' . $name ] != '') {
                                $conditions[] = $name . ' <= ' . Yii::app()->db->quoteValue($_POST['values'][ 'end' . $name ]);
                            }
                            break;
                        case 'multiselect'://Multiselect
                            $conditions[] = $name . ' IN (' . implode(', ', $_POST['values'][ $name ]) . ')';
                            break;
                    }
                }

                //накладываем ограничения в зависимости от полномочий
                $models = array();
                foreach($this->model->output_parameters AS $parameter) {
                    if (!in_array($parameter['model'], $models)) {
                        $models[] = $parameter['model'];

                        $condition = Controller::getCondition($parameter['model'], 'read');
                        if ($condition != '') {
                            $conditions[] = $condition;
                        }
                    }
                }

                $this->model->sql = str_replace('$where', implode(' AND ', $conditions), $this->model->sql);
            }

            //ограничиваем выдачу, чтобы не было переполнения
            $this->model->sql .= ' LIMIT 10000';

            //формируем файл
            switch ($this->model->id) {
                case '1'://операційний звіт по процесу продаж страхових продуктів
                    return $this->_generateReport1($this->model->sql, $this->model->output_parameters);
                    break;
                default:
                    return $this->_generateReport($this->model->sql, $this->model->output_parameters);
                    break;
            }
        } else {

            //показываем форму с данными модели
            echo UI::renderForm($this->model, $this->fields, array('width' => 853));
        }
    }
}