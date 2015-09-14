<?php include_once('verificacaoDeSessao.php');?><?php include_once('verificacaoDeUser.php'); ?>

<script>
    function confirmacaoEliminacao(i){
        if(confirm('Tem a certeza que deseja eliminar?')){
            window.location='eliminarCondomino.php?i='+i;
        }
    }
</script>

<?php
	function Criar(){
		echo"
			<div class='row' style='position:relative; top:10%'>
				<div class='large-2 columns'>
					۩
						<a href='Condominos.php'> Condominos </a>
					۩
				</div>
				<div class='row'>
					<div class='large-8 end panel radius columns'>
						<form method='post' action='Condominos.php'>
							<fieldset>
								<legend> Criar Condomino </legend>
								<div class='row'>
									<div class='large-12 columns'>
										<label for='nome'> Nome do condomino </label>
										<input type='text' placeholder='Nome do condomino' name='nome' required/>
									</div>
								</div>
								<div class='row'>
									<div class='large-6 columns'>
										<label for='morada'> Morada do condomino </label>
										<input type='text' placeholder='Morada do condomino' name='morada' required/>
									</div>
									<div class='large-6 columns'>
										<label for='email'> Email do condomino </label>
										<input type='text' placeholder='Email do condomino' name='email' required/>
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
		$res = $da->getCondomino($id);
		if (mysqli_num_rows($res) > 0){
			$row = mysqli_fetch_object($res);
			echo"
				<div class='row' style='position:relative; top:10%'>
					<div class='large-2 columns'>
						۩
							<a href='Condominos.php'> Condominos </a>
						۩
					</div>
					<div class='row'>
						<div class='large-8 end panel radius columns'>
							<form method='post' action='Condominos.php'>
								<fieldset>
									<legend>Editar Condomino " . $row->nome . "</legend>
									<div class='row'>
										<div class='large-12 columns'>
											<input type='hidden' id='id' name='id' value='$row->id'/>
											<label for='nomedit'> Nome do condomino </label>
											<input type='text' placeholder='Nome do condomino' value='". $row->nome ."' name='nomedit' required/>
										</div>
									</div>
									<div class='row'>
										<div class='large-6 columns'>
											<label for='moradaedit'> Morada do condomino </label>
											<input type='text' placeholder='Morada do condomino' value='". $row->morada ."' name='moradaedit' required/>
										</div>
										<div class='large-6 columns'>
											<label for='emailedit'> Email do condomino </label>
											<input type='text' placeholder='Email do condomino' value='". $row->email ."' name='emailedit' required/>
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