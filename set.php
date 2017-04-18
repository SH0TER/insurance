<?
require_once 'include/collector.inc.php';
 
	$sql='
		INSERT INTO ukrauto_questionnaire_messages(questionnairesId,auto_showsId,authorRolesId,authorsId,author,recipientRolesId,recipientOrganization,
										subject,created ,	 modified)
		 select
a.id,a.auto_showsId,8,a.managersId, concat(c.lastname,\' \',c.firstname) ,2,\'Операційний центр\',\'Нова консультацiя була створена\',b.created,b.created
					   from  ukrauto_questionnaires a
					   join ukrauto_managers c on c.accountsId=a.managersId
					   join ukrauto_questionnaires_state_changes b on b.questionnairesId=a.id and b.questionnaire_statusesId=20
					   where b.questionnaire_statusesId=20
		';
		
		$sql='
		update `insurance_agents` a
		join  insurance_accounts b on b.id=a.accounts_id
set 
 ground_kasko_express=\'Довіреності № СК/0221/13-12 від 01.07.2013\' ,
ground_ns_express=\'Довіреності № СК/0221/13-12 від 01.07.2013\' ,ground_ns_gl=\'Довіреності № СК/0221/13-12 від 01.07.2013\'
WHERE `agencies_id` in (
select id from insurance_agencies where code like \'557.%\' OR code=\'557\'
)  
			';		  
		echo $sql;
		$db->query($sql);
		echo 'done111111';
?>
