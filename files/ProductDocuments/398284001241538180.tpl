<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Заява на добровільне страхування квартири та відповідальності</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
</head>
<body {if !$values.closed}style="background: url(http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/sample.gif)"{/if}>
<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="center">
		<h1 align="center">ЗАЯВА</h1>
		<h2 align="center">на добровільне страхування квартири та відповідальності</h2><br /><br />
		<p>Прошу укласти договір страхування згідно наведеної нижче інформації.</p>
	</td>
	<td align="right">
		<p>№ {$values.number}</p>
		<p>від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
	</td>
</tr>
</table>
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>1. Заявник</b></td>
	<td class="all">{$values.insurerTitle}</td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td align="center" class="small">прізвище, ім'я, по батькові (назва організації)</td>
</tr>
<tr>
	<td>Адреса:</td>
	<td class="all">{$values.insurer_address}</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%">Ідент. код (код ЄДРПОУ)</td>
	<td width="44%" class="all">{$values.insurer_identification_code}</td>
	<td width="9%" align="center">Тел./факс</td>
	<td class="all">{$values.insurer_phone}</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%">Дата народження:</td>
	<td width="44%" class="all">{$values.insurer_dateofbirth|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
	<td width="9%" align="center">E-mail</td>
	<td class="all">{if $values.insurer_email}{$values.insurer_email}{else}----{/if}</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
	<tr>
		{if $values.insurer_id_card == 1}
		<td width="20%">Дані ID-карти:</td>
		<td>№</td>
		<td class="all">{$values.insurer_newpassport_number}</td>
		<td align="center">від</td>
		<td class="all">{$values.insurer_newpassport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
		<td align="center">дійсний до</td>
		<td class="all">{$values.insurer_newpassport_dateEnd|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
		<td>орган що видав</td>
		<td class="all">{$values.insurer_newpassport_place}</td>
		<td>запис №</td>
		<td class="all">{$values.insurer_newpassport_reestr}</td>
		{else}
		<td width="20%">Паспортні дані:</td>
		<td>серія, №</td>
		<td class="all">{$values.insurer_passport_series} {$values.insurer_passport_number}</td>
		<td align="center">від</td>
		<td class="all">{$values.insurer_passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY}</td>
		<td>виданий</td>
		<td width="50%" class="all">{$values.insurer_passport_place}</td>
		{/if}
	</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>2. Місцезнаходження квартири</b></td>
	<td class="all">{$values.flatAddress}</td>
</tr>
</table>

<h2 align="center">Страхове покриття</h2><br /><br />
<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>3. Страхування майна</b><br /><br />забезпечує відшкодування шкоди, завданої внаслідок втрати, пошкодження або загибелі застрахованого майна внаслідок негативних подій.</td>
	<td>
		<table cellspacing=0 cellpadding=5 width="100%">
		<tr>
			<td width="15%">Опція страхування</td>
			<td class="all">{$values.products_title}</td>
		</tr>
		</table><br />

		{section name="roll" loop=$values.property_sections}
		{if $smarty.section.roll.first}
		<table cellspacing=0 cellpadding=5 width="100%">
		<tr>
			<td width="15%" class="all">Об’єкт страхування</td>
			<td class="top right bottom">Страхові суми/ліміти відповідальності Страховика, грн.</td>
		</tr>
		{/if}
		<tr>
			<td class="right bottom left">{$values.property_sections[roll].title}</td>
			<td class="right bottom">{if $values.property_sections[roll].value > 0}{$values.property_sections[roll].value}{else}----{/if}</td>
		</tr>
		{if $smarty.section.roll.last}</table><br />{/if}
		{/section}

		{section name="roll" loop=$values.risks}
		{if $smarty.section.roll.first}
		<table cellspacing=0 cellpadding=2 width="100%">
		<tr>
			<td width="15%">Страхові ризики</td>
			<td class="all">{$values.risks[roll].title}</td>
			<td class="top right bottom center">{if $values.risks[roll].value > 0}так{else}ні{/if}</td>
		</tr>
		{else}
		<tr>
			<td>&nbsp;</td>
			<td class="right bottom left">{$values.risks[roll].title}</td>
			<td class="right bottom center">{if $values.risks[roll].value > 0}так{else}ні{/if}</td>
		</tr>
		{/if}
		{if $smarty.section.roll.last}</table>{/if}
		{/section}
	</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>4. Страхування цивільної відповідальності перед третіми особами</b><br /><br />передбачає відшкодування шкоди, заподіяної майну фізичної або юридичної особи, внаслідок експлуатації застрахованого майна. Страхування відповідальності поширюється також на представників Страхувальника, що проживають та/або ведуть з ним спільне господарство.</td>
	<td>
		Додатково прошу застрахувати цивільну відповідальність перед третіми особами <b>{if $values.price_other > 0}ТАК{else}НІ{/if}</b><br /><br />
		<table cellspacing=0 cellpadding=10>
			<tr>
				<td>Страхова сума, грн. (непотрібне закреслити):</td>
				<td class="all {if $values.price_other != '10000.00'}u{/if}">10 000.00</td>
				<td class="top right bottom {if $values.price_other != '20000.00'}u{/if}">20 000.00</td>
				<td class="top right bottom {if $values.price_other != '30000.00'}u{/if}">30 000.00</td>
				<td class="top right bottom {if $values.price_other != '60000.00'}u{/if}">60 000.00</td>
			</tr>
		</table>
	</td>
</tr>
</table>

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
    <td width="20%"><b>5. Вигодонабувач</b></td>
	<td>договір страхування прошу укласти на користь Вигодонабувача - <b>{if $values.assured_title}ТАК{else}НІ{/if}</b></td>
</tr>
{if $values.assured_title}
<tr>
	<td>ПІБ (назва), реквізити Вигодонабувача</td>
	<td class="all">{$values.assured_title}</td>
</tr>
<tr>
	<td>Адреса, телефон</td>
	<td class="right bottom left">{$values.assured_address} {$values.assured_phone}</td>
</tr>
{/if}
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%"><b>6. Декларація Заявника</b></td>
	<td class="all">
        1. Заявник гарантує істинність та точність всієї зазначеної ним інформації, а також те, що жодна інформація не була прихована, якщо вона логічно могла вплинути на рішення страхової компанії щодо можливості та обсягу страхування. Подання свідомо неправдивих відомостей про об’єкт страхування є підставою для відмови страхової компанії у виплаті страхового відшкодування.<br /><br />
        2. Прочерк або відсутність відповіді розцінюється страховою компанією як заперечення.<br /><br />
        3. З Правилами ТДВ "Експрес Страхування" "Добровільного страхування майна (крім залізничного, наземного, повітряного, водного транспорту (морського внутрішнього та інших видів водного транспорту), вантажів та багажу (вантажобагажу)", та Правилами ТДВ "Експрес Страхування" "Добровільного страхування відповідальності перед третіми особами (іншої, ніж цивільної відповідальності власників наземного транспорту (включаючи відповідальність перевізника), відповідальності власників повітряного транспорту (включаючи відповідальність перевізника), відповідальність власників водного транспорту (включаючи відповідальність перевізників)" ознайомлений.<br /><br />
		4. Інформація, щодо:
		<ul>
		<li>страхової послуги, вартості цієї послуги для мене;</li>
		<li>умов надання додаткових страхових послуг та їх вартість;</li>
		<li>порядку сплати податків і зборів за мій рахунок в результаті отримання страхової послуги;</li>
		<li>правових наслідків та порядку здійснення розрахунків зі мною внаслідок дострокового припинення Договору страхування;
		<li>механізму захисту Страховиком прав споживачів та порядку урегулювання спірних питань, що виникають у процесі надання послуги зі страхування;</li>
		<li>реквізитів органу, який здійснює державне регулювання ринків фінансових послуг (адреса, номер телефону тощо), а також реквізитів органів з питань захисту прав споживачів;</li>
		<li>розміру винагороди фінансової установи у разі, коли вона пропонує страхові послуги, що надаються іншими фінансовими установами,</li>
		</ul>
		<p>надана мені  до укладання Договору страхування та мені зрозуміла.
	</td>
</tr>
</table><br />

<table cellspacing=0 cellpadding=5 width="100%">
<tr>
	<td width="20%" align="right">Заяву заповнив&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td width="30%" class="bottom">{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.</td>
	<td width="7%" align="center">&nbsp;/&nbsp;</td>
	<td width="10%" class="bottom">&nbsp;</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td width="20%"  >&nbsp;</td>
</tr>
<tr><td colspan="5">&nbsp;</td></tr>
<tr>
	<td align="right">Заяву прийняв&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td class="bottom">{$values.agent_lastname} {$values.agent_firstname|truncate:2:'':true}. {if $values.agent_patronymicname}{$values.agent_patronymicname|truncate:2:'':true}.{/if}</td>
	<td align="center">&nbsp;/&nbsp;</td>
	<td class="bottom">&nbsp;</td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td  >&nbsp;</td>
</tr>
</table>
</body>
</html>