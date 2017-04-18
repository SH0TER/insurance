<?
/*
 * Title: product document type class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'ProductDocuments.class.php';

class ProductDocumentTypes extends Form {

	var $formDescription =
			array(
				'fields' 	=>
					array(
						array(
							'name'				=> 'id',
					        'type'				=> fldIdentity,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'product_document_types'),
						array(
							'name'				=> 'product_types_id',
							'description'		=> 'Тип',
					        'type'				=> fldHidden,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 1,
							'table'				=> 'product_document_types',
							'sourceTable'		=> 'product_types',
							'selectField'		=> 'title',
							'orderField'		=> 'order_position'),
						array(
							'name'				=> 'sections_id',
							'description'		=> 'Розділ',
					        'type'				=> fldRadio,
					        'list'				=> array(
					        						1 => 'оформлення',
					        						2 => 'врегулювання'),
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 2,
							'table'				=> 'product_document_types'),
						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
					        'type'				=> fldUnique,
					        'maxlength'			=> 150,
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 3,
							'table'				=> 'product_document_types'),

						array(
							'name'				=> 'declaration',
							'description'		=> 'Використовується',
					        'type'				=> fldMultipleSelect,
							'indexType'			=> 'double',
							'list'				=> array(
														1 => 'Додається до заяви',
														2 => 'Надається сканкопія до справи',
														4 => 'В очікуванні',
														8 => 'Використовуються при складанні страхового акту'),
							'display'			=>
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> false,
									'change'	=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'product_document_types'),
						array(
							'name'				=> 'created',
							'description'		=> 'Створено',
					        'type'				=> fldDate,
					        'value'				=> 'NOW()',
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 6,
                            'width'             => 100,
							'table'				=> 'product_document_types'),
						array(
							'name'				=> 'modified',
							'description'		=> 'Редаговано',
					        'type'				=> fldDate,
					        'value'				=> 'NOW()',
							'display'			=> 
								array(
									'show'		=> true,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'orderPosition'		=> 7,
                            'width'             => 100,
							'table'				=> 'product_document_types')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 6,
						'defaultOrderDirection'	=> 'desc',
						'titleField'			=> 'id'
					)
			);

	function ProductDocumentTypes($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Типи документів';
		$this->messages['single'] = 'Тип документy';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> true,
					'update'	=> true,
					'view'		=> false,
					'change'	=> true,
					'delete'	=> true);
				break;
		}
	}

	function isExists($table, $field, $value, $id = 0, $data = null) {
		global $db;

		$sql =	'SELECT count(*) ' .
				'FROM ' . $table . ' ' .
				'WHERE ' . $field . '=' . $db->quote($value) . ' AND id <> ' . intval($id) . ' AND product_types_id = ' . intval($data['product_types_id']);
		$count = $db->getOne($sql);

		return ($count != 0);
	}

	function deleteProcess($data, $i = 0, $folder=null) {
		global $db, $Log;

		$EventDocuments = new EventDocuments($data);

		$sql =	'SELECT id ' .
				'FROM ' . $EventDocuments->tables[0] . ' ' .
				'WHERE product_document_types_id IN(' . implode(', ', $data['id']) . ')';
		$toDelete['id'] = $db->getCol($sql);

		if (sizeOf($toDelete['id'])) {
			$Log->add('error', 'Спочатку треба вилучити <b>' . $EventDocuments->messages['plural'] . '</b>.');
			return false;
		}

		$ProductDocuments = new ProductDocuments($data);

		$sql =	'SELECT id ' . 
				'FROM ' . $ProductDocuments->tables[0] . ' ' .
				'WHERE product_document_types_id IN(' . implode(', ', $data['id']) . ')';
		$toDelete['id'] = $db->getCol($sql);

		if (sizeOf($toDelete['id'])) {
			$Log->add('error', 'Спочатку треба вилучити <b>' . $ProductDocuments->messages['plural'] . '</b>.');
			return false;
		}

		$EventRequiredDocuments = new EventRequiredDocuments($data);

		$sql =	'SELECT id ' . 
				'FROM ' . $EventRequiredDocuments->tables[0] . ' ' .
				'WHERE product_document_types_id IN(' . implode(', ', $data['id']) . ')';
		$toDelete['id'] = $db->getCol($sql);

		$EventRequiredDocuments->delete($toDelete, false, false);

		return parent::deleteProcess($data, $i, $folder);
	}

	//формируем список типов для урегулирования (перечень необходимых)
	function getList($data) {
		global $db;

		$conditions[] = 'sections_id = 2';
		
		if(intval($data['product_types_id']))
			$conditions[] = 'product_types_id IN(1, ' . intval($data['product_types_id']) . ')';

		$sql =	'SELECT id, title ' .
				'FROM ' . PREFIX . '_product_document_types ' .
				'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY title';
		return $db->getAll($sql, 60 * 60);
	}

	function get($id) {
		global $db;

		$sql =	'SELECT * ' .
				'FROM ' . PREFIX . '_product_document_types ' .
				'WHERE id = ' . intval($id);
		return $db->getRow($sql, 30* 60);
	}
	
	function getListByIdx($array) {
		global $db;
		
		$array[] = 0;
		
		$sql = 'SELECT * ' .
			   'FROM ' . PREFIX . '_product_document_types ' .
			   'WHERE id IN(' . implode(', ', $array) . ') ' .
			   'ORDER BY title ASC';
		return $db->getAll($sql);
	}
}

?>