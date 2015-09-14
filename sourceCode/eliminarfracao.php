<?php
	$id = $_GET['i'];
	include_once('DataAccess.php');
	$da = new DataAccess();
	$da->eliminarfracao($id);

	echo "<script>
		alert('Fracao eliminada com sucesso');
		window.location='Fracoes.php';
	</script>";
?>