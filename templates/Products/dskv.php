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
                                <input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>">
                                <table cellpadding="2" cellspacing="0" width="100%">
                                    <?=$this->buildFieldsPart($data, $actionType);?>
                                    <?
                                        if ($action != 'view') {
                      						echo ParametersPropertySections::getList($data, $data['product_types_id']);
                                            echo ParametersRisks::getList($data, $data['product_types_id']);
                                        }
                                    ?>
                                    <tr>
                                        <td width="150">&nbsp;</td>
                                        <td align="center">
                                            <?
                                                switch ($action) {
                                                    case 'view':
                                                        echo '<input type="button" value=" ' . translate('Back') . ' " class="button" onclick="changeLocation(document.path, ' . (sizeOf($_SESSION['auth']['path']) - 2) . ')" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" />';
                                                        break;
                                                    default:
                                                        echo '<input type="submit" value=" ' . translate('Save') . ' " class="button" onMouseOver="this.className = \'buttonOver\';" onMouseOut="this.className = \'button\';" />';
                                                        break;
                                                }
                                            ?>
                                        </td>
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
<script type="text/javascript">
    initFocus(document.<?=$this->objectTitle?>);
</script>