<?php include_once('verificacaoDeSessao.php');?>

<?php
	function Criar(){
		echo"
			<div class='row' style='position:relative; top:10%'>
				<div class='large-2 columns'>
					۩
						<a href='Reunioes.php'> Reunioes </a>
					۩
				</div>
				<div class='row'>
					<div class='large-8 end panel radius columns'>
						<form method='post' action='Reunioes.php'>
							<fieldset>
								<legend>Criar nova Reunião</legend>
								<div class='row'>
									<div class='large-4 columns'>
										<input type='hidden' id='utilizador' name='utilizador' value='" . $_SESSION['id'] . "'/>
										<label for='data'> Data da reunião</label>
										<input type='date' name='data' required/>
									</div>
									<div class='large-4 columns'>
										<label for='hora'> Hora da reunião </label>
										<input type='time' name='hora' required/>
									</div>
									<div class='small-4 columns'>
											<label for = 'representante'>Selecione um Representante</label>
											<select name='representante' id='representante'>
				";
												include_once('DataAccess.php');
												$da = new DataAccess();
												$ras = $da->getallUser();
												if (mysqli_num_rows($ras) > 0){
													while($roo = mysqli_fetch_object($ras)){
														echo"<option value = '" . $roo->id ."' selected> " . $roo->nome . "</option>";
													}
												}
				echo"
											</select>
										</div>
								</div>
								<div class='row'>
									<div class='small-6 columns'>
										<label for = 'condomino'>Selecione um condomino</label>
										<select name='condomino' id='condomino'>
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
									<div class='large-6 columns'>
										<label> Onde se realizou a reunião </label>
										<div class='large-4 columns'>
											<label> Predio </label>
										</div>
										<div class='large-4 columns'>
											<div class='switch round'>
												<input id='local' name='local' type='checkbox'>
												<label for='local'></label>
											</div>
										</div>
										<div class='large-4 end columns'>
											<label> Escritório </label>
										</div>
									</div>
								</div>
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
		$res = $da->getReuniao($id);
		if (mysqli_num_rows($res) > 0){
			$row = mysqli_fetch_object($res);
			echo"
				<div class='row' style='position:relative; top:10%'>
					<div class='large-2 columns'>
						۩
							<a href='Reunioes.php'> Reunioes </a>
						۩
					</div>
					<div class='row'>
						<div class='large-8 end panel radius columns'>
							<form method='post' action='Reunioes.php'>
								<fieldset>
									<legend>Editar Reunião</legend>
									<div class='row'>
										<div class='large-4 columns'>
											<input type='hidden' id='id' name='id' value='$row->id'/>
											<input type='hidden' id='utilizadoredit' name='utilizadoredit' value='$row->id_utilizador'/>
											<label for='dataedit'> Data da reunião</label>
											<input type='date' value='". $row->data ."' name='dataedit' required/>
										</div>
										<div class='large-4 columns'>
											<label for='horaedit'> Hora da reunião </label>
											<input type='time' value='". $row->hora ."' name='horaedit' required/>
										</div>
										<div class='small-4 columns'>
											<label for = 'representantedit'>Selecione um Representante</label>
											<select name='representantedit' id='representantedit'>
				";
												include_once('DataAccess.php');
												$da = new DataAccess();
												$ras = $da->getallUser();
												if (mysqli_num_rows($ras) > 0){
													while($roo = mysqli_fetch_object($ras)){
														if($row -> representante == $roo->id){
															echo"<option value = '" . $roo->id ."' selected> " . $roo->nome . "</option>";
														}else{
															echo"<option value = '" . $roo->id ."'> " . $roo->nome . "</option>";
														}
													}
												}
				echo"
											</select>
										</div>
									</div>
									<div class='row'>
										<div class='small-6 columns'>
											<label for = 'condominioedit'>Selecione um condomino</label>
											<select name='condominioedit' id='condominioedit'>
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
										<div class='large-6 columns'>
											<label> Onde se realizou a reunião </label>
											<div class='large-4 columns'>
												<label> Predio </label>
											</div>
											<div class='large-4 columns'>
												<div class='switch round'>
			";
													if($row->local == 'Escritório'){
														echo"<input id='localedit' name='localedit' type='checkbox' checked>";
													}else{
														echo"<input id='localedit' name='localedit' type='checkbox'>";
													}
			echo"
													<label for='localedit'></label>
												</div>
											</div>
											<div class='large-4 end columns'>
												<label> Escritório </label>
											</div>
										</div>
									</div>
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
			}else{
				Criar();
			}
		?>
		<?php include_once('importarScript2.php'); ?>
	</body>
</html>