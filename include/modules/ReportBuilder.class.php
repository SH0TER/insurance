<?
/*
 * Title: ReportBuilder class
 *
 * @author 
 * @email 
 * @version 3.0
 */

require_once 'Policies.class.php';
require_once 'CarServices.class.php';
require_once 'ReportBuilderInputParameters.class.php';
require_once 'ReportBuilderOutputParameters.class.php';
require_once 'Accidents.class.php';

class ReportBuilder extends Form {

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
							'table'				=> 'reports'),
						array(
							'name'				=> 'title',
							'description'		=> 'Назва',
					        'type'				=> fldUnique,
					        'maxlength'			=> 200,
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
							'table'				=> 'reports'),
						array(
							'name'				=> 'text',
							'description'		=> 'SQL',
					        'type'				=> fldNote,
							'replaceTags'		=> false,
							'display'			=> 
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> true,
									'update'	=> true
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> true
								),
							'table'				=> 'reports'),
						array(
							'name'				=> 'roles_id',
							'description'		=> 'Ролi',
					        'type'				=> fldMultipleSelect,
							'display'			=>
								array(
									'show'		=> false,
									'insert'	=> true,
									'view'		=> false,
									'update'	=> true,
									'change'	=> false
								),
							'verification'		=>
								array(
									'canBeEmpty'	=> false
								),
							'table'				=> 'reports_roles_assignments',
							'sourceTable'		=> 'roles',
							'selectField'		=> 'title',
							'orderField'		=> 'title'),
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
							'table'				=> 'reports'),
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
							'orderPosition'		=> 8,
							'width'				=> 100,
							'table'				=> 'reports')
					),
				'common'	=>
					array(
						'defaultOrderPosition'	=> 2,
						'defaultOrderDirection'	=> 'asc',
						'titleField'			=> 'title'
					)
			);

	function ReportBuilder($data) {
		Form::Form($data);

		$this->messages['plural'] = 'Звiти';
		$this->messages['single'] = 'Звiт';
	}

	function setPermissions($data) {
		global $Authorization;

		switch ($Authorization->data['roles_id']) {
			case ROLES_ADMINISTRATOR:
				$this->permissions = array(
					'show'					=> true,
					'insert'				=> true,
					'update'				=> true,
					'view'					=> true,
					'change'				=> true,
					'delete'				=> true,
					'generate'				=> true,
					'downloadFileInWindow'	=> true);
				break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
            case ROLES_MASTER:
				$this->permissions = array(
					'show'					=> true,
					'generate'				=> true);
				break;
		}
	}

	function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
        global $Authorization;

        $this->setTables('show');
        $this->setShowFields();

        $conditions[] = '1';

        switch ($Authorization->data['roles_id']) {
            case ROLES_MANAGER:
                if (!in_array($Authorization->data['id'], array(3909, 4427, 11467, 13115,13077))) {
                    $conditions[] = $this->tables[0] . '.id NOT IN(40)';
                }
            case ROLES_MASTER:
            case ROLES_AGENT:
            case ROLES_CLIENT_CONTACT:
            case ROLES_EXPERT:
                $conditions[] = PREFIX . '_reports_roles_assignments.roles_id = ' . $Authorization->data['roles_id'];
                break;
        }

        $sql = 'SELECT ' . $this->getShowFieldsSQLString() . ' ' .
               'FROM ' .  $this->tables[0] .
               ($Authorization->data['roles_id']!=ROLES_ADMINISTRATOR ? ' JOIN '.PREFIX.'_reports_roles_assignments ON '.$this->tables[0].'.id='.PREFIX.'_reports_roles_assignments.reports_id ' : ' ').
               'WHERE ' . implode(' AND ', $conditions);

		return parent::show($data, $fields, $conditions, $sql, $template, $limit);
	}

	function generateInWindow($data) {
		$this->generate($data);
	}

	function generate($data) {
		global $db, $Authorization;

		if (is_array($data['id'])) $data['id'] = intval($data['id'][0]);
		$data['report'] = $db->getRow('SELECT * FROM '.PREFIX.'_reports WHERE id='.intval($data['id']));
		$data['inputparameters'] = $db->getAll('SELECT * FROM '.PREFIX.'_reports_input_parameters WHERE reports_id='.intval($data['id']).' order by order_position');
		$data['outputparameters'] = $db->getAll('SELECT * FROM '.PREFIX.'_reports_output_parameters WHERE reports_id='.intval($data['id']).' order by order_position');
        if ($data['id'] == 25) {
            Accidents::updateReportHistory();
        }

		$sql = $data['report']['text'];

        for($i=0; $i<sizeof($data['outputparameters']); $i++){
            if($data['outputparameters'][$i]['types_id'] == 3){
                $data['outputparameters'][$i]['style'] = 'x:str';
            }
        }

		if (is_array($data['inputparameters']) && $data['runquery']) {
			foreach($data['inputparameters'] as $parameter) {
				$alias = $parameter['alias'];
				$val = $data[$alias];
				switch 	($parameter['types_id']) {
					case 1://Число
					case 3://Булево
						$val = intval($val);
						$sql = str_replace('&'.$alias, $val, $sql);
						break;
					case 2://Дата
						$val = substr($val, 6, 4) .'-'. substr($val, 3, 2) .'-'. substr($val, 0, 2);
						$sql = str_replace('&'.$alias, $val, $sql);
						break;
					case 4://Текст
						$val = trim($val);
						$sql = str_replace('&' . $alias, $val , $sql);
						break;
					
					case 7://Банк
					case 15://архив
                    case 19://УкрАвто
                    case 20://Зміна категорії
						$val = intval($val);
						$sql = str_replace ('&' . $alias, $val, $sql);
						break;
					case 6://Агенция
					case 5://Страхова компания
					case 8://Марка
					case 9://да - нет
					case 11://Ризик
					case 12://Статус
					case 13://Тип справи
					case 14://Менеджер
                    case 16://Категорія справи
                    case 17://Клас ремонту
                    case 18://тип(вид) страхування
					case 21://стату оплаты
					case 22://стан справи
						if (is_array($val)) {
							$val=  implode(', ', $val) ;
						} else {
							$val=intval($val);
						}

						if (strlen($val) == 0) $val='0';
						$sql = str_replace('&'.$alias, $val, $sql);
						break;
					case 10://сто
						if ($Authorization->data['roles_id'] == ROLES_MASTER) {
						   $val = intval($Authorization->data['car_services_id']);
						}
						if (intval($val)) {
							$CarServices = new CarServices($data);
							$car_services = array($val);
							$CarServices->getSubId(&$car_services, $val);
							$val = implode(', ', $car_services) ;
						} else {
							$val = intval($val);
						}

						$sql = str_replace('&'.$alias, $val, $sql);
						break;
				}
			}

			if ($sql) $res = $db->query($sql, 60);

			if ($sql && $data['excel']) {
				header('Content-Disposition: attachment; filename="report.xls"');
				header('Content-Type: ' . Form::getContentType('report.xls'));
				include_once $this->object . '/generateExcel.php';
				exit;
			}
		}	

		include_once $this->object . '/generate.php';
	}
	
	function printParameter($data, $parameter) {
		global $db, $Authorization;
														
		switch 	($parameter['types_id']) {
			case 1://Число
				$result =	'<tr>
								<td><b>' . $parameter['title' ] . ':</b></td>
								<td><input type="text" id="' . $parameter['alias'] . '" name="' . $parameter['alias'] . '" value="' . intval($data[$parameter['alias']]) . '" /></td>
							</tr>';
				break;
			case 2://Дата
				if (!isset($data[$parameter['alias']])) $data[ $parameter['alias'] ] = date('d.m.Y');
				$result =	'<tr>
								<td><b>' . $parameter['title'] . ':</b></td>
								<td><table cellpadding=0 cellspacing=0 width="90"><tr><td nowrap><input type="text" id="'.$parameter['alias'].'" name="'.$parameter['alias'].'" value="'.$data[$parameter['alias']].'" class="fldDatePicker" onfocus="this.className=\'fldDatePickerOver\';" onblur="this.className=\'fldDatePicker\';" /></td></tr></table></td>
							</tr>';
				break;
			case 3://Булево
				$result =	'<tr>
								<td><b>' . $parameter['title'] . ':</b></td>
								<td><input type="checkbox" name="' . $parameter['alias'] . '" value="1" ' . (isset($data[$parameter['alias']]) ? 'checked' : '') . ' ></td>
							</tr>';
				break;
			case 4://Текст
				$result =	'<tr>
								<td><b>' . $parameter['title'] . ':</b></td>
								<td><input size="50" type="text" id="' . $parameter['alias'] . '" name="' . $parameter['alias'] . '" value="' . $data[$parameter['alias']] . '" /></td>
							</tr>';
				break;
			case 5://Страхова компания
				$result =	'<tr>
								<td><b>' . $parameter['title'] . ':</b></td>
								<td>
									<select size="3" multiple name="' . $parameter['alias'] . '[]" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" style="width: 200px;">
									<option value="">...</option>
									<option value="' . INSURANCE_COMPANIES_EXPRESS . '" ' . (in_array(INSURANCE_COMPANIES_EXPRESS, $data[$parameter['alias']]) ? 'selected' : '') . '>ТДВ Експрес страхування</option>
									<option value="' . INSURANCE_COMPANIES_GENERALI . '" ' . (in_array(INSURANCE_COMPANIES_GENERALI, $data[$parameter['alias']]) ? 'selected' : '') . '>СК ГАРАНТ-АВТО</option>
									</select>
								</td>
							</tr>';
				break;
			case 6://Агенция
						$sql =	'SELECT id, title ' .
						'FROM insurance_agencies WHERE parent_id=0 ' .
						'ORDER BY id';
				$agencies= $db->getAll($sql, 30 * 60);

				$result =	'<tr>
								<td><b>' . $parameter['title'] . ':</b></td>
							<td>
								<select name="' . $parameter['alias'] . '" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">
								<option value="">...</option>';
				foreach ($agencies as $agency) {
					$result .= '<option value="' . $agency['id'] . '" ' . (($agency['id'] == $data[$parameter['alias']]) ? 'selected' : '') . '>' . $agency['title'] . '</option>';
				}
				$result .= '</select></td></tr>';
				
							break;	
			case 15://Архив
				$result =	'<tr>
								<td><b>'.$parameter['title'].':</b></td>
								<td>
									<select name="' . $parameter['alias'] . '" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">
										<option value="0">...</option>
										<option value="1" ' . ($data[$parameter['alias']] == 1 ? 'selected' : '') . '>в роботi</option>
										<option value="2" ' . ($data[$parameter['alias']] == 2 ? 'selected' : '') . '>архiв</option>
									</select>
								</td>
							</tr>';
				break;
			case 11://Ризик
				$sql =	'SELECT id,  title ' .
						'FROM ' . PREFIX . '_parameters_risks ' .
						'WHERE id<=7';
				$risks = $db->getAll($sql, 60 * 60);

				$result =	'<tr>
								<td><b>' . $parameter['title'] . ':</b></td>
								<td>
									<select size="4" multiple name="' . $parameter['alias'] . '[]" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" style="width: 200px;">
									<option value="">...</option>';
							foreach($risks as $risk) {
								$result .= '<option value="' . $risk['id'] . '" ' . (in_array($risk['id'], $data[$parameter['alias']]) ? 'selected' : '') . '>' . $risk['title'] . '</option>';
							}
				$result .= '</select></td></tr>';
				break;
			  case 12://Статус
				$sql =	'SELECT id,  title ' .
						'FROM ' . PREFIX . '_accident_statuses ' .
						'ORDER BY id';
				$statuses = $db->getAll($sql, 60 * 60);

				$result =	'<tr>
								<td><b>' . $parameter['title'] . ':</b></td>
								<td>
									<select size="4" multiple name="' . $parameter['alias'] . '[]" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" style="width: 200px;">
										<option value="">...</option>';
				foreach($statuses as $status) {
					$result .= '<option value="' . $status['id'] . '" '.(in_array($status['id'], $data[$parameter['alias']])  ? 'selected' : '') . '>' . $status['title'] . '</option>';
				}
				$result .= '</select></td></tr>';
				break;
			case 13://тип справи
				$result =	'<tr>
								<td><b>'.$parameter['title'].':</b></td>
								<td>
									<select size="3" multiple name="'.$parameter['alias'].'[]" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" style="width: 200px;">
										<option value="0">...</option>
										<option value="1" ' . (in_array(1, $data[$parameter['alias']]) ? 'selected' : '') . '>Страховий</option>
										<option value="2" ' . (in_array(2, $data[$parameter['alias']]) ? 'selected' : '') . '>Страховий без виплати</option>
										<option value="3" ' . (in_array(3, $data[$parameter['alias']]) ? 'selected' : '') . '>Не страховий</option>
									</select>
								</td>
							</tr>';
				break;
			 case 14://менеджеры
				$sql =	'SELECT id, lastname AS title ' .
						'FROM ' . PREFIX . '_accounts ' .
						'WHERE roles_id = ' . ROLES_MANAGER . ' AND active = 1 ' .
						'ORDER BY lastname ';
				$acounts = $db->getAll($sql, 60 * 60);

				$result =	'<tr>
								<td><b>' . $parameter['title'] . ':</b></td>
								<td>
									<select size="4" multiple name="' . $parameter['alias'] . '[]" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" style="width: 200px;">
									<option value="">...</option>';
				foreach($acounts as $acount) {
					$result .= '<option value="' . $acount['id'] . '" ' . (in_array($acount['id'], $data[$parameter['alias']]) ? 'selected' : '') . '>' . $acount['title'] . '</option>';
				}
				$result .= '</select></td></tr>';
				break;
			case 10://СТО
				$conditions[] = 1;

				if ($Authorization->data['roles_id']==ROLES_MASTER) {
					$CarServices = new CarServices($data);
					$car_services = array(intval($Authorization->data['car_services_id']));
					$CarServices->getSubId(&$car_services, intval($Authorization->data['car_services_id']));
					$conditions[]=  'id IN ('.implode(', ', $car_services).')' ;
				}

				$sql =	'SELECT id, code, title, level ' .
						'FROM ' . PREFIX . '_car_services ' .
						'WHERE ' . implode(' AND ', $conditions) . ' ' .
						'ORDER BY top, num_l';
				$car_services = $db->getAll($sql, 60 * 60);

				$result =	'<tr>
								<td><b>' . $parameter['title'] . ':</b></td>
								<td>
									<select name="' . $parameter['alias'] . '" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">
										<option value="">...</option>';
				foreach ($car_services as $car_service) {
					$result .= ($car_service['id'] == $data[$parameter['alias']])
							? '<option value="' . $car_service['id'] . '" selected>' . str_repeat('&nbsp;', ($car_service['level'] - 1) * 3) . $car_service['code'] . ' - ' . $car_service['title'] . '</option>'
							: '<option value="' . $car_service['id'] . '">' . str_repeat('&nbsp;', ($car_service['level'] - 1) * 3) . $car_service['code'] . ' - ' . $car_service['title'] . '</option>';
				}
				$result .= '</select></td></tr>';
				break;
			case 7://Банк
				$sql =	'SELECT id, title ' .
						'FROM ' . PREFIX . '_financial_institutions ' .
						'ORDER BY title';
				$financial_institutions = $db->getAll($sql, 30 * 60);

				$result =	'<tr>
								<td><b>' . $parameter['title'] . ':</b></td>
							<td>
								<select name="' . $parameter['alias'] . '" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">
								<option value="">...</option>';
				foreach ($financial_institutions as $financial_institution) {
					$result .= '<option value="' . $financial_institution['id'] . '" ' . (($financial_institution['id'] == $data[$parameter['alias']]) ? 'selected' : '') . '>' . $financial_institution['title'] . '</option>';
				}
				$result .= '</select></td></tr>';

				break;
			case 8://Марка
				$sql =	'SELECT id, title ' .
						'FROM ' . PREFIX . '_car_brands ' .
						'ORDER BY title';
				$models = $db->getAll($sql);
				
				$result =	'<tr>
								<td><b>'.$parameter['title'].':</b></td>
								<td>
									<select size="4" multiple name="'.$parameter['alias'].'[]" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" style="width: 200px;">
										<option value="">...</option>';
				foreach($models as $model) {
					$result .= '<option value="'.$model['id'].'" '.(in_array($model['id'],$data[$parameter['alias']])  ? 'selected' : '').'>'.$model['title'].'</option>';
				}
				$result .= '</select></td></tr>';
				break;
			case 9://Да/Нет
				$result='
				<tr>
				<td><b>'.$parameter['title'].':</b></td>
				<td>
					<select name="'.$parameter['alias'].'" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" style="width: 200px;">
						<option value="0">...</option>
						<option value="1" '.($data[$parameter['alias']] == 1 ? 'selected' : '').'>Да</option>
						<option value="2" '.($data[$parameter['alias']] == 2 ? 'selected' : '').'>Нет</option>
					</select></td>
					</tr>';
				break;
			case 16://Категорія Справи
				$result =	'<tr>
							<td><b>'.$parameter['title'].':</b></td>
							<td>
								<select size="3" multiple name="'.$parameter['alias'].'[]" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" style="width: 200px;">
									<option value="0">...</option>
									<option value="1" ' . (in_array(1, $data[$parameter['alias']]) ? 'selected' : '') . '>Експрес</option>
									<option value="2" ' . (in_array(2, $data[$parameter['alias']]) ? 'selected' : '') . '>Стандарт</option>
									<option value="3" ' . (in_array(3, $data[$parameter['alias']]) ? 'selected' : '') . '>Специфічне</option>
								</select>
							</td>
						</tr>';
				break;
			case 17://Клас ремонту
				$sql =	'SELECT id, title ' .
					'FROM ' . PREFIX . '_repair_classifications ' .
					'ORDER BY title';
				$repair_classes = $db->getAll($sql);

				$result =	'<tr>
							<td><b>'.$parameter['title'].':</b></td>
							<td>
								<select size="4" multiple name="'.$parameter['alias'].'[]" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" style="width: 200px;">
									<option value="">...</option>';
				foreach($repair_classes as $repair_class) {
					$result .= '<option value="'.$repair_class['id'].'" '.(in_array($repair_class['id'],$data[$parameter['alias']])  ? 'selected' : '').'>'.$repair_class['title'].'</option>';
				}
				$result .= '</select></td></tr>';
				break;
			case 18://Тип(вид) страхування
				$sql = 'SELECT id, title ' .
					   'FROM ' . PREFIX . '_product_types ' .
					   'WHERE level = 2 ' .
					   'ORDER BY id';
				$product_types = $db->getAll($sql);

				$result = '<tr>
						  <td><b>'.$parameter['title'].':</b></td>
						  <td>
							<select size="4" name="'.$parameter['alias'].'" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" style="width: 200px;">';
								//<option value="">...</option>';
								foreach($product_types as $product_type){
									$result .= '<option value="'.$product_type['id'].'" '.($product_type['id'] == $data[$parameter['alias']] ? 'selected' : '').'>'.$product_type['title'].'</option>';
								}
				$result .= '</select></td></tr>';
				break;
			case 19://УкрАВТО
			$result =	'<tr>
							<td><b>'.$parameter['title'].':</b></td>
							<td>
								<select name="' . $parameter['alias'] . '" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">
									<option value="0">...</option>
									<option value="1" ' . ($data[$parameter['alias']] == 1 ? 'selected' : '') . '>не УкрАВТО</option>
									<option value="2" ' . ($data[$parameter['alias']] == 2 ? 'selected' : '') . '>УкрАВТО</option>
								</select>
							</td>
						</tr>';
				break;
			case 20://Зміна категорії
				$result =	'<tr>
								<td><b>'.$parameter['title'].':</b></td>
								<td>
									<select name="' . $parameter['alias'] . '" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'">
										<option value="0">...</option>
										<option value="1" ' . ($data[$parameter['alias']] == 1 ? 'selected' : '') . '>ні</option>
										<option value="2" ' . ($data[$parameter['alias']] == 2 ? 'selected' : '') . '>так</option>
									</select>
								</td>
							</tr>';
				break;
			case 21://Статус
				$sql =	'SELECT id,  title ' .
						'FROM insurance_payment_statuses  ORDER BY id';
				$statuses = $db->getAll($sql, 60 * 60);

				$result =	'<tr>
								<td><b>' . $parameter['title'] . ':</b></td>
								<td>
									<select size="4" multiple name="' . $parameter['alias'] . '[]" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" style="width: 200px;">
										<option value="">...</option>';
				foreach($statuses as $status) {
					$result .= '<option value="' . $status['id'] . '" '.(in_array($status['id'], $data[$parameter['alias']])  ? 'selected' : '') . '>' . $status['title'] . '</option>';
				}
				$result .= '</select></td></tr>';
				break;
			case 22://Стан справи
				$result = '<tr><td><b>' . $parameter['title'] . '</b></td><td>';
				$result .= '<select name="' . $parameter['alias'] . '" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" style="width: 100px;">
								<option value="0" '.($data[$parameter['alias']] == 0 ? 'selected' : '').'>...</option>
								<option value="1" '.($data[$parameter['alias']] == 1 ? 'selected' : '').'>в роботі</option>
								<option value="2" '.($data[$parameter['alias']] == 2 ? 'selected' : '').'>врегульовано</option>
								<option value="3" '.($data[$parameter['alias']] == 3 ? 'selected' : '').'>закрито</option>
							</select></td></tr>';
				break;
		}

		echo $result;
	}
	
	function printOutputParameter($val, $parameter, $row, $excel = false) {
		$result = '';

		switch ($parameter['types_id']) {
			case 1://Число
				$result = intval($val);
				break;
			case 2://Деньги
				$result = $excel ? str_replace ( '.' , ',' , $val) : getMoneyFormat($val);
				break;
			case 3://Текст

				$result = $excel ? str_replace ( '&quot;' , '"' , $val) : trim($parameter['link'] ? '<a target="_blank" href="'.str_replace($parameter['link_id'],$row[$parameter['link_id']],$parameter['link']).'">'.$val.'</a>': $val);

				$result = $excel ? str_replace ( '&quot;' , '"' , $val) : trim($parameter['link'] ? '<a target="_blank" href="' . str_replace($parameter['link_id'], $row[$parameter['link_id']], $parameter['link']) . '">' . $val . '</a>': $val);

				break;
			case 4://Дата
				$result = $val && $val!='0000-00-00' ? date('d.m.Y',smarty_make_timestamp($val)) : '';
				break;
			case 7://Дата время
				$result = $val && $val!='0000-00-00' ? date('d.m.Y H:i:s',smarty_make_timestamp($val)) : '';
				break;
			case 5://Булево
				$result = intval($val) > 0 ? 'Так' : 'Нi';
				break;
			case 6://%
				$result = $excel ? str_replace ( '.' , ',' , $val) : $val.' %';
				break;
            case 14://Рациональное число
				$result = $excel ? str_replace ( '.' , ',' , round($val,3)) : $val.'';
                //$result = substr(floatval($val),0,4);
                break;
		}
		
		return $result;
	}
	
	function view($data) {
		if (intval($data['reports_id'])) {
			$data['id'] = $data['reports_id'];
		}

		$row = parent::view($data);

		$data['reports_id'] = $row['id'];

		$fields		= array('reports_id');
		$conditions	= array('reports_id = ' . intval($data['reports_id']));

		$ReportBuilderInputParameters =new ReportBuilderInputParameters($data);
		$ReportBuilderInputParameters->show($data, $fields, $conditions);

		$fields		= array('reports_id');
		$conditions	= array('reports_id = ' . intval($data['reports_id']));
		$data['reports_id'] = $row['id'];

		$ReportBuilderOutputParameters =new ReportBuilderOutputParameters($data);
		$ReportBuilderOutputParameters->show($data, $fields, $conditions);
	}
}

?>