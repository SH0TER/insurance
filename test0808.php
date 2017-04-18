<?php
include_once './include/collector.inc.php';

$row['manager_id'] = '7225';

$sqlTemp = 'SELECT allcomission as comission 
                FROM insurance_agents WHERE allcomission = 1 
                and accounts_id = ' . intval($row['manager_id']);

                $rowTemp = $db->getRow($sqlTemp);

                if (!$rowTemp['comission'])
                    echo 'true';
				else
					echo 'false';

?>