<?php
/*
 * Title: authorization class
 *
 * @author Eugen Cherkassky
 * @email eugene.cherkassky@gmail.com
 * @version 3.0
 */

require_once 'Users.class.php';

class Authorization {

    var $roles_id	= 0;
    var $login		= '';
    var $password	= '';
    var $data		= '';

    function Authorization(&$data) {
        global $MENU;

        ini_set('session.gc_maxlifetime', '7200');
        session_cache_limiter('private_no_expire, must-revalidate');

        session_start();

        if ($_POST['do'] == 'login') {
            $this->login = $_POST['login'];
            $this->password = $_POST['password'];
        }
        else if ($_GET['do'] == 'login') {
            $this->login = $_GET['login'];
            $this->password = $_GET['password'];
        } else {
            $this->data = $_SESSION['auth'];

            $MENU =
                array(
                    'main' => array(
                        array(
                            'class' => 'Users',
                            'method' => 'showDesktop',
                            'button' => 'Desktop',
                            'width' => 72,
                            'description' => 'Поліси',
                            'permissions' => ROLES_ADMINISTRATOR + ROLES_MANAGER + ROLES_AGENT + ROLES_MASTER  + ROLES_CLIENT_CONTACT),
                        array(
                            'class' => 'Reinsurance',
                            'button' => 'Reinsurance',
                            'width' => 110,
                            'description' => 'Перестрахування',
                            'permissions'	=> ROLES_ADMINISTRATOR),
                        array(
                            'class' => 'Clients',
                            'button' => 'Clients',
                            'width' => 72,
                            'description' => 'Клієнти',
                            'permissions'	=> ROLES_ADMINISTRATOR + (($_SESSION['auth']['top_agencies_id'] == SELLER_AGENCIES_ID) ? ROLES_AGENT : 0)),
                        array(
                            'class' => 'Certificates',
                            'button' => 'Certificates',
                            'width' => 90,
                            'description' => 'Сертифікати',
                            'permissions'	=> ROLES_ADMINISTRATOR),
                        array(
                            'class' => 'PolicyPaymentsCalendar',
                            'button' => 'Payments',
                            'width' => 72,
                            'description' => 'Календар оплат',
                            'permissions'	=> ROLES_ADMINISTRATOR),
                        array(
                            'class' => 'Accidents',
                            'button' => 'Accidents',
                            'width' => 72,
                            'description' => 'Страхові події',
                            'permissions'	=> ROLES_ADMINISTRATOR + ($this->data['agencies_id'] == SELLER_AGENCIES_ID ? ROLES_AGENT : 0)),
                        array(
                            'class' => 'Akts',
                            'button' => 'Commissions',
                            'width' => 72,
                            'description' => 'Commissions',
                            'permissions'	=> ROLES_ADMINISTRATOR+ROLES_MASTER),
                        array(
                            'class' => 'PolicyBlanks',
                            'button' => 'Blanks',
                            'width' => 72,
                            'description' => 'Бланки',
                            'permissions'	=> ROLES_ADMINISTRATOR + ROLES_AGENT),
                        array(
                            'class' => 'Cards',
                            'button' => 'Cards',
                            'width' => 72,
                            'description' => 'Картки',
                            'permissions'	=> ROLES_ADMINISTRATOR),
                        array(
                            'class' => 'ProductTypes',
                            'button' => 'Products',
                            'width' => 72,
                            'description' => 'Продукти',
                            'permissions'	=> ROLES_ADMINISTRATOR),
                        array(
                            'class' => 'Agencies',
                            'button' => 'Agencies',
                            'width' => 72,
                            'description' => 'Агенції',
                            'permissions'	=> ROLES_ADMINISTRATOR),
                        array(
                            'class' => 'Reports',
                            'button' => 'Reports',
                            'width' => 72,
                            'description' => 'Звіти',
                            'permissions'	=> ROLES_ADMINISTRATOR + ROLES_AGENT),
                        array(
                            'class' => 'DocumentSections',
                            'button' => 'Documents',
                            'width' => 72,
                            'description' => 'Документи',
                            'permissions'	=> ROLES_ADMINISTRATOR + ROLES_AGENT + ROLES_MASTER),
                        array(
                            'class' => 'News',
                            'button' => 'News',
                            'width' => 72,
                            'description' => 'News',
                            'permissions'	=> ROLES_ADMINISTRATOR + ROLES_AGENT + ROLES_MASTER),
                        array(
                            'class' => 'Tasks',
                            'button' => 'Tasks',
                            'width' => 72,
                            'description' => 'Tasks',
                            'permissions'	=> ROLES_ADMINISTRATOR + (($_SESSION['auth']['top_agencies_id'] == SELLER_AGENCIES_ID) ? ROLES_AGENT : 0)),
                        array(
                            'class'         =>  'Accidents',
                            'method'        =>  'showCarServicesCompensation',
                            'button'        =>  'CarServicesCompensation',
                            'width'         =>  110,
                            'description'   =>  'CarServicesCompensation',
                            'permissions'   =>  ROLES_ADMINISTRATOR + ROLES_MASTER),
                        array(
                            'class'         =>  'Axapta',
                            'button'        =>  'Axapta',
                            'width'         =>  70,
                            'description'   =>  'Axapta',
                            'permissions'   =>  ROLES_AGENT & $_SESSION['auth']['top_agencies_id'] == SELLER_AGENCIES_ID),
                        array(
                            'class'         =>  'AccidentRegressionCulprits',
                            'button'        =>  'AccidentRegressionCulprits',
                            'width'         =>  72,
                            'description'   =>  'Регреси',
                            'permissions'   =>  ROLES_ADMINISTRATOR),
                        array(
                            'class'         =>  'Profiles',
                            'button'        =>  'Profiles',
                            'width'         =>  72,
                            'description'   =>  'Анкети',
                            'permissions'   =>  ROLES_ADMINISTRATOR),
                        array(
                            'class'         =>  'SpareParts',
                            'button'        =>  'SpareParts',
                            'width'         =>  95,
                            'description'   =>  'Запчастини',
                            'permissions'   =>  ROLES_ADMINISTRATOR + ROLES_MASTER)
                    )
                );

            if ($_SESSION['auth']['top_agencies_id'] == 245) {//втб лайф
                $MENU =
                    array(
                        'main' => array(
                            array(
                                'class' => 'Users',
                                'method' => 'showDesktop',
                                'button' => 'Desktop',
                                'width' => 72,
                                'description' => 'Поліси',
                                'permissions' => ROLES_ADMINISTRATOR + ROLES_MANAGER + ROLES_AGENT + ROLES_MASTER  + ROLES_CLIENT_CONTACT),
                        )
                    );
            }

            if ($_SESSION['auth']['agencies_id'] == AGENCY_SATIS) {
                $MENU =
                    array(
                        'main' => array(
                            array(
                                'class' => 'Users',
                                'method' => 'showDesktop',
                                'button' => 'Desktop',
                                'width' => 72,
                                'description' => 'Поліси',
                                'permissions' => ROLES_ADMINISTRATOR + ROLES_MANAGER + ROLES_AGENT + ROLES_MASTER  + ROLES_CLIENT_CONTACT)
                        )
                    );
            }

            foreach ($MENU['main'] as $i => $row) {
                $MENU['main'][ $i ][ 'permissions' ] = $MENU['main'][ $i ][ 'permissions' ] + ($this->data['permissions'][ $row[ 'class' ] ]['show'] ? ROLES_MANAGER : 0);
            }
        }

        if ($_GET['menu']) {
            $_SESSION['auth']['menu'] = $_GET['menu'];
        }

        if ($_GET['subMenu']) {
            $_SESSION['auth']['subMenu'] = $_GET['subMenu'];
        }

        if ($_POST['save'] != 1 && $_POST['do'] == 'login') {
            setcookie('saveLogin', '',  time()-3600);
            setcookie('savePassword', '', time()-3600);
        }

        $this->roles_id = $_SESSION['auth']['roles_id'];

        $this->data = $_SESSION['auth'];
    }

