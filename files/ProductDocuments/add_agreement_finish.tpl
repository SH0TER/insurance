{if $values.agreement_types_id!=3}
<br><br><br> 
 

<p style="font-size: 13px">2.	Ця Додаткова Угода є невід’ємною частиною Договору страхування № {$values.original.number} від {$values.original.date|date_format:$smarty.const.DATE_FORMAT_SMARTY} р. і набуває чинності з моменту її підписання Сторонами.
<p style="font-size: 13px">3.	Додаткова Угода  складена  на 2 аркушах у {if $values.financial_institutions_id == 11 || $values.financial_institutions_id == 15}3 (трьох) {else}двох{/if} примірниках  по одному – для кожної із Сторін.
{if $values.agreement_types_id!=2 && $values.agreement_types_id!=4}
<p style="font-size: 13px">4.	Сума страхового платежу, що підлягає доплаті складає {$values.amount|moneyformat:1} грн. Доплата здійснюється на рахунок Страховика, зазначений у цій Додатковій угоді до {$values.begin_datetime_add_agreement|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. 
{/if}


{/if}