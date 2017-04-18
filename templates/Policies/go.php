<?
if ($_POST['ECmode']) {
    $data['ECmode'] = $_POST['ECmode'];
}

if ($_POST['financial_institutions_id']) {
    $data['financial_institutions_id'] = $_POST['financial_institutions_id'];
}

$field = $this->formDescription['fields'][ $this->getFieldPositionByName('policy_statuses_id') ];
unset($field['condition']);
$field['list'] = $this->getListValue($field, $data);
if (($Authorization->data['roles_id'] == ROLES_AGENT) || ($Authorization->data['roles_id'] != ROLES_AGENT && $data['agencies_id']==SELLER_AGENCIES_ID)) {
	$change_seller = true;
}

?>

<?if ($this->mode != 'update') {?>
<link rel="stylesheet" type="text/css" href="/css/jquery.fancybox-1.3.1.css" media="screen" />
<script type="text/javascript" src="/js/jquery/jquery.fancybox-1.3.1.pack.js"></script>	
<script type="text/javascript" src="/js/jquery/form.js"></script>
<div style="display:none">
    <div id="inlinecontent">
		<form name="changeForm" id="changeForm" action="index.php" method="post" enctype="multipart/form-data" >
		<div align="right"> &nbsp;&nbsp; <a href="javascript:;" onclick="$.fancybox.close();">Закрыть</a><br><br></div>
		<div id="inlinecontent_inner">
			<input type="hidden" name="do" value="Policies|changePolicyInWindow">
			<input type="hidden" name="product_types_id" value="<?=PRODUCT_TYPES_GO?>">
			<input type="hidden" name="policies_id" value="<?=$data['id']?>">
			<input type="hidden" name="skipCheck" value="1">
			
			<table>
			<tr>
				<td>Тариф по полису:</td>
				<td><input type="text" name="amount" value="<?=$data['amount']?>" size="5"></td>
			</tr>
			<tr>
				<td>Тариф по бланку:</td>
				<td><input type="text" name="amount_go" value="<?=$data['amount_go']?>" size="5"></td>
			</tr>
			<tr>
				<td>Статус:</td>
				<td><?echo $this->buildSelect($field, $data['policy_statuses_id'], $data['languageCode'], ' ' , null, $data, $this->isEqual('policy_statuses_id'));?></td>
			</tr>	
			<tr>
				<td>Серія поліса оригіналу:</td>
				<td><input type="text" name="blank_series_parent" value="<?=$data['blank_series_parent']?>" size="5"></td>
			</tr>
			<tr>
				<td>Номер поліса оригіналу:</td>
				<td><input type="text" name="blank_number_parent" value="<?=$data['blank_number_parent']?>" size="8"></td>
			</tr>
			<tr>
				<td>Державний знак:</td>
				<td><input type="text" name="sign" value="<?=$data['sign']?>" size="10" autocomplete="off"></td>
			</tr>
			<tr>
				<td>№ шасі:</td>
				<td><input type="text" name="shassi" value="<?=$data['shassi']?>" size="20"></td>
			</tr>
			<tr>
				<td>ІПН:</td>
				<td><input type="text" name="insurer_identification_code" id="insurer_identification_code" value="<?=$data['insurer_identification_code']?>"   size="20"></td>
			</tr>
			<tr>
				<td>Паспорт серiя:</td>
				<td><input type="text" name="insurer_passport_series" value="<?=$data['insurer_passport_series']?>" size="20"></td>
			</tr>
			<tr>
				<td>Паспорт номер:</td>
				<td><input type="text" name="insurer_passport_number" value="<?=$data['insurer_passport_number']?>" size="20"></td>
			</tr>
			
			
			
			<tr>
				<td>Прізвище:</td>
				<td><input type="text" name="insurer_lastname" value="<?=$data['insurer_lastname']?>" size="30"></td>
			</tr>
			<tr>
				<td>Ім'я:</td>
				<td><input type="text" name="insurer_firstname" value="<?=$data['insurer_firstname']?>" size="30"></td>
			</tr>
			
			<tr>
				<td>По батьков:</td>
				<td><input type="text" name="insurer_patronymicname" value="<?=$data['insurer_patronymicname']?>" size="30"></td>
			</tr>
			
			
			<tr>
				<td>Дата полiсу:</td>
				<td><input type="text" name="date" value="<?=$data['date_format']?>" size="20"></td>
			</tr>
			<tr>
				<td>Дата та час початку дії:</td>
				<td><input type="text" name="begin_datetime" value="<?=$data['begin_datetime_format']?>" size="20"></td>
			</tr>
			<tr>
				<td>Дата закінчення дії:</td>
				<td><input type="text" name="end_datetime" value="<?=$data['end_datetime_format']?>" size="20"></td>
			</tr>
			<tr>
				<td colspan="2">
				<br><div align=center><input type="button" value=" Змiнити " onclick="changePolicy()" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" /></div>
				</td>
			</tr>
			
			
			
			</table>
		</div>
		</form>
    </div>
</div>

<?
if ($_REQUEST['showhint'] && $Authorization->data['id']!=1) {?>
<a id="hidden_hint_link" class="hint_content" href="#hintcontent"  style="display:none">___</a>
<div style="display:none">
    <div   id="hintcontent">
	<p><u>Можливо Клієнту буде цікаво:</u> 
	<p>1.	Добровільне страхування цивільної відповідальності власників наземного транспорту:
	<table border=1>
	<tr>
		<td>Страхова сума, грн</td><td>Страховий платіж, грн</td><td>Комісійна винагорода</td>
	</tr>
	<tr><td>50 000,00</td><td>125,00</td><td>22.50</td></tr>
	<tr><td>100 000,00</td><td>200,00</td><td>36.00</td></tr>
	<tr><td>200 000,00</td><td>300,00</td><td>54.00</td>	</tr>
	</table>

	<p>2.	Договір добровільного страхування наземних транспортних засобів «КАСКО Mini» віком до 8 років:
	<table border=1>
	<tr>
		<td>Страхова сума, грн</td><td>Страховий платіж, грн</td><td>Комісійна винагорода</td>
	</tr>
	<tr><td>10 000,00</td><td>220,00</td><td>52.80</td></tr>
	<tr><td>20 000,00</td><td>440,00</td><td>105.60</td></tr>
	<tr><td>50 000,00</td><td>1 100,00</td><td>264.00</td>	</tr>
	</table>
	
	<!--<p>3.	Договір страхування від нещасного випадку на транспорті:
	<table border=1>
	<tr>
		<td>Страхова сума, грн</td><td>Страховий платіж, грн</td><td>Комісійна винагорода</td>
	</tr>
	<tr><td>20 000,00</td><td>70,00</td><td>18,00</td></tr>
	<tr><td>50 000,00</td><td>135,00</td><td>45,00</td></tr>
	<tr><td>100 000,00</td><td>300,00</td><td>90,00</td>	</tr>
	</table>-->
   </div>
</div>
<script>

$(document).ready(function() {
	$(".hint_content").fancybox({
		'hideOnContentClick': true
	});
	$("#hidden_hint_link").fancybox().trigger('click');
	
});
</script>
<?}?>
<script>
function changePolicy() {
    var options = {success: showResponse};
    $('#changeForm').ajaxSubmit(options);
    $.fancybox.close();
}

function showResponse(value) {
    alert(value);
}

$(document).ready(function() {

	$(".changeval").fancybox({
		'modal'	:	true,
		'onComplete'	:	function() {}
	});
	
});
</script>
<?}?>
<link type="text/css" href="/js/jquery/thickbox.css" rel="stylesheet" media="screen" />
<script type="text/javascript" src="/js/jquery/thickbox.js"></script>

<script type="text/javascript" src="/js/jquery/jquery.flexbox.js"></script>
<link rel="stylesheet" type="text/css" href="/css/jquery.flexbox.css" media="screen" />

<script type="text/javascript">

var cities = new Array();
var cities_list = {};

//загружаем модели для выбранного бренда
function setCar() {
    <?if (!ereg('^view', $action)) {?>
    $.ajax({
        type:		'GET',
        url:		'index.php',
        dataType:	'script',
        data:		'do=CarModels|getJavaScriptInWindow&product_types_id=<?=PRODUCT_TYPES_GO?>&brands_id=<?=$data['brands_id']?>&models_id=<?=$data['models_id']?>',
        success:	function (result) {
            setModel();
        }
    })
    <?}?>
}
//новый пасспорт 
function setInsurerIdCard() {
    if($('[name=insurer_id_card]:checked').val() == 0) {
        $('#passport').css('display', 'table');
        $('table#insurer_new_passport_table').css('display', 'none');
    } else {
        $('#passport').css('display', 'none');
        $('table#insurer_new_passport_table').css('display', 'table');
    }
}

