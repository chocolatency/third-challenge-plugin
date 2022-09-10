<?php
include_once('tests_functions.php');


$user_send_mail = get_user_send_mail_status($_GET['stat_id']);

if($_GET['stat_action'] == 'send' && $user_send_mail['users_tests_test_result_send'] == 0){
    $user_data = get_user_stat_data($_GET['stat_id']);
    $subject = "Результаты теста \"" . $user_data['users_tests_test_name'] . "\"";
    mail($user_data['users_email'], $subject, $user_data['users_tests_test_result']);
    $user_send_mail = set_user_send_mail_status($_GET['stat_id']);
}

if($_GET['resend'] == 'true' && $user_send_mail['users_tests_test_result_send'] == 1){
    $user_data = get_user_stat_data($_GET['stat_id']);
    $subject = "Результаты теста \"" . $user_data['users_tests_test_name'] . "\"";
    mail($user_data['users_email'], $subject, $user_data['users_tests_test_result']);
}

$users_tests_stat = get_users_tests_stat();
?>
<style>
    .admin {
        background-color: #fff;
        margin-right: 20px;
        padding: 20px;
    }    
    td {
        padding: 10px;
        font-family: arial, serif;
        font-size: 14px;
        text-align: left;
    }
        
</style>
<div class='admin'>
<h2>Статистика:</h2>
<table>
<tr>
    <th>Название теста</th>
    <th>Имя пользователя</th>
    <th>Email пользователя</th>
    <th>IP пользователя</th>
    <th>Дата теста</th>
    <th>Результат</th>
    <th>Отправка результата по email</th>
</tr>
<?php foreach($users_tests_stat as $user_test_stat_item):?>
<tr>
    <td><?php echo $user_test_stat_item['users_tests_test_name'];?></td>
    <td><?php echo $user_test_stat_item['users_name'];?></td>
    <td><?php echo $user_test_stat_item['users_email'];?></td>
    <td><?php echo $user_test_stat_item['users_ip'];?></td>
    <td><?php echo $user_test_stat_item['users_tests_test_date'];?></td>
    <td><?php echo $user_test_stat_item['users_tests_test_result'];?></td>
    <td>
    <?php if($user_test_stat_item['users_tests_test_result_send'] == 1):?>
        <b>Отправлено (<a href='<?php echo $_SERVER['PHP_SELF'] ?>?page=user_tests&stat_action=send&stat_id=<?php echo $user_test_stat_item['users_tests_id']?>&resend=true'>Отправить заново</a>)</b>
    <?php else:?>
        <a href='<?php echo $_SERVER['PHP_SELF'] ?>?page=user_tests&stat_action=send&stat_id=<?php echo $user_test_stat_item['users_tests_id']?>'>Отправить результаты на email</a>
    <?php endif;?>
    </td>
</tr>
<?php endforeach;?>
</table>
<?php if(empty($users_tests_stat)):?>
    <h3>Статистика будет появлятся с прохождением тестов пользователей.</h3>
<?php endif;?>
</div>


















