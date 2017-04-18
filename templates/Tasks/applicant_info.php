<table width="100%" cellspacing="0" cellpadding="0">
    <tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
    <tr><td colspan="2" class="content">Інформація:</td></tr>
    <tr>
        <td id="QuestionnaireMessageInWindow">
            <table cellpadding="5" cellspacing="5">
                <? if($data['product_types_id'] != PRODUCT_TYPES_GO) { ?>
                <tr>
                    <td>
                        <b>Страхувальник:&nbsp;</b><?=$data['insurer_name']?>
                    </td>
                    <td>
                        <b>Контактний телефон:&nbsp;</b><?=$data['insurer_phone']?>
                    </td>
                    <td>
                        &nbsp;
                    </td>
                </tr>
                <? } ?>
                <tr>
                    <td>
                        <b>Заявник:&nbsp;</b><?=$data['applicant']?>
                    </td>
                    <td>
                        <b>Контактний телефон:&nbsp;</b><?=$data['applicant_phones']?>
                    </td>
                    <td>
                        <b>Транспортний засіб, державний номер:&nbsp;</b><?=$data['item'] . ', ' . $data['sign']?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Обставини:</b>
                    </td>
                    <td colspan="2" width="100">
                        <?=$data['description']?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Пошкодження:</b>
                    </td>
                    <td colspan="2">
                        <?=$data['damage']?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Сума відшкодування:</b>
                    </td>
                    <td colspan="2">
                        <?=$data['payment_amount']?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Дата виплати:</b>
                    </td>
                    <td colspan="2">
                        <?=$data['payment_date_format']?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Куди сплачено:</b>
                    </td>
                    <td colspan="2">
                        <?=$data['payment_recipient']?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Клас ремонту:</b>
                    </td>
                    <td colspan="2">
                        <?=$data['repair_classifications_id']?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Акт:&nbsp;</b><a target="_blank" href="/?do=AccidentActs|view&id=<?=$data['acts_id']?>&product_types_id=<?=$data['product_types_id']?>"><?=$data['acts_number']?></a>
                    </td>
                    <td>
                        <b>Справа:&nbsp;</b><a target="_blank" href="/?do=Accidents|view&id=<?=$data['accidents_id']?>&product_types_id=<?=$data['product_types_id']?>"><?=$data['accidents_number']?></a>
                    </td>
                    <td>
                        <b>Договір:&nbsp;</b><a target="_blank" href="/?do=Policies|view&id=<?=$data['policies_id']?>&product_types_id=<?=$data['product_types_id']?>"><?=$data['policies_number']?></a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>