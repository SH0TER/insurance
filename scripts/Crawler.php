<?php

require_once 'simple_html_dom.php';

define('CAR_OPTIONS_SECURIRY', 42);
define('CAR_OPTIONS_EXTERIOR', 115);
define('CAR_OPTIONS_INTERIOR', 123);
define('CAR_OPTIONS_COMFORT', 44);
define('CAR_OPTIONS_STATE', 46);
define('CAR_OPTIONS_MULTIMEDIA', 45);
define('CAR_OPTIONS_OTHER', 43);

class Crawler {

    //параметры работы парсера
    protected $_url = null;
    protected $_html = null;
    protected $_dictionaries = array();

    //объявление
    protected $_advert = array();

    //перечень ошибок разбора содержимого
    protected $_logs = array();

    //количество объявления на парсинга
    protected $_number = 50;

    public static function create($class)
    {
        switch ($class) {
            case '57':
                $class = 'AutobazarUaCrawler';
                break;
            case '58':
                $class = 'AutoRiaComCrawler';
                break;
        }

        require_once 'Sites/' . $class . '.php';
        return new $class();
    }

    function __construct($a)
    {
        //загружаем справочники
        $methods = get_class_methods($this);
        foreach ($methods as $method) {
            if (preg_match('/^_load.*/', $method)) {
                $this->$method();
            }
        }
		
		$this->_html = $a;
    }

//загружаем справочники
    //загружаем справочник областей
    protected function _loadRegions()
    {
        $this->_dictionaries['regions'] = array();

        $sql =  'SELECT id, LOWER(title) AS title, LOWER(aliases) AS aliases ' .
                'FROM {{regions}}';
        //$list = Yii::app()->db->createCommand($sql)->queryAll();

        foreach ($list as $row) {
            $this->_dictionaries['regions'][ $row['title'] ] = $row['id'];

            $regions = explode(';', $row['aliases']);
            foreach ($regions as $region) {
                $this->_dictionaries['regions'][ $region ] = $row['id'];
            }
        }
    }

    //загружаем справочник марок ТС
    protected function _loadCarBrands()
    {
        $this->_dictionaries['car_brands'] = array();

        $sql =  'SELECT id, LOWER(title) AS title, LOWER(aliases) AS aliases ' .
                'FROM {{car_brands}}';
        //$list = Yii::app()->db->createCommand($sql)->queryAll();

        foreach ($list as $row) {
            $this->_dictionaries['car_brands'][ $row['title'] ] = $row['id'];

            $car_brands = explode(';', $row['aliases']);
            foreach ($car_brands as $car_brand) {
                $this->_dictionaries['car_brands'][ $car_brand ] = $row['id'];
            }
        }
    }

    //загружаем справочник моделей ТС
    protected function _loadCarModels()
    {
        $this->_dictionaries['car_models'] = array();

        $sql =  'SELECT id, car_brands_id, LOWER(title) AS title, LOWER(aliases) AS aliases ' .
                'FROM {{car_models}}';
        //$list = Yii::app()->db->createCommand($sql)->queryAll();

        foreach ($list as $row) {
            $this->_dictionaries['car_models'][ $row['car_brands_id'] ][ $row['title'] ] = $row['id'];

            $car_models = explode(';', $row['aliases']);
            foreach ($car_models as $car_model) {
                $this->_dictionaries['car_models'][ $row['car_brands_id'] ][ $car_model ] = $row['id'];
            }
        }
    }

    //загружаем справочник типов кузовов
    protected function _loadCarBodies()
    {
        $this->_dictionaries['car_bodies'] = array();

        $sql =  'SELECT id, LOWER(title) AS title, LOWER(aliases) AS aliases ' .
                'FROM {{car_bodies}}';
        //$list = Yii::app()->db->createCommand($sql)->queryAll();

        foreach ($list as $row) {
            $this->_dictionaries['car_bodies'][ $row['title'] ] = $row['id'];

            $regions = explode(';', $row['aliases']);
            foreach ($regions as $region) {
                $this->_dictionaries['car_bodies'][ $region ] = $row['id'];
            }
        }
    }

