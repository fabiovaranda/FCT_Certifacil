<?php
	$id = $_GET['i'];
	include_once('DataAccess.php');
	$da = new DataAccess();
	$da->eliminarUtilizador($id);

	echo "<script>
		alert('Utilizador eliminado com sucesso');
		window.location='Utilizadores.php';
	</script>";
?>