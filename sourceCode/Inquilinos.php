<?php include_once('verificacaoDeSessao.php');?>

<?php
    if ( isset ($_POST['nomedit'])){
		$id = $_POST['id'];
		$nome = $_POST['nomedit'];
		$dataNascimento = $_POST['dataNascimentoedit'];
		$contato = $_POST['contatoedit'];
		$email = $_POST['emailedit'];
		$contribuinte = $_POST['contribuintedit'];
		$id_procurador = $_POST['procuradoredit'];
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->actualizarInquilino($id, $nome, $dataNascimento, $contato, $email, $contribuinte, $id_procurador);
		echo "<script>alert('Inquilino atualizado com sucesso'); window.location='Inquilinos.php'</script>";
    }
	
	if ( isset ($_POST['nome'])){
		$nome = $_POST['nome'];
		$dataNascimento = $_POST['dataNascimento'];
		$contato = $_POST['contato'];
		$email = $_POST['email'];
		$contribuinte = $_POST['contribuinte'];
		$id_procurador = $_POST['procurador'];
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->inserirInquilino($nome, $dataNascimento, $contato, $email, $contribuinte, $id_procurador);
		echo "<script>alert('Inquilino criado com sucesso'); window.location='Inquilinos.php'</script>";
		
	}
?>

<?php
	function MostarInquilinos($id, $idf){
		echo"
			<div class='row' style='position:relative; top:10%'>
				<div class='large-3 columns'>
					۩
					<a href='Condominios.php'> Condominios </a>
					➜
					<a href='Fracoes.php?h=".$idf."'> Fracoes </a>
					۩
				</div>
				<div class='row'>
					<div class='large-12 end panel callout radius columns'>
						<table class='large-12 end panel radius columns'>
							<thead>
							<tr>
								<th class='large-2'>Nome</th>
								<th class='large-2'>Data de Nascimento</th>
								<th class='large-1'>Contato</th>
								<th class='large-2'>Email</th>
								<th class='large-1'>Contribuinte</th>
								<th class='large-2'>Procurador</th>";
									include_once('DataAccess.php');
									$da = new DataAccess();
									$res = $da->getUser($_SESSION['id']);
									if (mysqli_num_rows($res) > 0){
										$row = mysqli_fetch_object($res);
										if($row->id_tipoUtilizador == 1){
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
								$ras = $da->getInquilino($id);
								if (mysqli_num_rows($ras) > 0){
									$roo = mysqli_fetch_object($ras);
		echo "
									<tr>
										<td class='large-2'>" . $roo->nome . "</td>
										<td class='large-2'>" . $roo->dataNascimento . "</td>
										<td class='large-1'>" . $roo->contato . "</td>
										<td class='large-2'>" . $roo->email . "</td>
										<td class='large-1'>" . $roo->contribuinte . "</td>
		";
										if ($roo->id_procurador != null){
											$rip = $da->getProcurador($roo->id_procurador);
											if (mysqli_num_rows($rip) > 0){
											$rum = mysqli_fetch_object($rip);
		echo"
											
											<td class='large-2'>
												<a href='Procuradores.php?h=" . $roo->id_procurador . " & f=".$idf." & I=".$roo->id."'>" . $rum->nome . "</a>
											</td>
		";	
											}
										}else{
		echo"
											<td class='large-2'>Não Tem</td>
		";
										}
		echo"
										<td class='large-2'>
		";
											if($row->id_tipoUtilizador == 1){
												echo"<a href='InquilinosDados.php?h=" . $roo->id . "'><img src='foundation/img/Editar.png'/></a>";
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
						if($row->id_tipoUtilizador == 1){
		echo"
							<div class='row'>
								<div class='large-2 large-centered columns'>
									<a href='InquilinosDados.php' class='button round'>Criar novo Inquilino</a>
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

	function ShowInquilinos(){
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
								<th class='large-2'>Data de Nascimento</th>
								<th class='large-1'>Contato</th>
								<th class='large-2'>Email</th>
								<th class='large-1'>Contribuinte</th>
								<th class='large-2'>Procurador</th>
								<th class='large-2'>Editar</th>
							</tr>
							</thead>
							<tbody>
		";
								include_once('DataAccess.php');
								$da = new DataAccess();
								$res = $da->getallInquilino();
								if (mysqli_num_rows($res) > 0){
									while($row = mysqli_fetch_object($res)){
		echo "
										<tr>
											<td class='large-2'>" . $row->nome . "</td>
											<td class='large-2'>" . $row->dataNascimento . "</td>
											<td class='large-1'>" . $row->contato . "</td>
											<td class='large-2'>" . $row->email . "</td>
											<td class='large-1'>" . $row->contribuinte . "</td>
		";
											if ($row->id_procurador != null){
												$ras = $da->getProcurador($row->id_procurador);
												if (mysqli_num_rows($ras) > 0){
												$roo = mysqli_fetch_object($ras);
		echo"
												<td class='large-2'>" . $roo->nome . "</td>
		";	
												}
											}else{
		echo"
												<td class='large-2'>Não Tem</td>
		";
											}
		echo"
											<td class='large-2'>
												<a href='InquilinosDados.php?h=" . $row->id . "'><img src='foundation/img/Editar.png'/></a>
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
								<a href='InquilinosDados.php' class='button round'>Criar novo Inquilino</a>
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
			if (isset($_GET['h']) && isset($_GET['f'])){
				MostarInquilinos($_GET['h'], $_GET['f']);
			}else{
				ShowInquilinos();
			}
		?>
		<?php include_once('importarScript2.php'); ?>
	</body>
</html>