    function getMenu() {
        return $_SESSION['auth']['menu'];
    }

    function assignValues($login, $password) {
        $this->login		= $login;
        $this->password		= $password;
    }

    function isLoggedUser() {
        return (intval($_SESSION['auth']['roles_id']) & intval($this->roles_id));
    }

    function isValidUser() {
        return ($_SESSION['auth']['roles_id'] == $this->roles_id);
    }

    function check() {
        global $Log;

        if (!$this->isLoggedUser()) {
            $this->login(($_GET['redirect'])? $_GET['redirect'] : '');
        }

        if ($_SESSION['auth']['expired'] && $_GET['do']!='Users|loadPassword' && $_GET['do']!='logout' && !ereg('updatePassword',$_POST['do'])) {
            $Log->add('error', 'Срок действия пароля истек необходимо изменить пароль', array(), null, true);
            header('Location: index.php?do=Users|loadPassword');
            exit;
        }
    }

    function track() {
        global $Log;

        $params = array(
            'storage'	=> PREFIX . '_accounts',
            'id'		=> $this->data['id']);

        switch ($_REQUEST['action']) {
            case 'login':
                $description = 'Login';
                break;
            case 'logout':
                $description = 'Logout';
                break;
        }

        $Log->add('confirm', $description, $params, null, true);
    }

