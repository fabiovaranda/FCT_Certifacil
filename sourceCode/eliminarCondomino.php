<?php
	$id = $_GET['i'];
	include_once('DataAccess.php');
	$da = new DataAccess();
	$da->eliminarCondomino($id);

	echo "<script>
		alert('Condomino eliminado com sucesso');
		window.location='Condominos.php';
	</script>";
?>