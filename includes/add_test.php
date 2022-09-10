<?php
include_once('tests_functions.php');
if(isset($_POST['add_test_button']) && $_POST['test_name'] != ''){
    $result = new_test($_POST['test_name']);       
    echo "<script>document.location.href = '" . $_SERVER['PHP_SELF'] . "?page=tests'</script>";

}else{
    if(isset($_POST['add_test_button']) && $_POST['test_name'] == ''){
        $message = "<b>Пожалуйста, заполните все поля</b>";
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
<p><h2>Добавление теста <?php if(isset($message)){ echo "<b>(" . $message . ")</b>";} ?> (<a href="<?php echo $_SERVER['PHP_SELF'] ?>?page=tests">К списку тестов</a>)</h2></p>
<form action='' method='POST'>
<p><b>Название теста:</b></p>
<input type='text' name='test_name' style="width: 400px;" />
<p>
    <input type='submit' name='add_test_button' value='Добавить' />
</p>
</form> 
</div>