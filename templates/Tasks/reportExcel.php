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
.grey {
	background-color: #CCCCCC;
}
</style>
</head>
<body>
    <table width="600" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <h3>
                    Результати обдзвону на наступний день після планового закінчення ремонту
                </h3>
            </td>
        </tr>
        <tr>
            <td>
                <h3>
                    Всього перераховано (за весь період): <?=$list['year']['total']?> СВ
                </h3>
            </td>
        </tr>
        <tr>
            <td>
                <h3>
                    Період обробки: <?=$data['from']?> - <?=$data['to']?>
                </h3>
            </td>
        </tr>
        <tr>
            <td>
                <h3>
                    Планова кількість дзвінків: <?=$list['week']['total']?>шт. (результативних <?=($list['week']['total'] - $list['week']['no_call_count'])?>шт.)
                </h3>
            </td>
        </tr>
        <tr>
            <td>
                <table border="1" cellspacing="0">
                    <tr>
                        <td width="300">
                            Категорія
                        </td>
                        <td colspan="6" width="300">
                            <table border="1" width="300">
                                <tr>
                                    <td colspan="6" width="300">
                                        Накопичувальний період за:
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2" width="100">
                                        Тиждень
                                    </td>
                                    <td colspan="2" width="100">
                                        Місяць
                                    </td>
                                    <td colspan="2" width="100">
                                        За весь період
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td width="300">
                            Результативних дзвінків згідно план-класу
                        </td>
                        <td colspan="2" width="100">
                            &nbsp;<?=($list['week']['total'] - $list['week']['no_call_count'])?>
                        </td>
                        <td colspan="2" width="100">
                            &nbsp;<?=($list['month']['total'] - $list['month']['no_call_count'])?>
                        </td>
                        <td colspan="2" width="100">
                            &nbsp;<?=($list['year']['total'] - $list['year']['no_call_count'])?>
                        </td>
                    </tr>
                    <tr>
                        <td width="300">
                            I. ТЗ відремонтовано
                        </td>
                        <td width="50">
                            &nbsp;<?=$list['week']['end']['total']?>
                        </td>
                        <td width="50">
                            &nbsp;<?=round($list['week']['end']['total'] / $list['week']['total'] * 100,2)?>
                        </td>
                        <td width="50">
                            &nbsp;<?=$list['month']['end']['total']?>
                        </td>
                        <td width="50">
                            &nbsp;<?=round($list['month']['end']['total'] / $list['month']['total'] * 100,2)?>
                        </td>
                        <td width="50">
                            &nbsp;<?=$list['year']['end']['total']?>
                        </td>
                        <td width="50">
                            &nbsp;<?=round($list['year']['end']['total'] / $list['year']['total'] * 100,2)?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            - з дотриманням терміну план-класу
                        </td>
                        <td>
                            &nbsp;<?=$list['week']['end']['positive']?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['week']['end']['positive'] / $list['week']['end']['total'] * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=$list['month']['end']['positive']?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['month']['end']['positive'] / $list['year']['end']['total'] * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=$list['year']['end']['positive']?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['year']['end']['positive'] / $list['year']['end']['total'] * 100,2)?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            - з порушенням терміну план-класу
                        </td>
                        <td>
                            &nbsp;<?=$list['week']['end']['negative']?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['week']['end']['negative'] / $list['week']['end']['total'] * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=$list['month']['end']['negative']?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['month']['end']['negative'] / $list['year']['end']['total'] * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=$list['year']['end']['negative']?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['year']['end']['negative'] / $list['year']['end']['total'] * 100,2)?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            II. ТЗ в ремонті
                        </td>
                        <td>
                            &nbsp;<?=$list['week']['repair']['total']?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['week']['repair']['total'] / $list['week']['total'] * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=$list['month']['repair']['total']?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['month']['repair']['total'] / $list['month']['total'] * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=$list['year']['repair']['total']?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['year']['repair']['total'] / $list['year']['total'] * 100,2)?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            - з дотриманням терміну план-класу
                        </td>
                        <td>
                            &nbsp;<?=$list['week']['repair']['positive']?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['week']['repair']['positive'] / $list['week']['repair']['total'] * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=$list['month']['repair']['positive']?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['month']['repair']['positive'] / $list['month']['repair']['total'] * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=$list['year']['repair']['positive']?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['year']['repair']['positive'] / $list['year']['repair']['total'] * 100,2)?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            - з порушенням терміну план-класу
                        </td>
                        <td>
                            &nbsp;<?=$list['week']['repair']['negative']?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['week']['repair']['negative'] / $list['week']['repair']['total'] * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=$list['month']['repair']['negative']?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['month']['repair']['negative'] / $list['month']['repair']['total'] * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=$list['year']['repair']['negative']?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['year']['repair']['negative'] / $list['year']['repair']['total'] * 100,2)?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            III. ТЗ не поставлені на ремонт з інінціативи Страхувальника
                        </td>
                        <td>
                            &nbsp;<?=$list['week']['begin'][1]?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['week']['begin'][1] / array_sum($list['week']['begin']) * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=$list['month']['begin'][1]?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['month']['begin'][1] / array_sum($list['month']['begin']) * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=$list['year']['begin'][1]?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['year']['begin'][1] / array_sum($list['year']['begin']) * 100,2)?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            IV. ТЗ не поставлені на ремонт з інінціативи СТО (фактори)
                        </td>
                        <td>
                            &nbsp;<?=(array_sum($list['week']['begin']) - $list['week']['begin'][1])?>
                        </td>
                        <td>
                            &nbsp;<?=round((array_sum($list['week']['begin']) - $list['week']['begin'][1]) / array_sum($list['week']['begin']) * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=(array_sum($list['month']['begin']) - $list['month']['begin'][1])?>
                        </td>
                        <td>
                            &nbsp;<?=round((array_sum($list['month']['begin']) - $list['month']['begin'][1]) / array_sum($list['month']['begin']) * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=(array_sum($list['year']['begin']) - $list['year']['begin'][1])?>
                        </td>
                        <td>
                            &nbsp;<?=round((array_sum($list['year']['begin']) - $list['year']['begin'][1]) / array_sum($list['month']['begin']) * 100,2)?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            - відсутність запасних частин
                        </td>
                        <td>
                            &nbsp;<?=$list['week']['begin'][2]?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['week']['begin'][2] / array_sum($list['week']['begin']) * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=$list['month']['begin'][2]?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['month']['begin'][2] / array_sum($list['month']['begin']) * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=$list['year']['begin'][2]?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['year']['begin'][2] / array_sum($list['year']['begin']) * 100,2)?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            - не виклик клієнта на СТО
                        </td>
                        <td>
                            &nbsp;<?=$list['week']['begin'][3]?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['week']['begin'][3] / array_sum($list['week']['begin']) * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=$list['month']['begin'][3]?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['month']['begin'][3] / array_sum($list['month']['begin']) * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=$list['year']['begin'][3]?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['year']['begin'][3] / array_sum($list['year']['begin']) * 100,2)?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            - завантаженність/черга на СТО
                        </td>
                        <td>
                            &nbsp;<?=$list['week']['begin'][4]?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['week']['begin'][4] / array_sum($list['week']['begin']) * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=$list['month']['begin'][4]?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['month']['begin'][4] / array_sum($list['month']['begin']) * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=$list['year']['begin'][4]?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['year']['begin'][4] / array_sum($list['year']['begin']) * 100,2)?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            - відсутність працівника
                        </td>
                        <td>
                            &nbsp;<?=$list['week']['begin'][5]?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['week']['begin'][5] / array_sum($list['week']['begin']) * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=$list['month']['begin'][5]?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['month']['begin'][5] / array_sum($list['month']['begin']) * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=$list['year']['begin'][5]?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['year']['begin'][5] / array_sum($list['year']['begin']) * 100,2)?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            - інше
                        </td>
                        <td>
                            &nbsp;<?=$list['week']['begin'][6]?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['week']['begin'][6] / array_sum($list['week']['begin']) * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=$list['month']['begin'][6]?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['month']['begin'][6] / array_sum($list['month']['begin']) * 100,2)?>
                        </td>
                        <td>
                            &nbsp;<?=$list['year']['begin'][6]?>
                        </td>
                        <td>
                            &nbsp;<?=round($list['year']['begin'][6] / array_sum($list['year']['begin']) * 100,2)?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>