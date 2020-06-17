<?php

require_once("config.php");

//$sql = new Sql();
//$usuarios = $sql->select("SELECT * FROM tb_usuarios");
//echo json_encode($usuarios);

//retorna apenas um usuario
//$root = new usuario();
//$root->loadById(1);
//como $root é um objeto, ele vai chamar a funcao __tostring da 
//classe usuario
//echo $root;

//por ser, getlist, um metodo estatico podemos chama-lo sem instanciar
//usando os ::
//$lista = Usuario::getList();
//Nao carrega o json da classe por que $lista nao é objeto
//echo json_encode($lista);

//Carrega uma lista de usuarios buscando pelo login
//$busca = Usuario::busca("se");
//Nao carrega o json da classe por que $busca nao é objeto
//echo json_encode($busca);

//Carrega um usuario usando o login e a senha
//$usuario = new Usuario();
//$usuario->login("Sergio", "1239000");
//echo $usuario;

//adicionando um novo usuario
//$aluno = new Usuario("sicrano", "333");
//$aluno->insert();
//echo $aluno;

//alterando um usuario
//$usuario = new Usuario();
//$usuario->loadById(11);
//$usuario->update("professor", "hgftf");
//echo $usuario;

$usuario = new Usuario();
$usuario->loadById(11);
$usuario->delete();
echo $usuario;

?>