    //загружаем справочник типов двигателей
    protected function _loadCarEngineTypes()
    {
        $this->_dictionaries['car_engine_types'] = array();

        $sql =  'SELECT id, LOWER(title) AS title, LOWER(aliases) AS aliases ' .
                'FROM {{car_engine_types}}';
        //$list = Yii::app()->db->createCommand($sql)->queryAll();

        foreach ($list as $row) {
            $this->_dictionaries['car_engine_types'][ $row['title'] ] = $row['id'];

            $regions = explode(';', $row['aliases']);
            foreach ($regions as $region) {
                $this->_dictionaries['car_engine_types'][ $region ] = $row['id'];
            }
        }
    }

    //загружаем справочник КПП
    protected function _loadCarTransmissions()
    {
        $this->_dictionaries['car_transmissions'] = array();

        $sql =  'SELECT id, LOWER(title) AS title, LOWER(aliases) AS aliases ' .
                'FROM {{car_transmissions}}';
        //$list = Yii::app()->db->createCommand($sql)->queryAll();

        foreach ($list as $row) {
            $this->_dictionaries['car_transmissions'][ $row['title'] ] = $row['id'];

            $regions = explode(';', $row['aliases']);
            foreach ($regions as $region) {
                $this->_dictionaries['car_transmissions'][ $region ] = $row['id'];
            }
        }
    }

    //загружаем справочник цветов ТС
    protected function _loadCarColors()
    {
        $this->_dictionaries['car_colors'] = array();

        $sql =  'SELECT id, LOWER(title) AS title, LOWER(aliases) AS aliases ' .
                'FROM {{car_colors}}';
        //$list = Yii::app()->db->createCommand($sql)->queryAll();

        foreach ($list as $row) {
            $this->_dictionaries['car_colors'][ $row['title'] ] = $row['id'];

            $car_colors = explode(';', $row['aliases']);
            foreach ($car_colors as $car_color) {
                $this->_dictionaries['car_colors'][ $car_color ] = $row['id'];
            }
        }
    }

    //загружаем справочник опций ТС
    protected function _loadCrawlerParameters()
    {
        $this->_dictionaries['crawler_parameters'] = array();

        $sql =  'SELECT id, LOWER(title) AS title, LOWER(aliases) AS aliases, parent_id ' .
                'FROM {{crawler_parameters}} ' .
                'WHERE top = parent_id';
        //$list = Yii::app()->db->createCommand($sql)->queryAll();

        foreach ($list as $row) {
            $this->_dictionaries['crawler_parameters'][ $row['parent_id'] ][ $row['title'] ] = $row['id'];

            $crawler_parameters = explode(';', $row['aliases']);
            foreach ($crawler_parameters as $crawler_parameter) {

                //фиксируем с разбивкой по грУппе опций
                $this->_dictionaries['crawler_parameters'][ $row['parent_id'] ][ $crawler_parameter ] = $row['id'];

                //фиксируем опции
                $this->_dictionaries['crawler_parameters'][ -1 ][ $crawler_parameter ] = $row['id'];
            }
        }
    }
//конец загрузки справочников

    //получаем ID последнего сохраненного объявления
    protected function _getLastSourcesId()
    {
        $sql =  'SELECT sources_id ' .
                'FROM {{adverts}} ' .
                'WHERE sources_organizations_id = ' . $this->_sources_organizations_id . ' ' .
                'ORDER BY id DESC ' .
                'LIMIT 1';
        return Yii::app()->db->createCommand($sql)->queryScalar();
    }

    //формируем URL
    protected function _getUrl($id)
    {
        return str_replace('{id}', $id, $this->_url);
    }

