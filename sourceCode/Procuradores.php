<?php include_once('verificacaoDeSessao.php');?>

<?php
    if ( isset ($_POST['nomedit'])){
		$id = $_POST['id'];
		$nome = $_POST['nomedit'];
		$morada = $_POST['moradaedit'];
		$codigoPostal = $_POST['codigoPostaledit'];
		$contato = $_POST['contatoedit'];
		$contribuinte = $_POST['contribuintedit'];
		$dataNascimento = $_POST['dataNascimentoedit'];
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->actualizarProcurador($id, $nome, $morada, $codigoPostal, $contato, $contribuinte, $dataNascimento);
		echo "<script>alert('Procurador atualizado com sucesso'); window.location='Procuradores.php'</script>";
    }
	
	if ( isset ($_POST['nome'])){
		$nome = $_POST['nome'];
		$morada = $_POST['morada'];
		$codigoPostal = $_POST['codigoPostal'];
		$contato = $_POST['contato'];
		$contribuinte = $_POST['contribuinte'];
		$dataNascimento = $_POST['dataNascimento'];
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->inserirProcurador($nome, $morada, $codigoPostal, $contato, $contribuinte, $dataNascimento);
		echo "<script>alert('Procurador criado com sucesso'); window.location='Procuradores.php'</script>";
		
	}
?>

<?php
	function MostarProcuradores($id, $idf, $idI){
		echo"
			<div class='row' style='position:relative; top:10%'>
				<div class='large-5 columns'>
					۩
					<a href='Condominios.php'> Condominios </a>
					➜
					<a href='Fracoes.php?h=".$idf."'> Fracoes </a>
					➜
					<a href='Inquilinos.php?h=" . $idI . " & f=".$idf."'> Inquilinos </a>
					۩
				</div>
				<div class='row'>
					<div class='large-12 end panel callout radius columns'>
						<table class='large-12 end panel radius columns'>
							<thead>
							<tr>
								<th class='large-2'>Nome</th>
								<th class='large-2'>Morada</th>
								<th class='large-1'>codigoPostal</th>
								<th class='large-2'>contato</th>
								<th class='large-1'>Contribuinte</th>
								<th class='large-2'>dataNascimento</th>";
									include_once('DataAccess.php');
									$da = new DataAccess();
									$ras = $da->getUser($_SESSION['id']);
									if (mysqli_num_rows($ras) > 0){
										$roo = mysqli_fetch_object($ras);
										if($roo->id_tipoUtilizador == 1){
											echo"<th class='large-2'>Editar</th>";
										}else{
											echo"<th class='large-2'>&nbsp;</th>";
										}
									}
								echo"
							</tr>
							</thead>
							<tbody>
		";
								$res = $da->getProcurador($id);
								if (mysqli_num_rows($res) > 0){
									$row = mysqli_fetch_object($res);
		echo "
									<tr>
										<td class='large-2'>" . $row->nome . "</td>
										<td class='large-2'>" . $row->morada . "</td>
										<td class='large-1'>" . $row->codigoPostal . "</td>
										<td class='large-2'>" . $row->contato . "</td>
										<td class='large-1'>" . $row->contribuinte . "</td>
										<td class='large-1'>" . $row->dataNascimento . "</td>
										<td class='large-2'>
		";
											if($roo->id_tipoUtilizador == 1){
												echo"<a href='InquilinosDados.php?h=" . $row->id . "'><img src='foundation/img/Editar.png'/></a>";
											}
		echo"
										</td>
									</tr>
		";
								}
		echo"
							</tbody>
						</table>
		";
						if($roo->id_tipoUtilizador == 1){
		echo"	
						<div class='row'>
							<div class='large-2 large-centered columns'>
								<a href='ProcuradoresDados.php' class='button round'>Criar novo procurador</a>
							</div>
						</div>
		";
						}
		echo"	
					</div>
				</div>
			</div>
		";
	}

	function ShowProcuradores(){
		include_once('verificacaoDeUser.php');
		echo"
			<div class='row' style='position:relative; top:10%'>
				<div class='large-2 columns'>
					&nbsp;
				</div>
				<div class='row'>
					<div class='large-12 end panel callout radius columns'>
						<table class='large-12 end panel radius columns'>
							<thead>
							<tr>
								<th class='large-2'>Nome</th>
								<th class='large-2'>Morada</th>
								<th class='large-1'>Código Postal</th>
								<th class='large-2'>Contato</th>
								<th class='large-1'>Contribuinte</th>
								<th class='large-2'>Data de Nascimento</th>
								<th class='large-2'>Editar</th>
							</tr>
							</thead>
							<tbody>
		";
								$res = $da->getallProcurador();
								if (mysqli_num_rows($res) > 0){
									while($row = mysqli_fetch_object($res)){
		echo "
										<tr>
											<td class='large-2'>" . $row->nome . "</td>
											<td class='large-2'>" . $row->morada . "</td>
											<td class='large-1'>" . $row->codigoPostal . "</td>
											<td class='large-2'>" . $row->contato . "</td>
											<td class='large-1'>" . $row->contribuinte . "</td>
											<td class='large-1'>" . $row->dataNascimento . "</td>
											<td class='large-2'>
												<a href='ProcuradoresDados.php?h=" . $row->id . "'><img src='foundation/img/Editar.png'/></a>
											</td>
										</tr>
		";
									}
								}
		echo"
							</tbody>
						</table>
						<div class='row'>
							<div class='large-2 large-centered columns'>
								<a href='ProcuradoresDados.php' class='button round'>Criar novo procurador</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		";
	}

?>

<!doctype html>
<html class="no-js" lang="en">
	<head>
		<?php include_once('importarScript.php'); ?>
		<?php include_once('verificacaoDeMenu.php'); ?>
	</head>
	<body>
		<?php
			if (isset($_GET['h']) && isset($_GET['f']) && isset($_GET['I'])){
				MostarProcuradores($_GET['h'], $_GET['f'], $_GET['I']);
			}else{
				ShowProcuradores();
			}
		?>
		<?php include_once('importarScript2.php'); ?>
	</body>
</html>