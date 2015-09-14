<?php include_once('verificacaoDeSessao.php');?><?php include_once('verificacaoDeUser.php'); ?>

<script>
    function confirmacaoEliminacao(i){
        if(confirm('Tem a certeza que deseja eliminar?')){
            window.location='eliminaruser.php?i='+i;
        }
    }
	
	function confirmarPWD(){	
		if ( document.getElementById('password').value == document.getElementById('password1').value ){
			return true;
		}else{
			alert('As palavras-passe têm que ser iguais.');
			return false;
		}
	}
</script>

<?php
	function Criar(){
		echo"
			<div class='row' style='position:relative; top:10%'>
				<div class='large-2 columns'>
					۩
						<a href='Utilizadores.php'> Utilizadores </a>
					۩
				</div>
				<div class='large-8 end panel callout radius columns'>
					<form method='post' onsubmit='return confirmarPWD()' action='Utilizadores.php'>
						<fieldset>
							<legend>Criar Novo Utilizador</legend>
							<div class='row'>
								<div class='large-12 columns'>
									<input type='text' placeholder='Nome do Utilizador' name='nome' id='nome' required/>
								</div>
							</div>
							<div class='row'>
								<div class='large-6 columns'>
									<input type='password' placeholder='Palavra-Passe' name='password' id='password' required/>
								</div>
								<div class='large-6 columns'>
									<input type='password' placeholder='Repita Palavra-Passe' name='password1' id='password1' required/>
								</div>
							</div>
							<div class='row'>
								<div class='large-3 columns'>
									&nbsp;
								</div>
								<div class='large-2 columns'>
									<label>Utilizador</label>
								</div>
								<div class='large-2 columns'>
									<div class='switch round'>
										<input id='tipouser' name='tipouser' type='checkbox'>
										<label for='tipouser'></label>
									</div>
								</div>
								<div class='large-2 end columns'>
									<label>Administrador</label>
								</div>
							</div>
							<div class='row'>
								<div class='large-3 columns'>
									&nbsp;
								</div>
								<div class='large-2 columns'>
									<label>Inativo</label>
								</div>
								<div class='large-2 columns'>
									<div class='switch round'>
										<input id='estado' name='estado' type='checkbox' checked>
										<label for='estado'></label>
									</div>
								</div>
								<div class='large-2 end columns'>
									<label>Ativo</label>
								</div>
							</div>
							<div class='row'>
								<div class='large-3 large-centered columns'>
									<input type='submit' value='Criar' class='button round'/>
								</div>
							</div>
						</fieldset>
					</form>	
				</div>	
			</div>
		";
	}
	
	function Editar($id){
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->getUser($id);
		//Se a variável $res tiver resultados, significa que o login foi efetuado com sucesso
		if (mysqli_num_rows($res) > 0){
			$row = mysqli_fetch_object($res);
			echo"
				<div class='row' style='position:relative; top:10%'>
					<div class='large-2 columns'>
						۩
							<a href='Utilizadores.php'> Utilizadores </a>
						۩
					</div>
					<div class='large-8 end panel callout radius columns'>
						<form method='post' action='Utilizadores.php'>
							<fieldset>
								<legend>Editar Utilizador " . $row->nome . "</legend>
								<div class='row'>
									<div class='large-12 columns'>
										<label>Preencha apenas este campo caso o utilizador não se lembre da sua palavra-passe</label>
										<input type='password' placeholder='Palavra-Passe' name='password' id='password'/>
										<input type='hidden' id='id' name='id' value='$row->id'/>
										<input type='hidden' id='nome' name='nomedit' value='$row->nome'/>
										<input type='hidden' id='oldPassword' name='oldPassword' value='$row->palavrapasse'/>
									</div>
								</div>
								<div class='row'>
									<div class='large-2 columns'>
										&nbsp;
									</div>
									<div class='large-2 columns'>
										<label>Utilizador</label>
									</div>
									<div class='large-2 columns'>
										<div class='switch round'>";
										  if($row->id_tipoUtilizador == 1){
		echo" 
											<input id='tipouser' name='tipouser' type='checkbox' checked>
											<label for='tipouser'></label>
		";
										  }else{
		echo"
											<input id='tipouser' name='tipouser' type='checkbox'>
											<label for='tipouser'></label>
		";
										  }
		echo"  
										</div>
									</div>
									<div class='large-2 end columns'>
										<label>Administrador</label>
									</div>
								</div>
								
								<div class='row'>
									<div class='large-2 columns'>
										&nbsp;
									</div>
									<div class='large-2 columns'>
										<label>Inativo</label>
									</div>
									<div class='large-2 columns'>
										<div class='switch round'>
		";
										  if($row->id_estado == 1){
		echo"
											<input id='estado' name='estado' type='checkbox' checked>
											<label for='estado'></label>
		";
										  }else{
		echo"
											<input id='estado' name='estado' type='checkbox'>
											<label for='estado'></label>
		";
										  }
		echo"  
										</div>
									</div>
									<div class='large-2 end columns'>
										<label>Ativo</label>
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