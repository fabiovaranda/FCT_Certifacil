<?php include_once('verificacaoDeSessao.php'); ?>

<?php
    if ( isset ($_POST['useredit'])){
		$antigaPwd = md5($_POST['password']);
		$pwdBD = $_POST['oldPassword'];
		$pwd1 = $_POST['password1'];
		$pwd2 = $_POST['password2'];
		if ($antigaPwd == $pwdBD && $pwd1 == $pwd2 && $pwd1 != ""){
			$id = $_SESSION['id'];
			$nome = $_POST['useredit'];
			$novaPwd = md5($_POST['password1']);
			
			include_once('DataAccess.php');
			$da = new DataAccess();
			$res = $da->atualizarUtilizador($id, $nome, $novaPwd);
			echo "<script>alert('Utilizador atualizado com sucesso'); window.location='PaginaInicial.php'</script>";
			
		}else if ($pwd1 == "" && $pwd2 == ""){
			$id = $_SESSION['id'];
			$nome = $_POST['useredit'];
			
			include_once('DataAccess.php');
			$da = new DataAccess();
			$res = $da->atualizarUtilizador($id, $nome, $pwdBD);
			echo "<script>alert('Nome atualizado com sucesso'); window.location='PaginaInicial.php'</script>";
		}else{
			echo "<script>alert('Palavras-Passe incorretas');</script>";
		}
    }
?>

<!doctype html>
<html class="no-js" lang="en">
	<head>
		<?php include_once('importarScript.php'); ?>
		<?php include_once('verificacaoDeMenu.php'); ?>
	</head>
	<body>
		<?php include_once('PerfilHTML.php'); ?>
		<?php include_once('importarScript2.php'); ?>
	</body>
</html>