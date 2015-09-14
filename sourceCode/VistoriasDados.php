<?php include_once('verificacaoDeSessao.php');?>

<?php
	function Criar($nmov){
		echo"
			<div class='row' style='position:relative; top:10%'>
				<div class='large-2 columns'>
					۩
						<a href='Vistorias.php'> Vistorias </a>
					۩
				</div>
				<div class='row'>
					<div class='large-8 end panel radius columns'>
						<form method='post' action='Vistorias.php'>
							<fieldset>
								<legend>Criar Vistoria</legend>
								<div class='row'>
									<div class='large-6 columns'>
		";
										include_once('DataAccess.php');
										$da = new DataAccess();
										$res = $da->getallVistoria();
										$nmrRows = mysqli_num_rows($res) + 1;
		echo"
										<input type='hidden' name='idvistoria' value='" . $nmrRows . "'/>
										<input type='hidden' name='num' value='" . $nmov . "'/>
										<input type='hidden' name='utilizador' value='" . $_SESSION['id'] . "'/>
										
										<label for='data'> Data da vistoria</label>
										<input type='date' name='data' required/>
									</div>
									<div class='large-6 columns'>
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
								</div>
								<div class='row'>
									<div class='large-12 columns'>
										<textarea name='vistoria' placeholder='Dados da vistoria' required></textarea>
									</div>
								</div>
		";
									if($nmov == 1){
		echo"
										<fieldset>
											<legend> Movimento de Lamapdas </legend>
											<div class='row'>
												<div class='large-4 columns'>
													<label for = 'acao'> Movimento de Entrada ou Saida </label>
													<select name='acao' id='acao'>
														<option value = 'Entrada'>Entrada</option>
														<option value = 'Saida'>Saida</option>
													</select>
												</div>
												<div class='large-4 columns'>
													<label for='numero'> Numero de lampadas </label>
													<input type='text' placeholder='Numero de lampadas' name='numero' required/>
												</div>
												<div class='large-4 columns'>
													<label for='descricao'> Quais os tipos de lampadas </label>
													<input type='text' name='descricao' required/>
												</div>
											</div>
										</fieldset>
		";
									}						
		echo"
								<div class='row'>
									<div class='large-2 large-centered columns'>
										 <input type='submit' value='Criar'/>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		";
	}
	
	function Editar($id){
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->getVistoria($id);
		if (mysqli_num_rows($res) > 0){
			$row = mysqli_fetch_object($res);
			echo"
				<div class='row' style='position:relative; top:10%'>
					<div class='large-2 columns'>
						۩
							<a href='Vistorias.php'> Vistorias </a>
						۩
					</div>
					<div class='row'>
						<div class='large-8 end panel radius columns'>
							<form method='post' action='Vistorias.php'>
								<fieldset>
									<legend>Editar Vistoria</legend>
									<div class='row'>
										<div class='large-6 columns'>
											<input type='hidden' name='id' value='$row->id'/>
											<input type='hidden' name='num' value='$row->nMovimentos'/>
											<input type='hidden' name='utilizador' value='" . $_SESSION['id'] . "'/>
											
											<label for='dataedit'> Data da Vistoria</label>
											<input type='date' value='". $row->data ."' name='dataedit' required/>
										</div>
										<div class='small-6 columns'>
											<label for = 'Condominioedit'>Selecione um condomino</label>
											<input type='hidden' name='oldCondominio' value='$row->id_condominio'/>
											<select name='Condominioedit' id='Condominioedit'>
				";
												include_once('DataAccess.php');
												$da = new DataAccess();
												$ras = $da->getallCondominio();
												if (mysqli_num_rows($ras) > 0){
													while($roo = mysqli_fetch_object($ras)){
														if($row->id_condominio == $roo->id){
															echo"<option value = '" . $roo->id ."' selected> " . $roo->morada . "</option>";
														}else{
															echo"<option value = '" . $roo->id ."'> " . $roo->morada . "</option>";
														}
													}
												}
				echo"
											</select>
										</div>
									</div>
									<div class='row'>
										<div class='large-12 columns'>
											<textarea name='vistoriaedit' placeholder='Dados da vistoria' required>" . $row->vistoria . "</textarea>
										</div>
									</div>
				";
										if($row->nMovimentos == 1){
				echo"
											<fieldset>
												<legend> Movimento de Lamapdas </legend>
				";
												include_once('DataAccess.php');
												$da = new DataAccess();
												$ros = $da->getMovLampada($row->id_condominio, $row->data);
												if (mysqli_num_rows($ros) > 0){
													$rom = mysqli_fetch_object($ros);
				echo"
													<div class='row'>
														<div class='large-4 columns'>
															<input type='hidden' name='idM' value='$rom->id'/>
															<label for = 'acaoedit'> Movimento de Entrada ou Saida </label>
															<select name='acaoedit'>
				";
															if($rom->acao == 'Entrada'){
				echo"
																<option value = 'Entrada' selected>Entrada</option>
																<option value = 'Saida'>Saida</option>
				";
															}else{
				echo"
																<option value = 'Entrada'>Entrada</option>
																<option value = 'Saida' selected>Saida</option>
				";
															}
				echo"
															</select>
														</div>
														<div class='large-4 columns'>
															<label for='numeroedit'> Numero de lampadas </label>
															<input type='hidden' name='stock' value='$rom->stock'/>
															<input type='text' placeholder='Numero de lampadas' value = '" . $rom->numero ."' name='numeroedit' required/>
														</div>
														<div class='large-4 columns'>
															<label for='descricaoedit'> Quais os tipos de lampadas </label>
															<input type='text' value = '" . $roo->descricao ."' name='descricaoedit' required/>
														</div>
													</div>
				";
												}
				echo"
											</fieldset>
				";
										}						
				echo"
									<div class='row'>
										<div class='large-2 large-centered columns'>
											 <input type='submit' value='Editar'/>
										</div>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			";
		}
	}
	
	function Choose(){
		include_once('verificacaoDeUser.php');
		echo"
			<div class='row' style='position:relative; top:10%'>
				<div class='large-2 columns'>
					&nbsp;
				</div>
				<div class='row'>
					<div class='large-8 end panel callout radius columns'>
						<form method='post' action='VistoriasDados.php'>
							<div class='row'>
								<div class='small-8 columns'>
									<label for = 'Choose'>Que tipo de movimento houve</label>
									<select name='Choose' id='Choose'>
										<option value = 0> Sem Movimento de lampadas </option>
										<option value = 1> 1Movimento de saida ou entrada </option>
									</select>
								</div>
								<div class='small-4 columns'>
									<input type='submit' value='Criar' class='button round'/>
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
				Editar($_GET['h']);
			}else if (isset($_POST['Choose'])){
				Criar($_POST['Choose']);
			}else{
				Choose();
			}
		?>
		<?php include_once('importarScript2.php'); ?>
	</body>
</html>