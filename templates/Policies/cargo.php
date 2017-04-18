<link type="text/css" href="/js/jquery/thickbox.css" rel="stylesheet" media="screen" />
<script type="text/javascript" src="/js/jquery/thickbox.js"></script>
<script type="text/javascript">
    var num = -1;

    function changeItemType(itemTypes) {

        for(i=document.getElementById('items').rows.length; i > 0; i--) {
            document.getElementById('items').deleteRow(i - 1);
        }

        num = -1;
        addItem();
    }

    function addItem() {
        var row	= document.getElementById('items').insertRow(-1);
        row.style.background = (document.getElementById('items').rows.length % 2 == 0) ? '#FFFFFF' : '#F0F0F0';

        var cell = row.insertCell(0);

        switch (document.getElementById('item_types_id').options[ document.getElementById('item_types_id').selectedIndex ].value) {
            case '1'://грузы
			case '3':
			case '4':
			case '5':
                cell.innerHTML	=
                    '<table cellpadding="5" cellspacing="0">' +
                    '<tr>' +
                    '<td class="label grey"><?=$this->getMark()?>Кількість місць, шт.:</td>' +
                    '<td><input type="text" name="items[' + num + '][quantity]" value="" maxlength="100" class="fldText email" onfocus="this.className=\'fldTextOver email\'" onblur="this.className=\'fldText email\'" /></td>' +
                    '<td class="label grey">Упаковка:</td>' +
                    '<td><input type="text" name="items[' + num + '][packing]" value=""  class="fldText code" onfocus="this.className=\'fldTextOver code\'" onblur="this.className=\'fldText code\'" /></td>' +
                    '<td class="label grey"><?=$this->getMark()?>Вага, кг.:</td>' +
                    '<td><input type="text" name="items[' + num + '][weight]" value="" maxlength="10" class="fldInteger" onfocus="this.className=\'fldIntegerOver\'" onblur="this.className=\'fldInteger\'" /></td>' +
                    '<td class="label grey"><?=$this->getMark()?>Вартість, грн.:</td>' +
                    '<td><input type="text" name="items[' + num + '][price]" value="" maxlength="14" class="fldMoney" onfocus="this.className=\'fldMoneyOver\'" onblur="this.className=\'fldMoney\'" onchange="changeRate()" /></td>' +
                    '<td class="label grey">Вартість, $:</td>' +
                    '<td><input type="text" name="items[' + num + '][price_usd]" value="" maxlength="14" class="fldMoney" onfocus="this.className=\'fldMoneyOver\'" onblur="this.className=\'fldMoney\'" onchange="changeRate()" /></td>' +
                    '</tr>' +
                    '</table>' +
                    '<table cellpadding="5" cellspacing="0">' +
                    '<tr>' +
                    '<td class="label grey"><?=$this->getMark()?>ТТН, номер і дата:</td>' +
                    '<td><input type="text" name="items[' + num + '][document_number]" value="" class="fldText email" onfocus="this.className=\'fldTextOver email\'" onblur="this.className=\'fldText email\'" /></td>' +
                    '<td><input type="text" id="items'+num+'document_date" name="items[' + num + '][document_date]" maxlength="10" class="fldDatePicker" onfocus="this.className=\'fldDatePickerOver\'" onblur="this.className=\'fldDatePicker\'" /></td>' +
                    '</tr>' +
                    '</table>';
                break;
            case '2'://автомобили
<?
$car_type = '<select id="items\' + num + \'car_types_id" name="items[\' + num + \'][car_types_id]" onchange="changeCarType(this);" class="fldSelect" onfocus="this.className=\\\'fldSelectOver\\\';" onblur="this.className=\\\'fldSelect\\\';">';
foreach ($data['car_types']['list'] as $row) {
    $car_type .= '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
}
$car_type .= '</select>';
?>

                cell.innerHTML	=
                    '<table cellpadding="5" cellspacing="0">' +
                    '<tr>' +
                    '<td class="label grey"><?=$this->getMark()?>Тип ТЗ:</td>' +
                    '<td><?=$car_type?></td>' +
                    '<td class="label grey"><?=$this->getMark()?>Марка:</td>' +
                    '<td><select id="items' + num + 'brands_id" name="items[' + num + '][brands_id]" onchange="changeBrand(document.getElementById(\'items' + num + 'car_types_id\'))" class="fldSelect" onfocus="this.className=\'fldSelectOver\';" onblur="this.className=\'fldSelect\';"></select></td>' +
                    '<td class="label grey"><?=$this->getMark()?>Модель:</td>' +
                    '<td><select id="items' + num + 'models_id" name="items[' + num + '][models_id]" class="fldSelect" onfocus="this.className=\'fldSelectOver\';" onblur="this.className=\'fldSelect\';"></select></td>' +
                    '</tr>'+
                    '</table>' +

                    '<table cellpadding="5" cellspacing="0">' +
                    '<tr>' +
                    '<td class="label grey"><?=$this->getMark()?>№ шасі (кузов, рама):</td>' +
                    '<td><input type="text" name="items[' + num + '][shassi]" value="" maxlength="28" class="fldText shassi" onfocus="this.className=\'fldTextOver shassi\'" onblur="this.className=\'fldText shassi\'" /></td>' +
                    '<td class="label grey"><?=$this->getMark()?>Вартість, грн.:</td>' +
                    '<td><input type="text" name="items[' + num + '][price]" value="" maxlength="14" class="fldMoney" onfocus="this.className=\'fldMoneyOver\'" onblur="this.className=\'fldMoney\'" onchange="changeRate()" /></td>' +
                    '<td class="label grey">Вартість, $:</td>' +
                    '<td><input type="text" name="items[' + num + '][price_usd]" value="" maxlength="14" class="fldMoney" onfocus="this.className=\'fldMoneyOver\'" onblur="this.className=\'fldMoney\'" onchange="changeRate()" /></td>' +
                    '</tr>' +
                    '</table>' +

                    '<table cellpadding="5" cellspacing="0">' +
                    '<tr>' +
                    '<td class="label grey"><?=$this->getMark()?>ТТН, номер і дата:</td>' +
                    '<td><input type="text" name="items[' + num + '][document_number]" value="" class="fldText email" onfocus="this.className=\'fldTextOver email\'" onblur="this.className=\'fldText email\'" /></td>' +
                    '<td><input type="text" id="items'+num+'document_date" name="items[' + num + '][document_date]" maxlength="10" class="fldDatePicker" onfocus="this.className=\'fldDatePickerOver\'" onblur="this.className=\'fldDatePicker\'" /></td>' +
                    '</tr>' +
                    '</table>';

                <?='setBrands(document.getElementById(\'items\' + num + \'car_types_id\'), 0);' . "\r\n";?>
                <?='setModels(document.getElementById(\'items\' + num + \'car_types_id\'), 0);' . "\r\n";?>
                break;
        }

        var clients_id = getElementValue('clients_id');
        var item_types_id = getElementValue('item_types_id');

        cell.innerHTML +=
            '<table cellpadding="5" cellspacing="0">' +
            '<tr>' +
            '<td class="label grey"><?=$this->getMark()?>Пункт відправлення:</td>' +
            '<td><input id="items' + num + 'send" type="text" name="items[' + num + '][send]" value="" maxlength="100" autocomplete="off" class="fldText city autocompletecity" onfocus="$(this).autocomplete(cities);this.className=\'fldTextOver city autocompletecity\'" onblur="this.className=\'fldText city autocompletecity\'; <?=($data['clients_id'] == CLIENTS_AUTOZAZ) ? '$(\\\'#items\' + num +\'sender\\\').val(this.value)' : ''?>" /></td>' +
            '<td class="label grey"><?=$this->getMark()?>Відправник:</td>' +
            '<td><input type="text" id="items' + num + 'sender" name="items[' + num + '][sender]" value="" maxlength="100" class="fldText city autocompletedialers" onfocus="$(this).autocomplete(dialers);this.className=\'fldTextOver city\'" onblur="this.className=\'fldText city\'" /></td>' +
            '<td class="label grey"><?=$this->getMark()?>Пункт призначення:</td>' +
            '<td><input type="text" name="items[' + num + '][destination]" value="" maxlength="100" autocomplete="off" class="fldText city autocompletecity" onfocus="$(this).autocomplete(cities);this.className=\'fldTextOver city autocompletecity\'" onblur="this.className=\'fldText city autocompletecity\'; <?=($data['clients_id'] == CLIENTS_AUTOZAZ) ? '$(\\\'#items\' + num +\'recipient\\\').val(this.value)' : ''?>" /></td>' +
            '<td class="label grey"><?=$this->getMark()?>Отримувач:</td>' +
            '<td><input type="text" id="items' + num + 'recipient" name="items[' + num + '][recipient]" value="" maxlength="200" class="fldText city autocompletedialers" onfocus="$(this).autocomplete(dialers);this.className=\'fldTextOver city\'" onblur="this.className=\'fldText city\'" /></td>' +
            '</tr>' +

            '<tr>' +
            '<td class="label grey">Пункт відправлення (Англ):</td>' +
            '<td><input id="items' + num + 'send_en" type="text" name="items[' + num + '][send_en]" value="" maxlength="100" autocomplete="off" class="fldText city autocompletecity" onfocus="$(this).autocomplete(cities);this.className=\'fldTextOver city autocompletecity\'" onblur="this.className=\'fldText city autocompletecity\'; <?=($data['clients_id'] == CLIENTS_AUTOZAZ) ? '$(\\\'#items\' + num +\'sender_en\\\').val(this.value)' : ''?>" /></td>' +
            '<td class="label grey">Відправник (Англ):</td>' +
            '<td><input type="text" id="items' + num + 'sender_en" name="items[' + num + '][sender_en]" value="" maxlength="100" class="fldText city autocompletedialers" onfocus="this.className=\'fldTextOver city\'" onblur="this.className=\'fldText city\'" /></td>' +
            '<td class="label grey">Пункт призначення (Англ):</td>' +
            '<td><input type="text" name="items[' + num + '][destination_en]" value="" maxlength="100" autocomplete="off" class="fldText city autocompletecity" onfocus="$(this).autocomplete(cities);this.className=\'fldTextOver city autocompletecity\'" onblur="this.className=\'fldText city autocompletecity\'; <?=($data['clients_id'] == CLIENTS_AUTOZAZ) ? '$(\\\'#items\' + num +\'recipient_en\\\').val(this.value)' : ''?>" /></td>' +
            '<td class="label grey">Отримувач (Англ):</td>' +
            '<td><input type="text" id="items' + num + 'recipient_en" name="items[' + num + '][recipient_en]" value="" maxlength="200" class="fldText city autocompletedialers" onfocus="$(this).autocomplete(cities);this.className=\'fldTextOver city\'" onblur="this.className=\'fldText city\'" /></td>' +
            '</tr>' +

            '</table>';

        cell.style.borderBottom = 'solid 1px #EBEBEB';

        cell			= row.insertCell(-1);
        cell.innerHTML          = '<A id="deleteitem' + num + '" href="JavaScript:deleteItem(\'deleteitem'+num+'\') "><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити"  />';
        cell.style.borderBottom = 'solid 1px #EBEBEB';

        num--;

        /*$(function() {
			$('.autocompletecity').bind('focus', function() {
				$('.autocompletecity').autocomplete(cities);
			});
			$('.autocompletecity').bind('click', function() {
				$('.autocompletecity').autocomplete(cities);
			});
        });*/

		initDatePicker();
    }

    function deleteItem(objId) {
		obj=document.getElementById(objId);
        if (confirm('Ви дійсно бажаєте вилучити вибраний вантаж?')) {
            document.getElementById('items').deleteRow( obj.parentNode.parentNode.sectionRowIndex );

            for(i=0; i<document.getElementById('items').rows.length; i++) {
                document.getElementById('items').rows[ i ].style.background = (i % 2 != 0) ? '#FFFFFF' : '#F0F0F0';
            }
        }
    }

    function getTotalByName(form, name) {
        var total = 0;

        for (i=0; i < form.length; i++) {
            if (form.elements[ i ].name.indexOf('[' + name + ']') != -1) {
                if (form.elements[ i ].value != '' && isNaN(parseFloat(form.elements[ i ].value.replace(',', '.')))) {
                    alert('Формат вартості не вірний!');
                    form.elements[ i ].value = '';
                    return 0;
                } else {
                    total += parseFloat(form.elements[ i ].value.replace(',', '.'));
                }
            }
        }

        return total;
    }

    function getPoliciesGeneral(policies_general_id) {
		$.ajax({
			type:       'POST',
            url:        'index.php',
			dataType:   'script',
			data:       'do=Certificates|getPoliciesGeneralInWindow' +
						'&product_types_id=<?=PRODUCT_TYPES_CARGO_GENERAL?>' +
						'&clients_id=' + getElementValue('clients_id') +
						'&date=' + getElementValue('date_year') + getElementValue('date_month') + getElementValue('date_day'),
			success:    function (result) {
							var policies_general = document.getElementById('policies_general_id');

							policies_general.options.length = 0;
							policies_general.options[ 0 ] = new Option( '...', 0);

							for(i=0; i < policies.length; i++) {
								policies_general.options[ i + 1 ] = new Option( policies[ i ][ 1 ], policies[ i ][ 0 ]);
								if (policies_general_id == policies[ i ][ 0 ]) {
									policies_general.selectedIndex = i + 1;
								}
							}
						}
		})
    }

    function setRate(data) {
		var price_usd = getTotalByName(document.<?=$this->objectTitle?>, 'price_usd');
		$('#price').html(data.price + ' грн.; ' + price_usd + ' $');
		$('#deductible').html(data.deductibles_value + ((data.deductibles_absolute == 0) ? ' %' : ' грн.'));
        $('#rate').html(data.rate + '%, ' + data.amount + ' грн., ' + getMoneyFormat(data.rate * price_usd / 100) + ' $');
    }

    function changeRate() {
        var price   = getTotalByName(document.<?=$this->objectTitle?>, 'price');

        if (price > 0 && getElementValue('policies_general_id') > 0) {
            $.ajax({
                type:       'POST',
                url:        'index.php',
                dataType:   'json',
                data:       'do=Policies|getRateInWindow' +
							'&product_types_id=' + getElementValue('product_types_id') +
							'&policies_general_id=' + getElementValue('policies_general_id') +
							'&item_types_id=' + getElementValue('item_types_id') +
							'&price=' + price +
							'&begin_datetime=' + getElementValue('begin_datetime_year') + getElementValue('begin_datetime_month') + getElementValue('begin_datetime_day') +
							'&end_datetime=' + getElementValue('end_datetime_year') + getElementValue('end_datetime_month') + getElementValue('end_datetime_day'),
                success:    setRate
            })
        } else {
			$('#deductible').html('');
			$('#rate').html('');
        }
    }

    function setBrands(car_type, brands_id) {
        var car_types_id = car_type.options[ car_type.selectedIndex ].value;

        var brand = document.getElementById( car_type.id.replace('car_types_id', 'brands_id') );
        brand.options.length = 0;

        var model = document.getElementById( car_type.id.replace('car_types_id', 'models_id') );
        model.options.length = 0;

        for (var i=0; i < cars.length; i++) {
            if (car_types_id == cars[ i ][ 0 ] ) {
                for (var j=0; j < cars[ i ][1].length; j++) {
                    brand.options[ j ] = new Option( cars[ i ][ 1 ][ j ][ 1 ], cars[ i ][ 1 ][ j ][ 0 ]);
                    if (brands_id == cars[ i ][ 1 ][ j ][ 0 ]) {
                        brand.selectedIndex = j;
                    }
                }
                break;
            }
        }
    }

    function setModels(car_type, models_id) {

        var car_types_id = car_type.options[ car_type.selectedIndex ].value;

        var brand = document.getElementById( car_type.id.replace('car_types_id', 'brands_id') );

        if (brand.selectedIndex == -1) {
            return;
        }

        var brands_id = brand.options[ brand.selectedIndex ].value;
        var model = document.getElementById( car_type.id.replace('car_types_id', 'models_id') );
        model.options.length = 0;

        for (var i=0; i < cars.length; i++) {
            if (car_types_id == cars[ i ][ 0 ] ) {
                for (var j=0; j < cars[ i ][ 1 ].length; j++) {
                    if (brands_id == cars[ i ][ 1 ][ j ][ 0 ]) {
                        for (var k=0; k < cars[ i ][ 1 ][ j ][ 2 ].length; k++) {
                            model.options[ k ] = new Option( cars[ i ][ 1 ][ j ][ 2 ][ k ][ 1 ], cars[ i ][ 1 ][ j ][ 2 ][ k ][ 0 ]);
                            if (models_id == cars[ i ][ 1 ][ j ][ 2 ][ k ][ 0 ] ) {
                                model.selectedIndex = k;
                            }
                        }
                        break;
                    }
                }
            }
        }
    }

    function changeBrand(car_type) {
        setModels(car_type, 0);
    }

    function changeCarType(car_type) {
        setBrands(car_type, 0);
        changeBrand(car_type);
    }

    function setCar() {
        $.ajax({
            type:	'GET',
            url:	'index.php',
            dataType:	'script',
            data:	'do=CarModels|getJavaScriptInWindow',
            success:	function (result) {
<?
    if (is_array($data['items'])) {
        switch ($data['item_types_id']) {
            case 2:
                if (is_array($data['items'])) {
                    foreach ($data['items'] as $i => $row) {
                        echo 'setBrands(document.getElementById(\'items' . $i . 'car_types_id\'), ' . intval($row['brands_id']) . ');' . "\r\n";
                        echo 'setModels(document.getElementById(\'items' . $i . 'car_types_id\'), ' . intval($row['models_id']) . ')' . "\r\n";
                    }
                }
                break;
        }
    }
?>
            }
        })
    }

    function showHideDetails() {
        if (document.getElementById('items').style.display == 'none') {
            document.getElementById('items').style.display = 'block';
            document.getElementById('button').src = '/images/administration/navigation/details.gif';
        } else {
            document.getElementById('items').style.display = 'none';
            document.getElementById('button').src = '/images/administration/navigation/details_over.gif';
        }
    }

    function showBeneficiariesWindow() {
        tb_show('<strong>Вибір вигодонабувача:</strong>', "#TB_inline?height=200&width=400&inlineId=beneficiaries", false);
    }

    function setBeneficiaryFields(title, title_en) {
		$('input[name=assured]').val(title);

		if ($('input[name=transportation_company_en]').val() != '' || $('input[name=shipping_en]').val() != '' || $('input[name=temporary_storage_en]').val() != '') {
			$('input[name=assured_en]').val(title_en);
		}
        tb_remove();
    }

    function showTransportationCompaniesWindow() {
        tb_show('<strong>Вибір експедитора, перевізника:</strong>', "#TB_inline?height=200&width=400&inlineId=transportationCompanies", false);
    }

    function setTransportationCompanyFields(title, title_en) {
		$('input[name=transportation_company]').val(title);

		if ($('input[name=assured_en]').val() != '' || $('input[name=shipping_en]').val() != '' || $('input[name=temporary_storage_en]').val() != '') {
			$('input[name=transportation_company_en]').val(title_en);
		}
        tb_remove();
    }

	function showHideAuto() {
		var delivery_ways_id = document.getElementById('delivery_ways_id');
		for (i=0; i < delivery_ways_id.options.length; i++ ) {
			if (delivery_ways_id.options[ i ].selected && delivery_ways_id.options[ i ].value == '<?=DELIVERY_WAYS_AUTO?>') {
				$('#auto').css('display', 'block');
				break;
			}
		}
		if (i == delivery_ways_id.options.length) {
			$('#auto').css('display', 'none');
			$('input[name=sign_car]').val('');
			$('input[name=sign_trailer]').val('');
		}
	}
</script>
<!-- required plugins -->
<script type="text/javascript" src="/js/jquery/date.js"></script>
<script type="text/javascript" src="/js/jquery/date_ua_utf8.js" charset="utf-8"></script>
<!--[if IE]><script type="text/javascript" src="/js/jquery/jquery.bgiframe.min.js"></script><![endif]-->
<!-- jquery.datePicker.js -->
<script type="text/javascript" src="/js/jquery/jquery.datePicker.js"></script>
<!-- datePicker required styles -->
<link rel="stylesheet" type="text/css" media="screen" href="/js/jquery/datePicker.css" />

<!--autoselect-->
<script type='text/javascript' src='/js/jquery/jquery.bgiframe.min.js'></script>
<script type='text/javascript' src='/js/jquery/jquery.ajaxQueue.js'></script>
<script type='text/javascript' src='/js/jquery/jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="/js/jquery/jquery.autocomplete.css" />
<script>
var cities = [
<? if (is_array($data['client_points']) && sizeof($data['client_points'])) {?>
	<? foreach ($data['client_points'] as $i => $row) {?>
	"<?=str_replace ('&quot;' , '\"' ,$row['title'] )?>"<?if ($i!=sizeof($data['client_points'])-1) echo ',';?>
	<?}?>
<?}?>
];

var dialers = [
<? if ($_SESSION['auth']['clients_id']==4 || $_SESSION['auth']['clients_id']==91950) {?>
"СП ТОВ \"Автомобільний Дім Україна - Мерседес-Бенц\"",
"ПРАТ «АТП «Атлант»",
"Філія «Автоцентр на московському»",
"АТ «Українська автомобільна корпорація»",
"ТОВ \"Авто Дім\"",
"ТОВ ФІРМА \"Альфа-Плюс\"",
"ТОВ \"Західно-Український автомобільний дім\"",
"ПАТ \"Волинь-Авто\"",
"ТОВ \"Техноконтракт\"",
"ТОВ \"Автомобільний Дім Одеса\"",
"ПАТ \"Таврія-Авто\"",
"ПАТ \"Хмельниччина-Авто\"",
"ТОВ \"Автомобільний дім Соллі-Плюс\"",
"ПАТ \"Харьків-Авто\"",
"ТОВ \"Солли-Плюс\"",
"ПАТ \"Черкаси-Авто\"",
"ТзОВ \"СМ АВТОДІМ\"",
"ПАТ \"Полтава-Авто\"",
"ПАТ \"Закарпаття-Авто\"",
"ПП \"Віктор і Сини\"",
"Філія «Автосалон Мерседес» ПАТ «Дніпропетровськ-Авто»",
"ТДВ \"Конкорд\"",
"Філія \"Петрівка-Авто\"",
"ПАТ \"Дніпропетровськ-АВТО\"",
"ПрАТ \"АвтоКапітал\"",
"Філія «Авто Дім» Публічного Акціонерного Товариства «Донецьк-Авто»",
"ПАТ «Галичина авто» м.Львів",
"Філія Автомобільний Дім Одеса ПАТ «Одеса-Авто»",
"ТОВ «Автодом Запоріжжя»",
"АФ \"Гранд Автомотів\" ПАТ \"Українська Автомобільна Корпорація\"",
"AF “Grand Automotive” PJSC Ukrainian Automobile Corporation",
"Балтимор (США)",
"Baltimore (USA)",
"ЕфСіЕй Інтернешнл Оперейшнз ЕлЕлСі",
"FCA International Operations LLC",
"Палдіскі (Естонія)",
"Paldiski (Estonia)",
"CFR Paldiski (Estonia)",
"Антверпен",
"Antwerpen",
"CEVA Logistics (contracted with Grimaldi Lines)"
<?}?>
];

	$(document).ready(function() {
        $(function() {
			$('.autocompletecity').bind('focus', function() {
				$('.autocompletecity').autocomplete(cities,{matchContains :1});
			});
			$('.autocompletecity').bind('click', function() {
				$('.autocompletecity').autocomplete(cities,{matchContains :1});
			});
        });
		
		$(function() {
			$('.autocompletedialers').bind('focus', function() {
				$('.autocompletedialers').autocomplete(dialers,{matchContains :1});
			});
			$('.autocompletedialers').bind('click', function() {
				$('.autocompletedialers').autocomplete(dialers,{matchContains :1});
			});
        });

		getPoliciesGeneral(<?=$data['policies_general_id']?>);
	});
</script>
<? $Log->showSystem();?>
<form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
    <input type="hidden" name="id" value="<?=$data['id']?>" />
    <input type="hidden" name="agencies_id" value="<?=$data['agencies_id']?>" />
    <input type="hidden" id="clients_id" name="clients_id" value="<?=$data['clients_id']?>" />
    <input type="hidden" name="policies_id" value="<?=$data['id']?>" />
    <input type="hidden" name="deductible" value="<?=$data['deductible']?>" />
    <input type="hidden" name="rate" value="<?=$data['rate']?>" />
    <input type="hidden" id="product_types_id" name="product_types_id" value="<?=$data['product_types_id']?>" />
    <table cellpadding="2" cellspacing="3" width="100%">
        <tr>
            <td>
                <div class="section">Застрахований вантаж:</div>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Найменування:</td>
                        <td>
                            <select id="item_types_id" name="item_types_id" onchange="changeItemType(this); changeRate()" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" <?=$this->getReadonly(true)?>>
                                <option value="1" <?=($data['item_types_id'] == 1) ? 'selected' : ''?>>Автомобільні запчастини, масла, аксесуари</option>
								<option value="3" <?=($data['item_types_id'] == 3) ? 'selected' : ''?>>Запчастини для автомобілів T-150</option>
                                <option value="2" <?=($data['item_types_id'] == 2) ? 'selected' : ''?>>Автомобілі</option>
								<option value="4" <?=($data['item_types_id'] == 4) ? 'selected' : ''?>>Автомобільні запчастини</option>
								<option value="5" <?=($data['item_types_id'] == 5) ? 'selected' : ''?>>Машинокомплекти</option>
                            </select>
                        </td>
						<td class="label grey">Додатково:</td>
                        <td><input  type="text" name="item_types_text" value="<?=$data['item_types_text']?>" maxlength="250" class="fldText city" onfocus="this.className='fldTextOver city'" onblur="this.className='fldText city';" <?=$this->getReadonly(false)?> /></td>
                        <?
                        switch ($this->mode) {
                            case 'update':
                                echo '<td><a href="javascript: addItem()"><img src="/images/administration/navigation/add_over.gif" width="19" height="19" alt="Додати вантаж" /></a></td><td><a href="javascript: addItem()">додати вантаж</a></td>';
                                break;
                            case 'view':
                                echo '<td><a href="javascript: showHideDetails()"><img id="button" src="/images/administration/navigation/details_over.gif" width="19" height="19" alt="Показати/сховати" alt="Показати/зховати" /></a></td><td><a href="javascript: showHideDetails()">показати/cховати вантаж</a></td>';
                                break;
                        }
                        ?>
						<td>
						<td>
						Страховий полiс <input type="checkbox" id="policy" name="policy" value="1" <?=($data['policy']) ? 'checked' : ''?> <?=$this->getReadonly(true)?> /></td>						
						</td>
                    </tr>
                </table>

                <table id="items" cellpadding="0" cellspacing="0" <? if ($this->mode == 'view') echo 'style="display: none;"'?>>
                    <?
                    $i = 0;
					//_dump($data['items']);
                    if (is_array($data['items'])) {
                        foreach ($data['items'] as $i => $row) {
                    ?>
                    <tr style="background: <?=($i % 2 == 1) ? '#FFFFFF' : '#F0F0F0'?>">
                        <td>
                            <table cellpadding="5" cellspacing="0">
                                <tr>
                                    <?
                                        switch ($data['item_types_id']) {
                                            case 1://грузы
											case 3:
											case 4:
											case 5:
                                    ?>
                                    <td class="label grey"><?=$this->getMark()?>Кількість місць, шт.:</td>
                                    <td><input type="text" id="items<?=$i?>quantity" name="items[<?=$i?>][quantity]" value="<?=$data['items'][ $i ]['quantity']?>" maxlength="100" class="fldText email" onfocus="this.className='fldTextOver email'" onblur="this.className='fldText email'" <?=$this->getReadonly(false)?> /></td>
                                    <td class="label grey">Упаковка:</td>
                                    <td><input type="text" id="items<?=$i?>packing" name="items[<?=$i?>][packing]" value="<?=$data['items'][ $i ]['packing']?>"  class="fldText code" onfocus="this.className='fldTextOver code'" onblur="this.className='fldText code'" <?=$this->getReadonly(false)?> /></td>
                                    <td class="label grey"><?=$this->getMark()?>Вага, кг.:</td>
                                    <td><input type="text" id="items<?=$i?>weight" name="items[<?=$i?>][weight]" value="<?=$data['items'][ $i ]['weight']?>" maxlength="10" class="fldInteger" onfocus="this.className='fldIntegerOver'" onblur="this.className='fldInteger'" <?=$this->getReadonly(false)?> /></td>
                                    <?
                                                break;
                                            case 2://автомобили
                                    ?>
                                    <td class="label grey"><?=$this->getMark()?>Тип ТЗ:</td>
                                    <td>
                                        <select id="items<?=$i?>car_types_id" name="items[<?=$i?>][car_types_id]" onchange="changeCarType(this);" class="fldSelect" onfocus="this.className='fldSelectOver';" onblur="this.className='fldSelect';" <?=$this->getReadonly(true)?>>
                                        <?
                                            foreach ($data['car_types']['list'] as $row) {
                                                echo '<option value="' . $row['id'] . '" ' . (($row['id']  == $data['items'][ $i ]['car_types_id']) ? 'selected' : '') . '>' . $row['title'] . '</option>';
                                            }
                                        ?>
                                        </select>
                                    </td>
                                    <td class="label grey"><?=$this->getMark()?>Марка:</td>
                                    <td><select id="items<?=$i?>brands_id" name="items[<?=$i?>][brands_id]" onchange="changeBrand(document.getElementById('items<?=$i?>car_types_id'))" class="fldSelect" onfocus="this.className='fldSelectOver';" onblur="this.className='fldSelect';" <?=$this->getReadonly(true)?>></select></td>
                                    <td class="label grey"><?=$this->getMark()?>Модель:</td>
                                    <td><select id="items<?=$i?>models_id" name="items[<?=$i?>][models_id]" class="fldSelect" onfocus="this.className='fldSelectOver';" onblur="this.className='fldSelect';" <?=$this->getReadonly(true)?>></select></td>
                                </tr>
                            </table>
                            <table cellpadding="5" cellspacing="0">
                                <tr>
                                    <td class="label grey"><?=$this->getMark()?>№ шасі (кузов, рама):</td>
                                    <td><input type="text" id="items<?=$i?>shassi" name="items[<?=$i?>][shassi]" value="<?=$data['items'][ $i ]['shassi']?>"  maxlength="28" class="fldText shassi" onfocus="this.className='fldTextOver shassi'" onblur="this.className='fldText shassi'" <?=$this->getReadonly(false)?> /></td>
                                    <?
                                                break;
                                            }
                                    ?>
                                    <td class="label grey"><?=$this->getMark()?>Вартість, грн.:</td>
                                    <td><input type="text" name="items[<?=$i?>][price]" value="<?=$data['items'][ $i ]['price']?>" maxlength="14" class="fldMoney" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" onchange="changeRate()" <?=$this->getReadonly(false)?> /></td>
                                    <td class="label grey">Вартість, $:</td>
                                    <td><input type="text" name="items[<?=$i?>][price_usd]" value="<?=$data['items'][ $i ]['price_usd']?>" maxlength="14" class="fldMoney" onfocus="this.className='fldMoneyOver'" onblur="this.className='fldMoney'" onchange="changeRate()" <?=$this->getReadonly(false)?> /></td>
                                </tr>
                            </table>
                            <table cellpadding="5" cellspacing="0">
                                <tr>
                                    <td class="label grey"><?=$this->getMark()?>ТТН, номер і дата:</td>
                                    <td><input type="text" name="items[<?=$i?>][document_number]" value="<?=$data['items'][ $i ]['document_number']?>" class="fldText email" onfocus="this.className='fldTextOver email'" onblur="this.className='fldText email'" <?=$this->getReadonly(false)?> /></td>
                                    <td nowrap><input type="text" id="items<?=$i?>document_date" name="items[<?=$i?>][document_date]" value="<?=$data['items'][ $i ]['document_date']?>" maxlength="10" class="fldDatePicker<?=($this->mode == 'update' ? '' : 'Disabled')?>" onfocus="this.className='fldDatePickerOver'" onblur="this.className='fldDatePicker'" <?=$this->getReadonly(false)?> /></td>
                                </tr>
                            </table>
                            <table cellpadding="5" cellspacing="0">
                                <tr>
                                    <td class="label grey"><?=$this->getMark()?>Пункт відправлення:</td>
                                    <td><input  type="text" name="items[<?=$i?>][send]" value="<?=$data['items'][ $i ]['send']?>" maxlength="100" class="fldText city autocompletecity" onfocus="this.className='fldTextOver city autocompletecity'" onblur="this.className='fldText city autocompletecity';<? if ($data['clients_id'] == CLIENTS_AUTOZAZ) {?> $('#items<?=$i?>sender').val(this.value)<? } ?>" <?=$this->getReadonly(false)?> /></td>
									<td class="label grey"><?=$this->getMark()?>Відправник:</td>
                                    <td><input type="text" id="items<?=$i?>sender" name="items[<?=$i?>][sender]" value="<?=$data['items'][ $i ]['sender']?>" maxlength="100" class="fldText city autocompletedialers" onfocus="this.className='fldTextOver city autocompletedialers'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
                                    <td class="label grey"><?=$this->getMark()?>Пункт призначення:</td>
                                    <td><input type="text" name="items[<?=$i?>][destination]" value="<?=$data['items'][ $i ]['destination']?>" maxlength="100" class="fldText city autocompletecity" onfocus="this.className='fldTextOver city autocompletecity'" onblur="this.className='fldText city autocompletecity';<? if ($data['clients_id'] == CLIENTS_AUTOZAZ) {?> $('#items<?=$i?>recipient').val(this.value)<? } ?>" <?=$this->getReadonly(false)?> /></td>
									<td class="label grey"><?=$this->getMark()?>Отримувач:</td>
                                    <td><input type="text" id="items<?=$i?>recipient" name="items[<?=$i?>][recipient]" value="<?=$data['items'][ $i ]['recipient']?>" maxlength="200" class="fldText city autocompletedialers" onfocus="this.className='fldTextOver city autocompletedialers'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
                                </tr>
								<tr>
                                    <td class="label grey">Пункт відправлення (англ.):</td>
                                    <td><input  type="text" name="items[<?=$i?>][send_en]" value="<?=$data['items'][ $i ]['send_en']?>" maxlength="100" class="fldText city autocompletecity" onfocus="this.className='fldTextOver city autocompletecity'" onblur="this.className='fldText city autocompletecity';<? if ($data['clients_id'] == CLIENTS_AUTOZAZ) {?> $('#items<?=$i?>sender_en').val(this.value)<? } ?>" <?=$this->getReadonly(false)?> /></td>
									<td class="label grey">Відправник (англ.):</td>
                                    <td><input type="text" id="items<?=$i?>sender_en" name="items[<?=$i?>][sender_en]" value="<?=$data['items'][ $i ]['sender_en']?>" maxlength="100" class="fldText city autocompletedialers" onfocus="this.className='fldTextOver city autocompletedialers'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
                                    <td class="label grey">Пункт призначення (англ.):</td>
                                    <td><input type="text" name="items[<?=$i?>][destination_en]" value="<?=$data['items'][ $i ]['destination_en']?>" maxlength="100" class="fldText city autocompletecity" onfocus="this.className='fldTextOver city autocompletecity'" onblur="this.className='fldText city autocompletecity';<? if ($data['clients_id'] == CLIENTS_AUTOZAZ) {?> $('#items<?=$i?>recipient_en').val(this.value)<? } ?>" <?=$this->getReadonly(false)?> /></td>
									<td class="label grey">Отримувач (англ.):</td>
                                    <td><input type="text" id="items<?=$i?>recipient_en" name="items[<?=$i?>][recipient_en]" value="<?=$data['items'][ $i ]['recipient_en']?>" maxlength="200" class="fldText city autocompletedialers" onfocus="this.className='fldTextOver city autocompletedialers'" onblur="this.className='fldText city'" <?=$this->getReadonly(false)?> /></td>
                                </tr>
                            </table>
                        </td>
                        <? if ($this->mode == 'update') { ?><td><a id="deleteitem<?=$i?>" href="javascript: deleteItem('deleteitem<?=$i?>')"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити вантаж" /></a></td><? } ?>
                    </tr>
                    <?
                        }
                    }
                    ?>
                </table>

                <div class="section">Умови страхування:</div>

                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey">Вигодонабувач:</td>
                        <td><input type="text" name="assured" value="<?=$data['assured']?>" maxlength="150" class="fldText company autocompletecity" onfocus="this.className='fldTextOver company autocompletecity'" onblur="this.className='fldText company autocompletecity'" <?=$this->getReadonly(false)?> /><? if ($this->mode == 'update') {?> <a href="javascript: showBeneficiariesWindow()"><img src="/images/administration/bulletPath.gif" alt="Вибрати вигодонабувача" width="13" height="9" /></a><? } ?></td>
                        <td class="label grey">Вигодонабувач (англ.):</td>
                        <td><input type="text" name="assured_en" value="<?=$data['assured_en']?>" maxlength="150" class="fldText company autocompletecity" onfocus="this.className='fldTextOver company autocompletecity'" onblur="this.className='fldText company autocompletecity'" <?=$this->getReadonly(false)?> /></td>
					</tr>
				</table>
				 <table cellpadding="5" cellspacing="0">
                    <tr>
						<td class="label grey"><?=$this->getMark()?>Умови поставки:</td>
						<td><input type="text" name="shipping" value="<?=$data['shipping']?>" maxlength="50" class="fldText company autocompletecity" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /></td>
						<td class="label grey">Умови поставки (англ.):</td>
						<td><input type="text" name="shipping_en" value="<?=$data['shipping_en']?>" maxlength="50" class="fldText company autocompletecity" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /></td>
					</tr>
				</table>
				 <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey">Місце тимчасового складування:</td>
                        <td><input type="text" name="temporary_storage" value="<?=$data['temporary_storage']?>" maxlength="100" class="fldText company autocompletecity" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /></td>
					    <td class="label grey">Місце тимчасового складування (англ.):</td>
                        <td><input type="text" name="temporary_storage_en" value="<?=$data['temporary_storage_en']?>" maxlength="100" class="fldText company autocompletecity" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /></td>
					</tr>
                </table>

                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Експедитор, перевізник:</td>
                        <td><input type="text" name="transportation_company" value="<?=$data['transportation_company']?>" maxlength="150" class="fldText company autocompletecity" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /><? if ($this->mode == 'update') {?> <a href="javascript: showTransportationCompaniesWindow()"><img src="/images/administration/bulletPath.gif" alt="Вибрати експедитора, перевізника" width="13" height="9" /></a><? } ?></td>
						<td class="label grey">Експедитор, перевізник (англ.):</td>
                        <td><input type="text" name="transportation_company_en" value="<?=$data['transportation_company_en']?>" maxlength="150" class="fldText company autocompletecity" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /></td>
					</tr>
				</table>
				<table cellpadding="5" cellspacing="0">
				<tr>
					<td class="label grey"><?=$this->getMark()?>Вид транспортування:</td>
						<td><?=$this->buildSelect($this->formDescription['fields'][ $this->getFieldPositionByName('delivery_ways_id') ], $data['delivery_ways_id' ], $data['languageCode'], 'multiple size="3" onchange="showHideAuto()" ' . $this->getReadonly(true), 'double', $data)?></td>
						<td id="auto" style="display: <?=(is_array($data['delivery_ways_id']) && in_array(DELIVERY_WAYS_AUTO, $data['delivery_ways_id'])) ? 'block' : 'none'?>">
							<table cellpadding="0" cellspacing="5">
							<tr>
								<td class="label grey"><?=$this->getMark()?>Номер авто:</td>
								<td><input type="text" name="sign_car" value="<?=$data['sign_car']?>" maxlength="10" class="fldText sign" onfocus="this.className='fldTextOver sign'" onblur="this.className='fldText sign'" <?=$this->getReadonly(false)?> /></td>
							</tr>							
							<tr>
								<td class="label grey">Номер прицепа:</td>
								<td><input type="text" name="sign_trailer" value="<?=$data['sign_trailer']?>" maxlength="10" class="fldText sign" onfocus="this.className='fldTextOver sign'" onblur="this.className='fldText sign'" <?=$this->getReadonly(false)?> /></td>
							</tr>
							</table>
						</td>
						<td>
						Назва транспортного засобу:
						</td>
						<td>
						<input type="text" name="delivery_title" value="<?=$data['delivery_title']?>" class="fldText company" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> />
						</td>
						<td>
							<table cellpadding="0" cellspacing="5">
							<tr>
								<td class="label grey">Коментар:</td>
								<td><input type="text" name="comment" value="<?=$data['comment']?>" class="fldText company" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /></td>
							</tr>
							<tr>
								<td class="label grey">Коментар (англ.):</td>
								<td><input type="text" name="comment_en" value="<?=$data['comment_en']?>" class="fldText company" onfocus="this.className='fldTextOver company'" onblur="this.className='fldText company'" <?=$this->getReadonly(false)?> /></td>
							</tr>
							</table>
						</td>
                    </tr>
                </table>

                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <? if ($this->mode == 'view') { ?>
                        <td class="label grey"><?=$this->getMark()?>Номер:</td>
                        <td><input type="text" name="number" value="<?=$data['number']?>" maxlength="20" class="fldText" onfocus="this.className='fldTextOver'" onblur="this.className='fldText'" <?=$this->getReadonly(false)?> /></td>
                        <? } ?>
                        <td class="label grey"><?=$this->getMark()?>Дата заключення:</td>
                        <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('date') ], $data['date_year' ], $data['date_month' ], $data['date_day' ], 'date', ' onchange="getPoliciesGeneral()" ' . $this->getReadonly(true))?></td>
                    </tr>
                </table>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Дата початку дії:</td>
                        <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('begin_datetime') ], $data['begin_datetime_year' ], $data['begin_datetime_month' ], $data['begin_datetime_day' ], 'begin_datetime', 'onchange="changeRate()" ' . $this->getReadonly(true))?></td>
                        <td class="label grey"><?=$this->getMark()?>Дата закінчення дії:</td>
                        <td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('end_datetime') ], $data['end_datetime_year' ], $data['end_datetime_month' ], $data['end_datetime_day' ], 'end_datetime', 'onchange="changeRate()" ' . $this->getReadonly(true))?></td>
                    </tr>
                </table>

                <div class="section">Параметри страхування:</div>
                <table cellpadding="5" cellspacing="0">
                    <tr>
                        <td class="label grey"><?=$this->getMark()?>Генеральний договір:</td>
						<td><select id="policies_general_id" name="policies_general_id" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'" onchange="changeRate()" <?=$this->getReadonly(true)?>></select></td>
                        <td class="label grey"><b>Страхова сума:</b></td>
                        <td id="price"><?=getMoneyFormat($data['price'] * $data['price_percent'] / 100)?>; <?=getMoneyFormat($data['price_usd']* $data['price_percent'] / 100, 2)?></td>
                        <td class="label grey"><b>Франшиза:</b></td>
                        <td id="deductible"><?=($data['deductibles_absolute']) ? getMoneyFormat($data['deductibles_value']) : getRateFormat($data['deductibles_value']) . ' %'?></td>
                        <td class="label grey"><b>Тариф:</b></td>
                        <td id="rate"><?=getRateFormat($data['rate'], 4)?>%; <?=getMoneyFormat($data['amount'])?>; <?=getMoneyFormat($data['amount_usd']* $data['price_percent'] / 100, 2)?></td>
                    </tr>
                </table>
                <?=ClientBeneficiaries::getListToChoose($data['clients_id'])?>
				<?=TransportationCompanies::getListToChoose()?>
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">
    setCar();
    <?if (ereg($this->object . '\|(insert|update)', $data['do'])) echo 'changeRate();';?>
    initFocus(document.<?=$this->objectTitle?>);
</script>