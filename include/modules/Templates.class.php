<?
/*
 * Title: template class
 *
 * @author Eugene Cherkassky
 * @email 
 * @version 3.0
 */

class Templates extends Form {

	var $object = 'Templates';

	function factory($data, $type = 'Mail') {
		require_once 'Templates/' . $type . '.class.php';

		$class = 'Templates_' . $type;
		@$obj =& new $class($data);

		return $obj;
	}

	function isExists($table, $field, $value, $id, $data) {
		global $db;

		$conditions[] = 'id <> ' . intval($id);
		$conditions[] = $field . '=' . $db->quote($value);
		$conditions[] = 'sections_id = ' . intval($data['sections_id']);

		$sql =	'SELECT count(*) ' . 
				'FROM ' . $table . ' ' . 
				'WHERE ' . implode(' AND ', $conditions);
		$count = $db->getOne($sql);

		return ($count != 0);
	}

	function getNextOrderPosition($data) {
		global $db;

		$field = $this->getOrderPositionField();

		if (!$field) {
			return;
		}

		$sql =	'SELECT MAX(order_position) + 1 ' .
				'FROM ' . $this->tables[0] . ' ' .
				'WHERE sections_id = ' . intval($data['sections_id']);
		$order_position = $db->getOne($sql);

		return (intval($order_position) == 0) ? 1 : $order_position;
	}

	function renumerateLinear($data) {
		global $db;

		$sql =	'SELECT * ' .
				'FROM ' . $this->tables[0] . ' ' .
				'WHERE sections_id = ' . intval($data['sections_id']) . ' ' .
				'ORDER BY order_position';
		$res = $db->query($sql);

		$order_position = 1;
		while ($res->fetchInto($row)) {
			$sql =	'UPDATE ' . $this->tables[0] . ' SET ' . 
					'order_position = ' . intval($order_position) . ' ' .
					'WHERE id = ' . intval($row['id']);
			$db->query($sql);
		}
	}

}

?>