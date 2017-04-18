<?
require_once '../../include/collector.inc.php';

$sql='SELECT a.number, a.agencies_id,a.products_id,a.commission_agency_amount,a.commission_agent_amount,a.commission_agency_percent,a.commission_agent_percent,a.documents, a.payment_statuses_id, d.datetime AS bankdatetime, d.amount, d.doc_number, d.payment_date, d.payment_number
		FROM insurance_policies a
		JOIN insurance_policies_kasko b ON b.policies_id = a.id
		JOIN (
		
		SELECT policies_id, max( datetime ) AS bankdatetime
		FROM insurance_policy_payments
		GROUP BY policies_id
		)c ON c.policies_id = a.id
		JOIN insurance_policy_payments d ON d.policies_id = a.id
		AND d.datetime = c.bankdatetime
		';
		$res = $db->query($sql);

		while($res->fetchInto($row)) {
		
		//$sql='SELECT * 	FROM insurance_agency_commissions WHERE date<'.$db->quote($row['bankdatetime']).' AND agenciesId='.intval($row['agenciesId']). ' AND productsId='.intval($row['productsId']). ' order by date DESC LIMIT 1';
		//$commissions=$db->getRow($sql);
		$result.='<row>
		<number>'.$row['number'].'</number>
		<documents>'.$row['documents'].'</documents>
		<payments_statusesId>'.$row['payment_statuses_id'].'</payments_statusesId>
		<bankdatetime>'.$row['bankdatetime'].'</bankdatetime>
		<amount>'.$row['amount'].'</amount>
		<docNumber>'.$row['doc_number'].'</docNumber>
		<paymentDate>'.$row['payment_date'].'</paymentDate>
		<paymentNumber>'.$row['payment_number'].'</paymentNumber>
		<commissionAgencyAmount>'.doubleval($row['commission_agency_amount']).'</commissionAgencyAmount>
		<commissionAgentAmount>'.doubleval($row['commission_agent_amount']).'</commissionAgentAmount>
		<commissionAgencyPercent>'.doubleval($row['commission_agency_percent']).'</commissionAgencyPercent>
		<commissionAgentPercent>'.doubleval($row['commission_agent_percent']).'</commissionAgentPercent>
		</row>
		';
		
		}
		header('Content-Type: ' . Form::getContentType('export.xml'));
		echo '<?xml version="1.0" encoding="UTF-8"?><resultset>'.$result.'</resultset>';
		exit;

?>


