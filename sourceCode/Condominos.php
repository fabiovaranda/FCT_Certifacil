<?php include_once('verificacaoDeSessao.php');?>

<?php
    if ( isset ($_POST['nomedit'])){
		$id = $_POST['id'];
		$nome = $_POST['nomedit'];
		$contato = $_POST['contatoedit'];
		$email = $_POST['emailedit'];
		$morada = $_POST['moradaedit'];
		$dataNascimento = $_POST['dataNascimentoedit'];
		$contribuinte = $_POST['contribuintedit'];
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->actualizarCondomino($id, $nome, $contato, $email, $morada, $dataNascimento, $contribuinte);
		echo "<script>alert('Condomino atualizado com sucesso'); window.location='Condominos.php'</script>";
    }

	if ( isset ($_POST['nome'])){
		$nome = $_POST['nome'];
		$contato = $_POST['contato'];
		$email = $_POST['email'];
		$morada = $_POST['morada'];
		$dataNascimento = $_POST['dataNascimento'];
		$contribuinte = $_POST['contribuinte'];
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->inserirCondomino($nome, $contato, $email, $morada, $dataNascimento, $contribuinte);
		echo "<script>alert('Condomino criado com sucesso'); window.location='Condominos.php'</script>";
		
	}
?>

<?php
	function MostarCondominos($id, $idf){
		echo"
			<div class='row' style='position:relative; top:10%'>
				<div class='large-3 columns'>
					۩
					<a href='Condominios.php'> Condominios </a>
					➜
					<a href='Fracoes.php?h=".$id."'> Fracoes </a>
					۩
				</div>
				<div class='row'>
					<div class='large-12 end panel callout radius columns'>
						<table class='large-12 end panel radius columns'>
							<thead>
							<tr>
								<th class='large-2'>Nome</th>
								<th class='large-1'>contato</th>
								<th class='large-2'>email</th>
								<th class='large-2'>morada</th>
								<th class='large-2'>dataNascimento</th>
								<th class='large-1'>contribuinte</th>
		";
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
								$res = $da->getCondominoFracao($idf);
								if (mysqli_num_rows($res) > 0){
									$row = mysqli_fetch_object($res);
		echo "
									<tr>
										<td class='large-2'>" . $row->nome . "</td>
										<td class='large-1'>" . $row->contato . "</td>
										<td class='large-2'>" . $row->email . "</td>
										<td class='large-2'>" . $row->morada . "</td>
										<td class='large-2'>" . $row->dataNascimento . "</td>
										<td class='large-1'>" . $row->contribuinte . "</td>
										<td class='large-2'>
		";
											if($roo->id_tipoUtilizador == 1){
												echo"<a href='CondominosDados.php?h=" . $row->id . "'><img src='foundation/img/Editar.png'/></a>";
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
									<a href='CondominosDados.php' class='button round'>Criar novo Condominio</a>
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

	function ShowCondominos(){
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
								<th class='large-1'>contato</th>
								<th class='large-2'>email</th>
								<th class='large-2'>morada</th>
								<th class='large-2'>dataNascimento</th>
								<th class='large-1'>contribuinte</th>
								<th class='large-2'>Editar</th>
							</tr>
							</thead>
							<tbody>
		";
								$res = $da->getallCondomino();
								if (mysqli_num_rows($res) > 0){
									while($row = mysqli_fetch_object($res)){
		echo "
											<tr>
												<td class='large-2'>" . $row->nome . "</td>
												<td class='large-1'>" . $row->contato . "</td>
												<td class='large-2'>" . $row->email . "</td>
												<td class='large-2'>" . $row->morada . "</td>
												<td class='large-2'>" . $row->dataNascimento . "</td>
												<td class='large-1'>" . $row->contribuinte . "</td>
												<td class='large-2'>
													<a href='CondominosDados.php?h=" . $row->id . "'><img src='foundation/img/Editar.png'/></a>
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
								<a href='CondominosDados.php' class='button round'>Criar novo Condominio</a>
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
				MostarCondominos($_GET['h'], $_GET['f']);
			}else{
				ShowCondominos();
			}
		?>
		<?php include_once('importarScript2.php'); ?>
	</body>
</html>