            </td>
		</tr>
		</table><br />
	</td>
</tr>
</table>
<script type="text/javascript">
	function back() {
		changeLocation(document.path, '<?=sizeOf($_SESSION['auth']['path']) - 2?>');
	}

	function next(btn) {
		<? if (intval($data['id']) && $_REQUEST['do'] != $this->object . '|view') { ?>
		if (document.PolicyMessagesBrief) {
			setCookie('message[policies_id]', document.PolicyMessagesBrief.policies_id.value);
			setCookie('message[subject]', document.PolicyMessagesBrief.subject.value);
			setCookie('message[text]', document.PolicyMessagesBrief.text.value);
		}
		<? } ?>

		if (document.<?=$form?>.onsubmit!=null) {
			if (!document.<?=$form?>.onsubmit())
				return;
		}
		$(btn).attr('disabled', true);
		eval('document.<?=$form?>.submit()');
	}
</script>
<div align="center">
	<?
		if (!intval($data['child_id']) || $data['product_types_id'] == PRODUCT_TYPES_GO) {
			switch ($data['product_types_id']) {
				case PRODUCT_TYPES_GO:
				case PRODUCT_TYPES_KASKO:
				case PRODUCT_TYPES_PROPERTY:
				case PRODUCT_TYPES_DMS:
				case PRODUCT_TYPES_DGO:
					if ($this->mode == 'view') {
						if ($data['product_types_id'] == PRODUCT_TYPES_GO && $data['policy_statuses_id'] != POLICY_STATUSES_CANCELLED && $data['policy_statuses_id'] != POLICY_STATUSES_CREATED && $data['payment_statuses_id'] == PAYMENT_STATUSES_NOT) {
							if (($_SESSION['auth']['roles_id']==ROLES_AGENT && ($_SESSION['auth']['agencies_id']==SELLER_AGENCIES_ID || $_SESSION['auth']['agencies_id']==$data['agencies_id'])) || $_SESSION['auth']['roles_id']!=ROLES_AGENT)
							echo '<input type="button" value="Зіпсувати" onclick="spoilPolicy()" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" class="button" />';
						}
                        if (/*$data['product_types_id'] != PRODUCT_TYPES_KASKO && */
							($data['policy_statuses_id']==POLICY_STATUSES_GENERATED || $data['policy_statuses_id']==POLICY_STATUSES_CONTINUED || $data['policy_statuses_id']==POLICY_STATUSES_RENEW)
                            && ($_SESSION['auth']['roles_id']==ROLES_ADMINISTRATOR ||  ($_SESSION['auth']['roles_id']==ROLES_MANAGER && $this->permissions['cancelPolicy'] ) 
							|| ($_SESSION['auth']['roles_id']==ROLES_AGENT && $this->permissions['cancelPolicy'] && $data['product_types_id'] == PRODUCT_TYPES_DMS) 
							)
                            && ereg('^' . $this->object . '\|(add|view)$', $_REQUEST['do'])
                           )
                        {
                            echo '&nbsp;<input type="button" value="Припинити дію полісу" onclick="cancelPolicy(this)" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" class="button" />';
                        }

						if ($data['product_types_id'] == PRODUCT_TYPES_KASKO && ($_SESSION['auth']['roles_id']==ROLES_ADMINISTRATOR || $_SESSION['auth']['roles_id']==ROLES_MANAGER || ($_SESSION['auth']['roles_id']==ROLES_AGENT && ($_SESSION['auth']['agencies_id']==SELLER_AGENCIES_ID || $_SESSION['auth']['agencies_id']==236)))) {
							if ($_SESSION['auth']['agencies_id']!=236) {
								echo '&nbsp;<input type="button" value="ДУ" onclick="renewPolicy(1)" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" class="button" />';
								echo '&nbsp;<input type="button" value="ДУ багатолiт." onclick="renewPolicy(2)" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" class="button" />';
							}
							echo '&nbsp;<input type="button" value="ДУ поновл. СС" onclick="renewPolicy(3)" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" class="button" />';
							if ($_SESSION['auth']['agencies_id']==SELLER_AGENCIES_ID && $data['financial_institutions_id']!=3) echo '&nbsp;<input type="button" value="ДУ багатолiт. тiльки змiна СС" onclick="renewPolicy(4)" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" class="button" />';
						}
						
						if ($this->permissions['insert']) {
							switch ($data['policy_statuses_id']) {
								case POLICY_STATUSES_GENERATED:
								case POLICY_STATUSES_CONTINUED:
								case POLICY_STATUSES_RENEW:
								case 15:
									if ($data['product_types_id'] == PRODUCT_TYPES_GO && ($data['payment_statuses_id'] != PAYMENT_STATUSES_NOT || $data['policy_statuses_id']==POLICY_STATUSES_RENEW || $data['policy_statuses_id']==15)) echo '&nbsp;<input type="button" value="Дублікат" onclick="copyPolicy()" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" class="button" />';
									if (
									$data['product_types_id'] != PRODUCT_TYPES_KASKO && ($data['payment_statuses_id'] != PAYMENT_STATUSES_NOT || $data['policy_statuses_id']==17 || $data['policy_statuses_id']==15))  {
										if (($_SESSION['auth']['roles_id']==ROLES_AGENT && ($_SESSION['auth']['agencies_id']==SELLER_AGENCIES_ID || $_SESSION['auth']['agencies_id']==$data['agencies_id'])) || $_SESSION['auth']['roles_id']!=ROLES_AGENT)
											echo '&nbsp;<input type="button" value="Переукласти" onclick="renewPolicy()" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" class="button" />';
									}
									
									if ($data['product_types_id'] != PRODUCT_TYPES_PROPERTY && $data['product_types_id'] != PRODUCT_TYPES_KASKO && $data['product_types_id'] != PRODUCT_TYPES_GO && $data['product_types_id'] != PRODUCT_TYPES_DMS) echo '&nbsp;<input type="button" value="Пролонгувати" onclick="continuePolicy()" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" class="button" />';

									break;
							}
						}
					}
					break;
			}
		}
	?>
    <? if ($showNavigationBack) {?><input type="button" value=" Назад " onclick="back()" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" /><? } ?>
	<? if ($showNavigationSave) { ?><input type="button" value=" Зберегти " onclick="next(this);" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" /><? } ?>
    <? if ($showNavigationNext) { ?><input type="button" value=" Далі " onclick="next()" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" /><? } ?>
    <? if ($showNavigationBackToList) { ?><input type="button" value=" Повернутися до списку " onclick="window.location='<?=$_SERVER['PHP_SELF']?>?do=<?=$this->object?>|show&product_types_id=<?=$data['product_types_id']?>'" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" /><? } ?>
</div>
<?
if ($this->mode == 'view' && $this->permissions['insert'] && $data['product_types_id'] == PRODUCT_TYPES_GO) {
?>	
<script>
function createKasko() {
	document.location='/index.php?do=Policies|add&load_id=<?=$data['id']?>&product_types_id=3';
}

function createNs() {
	document.location='/index.php?do=Policies|add&load_id=<?=$data['id']?>&product_types_id=13';
}

function createDgo() {
	document.location='/index.php?do=Policies|add&load_id=<?=$data['id']?>&product_types_id=7';
}
</script>
<div align="center">
<br>	
<input type="button" value=" Створити КАСКО " onclick="createKasko()" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" />	
<input type="button" value=" Створити ДСЦВ " onclick="createDgo()" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" />	
<!--<input type="button" value=" Створити НС " onclick="createNs()" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" />	-->
</div>
<?	
}
?>
<?
    $product_types = array(
        PRODUCT_TYPES_CARGO_CERTIFICATE,
        PRODUCT_TYPES_DRIVE_CERTIFICATE);

	if (intval($data['policies_id']) && !ereg('^' . $this->object . '\|(add|view)$', $_REQUEST['do']) && in_array($data['product_types_id'], $product_types)) {
		if (is_array($_COOKIE['message'])) {
			foreach ($_COOKIE['message'] as $field => $value) {
				$data[ $field ] = $value;
			}
		}

		if ($Authorization->data['permissions']['PolicyMessages']['show']) {
			$PolicyMessages = new PolicyMessages($data, 'PolicyMessagesBrief');
			$PolicyMessages->addInWindow($data);
		}
	}
	
	if ($data['product_types_id'] == PRODUCT_TYPES_DMS) {
		$DMSCalculation = new DMSCalculation($data);
		$DMSCalculation->show($data);
	}
?>