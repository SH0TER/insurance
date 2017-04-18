<? if (in_array($Authorization->data['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER)) && !intval($data['accidents_id']) && $data['owner_types_id'] == 1 && intval($data['policies_kasko_items_id'])) {
		echo '<div class="section" style="margin: 10px;">Дзвінки: </div>';
		echo '<table id="blockCallsInfo" border="1" cellpadding="5" cellspacing="0" style="margin: 10px; "></table>';
} ?>

<? if (is_array( $data['accidents']) && sizeof( $data['accidents']) && !intval($data['accidents_id'])) {
    echo '<div class="section" style="margin: 10px;">Страхові справи: </div>';
    echo '<table style="margin: 10px; font-weight: bold;"><tr>';
    foreach($data['accidents'] as $accident) {
        echo '<td><a style="color: red;" target="_blank" href="/?do=Accidents|view&id=' . $accident['id'] . '&product_types_id=' . $accident['product_types_id'] . '"><span>' .  $accident['number'] . '</span></a></td>';
    }
    echo '</tr></table>';
} ?>

<? if (intval($data['accidents_id']) && $data['product_types_id'] == PRODUCT_TYPES_GO) { ?>
    <div class="section" style="margin: 10px;">Страховий ризик: <?=$this->getTitleRiskGO($data['accidents_id'])?></div>

    <ul id="tabs" style="margin: 10px;">
        <li <?=(($data['owner_types_id'] == 2) ? 'class="active"' : '')?>>
            <a href="/?do=Accidents|view&id=<?=$data['accidents_id']?>&product_types_id=4"><span>Потерпілий</span></a>
        </li>
        <li <?=(($data['owner_types_id'] == 1) ? 'class="active"' : '')?>>
            <? if (intval($data['insurer_application_accidents_id']) || $data['owner_types_id'] == 1) { ?>
                <a href="/?do=Accidents|view&id=<?=$data['accidents_id']?>&product_types_id=4&owner_types_id=1"><span>Страхувальник</span></a>
            <? } ?>
        </li>
    </ul>
    <br />
<? } ?>

<style type="text/css">
.columns TD {
	height: 25px;
	color: #FFFFFF;
	font-weight: bold !important;
	border-right: 1px solid #4F5D75;
	border-top: 1px solid #4F5D75;
	border-bottom: 1px solid #4F5D75;
	background: #008575 url(../images/administration/tabBorder.gif);
}
</style>

<script type="text/javascript" src="/js/jquery/thickbox.js"></script>
<link rel="stylesheet" href="/js/jquery/thickbox.css" type="text/css" media="screen" />
<link rel="stylesheet" type="text/css" media="screen" href="/css/validationEngine.jquery.css" />
<script type="text/javascript" src="/js/jquery/jquery.flexbox.js"></script>
<link rel="stylesheet" type="text/css" href="/css/jquery.flexbox.css" media="screen" />

<script>

	function strtotime(text, now) {
	  //  discuss at: http://phpjs.org/functions/strtotime/
	  //     version: 1109.2016
	  // original by: Caio Ariede (http://caioariede.com)
	  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
	  // improved by: Caio Ariede (http://caioariede.com)
	  // improved by: A. Matías Quezada (http://amatiasq.com)
	  // improved by: preuter
	  // improved by: Brett Zamir (http://brett-zamir.me)
	  // improved by: Mirko Faber
	  //    input by: David
	  // bugfixed by: Wagner B. Soares
	  // bugfixed by: Artur Tchernychev
	  //        note: Examples all have a fixed timestamp to prevent tests to fail because of variable time(zones)
	  //   example 1: strtotime('+1 day', 1129633200);
	  //   returns 1: 1129719600
	  //   example 2: strtotime('+1 week 2 days 4 hours 2 seconds', 1129633200);
	  //   returns 2: 1130425202
	  //   example 3: strtotime('last month', 1129633200);
	  //   returns 3: 1127041200
	  //   example 4: strtotime('2009-05-04 08:30:00 GMT');
	  //   returns 4: 1241425800

	  var parsed, match, today, year, date, days, ranges, len, times, regex, i, fail = false;

	  if (!text) {
		return fail;
	  }

	  // Unecessary spaces
	  text = text.replace(/^\s+|\s+$/g, '')
		.replace(/\s{2,}/g, ' ')
		.replace(/[\t\r\n]/g, '')
		.toLowerCase();

	  // in contrast to php, js Date.parse function interprets:
	  // dates given as yyyy-mm-dd as in timezone: UTC,
	  // dates with "." or "-" as MDY instead of DMY
	  // dates with two-digit years differently
	  // etc...etc...
	  // ...therefore we manually parse lots of common date formats
	  match = text.match(
		/^(\d{1,4})([\-\.\/\:])(\d{1,2})([\-\.\/\:])(\d{1,4})(?:\s(\d{1,2}):(\d{2})?:?(\d{2})?)?(?:\s([A-Z]+)?)?$/);

	  if (match && match[2] === match[4]) {
		if (match[1] > 1901) {
		  switch (match[2]) {
			case '-':
			  { // YYYY-M-D
				if (match[3] > 12 || match[5] > 31) {
				  return fail;
				}

				return new Date(match[1], parseInt(match[3], 10) - 1, match[5],
				  match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
			  }
			case '.':
			  { // YYYY.M.D is not parsed by strtotime()
				return fail;
			  }
			case '/':
			  { // YYYY/M/D
				if (match[3] > 12 || match[5] > 31) {
				  return fail;
				}

				return new Date(match[1], parseInt(match[3], 10) - 1, match[5],
				  match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
			  }
		  }
		} else if (match[5] > 1901) {
		  switch (match[2]) {
			case '-':
			  { // D-M-YYYY
				if (match[3] > 12 || match[1] > 31) {
				  return fail;
				}

				return new Date(match[5], parseInt(match[3], 10) - 1, match[1],
				  match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
			  }
			case '.':
			  { // D.M.YYYY
				if (match[3] > 12 || match[1] > 31) {
				  return fail;
				}

				return new Date(match[5], parseInt(match[3], 10) - 1, match[1],
				  match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
			  }
			case '/':
			  { // M/D/YYYY
				if (match[1] > 12 || match[3] > 31) {
				  return fail;
				}

				return new Date(match[5], parseInt(match[1], 10) - 1, match[3],
				  match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
			  }
		  }
		} else {
		  switch (match[2]) {
			case '-':
			  { // YY-M-D
				if (match[3] > 12 || match[5] > 31 || (match[1] < 70 && match[1] > 38)) {
				  return fail;
				}

				year = match[1] >= 0 && match[1] <= 38 ? +match[1] + 2000 : match[1];
				return new Date(year, parseInt(match[3], 10) - 1, match[5],
				  match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
			  }
			case '.':
			  { // D.M.YY or H.MM.SS
				if (match[5] >= 70) { // D.M.YY
				  if (match[3] > 12 || match[1] > 31) {
					return fail;
				  }

				  return new Date(match[5], parseInt(match[3], 10) - 1, match[1],
					match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
				}
				if (match[5] < 60 && !match[6]) { // H.MM.SS
				  if (match[1] > 23 || match[3] > 59) {
					return fail;
				  }

				  today = new Date();
				  return new Date(today.getFullYear(), today.getMonth(), today.getDate(),
					match[1] || 0, match[3] || 0, match[5] || 0, match[9] || 0) / 1000;
				}

				return fail; // invalid format, cannot be parsed
			  }
			case '/':
			  { // M/D/YY
				if (match[1] > 12 || match[3] > 31 || (match[5] < 70 && match[5] > 38)) {
				  return fail;
				}

				year = match[5] >= 0 && match[5] <= 38 ? +match[5] + 2000 : match[5];
				return new Date(year, parseInt(match[1], 10) - 1, match[3],
				  match[6] || 0, match[7] || 0, match[8] || 0, match[9] || 0) / 1000;
			  }
			case ':':
			  { // HH:MM:SS
				if (match[1] > 23 || match[3] > 59 || match[5] > 59) {
				  return fail;
				}

				today = new Date();
				return new Date(today.getFullYear(), today.getMonth(), today.getDate(),
				  match[1] || 0, match[3] || 0, match[5] || 0) / 1000;
			  }
		  }
		}
	  }

	  // other formats and "now" should be parsed by Date.parse()
	  if (text === 'now') {
		return now === null || isNaN(now) ? new Date()
		  .getTime() / 1000 | 0 : now | 0;
	  }
	  if (!isNaN(parsed = Date.parse(text))) {
		return parsed / 1000 | 0;
	  }

	  date = now ? new Date(now * 1000) : new Date();
	  days = {
		'sun': 0,
		'mon': 1,
		'tue': 2,
		'wed': 3,
		'thu': 4,
		'fri': 5,
		'sat': 6
	  };
	  ranges = {
		'yea': 'FullYear',
		'mon': 'Month',
		'day': 'Date',
		'hou': 'Hours',
		'min': 'Minutes',
		'sec': 'Seconds'
	  };

	  function lastNext(type, range, modifier) {
		var diff, day = days[range];

		if (typeof day !== 'undefined') {
		  diff = day - date.getDay();

		  if (diff === 0) {
			diff = 7 * modifier;
		  } else if (diff > 0 && type === 'last') {
			diff -= 7;
		  } else if (diff < 0 && type === 'next') {
			diff += 7;
		  }

		  date.setDate(date.getDate() + diff);
		}
	  }

	  function process(val) {
		var splt = val.split(' '), // Todo: Reconcile this with regex using \s, taking into account browser issues with split and regexes
		  type = splt[0],
		  range = splt[1].substring(0, 3),
		  typeIsNumber = /\d+/.test(type),
		  ago = splt[2] === 'ago',
		  num = (type === 'last' ? -1 : 1) * (ago ? -1 : 1);

		if (typeIsNumber) {
		  num *= parseInt(type, 10);
		}

		if (ranges.hasOwnProperty(range) && !splt[1].match(/^mon(day|\.)?$/i)) {
		  return date['set' + ranges[range]](date['get' + ranges[range]]() + num);
		}

		if (range === 'wee') {
		  return date.setDate(date.getDate() + (num * 7));
		}

		if (type === 'next' || type === 'last') {
		  lastNext(type, range, num);
		} else if (!typeIsNumber) {
		  return false;
		}

		return true;
	  }

	  times = '(years?|months?|weeks?|days?|hours?|minutes?|min|seconds?|sec' +
		'|sunday|sun\\.?|monday|mon\\.?|tuesday|tue\\.?|wednesday|wed\\.?' +
		'|thursday|thu\\.?|friday|fri\\.?|saturday|sat\\.?)';
	  regex = '([+-]?\\d+\\s' + times + '|' + '(last|next)\\s' + times + ')(\\sago)?';

	  match = text.match(new RegExp(regex, 'gi'));
	  if (!match) {
		return fail;
	  }

	  for (i = 0, len = match.length; i < len; i++) {
		if (!process(match[i])) {
		  return fail;
		}
	  }

	  // ECMAScript 5 only
	  // if (!match.every(process))
	  //    return false;

	  return (date.getTime() / 1000);
	}

	function log(value) {
		console.log(value);
	}
	
	var fields = {
		'blockTimeAndPlace': {
			'datetime': 						{'check': true, 'valid': false},
			'datetimeTimePicker': 				{'check': true, 'valid': true},
			'address': 							{'check': true, 'valid': false}
		},
		'blockPolicies': {
			'policies': 						{'check': false, 'valid': false}
		},
		'blockApplicant': {
			'applicant_types_id':				{'check': false},
			'applicant_lastname':				{'check': true, 'valid': false},
			'applicant_firstname':				{'check': true, 'valid': false},
			'applicant_patronymicname':			{'check': true, 'valid': false},
			'applicant_regions_id':				{'check': true, 'valid': false},
			'applicant_area':					{'check': false, 'valid': false},
			'applicant_city':					{'check': true, 'valid': false},
			'applicant_street_types_id':		{'check': true, 'valid': false},
			'applicant_street':					{'check': true, 'valid': false},
			'applicant_house':					{'check': true, 'valid': false},
			'applicant_flat':					{'check': false, 'valid': false},
			'applicant_phone':					{'check': true, 'valid': false}
		},
		'blockRisks': {
			'application_risks_id': 			{'check': true, 'valid': false},
			'victim': {
				'name':							{'check': true, 'valid': false},
				'car': {
					'victim_car_type_id':		{'check': false, 'valid': false},
					'brand_id':					{'check': false, 'valid': false},
					'model_id':					{'check': false, 'valid': false},
					'sign':						{'check': false, 'valid': false},
					'damage':					{'check': false, 'valid': false}
				},
				'property': {
					'name':						{'check': false, 'valid': false},
					'address':					{'check': false, 'valid': false},
					'damage':					{'check': false, 'valid': false}
				},
				'life': {
					'damage_id':				{'check': false, 'valid': false},
					'damage':					{'check': false, 'valid': false}
				}
			},
			'damage':							{'check': true, 'valid': false}			
		},
		'blockMessageAbout': {
			'europrotocol': 					{'false': true, 'valid': false},
			'accident_schemes_id': 				{'check': false, 'valid': false},
			'applicant_insurer_company': 		{'check': false, 'valid': false},
			'applicant_policies_series': 		{'check': false, 'valid': false},
			'applicant_policies_number': 		{'check': false, 'valid': false},
			'competent_authorities':			{'check': true, 'valid': false},
			'competent_authorities_id': 		{'check': false, 'valid': false},
			'mvs_id':							{'check': false, 'valid': false},
			'mvs_title':						{'check': false, 'valid': false},
			'mvs_date':							{'check': false, 'valid': false},
			'administrativeprotocol':			{'check': true, 'valid': false},
			'administrative_protocol_series':	{'check': false, 'valid': false},
			'administrative_protocol_number':	{'check': false, 'valid': false},
			'unifiedstateregister':				{'check': false, 'valid': false},
			'criminal':							{'check': false, 'valid': false},
			'criminal_name':					{'check': false, 'valid': false},
			'assistance':						{'check': true, 'valid': false},
			'assistance_place':					{'check': false, 'valid': false},
			'assistance_date':					{'check': false, 'valid': false}
		},
		'blockCar': {
			'inspecting_car':					{'check': true, 'valid': false},
			'inspecting_car_place':				{'check': false, 'valid': false}
		},
		'blockProperty': {
			'inspecting_property':				{'check': false, 'valid': false},
			'inspecting_property_place':		{'check': false, 'valid': false}
		},
		'blockDriver': {
			'driver_lastname':					{'check': true, 'valid': false},
			'driver_firstname':					{'check': true, 'valid': false},
			'driver_patronymicname':			{'check': true, 'valid': false},
			//'driver_licence_series':			{'check': true, 'valid': false},
			//'driver_licence_number':			{'check': true, 'valid': false},
			//'driver_licence_date':			{'check': true, 'valid': false}
		},
		'blockParticipants': {}
	};
	
	var policies_kasko_id = <?=intval($data['policies_kasko_id'])?>;
	var policies_kasko_items_id = <?=intval($data['policies_kasko_items_id'])?>;
	var policies_go_id = <?=intval($data['policies_go_id'])?>;
	var cars = new Array();
    var types = new Array();
	var victim_car = new Array(<?=intval($data['victim']['car']['data']['victim_car_type_id'])?>, <?=intval($data['victim']['car']['data']['brand_id'])?>, <?=intval($data['victim']['car']['data']['model_id'])?>);
	var participants_cars = new Array();
	var mvs_information = new Array();
	var mvs_information_list = {};
	
	$(document).ready(function(){		
		//showHideAssistanceDate();
		//showHideAssistanceBlock();
		
		//тип заявника
		$('input[name=owner_types_id]').bind(
			"change", function() {
				if (this.value == 1 && this.value == $('input[name=owner_types_id]:checked').val()) {
					$('#blockApplicantTypesId').show();
					$('.blockTimeAndPlace').show();
					$('#blockVictimInfo').hide();
					$('#blockInsurerDamage').show();
					$('#blockAministrativeProtocol').show();
					fields['blockMessageAbout']['administrativeprotocol']['check'] = true;
					$('#blockAssistance').show();
					fields['blockMessageAbout']['assistance']['check'] = true;
					$('#driver_types_id_1').show();
					$('#driver_types_id_2').show();
					fields['blockCar']['inspecting_car']['check'] = true;
					fields['blockProperty']['inspecting_property']['check'] = false;
					fields['blockRisks']['damage']['check'] = true;
					//setDriver(0);
					setDriver(parseInt(<?=(intval($data['driver_types_id']) == 4 ? 4 : 0)?>));
				}
				if (this.value == 2 && this.value == $('input[name=owner_types_id]:checked').val()) {
					$('#blockApplicantTypesId').hide();
					$('.blockTimeAndPlace').show();
					$('#blockVictimInfo').show();
					$('#blockInsurerDamage').hide();
					$('#blockAministrativeProtocol').hide();
					fields['blockMessageAbout']['administrativeprotocol']['check'] = false;
					$('#blockAssistance').hide();
					fields['blockMessageAbout']['assistance']['check'] = false;
					$('#driver_types_id_1').hide();
					$('#driver_types_id_2').hide();
					fields['blockCar']['inspecting_car']['check'] = false;
					fields['blockRisks']['damage']['check'] = false;
					setDriver(4);
				}
			}
		);
		
		//дата пригоди
		$('input[name=datetime]').bind(
			"change", function() {
				var obj = this;
				if (isValidDate(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2))) &&
						new Date() >= new Date(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2)))
				) {
					fields['blockTimeAndPlace']['datetime']['valid'] = true;
					if (checkFields('blockTimeAndPlace')) $('.blockPolicies').show();
					if (fields['blockMessageAbout']['assistance_date']['check']) $('input[name=assistance_date]').change();
					if (fields['blockMessageAbout']['mvs_date']['check']) $('input[name=mvs_date]').change();
					checkFields(null);
					checkBeginDates();

					return;
				}
				fields['blockTimeAndPlace']['datetime']['valid'] = false;
				showPrompt(this, 'Невірна дата пригоди.');				
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
				$('.dp-choose-date').each(function(){
					if (obj.name == $(this).prev().attr('name'))
						$(this).click(function() {
							obj.focus();
						});
				});
			}
		).bind(
			"blur", function() {
				var obj = this;
				if (isValidDate(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2))) &&
						new Date() >= new Date(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2)))
				) {
					fields['blockTimeAndPlace']['datetime']['valid'] = true;
					if (checkFields('blockTimeAndPlace')) $('.blockPolicies').show();
					if (fields['blockMessageAbout']['assistance_date']['check']) $('input[name=assistance_date]').change();
					if (fields['blockMessageAbout']['mvs_date']['check']) $('input[name=mvs_date]').change();
					checkFields(null);
					return;
				}
				fields['blockTimeAndPlace']['datetime']['valid'] = false;
				showPrompt(this, 'Невірна дата пригоди.');				
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
				$('.dp-choose-date').each(function(){
					if (obj.name == $(this).prev().attr('name'))
						$(this).click(function() {
							obj.focus();
						});
				});
			}
		);
		
		//час пригоди
		$('input[name=datetimeTimePicker]').bind(
			"change", function() {
				var expr = /\d\d:\d\d/g;
				fields['blockTimeAndPlace']['datetimeTimePicker'] = 1;
				if (this.value.search(expr) == 0 && parseInt(this.value.substr(0,2)) >= 0 && parseInt(this.value.substr(0,2)) < 24 && parseInt(this.value.substr(3,2)) >=0 && parseInt(this.value.substr(0,2)) < 60) {
					fields['blockTimeAndPlace']['datetimeTimePicker']['valid'] = true;
					if (checkFields('blockTimeAndPlace')) $('.blockPolicies').show();
					checkFields(null);
					return;
				}
				fields['blockTimeAndPlace']['datetimeTimePicker']['valid'] = false;
				showPrompt(this, 'Невірний час пригоди.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//адреса пригоди
		$('input[name=address]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockTimeAndPlace']['address']['valid'] = true;
					if (checkFields('blockTimeAndPlace')) $('.blockPolicies').show();
					checkFields(null);
					return;
				}
				fields['blockTimeAndPlace']['address']['valid'] = false;
				showPrompt(this, 'Введіть адресу, де сталася пригода.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//прізвище заявника
		$('input[name=applicant_lastname]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockApplicant']['applicant_lastname']['valid'] = true;
					if ($('select[name=types_id] option:selected').val() == 2 && checkFields('blockApplicant')) $('.blockParticipants').show();
					else if (checkFields('blockApplicant')) $('.blockRisks').show();
					checkFields(null);
					return;
				}
				fields['blockApplicant']['applicant_lastname']['valid'] = false;
				showPrompt(this, 'Вкажіть прізвище заявника.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//ім"я заявника
		$('input[name=applicant_firstname]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockApplicant']['applicant_firstname']['valid'] = true;
					if ($('select[name=types_id] option:selected').val() == 2 && checkFields('blockApplicant')) $('.blockParticipants').show();
					else if (checkFields('blockApplicant')) $('.blockRisks').show();
					checkFields(null);
					return;
				}
				fields['blockApplicant']['applicant_firstname']['valid'] = false;
				showPrompt(this, 'Вкажіть ім\'я заявника.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//по батькові заявника
		$('input[name=applicant_patronymicname]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockApplicant']['applicant_patronymicname']['valid'] = true;
					if ($('select[name=types_id] option:selected').val() == 2 && checkFields('blockApplicant')) $('.blockParticipants').show();
					else if (checkFields('blockApplicant')) $('.blockRisks').show();
					checkFields(null);
					return;
				}
				fields['blockApplicant']['applicant_patronymicname']['valid'] = false;
				showPrompt(this, 'Вкажіть по батькові заявника.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//область заявника
		$('select[name=applicant_regions_id]').change(function() {
			if (parseInt(this.value) > 0) {
				fields['blockApplicant']['applicant_regions_id']['valid'] = true;
				if ($('select[name=types_id] option:selected').val() == 2 && checkFields('blockApplicant')) $('.blockParticipants').show();
				else if (checkFields('blockApplicant')) $('.blockRisks').show();
				checkFields(null);
				return;
			}
			fields['blockApplicant']['applicant_regions_id']['valid'] = false;
			$(this).blur();
			showPrompt(this, 'Потрібно вибрати область заявника.');
			$(this).bind(
				'focus', function() {
					$('#'+this.name+'ErrorPrompt').remove();
				}
			);
		});
		
		//місто заявника
		$('input[name=applicant_city]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockApplicant']['applicant_city']['valid'] = true;
					if ($('select[name=types_id] option:selected').val() == 2 && checkFields('blockApplicant')) $('.blockParticipants').show();
					else if (checkFields('blockApplicant')) $('.blockRisks').show();
					checkFields(null);
					return;
				}
				fields['blockApplicant']['applicant_city']['valid'] = false;
				showPrompt(this, 'Вкажіть місто заявника.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//тип вулиці заявника
		$('select[name=applicant_street_types_id]').change(function() {
			if (parseInt(this.value) > 0) {
				fields['blockApplicant']['applicant_street_types_id']['valid'] = true;
				if ($('select[name=types_id] option:selected').val() == 2 && checkFields('blockApplicant')) $('.blockParticipants').show();
				else if (checkFields('blockApplicant')) $('.blockRisks').show();
				checkFields(null);
				return;
			}
			fields['blockApplicant']['applicant_street_types_id']['valid'] = false;
			$(this).blur();
			showPrompt(this, 'Потрібно вибрати тип вулиці заявника.');
			$(this).bind(
				'focus', function() {
					$('#'+this.name+'ErrorPrompt').remove();
				}
			);
		});
		
		//вулиця заявника
		$('input[name=applicant_street]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockApplicant']['applicant_street']['valid'] = true;
					if ($('select[name=types_id] option:selected').val() == 2 && checkFields('blockApplicant')) $('.blockParticipants').show();
					else if (checkFields('blockApplicant')) $('.blockRisks').show();
					checkFields(null);
					return;
				}
				fields['blockApplicant']['applicant_street']['valid'] = false;
				showPrompt(this, 'Вкажіть назву.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//будинок заявника
		$('input[name=applicant_house]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockApplicant']['applicant_house']['valid'] = true;
					if ($('select[name=types_id] option:selected').val() == 2 && checkFields('blockApplicant')) $('.blockParticipants').show();
					else if (checkFields('blockApplicant')) $('.blockRisks').show();
					checkFields(null);
					return;
				}
				fields['blockApplicant']['applicant_house']['valid'] = false;
				showPrompt(this, 'Вкажіть будинок.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);

		//телефони заявника
		$('input[name=applicant_phone]').bind(
			"change", function() {
				if (this.value.length >= 10) {
					fields['blockApplicant']['applicant_phone']['valid'] = true;
					if ($('select[name=types_id] option:selected').val() == 2 && checkFields('blockApplicant')) $('.blockParticipants').show();
					else if (checkFields('blockApplicant')) $('.blockRisks').show();
					checkFields(null);
					return;
				}
				fields['blockApplicant']['applicant_phone']['valid'] = false;
				showPrompt(this, 'Вкажіть телефон.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//власник пошкодженого ТЗ
		$('#victim_name').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockRisks']['victim']['name']['valid'] = true;
					if (checkFields('blockRisks')) {
						$('.blockMessageAbout').show();
					}
					checkFields(null);
					return;
				}
				fields['blockRisks']['victim']['name']['valid'] = false;
				showPrompt(this, 'Введіть ПІБ потерпілого.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);

		//тип ТЗ потерпілого
		$('select[name=victim_car_type_id]').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockRisks']['victim']['car']['victim_car_type_id']['valid'] = true;
					if (checkFields('blockRisks')) {
						$('.blockMessageAbout').show();
					}
					checkFields(null);
					return;
				}
				fields['blockRisks']['victim']['car']['victim_car_type_id']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати тип ТЗ потерпілого.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//марка ТЗ потерпілого
		$('#victim_brand_id').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockRisks']['victim']['car']['brand_id']['valid'] = true;
					if (checkFields('blockRisks')) {
						$('.blockMessageAbout').show();
					}
					checkFields(null);
					return;
				}
				fields['blockRisks']['victim']['car']['brand_id']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати марку ТЗ потерпілого.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//модель ТЗ потерпілого
		$('#victim_model_id').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockRisks']['victim']['car']['model_id']['valid'] = true;
					if (checkFields('blockRisks')) {
						$('.blockMessageAbout').show();
					}
					checkFields(null);
					return;
				}
				fields['blockRisks']['victim']['car']['model_id']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати модель ТЗ потерпілого.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//номер ТЗ потерпілого
		$('#victim_sign').bind(
			"change", function() {
				if (this.value.length && isValidSign(fixSignSimbols(this.value)) || this.value == 'б/н') {
					fields['blockRisks']['victim']['car']['sign']['valid'] = true;
					if (checkFields('blockRisks')) {
						$('.blockMessageAbout').show();
					}
					checkFields(null);
					return;
				}
				fields['blockRisks']['victim']['car']['sign']['valid'] = false;
				showPrompt(this, 'Введіть номер ТЗ потерпілого.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//опис пошкоджень ТЗ потерпілого
		$('#victim_car_damage').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockRisks']['victim']['car']['damage']['valid'] = true;
					if (checkFields('blockRisks')) {
						$('.blockMessageAbout').show();
					}
					checkFields(null);
					return;
				}
				fields['blockRisks']['victim']['car']['damage']['valid'] = false;
				showPrompt(this, 'Введіть опис пошкоджень ТЗ потерпілого.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//назва пошкодженого майна, крім ТЗ
		$('#victim_property_name').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockRisks']['victim']['property']['name']['valid'] = true;
					if (checkFields('blockRisks')) {
						$('.blockMessageAbout').show();
					}
					checkFields(null);
					return;
				}
				fields['blockRisks']['victim']['property']['name']['valid'] = false;
				showPrompt(this, 'Введіть назву пошкодженого майна.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//адреса пошкодженого майна, крім ТЗ
		$('#victim_property_address').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockRisks']['victim']['property']['address']['valid'] = true;
					if (checkFields('blockRisks')) {
						$('.blockMessageAbout').show();
					}
					checkFields(null);
					return;
				}
				fields['blockRisks']['victim']['property']['address']['valid'] = false;
				showPrompt(this, 'Введіть адресу пошкодженого майна.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//опис пошкоджень майна, крім ТЗ
		$('#victim_property_damage').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockRisks']['victim']['property']['damage']['valid'] = true;
					if (checkFields('blockRisks')) {
						$('.blockMessageAbout').show();
					}
					checkFields(null);
					return;
				}
				fields['blockRisks']['victim']['property']['damage']['valid'] = false;
				showPrompt(this, 'Введіть опис пошкоджень майна.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//ступінь ушкоджень потерпілого
		$('#victim_life_damage_id').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockRisks']['victim']['life']['damage_id']['valid'] = true;
					if (checkFields('blockRisks')) {
						$('.blockMessageAbout').show();
					}
					checkFields(null);
					return;
				}
				fields['blockRisks']['victim']['life']['damage_id']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати ступінь ушкоджень.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//потерпіла особа
		$('#victim_life_damage').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockRisks']['victim']['life']['damage']['valid'] = true;
					if (checkFields('blockRisks')) {
						$('.blockMessageAbout').show();
					}
					checkFields(null);
					return;
				}
				fields['blockRisks']['victim']['life']['damage']['valid'] = false;
				showPrompt(this, 'Введіть опис ушкоджень потерпілої особи.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//пошкодження
		$('textarea[name=damage]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockRisks']['damage']['valid'] = true;
					if (checkFields('blockRisks')) {
						$('.blockMessageAbout').show();
					}
					checkFields(null);
					return;
				}
				fields['blockRisks']['damage']['valid'] = false;
				showPrompt(this, 'Введіть пошкодження.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//віддідлення ДАІ
		$('select[name=mvs_id]').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockMessageAbout']['mvs_id']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
							$('.blockCar').show();
						} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
							$('.blockProperty').show();
						} else {
							$('.blockDocuments').show();
						}
					}
					checkFields(null);
					return;
				}
				fields['blockMessageAbout']['mvs_id']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати віддідлення ДАІ.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//назва компетентних органів
		$('input[name=mvs_title]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockMessageAbout']['mvs_title']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
							$('.blockCar').show();
						} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
							$('.blockProperty').show();
						} else {
							$('.blockDocuments').show();
						}
					}
					checkFields(null);
					return;
				}
				fields['blockMessageAbout']['mvs_title']['valid'] = false;
				showPrompt(this, 'Введіть назву компетентних органів.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//дата звернення до компетентних органів
		$('input[name=mvs_date]').bind(
			"change", function() {
				var obj = this;
				if (isValidDate(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2))) &&
						new Date(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2))) >= new Date(parseInt($('input[name=datetime]').val().substr(6,4)), parseInt($('input[name=datetime]').val().substr(3,2)-1), parseInt($('input[name=datetime]').val().substr(0,2))) &&
						new Date() >= new Date(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2)))
				) {
					$('#'+this.name+'ErrorPrompt').remove();
					fields['blockMessageAbout']['mvs_date']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
							$('.blockCar').show();
						} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
							$('.blockProperty').show();
						} else {
							$('.blockDocuments').show();
						}
					}
					checkFields(null);
					return;
				}
				fields['blockMessageAbout']['mvs_date']['valid'] = false;
				showPrompt(this, 'Невірна дата звернення до компетентних органів.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
				$('.dp-choose-date').each(function(){
					if (obj.name == $(this).prev().attr('name'))
						$(this).click(function() {
							obj.focus();
						});
				});
			}
		).bind(
			"blur", function() {
				var obj = this;
				if (isValidDate(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2))) &&
						new Date(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2))) >= new Date(parseInt($('input[name=datetime]').val().substr(6,4)), parseInt($('input[name=datetime]').val().substr(3,2)-1), parseInt($('input[name=datetime]').val().substr(0,2))) &&
						new Date() >= new Date(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2)))
				) {
					$('#'+this.name+'ErrorPrompt').remove();
					fields['blockMessageAbout']['mvs_date']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
							$('.blockCar').show();
						} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
							$('.blockProperty').show();
						} else {
							$('.blockDocuments').show();
						}
					}
					checkFields(null);
					return;
				}
				fields['blockMessageAbout']['mvs_date']['valid'] = false;
				showPrompt(this, 'Невірна дата звернення до компетентних органів.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
				$('.dp-choose-date').each(function(){
					if (obj.name == $(this).prev().attr('name'))
						$(this).click(function() {
							obj.focus();
						});
				});
			}
		);
		
		//схема ДТП за європротоколом
		$('select[name=accident_schemes_id]').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockMessageAbout']['accident_schemes_id']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
							$('.blockCar').show();
						} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
							$('.blockProperty').show();
						} else {
							$('.blockDocuments').show();
						}
					}
					checkFields(null);
					return;
				}
				fields['blockMessageAbout']['accident_schemes_id']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати схему ДТП.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//СК заявника
		$('input[name=applicant_insurer_company]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockMessageAbout']['applicant_insurer_company']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
							$('.blockCar').show();
						} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
							$('.blockProperty').show();
						} else {
							$('.blockDocuments').show();
						}
					}
					checkFields(null);
					return;
				}
				fields['blockMessageAbout']['applicant_insurer_company']['valid'] = false;
				showPrompt(this, 'Введіть страхову компанію.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//серія полісу заявника
		$('input[name=applicant_policies_series]').bind(
			"change", function() {
				var expr = /[А-ЯІ][А-ЯІ]/g;
				if (this.value.search(expr) == 0 && this.value.length == 2) {
					fields['blockMessageAbout']['applicant_policies_series']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
							$('.blockCar').show();
						} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
							$('.blockProperty').show();
						} else {
							$('.blockDocuments').show();
						}
					}
					checkFields(null);
					return;
				} else if (this.value.length == 0) {
					showPrompt(this, 'Введіть серію полісу.');
				} else {
					showPrompt(this, 'Формат серії полісу невірний.');
				}
				fields['blockMessageAbout']['applicant_policies_series']['valid'] = false;
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//номер полісу заявника
		$('input[name=applicant_policies_number]').bind(
			"change", function() {
				var expr = /\d{7}/g;
				if (this.value.search(expr) == 0 && this.value.length == 7) {
					fields['blockMessageAbout']['applicant_policies_number']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
							$('.blockCar').show();
						} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
							$('.blockProperty').show();
						} else {
							$('.blockDocuments').show();
						}
					}
					checkFields(null);
					return;
				} else if (this.value.length == 0) {
					showPrompt(this, 'Введіть номер полісу.');
				} else {
					showPrompt(this, 'Формат номера полісу невірний.');
				}
				fields['blockMessageAbout']['applicant_policies_number']['valid'] = false;
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);

		//дата повідомлення в ДЦ
		$('input[name=assistance_date]').bind(
			"change", function() {
				var obj = this;
				if (isValidDate(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2))) &&
						new Date(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2))) >= new Date(parseInt($('input[name=datetime]').val().substr(6,4)), parseInt($('input[name=datetime]').val().substr(3,2)-1), parseInt($('input[name=datetime]').val().substr(0,2))) &&
						new Date() >= new Date(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2)))
				) {
					$('#'+this.name+'ErrorPrompt').remove();
					fields['blockMessageAbout']['assistance_date']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
							$('.blockCar').show();
						} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
							$('.blockProperty').show();
						} else {
							$('.blockDocuments').show();
						}
					}
					checkFields(null);
					return;
				}
				fields['blockMessageAbout']['assistance_date']['valid'] = false;
				showPrompt(this, 'Невірна дата повідомлення в диспетчерський центр.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
				$('.dp-choose-date').each(function(){
					if (obj.name == $(this).prev().attr('name'))
						$(this).click(function() {
							obj.focus();
						});
				});
			}
		).bind(
			"blur", function() {
				var obj = this;
				if (isValidDate(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2))) &&
						new Date(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2))) >= new Date(parseInt($('input[name=datetime]').val().substr(6,4)), parseInt($('input[name=datetime]').val().substr(3,2)-1), parseInt($('input[name=datetime]').val().substr(0,2))) &&
						new Date() >= new Date(parseInt(this.value.substr(6,4)), parseInt(this.value.substr(3,2)-1), parseInt(this.value.substr(0,2)))
				) {
					$('#'+this.name+'ErrorPrompt').remove();
					fields['blockMessageAbout']['assistance_date']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
							$('.blockCar').show();
						} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
							$('.blockProperty').show();
						} else {
							$('.blockDocuments').show();
						}
					}
					checkFields(null);
					return;
				}
				fields['blockMessageAbout']['assistance_date']['valid'] = false;
				showPrompt(this, 'Невірна дата повідомлення в диспетчерський центр.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
				$('.dp-choose-date').each(function(){
					if (obj.name == $(this).prev().attr('name'))
						$(this).click(function() {
							obj.focus();
						});
				});
			}
		);
		
		//серія АП
		$('input[name=administrative_protocol_series]').bind(
			"change", function() {
				var expr1 = /[А-Я][А-Я]/g;
                var expr2 = /[А-Я][А-Я][0-9]/g;
				if (this.value.search(expr1) == 0 && this.value.length == 2 || this.value.search(expr2) == 0 && this.value.length == 3) {
					fields['blockMessageAbout']['administrative_protocol_series']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
							$('.blockCar').show();
						} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
							$('.blockProperty').show();
						} else {
							$('.blockDocuments').show();
						}
					}
					checkFields(null);
					return;
				} else if (this.value.length == 0) {
					showPrompt(this, 'Введіть серію адміністративного протоколу.');
				} else {
					showPrompt(this, 'Формат серії адміністративного протоколу невірний.');
				}
				fields['blockMessageAbout']['administrative_protocol_series']['valid'] = false;
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//номер АП
		$('input[name=administrative_protocol_number]').bind(
			"change", function() {
				var expr = /\d{6}/g;
				if (this.value.search(expr) == 0 && this.value.length == 6) {
					fields['blockMessageAbout']['administrative_protocol_number']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
							$('.blockCar').show();
						} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
							$('.blockProperty').show();
						} else {
							$('.blockDocuments').show();
						}
					}
					checkFields(null);
					return;
				} else if (this.value.length == 0) {
					showPrompt(this, 'Введіть номер адміністративного протоколу.');
				} else {
					showPrompt(this, 'Формат номера адміністративного протоколу невірний.');
				}
				fields['blockMessageAbout']['administrative_protocol_number']['valid'] = false;
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//кримінал, назва
		$('input[name=criminal_name]').bind(
			"change", function() {
				if (this.value.length > 0) {
					fields['blockMessageAbout']['criminal_name']['valid'] = true;
					if (checkFields('blockMessageAbout')) {
						if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
							$('.blockCar').show();
						} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
							$('.blockProperty').show();
						} else {
							$('.blockDocuments').show();
						}
					}
					checkFields(null);
					return;
				} else {
					showPrompt(this, 'Введіть серію адміністративного протоколу.');
				}
				fields['blockMessageAbout']['criminal_name']['valid'] = false;
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//
		$('input[name=unifiedstateregister]').bind(
			"click", function() {					
				fields['blockMessageAbout']['unifiedstateregister']['valid'] = true;
				if (checkFields('blockMessageAbout')) {
					if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
						$('.blockCar').show();
					} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
						$('.blockProperty').show();
					} else {
						$('.blockDocuments').show();
					}
				}
				checkFields(null);
			}
		).bind(
			"change", function() {			
				fields['blockMessageAbout']['unifiedstateregister']['valid'] = true;
				if (checkFields('blockMessageAbout')) {
					if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
						$('.blockCar').show();
					} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
						$('.blockProperty').show();
					} else {
						$('.blockDocuments').show();
					}
				}
				checkFields(null);
			}
		);
		
		//європротокол
		$('input[name=europrotocol]').bind(
			"click", function() {					
				fields['blockMessageAbout']['europrotocol']['valid'] = true;
				if (checkFields('blockMessageAbout')) {
					if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
						$('.blockCar').show();
					} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
						$('.blockProperty').show();
					} else {
						$('.blockDocuments').show();
					}
				}
			}
		).bind(
			"change", function() {			
				fields['blockMessageAbout']['europrotocol']['valid'] = true;
				if (checkFields('blockMessageAbout')) {
					if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
						$('.blockCar').show();
					} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
						$('.blockProperty').show();
					} else {
						$('.blockDocuments').show();
					}
				}
			}
		);
		
		//компетентні органи
		$('input[name=competent_authorities]').bind(
			"click", function() {				
				fields['blockMessageAbout']['competent_authorities']['valid'] = true;
				if (checkFields('blockMessageAbout')) {
					if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
						$('.blockCar').show();
					} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
						$('.blockProperty').show();
					} else {
						$('.blockDocuments').show();
					}
				}
			}
		).bind(
			"change", function() {				
				fields['blockMessageAbout']['competent_authorities']['valid'] = true;
				if (checkFields('blockMessageAbout')) {
					if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
						$('.blockCar').show();
					} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
						$('.blockProperty').show();
					} else {
						$('.blockDocuments').show();
					}
				}
			}
		);
		
		//диспетчерський центр
		$('input[name=assistance]').bind(
			"click", function() {				
				fields['blockMessageAbout']['assistance']['valid'] = true;
				if (checkFields('blockMessageAbout')) {
					if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
						$('.blockCar').show();
					} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
						$('.blockProperty').show();
					} else {
						$('.blockDocuments').show();
					}
				}
			}
		).bind(
			"change", function() {				
				fields['blockMessageAbout']['assistance']['valid'] = true;
				if (checkFields('blockMessageAbout')) {
					if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
						$('.blockCar').show();
					} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
						$('.blockProperty').show();
					} else {
						$('.blockDocuments').show();
					}
				}
			}
		);
		
		//з місця пригоди
		$('input[name=assistance_place]').bind(
			"click", function() {				
				fields['blockMessageAbout']['assistance_place']['valid'] = true;
				if (checkFields('blockMessageAbout')) {
					if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
						$('.blockCar').show();
					} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
						$('.blockProperty').show();
					} else {
						$('.blockDocuments').show();
					}
				}
			}
		).bind(
			"change", function() {				
				fields['blockMessageAbout']['assistance_place']['valid'] = true;
				if (checkFields('blockMessageAbout')) {
					if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
						$('.blockCar').show();
					} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
						$('.blockProperty').show();
					} else {
						$('.blockDocuments').show();
					}
				}
			}
		);
		
		//адміністративний протокол
		$('input[name=administrativeprotocol]').bind(
			"click", function() {				
				fields['blockMessageAbout']['administrativeprotocol']['valid'] = true;
				if (checkFields('blockMessageAbout')) {
					if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
						$('.blockCar').show();
					} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
						$('.blockProperty').show();
					} else {
						$('.blockDocuments').show();
					}
				}
			}
		).bind(
			"change", function() {				
				fields['blockMessageAbout']['administrativeprotocol']['valid'] = true;
				if (checkFields('blockMessageAbout')) {
					if ($('input[name=owner_types_id]:checked').val() == 1 || $('input[name=owner_types_id]:checked').val() == 2 && $('#victim_car').is(':checked')) {
						$('.blockCar').show();
					} else if ($('input[name=owner_types_id]:checked').val() == 2 && $('#victim_property').is(':checked')) {
						$('.blockProperty').show();
					} else {
						$('.blockDocuments').show();
					}
				}
			}
		);
		
		//огляд авто
		$('input[name=inspecting_car]').bind(
			"click", function() {
				fields['blockCar']['inspecting_car']['valid'] = true;
				if (checkFields('blockCar')) {
					$('.blockDriver').show();
				}
			}
		).bind(
			"change", function() {
				fields['blockCar']['inspecting_car']['valid'] = true;
				if (checkFields('blockCar')) {
					$('.blockDriver').show();
				}
			}
		);
		
		//місце знаходження ТЗ
		$('input[name=inspecting_car_place]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockCar']['inspecting_car_place']['valid'] = true;
					if (checkFields('blockCar') && $('#victim_property').is(':checked')) 
						$('.blockProperty').show();
					else if (checkFields('blockCar'))
						$('.blockDriver').show();
					checkFields(null);
					return;
				}
				fields['blockCar']['inspecting_car_place']['valid'] = false;
				showPrompt(this, 'Вкажіть місце знаходження ТЗ.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//огляд майна
		$('input[name=inspecting_property]').bind(
			"click", function() {
				fields['blockProperty']['inspecting_property']['valid'] = true;
				if (checkFields('blockProperty')) {
					$('.blockDocuments').show();
				}
			}
		).bind(
			"change", function() {
				fields['blockProperty']['inspecting_property']['valid'] = true;
				if (checkFields('blockProperty')) {
					$('.blockDocuments').show();
				}
			}
		);
		
		//місце знаходження майна
		$('input[name=inspecting_property_place]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockProperty']['inspecting_property_place']['valid'] = true;
					if (checkFields('blockProperty') && $('#victim_car').is(':checked')) 
						$('.blockDriver').show();
					else if (checkFields('blockProperty'))
						$('.blockDocuments').show();
					checkFields(null);
					return;
				}
				fields['blockProperty']['inspecting_property_place']['valid'] = false;
				showPrompt(this, 'Вкажіть місце знаходження майна.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//тип водія
		$('input[name=driver_types_id]').bind(
			"click", function() {				
				if (this.checked) setDriver(parseInt(this.value));
				if (checkFields('blockDriver') && $('select[name=types_id] option:selected').val() == 2) {
					$('.blockParticipants').show();
					$('.blockDocuments').show();
				}
				else if (checkFields('blockDriver')) $('.blockDocuments').show();
				
				checkFields(null);
					
			}
		)/*.bind(
			"change", function() {			
				if (this.checked) setDriver(parseInt(this.value));
				if (checkFields('blockDriver') && $('select[name=types_id] option:selected').val() == 2) {
					$('.blockParticipants').show();
					$('.blockDocuments').show();
				}
				else if (checkFields('blockDriver')) $('.blockDocuments').show();
			}
		)*/;
		
		//прізвище водія
		$('input[name=driver_lastname]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockDriver']['driver_lastname']['valid'] = true;
					if (checkFields('blockDriver') && ($('select[name=types_id] option:selected').val() == 2 || $('select[name=types_id] option:selected').val() == 1)) {
						$('.blockParticipants').show();
						$('.blockDocuments').show();
					}
					else if (checkFields('blockDriver')) $('.blockDocuments').show();
					checkFields(null);
					return;
				}
				fields['blockDriver']['driver_lastname']['valid'] = false;
				showPrompt(this, 'Вкажіть прізвище водія.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//ім"я водія
		$('input[name=driver_firstname]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockDriver']['driver_firstname']['valid'] = true;
					if (checkFields('blockDriver') && ($('select[name=types_id] option:selected').val() == 2 || $('select[name=types_id] option:selected').val() == 1)) {
						$('.blockParticipants').show();
						$('.blockDocuments').show();
					}
					else if (checkFields('blockDriver')) $('.blockDocuments').show();
					checkFields(null);
					return;
				}
				fields['blockDriver']['driver_firstname']['valid'] = false;
				showPrompt(this, 'Вкажіть ім\'я водія.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//по батькові водія
		$('input[name=driver_patronymicname]').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockDriver']['driver_patronymicname']['valid'] = true;
					if (checkFields('blockDriver') && ($('select[name=types_id] option:selected').val() == 2 || $('select[name=types_id] option:selected').val() == 1)) {
						$('.blockParticipants').show();
						$('.blockDocuments').show();
					}
					else if (checkFields('blockDriver')) $('.blockDocuments').show();
					checkFields(null);
					return;
				}
				fields['blockDriver']['driver_patronymicname']['valid'] = false;
				showPrompt(this, 'Вкажіть по батькові водія.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		getCarTypes();
		//log('ready');
		getCar();
		getMVSList();
		
		<? if (in_array($Authorization->data['roles_id'], array(ROLES_ADMINISTRATOR, ROLES_MANAGER)) && !intval($data['accidents_id']) && $data['owner_types_id'] == 1 && intval($data['policies_kasko_items_id'])) { ?>
			getApplicationCalls();
		<? } ?>
	});
	
	function showPrompt(field, promptText) {
		for(key_1 in fields) {
			for(key_2 in fields[key_1])
				if (key_2 == field.name && !fields[key_1][key_2]['check'] ) {
					return false;
				}
		}

		var prompt = $('<div id="' + field.name.replaceArray(['\\[','\\]'],['','']) + 'ErrorPrompt">');
		prompt.addClass("reqformError");
		prompt.addClass("parentFormError");
		prompt.addClass("formError");

		var promptContent = $('<div>').addClass("formErrorContent").html(promptText).appendTo(prompt);
		var arrow = $('<div>').addClass("formErrorArrow");

		prompt.find(".formErrorContent").before(arrow);
		arrow.addClass("formErrorArrowBottom").html('<div class="line1"><!-- --></div><div class="line2"><!-- --></div><div class="line3"><!-- --></div><div class="line4"><!-- --></div><div class="line5"><!-- --></div><div class="line6"><!-- --></div><div class="line7"><!-- --></div><div class="line8"><!-- --></div><div class="line9"><!-- --></div><div class="line10"><!-- --></div>');

		prompt.addClass('formErrorInsideDialog');
		prompt.css({
			"opacity": 0,
			'position':'absolute'
		});
		$(field).before(prompt);

		var promptTopPosition, promptleftPosition, marginTopSize;
		promptleftPosition = $(field).position().left + $(field).width() - 30;
		promptTopPosition =  $(field).position().top +  $(field).height() + 5;
		marginTopSize = 0;

		prompt.css({
			"top": promptTopPosition,
			"left": promptleftPosition,
			"marginTop": marginTopSize,
			"opacity": 100
		});

		prompt.click(function() {
			$(this).remove();
		})
		$('input[name=btn_save]').hide();
		$('input[name=btn_load]').hide();
	}
	
	function checkFields(block) {
        if ("<?=$action?>" == "view") return;
		if (block) {
			for(key in fields[block]) {				
				if (key == 'victim' && $('input[name=owner_types_id]:checked').val() == 2) {
					key_1 = block;
					key_2 = key;
					if (fields[block][key]['name']['check'] && !fields[block][key]['name']['valid']) {
						log('victim_name');
						return false;					
					}
					if (!$('#victim_car').is(':checked') && !$('#victim_property').is(':checked') && !$('#victim_life').is(':checked')) {
						$('input[name=btn_save]').hide();
						$('input[name=btn_load]').hide();
						log('victim');
						return false;
					}
					if ($('#victim_car').is(':checked')) {
						for (key_3 in fields[key_1][key_2]['car'])
							if (fields[key_1][key_2]['car'][key_3]['check'] && !fields[key_1][key_2]['car'][key_3]['valid']) {
								$('input[name=btn_save]').hide();
								$('input[name=btn_load]').hide();
								log('victim_car');
								return false;
							}
					}
					if ($('#victim_property').is(':checked')) {
						for (key_3 in fields[key_1][key_2]['property'])
							if (fields[key_1][key_2]['property'][key_3]['check'] && !fields[key_1][key_2]['property'][key_3]['valid']) {
								$('input[name=btn_save]').hide();
								$('input[name=btn_load]').hide();
								log('victim_property');
								return false;
							}
					}
					if ($('#victim_life').is(':checked')) {
						for (key_3 in fields[key_1][key_2]['life'])
							if (fields[key_1][key_2]['life'][key_3]['check'] && !fields[key_1][key_2]['life'][key_3]['valid']) {
								$('input[name=btn_save]').hide();
								$('input[name=btn_load]').hide();
								log('victim_life');
								return false;
							}
					}
				}				
				else if (fields[block][key]['check'] && !fields[block][key]['valid']) {
					log(key);
					return false;
				}
			}
			return true;
		} else {
			for(key_1 in fields) {
				for(key_2 in fields[key_1]) {
					if (key_1 == 'blockParticipants') {
						if (fields[key_1][key_2]['name']['check'] && !fields[key_1][key_2]['name']['valid']) return false;
						for (key_3 in fields[key_1][key_2]['car'])
							if (fields[key_1][key_2]['car'][key_3]['check'] && !fields[key_1][key_2]['car'][key_3]['valid']) {
								$('input[name=btn_save]').hide();
								$('input[name=btn_load]').hide();
								log('Participant');
								return false;
							}
						for (key_3 in fields[key_1][key_2]['property'])
							if (fields[key_1][key_2]['property'][key_3]['check'] && !fields[key_1][key_2]['property'][key_3]['valid']) {
								$('input[name=btn_save]').hide();
								$('input[name=btn_load]').hide();
								log('Participant');
								return false;
							}
						for (key_3 in fields[key_1][key_2]['life'])
							if (fields[key_1][key_2]['life'][key_3]['check'] && !fields[key_1][key_2]['life'][key_3]['valid']) {
								$('input[name=btn_save]').hide();
								$('input[name=btn_load]').hide();
								log('Participant');
								return false;
							}
					}

					if (key_2 == 'victim' && $('input[name=owner_types_id]:checked').val() == 2) {
						if (fields[key_1][key_2]['name']['check'] && !fields[key_1][key_2]['name']['valid']) {
							log('victim_name');
							return false;					
						}
						
						if (!$('#victim_car').is(':checked') && !$('#victim_property').is(':checked') && !$('#victim_life').is(':checked')) {
							$('input[name=btn_save]').hide();
							$('input[name=btn_load]').hide();
							log('victim');							
							return false;
						}

						if ($('#victim_car').is(':checked')) {
							for (key_3 in fields[key_1][key_2]['car']) {
								if (fields[key_1][key_2]['car'][key_3]['check'] && !fields[key_1][key_2]['car'][key_3]['valid']) {
									$('input[name=btn_save]').hide();
									$('input[name=btn_load]').hide();
									log('victim_car');
									return false;
								}
							}
						}

						if ($('#victim_property').is(':checked')) {
							for (key_3 in fields[key_1][key_2]['property'])
								if (fields[key_1][key_2]['property'][key_3]['check'] && !fields[key_1][key_2]['property'][key_3]['valid']) {
									$('input[name=btn_save]').hide();
									$('input[name=btn_load]').hide();
									log('victim_property');
									return false;
								}
						}
						if ($('#victim_life').is(':checked')) {
							log(key_1 + '   ' + key_2);
							for (key_3 in fields[key_1][key_2]['life'])
								if (fields[key_1][key_2]['life'][key_3]['check'] && !fields[key_1][key_2]['life'][key_3]['valid']) {
									$('input[name=btn_save]').hide();
									$('input[name=btn_load]').hide();
									log('victim_life');
									return false;
								}
						}
					}					
					else if (fields[key_1][key_2]['check'] && !fields[key_1][key_2]['valid']) {
						$('input[name=btn_save]').hide();
						$('input[name=btn_load]').hide();
						log(key_2);
						return false;
					}
				}
			}
			log('true');
			$('input[name=btn_save]').show();
			$('input[name=btn_load]').show();
			return true;
		}
	}
	
	function addPolicy() {
		tb_show('<strong>Пошук договору/полісу:</strong>', '#TB_inline?height=400&width=800&inlineId=hiddenModalContent', false);
	}
	
	function searchPolicy(type) {
		if (($('#search_policies_number').val() ||
			$('#search_policies_date').val() ||
            $('#search_insurer_lastname').val() ||
            $('#search_insurer_passport_series').val() ||
            $('#search_insurer_passport_number').val() ||
            $('#search_insurer_identification_code').val() ||
            $('#search_shassi').val() ||
            $('#search_sign').val()) && type == 0) {
				$('#ajaxBusy').show(); 
				$('#policiesTable').hide();
				$.ajax({
					type:		'POST',
					url:		'index.php',
					dataType:	'html',
					async:		false,
					data:		'do=Policies|getSearchInWindow' +
								'&policies_kasko_id=' + policies_kasko_id +
								'&policies_kasko_items_id=' + policies_kasko_items_id +
								'&policies_go_id=' + policies_go_id +
								'&owner_types_id=' + $('input[name=owner_types_id]:checked').val() +
								'&product_types_idx[]=<?=PRODUCT_TYPES_KASKO?>' +
								'&product_types_idx[]=<?=PRODUCT_TYPES_GO?>' +
                                '&datetime=' + $('input[name=datetime]').val() +
								'&number=' + $('input[name=search_policies_number]').val() +
								'&date=' + $('input[name=search_policies_date_year]').val() + '.' + $('input[name=search_policies_date_month]').val() + '.' + $('input[name=search_policies_date_day]').val() +
								'&insurer_lastname=' + $('input[name=search_insurer_lastname]').val() +
								'&insurer_passport_series=' + $('input[name=search_insurer_passport_series]').val() +
								'&insurer_passport_number=' + $('input[name=search_insurer_passport_number]').val() +
								'&insurer_identification_code=' + $('input[name=search_insurer_identification_code]').val() +
								'&shassi=' + $('input[name=search_shassi]').val() +
								'&sign=' + $('input[name=search_sign]').val(),
					success: function(result) {
						$('#ajaxBusy').hide();
						$('#policiesTable').show();
						$('#searchPoliciesList').html(result);
					},
					complete: function(result) {
						$('#ajaxBusy').hide();
						$('#policiesTable').show();
					}
				});				
        } else if (type > 0 && (policies_kasko_id > 0 || policies_go_id > 0)) {
			$.ajax({
				type:		'POST',
				url:		'index.php',
				dataType:	'json',
				async:		false,
				data:		'do=Policies|getSearchInWindow' +
							'&action=<?=$action?>' +
							'&statuses_id=<?=$data['statuses_id']?>' +
							'&application_accidents_id=<?=$data['id']?>' +
                            '&owner_types_id=<?=$data['owner_types_id']?>' +
							'&type=1' +
							'&policies_kasko_id=' + policies_kasko_id +
							'&policies_kasko_items_id=' + policies_kasko_items_id +
							'&policies_go_id=' + policies_go_id +
							'&product_types_idx[]=<?=PRODUCT_TYPES_KASKO?>' +
							'&product_types_idx[]=<?=PRODUCT_TYPES_GO?>',
				success: function(result) {
					for (key in result) {
						$('#blockPoliciesInfo').append('<tr><td>'+result[key].insurer+'</td><td>'+result[key].product_types_title+'</td><td><a target="_blank" href="/?do=Policies|view&id=' + result[key].policies_id + '&product_types_id=' + result[key].product_types_id + '">'+result[key].number+'</a></td><td>'+result[key].date_format+'</td><td>'+result[key].item+'</td><td>'+result[key].shassi+'</td><td>'+result[key].sign+'</td><td>'+result[key].begin_datetime_format+'</td><td>'+result[key].interrupt_datetime_format+'</td>'+
						<? if($action == 'update' && $data['statuses_id'] == 2) { ?>
						'<td>'+result[key].statuses+'</td>'+
						<? } ?>
						<? if($action != 'view') { ?>
						'<td><a href="#" onclick="deletePolicy(this, ' + result[key].product_types_id + ', ' + result[key].items_id + ')"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td>'+
						<? } ?>
						'</tr>');
					}
				}
			});
		}
	}
	
	function choosePolicy(policies_id, items_id, product_types_id, product_types_title, insurer, number, date_format, item, shassi, sign, begin_datetime_format, interrupt_datetime_format) {
		switch (product_types_id) {
			case 3:
            case 11:
				if (policies_kasko_id == 0) {
					policies_kasko_id = policies_id;
					policies_kasko_items_id = items_id;
					$('input[name=policies_kasko_id]').val(policies_id);
					$('input[name=policies_kasko_items_id]').val(items_id);
					$('#blockPoliciesInfo').append('<tr><td>'+insurer+'</td><td>'+product_types_title+'</td><td><a target="_blank" href="/?do=Policies|view&id=' + policies_id + '&product_types_id=3">'+number+'</a></td><td>'+date_format+'</td><td>'+item+'</td><td>'+shassi+'</td><td>'+sign+'</td><td class="policyBeginDate">'+begin_datetime_format+'</td><td>'+interrupt_datetime_format+'</td><td><a href="#" onclick="deletePolicy(this, ' + product_types_id + ', ' + items_id + ')"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td></tr>');
				} else {
					alert('Договір КАСКО уже додано до списку.');
					return;
				}
				break;
			case 4:
				if (policies_go_id == 0) {
					policies_go_id = policies_id;
					$('input[name=policies_go_id]').val(policies_id);
					$('#blockPoliciesInfo').append('<tr><td>'+insurer+'</td><td>'+product_types_title+'</td><td><a target="_blank" href="/?do=Policies|view&id=' + policies_id + '&product_types_id=4">'+number+'</a></td><td>'+date_format+'</td><td>'+item+'</td><td>'+shassi+'</td><td>'+sign+'</td><td class="policyBeginDate">'+begin_datetime_format+'</td><td>'+interrupt_datetime_format+'</td><td><a href="#" onclick="deletePolicy(this, ' + product_types_id + ', ' + policies_id + ')"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td></tr>');
				} else {
					alert('Договір ОСЦПВ уже додано до списку.');
					return;
				}
				break;
		}
		$('.blockApplicant').show();
		if ($('input[name=owner_types_id]:checked').val() == 2) $('#blockVictimInfo').show();
		else $('#blockVictimInfo').hide();
		setRisks(0);
		tb_remove();
		checkBeginDates();
	}
	
	function checkBeginDates() {
		$( '#blockPoliciesDatesErrors' ).html('');
		$( ".policyBeginDate" ).each(function( index ) {
			var d1 = strtotime($('#datetime').val());
			var d2= strtotime($( this ).text());
			if (d2>d1) {
				$( '#blockPoliciesDatesErrors' ).html('<span style="color:red"><b>Дата початку дiї полiсу пiзнiше Дати та часу настання пригоди Зателефонуйте, будь ласка в відділ обліку та реєстрації за тел.(095)262-56-20 або (095)262-56-16</b></span>');
			}
			else
				$( '#blockPoliciesDatesErrors' ).html('');
		});
	}

	function deletePolicy(obj, product_types_id, id) {
        if (confirm('Ви дійсно бажаєте вилучити договір/поліс?')) {
            document.getElementById('blockPoliciesInfo').deleteRow( obj.parentNode.parentNode.sectionRowIndex );
			switch (product_types_id) {
				case 3:
					policies_kasko_id = 0;
					policies_kasko_items_id = 0;
					$('input[name=policies_kasko_id]').val(0);
					$('input[name=policies_kasko_items_id]').val(0);
					break;
				case 4:
					policies_go_id = 0;
					$('input[name=policies_go_id]').val(0);
					break;
			}
			setRisks(0);
			checkBeginDates();
		}
    }
	
	function setRisks(application_risks_id) {
		$.ajax({
			type:		'POST',
			url:		'index.php',
			dataType:	'html',
			data:		'do=Policies|getApplicationRisksInWindow' +
						'&policies_kasko_id=' + policies_kasko_id +
						'&policies_go_id=' + policies_go_id +
						'&application_risks_id=' + application_risks_id+
						'&types_id=<?=$data['types_id']?>'+
						'&action=<?=$action?>',
			success: function(result) {
				$('#risks').html( result );
				if (application_risks_id > 0) fields['blockRisks']['application_risks_id']['valid'] = true;
				else fields['blockRisks']['application_risks_id']['valid'] = false;
				$('input[name=application_risks_id]').bind(
					"click", function() {
						if (checkFields('blockRisks')) {
							$('.blockMessageAbout').show();
						}
					}
				);
				//log('setRisks');
				checkFields(null);
			}
		});
	}
	
	function setApplicant(types_id) {
		switch(types_id) {
			case 1:
			case 2:
				$.ajax({
					type:		'POST',
					url:		'index.php',
					dataType:	'json',
					data:		'do=Policies|getApplicationInfoInWindow' +
								'&types_id=' + types_id +
								'&policies_kasko_id=' + policies_kasko_id +
								'&policies_go_id=' + policies_go_id,
					success: function(result) {
						if (result.status == 1) {
							$('input[name=applicant_lastname]').val(result.applicant_lastname);
							$('input[name=applicant_firstname]').val(result.applicant_firstname);
							$('input[name=applicant_patronymicname]').val(result.applicant_patronymicname);
							$('select[name=applicant_regions_id]').val(result.applicant_regions_id);
							$('input[name=applicant_area]').val(result.applicant_area);
							$('input[name=applicant_city]').val(result.applicant_city);
							$('select[name=applicant_street_types_id]').val(result.applicant_street_types_id);
							$('input[name=applicant_street]').val(result.applicant_street);
							$('input[name=applicant_house]').val(result.applicant_house);
							$('input[name=applicant_flat]').val(result.applicant_flat);
							//$('input[name=applicant_phone]').val(result.applicant_phone);
							$('input[name^=applicant_]').change();
							$('select[name^=applicant_]').change();
						} else {
							alert('Інформацію не знайдено.');
						}
					}
				});
				break;
		}
	}
	
	function changeEuroprotocol(value) {
		if (value == 1) {
			$('#blockEuroprotocolInfo').show();
			$('#blockCompetentAuthorities').hide();
			//$('#blockAministrativeProtocol').hide();
			
			fields['blockMessageAbout']['accident_schemes_id']['check'] = true;
			fields['blockMessageAbout']['applicant_insurer_company']['check'] = true;
			fields['blockMessageAbout']['applicant_policies_series']['check'] = true;
			fields['blockMessageAbout']['applicant_policies_number']['check'] = true;
			
			fields['blockMessageAbout']['competent_authorities']['check'] = false;
			fields['blockMessageAbout']['administrativeprotocol']['check'] = false;
		} else {
			$('#blockEuroprotocolInfo').hide();
			$('#blockCompetentAuthorities').show();
			//$('#blockAministrativeProtocol').show();
			
			fields['blockMessageAbout']['accident_schemes_id']['check'] = false;
			fields['blockMessageAbout']['applicant_insurer_company']['check'] = false;
			fields['blockMessageAbout']['applicant_policies_series']['check'] = false;
			fields['blockMessageAbout']['applicant_policies_number']['check'] = false;
			
			fields['blockMessageAbout']['competent_authorities']['check'] = true;
			changeCompetentAuthorities($('input[name=competent_authorities]:checked').val());
		}
		checkFields(null);
	}
	
	function changeCompetentAuthorities(value) {
		if (value == 1) {
			$('select[name=competent_authorities_id]').show();
			changeCompetentAuthoritiesId( $('select[name=competent_authorities_id] option:selected').val() );
			changeCriminal( $('input[name=criminal]:checked').val() );
			if ($('input[name=owner_types_id]:checked').val() == 1) {
				$('#blockAministrativeProtocol').show();
			}
			$('#blockEuroprotocol').hide();			
			
			fields['blockMessageAbout']['europrotocol']['check'] = false;
			fields['blockMessageAbout']['competent_authorities_id']['check'] = true;
		} else {
			$('select[name=competent_authorities_id]').hide();
			$('#blockCompetentAuthoritiesInfo').hide();
			$('#blockAministrativeProtocol').hide();
            if ($('select[name=types_id] option:selected').val() == 2) {
                $('#blockEuroprotocol').show();
                fields['blockMessageAbout']['europrotocol']['check'] = true;
            } else {
                fields['blockMessageAbout']['europrotocol']['check'] = false;
            }
			
			fields['blockMessageAbout']['mvs_id']['check'] = false;
			fields['blockMessageAbout']['mvs_title']['check'] = false;
			fields['blockMessageAbout']['mvs_date']['check'] = false;
			
			fields['blockMessageAbout']['administrativeprotocol']['check'] = false;
			fields['blockMessageAbout']['administrative_protocol_series']['check'] = false;
			fields['blockMessageAbout']['administrative_protocol_number']['check'] = false;			
			
			fields['blockMessageAbout']['competent_authorities_id']['check'] = false;
			
			fields['blockMessageAbout']['criminal']['check'] = false;
			fields['blockMessageAbout']['criminal_name']['check'] = false;
			$('#blockCriminal').hide();
			
			fields['blockMessageAbout']['unifiedstateregister']['check'] = false;
			$('#blockUnifiedStateRegister').hide();
			
			fields['blockMessageAbout']['competent_authorities_id']['valid'] = true;
		}
		checkFields(null);
	}

	function changeCompetentAuthoritiesId(id) {
	//log($('input[name=application_risks_id]:checked').val());
		switch (id) {
			case '1':
				$('#blockCompetentAuthoritiesInfo').show();
				$('#daiYes').show();
				$('#daiNo').hide();
				$('#blockEuroprotocol').hide();
				$('#blockAministrativeProtocol').show();
				$('#blockUnifiedStateRegister').hide();
				fields['blockMessageAbout']['mvs_id']['check'] = true;
				fields['blockMessageAbout']['mvs_title']['check'] = false;
				fields['blockMessageAbout']['mvs_date']['check'] = true;
				fields['blockMessageAbout']['unifiedstateregister']['check'] = false;				
				
				if ($('input[name=application_risks_id]:checked').val() != 3 && $('input[name=application_risks_id]:checked').val() != 5) {
					fields['blockMessageAbout']['criminal']['check'] = true;
					$('#blockCriminal').show();
				}
				
				fields['blockMessageAbout']['administrativeprotocol']['check'] = true;
				fields['blockMessageAbout']['administrative_protocol_series']['check'] = true;
				fields['blockMessageAbout']['administrative_protocol_number']['check'] = true;	
				
				fields['blockMessageAbout']['competent_authorities_id']['valid'] = true;
				break;
			case '2':
				$('#blockCompetentAuthoritiesInfo').show();
				$('#daiYes').hide();
				$('#daiNo').show();
				$('#blockEuroprotocol').hide();
				$('#blockAministrativeProtocol').hide();
				$('#blockUnifiedStateRegister').show();
				fields['blockMessageAbout']['mvs_id']['check'] = false;
				fields['blockMessageAbout']['mvs_title']['check'] = true;
				fields['blockMessageAbout']['mvs_date']['check'] = true;
				fields['blockMessageAbout']['unifiedstateregister']['check'] = true;
				
				if ($('input[name=application_risks_id]:checked').val() != 3 && $('input[name=application_risks_id]:checked').val() != 5) {
					fields['blockMessageAbout']['criminal']['check'] = true;
					$('#blockCriminal').show();
				}
				
				fields['blockMessageAbout']['administrativeprotocol']['check'] = false;
				fields['blockMessageAbout']['administrative_protocol_series']['check'] = false;
				fields['blockMessageAbout']['administrative_protocol_number']['check'] = false;	
				
				fields['blockMessageAbout']['competent_authorities_id']['valid'] = true;
				break;
			case '3':
				$('#blockCompetentAuthoritiesInfo').show();
				$('#daiYes').hide();
				$('#daiNo').show();
				$('#blockEuroprotocol').hide();
				$('#blockAministrativeProtocol').hide();
				$('#blockUnifiedStateRegister').hide();
				fields['blockMessageAbout']['mvs_id']['check'] = false;
				fields['blockMessageAbout']['mvs_title']['check'] = true;
				fields['blockMessageAbout']['mvs_date']['check'] = true;
				fields['blockMessageAbout']['unifiedstateregister']['check'] = false;
				
				fields['blockMessageAbout']['criminal']['check'] = false;
				$('#blockCriminal').hide();
				
				fields['blockMessageAbout']['administrativeprotocol']['check'] = false;
				fields['blockMessageAbout']['administrative_protocol_series']['check'] = false;
				fields['blockMessageAbout']['administrative_protocol_number']['check'] = false;	
				
				fields['blockMessageAbout']['competent_authorities_id']['valid'] = true;
				break;
			case '4':
				$('#blockCompetentAuthoritiesInfo').show();
				$('#daiYes').hide();
				$('#daiNo').show();
				$('#blockEuroprotocol').hide();
				$('#blockAministrativeProtocol').show();
				$('#blockUnifiedStateRegister').hide();
				fields['blockMessageAbout']['mvs_id']['check'] = false;
				fields['blockMessageAbout']['mvs_title']['check'] = true;
				fields['blockMessageAbout']['mvs_date']['check'] = true;
				fields['blockMessageAbout']['unifiedstateregister']['check'] = false;				
				
				if ($('input[name=application_risks_id]:checked').val() != 3 && $('input[name=application_risks_id]:checked').val() != 5) {
					fields['blockMessageAbout']['criminal']['check'] = true;
					$('#blockCriminal').show();
				}
				
				fields['blockMessageAbout']['administrativeprotocol']['check'] = true;
				fields['blockMessageAbout']['administrative_protocol_series']['check'] = true;
				fields['blockMessageAbout']['administrative_protocol_number']['check'] = true;	
				
				fields['blockMessageAbout']['competent_authorities_id']['valid'] = true;
				break;
			case '0':
				$('#blockCompetentAuthoritiesInfo').hide();
				$('#daiYes').hide();
				$('#daiNo').hide();
				//$('#blockEuroprotocol').show();
				$('#blockAministrativeProtocol').hide();
				$('#blockUnifiedStateRegister').hide();
				fields['blockMessageAbout']['mvs_id']['check'] = false;
				fields['blockMessageAbout']['mvs_title']['check'] = false;
				fields['blockMessageAbout']['mvs_date']['check'] = false;
				fields['blockMessageAbout']['unifiedstateregister']['check'] = false;
				
				fields['blockMessageAbout']['criminal']['check'] = false;
				$('#blockCriminal').hide();
				
				fields['blockMessageAbout']['administrativeprotocol']['check'] = false;
				fields['blockMessageAbout']['administrative_protocol_series']['check'] = false;
				fields['blockMessageAbout']['administrative_protocol_number']['check'] = false;	
				
				fields['blockMessageAbout']['competent_authorities_id']['valid'] = false;
				break;
			default:
				$('#blockCompetentAuthoritiesInfo').hide();
				$('#daiYes').hide();
				$('#daiNo').hide();
				//$('#blockEuroprotocol').show();
				$('#blockAministrativeProtocol').hide();
				$('#blockUnifiedStateRegister').hide();
				fields['blockMessageAbout']['mvs_id']['check'] = false;
				fields['blockMessageAbout']['mvs_title']['check'] = false;
				fields['blockMessageAbout']['mvs_date']['check'] = false;
				fields['blockMessageAbout']['unifiedstateregister']['check'] = false;
				
				fields['blockMessageAbout']['criminal']['check'] = false;
				$('#blockCriminal').hide();
				
				fields['blockMessageAbout']['administrativeprotocol']['check'] = false;
				fields['blockMessageAbout']['administrative_protocol_series']['check'] = false;
				fields['blockMessageAbout']['administrative_protocol_number']['check'] = false;	
				
				fields['blockMessageAbout']['competent_authorities_id']['valid'] = false;
				break;
		}
		checkFields(null);
	}
	
	function changeCriminal(value) {	
		if (value == 1) {
			$('#blockCriminalInfo').show();
			fields['blockMessageAbout']['criminal_name']['check'] = true;
			fields['blockMessageAbout']['criminal']['valid'] = true;
		} else if (value == -1) {
			$('#blockCriminalInfo').hide();
			fields['blockMessageAbout']['criminal_name']['check'] = false;
			fields['blockMessageAbout']['criminal']['valid'] = true;
		}
		if (checkFields('blockMessageAbout')) $('.blockDocuments').show();
		checkFields(null);
	}
	
	function showHideAssistanceBlock(value) {
        if (value == 1) {
            $('#assistanceYes').css('display', 'block');
			fields['blockMessageAbout']['assistance_date']['check'] = true;
        } else {
            $('#assistanceYes').css('display', 'none');
			fields['blockMessageAbout']['assistance_date']['check'] = false;
        }
		checkFields(null);
    }

	function showHideAssistanceDate(value) {
        if (value == 1) {
            $('#assistance_dateBlock').css('display', 'none');
			fields['blockMessageAbout']['assistance_date']['check'] = false;			
		} else {
            $('#assistance_dateBlock').css('display', 'block');
			fields['blockMessageAbout']['assistance_date']['check'] = true;
		}
		checkFields(null);
	}
	
	function changeAministrativeProtocol(value) {
		if (value == 1) {
			$('#blockAministrativeProtocolInfo').show();
			fields['blockMessageAbout']['administrative_protocol_series']['check'] = true;
			fields['blockMessageAbout']['administrative_protocol_number']['check'] = true;
		} else {
			$('#blockAministrativeProtocolInfo').hide();
			fields['blockMessageAbout']['administrative_protocol_series']['check'] = false;
			fields['blockMessageAbout']['administrative_protocol_number']['check'] = false;
		}
		checkFields(null);
	}
	
	function changeInspectingCar(value) {
		if (value == 1) {
			$('#blockInspectingCarInfo').hide();
			fields['blockCar']['inspecting_car_place']['check'] = false;
		} else {
			$('#blockInspectingCarInfo').show();
			fields['blockCar']['inspecting_car_place']['check'] = true;			
		}
		fields['blockCar']['inspecting_car']['valid'] = true;
		if (checkFields('blockCar')) $('.blockDriver').show();
		checkFields(null);
	}
	
	function changeInspectingProperty(value) {
		if (value == 1) {
			$('#blockInspectingPropertyInfo').show();
			fields['blockProperty']['inspecting_property_place']['check'] = true;
		} else {
			$('#blockInspectingPropertyInfo').hide();
			fields['blockProperty']['inspecting_property_place']['check'] = false;
		}
		if (checkFields('blockProperty')) $('.blockDocuments').show();
		checkFields(null);
	}
	
	function setDriver(types_id) {
		switch(types_id) {
			case 1:
			case 2:
				$('#blockDriverInfo').show();
				fields['blockDriver']['driver_lastname']['check'] = true;
				fields['blockDriver']['driver_firstname']['check'] = true;
				fields['blockDriver']['driver_patronymicname']['check'] = true;
				$.ajax({
					type:		'POST',
					url:		'index.php',
					dataType:	'json',
					data:		'do=Policies|getApplicationInfoInWindow' +
								'&types_id=' + types_id +
								'&policies_kasko_id=' + policies_kasko_id +
								'&policies_go_id=' + policies_go_id,
					success: function(result) {
						if (result.status == 1) {
							$('input[name=driver_lastname]').val(result.applicant_lastname);
							$('input[name=driver_firstname]').val(result.applicant_firstname);
							$('input[name=driver_patronymicname]').val(result.applicant_patronymicname);
							$('input[name=driver_lastname]').change();
							$('input[name=driver_firstname]').change();
							$('input[name=driver_patronymicname]').change();
						} else {
							alert('Інформацію не знайдено.');
						}
					}
				});
				break;
			case 3:
				$('#blockDriverInfo').show();
				fields['blockDriver']['driver_lastname']['check'] = true;
				fields['blockDriver']['driver_firstname']['check'] = true;
				fields['blockDriver']['driver_patronymicname']['check'] = true;
				$('input[name=driver_lastname]').val($('input[name=applicant_lastname]').val());
				$('input[name=driver_firstname]').val($('input[name=applicant_firstname]').val());
				$('input[name=driver_patronymicname]').val($('input[name=applicant_patronymicname]').val());
				$('input[name^=driver_]').change();
				break;
			case 4:
				$('#blockDriverInfo').hide();
				fields['blockDriver']['driver_lastname']['check'] = false;
				fields['blockDriver']['driver_firstname']['check'] = false;
				fields['blockDriver']['driver_patronymicname']['check'] = false;
				break;
			default:
				$('#blockDriverInfo').show();
				fields['blockDriver']['driver_lastname']['check'] = true;
				fields['blockDriver']['driver_firstname']['check'] = true;
				fields['blockDriver']['driver_patronymicname']['check'] = true;
				break;
		}
	}
	
	function changeVictimRisks(checked, type) {
		if (checked) {
			$('#victim_'+type+'_info').show();
		} else {
			$('#victim_'+type+'_info').hide();
		}
		
		for (param in fields['blockRisks']['victim'][type]) {
			fields['blockRisks']['victim'][type][param]['check'] = checked;
		}
		
		switch (type) {
			case 'car':
				fields['blockCar']['inspecting_car']['check'] = checked;
				if (checked /*&& checkFields('blockMessageAbout') || <?=intval($data['victim']['car']['flag'])?> > 0 && <?=$action?> == 'update'*/) {
					$('.blockCar').show();
					setDriver(0);
				}
				else {
					$('.blockCar').hide();
					setDriver(4);
				}
				break;
			case 'property':
				fields['blockProperty']['inspecting_property']['check'] = checked;
				if (checked /*&& checkFields('blockMessageAbout') || <?=intval($data['victim']['property']['flag'])?> > 0 && <?=$action?> == 'update'*/) $('.blockProperty').show();
				else $('.blockProperty').hide();
				break;
		}
		
		checkFields(null);
	}
	
	function changeParticipantsRowStyle() {
		for (i=0; i < document.getElementById('participants').rows.length; i++) {
			document.getElementById('participants').rows[ i ].style.background = (i % 2) ? '#FFFFFF' : '#F0F0F0';
		}
	}

    function changeDocumentsRowStyle() {
        for (i=0; i < document.getElementById('documents').rows.length; i++) {
            document.getElementById('documents').rows[ i ].style.background = (i % 2) ? '#FFFFFF' : '#F0F0F0';
        }
    }
	
	function changeParticipant(checked, number, type) {
		if (checked) {
			$('#participants'+number+'_'+type+'_info').show();
		} else {
			$('#participants'+number+'_'+type+'_info').hide();
		}
		
		for (param in fields['blockParticipants'][number][type]) {
			fields['blockParticipants'][number][type][param]['check'] = checked;
		}
		
		checkFields(null);
	}

    var num_participants = -1;

    function addParticipant() {

    	var participant =
			'<table>'+
				'<tr>'+
					'<td style="text-align: left;"  class="label grey">Прізвище, ім\'я, по батькові:<input type="text" id="participants' + num_participants + '_name" name="participants[' + num_participants + '][name]" value="" maxlength="50" class="fldText lastname" onfocus="this.className=\'fldTextOver lastname\'" onblur="this.className=\'fldText lastname\'" /></td>' +
				'</tr>' +
				'<tr><td><input value="1" type="checkbox" id="participants' + num_participants + '_car" name="participants[' + num_participants + '][car][flag]" onchange="changeParticipant(this.checked, ' + num_participants + ', \'car\')"/> <b>Транспортний засіб</b>'+
				'<tr id="participants' + num_participants + '_car_info" style="display: none;">'+
					'<td>' +
						'<table cellpadding="5" cellspacing="0">' +
							'<tr>' +								
								'<td class="grey">Тип ТЗ:</td>' +
								'<td><select id="participants' + num_participants + 'car_car_type_id" name="participants[' + num_participants + '][car][data][car_type_id]" class="fldSelect" value="" onchange="setBrandsCars(this.id)" /></select></td>' +
								'<td class="grey">Марка:</td>' +
								'<td><select id="participants' + num_participants + 'car_brand_id" name="participants[' + num_participants + '][car][data][brand_id]" class="fldSelect" value="" onchange="setModelsCars(this.id)" /></select></td>' +
								'<input type="hidden" id="participants' + num_participants + 'car_brand" name="participants[' + num_participants + '][car][data][brand]" value="" />' +
								'<td class="grey">Модель:</td>' +
								'<td><select id="participants' + num_participants + 'car_model_id" name="participants[' + num_participants + '][car][data][model_id]" class="fldSelect" value="" onchange="setModelTitle(this.id)" /></select></td>' +
								'<input type="hidden" id="participants' + num_participants + 'car_model" name="participants[' + num_participants + '][car][data][model]" value="" />' +
								'<td class="label grey">Державний знак:</td>' +
								'<td><input type="text" id="participants' + num_participants + 'car_sign" name="participants[' + num_participants + '][car][data][sign]" value="" maxlength="10" class="fldText number" onfocus="this.className=\'fldTextOver number\'" onblur="this.className=\'fldText number\'" /></td>' +
							'</tr>' +
							'<tr>' +
								'<td class="label grey">Пошкодження:</td>' +
								'<td colspan="9"><input type="text" id="participants' + num_participants + 'car_damage" name="participants[' + num_participants + '][car][data][damage]" value="" class="fldText number" onfocus="this.className=\'fldTextOver number\'" onblur="this.className=\'fldText number\'" /></td>' +
							'</tr>' +
						'</table>' +
					'</td>' +
				'</tr>'+
				'<tr><td><input value="1" type="checkbox" id="participants' + num_participants + '_property" name="participants[' + num_participants + '][property][flag]" onchange="changeParticipant(this.checked, ' + num_participants + ', \'property\')"/> <b>Майно</b>'+
				'<tr id="participants' + num_participants + '_property_info" style="display: none;">'+
					'<td>'+
						'<table>'+
							'<tr>'+
								'<td class="label grey">Назва:</td>'+
								'<td><input type="text" id="participants' + num_participants + 'property_name" name="participants[' + num_participants + '][property][data][name]" maxlength="50" class="fldText" onfocus="this.className=\'fldTextOver\'" onblur="this.className=\'fldText\'" /></td>' +
								'<td class="label grey">Адреса:</td>'+
								'<td><input type="text" id="participants' + num_participants + 'property_address" name="participants[' + num_participants + '][property][data][address]" maxlength="50" class="fldText" onfocus="this.className=\'fldTextOver\'" onblur="this.className=\'fldText\'" /></td>' +
								'<td class="label grey">Пошкодження:</td>'+
								'<td><input type="text" id="participants' + num_participants + 'property_damage" name="participants[' + num_participants + '][property][data][damage]" value="" class="fldText number" onfocus="this.className=\'fldTextOver number\'" onblur="this.className=\'fldText number\'" /></td>' +
							'</tr>'+
						'</table>' +
					'</td>'+
				'</tr>'+
				'<tr><td><input value="1" type="checkbox" id="participants' + num_participants + '_life" name="participants[' + num_participants + '][life][flag]" onchange="changeParticipant(this.checked, ' + num_participants + ', \'life\')"/> <b>Життя/здоров\'я</b>'+
				'<tr id="participants' + num_participants + '_life_info" style="display: none;">'+
					'<td>'+
						'<table>'+
							'<tr>'+
								'<td class="label grey">Ступінь ушкоджень:</td>'+
								'<td>'+
									'<select id="participants' + num_participants + 'life_damage_id" name="participants[' + num_participants + '][life][data][damage_id]" class="fldSelect">'+
										'<option>...</option>'+
										'<option value="1">Тимчасова втрата працездатності(травма)</option>'+
										'<option value="2">Стійка втрата працездатності(інвалідність 1 групи)</option>'+
										'<option value="3">Стійка втрата працездатності(інвалідність 2 групи)</option>'+
										'<option value="4">Стійка втрата працездатності(інвалідність 3 групи/інвалід-дитина)</option>'+
										'<option value="5">Смерть</option>'+
										'<option value="6">Моральна шкода</option>'+
									'</select>'+
								'</td>' +
								'<td class="label grey">Пошкодження:</td>'+
								'<td><input type="text" id="participants' + num_participants + 'life_damage" name="participants[' + num_participants + '][life][data][damage]" value="" class="fldText number" onfocus="this.className=\'fldTextOver number\'" onblur="this.className=\'fldText number\'" /></td>' +
							'</tr>'+
						'</table>' +
					'</td>'+
                    '<td><a href="javascript: deleteParticipant(' + num_participants + ')"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td>'
				'</tr>'+
				'<tr><td>&nbsp;</td></tr>'+
			'</table>';

		
			
    	$('#participants').append(participant);

		//car
        setTypesCars("participants" + num_participants + "car_car_type_id");
		
		var p = {				
				'car_type_id': {'check': false, 'valid': false},
				'brand_id': {'check': false, 'valid': false},
				'model_id': {'check': false, 'valid': false},
				'sign': {'check': false, 'valid': false},
				'damage': {'check': false, 'valid': false}
			};
			
		fields['blockParticipants'][num_participants] = {};
		
		fields['blockParticipants'][num_participants]['name'] = {'check': false, 'valid': false};
		
		fields['blockParticipants'][num_participants]['car'] = p;
		
		var i = num_participants;
		$('#participants' + i + '_name').bind(
			"change", function() {
				if (this.value.length) {
					fields['blockParticipants'][i]['name']['valid'] = true;
					checkFields(null);
					return;
				}
				fields['blockParticipants'][i]['name']['valid'] = false;
				showPrompt(this, 'Введіть \'Прізвище, ім\'я, по батькові\'.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);

		$('#participants' + i + 'car_car_type_id').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockParticipants'][i]['car']['car_type_id']['valid'] = true;
					checkFields(null);
					return;
				}
				fields['blockParticipants'][i]['car']['car_type_id']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати тип ТЗ.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		$('#participants' + i + 'car_brand_id').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockParticipants'][i]['car']['brand_id']['valid'] = true;
					checkFields(null);
					return;
				}
				fields['blockParticipants'][i]['car']['brand_id']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати марку ТЗ.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		$('#participants' + i + 'car_model_id').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockParticipants'][i]['car']['model_id']['valid'] = true;
					checkFields(null);
					return;
				}
				fields['blockParticipants'][i]['car']['model_id']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати модель ТЗ.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		$('#participants' + i + 'car_sign').bind(
			"change", function() {
				if (this.value.length && isValidSign(fixSignSimbols(this.value))) {
					fields['blockParticipants'][i]['car']['sign']['valid'] = true;
					checkFields(null);
					return;
				}
				fields['blockParticipants'][i]['car']['sign']['valid'] = false;
				showPrompt(this, 'Введіть номер ТЗ.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		$('#participants' + i + 'car_damage').bind(
			'change', function() {
				if (this.value.length) {
					fields['blockParticipants'][i]['car']['damage']['valid'] = true;
					checkFields(null);
					return;
				}
				fields['blockParticipants'][i]['car']['damage']['valid'] = false;
				showPrompt(this, 'Введіть пошкодження.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//property
		var p = {
				'name': {'check': false, 'valid': false},
				'address': {'check': false, 'valid': false},
				'damage': {'check': false, 'valid': false}
			};
			
		fields['blockParticipants'][num_participants]['property'] = p;
			
		$('#participants' + i + 'property_name').bind(
			'change', function() {
				if (this.value.length) {
					fields['blockParticipants'][i]['property']['name']['valid'] = true;
					checkFields(null);
					return;
				}
				fields['blockParticipants'][i]['property']['name']['valid'] = false;
				showPrompt(this, 'Введіть назву майна.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		$('#participants' + i + 'property_address').bind(
			'change', function() {
				if (this.value.length) {
					fields['blockParticipants'][i]['property']['address']['valid'] = true;
					checkFields(null);
					return;
				}
				fields['blockParticipants'][i]['property']['address']['valid'] = false;
				showPrompt(this, 'Введіть адресу майна.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		$('#participants' + i + 'property_damage').bind(
			'change', function() {
				if (this.value.length) {
					fields['blockParticipants'][i]['property']['damage']['valid'] = true;
					checkFields(null);
					return;
				}
				fields['blockParticipants'][i]['property']['damage']['valid'] = false;
				showPrompt(this, 'Введіть пошкодження майна.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		//life
		var p = {
				'damage_id': {'check': false, 'valid': false},
				'damage': {'check': false, 'valid': false}
			};
			
		fields['blockParticipants'][num_participants]['life'] = p;

		$('#participants' + i + 'life_damage_id').bind(
			"change", function() {
				if (parseInt(this.value) > 0) {
					fields['blockParticipants'][i]['life']['damage_id']['valid'] = true;
					checkFields(null);
					return;
				}
				fields['blockParticipants'][i]['life']['damage_id']['valid'] = false;
				$(this).blur();
				showPrompt(this, 'Потрібно вибрати ступінь ушкоджень');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		$('#participants' + i + 'life_damage').bind(
			'change', function() {
				if (this.value.length) {
					fields['blockParticipants'][i]['life']['damage']['valid'] = true;
					checkFields(null);
					return;
				}
				fields['blockParticipants'][i]['life']['damage']['valid'] = false;
				showPrompt(this, 'Введіть пошкодження особи.');
				$(this).bind(
					'focus', function() {
						$('#'+this.name.replaceArray(['\\[','\\]'],['',''])+'ErrorPrompt').remove();
					}
				);
			}
		);
		
		checkFields(null);
		
        num_participants--;

		changeParticipantsRowStyle();
    }
	
	function deleteParticipant(i) {
        if (confirm('Ви дійсно бажаєте вилучити інформацію по одному з участників ДТП?')) {

			delete(fields['blockParticipants'][i]);
			checkFields(null);
		
        	$('#participants' + i).remove();

			changeParticipantsRowStyle();
        }
    }
	
	var num_documents = -1;

    function addDocument() {
    	$('#documents').append('<tr><td><input type="text" name="document[' + num_documents + ']" value="" class="fldText" onfocus="this.className=\'fldTextOver\'" onblur="this.className=\'fldText\'" /></td><td width="30"><a href="#" onclick="deleteDocument(this)"><img src="/images/administration/navigation/delete_over.gif" width="19" height="19" alt="Вилучити" /></a></td></tr>');

		changeDocumentsRowStyle();
        num_documents--;
    }
	
	function deleteDocument(obj) {
        if (confirm('Ви дійсно бажаєте вилучити документ?')) {
            document.getElementById('documents').deleteRow( obj.parentNode.parentNode.sectionRowIndex );

            changeDocumentsRowStyle();
        }
    }
	
	function setCars(){
        if (participants_cars.length > 0) {
            for (var i=0; i < participants_cars.length; i++){
                setTypesCars("participants" + i + "car_car_type_id");
                document.getElementById("participants" + i + "car_car_type_id").value = participants_cars[i][0];
                setBrandsCars("participants" + i + "car_car_type_id");
                document.getElementById("participants" + i + "car_brand_id").value = participants_cars[i][1];
                setModelsCars("participants" + i + "car_brand_id");
                document.getElementById("participants" + i + "car_model_id").value = participants_cars[i][2];
                setModelTitle("participants" + i + "car_model_id");
            }
        }
    }

	function getCarTypes() {
        $.ajax({
            type:       'GET',
            url:        'index.php',
            dataType:   'script',
            data:       'do=CarTypes|getJavaScriptInWindow&product_types_id=<?=PRODUCT_TYPES_GO?>',
            success:    function (result){
							if (participants_cars.length > 0) {
								for (var i=0; i < participants_cars.length; i++){
									setTypesCars("participants" + i + "car_car_type_id");
									document.getElementById("participants" + i + "car_car_type_id").value = participants_cars[i][0];
								}
							}
			}
        });
    }

	function getCar() {
        $.ajax({
            type:       'GET',
            url:        'index.php',
            dataType:   'script',
            data:       'do=CarModels|getJavaScriptInWindow&product_types_id=<?=PRODUCT_TYPES_GO?>',
            success:    function (result) {
                            if (victim_car.length) {
                                $("#victim_car_type_id").val(victim_car[0]);
								if (parseInt($("#victim_car_type_id").val()) > 0) {
									fields['blockRisks']['victim']['car']['victim_car_type_id']['valid'] = true;
								}
                                setBrandsCars("victim_car_type_id");
                                $("#victim_brand_id").val(victim_car[1]);
								if (parseInt($("#victim_brand_id").val()) > 0) {
									fields['blockRisks']['victim']['car']['brand_id']['valid'] = true;
								}
                                setModelsCars("victim_brand_id");
                                $("#victim_model_id").val(victim_car[2]);
								if (parseInt($("#victim_brand_id").val()) > 0) {
									fields['blockRisks']['victim']['car']['model_id']['valid'] = true;
								}
								setModelTitle("victim_model_id");
                            }
							if (participants_cars.length > 0) {
								for (var i=0; i < participants_cars.length; i++){
									setTypesCars("participants" + i + "car_car_type_id");
									document.getElementById("participants" + i + "car_car_type_id").value = participants_cars[i][0];
									setBrandsCars("participants" + i + "car_car_type_id");
									document.getElementById("participants" + i + "car_brand_id").value = participants_cars[i][1];
									setModelsCars("participants" + i + "car_brand_id");
									document.getElementById("participants" + i + "car_model_id").value = participants_cars[i][2];
									setModelTitle("participants" + i + "car_model_id");
								}
							}
							searchPolicy(1);
							
							setRisks(<?=$data['application_risks_id']?>);
							<? if ($action == 'update') { ?>
								$('#<?=$this->objectTitle?> select, input, textarea').each(function(){
									if (this.type == 'radio' && this.checked || this.type != 'radio') {
										$(this).change();
									}
								}); 
							<? } ?>	
							setDriver(parseInt(<?=intval($data['driver_types_id'])?>));							
            }
        });
    }
	
	function setTypesCars(id){
        var car_types = document.getElementById(id);
        car_types.options.length = 0;
        car_types.options[0] = new Option ('...', '-1');
        for (var i=0; i < types.length; i++){
            car_types.options[i+1] = new Option (types[i][1], types[i][0]);
        }
    }

    function setBrandsCars(id){		
		var select_brands_id = document.getElementById(id.replace('car_type_id', 'brand_id')).value;	
        var car_types = document.getElementById(id);				
        var brands = document.getElementById(id.replace('car_type_id', 'brand_id'));		
        brands.options.length = 0;
        document.getElementById(id.replace('car_type_id', 'brand')).value = '';
        brands.options[0] = new Option ('...', '-1');
        for (var i=0; i < cars.length; i++){
            if (cars[i][0] == car_types[car_types.selectedIndex].value){
                for (var j=0; j < cars[i][1].length; j++){
                    brands.options[j+1] = new Option (cars[ i ][ 1 ][ j ][ 1 ], cars[ i ][ 1 ][ j ][ 0 ]);
                }
            }
        }
		$('#'+id.replace('car_type_id', 'brand_id')).val(select_brands_id);
    }

    function setModelsCars(id){
		var select_models_id = document.getElementById(id.replace('brand_id', 'model_id')).value;
		var brands = document.getElementById(id);
		var car_types = document.getElementById(id.replace('brand_id', 'car_type_id'));
		var models = document.getElementById(id.replace('brand_id', 'model_id'));
		document.getElementById(id.replace('brand_id', 'brand')).value = brands[brands.selectedIndex].text;
		document.getElementById(id.replace('brand_id', 'model')).value = '';
		models.options.length = 0;
		models.options[0] = new Option ('...', '-1');
		for (var i=0; i < cars.length; i++) {
			if (cars[ i ][ 0 ] == car_types[car_types.selectedIndex].value) {
				for (var j=0; j < cars[ i ][ 1 ].length; j++) {
					if (cars[ i ][ 1 ][ j ][ 0 ] == brands[brands.selectedIndex].value) {
						for (var k=0; k < cars[ i ][ 1 ][ j ][ 2 ].length; k++) {
							models.options[k+1] = new Option( cars[ i ][ 1 ][ j ][ 2 ][ k ][ 1 ], cars[ i ][ 1 ][ j ][ 2 ][ k ][ 0 ]);
							/*if (cars[ i ][ 1 ][ j ][ 2 ][ k ][ 0 ] == models[models.selectedIndex].value) {
								model.selectedIndex = k;
							}*/
						}
						break;
					}
				}
			}
		}
		$('#'+id.replace('brand_id', 'model_id')).val(select_models_id);
    }

    function setModelTitle(id){
		var models = document.getElementById(id);
		document.getElementById(id.replace('model_id', 'model')).value = models[models.selectedIndex].text;
    }
	
	function getMVSList() {
        $.ajax({
            type:	    'POST',
            url:	    'index.php',
            dataType:   'script',
            data:	    'do=MVS|getJSListInWindow',
            success: function(result) {
                mvs_information_list.results = mvs_information;
                mvs_information_list.total = mvs_information.length;
				$('#mvs_id').flexbox(mvs_information_list, {
					allowInput: <?=($action == 'view' ? 0 : 1)?>,
					width: 400,
					paging: false,
					maxVisibleRows: 8,
					maxCacheBytes: 0,
					noResultsText: 'Результатів не знайдено',
                    readOnly: <?=($action == 'view' ? 1 : 0)?>,
					compare: function(elem){
							return true;
					},
					onSelect: function(){
						var mvs_id = parseInt($('input[name=mvs_id]').val());
						if (mvs_id > 0) fields['blockMessageAbout']['mvs_id']['valid'] = true;
						else fields['blockMessageAbout']['mvs_id']['valid'] = false;
					}
				});
				setMVSId();
				$('#mvs_id_input').val($('input[name=mvs_id_title]').val());				
            }

        });
	}
   
	function setMVSId() {
		$('#mvs_id_hidden').val(<?=$data['mvs_id']?>);
		<? if($data['mvs_id'] > 0) { ?>	
			fields['blockMessageAbout']['mvs_id']['valid'] = true;
			$('#mvs_id_input').val("<?=MVS::getTitle($data['mvs_id'])?>");
		<? } ?>
	}
	
	function checkStatus() {
		var count = 0;
		var count0 = 0;
		var count1 = 0;
		$('select[name^=accident_statuses_id]').each(function(){
			count++;
			if (parseInt(this.value) > 0) count1++;
			else count0++;
		});
		if (count1 == count || count0 == count) { 
			$('input[name=btn_save]').show();
			$('input[name=btn_load]').show();
		} else {
			$('input[name=btn_save]').hide();
			$('input[name=btn_load]').hide();
		}
	}
	
	function save() {
		$('input[name=download]').val(0);
		eval('document.<?=$this->objectTitle?>.submit()');
	}
	
	function load() {
		$('input[name=download]').val(1);
		eval('document.<?=$this->objectTitle?>.submit()');
	}
	
	function view() {
		window.location = '?do=<?=$this->object?>|view&id=<?=$data['id']?>';
	}
	
	function back() {
		window.location = '?do=Accidents|show';
	}

    function download() {
        window.location = '?do=AccidentDocuments|downloadFileInWindow&application_accidents_id=<?=$data['id']?>&document_product_types_id=149&download=1';
    }
	
	function getApplicationCalls() {		
		$.ajax({
			type:	    'POST',
            url:	    'index.php',
            dataType:   'json',
            data:	    'do=ApplicationCalls|getJSONListInWindow'+
						'&policies_kasko_items_id=<?=$data['policies_kasko_items_id']?>'+
						'&application_accidents_id=<?=$data['id']?>',
            success: 	setTableApplicationCalls,
		});
	}
	
	function setTableApplicationCalls(list) {
		var application_accidents_id = parseInt(<?=intval($data['id'])?>);
		$('#blockCallsInfo').append('<tr class="columns"><td>Номер</td><td>Договір</td><td>Заявник</td><td>Марка</td><td>Модель</td><td>Дата та час події</td><td>Адреса</td><td>Дата заяви</td><td>Дія</td></tr>');
		
		for (i in list) {	
			row = list[i];
			calls_id = row.id;
			log(calls_id);
			font_weight = '';
			if (application_accidents_id == row.application_accidents_id) {
				font_weight = 'bold';
			} else {
				font_weight = 'normal';
			}			
			href = '<td><a id="callID' + row.id + '" style="cursor: pointer;">Вибрати</a></td>';
			$('#blockCallsInfo').append('<tr id="rowCall'+calls_id+'" style="font-weight: '+font_weight+'"><td>'+row.number+'</td><td>'+row.policies_kasko_number+'</td><td>'+row.applicant+'</td><td>'+row.car_brands_id+'</td><td>'+row.car_models_id+'</td><td>'+row.datetime_format+'</td><td>'+row.address+'</td><td>'+row.created_format+'</td>'+href+'</tr>');			
			$('#callID'+calls_id).bind('click', function() {
				setRelation(this.id);
			});
		}
	}
	
	function setRelation(objId) {
		$.ajax({
			type:	    'POST',
            url:	    'index.php',
            dataType:   'json',
            data:	    'do=ApplicationCalls|setRelationInWindow'+
						'&application_calls_id='+objId.replace('callID', '')+
						'&application_accidents_id=<?=$data['id']?>',
            success: 	function(result) {				
				if (result.result == 1) {
					$('[id^=rowCall]').each(function(){
						log(this.id);
						$(this).css('font-weight', 'normal');
					});
					$('#rowCall'+objId.replace('callID', '')).css('font-weight', 'bold');
					alert("Зв'язок встановлено");
				} else {
					alert("Помилка");
				}
			},
		});
	}
	
</script>

<form style="margin: 10px;" id="<?=$this->objectTitle?>" name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF)']?>" method="post" enctype="multipart/form-data" onsubmit="return checkFields(null);">
    <input type="hidden" name="do" value="<?=$this->object . '|' . $action?>" />
    <input type="hidden" name="id" value="<?=($data['id'] ? $data['id'] : -1)?>" />
    <input type="hidden" name="accidents_id" value="<?=($data['accidents_id'] ? $data['accidents_id'] : -1)?>" />
	<input type="hidden" name="policies_kasko_id" value="<?=$data['policies_kasko_id']?>" />
	<input type="hidden" name="policies_kasko_items_id" value="<?=$data['policies_kasko_items_id']?>" />
	<input type="hidden" name="policies_go_id" value="<?=$data['policies_go_id']?>" />
	<input type="hidden" name="download" value="0" />
	
	<? include_once 'blocks/blockApplicantType.php' ?>	
	<? include_once 'blocks/blockTimeAndPlace.php' ?>
	<? include_once 'blocks/blockPolicies.php' ?>
	<? include_once 'blocks/blockApplicant.php' ?>
	<? include_once 'blocks/blockRisks.php' ?>
	<? include_once 'blocks/blockMessageAbout.php' ?>
	<? include_once 'blocks/blockCar.php' ?>
	<? include_once 'blocks/blockProperty.php' ?>
	<? include_once 'blocks/blockDriver.php' ?>
	<? include_once 'blocks/blockParticipants.php' ?>
	<? include_once 'blocks/blockDocuments.php' ?>
	<? include_once 'blocks/blockParameters.php' ?>

    <? if (!intval($data['in_accidents'])) { ?>
	<table>
		<tr>
			<? if ($action != 'view') {?>
			<td>
				<input onclick="save()" name="btn_save" type="button" value=" Зберегти " onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" />
			</td>
			<td>
				<input onclick="view()" name="btn_view" type="button" value=" Перегляд " onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" style="display: <?=($data['id'] ? 'block' : 'none')?>" />
			</td>
			<? } ?>
            <td>
                <input onclick="load()" name="btn_load" type="button" value=" Скачати " onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" />
            </td>
			<td>
				<input onclick="back()" name="btn_back" type="button" value=" Назад " onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" class="button" style="display: <?=($data['id'] ? 'block' : 'none')?>" />
			</td>
		</tr>
	</table>
    <? } ?>
	
</form>
<script type="text/javascript">	
    initFocus(document.<?=$this->objectTitle?>);
</script>

<div id="hiddenModalContent" style="display:none;">
    <div id="ajaxBusy" style="align: center; display: none; position: static; width: 780px;"><p align="center">Пошук<br /><img src="images/loading.gif"></p></div>
	
	<div id="policiesTable">
		<table cellpadding="5" cellspacing="0" border="1">
		<tr>
			<td class="label grey">Номер договору:</td>
			<td><input type="text" id="search_policies_number" name="search_policies_number" maxlength="20" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
			<td class="label grey">Дата:</td>
			<td><?=$this->getDateSelect($this->formDescription['fields'][ $this->getFieldPositionByName('search_policies_date') ], $data['search_policies_date_year' ], $data['search_policies_date_month' ], $data['search_policies_date_day' ], 'search_policies_date', $this->getReadonly(true))?></td>
			<td class="label grey">Страхувальник:</td>
			<td><input type="text" id="search_insurer_lastname" name="search_insurer_lastname" maxlength="50" class="fldText lastname" onfocus="this.className='fldTextOver lastname'" onblur="this.className='fldText lastname'" <?=$this->getReadonly()?> /></td>
		</tr>
		<!--/table>

		<table cellpadding="5" cellspacing="0"-->
		<tr>		
			<td class="label grey">Паспорт:</td>
			<td>
				<input type="text" id="search_insurer_passport_series" name="search_insurer_passport_series" maxlength="2" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly()?> />
				<input type="text" id="search_insurer_passport_number" name="search_insurer_passport_number" maxlength="13" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> />
			</td>
			<td class="label grey">ІПН:</td>
			<td><input type="text" id="search_insurer_identification_code" name="search_insurer_identification_code" maxlength="10" class="fldText code" onfocus="this.className='fldTextOver code'" onblur="this.className='fldText code'" <?=$this->getReadonly()?> /></td>
			<td class="label grey">Водійські права:</td>
			<td>
				<input type="text" id="search_insurer_driver_licence_series" name="search_insurer_driver_licence_series" maxlength="3" class="fldText series" onfocus="this.className='fldTextOver series'" onblur="this.className='fldText series'" <?=$this->getReadonly()?> />
				<input type="text" id="search_insurer_driver_licence_number" name="search_insurer_driver_licence_number" maxlength="6" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> />
			</td>		
		</tr>
		<!--/table>

		<table cellpadding="5" cellspacing="0"-->
		<tr>		
			<td class="label grey">№ шасі (кузов, рама):</td>
			<td><input type="text" id="search_shassi" name="search_shassi" maxlength="20" class="fldText shassi" onfocus="this.className='fldTextOver shassi'" onblur="this.className='fldText shassi'" <?=$this->getReadonly()?> /></td>
			<td class="label grey">Державний знак:</td>
			<td><input type="text" id="search_sign" name="search_sign" maxlength="10" class="fldText number" onfocus="this.className='fldTextOver number'" onblur="this.className='fldText number'" <?=$this->getReadonly()?> /></td>
			<td></td>
			<td align="right"><input type="button" id="search_button" value="Знайти" onclick="searchPolicy(0)" class="button" onmouseover="this.className = 'buttonOver';" onmouseout="this.className = 'button';" /></td>
		</tr>
		</table>
		
		<div id="searchPoliciesList" style="width: 780px;">
		</div>		
	</div>
</div>

<?

if (intval($data['id']) && $action == 'view' && !$data['in_accidents'] && !intval($data['download']) || $data['in_accidents'] && $data['product_types_id'] == PRODUCT_TYPES_GO && $data['owner_types_id'] == 1) {
	$data['application_accidents_id'] = $data['id'];
	$AccidentDocuments = new AccidentDocuments($data);
	$AccidentDocuments->show(array('application_accidents_id' => $data['application_accidents_id'], 'application_accident_statuses_id' => $data['statuses_id']));
}

if (intval($data['download'])) {
	/*$AccidentDocuments = new AccidentDocuments($data);
	$AccidentDocuments->downloadFileInWindow(array('application_accidents_id' => $data['id'], 'document_product_types_id' => 149));*/
    echo '<script>download();</script>';
}

?>