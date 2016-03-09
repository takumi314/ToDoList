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

<div class="text-center">
	<div class="container" style="
	    width: 530px;
	">
		<div>
			<h3>タスク登録</h3>
			<form action="afterAdding.php" method="POST" id="sign_up" onsubmit="return validate()" class="form-horizontal">
				<div class="form-horizontal" style="
				    margin-top: 40px;
				    border-bottom-width: 20px;
				">

					<div></div>
						
					<div class="form-group">
						<!-- <div class=""> -->
							<label for="exampleInputTitle">タスク名</label>					
							<input type="text" name="title" class="autocomplete" id="name" size="40">
						<!-- </div> -->
					</div>

					
						<!-- <div class=""> -->
					<div class="form-group">
						<label for="exampleInputPlan">予定日</label>
						<input type="text" name="planed_date" id="datepicker_plan" >
					</div>
					<!-- <div></div> -->
					<div class="form-group">
						<label for="exampleInputFinish">完了日</label>
						<input type="text" name="finishing_date" id="datepicker_finishing" >
					</div>			
				<!-- </div> -->
					

					<div class="form-group">
						<label for="exampleInputDetail">タスク内容</label>
						<textarea name="task" rows="4" cols="40" class="autocomplete" id="task" ></textarea>
					</div>
				</div>

				<div class="form-group">
				優先順位：
				  	<select name="priorities">
	    				<option value="5">Right now!</option>
					    <option value="4">As soon as possible</option>
					    <option value="3">Very Important</option>
					    <option value="2">Important</option>
					    <option value="1">Later</option>
				 	</select>
				
				<inout type="radio" name="" value="1">
				</div>
				
				<div class="form-group">
				<p>
				<input type="submit" value="送信">
				<input type="reset" value="リセット">
				</p>
				</div>

			</form>
			<form action="ToDoList.php" method="post"> 
				<input type="submit" value="戻る" >
			</form>
		</div>	
	</div>
</div>


<script type="text/javascript">

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


</body>