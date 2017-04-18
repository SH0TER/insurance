<style type="text/css">
    .header td {
        font-weight: bold;
        font-size: 18px;
        font-style: italic;
        padding-right: 100px;
    }

    .titleBlock {
        font-style: italic;
        font-weight: bold;
        text-decoration: underline;
    }
</style>

<table class="header">
    <tr>
        <td>Лист узгодження рішення по справі</td>
        <td>Справа № <?=$values['accidents_number']?></td>
        <td>Класифікація справи: <?=$accident_sections_titles[ $values['accident_sections_id'] ]?></td>
    </tr>
</table>
<br/>

<table width="100%" border="1">
    <tr>
        <td width="30%" style="vertical-align: top; border: solid;" >
            <table width="100%" border="0">
                <tr>
                    <td colspan="2" style="text-align: center;">Дані умов договору страхування</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;"><?=$values['policies_number']?> від <?=date('d.m.Y', strtotime($values['policies_date']))?></td>
                </tr>
                <tr>
                    <td width="30%">Строк дії</td>
                    <td><?=date('d.m.Y', strtotime($values['policies_begin_date']))?> по <?=date('d.m.Y', strtotime($values['policies_end_date']))?></td>
                </tr>
                <tr>
                    <td width="30%">Страхувальник</td>
                    <td><?=$values['insurer']?></td>
                </tr>
                <tr>
                    <td width="30%">Вигодонабувач</td>
                    <td><?=$values['assured_title']?></td>
                </tr>
                <tr>
                    <td width="30%">Об'єкт страхування</td>
                    <td><?=$values['item']?></td>
                </tr>
                <tr>
                    <td width="30%">Д.Р.З / VIN</td>
                    <td><?=$values['sign']?> / <?=$values['shassi']?></td>
                </tr>
                <tr>
                    <td width="30%">Територія покриття</td>
                    <td><?=$zones_id_titles[ $values['zones_id'] ]?></td>
                </tr>
            </table>
        </td>
        <td width="30%" style="vertical-align: top; border: solid;">
            <table width="100%" border="0">
                <tr>
                    <td colspan="3" style="text-align: center;"><?=$values['products_title']?></td>
                </tr>
                <tr>
                    <td width="30%">Статус страхувальника</td>
                    <td colspan="2"><?=$insurer_status_titles[ $values['insurer_status_id'] ]?></td>
                </tr>
                <tr>
                    <td>Страхова сума</td>
                    <td><?=$values['insurance_price']?></td>
                    <td><?=$insurance_price_type[ $values['options_agregate_no'] ]?></td>
                </tr>
                <tr>
                    <td>Ринкова вартість</td>
                    <td colspan="2"><?=$values['market_price']?></td>
                </tr>
                <tr>
                    <td>Страхова сума ДО</td>
                    <td colspan="2"><?=$values['amount_equipment']?></td>
                </tr>
            </table>
        </td>
        <td style="vertical-align: top; border: solid;">
            <table width="100%" border="0">
                <tr>
                    <td colspan="5" style="text-align: center;">Історія страхування</td>
                </tr>
                <tr>
                    <td>Договір страхування</td>
                    <td>Дата договору страхування</td>
                    <td>Дата</td>
                    <td>Страхова премія</td>
                    <td>Сплачена страхова премія</td>
                </tr>
                <? foreach($values['policies'] as $policy) { ?>
                    <tr>
                        <td><a target="_blank" href="/index.php?do=Policies|view&product_types_id=<?=PRODUCT_TYPES_KASKO?>&id=<?=$policy['policies_id']?>"><?=$policy['policies_number']?></a></td>
                        <td><?=date('d.m.Y', strtotime($policy['policies_date']))?></td>
                        <td><?=date('d.m.Y', strtotime($policy['calendar_date']))?></td>
                        <td><?=$policy['calendar_amount']?></td>
                        <td><?=$policy['payed_amount']?></td>
                    </tr>
                <? } ?>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan="3" style="border: solid;">
            <table cellpadding="10">
                <tr>
                    <td class="titleBlock">Додаткові опції ДС</td>
                    <td style="border: solid 2px;">без франшизи на вітрові стекла: <?=(intval($values['options_deductible_glass_no']) ? 'ТАК' : 'ні')?></td>
                    <td style="border: solid 2px;">без врахування зносу: <?=(intval($values['options_deterioration_no']) ? 'ТАК' : 'ні')?></td>
                    <td style="border: solid 2px;">неагрегатна страхова сума: <?=(intval($values['options_agregate_no']) ? 'ТАК' : 'ні')?></td>
                    <td style="border: solid 2px;">50 на 50: <?=(intval($values['options_fifty_fifty']) ? 'ТАК' : 'ні')?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<table width="100%" border="1">
    <tr>
        <td width="80%">
            <table width="100%" cellpadding="10">
                <tr>
                    <td style="background-color: #fffacd; font-weight: bold; font-style: italic;" nowrap>Дані стосовно події</td>
                    <td nowrap>Дата події</td>
                    <td style="font-weight: bold;"><?=date('d.m.Y', strtotime($values['accidents_datetime']))?></td>
                    <td nowrap>час</td>
                    <td style="font-weight: bold;"><?=date('H.s', strtotime($values['accidents_datetime']))?></td>
                    <td nowrap>Місце події</td>
                    <td style="font-weight: bold;"><?=$values['accidents_address']?></td>
                </tr>
                <tr>
                    <td style="font-style: italic; font-weight: bold; text-decoration: underline;">Обставини події</td>
                    <td colspan="6" style="font-style: italic; font-weight: bold;"><?=$values['description_average']?></td>
                </tr>
                <tr>
                    <td style="font-style: italic; font-weight: bold; text-decoration: underline;">Опис пошкоджень:</td>
                    <td colspan="6" style="font-style: italic; font-weight: bold;"><?=$values['damage']?></td>
                </tr>
                <tr>
                    <td>Ризик:</td>
                    <td style="background-color: #fffacd; font-weight: bold; text-align: center;"><?=$values['application_risks_title']?></td>
                    <td>Франшиза</td>
                    <td colspan="2" style="font-weight: bold;"><?=$values['deductible_percent']?> %  =  <?=roundNumber($values['insurance_price'] * $values['deductible_percent'] / 100, 2)?> грн.</td>
                    <td>Орієнтовний збиток</td>
                    <td style="background-color: #fffacd; font-weight: bold; text-align: center;"><?=$values['amount_rough']?></td>
                </tr>
                <tr>
                    <td colspan="7" style="font-style: italic; font-weight: bold; text-decoration: underline;">Перевірка виконання умов договору страхування:</td>
                </tr>
                <tr>
                    <td>Повідомлення в ГЛ ЕС</td>
                    <td style="background-color: #fffacd; font-weight: bold; text-align: center;"><?=$assistance[ $values['assistance'] ]?></td>
                    <td>Письмове повідомлення</td>
                    <td style="background-color: #fffacd; font-weight: bold; text-align: center;"><?=$written_sign[ $values['written_sign'] ]?></td>
                    <td>Компетентні органи</td>
                    <td style="background-color: #fffacd; font-weight: bold; text-align: center;"><?=$mvs_sign[ $values['mvs_sign'] ]?></td>
                </tr>
            </table>
            <table width="100%">
                <tr>
                    <td colspan="7">Інші страхові випадки<?=(sizeof($values['accidents']) ? '' : ' - відсутні')?></td>
                </tr>
                <? if (sizeof($values['accidents'])) { ?>
                <tr>
                    <td>Справа</td>
                    <td>Договір</td>
                    <td>Дата події</td>
                    <td>Пошкодження</td>
                    <td>Компроміс</td>
                    <td>Статус</td>
                    <td>Номер акту</td>
                    <td>Рішення</td>
                    <td>Причина</td>
                    <td>Сума</td>
                    <td>Отримувач</td>
                    <td>Дата</td>
                    <td>Сума</td>
                </tr>
                <? } ?>
                <?  foreach($values['accidents'] as $accidents_id => $accident) { ?>
                    <tr>
                        <td rowspan="<?=$accident['calendar_length']?>"><a target="_blank" href="/index.php?do=Accidents|view&product_types_id=<?=PRODUCT_TYPES_KASKO?>&id=<?=$accident['accidents_id']?>"><?=$accident['accidents_number']?></a></td>
                        <td rowspan="<?=$accident['calendar_length']?>"><?=$accident['policies_number']?></td>
                        <td rowspan="<?=$accident['calendar_length']?>"><?=date('d.m.Y', strtotime($accident['accidents_datetime']))?></td>
                        <td rowspan="<?=$accident['calendar_length']?>"><?=$accident['damage']?></td>
                        <td rowspan="<?=$accident['calendar_length']?>"><?=$accident['compromise_violation']?></td>
                        <td rowspan="<?=$accident['calendar_length']?>"><?=$accident['accident_statuses_title']?></td>
                        <? $act_count=0; foreach($accident['acts'] as $acts_id => $act) { ?>
                            <? if($act_count) { ?><tr><?}?>
                            <td rowspan="<?=sizeof($act['calendar'])?>"><?=$act['number']?></td>
                            <td rowspan="<?=sizeof($act['calendar'])?>"><?=$insurance[$act['insurance']]?></td>
                            <td rowspan="<?=sizeof($act['calendar'])?>"><?=$act['reason_not_payment']?></td>
                            <td rowspan="<?=sizeof($act['calendar'])?>"><?=$act['amount']?></td>
                            <? $calendar_count=0; foreach($act['calendar'] as $calendars_id => $calendar_row) { ?>
                                <? if($calendar_count) { ?><tr><?}?>
                                <td><?=$calendar_row['recipient']?></td>
                                <td><?=date('d.m.Y', strtotime($calendar_row['payment_date']))?></td>
                                <td><?=$calendar_row['amount']?></td>
                                <? if($calendar_count) { ?></tr><?}?>
                            <? $calendar_count++; } ?>
                            <? if($act_count) { ?></tr><?}?>
                        <? $act_count++; } ?>
                    </tr>
                <? } ?>
            </table>
        </td>
        <td style="vertical-align: top;">
            <table>
                <? foreach($values['history'] as $row) { ?>
                    <tr>
                        <td width="20%"><?=date('d.m.Y', strtotime($row['created']))?></td>
                        <td><?=$row['description']?> <?=($row['accident_statuses_id'] == 1 ? $values['car_services_title'] : '')?></td>
                    </tr>
                <? } ?>
            </table>
            <table>
                <tr><td>Аварійний комісар</td><td><?=$values['average_manager_name']?></td></tr>
                <tr><td>Експерт</td><td><?=$values['estimate_manager_name']?></td></tr>
            </table>
        </td>
    </tr>