    //очищаем HTML от лишних конструкций
    protected function _stripHTML($content)
    {
        $patterns = array(
            '/<head[^>]*>(.*?)<\/head>/si',
            '/<noindex[^>]*?>(.*?)<\/noindex>/si',
            '/<script[^>]*?>(.*?)<\/script>/si',
            '/<noscript[^>]*?>(.*?)<\/noscript>/si',
            '/<footer[^>]*?>(.*?)<\/footer>/si'
        );

        return preg_replace($patterns, '', $content);
    }

    //очищаем значения распарсенные
    public function clearValue($value)
    {
        switch (gettype($value)) {
            case 'array':
                foreach ($value as $i => $val) {
                    if (trim(strip_tags($val)) != '') {
                        $value[ $i ] = trim(strip_tags($val));
                    } else {
                        unset($value[ $i ]);
                    }
                }
                break;
            default:
                $value = trim(strip_tags($value));
        }

        return $value;
    }

/* получаем информацию со страницы, НАЧАЛО*/
    //устанавливаем ID источника объявления
    protected function _setSourcesOrganizationsId(){
        $this->_advert['sources_organizations_id'] = $this->_sources_organizations_id;
    }

    //устанавливаем область, ссылка на таблицу regions
    protected function _setRegionsId()
    {
        $this->_advert['regions_id'] = null;
        if ($this->_advert['regions_title'] != '') {
            $regions_title = mb_strtolower($this->_advert['regions_title'], 'UTF-8');
            if (isset($this->_dictionaries['regions'][ $regions_title ])) {
                $this->_advert['regions_id'] = $this->_dictionaries['regions'][ $regions_title ];
            } else {
                $this->_logs[] = 'Не визначен регіон: ' . $regions_title;
            }
        }
    }

    //устанавливаем марку ТС, ссылка на таблицу car_brands
    protected function _setCarBrandsId()
    {
        $this->_advert['car_brands_id'] = null;
        if ($this->_advert['car_brands_title'] != '') {
            $car_brands_title = mb_strtolower($this->_advert['car_brands_title'], 'UTF-8');
            if (isset($this->_dictionaries['car_brands'][ $car_brands_title ])) {
                $this->_advert['car_brands_id'] = $this->_dictionaries['car_brands'][ $car_brands_title ];
            } else {
                $this->_logs[] = 'Не визначена марка ТЗ: ' . $car_brands_title;
            }
        }
    }

