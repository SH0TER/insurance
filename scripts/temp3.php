<?

include_once '../include/collector.inc.php';
require_once '../include/modules/Reports.class.php';

_dump(Reports::getInsurancePeriods(
	array(
		'calendar'				=>	1,
		'agencies_id'		=>	12,
		'product_types_id'	=>	3,
		'types_id'			=>	0,
		'date_types_id'		=>	2,
		'from'				=>	'01.09.2014',
		'to'				=>	'28.09.2014'
	)
));



?>