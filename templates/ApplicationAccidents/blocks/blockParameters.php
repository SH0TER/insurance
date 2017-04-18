<? if($action != 'insert') { ?>
	<!--div class="blockParameters">
		<div class="section">Параметри:</div>
		<table>
			<tr>			
				<td>Статус:</td>
				<td>							
					<select name="statuses_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'">
						<option value="1" <?=($data['statuses_id'] == 1) ? 'selected' : ''?>>Створено</option>
						<option value="2" <?=($data['statuses_id'] == 2) ? 'selected' : ''?>>Прийнято</option>
					</select>				
				</td>
			</tr>
		</table>
	</div-->
<? } ?>