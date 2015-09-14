<div class='row' style='position:relative; top:10%'>
	<div class='large-1 columns'>
		&nbsp;
	</div>
	<div class='row'>
		<div class='large-12 panel callout radius columns'>
			<table>
				<thead>
				<tr>
				<th class='large-2'>Utilizador</th>
				<th class='large-2'>Condominio</th>
				<th class='large-1'>Data</th>
				<th class='large-6'>Descrição</th>
				<th class='large-1'>Editar</th>
				</tr>
				</thead>
				<tbody>
					<?php
						include_once('DataAccess.php');
						$da = new DataAccess();
						$res = $da->getallVistoria();
						if (mysqli_num_rows($res) > 0){
							while($row = mysqli_fetch_object($res)){
								echo "
									<tr>
										<td>" . $row->nome . "</td>
										<td>" . $row->morada . "</td>
										<td>" . $row->data . "</td>
										<td>" . $row->vistoria . "</td>
										<td>";
											$ras = $da->getUser($_SESSION['id']);
											if (mysqli_num_rows($ras) > 0){
												$roo = mysqli_fetch_object($ras);
												if($row->id_utilizador == $_SESSION['id'] || $roo->id_tipoUtilizador == 1){
													echo"<a href='VistoriasDados.php?h=" . $row->id . "'><img src='foundation/img/Editar.png'/></a>";
												}
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
					<a href='VistoriasDados.php' class='button round'>Criar nova Vistoria</a>
				</div>
			</div>
		</div>
	</div>
</div>