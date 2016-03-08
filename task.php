<?php 

// GETで受け取って照会する	
if (isset($_GET['id'])) {
	
	$id = $_GET['id'];

	require('dbconnect.php');

	$sql_squery = "SELECT `id`, `title`, `task`, `planed_date`, `finished_date`, `still`, `created`, `modified`, `priority` FROM `todo` WHERE id = ".$id.";" ;
	//mysql_query($sql_squery) or die(mysql_error());
	$task = mysql_fetch_assoc(mysql_query($sql_squery));

	mysql_close();

}

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

<script type="text/javascript">

$(function(){
	$('#sign_up').submit(function(){
		
		var name = $('#name').val();
		var task = $('#task').val();
		var planed_date = $('datepicker_plan').val();
		var finished_date = $('datepicker_finished').val();
		console.log(planed_date);
		
		if(name.length == 0){
			alert("タイトルが未入力です。");
			return false;
		}else{
			
			if(task.length == 0){
				if(window.confirm('タスク内容が未入力ですが、このまま変更されますか？')){
				//true ;
				}else{
					return false;
				};

			}else{

				
					if(window.confirm('変更されますか？')){
					//true ;
					}else{
						return false;
					};
				
			};

		};	
	});

});

</script>


<div class="text-center">
	
	<h3>タスク変更・閲覧画面</h3>
		
			<!-- <div class="text-left"> -->
				<form action="afterAdding.php" method="POST" id="sign_up">
					<input type="hidden" name="id" value="<?php echo $task['id'];?>" >

					<p>	予定日：<input type="text" name="planed_date" id="datepicker_plan" value=""> </p>
					<p>	完了日：<input type="text" name="finished_date" id="datepicker_finished" value=""> </p>

					<p>
						タイトル：<input type="text" name="title" class="autocomplete" id="name" size="40" value="<?php echo $task['title'];?>" >
					</p>
					<p>
					タスク内容：
					<textarea name="task" rows="4" cols="40" class="autocomplete" id="task"><?php echo $task['task'];?></textarea>
					<p>
					優先順位：<?php echo $task['priority'];?><br>
					  	<select name="priorities" checked="<?php echo $task['priority'];?>">
		    				<option value="5" 
			    					<?php 
			    						if($task['priority'] == '5' || $task['priority'] == '0'){ 
			    							echo 'selected';
			    						} 
			    					?>	
		    				>Right now!</option>
						    <option value="4"
			    					<?php 
			    						if($task['priority'] == '4' ){ 
			    							echo 'selected';
			    						} 
			    					?>	
		    				>As soon as possible</option>
						    <option value="3" value="5" 
			    					<?php 
			    						if($task['priority'] == '3' ){ 
			    							echo 'selected';
			    						} 
			    					?>	
		    				>Very Important</option>
						    <option value="2" 
			    					<?php 
			    						if($task['priority'] == '2' ){ 
			    							echo 'selected';
			    						} 
			    					?>	
		    				>Important</option>
						    <option value="1" 
			    					<?php 
			    						if($task['priority'] == '1' ){ 
			    							echo 'selected';
			    						} 
			    					?>
			    			>Later</option>
					 	</select>
					</p>	
					
					</p>
					<p>
					<input type="submit" value="変更">
					<input type="reset" value="リセット">
					</p>
				</form>
				<form action="ToDoList.php" method="post"> 
					<input type="submit" value="戻る" >
				</form>
			<!-- </div> -->
		
</div>
</body>

<script>	  

	$(function() {
		    $("#datepicker_plan").datepicker();

		    $("#datepicker_plan").datepicker("option", "showOn", 'button');
		    $("#datepicker_plan").datepicker("option", "buttonImageOnly", true);
		    $("#datepicker_plan").datepicker("option", "buttonImage", 'ico_calendar.png');

		    $( "#datepicker_plan" ).datepicker( "option", { "dateFormat": "yy-mm-dd"});
//		    $( "#datepicker_plan" ).datepicker( "option", "defaultDate", "<?php echo $task['planed_date']; ?>");
			$( "#datepicker_plan" ).datepicker( "setDate", "<?php echo $task['planed_date']; ?>" );
	  	}
	);

	$(function() {
		    $("#datepicker_finished").datepicker();

		    $("#datepicker_finished").datepicker("option", "showOn", 'button');
		    $("#datepicker_finished").datepicker("option", "buttonImageOnly", true);
		    $("#datepicker_finished").datepicker("option", "buttonImage", 'ico_calendar.png');

		    $( "#datepicker_finished" ).datepicker( "option", { "dateFormat": "yy-mm-dd"});
//		    $( "#datepicker" ).datepicker( "option", "defaultDate", "<?php echo $task['planed_date']; ?>");
			$( "#datepicker_finished" ).datepicker( "setDate", "<?php echo $task['finished_date']; ?>" );
	  	}
	);


</script>
