<?php
include_once('tests_functions.php');

$test_name = get_test_name_by_id($_GET['test_id']);
$question_list = get_test_questions($_GET['test_id']);

$questions_names_list = get_questions_names($_GET['test_id']);

$question_complete_list = get_complete_question($_GET['test_id']);
$results = get_test_results($_GET['test_id']);
$test_complete = get_complete_test($_GET['test_id']);


?>
<style>
    .admin {
        background-color: #fff;
        margin-right: 20px;
        padding: 20px;
    }    
        
</style>
<div class='admin'>
<p>
<h2>
<b style="font-size: 20px; font-weight: bold;"><?php echo $test_name['test_name'];?></b> 
(<a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=tests">К списку тестов</a>)
<?php if(empty($results)):?>
(<a href='<?php echo $_SERVER['PHP_SELF'];?>?page=tests&test_action=add_question&test_id=<?php echo $_GET['test_id'];?>'>Добавить вопрос теста</a>)
<?php endif;?>
(<a href='<?php echo $_SERVER['PHP_SELF'];?>?page=tests&test_action=test_results_list&test_id=<?php echo $_GET['test_id'];?>'>Список результатов теста</a>)
<?php if($test_complete['test_complete'] != 1 && ! empty($question_complete_list)): ?>
(<a href='<?php echo $_SERVER['PHP_SELF'];?>?page=tests&test_action=add_test_results&test_id=<?php echo $_GET['test_id'];?>'>Добавить результаты теста</a>)
<?php endif;?>
</h2>
</p>

<?php
if(empty($question_list)){
    $message = "<b>Список вопросов пуст.</b>";
    echo $message;
}else{
    echo "<p><b>Вопросы:</b></p>";
    foreach($question_list as $item){
        if($item['test_question_complete'] == 1){
            echo "<a href='" . $_SERVER['PHP_SELF'] . "?page=tests&test_action=question_answers&test_id=" . $_GET['test_id'] . "&question_id=" . $item['test_question_id'] . "'>" . $item['test_question_text'] . "</a>";    
            echo "<br />";            
        }

    }
    if( ! empty($questions_names_list)){
        echo "<p><b>Вопросы без ответов:</b></p>";
    }
    
    foreach($question_list as $item){
        if($item['test_question_complete'] == 0){
            echo "<a href='" . $_SERVER['PHP_SELF'] . "?page=tests&test_action=add_question_answers&test_id=" . $_GET['test_id'] . "&question_id=" . $item['test_question_id'] . "'>" . $item['test_question_text'] . "</a>";    
            echo "<br />";
        }
    }
}
?>
</div>