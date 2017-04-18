<?
/*
 *
 */

require_once '../../include/collector.inc.php';
echo '<?xml version="1.0" encoding="UTF-8"?>';
?>
<resultset>
<?
	$sql='SELECT a.* FROM '.PREFIX.'_policies a '.
		 'WHERE a.id='.intval($data['policiesId']);
	$row=$db->getRow($sql);
	if ($row) {
?>
		<amount><?=doubleval($row['amount'])?></amount>
<?
	}
?>

</resultset>