    //устанавливаем модель ТС, ссылка на таблицу car_models
    protected function _setCarModelsId()
    {
        $this->_setCarBrandsId();

        $this->_advert['car_models_id'] = null;
        foreach ($this->_advert['car_models_title'] as $i => $car_models_title) {

            $car_models_title = mb_strtolower(trim($car_models_title), 'UTF-8');
            if (isset($this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ][ $car_models_title ])) {
                $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ][ $car_models_title ];
            } else {
                switch ($this->_advert['car_brands_id']) {
                    case 66://infinity
                        switch ($car_models_title) {
                            case 'g':
                                switch ($this->_advert['car_engine_size']) {
                                    case '3500':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['g 35'];
                                        break;
                                    case '3700':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['g 37'];
                                        break;

                                }
                                break;

                            case 'qx':
                                switch ($this->_advert['car_engine_size']) {
                                    case '5600':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['qx 56'];
                                        break;
                                }
                                break;
                            case 'fx':
                                switch ($this->_advert['car_engine_size']) {
                                    case '3700':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['fx 37'];
                                        break;
                                    case '4500':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['fx 45'];
                                        break;
                                    case '5000':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['fx 50'];
                                        break;
                                }
                                break;
                            case 'ex':
                                    switch ($this->_advert['car_engine_size']) {
                                        case '3500':
                                            $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['ex 35'];
                                            break;
								        case '3600':
                                            $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['ex 36'];
                                            break;
                                    }
                                    break;
                            case 'm':
                                switch ($this->_advert['car_engine_size']) {
                                    case '3500':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['m 35'];
                                        break;
                                    case '3700':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['m 37'];
                                        break;
                                    case '4500':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['m 45'];
                                        break;
                                    case '5000':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['m 50'];
                                        break;
                                }
                                break;
                        }
                        break;
                    case 79://lexus
                        switch ($car_models_title) {
                            case 'es':
                                switch ($this->_advert['car_engine_size']) {
                                    case '3000':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['es 300'];
                                        break;
                                    case '3300':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['es 330'];
                                        break;
                                    case '3500':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['es 350'];
                                        break;
                                }
                                break;
                            case 'gs':
                                switch ($this->_advert['car_engine_size']) {
                                    case '3000':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['gs 300'];
                                        break;
                                    case '3500':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['gs 350'];
                                        break;
                                    case '4300':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['gs 430'];
                                        break;
                                    case '4500':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['gs 450'];
                                        break;
                                }
                                break;
                            case 'gx':
                                switch ($this->_advert['car_engine_size']) {
                                    case '4600':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['gx 460'];
                                        break;
                                    case '4700':
                                         $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['gx 470'];
                                         break;
                                }
                                break;
                            case 'is':
                                switch ($this->_advert['car_engine_size']) {
                                    case '2000':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['is 200'];
                                        break;
                                    case '2500':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['is 250'];
                                        break;
                                    case '3000':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['is 300'];
                                        break;
                                    case '3500':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['is 350'];
                                        break;
                                }
                                break;
                            case 'ls':
                                switch ($this->_advert['car_engine_size']) {
                                    case '4000':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['ls 400'];
                                        break;
                                    case '4300':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['ls 430'];
                                        break;
                                    case '4600':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['ls 460'];
                                        break;
                                    case '5000':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['ls 500'];
                                        break;
                                    case '6000':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['ls 600'];
                                        break;
                                }
                                break;
                            case 'lx':
                                switch ($this->_advert['car_engine_size']) {
                                    case '4300':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['lx 430'];
                                        break;
                                    case '4700':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['lx 470'];
                                        break;
                                    case '5700':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['lx 570'];
                                        break;
                                }
                                break;
                            case 'rx':
                                switch ($this->_advert['car_engine_size']) {
                                    case '3000':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['rx 300'];
                                        break;
                                    case '3300':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['rx 330'];
                                        break;
                                    case '3500':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['rx 350'];
                                        break;
                                    case '4000':
                                        $this->_advert['car_models_id'] = $this->_dictionaries['car_models'][ $this->_advert['car_brands_id'] ]['rx 400'];
                                        break;
                                }
                                break;
                        }
                        break;
                }
            }

