 
			<table width="100%" cellspacing="0" cellpadding="0">
			 <tr>
				<td>
				<? if (isset($date_title)) {?>
					<table width="100%" cellpadding="2" cellspacing="0">
                     <tr class="columns">
                        <td>&nbsp;</td>
                     <? foreach ($date_title as $date_value){?>
                        <td><?=$date_value?></td>
                     <? }?>
                    </tr>
					<? if ($Authorization->data['rolesId'] != ROLES_AGENT) {
                        foreach($avarage_managers as $manager) {
							$i = 1 - $i;
                    ?>
                        <tr class="row<?=$i?>">
                            <td><?=$manager['fio']?></td>
                          <? foreach($date_title as $date_value){?>
                            <td align="center"><?=(intval($average_counts_acts[$manager['fio']."/".$date_value]) != 0) ? '<b>'.$average_counts_acts[$manager['fio']."/".$date_value].'</b>' : '0' ?></td>
                          <?}?>
                        </tr>
                        <?}
                       }?>
					</table>
					<div class="navigation">
						<div class="paging">Всьго: <?=(sizeof($list))?></div>
					</div>
				<?}?>
				</td>
			</tr>
			</table>
			 