<?php
//exit;
/*
 * Title: process event
 *
 * @author Eugene Cherkassky
 * @email eugene.cherkassky@gmail.com
 * @version 3.0
 */
//exit;

if (!isset($_SERVER['HTTP_REFERER'])) $_SERVER['HTTP_REFERER']=(isset($_POST['redirect']) && strlen($_POST['redirect'])>0) ? $_POST['redirect'] : '/';

ob_start();

$sqls = array();

$begin = microtime(true);

require_once 'include/collector.inc.php';

if (!ereg('InWindow', $_REQUEST['do'])) {
	require_once 'News.class.php';
	$Authorization->check();
}

if ($_COOKIE['ec']==1) {
	$data['ec'] = 1;
}

if ($_POST['do'] == 'extractPathData' && is_array($_SESSION['auth']['path'][ intval($_POST['position']) ])) {
	$data = $_SESSION['auth']['path'][ intval($_POST['position']) ]['data'];
}

list($object, $method) = split('[|]', $data['do']);

if ($object == 'AccidentDocumentsAA') $object = 'AccidentDocuments';

if (is_file('include/modules/' .$object . '.class.php')) {

	require_once $object . '.class.php';

	switch ($object) {
		case 'Accidents':
			$$object = ($data['product_types_id'] && !isset($data['show']) ? Accidents::factory($data, ProductTypes::get($data['product_types_id'])) : new Accidents($data));
			break;
		case 'AccidentActs':
			$$object = AccidentActs::factory($data, ProductTypes::get($data['product_types_id']));
			break;
		case 'Policies':
			$$object = ($data['product_types_id'] ? Policies::factory($data, ProductTypes::get($data['product_types_id'])) : new Policies($data));
			break;
		case 'Products':
			$$object = Products::factory($data);
			break;
		case 'Templates':
			require_once 'Templates.class.php';
			$$object = Templates::factory($data, 'Mail');
			break;
		case 'Users':

			require_once 'Users.class.php';
			switch ($Authorization->roles_id) {
				case ROLES_AGENT:
					$$object = Users::factory($data, 'Agents');
					break;
				case ROLES_MASTER:
					$$object = Users::factory($data, 'Masters');
					break;
				case ROLES_MANAGER:
					$$object = Users::factory($data, 'Managers');
					break;
				case ROLES_ASSISTANCE:
					$$object = Users::factory($data, 'Assistances');
					break;
				case ROLES_ADMINISTRATOR:
					$$object = Users::factory($data, 'Administrators');
					break;
				case ROLES_CLIENT_CONTACT:
					$$object = Users::factory($data, 'ClientContacts');
					break;
				case ROLES_GENERALI_MANAGER:
					$$object = Users::factory($data, 'GeneraliManagers');
					break;
				default:

					$Users = new Users($data);
					$Users->$method($data);
					break;
			}
			break;
		default:
			$$object = new $object($data);
	}
} else {
	switch ($object) {
        case 'Experts':
		case 'Agents':
		case 'Masters':
		case 'Managers':
		case 'Assistances':
		case 'Administrators':
		case 'ClientContacts':
		case 'GeneraliManagers':
			require_once 'Users.class.php';
			$$object = Users::factory($data, $object);
			break;
	}
}
	
savePathData($data, $object);

if (!ereg('InWindow', $method) && !$data['InWindow']) {
	include_once 'header.php';
	if ($method != 'finish') {
		$Log->showSystem();
	}
}

switch ($data['do']) {
	case 'preferences':
		include_once 'preferences.php';
		break;
	case 'settings':
		include_once 'settings.php';
		break;
	case 'logout':
		$Authorization->logout();
		break;
	case 'extractPathData':
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		break;
    case '':
        if($data['redirect']) {
            header('Location: ' . $data['redirect']);
            exit;
            break;
        }
		header('Location: ' . $_SERVER['PHP_SELF'] . '?do=Users|showDesktop&menu=main&subMenu=Desktop');
		exit;
		break;
	default:
		if (getObject($object)) {
			$$object->$method($data);
		} else {
			header('Location: ' . $_SERVER['PHP_SELF']);
			exit;
		}
}

if (!ereg('InWindow', $method) && !$data['InWindow']) {
	include_once 'footer.php';
}

ob_end_flush();

?>