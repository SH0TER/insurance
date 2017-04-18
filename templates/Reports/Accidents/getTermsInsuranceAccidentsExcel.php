<html>
<head>
	<meta http-equiv=Content-Type content="text/html; charset=utf-8">
	<meta name=ProgId content=Excel.Sheet>
<style>
* {
	font-size: 11px;
	font-family: Tahoma, Verdana, Arial, Geneva, Helvetica, sans-serif;
}
.columns TD {
	/*height: 25px;*/
	color: #FFFFFF;
	padding-left: 4px;
	font-weight: bold;
	border-right: 1px solid #4F5D75;
	border-top: 1px solid #4F5D75;
	border-bottom: 1px solid #4F5D75;
	background-color: #008575;
	text-align: center;
	vertical-align: middle;
}
.grey {
	background-color: #CCCCCC;
}
</style>
</head>
<body>
    <table width="600" cellpadding="0" cellspacing="0" border="1">        
		<tr>
			<td><b>Реєстрація</b></td>
			<td><i>Дата заяви - Дата передачі матеріалів справи АК</i></td>
			<td>
				<?=$values['investigated_created']['investigated_count']?> шт.
				(<?=intval(roundNumber($values['investigated_created']['investigated_term'] / $values['investigated_created']['investigated_count'] / 24 / 60 / 60, 2))?> дн. 
				<?=roundNumber((roundNumber($values['investigated_created']['investigated_term'] / $values['investigated_created']['investigated_count'], 2) - intval(roundNumber($values['investigated_created']['investigated_term'] / $values['investigated_created']['investigated_count'], 2))) * 24, 0)?> год.)
			</td>
		</tr>
		<tr>
			<td><b>Врегулювання</b></td>
			<td><i>Дата отримання матеріалів справи АК - Дата створення СА АК</i></td>
			<td>
				<?=$values['created_acts']['created_acts_count']?> шт.
				(<?=intval(roundNumber($values['created_acts']['created_acts_term'] / $values['created_acts']['created_acts_count'] / 24 / 60 / 60, 2))?> дн. 
				<?=roundNumber((roundNumber($values['created_acts']['created_acts_term'] / $values['created_acts']['created_acts_count'], 2) - intval(roundNumber($values['created_acts']['created_acts_term'] / $values['created_acts']['created_acts_count'], 2))) * 24, 0)?> год.)
			</td>
		</tr>
		<tr>
			<td><b>Узгодження</b></td>
			<td><i>Дата створення СА АК - Дата затвердження СА</i></td>
			<td>
				<?=$values['approval']['approval_count']?> шт.
				(<?=intval(roundNumber($values['approval']['approval_acts_term'] / $values['approval']['approval_count'] / 24 / 60 / 60, 2))?> дн. 
				<?=roundNumber((roundNumber($values['approval']['approval_acts_term'] / $values['approval']['approval_count'], 2) - intval(roundNumber($values['approval']['approval_acts_term'] / $values['approval']['approval_count'], 2))) * 24, 0)?> год.)
			</td>
		</tr>
		<tr>
			<td><b>Сплата СВ</b></td>
			<td><i>Дата затвердження СА - Дата виплати</i></td>
			<td>
				<?=$values['payment']['payment_count']?> шт.
				(<?=intval(roundNumber($values['payment']['payment_approval_term'] / $values['payment']['payment_count'] / 24 / 60 / 60, 2))?> дн. 
				<?=roundNumber((roundNumber($values['payment']['payment_approval_term'] / $values['payment']['payment_count'], 2) - intval(roundNumber($values['payment']['payment_approval_term'] / $values['payment']['payment_count'], 2))) * 24, 0)?> год.)
			</td>
		</tr>
		<tr>
			<td rowspan="3"><b>Термін врегулювання справи</b></td>
			<td><i>Дата заяви - Дата створення СА АК</i></td>
			<td>
				<?=$values['created_acts_all']['created_acts_all_count']?> шт.
				(<?=intval(roundNumber($values['created_acts_all']['created_acts_term_all'] / $values['created_acts_all']['created_acts_all_count'] / 24 / 60 / 60, 2))?> дн.
				<?=roundNumber((roundNumber($values['created_acts_all']['created_acts_term_all'] / $values['created_acts_all']['created_acts_all_count'], 2) - intval(roundNumber($values['created_acts_all']['created_acts_term_all'] / $values['created_acts_all']['created_acts_all_count'], 2))) * 24, 0)?> год.)
			</td>
		</tr>
        <tr>
            <td><i>Дата заяви - Дата затвердження СА</i></td>
            <td>
                <?=$values['approval']['approval_count']?> шт.
                (<?=intval(roundNumber($values['approval']['approval_created_term'] / $values['approval']['approval_count'] / 24 / 60 / 60, 2))?> дн.
                <?=roundNumber((roundNumber($values['approval']['approval_created_term'] / $values['approval']['approval_count'], 2) - intval(roundNumber($values['approval']['approval_created_term'] / $values['approval']['approval_count'], 2))) * 24, 0)?> год.)
            </td>
        </tr>
		<tr>
			<td><i>Дата заяви - Дата виплати</i></td>
			<td>
				<?=$values['payment']['payment_count']?> шт.
				(<?=intval(roundNumber($values['payment']['payment_created_term'] / $values['payment']['payment_count'] / 24 / 60 / 60, 2))?> дн. 
				<?=roundNumber((roundNumber($values['payment']['payment_created_term'] / $values['payment']['payment_count'], 2) - intval(roundNumber($values['payment']['payment_created_term'] / $values['payment']['payment_count'], 2))) * 24, 0)?> год.)
			</td>
		</tr>
    </table>
</body>
</html>