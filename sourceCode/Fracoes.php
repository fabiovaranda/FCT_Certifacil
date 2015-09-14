<?php include_once('verificacaoDeSessao.php');?>

<?php
    if ( isset ($_POST['condominioedit'])){
		if($_POST['condominioedit'] != null){
			$id = $_POST['id'];
			$nome = $_POST['nomedit'];
			$piso = $_POST['pisoedit'];
			$porta = $_POST['portaedit'];
			$id_tipofracao = $_POST['tipofracaoedit'];
			$id_condominio = $_POST['condominioedit'];
			$id_condomino = $_POST['condominoedit'];
			$id_inquilino = $_POST['inquilinoedit'];
			include_once('DataAccess.php');
			$da = new DataAccess();
			$res = $da->actualizarFracao($id, $nome, $piso, $porta, $id_tipofracao, $id_condominio, $id_condomino, $id_inquilino);
			echo "<script>alert('Fracao atualizada com sucesso'); window.location='Fracoes.php'</script>";
		}
    }
	
	if ( isset ($_POST['nome'])){
		$nome = $_POST['nome'];
		$piso = $_POST['piso'];
		$porta = $_POST['porta'];
		$id_tipofracao = $_POST['tipofracao'];
		$id_condominio = $_POST['condominio'];
		$id_condomino = $_POST['condomino'];
		$id_inquilino = $_POST['inquilino'];
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->inserirFracao($nome, $piso, $porta, $id_tipofracao, $id_condominio, $id_condomino, $id_inquilino);
		echo "<script>alert('Fracao criada com sucesso'); window.location='Fracoes.php'</script>";
	}
?>

<?php
	function MostarFracoes($id){
	echo $id;
		echo"
			<div class='row' style='position:relative; top:10%'>
				<div class='large-3 columns'>
					۩
					<a href='Condominios.php'> Condominios </a>
					۩
				</div>
				<div class='row'>
					<div class='large-12 end panel callout radius columns'>
						<table class='large-12 end panel radius columns'>
							<thead>
							<tr>
								<th class='large-2'>Nome</th>
								<th class='large-1'>Piso</th>
								<th class='large-2'>Porta</th>
								<th class='large-1'>Tipo de fração</th>
								<th class='large-2'>Condomino</th>
								<th class='large-1'>Inquilino</th>
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
								$res = $da->getfracao($id);
								if (mysqli_num_rows($res) > 0){
									while($row = mysqli_fetch_object($res)){
		echo "
											<tr>
												<td class='large-2'>" . $row->nome . "</td>
												<td class='large-1'>" . $row->piso . "</td>
												<td class='large-2'>" . $row->porta . "</td>
												<td class='large-1'>" . $row->tipo . "</td>
												<td class='large-2'>
													<a href='Condominos.php?h=$row->id_condominio&f=$row->id'>" . $row->Cnome . "</a>
												</td>
		";
												if ($row->id_inquilino != null){
													$ros = $da->getInquilino($row->id_inquilino);
													if (mysqli_num_rows($ros) > 0){
														$rip = mysqli_fetch_object($ros);
		echo"
														<td class='large-1'>
															<a href='Inquilinos.php?h=" . $rip->id . " & f=".$row->id."'>" . $rip->nome . "</a>
														</td>
		";
													}
												}else{
													echo"<td class='large-1'>Não Tem</td>";
												}
		echo"
												<td class='large-2'>
		";
													if($roo->id_tipoUtilizador == 1){
														echo"<a href='FracoesDados.php?h=" . $row->id . "'><img src='foundation/img/Editar.png'/></a>";
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
		";
						if($roo->id_tipoUtilizador == 1){
		echo"
							<div class='row'>
								<div class='large-2 large-centered columns'>
									<a href='FracoesDados.php' class='button round'>Criar nova fracao</a>
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
	
	function ShowFracao($id){
		include_once('verificacaoDeUser.php');
		echo"
			<div class='row' style='position:relative; top:10%'>
				<div class='large-2 columns'>
					&nbsp;
				</div>
				<div class='row'>
					<div class='large-8 end panel callout radius columns'>
						<form method='post' action='Fracoes.php'>
							<div class='row'>
								<div class='small-8 columns'>
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
								<div class='small-4 columns'>
									<input type='submit' value='Procurar' class='button round'/>
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
								<th class='large-2'>Nome</th>
								<th class='large-1'>Piso</th>
								<th class='large-2'>Porta</th>
								<th class='large-1'>Tipo de fração</th>
								<th class='large-2'>Condomino</th>
								<th class='large-1'>Inquilino</th>
								<th class='large-2'>Editar</th>
							</tr>
							</thead>
							<tbody>
		";
								$res = $da->getfracao($id);
								if (mysqli_num_rows($res) > 0){
									while($row = mysqli_fetch_object($res)){
		echo "
											<tr>
												<td class='large-2'>" . $row->nome . "</td>
												<td class='large-1'>" . $row->piso . "</td>
												<td class='large-2'>" . $row->porta . "</td>
												<td class='large-1'>" . $row->tipo . "</td>
												<td class='large-2'>" . $row->Cnome . "</td>
		";
												if ($row->id_inquilino != null){
													$ros = $da->getInquilino($row->id_inquilino);
													if (mysqli_num_rows($ros) > 0){
														$rip = mysqli_fetch_object($ros);
		echo"
														<td class='large-1'>" . $rip->nome . "</td>
		";
													}
												}else{
													echo"<td class='large-1'>Não Tem</td>";
												}
		echo"
												<td class='large-2'>
													<a href='FracoesDados.php?h=" . $row->id . "'><img src='foundation/img/Editar.png'/></a>
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
								<a href='FracoesDados.php' class='button round'>Criar nova Fracao</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		";
	}
	
	function ProcurarFracao(){
		include_once('verificacaoDeUser.php');
		echo"
			<div class='row' style='position:relative; top:10%'>
				<div class='large-2 columns'>
					&nbsp;
				</div>
				<div class='row'>
					<div class='large-8 end panel callout radius columns'>
						<form method='post' action='Fracoes.php'>
							<div class='row'>
								<div class='small-8 columns'>
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
								<div class='small-4 columns'>
									<input type='submit' value='Procurar' class='button round'/>
								</div>
							</div>
						</form>
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
			if (isset($_GET['h'])){
				MostarFracoes($_GET['h']);
			}else if (isset($_POST['Condominio'])){
				ShowFracao($_POST['Condominio']);
			}else{
				ProcurarFracao();
			}
		?>
		<?php include_once('importarScript2.php'); ?>
	</body>
</html>