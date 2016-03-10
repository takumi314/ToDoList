<?php

if (isset($_POST['delate']) && isset($_POST['delate_submit'])) {

		$delate = $_POST['delate'];
		
		require('dbconnect.php');
		
		for( $i=0; $i < count($delate); $i++ ) {
	 	// ..削除処理 (それぞれのidは$sakujo[$i]、件数はcount($sakujo)になります)

		$sql_query = "DELETE FROM `todo` WHERE id = ".$delate[$i].";" ;

		mysql_query($sql_query) or die(mysql_error());

		}

		mysql_close();	

// データベースの完了操作を行う。
}elseif (isset($_POST['finished']) && isset($_POST['finished_submit'])) {

		$finished = $_POST['finished'];		

		require('dbconnect.php');
		
		for( $i=0; $i < count($finished); $i++ ) {
	 	// ..削除処理 (それぞれのidは$sakujo[$i]、件数はcount($sakujo)になります)

		$sql_query = "UPDATE `todo` SET `finished_date`= CURDATE(),`still`= 0, `modified`= NOW() WHERE id = ".$finished[$i].";" ;

	    mysql_query($sql_query) or die(mysql_error());

		}

		mysql_close();	

}else{
		if (isset($_POST['unfinished']) && isset($_POST['unfinished_submit'])) {
			
		$unfinished = $_POST['unfinished'];		
		
		require('dbconnect.php');
		
		for( $j=0; $j < count($unfinished); $j++ ) {
	 	// ..削除処理 (それぞれのidは$sakujo[$i]、件数はcount($sakujo)になります)

		$sql_query = "UPDATE `todo` SET `still`= 1, `modified`= NOW() WHERE id = ".$unfinished[$j].";" ;

	    mysql_query($sql_query) or die(mysql_error());

		}
		mysql_close();
		}
}


	//未完了データベースをpull out
	require('dbconnect.php');
	// データベースから未完了タスクを取り出す（still=1, 完了日が近い方から）
	$sql_query = "SELECT * FROM `todo` WHERE still = 1 ORDER BY `planed_date`";
	$todos = mysql_query($sql_query);

	//データベースから完了タスクを取り出す（still=0, 完了した順で）
	$sql_query = "SELECT * FROM `todo` WHERE still = 0 ORDER BY `finished_date` DESC;";
	$all_done = mysql_query($sql_query);

	mysql_close();	
	// 順番に表示する（foreach文）
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>PHPを利用したToDoリスト(Web)の開発</title>
  <link href="/todolist/bootstrap-3.3.6-dist/css/bootstrap.css" media="all" rel="Stylesheet" type="text/css" /> 
  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/start/jquery-ui.css" >
  <!-- <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/redmond/jquery-ui.css" > -->
  <!-- <link href="jquery-1.12.1.min.js" rel="stylesheet" type="text/js" /> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
</head>
<body>
<header>

</header>

<div clas="container table-bordered">

<div class="text-center">

<h2>未完了タスクの一覧</h2>

<!-- 新規画面へ -->
<p><a href="add.php" class="btn btn-primary btn-lg active">新規登録</a></p>

<form action="" method="post">
<?php 
	if ($todos !== false && mysql_num_rows($todos)){	

		echo '<table class="table table-hover">
							 <thead>
								<tr>
									<th> 　　　　 </th>
									<th> タイトル </th>
									<th> 予定日 </th>
									<th> 優先順位 </th>
									<th> <input type="submit" name="finished_submit" value="タスク完了" class="btn btn-default btn-sm"></th>
									<th> <input type="submit" name="delate_submit" value="削除" onClick="check_submit()" class="btn btn-default btn-sm"></th> 
									</th>			
								</tr>	
								</thead>' ;
  	
				
			$k = 1;
			while ($todo = mysql_fetch_assoc($todos)){
					
					$priority =htmlspecialchars($todo['priority'], ENT_QUOTES, 'UTF-8');
					$colour = "black";
					// 優先度に応じて表示・色を指定
					if ($priority == 1) {
						$priority = "Later";
						$colour = "black";
					}elseif($priority == 2){
						$priority = "Important";
						$colour = "blue";
					}elseif($priority == 3){
						$priority = "Very Important";
						$colour = "yellow";
					}elseif($priority == 4){
						$priority = "As soon as possible";
						$colour = "orange";
					}else{
						$priority = "Right now!";
						$colour = "red";
					}

					echo '<tbody>';
					echo "<tr>";
				//	echo "<th>".htmlspecialchars($todo['id'], ENT_QUOTES, 'UTF-8')."</th>";
					echo "<th>".$k."</th>";
					echo '<th><a href="task.php?id='.htmlspecialchars($todo['id'], ENT_QUOTES, 'UTF-8').'">'.htmlspecialchars($todo['title'], ENT_QUOTES, 'UTF-8').'</a></th>';
					echo '<th>'.htmlspecialchars($todo['planed_date'], ENT_QUOTES, 'UTF-8').'</th>';
					echo '<th><span style="color:'.$colour.';">'.$priority.'</span></th>';
					echo '<th> <input type="checkbox" name = "finished[]" value="'.htmlspecialchars($todo['id'], ENT_QUOTES, 'UTF-8').'"> </th>';
					echo '<th> <input type="checkbox" name = "delate[]" value="'.htmlspecialchars($todo['id'], ENT_QUOTES, 'UTF-8').'"> </th>';
					echo "</tr>";
					

					$k++;
			}
			mysql_free_result($todos);

		} else{	echo '<h3> 未完了タスクはございません。 </h3>';	}

