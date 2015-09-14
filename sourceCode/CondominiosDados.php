<?php include_once('verificacaoDeSessao.php');?><?php include_once('verificacaoDeUser.php'); ?>

<?php
	function Criar(){
		echo"
			<div class='row' style='position:relative; top:10%'>
				<div class='large-2 columns'>
					&nbsp;
				</div>
				<div class='row'>
					<div class='large-8 end panel radius columns'>
						<form method='post' action='Condominios.php'>
							<fieldset>
								<legend> Criar Condominio </legend>
								<div class='row'>
									<div class='large-6 columns'>
										<label for='morada'> Morada do condomino </label>
										<input type='text' placeholder='Morada do condomino' name='morada' required/>
									</div>
									<div class='large-6 columns'>
										<label for='codigoPostal'> Código postal </label>
										<input type='text' placeholder='Código postal' name='codigoPostal' required/>
									</div>
								</div>
								<div class='row'>
									<div class='large-6 columns'>
										<label for='contribuinte'> Numero de contribuinte </label>
										<input type='text' placeholder='Numero de contribuinte' name='contribuinte' maxlength='9' required/>
									</div>
									<div class='large-6 columns'>
										<label for='freguesia'> Freguesia do condominio </label>
										<input type='text' placeholder='Freguesia do condominio' name='freguesia' required/>
									</div>
								</div>
								<div class='row'>
									<div class='large-4 columns'>
										<label for='nLampadas'> Numero de Lampadas </label>
										<input type='text' placeholder='Numero de Lampadas' name='nLampadas' required/>
									</div>
									<div class='large-4 columns'>
										<label for='nFracao'> Numero de fraçoões </label>
										<input type='text' placeholder='Numeros fraçoões' name='nFracao' required/>
									</div>
									<div class='large-4 columns'>
										<label for='rota'> Rota do condominio </label>
										<input type='text' placeholder='Rota do condominio' name='rota' required/>
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
		$res = $da->getCondominio($id);
		if (mysqli_num_rows($res) > 0){
			$row = mysqli_fetch_object($res);
			echo"
				<div class='row' style='position:relative; top:10%'>
					<div class='large-2 columns'>
						&nbsp;
					</div>
					<div class='row'>
						<div class='large-8 end panel radius columns'>
							<form method='post' action='Condominios.php'>
								<fieldset>
									<legend> Editar Condominio </legend>
									<div class='row'>
										<div class='large-12 columns'>
											<input type='hidden' id='id' name='id' value='$row->id'/>
										</div>
									</div>
									<div class='row'>
										<div class='large-6 columns'>
											<label for='moradaedit'> Morada do condomino </label>
											<input type='text' placeholder='Morada do condomino' value='". $row->morada ."' name='moradaedit' required/>
										</div>
										<div class='large-6 columns'>
											<label for='codigoPostaledit'> Código postal </label>
											<input type='text' placeholder='Código postal' value='". $row->codigoPostal ."' name='codigoPostaledit' required/>
										</div>
									</div>
									<div class='row'>
										<div class='large-6 columns'>
											<label for='contribuintedit'> Numero de contribuinte </label>
											<input type='text' placeholder='Numero de contribuinte' value='". $row->contribuinte ."' name='contribuintedit' maxlength='9' required/>
										</div>
										<div class='large-6 columns'>
											<label for='freguesiaedit'> Freguesia do condominio </label>
											<input type='text' placeholder='Freguesia do condominio' value='". $row->freguesia ."' name='freguesiaedit' required/>
										</div>
										
									</div>
									<div class='row'>
										<div class='large-4 columns'>
											<label for='nLampadasedit'> Numero de Lampadas </label>
											<input type='text' placeholder='Numero de Lampadas' value='". $row->nLampadas ."' name='nLampadasedit' required/>
										</div>
										<div class='large-4 columns'>
											<label for='nFracaoedit'> Numero de fraçoões </label>
											<input type='text' placeholder='Numero de fraçoões' value='". $row->nFracao ."' name='nFracaoedit' required/>
										</div>
										<div class='large-4 columns'>
											<label for='rotaedit'> Rota do condominio </label>
											<input type='text' placeholder='Rota do condominio' value='". $row->rota ."' name='rotaedit' required/>
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