//проведение акций
function changeSpecial(brands_id, models_id) {
    showHideStage3Block();
    if (!brands_id) {
        brands_id = $('#brands_id option:selected').val();
    }

    if (!models_id) {
        models_id = $('#models_id option:selected').val();
    }

    if (<?=($this->mode == 'view' && $data['special']) ? 'true' : 'false'?> ) {
        $('#specialBlock').css('display', 'block');
    } else {
        $('#specialBlock').css('display', 'none');
        $('#special').attr('checked', false);
    }
}
//установка стоимости полиса
function setProductValues(data) {
    $('#rate').html( getMoneyFormat(data.amount) );
    $('#rate_amount').val(data.amount);
    <?if ($data['next_policy_statuses_id'] == POLICY_STATUSES_RENEW) {?>
    $('#amountPayment').html(getMoneyFormat( parseFloat(data.amount) - parseFloat($('#amount_parent').val()) ));
    <?}?>
}
//устанавливаем сферы применения
function setScopesId() {
    var scopes_id = 0;

    var person_types_id = $('select[name=person_types_id] option:selected').val();
    var car_types_id = $('select[name=car_types_id] option:selected').val();
    var taxi = $('input[name="taxi"]:checked').val();
    var passengers = $('#passengers').val();

    if (car_types_id == '2' || (car_types_id == '3' && passengers >= 20) || car_types_id == '4' || car_types_id == '5') {
        scopes_id = 3;
    } else if (taxi != '0') {
        if (car_types_id == '1' || (car_types_id == '3' && passengers < 20)) {
            switch (person_types_id) {
                case '1':
                    scopes_id = 4;
                    break;
                case '2':
                    scopes_id = 5;
                    break;
            }
        }
    } else if (taxi == '0') {
        switch (car_types_id) {
			case '3' :
                        scopes_id = 3;
                        break;
            case '1'://B - Легкові автомобілі
            case '6'://A1 - Моторолер
            case '7'://A2 - Мотоцикл
                switch (person_types_id) {
                    case '1':
                        scopes_id = 1;
                        break;
                    case '2':
                        scopes_id = 2;
                        break;
                }
        }
    }

    $('#scopes_id').val( scopes_id );
}
//устанавливаем стаж вождения
function setDriverStagesId() {
    var driver_standings_id = 0;

    switch ( $('select[name=person_types_id] option:selected').val() ) {
        case '1'://физ. лицо
            switch ( $('input[name="stage3"]:checked').val() ) {
                case '0':
                    driver_standings_id = 5;
                    break;
                case '1':
                    driver_standings_id = 6;
                    break;
            }
            break;
        case '2':
            driver_standings_id = 7;
            break;
    }

    $('#driver_standings_id').val( driver_standings_id );
}

//показываем или прячем блок ОТК
function showHideStage3Block() {
	return;
    if ( $('select[name=person_types_id] option:selected').val() == '1' ) {
        $('#stage3Block').css('display', 'block');
    } else {
        $('#stage3Block').css('display', 'none');
    }
}

function changeProduct() {

    showHideStage3Block();
    showHideOTKBlock();
	
	if ( $('#registration_cities_id_hidden').val() != 284 ) {
		var terms_id = parseInt(getElementValue('terms_id'));
		var person_types_id =parseInt(getElementValue('person_types_id'));
		if (isNaN(terms_id)) terms_id = 0;
		if (isNaN(person_types_id)) person_types_id = 0;
		if (person_types_id==1) {
			if (parseInt($('select[name=car_types_id] option:selected').val()) == 3 && terms_id != 19 && terms_id != 13 && terms_id > 0 && $('#otk').val() == 0) {
				alert('Терміни страхування автобусів для резидентів - 15 днів або 6 місяців.');
				$('select[name=terms_id]').val(0);
			} else if (parseInt($('select[name=car_types_id] option:selected').val()) != 3 && terms_id != 25 && terms_id != 13 && terms_id > 0  && $('#otk').val() == 0) {
				alert('Терміни страхування ТЗ (крім автобусів) для резидентів - 15 днів або 1 рік.');
				$('select[name=terms_id]').val(0);
			}
		}	
	}

    if ($('select[name=privileges] option:selected').val() > 0) {
        if ($('select[name=person_types_id] option:selected').val() != '1') {
            alert('Пільги діють лише для фізичних осіб.');
            $('select[name=privileges] option:selected').val(0);
        } else if (
                $('select[name=car_types_id] option:selected').val() != '1' &&
                $('select[name=car_types_id] option:selected').val() != '6' &&
                $('select[name=car_types_id] option:selected').val() != '7') {

            alert('Пільги діють лише для легкових автомобілів та мотоциклів.');
            $('select[name=privileges] option:selected').val(0);
        } else if ($('#engine_size').val() > 2500) {
            alert('Пільги діють лише для легкових автомобілів з об`ємом до 2500 см3.');
            $('select[name=privileges]').val(0);
        } else {
            $('#privilegesBlock').css('display', 'block');
        }
    } else {
        $('#privilegesBlock').css('display', 'none');
    }

    if ($('select[name=person_types_id] option:selected').val() == '2') {
        $('#insurer_identification_code').css('display', 'none');
        $('#insurer_identification_code').val('');
        $('#insurer_edrpou').css('display', 'block');
        $('#identificationCodeLabel').html('<?=$this->getMark()?>ЄДРПОУ:');

        $('#lastnameLabel').html('<?=$this->getMark()?>Організація:');

        $('#firstnameLabel').css('display', 'none');
        $('#firstnameInput').css('display', 'none');
        $('#firstnameInput').val('');

        $('#patronymicnameLabel').css('display', 'none');
        $('#patronymicnameInput').css('display', 'none');
        $('#patronymicnameInput').val('');

        $('#passport').css('display', 'none');
        $('#birth').css('display', 'none');


        $('table#insurer_new_passport_table').css('display', 'none');
        $('table#insurer_id_card_table').css('display', 'none');

        $('#insurer_passport_series').val('');
        $('#insurer_passport_number').val('');
        $('input[name=insurer_newpassport_number').val('');
        $('input[name=insurer_newpassport_reestr').val('');
        $('input[name=insurer_newpassport_place').val('');

        $('#insurer_dateofbirth_year').val('');
        $('#insurer_dateofbirth_month').val('');
        $('#insurer_dateofbirth_day').val('');
        $('#insurer_dateofbirth').val('');
    } else {
        $('#insurer_identification_code').css('display', 'block');
        $('#insurer_edrpou').css('display', 'none');
        $('#insurer_edrpou').val();
        $('#identificationCodeLabel').html('ІПН:');

        $('#lastnameLabel').html('<?=$this->getMark()?>Прізвище:');

        $('#firstnameLabel').css('display', '');
        $('#firstnameInput').css('display', '');
        $('#patronymicnameLabel').css('display', '');
        $('#patronymicnameInput').css('display', '');

        $('#birth').css('display', 'block');
        $('table#insurer_id_card_table').css('display', 'table');

        setInsurerIdCard();
    }

    car_types_id = $('select[name=car_types_id] option:selected').val();

    switch (car_types_id) {
        case '2':
        case '5':
            $('#textLabel').html('');
            $('#engine_size').css('display', 'none');
            $('#engine_size').val('');
            $('#car_weight').css('display', 'none');
            $('#car_weight').val();
            $('#passengers').css('display', 'none');
            $('#passengers').val();
            break;
        case '3':
            $('#textLabel').html('<?=$this->getMark()?>Кiлькicть пасажирiв:');
            $('#engine_size').css('display', 'none');
            $('#engine_size').val('');
            $('#car_weight').css('display', 'none');
            $('#car_weight').val('');
            $('#passengers').css('display', 'block');
            break;
        case '4':
            $('#textLabel').html('<?=$this->getMark()?>Вантажопiд`ємність, кг.:');
            $('#engine_size').css('display', 'none');
            $('#engine_size').val('');
            $('#car_weight').css('display', 'block');
            $('#passengers').css('display', 'none');
            $('#passengers').val('');
            break;
        default:
            $('#textLabel').html("<?=$this->getMark()?>Об`єм двигуна, см<sup>3</sup>:");
            $('#engine_size').css('display', 'block');
            $('#car_weight').css('display', 'none');
            $('#car_weight').val('');
            $('#passengers').css('display', 'none');
            $('#passengers').val('');
            break;
    }

    if ($('select[name=person_types_id] option:selected').val() > 0 &&
        (
            (car_types_id == 3 && $('#passengers').val() > 0) ||
            (car_types_id == 4 && $('#car_weight').val() > 0) ||
            (car_types_id != 2 && car_types_id != 5 && $('#engine_size').val() > 0) ||
            car_types_id == 2 || car_types_id == 5
        ) &&
            $('#registration_cities_id_hidden').val() > 0 &&
            $('#terms_id').val() > 0 && <?=($this->mode == 'view') ? 'false' : 'true'?>) {

                setScopesId();
                setDriverStagesId();

                $.ajax({
                    type:		'POST',
                    url:		'index.php',
                    dataType:	'json',
                    data:		'do=Products|getRateInWindow' +
                                '&product_types_id=' + $('#product_types_id').val() +
								'&products_id=' + $('#products_id').val() +
                                '&person_types_id=' + $('select[name=person_types_id] option:selected').val() +
                                '&policies_general_id=' + $('select[name=policies_general_id] option:selected').val() +
                                '&deductible=' + $('select[name=deductible] option:selected').val() +
                                '&car_types_id=' + $('select[name=car_types_id] option:selected').val() +
                                '&engine_size=' + $('#engine_size').val() +
                                '&car_weight=' + $('#car_weight').val() +
                                '&passengers=' + $('#passengers').val() +
                                //'&registration_cities_id=' + $('select[name=registration_cities_id] option:selected').val() +
                                '&registration_cities_id=' + $('#registration_cities_id_hidden').val() +
                                '&scopes_id=' + $('#scopes_id').val() +
                                '&driver_standings_id=' + $('#driver_standings_id').val() +
                                '&terms_id=' + $('#terms_id').val() +
                                '&regres=' + getElementValue('regres') +
                                '&bonus_malus_id=' + $('select[name=bonus_malus_id] option:selected').val() +
                                <? if ($data['clients_id'] == 97084 || $data['clients_id'] == 68918) { ?>
                                    '&privileges=' + getElementValue('privileges') +
								    '&clients_id=' + $('#clients_id').val(),
                                <? } else { ?>
								    '&privileges=' + getElementValue('privileges'),
                                <? } ?>
            success:	setProductValues})
    } else if (<?=($this->mode == 'view') ? 'false' : 'true'?>) {
        $('#rate').html('');
    }
}

