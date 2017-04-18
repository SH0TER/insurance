<?php

header('Content-type: text/xml');

use easypay\EasyPayWorker;
use easypay\XmlWorker;
use easypay\DB;
use easypay\Log;

include './lib/constants.php';
include './class/xml_worker.php';
include './class/easypay_worker.php';
include './class/database_worker.php';
include './class/log_worker.php';

$easyPayWorker = new EasyPayWorker(XmlWorker::xmlToArray(trim(file_get_contents('php://input'))));
unset($easyPayWorker);