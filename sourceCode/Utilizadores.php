<?php include_once('verificacaoDeSessao.php'); include_once('verificacaoDeUser.php'); ?>

<?php
    if ( isset ($_POST['nomedit'])){
		$id = $_POST['id'];
		$nome = $_POST['nomedit'];
		if ($_POST['password'] != ""){
			$passe = md5($_POST['password']);
		}else{
			$passe = $_POST['oldPassword'];
		}
		if($_POST['tipouser'] == true){
			$idTipo = 1;
		}else{
			$idTipo = 2;
		}
		if($_POST['estado'] == true){
			$idestado = 1;
		}else{
			$idestado = 2;
		}
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->atualizarUser($id, $nome, $passe, $idTipo, $idestado);
		echo "<script>alert('Utilizador atualizado com sucesso'); window.location='Utilizadores.php'</script>";
    }
	
	if ( isset ($_POST['nome'])){
		$nome = $_POST['nome'];
		$pwd = md5($_POST['password']);
		if($_POST['tipouser'] == true){
			$idTipo = 1;
		}else{
			$idTipo = 2;
		}
		if($_POST['estado'] == true){
			$idestado = 1;
		}else{
			$idestado = 2;
		}
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->inserirUser($nome, $passe, $idTipo, $idestado);
		echo "<script>alert('Utilizador criado com sucesso'); window.location='Utilizadores.php'</script>";
		
	}
?>

<!doctype html>
<html class="no-js" lang="en">
	<head>
		<?php include_once('importarScript.php'); ?>
		<?php include_once('verificacaoDeMenu.php'); ?>
	</head>
	<body>
		<?php include_once('UtilizadoresHTML.php'); ?>
		<?php include_once('importarScript2.php'); ?>
	</body>
</html>