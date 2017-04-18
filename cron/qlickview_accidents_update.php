<?
require_once '../include/collector.inc.php';
global $db;

$sql = 'SELECT history.accidents_id ' .
	   'FROM qlickview_accidents as history ' .
	   'JOIN ' . PREFIX . '_accidents_go as accidents_go ON history.accidents_id = accidents_go.accidents_id ' .
	   'WHERE accidents_go.owner_types_id = 1 ' .
	   'GROUP BY history.accidents_id';
$list = $db->getCol($sql);
$sql = 'DELETE FROM qlickview_accidents WHERE accidents_id IN (' . (sizeof($list) ? implode(', ', $list) : '0') . ')';
$db->query($sql);

$sql = 'SELECT MAX(modified) FROM qlickview_accidents';
$max_date = $db->getOne($sql);
if ($max_date == NULL) $max_date = '0000-00-00';

$sql = 'SELECT id FROM insurance_accidents WHERE modified > ' . $db->quote($max_date) . ' AND product_types_id IN (3, 4)';
$list_accidents = $db->getCol($sql);
//_dump($list_accidents);exit;
//if (!sizeof($list_accidents)) exit;;

$sql = 'CREATE TEMPORARY TABLE IF NOT EXISTS temp_accident_repair_info ' . 
	   'SELECT calendar.accidents_id, repair_info.* ' .
	   'FROM ' . PREFIX . '_accident_payments_calendar as calendar ' .
	   'JOIN ' . PREFIX . '_accident_repair_info as repair_info ON calendar.id = repair_info.payments_calendar_id ' .
	   'JOIN ( ' .
			'SELECT MAX(last_date_exchange) as last_date, payments_calendar_id ' .
			'FROM ' . PREFIX . '_accident_repair_info ' .
			'GROUP BY payments_calendar_id' .
	   ') as repair_info_last ON repair_info.payments_calendar_id = repair_info_last.payments_calendar_id ' .
	   'WHERE repair_info_last.last_date = repair_info.last_date_exchange AND repair_info.last_date_exchange > ' . $db->quote($max_date);
$db->query($sql);

$sql = 'SELECT a.id as accidents_id, accidents_go.owner_types_id, getArchiveStatusesId(a.id) as archive_statuses_id, getResolvedDate(a.id, 0) as resolved_date, a.number, a.date, a.datetime, a.insurance,a.accident_sections_id, a.product_types_id, a.accident_statuses_id, amount_rough, SUM(y.amount) as acts_amount,

a.compromise as compromise, a.compromise_violation as compromise_violation, a.compromise_date as compromise_date,

b.id as car_services_id, b.ukravto as car_services_ukravto, b.title as car_services_title, d.title as accicent_sections_title, a.repair_classifications_id, e.title as accident_statuses_title, w2.id as financial_institutions_id,  w2.title as financial_institutions_title, p2.title as car_services_title, car_services_amount,

z1.application_created as application_created, WEEKDAY(application_created)+1 as application_weekday, ROUND(application_duration/3600,2) as application_duration, application_responsible, classification_responsible as application_end_responsible,
classification_created, WEEKDAY(classification_created)+1 as classification_weekday, ROUND(classification_duration/3600,2) as classification_duration, investigation_responsible as classification_responsible,
investigation_created, WEEKDAY(investigation_created)+1 as investigation_weekday, ROUND(investigation_duration/3600,2) as investigation_duration, approval_responsible as investigation_responsible, messages_created, messages_solved,
approval_created, WEEKDAY(approval_created)+1 as approval_weekday, ROUND(approval_duration/3600,2) as approval_duration, payment_responsible as approval_responsible,
payment_created, WEEKDAY(payment_created)+1 as payment_weekday, ROUND(payment_duration/3600,2) as payment_duration, resolved_responsible as payment_responsible,
resolved_created, WEEKDAY(resolved_created)+1 as resolved_weekday, ROUND(resolved_duration/3600,2) as resolved_duration, resolved_responsible, closed_created, ROUND(closed_duration/3600,2) as closed_duration, reset_responsible,
reset_created, WEEKDAY(reset_created)+1 as reset_weekday, ROUND(reset_duration/3600,2) as reset_duration, reinvestigation_responsible,
reinvestigation_created, WEEKDAY(reinvestigation_created)+1 as reinvestigation_weekday, ROUND(reinvestigation_duration/3600,2) as reinvestigation_duration, defects_responsible,
defects_created, WEEKDAY(defects_created)+1 as defects_weekday, ROUND(defects_duration/3600,2) as defects_duration, defects_responsible,
suspended_created, WEEKDAY(suspended_created)+1 as suspended_weekday, ROUND(suspended_duration/3600,2) as suspended_duration, suspended_responsible,
accident_sections_change_created, WEEKDAY(accident_sections_change_created)+1 as accident_sections_change_created_weekday, ROUND(accident_section_change_duration/3600,2) as accident_section_change_duration, accident_sections_change_responsible,
p2.ukravto, p4.title as accident_expert_organizations, p3.expertises_amount, p5.other_amount,
z12.average_first_task_created, z13.average_last_task_closed,
z15.compromise_agreement_created as compromise_agreement_created, ROUND(compromise_agreement_duration/3600,2) as compromise_agreement_duration, compromise_agreement_responsible,
z16.compromise_continue_created as compromise_continue_created, ROUND(compromise_continue_duration/3600,2) as compromise_continue_duration, compromise_continue_responsible,

