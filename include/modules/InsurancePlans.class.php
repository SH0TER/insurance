<?
/*
 * Title: InsurancePlans.class.php 
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class InsurancePlans extends Form {

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
                        'table'				=> 'policy_plans'),
                    array(
                        'name'              => 'insurance_companies_id',
                        'description'       => 'Страхова компанiя',
                        'type'              => fldRadio,
                        'withoutTable'		=> true,
                        'list'              => array(
                                                INSURANCE_COMPANIES_EXPRESS => 'ТДВ "Eкспрес Страхування"',
                                                INSURANCE_COMPANIES_GENERALI => 'ВАТ «УСК «Гарант-Авто»'
                                                ),
                        'display'           =>
                            array(
                                'show'      => true,
                                'insert'    => true,
                                'view'      => true,
                                'update'    => true
                            ),
                         'orderPosition'         => 3,
                        'verification'      =>
                            array(
                                'canBeEmpty'    => false
                            ),
                        'table'             => 'policy_plans'),

                    array(
                        'name'				=> 'date',
                        'description'		=> 'Перiод',
                        'type'				=> fldDate,
                        'input'				=> true,
                        'display'			=>
                            array(
                                'show'		=> true,
                                'insert'	=> true,
                                'view'		=> true,
                                'update'	=> false
                            ),
                        'verification'		=>
                            array(
                                'canBeEmpty'	=> false
                            ),
                        'orderPosition'		=> 1,
                        'table'				=> 'policy_plans'),

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
                        'orderPosition'		=> 14,
                        'width'             => 100,
                        'table'				=> 'policy_plans')
                ),
            'common'	=>
                array(
                    'defaultOrderPosition'	=> 1,
                    'defaultOrderDirection'	=> 'desc',
                    'titleField'			=> 'date'
                )
            );

    function InsurancePlans($data) {
        Form::Form($data);

        $this->messages['plural'] = 'Плани продажу полiсiв';
        $this->messages['single'] = 'План продажу полiсiв';
    }

    function setPermissions($data) {
        global $Authorization;

        switch ($Authorization->data['roles_id']) {
            case ROLES_ADMINISTRATOR:
                $this->permissions = array(
                    'show'		=> true,
                    'insert'	=> true,
                    'update'	=> true,
                    'view'		=> true,
					'akts'		=> true,
                    'generate'	=> true,
                    'export'	=> true,
                    'delete'	=> true);
                break;
			case ROLES_MANAGER:
				$this->permissions = $Authorization->data['permissions'][ get_class($this) ];
				break;
        }
    }


	function generateInWindow($data) {
		$this->generate($data);
	}


	function generate($data) {
		global $db, $Log;

		if (is_array($data['id'])) $data['id']=intval($data['id'][0]);

		if ($data['lastplan']) {

             $sql = 'SELECT CONCAT(lastname, \' \', firstname) AS fio, a.agreement_number, GROUP_CONCAT(c.title SEPARATOR \';\') AS agency ' .
					'FROM ' . PREFIX . '_agents AS a ' .
					'JOIN ' . PREFIX . '_accounts AS b ON a.accounts_id = b.id ' .
					'JOIN ' . PREFIX . '_agencies AS c ON a.agencies_id = c.id ' .
					'WHERE LENGTH(a.agreement_number)>1 ' .
					'GROUP BY CONCAT(lastname, \' \', firstname), a.agreement_number ' .
					'ORDER BY CONCAT(lastname, \' \', firstname)';
			 $list = $db->getAll($sql);

             foreach($list as $i=>$row) {

                $sql =	'SELECT * ' .
						'FROM ' . PREFIX . '_policy_plans_agents ' .
						'WHERE '.($data['id'] ? ' plans_id = '.$data['id'].' AND ' :  '').' agreement_number = ' . $db->quote($row['agreement_number']) . ' ' .
						'ORDER BY plans_id DESC ' .
						'LIMIT 1';
                $r = $db->getRow($sql);

                 if ($r) {
                     $list[$i]['credit_cars'] = $r['credit_cars'];
                     $list[$i]['not_credit_cars'] = $r['not_credit_cars'];
                     $list[$i]['continued_cars'] = $r['continued_cars'];
                     $list[$i]['go_cars'] = $r['go_cars'];
					 
					 $list[$i]['credit_cars_money'] = $r['credit_cars_money'];
                     $list[$i]['not_credit_cars_money'] = $r['not_credit_cars_money'];
                     $list[$i]['continued_cars_money'] = $r['continued_cars_money'];
                     $list[$i]['go_cars_money'] = $r['go_cars_money'];
                 }
             }

             header('Content-Disposition: attachment; filename="plan.xls"');
			 header('Content-Type: ' . Form::getContentType('plan.xls'));
			 include_once $this->object . '/agentsPlansExcel.php';
			 exit;
		}

        if (is_uploaded_file($_FILES['file']['tmp_name']) &&
            $_FILES['file']['size'] &&
            ereg('\.xls$', $_FILES['file']['name'])) {

            $db->query('DELETE FROM ' . PREFIX . '_policy_plans_agents WHERE plans_id=' . intval($data['id']) . ' ');

            require_once 'Excel/reader.php';

            $Excel = new Spreadsheet_Excel_Reader();
            $Excel->setOutputEncoding('utf-8');
            $Excel->read($_FILES['file']['tmp_name']);

            for ($i=2; $i <= sizeOf($Excel->sheets[0]['cells']); $i++) {


              $sql='REPLACE  ' . PREFIX . '_policy_plans_agents
                    SET plans_id='.intval($data['id']).',
                        agreement_number='.$db->quote($Excel->sheets[0]['cells'][ $i ][1]).',
                        credit_cars='.intval($Excel->sheets[0]['cells'][ $i ][4]).',
                        not_credit_cars='.intval($Excel->sheets[0]['cells'][ $i ][5]).',
                        continued_cars='.intval($Excel->sheets[0]['cells'][ $i ][6]).',
                        go_cars='.intval($Excel->sheets[0]['cells'][ $i ][7]).', 
						credit_cars_money='.doubleval($Excel->sheets[0]['cells'][ $i ][8]).',
                        not_credit_cars_money='.doubleval($Excel->sheets[0]['cells'][ $i ][9]).',
                        continued_cars_money='.doubleval($Excel->sheets[0]['cells'][ $i ][10]).',
                        go_cars_money='.doubleval($Excel->sheets[0]['cells'][ $i ][11]).' ';
                $db->query($sql);
            }
            $Log->add('confirm', 'Реестр було iмпортовано', array());
        } else {
                $Log->add('error', 'The file\'s <b>%s</b>%s format is not valid.', array('Файл', $languageDescription));
        }


		include_once $this->object . '/agentsPlans.php';
	}
	
	
	function exportInWindow($data) {
		$this->export($data);
	}


	function export($data) {
		global $db, $Log;

		if (is_array($data['id'])) $data['id']=intval($data['id'][0]);

		if ($data['lastplan']) {
			$data['id'] = $db->getOne('SELECT max(plans_id) FROM insurance_policy_plans_agencies');
			$sql =  'SELECT a.id,CONCAT(a.code,\' \',a.title) as agencyTitle, b.* ' .
					'FROM ' . PREFIX . '_agencies as a ' .
					'LEFT JOIN ' . PREFIX . '_policy_plans_agencies as b ON b.plans_id = '.intval($data['id']).' AND b.agencies_id =a.id ' .
					'WHERE ukravto=1 and (a.level<2 OR a.code like \'26.%\') and (a.code not like \'417%\' and a.code not like \'421%\' and  a.code not like \'422%\' and a.code not like \'423%\' and a.code not like \'557%\'  and a.code not like \'561%\'  and a.code not like \'563%\'  and a.code not like \'847%\'  and a.code not like \'939%\'  and a.code not like \'846%\'   and a.code not in(\'94\',\'95\',\'96\' ,\'97\',\'98\',\'65\',\'112\',\'1253\',\'1254\',\'1252\',\'112\',\'101\',\'102\',\'104\',\'1345\',\'1347\',\'1366\',\'1367\',\'1368\',\'223\',\'224\',\'226\',\'231\',\'232\',\'233\',\'234\',\'235\',\'236\',\'237\',\'239\',\'241\',\'242\',\'244\',\'245\',\'230\',\'50\',\'555\',\'556\',\'558\',\'559\',\'560\',\'562\',\'58\',\'60\',\'792\',\'832\',\'845\',\'418\',\'229\',\'91\') )  ORDER BY a.code,a.title';
			$list = $db->getAll($sql);
              
             header('Content-Disposition: attachment; filename="plan.xls"');
			 header('Content-Type: ' . Form::getContentType('plan.xls'));
			 include_once $this->object . '/agenciesPlansExcel.php';
			 exit;
		}

        if (is_uploaded_file($_FILES['file']['tmp_name']) &&
            $_FILES['file']['size'] &&
            ereg('\.xls$', $_FILES['file']['name'])) {
            $db->query('DELETE FROM ' . PREFIX . '_policy_plans_agencies WHERE plans_id=' . intval($data['id']) . ' ');

            require_once 'Excel/reader.php';

            $Excel = new Spreadsheet_Excel_Reader();
            $Excel->setOutputEncoding('utf-8');
            $Excel->read($_FILES['file']['tmp_name']);

            for ($i=2; $i <= sizeOf($Excel->sheets[0]['cells']); $i++) {

			  $agencies_id = $db->getOne('select id  FROM insurance_agencies where id = '.intval($Excel->sheets[0]['cells'][ $i ][1]));
			  if ($agencies_id) {
				$sql='REPLACE  ' . PREFIX . '_policy_plans_agencies
                    SET plans_id='.intval($data['id']).',
						agencies_id='.intval($agencies_id).',
                        credit_cars='.$db->quote($Excel->sheets[0]['cells'][ $i ][3]).',
						continued_cars='.$db->quote($Excel->sheets[0]['cells'][ $i ][4]).',
						not_credit_cars='.$db->quote($Excel->sheets[0]['cells'][ $i ][5]).',
						go_cars='.$db->quote($Excel->sheets[0]['cells'][ $i ][6]).',
						dgo_cars='.$db->quote($Excel->sheets[0]['cells'][ $i ][7]).',
						
						credit_cars_money='.$db->quote($Excel->sheets[0]['cells'][ $i ][8]).',
						continued_cars_money='.$db->quote($Excel->sheets[0]['cells'][ $i ][9]).',
						not_credit_cars_money='.$db->quote($Excel->sheets[0]['cells'][ $i ][10]).',
						go_cars_money='.$db->quote($Excel->sheets[0]['cells'][ $i ][11]).',
						dgo_cars_money='.$db->quote($Excel->sheets[0]['cells'][ $i ][12]).',
						
						brand_count='.intval($Excel->sheets[0]['cells'][ $i ][13]).',
						zaz='.$db->quote($Excel->sheets[0]['cells'][ $i ][14]).',
						chevrolet='.$db->quote($Excel->sheets[0]['cells'][ $i ][15]).',
						kia='.$db->quote($Excel->sheets[0]['cells'][ $i ][16]).',
						chery='.$db->quote($Excel->sheets[0]['cells'][ $i ][17]).',
						lada='.$db->quote($Excel->sheets[0]['cells'][ $i ][18]).',
						mercedes='.$db->quote($Excel->sheets[0]['cells'][ $i ][19]).',
						jeep='.$db->quote($Excel->sheets[0]['cells'][ $i ][20]).',
						chrasler='.$db->quote($Excel->sheets[0]['cells'][ $i ][21]).',
						opel='.$db->quote($Excel->sheets[0]['cells'][ $i ][22]).',
						nissan='.$db->quote($Excel->sheets[0]['cells'][ $i ][23]).',
						renault='.$db->quote($Excel->sheets[0]['cells'][ $i ][24]).',
						itog='.$db->quote($Excel->sheets[0]['cells'][ $i ][25]).',
						toyota='.$db->quote($Excel->sheets[0]['cells'][ $i ][26]).' ';

					$db->query($sql);
_dump($sql);
				}
            }
exit;
            $Log->add('confirm', 'Реестр було iмпортовано', array());
        } else {
                $Log->add('error', 'The file\'s <b>%s</b>%s format is not valid.', array('Файл', $languageDescription));
        }


		include_once $this->object . '/agenciesPlans.php';
	}
	

	function setAdditionalFields($id, $data) {
		global $db;

        if (is_array($data['plans'])) {
            $db->query('DELETE FROM ' . PREFIX . '_policy_plans_agencies WHERE plans_id=' . intval($id) . ' ');
            foreach ($data['plans'] as $agencyId => $row) {
                $sql =  'REPLACE INTO ' . PREFIX . '_policy_plans_agencies SET ' .
                        'agencies_id = ' . intval($agencyId) . ', ' .
                        'plans_id = ' . intval($id) . ', ' .
                        'credit_cars = ' . intval($row['credit_cars']) . ', ' .
                        'not_credit_cars = ' . intval($row['not_credit_cars']) . ', ' .
                        'continued_cars = ' . intval($row['continued_cars']) . ', ' .
						'go_cars = ' . intval($row['go_cars']).','.
						'dgo_cars = ' . intval($row['dgo_cars']).','.
						
						'credit_cars_money = ' . doubleval($row['credit_cars_money']) . ', ' .
                        'not_credit_cars_money = ' . doubleval($row['not_credit_cars_money']) . ', ' .
                        'continued_cars_money = ' . doubleval($row['continued_cars_money']) . ', ' .
						'go_cars_money = ' . doubleval($row['go_cars_money']) . ', ' .
						'dgo_cars_money = ' . doubleval($row['dgo_cars_money']) . ', ' .

						
						'brand_count = ' . intval($row['brand_count']) . ', ' .
						
                        'zaz = ' . doubleval($row['zaz']) . ', ' .
                        'chevrolet = ' . doubleval($row['chevrolet']) . ', ' .
                        'kia = ' . doubleval($row['kia']) . ', ' .
                        'chery = ' . doubleval($row['chery']) . ', ' .
                        'lada = ' . doubleval($row['lada']) . ', ' .
                        'mercedes = ' . doubleval($row['mercedes']) . ', ' .
						'jeep = ' . doubleval($row['jeep']) . ', ' .
						'chrasler = ' . doubleval($row['chrasler']) . ', ' .
                        'opel = ' . doubleval($row['opel']) . ', ' .
                        'nissan = ' . doubleval($row['nissan']) . ', ' .
						'renault = ' . doubleval($row['renault']) . ', ' .
						'toyota = ' . doubleval($row['toyota']) . ', ' .
						'itog = ' . doubleval($row['itog']) . '  ' ;

                        
                $db->query($sql);
            }
        }
	}

	function showForm($data, $action, $actionType=null, $template=null) {
        global $db, $Authorization;

		if (is_array($data['id'])) {
            $data['id'] = $data['id'][0];
        }

        $sql =  'SELECT a.id,CONCAT(a.code,\' \',a.title) as agencyTitle, b.* ' .
                'FROM ' . PREFIX . '_agencies as a ' .
                'LEFT JOIN ' . PREFIX . '_policy_plans_agencies as b ON b.plans_id = '.intval($data['id']).' AND b.agencies_id =a.id ' .
                'WHERE (ukravto=1 OR a.code like \'1469%\') and (a.level<2 OR a.code like \'26.%\') and (a.code not like \'417%\' and a.code not like \'421%\' and  a.code not like \'422%\' and a.code not like \'423%\' and a.code not like \'557%\'  and a.code not like \'561%\'  and a.code not like \'563%\'  and a.code not like \'847%\'  and a.code not like \'939%\'  and a.code not like \'846%\'   and a.code not in(\'94\',\'95\',\'96\' ,\'97\',\'98\',\'65\',\'112\',\'1253\',\'1254\',\'1252\',\'112\',\'101\',\'102\',\'104\',\'1345\',\'1347\',\'1366\',\'1367\',\'1368\',\'223\',\'224\',\'226\',\'231\',\'232\',\'233\',\'234\',\'235\',\'236\',\'237\',\'239\',\'241\',\'242\',\'244\',\'245\',\'230\',\'50\',\'555\',\'556\',\'558\',\'559\',\'560\',\'562\',\'58\',\'60\',\'792\',\'832\',\'845\',\'418\',\'229\',\'91\') )  ORDER BY a.code,a.title';
        $res = $db->query($sql);

        $result = '';

        switch ($action) {
            default:

                if ($res->numRows()) {

                    $i = 1;
                    $result .=
                            '<tr><td><b>Агенцiя</b></td><td><b>Кредит/КАСКО Банк</b></td><td><b>Пролонгацiя Рітейл</b></td><td><b>Рітейл 1й рік</b></td><td><b>ОСАГО</b></td> <td><b>ДСЦВ</b></td><td>Кiльк брендiв</td> <td><b>ЗАЗ %</b></td> <td><b>Chevrolet %</b></td>  <td><b>KIA % </b></td>  <td><b>Chery %</b></td>  <td><b>LADA %</b></td>  <td><b>Mercedes  %</b></td> <td><b>JEEP  %</b></td> <td><b>CHRYSLER %</b></td>  <td><b>OPEL %</b></td>  <td><b>Nissan  %</b></td> <td><b>Renault  %</b></td> <td><b>Toyota %</b></td><td><b>Iтого %</b></td></tr>';
                    while ($res->fetchInto($row)) {


                        $commissionAgency = $data['commissions'][ $row['products_id'] ]['agency_percent'] + $data['commissions'][ $row['products_id'] ]['agency_amount'] + $data['commissions'][ $row['products_id'] ]['agent_percent'] + $data['commissions'][ $row['products_id'] ]['agent_amount'];

                        $result .=
                            '<tr>' .
                                '<td >' . $row['agencyTitle'] . ' :</td>' .
                                    '<td nowrap>
									<input type="text" name="plans[' . $row['id'] . '][credit_cars]" value="' . ($data['plans'][ $row['id'] ]['credit_cars'] ?  $data['plans'][ $row['id'] ]['credit_cars'] : $row['credit_cars']). '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> шт
									<input type="text" name="plans[' . $row['id'] . '][credit_cars_money]" value="' . ($data['plans'][ $row['id'] ]['credit_cars_money'] ?  $data['plans'][ $row['id'] ]['credit_cars_money'] : $row['credit_cars_money']). '" maxlength="15" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> грн
									</td>' .
                                    '<td nowrap>
									<input type="text" name="plans[' . $row['id'] . '][continued_cars]" value="' . ($data['plans'][ $row['id'] ]['continued_cars'] ?  $data['plans'][ $row['id'] ]['continued_cars'] : $row['continued_cars']). '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> шт
									<input type="text" name="plans[' . $row['id'] . '][continued_cars_money]" value="' . ($data['plans'][ $row['id'] ]['continued_cars_money'] ?  $data['plans'][ $row['id'] ]['continued_cars_money'] : $row['continued_cars_money']). '" maxlength="15" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" />  грн									
									</td>' .
                                    '<td nowrap>
									<input type="text" name="plans[' . $row['id'] . '][not_credit_cars]" value="' . ($data['plans'][ $row['id'] ]['not_credit_cars'] ?  $data['plans'][ $row['id'] ]['not_credit_cars'] : $row['not_credit_cars']). '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> шт
									<input type="text" name="plans[' . $row['id'] . '][not_credit_cars_money]" value="' . ($data['plans'][ $row['id'] ]['not_credit_cars_money'] ?  $data['plans'][ $row['id'] ]['not_credit_cars_money'] : $row['not_credit_cars_money']). '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> грн
									</td>' .
                                    '<td nowrap>
									<input type="text" name="plans[' . $row['id'] . '][go_cars]" value="' . ($data['plans'][ $row['id'] ]['go_cars'] ?  $data['plans'][ $row['id'] ]['go_cars'] : $row['go_cars']). '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> шт
									<input type="text" name="plans[' . $row['id'] . '][go_cars_money]" value="' . ($data['plans'][ $row['id'] ]['go_cars_money'] ?  $data['plans'][ $row['id'] ]['go_cars_money'] : $row['go_cars_money']). '" maxlength="15" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> грн
									</td>' .
									'<td nowrap>
									<input type="text" name="plans[' . $row['id'] . '][dgo_cars]" value="' . ($data['plans'][ $row['id'] ]['dgo_cars'] ?  $data['plans'][ $row['id'] ]['dgo_cars'] : $row['dgo_cars']). '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> шт
									<input type="text" name="plans[' . $row['id'] . '][dgo_cars_money]" value="' . ($data['plans'][ $row['id'] ]['dgo_cars_money'] ?  $data['plans'][ $row['id'] ]['dgo_cars_money'] : $row['dgo_cars_money']). '" maxlength="15" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> грн
									</td>' .
									'<td><input type="text" name="plans[' . $row['id'] . '][brand_count]" value="' . ($data['plans'][ $row['id'] ]['brand_count'] ?  $data['plans'][ $row['id'] ]['brand_count'] : $row['brand_count']). '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> </td>' .
									
									'<td><input type="text" name="plans[' . $row['id'] . '][zaz]" value="' . ($data['plans'][ $row['id'] ]['zaz'] ?  $data['plans'][ $row['id'] ]['zaz'] : $row['zaz']). '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> </td>' .
									'<td><input type="text" name="plans[' . $row['id'] . '][chevrolet]" value="' . ($data['plans'][ $row['id'] ]['chevrolet'] ?  $data['plans'][ $row['id'] ]['chevrolet'] : $row['chevrolet']). '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> </td>' .
									'<td><input type="text" name="plans[' . $row['id'] . '][kia]" value="' . ($data['plans'][ $row['id'] ]['kia'] ?  $data['plans'][ $row['id'] ]['kia'] : $row['kia']). '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> </td>' .
									'<td><input type="text" name="plans[' . $row['id'] . '][chery]" value="' . ($data['plans'][ $row['id'] ]['chery'] ?  $data['plans'][ $row['id'] ]['chery'] : $row['chery']). '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> </td>' .
									'<td><input type="text" name="plans[' . $row['id'] . '][lada]" value="' . ($data['plans'][ $row['id'] ]['lada'] ?  $data['plans'][ $row['id'] ]['lada'] : $row['lada']). '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> </td>' .
									'<td><input type="text" name="plans[' . $row['id'] . '][mercedes]" value="' . ($data['plans'][ $row['id'] ]['mercedes'] ?  $data['plans'][ $row['id'] ]['mercedes'] : $row['mercedes']). '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> </td>' .
									'<td><input type="text" name="plans[' . $row['id'] . '][jeep]" value="' . ($data['plans'][ $row['id'] ]['jeep'] ?  $data['plans'][ $row['id'] ]['jeep'] : $row['jeep']). '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> </td>' .
									'<td><input type="text" name="plans[' . $row['id'] . '][chrasler]" value="' . ($data['plans'][ $row['id'] ]['chrasler'] ?  $data['plans'][ $row['id'] ]['chrasler'] : $row['chrasler']). '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> </td>' .
									'<td><input type="text" name="plans[' . $row['id'] . '][opel]" value="' . ($data['plans'][ $row['id'] ]['opel'] ?  $data['plans'][ $row['id'] ]['opel'] : $row['opel']). '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> </td>' .
									'<td><input type="text" name="plans[' . $row['id'] . '][nissan]" value="' . ($data['plans'][ $row['id'] ]['nissan'] ?  $data['plans'][ $row['id'] ]['nissan'] : $row['nissan']). '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> </td>' .
									'<td><input type="text" name="plans[' . $row['id'] . '][renault]" value="' . ($data['plans'][ $row['id'] ]['renault'] ?  $data['plans'][ $row['id'] ]['renault'] : $row['renault']). '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> </td>' .
									'<td><input type="text" name="plans[' . $row['id'] . '][toyota]" value="' . ($data['plans'][ $row['id'] ]['toyota'] ?  $data['plans'][ $row['id'] ]['toyota'] : $row['toyota']). '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> </td>' .
									'<td><input type="text" name="plans[' . $row['id'] . '][itog]" value="' . ($data['plans'][ $row['id'] ]['itog'] ?  $data['plans'][ $row['id'] ]['itog'] : $row['itog']). '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> </td>' .
                            '</tr>';

                        $i++;
                    }
                }
                $data['direktorPlans'] = $result;
						}
			//_dump($data['direktorPlans']);
		$template = 'form.php';

        parent::showForm($data, $action, $actionType, $template);
    }

   function getDateSelect($field, $year, $month, $day, $name, $addition=null) {

		if (empty($month) || empty($day)) {
			$year	= date('Y');
			$month	= date('m');
			$day	= date('d');
		}

		if (!intval($field['year'])) {
			$fromYear = DATE_SELECT_FROM_YEAR;
		}

		$result = '<table border="0"><tr>';
		if ($field['name']!='date') {
			$result .= '<td><select id="' . $name . 'Day" name="' . $name . '_day" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" ' . $addition . '>';
			$result .= '<option value="00">...</option>';
			for($i=1; $i<32; $i++) {
				$result .= (intval($day) == $i) ? '<option value="' . sprintf('%02d', $i) . '" selected>' . $i : '<option value="' . sprintf('%02d', $i) . '">' . $i . '</option>';
			}
			$result .= '</select></td>';
		}
		else $result .= '<input type="hidden" name="' . $name . '_day" value="01">';
		$result .= '<td><select id="' . $name . '_month" name="' . $name . '_month" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" ' . $addition . '>';
		$result .= '<option value="00">...</option>';
		for($i=1; $i<13; $i++) {
			$result .= (intval($month) == $i) ? '<option value="' . sprintf('%02d', $i) . '" selected>' . $this->getMonth($i) . '</option>' : '<option value="' . sprintf('%02d', $i) . '">' . $this->getMonth($i) . '</option>';
		}
		$result .= '</select></td>';

		$result .= '<td>';

		if ($field['input']) {
			$result .= '<input type="text" id="' . $name . '_year" name="' . $name . '_year" value="' . ((intval($year)) ? $year : '') . '" maxlength="4" class="fldYear" onfocus="this.className=\'fldYearOver\'" onblur="this.className=\'fldYear\'" ' . str_replace('disabled', 'readonly', $addition) . ' />';
		} else {
			$result .= '<select id="' . $name . '_year" name="' . $name . '_year" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" ' . $addition . '>';
			$result .= '<option value="0000">...</option>';
			for ($i = date('Y') + 2; $i >= $fromYear; $i--) {
				$result .= ($year == $i) ? '<option value="' . $i . '" selected>' . $i . '</option>' : '<option value="' . $i . '">' . $i . '</option>';
			}
			$result .= '</select>';
		}

		$result .= '</td>';

		$result .= '</tr></table>';

		return $result;
	}

	function insert($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
		global $Log;
		$id = parent::insert($data, false, true, false);

		if ($id) {
			$this->setAdditionalFields($id, $data);
		}

		if ($redirect) {
			if (!$Log->isPresent() && $id)
			{
				$Log->add('confirm', $this->messages['insert']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);
				header('Location: ' . $data['redirect']);
			}	
			exit;
		} else {
			return $id;
		}
	}

	function update($data, $redirect=true, $showForm=true, $checkFieldsAndReturn=false) {
        global $Log, $Authorization,$db;

		if ($data['id']=parent::update(&$data, false, $showForm)) {
			$this->setAdditionalFields($data['id'], $data);

            if ($redirect) {

				$params['title']	= $this->messages['single'];
				$params['id']		= $data['id'];
				$params['storage']	= $this->tables[0];

				$Log->add('confirm', $this->messages['update']['confirm'], $params, $data[$this->formDescription['common']['titleField']], true);

                header('Location: ' . $data['redirect']);
                exit;
            } else {
                return $data['id'];
            }
		}
    }
	
	function show($data, $fields=null, $conditions=null, $sql=null, $template='show.php', $limit=true) {
		parent::show($data, $fields, $conditions, $sql, 'InsurancePlans/show.php', $limit);
	}
}

?>
