<?
/**
 * Created by JetBrains PhpStorm.
 * User: e.cherkassky
 * Date: 13.06.12
 * Time: 9:57
 * To change this template use File | Settings | File Templates.
 */

include_once '../../include/collector.inc.php';

include_once 'Regions.class.php';
include_once 'StreetTypes.class.php';

$fields = array(
            'blank_series',
            'blank_number',
            'policy_statuses_title',
            'begin_datetime',
            'end_datetime',
            'terms_title',
            'policies_date',
            'terms_id1',
            'terms_id2',
            'terms_id3',
            'terms_id4',
            'terms_id5',
            'terms_id6',
            'terms_id7',
            'terms_id8',
            'terms_id9',
            'terms_id10',
            'terms_id11',
            'terms_id12',
            'privileges',
            'discount',
            'registration_regions_id',
            'registration_regions_title',
            'bonus_malus',
            'k1',
            'k2',
            'k3',
            'k4',
            'k5',
            'k6',
            'k7',
            'limit_life',
            'limit_property',
            'deductible',
            'amount',
            'payed_amount',
            'comment',
            'cancel_date',
            'amount_return',
            'blank_series_parent',
            'blank_number_parent',
            'resident',
            'insurer_person_types_title',
            'insurer_identification_code',
            'insurer_lastname',
            'insurer_firstname',
            'insurer_patronymicname',
            'insurer_dateofbirth',
            'insurer_phone',
            'insurer_passport',
            'insurer_passport_series',
            'insurer_passport_number',
            'insurer_zip',
            'insurer_address',
            'registration_cities_title',
            'item',
            'sign',
            'shassi',
            'car_types_title',
            'brands_id',
            'brand',
            'models_id',
            'model',
            'year',
            'taxi',
            'otk',
            'otkdate',
            'stage3',
            'old',
            'auto',
            'marka',
            'city_name');