?>

</table>
</form>


<h2>完了タスクの一覧</h2>

<form action="" method="POST">
<?php 

	if ($all_done !== false && mysql_num_rows($all_done)){				
	
		echo '<table class="table table-hover">
							<thead>
								<tr>
									<th> 　　　　 </th>
									<th> タイトル </th>
									<th> 完了日 </th>
									<th> 予定日 </th>
									<th> <input type="submit" name="unfinished_submit" value="タスク未完了" class="btn btn-default btn-sm" ></th>
									<th> <input type="submit" name="delate_submit" value="削除" class="btn btn-default btn-sm" onClick="check_submit()"></th>			
								</tr>	
					  		</thead>';			
			$k=1;
			while ($done = mysql_fetch_assoc($all_done)){
					echo "<tbody>";
					echo "<tr>";
						//echo "<th>".htmlspecialchars($done['id'], ENT_QUOTES, 'UTF-8')."</th>";
						echo "<th>".$k."</th>";
//						echo "<th>".htmlspecialchars($done['title'], ENT_QUOTES, 'UTF-8')."</th>";
						echo '<th><a href="task.php?id='.htmlspecialchars($done['id'], ENT_QUOTES, 'UTF-8').'">'.htmlspecialchars($done['title'], ENT_QUOTES, 'UTF-8').'</a></th>';
						echo "<th>".htmlspecialchars($done['finished_date'], ENT_QUOTES, 'UTF-8')."</th>";
						echo "<th>".htmlspecialchars($done['planed_date'], ENT_QUOTES, 'UTF-8')."</th>";
						echo '<th> <input type="checkbox" name="unfinished[]" value="'.htmlspecialchars($done['id'], ENT_QUOTES, 'UTF-8').'"> </th>';
						echo '<th> <input type="checkbox" name="delate[]" value="'.htmlspecialchars($done['id'], ENT_QUOTES, 'UTF-8').'"> </th>';
					echo "</tr>";
					echo "</tbody>";
					$k++;
			}
			mysql_free_result($all_done);

		} else{	echo '<h3> 完了タスクは０件です </h3>';	}

	echo "</table>";

?>

</form>
</div>
</div>
</body>



<!-- カレンダー表示 -->
<script>
	  $(function() {
	    $("#datepicker_plan").datepicker();
	    $("#datepicker_plan").datepicker("option", "showOn", 'button');
	    $("#datepicker_plan").datepicker("option", "buttonImageOnly", true);
	    $("#datepicker_plan").datepicker("option", "buttonImage", 'ico_calendar.png');
	  });

	  $(function() {
	    $("#datepicker_finished").datepicker();
	    $("#datepicker_finished").datepicker("option", "showOn", 'button');
	    $("#datepicker_finished").datepicker("option", "buttonImageOnly", true);
	    $("#datepicker_finished").datepicker("option", "buttonImage", 'ico_calendar.png');
	  });


	function check_submit() {
		//項目が空白の場合にアラート
		// if (document.fb.textfield.value == "") {
		// 	alert("項目が入力されていません。");
		// } else {
			//ダイアログを表示
			var r = confirm("本当に削除してもよろしいですか？");
			//フォームの送信
			if (r) {
				document.fb.submit();
			}else{
				return false;	//送信を中止
			}
		}


</script>
<!-- 修正が必要部分！！ -->
<script type="text/javascript">
document.getElementById('btnClose').onclick = function(){
	if (confirm('削除しますか？')) {
	}else{	};
}
</script>




