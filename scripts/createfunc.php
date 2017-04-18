<?

require_once '../include/collector.inc.php';

$sql = 'DROP FUNCTION IF EXISTS insurance.getCarParameters';
$db->query($sql);

$sql = 'CREATE FUNCTION insurance.`getCarParameters`(param_type INT, param_subtype INT) RETURNS varchar(30) CHARSET utf8
BEGIN
  RETURN CASE param_type
      WHEN 1 THEN
        CASE param_subtype 
          WHEN 1 THEN \'Седан\'
          WHEN 2 THEN \'Універсал\'
		  WHEN 3 THEN \'Позашляхових / Кроссовер\'
		  WHEN 4 THEN \'Хетчбек\'
		  WHEN 5 THEN \'Кабріолет\'
		  WHEN 6 THEN \'Купе\'
		  WHEN 7 THEN \'Лімузин\'
		  WHEN 8 THEN \'Мікроавтобус\'
		  WHEN 9 THEN \'Мінівен\'
		  WHEN 10 THEN \'Пікап\'
		  WHEN 11 THEN \'Фургон\'
        END
      WHEN 2 THEN
        CASE param_subtype
          WHEN 1 THEN \'Автомат\'
          WHEN 2 THEN \'Ручна / Механіка\'
		  WHEN 3 THEN \'Адаптивна\'
		  WHEN 4 THEN \'Варіатор\'
		  WHEN 5 THEN \'Типтронік\'
        END
	  WHEN 3 THEN
		CASE param_subtype
		  WHEN 1 THEN \'Бензин\'
		  WHEN 2 THEN \'Дизель\'
		  WHEN 3 THEN \'Газ\'
		  WHEN 4 THEN \'Газ/бензин\'
		  WHEN 5 THEN \'Гібрид\'
		  WHEN 6 THEN \'Електро\'
		END
    END;
END;';
$db->query($sql);

?>