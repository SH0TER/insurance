<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
	<title>Додаткова угода на розірвання договору ДМС</title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/pdf.css" rel="stylesheet" />
	<link type="text/css" href="http://{$smarty.server.HTTP_HOST}/css/accidents.css" rel="stylesheet" />
{literal}
<style>
*, P {
	font-size: 18px;
	line-height: 24px;
}
H1 {
	font-size: 20px;
	font-weight: bold;
	text-align: center;
	margin: 0px;
}
H2 {
	margin-top: 0px;
	font-size: 18px;
	font-weight: bold;
	text-align: center;
}
.small P {
	font-size: 18px;
	line-height: 20px;
}
.large P {
	font-size: 20px;
}
</style>
{/literal}
</head>
<body>

<br/><br/>

<p align="center" class="large"><b>ДОДАТКОВА УГОДА № 1</b></p>
<p align="center"><b>До договору добровільного медичного страхування </b></p>
<p align="center"><b>{if $values.insurance_companies_id == 4} № {$values.policies_number}{else} Серія  54 – 33 – Т № 02 – {$values.policies_id}{/if}
	від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</b></p>
<br/>
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
	<td width="60%" align="left">м. Київ</td>
	<td align="right">{$values.interrupt_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.</td>
</tr>
</table>
<br/>

<p style="text-indent: 2em; text-align: justify;">
{if $values.insurance_companies_id == 4}ТДВ "Експрес Страхування"{else}Приватне акціонерне товариство "Страхова компанія "САТІС"{/if}
(надалі – Страховик), в особі ФО-П Турчиної Надії Миколаївни, паспорт Серія СН № 329366, виданий  Дніпровським РУ ГУ МВС України в м. Києві  22 жовтня 1996 р., ідентифікаційний номер 2698309504, що діє на підставі
{if $values.insurance_companies_id == 4}Довіреності №10/АС-1 від 23.11.2012р. (Додаток №5 до Договору доручення №10/АС від 23.11.2012р.){else}Договору  доручення № 06-15/3 від 22.06.2015 р.){/if}
від імені та в інтересах {if $values.insurance_companies_id == 4}ТДВ "Експрес Страхування"{else}Приватне акціонерне товариство "Страхова компанія "САТІС"{/if}(далі – "Страховик"), з однієї сторони,<br/>
</p>

<p style="text-indent: 2em; text-align: justify;">
та {$values.insurer}, далі за текстом "Страхувальник", з другої Сторони, а разом - Сторони дійшли згоди про наступне:
</p>

