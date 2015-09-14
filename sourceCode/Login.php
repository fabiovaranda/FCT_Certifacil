<div class='row' style='position:relative; top:10%' id='divLogin'>
	<div class='large-4 columns'>
		&nbsp;
	</div>
	<div class='row'>
		<div class='large-4 end panel callout radius columns'>
			<form method='post' action='index.php'>
				<div class='row'>
					<div class='large-12 columns'>
						<input type='text' placeholder='Nome do Utilizador' name='user' required/>
					</div>
				</div>
				<div class='row'>
					<div class='large-12 columns'>
						<input type='password' placeholder='Palavra-Passe' name='passe' required/>
					</div>
				</div>
				<div class='row'>
					<div class='large-5 large-centered columns'>
						<input type='submit' value='Entrar' class='button success round'/>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!--
if (isset($_POST['data'])){
		echo "<script>alert('".$_POST['data']."');</script>";
	}

<input type='time' id = 'data' name='data' required>
<input type='date' id = 'data' name='data' required>
<input type='submit' value='Editar' class='button'/>
-->
