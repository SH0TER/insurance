<?
/*
 * Title: product document class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class ProductDocuments extends Form {

    var $formDescription =
			array(
				'fields'     =>
					array(
						array(
							'name'                => 'id',
							'type'                => fldIdentity,
							'display'            =>
								array(
									'show'        => true,
									'insert'    => false,
									'view'        => true,
									'update'    => true
								),
							'verification'        =>
								array(
									'canBeEmpty'    => false
								),
							'table'                => 'product_documents'),
						array(
							'name'                => 'product_types_id',
							'description'        => 'Тип',
							'type'                => fldHidden,
							'display'            =>
								array(
									'show'        => true,
									'insert'    => true,
									'view'        => true,
									'update'    => true
								),
							'verification'        =>
								array(
								'canBeEmpty'    => true
								),
							'table'                => 'product_documents'),
						array(
							'name'                => 'product_document_types_id',
							'description'        => 'Тип',
							'type'                => fldSelect,
							'display'            =>
								array(
									'show'        => true,
									'insert'    => true,
									'view'        => true,
									'update'    => true
								),
							'verification'        =>
								array(
									'canBeEmpty'    => true
								),
							'orderPosition'        => 1,
							'table'                => 'product_documents',
							'sourceTable'          => 'product_document_types',
							'selectField'          => 'title',
							'orderField'           => 'title'),
						array(
							'name'                => 'date',
							'description'        => 'Початок дії',
							'type'                => fldDate,
							'input'                => true,
							'display'            =>
								array(
									'show'        => true,
									'insert'    => true,
									'view'        => true,
									'update'    => true
								),
							'verification'        =>
								array(
									'canBeEmpty'    => false
								),
							'orderPosition'        => 2,
							'table'                => 'product_documents'),
						array(
							'name'                => 'financial_institutions_id',
							'description'        => 'Банки',
							'type'                => fldMultipleSelect,
							'display'            =>
								array(
									'show'        => false,
									'insert'    => true,
									'view'        => false,
									'update'    => true
								),
							'verification'        =>
								array(
									'canBeEmpty'    => true
								),
							'table'                => 'financial_institution_product_document_assignments',
							'sourceTable'        => 'financial_institutions',
							'selectField'        => 'title',
							'orderField'        => 'title'),
						array(
							'name'                => 'car_types_id',
							'description'        => 'Типи ТЗ',
							'type'                => fldMultipleSelect,
							'display'            =>
								array(
									'show'        => false,
									'insert'    => true,
									'view'        => false,
									'update'    => true
								),
							'verification'        =>
								array(
									'canBeEmpty'    => true
								),
							'table'                => 'car_types_product_document_assignments',
							'sourceTable'        => 'car_types',
							'condition'            => 'product_types_id = 3',
							'selectField'        => 'title',
							'orderField'        => 'order_position'),
						 array(
							'name'                => 'products_id',
							'description'        => 'Страховi продукти',
							'type'                => fldMultipleSelect,
							'display'            =>
								array(
									'show'        => false,
									'insert'    => true,
									'view'        => false,
									'update'    => true
								),
							'verification'        =>
								array(
									'canBeEmpty'    => true
								),
							'table'                => 'product_document_assignments',
							'condition'            => '(product_types_id = 3 OR product_types_id = 13)',
							'sourceTable'        => 'products',
							'selectField'        => 'title',
							'orderField'        => 'title'),
						array(
							'name'                => 'description',
							'description'        => 'Опис',
							'type'                => fldText,
							'maxlength'            => 50,
							'display'            =>
								array(
									'show'        => true,
									'insert'    => true,
									'view'        => true,
									'update'    => true
								),
							'verification'        =>
								array(
									'canBeEmpty'    => true
								),
							'orderPosition'        => 3,
							'table'                => 'product_documents'),
						array(
							'name'                => 'info',
							'description'        => 'Додатковi умови',
							'type'                => fldNote,
							'replaceTags'		=>false,
							'display'            =>
								array(
									'show'        => true,
									'insert'    => true,
									'view'        => true,
									'update'    => true
								),
							'verification'        =>
								array(
									'canBeEmpty'    => true
								),
							'table'                => 'product_documents'),	
						array(
							'name'                => 'race',
							'description'        => 'Страхування перегону',
							'type'                => fldBoolean,
							'display'            =>
								array(
									'show'        => false,
									'insert'    => true,
									'view'        => false,
									'update'    => true
								),
							'verification'        =>
								array(
									'canBeEmpty'    => true
								),
							'table'                => 'product_documents'),
						array(
							'name'                => 'multiple_cars',
							'description'        => 'Страхування декiлька ТЗ',
							'type'                => fldBoolean,
							//'addition'			=>'onclick="showProducts()"',
							'display'            =>
								array(
									'show'        => false,
									'insert'    => true,
									'view'        => false,
									'update'    => true
								),
							'verification'        =>
								array(
									'canBeEmpty'    => true
								),
							'table'                => 'product_documents'),
						array(
							'name'                => 'long_term',
							'description'        => 'Багатолiтнiй договор',
							'type'                => fldBoolean,
							'display'            =>
								array(
									'show'        => false,
									'insert'    => true,
									'view'        => false,
									'update'    => true
								),
							'verification'        =>
								array(
									'canBeEmpty'    => true
								),
							'table'                => 'product_documents'),
						array(
							'name'                => 'file',
							'description'        => 'Файл',
							'type'                => fldFile,
							'format'            => '\.tpl$',
							'display'            =>
								array(
									'show'        => true,
									'insert'    => true,
									'view'        => true,
									'update'    => true
								),
							'verification'        =>
								array(
									'canBeEmpty'    => false
								),
							'orderPosition'        => 4,
							'table'                => 'product_documents'),
						array(
							'name'                => 'created',
							'description'        => 'Створено',
							'type'                => fldDate,
							'value'                => 'NOW()',
							'display'            =>
								array(
									'show'        => false,
									'insert'    => false,
									'view'        => false,
									'update'    => false
								),
							'verification'        =>
								array(
								'canBeEmpty'    => false
								),
							'table'                => 'product_documents'),
						array(
							'name'                => 'modified',
							'description'        => 'Редаговано',
							'type'                => fldDate,
							'value'                => 'NOW()',
							'display'            =>
								array(
									'show'        => true,
									'insert'    => false,
									'view'        => false,
									'update'    => false
								),
							'verification'        =>
								array(
								'canBeEmpty'    => false
								),
							'orderPosition'        => 5,
							'width'             => 100,
							'table'                => 'product_documents')
					),
				'common'    =>
					array(
						'defaultOrderPosition'		=> 1,
						'defaultOrderDirection'		=> 'asc',
						'titleField'				=> 'title')
    );

    function ProductDocuments(&$data) {
        Form::Form($data);

        $this->messages['plural'] = 'Документи';
        $this->messages['single'] = 'Документ';

        if (!$data['sections_id']) {
            $data['sections_id'] = PRODUCT_DOCUMENT_SECTIONS_SALE;
        }
		
		if ($data['product_types_id'] != PRODUCT_TYPES_KASKO && $data['product_types_id'] != PRODUCT_TYPES_NS) {
			unset($this->formDescription['fields'][ $this->getFieldPositionByName('products_id') ]);
		}	

        $this->formDescription['fields'][ $this->getFieldPositionByName('product_document_types_id') ]['condition'] = 'sections_id = ' . intval($data['sections_id']) . ' AND product_types_id = ' . intval($data['product_types_id']);

        switch ($data['sections_id']) {
            case PRODUCT_DOCUMENT_SECTIONS_SALE:
                break;
            case PRODUCT_DOCUMENT_SECTIONS_SETTLEMENT:
                unset($this->formDescription['fields'][ $this->getFieldPositionByName('date') ]);
				unset($this->formDescription['fields'][ $this->getFieldPositionByName('products_id') ]);
                unset($this->formDescription['fields'][ $this->getFieldPositionByName('car_types_id') ]);
                unset($this->formDescription['fields'][ $this->getFieldPositionByName('multiple_cars') ]);
                unset($this->formDescription['fields'][ $this->getFieldPositionByName('financial_institutions_id') ]);
                $this->formDescription['fields'][ $this->getFieldPositionByName('file') ]['verification']['canBeEmpty'] = true;
                break;
        }
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'      => true,
                    'insert'    => true,
                    'update'    => true,
                    'view'      => true,
                    'change'	=> false,
                    'delete'    => true);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
                break;

        }
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
        global $db;

        $sql1 =	'SELECT id, title ' .
                'FROM ' . PREFIX . '_financial_institutions ' .
                'ORDER BY title';
		$data['financial_institutions'] = $db->getAll($sql1, 30 * 60);

        if ($data['financial_institutions_id']>0) {
            $conditions[] = 'insurance_product_documents.id IN (SELECT product_documents_id FROM  '.PREFIX.'_financial_institution_product_document_assignments WHERE financial_institutions_id='.intval($data['financial_institutions_id']).')';
        }

        $fields[] = 'sections_id';
        $conditions[] = 'sections_id = ' . intval($data['sections_id']);

        parent::show($data, $fields, $conditions, $sql, $this->object . '/show.php', $limit);
    }

    function load($data, $showForm=true, $action='update', $actionType='update', $template=null) {
        global $db;

        $this->checkPermissions('update', $data);

        if (is_array($data['id'])) $data['id'] = $data['id'][0];

        $this->setTables('load');
        $this->getFormFields('update');

        $identityField = $this->getIdentityField();

        $sql =	'SELECT ' . implode(', ', $this->formFields) . ', sections_id ' .
				'FROM ' . $this->tables[0] . ' ' .
				'JOIN ' . PREFIX . '_product_document_types ON ' . $this->tables[0] . '.product_document_types_id = ' . PREFIX . '_product_document_types.id ' .
				'WHERE ' . PREFIX . '_' . $identityField['table'] . '.' . $identityField['name'] . '=' . intval($data['id']);
        $data = $db->getRow($sql);

        $data = $this->prepareFields($action, $data);

        if ($showForm) {
            $this->showForm($data, $action, $actionType, $template);
        } else {
            return $data;
        }
    }

    function deleteProcess($data, $i = 0, $folder=null) {
        global $db;

        $sql =	'DELETE FROM ' . PREFIX . '_financial_institution_product_document_assignments ' .
				'WHERE product_documents_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);

		$sql =	'DELETE FROM ' . PREFIX . '_car_types_product_document_assignments ' .
				'WHERE product_documents_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);
		
		$sql =	'DELETE FROM ' . PREFIX . '_product_document_assignments ' .
				'WHERE product_documents_id IN(' . implode(', ', $data['id']) . ')';
        $db->query($sql);
		
		$conditions[] = 'id IN(' . implode(', ', $data['id']) . ')';

		$sql =	'DELETE ' .
				'FROM ' . $this->tables[ $i ] . ' ' .
				'WHERE ' . implode(' AND ', $conditions);
		$db->query($sql);

		return true;
    }

    function get($product_types_id, $product_document_types_id, $date, $financial_institutions_id=null, $car_types_id=null, $multiple_cars=null, $products_id=null,$race=null,$long_term=null) {
        global $db;

        $sql = 'SELECT sections_id ' .
            'FROM ' . PREFIX . '_product_document_types ' .
            'WHERE id = ' . intval($product_document_types_id);
        $sections_id = $db->getOne($sql);//идентификатор документов урегулирования

        $conditions[] = '(product_types_id = ' . intval($product_types_id).' OR product_types_id = 1)';
        $conditions[] = 'product_document_types_id = ' . intval($product_document_types_id);

        if ($product_types_id == PRODUCT_TYPES_KASKO && $sections_id == 1 ) {
			if (!intval($race)) {
				$conditions[] = 'a.multiple_cars = ' . ($multiple_cars ? '1':'0');//учитываем это условие, если не перегоны
			}

			$conditions[] = 'a.race = ' . (intval($race)>0 ? '1':'0');
			//if ($product_document_types_id==2)
			//	$conditions[] = 'a.long_term = ' . (intval($long_term)>0 ? '1':'0');
        }

        if ($product_types_id == PRODUCT_TYPES_KASKO && intval($car_types_id) && $sections_id == 1) {
            $conditions[] = 'car_types_id = ' . intval($car_types_id);
        }
		if (($product_types_id == PRODUCT_TYPES_KASKO && $sections_id == 1) || $product_types_id == PRODUCT_TYPES_NS) {
			//поиск договора для конкретного продукта Банк здесь неучитываем
			$conditions[] = 'product_types_id = ' . intval($product_types_id);
			$sql =	'SELECT file FROM ' . PREFIX . '_product_documents as a '.
					'JOIN ' . PREFIX . '_product_document_assignments as d ON a.id = d.product_documents_id AND products_id=' . intval($products_id) . ' ' .
					'LEFT JOIN ' . PREFIX . '_car_types_product_document_assignments as c ON a.id = c.product_documents_id '.
					'WHERE ' . implode(' AND ', $conditions) . ' ' .
					'ORDER BY a.id DESC ' .
					'LIMIT 1';
			$file =	$db->getOne($sql);
//_dump($sql);exit;
			if ($file) {
				return $file;
			}
		}	  
//_dump($product_document_types_id);exit;
        if (intval($financial_institutions_id) && $product_document_types_id != 1 && $product_document_types_id != 110 && $product_document_types_id != 111 && $product_document_types_id != 69 && $product_document_types_id != 106 && $product_document_types_id != 101 && $product_document_types_id != 94  && $product_document_types_id != 151 && ($product_types_id!=12 || $product_document_types_id==44)) {
            $conditions[] = 'financial_institutions_id = ' . intval($financial_institutions_id);
            $conditions[] = 'NOT ISNULL(b.product_documents_id)';
        } else {
            $conditions[] = 'ISNULL(b.product_documents_id)';
        }

        //!!! надо доработать начало действие документа
        //$conditions[] = 'TO_DAYS(date) <= TO_DAYS(' . $db->quote($date) . ')';

		if ($product_types_id == PRODUCT_TYPES_KASKO && $sections_id == 1) {
			//для конкретного продукта договор не нашли, ищем общий договор
			$conditions[] = 'product_types_id = ' . intval($product_types_id);
			$conditions[] = 'a.id NOT IN (SELECT product_documents_id FROM ' .PREFIX . '_product_document_assignments WHERE products_id <> ' . intval($products_id) . ' )';
		}
//_dump($sql);exit;
        $sql =  'SELECT file ' .
				'FROM ' . PREFIX . '_product_documents as a ' .
                'LEFT JOIN ' . PREFIX . '_financial_institution_product_document_assignments as b ON a.id = b.product_documents_id ' .
                'LEFT JOIN ' . PREFIX . '_car_types_product_document_assignments as c ON a.id = c.product_documents_id ' .
                'WHERE ' . implode(' AND ', $conditions) . ' ' .
                'ORDER BY a.id DESC ' .
                'LIMIT 1';
//_dump($sql);exit;
        return $db->getOne($sql);
    }
}

?>