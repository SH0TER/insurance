<?
/*
 *
 */

require_once '../../include/collector.inc.php';
 $url = 'https://express-credit.in.ua/synchronization/express/exportkreditdates.php';
$contents = file_get_contents ($url);
echo $contents;
 $xml = simplexml_load_string($contents);
 if ($xml) {
                    foreach ($xml->record as $record) {
						$sql='UPDATE insurance_policies SET register_car_date='.$db->quote((string)$record->zareestrovanoDate).',bank_akt_payment_date='.$db->quote((string)$record->bankAktPaymentDate).',solutions_id='.intval($record->solutionId).' WHERE id='.intval($record->insurance_kasko_policiesId);
//						_dump($sql);
						$db->query($sql);
						$sql='UPDATE insurance_policies SET register_car_date='.$db->quote((string)$record->zareestrovanoDate).',bank_akt_payment_date='.$db->quote((string)$record->bankAktPaymentDate).',solutions_id='.intval($record->solutionId).' WHERE id='.intval($record->insurance_go_policiesId);
						$db->query($sql);
//						_dump($sql);
					}
 }
 echo 'done';
?>
