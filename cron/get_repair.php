<?

require_once '../include/collector.inc.php';

$conditions = array();
$conditions[] = 'accidents.product_types_id = 3';
$conditions[] = 'accident_messages.message_types_id = 5';
$conditions[] = 'accident_messages.statuses_id = 2';
$conditions[] = 'date_format(accident_messages.decision, \'%d.%m.%Y\') = date_format(SUBDATE(NOW(), INTERVAL 1 DAY), \'%d.%m.%Y\')';
//$conditions[] = 'date_format(accident_messages.decision, \'%d.%m.%Y\') = date_format(SUBDATE(\'2013-01-21\', INTERVAL 1 DAY), \'%d.%m.%Y\')';

$sql_messages = 'SELECT accident_messages.accidents_id, accidents.number as accidents_number, CONCAT(policies_kasko_items.brand,\' \',policies_kasko_items.model) as item, policies_kasko_items.sign, policies_kasko_items.shassi, ' .
                'IF (policies_kasko.insurer_person_types_id = 1, CONCAT(policies_kasko.insurer_lastname,\' \',policies_kasko.insurer_firstname,\' \',policies_kasko.insurer_patronymicname), policies_kasko.insurer_company) as insurer, ' .
                'accident_messages.answer as answer_serialize ' .
            'FROM ' . PREFIX . '_accident_messages as accident_messages ' .
            'JOIN ' . PREFIX . '_accidents as accidents ON accident_messages.accidents_id = accidents.id ' .
            'JOIN ' . PREFIX . '_accidents_kasko as accidents_kasko ON accident_messages.accidents_id = accidents_kasko.accidents_id ' .
            'JOIN ' . PREFIX . '_policies_kasko as policies_kasko ON accidents.policies_id = policies_kasko.policies_id ' .
            'JOIN ' . PREFIX . '_policies_kasko_items as policies_kasko_items ON accidents_kasko.items_id = policies_kasko_items.id ' .
            'WHERE ' . implode(' AND ', $conditions);
$messages = $db->getAll($sql_messages);

if(is_array($messages)){
    $repair_problem_count = 0;	
    $content = '<table border=2>';
    $content .= '<tr>';
    $content .= '<td style = "background: #008575;">Номер справи</td>';
    $content .= '<td style = "background: #008575;">Об\'єкт страхування</td>';
    $content .= '<td style = "background: #008575;">Державний номер</td>';
    $content .= '<td style = "background: #008575;">Номер кузова/шасі</td>';
    $content .= '<td style = "background: #008575;">Страхувальник</td>';
    $content .= '<td style = "background: #008575;">Рахунок (фактура/калькуляція), виконавець</td>';
    $content .= '<td style = "background: #008575;">Проблеми ремонту</td>';
    $content .= '<td style = "background: #008575;">Дата проставлення маркера</td>';
    $content .= '</tr>';
    foreach($messages as $message){
        $message['answer'] = unserialize($message['answer_serialize']);
	if($message['answer']['repair_problem'] == 'on'){
        	$content .= '<tr>';
	        $content .= '<td x:str> ' . $message['accidents_number'] . '</td>';
	        $content .= '<td>' . $message['item'] . '</td>';
	        $content .= '<td>' . $message['sign'] . '</td>';
            $content .= '<td>' . $message['shassi'] . '</td>';
        	$content .= '<td>' . $message['insurer'] . '</td>';
	        $content .= '<td>' . $message['answer']['payment_document_number'] . '</td>';
	        $content .= '<td>' . (($message['answer']['repair_problem'] == 'on') ? 'Так' : 'Ні') . '</td>';
            	$content .= '<td>' . date("d.m.Y",time()-(24*60*60)) . '</td>';
	        $content .= '</tr>';
		$repair_problem_count++;
	}
    }
    $content .= '</table>';

    if($repair_problem_count>0){
        $emails = array();
	$emails[] = "m.marchuk@express-group.com.ua";

	$emails[] = "g.sarzhevskaya@ukravto.ua";
	$emails[] = "m.omelyusik@ukravto.ua";
	$emails[] = "a.chalenko@ukravto.ua";
	$emails[] = "v.poddubniy@ukravto.ua";

	$emails[] = "o.zhmur@express-group.com.ua";
	$emails[] = "d.petrenko@express-group.com.ua";
	$emails[] = "i.kvasha@express-group.com.ua";
	$emails[] = "y.burdeiniy@express-group.com.ua";
	
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
	$headers .= 'From: Express group <support@e-insurance.in.ua>' . "\r\n";

	$subject = 'Маркування рахунків';
	$txt='<literal>Добрый день! Высылаем на Вас список промаркированных экспертами калькуляций, по которым на предприятиях отсутствуют отдельные запасные части с целью дальнейшего контроля с Вашей стороны.</literal>';
	$files = array(
        	array(
                	'data'  => $content,
	                'name'  => 'file_' . date("d.m.Y",time()-(24*60*60)) . '.xls'));

	//$Templates->send('m.marchuk@express-group.com.ua, mikemarchuk@gmail.com', null, $template = null, $subject, $txt, 'Express group', 'support@e-insurance.in.ua', false, $files);
	$Templates->send(implode(', ', $emails), null, $template = null, $subject, $txt, 'Express group', 'support@e-insurance.in.ua', false, $files);
	//foreach($emails as $email)
		//$Templates->send($email, null, $template = null, $subject, $txt, 'Express group', 'support@e-insurance.in.ua', false, $files);

    }

}
echo 'done';
?>