 
<html xmlns:o="urn:schemas-microsoft-com:office:office"
      xmlns:x="urn:schemas-microsoft-com:office:excel"
      xmlns="http://www.w3.org/TR/REC-html40">

    <head>
        <meta http-equiv=Content-Type content="text/html; charset=utf-8">
        <meta name=ProgId content=Excel.Sheet>
        <style>
            * {
                font-size: 11px;
                font-family: Tahoma, Verdana, Arial, Geneva, Helvetica, sans-serif;
            }
            .columns TD {
                height: 25px;
                color: #FFFFFF;
                padding-left: 4px;
                font-weight: bold;
                border-right: 1px solid #4F5D75;
                border-top: 1px solid #4F5D75;
                border-bottom: 1px solid #4F5D75;
                background-color: #008575;
            }
        </style>
    </head>
    <body>
        <table border="1" cellpadding=0 cellspacing=0>
            <tr class="columns">
                <td>Полис</td>
				<td>Страхувальник</td>
				<td>Агенция</td>
				<td>Продукт</td>
				<td>Пролонгация</td>
				<td>Котировка</td>
				<td>Номер ЭК</td>
				<td>Вигодонабувач</td>
				<td>Тариф, %</td>
                <td>Платеж, грн</td>
                <td>Страх сума, грн</td>
                <td>Сума кредиту, грн</td>
                <td>Знижка для банкiв</td>
                <td>Компенсацiя банка</td>
                <td>РКО грн</td>
                <td>Комісія, грн</td>
                <td>Редаговано</td>
				<td>Коментар андерайтера</td>
                <td>Рік страхування</td>
            </tr>
			<?
			$db = $GLOBALS['db'];
			?>
			<? foreach ($list as $row) {?>
            <tr>
                <td><?=$row['number']?></td>
				<td><?=$row['insurer']?></td>
				<td><?=$row['agency_title']?></td>
				<td><?=$row['product_title']?></td>
				<td><?=($row['prolongation'] ? 'Так' :  'Нi') ?></td>
				<td><?=($row['quote']==2 ? 'Так' :  'Нi') ?></td>
				<td><?=$row['ek_number']?></td>
				<td><?=$row['assured_title']?></td>
				
				<td><?=str_replace('.',',',$row['rate'])?></td>
                <td><?=str_replace('.',',',$row['payment_amount'])?></td>
                <td><?=str_replace('.',',',$row['insurance_amount'])?></td>
                <td><?=str_replace('.',',',$row['credit_amount'])?></td>
                <td><?=str_replace('.',',',$row['bank_discount_value'])?></td>
                <td><?=str_replace('.',',',$row['bank_commission_value'])?></td>
				<td><?=str_replace('.',',',$row['bank_rko_insurance_amount'])?></td>

				
				<td><?=str_replace('.',',',$row['commission_amount'])?></td>
 
                <td><?=$row['modified_format']?></td>
				<td>
				<?
				$s = ' select comment_quote from insurance_bank_akts_contents a join  insurance_policies_kasko b on b.policies_id=a.policies_id where a.id='.$row['id'];
				echo $db->getOne($s);
				?>
				</td>
                <td>
                <?
                    $sql = 'SELECT number_insurance_year FROM insurance_policy_payments_calendar a '.
                        'JOIN insurance_bank_akts_contents b on a.id = b.payments_calendar_id '.
                        'WHERE b.id = '.$row['id'];
                    echo $db->getOne($sql);
                ?>
                </td>
            </tr>
            <?}?>
        </table>
    </body>
</html>