function process($fields, $row) {
    global $REGIONS;

    foreach ($fields as $name) {
        switch ($name) {
            case 'policy_statuses_title':
/*
есть
    10 	сформований - 1
    13 	анульований - 2
    14 	зіпсований - это к бланкам
    15 	дублікат - 3
    16 	пролонгований - 1
    17 	переукладений - 4
*/
                switch ($row['policy_statuses_id']) {
                    case '10'://1 - Укладений
                    case '16':
                        $result['policy_statuses_title'] = 1;
                        break;
                    case '13'://2 - Достроково припинений
                        $result['policy_statuses_title'] = 2;
                        break;
                    case '15'://3 - Дублікат
                        $result['policy_statuses_title'] = 3;
                        break;
                    case '17'://4 - Переоформлений
                        $result['policy_statuses_title'] = 4;
                        break;
                }
                break;
            case 'terms_title':
                for ($i=1; $i<13; $i++) {
                    $result['terms_id' . $i] = 0;
                }

                $result['terms_id' . ($row['terms_id'] - 13) ] = 1;
                $result['terms_title'] = $row['terms_id'] - 12;
                break;
            case 'terms_id1':
            case 'terms_id2':
            case 'terms_id3':
            case 'terms_id4':
            case 'terms_id5':
            case 'terms_id6':
            case 'terms_id7':
            case 'terms_id8':
            case 'terms_id9':
            case 'terms_id10':
            case 'terms_id11':
            case 'terms_id12':
                break;
            case 'discount':
                $result[ $name ] = 0;
                break;
            case 'registration_regions_id':
                switch ($row['registration_regions_id']) {
                    case '1':
                    case '2':
                    case '3':
                    case '4':
                    case '5':
                        $result[ $name ] = $row['registration_regions_id'];
                        break;
                    case '11':
                        $result[ $name ] = 6;
                        break;
                }
                break;
            case 'bonus_malus':
                 $result[ $name ] = 0;
                break;
            case 'k5':
                 $result[ $name ] = '1,000';
                break;
            case 'k1':
            case 'k2':
            case 'k3':
            case 'k4':
            case 'k6':
            case 'k7':
            case 'deductible':
            case 'amount':
            case 'payed_amount':
            case 'amount_return':
                $result[ $name ] = str_replace('.', ',', $row[ $name ]);
                break;
            case 'comment':
                $result[ $name ] = 'Виданий спеціальний знак серії ' . $row['stiker_series'] . ' № ' . $row['stiker_number'];
                break;
            case 'limit_life':
                $result[ $name ] = 100000;
                break;
            case 'limit_property':
                $result[ $name ] = 50000;
                break;
            case 'resident':
                $result[ $name ] = 1;
                break;
            case 'insurer_passport':
                $result[ $name ] = ($row['passport_series'] != '' || $row['passport_number'] != '') ? 'паспорт' : '';
                break;
            case 'insurer_dateofbirth':
                $result[ $name ] = ($row[ $name ] == '0000-00-00') ? '' : $row[ $name ];
                break;
            case 'insurer_phone':
                $result[ $name ] = str_replace(array(' ', '-', '(', ')'), array('', '', '', ''), $row[ $name ]);
                break;
            case 'insurer_person_types_title':
                switch ($row['person_types_id']) {
                    case '1':
                        $result[ $name ] = 'Ф';
                        break;
                    case '2':
                        $result[ $name ] = 'Ю';
                        break;
                }
                break;
            case 'insurer_identification_code':
                switch ($row['person_types_id']) {
                    case '1':
                        $result[ $name ] = $row['insurer_identification_code'];
                        break;
                    case '2':
                        $result[ $name ] = $row['insurer_edrpou'];
                        break;
                }
                break;
            case 'insurer_address':
                $result[ $name ] = Regions::getTitle($row['insurer_regions_id']);

                if ($row['insurer_area']) {
                    $result[ $name ] .= ', ' . $row['insurer_area'].' р-н';
                }

                if (!in_array($row['insurer_regions_id'], $REGIONS)) {
                    $result[ $name ] .= ', ' . $row['insurer_city'];
                }

                $result[ $name ] .=  ', ' . StreetTypes::getTitle($row['insurer_street_types_id']) . ' ' . $row['insurer_street'] . ', буд. ' . $row['insurer_house'];

                if ($row['insurer_flat']) {
                    switch ($row['person_types_id']) {
                        case 1:
                            $result[ $name ] .= ', кв. ' . $row['insurer_flat'];
                            break;
                        case 2:
                            $result[ $name ] .= ', оф. ' . $row['insurer_flat'];
                            break;
                    }
                }
                break;
            case 'car_types_title':
                switch ($row['car_types_id']) {
                    case '1'://Легкові автомобілі
                        if ($row['engine_size'] < 1600) {//1	A1	легковий автомобіль до 1600 кубічних сантиметрів;
                            $result['car_types_title'] = 1;
                        } elseif ($row['engine_size'] < 2000) {//2	A2	легковий автомобіль від 1601 до 2000 куб. см.
                            $result['car_types_title'] = 2;
                        } elseif ($row['engine_size'] < 3000) {//3	A3	легковий автомобіль від 2001 до 3000 куб. см.
                            $result['car_types_title'] = 3;
                        } else {//4	A4	легковий автомобіль більше 3000 куб. см.
                            $result['car_types_title'] = 4;
                        }
                        break;
                    case '2'://Причепи до легкових автомобілів
                        $result['car_types_title'] = 11;
                        break;
                    case '3'://Автобуси
                        if ($row['passengers'] <= 20) {//9	E1	автобуси з кількістю місць до 20 чол. (включно)
                            $result['car_types_title'] = 9;
                        } else {//10	E2	автобуси з кількістю місць більше 20 чол.
                            $result['car_types_title'] = 10;
                        }
                        break;
                    case '4'://Вантажні автомобілі
                        if ($row['car_weight'] <= 2000) {//7	C1	вант. автомобілі вантажопідйомністю до 2т (включ)
                            $result['car_types_title'] = 7;
                        } else {//8	C2	вантажні автомобілі вантажопідйомністю понад 2 т.
                            $result['car_types_title'] = 8;
                        }
                        break;
                    case '5'://Причепи до вантажних автомобілів
                        $result['car_types_title'] = 12;
                        break;
                    case '6':
                    case '7':
                        if ($row['engine_size'] <= 300) {//5	B1	мотоцикли та моторолери до 300 куб. см.
                            $result['car_types_title'] = 5;
                        } else {//6	B2	мотоцикли та моторолери більше 300 куб. см.
                            $result['car_types_title'] = 6;
                        }
                        break;
                }
                break;
            case 'sign':
            case 'shassi':
                $result[ $name ] = str_replace(' ', '', $row[ $name ]);
                break;
            case 'taxi':
                switch ($row[ $name ]) {
                    case '0':
                        $result[ $name ] = '1';
                        break;
                    case '1':
                        $result[ $name ] = '2';
                        break;
                }
                break;
            case 'otkdate':
                $result[ $name ] = ($row['otk'] == '1') ? $row['otkdate'] : '';
                break;
            case 'stage3':
                if ($row['person_types_id'] == '1') {
                    switch ($row[ $name ]) {
                        case '0':
                            $result[ $name ] = '2';
                            break;
                        case '1':
                            $result[ $name ] = '1';
                            break;
                    }
                } else {
                    $result[ $name ] = '';
                }
                break;
            case 'old':
                $result[ $name ] = 'false';
                break;
            case 'auto':
            case 'marka':
                $result[ $name ] = $row['brand'] . ' ' . $row['model'];
                break;
            case 'city_name':
                $result[ $name ] = $row['registration_cities_title'];
                break;
            default:
                $result[ $name ] = $row[ $name ];
                break;
        }
    }

    return $result;
}
/*
$conditions[] = 'insurance_companies_id = 4';
$conditions[] = 'policy_statuses_id IN(10, 14)';
$conditions[] = 'TO_DAYS(begin_datetime) < TO_DAYS(\'2012-06-01\')';
$conditions[] = '(documents = 1 OR policy_comment<>\'\')';
*/

