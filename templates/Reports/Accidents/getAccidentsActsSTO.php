<script type="text/javascript">
    car_services_ukravto = new Array();
    car_services_not_ukravto = new Array();

    function getCarServicesUkrAVTO(){
        $.ajax({
            type:       'POST',
            url:        '/index.php',
            dataType:   'script',
            data:       'do=CarServices|getUkrAVTOCarServicesInWindow',
            success:    function (result){
                            setCarServices();
                        }
        });
    }

    function getCarServicesNotUkrAVTO(){
        $.ajax({
            type:       'POST',
            url:        '/index.php',
            dataType:   'script',
            data:       'do=CarServices|getNotUkrAVTOCarServicesInWindow',
            success:    function (result){
                            setCarServices();
                        }
        });
    }

    function setCarServices(){
        type = 1;//$('#ukravto option:selected').val();
        var car_services = document.getElementById('car_services');
        car_services.options.length = 0;
        if(type==0){
            for (var i=0; i < car_services_not_ukravto.length; i++) {
				car_services.options[i] = new Option(car_services_not_ukravto[i][1], car_services_not_ukravto[i][0]);
			}
        }
        if(type==1){
            for (var i=0; i < car_services_ukravto.length; i++) {
				car_services.options[i] = new Option(car_services_ukravto[i][1], car_services_ukravto[i][0]);
			}
        }
    }

    $(document).ready(function() {
        getCarServicesUkrAVTO();
        getCarServicesNotUkrAVTO();
    })
</script>
<div class="block">
    <table width="100%" cellspacing="0" cellpadding="0">
    <tr>
        <td class="bullet">
            <?
                $bullet = ($_COOKIE[$this->object.'Block'] == 'none') ? 'bulletRight.gif' : 'bulletDown.gif';
                echo '<a href="javascript: showHideModule(\'' . $this->object . 'Block\')"><img src="/images/administration/' . $bullet . '" name="' . $this->object . 'BlockBullet" alt="" /></a>';
            ?>
        </td>
        <td class="caption">Страхові акти (СТО):</td>
    </tr>
    <tr>
        <td></td>
        <td align="right">
            <?='<div id="' . $this->object . 'Block" ' . (($_COOKIE[$this->object.'Block'] == 'none') ? 'style="display: none;"' : '') . '>';?>
            <form name="<?=$this->objectTitle?>" action="<?=$_SERVER['PHP_SELF']?>" method="post">
                <input type="hidden" name="do" value="<?=$_REQUEST['do']?>" />
                <input type="hidden" name="InWindow" value="true" />
                <table cellpadding="0" cellspacing="5">
                <tr>
                    <td><b>СТО:</b></td>
                    <td>
                        <select id="car_services" name="car_services_id[]" multiple="multiple" size="5" class="fldSelect" onfocus="this.className='fldSelectOver'" onblur="this.className='fldSelect'"></select>
                    </td>
                    <td><b>Дата:</b></td>
                    <td>&nbsp;з</td><td><input type="text" id="from<?=$this->objectTitle?>" name="from" value="<?=$data['from']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                    <td nowrap>&nbsp;до</td><td><input type="text" id="to<?=$this->objectTitle?>" name="to" value="<?=$data['to']?>" class="fldDatePicker" onfocus="this.className='fldDatePickerOver';" onblur="this.className='fldDatePicker';" /></td>
                    <td><input type="submit" value=" Виконати " class="button" onMouseOver="this.className = 'buttonOver';" onMouseOut="this.className = 'button';" /></td>
                </tr>
                </table>
            </form>
            </div>
        </td>
    </tr>
    </table>
</div>