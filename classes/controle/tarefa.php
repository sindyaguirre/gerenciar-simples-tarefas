<?php
/**
 * ESTE CONTROLLER SERÁ UTILIZADO NA PRÓXIMA REFATORAÇÃO 
 */
require_once '../Funcoes.class.php';
require_once '../Tarefa.class.php';
require_once '../Projeto.class.php';
require_once '../Funcionario.class.php';

$objFuncoes = new Funcoes();
$objFcn = new Tarefa();
$objProj = new Projeto();
$objFuncionario = new Funcionario();

switch ($_POST['btCadastrar']) {
    case 'Cadastrar':

        if (isset($_POST['btCadastrar'])) {

            if ($objFcn->queryInsert($_POST) == true) {
                echo json_encode(array("msg" => utf8_encode("Cadastrado com sucesso!")));
            } else {
                echo '<script type="text/javascript">alert("Erro em cadastrar");</script>';
            }
        }

        break;

    default:
        break;
}
?>