getLastResolvedDate(a.id) as last_resolved_date,

getAccidentsDeductible(a.id) as deductibles_amount,
getAmountAccidents(a.number, a.id, 1) as amount_compensation,
getAmountAccidents(a.number, a.id, 2) as amount_vz,
getAmountAccidents(a.number, a.id, 3) as amount_act,
getAmountAccidents(a.number, a.id, 4) as amount_addition,
getAmountAccidents(a.number, a.id, 5) as amount_experts,
getRecipientAccidents(a.number, a.id, 3) as recipient_act,
getRecipientAccidents(a.number, a.id, 4) as recipient_addition,
getRecipientAccidents(a.number, a.id, 5) as recipient_experts,
getPaymentDateAccidents(a.number, a.id, 3) as act_payments_date,
getPaymentDateAccidents(a.number, a.id, 4) as addition_payments_date, ' .

/*GROUP_CONCAT(date_format(repair_info.document_date, \'%d.%m.%Y\') SEPARATOR \'<br>\') as document_date_tis,
GROUP_CONCAT(REPLACE(repair_info.amount, \'.\', \',\') SEPARATOR \'<br>\') as amount_tis,
GROUP_CONCAT(IF(repair_info.order_parts_date = \'0000-00-00\', \'-\', date_format(repair_info.order_parts_date, \'%d.%m.%Y\')) SEPARATOR \'<br>\') as order_parts_date_tis,
GROUP_CONCAT(IF(repair_info.order_outfit_begin_date = \'0000-00-00\', \'-\', date_format(repair_info.order_outfit_begin_date, \'%d.%m.%Y\')) SEPARATOR \'<br>\') as order_outfit_begin_date_tis,
GROUP_CONCAT(REPLACE(repair_info.order_outfit_begin_amount, \'.\', \',\') SEPARATOR \'<br>\') as order_outfit_begin_amount_tis,
GROUP_CONCAT(repair_info.order_outfit_begin_author SEPARATOR \'<br>\') as order_outfit_begin_author_tis,
GROUP_CONCAT(IF(repair_info.order_outfit_end_date = \'0000-00-00\', \'-\', date_format(repair_info.order_outfit_end_date, \'%d.%m.%Y\')) SEPARATOR \'<br>\') as order_outfit_end_date_tis,
GROUP_CONCAT(REPLACE(repair_info.order_outfit_end_amount, \'.\', \',\') SEPARATOR \'<br>\') as order_outfit_end_amount_tis,
GROUP_CONCAT(repair_info.order_outfit_end_author SEPARATOR \'<br>\') as order_outfit_end_author_tis,
GROUP_CONCAT(REPLACE(repair_info.deductible_amount, \'.\', \',\') SEPARATOR \'<br>\') as deductible_amount_tis,
GROUP_CONCAT(IF(repair_info.last_date_exchange = \'0000-00-00\', \'-\', date_format(repair_info.last_date_exchange, \'%d.%m.%Y\')) SEPARATOR \'<br>\') as last_date_exchange_tis,*/

'IF(a.risks_id>0,a.risks_id,a.application_risks_id) as risk,

