<?php
	function errorHandler($msg){
		header("Location: index.php?msg=$msg");
		exit;
	}
	function successHandler($msg){
		header("Location: index.php?success=$msg");
		exit;
	}
	try {
		$nome = $_POST['nome'];
		$arquivoTmp = $_FILES['arquivo']['tmp_name'];
		if(trim($nome)==''){
			errorHandler('Preencha o nome do arquivo.');
		}
		if(trim($arquivoTmp)==''){
			errorHandler('Informe um arquivo para upload.');
		}
	
		if (!file_exists('upload')) {
			mkdir("upload");
		}
		$md5Arquivo = md5(uniqid(rand(), true));
		$arquivo = "upload/" . md5($md5Arquivo) . ".jpg";
		move_uploaded_file($_FILES['arquivo']['tmp_name'], $arquivo);
		$images = [];
		$caminhoJson = "upload/imagens.json";
		if(file_exists($caminhoJson)){
			$images = json_decode(file_get_contents($caminhoJson));
		}
		$images[]= [
			"link"=> $arquivo,
			"nome"=>$nome,
			"data_upload"=>  new DateTime()
		];
		file_put_contents($caminhoJson, json_encode($images));
		successHandler("Imagem salva com sucesso.");
	} catch (\Throwable $th) {
		errorHandler('Erro interno ao salvar o arquivo.');
	
	}

	




?>