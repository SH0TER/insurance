<script type="text/javascript">
    $(document).ready(function(){
        //console.log($('select[name=product_document_types_id] option[value=149]').text());
        //$('select[name=product_document_types_id] [value=149]').style('font-weight', 'bold');
        $("select[name=product_document_types_id] option[value=149]").remove();
        //$("select[name=product_document_types_id]").prepend( $('<option value="149"><b>Заява-повідомлення про подію</b></option>') );
        $("select[name=product_document_types_id] option:nth-child(1)").after( $('<option value="149" style="font-weight: bold; color: magenta;">Заява-повідомлення про подію</option>') );
    });
</script>
<? $Log->showSystem();?>
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

                            <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data" onsubmit="return checkFields()">
                                <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
                                <input type="hidden" name="id" value="<?=$data['id']?>" />
								<input type="hidden" name="application_accidents_id" value="<?=$data['application_accidents_id']?>" />
                                <input type="hidden" name="product_types_id" value="<?=$data['product_types_id']?>" />
                                <input type="hidden" name="surcharge" value="" />
                                <input type="hidden" name="redirect" value="<?=($data['is_accidents']=='1') ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />
                                <table cellpadding="2" cellspacing="3" width="100%">
                                    <tr>
                                        <td>
                                            <table cellpadding="5" cellspacing="0">
                                                <tr>
                                                    <td class="label grey"><?=$this->getMark()?>Тип:</td>
                                                    <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('product_document_types_id') ], $data['product_document_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
                                                </tr>
                                                <tr>
                                                    <td class="label grey"><?=$this->getMark()?>Файл:</td>
                                                    <td><input type="file" name="file" value="" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly()?> /></td>
                                                    <?
                                                        if ($data['file']) {
                                                            $file = array(
                                                                'id'            => $data['id'],
                                                                'position'      => $this->getFieldPositionByName('file'),
                                                                'languageCode'  => '');

                                                            echo ($this->isValidImage($data['file']) && $this->displayImage)
                                                                ? '<tr><td>&nbsp;</td><td>' . getImageTag('/files' . $Authorization->data['folder'] . '/' . $this->object . '/' . $data['file']) . '</td></tr>'
                                                                : '<tr><td>&nbsp;</td><td><b>' . translate('Present, size') . ' ' . getFileSize('/files' . $Authorization->data['folder'] . '/' . $this->object . '/' . $data['file']) . ':</b> <a href="?do=' . $this->object . '|downloadFileInWindow&&amp;file=' . urlencode(serialize($file)) . '" target="_blank">' . translate('Download') . '</a></td></tr>';
                                                        }
                                                    ?>
                                                </tr>
                                                <tr>
                                                    <td class="label grey">Оригінал:</td>
                                                    <td><input type="checkbox" name="original" value="<?=$data['original']?>" <?=(intval($data['original']) ? 'checked' : '')?>  <?=$this->getReadonly(true)?> /></td>
                                                </tr>
												<tr>
                                                    <td class="label grey">Коментар:</td>
                                                    <td><textarea name="comment" class="fldNote" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';"><?=$data['comment']?></textarea></td>
                                                </tr>
                                            </table>

                                            <table cellpadding="5" cellspacing="0">
                                                <tr>
                                                    <td width="150">&nbsp;</td>
                                                    <td><input type="submit" value=" <?=translate('Save')?> " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
                                                </tr>
                                            </table>
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