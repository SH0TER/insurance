<? $Log->showSystem();?>
<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
    <input type="hidden" name="id" value="<?=$data['id']?>" />
	<input type="hidden" name="step" value="<?=$data['step']?>" />
	<input type="hidden" name="act_type" value="<?=$data['act_type']?>" />
	<input type="hidden" name="number" value="<?=$data['number']?>" />
	<input type="hidden" name="amount" value="<?=doubleval($data['amount'])?>" />
	<input type="hidden" name="accidents_id" value="<?=$data['accidents_id']?>" />
	<input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>" />
	<input type="hidden" name="policies_price" value="<?=$data['policies_price']?>" />
	<input type="hidden" name="policies_number" value="<?=$data['policies_number']?>" />
	<input type="hidden" name="policies_amount" value="<?=$data['policies_amount']?>" />
	<input type="hidden" name="recipient_types_id" value="<?=$data['recipient_types_id']?>" />
	<input type="hidden" name="policy_payments_amount" value="<?=$data['policy_payments_amount']?>" />
	<input type="hidden" name="policies_begin_datetime_format" value="<?=$data['policies_begin_datetime_format']?>" />
	<input type="hidden" name="policies_interrupt_datetime_format" value="<?=$data['policies_interrupt_datetime_format']?>" />

	<input type="hidden" name="comment" value="<?=$data['comment']?>" />
    <table cellpadding="5" cellspacing="0" width="100%">
	<tr>
		<td>
			<b>Акт:</b> <?=$data['number']?> &nbsp; &nbsp; <b>Поліс:</b> <a href="/?do=Policies|view&id=<?=$data['policies_id']?>&product_types_id=<?=$data['product_types_id']?>" target="_blank"><?=$data['policies_number']?></a> &nbsp; &nbsp; <b>Термін дії:</b> <?=$data['policies_begin_datetime_format']?> - <?=$data['policies_interrupt_datetime_format']?> &nbsp; &nbsp; <b>Премія:</b> <?=getMoneyFormat($data['policies_amount'])?> &nbsp; &nbsp; <b>Сплачено:</b> <?=($data['policies_amount'] < $data['policy_payments_amount']) ? '<span class="attention">' . getMoneyFormat($data['policy_payments_amount']) . '</span>' : getMoneyFormat($data['policy_payments_amount'])?><br /><br />
			<b>Коментар:</b> <?=$data['comment']?>

			<div class="section">Параметри:</div>
			<table cellpadding="5" cellspacing="0">
			</table>

			<div class="section">Додатково:</div>
			<table cellpadding="5" cellspacing="0">
			<? if ($data['act_statuses_id'] == ACCIDENT_STATUSES_APPROVAL || $data['act_statuses_id'] == ACCIDENT_STATUSES_TRANSFER_INSURANCE_COMPANY) { ?>
			<tr>
				<td class="label grey"><?=$this->getMark()?>Дата:</td>
				<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('date') ], $data[ 'date_year' ], $data[ 'date_month' ], $data[ 'date_day' ], 'date', $this->getReadonly(true))?></td>
			</tr>
			<? } ?>
			<tr>
				<td class="label grey"><?=$this->getMark()?>Статус:</td>
				<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('act_statuses_id') ], $data['act_statuses_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
			</tr>
			<? if ($data['insurance'] != 1 && $data['act_statuses_id'] == ACCIDENT_STATUSES_APPROVAL) { ?>
			<tr>
				<td class="label grey">Ознака призупинення:</td>
				<td><input type="checkbox" name="sign_suspended" value="1"></td>
			</tr>
			<? } ?>
			</table>

			<? if ($this->mode == 'update') {?><div align="center"><input type="submit" value=" <?=translate('Save')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></div><? } ?>
		</td>
	</tr>
    </table>
</form>
<script type="text/javascript">initFocus(document.<?=$this->objectTitle?>);</script>