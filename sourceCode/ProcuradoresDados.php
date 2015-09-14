<?php include_once('verificacaoDeSessao.php');?><?php include_once('verificacaoDeUser.php'); ?>

<script>
    function confirmacaoEliminacao(i){
        if(confirm('Tem a certeza que deseja eliminar?')){
            window.location='eliminarProcurador.php?i='+i;
        }
    }
</script>

<?php
	function Criar(){
		echo"
			<div class='row' style='position:relative; top:10%'>
				<div class='large-2 columns'>
					۩
						<a href='Procuradores.php'> Procuradores </a>
					۩
				</div>
				<div class='row'>
					<div class='large-8 end panel radius columns'>
						<form method='post' action='Procuradores.php'>
							<fieldset>
								<legend> Criar procurador </legend>
								<div class='row'>
									<div class='large-12 columns'>
										<label for='nome'> Nome do procurador </label>
										<input type='text' placeholder='Nome do procurador' name='nome' required/>
									</div>
								</div>
								<div class='row'>
									<div class='large-6 columns'>
										<label for='morada'> Morada do procurador </label>
										<input type='text' placeholder='Morada do procurador' name='morada' required/>
									</div>
									
									<div class='large-6 columns'>
										<label for='codigoPostal'> Código postal </label>
										<input type='text' placeholder='Código postal' name='codigoPostal' required/>
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
									<div class='large-12 columns'>
										<label for='dataNascimento'> Data de nascimento </label>
										<input type='date' placeholder='Data de nascimento' name='dataNascimento' required/>
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
		$res = $da->getProcurador($id);
		if (mysqli_num_rows($res) > 0){
			$row = mysqli_fetch_object($res);
			echo"
				<div class='row' style='position:relative; top:10%'>
					<div class='large-2 columns'>
						۩
							<a href='Procuradores.php'> Procuradores </a>
						۩
					</div>
					<div class='row'>
						<div class='large-8 end panel radius columns'>
							<form method='post' action='Procuradores.php'>
								<fieldset>
									<legend>Editar procurador " . $row->nome . "</legend>
									<div class='row'>
										<div class='large-12 columns'>
											<input type='hidden' id='id' name='id' value='$row->id'/>
											<label for='nomedit'> Nome do procurador </label>
											<input type='text' placeholder='Nome do procurador' value='". $row->nome ."' name='nomedit' required/>
										</div>
									</div>
									<div class='row'>
										<div class='large-6 columns'>
											<label for='moradaedit'> Morada do procurador </label>
											<input type='text' placeholder='Morada do procurador' value='". $row->morada ."' name='moradaedit' required/>
										</div>
										<div class='large-6 columns'>
											<label for='codigoPostaledit'> Código Postal </label>
											<input type='text' placeholder='Código Postal' value='". $row->codigoPostal ."' name='codigoPostaledit' maxlength='8' required/>
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
										<div class='large-12 columns'>
											<label for='dataNascimentoedit'> Data de nascimento </label>
											<input type='date' placeholder='Data de nascimento' value='". $row->dataNascimento ."' name='dataNascimentoedit' required/>
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