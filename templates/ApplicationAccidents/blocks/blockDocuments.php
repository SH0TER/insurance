<div class="blockDocuments" style="display: <?=($data['id'] ? 'block' : 'none')?>">
	<div class="section">Документи:</div>
	<? include_once 'documents.php'; ?>
	<table width="600" cellpadding="5" cellspacing="0">
		<tr>
			<td width="50%" valign="top">
				<? if ($this->mode == 'update') {?>
				<table>
					<tr>
						<td><b>Інші документи:</b></td>
						<td><a href="javascript: addDocument()"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати документ" /></a></td>
						<td><a href="javascript: addDocument()">додати документ</a></td>
					</tr>
				</table>
				<? } ?>

				<table id="documents" width="100%" cellpadding="5" cellspacing="0">
				<?
					if (is_array($data['document'])) {
						foreach ($data['document'] as $i => $document) {
				?>
				<tr>
					<td><input type="text" name="document[<?=$i?>]" value="<?=$document?>" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> ></td>
					<? if ($this->mode == 'update') {?><td><a onclick="deleteDocument(this)"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td><? } ?>
				</tr>
				<?
						}
					}
				?>
				</table>
			</td>
		</tr>
		</table>
</div>