            if (!is_null($this->_advert['car_models_id'])) {
                $this->_advert['car_models_title'] = $this->_advert['car_models_title'][ $i ];
                break;
            }
        }

        if (is_null($this->_advert['car_models_id']) || is_array($this->_advert['car_models_title'])) {
            $this->_advert['car_models_title'] = '';
            $this->_logs[] = 'Не визначена модель ТЗ: ' . $car_models_title;
        }
    }

    //устанавливаем тип кузова ТС, ссылка на таблицу car_bodies
    protected function _setCarBodiesId()
    {
        $this->_advert['car_bodies_id'] = null;
        if ($this->_advert['car_bodies_title'] != '') {
            $car_bodies_title = mb_strtolower($this->_advert['car_bodies_title'], 'UTF-8');
            if (isset($this->_dictionaries['car_bodies'][ $car_bodies_title ])) {
                $this->_advert['car_bodies_id'] = $this->_dictionaries['car_bodies'][ $car_bodies_title ];
            } else {
                $this->_logs[] = 'Не визначен тип кузова ТЗ: ' . $car_bodies_title;
            }
        }
    }

    //устанавливаем тип привода ТС, ссылка на таблицу crawler_parameters
    protected function _setCarDrivesId()
    {
        $this->_advert['car_drives_id'] = null;
        if ($this->_advert['car_drives_title'] != '') {
            $car_drives_title = mb_strtolower($this->_advert['car_drives_title'], 'UTF-8');
            if (isset($this->_dictionaries['crawler_parameters'][ -1 ][ $car_drives_title ])) {
                $this->_advert['car_drives_id'] = $this->_dictionaries['crawler_parameters'][ -1 ][ $car_drives_title ];
            } else {
                $this->_logs[] = 'Не визначен привід: ' . $car_drives_title;
            }
        }
    }

    //устанавливаем КПП, ссылка на таблицу crawler_parameters
    protected function _setCarTransmissionsId()
    {
        $this->_advert['car_transmissions_id'] = null;
        if ($this->_advert['car_transmissions_title'] != '') {
            $car_transmissions_title = mb_strtolower($this->_advert['car_transmissions_title'], 'UTF-8');
            if (isset($this->_dictionaries['car_transmissions'][ $car_transmissions_title ])) {
                $this->_advert['car_transmissions_id'] = $this->_dictionaries['car_transmissions'][ $car_transmissions_title ];
            } else {
                $this->_logs[] = 'Не визначена КПП: ' . $car_transmissions_title;
            }
        }
    }

    //устанавливаем тип кузова ТС, ссылка на таблицу car_engine_types
    protected function _setCarEngineTypesId()
    {
        $this->_advert['car_engine_types_id'] = null;
        if ($this->_advert['car_engine_types_title'] != '') {
            $car_engine_types_title = mb_strtolower($this->_advert['car_engine_types_title'], 'UTF-8');
            if (isset($this->_dictionaries['car_engine_types'][ $car_engine_types_title ])) {
                $this->_advert['car_engine_types_id'] = $this->_dictionaries['car_engine_types'][ $car_engine_types_title ];
            } else {
                $this->_logs[] = 'Не визначен тип двигуна ТЗ: ' . $car_engine_types_title;
            }
        }
    }

    //получаем Цвет
    protected function _setCarColorsId()
    {
        $this->_advert['car_colors_id'] = null;
        if ($this->_advert['car_colors_title'] != '') {
            $car_colors_title = mb_strtolower($this->_advert['car_colors_title'], 'UTF-8');
            if (isset($this->_dictionaries['car_colors'][ $car_colors_title ])) {
                $this->_advert['car_colors_id'] = $this->_dictionaries['car_colors'][ $car_colors_title ];
            } else {
                $this->_logs[] = 'Не визначен колір: ' . $car_colors_title;
            }
        }
    }

    //получаем Опции, безопасность
    protected function _setCarOptionsSecurity()
    {
        $this->_advert['car_options_security'] = array();
        foreach ($this->_advert['car_options'] as $i => $car_option) {

            $car_option = mb_strtolower(trim($car_option), 'UTF-8');

            if (isset($this->_dictionaries['crawler_parameters'][ CAR_OPTIONS_SECURIRY ][ $car_option ])) {
                $this->_advert['car_options_security'][] = $this->_dictionaries['crawler_parameters'][ CAR_OPTIONS_SECURIRY ][ $car_option ];
                unset($this->_advert['car_options'][ $i ]);
            } elseif (!isset($this->_dictionaries['crawler_parameters'][ -1 ][ $car_option ]) && $car_option !== 'undefined') {
                $this->_logs[] = 'Не визначена опція: ' . $car_option;
                unset($this->_advert['car_options'][ $i ]);
            }
        }
    }

    //получаем Опции, экстерьер
    protected function _setCarOptionsExterior()
    {
        $this->_advert['car_options_exterior'] = array();
        foreach ($this->_advert['car_options'] as $i => $car_option) {

            $car_option = mb_strtolower(trim($car_option), 'UTF-8');

            if (isset($this->_dictionaries['crawler_parameters'][ CAR_OPTIONS_EXTERIOR ][ $car_option ])) {
                $this->_advert['car_options_exterior'][] = $this->_dictionaries['crawler_parameters'][ CAR_OPTIONS_EXTERIOR ][ $car_option ];
                unset($this->_advert['car_options'][ $i ]);
            } elseif (!isset($this->_dictionaries['crawler_parameters'][ -1 ][ $car_option ]) && $car_option !== 'undefined') {
                $this->_logs[] = 'Не визначена опція: ' . $car_option;
                unset($this->_advert['car_options'][ $i ]);
            }
        }
    }

    //получаем Опции, интерьер
    protected function _setCarOptionsInterior()
    {
        $this->_advert['car_options_interior'] = array();
        foreach ($this->_advert['car_options'] as $i => $car_option) {

            $car_option = mb_strtolower(trim($car_option), 'UTF-8');

            if (isset($this->_dictionaries['crawler_parameters'][ CAR_OPTIONS_INTERIOR ][ $car_option ])) {
                $this->_advert['car_options_interior'][] = $this->_dictionaries['crawler_parameters'][ CAR_OPTIONS_INTERIOR ][ $car_option ];
                unset($this->_advert['car_options'][ $i ]);
            } elseif (!isset($this->_dictionaries['crawler_parameters'][ -1 ][ $car_option ]) && $car_option !== 'undefined') {
                $this->_logs[] = 'Не визначена опція: ' . $car_option;
                unset($this->_advert['car_options'][ $i ]);
            }
        }
    }

    //получаем Опции, комфорт
    protected function _setCarOptionsComfort()
    {
        $this->_advert['car_options_comfort'] = array();
        foreach ($this->_advert['car_options'] as $i => $car_option) {

            $car_option = mb_strtolower(trim($car_option), 'UTF-8');

            if (isset($this->_dictionaries['crawler_parameters'][ CAR_OPTIONS_COMFORT ][ $car_option ])) {
                $this->_advert['car_options_comfort'][] = $this->_dictionaries['crawler_parameters'][ CAR_OPTIONS_COMFORT ][ $car_option ];
                unset($this->_advert['car_options'][ $i ]);
            } elseif (!isset($this->_dictionaries['crawler_parameters'][ -1 ][ $car_option ]) && $car_option !== 'undefined') {
                $this->_logs[] = 'Не визначена опція: ' . $car_option;
                unset($this->_advert['car_options'][ $i ]);
            }
        }
    }

    //получаем Опции, состояние
    protected function _setCarOptionsState()
    {
        $this->_advert['car_options_state'] = array();
        foreach ($this->_advert['car_options'] as $i => $car_option) {

            $car_option = mb_strtolower(trim($car_option), 'UTF-8');

            if (isset($this->_dictionaries['crawler_parameters'][ CAR_OPTIONS_STATE ][ $car_option ])) {
                $this->_advert['car_options_state'][] = $this->_dictionaries['crawler_parameters'][ CAR_OPTIONS_STATE ][ $car_option ];
                unset($this->_advert['car_options'][ $i ]);
            } elseif (!isset($this->_dictionaries['crawler_parameters'][ -1 ][ $car_option ]) && $car_option !== 'undefined') {
                $this->_logs[] = 'Не визначена опція: ' . $car_option;
                unset($this->_advert['car_options'][ $i ]);
            }
        }
    }

    //получаем Опции, мультимедиа
    protected function _setCarOptionsMultimedia()
    {
        $this->_advert['car_options_multimedia'] = array();
        foreach ($this->_advert['car_options'] as $i => $car_option) {

            $car_option = mb_strtolower(trim($car_option), 'UTF-8');

            if (isset($this->_dictionaries['crawler_parameters'][ CAR_OPTIONS_MULTIMEDIA ][ $car_option ])) {
                $this->_advert['car_options_multimedia'][] = $this->_dictionaries['crawler_parameters'][ CAR_OPTIONS_MULTIMEDIA ][ $car_option ];
                unset($this->_advert['car_options'][ $i ]);
            } elseif (!isset($this->_dictionaries['crawler_parameters'][ -1 ][ $car_option ]) && $car_option !== 'undefined') {
                $this->_logs[] = 'Не визначена опція: ' . $car_option;
                unset($this->_advert['car_options'][ $i ]);
            }
        }
    }

    //получаем Опции, другое
    protected function _setCarOptionsOther()
    {
        $this->_advert['car_options_other'] = array();
        foreach ($this->_advert['car_options'] as $i => $car_option) {

            $car_option = mb_strtolower(trim($car_option), 'UTF-8');

            if (isset($this->_dictionaries['crawler_parameters'][ CAR_OPTIONS_OTHER ][ $car_option ])) {
                $this->_advert['car_options_other'][] = $this->_dictionaries['crawler_parameters'][ CAR_OPTIONS_OTHER ][ $car_option ];
                unset($this->_advert['car_options'][ $i ]);
            } elseif (!isset($this->_dictionaries['crawler_parameters'][ -1 ][ $car_option ]) && $car_option !== 'undefined') {
                $this->_logs[] = 'Не визначена опція: ' . $car_option;
                unset($this->_advert['car_options'][ $i ]);
            }
        }
    }
