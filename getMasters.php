<?
require_once 'include/collector.inc.php';

$sql = 'SELECT DISTINCT  CONCAT(accounts.lastname, \' \', accounts.firstname, \' \', accounts.patronymicname) as master, masters.address, masters.identification_code,
        CONCAT(masters.passport_series, \' \', masters.passport_number) as passport_number,masters.passport_place, date_format(masters.passport_date, \'%d.%m.%Y\') as passport_date,
        masters.recipient,	masters.mfo, masters.zkpo, masters.bank_account, masters.bank_reference
        FROM insurance_masters as masters
        JOIN insurance_accounts as accounts ON masters.accounts_id = accounts.id
        WHERE agreement_number<> \'\' AND agreement_number is not NULL AND accounts.active = 1 AND agreement_date <> \'0000-00-00\' AND  agreement_date	is not NULL
        GROUP BY masters.agreement_number';
$list = $db->getAll($sql);

header('Content-Disposition: attachment; filename="report.xls"');
header('Content-Type: ' . Form::getContentType('report.xls'));
include 'getMastersExcel.php';

?>