<?php

function get_tests_names(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_name';
    $query = "SELECT * FROM $table_name ORDER BY `test_name_id`";
    $res_array = $wpdb->get_results($query, ARRAY_A);
    return $res_array;
}

function new_test($test_name){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_name';
    $str = "INSERT INTO $table_name (test_name) VALUES ('%s')";
    $query = $wpdb->prepare($str, $test_name);
    $result = $wpdb->query($query);
    return $result;
}

function get_test_name_by_id($id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_name';
    $query = "SELECT `test_name` FROM $table_name WHERE `test_name_id` = '%d'";
    $query = $wpdb->prepare($query, $id);
    $res_array = $wpdb->get_row($query, ARRAY_A);
    return $res_array;
    
}

function get_test_shortcode($id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_name';
    $query = "SELECT `test_shortcode` FROM $table_name WHERE `test_name_id` = '%d'";
    $query = $wpdb->prepare($query, $id);
    $res_array = $wpdb->get_row($query, ARRAY_A);
    return $res_array;
    
}

function complete_test($test_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_name';
    $query = "UPDATE $table_name SET `test_complete` = 1, `test_shortcode` = 'test id=\"%d\"' WHERE `test_name_id` = '%d'";
    $query = $wpdb->prepare($query, $test_id, $test_id);
    $result = $wpdb->query($query);
    return $result;
}

function get_complete_test($test_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_name';
    $query = "SELECT `test_complete` FROM $table_name WHERE `test_name_id` = '%d'";
    $query = $wpdb->prepare($query, $test_id);
    $res_array = $wpdb->get_row($query, ARRAY_A);
    return $res_array;
}

function get_test_max_value($test_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_questions';
    $query = "SELECT SUM(`test_question_max_value`) AS `max` FROM $table_name WHERE `test_name_id` = '%d'";
    $query = $wpdb->prepare($query, $test_id);
    $res_array = $wpdb->get_row($query, ARRAY_A);
    return $res_array;
}

function get_test_min_value($test_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_questions';
    $query = "SELECT SUM(`test_question_min_value`) AS `min` FROM $table_name WHERE `test_name_id` = '%d'";
    $query = $wpdb->prepare($query, $test_id);
    $res_array = $wpdb->get_row($query, ARRAY_A);
    return $res_array;
}

function get_test_questions($test_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_questions';
    $query = "SELECT * FROM $table_name WHERE `test_name_id` = '%d' ORDER BY `test_question_id`";
    $query = $wpdb->prepare($query, $test_id);
    $res_array = $wpdb->get_results($query, ARRAY_A);
    return $res_array;
}

function get_questions_names($test_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_questions';
    $query = "SELECT * FROM $table_name WHERE `test_name_id` = '%d' AND `test_question_complete` = '0' ORDER BY `test_question_id`";
    $query = $wpdb->prepare($query, $test_id);
    $res_array = $wpdb->get_results($query, ARRAY_A);
    return $res_array;
}

function get_complete_question($test_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_questions';
    $query = "SELECT * FROM $table_name WHERE `test_name_id` = '%d' AND `test_question_complete` = '1' ORDER BY `test_question_id`";
    $query = $wpdb->prepare($query, $test_id);
    $res_array = $wpdb->get_results($query, ARRAY_A);
    return $res_array;
}

function add_test_question($test_id, $test_question, $question_answer_count){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_questions';
    $query = "INSERT INTO $table_name (test_name_id, test_question_text, test_question_answer_count) VALUES ('%d', '%s', '%d')";
    $query = $wpdb->prepare($query, $test_id, $test_question, $question_answer_count);
    $result = $wpdb->query($query);
    return $result;
}

function get_question_name($question_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_questions';
    $query = "SELECT `test_question_text` FROM $table_name WHERE `test_question_id` = '%d'";
    $query = $wpdb->prepare($query, $question_id);
    $res_array = $wpdb->get_row($query, ARRAY_A);
    return $res_array;
}

