<?

require_once '../../include/collector.inc.php';
require_once '../../include/modules/Products/GO.class.php';
require_once '../../include/modules/Regions.class.php';

switch ($_GET['type']){
    case 'rate':
        $cl = new Products_GO();
        if ($data['privileges'] == 'true')
            echo $cl->calculate($data['person_types_id'],null,510.00,$data['car_types_id'],$data['engine_size'],$data['car_weight'],$data['passengers'],Regions::getOneCityIdByRegionId($data['regions_id']),$data['scopes_id'],5,$data['terms_id'],0,true,5,$data);
        else
            echo $cl->calculate($data['person_types_id'],null,510.00,$data['car_types_id'],$data['engine_size'],$data['car_weight'],$data['passengers'],Regions::getOneCityIdByRegionId($data['regions_id']),$data['scopes_id'],5,$data['terms_id'],0,false,5,$data);
        break;
}

?>