<p style="text-indent: 2em; text-align: justify;">
1. Припинити з {$values.interrupt_datetime|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. 00 годин 00 хвилин дію Договору 
	{if $values.insurance_companies_id == 4} № {$values.policies_number}{else} Серія  54 – 33 – Т № 02 – {$values.policies_id}{/if}
	від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р.
</p>

<p style="text-indent: 2em; text-align: justify;">
2. Страховик повертає Страхувальнику суму страхової премії за період, що залишився до закінчення дії Договору страхування, що розраховується за формулою:
</p>

<!--img src="http://{$smarty.server.HTTP_HOST}/files/ProductDocuments/images/dms_formula.png" /-->
<table>
	<tr>
		<td rowspan="2">П<span class="small">поверн</span> = </td>
		<td class="bottom">П<span class="small">дог</span></td>
		<td rowspan="2">* 365 - 0 - 0 - 0, де </td>
	</tr>
	<tr>
		<td>365</td>
	</tr>
</table>
<p><b>П<span class="small">поверн</span></b> - платіж, що повинен бути повернутий Страхувальнику;</p>
<p><b>П<span class="small">дог</span></b> - загальний платіж по Договору;</p>
<p><b>Д<span class="small">невикор</span></b> - кількість днів що залишилися до закінчення договору;</p>
<p><b>Н<span class="small">витр</span></b> - норматив витрат на ведення справи;</p>
<p><b>В<span class="small">факт</span></b> - сума фактично здійснених страхових виплат;</p>
<p><b>В<span class="small">заявл</span></b> - сума заявлених виплат.</p>
<br/>
<p>Отже,</p>
<p>П<span class="small">поверн</span> = {$values.amount|moneyformat} грн.

<p style="text-indent: 2em; text-align: justify;">
3. Сума страхової премії за період, що залишився до закінчення дії Договору страхування, в сумі {$values.amount|moneyformat} грн. ({$values.amount|moneyformat:1:true}) повертається Страхувальнику шляхом перерахування на рахунок.<br/>
</p>

<p style="text-indent: 2em; text-align: justify;">
4. Страхувальник підтверджує, що на дату припинення дії Договору страхування відсутні претензій, що заявлені та не задоволені щодо здійснення виплат за подіями, які можуть бути кваліфіковані як страхові випадки 
відповідно до умов Договору страхування, а також підтверджує, що такі претензії не будуть заявлені і надалі.
</p>

<p style="text-indent: 2em; text-align: justify;">
5. Додаткова Угода №1 є невід’ємною частиною Договору {if $values.insurance_companies_id == 4} № {$values.policies_number}{else} Серія  54 – 33 – Т № 02 – {$values.policies_id}{/if}
	від {$values.date|date_format:$smarty.const.DATE_FORMAT_SMARTY}р. і набуває чинності з моменту її підписання Сторонами.
</p>

<p style="text-indent: 2em; text-align: justify;">
6. Додаткова Угода №1 складається на одному аркуші в двох примірниках – по одному кожній Стороні.
</p>

{if $values.insurance_companies_id == 4}
	<table width=100% cellpadding=0 cellspacing=0 class="signs">
		<tr>
			<td width="45%" valign=top>
				<table width="100%" cellspacing=0 cellpadding=5>
					<tr>
						<td colspan=2 align="center"><b>СТРАХОВИК</b></td>
					</tr>
					<tr>
						<td colspan=2 class="bottom"><b>ТДВ "Експрес Страхування"</b></td>
					</tr>
					<tr>
						<td colspan=2 class="bottom">01004, м. Київ, вул. Велика Васильківська, 15/2</td>
					</tr>
					<tr>
						<td colspan=2 class="bottom">Р/р 26506056201918 в ПАТ КБ "ПРИВАТБАНК"</td>
					</tr>
					<tr>
						<td colspan=2 class="bottom">МФО 380269, Код ЄДРПОУ 36086124</td>
					</tr>
					<tr>
						<td colspan=2 class="bottom">в особі Турчина Надія Миколаївна <br/> м. Київ, вул. Драгоманова, буд. 8-А, кв. 197, <br/>ІПН 2698309504</td>
					</tr>
					<tr>
						<td colspan=2 class="bottom">&nbsp;</td>
					</tr>
					<tr>
						<td colspan=2>&nbsp;</td>
					</tr>
					<tr>
						<td width="50%">Турчина Н. М.</td>
						<td class="bottom">&nbsp;</td>
					</tr>
				</table>
			</td>
			<td>&nbsp;</td>
			<td width="45%" align=right valign=top>
				<table width="100%" cellspacing=0 cellpadding=5>
					<tr>
						<td colspan=2 align=center><b>СТРАХУВАЛЬНИК</b></td>
					</tr>
					<tr>
						<td colspan=2 class="bottom"><b>{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}</b></td>
					</tr>
					<tr>
						<td colspan=2 class="bottom">Адреса реєстрації: {$values.insurer_address}</td>
					</tr>
					<tr>
						{if $values.insurer_id_card == 1}<td colspan=2 class="bottom">ID-карта: № {$values.insurer_newpassport_number},<br />Орган, що видав: {$values.insurer_newpassport_place} ({$values.insurer_newpassport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY})</td>{else}<td colspan=2 class="bottom">Паспорт: {$values.insurer_passport_series} {$values.insurer_passport_number},<br />виданий {$values.insurer_passport_place} ({$values.insurer_passport_date|date_format:$smarty.const.DATE_FORMAT_SMARTY})</td>{/if}
					</tr>
					<tr>
						<td colspan=2>&nbsp;</td>
					</tr>
					<tr>
						<td width="50%">&nbsp;</td>
					</tr>
					<tr>
						<td>{$values.insurer_lastname} {$values.insurer_firstname|truncate:2:'':true}. {$values.insurer_patronymicname|truncate:2:'':true}.</td>
						<td width="50%" class="bottom">&nbsp;</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
{else}
	<table width=100% cellpadding=0 cellspacing=0 class="signs">
	<tr>
		<td width="30%" valign=top>
			<table width="100%" cellspacing=0 cellpadding=5>
			<tr>
				<td colspan=2 align="center"><b>СТРАХОВИК</b></td>
			</tr>
			<tr>
				<td colspan=2 class="bottom"><b>ПрАТ «СК «САТІС»</b></td>
			</tr>
			<tr>
				<td colspan=2 class="bottom">ПАТ «УкрСиббанк», МФО 351005</td>
			</tr>
			<tr>
				<td colspan=2 class="bottom">Рахунок №26507051917600</td>
			</tr>
			<tr>
				<td colspan=2 class="bottom">ЄДРПОУ 22963118</td>
			</tr>
			<tr>
				<td width="50%">Турчина Н. М.</td>
				<td class="bottom">&nbsp;</td>
			</tr>
			</table>
		</td>
		<td>&nbsp;</td>
		<td width="60%" align=right valign=top>
			<table width="100%" cellspacing=0 cellpadding=5>
			<tr>
				<td colspan=2 align=center><b>СТРАХУВАЛЬНИК (ЗАСТРАХОВАНА ОСОБА)</b></td>
			</tr>
			<tr>
				<td colspan=2 style="font-size: 8px;">
					Страховик до укладення цього Договору надав Страхувальнику інформацію, викладену у ст.12 Закону України «Про фінансові послуги та державне регулювання ринків фінансових послуг».
				</td>
			</tr>
			<tr>
				<td colspan=2>П.І.Б. <b>{$values.insurer_lastname} {$values.insurer_firstname} {$values.insurer_patronymicname}</b></td>
			</tr>
			<tr>
				<td colspan=2 style="font-size: 8px;">Підписуючи даний Договір погоджуюсь, що з Правилами добровільного медичного страхування (безперервного страхування здоров’я)  та Програмою страхування ознайомлений, а також даю згоду на обробку моїх персональних даних у розумінні ЗУ «Про захист персональних даних» з метою провадження Страховиком своєї страхової діяльності; відмовляюсь від письмового повідомлення про включення інформації до бази персональних даних. Страховик повідомив мене про мої права, визначені ЗУ «Про захист персональних даних»</td>
			</tr>
			<tr>
				<td colspan=2>&nbsp;</td>
			</tr>
			<tr>
				<td width="70%"></td>
				<td class="bottom">&nbsp;</td>
			</tr>
			</table>
		</td>
	</tr>
	</table>
{/if}

</body>
</html>