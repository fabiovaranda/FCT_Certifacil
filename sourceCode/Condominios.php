<?php include_once('verificacaoDeSessao.php'); ?>

<?php
    if ( isset ($_POST['moradaedit'])){
		$id = $_POST['id'];
		$morada= $_POST['moradaedit'];
		$codigoPostal= $_POST['codigoPostaledit'];
		$contribuinte= $_POST['contribuintedit'];
		$nFracao= $_POST['nFracaoedit'];
		$nLampadas= $_POST['nLampadasedit'];
		$freguesia= $_POST['freguesiaedit'];
		$rota= $_POST['rotaedit'];
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->atualizarCondominio($id, $morada, $codigoPostal, $contribuinte, $nFracao, $nLampadas, $freguesia, $rota);
		echo "<script>alert('Condominio atualizado com sucesso'); window.location='Condominios.php'</script>";
    }
	
	if ( isset ($_POST['morada'])){
		$morada= $_POST['morada'];
		$codigoPostal= $_POST['codigoPostal'];
		$contribuinte= $_POST['contribuinte'];
		$nFracao= $_POST['nFracao'];
		$nLampadas= $_POST['nLampadas'];
		$freguesia= $_POST['freguesia'];
		$rota= $_POST['rota'];
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->inserirCondominio($morada, $codigoPostal, $contribuinte, $nFracao, $nLampadas, $freguesia, $rota);
		echo "<script>alert('Condominio criado com sucesso'); window.location='Condominios.php'</script>";
	}
?>

<!doctype html>
<html class="no-js" lang="en">
	<head>
		<?php include_once('importarScript.php'); ?>
		<?php include_once('verificacaoDeMenu.php'); ?>
	</head>
	<body>
		<?php include_once('CondominiosHTML.php'); ?>
		<?php include_once('importarScript2.php'); ?>
	</body>
</html>