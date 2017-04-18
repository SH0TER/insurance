<?php

namespace easypay {

    class Log {

        private $db = null;
        private $filelog = null;

        public function __construct()
        {
            $this->db = new DB();
            
            if($this->db->error === ERROR_DB_CONNECT) {
                if($error === ERROR_NO_ERROR || $error === ERROR_NOT_FOUND) {
                    $this->filelog = fopen("logs/log_" . date('d-m-Y', time()) . ".txt", "a");
                } else {
                    $this->filelog = fopen("logs/error_" . date('d-m-Y', time()) . ".txt", "a");
                }

                $this->db-closeConnection();
                unset($this->db);
            }
        }

        public function addToLog($Account = null, $error = null)
        {
            if($this->db) {
                $this->db->addToLog($Account, $error);
            } elseif ($this->filelog) {
                fwrite($this->filelog, EasyPayWorker::dateTime()."\t| ".($Account) ? $Account : '' ."\t|".$error.";");
            }
        }

        public function __destruct()
        {
            $this->db->closeConnection();

            if($this->filelog)
                fclose($this->filelog);

            unset($this->filelog);
            unset($this->db);
        }

    }

}