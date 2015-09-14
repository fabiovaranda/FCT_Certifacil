<?php
	$id = $_GET['i'];
	include_once('DataAccess.php');
	$da = new DataAccess();
	$da->eliminarProcurador($id);

	echo "<script>
		alert('Procurador eliminado com sucesso');
		window.location='Procuradores.php';
	</script>";
?>