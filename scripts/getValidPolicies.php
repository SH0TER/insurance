<style>
.columns TD {
	height: 25px;
	color: #FFFFFF;
	padding-left: 4px;
	font-weight: bold !important;
	border-right: 1px solid #4F5D75;
	border-top: 1px solid #4F5D75;
	border-bottom: 1px solid #4F5D75;
	background: #008575 url(../images/administration/tabBorder.gif);
}
</style>

<?

require_once '../include/collector.inc.php';

$sql = 'create temporary table temp_list
select max(a.date) as date, a.policies_id
from insurance_policy_payments_calendar a
join insurance_policies b on a.policies_id = b.id
where b.date > \'2011-01-01\' AND b.date < \'2014-04-30\'  and b.product_types_id = 3 AND a.statuses_id>1 and a.amount>0
group by a.policies_id HAVING(max(a.date))>\'2013-06-01\' ';

/*$sql = 'create temporary table temp_list
select max(a.date) as date, a.policies_id, b.number
from insurance_policy_payments_calendar a
join insurance_policies b on a.policies_id = b.id
join insurance_agencies c on b.agencies_id = c.id
join insurance_policies_kasko d on b.id = d.policies_id
join insurance_cities e on d.registration_cities_id = e.id
where a.date < \'2014-04-30\' and b.interrupt_datetime > \'2014-04-30\' and b.product_types_id = 3 and (c.regions_id in (1,27) or e.regions_id in (1,27) or d.insurer_regions_id in (1,27))
group by a.policies_id';*/
$db->query($sql);

/*$sql = 'create temporary table temp_list
select max(a.date) as date, a.policies_id, b.number
from insurance_policy_payments_calendar a
join insurance_policies b on a.policies_id = b.id
join insurance_agencies c on b.agencies_id = c.id
join insurance_policies_go d on b.id = d.policies_id
join insurance_cities e on d.registration_cities_id = e.id
where a.date < \'2014-04-30\' and b.interrupt_datetime > \'2014-04-30\' and b.product_types_id = 4 and (c.regions_id in (1,27) or e.regions_id in (1,27) or d.insurer_regions_id in (1,27))
group by a.policies_id';
$db->query($sql);
*/
$sql = 'select * from temp_list';
//_dump($db->getAll($sql));exit;

$sql = 'select c.number, date_format(c.date, \'%d.%m.%Y\') as p_date, 
d.terms_years_id,
0 as oplacheno,b.date as dataposlednplatega,\'\' as dataposlplategafact,
IF(payment_brakedown_id=1,1,IF(payment_brakedown_id=2,2,IF(payment_brakedown_id=3,4,0))) as razbivka,
0 as oplpocalendar,
if(d.insurer_person_types_id = 1, concat_ws(\' \', d.insurer_lastname, d.insurer_firstname, d.insurer_patronymicname), d.insurer_company),
f.title as type, e.brand, e.model, g.title as color, e.engine_size, e.year, e.race, e.number_places, e.use_as_car, e.car_price, e.rate_kasko, e.amount_kasko, date_format(getPolicyDate(c.number, 2), \'%d.%m.%Y\') as b_date, 
date_format(getPolicyDate(c.number, 3), \'%d.%m.%Y\') as e_date, h.title as statuses, \'сплачено\' as p_status, j.title as bank, k.title as agency, concat_ws(\' \', l.lastname, l.firstname), getInsurerAddressByPoliciesId(c.id),c.id
from  temp_list b  
join insurance_policies c on b.policies_id = c.id
join insurance_policies_kasko d on c.id = d.policies_id
join insurance_policies_kasko_items e on c.id = e.policies_id
join insurance_car_types f on e.car_types_id = f.id
join insurance_car_colors g on e.colors_id = g.id
join insurance_policy_statuses h on c.policy_statuses_id = h.id
left join insurance_financial_institutions j on d.financial_institutions_id = j.id
join insurance_agencies k on c.agencies_id = k.id
join insurance_accounts l on c.agents_id = l.id
 WHERE c.agreement_types_id<>3 ';
$list = $db->getAll($sql);

//$sql = 'select * from temp_list';
$list = $db->getAll($sql);

$use = array(
	1 => 'особисто',
	2 => 'робочі',
	3 => 'особисто, робочі',
	4 => 'оренда, лізинг',
	5 => 'особисто, оренда, лізинг',
	6 => 'робочі, оренда, лізинг',
	7 => 'особисто, робочі, оренда, лізинг'
);

header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));

?>

<table>
	<tr class="columns">
		<td>Номер</td>
		<td>Дата полісу</td>
		<td>Всего страховых периодов по договору (года)</td>
		<td>Количество оплаченных платежей по страховым периодам</td>
		<td>Дата последнего платежа</td>
		<td>Дата последнего платежа(факт)</td>
		<td>Рaзбивка (количество)</td>
		<td>Количество оплаченных платежей по календарю</td>
		<td>Страхувальник (ФИО в одной ячейке)</td>
		<td>Тип ТЗ</td>
		<td>марка</td>
		<td>модель</td>
		<td>цвет</td>
		<td>объем двигателя</td>
		<td>Год выпуск</td>
		<td>Пробег, тыс. км</td>
		<td>кол-во мест</td>
		<td>использование ТС в целях</td>
		<td>Сума, грн.</td>
		<td>Тариф, %</td>
		<td>Премія, грн.</td>
		<td>Початок</td>
		<td>Закінчення</td>
		<td>Статус</td>
		<td>Оплата</td>
		<td>Банк</td>
		<td>Агенція</td>
		<td>Агент</td>
		<td>Адреса страхувальника с указанием области (в одной ячейке)</td>
	</tr>
	
	<?
		foreach ($list as $row){
		$row['oplacheno'] = $db->getOne('
		SELECT COUNT( * ) 
FROM (

SELECT COUNT( a.id ) AS colall, oplcol, a.number_insurance_year
FROM insurance_policy_payments_calendar a
LEFT JOIN (

SELECT COUNT( id ) AS oplcol, number_insurance_year
FROM   insurance_policy_payments_calendar  
WHERE  policies_id ='.$row['id'].'
AND statuses_id >1
GROUP BY number_insurance_year
)b ON b.number_insurance_year = a.number_insurance_year
WHERE a.policies_id ='.$row['id'].'
GROUP BY number_insurance_year, oplcol
)f
WHERE colall = oplcol');

$row['oplpocalendar'] = $db->getOne('
SELECT COUNT( id )  
FROM   insurance_policy_payments_calendar  
WHERE  policies_id ='.$row['id'].'
AND statuses_id >1');

$row['dataposlplategafact'] = $db->getOne('
SELECT max( datetime )  
FROM   insurance_policy_payments  
WHERE  policies_id ='.$row['id'].'
 ');



			echo '<tr>';
			foreach ($row as $key => $val){
				if ($key == 'use_as_car') echo '<td>' . $use[$val] . '</td>';
				elseif ($key == 'car_price' || $key == 'amount_kasko') echo '<td>' . str_replace('.', ',', $val) . '</td>';
				else echo '<td>' . $val . '</td>';
			}
			echo '</tr>';
		}
	?>
	
</table>