<div class='row' style='position:relative; top:10%'>
	<div class='large-1 columns'>
		&nbsp;
	</div>
	<div class='row'>
		<div class='large-12 end panel callout radius columns'>
			<table>
				<thead>
				<tr>
					<th class='large-2'>morada</th>
					<th class='large-1'>codigoPostal</th>
					<th class='large-2'>contribuinte</th>
					<th class='large-1'>nFracao</th>
					<th class='large-1'>nLampadas</th>
					<th class='large-2'>freguesia</th>
					<th class='large-1'>rota</th>
					<?php
						$ras = $da->getUser($_SESSION['id']);
						if (mysqli_num_rows($ras) > 0){
							$roo = mysqli_fetch_object($ras);
							if($roo->id_tipoUtilizador == 1){
								echo"<th class='large-2'>Editar</th>";
							}
						}
					?>
				</tr>
				</thead>
				<tbody>
					<?php
						include_once('DataAccess.php');
						$da = new DataAccess();
						$res = $da->getallCondominio();
						if (mysqli_num_rows($res) > 0){
							while($row = mysqli_fetch_object($res)){
								echo "
									<tr>
										
											<td>" . $row->morada . "</td>
											<td>" . $row->codigoPostal . "</td>
											<td>" . $row->contribuinte . "</td>
											<td>
												<a href='Fracoes.php?h=" . $row->id . "'>" . $row->nFracao . "</a>
											</td>
											<td>" . $row->nLampadas . "</td>
											<td>" . $row->freguesia . "</td>
											<td>" . $row->rota . "</td>
										
											<td>
								";
											$ras = $da->getUser($_SESSION['id']);
											if (mysqli_num_rows($ras) > 0){
												$roo = mysqli_fetch_object($ras);
												if($roo->id_tipoUtilizador == 1){
													echo"<a href='CondominiosDados.php?h=" . $row->id . "'><img src='foundation/img/Editar.png'/></a>";
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
			<?php
				if($roo->id_tipoUtilizador == 1){
					echo"
						<div class='row'>
							<div class='large-2 large-centered columns'>
								<a href='CondominiosDados.php' class='button round'>Criar novo Condominio</a>
							</div>
						</div>
					";
				}
			?>
		</div>
	</div>
</div>