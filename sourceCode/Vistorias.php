<?php include_once('verificacaoDeSessao.php'); ?>

<?php
    if ( isset ($_POST['dataedit'])){
		$data = $_POST['dataedit'];
		$id = $_POST['id'];
		$vistoria = $_POST['vistoriaedit'];
		$id_condominio = $_POST['Condominioedit'];
			include_once('DataAccess.php');
			$da = new DataAccess();
			$rip = $da->getCondominionlampadas($id_condominio);
			if (mysqli_num_rows($rip) > 0){
				$roo = mysqli_fetch_object($rip);
				$stock = $roo->nLampadas;
			}
		$id_utilizador = $_POST['utilizador'];
		$numMov = $_POST['num'];
		$idvistoria = $_POST['idvistoria'];
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->atualizarVistoria($id, $data, $vistoria, $numMov, $id_condominio, $id_utilizador);
		if($numMov==1){
			$idM = $_POST['idM'];
			$oldid_condominio = $_POST['oldCondominio'];
			$oldstock = $_POST['stock'];
			$acao = $_POST['acaoedit'];
			$descricao = $_POST['descricaoedit'];
			$numero = $_POST['numeroedit'];
			if($id_condominio == $oldid_condominio){
				include_once('DataAccess.php');
				$da = new DataAccess();
				$ras = $da->actualizarMovLampada($idM, $oldstock, $data, $acao, $numero, $descricao, $idvistoria);
				if($acao == 'Entrada'){
					$nLampadas = $oldstock + $numero;
				}
				if($acao == 'Saida'){
					$nLampadas = $oldstock - $numero;
				}
				$ros = $da->atualizarCondominionlampadas($id_condominio,$nLampadas);
			}else{
				include_once('DataAccess.php');
				$da = new DataAccess();
				$ras = $da->actualizarMovLampada($idM, $stock, $data, $acao, $numero, $descricao, $idvistoria);
				if($acao == 'Entrada'){
					$nLampadas = $stock+$numero;
				}else{
					$nLampadas = $stock-$numero;
				}
				$ros = $da->atualizarCondominionlampadas($oldid_condominio,$oldstock);
				$ros = $da->atualizarCondominionlampadas($id_condominio,$nLampadas);
			}
		}
		echo "<script>alert('Vistotia Editada com sucesso'); window.location='Vistorias.php'</script>";
	}
	
	if ( isset ($_POST['data'])){
		$data = $_POST['data'];
		$vistoria = $_POST['vistoria'];
		$id_condominio = $_POST['Condominio'];
			include_once('DataAccess.php');
			$da = new DataAccess();
			$rip = $da->getCondominionlampadas($id_condominio);
			if (mysqli_num_rows($rip) > 0){
				$roo = mysqli_fetch_object($rip);
				$stock = $roo->nLampadas;
			}
		$id_utilizador = $_POST['utilizador'];
		$numMov = $_POST['num'];
		$idvistoria = $_POST['idvistoria'];
		
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->inserirVistoria($data, $vistoria, $numMov, $id_condominio, $id_utilizador);
		if($numMov==1){
			$acao = $_POST['acao'];
			$numero = $_POST['numero'];
			$descricao = $_POST['descricao'];
			include_once('DataAccess.php');
			$da = new DataAccess();
			$ras = $da->inserirMovLampada($stock, $data, $acao, $numero, $descricao, $idvistoria);
			
			if($acao == 'Entrada'){
				$nLampadas = $stock+$numero;
			}else{
				$nLampadas = $stock-$numero;
			}
			$ros = $da->atualizarCondominionlampadas($id_condominio,$nLampadas);
		}
		echo "<script>alert('Vistotia criada com sucesso'); window.location='Vistorias.php'</script>";
	}
?>

<?php
	function MostarAllVistorias(){
		echo"
			<div class='row' style='position:relative; top:10%'>
				<div class='large-2 columns'>
					&nbsp;
				</div>
				<div class='row'>
					<div class='large-8 end panel callout radius columns'>
						<form method='post' action='Vistorias.php'>
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
					<div class='large-12 panel callout radius columns'>
						<table>
							<thead>
							<tr>
							<th class='large-2'>Utilizador</th>
							<th class='large-2'>Condominio</th>
							<th class='large-1'>Data</th>
							<th class='large-6'>Descrição</th>
							<th class='large-1'>Editar</th>
							</tr>
							</thead>
							<tbody>
		";
									include_once('DataAccess.php');
									$da = new DataAccess();
									$res = $da->getallVistoria();
									if (mysqli_num_rows($res) > 0){
										while($row = mysqli_fetch_object($res)){
		echo "
												<tr>
													<td>" . $row->nome . "</td>
													<td>" . $row->morada . "</td>
													<td>" . $row->data . "</td>
													<td>" . $row->vistoria . "</td>
													<td>
		";
														$ras = $da->getUser($_SESSION['id']);
														if (mysqli_num_rows($ras) > 0){
															$roo = mysqli_fetch_object($ras);
															if($row->id_utilizador == $_SESSION['id'] || $roo->id_tipoUtilizador == 1){
																echo"<a href='VistoriasDados.php?h=" . $row->id . "'><img src='foundation/img/Editar.png'/></a>";
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
								<a href='VistoriasDados.php' class='button round'>Criar nova Vistoria</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		";
	}
	
	function MostarVistorias($Condominio){
		echo"
			<div class='row' style='position:relative; top:10%'>
				<div class='large-2 columns'>
					&nbsp;
				</div>
				<div class='row'>
					<div class='large-8 end panel callout radius columns'>
						<form method='post' action='Vistorias.php'>
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
					<div class='large-12 panel callout radius columns'>
						<table>
							<thead>
							<tr>
							<th class='large-2'>Utilizador</th>
							<th class='large-2'>Condominio</th>
							<th class='large-1'>Data</th>
							<th class='large-6'>Descrição</th>
							<th class='large-1'>Editar</th>
							</tr>
							</thead>
							<tbody>
		";
									include_once('DataAccess.php');
									$da = new DataAccess();
									$res = $da->getallVistoriadados($Condominio);
									if (mysqli_num_rows($res) > 0){
										while($row = mysqli_fetch_object($res)){
		echo "
												<tr>
													<td>" . $row->nome . "</td>
													<td>" . $row->morada . "</td>
													<td>" . $row->data . "</td>
													<td>" . $row->vistoria . "</td>
													<td>
		";
														$ras = $da->getUser($_SESSION['id']);
														if (mysqli_num_rows($ras) > 0){
															$roo = mysqli_fetch_object($ras);
															if($row->id_utilizador == $_SESSION['id'] || $roo->id_tipoUtilizador == 1){
																echo"<a href='VistoriasDados.php?h=" . $row->id . "'><img src='foundation/img/Editar.png'/></a>";
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
								<a href='VistoriasDados.php' class='button round'>Criar nova Vistoria</a>
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
				MostarVistorias($_POST['Condominio']);
			}else{
				MostarAllVistorias();
			}
		?>
		<?php include_once('importarScript2.php'); ?>
	</body>
</html>