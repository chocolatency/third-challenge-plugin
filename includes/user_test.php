<?php
include_once('tests_functions.php');

$test_name = get_test_name_by_id($test_id['id']);
$test_questions = get_test_questions($test_id['id']);
$test_question_number_count = count($test_questions);

//echo $test_questions;

if(isset($_POST['start_user_test'])){
    
    if($_POST['user_name'] == '' || $_POST['user_email'] == '' || strpos($_POST['user_email'], '@') === false){
        $form_message = "Пожалуйста, заполните все поля";
        include_once('templates/user_form.php');
    }else{
        
        $user_test_data = get_user_test_progress($_SERVER['REMOTE_ADDR']);
        $test_question_number = count($user_test_data);
        $test_question_aswers = get_question_answers($test_questions[$test_question_number]['test_question_id']);
        
        if(isset($_POST['submit_test_button'])){    
            

            if($_POST['test_question_answer_value'] == ''){
                $error_message = "выберите ответ";
            }
            if(isset($_POST['test_question_answer_value'])){
                
                $user_progress = get_user_question_answer($_SERVER['REMOTE_ADDR'], $_POST['test_question_id']);
                if(empty($user_progress)){
                    $result = set_user_answer_data($_SERVER['REMOTE_ADDR'], $_POST['test_question_answer_value'], $_POST['test_question_id']);
                }
                                        
                $user_test_data = get_user_test_progress($_SERVER['REMOTE_ADDR']);
                $test_question_number = count($user_test_data);
                $test_question_aswers = get_question_answers($test_questions[$test_question_number]['test_question_id']);
            }
                       
            if($_POST['test_question_number'] == $test_question_number_count - 1){

                $user_test_result = get_user_test_result($_SERVER['REMOTE_ADDR']);
                $user_result_text = get_user_test_result_text($test_id['id'], $user_test_result['user_test_result_value']);
                $user_test_stat_result = add_user_statistic_test_result($_POST['user_name'], 
                                                                        $_POST['user_email'], 
                                                                        $_SERVER['REMOTE_ADDR'], 
                                                                        $test_name['test_name'],
                                                                        $user_result_text['test_result_text'],
                                                                        $user_test_result['user_test_result_value'],
                                                                        date('Y-m-d'));

                include_once('templates/user_test_results.php');
            }
            
        }
        if($test_question_number_count == 1 && ! isset($_POST['test_question_number'])){
            include_once('templates/test.php');
        }elseif($_POST['test_question_number'] != $test_question_number_count - 1){
            include_once('templates/test.php');
        }
        
    }
         
}else{
    $clear_result = clear_user_actions($_SERVER['REMOTE_ADDR']);
    include_once('templates/user_form.php');    
}


?>


















