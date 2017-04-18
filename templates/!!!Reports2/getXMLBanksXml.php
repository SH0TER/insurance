<?

echo '<?xml version="1.0" encoding="windows-1251"?>';
echo "\n";
echo '<insurance xmlns="http://credit-agricole.com.ua/it/insurance-interaction.xsd">';
echo "\n\t";
    echo '<about>
        <createDate>' . $info['date'] . '</createDate>
        <okpo>' . $info['okpo'] . '</okpo>
    </about>
    <ROWDATA>';
echo "\n";
    foreach($list as $row){
        echo "\t\t";
        echo '<report>
            <region>' . iconv('utf-8', 'cp1251', $row['region']) . '</region>
            <passportSeries>' . iconv('utf-8', 'cp1251', $row['passportSeries']) . '</passportSeries>
            <passportNumber>' . iconv('utf-8', 'cp1251', $row['passportNumber']) . '</passportNumber>
            <insuredID>' . $row['insuredID'] . '</insuredID>
            <insuredFirstName>' . iconv('utf-8', 'cp1251', str_replace("&quot;", "\"",$row['insuredFirstName'])) . '</insuredFirstName>
            <insuredLastName>' . $row['insuredLastName'] . '</insuredLastName>
            <insuredPatronymic>' . $row['insuredPatronymic'] . '</insuredPatronymic>
            <subject>' . iconv('utf-8', 'cp1251', $row['subject']) . '</subject>
            <contractNumber>' . $row['contractNumber'] . '</contractNumber>
            <contractDateStart>' . date('Y-m-d', strtotime($row['contractDateStart'])) . '</contractDateStart>
            <contractDateEnd>' . date('Y-m-d', strtotime($row['contractDateEnd'])) . '</contractDateEnd>
            <premium>' . $row['premium'] . '</premium>
            <premiumPaid>' . $row['premiumPaid'] . '</premiumPaid>
            <premiumPaidDate>' . ((strtotime($row['premiumPaidDate']) > 0) ? date('Y-m-d', strtotime($row['premiumPaidDate'])) : '') . '</premiumPaidDate>
            <type>' . iconv('utf-8', 'cp1251', $row['type']) . '</type>
            <car>' . iconv('utf-8', 'cp1251', $row['car']) . '</car>
            <percentRate>' . $row['percentRate'] . '</percentRate>
            <bankPercentInterest>' . $row['bankPercentInterest'] . '</bankPercentInterest>
            <bankUahInterest>' . $row['bankUahInterest'] . '</bankUahInterest>
            <amount>' . $row['amount'] . '</amount>
        </report>';
        echo "\n";
    }
    echo "\t";
    echo '</ROWDATA>
</insurance>';

?>