$conditions = array('b.blank_number IN(SELECT number FROM mtsbu_blanks)');

$sql = 'SELECT
blank_series,
blank_number,
policy_statuses_id,
a.begin_datetime,
a.end_datetime,
IF(a.begin_datetime > d.payment_date, d.payment_date, a.begin_datetime) as policies_date,
terms_id,
privileges,
b.regions_id AS registration_regions_id,
j.title as registration_regions_title,
k1,
k2,
k3,
k4,
k5,
k6,
k7,
deductible,
a.amount,
payed_amount,
a.comment,
amount_return,
blank_series_parent,
blank_number_parent,
person_types_id,
insurer_identification_code,
insurer_edrpou,
insurer_lastname,
insurer_firstname,
insurer_patronymicname,
insurer_dateofbirth,
insurer_phone,
insurer_passport_series,
insurer_passport_number,
insurer_zip,
insurer_regions_id,
insurer_area,
insurer_city,
insurer_street,
insurer_house,
insurer_flat,
item,
sign,
shassi,
car_types_id,
brands_id,
brand,
models_id,
model,
year,
stiker_series,
stiker_number,
taxi,
otk,
otkdate,
stage3,
f.title as registration_cities_title

FROM ' . PREFIX . '_policies AS a
JOIN ' . PREFIX . '_policies_go AS b ON a.id = b.policies_id 
JOIN ' . PREFIX . '_policy_statuses AS c ON a.policy_statuses_id = c.id
LEFT OUTER JOIN (SELECT policies_id, MIN(payment_date) as payment_date, IF(ISNULL(SUM(amount)), 0, SUM(amount)) as payed_amount FROM ' . PREFIX . '_policy_payments GROUP BY policies_id) AS d on a.id = d.policies_id
LEFT OUTER JOIN (SELECT policies_id, MIN(created) as cancel_date FROM ' . PREFIX . '_policy_status_changes WHERE policy_statuses_id = 13 GROUP BY policies_id) AS e ON a.id = e.policies_id OR ISNULL(e.policies_id)
JOIN ' . PREFIX .'_cities as f ON b.registration_cities_id = f.id
JOIN ' . PREFIX .'_parameters_regions as j ON f.regions_go_id = j.id
WHERE ' . implode(' AND ', $conditions);

$list = $db->getAll($sql);

$result = array();
foreach ($list as $i => $row) {
    $result[] = process($fields, $row);
}

echo '<table border="1">';
echo '<tr>';
foreach ($fields as $name) {
    echo '<td>' . $name . '</td>';
}
echo '</tr>';

foreach ($result as $i => $row) {
    echo '<tr>';
    foreach ($fields as $name) {
        echo '<td>' . $row[ $name ] . '</td>';
    }
    echo '</tr>';
}

echo '</table>';

?>