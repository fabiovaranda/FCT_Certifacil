<?php include_once('verificacaoDeSessao.php');?><?php include_once('verificacaoDeUser.php'); ?>

<script>
    function confirmacaoEliminacao(i){
        if(confirm('Tem a certeza que deseja eliminar?')){
            window.location='eliminarfracao.php?i='+i;
        }
    }
</script>


<?php
	function Criar(){
		echo"
			<div class='row' style='position:relative; top:10%'>
				<div class='large-2 columns'>
					&nbsp;
				</div>
				<div class='row'>
					<div class='large-8 end panel radius columns'>
						<form method='post' action='Fracoes.php'>
							<fieldset>
								<legend> Criar fracao </legend>
								<div class='row'>
									<div class='large-4 columns'>
										<label for='nome'> Nome da fracao </label>
										<input type='text' placeholder='Nome da fracao' name='nome' required/>
									</div>
									<div class='large-4 columns'>
										<label for='piso'> Piso da fracao </label>
										<input type='text' placeholder='Piso da fracao' name='piso' required/>
									</div>
									<div class='large-4 columns'>
										<label for='porta'> Porta da fracao </label>
										<input type='text' placeholder='Porta da fracao' name='porta' required/>
									</div>
								</div>
								<div class='row'>
									<div class='small-6 columns'>
										<label for = 'tipofracao'>Qual o tipo de fração</label>
										<select name='tipofracao' id='tipofracao'>
		";
											include_once('DataAccess.php');
											$da = new DataAccess();
											$ras = $da->getalltipofracao();
											if (mysqli_num_rows($ras) > 0){
												while($roo = mysqli_fetch_object($ras)){
													echo"<option value = '" . $roo->id ."'> " . $roo->tipo . "</option>";
												}
											}
		echo"
										</select>
									</div>
									<div class='small-6 columns'>
										<label for = 'condominio'>Selecione um condominio</label>
										<select name='condominio' id='condominio'>
		";
											include_once('DataAccess.php');
											$da = new DataAccess();
											$ras = $da->getallCondominio();
											if (mysqli_num_rows($ras) > 0){
												while($roo = mysqli_fetch_object($ras)){
													include_once('DataAccess.php');
													$da = new DataAccess();
													$rip = $da->getfracoes($roo->id);
													if ($roo->nFracao > mysqli_num_rows($rip)){
														echo"<option value = '" . $roo->id ."'> " . $roo->morada . "</option>";
													}
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
											$ras = $da->getallCondomino();
											if (mysqli_num_rows($ras) > 0){
												while($roo = mysqli_fetch_object($ras)){
													echo"<option value = '" . $roo->id ."'> " . $roo->nome . "</option>";
												}
											}
		echo"
										</select>
									</div>
									<div class='small-6 columns'>
										<label for = 'inquilino'>Selecione um procurador</label>
										<select name='inquilino' id='inquilino'>
											<option value = null> Sem Inquilino </option>
		";
											include_once('DataAccess.php');
											$da = new DataAccess();
											$ras = $da->getallInquilino();
											if (mysqli_num_rows($ras) > 0){
												while($roo = mysqli_fetch_object($ras)){
													echo"<option value = '" . $roo->id ."'> " . $roo->nome . "</option>";
												}
											}
		echo"
										</select>
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
		$res = $da->getafracao($id);
		if (mysqli_num_rows($res) > 0){
			$row = mysqli_fetch_object($res);
			echo"
				<div class='row' style='position:relative; top:10%'>
					<div class='large-2 columns'>
						&nbsp;
					</div>
					<div class='row'>
						<div class='large-8 end panel radius columns'>
							<form method='post' action='Fracoes.php'>
								<fieldset>
									<legend>Editar fracao " . $row->nome . "</legend>
									<div class='row'>
										<div class='large-4 columns'>
											<input type='hidden' id='id' name='id' value='$row->id'/>
											<label for='nomedit'> Nome da fracao </label>
											<input type='text' placeholder='Nome da fracao' value='". $row->nome ."' name='nomedit' required/>
										</div>
										<div class='large-4 columns'>
											<label for='pisoedit'> Piso da fracao </label>
											<input type='text' placeholder='Piso da fracao' value='". $row->piso ."' name='pisoedit' required/>
										</div>
										<div class='large-4 columns'>
											<label for='portaedit'> Porta da fracao </label>
											<input type='text' placeholder='Porta da fracao' value='". $row->porta ."' name='portaedit' required/>
										</div>
									</div>
									<div class='row'>
										<div class='small-6 columns'>
											<label for = 'tipofracaoedit'>Qual o tipo de fração</label>
											<select name='tipofracaoedit' id='tipofracaoedit'>
				";
												include_once('DataAccess.php');
												$da = new DataAccess();
												$ras = $da->getalltipofracao();
												if (mysqli_num_rows($ras) > 0){
													while($roo = mysqli_fetch_object($ras)){
														if($row -> id_tipofracao == $roo->id){
															echo"<option value = '" . $roo->id ."' selected> " . $roo->tipo . "</option>";
														}else{
															echo"<option value = '" . $roo->id ."'> " . $roo->tipo . "</option>";
														}
													}
												}
				echo"
											</select>
										</div>
										<div class='small-6 columns'>
											<label for = 'condominoedit'>Selecione um condomino</label>
											<select name='condominoedit' id='condominoedit'>
				";
												include_once('DataAccess.php');
												$da = new DataAccess();
												$ras = $da->getallCondomino();
												if (mysqli_num_rows($ras) > 0){
													while($roo = mysqli_fetch_object($ras)){
														if($row -> id_condomino == $roo->id){
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
											<label for = 'inquilinoedit'>Selecione um procurador</label>
											<select name='inquilinoedit' id='inquilinoedit'>
												<option value = null> Sem Inquilino </option>
				";
												include_once('DataAccess.php');
												$da = new DataAccess();
												$ras = $da->getallInquilino();
												if (mysqli_num_rows($ras) > 0){
													while($roo = mysqli_fetch_object($ras)){
														if($row -> id_inquilino == $roo->id){
															echo"<option value = '" . $roo->id ."'selected> " . $roo->nome . "</option>";
														}else{
															echo"<option value = '" . $roo->id ."'> " . $roo->nome . "</option>";
														}
													}
												}
				echo"
											</select>
										</div>
										<div class='small-6 columns'>
				";
												include_once('DataAccess.php');
												$da = new DataAccess();
												$ras = $da->getCondominio($row->id_condominio);
												if (mysqli_num_rows($ras) > 0){
													$roo = mysqli_fetch_object($ras);
				echo"
													<input type='hidden' id='condominioedit' name='condominioedit' value='$row->id_condominio'/>
													<label for='condominio'> Condominio </label>
													<input type='text' value='". $roo->morada ."' name='condominio' Disabled/>
				";
												}
				echo"
										</div>
									</div>
									<div class='row'>
										<div class='large-2 columns'>
											 <input type='button' onclick='confirmacaoEliminacao(".$id.")' value='Apagar'/>
										</div>
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