//показываем или прячем блок ОТК
function showHideOTKBlock() {
    var year = new Date();

    if ($('select[name=car_types_id] option:selected').val() == '3' || //автобуси
        $('input[name="taxi"]:checked').val()=='1' || //таксі
        ($('select[name=car_types_id] option:selected').val() == '1' && $('input[name="taxi"]:checked').val() == '2' && (year.getFullYear() - parseInt($('#year').val()) >= 2)) ||//легкова+рік>2+прибуток
        ($('select[name=car_types_id] option:selected').val() == '4' && parseInt($('#car_weight').val()) >= 3500) || //вантажна + вантажопідйомність>=3500
        ($('select[name=car_types_id] option:selected').val() == '4' && parseInt($('#car_weight').val()) > 0 && parseInt($('#car_weight').val()) < 3500 && (year.getFullYear() - parseInt($('#year').val()) >= 2)) || //вантажна+вантажопідйомність <3500+рік>2
        $('select[name=car_types_id] option:selected').val() == '5' //причіп до вант. тз
            ) {
        $('#otkBlock').css('display', 'block');
        $('#otk').val(1);
    } else {
        $('#otkBlock').css('display', 'none');
        $('#otk').val(0);
        $('#otknumber').val('');
        $('#otkdate_day').val(0);
        $('#otkdate_month').val(0);
        $('#otkdate_year').val(0);
    }
}

//устнавливаем  дату окончания действия
function setEnd() {
    with (document.<?=$this->objectTitle?>) {

        bday    = begin_datetime_day.value;
        bmonth  = begin_datetime_month.value;
        byear   = begin_datetime_year.value;

        if (bday.substring(0,1)=='0') bday=bday.substring(1,2);
        if (bmonth.substring(0,1)=='0') bmonth=bmonth.substring(1,2);

        bday	= parseInt(bday);
        bmonth	= parseInt(bmonth);
        byear	= parseInt(byear);

        if (bday>0 && bmonth>0 && byear>0) {
            date = new Date(byear, bmonth-1, bday);
            newdate = null;

            switch (parseInt(getElementValue('terms_id'))) {
                case 12:
                    end_datetime_day.value	= '';
                    end_datetime_month.value	= '';
                    begin_datetime_year.value			= '';
                    break;
                case 13: //15 днів
                    newdate = date.addDays(14);
                    break;
                case 14: //1 місяць
                case 15: //2 місяць
                case 16: //3 місяць
                case 17: //4 місяць
                case 18: //5 місяць
                case 19: //6 місяць
                case 20: //7 місяць
                case 21: //8 місяць
                case 22: //9 місяць
                case 23: //10 місяць
                case 24: //11 місяць
                    addmonth	= parseInt(getElementValue('terms_id')) - 13;
                    newdate		= date.addMonths(addmonth).addDays(-1);
                    break;
                case 25: //1 год
                    if (bmonth==2 && bday==29)
                        newdate = date.addYears(1)
                    else
                        newdate = date.addYears(1).addDays(-1);
                    break;
            }

            if (newdate != null) {
                eday		= newdate.getDate();
                emonth	= newdate.getMonth()+1;
                eyear	= newdate.getFullYear();
                if (eday<10) eday='0'+eday;
                if (emonth<10) emonth='0'+emonth;

                end_datetime_day.value	= eday;
                end_datetime_month.value	= emonth;
                end_datetime_year.value	= eyear;
                end_datetime.value=eday+'.'+	emonth+'.'+	eyear;
            }
        }
    }
}
//проверяем поля перед отправкой
function checkFields() {
    if ($('#special').attr('checked')) {

        if ($('#person_types_id option:selected').val() == '1' && $('#insurer_identification_code').val() == '') {
            alert('ІПН страхувальника обов`язкове для заповнення при оформленні акційного поліса.');
            return false;
        }

        if ($('#person_types_id option:selected').val() == '2' && $('#insurer_edrpou').val() == '') {
            alert('ЄДРПОУ страхувальника обов`язкове для заповнення при оформленні акційного поліса.');
            return false;
        }

        if (!window.confirm('Дата початку дії акційного поліса буде встановлена завтрашнім днем. Продовжити?')) {
            return false;
        }
    }

    if ($('#policy_statuses_id option:selected').val() == <?=POLICY_STATUSES_GENERATED?> &&	!window.confirm('Після зміни статусу на "Сформовано" редагування полісу стане неможливим. Продовжити?')) {
        return false;
    }

    if (($('#blank_series_old').val() != '' && $('#blank_series_old').val() != $('#blank_series').val()) ||
        ($('#blank_number_old').val() != ''  && $('#blank_number_old').val() != $('#blank_number').val())) {
            if (!window.confirm('Ви дійсно бажаєте змінити серію та номер поліса, а поліс ' + $('#blank_series_old').val() + ' ' + $('#blank_number_old').val() + ' відмити як зіпсований?')) {
                return false;
            }
    }

    document.<?=$this->objectTitle?>.end_datetime_day.disabled		= false;
    document.<?=$this->objectTitle?>.end_datetime_month.disabled	= false;
    document.<?=$this->objectTitle?>.end_datetime_year.disabled		= false;

    document.<?=$this->objectTitle?>.end_datetime_day.style.display	    = 'none';
    document.<?=$this->objectTitle?>.end_datetime_month.style.display	= 'none';
    document.<?=$this->objectTitle?>.end_datetime_year.style.display	= 'none';

    document.<?=$this->objectTitle?>.blank_series.disabled		= false;
    document.<?=$this->objectTitle?>.blank_number.disabled		= false;

    return true;
}
//меняем представителя сервиса
function changeServicePerson() {
    $.ajax({
        type:	    'POST',
        url:	    'index.php',
        dataType:   'html',
        data:	    'do=Policies|changeServicePersonInWindow' +
                    '&product_types_id=' + getElementValue('product_types_id') +
                    '&id=<?=$data['id']?>' +
                    '&service_person=' + getElementValue('service_person'),
        success: function(result) {
            alert(result);
        }
    });
}
//меняем подписанта
function changeSign() {
    $.ajax({
        type:	    'POST',
        url:	    'index.php',
        dataType:   'html',
        data:	    'do=Policies|changeSignInWindow' +
                    '&product_types_id=' + getElementValue('product_types_id') +
                    '&id=<?=$data['id']?>' +
                    '&sign=' + getElementValue('sign'),
        success: function(result) {
            alert(result);
        }
    });
}

function spoilPolicy() {
    if (!window.confirm('Ви дійсно бажаєте встановити поліс як "Зіпсований"?')) {
        return;
    }
    document.location='/index.php?do=Policies|spoilPolicy&id=<?=$data['id']?>&product_types_id=<?=$data['product_types_id']?>';
}

function copyPolicy() {
    if (!window.confirm('Ви дійсно бажаєте виписати "Дублікат" полісу?')) {
            return;
    }
    document.location='/index.php?do=Policies|copyPolicy&id=<?=$data['id']?>&product_types_id=<?=$data['product_types_id']?>';
}

