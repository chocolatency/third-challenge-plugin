<?php
/*
Plugin Name: Тесты
Description: Плагин тестов.
Author: Тесты
*/

function tests_install(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_name';
    
    if( $wpdb->get_var("SHOW TABLES LIKE $table_name") != $table_name){
        $sql = "CREATE TABLE IF NOT EXISTS `$table_name` (
            `test_name_id` int(4) NOT NULL AUTO_INCREMENT,
            `test_name` varchar(500) NOT NULL,
            `test_complete` int(4) NOT NULL,
            `test_shortcode` varchar(40) NOT NULL,
            PRIMARY KEY (`test_name_id`)
        ) ENGINE MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
        $wpdb->query($sql);
    }
    
    $table_name = $wpdb->prefix . 'test_questions';
    if( $wpdb->get_var("SHOW TABLES LIKE $table_name") != $table_name){
        $sql = "CREATE TABLE IF NOT EXISTS `$table_name` (
            `test_question_id` int(4) NOT NULL AUTO_INCREMENT,
            `test_name_id` int(4) NOT NULL,
            `test_question_text` varchar(500) NOT NULL,
            `test_question_min_value` int(4) NOT NULL,
            `test_question_max_value` int(4) NOT NULL,
            `test_question_answer_count` int(4) NOT NULL,
            `test_question_complete` int(4) NOT NULL,
            PRIMARY KEY (`test_question_id`)
        ) ENGINE MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
        $wpdb->query($sql);
    } 
    
    $table_name = $wpdb->prefix . 'test_question_answers';
    if( $wpdb->get_var("SHOW TABLES LIKE $table_name") != $table_name){
        $sql = "CREATE TABLE IF NOT EXISTS `$table_name` (
            `test_answer_id` int(4) NOT NULL AUTO_INCREMENT,
            `test_question_id` int(4) NOT NULL,
            `test_question_answer_text` varchar(500) NOT NULL,
            `test_question_answer_value` int(4) NOT NULL,
            `test_name_id` int(4) NOT NULL,
            PRIMARY KEY (`test_answer_id`)
        ) ENGINE MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
        $wpdb->query($sql);
    }
    
    $table_name = $wpdb->prefix . 'tests_results';
    if( $wpdb->get_var("SHOW TABLES LIKE $table_name") != $table_name){
        $sql = "CREATE TABLE IF NOT EXISTS `$table_name` (
            `test_result_id` int(4) NOT NULL AUTO_INCREMENT,
            `test_name_id` int(4) NOT NULL,
            `test_result_min_value` int(4) NOT NULL,
            `test_result_max_value` int(4) NOT NULL,
            `test_result_text` text(5000) NOT NULL,
            PRIMARY KEY (`test_result_id`)
        ) ENGINE MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
        $wpdb->query($sql);
    }
    
    $table_name = $wpdb->prefix . 'user_tests_actions';
    if( $wpdb->get_var("SHOW TABLES LIKE $table_name") != $table_name){
        $sql = "CREATE TABLE IF NOT EXISTS `$table_name` (
            `user_tests_actions_id` int(4) NOT NULL AUTO_INCREMENT,
            `user_tests_actions_address` varchar(50) NOT NULL,
            `user_tests_actions_value` int(4) NOT NULL,
            `user_tests_actions_question_id` int(4) NOT NULL,
            PRIMARY KEY (`user_tests_actions_id`)
        ) ENGINE MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
        $wpdb->query($sql);
    }
    
    $table_name = $wpdb->prefix . 'users_tests';
    if( $wpdb->get_var("SHOW TABLES LIKE $table_name") != $table_name){
        $sql = "CREATE TABLE IF NOT EXISTS `$table_name` (
            `users_tests_id` int(4) NOT NULL AUTO_INCREMENT,
            `users_tests_test_name` varchar(50) NOT NULL,
            `users_name` varchar(50) NOT NULL,
            `users_email` varchar(50) NOT NULL,
            `users_ip` varchar(50) NOT NULL,
            `users_tests_test_date` varchar(50) NOT NULL,
            `users_tests_test_result` text(5000) NOT NULL,
            `users_tests_test_result_value` int(4) NOT NULL,
            `users_tests_test_result_send` int(4) NOT NULL,
            PRIMARY KEY (`users_tests_id`)
        ) ENGINE MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
        $wpdb->query($sql);
    }
            
}

function tests_uninstall(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'test_name';
    $sql = "DROP TABLE $table_name"; 
    $wpdb->query($sql);
    
    $table_name = $wpdb->prefix . 'test_questions';
    $sql = "DROP TABLE $table_name"; 
    $wpdb->query($sql); 
    
    $table_name = $wpdb->prefix . 'test_question_answers';
    $sql = "DROP TABLE $table_name"; 
    $wpdb->query($sql); 
    
    $table_name = $wpdb->prefix . 'tests_results';
    $sql = "DROP TABLE $table_name"; 
    $wpdb->query($sql);
    
    $table_name = $wpdb->prefix . 'user_tests_actions';
    $sql = "DROP TABLE $table_name"; 
    $wpdb->query($sql); 
    
    $table_name = $wpdb->prefix . 'users_tests';
    $sql = "DROP TABLE $table_name"; 
    $wpdb->query($sql); 
}



register_activation_hook(__FILE__, 'tests_install');

//register_deactivation_hook(__FILE__, 'tests_uninstall');

register_uninstall_hook(__FILE__, tests_uninstall);


function tests_add_admin_menu_item(){
    add_menu_page( 'Page menu', 'Тесты', '1', 'tests', 'tests_list');
    add_submenu_page('tests', 'Page menu', 'Тесты пользователей', '1', 'user_tests', 'user_tests');
}

add_action('admin_menu', 'tests_add_admin_menu_item');

function tests_list(){

    if($_GET['test_action'] == 'add'){
        include_once('includes/add_test.php');
    }elseif($_GET['test_id'] && ! isset($_GET['test_action'])){
        include_once('includes/test_questions.php');
    }elseif($_GET['test_action'] == 'add_question'){
        include_once('includes/add_test_question.php');
    }elseif($_GET['test_action'] == 'add_question_answers'){
        include_once('includes/add_question_answers.php');
    }elseif($_GET['test_action'] == 'question_answers'){
        include_once('includes/question_answers.php');
    }elseif($_GET['test_action'] == 'add_test_results'){
        include_once('includes/add_test_results.php');
    }elseif($_GET['test_action'] == 'test_results_list'){
        include_once('includes/test_results_list.php');
    }else{
        include_once('includes/tests_list.php');
    }

}

function user_tests(){
    include_once('includes/users_tests_stat.php');
}

function test($test_id){
    ob_start();
    include_once("includes/user_test.php");
    return ob_get_clean();
}

add_shortcode('test', 'test');
?>
