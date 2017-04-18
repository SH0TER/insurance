<?
    if($_GET['site'] && strpos($_GET['site'], 'http://192.168.162.227') !== false)
    {
        echo '<script>window.location = "' . $_GET['site'] . '";</script>';
    }
?>