<?php

include_once "Conexao.class.php";
include_once "Funcoes.class.php";

class Tarefa {

    private $con;
    private $objfc;
    private $idTarefa;
    private $idProjeto;
    private $idFuncionario;
    private $idNivel;
    private $idTempoEstimado;
    private $idStatus;
    private $descricao;
    private $dataInicio;
    private $dataFinal;
    private $horaInicio;
    private $horaFinal;
    private $dataCadastro;
    private $tarefa;

    public function __construct() {
        $this->con = new Conexao();
        $this->objfc = new Funcoes();
    }

    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }

    public function __get($atributo) {
        return $this->$atributo;
    }

    public function querySeleciona($dado) {

        try {
            $this->idTarefa = $this->objfc->base64($dado, 2);
            $cst = $this->con->conectar()->prepare(
                    "SELECT * FROM `tarefa` WHERE `idTarefa` = :idTarf;");
            $cst->bindParam(":idTarf", $this->idTarefa, PDO::PARAM_INT);
            $cst->execute();
            return $cst->fetch();
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    public function querySelect() {
        try {
            $cst = $this->con->conectar()->prepare(""
                    . "SELECT * FROM `tarefa` as t JOIN projeto as p on t.idProjeto= p.idProjeto ;");
            $cst->execute();
            return $cst->fetchAll();
        } catch (PDOException $ex) {
            return 'erro ' . $ex->getMessage();
        }
    }
/**
 * Query para usar na tabela de consulta, funcionalidade de agrupamento [ainda não implementado]
 * GROUP BY t.idStatus ORDER BY t.idStatus
 * @param type $where
 * @param type $groupBy
 * @return type
 */
    public function querySelectGroupBy($where,$groupBy) {
        try {
            $cst = $this->con->conectar()->prepare(""
                    . "SELECT t.*,p.projeto,COUNT(t.idTarefa) "
                    . "FROM `tarefa` as t "
                    . "INNER JOIN projeto as p on t.idProjeto= p.idProjeto"
                    .$where
                    . $groupBy.";");
            $cst->execute();
            return $cst->fetchAll();
        } catch (PDOException $ex) {
            return 'erro ' . $ex->getMessage();
        }
        
    }

    public function queryInsert($dados) {

        unset($dados['btCadastrar']);
        unset($dados['func']);
        $strCampos = "";
        $strValue = "";
        try {
            foreach ($dados as $key => $value) {
                $this->$key = $this->objfc->tratarCaracter($value, 1);
            }
            $this->dataCadastro = $this->objfc->dataAtual(2);

            if (isset($dados['tarf'])) {
                unset($dados['tarf']);
            }
            foreach ($dados as $key => $value) {
                $strCampos .= "`" . $key . "`,";
                $strValue .= ":" . $key . ",";
            }
            $cst = $this->con->conectar()->prepare(
                    "INSERT INTO `tarefa` (" . $strCampos . "`dataCadastro`) VALUES (" . $strValue . ":dataCadastro);"
            );

            $cst->bindParam(":tarefa", $this->tarefa, PDO::PARAM_STR);
            $cst->bindParam(":idProjeto", $this->idProjeto, PDO::PARAM_INT);
            $cst->bindParam(":idNivel", $this->idNivel, PDO::PARAM_INT);
            $cst->bindParam(":idFuncionario", $this->idFuncionario, PDO::PARAM_INT);
            $cst->bindParam(":idTempoEstimado", $this->idTempoEstimado, PDO::PARAM_INT);
            $cst->bindParam(":idStatus", $this->idStatus, PDO::PARAM_INT);
            $cst->bindParam(":descricao", $this->descricao, PDO::PARAM_STR);
            $cst->bindParam(":dataCadastro", $this->dataCadastro, PDO::PARAM_STR);

            if ($cst->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    public function queryUpdate($dados) {
        $strSet = "";
        $strValue = "";
        unset($dados['btAlterar']);

        try {

            foreach ($dados as $key => $value) {
                if ($key == 'tarf') {
                    $this->idTarefa = $this->objfc->base64($dados['tarf'], 2);
                } else {
                    $this->$key = $this->objfc->tratarCaracter($value, 1);
                }
            }

            $this->dataAlteracao = $this->objfc->dataAtual(2);

            unset($dados['tarf']);
            foreach ($dados as $key => $value) {
                $strSet .= "`" . $key . "`= :" . $key . ",";
            }

            $cst = $this->con->conectar()->prepare(
                    "UPDATE `tarefa` SET " . $strSet . " `dataAlteracao`= :dataAlteracao WHERE `idTarefa` = :idtarf;"
            );

            $cst->bindParam(":idtarf", $this->idTarefa, PDO::PARAM_INT);
            $cst->bindParam(":tarefa", $this->tarefa, PDO::PARAM_STR);
            $cst->bindParam(":idProjeto", $this->idProjeto, PDO::PARAM_INT);
            $cst->bindParam(":idNivel", $this->idNivel, PDO::PARAM_INT);
            $cst->bindParam(":idFuncionario", $this->idFuncionario, PDO::PARAM_INT);
            $cst->bindParam(":idTempoEstimado", $this->idTempoEstimado, PDO::PARAM_INT);
            $cst->bindParam(":idStatus", $this->idStatus, PDO::PARAM_INT);
            $cst->bindParam(":descricao", $this->descricao, PDO::PARAM_STR);
            $cst->bindParam(":dataAlteracao", $this->dataAlteracao, PDO::PARAM_STR);

            if ($cst->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $ex) {
            return 'error ' . $ex->getMessage();
        }
    }

    public function queryDelete($dado) {
        try {
            $this->idTarefa = $this->objfc->base64($dado, 2);
            $cst = $this->con->conectar()->prepare("DELETE FROM `tarefa` WHERE `idTarefa` = :idTarf;");
            $cst->bindParam(":idTarf", $this->idTarefa, PDO::PARAM_INT);
            if ($cst->execute()) {
                return 'ok';
            } else {
                return 'erro';
            }
        } catch (PDOException $ex) {
            return 'error' . $ex->getMessage();
        }
    }

}

?>
