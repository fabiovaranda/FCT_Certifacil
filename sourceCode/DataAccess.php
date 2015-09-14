<?php
	class DataAccess{
		private $connection;
		
		#region Base de Dados
		function connect(){
			$bd= "gestaocertifacil";
			$username = "root";
			$password = "";
			$server = "localhost";
			$this->connection = mysqli_connect($server,$username,$password,$bd);

			// Check connection
			if (mysqli_connect_errno())
			{
				echo "Failed to connect to MySQL: " . mysql_connect_error();
			}else{
				mysqli_query($this->connection, "set names 'utf8'");
				mysqli_query($this->connection, "set character_set_connection=utf8");
				mysqli_query($this->connection, "set character_set_client=utf8");
				mysqli_query($this->connection, "set character_set_results=utf8");
			}
		}
		function execute($query){
			$res = mysqli_query($this->connection, $query);
			if(!$res){
				die("Comando inválido".mysqli_error($this->connection));
			}else
				return $res;
		}
		function disconnect(){
			mysqli_close($this->connection);
		}
		function login($user, $passe){
			$query = "select * from utilizadores where nome = '$user' and palavrapasse = '$passe'";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		#endregion

		#region Dados da tabela Utilizador
		function inserirUser($nome, $pwd, $idTipo, $idestado){
			$query = "insert into utilizadores (nome, palavrapasse, id_tipoUtilizador, id_estado) values('$nome', '$pwd', $idTipo, $idestado)";
			$this->connect();
			$this->execute($query);       
			$this->disconnect();       
		}
		function atualizarUtilizador($id, $nome, $pwd){
			$query = "update utilizadores set nome = '$nome', palavrapasse = '$pwd' where id = $id";
			$this->connect();
			$this->execute($query);       
			$this->disconnect();       
		}
		function atualizarUser($id, $nome, $pwd, $idTipo, $idestado){
			$query = "update utilizadores set nome = '$nome', palavrapasse = '$pwd', id_tipoUtilizador = $idTipo, id_estado = $idestado where id = $id";
			$this->connect();
			$this->execute($query);       
			$this->disconnect();       
		}
		function getUser($id){
			$query = "select * from utilizadores where id = $id";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		function getallUser(){
			$query = "select * from utilizadores";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		function eliminarUtilizador($id){
			$query = "delete from utilizadores where id = ".$id;
			$this->connect();
			$this->execute($query);
			$this->disconnect();
		}		
		#endregion

		#region Dados da tabela Condominio
		function inserirCondominio($morada, $codigoPostal, $contribuinte, $nFracao, $nLampadas, $freguesia, $rota){
			$query = "insert into Condominios(morada, codigoPostal, contribuinte, nFracao, nLampadas, freguesia, rota) values ('$morada', '$codigoPostal', $contribuinte, $nFracao, $nLampadas, '$freguesia', '$rota')";
			$this->connect();
			$this->execute($query);
			$this->disconnect();
		}
		function atualizarCondominio($id, $morada, $codigoPostal, $contribuinte, $nFracao, $nLampadas, $freguesia, $rota){
			$query = "update Condominios set morada = '$morada', codigoPostal = '$codigoPostal', contribuinte = $contribuinte, nFracao = $nFracao, nLampadas = $nLampadas, freguesia = '$freguesia', rota = '$rota' where id = $id";
			$this->connect();
			$this->execute($query);       
			$this->disconnect();       
		}
		function atualizarCondominionlampadas($id,$nLampadas){
			$query = "update Condominios set nLampadas = '$nLampadas' where id = $id";
			$this->connect();
			$this->execute($query);       
			$this->disconnect();       
		}
		function getCondominionlampadas($id){
			$query = "select nLampadas from Condominios where id = $id";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		function getCondominio($id){
			$query = "select * from Condominios where id = $id";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		function getallCondominio(){
			$query = "select * from Condominios";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		#endregion

		#region Dados da tabela Vistoria
		function inserirVistoria($data, $vistoria, $nMovimentos, $id_condominio, $id_utilizador){
			$query = "insert into vistorias(data, vistoria, nMovimentos, id_condominio, id_utilizador) values ('$data', '$vistoria', $nMovimentos, $id_condominio, $id_utilizador)";
			$this->connect();
			$this->execute($query);       
			$this->disconnect();       
		}
		function atualizarVistoria($data, $vistoria, $nMovimentos, $id_condominio, $id_utilizador){
			$query = "update vistorias set data = '$data', vistoria = '$vistoria',  nMovimentos = $nMovimentos, id_condominio = $id_condominio, id_utilizador = $id_utilizador where id = $id";
			$this->connect();
			$this->execute($query);       
			$this->disconnect();       
		}
		function getVistoria($id){
			$query = "select V.*, U.nome, C.morada from Vistorias V inner join Utilizadores U inner join Condominios C where V.id = $id and C.id = V.id_condominio and U.id = V.id_utilizador";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		function getallVistoria(){
			$query = "select V.*, U.nome, U.id_tipoUtilizador, C.morada from Vistorias V inner join Utilizadores U inner join Condominios C where C.id = V.id_condominio and U.id = V.id_utilizador";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		function getallVistoriadados($Condominio){
			$query = "select V.*, U.nome, U.id_tipoUtilizador, C.morada from Vistorias V inner join Utilizadores U inner join Condominios C where V.id_condominio = $Condominio and C.id = V.id_condominio and U.id = V.id_utilizador";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		#endregion

		#region Dados da tabela Reuniao
		function inserirReuniao($data, $hora, $local, $id_condominio, $representante, $id_utilizador){
			$query = "insert into Reunioes(data, hora, local, id_condominio, representante, id_utilizador) values ('$data', '$hora', '$local', $id_condominio, $representante, $id_utilizador)";
			$this->connect();
			$this->execute($query);       
			$this->disconnect();       
		}
		function atualizarReuniao($id, $data, $hora, $local, $id_condominio, $representante, $id_utilizador){
			$query = "update Reunioes set data = '$data', hora = '$hora', local = '$local', id_condominio = $id_condominio, representante = $representante, id_utilizador = $id_utilizador where id = $id";
			$this->connect();
			$this->execute($query);       
			$this->disconnect();       
		}
		function getReuniao($id){
			$query = "select R.*, U.nome, UR.nome as RepNome, C.morada from Reunioes R inner join Utilizadores U inner join Utilizadores UR inner join Condominios C where R.id = $id and U.id = R.id_utilizador and UR.id = R.representante and C.id = R.id_condominio";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		function getallReuniao(){
			$query = "select R.*, U.nome, UR.nome as RepNome, C.morada from Reunioes R inner join Utilizadores U inner join Utilizadores UR inner join Condominios C where U.id = R.id_utilizador and UR.id = R.representante and C.id = R.id_condominio";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		function getallReuniaodados($condominio){
			$query = "select R.*, U.nome, UR.nome as RepNome, C.morada from Reunioes R inner join Utilizadores U inner join Utilizadores UR inner join Condominios C where R.id_condominio = $condominio and U.id = R.id_utilizador and UR.id = R.representante and C.id = R.id_condominio";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		#endregion

		#region Dados da tabela Fracao
		function inserirFracao($nome, $piso, $porta, $id_tipofracao, $id_condominio, $id_condomino, $id_inquilino){
			$query = "insert into Fracoes(nome, piso, porta, id_tipofracao, id_condominio, id_condomino, id_inquilino) values ('$nome', '$piso', '$porta', $id_tipofracao, $id_condominio, $id_condomino, $id_inquilino)";
			$this->connect();
			$this->execute($query);
			$this->disconnect();
		}
		function actualizarFracao($id, $nome, $piso, $porta, $id_tipofracao, $id_condominio, $id_condomino, $id_inquilino){
			$query = "update Fracoes set nome = '$nome', piso = '$piso', porta = '$porta', id_tipofracao = $id_tipofracao, id_condominio = $id_condominio, id_condomino = $id_condomino, id_inquilino = $id_inquilino where id = $id";
			$this->connect();
			$this->execute($query);
			$this->disconnect();
		}
		function getfracao($id){
			$query = "select C.id as idCondomino, F.*, TF.tipo, C.nome as Cnome from Fracoes F inner join TiposFracoes TF inner join Condominos C
			where F.id_condominio = $id and TF.id = F.id_tipofracao and C.id = F.id_condomino";
			//echo $query;
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		function getafracao($id){
			$query = "select F.*, TF.tipo, C.nome as Cnome, I.nome as Inqnome from Fracoes F inner join TiposFracoes TF inner join Condominos C inner join Inquilinos I 
			where F.id = $id and TF.id = F.id_tipofracao and C.id = F.id_condomino";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		function getallfracao(){
			$query = "select F.*, TF.tipo, C.nome as Cnome from Fracoes F inner join TiposFracoes TF inner join Condominos C where TF.id = F.id_tipofracao and C.id = F.id_condomino";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		function getfracoes($id){
			$query = "select * from Fracoes where id_condominio = $id";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		function eliminarfracao($id){
			$query = "delete from Fracoes where id = ".$id;
			$this->connect();
			$this->execute($query);
			$this->disconnect();
		}
		#endregion

		#region Dados da tabela Inquilino
		function inserirInquilino($nome, $dataNascimento, $contato, $email, $contribuinte, $id_procurador){
			$query = "insert into inquilinos(nome, dataNascimento, contato, email, contribuinte, id_procurador) values ('$nome', '$dataNascimento', $contato, '$email', $contribuinte, $id_procurador)";
			$this->connect();
			$this->execute($query);
			$this->disconnect();
		}
		function actualizarInquilino($id, $nome, $dataNascimento, $contato, $email, $contribuinte, $id_procurador){
			$query = "update Inquilinos set nome = '$nome', dataNascimento = '$dataNascimento', contato = $contato, email = '$email', contribuinte = $contribuinte, id_procurador = $id_procurador where id = $id";
			$this->connect();
			$this->execute($query);
			$this->disconnect();
		}
		function getInquilino($id){
			$query = "select * from Inquilinos where id = $id";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		function getallInquilino(){
			$query = "select * from Inquilinos";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		function eliminarInquilino($id){
			$query = "delete from Inquilinos where id = ".$id;
			$this->connect();
			$this->execute($query);
			$this->disconnect();
		}
		#endregion

		#region Dados da tabela Condomino
		function inserirCondomino($nome, $contato, $email, $morada, $dataNascimento, $contribuinte){
			$query = "insert into Condominos(nome, contato, email, morada, dataNascimento, contribuinte) values ('$nome', $contato, '$email', '$morada', '$dataNascimento', $contribuinte)";
			$this->connect();
			$this->execute($query);
			$this->disconnect();
		}
		function actualizarCondomino($id, $nome, $contato, $email, $morada, $dataNascimento, $contribuinte){
			$query = "update Condominos set nome = '$nome', contato = $contato, email = '$email', morada = '$morada', dataNascimento = '$dataNascimento', contribuinte = $contribuinte where id = $id";
			$this->connect();
			$this->execute($query);
			$this->disconnect();
		}
		function getCondominoFracao($idFracao){
			$query = "select id_condomino from fracoes where id = $idFracao";
			$this->connect();
			$res = $this->execute($query);
			$row = mysqli_fetch_object($res);
			$query = "select * from Condominos where id = $row->id_condomino";
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		function getCondomino($id){
			$query = "select * from Condominos where id = $id";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		function getallCondomino(){
			$query = "select * from Condominos";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		function eliminarCondomino($id){
			$query = "delete from Condominos where id = ".$id;
			$this->connect();
			$this->execute($query);
			$this->disconnect();
		}
		#endregion

		#region Dados da tabela Procurador
		function inserirProcurador($nome, $morada, $codigoPostal, $contato, $contribuinte, $dataNascimento){
			$query = "insert into Procuradores(nome, morada, codigoPostal, contato, contribuinte, dataNascimento) values ('$nome', '$morada', '$codigoPostal', $contato, $contribuinte, '$dataNascimento')";
			$this->connect();
			$this->execute($query);
			$this->disconnect();
		}
		function actualizarProcurador($id, $nome, $morada, $codigoPostal, $contato, $contribuinte, $dataNascimento){
			$query = "update Procuradores set nome = '$nome', morada = '$morada', codigoPostal = '$codigoPostal', contato = $contato, contribuinte = $contribuinte, dataNascimento = '$dataNascimento' where id = $id";
			$this->connect();
			$this->execute($query);
			$this->disconnect();
		}
		function getProcurador($id){
			$query = "select * from Procuradores where id = $id";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		function getallProcurador(){
			$query = "select * from Procuradores";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		function eliminarProcurador($id){
			$query = "delete from Procuradores where id = ".$id;
			$this->connect();
			$this->execute($query);
			$this->disconnect();
		}
		#endregion

		#region Dados da tabela MovLampada
		function inserirMovLampada($stock, $data, $acao, $numero, $descricao, $id_vistoria){
			$query = "insert into MovLampadas(stock, data, acao, numero, descricao, id_vistoria) values ($stock, '$data', '$acao', $numero, '$descricao', $id_vistoria)";
			$this->connect();
			$this->execute($query);
			$this->disconnect();
		}
		function actualizarMovLampada($id, $stock, $data, $acao, $numero, $descricao, $id_vistoria){
			$query = "update MovLampadas set stock = $stock, data = '$data', acao = '$acao', numero = $numero, descricao = '$descricao', id_vistoria = $id_vistoria where id = $id";
			$this->connect();
			$this->execute($query);
			$this->disconnect();
		}
		function getMovLampada($id, $data){
			$query = "select * from MovLampadas where id = $id and data = '$data'";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
		#endregion

		function getalltipofracao(){
			$query = "select * from tiposfracoes";
			$this->connect();
			$res = $this->execute($query);
			$this->disconnect();
			return $res;
		}
	}
?>