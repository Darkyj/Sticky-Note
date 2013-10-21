<?php 
	require('connectionadvanced.php');
 ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Advanced AJAX</title>
	<link rel="stylesheet" type="text/css" href="//code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function()
	{
		$('#note').submit(function()
		{
			var form = $(this);
			$.post(
				
				form.attr('action'),
				form.serialize(),
				function(data)
				{
					$("#myposts").html(data), 
					$('.post').val("");
				},"json"
			);
			return false;
		});

		$('#note').submit();

		$(document).on('blur','.post_content',function()
		{
			$($(this).parent()).submit(function()
			{
				var edit = $(this);
				$.post(
					edit.attr('action'),
					edit.serialize(),
					function(data)
					{
						$('#myposts').html(data);
					},
					"json"
				);
				return false;
			});
			$($(this).parent()).submit();
		});

		$(document).on('click',".del",function()
		{
			$('.post_delete').attr('value','True');
			$($(this).parent()).submit(function()
			{
				var del = $(this);
				$.post(
					del.attr('action'),
					del.serialize(),
					function (data)
					{
						$('#myposts').html(data);

					},
					"json"
					);
				return false;
			});
			$($(this).parent()).submit();
		});
	});


	</script>
</head>
<body>
	<div>
		<h1>My sticky notes:</h1>
		<div id="myposts">
			<!--Posts -->
		</div>
		<h1>Add a Note:</h1>
		<form action="processadvanced.php" method="post" id="note">
			<input name="title" type="text" class='post' placeholder="Insert note title here...">
			<textarea name="description" class='post' id="" cols="30" rows="10"></textarea>
			<button type="submit">Insert Note</button>
		</form>
	</div>
	<div id = "notes">
		
	</div>
</body>
</html>