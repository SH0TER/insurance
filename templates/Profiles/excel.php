<head>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <meta name=ProgId content=Excel.Sheet>
<style>
* {
    font-size: 11px;
    font-family: Tahoma, Verdana, Arial, Geneva, Helvetica, sans-serif;
}
.columns TD {
    height: 25px;
    color: #FFFFFF;
    padding-left: 4px;
    font-weight: bold;
    border-right: 1px solid #4F5D75;
    border-top: 1px solid #4F5D75;
    border-bottom: 1px solid #4F5D75;
    background-color: #008575;
}
.grey {
    background-color: #CCCCCC;
}
</style>
</head>
<body>
<table width="100%" cellpadding="0" cellspacing="0" border=1>
<tr class="columns">
    <td>Номер</td>
    <td>Дата та час реєстрації</td>
    <td>Менеджер</td>

    <?
        foreach ($questions as $question) {
            echo '<td>' . $question['question'] . '</td>';
        }
    ?>
    <td>Коментар</td>
</tr>

<?
    foreach ($list as $row) {
        $i = 1 - $i;
        $answers = json_decode($row['answers'], true);
?>
<tr class="<?=$this->getRowClass($row, $i)?>">
    <td><?=$row['number']?></td>
    <td><?=$row['created_format']?></td>
    <td><?=$row['managers_id']?></td>

    <?
        foreach ($questions as $question) {
            $question_answers = explode(';', $question['answers']);
            echo '<td>' . (in_array($answers[$question['id']]['question_answer'], $question_answers) || !strlen($question['answers']) && $answers[$question['id']]['question_answer']
                            ? $answers[$question['id']]['question_answer']
                            : '&nbsp;') .
                          (strlen($answers[$question['id']]['question_comment']) ? ': ' . $answers[$question['id']]['question_comment'] : '') .
                '</td>';
        }
    ?>
    <td><?=$row['comment']?></td>
</tr>
<? } ?>
</table>
</body>
</html>