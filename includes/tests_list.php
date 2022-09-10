<?php 

include_once('tests_functions.php');



if($_GET['test_action'] == 'delete'){
    
    $post_title = get_test_name_by_id($_GET['test_id']);
    $post = get_page_by_title($post_title['test_name']);
    
    $selete_result_test = delete_test($_GET['test_id']);
    $delete_result_test_questions = delete_test_question($_GET['test_id']);
    $delete_result_test_question_answers = delete_test_question_answers($_GET['test_id']);
    $delete_result_test_results = delete_test_results($_GET['test_id']);
    
    if( ! empty($post)){
        wp_delete_post($post->ID, true);
    }  
}

$results = get_tests_names();

?>
<style>
    .admin {
        background-color: #fff;
        margin-right: 20px;
        padding: 20px;
    }    
        
</style>
<div class='admin'>
<h2>Название теста: (<a href='<?php echo $_SERVER['PHP_SELF'];?>?page=tests&test_action=add'>Добавить новый тест</a>)</h2>
<?php $count = 1;?>
<?php foreach($results as $item):?>
<b><a href='<?php echo $_SERVER['PHP_SELF'];?>?page=tests&test_id=<?php echo $item['test_name_id'];?>'><?php echo $item['test_name'];?></a>
<?php if($item['test_complete'] == 1):?>
Шорткод: [<?php echo $item['test_shortcode'];?>] 
<?php endif;?>
(<a href='<?php echo $_SERVER['PHP_SELF'];?>?page=tests&test_action=delete&test_id=<?php echo $item['test_name_id']?>'>Удалить</a>)
<?php if(count($results) > 1 && $count != count($results)):?>
, 
<?php endif;?>
</b>
<?php $count += 1;?>
<?php endforeach;?>
</div>