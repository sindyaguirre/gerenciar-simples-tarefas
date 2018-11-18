<?php

include_once "Conexao.class.php";
include_once "Funcoes.class.php";

class Projeto {
    
    private $con;
    private $objfc;
    private $idProjeto;
    private $projeto;
    private $descricao;
    private $dataCadastro;
    
    public function __construct(){
        $this->con = new Conexao();
        $this->objfc = new Funcoes();
    }
    
    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    public function __get($atributo){
        return $this->$atributo;
    }
    
    public function querySeleciona($dado){
        try{
            $this->idProjeto = $this->objfc->base64($dado, 2);
            $cst = $this->con->conectar()->prepare("SELECT idProjeto, projeto, descricao, data_cadastro FROM `projeto` WHERE `idProjeto` = :idProj;");
            $cst->bindParam(":idProj", $this->idProjeto, PDO::PARAM_INT);
            $cst->execute();
            return $cst->fetch();
        } catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }
    
    public function querySelect(){
        try{
            $cst = $this->con->conectar()->prepare("SELECT `idProjeto`, `projeto`, `descricao`, `data_cadastro` FROM `projeto`;");
            $cst->execute();
            return $cst->fetchAll();
        } catch (PDOException $ex) {
            return 'erro '.$ex->getMessage();
        }
    }
    
    public function queryInsert($dados){
        try{
            $this->projeto= $this->objfc->tratarCaracter($dados['projeto'], 1);
            $this->descricao= $this->objfc->tratarCaracter($dados['descricao'], 1);
            $this->dataCadastro = $this->objfc->dataAtual(2);

            $cst = $this->con->conectar()->prepare("INSERT INTO `projeto` (`projeto`,`descricao`,`data_cadastro`) VALUES (:projeto,:descricao,:dt);");
            $cst->bindParam(":projeto", $this->projeto, PDO::PARAM_STR);
            $cst->bindParam(":descricao", $this->email, PDO::PARAM_STR);
            $cst->bindParam(":dt", $this->dataCadastro, PDO::PARAM_STR);
//            var_dump($cst->execute());
//            die('debug');
            if($cst->execute()){
                return 'ok';
            }else{
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }
    
    public function queryUpdate($dados){
        try{
            $this->idProjeto = $this->objfc->base64($dados['proj'], 2);
            $this->projeto = $this->objfc->tratarCaracter($dados['projeto'], 1);
            $this->descricao = $this->objfc->tratarCaracter($dados['descricao'], 1);

            $cst = $this->con->conectar()->prepare("UPDATE `projeto` SET  `projeto` = :projeto, `descricao` = :descricao WHERE `idProjeto` = :idProj;");
            $cst->bindParam(":idProj", $this->idProjeto, PDO::PARAM_INT);
            $cst->bindParam(":descricao", $this->descricao, PDO::PARAM_STR);
            $cst->bindParam(":projeto", $this->projeto, PDO::PARAM_STR);
            if($cst->execute()){
                return 'ok';
            }else{
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error '.$ex->getMessage();
        }
    }
    
    public function queryDelete($dado){
        try{
            $this->idProjeto = $this->objfc->base64($dado, 2);
            $cst = $this->con->conectar()->prepare("DELETE FROM `projeto` WHERE `idProjeto` = :idProj;");
            $cst->bindParam(":idProj", $this->idProjeto, PDO::PARAM_INT);
            if($cst->execute()){
                return 'ok';
            }else{
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error'.$ex->getMessage();
        }
    }
    
}

?>