function get_question_answers_count($question_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_questions';
    $query = "SELECT `test_question_answer_count` FROM $table_name WHERE `test_question_id` = '%d'";
    $query = $wpdb->prepare($query, $question_id);
    $res_array = $wpdb->get_row($query, ARRAY_A);
    return $res_array;
}

function set_question_to_complete($question_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_questions';
    $query = "UPDATE $table_name SET `test_question_complete` = 1 WHERE `test_question_id` = '%d'";
    $query = $wpdb->prepare($query, $question_id);
    $result = $wpdb->query($query);
    return $result;
}

function set_min_max_question_value($min_value, $max_value, $question_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_questions';
    $query = "UPDATE $table_name SET `test_question_min_value` = '%d', `test_question_max_value` = '%d' WHERE `test_question_id` = '%d'";
    $query = $wpdb->prepare($query, $min_value, $max_value, $question_id);
    $result = $wpdb->query($query);
    return $result; 
}

function delete_empty_question($test_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_questions';
    $query = "DELETE FROM $table_name WHERE `test_name_id` = '%d' AND `test_question_complete` = 0";
    $query = $wpdb->prepare($query, $test_id);
    $result = $wpdb->query($query);
    return $result; 
}

function get_question_answers($question_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_question_answers';
    $query = "SELECT * FROM $table_name WHERE `test_question_id` = '%d' ORDER BY `test_answer_id`";
    $query = $wpdb->prepare($query, $question_id);
    $res_array = $wpdb->get_results($query, ARRAY_A);
    return $res_array;
}

function add_question_answers($question_id, $question_answer_text, $question_aswer_rating, $test_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_question_answers';
    $query = "INSERT INTO $table_name (`test_question_id`, `test_question_answer_text`, `test_question_answer_value`, `test_name_id`) VALUES ('%d', '%s', '%d', '%d')";
    $query = $wpdb->prepare($query, $question_id, $question_answer_text, $question_aswer_rating, $test_id);
    $result = $wpdb->query($query);
    return $result;
}

function add_test_result($result_min_value, $result_max_value, $result_text, $test_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'tests_results';
    $query = "INSERT INTO $table_name (test_name_id, test_result_min_value, test_result_max_value, test_result_text) VALUES ('%d', '%d', '%d', '%s')";
    $query = $wpdb->prepare($query, $test_id, $result_min_value, $result_max_value, $result_text);
    $result = $wpdb->query($query);
    return $result;
}

function get_add_test_results_min_value($test_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'tests_results';
    $query = "SELECT MAX(`test_result_max_value`) as `min` FROM $table_name WHERE `test_name_id` = '%d'";
    $query = $wpdb->prepare($query, $test_id);
    $res_array = $wpdb->get_row($query, ARRAY_A);
    return $res_array;
}

function get_test_results($test_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'tests_results';
    $query = "SELECT * FROM $table_name WHERE `test_name_id` = '%d'";
    $query = $wpdb->prepare($query, $test_id);
    $res_array = $wpdb->get_results($query, ARRAY_A);
    return $res_array;
}

function set_user_answer_data($address, $user_test_value, $user_test_question_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_tests_actions';
    $query = "INSERT INTO $table_name (user_tests_actions_address, user_tests_actions_value, user_tests_actions_question_id) VALUES ('%s', '%d', '%d')";
    $query = $wpdb->prepare($query, $address, $user_test_value, $user_test_question_id);
    $result = $wpdb->query($query);
    return $result;
}

function get_user_test_progress($address){
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_tests_actions';
    $query = "SELECT * FROM $table_name WHERE `user_tests_actions_address` = '%s'";
    $query = $wpdb->prepare($query, $address);
    $res_array = $wpdb->get_results($query, ARRAY_A);
    return $res_array;
}

function get_user_question_answer($address, $question_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_tests_actions';
    $query = "SELECT * FROM $table_name WHERE `user_tests_actions_address` = '%s' AND `user_tests_actions_question_id` = '%d'";
    $query = $wpdb->prepare($query, $address, $question_id);
    $res_array = $wpdb->get_results($query, ARRAY_A);
    return $res_array;
}