    function setUserValues($row) {
        global $db;
        $row['accounts_id']=$row['id'];
        foreach($row as $name => $value) {
            $_SESSION['auth'][ $name ] = $value;
        }

        switch ($this->roles_id) {
            case ROLES_AGENT:

                if ($_SESSION['auth']['agencies_id'] == 223) {//ФОП "Лігус Олександр Федорович" - Луганск
                    $_SESSION['auth']['subAgenciesId'] = array(223 ,26,128,137, 183, 184, 185, 129, 130 ,131, 132, 133, 134, 135, 136);
                    $_SESSION['auth']['specialAgent'] = true;
                } elseif ($_SESSION['auth']['agencies_id'] == 224) {//ФОП "Лігус Олександр Федорович" - Луганск
                    $_SESSION['auth']['subAgenciesId'] = array(224 , 22,149, 150 ,151, 207, 208 ,209 ,210, 217);
                    $_SESSION['auth']['specialAgent'] = true;
                }

                if ($_SESSION['auth']['id']==3279 || $_SESSION['auth']['id']==4464) {//Дедяєва; Рагімова	Юлія
                    $_SESSION['auth']['subAgenciesId'] = array(9,158 , 167,168, 169 ,170, 171, 222 ,159 ,160, 161,162,163,164,165,166);
                }


                if ($_SESSION['auth']['id']==6970) {//Шулика
                    //$_SESSION['auth']['subAgenciesId'] = array(50,240,232);
                }

                if ($_SESSION['auth']['id']==4873) {//Юрьев
                    $_SESSION['auth']['subAgenciesId'] = array(50,240,232,233,237,235);
                }

                if ($_SESSION['auth']['id']==6968) {//Губа
                    $_SESSION['auth']['subAgenciesId'] = array(50,420,240,414,413,412);
                }

                if (intval($_SESSION['auth']['agent_financial_institutions_id'])>0) //агенция она же банк
                {//загрузить субагенции
                    $subAgencies = $db->getCol('SELECT id FROM insurance_agencies WHERE top = '.intval($_SESSION['auth']['agencies_id']));
                    if (is_array($subAgencies) && sizeof($subAgencies))
                        $_SESSION['auth']['subAgenciesId'] = $subAgencies;
                }

                break;
            case ROLES_MANAGER://устанавливаем полномочия для менеджера (сотрудника Экспресс Страхование)

                $sql =	'SELECT DISTINCT object, method ' .
                    'FROM ' . PREFIX . '_account_permissions AS a ' .
                    'JOIN ' . PREFIX . '_account_group_permissions AS b ON a.id = b.account_permissions_id ' .
                    'JOIN ' . PREFIX . '_account_groups_managers_assignments c ON c.account_groups_id = b.account_groups_id '.
                    'WHERE c.accounts_id   = ' . intval($row['accounts_id']);
                $res = $db->query($sql);

                while ($res->fetchInto($permission)) {
                    $_SESSION['auth']['permissions'][ $permission['object'] ][ $permission['method'] ] = true;
                }

                $sql = 'SELECT account_groups_id ' .
                    'FROM ' . PREFIX .'_account_groups_managers_assignments ' .
                    'WHERE accounts_id =' . intval($row['accounts_id']);
                $_SESSION['auth']['account_groups_id'] = $db->getCol($sql);

                $sql = 'SELECT car_services_id ' .
                    'FROM ' . PREFIX .'_car_services_service_department_assignments ' .
                    'WHERE accounts_id =' . intval($row['accounts_id']);
                $_SESSION['auth']['service_department_car_services_id'] = $db->getCol($sql);

                $sql =	'SELECT managers_id ' .
                    'FROM ' . PREFIX . '_manager_manager_assignments ' .
                    'WHERE accounts_id = ' . $row['id'];
                $_SESSION['auth']['managers'] = $db->getCol($sql);

                array_push($_SESSION['auth']['managers'], $_SESSION['auth']['id']);

                $sql =	'SELECT id ' .
                    'FROM ' . PREFIX . '_accounts ' .
                    'WHERE active=1 AND roles_id = ' . ROLES_MANAGER;
                $_SESSION['auth']['messages_managers'] = $db->getCol($sql);

                break;
            case ROLES_ADMINISTRATOR:
                $sql =	'SELECT id ' .
                    'FROM ' . PREFIX . '_accounts ' .
                    'WHERE active=1 AND roles_id = ' . ROLES_MANAGER;
                $_SESSION['auth']['managers'] = $db->getCol($sql);
                $_SESSION['auth']['messages_managers'] = $_SESSION['auth']['managers'];
                break;
            case ROLES_CLIENT_CONTACT:
                $sql =	'SELECT accounts_id ' .
                    'FROM ' . PREFIX . '_client_contacts ' .
                    'WHERE clients_id = ' . intval($row['clients_id']);
                $_SESSION['auth']['client_contacts'] = $db->getCol($sql);
                break;
            case ROLES_MASTER:
                $sql =	'SELECT car_service ' .
                    'FROM ' . PREFIX . '_master_car_services_assignments ' .
                    'WHERE accounts_id = ' . $row['id'];
                $_SESSION['auth']['car_services'] = $db->getCol($sql);

                array_push($_SESSION['auth']['car_services'], $_SESSION['auth']['car_services_id']);
                break;
        }

        if ($_POST['do'] == 'login' && $_POST['save'] == 1) {
            setcookie('saveLogin',		$_POST['login'], time() + 86400*7);
            setcookie('savePassword',	$_POST['password'], time() + 86400*7);
        }

        $this->data = $_SESSION['auth'];

        $this->track();
    }

