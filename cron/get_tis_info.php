<?

require_once '../include/collector.inc.php';
require_once '../include/modules/Accidents.class.php';

/*доступ к ящику*/
$user = 'ukravto.loc\tis';
$pass = 'pqrstis';

/*подключение через imap к ящику (входящие письма)*/
$connect = imap_open('{imap.ukravto.ua:993/imap/ssl/novalidate-cert}INBOX',$user, $pass);

/*если подключение не удачное - посылаем письмо*/
if (!$connect) {
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From: Express group <support@e-insurance.in.ua>' . "\r\n";
    $subject = 'Звіт про імпорт інформації по ТіС. Помилка.';
    $txt='<literal>' . imap_last_error() . '</literal>';
    $emails = array();
    $emails[] = 'm.marchuk@express-group.com.ua';
    $emails[] = 'mail4mike@ukr.net';
    //$emails[] = 'd.petrenko@express-group.com.ua';
    //$emails[] = 'o.gorobets@express-group.com.ua';
    $Templates = Templates::factory($data, 'Mail');
    $Templates->send(implode(', ', $emails), null, $template = null, $subject, $txt, 'Express group', 'support@e-insurance.in.ua', false, $files);
    exit;
}

/*выбираем все письма*/
$mails = imap_search($connect, 'ALL');

/*цикл по письмам с конца, ищем нужное письмо*/
for ($i = sizeof($mails)-1; $i >= 0; $i--) {
    $mail = $mails[$i];

    $header = imap_header($connect, $mail);

    /*если отправитель, хост, дата и тема*/
    if (imap_utf8($header->from[0]->mailbox) == '1c' && imap_utf8($header->from[0]->host) == 'ukravto.ua' && date('d.m.Y', strtotime(imap_utf8($header->MailDate))) == date('d.m.Y') && imap_utf8($header->subject) == 'Отчет по заказ-нарядам') {
        $structure = imap_fetchstructure($connect, $mail);
        /*есть ли в письме файл*/
        if(isset($structure->parts[1]->subtype)) {
            /*получаем контент файла*/
            $attach = imap_fetchbody($connect, $mail, 2);
            $attach = imap_base64($attach);
            /*сохраняем временній файл*/
            $handle = fopen($_SERVER['DOCUMENT_ROOT'] . '/temp/temp.csv', 'w');
            fwrite($handle, $attach);
            fclose($handle);
            /*импортируем данные*/
            $data['mode'] = 2;
            $Accidents = new Accidents($data);
            $Accidents->importAccidentRepairInfo($data);
            /*удаляем временный файл*/
            unlink($_SERVER['DOCUMENT_ROOT'] . '/temp/temp.csv');
            exit;
        }
    }
}

?>