function clear_user_actions($address){
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_tests_actions';
    $query = "DELETE FROM $table_name WHERE `user_tests_actions_address` = '%s'";
    $query = $wpdb->prepare($query, $address);
    $result = $wpdb->query($query);
    return $result;
}

function get_user_test_result($address){
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_tests_actions';
    $query = "SELECT SUM(`user_tests_actions_value`) as `user_test_result_value` FROM $table_name WHERE `user_tests_actions_address` = '%s'";
    $query = $wpdb->prepare($query, $address);
    $res_array = $wpdb->get_row($query, ARRAY_A);
    return $res_array;
}

function get_user_test_result_text($test_id, $user_test_value){
    global $wpdb;
    $table_name = $wpdb->prefix . 'tests_results';
    $query = "SELECT `test_result_text` FROM $table_name WHERE `test_name_id` = '%d' AND `test_result_min_value` <= '%d' AND `test_result_max_value` >= '%d'";
    $query = $wpdb->prepare($query, $test_id, $user_test_value, $user_test_value);
    $res_array = $wpdb->get_row($query, ARRAY_A);
    return $res_array;
}

function add_user_statistic_test_result($user_name, $user_email, $ip, $test_name, $test_result, $test_result_value, $date){
    global $wpdb;
    $table_name = $wpdb->prefix . 'users_tests';
    $query = "INSERT INTO $table_name (users_tests_test_name, users_name, users_email, users_ip, users_tests_test_date, users_tests_test_result, users_tests_test_result_value) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%d')";
    $query = $wpdb->prepare($query, $test_name, $user_name, $user_email, $ip, $date, $test_result, $test_result_value);
    $result = $wpdb->query($query);
    return $result;
}

function get_users_tests_stat(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'users_tests';
    $query = "SELECT * FROM $table_name ORDER BY `users_tests_id` DESC";
    $res_array = $wpdb->get_results($query, ARRAY_A);
    return $res_array;
}

function get_user_stat_data($stat_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'users_tests';
    $query = "SELECT `users_email`, `users_tests_test_name`, `users_tests_test_result` FROM $table_name WHERE `users_tests_id` = '%d'";
    $query = $wpdb->prepare($query, $stat_id);
    $res_array = $wpdb->get_row($query, ARRAY_A);
    return $res_array;
}

function set_user_send_mail_status($stat_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'users_tests';
    $query = "UPDATE $table_name SET `users_tests_test_result_send` = 1 WHERE `users_tests_id` = '%d'";
    $query = $wpdb->prepare($query, $stat_id);
    $result = $wpdb->query($query);
    return $result;
}

function get_user_send_mail_status($stat_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'users_tests';
    $query = "SELECT `users_tests_test_result_send` FROM $table_name WHERE `users_tests_id` = '%d'";
    $query = $wpdb->prepare($query, $stat_id);
    $res_array = $wpdb->get_row($query, ARRAY_A);
    return $res_array;
}

function delete_test($test_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_name';
    $query = "DELETE FROM $table_name WHERE `test_name_id` = '%d'";
    $query = $wpdb->prepare($query, $test_id);
    $result = $wpdb->query($query);
    return $result; 
}

function delete_test_question($test_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_questions';
    $query = "DELETE FROM $table_name WHERE `test_name_id` = '%d'";
    $query = $wpdb->prepare($query, $test_id);
    $result = $wpdb->query($query);
    return $result; 
}

function delete_test_question_answers($test_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_question_answers';
    $query = "DELETE FROM $table_name WHERE `test_name_id` = '%d'";
    $query = $wpdb->prepare($query, $test_id);
    $result = $wpdb->query($query);
    return $result; 
}

function delete_test_results($test_id){
    global $wpdb;
    $table_name = $wpdb->prefix . 'tests_results';
    $query = "DELETE FROM $table_name WHERE `test_name_id` = '%d'";
    $query = $wpdb->prepare($query, $test_id);
    $result = $wpdb->query($query);
    return $result; 
}

























?>