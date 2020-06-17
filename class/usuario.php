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
		
		//Alimentando as variaveis com o sets
		if (count($results) > 0){
			$row = $results[0];
			$this->setIdusuario($row['idusuario']); 
			$this->setDeslogin($row['deslogin']); 
			$this->setDessenha($row['dessenha']); 
			$this->setDtcadastro(new DateTime($row['dtcadastro'])); 

		}

	}

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