<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td class="bullet"><img src="/images/pixel.gif" width="27" height="28" alt="" /></td>
		<td class="caption"><?=$this->getFormTitle($actionType)?>:</td>
	</tr>
	<tr>
		<td></td>
		<td>
			<table width="100%" cellspacing="0" cellpadding="0">
			<tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
			<tr><td colspan="2" class="content"><?=translate('Content')?>:</td></tr>
			<tr>
				<td>
					<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
						<input type="hidden" name="do" value="<?=$this->object.'|'.$action?>" />
						<input type="hidden" name="id" value="<?=$data['id']?>" />
						<input type="hidden" name="redirect" value="index.php?do=Policies|show&product_types_id=<?=PRODUCT_TYPES_DMS?>" />
						<table cellpadding="2" cellspacing="0">
						<? if ($action == 'insert') { ?>
						<tr>
							<td class="label"><?=$this->getMark()?>Дата:</td>
							<td style="width: 100px;"><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('date') ], $data[ 'date_year' ], $data[ 'date_month' ], $data[ 'date_day' ], 'date', $this->getReadonly(true))?></td>
						</tr>
						<? } ?>
						
						<? if ($action == 'update') { ?>
						<tr>
							<td class="label"><?=$this->getMark()?>Статус:</td>
							<td style="width: 100px;">
								<?
									$selectHtml = '<select name="status">';
									$selectHtml .= '<option value="0">...</option>';
									foreach ($this->statuses as $id => $title) {
										$selectHtml .= '<option value="' . $id . '" ' . ($id == $data['status'] ? 'selected' : '') . '>' . $title . '</option>';
									}
									$selectHtml .= '</select>';
									echo $selectHtml;
								?>
							</td>
						</tr>
						<? } ?>
						
						<? if ($action == 'view') { ?>
							<tr>
								<td colspan="2">
									<table cellspacing=0 cellpadding=10>
										<tr class="columns">
											<td>Договір</td>
											<td>Застрахована особа</td>
											<td>Дата страхового випадку</td>
											<td>Сума</td>
										</tr>
										<? foreach($this->calculations as $calculation) { ?>
											<tr>
												<td><?=$calculation['number']?></td>
												<td><?=$calculation['insured']?></td>
												<td><?=$calculation['date']?></td>
												<td><?=$calculation['amount']?></td>
											</tr>
										<? } ?>
									</table>
								</td>
							</tr>
						<? } ?>
						<tr>
							<td width="150">&nbsp;</td>
							<? if ($action != 'view') { ?>
								<td align="center" colspan="3"><input type="submit" value=" <?=translate('Save')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
							<? } else { ?>
								<td align="center" colspan="3"><input onclick="location='index.php?do=Policies|show&product_types_id=<?=PRODUCT_TYPES_DMS?>'" type="button" value=" <?=translate('Back')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
							<? } ?>
						</tr>
						</table>
					</form>
				</td>
			</tr>
			</table>
		</td>
	</tr>
    </table>
</div>
<script type="text/javascript">initFocus(document.<?=$this->objectTitle?>);</script>