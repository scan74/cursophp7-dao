<?php

class Usuario{

	private $idusuario;
	private $deslogin;
	private $dessenha;
	private $dtcadastro;

	public function getIdusuario(){
		return $this->idusuario;
	}

	public function setIdusuario($valor){
		$this->idusuario = $valor;
	}

	public function getDeslogin(){
		return $this->deslogin;
	}

	public function setDeslogin($valor){
		$this->deslogin = $valor;
	}

	public function getDessenha(){
		return $this->dessenha;
	}

	public function setDessenha($valor){
		$this->dessenha = $valor;
	}

	public function getDtcadastro(){
		return $this->dtcadastro;
	}

	public function setDtcadastro($valor){
		$this->dtcadastro = $valor;
	}

	public function loadById($id){
		
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE idusuario = :ID", array(":ID"=>$id));
		
		//Alimentando (setando) as variaveis com o sets
		if (count($results) > 0)
		{
			$this->setDados($results[0]);
		}
		//else
	 	//{
		//	echo "Usuario não existe";
		//}

	}

	public static function getList(){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios ORDER BY deslogin");

	}

	public static function busca($login){
		$sql = new Sql();
		return $sql->select("SELECT * FROM tb_usuarios WHERE deslogin LIKE :TEXTO ORDER BY deslogin", array(":TEXTO"=>"%".$login."%"));
	}

	public function login($usuario, $senha){
		$sql = new Sql();
		$results = $sql->select("SELECT * FROM tb_usuarios WHERE deslogin = :USUARIO AND dessenha = :SENHA", array(
			":USUARIO"=>$usuario, 
			":SENHA"=>$senha
		));
		
		//Alimentando (setando) as variaveis com o sets
		if (count($results) > 0)
		{
			$this->setDados($results[0]);
		}
		else
		{
			throw new Exception("login ou senha invalidos");
		}


	}

	public function setDados($dados){
			$this->setIdusuario($dados['idusuario']); 
			$this->setDeslogin($dados['deslogin']); 
			$this->setDessenha($dados['dessenha']); 
			$this->setDtcadastro(new DateTime($dados['dtcadastro'])); 
	}

	public function insert(){

		$sql = new Sql();
		//CALL chama a procedure sp_usuario_insert, que nós criamos
		//no mysql
		$results = $sql->select("CALL sp_usuarios_insert(:LOGIN, :PASSWORD)", array(
			":LOGIN"=>$this->getDeslogin(),
			":PASSWORD"=>$this->getDessenha()
		));

		if (count($results) > 0)
		{
			$this->setDados($results[0]);
		}

	}

	public function update($usuario, $senha){
		
		$this->setDeslogin($usuario);
		$this->setDessenha($senha);

		$sql = new Sql();
		$sql->query("UPDATE tb_usuarios SET deslogin = :USUARIO, dessenha = :SENHA WHERE idusuario = :ID", array(
			":USUARIO"=>$this->getDeslogin(),
			":SENHA"=>$this->getDessenha(),
			":ID"=>$this->getIdusuario()
			));
	}

	//usando ="" torna os parametros NAO obrigatorios. Se eu passar ele usa,
	//se eu nao passar paramentros ele nao vai dar erro
	public function __construct($usuario = "", $senha = ""){
		$this->setDeslogin($usuario);
		$this->setDessenha($senha);
	}

	//esse metodo é executado quando damos um echo no objeto e em vez
	//de mostrar o echo, ele executa o __toString
	public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y H:i:s")
		));
	}

}


?>