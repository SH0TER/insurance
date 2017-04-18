<?
/*
 * Title: product type class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

require_once 'Products.class.php';
require_once 'Commissions.class.php';
require_once 'ParametersTerms.class.php';
require_once 'ProductDocuments.class.php';
require_once 'ParametersDrivers.class.php';
require_once 'ParametersRegions.class.php';
require_once 'ParametersCarWeights.class.php';
require_once 'ParametersPassengers.class.php';
require_once 'ProductDocumentTypes.class.php';
require_once 'ParametersBonusMalus.class.php';
require_once 'ParametersDriverAges.class.php';
require_once 'ParametersEngineSizes.class.php';
require_once 'ParametersDeductibles.class.php';
require_once 'ParametersDriverStandings.class.php';
require_once 'ParametersPropertySections.class.php';
require_once 'ParametersInsurancePrice.class.php';

class ProductTypes extends Form {

    var $formDescription =
            array(
                'fields'     =>
                    array(
                        array(
                            'name'                	=> 'id',
                            'type'                	=> fldIdentity,
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> false,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'	=> false
                                ),
                            'table'                	=> 'product_types'),
                        array(
                            'name'                	=> 'title',
                            'description'        	=> 'Назва',
                            'type'                	=> fldUnique,
                            'maxlength'            	=> 150,
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        	=> 1,
                            'table'                	=> 'product_types'),
                        array(
                            'name'                	=> 'order_position',
                            'description'        	=> 'Порядок виводу',
                            'type'                	=> fldOrderPosition,
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> true,
                                    'view'        	=> false,
                                    'update'    	=> false,
                                    'change'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'width'                	=> 150,
                            'orderPosition'        	=> 2,
                            'table'                	=> 'product_types'),
                        array(
                            'name'                	=> 'parent_id',
                            'description'        	=> 'Тип',
                            'type'                	=> fldHidden,
                            'structure'            	=> 'tree',
                            'condition'            	=> 'parent_id=0',
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> true,
                                    'view'        	=> true,
                                    'update'    	=> true
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => true
                                ),
                            'table'                	=> 'product_types'),
                        array(
                            'name'                	=> 'created',
                            'description'        	=> 'Створено',
                            'type'                	=> fldDate,
                            'value'                	=> 'NOW()',
                            'display'            	=>
                                array(
                                    'show'        	=> false,
                                    'insert'    	=> false,
                                    'view'        	=> false,
                                    'update'    	=> false
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'table'                	=> 'product_types'),
                        array(
                            'name'                	=> 'modified',
                            'description'        	=> 'Редаговано',
                            'type'                	=> fldDate,
                            'value'                	=> 'NOW()',
                            'display'            	=>
                                array(
                                    'show'        	=> true,
                                    'insert'    	=> false,
                                    'view'        	=> false,
                                    'update'    	=> false
                                ),
                            'verification'        	=>
                                array(
                                    'canBeEmpty'    => false
                                ),
                            'orderPosition'        	=> 2,
                            'width'             	=> 100,
                            'table'                	=> 'product_types')
                    ),
                'common'    =>
                    array(
                        'defaultOrderPosition'    	=> 1,
                        'defaultOrderDirection'    	=> 'asc',
                        'titleField'            	=> 'title'
                    )
            );

    function ProductTypes($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Типи страхових продуктів';
        $this->messages['single'] = 'Тип страхового продукту';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'    	=> true,
                    'insert'    => true,
                    'update'    => true,
                    'view'    	=> true,
                    'change'    => false,
                    'delete'    => false);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
        }
    }

    function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {

        $fields     = array('parent_id');
        $conditions = array('parent_id = ' . intval($data['parent_id']));

        parent::show($data, $fields, $conditions, $sql, $template, $limit);

        if (!intval($data['parent_id'])) {
            $fields     = array('product_types_id');
            $conditions = array('product_types_id = ' . intval($data['parent_id']));

            $ParametersTerms = new ParametersTerms($data);
            $ParametersTerms->show($data, $fields, $conditions);

			$Commissions = new Commissions($data);
			$Commissions->show($data);
        }
    }

    function view($data) {
		global $Authorization;

        if ($data['product_types_id'])
            $data['id'] = $data['product_types_id'];

        $row = parent::view($data);

        if (!intval($row['parent_id'])) {
            $data['parent_id'] = $row['id'];
            $this->setObjectTitle('sub' . $this->objectTitle);

            $this->show($data);
        }

        $data['product_types_id'] = $row['id'];

        $fields[]       = 'product_types_id';
        $conditions[]   = 'product_types_id=' . intval($data['product_types_id']);

        switch ($data['product_types_id']) {

            case PRODUCT_TYPES_AUTO://автострахование
				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ParametersRegions']['show']) {
					$ParametersRegions = new ParametersRegions($data);
					$ParametersRegions->show($data, $fields, $conditions);
				}

                if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ProductDocumentTypes']['show']) {

					$ProductDocumentTypes = new ProductDocumentTypes($data);
					$ProductDocumentTypes->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ProductDocuments']['show']) {
					$conditions    = array(PREFIX . '_product_documents.product_types_id=' . intval($data['product_types_id']));
					$ProductDocuments = new ProductDocuments($data);
					$ProductDocuments->show($data, $fields, $conditions);
				}	    
                break;

            case PRODUCT_TYPES_KASKO://КАСКО

                $Products = Products::factory($data, 'KASKO');
				$Products->show($data, array('product_types_id'), array(PREFIX . '_products.product_types_id=' . intval($data['product_types_id'])));

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ParametersDriverStandings']['show']) {
					//$ParametersDriverStandings = new ParametersDriverStandings($data);
					//$ParametersDriverStandings->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR 
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ParametersTerms']['show']) {
					//$ParametersTerms = new ParametersTerms($data);
					//$ParametersTerms->show($data, $fields, $conditions);
				}	

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR 
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ProductDocumentTypes']['show']) {
					
					//$ProductDocumentTypes = new ProductDocumentTypes($data);
					//$ProductDocumentTypes->show($data, $fields, $conditions);
				}
				
				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR 
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ProductDocuments']['show']) {
					$conditions    = array(PREFIX . '_product_documents.product_types_id=' . intval($data['product_types_id']));
					$ProductDocuments = new ProductDocuments($data);
					$ProductDocuments->show($data, $fields, $conditions);
				}	
                break;

            case PRODUCT_TYPES_GO://ЦВ

                $Products = Products::factory($data, 'GO');
                $Products->show($data, $fields, $conditions);

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ParametersDriverStandings']['show']) {
					$ParametersDriverStandings = new ParametersDriverStandings($data);
					$ParametersDriverStandings->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR 
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ParametersEngineSizes']['show']) {

					$ParametersEngineSizes = new ParametersEngineSizes($data);
					$ParametersEngineSizes->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR 
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ParametersRegions']['show']) {
					$ParametersRegions = new ParametersRegions($data);
					$ParametersRegions->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR 
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ParametersTerms']['show']) {
					$ParametersTerms = new ParametersTerms($data);
					$ParametersTerms->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ParametersCarNumbers']['show']) {
					$ParametersCarNumbers = new ParametersCarNumbers($data);
					$ParametersCarNumbers->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ParametersBonusMalus']['show']) {
					$ParametersBonusMalus = new ParametersBonusMalus($data);
					$ParametersBonusMalus->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR 
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ProductDocumentTypes']['show']) {
					$ProductDocumentTypes = new ProductDocumentTypes($data);
					$ProductDocumentTypes->show($data, $fields, $conditions);
				}	

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR 
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ProductDocuments']['show']) {
					$conditions    = array(PREFIX . '_product_documents.product_types_id=' . intval($data['product_types_id']));
					$ProductDocuments = new ProductDocuments($data);
					$ProductDocuments->show($data, $fields, $conditions);
				}
                break;

            case PRODUCT_TYPES_DGO://ДГО

                $Products = Products::factory($data, 'DGO');
                $Products->show($data, $fields, $conditions);
				
				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR 
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ParametersTerms']['show']) {
					$ParametersTerms = new ParametersTerms($data);
					$ParametersTerms->show($data, $fields, $conditions);
				}

                if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ParametersInsurancePrice']['show']) {
					$ParametersInsurancePrice = new ParametersInsurancePrice($data);
					$ParametersInsurancePrice->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR 
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ProductDocumentTypes']['show']) {
					$ProductDocumentTypes = new ProductDocumentTypes($data);
					$ProductDocumentTypes->show($data, $fields, $conditions);
				}	

   				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR 
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ProductDocuments']['show']) {
					$conditions    = array(PREFIX . '_product_documents.product_types_id=' . intval($data['product_types_id']));
					$ProductDocuments = new ProductDocuments($data);
					$ProductDocuments->show($data, $fields, $conditions);
				}
                break;

            case PRODUCT_TYPES_DSKV://Добровільне страхування квартири та відповідальності
                $Products = Products::factory($data, 'DSKV');
                $Products->show($data, $fields, $conditions);

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR 
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ProductDocumentTypes']['show']) {
				
					$ProductDocumentTypes = new ProductDocumentTypes($data);
					$ProductDocumentTypes->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR 
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ProductDocuments']['show']) {
				
					$conditions    = array(PREFIX . '_product_documents.product_types_id=' . intval($data['product_types_id']));
					$ProductDocuments = new ProductDocuments($data);
					$ProductDocuments->show($data, $fields, $conditions);
				}	
                break;
            case PRODUCT_TYPES_CARGO_CERTIFICATE://Страхування перевезень
            case PRODUCT_TYPES_DRIVE_CERTIFICATE://Страхування перегонів
				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR 
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ProductDocumentTypes']['show']) {
			
					$ProductDocumentTypes = new ProductDocumentTypes($data);
					$ProductDocumentTypes->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR 
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ProductDocuments']['show']) {
				
					$conditions    = array(PREFIX . '_product_documents.product_types_id=' . intval($data['product_types_id']));
					$ProductDocuments = new ProductDocuments($data);
					$ProductDocuments->show($data, $fields, $conditions);
				}
                break;

            case PRODUCT_TYPES_PROPERTY://имущество
			case PRODUCT_TYPES_MORTAGE://имущество
			
				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR 
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ProductDocumentTypes']['show']) {
					$Products = Products::factory($data, 'Property');
					$Products->show($data, $fields, $conditions);
				
					$ProductDocumentTypes = new ProductDocumentTypes($data);
					$ProductDocumentTypes->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR 
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ProductDocuments']['show']) {
					$ProductDocuments = new ProductDocuments($data);
					$ProductDocuments->show($data, $fields, array(PREFIX . '_product_documents.product_types_id=' . intval($data['product_types_id'])));
				}
                break;

            case PRODUCT_TYPES_NS://НС

                $Products = Products::factory($data, 'NS');
				$Products->show($data, array('product_types_id'), array(PREFIX . '_products.product_types_id=' . intval($data['product_types_id'])));

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR 
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ProductDocumentTypes']['show']) {
					$ProductDocumentTypes = new ProductDocumentTypes($data);
					$ProductDocumentTypes->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR 
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ProductDocuments']['show']) {
					$conditions    = array(PREFIX . '_product_documents.product_types_id=' . intval($data['product_types_id']));
					$ProductDocuments = new ProductDocuments($data);
					$ProductDocuments->show($data, $fields, $conditions);
				}	
                break;
			 case PRODUCT_TYPES_NS_TRANSPORT://НС транспорт

                $Products = Products::factory($data, 'NS_Transport');
				$Products->show($data, array('product_types_id'), array(PREFIX . '_products.product_types_id=' . intval($data['product_types_id'])));

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR 
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ProductDocumentTypes']['show']) {
					$ProductDocumentTypes = new ProductDocumentTypes($data);
					$ProductDocumentTypes->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR 
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ProductDocuments']['show']) {
					$conditions    = array(PREFIX . '_product_documents.product_types_id=' . intval($data['product_types_id']));
					$ProductDocuments = new ProductDocuments($data);
					$ProductDocuments->show($data, $fields, $conditions);
				}	
                break;	
				
			case PRODUCT_TYPES_TRANSPORTER:
			case PRODUCT_TYPES_THIRD_PARTY_LIABILITY:
			case PRODUCT_TYPES_THIRD_PARTY_LIABILITY_PROF_RESP:
			case PRODUCT_TYPES_TRANSPORT_ACCIDENTS:
			case PRODUCT_TYPES_DANGER_OBJECTS:
			case PRODUCT_TYPES_ONE_SHIPPING:
            case PRODUCT_TYPES_DMS:
				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ProductDocumentTypes']['show']) {

					$ProductDocumentTypes = new ProductDocumentTypes($data);
					$ProductDocumentTypes->show($data, $fields, $conditions);
				}

				if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR
					|| $Authorization->data['roles_id'] == ROLES_MANAGER && $Authorization->data['permissions']['ProductDocuments']['show']) {
					$conditions    = array(PREFIX . '_product_documents.product_types_id=' . intval($data['product_types_id']));
					$ProductDocuments = new ProductDocuments($data);
					$ProductDocuments->show($data, $fields, $conditions);
				}	    
                break;
        }
    }

    function deleteProcess($data, $i=0) {
        global $db, $Log;

        //страхові продукти
        $Products = new Products($data);

        $sql =  'SELECT id ' .
                'FROM ' . $Products->tables[0] . ' ' .
                'WHERE product_types_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>' . $Products->messages['plural'] . '</b>.');
            return false;
        }

        //ризики
        $ParametersRisks = new ParametersRisks($data);

        $sql =  'SELECT id ' .
                'FROM ' . $ParametersRisks->tables[0] . ' ' .
                'WHERE product_types_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>' . $ParametersRisks->messages['plural'] . '</b>.');
            return false;
        }

        //франшизи
        $ParametersDeductibles = new ParametersDeductibles($data);

        $sql =  'SELECT id ' .
                'FROM ' . $ParametersDeductibles->tables[0] . ' ' .
                'WHERE product_types_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>' . $ParametersDeductibles->messages['plural'] . '</b>.');
            return false;
        }

        //cтаж вождіння
        $ParametersDriverStandings = new ParametersDriverStandings($data);

        $sql =  'SELECT id ' .
                'FROM ' . $ParametersDriverStandings->tables[0] . ' ' .
                'WHERE product_types_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>' . $ParametersDriverStandings->messages['plural'] . '</b>.');
            return false;
        }

        //кількість осіб допущених до керування
        $ParametersDrivers = new ParametersDrivers($data);

        $sql =  'SELECT id ' .
                'FROM ' . $ParametersDrivers->tables[0] . ' ' .
                'WHERE product_types_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>' . $ParametersDrivers->messages['plural'] . '</b>.');
            return false;
        }

        //вік водія
        $ParametersDriverAges = new ParametersDriverAges($data);

        $sql =  'SELECT id ' .
                'FROM ' . $ParametersDriverAges->tables[0] . ' ' .
                'WHERE product_types_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>' . $ParametersDriverAges->messages['plural'] . '</b>.');
            return false;
        }

        //oб'єми двигунів
        $ParametersEngineSizes = new ParametersEngineSizes($data);

        $sql =  'SELECT id ' .
                'FROM ' . $ParametersEngineSizes->tables[0] . ' ' .
                'WHERE product_types_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>' . $ParametersEngineSizes->messages['plural'] . '</b>.');
            return false;
        }

        //регіони переважного використання
        $ParametersRegions = new ParametersRegions($data);

        $sql =  'SELECT id ' .
                'FROM ' . $ParametersRegions->tables[0] . ' ' .
                'WHERE product_types_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>' . $ParametersRegions->messages['plural'] . '</b>.');
            return false;
        }

        //коефіцієнти короткостроковості
        $ParametersTerms = new ParametersTerms($data);

        $sql =  'SELECT id ' .
                'FROM ' . $ParametersTerms->tables[0] . ' ' .
                'WHERE product_types_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>' . $ParametersTerms->messages['plural'] . '</b>.');
            return false;
        }

        //шаблоны документов 
        $ProductDocuments = new ProductDocuments($data);

        $sql =  'SELECT id ' .
                'FROM ' . $ProductDocuments->tables[0] . ' ' .
                'WHERE product_types_id IN(' . implode(', ', $data['id']) . ')';
        $toDelete['id'] = $db->getCol($sql);

        if (sizeOf($toDelete['id'])) {
            $Log->add('error', 'Спочатку треба вилучити <b>' . $ProductDocuments->messages['plural'] . '</b>.');
            return false;
        }

        parent::deleteProcess($data);
    }

    function get($id) {
        switch ($id) {
            case PRODUCT_TYPES_KASKO:
                return 'KASKO';
                break;
			case PRODUCT_TYPES_GO_GENERAL:
				return 'GOGeneral';
				break;
            case PRODUCT_TYPES_GO:
                return 'GO';
                break;
            case PRODUCT_TYPES_DGO:
                return 'DGO';
                break;
            case PRODUCT_TYPES_DSKV:
                return 'DSKV';
                break;
            case PRODUCT_TYPES_CARGO_GENERAL:
                return 'CargoGeneral';
                break;
            case PRODUCT_TYPES_CARGO_CERTIFICATE:
                return 'Cargo';
                break;
            case PRODUCT_TYPES_DRIVE_GENERAL:
                return 'DriveGeneral';
                break;
            case PRODUCT_TYPES_DRIVE_CERTIFICATE:
                return 'Drive';
                break;
			case PRODUCT_TYPES_PROPERTY:
				return 'Property';
				break;
			case PRODUCT_TYPES_NS:
				return 'NS';
			case PRODUCT_TYPES_NS_TRANSPORT:
				return 'NS_Transport';	
			case PRODUCT_TYPES_MORTAGE:
				return 'Mortage';	
				break;
			case PRODUCT_TYPES_TRANSPORTER:
				return 'Transporter';	
				break;
			case PRODUCT_TYPES_THIRD_PARTY_LIABILITY:
				return 'ThirdPartyLiability';	
				break;
			case PRODUCT_TYPES_THIRD_PARTY_LIABILITY_PROF_RESP:
				return 'ThirdPartyLiabilityProfResp';	
				break;
			case PRODUCT_TYPES_TRANSPORT_ACCIDENTS:
				return 'TransportAccidents';
				break;
			case PRODUCT_TYPES_DANGER_OBJECTS:
				return 'DangerObjects';
				break;
			case PRODUCT_TYPES_ONE_SHIPPING:
				return 'OneShipping';
				break;
            case PRODUCT_TYPES_DMS:
				return 'DMS';
				break;
        }
    }
}

?>