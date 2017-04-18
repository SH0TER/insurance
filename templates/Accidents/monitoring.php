<? if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['permissions']['Accidents']['showMonitoring']) { ?>
    <table width="100%">
    <tr>
        <td width="10"><a href="javascript:showComments();" alt="Моніторинг"><img src="/images/administration/navigation/view_dim.gif"></a></td></td>
        <td width="50"><a href="javascript:showComments();" alt="Моніторинг">Моніторинг</a></td>
        <td width="10"><a href="javascript:addComment();" alt="Додати коментар"><img src="/images/administration/navigation/add_over.gif"></a></td>
        <td width="100"><a href="javascript:addComment();" alt="Додати коментар">Додати коментар</a></td>
        <td>&nbsp;</td>
        <? if ($this->permissions['assignMonitorUser'] || $Authorization->data['id'] == 1) { ?>
            <td  align="">Справа знаходиться у: &nbsp;&nbsp;<?=$this->getAssignUsersSelect($data)?>
            <input type="button" value="Закріпити справу" onclick="setMonitoringUser();" /></td>
        <? } ?>
   </tr>
   <tr>
        <td colspan="8"><textarea name="monitoring_comment" id="monitoring_comment" class="fldText"></textarea></td>
   </tr>
   </table>
<? } ?>