isAccidentsTotal(a.id),
REPLACE(REPLACE(REPLACE(getPaymentNotesAccidents(a.id), \'Previous\', \'Попередньо було перераховано\' COLLATE utf8_unicode_ci), \'grn\', \'грн\' COLLATE utf8_unicode_ci), \'Denial\', \'Було відмовлено\' COLLATE utf8_unicode_ci) as notes,

REPLACE(REPLACE(REPLACE(REPLACE(getRecipientSignAccidents(a.number, a.id, 3), \'1\', \'УкрАВТО\' COLLATE utf8_unicode_ci), \'0\', \'не УкрАВТО\' COLLATE utf8_unicode_ci), \'2\', \'Банк\' COLLATE utf8_unicode_ci), \'3\', \'Фізична особа\' COLLATE utf8_unicode_ci) as sign_recipient_act,
REPLACE(REPLACE(REPLACE(REPLACE(getRecipientSignAccidents(a.number, a.id, 4), \'1\', \'УкрАВТО\' COLLATE utf8_unicode_ci), \'0\', \'не УкрАВТО\' COLLATE utf8_unicode_ci), \'2\', \'Банк\' COLLATE utf8_unicode_ci), \'3\', \'Фізична особа\' COLLATE utf8_unicode_ci) as sign_recipient_addition,

a.comment_closed

FROM insurance_accidents AS a
LEFT JOIN insurance_accidents_go as accidents_go ON a.id = accidents_go.accidents_id
LEFT JOIN temp_accident_repair_info as repair_info ON a.id = repair_info.accidents_id
LEFT JOIN insurance_car_services AS b ON a.car_services_id=b.id
LEFT JOIN insurance_product_types AS c ON a.product_types_id=c.id
LEFT JOIN insurance_accident_sections AS d ON a.accident_sections_id = d.id
LEFT JOIN insurance_accident_statuses AS e ON a.accident_statuses_id = e.id

LEFT JOIN insurance_accidents_acts AS y ON a.id = y.accidents_id

LEFT JOIN insurance_policies_kasko AS w1 ON a.policies_id = w1.policies_id
LEFT JOIN insurance_financial_institutions AS w2 ON w1.financial_institutions_id = w2.id

LEFT JOIN (SELECT SUM(amount) as car_services_amount, accidents_id, recipients_id FROM insurance_accident_payments_calendar WHERE recipient_types_id = 5 GROUP BY accidents_id) AS p1 ON a.id = p1.accidents_id

LEFT JOIN insurance_car_services AS p2 ON p2.id = p1.recipients_id

LEFT JOIN (SELECT SUM(amount) as  expertises_amount, accidents_id, recipients_id FROM insurance_accident_payments_calendar WHERE recipient_types_id = 3 GROUP BY accidents_id) AS p3 ON a.id = p3.accidents_id

LEFT JOIN insurance_expert_organizations AS p4 ON p4.id = p3.recipients_id

LEFT JOIN (SELECT SUM(amount) as  other_amount, accidents_id, recipients_id FROM insurance_accident_payments_calendar WHERE payment_types_id NOT IN (1,5,6) GROUP BY accidents_id) AS p5 ON a.id = p5.accidents_id

LEFT JOIN (SELECT MIN(created) as messages_created, accidents_id, authors_id FROM insurance_accident_messages WHERE message_types_id<>1 GROUP BY accidents_id) AS x1 ON a.id = x1.accidents_id AND a.average_managers_id = x1.authors_id

LEFT JOIN (SELECT MAX(created) as messages_solved, accidents_id, authors_id FROM insurance_accident_messages WHERE message_types_id<>1 AND statuses_id = 2 GROUP BY accidents_id) AS x2 ON a.id = x2.accidents_id AND a.average_managers_id = x2.authors_id

LEFT JOIN (SELECT MIN( created ) AS application_created, SUM( duration ) AS application_duration, accounts_title as application_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =1 GROUP BY accidents_id) AS z1 ON a.id = z1.accidents_id
LEFT JOIN (SELECT MIN( created ) AS classification_created, SUM( duration ) AS classification_duration, accounts_title as classification_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =2 GROUP BY accidents_id) AS z2 ON a.id = z2.accidents_id
LEFT JOIN (SELECT MIN( created ) AS investigation_created, SUM( duration ) AS investigation_duration, accounts_title as investigation_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =3 GROUP BY accidents_id) AS z3 ON a.id = z3.accidents_id
LEFT JOIN (SELECT MIN( created ) AS approval_created, SUM( duration ) AS approval_duration, accounts_title as approval_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =4 GROUP BY accidents_id) AS z4 ON a.id = z4.accidents_id
LEFT JOIN (SELECT MIN( created ) AS payment_created, SUM( duration ) AS payment_duration, accounts_title as payment_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =5 GROUP BY accidents_id) AS z5 ON a.id = z5.accidents_id
LEFT JOIN (SELECT MIN( created ) AS resolved_created, SUM( duration ) AS resolved_duration, accounts_title as resolved_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =6 GROUP BY accidents_id) AS z6 ON a.id = z6.accidents_id
LEFT JOIN (SELECT MIN( created ) AS reset_created, SUM( duration ) AS reset_duration, accounts_title as reset_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =7 GROUP BY accidents_id) AS z7 ON a.id = z7.accidents_id
LEFT JOIN (SELECT MIN( created ) AS reinvestigation_created, SUM( duration ) AS reinvestigation_duration, accounts_title as reinvestigation_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =8 GROUP BY accidents_id) AS z8 ON a.id = z8.accidents_id
LEFT JOIN (SELECT MIN( created ) AS defects_created, SUM( duration ) AS defects_duration, accounts_title as defects_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =9 GROUP BY accidents_id) AS z9 ON a.id = z9.accidents_id
LEFT JOIN (SELECT MIN( created ) AS suspended_created, SUM( duration ) AS suspended_duration, accounts_title as suspended_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =10 GROUP BY accidents_id) AS z10 ON a.id = z10.accidents_id
LEFT JOIN (SELECT MIN( created ) AS closed_created, SUM( duration ) AS closed_duration, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id = 11 GROUP BY accidents_id) AS z14 ON a.id = z14.accidents_id

LEFT JOIN (SELECT MIN( created ) AS compromise_agreement_created, SUM( duration ) AS compromise_agreement_duration, accounts_title as compromise_agreement_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =13 GROUP BY accidents_id) AS z15 ON a.id = z15.accidents_id
		LEFT JOIN (SELECT MIN( created ) AS compromise_continue_created, SUM( duration ) AS compromise_continue_duration, accounts_title as compromise_continue_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =14 GROUP BY accidents_id) AS z16 ON a.id = z16.accidents_id

LEFT JOIN (SELECT MIN( created ) AS accident_sections_change_created, SUM( duration ) AS accident_section_change_duration, accounts_title as accident_sections_change_responsible, accidents_id FROM insurance_accident_status_changes WHERE accident_statuses_id =-1 GROUP BY accidents_id) AS z11 ON a.id = z11.accidents_id

LEFT JOIN (SELECT MIN(a.created) as average_first_task_created, a.accidents_id FROM insurance_accident_messages as a JOIN insurance_accidents as b ON a.authors_id = b.average_managers_id GROUP BY a.accidents_id) as z12 ON a.id = z12.accidents_id

LEFT JOIN (SELECT MAX(a.decision) as average_last_task_closed, a.accidents_id FROM insurance_accident_messages as a JOIN insurance_accidents as b ON a.authors_id = b.average_managers_id WHERE a.statuses_id = 2 GROUP BY a.accidents_id) as z13 ON a.id = z13.accidents_id

WHERE a.modified > ' . $db->quote($max_date) . ' AND a.product_types_id IN (3,4) ' .

'GROUP BY a.id
ORDER BY datetime ASC';
//WHERE TO_DAYS(NOW()) - TO_DAYS(a.modified) <= 1
$new = $db->getAll($sql);
//_dump($new);exit;
$sql = 'SHOW COLUMNS FROM qlickview_accidents';
	$columns = $db->getAll($sql);
	$columns_names = array();

	foreach($columns as $column){
		$columns_names[] = $column['Field'];
	}

unset($columns_names[array_search('created', $columns_names)]);//убираем поле created
unset($columns_names[array_search('modified', $columns_names)]);//убираем поле modified для ручной вставки в запрос

$diff = array();
$log = array();
foreach($new as $new_item){
	if ($new_item['product_types_id'] == PRODUCT_TYPES_GO && $new_item['owner_types_id'] == 1) continue;
    $sql = 'SELECT * FROM qlickview_accidents WHERE accidents_id = ' . $new_item['accidents_id'] . ' ORDER BY created desc LIMIT 1';
    $old = $db->getRow($sql);
    //если запись новая, то сразу добавляем её в запрос
    if(!$old){
        $diff[] = $new_item;
    }
    else{//проверка на совпадение значений полей, если не совпадают, то пишем в таблицу
        unset($old['created']);
        unset($old['modified']);
        foreach($columns_names as $name){
            if($new_item[$name] != $old[$name]) {
                $diff[] = $new_item;
                $log[]['accidents_id']  = $new_item['accidents_id'];
                $log[]['name']          = $name;
                break;
            }
        }
    }
}
if(sizeof($diff)){
$sql = 'INSERT INTO qlickview_accidents (created, modified, ' . implode(', ',$columns_names) . ')' .
			'VALUES ';

	foreach($diff as $item){
		$sql .= '(NOW(), NOW(), ';
		foreach($columns_names as $name){
			$sql .= $db->quote($item[$name]) . ',';
		}
		$sql = rtrim($sql, ',');
		$sql .='),';
	}
	$sql = rtrim($sql, ',');

    $db->query($sql);
}

?>