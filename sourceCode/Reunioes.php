<?php include_once('verificacaoDeSessao.php'); ?>

<?php
    if ( isset ($_POST['dataedit'])){
		$id = $_POST['id'];
		$data = $_POST['dataedit'];
		$hora = $_POST['horaedit'];
		if($_POST['localedit'] == true){
			$local = 'Escritório';
		}else{
			$local = 'Predio';
		}
		$id_condominio = $_POST['condominioedit'];
		$representante = $_POST['representantedit'];
		$id_utilizador = $_POST['utilizadoredit'];
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->atualizarReuniao($id, $data, $hora, $local, $id_condominio, $representante, $id_utilizador);
		echo "<script>alert('Reuniao atualizada com sucesso'); window.location='Reunioes.php'</script>";
    }
	
	if ( isset ($_POST['data'])){
		$data = $_POST['data'];
		$hora = $_POST['hora'];
		if($_POST['local'] == true){
			$local = 'Escritório';
		}else{
			$local = 'Predio';
		}
		$id_condominio = $_POST['condominio'];
		$representante = $_POST['representante'];
		$id_utilizador = $_POST['utilizador'];
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->inserirReuniao($data, $hora, $local, $id_condominio, $representante, $id_utilizador);
		echo "<script>alert('Reuniao criada com sucesso'); window.location='Reunioes.php'</script>";
	}
?>

<?php
	function MostarAllReunioes(){
		echo"
			<div class='row' style='position:relative; top:10%'>
				<div class='large-2 columns'>
					&nbsp;
				</div>
				<div class='row'>
					<div class='large-8 end panel callout radius columns'>
						<form method='post' action='Reunioes.php'>
							<div class='row'>
								<div class='large-8 columns'>
									<label for = 'Condominio'>Qual o Condominio pretendido</label>
									<select name='Condominio' id='Condominio'>
		";
										include_once('DataAccess.php');
										$da = new DataAccess();
										$ras = $da->getallCondominio();
										if (mysqli_num_rows($ras) > 0){
											while($roo = mysqli_fetch_object($ras)){
												echo"<option value = '" . $roo->id ."'> " . $roo->morada . "</option>";
											}
										}
		echo"
									</select>
								</div>
								<div class='large-2 end columns'>
									<input type='submit' value='Pesquisar' class='button round'/>
								</div>
							</div>
						</form>	
					</div>
				</div>
				<div class='row'>
					<div class='large-12 end panel callout radius columns'>
						<table class='large-12 end panel radius columns'>
							<thead>
								<tr>
									<th class='large-3'>Condominio</th>
									<th class='large-2'>Local da Reunião</th>
									<th class='large-2'>Representante</th>
									<th class='large-2'>Data</th>
									<th class='large-2'>Hora</th>
									<th class='large-1'>Editar</th>
								</tr>
							</thead>
							<tbody>
		";
									include_once('DataAccess.php');
									$da = new DataAccess();
									$res = $da->getallReuniao();
									if (mysqli_num_rows($res) > 0){
										while($row = mysqli_fetch_object($res)){
											echo "
												<tr>
													<td>" . $row->morada . "</td>
													<td>" . $row->local . "</td>
													<td>" . $row->RepNome . "</td>
													<td>" . $row->data . "</td>
													<td>" . $row->hora . "</td>
													<td>
											";
														$ras = $da->getUser($_SESSION['id']);
														if (mysqli_num_rows($ras) > 0){
															$roo = mysqli_fetch_object($ras);
															if($row->id_utilizador == $_SESSION['id'] || $roo->id_tipoUtilizador == 1){
																echo"<a href='ReunioesDados.php?h=" . $row->id . "'><img src='foundation/img/Editar.png'/></a>";
															}
														}
											echo"
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
								<a href='ReunioesDados.php' class='button round'>Criar nova Reunião</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		";
	}
	
	function MostarReunioes($Condominio){
		echo"
			<div class='row' style='position:relative; top:10%'>
				<div class='large-2 columns'>
					&nbsp;
				</div>
				<div class='row'>
					<div class='large-8 end panel callout radius columns'>
						<form method='post' action='Reunioes.php'>
							<div class='row'>
								<div class='large-8 columns'>
									<label for = 'Condominio'>Qual o Condominio pretendido</label>
									<select name='Condominio' id='Condominio'>
		";
										include_once('DataAccess.php');
										$da = new DataAccess();
										$ras = $da->getallCondominio();
										if (mysqli_num_rows($ras) > 0){
											while($roo = mysqli_fetch_object($ras)){
												echo"<option value = '" . $roo->id ."'> " . $roo->morada . "</option>";
											}
										}
		echo"
									</select>
								</div>
								<div class='large-2 end columns'>
									<input type='submit' value='Pesquisar' class='button round'/>
								</div>
							</div>
						</form>	
					</div>
				</div>
				<div class='row'>
					<div class='large-12 end panel callout radius columns'>
						<table class='large-12 end panel radius columns'>
							<thead>
								<tr>
									<th class='large-3'>Condominio</th>
									<th class='large-2'>Local da Reunião</th>
									<th class='large-2'>Representante</th>
									<th class='large-2'>Data</th>
									<th class='large-2'>Hora</th>
									<th class='large-1'>Editar</th>
								</tr>
							</thead>
							<tbody>
		";
									include_once('DataAccess.php');
									$da = new DataAccess();
									$res = $da->getallReuniaodados($Condominio);
									if (mysqli_num_rows($res) > 0){
										while($row = mysqli_fetch_object($res)){
		echo "
												<tr>
													<td>" . $row->morada . "</td>
													<td>" . $row->local . "</td>
													<td>" . $row->RepNome . "</td>
													<td>" . $row->data . "</td>
													<td>" . $row->hora . "</td>
													<td>
		";
														$ras = $da->getUser($_SESSION['id']);
														if (mysqli_num_rows($ras) > 0){
															$roo = mysqli_fetch_object($ras);
															if($row->id_utilizador == $_SESSION['id'] || $roo->id_tipoUtilizador == 1){
																echo"<a href='ReunioesDados.php?h=" . $row->id . "'><img src='foundation/img/Editar.png'/></a>";
															}
														}
		echo"
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
								<a href='ReunioesDados.php' class='button round'>Criar nova Reunião</a>
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
			if (isset($_POST['Condominio'])){
				MostarReunioes($_POST['Condominio']);
			}else{
				MostarAllReunioes();
			}
		?>
		<?php include_once('importarScript2.php'); ?>
	</body>
</html>