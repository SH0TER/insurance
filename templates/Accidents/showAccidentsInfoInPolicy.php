<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet">
                <?
                $bullet = ($_COOKIE['AccidentsInfoInPolicyBlock'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                echo '<a href="javascript: showHideModule(\'AccidentsInfoInPolicyBlock\')"><img src="/images/administration/' . $bullet . '" name="AccidentsInfoInPolicyBlockBullet" alt="" /></a>';
                ?>
            </td>
            <td class="caption"><?=$this->getFormTitle('show')?>:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <?='<div id="AccidentsInfoInPolicyBlock" ' . (($_COOKIE['AccidentsInfoInPolicyBlock'] == 'none') ? 'style="display: none;"' : '') . '>';?>
                <table width="100%" cellpadding="0" cellspacing="0">
                        <tr class="columns">
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
                    <?  foreach($values['accidents'] as $accidents_id => $accident) { $i = 1 - $i;?>
                        <tr class="<?=$this->getRowClass($row, $i)?>">
                        <td rowspan="<?=$accident['calendar_length']?>">&nbsp;<a href="/index.php?do=Accidents|view&product_types_id=3&id=<?=$accident['accidents_id']?>" target="_blank"><?=$accident['accidents_number']?></a></td>
                        <td rowspan="<?=$accident['calendar_length']?>">&nbsp;<?=$accident['policies_number']?></td>
                        <td rowspan="<?=$accident['calendar_length']?>">&nbsp;<?=date('d.m.Y', strtotime($accident['accidents_datetime']))?></td>
                        <td rowspan="<?=$accident['calendar_length']?>">&nbsp;<?=$accident['damage']?></td>
                        <td rowspan="<?=$accident['calendar_length']?>">&nbsp;<?=$accident['compromise_violation']?></td>
                        <td rowspan="<?=$accident['calendar_length']?>">&nbsp;<?=$accident['accident_statuses_title']?></td>
                        <? $act_count=0; foreach($accident['acts'] as $acts_id => $act) { ?>
                            <? if($act_count) { ?><tr><?}?>
                            <td rowspan="<?=sizeof($act['calendar'])?>">&nbsp;<?=$act['number']?></td>
                            <td rowspan="<?=sizeof($act['calendar'])?>">&nbsp;<?=$insurance[$act['insurance']]?></td>
                            <td rowspan="<?=sizeof($act['calendar'])?>">&nbsp;<?=$act['reason_not_payment']?></td>
                            <td rowspan="<?=sizeof($act['calendar'])?>">&nbsp;<?=$act['amount']?></td>
                            <? $calendar_count=0; foreach($act['calendar'] as $calendars_id => $calendar_row) { ?>
                                <? if($calendar_count) { ?><tr><?}?>
                                <td>&nbsp;<?=$calendar_row['recipient']?></td>
                                <td>&nbsp;<?=($calendar_row['payment_statuses_id'] > 1 ? date('d.m.Y', strtotime($calendar_row['payment_date'])) : '')?></td>
                                <td>&nbsp;<?=$calendar_row['amount']?></td>
                                <? if($calendar_count) { ?></tr><?}?>
                                <? $calendar_count++; } ?>
                            <? if($act_count) { ?></tr><?}?>
                            <? $act_count++; } ?>
                        </tr>
                    <? } ?>
                </table>
            </td>
        </tr>
    </table>
</div>