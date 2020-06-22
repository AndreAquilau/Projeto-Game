<?php

namespace Source\App\Controllers;

use Source\App\Model\Perfil;
use Source\App\Model\Game;
use Source\App\Model\Biblioteca;
use Source\core\Router;

/*  Classe está herdando os métodos de Router*/
class GameController extends Router 
{
    
/* Função publica para pegar o jogo de escolha do usuario*/
    public function getGame()
    {
        $user = new Perfil($_GET['id'], $_GET['usuario']);
        $jogo = new Game();
        $jogos = new Biblioteca();
        /* Deletar o jogo quando receber o _method */
        if(isset($_GET['_method'])){
            $jogo->deleteGame($_GET['id_jogo']);
            //echo $jogo;
            $res = json_encode($jogos->getBiblioteca($_GET["id_usuario"], $_GET['usuario']), JSON_UNESCAPED_UNICODE);
            $params["TITULO"] = "Biblioteca";
            $params["ROTA"] = 'GET';
            $dados = json_encode($user->getPerfil());
            $params["USUARIO"] = json_decode($dados, true);
            $params["GAME"] = json_decode($res,  true);
    
            //print_r($params);
    
            //LoadTemplate("biblioteca/biblioteca", $params);

            parent::getRouter()->redirect("/biblioteca?id=".$_GET['id']."&usuario=".$_GET['usuario'], $params);
            return;
        }

        $params["TITULO"] = "Game Add";
        $dados = json_encode($user->getPerfil());
        $params["USUARIO"] = json_decode($dados, true);
        LoadTemplate("addGame/addGame", $params);
    }
/* Função publica para criar o jogo no banco de dados*/
    public function postGame($params)
    {

        $game = new Game();
        /* Buscando os dados do jogos */
        $input['id_usuario'] = isset($_POST["id_usuario"]) ?$_POST["id_usuario"] : null;
        $input['titulo'] = isset($_POST["titulo"]) ?$_POST["titulo"] : null;
        $input['descricao'] = isset($_POST["descricao"]) ?$_POST["descricao"] : null;
        $input['thumb_url'] = isset($_POST["thumb_url"]) ?$_POST["thumb_url"] : null;
        $input['dowload_url'] = isset($_POST["dowload_url"]) ?$_POST["dowload_url"] : null;
        $input['dispositivo'] = isset($_POST["dispositivo"]) ?$_POST["dispositivo"] : null;
    /* Resgistrando os jogos no banco de dados*/
        $res = json_encode($game->postGame($input), JSON_UNESCAPED_UNICODE);
        $user = new Perfil($_POST['id_usuario'], $_POST['usuario']);
        $dados = json_encode($user->getPerfil());
        $params["USUARIO"] = json_decode($dados, true);
        $params["GAME"] = json_decode($res,  true);
        $params["TITULO"] = "Game Add";
       // print_r($params);

       /* Carrega página para adicionar um jogo */
        LoadTemplate("addGame/addGame", $params);

    }



}