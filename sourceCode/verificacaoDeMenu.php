<script>
	function confirmarSair(){
		return confirm('Tem a certeza?');
	}
</script>

<script type="text/javascript">
	$(document).foundation();
</script>

<?php
	
	if(isset($_SESSION['id'])){
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->getUser($_SESSION['id']);
		//Se a variável $res tiver resultados, significa que o login foi efetuado com sucesso
		if (mysqli_num_rows($res) > 0){
			$row = mysqli_fetch_object($res);
			if($row->id_tipoUtilizador == 1){
				echo"
					<div class='row' style='position:relative; top:5%' id='divMenuAdmin'>
						<div class='row'>
							<div class='large-12 columns'>
								<ul class='button-group round even-4'>
									<li><a href='Condominios.php' class='button round'>Condominios</a></li>
									<li><a href='Reunioes.php' class='button round'>Reunioes</a></li>
									<li><a href='Vistorias.php' class='button round'>Vistorias</a></li>
									<li><a data-dropdown='drop1' class='round button dropdown'>Definicoes</a></li>
								</ul>
								<ul id='drop1' data-dropdown-content class='f-dropdown'>
									<li><a href='Perfil.php'>Perfil</a></li>
									<li><a href='Utilizadores.php'>Utilizadores</a></li>
									<li><a href='Fracoes.php'>Fracoes</a></li>
									<li><a href='Condominos.php'>Condominos</a></li>
									<li><a href='Inquilinos.php'>Inquilinos</a></li>
									<li><a href='Procuradores.php'>Procuradores</a></li>
									<li><a onclick='return confirmarSair()' href='Logout.php'>Sair</a></li>
								</ul>
							</div>
						</div>
					</div>
				";
			}
			else//2=User
			{
				echo"
					<div class='row' style='position:relative; top:5%' id='divMenuUser'>
						<div class='row'>
							<div class='large-12 columns'>
								<ul class='button-group round even-4'>
									<li><a href='Condominios.php' class='button round'>Condominios</a></li>
									<li><a href='Reunioes.php' class='button round'>Reunioes</a></li>
									<li><a href='Vistorias.php' class='button round'>Vistorias</a></li>
									<li><a data-dropdown='drop1' class='round button dropdown'>Definicoes</a></li>
								</ul>
								<ul id='drop1' data-dropdown-content class='f-dropdown'>
									<li><a href='Perfil.php'>Perfil</a></li>
									<li><a onclick='return confirmarSair()' href='Logout.php'>Sair</a></li>
								</ul>
							</div>
						</div>
					</div>
				";
			}
		}
	}
?>