<?
/*
 * Title: car model class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'CarTypes.class.php';

class CarModels extends Form {

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
							'table'				=> 'car_models'),
						array(
							'name'				=> 'car_brands_id',
							'description'		=> 'Марка',
					        'type'				=> fldSelect,
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
							'table'				=> 'car_models',
							'sourceTable'		=> 'car_brands',
							'selectField'		=> 'title',
							'orderField'		=> 'title'),
						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
					        'type'				=> fldText,
					        'maxlength'			=> 50,
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
							'table'				=> 'car_models'),
                        array(
							'name'				=> 'short_title',
							'description'		=> 'Скорочена назва',
					        'type'				=> fldText,
					        'maxlength'			=> 50,
							'display'			=>
								array(
									'show'		=> true,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'orderPosition'		=> 3,
							'table'				=> 'car_models'),
						array(
							'name'				=> 'synchronize',
							'description'		=> 'Синхронізувати з ЕК',
					        'type'				=> fldBoolean,
							'display'			=> 
								array(
									'show'		=> true,
									'change'		=> true,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'width'				=> 150,
							'orderPosition'		=> 4,
							'table'				=> 'car_models'),
							
						array(
							'name'				=> 'created',
							'description'		=> 'Створено',
					        'type'				=> fldDate,
					        'value'				=> 'NOW()',
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> false,
									'view'		=> false,
									'update'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'car_models'),
						
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
							'orderPosition'		=> 5,
							'width'				=> 120,
							'table'				=> 'car_models')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 1,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function CarModels($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Моделі автомобілів';
		$this->messages['single'] = 'Модель автомобіля';
	}

	function setPermissions() {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'		=> true,
					'insert'	=> true,
					'update'	=> true,
					'view'		=> false,
					'change'	=> false,
					'delete'	=> true);
				break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
		}
	}

	function synhronize(&$data) {
		global $Log,$db;

		if (E_IX_SYNHRONIZATION!=1) return;

		$Client = new SoapClient(E_IX_URL . 'synchronization/express/index.php?wsdl');
		$type = 'carmodels';

		$result = $Client->synhronize(
					array(
						'type'	=> $type,
						'data'		=> serialize($data)));
	}

    function setCarModelAssignments($data) {
        global $db;

        $sql =  'DELETE FROM ' . PREFIX . '_car_type_car_model_assignments ' .
                'WHERE car_models_id = ' . intval($data['models_id']);
        $db->query($sql);

        if (is_array($data['car_types_id'])) {
            foreach ($data['car_types_id'] as $product_types_id => $car_types_id) {
                $sql =  'INSERT INTO ' . PREFIX . '_car_type_car_model_assignments SET ' .
                        'car_types_id = ' . intval($car_types_id) . ', ' .
                        'car_models_id = ' . intval($data['models_id']) . ', ' .
                        'modified = NOW()';
                $db->query($sql);
            }
        }
    }

	function insert($data, $redirect=true) {
		global $Log;

		$data = $this->replaceSpecialChars($data, 'insert');

		$data['models_id'] = parent::insert($data, false);

		if (intval($data['models_id'])) {

			$params['title']		= $this->messages['single'];
			$params['id']			= $data['models_id'];
			$params['storage']		= $this->tables[0];

			$this->setCarModelAssignments($data);

			$this->synhronize($data);

			if ($redirect) {
				$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

				header('Location: ' . $data['redirect']);
				exit;
			} else {
				return $params['id'];
			}
		}
	}

	function prepareFields($action, $data) {
        global $db;

        $data = parent::prepareFields($action, $data);

        $sql =  'SELECT b.product_types_id, a.car_types_id ' .
                'FROM ' . PREFIX . '_car_type_car_model_assignments as a ' .
                'JOIN ' . PREFIX . '_car_types as b ON a.car_types_id=b.id ' .
                'WHERE car_models_id = ' . intval($data['id']);
        $res =  $db->query($sql);

        while($res->fetchInto($row)) {
            $data['car_types_id'][ $row['product_types_id'] ] = $row['car_types_id'];
        }

        return $data;
    }

	function update($data, $redirect=true) {
		global $Log;

		$data = $this->replaceSpecialChars($data, 'insert');

		$data['models_id'] = parent::update($data, false);

		if (intval($data['models_id'])) {

			$params['title']		= $this->messages['single'];
			$params['id']			= $data['models_id'];
			$params['storage']		= $this->tables[0];

			$this->setCarModelAssignments($data);

			$this->synhronize($data);

			if ($redirect) {
				$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

				header('Location: ' . $data['redirect']);
				exit;
			} else {
				return $params['id'];
			}
		}
	}

    function getJavaScriptInWindow($data) {
        global $db;

        $conditions[] = 1;

        if (intval($data['product_types_id'])) {
            $conditions[] = 'b.product_types_id = ' . intval($data['product_types_id']);
        }

        if (intval($data['synchronize'])) {
            $conditions[] = 'c.synchronize = 1';
            $conditions[] = 'd.synchronize = 1';
        }

        $sql =	'SELECT a.car_types_id as types_id, d.id as brands_id, d.title as brandsTitle, c.id as models_id, c.title as modelsTitle ' .
                'FROM ' . PREFIX . '_car_type_car_model_assignments AS a ' .
                'JOIN ' . PREFIX . '_car_types AS b ON a.car_types_id = b.id ' .
                'JOIN ' . PREFIX . '_car_models AS c ON a.car_models_id = c.id ' .
                'JOIN ' . PREFIX . '_car_brands AS d ON c.car_brands_id = d.id ';

        if (intval($data['policies_general_id'])) {
            $sql .= 'JOIN ' . PREFIX . '_policies_drive_general_deductibles AS e ON a.car_types_id = e.car_types_id AND (d.id = e.brands_id OR e.brands_id = 0) AND (c.id = e.models_id OR e.models_id = 0) AND policies_id = ' . intval($data['policies_general_id']) . ' ';
        }

        $sql .=	'WHERE ' . implode(' AND ', $conditions) . ' ' .
				'ORDER BY types_id, d.title, c.title';
        $list = $db->getAll($sql);

		if (is_array($list)) {

			foreach ($list as $i => $row) {
				$row['modelsTitle']=str_replace ( "'" , "\\'" , $row['modelsTitle'] );
				//set type if previous doesn't identical
				if (!$cars[ $row['types_id'] ]) {
					$cars[ $row['types_id'] ] =
						array(
							'brands'	=>
								array(
									$row['brands_id'] =>
										array(
											'title'		=> $row['brandsTitle'],
											'models'	=>
												array(
													$row['models_id'] =>
														array(
															'title'	=> $row['modelsTitle']
														)
												)
										)
								)
						);

						continue;
				}

				//set brand if previous doesn't identical
				if (!$cars[ $row['types_id'] ]['brands'][ $row['brands_id'] ]) {
					$cars[ $row['types_id'] ]['brands'][ $row['brands_id'] ] =
						array(
							'title'		=> $row['brandsTitle'],
							'models'	=>
								array(
									$row['models_id'] =>
										array(
											'title'	=> $row['modelsTitle']
										)
								)
						);

						continue;
				}

				//set model if previous doesn't identical
				$cars[ $row['types_id'] ]['brands'][ $row['brands_id'] ]['models'][ $row['models_id'] ] =
					array(
						'title'	=> $row['modelsTitle']
					);

			}
		}

		if ($cars) {
			$result .= "var cars = new Array();\r\n";

			$i = 0;
			foreach ($cars as $types_id => $types) {
				$result .= "cars[" . $i . "] = new Array('" . $types_id . "', new Array());\r\n";

				$j = 0;
				foreach ($types['brands'] as $brands_id => $brands) {
					$result .= "cars[" . $i . "][1][" . $j . "] = new Array('" . $brands_id . "', '" . $brands['title'] . "', new Array());\r\n";

					$k = 0;
					foreach ($brands['models'] as $models_id => $models) {
						$result .= "cars[" . $i . "][1][" . $j . "][2][" . $k . "] = new Array('" . $models_id . "', '" . $models['title'] . "');\r\n";

						$k++;
					}

					$j++;
				}

				$i++;
			}

if (intval($data['product_types_id'])) {
//установка для КАСКО, ГО и ДГО
$result .= <<< EOD
			function setBrands(brands_id) {

				var car_type = document.getElementById('car_types_id');
				var car_types_id = car_type.options[ car_type.selectedIndex ].value;

				var brand = document.getElementById('brands_id');
				brand.options.length = 0;

				var model = document.getElementById('models_id');
				model.options.length = 0;
				brand.options[ 0 ] = new Option( '...', 0);
				for (var i=0; i < cars.length; i++) {
					if (car_types_id == cars[ i ][ 0 ] ) {
						for (var j=0; j < cars[ i ][1].length; j++) {
							brand.options[ j+1 ] = new Option( cars[ i ][ 1 ][ j ][ 1 ], cars[ i ][ 1 ][ j ][ 0 ]);

							if (brands_id == cars[ i ][ 1 ][ j ][ 0 ]) {
								brand.selectedIndex = j+1;
							}

						}
						break;
					}
				}
			}

			function setModels(models_id) {

				var car_type = document.getElementById('car_types_id');
				var car_types_id = car_type.options[ car_type.selectedIndex ].value;

				var brand = document.getElementById('brands_id');
                if (brand.selectedIndex == -1) {
                    return;
                }
				var brands_id = brand.options[ brand.selectedIndex ].value;
				var model = document.getElementById('models_id');
				model.options.length = 0;

				for (var i=0; i < cars.length; i++) {
					if (car_types_id == cars[ i ][ 0 ] ) {
						for (var j=0; j < cars[ i ][ 1 ].length; j++) {
							if (brands_id == cars[ i ][ 1 ][ j ][ 0 ]) {
								for (var k=0; k < cars[ i ][ 1 ][ j ][ 2 ].length; k++) {
									model.options[ k ] = new Option( cars[ i ][ 1 ][ j ][ 2 ][ k ][ 1 ], cars[ i ][ 1 ][ j ][ 2 ][ k ][ 0 ]);

									if (models_id == cars[ i ][ 1 ][ j ][ 2 ][ k ][ 0 ] ) {
										model.selectedIndex = k;
									}
								}
								break;
							}
						}
					}
				}
			}

			function changeCarType() {
                if (document.getElementById('products')) {
                    document.getElementById('products').innerHTML = '';
                }
				setBrands(0);
				changeBrand();
			}

			function changeBrand() {
				setModels(0);
			}

			function setModel() {
					if (cars.length) {
					setBrands('{$data['brands_id']}');
					setModels('{$data['models_id']}');
				}
			}
EOD;
}

			echo $result;
		}
    }
	
	function getTitle($id) {
		global $db;
		
		$sql = 'SELECT title ' .
			   'FROM ' . PREFIX . '_car_models ' .
			   'WHERE id = ' . intval($id);
		return $db->getOne($sql);
	}
	
	function getListJsonInWindow($data) {
        global $db;

        $conditions = array('1');

        if (intval($data['brands_id'])) {
            $conditions[] = 'models.car_brands_id = ' . intval($data['brands_id']);
        }
		
		if (intval($data['car_types_id'])) {
            $conditions[] = 'types_models.car_types_id = ' . intval($data['car_types_id']);
        }

        $sql = 'SELECT models.id, models.title ' .
               'FROM ' . PREFIX . '_car_models as models ' .
			   'JOIN ' . PREFIX . '_car_type_car_model_assignments as types_models ON models.id = types_models.car_models_id ' .
               'WHERE ' . implode(' AND ', $conditions) . ' ' .
			   'ORDER BY models.title';
        echo json_encode($db->getAll($sql));
    }
 }

?>