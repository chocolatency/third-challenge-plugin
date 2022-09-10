<h2><?php echo $test_name['test_name'];?> (<?php echo $test_question_number + 1;?>/<?php echo $test_question_number_count;?>)</h2>
<form action='' method='POST'>
<p><?php echo $test_questions[$test_question_number]['test_question_text'];?> 
<?php if(isset($error_message)):?>
(<?php echo $error_message;?>)
<?php endif;?>
</p>
<?php foreach($test_question_aswers as $question_item):?>
<p><input type='radio' name='test_question_answer_value' value='<?php echo $question_item['test_question_answer_value'];?>' /><?php echo $question_item['test_question_answer_text'];?></p>
<?php endforeach;?>
<input type='hidden' name='test_question_number' value='<?php echo $test_question_number;?>' />
<input type='hidden' name='test_question_id' value='<?php echo $test_questions[$test_question_number]['test_question_id'];?>' />
<input type='hidden' name='user_name' value='<?php echo $_POST['user_name'];?>' />
<input type='hidden' name='user_email' value='<?php echo $_POST['user_email'];?>' />
<input type='hidden' name='start_user_test' value='<?php echo $_POST['start_user_test'];?>' />
<input type='submit' name='submit_test_button' value='Далее' />
</form>