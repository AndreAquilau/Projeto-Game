<?php

namespace Source\App\Model;

use Source\db\Database;

class Biblioteca
{

  public function __construct()
  {

  }


  public function getBiblioteca($id, $usuario)
  {
    $instance = new Database();
    $conn = $instance->getInstance();

    $sql = ('SELECT * FROM  user_biblioteca WHERE usuario =\'' . $usuario . "'" . ' AND ' . 'ID_USUARIO = \'' . $id . "'");

    //echo $sql;
    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $dados = $stmt->fetchAll();

    //print_r($dados);

    return $dados;

  }

  public function viewGame($id_jogo, $id_usuario, $usuario) {
    $instance = new Database();
    $conn = $instance->getInstance();

    $sql = ('SELECT * FROM  user_biblioteca WHERE ID_JOGO =\'' . $id_jogo . "'" . ' AND ' . 'ID_USUARIO = \'' . $id_usuario . "'" . ' AND ' . 'usuario = \'' . $usuario . "'");

    //echo $sql;
    $stmt = $conn->prepare($sql);

    $stmt->execute();

    $dados = $stmt->fetchAll();

    //print_r($dados);

    return $dados;
  }

  public function deleteGame ($id_usuario, $id_jogo){
    $instance = new Database();
    $conn = $instance->getInstance();

    $sql = ("DELETE FROM Biblioteca WHERE id_usuario = $id_usuario AND id_jogo = $id_jogo");

    //echo $sql;
 

    $stmt = $conn->prepare($sql);
    
    $stmt->execute();  
    if($stmt->rowCount() > 0){
      return true;
    } else {
      return false;
    }
  }



}
