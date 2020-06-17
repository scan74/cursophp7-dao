<?php

class Sql extends PDO 
{

	private $conn;

	//metodo construtor. quando eu der um new sql ele ja vai realizar
	//a conexao com o banco
	public function __construct()
	{
		$this->conn = new PDO("mysql:host=localhost;dbname=dbphp7", "root", "");
	}

	private function setParams($statement, $parameters = array())
	{
		//associando os parametros à query
		foreach($parameters as $key => $value)
		{
			//chama o setparam por que ele faz o set de um por vez
			//e aqui ele vai chamar quantas vezes for necessario
			//vai depender da quantidade de paramentros passados
			$this->setParam($statement, $key, $value);
		}
	}

	private function setParam($statement, $key, $value)
	{
		$statement->bindParam($key, $value);
	}


	//$rawquery será a nossa instrucao sql que queremos executar
	//$params sera um array com os dados de nossa query
	public function query($rawQuery, $params = array())
	{
		$stmt = $this->conn->prepare($rawQuery);
		$this->setParams($stmt, $params);
		$stmt->execute();
		return $stmt;
	}

	public function select($rawQuery, $params = array()):array
	{
		$stmt = $this->query($rawQuery, $params);
		//FETCH_ASSOC tras somente os dados associativos do array,
		//ignorando os indices numericos desse array
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
}


?>