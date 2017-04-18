<script type="text/javascript">
    
     function showCommentInLine() {
				$.ajax({
					type:		'POST',
					url:		'index.php',
					dataType:	'html',
					async:		false,
					data:		'do=Accidents|getListCommentsInWindow' +
                                '&accidents_id='+$('input[name="accidents_id"]').val(),

					success: function(result) {
						$("#comments").html(result);
					}
				});
        }

    function showComments() {
        $('#comments').toggle();
        showCommentInLine();
    }

    function addComment() {
         $.ajax({
					type:		'POST',
					url:		'index.php',
					dataType:	'html',
					async:		false,
					data:		'do=Accidents|insertAccidentsCommentInWindow' +
                                '&accidents_id='+$('input[name="accidents_id"]').val()+
                                '&monitoring_comment='+ $("#monitoring_comment").val(),

					success: function(result) {
						showCommentInLine();
                        $("#monitoring_comment").val("");
					}
				});
    }

    function deleteComment(id) {
        if (!window.confirm("Ви дійсно бажаєте видалити коментраій?")) {
            return;
        }

        $.ajax({
                type:       'POST',
                url:        'index.php',
                dataType:   'html',
                async:      false,
                data:       'do=Accidents|deleteAccidentsCommentInWindow' +
                            '&id=' + id,
                success:    function(result) {
                    showCommentInLine();
                }
        });
    }

    function setMonitoringUser() {
         $.ajax({
					type:		'POST',
					url:		'index.php',
					dataType:	'html',
					async:		false,
					data:		'do=Accidents|updateMonitoringInWindow' +
                                '&accidents_id='+$('input[name="accidents_id"]').val()+
                                '&monitoring_managers_id='+ $("select[name=monitoring_managers_id] option:selected").val(),

					success: function(result) {
                        addComment();
						showCommentInLine();
					}
				});
         $.ajax({
					type:		'POST',
					url:		'index.php',
					dataType:	'html',
					async:		false,
					data:		'do=Accidents|insertAccidentsCommentInWindow' +
                                '&accidents_id='+$('input[name="accidents_id"]').val()+
                                '&monitoring_managers_id='+$("select[name=monitoring_managers_id] option:selected").val(),

					success: function(result) {
						showCommentInLine();
                        $("#monitoring_comment").val("");
					}
				});
    }
</script>
<div class="block">
<table width="100%" cellspacing="0" cellpadding="0">
<tr>
	<td></td>
	<td id="info_messages" onclick="$(this).hide();" style="color: #000000; text-align: left; margin-top: 14px; margin-left: 27px; background-color: #FC9233; padding: 5px 5px 2px 27px; cursor: pointer; display:none;"></td>
</tr>
<tr>
	<td class="bullet" rowspan="2"><img src="/images/pixel.gif" width="27" height="28" alt="" /></td>
	<td class="caption bottom"><?$this->showAgenda($data)?></td>
</tr>
<tr>
	<td>
		<table class="wizard" cellpadding="2" cellspacing="3" width="100%">
		<tr>
			<td>