</table><br/>

<table cellpadding="10">
    <tr>
        <td colspan="2" style="font-weight: bold; font-style: italic; text-decoration: underline;">РОЗМІР СТРАХОВОГО ВІДШКОДУВАННЯ</td>
        <td colspan="2">Страхова сума на дату події</td>
        <td colspan="2"><?=roundNumber($values['insurance_price'] - $values['previous_accidents_amount'], 2)?></td>
    </tr>
    <?
        $main_message = current($values['messages']);
    ?>
    <tr>
        <td>Ринкова вартість на дату події</td>
        <td>&nbsp;<b><?=$values['messages'][0]['market_price']?></b></td>
        <td>Коефіцієнт проп Кп</td>
        <td>&nbsp;<?=($values['messages'][0]['market_price'] > 0 ? roundNumber(($values['insurance_price'] - $values['previous_accidents_amount']) / $values['messages'][0]['market_price'], 2) : '')?></td>
        <td>Коефіцієнт фіз знос Ез</td>
        <td>&nbsp;<?=$values['messages'][0]['deterioration_value']?></td>
    </tr>
</table><br/>

<table width="30%">
    <? for ($i=1; $i<=3; $i++) { ?>
        <tr>
            <td width="10%"><?=$values['messages'][$i]['title']?></td>
            <td width="5%">Сс = <?=$values['messages'][$i]['data']['answer']['amount_details']?></td>
            <td width="5%">См = <?=$values['messages'][$i]['data']['answer']['amount_material']?></td>
            <td width="5%">Ср = <?=$values['messages'][$i]['data']['answer']['amount_work']?></td>
            <td width="5%">Свр = <?=$values['messages'][$i]['data']['answer']['amount_details'] * (1 - $values['messages'][$i]['data']['answer']['deterioration_value']) + $values['messages'][$i]['data']['answer']['amount_material'] + $values['messages'][$i]['data']['answer']['amount_work']?></td>
        </tr>
    <? } ?>
</table>

<table>
    <tr>
        <td>Порядок виплати страхового відшкодування - <?=$result_calculation_car_services_title?></td>
    </tr>
</table>