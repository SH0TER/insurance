<?
require_once '../include/collector.inc.php';

/*$str = "338(Добуток базового платежу та корегуючих коефіцієнтів з урахуванням знижок має дорівнювати страховій премії), 342(Дата народження не відповідає ідентифікаційному коду ), 229(Невірний формат державного номеру ТЗ для резиденту)";
$str = "zona(Даний параметр є параметром ідентифікації. У випадку його відсутності дані не будуть завантажені)";
$num = explode(',', preg_replace("![^\d,\,]*!", "", $str));
_dump($num);

preg_match_all('/\(([^()]*)\)/', $str, $errors);
/*foreach ($num as $key => $val) {
	if ($val == 342) unset($errors[1][$key]);
}*/
/*_dump($errors);*/

$xml_response = '<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/" xmlns:u="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd"><s:Header><ActivityId CorrelationId="84679a91-ace3-4732-9c49-ff294a2e018d" xmlns="http://schemas.microsoft.com/2004/09/ServiceModel/Diagnostics">818411eb-0755-41f9-9029-eed7811712cc</ActivityId><o:Security s:mustUnderstand="1" xmlns:o="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"><u:Timestamp u:Id="_0"><u:Created>2013-08-21T15:53:15.093Z</u:Created><u:Expires>2013-08-21T15:58:15.093Z</u:Expires></u:Timestamp></o:Security></s:Header><s:Body><LoadXMLimportResponse xmlns="https://mail.mtibu.kiev.ua/WebService"><LoadXMLimportResult>&lt;?xml version="1.0" encoding="Windows-1251"?&gt;&lt;Contracts&gt;&#xD;
  &lt;Contract hash_code="VV5cAKXtsygOwv4TJQuW1Q==" sagr="АС" nagr="3824392" compl="4" d_beg="20130714" d_end="20140713" c_term="13" d_distr="20130714" is_active1="False" is_active2="False" is_active3="False" is_active4="False" is_active5="False" is_active6="False" is_active7="False" is_active8="False" is_active9="False" is_active10="False" is_active11="False" is_active12="True" c_privileg="0" c_discount="0" zona="3" b_m="0" k1="2.18" k2="1.8" k3="1" k4="1.2" k5="1" k6="1" k7="1" limit_life="100000" limit_prop="50000" franchise="510.00" payment="679.00" paym_bal="0.00" note="Виданий спеціальний знак серії АС № 3824392" retpayment="0.00" chng_sagr="АС" chng_nagr="3824049" resident="True" status_prs="Ю" numb_ins="01237738" f_name="ПАТ&amp;quot;Будмеханізація&amp;quot;" phone="0623051562" address_e="Донецька область, Донецьк,  Молодих шахтарів, буд. 8 А" c_city="37" auto="VOLVO/FM 13" reg_no="АН3366ЕІ" vin="YV2JSG0G68B505101" c_type="8" c_mark="34" prod_year="2008" sphere_use="1" need_to="True" date_next_to="20140714" IsOldData="False" mark_txt="VOLVO" model_txt="FM 13" str_error="338(Добуток базового платежу та корегуючих коефіцієнтів з урахуванням знижок має дорівнювати страховій премії), 58(Замінений поліс не знайдений в реєстрі полісів)" empty_id="" is_duplicate="False" Loaded="False" Has_Crit_Errors="True" empty_obl="c_model(Даний параметр є обов\'язковим)" empty_full="birth_date(Відсутні дані), doc_name(Відсутні дані), doc_series(Відсутні дані), doc_no(Відсутні дані), post_code(Відсутні дані)" form_error="" /&gt;&#xD;
&lt;/Contracts&gt;</LoadXMLimportResult></LoadXMLimportResponse></s:Body></s:Envelope>';

$xml_parser = xml_parser_create();
				xml_parse_into_struct($xml_parser, $xml_response, $vals_response, $index);
				xml_parser_free($xml_parser);
				//_dump($vals_response);
				
