<?php

namespace easypay {

    class DB {

        private $mysqli = null;
        public $error = ERROR_NOT_FOUND;

        public function __construct()
        {
            $this->mysqli = new \mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);

            if($this->mysqli->connect_errno)
                $this->error = ERROR_DB_CONNECT;
            else {
                $this->mysqli->query('SET character_set_server = utf8');
                $this->mysqli->query('SET collation_server =  utf8_unicode_ci');
                $this->mysqli->query('SET character_set_database = utf8');
                $this->mysqli->query('SET collation_database =  utf8_unicode_ci');
                $this->mysqli->query('SET character_set_connection = utf8');
                $this->mysqli->query('SET collation_connection = utf8_unicode_ci');
                $this->mysqli->query('SET character_set_client = utf8');
                $this->mysqli->query('SET character_set_results = utf8');
            }
        }

        public function __destruct()
        {
            if($this->mysqli)
            {
                $this->mysqli->close();
                unset($this->mysqli);
            }
        }

        public function closeConnection()
        {
            if($this->mysqli)
            {
                $this->mysqli->close();
                unset($this->mysqli);
            }
        }

        public function addToLog($Account = null, $error)
        {
            $sqlText = "INSERT INTO easypay_log (account, error, `date`) VALUES (?, ?, ?)";

            if($sql = $this->mysqli->prepare($sqlText)) {
                $null = "NULL";

                if($Account)
                    $sql->bind_param("sis", $Account, $error, EasyPayWorker::dateTime(true));
                else
                    $sql->bind_param("sis", $null, $error, EasyPayWorker::dateTime(true));

                unset($null);

                $sql->execute();
                $sql->close();
            }
        }

        public function getInfoFromClient($Account)
        {
            $sqlText = "SELECT a.insurer AS Fio, a.begin_datetime as Data, 
                    IF(e.insurer_identification_code IS NOT NULL, e.insurer_identification_code, IF(f.insurer_identification_code IS NOT NULL, f.insurer_identification_code,
                    IF(h.insurer_identification_code IS NOT NULL, h.insurer_identification_code, IF(b.insurer_identification_code IS NOT NULL, b.insurer_identification_code, 
                    IF(c.insurer_identification_code IS NOT NULL, c.insurer_identification_code, IF(d.insurer_identification_code IS NOT NULL, d.insurer_identification_code, 
                    IF(g.insurer_identification_code IS NOT NULL, g.insurer_identification_code, '0000000000'))))))) AS Inn
                    FROM insurance_policies a
                    LEFT JOIN insurance_policies_danger_objects b on a.id = b.policies_id
                    LEFT JOIN insurance_policies_dgo c on a.id = c.policies_id
                    LEFT JOIN insurance_policies_dms d on a.id = d.policies_id
                    LEFT JOIN insurance_policies_go e on a.id = e.policies_id
                    LEFT JOIN insurance_policies_kasko f on a.id = f.policies_id
                    LEFT JOIN insurance_policies_mortage g on a.id = g.policies_id
                    LEFT JOIN insurance_policies_ns h on a.id = h.policies_id
                    WHERE a.number = ? ORDER BY Data DESC LIMIT 1;";

            if ($sql = $this->mysqli->prepare($sqlText)) {

                $sql->bind_param("s", $Account);
                $sql->execute();

                $sql->bind_result($result['Fio'], $result['Date'], $result['Inn']);
                $sql->fetch();

                $sql->close();

                foreach ($result as $key => $value)
                    if($value != '')
                        $this->error = ERROR_NO_ERROR;
                    else
                        $this->error = ERROR_NOT_FOUND;
            } else {
                $this->error = ERROR_DB_CONNECT;
            }

            return $result;
        }

    }
}