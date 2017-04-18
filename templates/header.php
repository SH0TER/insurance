<?
if ($_SERVER["REMOTE_ADDR"]=='62.149.7.189') $data['ec']=1;
if ($data['ec']!=1) {?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <title>ТДВ "Експрес Cтрахування"</title>
    <meta http-equiv="content-type" content="text/html; charset=<?=CHARSET?>" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="no-cache" />
    <link type="image/x-icon" href="/favicon.ico" rel="shortcut icon" />
    <link type="text/css" href="/css/style.css" rel="stylesheet" media="screen" />
    <link type="text/css" href="/css/additional.css" rel="stylesheet" media="screen" />
    <script type="text/javascript" src="/js/script.js"></script>
    <script type="text/javascript" src="/js/jquery/jquery.js"></script>
    <script type="text/javascript" src="/js/jquery/jtip.js"></script>
    <script type="text/javascript" src="/js/jquery/autocomplete.js"></script>
    <link rel="stylesheet" href="/js/jquery/jtip.css" type="text/css" media="screen" />
    <!-- required plugins -->
    <script type="text/javascript" src="/js/jquery/date.js"></script>
    <script type="text/javascript" src="/js/jquery/date_ua_utf8.js" charset="utf-8"></script>
    <!--[if IE]><script type="text/javascript" src="/js/jquery/jquery.bgiframe.min.js"></script><![endif]-->
    <!-- jquery.datePicker.js -->
    <script type="text/javascript" src="/js/jquery/jquery.datePicker.js"></script>
    <!-- datePicker required styles -->
    <link rel="stylesheet" type="text/css" media="screen" href="/js/jquery/datePicker.css" />
    <script language="javascript" type="text/javascript">
    <!--
    function initDatePicker() {
        //datePicker Init
        $(function() {
            $('.fldDatePicker,.fldDatePickerOver').each(
                function(i, element) {
                    if (!$('body').data(element.id))
                    $("#"+element.id+"").datePicker({startDate:'01/01/1901'}).bind(
                            'dateSelected',
                            function(e, selectedDate, $td) {
                                if (selectedDate.asString().length==10 && document.getElementById(this.id+'_day') && document.getElementById(this.id+'_month') && document.getElementById(this.id+'_year')) {
                                    Day = selectedDate.asString().substring(0,2); 
                                    Month = selectedDate.asString().substring(3,5); 
                                    Year = selectedDate.asString().substring(6,10); 
                                } else {
                                    Day = Month = Year = "";
                                }
                                if (document.getElementById(this.id+'_day') && document.getElementById(this.id+'_month') && document.getElementById(this.id+'_year')) {
                                    document.getElementById(this.id+'_day').value=Day;
                                    document.getElementById(this.id+'_month').value=Month;
                                    document.getElementById(this.id+'_year').value=Year;
                                }
                            }
                        ).bind(
                            'change',
                            function() {
                                var d=explode ('.', this.value);
                                if (d.length==3) {
                                    var res='';
                                    if (d[0].length<2) {
                                        if (d[0].length==0) res='01'+'.';
                                        else res='0'+d[0]+'.';
                                    } else res=d[0]+'.';
                                    if (d[1].length<2) {
                                        if (d[1].length==0) res+='01'+'.';
                                        else res+='0'+d[1]+'.';
                                    } else res+=d[1]+'.';
                                    if (d[2].length<4) {
                                        if (d[2].length==0 || d[2].length==3 || d[2].length==1) res+='2000';
                                        else if(d[2].length==2) res+='19'+d[2];
                                    } else res+=d[2];
                                    this.value=res;

                                    Day=this.value.substring(0,2); 
                                    Month=this.value.substring(3,5); 
                                    Year=this.value.substring(6,10); 
                                } else {
                                    Day = Month = Year = '';
                                }

                                if (document.getElementById(this.id+'_day') && document.getElementById(this.id+'_month') && document.getElementById(this.id+'_year')) {
                                    document.getElementById(this.id+'_day').value=Day;
                                    document.getElementById(this.id+'_month').value=Month;
                                    document.getElementById(this.id+'_year').value=Year;
                                }
                            }
                        );
                        $('body').data(element.id, 1);
                }
            );
            $('.fldDatePickerDisabled').datePicker({startDate:'01/01/1901'});
            $('.fldDatePickerDisabled').dpSetDisabled(true);
        });
    }

    initDatePicker();
    //-->
    </script>
    <script type="text/javascript" src="/js/jquery/jquery.clockpick.js"></script>
    <link rel="stylesheet" href="/js/jquery/jquery.clockpick.css" type="text/css">
    <script language="javascript" type="text/javascript">
    $(function() {
        $('.fldTimePicker').clockpick({
            }, function (val) { 
                setTimeVals(this.name,val);
            }
        ); 
        $('.fldTimePicker').bind(
            'change',
            function()
            {
                setTimeVals(this.name,this.value);
            }
        );
        $('.imgTimePicker').bind(
            'click',
            function()
            {
                $('#'+this.id).clockpick({
                    valuefield: this.id,
                    starthour:  0,
                    endhour:    23
                    }, function (val) { 
                    setTimeVals(this.id,val);
                }
                ); 
            }
        ).bind('mouseover',
            function()
            {
                $('#'+this.id).clockpick({
                    valuefield: this.id,
                    starthour:  0,
                    endhour:    23
                    }, function (val) { 
                    setTimeVals(this.id,val);
                }
                ); 
            }
        );
    });
    
    function setTimeVals(elementname,val)
    {
        var t=explode (':', val);
        var name=explode ('TimePicker', elementname);
        if (t.length==2) {
                document.getElementById(name[0]+'_hour').value=t[0];
                document.getElementById(name[0]+'_minute').value=t[1];
        }
        else {
            document.getElementById(elementname).value='00:00';
            document.getElementById(name[0]+'_hour').value='00';
            document.getElementById(name[0]+'_minute').value='00';

        }       
    }
    </script>

</head>
<body>
<table width="<?=($_SESSION['auth']['width_pixel']) ? $_SESSION['auth']['width_pixel'] : '768'?>" cellspacing="0" cellpadding="0">
<tr>
    <td>
        <table width="100%" cellspacing="0" cellpadding="0">
        <tr>
            <td class="logo2"><a href="/"><img src="/images/administration/logoSmall.gif" width="325" height="30" alt="<?=$_SERVER['HTTP_HOST']?>" /></a></td>
            <td id="header">
                <table cellpadding="0" cellspacing="0">
                <tr>
                    <td class="name"><?=$_SESSION['auth']['roles_title'] . ': ' . $_SESSION['auth']['lastname'] . ' ' . $_SESSION['auth']['firstname']?></td>
                    <td align="right" valign="top"><img src="/images/administration/leftcorner.gif" width="11" height="20" alt="" /></td>
                    <td class="menu"><a href="?menu=main" <?=($_SESSION['auth']['menu'] == '' || $_SESSION['auth']['menu'] == 'main') ? 'class="active"' : ''?>>Головна</td>
                    <td class="menu"><a href="?do=preferences&amp;menu=preferences&amp;subMenu=preferences" <?=($_SESSION['auth']['menu'] == 'preferences') ? 'class="active"' : ''?>>Преференсії</a></td>
                    <? if ($Authorization->data['roles_id'] == ROLES_ADMINISTRATOR || $Authorization->data['roles_id'] == ROLES_MANAGER) { ?><td class="menu"><a href="?do=settings&amp;menu=settings&amp;subMenu=settings" <?=($_SESSION['auth']['menu'] == 'settings') ? 'class="active"' : ''?>>Установки</a></td><? } ?>
                    <!--<td class="menu"><a href="?do=Tickers|add&amp;menu=tickers&amp;subMenu=tickers" <?=($_SESSION['auth']['menu'] == 'tickers') ? 'class="active"' : ''?>>Повідомлення</a></td>-->
                    <td class="menu"><a href="?do=logout">Вийти</a></td>
                </tr>
                </table>
            </td>
        </tr>
        </table>
        <div id="line"><img src="/images/pixel.gif" width="1" height="1" alt="" /></div>
        <div id="menu"><?=getMenu()?><img src="/images/pixel.gif" width="1" height="19" alt="" /></div><?}?>
        <?if ($data['skippath']!=1 && !$_POST['InWindow']) {?><table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td id="location"><?=getPath($_REQUEST)?></td>
        </tr>
        </table><?}?>