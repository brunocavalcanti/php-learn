<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
	body{
		background-color: #fafafa;

	}
		form{
			width: 400px; 
			margin: 0 auto; 
			background-color: #ccc;
			padding: 10px;
			border-radius: 8px
		}
		.avatar {
 		 vertical-align: middle;
 		 width: 50px;
 		 height: 50px;
  		 border-radius: 50%;
}
	</style>
</head>
<body>

	<div class="container">
		<form action="upload.php" method="POST" enctype="multipart/form-data">
			<label for="nome">Nome</label><br />
			<input type="text" name="nome" /><br /><br />

			<label for="arquivo">Arquivo</label><br />
			<input type="file" name="arquivo" /><br /><br />

			<input type="submit" />
		</form>
	</div>
<?php
	$error_message = $_REQUEST['msg'];
	if(trim($error_message)!=='' ){
		echo "<script type=\"text/javascript\">alert('$error_message');</script>";
	}
	$success_message = $_REQUEST['success'];
	if(trim($success_message)!=='' ){
		echo "<script type=\"text/javascript\">alert('$success_message');</script>";
	}

	$images = [];
	$caminhoJson = "upload/imagens.json";
	echo "<br><br>";
	if(file_exists($caminhoJson)){
		$images = json_decode(file_get_contents($caminhoJson));
		foreach ($images as $key => $value) {
		$img ="<img src=%s alt=Avatar class=avatar>";
			printf($img, $value->link);
		}
	}


?>
</body>
</html>