function renewPolicy() {
    if (!window.confirm('Ви дійсно бажаєте переукласти поліс?')) {
        return;
    }

    var day     = $('#begin_datetime_day').val();
    var month   = $('#begin_datetime_month').val();
    var year    = $('#begin_datetime_year').val();

    if (day.substring(0,1) == '0') {
        day = day.substring(1, 2);
    }

    if (month.substring(0,1) == '0') {
        month = month.substring(1, 2);
    }

    day		= parseInt(day);
    month	= parseInt(month);
    year	= parseInt(year);

    if (day > 0 && month > 0 && year > 0 && <?=$data['policy_statuses_id']?> >= 10) {
        var d1 = new Date(year, month-1, day);
        var d2 = new Date();
        /*if (d1<d2)
        {
            alert('Неможливо переукласти поліс Дата початку Дії меньше поточної дати');
            return;
        }*/
    }

    document.location = '/index.php?do=Policies|renewPolicy&id=<?=$data['id']?>&product_types_id=<?=$data['product_types_id']?>';
}

function continuePolicy() {
    if (!window.confirm('Ви дійсно бажаєте пролонгувати поліс?')) {
        return;
    }
    document.location = '/index.php?do=Policies|continuePolicy&id=<?=$data['id']?>&product_types_id=<?=$data['product_types_id']?>';
}

function cancelPolicy(button) {
    if (!window.confirm('Ви дійсно бажаєте припинити дiю полісу?')) {
        return;
    }
    document.location = '/index.php?do=Policies|cancelPolicy&id=<?=$data['id']?>&product_types_id=<?=$data['product_types_id']?>';
}

function resetRegistrationCitiesId() {
    if ($('select[name=regions_id]').val() == 1) {
        $('#registration_cities_id_input').val('Київ');
        $('#registration_cities_id_hidden').val(1);
        $('input[name=registration_cities_title]').val($('#name=registration_cities_id_input').val());
		$('#registration_cities_id_input').attr('readonly', '');
    } else if ($('select[name=regions_id]').val() == 12) {
		$('#registration_cities_id_input').val('за межами України');
        $('#registration_cities_id_hidden').val(284);
        $('input[name=registration_cities_title]').val($('#name=registration_cities_id_input').val());
		$('#registration_cities_id_input').attr('readonly', 'readonly');
	} else {
        $('#registration_cities_id_input').val('');
        $('#registration_cities_id_hidden').val('');
		$('#registration_cities_id_input').attr('readonly', '');
    }
}

function setRegistrationCitiesId() {
    $('#registration_cities_id_hidden').val(<?=$data['registration_cities_id']?>);
    
}

