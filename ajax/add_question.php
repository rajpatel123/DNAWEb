<?php
include("../lib/database.php");
include("../lib/function.php");

//print_r($_POST);die;
$question = $_POST['question'];
$ans1 = $_POST['ans1'];
$ans2 = $_POST['ans2'];
$ans3 = $_POST['ans3'];
$ans4 = $_POST['ans4'];
$answer = $_POST['answer'];
$tid = $_POST['tid'];

	$addtest = mysql_query("INSERT INTO test_question SET test_id='$tid',question='$question',ans1='$ans1',ans2='$ans2',ans3='$ans3',ans4='$ans4',currect_ans='$answer',created_on=Now()");
	
	//echo "INSERT INTO test_question SET test_id='$tid',question='$question',ans1='$ans1',name='$name',ans2='$ans2',ans3='$ans3',ans1='$ans4',answer='$answer',created_on=Now()";
	
	if($addtest){
	
		echo "1";
		
	}else{
		
		echo "2";
		
	}
	



?>