    function drawLogin() {
        global $Log;

        switch ($this->roles_id) {
            default:
                include_once 'login.php';
                exit;
                break;
        }
    }

    function getRole() {
        global $db;

        $conditions[] = 'login LIKE BINARY ' . $db->quote($this->login);
        $conditions[] = 'password LIKE BINARY ' . $db->quote($this->password);

        $sql =	'SELECT roles_id ' .
            'FROM ' . PREFIX . '_accounts ' .
            'WHERE ' . implode(' AND ', $conditions);
        
        //Защита от Автоцентра на Голосеевском
        $res = $db->getOne($sql);

        if($_SERVER["REMOTE_ADDR"] == "195.68.202.122" && $res != 4)
            unset($res);

        return  $res;
    }


    function login($redirect = '') {
        global $db, $Log;

        if ($_POST['do'] == 'login' || $_GET['do'] == 'login') {
            $this->roles_id = $this->getRole();

            if ($this->roles_id) {

                $conditions[] = 'a.active = 1';
                $conditions[] = 'a.roles_id = ' . intval($this->roles_id);
                $conditions[] = 'a.login LIKE BINARY ' . $db->quote($this->login);
                $conditions[] = 'a.password LIKE BINARY ' . $db->quote($this->password);

                switch ($this->roles_id) {
                    case ROLES_AGENT:
                        $conditions[] = 'e.active = 1';
                        $sql =	'SELECT a.*, b.*, c.width_pixel, d.title as roles_title, e.top as top_agencies_id,e.title as organizations_title,  IF( NOW( ) > a.expired, 1, 0) AS expired,e.alternative,e1.financial_institutions_id as agent_financial_institutions_id,e.ukravto as ukravto,e.individual_motivation ' .
                            'FROM ' . PREFIX . '_accounts AS a ' .
                            'JOIN ' . PREFIX . '_agents AS b ON a.id=b.accounts_id ' .
                            'JOIN ' . PREFIX . '_screen_resolutions AS c ON a.screen_resolutions_id=c.id ' .
                            'JOIN ' . PREFIX . '_roles AS d ON a.roles_id=d.id ' .
                            'JOIN ' . PREFIX . '_agencies AS e ON b.agencies_id=e.id ' .
                            'LEFT JOIN ' . PREFIX . '_agencies AS e1 ON e.top=e1.id ' .
                            'WHERE ' . implode(' AND ', $conditions);
                        break;
                    case ROLES_MASTER:
                        $conditions[] = 'e.active = 1';
                        $sql =	'SELECT a.*, b.*, c.width_pixel, d.title as roles_title, e.title as organizations_title, IF( NOW( ) > a.expired, 1, 0) AS expired ' .
                            'FROM ' . PREFIX . '_accounts AS a ' .
                            'JOIN ' . PREFIX . '_masters AS b ON a.id=b.accounts_id ' .
                            'JOIN ' . PREFIX . '_screen_resolutions AS c ON a.screen_resolutions_id=c.id ' .
                            'JOIN ' . PREFIX . '_roles AS d ON a.roles_id=d.id ' .
                            'JOIN ' . PREFIX . '_car_services AS e ON b.car_services_id=e.id ' .
                            'WHERE ' . implode(' AND ', $conditions);
                        break;
                    case ROLES_MANAGER:
//header('Location: index.php?do=logout');
//exit;
                        $conditions[] = 'a.id NOT IN(3849, 3914, 4447, 3753, 3850, 3870, 4644, 3372, 3871, 4407, 4717)';

                        $sql =	'SELECT a.*, b.width_pixel, c.title AS roles_title, 1 AS agencies_id, ' . $db->quote('ТДВ "Експрес страхування"') . ' AS organizations_title, IF( NOW( ) > a.expired, 1, 0) AS expired ' .
                            'FROM ' . PREFIX . '_accounts AS a ' .
                            'JOIN ' . PREFIX . '_screen_resolutions AS b ON a.screen_resolutions_id = b.id ' .
                            'JOIN ' . PREFIX . '_roles AS c ON a.roles_id = c.id ' .
                            'WHERE ' . implode(' AND ', $conditions);
                        break;
                    case ROLES_ADMINISTRATOR:
                        $sql =	'SELECT a.*, b.width_pixel, c.title AS roles_title, 1 AS agencies_id, ' . $db->quote('ТДВ "Експрес страхування"') . ' AS organizations_title, IF( NOW( ) > a.expired, 1, 0) AS expired ' .
                            'FROM ' . PREFIX . '_accounts AS a ' .
                            'JOIN ' . PREFIX . '_screen_resolutions AS b ON a.screen_resolutions_id = b.id ' .
                            'JOIN ' . PREFIX . '_roles AS c ON a.roles_id = c.id ' .
                            'WHERE ' . implode(' AND ', $conditions);
                        break;
                    case ROLES_CLIENT_CONTACT:
                        $sql =	'SELECT a.*, b.*, c.width_pixel, d.title AS roles_title, e.company AS organizations_title, IF( NOW( ) > a.expired, 1, 0) AS expired ' .
                            'FROM ' . PREFIX . '_accounts AS a ' .
                            'JOIN ' . PREFIX . '_client_contacts AS b ON a.id=b.accounts_id ' .
                            'JOIN ' . PREFIX . '_screen_resolutions AS c ON a.screen_resolutions_id=c.id ' .
                            'JOIN ' . PREFIX . '_roles AS d ON a.roles_id=d.id ' .
                            'JOIN ' . PREFIX . '_clients AS e ON b.clients_id=e.id ' .
                            'WHERE ' . implode(' AND ', $conditions);
                        break;
                }

                $row = $db->getRow($sql);
                if ($this->roles_id==ROLES_AGENT && is_array($row) && $row['ukravto']==1 )//мониторим чтобы только через ЭК заходили
                {
                    if ($_SERVER['REMOTE_ADDR']!='62.149.7.189') exit;
                }
            }

            if (is_array($row)) {
                $this->setUserValues($row);

                switch ($this->roles_id) {
                    default:
                        if($redirect) {
                            echo '<script>window.location = "' . $_SERVER['SERVER_HOST'] . '?do=' . $redirect . '";</script>';
                        } else {
                            header('Location: ' . $_SERVER['HTTP_REFERER']);
                        }
                        exit;
                        break;
                }
                return true;
            } else {
                //track login failed
                $params = array(
                    'storage'	=> PREFIX . '_accounts',
                    'title'		=> 	'Login failed',
                    'id'		=> $this->data['id']);
                $Log->add('confirm', $description, $params, 'Login failed', true);
            }
        }

        return $this->drawLogin();
    }

    function logout($redirect = true) {
        global $data, $db;

        $this->track();

        $this->login = '';
        $this->password = '';

        $_SESSION['auth'] = '';
        session_unregister('auth');

        $_SESSION['Accidents'] = '';
        session_unregister('Accidents');

        $_SESSION['Policies'] = '';
        session_unregister('Policies');

        unset($_SESSION['master_download_agreements']);

        if ($redirect) {
            switch ($this->roles_id) {
                default:
                    if (intval($data['accounts_id'])) {
                        $sql = 'SELECT login, password FROM ' . PREFIX . '_accounts WHERE id = ' . intval($data['accounts_id']);
                        $acc = $db->getRow($sql);
                        header('Location: ' . $_SERVER['PHP_SELF'] . '?admin=1&login=' . $acc['login'] . '&password=' . $acc['password']);
                        break;
                    } else {
                        header('Location: ' . $_SERVER['PHP_SELF']);
                        break;
                    }
            }
            exit;
        }
    }

    function getLogin($params) {
        return $this->login();
    }

    function getAccountsId() {
        switch ($this->data['roles_id']) {
            default:
                $result = $this->data['id'];
                break;
        }
        return $result;
    }
}

?>