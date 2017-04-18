<?
/*
 *
 */

require_once '../../include/collector.inc.php';
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<resultset>
<?

		$sql =  'SELECT a.*,DATE_SUB(DATE_ADD(a.begin_datetime,INTERVAL  1 YEAR),INTERVAL 1 DAY) as end_datetime, b.sign_agents_id,d.ground_kasko_express as ground_kasko, d.director1, d.director2 ' .
                'FROM ' . PREFIX . '_policies AS a ' .
                'JOIN ' . PREFIX . '_policies_kasko AS b ON b.policies_id = a.id ' .
				'JOIN ' . PREFIX . '_agencies AS d ON a.agencies_id = d.id ' .
                'WHERE a.id=' .intval($data['policiesId']);
				
	$row=$db->getRow($sql);

	if (intval($row['sign_agents_id'])) {

            $sql =  'SELECT * ' .
                    'FROM ' . PREFIX . '_agents ' .
                    'WHERE accounts_id = ' . intval($row['sign_agents_id']);
            $agent = $db->getRow($sql);

            if ($agent['ground_kasko'] && $agent['director1'] && $agent['director2']) {
                $row['ground_kasko'] = $agent['ground_kasko'];
                $row['director1']   = $agent['director1'];
                $row['director2']   = $agent['director2'];
            }
        }
		
	if ($row) {
?>
		<beginDateTime><?=$row['begin_datetime']?></beginDateTime>
		<endDateTime><?=$row['end_datetime']?></endDateTime>
		<agreementDate><?=$row['date']?></agreementDate>	
		<groundKASKO><?=$row['ground_kasko']?></groundKASKO>		
		<director1><?=$row['director1']?></director1>		
		<director2><?=$row['director2']?></director2>		
<?
	}

?>

</resultset>
