<?php
include_once('tests_functions.php');
$results = get_question_answers($_GET['question_id']);
$question_name = get_question_name($_GET['question_id']);


echo "";
?>

<style>
    .admin {
        background-color: #fff;
        margin-right: 20px;
        padding: 20px;
    }    
    td {
        padding: 5px;
        font-family: arial, serif;
        font-size: 14px;
    }
        
</style>

<div class='admin'>
<p><h2><b><?php echo $question_name['test_question_text'];?> (<a href='<?php echo $_SERVER['PHP_SELF'];?>?page=tests&test_id=<?php echo $_GET['test_id'];?>'>К списку вопросов теста</a>)</h2></b>
</p>
<p>
<table>
<tr><td><b>Ответы</b></td><td><b>Оценка</b></td></tr>
<?php foreach($results as $results_item):?>
    <tr><td><?php echo $results_item['test_question_answer_text'];?></td> <td style='text-align: center;'><?php echo $results_item['test_question_answer_value'];?></td> </tr>
<?php endforeach;?>
</table>
</p>
</div>