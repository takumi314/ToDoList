・未入力の場合について
・


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
	<script>
	  	$(function() {
		    $("#datepicker_plan").datepicker();
		    $("#datepicker_plan").datepicker("option", "showOn", 'button');
		    $("#datepicker_plan").datepicker("option", "buttonImageOnly", true);
		    $("#datepicker_plan").datepicker("option", "buttonImage", 'ico_calendar.png');
	 	});

	  	$(function() {
		    $("#datepicker_finishing").datepicker();
		    $("#datepicker_finishing").datepicker("option", "showOn", 'button');
		    $("#datepicker_finishing").datepicker("option", "buttonImageOnly", true);
		    $("#datepicker_finishing").datepicker("option", "buttonImage", 'ico_calendar.png');
	 	});


	</script>

<script type="text/javascript">


// $(function(){
// 	$('#sign_up').submit(function(){		
// 		var plan = $('#planed_date').val();
// 		if (plan.length == null){
// 			alert("タスク予定日を選んで下さい。");
// 			return false;
// 		};
//  	});
// });

$(function(){
	$('#sign_up').submit(function(){
		var name = $('#name').val();
		if(name.length == 0){
			alert("タスクにタイトルを付けて下さい。");
			return false;
		}else{

			var task = $('#task').val();
			if(task.length == 0){
				if(window.confirm('タスク内容が未入力ですが、このまま登録されますか？')){
				//true ;
				}else{
					return false;
				};
			};

		};	
	});
});

</script>
</header>






<div class="text-center">
	<div>
		<div>
			<h3>タスク登録</h3>
			<form action="ToDoList.php" method="POST" id="sign_up" onsubmit="return validate()">
				<p>	予定日：<input type="text" name="planed_date" id="datepicker_plan" > </p>
				<p>	完了日：<input type="text" name="finishing_date" id="datepicker_finishing" > </p>
				<p>
					タイトル：<input type="text" name="title" class="autocomplete" id="name" size="40">
				</p>
				<!-- <div class="alert alert-danger" role="alert">こここ</div> -->
				<p>
				タスク内容：
				<textarea name="task" rows="4" cols="40" class="autocomplete" id="task" ></textarea>
				<p>
				優先順位：
				  	<select name="priorities">
	    				<option value="5">Right now!</option>
					    <option value="4">As soon as possible</option>
					    <option value="3">Very Important</option>
					    <option value="2">Important</option>
					    <option value="1">Later</option>
				 	</select>
				</p>	
				<inout type="radio" name="" value="1">
				</p>
				<p>
				<input type="submit" value="送信">
				<input type="reset" value="リセット">
				</p>
			</form>
			<form action="ToDoList.php" method="post"> 
				<input type="submit" value="戻る" >
			</form>
		</div>	
	</div>
</div>



</body>