<?php
include_once('tests_functions.php');
$test_name = get_test_name_by_id($_GET['test_id']);
$results = get_test_results($_GET['test_id']);
$test_complete = get_complete_test($_GET['test_id']);
$question_complete_list = get_complete_question($_GET['test_id']);


$test_max_value = get_test_max_value($_GET['test_id']);
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
    table {
        max-width: 1000px;
    }
        
</style>
<div class='admin'>
<p><h2><b>Список результатов теста <?php echo $test_name['test_name'];?> (<a href='<?php echo $_SERVER['PHP_SELF'];?>?page=tests&test_id=<?php echo $_GET['test_id'];?>'>К списку вопросов теста</a>)</b></h2></p>
<?php if($test_complete['test_complete'] != 1 && ! empty($question_complete_list)): ?>
<p>Диапазон значений для новых результатов теста: <?php echo $min_value;?> - <?php echo $test_max_value['max'];?>
    (<a href='<?php echo $_SERVER['PHP_SELF'];?>?page=tests&test_action=add_test_results&test_id=<?php echo $_GET['test_id'];?>'>Добавить результаты теста</a>)
</p>
<?php endif;?>

<?php if($test_complete['test_complete'] == 1):?>
    <p>Тест сформирован: (<a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=tests">к списку тестов</a>)</p>
<?php endif;?>


<table>
<tr><th>№</th><th>Диапазон</th><th>Текст</th></tr>
<?php $count = 1;?>
<?php foreach($results as $item_result):?>
<tr>
    <td>
        <?php echo $count; $count += 1;?>
    </td>
    <td>
        <?php echo $item_result['test_result_min_value'];?> - <?php echo $item_result['test_result_max_value'];?>
    </td>
    <td>
        <?php echo $item_result['test_result_text'];?>
    </td>
</tr>
<?php endforeach;?>
</table>
</div>