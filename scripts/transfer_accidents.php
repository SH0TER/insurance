<?php
/**
 * Created by JetBrains PhpStorm.
 * User: m.marchuk
 * Date: 01.02.13
 * Time: 10:48
 * To change this template use File | Settings | File Templates.
 */

require_once '../include/collector.inc.php';

$from_masters_id = 8876;
$to_masters_id = 8916;

//master's name
$sql = 'SELECT CONCAT(lastname, \' \', firstname) FROM insurance_accounts WHERE id = ' . $to_masters_id;
$name = $db->getOne($sql);

//get accidents
$sql = 'SELECT id FROM insurance_accidents WHERE product_types_id IN (3,4) '. /*AND created > \'2012-05-31\'*/ 'AND masters_id = ' . $from_masters_id;
$accidents = $db->getCol($sql);

_dump(implode(',', $accidents));

//update accidents
$sql = 'UPDATE insurance_accidents SET masters_id = ' . $to_masters_id . ' WHERE id IN(' . implode(',', $accidents) . ') AND masters_id = ' . $from_masters_id;
$db->query($sql);

//update messages
$sql = 'UPDATE insurance_accident_messages SET recipients_id = ' $to_masters_id . ', recipient = ' . $db->quote($name) . ' WHERE id IN(' . implode(',', $accidents_) . ') AND masters_id = ' . $from_masters_id;
$db->query($sql);

//update history
$sql = 'UPDATE insurance_accident_status_changes SET accounts_id = ' . $to_masters_id . ', accounts_title = ' . $db->quote($name) . ' WHERE accidents_id IN(' . implode(',', $accidents) . ') AND accident_statuses_id = 1';
$db->query($sql);

//update documents
$sql = 'UPDATE insurance_accident_documents SET authors_id = ' . $to_masters_id . ', authors_title = ' . $db->quote($name) . ' WHERE accidents_id IN(' . implode(',', $accidents) . ') AND authors_id = ' . $from_masters_id;
$db->query($sql);
$sql = 'UPDATE insurance_accident_documents SET managers_id = ' . $to_masters_id . ' WHERE accidents_id IN(' . implode(',', $accidents) . ') AND managers_id = ' . $from_masters_id;
$db->query($sql);

//update comments
$sql = 'UPDATE insurance_accident_comments SET authors_id = ' . $to_masters_id . ', authors_title = ' . $db->quote($name) . ' WHERE accidents_id IN(' . implode(',', $accidents) . ') AND authors_id = ' . $from_masters_id;
$db->query($sql);
 
?>