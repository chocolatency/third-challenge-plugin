<?php
include_once('tests_functions.php');

$test_name = get_test_name_by_id($_GET['test_id']);
$test_max_value = get_test_max_value($_GET['test_id']);
$results = get_test_results($_GET['test_id']);


$test_min_value = get_add_test_results_min_value($_GET['test_id']);
if(is_numeric($test_min_value['min'])){
    $min_value = $test_min_value['min'];

}else{
    $test_min_value = get_test_min_value($_GET['test_id']);
    $min_value = $test_min_value['min'];

}

if( ! empty($results)){
    $min_value += 1;
}

if(isset($_POST['add_result_submit_button'])){
    if($_POST['test_result_text'] == ''){
        $text_message = 'введите тескт результата';
    }
    if($_POST['result_max_value'] > $test_max_value['max'] || $_POST['result_max_value'] == '' || $_POST['result_max_value'] < $min_value){
        $max_message = "введите корректный диапазон";
    }
    if(is_numeric($_POST['result_min_value']) && is_numeric($_POST['result_max_value']) && $_POST['result_max_value'] <= $test_max_value['max'] && $_POST['result_max_value'] >= $min_value && $_POST['test_result_text'] != ''){
        $result = add_test_result($_POST['result_min_value'], $_POST['result_max_value'], $_POST['test_result_text'], $_GET['test_id']);
        if($_POST['result_max_value'] == $test_max_value['max']){
            
            $result = complete_test($_GET['test_id']);
            $result = delete_empty_question($_GET['test_id']);
            
            $shortcode = get_test_shortcode($_GET['test_id']);
            
            $post_id = wp_insert_post( array( 'post_type' => 'page',
                                              'post_title' => $test_name['test_name'],
                                              'post_content' => '[' . $shortcode['test_shortcode'] . ']'
                
            ), $wp_error );

        }
        echo "<script>document.location.href = '" . $_SERVER['PHP_SELF'] . "?page=tests&test_action=test_results_list&test_id=" . $_GET['test_id'] . "'</script>";
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
<p><h2><b>Добавление результатов теста "<?php echo $test_name['test_name'];?>"</b> (<a href='<?php echo $_SERVER['PHP_SELF'];?>?page=tests&test_id=<?php echo $_GET['test_id'];?>'>К списку вопросов теста</a>) </h2></p>

<form action='' method='POST'>
<p><strong>Диапазон для оценок: <?php echo $min_value;?> - <?php echo $test_max_value['max'];?></strong></p>
<p>Диапазон для оценки теста:
</p>
<?php if(isset($max_message)):?>
<b>Ошибка: <?php echo $max_message;?></b><br />
<?php endif;?>
От <?php echo $min_value;?> до <input type='text' name='result_max_value' value='<?php echo $_POST['result_max_value'];?>' />

<p>Текст результата:<br />
    <?php if(isset($text_message)):?>
    <b>Ошибка: <?php echo $text_message;?></b><br />
    <?php endif;?>
    <textarea rows="10" cols="80" name="test_result_text" ><?php echo $_POST['test_result_text'];?></textarea>
</p>
    <input type='hidden' name='result_min_value' value='<?php echo $min_value; ?>' />
<p>
    <input type='submit' name='add_result_submit_button' value='Добавить' />
</p>
</form>
</div>
