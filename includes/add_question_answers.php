<?php
include_once('tests_functions.php');
$question_name = get_question_name($_GET['question_id']);

if(isset($_POST['answers_submit_button'])){
    $answer_count = get_question_answers_count($_GET['question_id']);
    
    for($i = 0; $i < $answer_count['test_question_answer_count']; $i++){
        if($_POST["question_answer_$i"] == ''){
            $answer_err = ' <b style="text-decoration: underline;">введите текст ответов</b>'; 
        }
        if( ! is_numeric($_POST["question_answer_rating_$i"]) ||  $_POST["question_answer_rating_$i"] < 0){
            $value_err = ' <b style="text-decoration: underline;">введите положительное число оценки</b>';
        } 
    }
    
    if( ! isset($answer_err) && ! isset($value_err)){
        $max_answer_rating = $_POST['question_answer_rating_0'];
        $min_answer_rating = $_POST['question_answer_rating_0'];
        for($i = 0; $i < $answer_count['test_question_answer_count']; $i++){
            $answer_result = add_question_answers( $_GET['question_id'], $_POST["question_answer_$i"], $_POST["question_answer_rating_$i"], $_GET['test_id']);
            if($max_answer_rating < $_POST["question_answer_rating_$i"]){
                $max_answer_rating = $_POST["question_answer_rating_$i"];
            }
            if($min_answer_rating > $_POST["question_answer_rating_$i"]){
                $min_answer_rating = $_POST["question_answer_rating_$i"];
            }
            
        }
        $result = set_question_to_complete($_GET['question_id']);
        $result = set_min_max_question_value($min_answer_rating, $max_answer_rating, $_GET['question_id']);
        echo "<script>document.location.href = '" . $_SERVER['PHP_SELF'] . "?page=tests&test_id=" . $_GET['test_id'] . "'</script>";
    }
}

echo "
<style>
    .admin {
        background-color: #fff;
        margin-right: 20px;
        padding: 20px;
    }    
        
</style>
";
echo "<div class='admin'><p><h2><b>Ответы вопроса \"" . $question_name['test_question_text'] . "\": (<a href='" . $_SERVER['PHP_SELF'] . "?page=tests&test_id=" . $_GET['test_id'] . "'>К списку вопросов теста</a>)</b></h2></p>";
$results = get_question_answers($_GET['question_id']);
if(empty($results)){
    $answer_count = get_question_answers_count($_GET['question_id']);
    if(is_numeric($answer_count['test_question_answer_count'])){
        echo "<p><b>Добавьте варианты ответов с их оценкой:</b></p>";
        echo "<form action='' method='POST'>";
        if(isset($answer_err)){
            echo "<p>Ошибка:" . $answer_err . "</p>";
        }
        if(isset($value_err)){
            echo "<p>Ошибка:" . $value_err . "</p>";
        }
        for($i = 0; $i < $answer_count['test_question_answer_count']; $i++){
            echo "<p>Ответ: <input type='text' style='width: 400px;' name='question_answer_" . $i . "' value='" . $_POST["question_answer_$i"] . "' />";
            echo " Балы: <input type='text' style='width: 50px;' name='question_answer_rating_" . $i . "' value='" . $_POST["question_answer_rating_$i"] . "' /></p>";
        }
        echo "<input type='submit' name='answers_submit_button' value='Сохранить'>";
        echo "</form></div>";
    }
}

?>