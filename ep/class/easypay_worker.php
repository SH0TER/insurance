<?php

namespace easypay {

    class EasyPayWorker {

        private $responseCodes = array (
            ERROR_DB_CONNECT        =>  'Error in connection to DB',
            ERROR_WRONG_XML         =>  'Error in request (Wrong XML)',
            ERROR_WRONG_SERVICE_ID  =>  'Error in XML Data (Wrong ServiceId)',
            ERROR_NO_ERROR          =>  'Ok - user found',
            ERROR_NOT_FOUND         =>  'User not found',
        );

        public function __construct($xmlArray)
        {
            $this->init($xmlArray);
            $Account = trim(XmlWorker::getValueByTag($xmlArray, 'Account'));
            $this->getInfoAboutClient($Account);
        }

        private function init($xmlArray)
        {
            $log = new Log();
            $errors = array_filter($xmlArray);

            if (empty($errors)) {

                $log->addToLog(null, ERROR_WRONG_XML);
                unset($log);

                exit(print($this->sendResponse(null, ERROR_WRONG_XML)));
            }

            if (intval(XmlWorker::getValueByTag($xmlArray, 'ServiceId')) !== 3346) {

                $log->addToLog(null, ERROR_WRONG_SERVICE_ID);
                unset($log);

                exit(print($this->sendResponse(null, ERROR_WRONG_SERVICE_ID)));
            }
        }

        private function getInfoAboutClient($Account)
        {
            $log = new Log();
            $db = new DB();

            if($db->error === ERROR_DB_CONNECT) {
                $db->closeConnection();
                $log->addToLog($Account, ERROR_DB_CONNECT);
                unset($log);

                exit(print($this->sendResponse(null, ERROR_DB_CONNECT)));
            }

            $infoAboutClient = $db->getInfoFromClient($Account);

            $db->closeConnection();

            $log->addToLog($Account, $db->error);
            unset($log);

            exit($this->sendResponse($infoAboutClient, $db->error));
        }

        public function dateTime($check = false)
        {
            if(!$check)
                return date('Y-m-d\TH:i:s', time());
            else
                return date('Y-m-d H:i:s', time());
        }

        public function sendResponse($info = null, $error = ERROR_NOT_FOUND)
        {
            $response = array(
                'StatusCode'    =>  $error,
                'StatusDetail'  =>  $this->responseCodes[$error],
                'DateTime'      =>  $this->dateTime(),
                'Sign'          =>  '',
            );

            if($info && $error === ERROR_NO_ERROR)
                foreach ($info as $key => $value)
                    $response['AccountInfo'][$key] = $value;

            return XmlWorker::formatToXml($response);
        }
    }
}