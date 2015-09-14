<?php
	if (isset($_POST['user'])){
		//tentar efetuar login
		$username = $_POST['user'];
		$password = md5($_POST['passe']); //md5 serve para encriptar a password
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->login($username, $password);
		//Se a variável $res tiver resultados, significa que o login foi efetuado com sucesso
		if (mysqli_num_rows($res) > 0){
			$row = mysqli_fetch_object($res);
			if($row->id_estado == 1){
				session_start();
				$_SESSION['id'] = $row->id;
				echo "<script>alert('Login efetuado com sucesso'); window.location='Condominios.php'</script>";
			}else{
				echo "<script>alert('Nome ou Palavra-Passe incorretos');</script>";
			}
		}else{
			echo "<script>alert('Nome ou Palavra-Passe incorretos');</script>";
		}
	}
?>

<html>
	<head>
		<?php 
		    include_once('importarScript.php'); 	
			session_start();
			if (isset($_SESSION['id'])){
				echo "<script>window.location='Condominios.php';</script>";
			}
		?>
	</head>
	<body>
		<?php include_once('Login.php'); ?>
		<?php include_once('importarScript2.php'); ?>
	</body>
</html>