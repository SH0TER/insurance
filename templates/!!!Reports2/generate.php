<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="bullet"><img src="/images/pixel.gif" width="27" height="28" alt="" /></td>
            <td class="caption"><?=$data['report']['title']?>:</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tr><td height="4" bgcolor="#D6D6D6"><img src="/images/pixel.gif" width="1" height="1" alt="" /></td></tr>
                    <tr><td colspan="2" class="content"><?=translate('Content')?>:</td></tr>
                    <tr>
                        <td>
                            <form id="<?=$this->objectTitle?>" name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="do" id="doval" value="<?=$this->object.'|'.$method?>" />
								<input type="hidden" name="id" value="<?=$data['id']?>" />
								<input type="hidden" name="runquery" value="1" />
                                <input type="hidden" name="redirect" value="<?=(!$data['redirect']) ? $_SERVER['HTTP_REFERER'] : $data['redirect']?>" />
                                <table cellpadding="2" cellspacing="0">
								<tr>
								<td >

                                    <?
									if (is_array($data['inputparameters']))
									{
                                        $j=0;
										foreach($data['inputparameters'] as $parameter)
										{
                                            echo '<table border="0" align="left">';
											echo ReportBuilder::printParameter($data,$parameter);
                                            echo '</table>';
                                            $j++;
                                            if ($j==4) {echo '<br>';$j=0;}

										}

									}
									?>

								</td>	
								</tr>	
                                    <tr>
                                        <td width="150">&nbsp;</td>
                                        <td align="center"><input type="submit" value=" Виконати " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /> <b>Ексель:</b> <input id="excel" type="checkbox" value="1" name="excel"></td>
                                    </tr>
                                </table>
                            </form>
							
							<?
							if ($res)
							{
								echo '<table width="100%" cellpadding="0" cellspacing="0">';
								echo '<tr class="columns" align="center">';
								foreach($data['outputparameters'] as $parameter)
								{
									echo '<td>'.$parameter['title'].'</td>';
								}	
							
								echo '</tr>';
                                $sum=array();
                                $reccount = 0;
								while($res->fetchInto($row)) {
									$i = 1 - $i;
									echo '<tr class="'.Policies::getRowClass($row, $i).'">';
									foreach($data['outputparameters'] as $parameter)
									{
                                        if ($parameter['sum'])
                                        {
                                            $sum[$parameter['alias']]+=doubleval($row[$parameter['alias']]);
                                        }
										echo '<td>&nbsp;'.ReportBuilder::printOutputParameter($row[$parameter['alias']],$parameter,$row).'</td>';
									}	
									echo '</tr>';
                                    $reccount++;
								}
                                echo '<tr class="navigation" align="center">';
                                $i=0;
                                foreach($data['outputparameters'] as $parameter)
								{
                                    if ($i ==0)
                                    {
                                        echo '<td class="paging" nowrap> Всього: '.intval($reccount).'</td>';
                                    }
                                    else
                                        echo '<td>'.($parameter['sum']? getMoneyFormat($sum[$parameter['alias']],$parameter['typesId']==2 ? 1: -1):'&nbsp;').'</td>';
                                    $i++;
                                }
                                echo '</tr>';
								echo '</table>';
							}
							
							?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
<script>
$('#<?=$this->objectTitle?>').submit(function() {
  
  if ($('#excel').attr('checked'))
	$('#doval').val('<?=$this->object.'|'.$method.'InWindow'?>');
  else
	$('#doval').val('<?=$this->object.'|'.$method?>');
  return true;
});
</script>
<script type="text/javascript">initFocus(document.<?=$this->objectTitle?>);</script>