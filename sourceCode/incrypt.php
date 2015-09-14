<?php
	if (isset($_POST['word'])){
		//tentar efetuar login
		$word = md5($_POST['word']); //md5 serve para encriptar a password
		echo "<script>alert('".$word."');</script>";
	}
?>
<!doctype html>
<html class="no-js" lang="en">
	<head>
		<title>Certifácil</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="shortcut icon" type="image/ico" href="foundation/img/LogoCertifacil.ico"/>
		<link rel="stylesheet" href="foundation/css/foundation.css" />
		<link rel='stylesheet' href='http://foundation3.zurb.com/docs/assets/normalize.css'/>
		<script src="http://foundation3.zurb.com/docs/assets/vendor/custom.modernizr.js"></script>
	</head>
	<body>
		<div class='row' style='position:relative; top:10%' id='divLogin'>
			<div class='large-4 columns'>
				&nbsp;
			</div>
			<div class='row'>
				<div class='large-4 end panel callout radius columns'>
					<form method='post' action='incrypt.php'>
						<div class='row'>
							<div class='large-12 columns'>
								<input type='text' placeholder='Nome do Utilizador' name='word' required/>
							</div>
						</div>
						<div class='row'>
							<div class='large-5 large-centered columns'>
								<input type='submit' value='Encrypt' class='button round'/>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<?php include_once('importarScript2.php'); ?>
	</body>
</html>