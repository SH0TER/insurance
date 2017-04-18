<table width="100%" cellspacing="0" cellpadding="0">
    <tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
    <tr><td colspan="2" class="content">Інформація:</td></tr>
    <tr>
        <td id="QuestionnaireMessageInWindow">
            <table cellpadding="5" cellspacing="5">
			<tr>
				<td>
					<b>Страхувальник:&nbsp;</b><a href="/?Clients|show&id=<?=$data['clients_id']?>"><?=$data['insurer_name']?>
				</td>
				<td>
					<b>Контактний телефон:&nbsp;</b><?=$data['insurer_phone']?>
				</td>
				<td>
					<b>Договір:&nbsp;</b><a target="_blank" href="/?do=Policies|view&id=<?=$data['policies_id']?>&product_types_id=<?=$data['product_types_id']?>"><?=$data['policies_number']?></a>
				</td>
			</tr>
            </table>
        </td>
    </tr>
</table>