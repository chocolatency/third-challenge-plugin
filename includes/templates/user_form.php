<h3>Для прохождения теста заполните форму:</h3>
<form action='' method='POST' >
<?php if(isset($form_message)):?>
<?php echo $form_message;?>
<?php endif;?>
<p>Имя:<br />
<input type='text' name='user_name' value='<?php echo $_POST['user_name'];?>'/>
</p>
<p>Email:<br />
<input type='text' name='user_email' value='<?php echo $_POST['user_email']?>'/>
</p>
<input type='submit' name='start_user_test' value='Пройти тест' />
</form>