function getCitiesList() {
    $.ajax({
        type:	    'POST',
        url:	    'index.php',
        dataType:   'script',
        data:	    'do=Cities|getCitiesListInWindow' +
                    '&product_types_id=' + <?=PRODUCT_TYPES_GO?>,
        success: function(result) {
            cities_list.results = cities;
            cities_list.total = cities.length;

            $('#registration_cities_id').flexbox(cities_list, {
                allowInput: true,
				paging: false,
				maxVisibleRows: 8,
                maxCacheBytes: 0,
                readOnly: <?if (!ereg('^view', $action)) echo 0; else echo 1;?>,
                noResultsText: 'Результатів не знайдено',
                compare: function(elem){
                    //console.log($('#regions_id option:selected').val());
                    if ($('#regions_id option:selected').val() > 0) {
                        if (parseInt(elem.regions_go_id) == $('#regions_id option:selected').val()) {
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        return true;
                    }
                },
                afterblur: function(elem){
                    for (var i=0; i < cities_list.total; i++) {
                        if (cities_list.results[i].id == elem) {
                            $('select[name=regions_id]').val(cities_list.results[i].regions_go_id);
                            $('input[name=registration_cities_title]').val($('#registration_cities_id_input').val());
                            changeProduct();
                            return;
                        }
                    }
                }
            });
            setRegistrationCitiesId();
            changeProduct();
            $('#registration_cities_id_input').val($('input[name=registration_cities_title]').val());
        }
    });
}


function getBonusMalus()
{
	<? if ($this->mode != 'view') { ?>
	var insurer_identification_code = $('#insurer_identification_code').val();
	var insurer_edrpou = $('#insurer_edrpou').val();
	
	var shassi = $('#shassi').val();
	
		$.ajax({
			type:       'POST',
            url:        'index.php',
            dataType:   'json',
			async:		false,
            data:       'do=Policies|getBonusMalusInWindow' +
						'&product_types_id=4'+
						'&shassi='+$('#shassi').val() +
						'&id='+$('#id').val() +
						'&insurer_edrpou='+$('#insurer_edrpou').val() +
						'&renewPolicy=<?=(ereg($_GET['do'],'renewPolicy$') || ereg($_POST['do'],'renewPolicy$') ? '1':'0')?>'+
						'&parent_id=<?=($data['parent_id'])?>'+
						'&insurer_identification_code='+$('#insurer_identification_code').val() ,
			success: setBonusMalus});
	<?}?>	

}

    function setBonusMalus(data) {
	<? if ($this->mode != 'view') { 
	if ($Authorization->data['agencies_id'] != 556 && $Authorization->data['agencies_id'] != 560 && $Authorization->data['agencies_id'] != 1492 && $Authorization->data['roles_id'] == ROLES_AGENT /*&& !$Authorization->data['alternative']*/) {
	?>
		var bonus_malus_id = document.getElementById('bonus_malus_id').options;
		if (data.bonus_malus_id==5 && bonus_malus_id.length>2) {
			bonus_malus_id.length = 0;
			bonus_malus_id[ bonus_malus_id.length ] = new Option( '...',0);
		}
		var f = false;
		for (i=0;i<bonus_malus_id.length;i++) {
			if (bonus_malus_id[i].value == data.bonus_malus_id) f=true;
		}
		if (!f) {
		 bonus_malus_id[ bonus_malus_id.length ] = new Option( data.bonus_malus_value,data.bonus_malus_id);
		} 
	<?} }?>	
    }


</script>
<? $Log->showSystem();?>
<?
if  ($action=='insert' 	) 
{
	if ($Authorization->data['roles_id']==ROLES_AGENT  	&& $Authorization->data['ukravto']==1
		&& !in_array ( $Authorization->data['agencies_id'], array(206,52,55,56, 848,15)  )
	) {}
	else {
		$Clients = new Clients($data);
		$Clients->getSearchForm($data);
	}
}
?>
<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data"  onsubmit="return checkFields()">
    <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
    <input type="hidden" id="id" name="id" value="<?=$data['id']?>" />
    <input type="hidden" id="insurance_companies_id" name="insurance_companies_id" value="<?=$data['insurance_companies_id']?>" />
    <input type="hidden" id="types_id" name="types_id" value="<?=$data['types_id']?>" />
    <input type="hidden" id="parent_id" name="parent_id" value="<?=$data['parent_id']?>" />
	<input type="hidden" id="agencies_id" name="agencies_id" value="<?=$data['agencies_id']?>" />
    <input type="hidden" id="top_agencies_id" name="top_agencies_id" value="<?=$data['top_agencies_id']?>" />
    <input type="hidden" id="product_types_id" name="product_types_id" value="<?=$data['product_types_id']?>" />
    <input type="hidden" id="clients_id" name="clients_id" value="<?=$data['clients_id']?>" />
    <? if ($action == 'update') {?>
    <input type="hidden" id="blank_series_old" name="blank_series_old" value="<?=($data['blank_series_old']) ? $data['blank_series_old'] : $data['blank_series']?>" />
    <input type="hidden" id="blank_number_old" name="blank_number_old" value="<?=($data['blank_number_old']) ? $data['blank_number_old'] : $data['blank_number']?>" />
    <? } else { ?>
    <input type="hidden" id="blank_series_old" name="blank_series_old" value="" />
    <input type="hidden" id="blank_number_old" name="blank_number_old" value="" />
    <? } ?>
    <input type="hidden" id="date_day" name="date_day" value="<?=$data['date_day']?>" />
    <input type="hidden" id="date_month" name="date_month" value="<?=$data['date_month']?>" />
    <input type="hidden" id="date_year" name="date_year" value="<?=$data['date_year']?>" />
	<input type="hidden" id="amount_parent" name="amount_parent" value="<?=doubleval($data['amount_parent'])?>" />
	<input type="hidden" id="rate_amount" name="rate_amount" value="0" />
	<input type="hidden" id="next_policy_statuses_id" name="next_policy_statuses_id" value="<?=intval($data['next_policy_statuses_id'])?>" />

	<input type="hidden" id="blank_series_parent" name="blank_series_parent" value="<?=$data['blank_series_parent']?>" />
	<input type="hidden" id="blank_number_parent" name="blank_number_parent" value="<?=$data['blank_number_parent']?>" />
    <input type="hidden" id="scopes_id" name="scopes_id" value="<?=$data['scopes_id']?>" />
    <input type="hidden" id="driver_standings_id" name="driver_standings_id" value="<?=$data['driver_standings_id']?>" />
    <input type="hidden" id="regres" name="regres" value="<?=$data['regres']?>" />
    <input type="hidden" id="otk" name="otk" value="<?=$data['otk']?>" />
	<input type="hidden" id="solutions_id" name="solutions_id" value="<?=$data['solutions_id']?>" />

	<input type="hidden" id="financial_products_id" name="financial_products_id" value="<?=intval($data['financial_products_id'])?>" />
	<input type="hidden" id="products_id" name="products_id" value="<?=intval($data['products_id'])?>" />
	<input type="hidden" id="cons_agents_id" name="cons_agents_id" value="<?=intval($data['cons_agents_id'])?>" />
	<input type="hidden" id="individual_motivation" name="individual_motivation" value="<?=intval($data['individual_motivation'])?>" />
	<input type="hidden" id="limit_property" name="limit_property" value="<?= ($data['limit_property']>0 ? $data['limit_property'] : 100000)?>" />
	<input type="hidden" id="limit_life" name="limit_life" value="<?= ($data['limit_life']>0 ? $data['limit_life'] : 200000)?>" />
	
	
	
	
    <table cellpadding="2" cellspacing="3" width="100%">
    <tr>
        <td>
            <div class="section">Параметри страхування:</div>

            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey"><?=$this->getMark()?>Особа:</td>
                <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('person_types_id') ], $data['person_types_id'], $data['languageCode'], $this->getReadonly(true) . ' onchange="changeProduct();changeSpecial();"', null, $data)?></td>
				<td class="label grey">не резидент:</td>
				<td width="100px"><input type="checkbox" value="1" name="no_resident" onchange="changeProduct();" <?=(intval($data['no_resident']) ? 'checked' : '')?> <?=$this->getReadonly(true)?> /></td>
                <td class="label grey"><?=$this->getMark()?>Автомобіль:</td>
                <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('car_types_id') ], $data[ 'car_types_id' ], $data['languageCode'], $this->getReadonly(true) . ' style="width: 140px;" onchange="changeProduct();changeCarType();changeSpecial();"', null, $data)?></td>
                <td class="label grey"><?=$this->getMark()?>Марка:</td>
                <td><select id="brands_id" name="brands_id" class="fldSelect" onfocus="this.className='fldSelectOver';" onblur="this.className='fldSelect';" onchange="changeBrand(); changeSpecial();" <?=$this->getReadonly(true)?>><?if (ereg('^view', $action)) {echo '<option value="'.$data['brands_id'].'">'.$data['brand'].'</option>';}?></select></td>
                <td class="label grey"><?=$this->getMark()?>Модель:</td>
                <td><select id="models_id" name="models_id" class="fldSelect" onfocus="this.className='fldSelectOver';" onblur="this.className='fldSelect';" onchange="changeSpecial();" <?=$this->getReadonly(true)?>><?if (ereg('^view', $action)) {echo '<option value="'.$data['models_id'].'">'.$data['model'].'</option>';}?></select></td>
                <td class="label grey" id="textLabel"><?=$this->getMark()?>Об'єм двигуна, см<sup>3</sup>:</td>
                <td><input type="text" id="engine_size" name="engine_size" value="<?=$data['engine_size']?>" maxlength="5" class="fldText flat" onfocus="this.className='fldTextOver flat'" onblur="this.className='fldText flat'; changeProduct();" <?=$this->getReadonly(false, $data['ECmode'])?> /></td>
                <td><input type="text" id="car_weight" name="car_weight" value="<?=$data['car_weight']?>" maxlength="10" class="fldText flat" onfocus="this.className='fldTextOver flat'" onblur="this.className='fldText flat'; changeProduct();" <?=$this->getReadonly(false, $data['ECmode'])?> /></td>
                <td><input type="text" id="passengers" name="passengers" value="<?=$data['passengers']?>" maxlength="4" class="fldText flat" onfocus="this.className='fldTextOver flat'" onblur="this.className='fldText flat'; changeProduct();" <?=$this->getReadonly(false, $data['ECmode'])?> /></td>
                <td class="label grey"><?=$this->getMark()?>Рік випуску:</td>
                <td><input type="text" id="year" name="year" value="<?=$data[ 'year' ]?>" maxlength="4" class="fldYear" onfocus="this.className='fldYearOver'" onblur="this.className='fldYear'" onchange="changeSpecial(); changeProduct();" <?=$this->getReadonly(false, $data['ECmode'])?> /></td>
                <td id="specialBlock"><input type="checkbox" id="special" name="special" value="1" <?=($data[ 'special' ] == 1) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /> акція</td>
            </tr>
            </table>

            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey" style="width: 110px;"><?=$this->getMark()?>Місце реєстрації:</td>
                <!--td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('registration_cities_id') ], $data['registration_cities_id'], $data['languageCode'], $this->getReadonly(true) . ' style="width: 400px;" onchange="changeProduct()"', null, $data)?></td-->
                <td>*Зона</td><td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('regions_id') ], $data['regions_id'], $data['languageCode'], $this->getReadonly(true) . ' style="width: 400px;" onchange="resetRegistrationCitiesId(); changeProduct()"', null, $data)?></td>
                <td>*Місто</td><td><div id="registration_cities_id"></div></td>
                <input type="hidden" name="registration_cities_title" value="<?=$data['registration_cities_title']?>" />
                <!--td><input type="text" name="registration_cities_title" value="<?=$data[ 'registration_cities_title' ]?>" maxlength="50" class="fldText place" onfocus="this.className='fldTextOver place'" onblur="this.className='fldText place'" <?=$this->getReadonly(false)?> /></td-->
            </tr>
            </table>

            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey"><?=$this->getMark()?>Франшиза, грн.:</td>
                <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('deductible') ], $data['deductible'], $data['languageCode'], $this->getReadonly(true) . ' onchange="changeProduct();"', null, $data)?></td>
                <td class="label grey"><?=$this->getMark()?>Термін страхування:</td>
                <td>
                    <?
                        $field = $this->formDescription['fields'][ $this->getFieldPositionByName('terms_id') ];
                        if ($data['ECmode']) {
                            $field['name'] .= '_temp';
                            echo '<input type="hidden" id="terms_id" name="terms_id" value="' . $data['terms_id'] . '" />';
                            echo $this->buildSelect($field, $data['terms_id'], $data['languageCode'], ' disabled', null, $data);
                        } else {
                            echo $this->buildSelect($field, $data['terms_id'], $data['languageCode'], $this->getReadonly(true) . ' onchange="changeProduct(); setEnd();"', null, $data);
                        }
                    ?>
                </td>
                <td class="label grey"><?=$this->getMark()?>Бонус-малус, клас: <?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('bonus_malus_id') ], $data[ 'bonus_malus_id' ], $data['languageCode'], $this->getReadonly(true) . ' onchange="changeProduct()"', null, $data)?></td>
                <td class="label grey">Генеральний договір: <?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('policies_general_id') ], $data[ 'policies_general_id' ], $data['languageCode'], $this->getReadonly(true) . ' onchange="changeProduct()"', null, $data)?></td>
				<? if ($this->mode == "view" && $Authorization->data['roles_id'] != ROLES_AGENT || $this->mode != "view") {?> 
                <td class="label grey"><?=$this->getMark()?>Знижка агента, %:</td>
                <td><input type="text" id="discount" name="discount" value="<?=$data['discount']?>"     class="fldText flat" onfocus="this.className='fldTextOver flat'" onblur="this.className='fldText flat'" <?=$this->getReadonly(true)?> /></td>
				<?} else {?>
					<input type="hidden"   name="discount" value="<?=$data['discount']?>"   />			
				<?}?>

            </tr>
            </table>

            <table id="stage3Block" cellpadding="5" cellspacing="0">
            <tr>
                <td class="grey">До керування  ТЗ допускатимуться особи з водійським стажем до 3-х років та/або водійський стаж страхувальника менше 3-х років: </td>
                <td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('stage3') ], $data['stage3' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
            </tr>
            </table>

            <table cellpadding="5" cellspacing="0">
                <tr>
                    <td class="grey">Використання: </td>
                    <td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('taxi') ], $data['taxi' ], $data['languageCode'], $this->getReadonly(true), $data)?></td>
                </tr>
            </table>

            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey">Пільги:</td>
                <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('privileges') ], $data['privileges'], $data['languageCode'], $this->getReadonly(true) . ' onchange="changeProduct();"', null, $data)?>
				<td class="label grey"><?=$this->getLink('Картка Експрес Асістанс:','card_assistance',fldText)?></td>
				<td><input type="text" name="card_assistance" id="card_assistance" value="<?=$data['card_assistance']?>" maxlength="4" class="fldText number<?=$this->isEqual('card_assistance')?>" onfocus="this.className='fldTextOver number<?=$this->isEqual('card_assistance')?>'" onblur="this.className='fldText number<?=$this->isEqual('card_assistance')?>'" <?=$this->getReadonly(false)?> /></td>

            </tr>
            </table>

            <table id="privilegesBlock" cellpadding="0" cellspacing="5" style="display: <?=($data['privileges'] > 0) ? 'block' : 'none'?>">
            <tr>
                <td class="label grey"><?=$this->getMark()?>Посвідчення, серія:</td>
                <td><input type="text" id="certificate_series" name="certificate_series" value="<?=$data['certificate_series']?>" onclick="changeProduct()" maxlength="3" class="fldText flat" onfocus="this.className='fldTextOver flat'" onblur="this.className='fldText flat'" <?=$this->getReadonly(true)?> /></td>
                <td class="label grey"><?=$this->getMark()?>Посвідчення, номер:</td>
                <td><input type="text" id="certificate_number" name="certificate_number" value="<?=$data['certificate_number']?>" onclick="changeProduct()" maxlength="8" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(true)?> /></td>
                <td class="label grey"><?=$this->getMark(false)?>Посвідчення. Ким і де видано:</td>
                <td><input type="text" id="certificate_place" name="certificate_place" value="<?=$data['certificate_place']?>" maxlength="100" class="fldText place<?=$this->isEqual('certificate_place')?>" onfocus="this.className='fldTextOver place<?=$this->isEqual('certificate_place')?>'" onblur="this.className='fldText place<?=$this->isEqual('certificate_place')?>'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey"><?=$this->getMark(false)?> Посвідчення. Дата видачі:</td>
                <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('certificate_date') ], $data['certificate_date_year' ], $data['certificate_date_month' ], $data['certificate_date_day' ], 'certificate_date', $this->getReadonly(true))?></td>
            </tr>
            </table>

            <table class="section2" width="100%" cellpadding="5" cellspacing="0">
            <tr>
                <td><b><?=$this->getLink('ТАРИФ:','',fldText)?></b></td>
                <td id="rate"><?=getMoneyFormat($data['amount_go'])?></td>
                <? if ($data['policy_statuses_id'] == POLICY_STATUSES_CANCELLED) {?>
                <td><b>Сума, що підлягає поверненню:</b><td>
                <td><?=getMoneyFormat($data['amount_return'])?></td>
                <?}?>
                <? if ($data['next_policy_statuses_id'] == POLICY_STATUSES_RENEW) {?>
                <script>
                $(function() {
                $('#begin_datetime').bind(
                        'change',
                        function()
                        {
                            $.ajax({
                                    type:		'POST',
                                    url:		'index.php',
                                    dataType:	'json',
                                    data:		'do=Policies|getPayDissolutionInWindow' +
                                                '&product_types_id=' + getElementValue('product_types_id') +
                                                '&dissolutionPercent=0' +
                                                '&id=<?=$data['parent_id']?>' +
                                                '&begin_datetime_day=' + getElementValue('begin_datetime_day') +
                                                '&begin_datetime_month=' + getElementValue('begin_datetime_month') +
                                                '&begin_datetime_year=' + getElementValue('begin_datetime_year') +
                                                '&blank_series=' + getElementValue('blank_series_parent') +
                                                '&blank_number=' + getElementValue('blank_number_parent'),
                                    success:	function(result) {
                                                    if (result.amount_return == '-1') {
                                                        alert('Помилка отримання данних про невiдпрацьованi кошти за полісом.');
                                                        return;
                                                    }
                                                    $('#amount_parentLabel').html(result.amount_return + ' грн.');
                                                    document.<?=$this->objectTitle?>.amount_parent.value= result.amount_return;
                                                    $('#amountPayment').html(getMoneyFormat(parseFloat(document.getElementById('rate_amount').value.replace(',','.'))-parseFloat(document.getElementById('amount_parent').value)));
                                                }
                            });
                        }
                    );
                });
                </script>
                <td><b>Залишок від сплаченної страхової премії:</b></td>
                <td id="amount_parentLabel"><?=getMoneyFormat($data['amount_parent'])?></td>
                <td><b>ДО СПЛАТИ:</b></td>
                <td id="amountPayment"><?=getMoneyFormat($data['amount'])?></td>
                <? } ?>
                <td width="100%">&nbsp;</td>
            </tr>
            </table>

            <div class="section">Страхувальник:</div>
            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey" id="lastnameLabel"><?=$this->getMark()?>Прізвище:</td>
                <td id="lastnameInput"><input type="text" name="insurer_lastname" value="<?=$data['insurer_lastname']?>" maxlength="150" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey" id="firstnameLabel"><?=$this->getMark()?>Ім'я:</td>
                <td id="firstnameInput"><input type="text" name="insurer_firstname" value="<?=$data['insurer_firstname']?>" maxlength="50" class="fldText firstname" onfocus="this.className='fldTextOver firstname'" onblur="this.className='fldText firstname'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey" id="patronymicnameLabel"><?=$this->getMark()?>По батькові:</td>
                <td id="patronymicnameInput"><input type="text" name="insurer_patronymicname" value="<?=$data['insurer_patronymicname']?>" maxlength="50" class="fldText patronymicname" onfocus="this.className='fldTextOver patronymicname'" onblur="this.className='fldText patronymicname'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey" id="identificationCodeLabel">ІПН (ЄДРПОУ):</td>
                <td>
                    <input type="text" name="insurer_identification_code" id="insurer_identification_code" value="<?=$data[ 'insurer_identification_code' ]?>" maxlength="10" class="fldText code" onchange="getBonusMalus();" onfocus="this.className='fldTextOver code'" onblur="this.className='fldText code'" <?=$this->getReadonly(false)?> />
                    <input type="text" name="insurer_edrpou" id="insurer_edrpou" value="<?=$data[ 'insurer_edrpou' ]?>" maxlength="10" class="fldText code" onfocus="this.className='fldTextOver code'" onblur="this.className='fldText code'" <?=$this->getReadonly(false)?> />
                </td>
            </tr>
            </table>
            <table cellpadding="5" cellspacing="0" id="insurer_id_card_table">
                <tr>
                    <td class="label grey">ID-картка:</td>
                    <td class="label grey"><input type="radio" name="insurer_id_card" onclick="setInsurerIdCard()" <?=$this->getReadonly(true)?> value="1" <?= (intval($data['insurer_id_card'])?'checked':'') ?> /></td>
                    <td>Так</td>
                    <td class="label grey"><input type="radio" name="insurer_id_card" onclick="setInsurerIdCard()" <?=$this->getReadonly(true)?> value="0" <?= (intval($data['insurer_id_card'])?'':'checked') ?> /></td>
                    <td>Ні</td>
                </tr>
            </table>
            <table cellpadding="5" cellspacing="0" id="passport" <?= (intval($data['insurer_id_card'])?'style="display:none"':'') ?>>
            <tr>
                <td class="label grey"><?=$this->getMark(false)?>Паспорт, серія і номер:</td>
                <td>
                    <input type="text" id="insurer_passport_series" name="insurer_passport_series" value="<?=$data['insurer_passport_series']?>" maxlength="5" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly(false)?> />
                    <input type="text" id="insurer_passport_number" name="insurer_passport_number" value="<?=$data['insurer_passport_number']?>" maxlength="13" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> />
                </td>
                <td class="label grey"><?=$this->getMark(false)?>Паспорт. Ким і де виданий :</td>
                <td><input type="text" id="insurer_passport_place" name="insurer_passport_place" value="<?=$data['insurer_passport_place']?>" maxlength="100" class="fldText place<?=$this->isEqual('insurer_passport_place')?>" onfocus="this.className='fldTextOver place<?=$this->isEqual('insurer_passport_place')?>'" onblur="this.className='fldText place<?=$this->isEqual('insurer_passport_place')?>'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey"><?=$this->getMark(false)?> Паспорт. Дата видачі :</td>
                <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_passport_date') ], $data['insurer_passport_date_year' ], $data['insurer_passport_date_month' ], $data['insurer_passport_date_day' ], 'insurer_passport_date', $this->getReadonly(true))?></td>
            </tr>
            </table>
            <table cellpadding="5" cellspacing="0" <?= (intval($data['insurer_id_card'])?'':'style="display:none"') ?> id="insurer_new_passport_table">
                <tr>
                    <td class="label grey">Паспорт. Номер:</td>
                    <td><input type="text" name="insurer_newpassport_number" value="<?=$data['insurer_newpassport_number']?>" maxlength="9" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
                    <td>Паспорт. Ким і де виданий:</td>
                    <td><input type="text" name="insurer_newpassport_place" value="<?=$data['insurer_newpassport_place']?>" maxlength="15" class="fldInteger number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
                    <td>Паспорт. Дата видачі:</td>
                    <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_date') ], $data['insurer_newpassport_date_year' ], $data['insurer_newpassport_date_month' ], $data['insurer_newpassport_date_day' ], 'insurer_newpassport_date', $this->getReadonly(true))?></td>
                    <td>
                        Унікальний номер запису в реєстрі:
                    </td>
                    <td>
                        <input type="text" name="insurer_newpassport_reestr" value="<?= $data['insurer_newpassport_reestr'] ?>" maxlength="14" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> />
                    </td>
                    <td>
                        Дійсний до:
                    </td>
                    <td>
                        <?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_newpassport_dateEnd') ], $data['insurer_newpassport_dateEnd_year' ], $data['insurer_newpassport_dateEnd_month' ], $data['insurer_newpassport_dateEnd_day' ], 'insurer_newpassport_dateEnd', $this->getReadonly(true))?>
                    </td>
                </tr>
            </table>
            <table cellpadding="5" cellspacing="0" id="birth">
                <tr>
                    <td class="label grey"><?=$this->getMark(false)?>Дата народження:</td>
                    <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_dateofbirth') ], $data['insurer_dateofbirth_year' ], $data['insurer_dateofbirth_month' ], $data['insurer_dateofbirth_day' ], 'insurer_dateofbirth', $this->getReadonly(true))?></td>
                </tr>
            </table>
            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey">Індекс:</td>
                <td><input type="text" name="insurer_zip" value="<?=$data['insurer_zip']?>" maxlength="5" class="fldText zip" onfocus="this.className='fldTextOver zip'" onblur="this.className='fldText zip'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey"><?=$this->getMark()?>Область:</td>
                <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_regions_id') ], $data['insurer_regions_id'], $data['languageCode'], $this->getReadonly(true), null, $data)?></td>
                <td class="label grey">Район:</td>
                <td><input type="text" id="insurer_area" name="insurer_area" value="<?=$data['insurer_area']?>" maxlength="50" class="fldText city<?=$this->isEqual('insurer_area')?>" onfocus="this.className='fldTextOver city<?=$this->isEqual('insurer_area')?>'" onblur="this.className='fldText city<?=$this->isEqual('insurer_area')?>'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey"><?=$this->getMark()?>Місто:</td>
                <td><input type="text" name="insurer_city" value="<?=$data['insurer_city']?>" maxlength="50" class="fldText city" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
              </tr>
            </table>
            <table cellpadding="5" cellspacing="0">
            <tr>
               <td class="label grey"><?=$this->getMark()?>Вулиця:</td>
                <td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('insurer_street_types_id') ], $data['insurer_street_types_id'], $data['languageCode'], $this->getReadonly(true), null, $data, $this->isEqual('insurer_street_types_id'))?><input type="text" name="insurer_street" value="<?=$data['insurer_street']?>" maxlength="50" class="fldText street" onfocus="this.className='fldTextOver street'" onblur="this.className='fldText street'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey"><?=$this->getMark()?>Будинок:</td>
                <td><input type="text" name="insurer_house" value="<?=$data['insurer_house']?>" maxlength="10" class="fldText house" onfocus="this.className='fldTextOver house'" onblur="this.className='fldText house'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey">Квартира:</td>
                <td><input type="text" name="insurer_flat" value="<?=$data['insurer_flat']?>" maxlength="10" class="fldText flat" onfocus="this.className='fldTextOver flat'" onblur="this.className='fldText flat'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey"><?=$this->getMark()?>Телефон:</td>
                <td><input type="text" id="insurer_phone" name="insurer_phone" value="<?=$data['insurer_phone']?>" maxlength="15" class="fldText phone" onfocus="this.className='fldTextOver phone'" onblur="this.className='fldText phone'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey">E-mail:</td>
                <td><input type="text" name="insurer_email" value="<?=$data['insurer_email']?>" maxlength="50" class="fldText email" onfocus="this.className='fldTextOver email'" onblur="this.className='fldText email'" <?=$this->getReadonly(false)?> /></td>
            </tr>
            </table>

            <div class="section">Дані щодо автомобіля:</div>
            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey"><?=$this->getMark()?>№ шасі (кузов, рама):</td>
                <td><input type="text" name="shassi" id="shassi" value="<?=$data[ 'shassi' ]?>" onchange="getBonusMalus();"   maxlength="20" class="fldText shassi" onfocus="this.className='fldTextOver shassi'" onblur="this.className='fldText shassi'" <?=$this->getReadonly(false, $data['ECmode'])?> /></td>
                <td class="label grey">Державний знак (реєстраційний №):</td>
                <td><input id="sign" type="text" name="sign" value="<?=$data[ 'sign' ]?>" maxlength="15" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" autocomplete="off" /></td>
                <? if ($this->mode != 'update') {?>
                    <td><input type="button" value=" Змiнити " onclick="changeSign();" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" /></td>
                <? } ?>
            </tr>
            </table>
            <table cellpadding="0" cellspacing="0">
            <tr>
                <!--td class="grey">ТЗ підлягає обов’язковому технічному контролю (ОТК): </td>
                <td><?=$this->buildRadio($this->formDescription['fields'][ $this->getFieldPositionByName('otk') ], $data['otk' ], $data['languageCode'], $this->getReadonly(true), $data)?></td-->
                <td>
                    <table id="otkBlock" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="grey"><?=$this->getMark()?>Визнаний технічно справним згідно з:</td>
                        <td><input type="text" id="otknumber" name="otknumber" value="<?=$data['otknumber']?>"   class="fldText company " onfocus="this.className='fldTextOver company '" onblur="this.className='fldText company '" <?=$this->getReadonly(false)?> /></td>
                        <td><?=$this->getMark()?> Дата наступного ОТК:</td>
                        <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('otkdate') ], $data['otkdate_year' ], $data['otkdate_month' ], $data['otkdate_day' ], 'otkdate', $this->getReadonly(true))?></td>
                    </tr>
                    </table>
                </td>
            </tr>
            </table><br />
                                
            <div class="section">Термін, бланк, стікер:</div>
            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey"><?=$this->getMark()?>Дата та час початку дії поліса:</td>
                <td><?=$this->getDateTimeSelect($this->formDescription['fields'][ $this->getFieldPositionByName('begin_datetime') ], $data[ 'begin_datetime_year' ], $data[ 'begin_datetime_month' ], $data[ 'begin_datetime_day' ], $data[ 'begin_datetime_hour' ], $data[ 'begin_datetime_minute' ], 'begin_datetime', 'id="begin_datetime" ' . $this->getReadonly(true))?></td>
                <td class="label grey"><?=$this->getMark()?>Дата закінчення дії поліса:</td>
                <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('end_datetime') ], $data[ 'end_datetime_year' ], $data[ 'end_datetime_month' ], $data[ 'end_datetime_day' ], 'end_datetime', ' disabled ' . $this->getReadonly(true))?></td>
            </tr>
            </table>
            <table width="100%" cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey">Примітка:</td>
                <td width="100%"><input type="text" name="comment" value="<?=$data[ 'comment' ]?>" maxlength="255" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false)?> /></td>
            </tr>
			<? if (in_array($Authorization->data['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER))) { ?>
				<tr>
					<td class="label grey">Коментар андерайтера:</td>
					<td width="100%"><textarea id="comment_quote" name="comment_quote" class="fldNote" onfocus="this.className='fldNoteOver';" onblur="this.className='fldNote';" <?=$this->getReadonly()?>><?=$data['comment_quote']?></textarea></td>
				</tr>
			<? } ?>
            </table>

            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey"><?=$this->getMark()?>Серія поліса:</td>
                <td><input type="text" id="blank_series" name="blank_series" value="<?=$data[ 'blank_series' ]?>" maxlength="2" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly(false)?> <?=($data['policy_statuses_id']==POLICY_STATUSES_GENERATED && $action=='update' ? 'disabled':'')?>/></td>
                <td class="label grey"><?=$this->getMark()?>Номер поліса:</td>
                <td><input type="text" id="blank_number" name="blank_number" value="<?=$data[ 'blank_number' ]?>" maxlength="7" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey"><?=$this->getMark()?>Серія стікера:</td>
                <td><input type="text" name="stiker_series" value="<?=$data[ 'stiker_series' ]?>" maxlength="2" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly(false)?> /></td>
                <td class="label grey"><?=$this->getMark()?>Номер стікера:</td>
                <td><input type="text" name="stiker_number" value="<?=$data[ 'stiker_number' ]?>" maxlength="7" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'"  /></td>
            </tr>
            </table>
            <? if ($data[ 'certificate' ]) {?>
            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey"><?=$this->getMark()?>Сертифікат на 500 грн.:</td>
                <td><?=($data[ 'certificate' ] ? $data[ 'certificate' ] : 'вiдсутнiй')?><input type="hidden" name="certificate" value="<?=$data[ 'certificate' ]?>" /></td>
            </tr>
            </table>
            <?}?>
            <div class="section">Оплата:</div>
            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey">Дата та час сплати:</td>
                <td><?=$this->getDateTimeSelect($this->formDescription['fields'][ $this->getFieldPositionByName('payment_datetime') ], $data[ 'payment_datetime_year' ], $data[ 'payment_datetime_month' ], $data[ 'payment_datetime_day' ], $data[ 'payment_datetime_hour' ], $data[ 'payment_datetime_minute' ], 'payment_datetime', $this->getReadonly(true))?></td>
                <td class="label grey">Номер квитанції:</td>
                <td><input type="text" name="payment_number" id="payment_number" value="<?=$data[ 'payment_number' ]?>" maxlength="15" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly(false)?> /></td>
            </tr>
            </table>

            <div class="section">Додатково:</div>
            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey"><?=$this->getMark()?>Статус:</td>
                <td>
                <?
                    $field = $this->formDescription['fields'][ $this->getFieldPositionByName('policy_statuses_id') ];
                    if ($data['ECmode'] && $data['financial_institutions_id']==35) {
                        $field['name'] .= '_temp';
                        echo '<input type="hidden" id="policy_statuses_id" name="policy_statuses_id" value="' . $data['policy_statuses_id'] . '" />';
                        echo $this->buildSelect($field, $data['policy_statuses_id'], $data['languageCode'], ' disabled', null, $data);
                    } else {
                        echo $this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('policy_statuses_id') ], $data['policy_statuses_id'], $data['languageCode'], ' ' . $this->getReadonly(true), null, $data, $this->isEqual('policy_statuses_id'));
                    }
                ?>
                </td>
				<td class="label grey client_manager">Сторонiй клiєнт:</td>
				<td class="client_manager"><input id="outside_client" type="checkbox" name="outside_client" value="1" <?if ($data['outside_client']==1) echo 'checked';?> <?=$this->getReadonly(true)?> /></td>
				<? if ($data['cons_agents_id']==0) { ?>
				<td class="label grey client_manager"><?=$this->getMark()?>Менеджер що привiв клiєнта:</td>
				<td class="client_manager" id="selectsellermanager">
					<?if (ereg('^view', $action)) {?>
						<b><?=$data['manager_fio']?></b>
					<?} else {?>
						<?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('manager_id')], $data['manager_id'], $data['languageCode'], $this->getReadonly($data) . ' onchange=""', null, $data, $this->isEqual('manager_id'))?>
					<?}?>
				</td>
				<? if ($data['individual_motivation'] && ($Authorization->data['roles_id'] == ROLES_AGENT || $Authorization->data['roles_id'] != ROLES_AGENT)) {?>
				<td>
				% КВ для МП:
				<input id="motivation_manager_percent" class="fldPercent flat" type="text" onblur="this.className='fldPercent flat'" onfocus="this.className='fldPercent flat'" maxlength="10" value="<?=$data['motivation_manager_percent']?>" name="motivation_manager_percent" <?=$this->getReadonly(true)?> >
				</td>		
				<?}?>
				<?
				}  else {
						echo '<td>Створив консультацiю: '.$data['cons_agents_fio'].'</td>';
					}
				?>
				
				
				
                <? if ($Authorization->data['service'] || $data['service_person'] || $Authorization->data['id'] == 0) {//показываем только для тех полисов где есть сотрудник СТО или продажи идут с участием СТО ?>
                <!--<td class="label grey">Представник СТО:</td>
                <td><input type="text" id="service_person" name="service_person" value="<?=$data['service_person']?>" maxlength="70" class="fldText email<?=$this->isEqual('service_person')?>" onfocus="this.className='fldTextOver email'" onblur="this.className='fldText email'" /></td>-->
                <? if ($this->mode != 'update') {?>
                <td><input type="button" value=" Змiнити " onclick="changeServicePerson();" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" /></td>
                <? } ?>
                <? } ?>
				<?if (ereg('^view', $action)) {?>
				<td>
				Нове авто мережi Укравто: <input type="checkbox" style="color: #666666; background-color: #f5f5f5;" disabled=""   name="axapta_car" value="1" <?=$data['axapta_car']>0 ? 'checked' : ''?>>
				</td>
				<?}?>
				
				<?
						if ($change_seller) {
							echo '<td>';
							echo 'Агенція продавець: ';
							echo '<select '.$this->getReadonly().' name="seller_agencies_id" id="seller_agencies_id" class="fldSelect" onfocus="this.className=\'fldSelectOver\'" onblur="this.className=\'fldSelect\'" style="width: 250px;">';
							echo '<option value="">...</option>';
							$agencies = $data['seller_agencies'];
							foreach ($agencies as $agency) {
								echo ($agency['id'] == $data['seller_agencies_id'])
									? '<option value="' . $agency['id'] . '" selected>' . str_repeat('&nbsp;', ($agency['level'] - 1) * 3) . $agency['code'] . ' - ' . $agency['title'] . '</option>'
									: '<option value="' . $agency['id'] . '">' . str_repeat('&nbsp;', ($agency['level'] - 1) * 3) . $agency['code'] . ' - ' . $agency['title'] . '</option>';
							}
							echo '</select>';
							echo '</td>';
							echo '<td>Менеджер продавець:</td>
							<td id="selectmanager">
								<b>'.$data['seller_agents_fio'].'</b>
							</td>';
						}
						else {
							echo '<input type="hidden" id="seller_agencies_id" name="seller_agencies_id" value="'.intval($data['seller_agencies_id']).'" />
							<input type="hidden" id="seller_agents_id" name="seller_agents_id" value="'.intval($data['seller_agents_id']).'" />
							';
						}
                ?>
            </tr>
            </table>

            <? if ($data['blank_series_parent'] || $data['blank_number_parent']) {?>
            <input type="hidden" name="blank_series_parent" id="blank_series_parent" value="<?=$data['blank_series_parent']?>" />
            <input type="hidden" name="blank_number_parent" id="blank_number_parent" value="<?=$data['blank_number_parent']?>" />
            <table cellpadding="5" cellspacing="0">
            <tr>
                <td class="label grey"><?=$this->getMark()?>Серія поліса оригіналу:</td>
                <td><input type="text" id="blank_series_parent1" name="blank_series_parent1" value="<?=$data[ 'blank_series_parent' ]?>" maxlength="2" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" disabled style="color: #666666; background-color: #f5f5f5;" /></td>
                <td class="label grey"><?=$this->getMark()?>Номер поліса оригіналу:</td>
                <td><input type="text" id="blank_number_parent1" name="blank_number_parent1" value="<?=$data[ 'blank_number_parent' ]?>" maxlength="7" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" disabled style="color: #666666; background-color: #f5f5f5;" /></td>
            </tr>
            </table>
            <? } ?>
			<?if (ereg('^view', $action)  && ($Authorization->data['permissions']['Policies_KASKO']['superupdate'] || $Authorization->data['id']==1)) {?>
				<a style="color:red" href="JavaScript:makeRitale()">Встановити старий тариф</a>
				<script type="text/javascript">
					function makeRitale() {
						$.ajax({
						type:       'POST',
						url:        'index.php',
						dataType:   'json',
						data:       'do=Policies|setOldRateInWindow' +
									'&product_types_id=4'+
									'&id=<?=$data['id']?>' ,
							success: function(result) {
								 alert(result.text);
							}
						}); 
					}
				</script>
			<?}?>
        </td>
    </tr>
    </table>
