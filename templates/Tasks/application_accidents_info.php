<table width="100%" cellspacing="0" cellpadding="0">
    <tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
    <tr><td colspan="2" class="content">Інформація:</td></tr>
    <tr>
        <td id="QuestionnaireMessageInWindow">
            <table cellpadding="5" cellspacing="5">
			<tr>
				<td>
					<b>Страхувальник:&nbsp;</b><a href="/?Clients|show&id=<?=$info['clients_id']?>"><?=$info['insurer_name']?>
				</td>
				<td>
					<b>Контактний телефон:&nbsp;</b><?=$info['insurer_phone']?>
				</td>
				<td>
					<b>Договір:&nbsp;</b><a target="_blank" href="/?do=Policies|view&id=<?=$info['policies_id']?>&product_types_id=<?=$info['product_types_id']?>"><?=$info['policies_number']?></a>
				</td>
			</tr>
			<tr>
				<td>
					<b>Заявник:&nbsp;</b><?=$info['applicant_name']?>
				</td>
				<td>
					<b>Контактний телефон:&nbsp;</b><?=$info['applicant_phone']?>
				</td>
				<td>
					<b>Дзвінок про подію:&nbsp;</b><a target="_blank" href="/?do=ApplicationCalls|view&id=<?=$info['calls_id']?>"><?=$info['calls_number']?></a>
				</td>
			</tr>
            </table>
        </td>
    </tr>
</table>