foreach($vals_response as $el) {
	if ($el['tag'] == 'LOADXMLIMPORTRESULT' && $el['type'] == 'complete') {
		$xml_response = iconv('UTF-8', 'CP1251', $el['value']);
		//$xml_response = $el['value'];
		$xml_parser = xml_parser_create();
		xml_parse_into_struct($xml_parser, $xml_response, $vals_response, $index);
		xml_parser_free($xml_parser);
		

		foreach($vals_response as $el_response) {
		
					if (in_array($el_response['tag'], array('USEDFORM', 'CONTRACT', 'CASE', 'CLAIMPAID')) AND $el_response['type'] == 'complete') {
				foreach($el_response['attributes'] as $key => $val) {
					_dump(iconv('UTF-8', 'CP1251',$val));
				}
				$sql = 'INSERT INTO ' . PREFIX . '_mtsbu_import_log ' .
								'SET ' .
									'storage = ' . $db->quote($storage) . ', ' .
									'items_id = ' . intval($array_id[ sizeof($array_id)-1] ) . ', ' .
									'data = ' . $db->quote(serialize($data)) . ', ' .
									'attributes = ' . $db->quote(iconv('UTF-8', 'CP1251', serialize($el_response['attributes']))) . ', ' .
									'type = ' . intval($type) . ', ' .
									'is_test = ' . 0 . ', ' .
									'loaded = ' . (($el_response['attributes']['LOADED'] == 'True') ? 1 : 0) . ', ' .
									'duplicate = ' . (($el_response['attributes']['IS_DUPLICATE'] == 'True') ? 1 : 0) . ', ' .
									'empty_id = ' . $db->quote(iconv('UTF-8', 'CP1251', $el_response['attributes']['EMPTY_ID'])) . ', ' .
									'str_error = ' . $db->quote(iconv('UTF-8', 'CP1251', $el_response['attributes']['STR_ERROR'])) . ', ' .
									'created = NOW()';
									_dump($sql);
			}
		}
	}
}
exit;
$xml_response = '<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/" xmlns:u="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd"><s:Header><ActivityId CorrelationId="84679a91-ace3-4732-9c49-ff294a2e018d" xmlns="http://schemas.microsoft.com/2004/09/ServiceModel/Diagnostics">818411eb-0755-41f9-9029-eed7811712cc</ActivityId><o:Security s:mustUnderstand="1" xmlns:o="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"><u:Timestamp u:Id="_0"><u:Created>2013-08-21T15:53:15.093Z</u:Created><u:Expires>2013-08-21T15:58:15.093Z</u:Expires></u:Timestamp></o:Security></s:Header><s:Body><LoadXMLimportResponse xmlns="https://mail.mtibu.kiev.ua/WebService"><LoadXMLimportResult>&lt;?xml version="1.0" encoding="Windows-1251"?&gt;&lt;Contracts&gt;&#xD;
  &lt;Contract hash_code="VV5cAKXtsygOwv4TJQuW1Q==" sagr="АС" nagr="3824392" compl="4" d_beg="20130714" d_end="20140713" c_term="13" d_distr="20130714" is_active1="False" is_active2="False" is_active3="False" is_active4="False" is_active5="False" is_active6="False" is_active7="False" is_active8="False" is_active9="False" is_active10="False" is_active11="False" is_active12="True" c_privileg="0" c_discount="0" zona="3" b_m="0" k1="2.18" k2="1.8" k3="1" k4="1.2" k5="1" k6="1" k7="1" limit_life="100000" limit_prop="50000" franchise="510.00" payment="679.00" paym_bal="0.00" note="Виданий спеціальний знак серії АС № 3824392" retpayment="0.00" chng_sagr="АС" chng_nagr="3824049" resident="True" status_prs="Ю" numb_ins="01237738" f_name="ПАТ&amp;quot;Будмеханізація&amp;quot;" phone="0623051562" address_e="Донецька область, Донецьк,  Молодих шахтарів, буд. 8 А" c_city="37" auto="VOLVO/FM 13" reg_no="АН3366ЕІ" vin="YV2JSG0G68B505101" c_type="8" c_mark="34" prod_year="2008" sphere_use="1" need_to="True" date_next_to="20140714" IsOldData="False" mark_txt="VOLVO" model_txt="FM 13" str_error="338(Добуток базового платежу та корегуючих коефіцієнтів з урахуванням знижок має дорівнювати страховій премії), 58(Замінений поліс не знайдений в реєстрі полісів)" empty_id="" is_duplicate="False" Loaded="False" Has_Crit_Errors="True" empty_obl="c_model(Даний параметр є обов\'язковим)" empty_full="birth_date(Відсутні дані), doc_name(Відсутні дані), doc_series(Відсутні дані), doc_no(Відсутні дані), post_code(Відсутні дані)" form_error="" /&gt;&#xD;
&lt;/Contracts&gt;</LoadXMLimportResult></LoadXMLimportResponse></s:Body></s:Envelope>';

$xml_parser = xml_parser_create();
				xml_parse_into_struct($xml_parser, $xml_response, $vals_response, $index);
				xml_parser_free($xml_parser);
				//_dump($vals_response);
				
foreach($vals_response as $el) {
	if ($el['tag'] == 'LOADXMLIMPORTRESULT' && $el['type'] == 'complete') {
		$xml_response = $el['value'];
		$xml_parser = xml_parser_create();
		xml_parse_into_struct($xml_parser, $xml_response, $vals_response, $index);
		xml_parser_free($xml_parser);
		_dump($xml_response);

		foreach($vals_response as $el_response) {
			if (in_array($el_response['tag'], array('USEDFORM', 'CONTRACT', 'CASE', 'CLAIMPAID')) AND $el_response['type'] == 'complete') {
				
			}
		}
	}
}
?>