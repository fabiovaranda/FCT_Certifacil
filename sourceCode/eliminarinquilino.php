<?php
	$id = $_GET['i'];
	include_once('DataAccess.php');
	$da = new DataAccess();
	$da->eliminarInquilino($id);

	echo "<script>
		alert('Inquilino eliminada com sucesso');
		window.location='Inquilinos.php';
	</script>";
?>