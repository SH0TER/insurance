<div class="block">
    </tr>
    </table>
</div>
<script type="text/javascript">
	function setChecked(id, name, value) {
        $.ajax({
            type:		'POST',
            url:		'index.php',
            dataType:	'json',
            data:		'do=Accidents|setCheckedInWindow' +
                        '&product_types_id=' + $('input[name=product_types_id]').val() +
                        '&id=' + id +
                        '&name=' + name +
                        '&value=' + value,
            success: 	function(result) {
                            alert( result.text );
                            if ( result.type == 'error') {
                                $('input[type=checkbox][name=' + name + '\[' + id + '\]]').attr('checked', !$('input[type=checkbox][name=' + name + '\[' + id + '\]]').attr('checked'));
                            }
                        }
        });
    }
	
    $('input[type=checkbox][name^=master_documents]').bind('click', function() {
        value = $(this).attr('name').match(/\[[0-9]*\]/ig);
        id = value[ 0 ].substr( 1, value[ 0 ].length - 2);
        value = ($(this).attr('checked')) ? 1 : 0;
        setChecked(id, 'master_documents', value);
    })

  
</script>