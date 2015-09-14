<?php
	if(isset($_SESSION['id'])){
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->getUser($_SESSION['id']);
		//Se a variável $res tiver resultados, significa que o login foi efetuado com sucesso
		if (mysqli_num_rows($res) > 0){
			$row = mysqli_fetch_object($res);
			if($row->id_tipoUtilizador == 2){
				echo "<script>alert('Acesso Negado!!!');window.location='PaginaInicial.php'</script>";
			}
		}
	}
?>