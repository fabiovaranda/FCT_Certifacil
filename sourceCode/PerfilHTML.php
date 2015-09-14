<?php
	if(isset($_SESSION['id'])){
		include_once('DataAccess.php');
		$da = new DataAccess();
		$res = $da->getUser($_SESSION['id']);
		//Se a variável $res tiver resultados, significa que o login foi efetuado com sucesso
		if (mysqli_num_rows($res) > 0){
			$row = mysqli_fetch_object($res);
			echo "
				<div class='row' style='position:relative; top:10%'>
					<div class='large-2 columns'>
						&nbsp;
					</div>
					<div class='row'>
						<div class='large-8 end panel radius columns'>
							<form method='post' action='Perfil.php'>
								<input type='hidden' id='oldPassword' name='oldPassword' value='$row->palavrapasse'/>
								<div class='row'>
									<div class='large-12 columns'>
										<input type='text' placeholder='Utilizador' value='". $row->nome ."' name='useredit' required/>
									</div>
								</div>
								<div class='row'>
									<div class='large-12 columns'>
										<input type='password' placeholder='Palavra-Passe Antiga' name='password' id='password'/>
									</div>
								</div>
								<div class='row'>
									<div class='large-6 columns'>
										<input type='password' placeholder='Nova Password' name='password1' id='password1'/>
									</div>
									<div class='large-6 columns'>
										<input type='password' placeholder='Repetir Nova Password' name='password2' id='password2'/>
									</div>
								</div>
								<div class='row'>
									<div class='large-2 large-centered columns'>
										 <input type='submit' value='Editar'/>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			";
		}
	}
?>