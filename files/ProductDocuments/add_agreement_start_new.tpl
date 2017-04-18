<table cellspacing=0 cellpadding=0 width="100%">
<tr>
	<td width="227"><img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/logo.gif" width="227" height="105" /></td>
	<td align="center">
 		<h1>Додаткова угода № {$values.sub_number} <br>
		до договору страхування	{$values.original.number}
		   від {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</h1>
	</td>
	<td width="220" align="center">
		<br> 
	</td>
</tr>
<tr>
	<td align="left" >
	м. Київ                                                                                                        
	</td>
    <td align="right" colspan="2">
		<p>{$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</p>
	</td>
</tr>
</table><br />

ТДВ «Експрес Страхування», в особі 

{if $values.agencies_id==560 || $values.agencies_id==1486}
{if $values.agencies_id==560}
  ФО-П Турчини Надії Миколаївни , яка діє на підставі Довіреності №10/АС від 23.11.2012р. та Договору доручення №10/АС від 23.11.2012р. (далі - Страховик) відповідно до Закону України «Про страхування», ліцензії серія АВ №429899 від 04.11.2008 р. та Правил ТДВ «Експрес Страхування» добровільного страхування майна (крім залізничного, наземного, повітряного, водного транспорту (морського внутрішнього та інших видів водного транспорту), вантажів та багажу (вантажобагажу) та додатків до них, зареєстрованих  Державною комісією з регулювання ринків фінансових послуг України 23 жовтня 2008 р. (далі - Правила)
{/if}
{if $values.agencies_id==1486}
  ФО-П Турчина Максима Костянтиновича , який діє на підставі Довіреності № 137/Д от 10.07.2014 р. та Договору доручення №4/АС от 10.07.2014 р. (далі - Страховик) відповідно до Закону України «Про страхування», ліцензії серія АВ №429899 від 04.11.2008 р. та Правил ТДВ «Експрес Страхування» добровільного страхування майна (крім залізничного, наземного, повітряного, водного транспорту (морського внутрішнього та інших видів водного транспорту), вантажів та багажу (вантажобагажу) та додатків до них, зареєстрованих  Державною комісією з регулювання ринків фінансових послуг України 23 жовтня 2008 р. (далі - Правила)
{/if}

{elseif ($values.agencies_id == 1469 && $values.seller_agencies_id == 0) || $values.agencies_id == 1496 || $values.agencies_id == 1497 || $values.agencies_id == 1498}
{$values.director2}, що діє на підставі {$values.ground_kasko}
{else} 
  {$values.director2} та {$values.findirector2}, що діють на підставі {$values.ground_kasko}


{/if}

(далі - Страховик), з однієї Сторони та
 {$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}, (далі – Страхувальник) 
 з другої Сторони (далі разом – Сторони), уклали цю додаткову угоду № {$values.sub_number} (далі - «Додаткова угода»)
 до  договору   страхування наземних транспортних засобів № {$values.original.number} від {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. р. (далі – «Договір страхування») про наступне:
<br><br>
<p style="font-size: 14px">1. <b>Викласти частину А Договору страхування в редакції Додатку 1 до цієї Додаткової угоди.</b>																								
<br><br>																									
<p style="font-size: 14px">2. <b>Викласти частину Б Договору страхування в редакції Додатку 2 до цієї Додаткової угоди.	</b>																								
<br><br>																									
<p style="font-size: 14px">3. Ця Додаткова Угода є невід’ємною частиною Договору страхування та набуває чинності з моменту її підписання Сторонами, але не раніше 00 год. 00 хв. дати, наступної за датою надходження страхового платежу за відповідний період дії Договору страхування на поточний рахунок Страховика в повному обсязі.																									
<br><br>																									
<p style="font-size: 14px">4. Інші умови Договору страхування залишаються без змін.																									
<br><br>																									
<p style="font-size: 14px">5.  Дана Додаткова угода складена в {if $values.financial_institutions_id == 46  || $values.financial_institutions_id == 15 || ($values.financial_institutions_id == 19 && $values.parent_id>0)}3{else}2{/if}-х примірниках, які мають однакову юридичну силу, по одному примірнику для кожної із Сторін.</p>
<br><br>
<table cellpadding="2" cellspacing="4" width="100%">
<tr>
	<td {if $values.financial_institutions_id == 46 || $values.financial_institutions_id == 15 || ($values.financial_institutions_id == 19 && $values.parent_id>0)}width="33%" {else} width="48%" {/if} align="center"><b>СТРАХОВИК</b></td>
	<td {if $values.financial_institutions_id == 46 || $values.financial_institutions_id == 15 || ($values.financial_institutions_id == 19 && $values.parent_id>0)}width="33%" {else} width="48%" {/if} align="center"><b>СТРАХУВАЛЬНИК</b></td>
	{if $values.financial_institutions_id == 46 || $values.financial_institutions_id == 15 || ($values.financial_institutions_id == 19 && $values.parent_id>0)}
	<td width="33%" align="center"><b>ВИГОДОНАБУВАЧ</b></td>
	{/if}
</tr>
<tr>
	<td>М.П.</td>
	<td align="center"><b>З Правилами ознайомлений, з умовами Договору ознайомлений та згодний.</b></td>
	{if $values.financial_institutions_id == 46  || $values.financial_institutions_id == 15 || ($values.financial_institutions_id == 19 && $values.parent_id>0)}
	<td>М.П.</td>
	{/if}
</tr>
<tr>
	<td height="30">{if $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou}{$values.director1}{else}Директор Щучьєва Т.А. {/if}</td>
	<td height="30">{if $values.insurer_position}{$values.insurer_position} {$values.insurer_company} {/if}{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.</td>
	{if $values.financial_institutions_id == 46  || $values.financial_institutions_id == 15 || ($values.financial_institutions_id == 19 && $values.parent_id>0)}
	<td>&nbsp;</td>
	{/if}
</tr>
<tr>
	<td class="top center">(П.І.Б., підпис)</td>
	<td class="top center">(П.І.Б., підпис)</td>
	{if $values.financial_institutions_id == 46  || $values.financial_institutions_id == 15 || ($values.financial_institutions_id == 19 && $values.parent_id>0)}
	<td class="top center">(П.І.Б., підпис)</td>
	{/if}
</tr>
<tr>
	<td height="30">{if $values.ground_kasko && $values.agencies_edrpou != $values.insurer_edrpou}{$values.findirector1}{else}Директор Щучьєва Т.А. {/if}</td>
	<td>&nbsp;</td>
	{if $values.financial_institutions_id == 46  || $values.financial_institutions_id == 15 || ($values.financial_institutions_id == 19 && $values.parent_id>0)}
	<td>&nbsp;</td>
	{/if}
</tr>
<tr>
	<td class="top center">(П.І.Б., підпис)</td>
	<td></td>
	{if $values.financial_institutions_id == 46  || $values.financial_institutions_id == 15 || ($values.financial_institutions_id == 19 && $values.parent_id>0)}
	<td></td>
	{/if}
</tr>
</table><br />
<div style="page-break-after: always"></div>