</form>
<script type="text/javascript">
	$('.driver_standingsBlock').css('display', 'none');

	$(document).ready(function() {
        getCitiesList();

        <?if (!ereg('^view', $action)) {?>setCar();<?}?>
        changeSpecial('<?=$data['brands_id']?>', '<?=$data['models_id']?>');
        changeProduct();
        initFocus(document.<?=$this->objectTitle?>);

		$('input[name="taxi"]').bind('change',
			function() {changeProduct();}
		);
		$('input[name="stage3"]').bind('change',
			function() {/*setDriverStandingsId();*/changeProduct();}
		);
		getBonusMalus();
		<?
			if ($change_seller) {
			?>
			
			$('#seller_agencies_id').bind('change', function() {
				loadManagers();
			});

			function loadManagers()
			{
				$.ajax({
				type:       'POST',
				url:        'index.php',
				dataType:   'html',
				data:       'do=Policies|loadAgentsInWindow' +
							'&agencies_id=' + getElementValue('seller_agencies_id') +
							'&product_types_id=' + getElementValue('product_types_id') +
							'&agent_field=seller_agents_id'+
							'&old_agents_id=<?=intval($data['seller_agents_id'])?>',
					success: function(result) {
						document.getElementById('selectmanager').innerHTML=result;
					}
				});
				
				$.ajax({
				type:       'POST',
				url:        'index.php',
				dataType:   'html',
				data:       'do=Policies|loadAgentsInWindow' +
							'&agencies_id=' + getElementValue('seller_agencies_id') +
							'&product_types_id=' + getElementValue('product_types_id') +
							'&agent_field=manager_id'+
							'&isseller=1'+
							'&old_agents_id=<?=intval($data['manager_id'])?>',
					success: function(result) {
						document.getElementById('selectsellermanager').innerHTML=result;
					}
				});
			}
			loadManagers();
			<?
			}
			?>
	});

$(document).ready(function() {
	/*$('input[name="otk"]').bind('change',
        function() {showHideOTKBlock();}
    );*/
	showHideOTKBlock();


});
$(function() {
    $('#begin_datetime').bind(
        'change',
        function() {
            setEnd();
        }
    );
});
</script>