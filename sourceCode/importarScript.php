<!-- Para colocar o titulo nas páginas-->
<title>Certifácil</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<!-- Para colocar o favicon -->
<link rel="shortcut icon" type="image/ico" href="foundation/img/LogoCertifacil.ico"/>
<!-- Para colocar as propriedades que todas as páginas devem ter -->
<link rel="stylesheet" href="foundation/css/foundation.css" />
<link rel='stylesheet' href='http://foundation3.zurb.com/docs/assets/normalize.css'/>
<script src="http://foundation3.zurb.com/docs/assets/vendor/custom.modernizr.js"></script>


<!-- Para colocar a imagem da Empresa no cima das paginas -->
<div class='row' style='position:relative; top:5%'>	
	<div class='large-4 columns'>
		<a href="index.php"><img src="foundation/img/LogoCertifacil.png"/></a>
	</div>
	<div class='row'>
		<div class='large-4 end columns'>
			<form method='post' action='index.php'>
				<div class='row'>
					<?php
						
						if(isset($_SESSION['id'])){
							include_once('DataAccess.php');
							$da = new DataAccess();
							$res = $da->getUser($_SESSION['id']);
							//Se a variável $res tiver resultados, significa que o login foi efetuado com sucesso
							if (mysqli_num_rows($res) > 0){
								$row = mysqli_fetch_object($res);
								echo "
									<div class='large-12 large-centered columns'>
										<h3>Bem Vindo <a href='Perfil.php'>" . $row->nome . "</a></h3>
									</div>
								";
							}
						}
					?>
				</div>
			</form>
		</div>
	</div>
</div>