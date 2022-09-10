<?php
include_once('tests_functions.php');

$test_name = get_test_name_by_id($_GET['test_id']);

if(isset($_POST['add_test_question_button'])){
    if( ! is_numeric($_POST['test_question_answers_count'])){
        $num_message = "Введите числовое значение";
    }elseif(is_numeric($_POST['test_question_answers_count']) && $_POST['test_question_answers_count'] <= 1){
        $num_message = "Введите положительное числовое значение больше \"1\"";
    }
    
    if($_POST['test_question_text'] == ''){
        $text_message = "Введите текст вопроса";
    }
    
    if(is_numeric($_POST['test_question_answers_count']) && $_POST['test_question_answers_count'] > 1 && ! empty($_POST['test_question_text'])){
        $result = add_test_question($_GET['test_id'], $_POST['test_question_text'], $_POST['test_question_answers_count']);
        echo "<script>document.location.href = '" . $_SERVER['PHP_SELF'] . "?page=tests&test_id=" . $_GET['test_id'] . "'</script>";
    }
}

?>
<style>
    .admin {
        background-color: #fff;
        margin-right: 20px;
        padding: 20px;
    }    
        
</style>
<div class='admin'>
<p><h2>Добавление вопроса к тесту "<b><?php echo $test_name['test_name'];?></b>" (<a href="<?php echo $_SERVER['PHP_SELF'] ?>?page=tests">К списку тестов</a>)</h2></p>
<form action='' method='POST'>
<p><b>Содержание вопроса:</b></p>
<input type='text' name='test_question_text' value='<?php echo $_POST['test_question_text'];?>' style="width: 400px;" /><?php if(isset($text_message)){ echo $text_message; }?>
<p><b>Количество вариантов ответа:</b></p>
<input type='text' name='test_question_answers_count' value='<?php echo $_POST['test_question_answers_count'];?>' style="width: 50px;" /> <?php if(isset($num_message)){ echo $num_message; }?>

<p>
    <input type='submit' name='add_test_question_button' value='Добавить' />
</p>
</form> 
</div>