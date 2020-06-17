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
		if (count($results) > 0){
			$row = $results[0];
			$this->setIdusuario($row['idusuario']); 
			$this->setDeslogin($row['deslogin']); 
			$this->setDessenha($row['dessenha']); 
			$this->setDtcadastro(new DateTime($row['dtcadastro'])); 

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
		if (count($results) > 0){
			$row = $results[0];
			$this->setIdusuario($row['idusuario']); 
			$this->setDeslogin($row['deslogin']); 
			$this->setDessenha($row['dessenha']); 
			$this->setDtcadastro(new DateTime($row['dtcadastro'])); 

		}
		else
		{
			throw new Exception("login ou senha invalidos");
		}


	}

	//esse metodo é executado quando damos um echo no objeto e em vez
	//de mostrar o echo, ele executa o __toString
	public function __toString(){
		return json_encode(array(
			"idusuario"=>$this->getIdusuario(),
			"deslogin"=>$this->getDeslogin(),
			"dessenha"=>$this->getDessenha(),
			"dtcadastro"=>$this->getDtcadastro()->format("d/m/Y")
		));
	}

}


?>