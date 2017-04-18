<?
/*
 * Title: calculator class
 *
 * @author Eugene Cherkassky
 * @email info@b-land.com
 * @version 3.0
 */

require_once '../../include/collector.inc.php';
require_once 'Products.class.php';

class ProductsService {  

    function get($values) {
        global $db;

        $conditions[] = 'a.product_types_id = ' . intval($values->product_typesId);

        $sql =  'SELECT a.*, b.agencies_id, c.code as agencies_code ' .
                'FROM ' . PREFIX . '_products as a ' .
                'JOIN ' . PREFIX . '_product_agency_assignments as b ON a.id = b.products_id ' .
                'JOIN ' . PREFIX . '_agencies as c ON b.agencies_id = c.id ' .
                'WHERE ' . implode(' AND ', $conditions) . ' ' .
                'ORDER BY a.id';
        $res = $db->query($sql);

        while ($res->fetchInto($row)) {
            $row['agenciesId'] = $row['agencies_id'];
            if (!in_array($row['id'], $products)) {
                $list[] = $row;
                $products[] = $row['id'];
                $list[ sizeOf($list) - 1]['agencies'][]='0';
            }

            $list[ sizeOf($list) - 1]['agencies'][] = $row['agencies_code'];
        }

        return $list;
    }

    function getGO($values) {

        $Products = Products::factory($data, 'GO');
//        $values->amount = $Products->calculate($values->personTypesId,0,$values->deductible,  $values->car_typesId, $values->engine_size, $values->car_weight, $values->passengers, $values->regionsId, $values->driver_standingsId, $values->driversId, $values->termsId,0, $values->privileges,3, $this->convertObjectToArray($values));
          $driver_standingsId = $values->driver_standingsId<3 ? 5 : 6;
          $values->amount = $Products->calculate(1,    0, $values->deductible,         $values->car_typesId,         $values->engine_size,         $values->car_weight,         $values->passengers,         $values->regionsId, 1, $driver_standingsId, $values->termsId, 0, $values->privileges, 5, $this->convertObjectToArray($values));

        return $values;
    }

    function convertObjectToArray($values) {

        if (is_object($values)) {

            $values = (array) $values;
            $values['products'] = (array) $values['products'];
        }

        return $values;
    }

    function getKASKO($values) {
        global $db;

        $values = $this->convertObjectToArray($values);
        $values['insurance_companiesId']=4;
//              return array('result' => serialize($values['products']['id']));
        if (is_array($values['products']['id'])) {

            $sql =  'SELECT a.id, a.products_id, a.value0, a.absolute0, a.value1, a.absolute1 ' .
                    'FROM ' . PREFIX . '_product_deductibles AS a ' .
                    'JOIN ' . PREFIX . '_product_car_brand_assignments AS b ON a.products_id = b.products_id ' .
                    'WHERE a.products_id IN(' . implode(', ', $values['products']['id']) . ') AND a.car_types_id ='.intval($values['car_typesId']).' AND car_brands_id = ' . intval($values['car_brandsId']).' ORDER BY a.absolute0,a.value0 DESC,a.value1 DESC ';
            $res =  $db->query($sql);
//              return array('result' => $sql);
            $Products = Products::factory($data, 'KASKO');

            while ($res->fetchInto($row)) {
// return array('result' => serialize($row));
                $data = array_merge($values, $row);

                if ($values['dtp']) {
                    $data['risks'][] = 1;
                }
                if ($values['pdto']) {
                    $data['risks'][] = 2;
                }
                if ($values['actofgod']) {
                    $data['risks'][] = 3;
                }
                if ($values['downfall']) {
                    $data['risks'][] = 4;
                }
                if ($values['animal']) {
                    $data['risks'][] = 5;
                }
                if ($values['fire']) {
                    $data['risks'][] = 6;
                }
                if ($values['hijacking']) {
                    $data['risks'][] = 7;
                }

                $data['brandsId'] = $data['brands_id'] =$data['car_brandsId'];
                $data['zonesId'] = $data['zones_id'] = 1;
                
                $data['car_types_id'] = $data['car_typesId'];
                $data['car_brands_id'] = $data['car_brandsId'];
                $data['person_types_id'] = $data['personTypesId'];
                $data['driver_standings_id'] = $data['driver_standingsId'];
                $data['drivers_id'] = $data['driversId'];
                $data['driver_ages_id'] = $data['driver_agesId'];
                $data['cities_id'] = $data['citiesId'];
                $data['terms_id'] = $data['termsId'];
                $data['deductibles_id'] = $data['deductiblesId'];
                $data['priority_payments_id'] = $data['priorityPaymentsId'];
                $data['residences_id'] = $data['residencesId'];
                $data['transmissions_id'] = $data['transmissionsId'];
                $data['options_deterioration_no'] = $data['optionsDeteriorationNo'];
                $data['options_deductible_glass_no'] = $data['optionsDeductibleGlassNo'];
                $data['options_first_accident'] = $data['optionsFirstEvent'];
                $data['options_season'] = $data['optionsSeason'];
                $data['options_guilty_no'] = $data['optionsGuiltyNo'];
                $data['options_holiday'] = $data['optionsHoliday'];
                $data['options_work'] = $data['optionsWork'];
                $data['options_taxy'] = $data['optionsTaxy'];
                $data['options_alarm'] = $data['optionsAlarm'];
                $data['options_agregate_no'] = $data['optionsAgregateNo'];
                $data['options_years'] = $data['optionsYears'];
                $data['price'] = $values['price'];
                $data['express_incoming'] = true;
                
                $item['transmissionsId'] = $item['transmissions_id']=$data['transmissionsId'];
                $item['brandsId']= $item['brands_id']= $data['brandsId'] ;
                $item['year']= $data['year'] ;
                $item['car_price'] = $values['price'];

                $data['items'][]=$item;
                $data['bonus_malus']=1;             
                $Products->calculate($values['engine_size'], $values['car_typesId'], $values['personTypesId'], $values['driver_standingsId'], $values['driversId'], $values['price'], $values['driver_agesId'], $values['citiesId'], $values['termsId'], $row['id'], $data,$item);
//return array('result' => serialize($item));               
//              return array('result' => serialize($values));
//              return array('result' => $item['sql']);
                if ((doubleval($item['amount'])>0 && doubleval($item['amount_kasko'])>0) || $row['products_id']==81)  {
                    $result[ $row['products_id'] ][] = array(
                    'id'            => $row['id'],
                    'other'         => $row['value0'] . (($row['absolute0']) ? ' грн.' : '%'),
                    'hijacking'     => $row['value1'] . (($row['absolute1']) ? ' грн.' : '%'),
                    'rate'          => round($item['amount'] / $values['price'] * 100, 3),
                    'amountKASKO'   =>$item['amount_kasko'],
                    'amount'        => $item['amount']);
                }   
            }
        }

        return array('result' => serialize($result));
    }
}

ini_set('soap.wsdl_cache_enabled', 0);

$Server = new SoapServer('products.wsdl');
$Server->setClass('ProductsService');
$Server->handle();

?>