//конец установки значений

    public function getHTML($url, $full=false) {

        $result = array();

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
                'Accept-Charset: utf-8;q=0.7,*;q=0.7',
                'Accept-Language: ru-ru,ru;q=0.7,en-us;q=0.5,en;q=0.3',
                'Connection: keep-alive')
        );
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:27.0) Gecko/20100101 Firefox/27.0');
        curl_setopt($ch, CURLOPT_REFERER, 'http://www.yandex.ru/');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $html = curl_exec($ch);
        $info = curl_getinfo($ch);

        curl_close($ch);


        return ($full) ? $html : array_merge($info, array('html' => $html));
    }

    //инициализируем базовые параметри объявления
    protected function _initAdvert($i)
    {
        $this->_advert = array(
            'sources_organizations_id' => $this->_sources_organizations_id,
            'sources_id' => $i,
            'url' => $this->_getUrl($i)
        );

        $next = true;

        do {
            $result = $this->getHTML($this->_advert['url']);

            switch ($result['http_code']) {
                case '301':
                case '302':
                    $this->_advert['url'] = $result['redirect_url'];
                    break;
                case '404':
                    $this->_advert['html'] = '';
                default:
                    $this->_advert['html'] = $result['html'];
                    if (!$this->_isValidSite()) exit;

                    $next = false;
                    break;
            }

        } while ($next);

        // close cURL resource, and free up system resources

        return $this->isValidHTML($this->_advert['html']);
    }

    protected function  _isValidSite() {

        if (preg_match('/(возможны временные перебои)|(There is no auto with such ID)/s', $this->_advert['html'])) return false;


        return true;

    }

    //инициализируем объявления
    public function init()
    {
        $adverts = array();
        //получаем sources_id последнего объявления
        $sources_id = $this->_getLastSourcesId() + 1;
        for ($i = $sources_id; $i < $sources_id + $this->_number; $i++) {

            if ($this->_initAdvert($i)) {
                $adverts[] = $this->_advert;
            }
        }

        return $adverts;
    }

    public function parse($attributes)
    {
        $this->_logs = array();
        $this->_advert = $attributes;

        $this->_html = str_get_html( $this->_stripHTML($this->_advert['html']) );

        $methods = get_class_methods($this);

        try {
            //парсим содержимое до текстовых значений
            foreach ($methods as $method) {
                if (preg_match('/^_parse.*/', $method)) {
                    $this->$method();
                }
            }

            //устанавливаем значения ID

            foreach ($methods as $method) {
                if (preg_match('/^_set.*/', $method)) {
                    $this->$method();
                }
            }
            $this->_advert['valid_statuses_id'] = (sizeOf($this->_logs) > 0) ? 0 : 1;
        }
        catch(Exception $e) {
            $this->_logs[]=$e->getMessage();
            $this->_advert['valid_statuses_id'] = 2;
        }


        $this->_advert['valid_statuses_id'] = (sizeOf($this->_logs) > 0) ? 0 : 1;
        $this->_advert['errors'] = $this->_logs;

        return $this->_advert;
    }
}