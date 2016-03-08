<?php


// データベースに新規登録・変更する
//もし文字化けしたらmysqlで文字コードをutf8にセットが必要
if (isset($_POST['planed_date']) || isset($_POST['finishing_date']) || isset($_POST['finished_date']) || isset($_POST['id']) ) {

		//var_dump($_POST);

		$title = mysql_real_escape_string($_POST['title']);
		$task = mysql_real_escape_string($_POST['task']);
		$planed_date = mysql_real_escape_string($_POST['planed_date']);
		
		if (isset($_POST['finishing_date'])) {
			$finishing_date = mysql_real_escape_string($_POST['finishing_date']);
		}else{
			$finished_date = mysql_real_escape_string($_POST['finished_date']);
		}
		
		$priority = mysql_real_escape_string($_POST['priorities']);

// idを含むとき変更手続きへ
		if (isset($_POST['id'])) {

			$id = mysql_real_escape_string($_POST['id']);

			require('dbconnect.php');

			$sql_query = "UPDATE `todo` SET `title`='".$title."',`task`='".$task."',`planed_date`='".$planed_date."',`finished_date`='".$finished_date."',`modified`= NOW(),`priority`='".$priority."' WHERE id =".$id.";" ;
			
			mysql_query($sql_query) or die(mysql_error());
			mysql_close();

// POSTデータにidが含まれていないなら新規登録手続きへ
		}else {

			require('dbconnect.php');

			$sql_query = "INSERT INTO `todo` (`id`, `title`, `task`, `planed_date`, `finished_date`, `still`, `created`, `modified`, `priority`) VALUES (NULL, '".$title."', '".$task."', '".$planed_date."', '".$finishing_date."', '1', NOW(), NOW(),'".$priority."');" ;
			
			mysql_query($sql_query) or die(mysql_error());
			mysql_close();

		}

	$url = 'http://localhost/todolist/ToDoList.php';
	header("Location: {$url}");
	exit;


}






?>