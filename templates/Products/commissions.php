<? $Log->showSystem();?>
<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet"><img src="/images/pixel.gif" width="27" height="28" alt="" /></td>
            <td class="caption">Встановлення агентської винагороди за останній період "<?=$data['products_title']?>":</td>
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
                                <input type="hidden" name="do" value="<?=$this->object.'|updateCommissions'?>" />
                                <input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>" />
                                <input type="hidden" name="products_id" value="<?=$data['products_id']?>" />
                                <input type="hidden" name="products_title" value="<?=$data['products_title']?>" />
                                <input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>">
                                <table cellpadding="2" cellspacing="0" width="100%">
                                    <?
                                    if (is_array($data['agencies'])) {
                                        echo '<tr><td colspan="3"><b>АГЕНЦІЇ ТА АГЕНТИ:</b></td></tr><tr><td colspan="2"><table cellpadding="2" cellspacing="0">';
                                        foreach ($data['agencies'] as $id => $row) {
                                            $i = 1 - $i;
                                            $commissionAgency = $data['agencies'][ $id ]['agency_percent'] + $data['agencies'][ $id ]['agency_amount'] + $data['agencies'][ $id ]['agent_percent'] + $data['agencies'][ $id ]['agent_amount'];
                                            echo '<tr class="' . $this->getRowClass($row, $i) . '">' .
                                                    '<td width="400" ' . (($commissionAgency == 0) ? ' class="warning"' : '') . '>' . $row['title'] . '</td>' .
                                                    '<td>' .
                                                        '<input type="hidden" name="agencies[' . $id . '][title]" value="' . htmlspecialchars($row['title']) . '" />' .
                                                        '<input type="hidden" name="agencies[' . $id . '][date]" value="2008-01-01" />' .
                                                    '</td>' .
                                                    '<td>' .
                                                        '<b>агенція:</b> <input type="text" name="agencies[' . $id . '][agency_percent]" value="' . $data['agencies'][ $id ]['agency_percent'] . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" />' .
														'<input type="hidden" name="agencies[' . $id . '][agency_base]" value="2" />' .//скрываем базу начисления
														'<input type="hidden" name="agencies[' . $id . '][agency_amount]" value="0" />' .//скрываем абсолютную величину
//                                                        'від страхової <input type="radio" name="agencies[' . $id . '][agency_base]" value="1" ' . ( ($data['agencies'][ $id ]['agency_base'] == COMMISSIONS_BASE_PRICE) ? 'checked' : '') . ' /> суми <input type="radio" name="agencies[' . $id . '][agency_base]" value="2" ' . ( ($data['agencies'][ $id ]['agency_base'] == COMMISSIONS_BASE_AMOUNT) ? 'checked' : '') . ' /> премії <b>АБО</b> ' .
//                                                        '<input type="text" name="agencies[' . $id . '][agency_amount]" value="' . $data['agencies'][ $id ]['agency_amount'] . '" maxlength="10" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" /> грн. &nbsp; ' .
                                                        '<b>агент:</b> <input type="text" name="agencies[' . $id . '][agent_percent]" value="' . $data['agencies'][ $id ]['agent_percent'] . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" /> %' .
														'<input type="hidden" name="agencies[' . $id . '][agent_base]" value="2" />' .//скрываем базу начисления
														'<input type="hidden" name="agencies[' . $id . '][agent_amount]" value="0" />' .//скрываем абсолютную величину
//                                                        'від страхової <input type="radio" name="agencies[' . $id . '][agent_base]" value="1" ' . ( ($data['agencies'][ $id ]['agent_base'] == COMMISSIONS_BASE_PRICE) ? 'checked' : '') . ' /> суми <input type="radio" name="agencies[' . $id . '][agent_base]" value="2" ' . ( ($data['agencies'][ $id ]['agent_base'] == COMMISSIONS_BASE_AMOUNT) ? 'checked' : '') . ' /> премії <b>АБО</b> ' .
//                                                        '<input type="text" name="agencies[' . $id . '][agent_amount]" value="' . $data['agencies'][ $id ]['agent_amount'] . '" maxlength="10" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" /> грн.' .
                                                    '</td>' .
                                                 '</tr>';
                                        }
                                        echo '</table></td></tr>';
                                    }
                                    if (is_array($data['financial_institutions'])) {
                                        echo '<tr><td colspan="3"><b>БАНКИ:</b></td></tr><tr><td colspan="2"><table cellpadding="2" cellspacing="0">';
                                        foreach ($data['financial_institutions'] as $id => $row) {
                                            $i = 1 - $i;
                                            $commissionFinancialInstitution = $data['financial_institutions'][ $id ]['percent'] + $data['financial_institutions'][ $id ]['amount'];
                                            echo '<tr class="' . $this->getRowClass($row, $i) . '">' .
                                                    '<td width="400" ' . (($commissionFinancialInstitution == 0) ? ' class="warning"' : '') . '>' . $row['title'] . '</td>' .
                                                    '<td>' .
                                                        '<input type="hidden" name="financial_institutions[' . $id . '][title]" value="' . htmlspecialchars($row['title']) . '" />' .
                                                        '<input type="hidden" name="financial_institutions[' . $id . '][date]" value="2008-01-01" />' .
                                                    '</td>' .
                                                    '<td style="padding-left: 48px;">' .
                                                        '<input type="text" name="financial_institutions[' . $id . '][percent]" value="' . $data['financial_institutions'][ $id ]['percent'] . '" maxlength="5" class="fldPercent" onfocus="this.className=\'fldPercentOver\';" onblur="this.className=\'fldPercent\';" />' .
														'<input type="hidden" name="financial_institutions[' . $id . '][base]" value="1" />' .
//                                                        'від страхової <input type="radio" name="financial_institutions[' . $id . '][base]" value="1" ' . ( ($data['financial_institutions'][ $id ]['base'] == COMMISSIONS_BASE_PRICE) ? 'checked' : '') . ' /> суми <input type="radio" name="financial_institutions[' . $id . '][base]" value="2" ' . ( ($data['financial_institutions'][ $id ]['base'] == COMMISSIONS_BASE_AMOUNT) ? 'checked' : '') . ' /> премії <b>АБО</b> ' .
//                                                        '<input type="text" name="financial_institutions[' . $id . '][amount]" value="' . $data['financial_institutions'][ $id ]['amount'] . '" maxlength="10" class="fldMoney" onfocus="this.className=\'fldMoneyOver\';" onblur="this.className=\'fldMoney\';" /> грн.' .
                                                 '</tr>';
                                        }
                                        echo '</table></td></tr>';
                                    }
                                    ?>
                                    <tr>
                                        <td width="400">&nbsp;</td>
                                        <td><input type="submit" value=" <?=translate('Save')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
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