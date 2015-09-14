<?php include_once('verificacaoDeSessao.php'); ?><?php include_once('verificacaoDeUser.php'); ?>

<script>
    function confirmacaoEliminacao(i){
        if(confirm('Tem a certeza que deseja eliminar?')){
            window.location='eliminarinquilino.php?i='+i;
        }
    }
</script>

<?php
	function Criar(){
		echo"
			<div class='row' style='position:relative; top:10%'>
				<div class='large-2 columns'>
					۩
						<a href='Inquilinos.php'> Inquilinos </a>
					۩
				</div>
				<div class='row'>
					<div class='large-8 end panel radius columns'>
						<form method='post' action='Inquilinos.php'>
							<fieldset>
								<legend> Criar inquilino </legend>
								<div class='row'>
									<div class='large-12 columns'>
										<label for='nome'> Nome do inquilino </label>
										<input type='text' placeholder='Nome do inquilino' name='nome' required/>
									</div>
								</div>
								<div class='row'>
									<div class='large-6 columns'>
										<label for='contato'> Telemóvel/Telefone </label>
										<input type='text' placeholder='Telemóvel/Telefone' name='contato' maxlength='9' required/>
									</div>
									<div class='large-6 columns'>
										<label for='contribuinte'> Numero de contribuinte </label>
										<input type='text' placeholder='Numero de contribuinte' name='contribuinte' maxlength='9' required/>
									</div>
								</div>
								<div class='row'>
									<div class='small-8 columns'>
										<label for = 'procurador'>Selecione um procurador</label>
										<select name='procurador' id='procurador'>
											<option value = null> Sem Procurador </option>
		";
											include_once('DataAccess.php');
											$da = new DataAccess();
											$ras = $da->getallProcurador();
											if (mysqli_num_rows($ras) > 0){
												while($roo = mysqli_fetch_object($ras)){
													echo"<option value = '" . $roo->id ."'> " . $roo->nome . "</option>";
												}
											}
		echo"
										</select>
									</div>
									<div class='large-4 columns'>
										<label for='dataNascimento'> Data de nascimento </label>
										<input type='date' placeholder='Data de nascimento' name='dataNascimento' required/>
									</div>
								</div>
								<div class='row'>
									<div class='large-12 columns'>
										<label for='email'> Email do inquilino </label>
										<input type='text' placeholder='Email do inquilino' name='email' required/>
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
		$res = $da->getInquilino($id);
		if (mysqli_num_rows($res) > 0){
			$row = mysqli_fetch_object($res);
			echo"
				<div class='row' style='position:relative; top:10%'>
					<div class='large-2 columns'>
						۩
							<a href='Inquilinos.php'> Inquilinos </a>
						۩
					</div>
					<div class='row'>
						<div class='large-8 end panel radius columns'>
							<form method='post' action='Inquilinos.php'>
								<fieldset>
									<legend>Editar inquilino " . $row->nome . "</legend>
									<div class='row'>
										<div class='large-12 columns'>
											<input type='hidden' id='id' name='id' value='$row->id'/>
											<label for='nomedit'> Nome do inquilino </label>
											<input type='text' placeholder='Nome do inquilino' value='". $row->nome ."' name='nomedit' required/>
										</div>
									</div>
									<div class='row'>
										<div class='large-6 columns'>
											<label for='contatoedit'> Telemóvel/Telefone </label>
											<input type='text' placeholder='Telemóvel/Telefone' value='". $row->contato ."' name='contatoedit' maxlength='9' required/>
										</div>
										<div class='large-6 columns'>
											<label for='contribuintedit'> Numero de contribuinte </label>
											<input type='text' placeholder='Numero de contribuinte' value='". $row->contribuinte ."' name='contribuintedit' maxlength='9' required/>
										</div>
									</div>
									<div class='row'>
										<div class='small-8 columns'>
											<label for = 'procuradoredit'>Selecione um procurador</label>
											<select name='procuradoredit' id='procuradoredit'>
												<option value = null> Sem Procurador </option>
			";
												include_once('DataAccess.php');
												$da = new DataAccess();
												$ras = $da->getallProcurador();
												if (mysqli_num_rows($ras) > 0){
													while($roo = mysqli_fetch_object($ras)){
														if($row -> id_procurador == $roo->id){
															echo"<option value = '" . $roo->id ."'Selected> " . $roo->nome . "</option>";
														}else{
															echo"<option value = '" . $roo->id ."'> " . $roo->nome . "</option>";
														}
													}
												}
			echo"
											</select>
										</div>
										<div class='large-6 columns'>
											<label for='dataNascimentoedit'> Data de nascimento </label>
											<input type='date' placeholder='Data de nascimento' value='". $row->dataNascimento ."' name='dataNascimentoedit' required/>
										</div>
									</div>
									<div class='row'>
										<div class='large-12 columns'>
											<label for='emailedit'> Email do inquilino </label>
											<input type='text' placeholder='Email do inquilino' value='". $row->email ."' name='emailedit' required/>
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