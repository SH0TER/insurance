<? $Log->showSystem();?>
<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
    <input type="hidden" name="id" value="<?=$data['id']?>" />
	<input type="hidden" name="policies_id" value="<?=$data['policies_id']?>" />
	<input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>" />
    <input type="hidden" name="owner_types_id" value="<?=$data['owner_types_id']?>" />
	<input type="hidden" name="policies_number" value="<?=$data['policies_number']?>" />
	<input type="hidden" name="policies_amount" value="<?=$data['policies_amount']?>" />
	<input type="hidden" name="policy_payments_amount" value="<?=$data['policy_payments_amount']?>" />
	<input type="hidden" name="policies_begin_datetime_format" value="<?=$data['policies_begin_datetime_format']?>" />
	<input type="hidden" name="policies_interrupt_datetime_format" value="<?=$data['policies_interrupt_datetime_format']?>" />
    <? include_once 'Accidents/monitoring.php'?>
    <div id="comments"></div>
	<div class="section">Поліс:</div>
	<b>Поліс:</b> <a href="/?do=Policies|view&id=<?=$data['policies_id']?>&product_types_id=<?=$data['product_types_id']?>" target="_blank"><?=$data['policies_number']?><?if($data['important_person'] == 1){?><b style="color: red;"> VIP</b><?}?></a> &nbsp; &nbsp;
	<b>Термін дії:</b> <?=$data['policies_begin_datetime_format']?> - <?=$data['policies_interrupt_datetime_format']?> &nbsp; &nbsp; 
	<b>Премія:</b> <?=getMoneyFormat($data['policies_amount'])?> &nbsp; &nbsp; <b>Сплачено:</b> <?=($data['policies_amount'] < $data['policy_payments_amount']) ? '<span class="attention">' . getMoneyFormat($data['policy_payments_amount']) . '</span>' : getMoneyFormat($data['policy_payments_amount'])?><br />

	<div class="section">Відповідальні:</div>
    <table width="100%">
        <tr>
            <td>
                    <table cellpadding="0" cellspacing="0">
                               <tr class="columns">
                                   <td width="200">Експертна організація</td>
                                   <td width="150">Призначення</td>
                                   <td width="70">Справи</td>
                                   <td width="70">Задачі</td>
                               </tr>
                               <?
                                   if (sizeOf($data['experts_organizations'])) {
                                       foreach ($data['experts_organizations'] as $expert_organization) {
                                           $i = 1 - $i;
                               ?>
                               <tr class="<?=$this->getRowClass($manager, $i)?>">
                                   <td><?=$expert_organization['title']?></td>
                                   <td align="center"><?='<input type="radio" name="expert_organizations_id" value="' . $expert_organization['id'] . '"' . (($expert_organization['id'] == $data['expert_organizations_id']) ? ' checked' : '') . ' ' . $this->getReadonly(true) . ' />'?></td>
                                   <td align="center"><?=$manager['accidents_investigated']?></td>
                                   <td align="center"><?=$manager['messages_investigated']?></td>
                               </tr>
                               <?
                                       }
                                   }
                               ?>
                    </table>
            </td>
            <td valign="top">
                <table cellpadding="0" cellspacing="0">
                    <tr class="columns">
                        <td width="200">Менеджер</td>
                        <td width="150">Аварійний комісар</td>
                        <td width="150">Експерт</td>
                        <td width="70">Справи</td>
                        <td width="70">Задачі</td>
                    </tr>
                    <?
                        if (sizeOf($data['managers'])) {
                            foreach ($data['managers'] as $manager) {
                                $i = 1 - $i;
                    ?>
                    <tr class="<?=$this->getRowClass($manager, $i)?>">
                        <td><?=$manager['lastname']?> <?=$manager['firstname']?></td>
                        <td align="center"><?=($manager['risk'] == '1') ? '<input type="radio" name="average_managers_id" value="' . $manager['id'] . '"' . (($manager['id'] == $data['average_managers_id']) ? ' checked' : '') . ' ' . $this->getReadonly(true) . ' />' : '&nbsp;'?></td>
                        <td align="center"><?=($manager['estimate'] == '1') ? '<input type="radio" name="estimate_managers_id" value="' . $manager['id'] . '"' . (($manager['id'] == $data['estimate_managers_id']) ? ' checked' : '') . ' ' . $this->getReadonly(true) . ' />' : '&nbsp;'?></td>
                        <td align="center"><?=$manager['accidents_investigated']?></td>
                        <td align="center"><?=$manager['messages_investigated']?></td>
                    </tr>
                    <?
                            }
                        }
                    ?>
                </table>
                <div class="section">Параметри:</div>
                    <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td><?=$this->getMark()?>Орієнтовний збиток, грн.:</td>
                        <td><input type="text" name="amount_rough" value="<?=($data['amount_rough'] > 0) ? $data['amount_rough'] : ''?>" class="fldMoney" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" <?=$this->getReadonly(false, $data['amount_rough'] > 0 && $this->getAccidentStatusesId($data['id']) != 2)?> /></td>
                        <td><?=$this->getMark()?>Категорія:</td>
                        <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('accident_sections_id') ], $data['accident_sections_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
                    </tr>
                    </table>
            </td>

        </tr>
    </table>
</form>
<script type="text/javascript">initFocus(document.<?=$this->objectTitle?>);</script>