<?

	if(in_array(ACCOUNT_GROUPS_AVERAGE, $Authorization->data['account_groups_id']) && !isset($data['show'])) {
		$data['show'] = 'kasko';
	}

?>

<script>

	$(document).ready(function(){
	
		$('#showApplicationCalls').click(function(){
			location = 'index.php?do=Accidents|show&show=calls';
		});
		
		$('#showApplicationAccidents').click(function(){
			location = 'index.php?do=Accidents|show&show=applications';
		});
		
		$('#showAccidentDocuments').click(function(){
			location = 'index.php?do=Accidents|show&show=documents';
		});
		
		$('#showAccidentMessages').click(function(){
			location = 'index.php?do=Accidents|show&show=messages';
		});
		
		$('#showAccidentsKasko').click(function(){
			location = 'index.php?do=Accidents|show&show=kasko';
		});
		
		$('#showAccidentsGo').click(function(){
			location = 'index.php?do=Accidents|show&show=go';
		});
		
		$('#showAccidentsProperty').click(function(){
			location = 'index.php?do=Accidents|show&show=property';
		});
		
		$('#showAccidentsCargo').click(function(){
			location = 'index.php?do=Accidents|show&show=cargo';
		});
		
		$('#showRecoveryRepairs').click(function(){
			location = 'index.php?do=Accidents|show&show=recovery';
		});
		
	});

</script>

<br />
<div style="margin-left: 20px;">
	<ul id="tabs">
		<li><a id="showApplicationCalls" style="cursor: pointer; " class="<?=($data['show'] == 'calls' ? 'active' : '')?>"><span>Дзвінки</span></a></li>
		<li><a id="showApplicationAccidents" style="cursor: pointer;" class="<?=($data['show'] == 'applications' ? 'active' : '')?>"><span>Повідомлення</span></a></li>
		<li><a id="showAccidentDocuments" style="cursor: pointer;" class="<?=($data['show'] == 'documents' ? 'active' : '')?>"><span>Документи</span></a></li>
		<li><a id="showAccidentMessages" style="cursor: pointer;" class="<?=($data['show'] == 'messages' ? 'active' : '')?>"><span>Задачі</span></a></li>
		<li><a id="showAccidentsKasko" style="cursor: pointer;" class="<?=($data['show'] == 'kasko' ? 'active' : '')?>"><span>КАСКО</span></a></li>
		<li><a id="showAccidentsGo" style="cursor: pointer;" class="<?=($data['show'] == 'go' ? 'active' : '')?>"><span>ОСЦПВ</span></a></li>
		<li><a id="showAccidentsProperty" style="cursor: pointer;" class="<?=($data['show'] == 'property' ? 'active' : '')?>"><span>Майно</span></a></li>
		<li><a id="showAccidentsCargo" style="cursor: pointer;" class="<?=($data['show'] == 'cargo' ? 'active' : '')?>"><span>Вантаж та багаж</span></a></li>
		<li><a id="showRecoveryRepairs" style="cursor: pointer;" class="<?=($data['show'] == 'recovery' ? 'active' : '')?>"><span>Відновлювальний ремонт</span></a></li>
	</ul>

	<br />
	<div id="showBlock" border="1">
		<?
			switch ($data['show']) {
				case 'calls':
					$ApplicationCalls = new ApplicationCalls($data);
					$ApplicationCalls->show($data);
					break;
				case 'applications':
					$ApplicationAccidents = new ApplicationAccidents($data);
					$ApplicationAccidents->show($data);
					break;
				case 'documents':
					$AccidentDocuments = new AccidentDocuments($data);
					$AccidentDocuments->show($data);
					break;
				case 'messages':
					$AccidentMessages = new AccidentMessages($data);
					$AccidentMessages->show($data);
					break;
				case 'kasko':
					$data['product_types_id'] = PRODUCT_TYPES_KASKO;
					$Accidents = Accidents::factory($data, ProductTypes::get($data['product_types_id']));
					$Accidents->show($data);
					break;
				case 'go':
					$data['product_types_id'] = PRODUCT_TYPES_GO;
					$Accidents = Accidents::factory($data, ProductTypes::get($data['product_types_id']));
					$Accidents->show($data);
					break;
				case 'property':
					$data['product_types_id'] = PRODUCT_TYPES_PROPERTY;
					$Accidents = Accidents::factory($data, ProductTypes::get($data['product_types_id']));
					$Accidents->show($data);
					break;
				case 'cargo':
					$data['product_types_id'] = PRODUCT_TYPES_CARGO_CERTIFICATE;
					$Accidents = Accidents::factory($data, ProductTypes::get($data['product_types_id']));			
					$Accidents->show($data);
					break;
				case 'recovery':
					require_once 'RecoveryRepairs.class.php';
					$RecoveryRepairs = new RecoveryRepairs($data);			
					$RecoveryRepairs->show($data);
					break;
				default:					
					break;
			}
		
		?>
	</div>
</div>

