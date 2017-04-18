<?

require_once 'include/collector.inc.php';

$sql = 'SELECT a.number,date_format(a.begin_datetime,\'%d.%m.%Y\'),k1.title as ag,k.brand, a.item , k.year, cities.title, k.shassi,products_title, fi.title as fi_title, k.deductibles_value0, k.deductibles_value1, if(b.options_deterioration_no=1,\'без зносу\', \'зі зносом\'),
a.price,a.amount AS amount ,



insurer_lastname,insurer_firstname,insurer_patronymicname,insurer_phone, date_format(insurer_dateofbirth,\'%d.%m.%Y\'),
reg1.title,insurer_area,insurer_city,st1.title as st1_t,insurer_street,insurer_house,insurer_flat,
owner_lastname,owner_firstname,owner_patronymicname,owner_phone,date_format(owner_dateofbirth,\'%d.%m.%Y\'),
reg2.title,owner_area,owner_city,st2.title as st2_t,owner_street,owner_house,owner_flat,

concat(acc.lastname,\' \',acc.firstname) as man, sum(accidents.amount_rough) as amount_rough, sum(getCompensation(accidents.id, 3)) as compensation, if(accidents3.id > 0, \'відмова\', \'\') as insurance3, if(iyp.policies_id>0, CONCAT(date_format(calendar.date, \'%d.%m.%Y\'), \' - \', date_format(subdate(adddate(calendar.date, INTERVAL 1 YEAR), INTERVAL 1 DAY), \'%d.%m.%Y\')), CONCAT(date_format(a.begin_datetime, \'%d.%m.%Y\'), \' - \', date_format(a.end_datetime, \'%d.%m.%Y\')))

FROM insurance_policies AS a 
join insurance_policy_payments_calendar as calendar on a.id = calendar.policies_id 
JOIN insurance_policies_kasko AS b ON a.id = b.policies_id 

join insurance_agencies k1 on k1.id=a.agencies_id

join insurance_street_types st1 on st1.id= insurer_street_types_id

join insurance_street_types st2 on st2.id= owner_street_types_id
join insurance_regions  reg1 on reg1.id=insurer_regions_id 
join insurance_regions  reg2 on reg2.id=owner_regions_id 
join insurance_cities cities on cities.id = b.registration_cities_id
join insurance_accounts acc on a.agents_id=acc.id
join insurance_financial_institutions fi on fi.id = b.financial_institutions_id

join (select id, policies_id ,brand,shassi, products_title, year, deductibles_value0, deductibles_value1 from insurance_policies_kasko_items group by policies_id , brand,products_title,shassi) k on a.id = k.policies_id 

left join insurance_accidents as accidents on a.id = accidents.policies_id
left join insurance_accidents as accidents3 on a.id = accidents3.policies_id and accidents3.insurance = 3
left join insurance_policies_kasko_item_years_payments as iyp on a.id = iyp.policies_id and k.id = iyp.items_id and calendar.date = iyp.date

where a.product_types_id=3 and a.insurance_companies_id=4 and b.insurer_person_types_id = 1
and options_test_drive=0 and options_race=0 and calendar.statuses_id > 2 and calendar.payment_date between \'2013-04-01\' and now() and a.end_datetime > now() group by a.number';

$list = $db->getAll($sql);

header('Content-Disposition: attachment; filename="list.xls"');
header('Content-Type: ' . Form::getContentType('list.xls'));

?>

<table width="100%" cellpadding="5" cellspacing="0">
	<?
		foreach ($list as $row) {
	?>
	<tr>
	<?
		foreach ($row as $el) {
	?>
		<td style='mso-number-format:"\@";' align="center"><?=$el?></td>
	<?
		}
	?>
	</tr>
	<?
		}
	?>
</table>