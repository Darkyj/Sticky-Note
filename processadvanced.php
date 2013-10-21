<?php 
	require('connectionadvanced.php');


	if(isset($_POST['description']) && !empty($_POST['description']))
		post();
	elseif(isset($_POST['edit_post']))
		editpost();
	elseif(isset($_POST['post_delete']) && $_POST['post_delete'] == true)
		delete();
	else
		showpost();

	function post()
	{
		$query = "INSERT INTO notes (title, description, created_at,updated_at) VALUES ('{$_POST['title']}','{$_POST['description']}',NOW(),NOW())";
		mysql_query($query);
		showpost();
	}

	function editpost()
	{
		$query_update = "UPDATE notes SET description='{$_POST['edit_post']}' WHERE id='{$_POST['id']}'";
		mysql_query($query_update);
		showpost();
	}


	function delete()
	{
		$query_delete = "DELETE FROM notes WHERE id ='{$_POST['id']}'";
		mysql_query($query_delete);
		showpost();
	}
	

	function showpost()
	{
		$html = "";
		$selecteverything = "SELECT id, title, description FROM notes ORDER BY created_at ASC";
		$search = fetch_all($selecteverything);

		foreach ($search as $value) 
		{
			$html .="
			<div>
				<form method='post' action='processadvanced.php'>
					<a href='' class='del' id='delete'>delete</a>
					<input type='hidden' name='id' value='{$value['id']}'>
					<input type='hidden' class='post_delete' name='post_delete' value='0'>
				</form>
				<div>
					'{$value['title']}'
				</div>
				<div>
					<form method='post' action='processadvanced.php'>
						<input type='hidden' name='id' value='{$value['id']}'>
						<textarea class='post_content' name='edit_post'>
						{$value['description']}
						</textarea>
					</form>
				</div>
			</div>";		
		}
		echo json_encode($html);

	}
	
	
	
	
 ?>