<div class='row' style='position:relative; top:10%'>
	<div class='large-1 columns'>
		&nbsp;
	</div>
	<div class='row'>
		<div class='large-12 end panel callout radius columns'>
			<table class='large-12 end panel radius columns'>
				<thead>
					<tr>
						<th class='large-4'>Nome do utilizador</th>
						<th class='large-3'>Administrador/Utilizador</th>
						<th class='large-3'>Activo/Inactivo</th>
						<th class='large-2'>Editar</th>
					</tr>
				</thead>
				<tbody>
					<?php
						include_once('DataAccess.php');
						$da = new DataAccess();
						$res = $da->getallUser();
						if (mysqli_num_rows($res) > 0){
							while($row = mysqli_fetch_object($res)){
								echo "
									<tr>
										<td>" . $row->nome . "</td>
										<td>
								";
											if($row->id_tipoUtilizador == 1){
												echo"<label>Administrador</label>";
											}else{
												echo"<label>Utilizador</label>";
											}
								echo "
										</td>
										<td>
								";
											if($row->id_estado == 1){
												echo"<label>Ativo</label>";
											}else{
												echo"<label>Inativo</label>";
											}
								echo "
										</td>
										<td>
								";
											if($row->id != $_SESSION['id']){
												echo"<a href='UtilizadoresDados.php?h=" . $row->id . "'><img src='foundation/img/Editar.png'/></a>";
											}
								echo"
											
										</td>
									</tr>
									
								";
							}
						}
					?>
				</tbody>
			</table>
			<div class='row'>
				<div class='large-2 large-centered columns'>
					<a href='UtilizadoresDados.php' class='button round'>Criar novo Utilizador</a>
				</div>
			</div>
		</div>
	</div>
</div>