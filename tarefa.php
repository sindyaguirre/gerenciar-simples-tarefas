<?php
require_once 'classes/Funcoes.class.php';
require_once 'classes/Tarefa.class.php';
require_once 'classes/Projeto.class.php';
require_once 'classes/Funcionario.class.php';

$objFuncoes = new Funcoes();
$objFcn = new Tarefa();
$objProj = new Projeto();
$objFuncionario = new Funcionario();

if (isset($_POST['btCadastrar'])) {
    if ($objFcn->queryInsert($_POST) == true) {

        header('location: /gerenciadorTarefas/tarefa.php');
    } else {
        echo '<script type="text/javascript">alert("Erro em cadastrar");</script>';
    }
}

if (isset($_POST['btAlterar'])) {
    if ($objFcn->queryUpdate($_POST) == true) {
        header('location: ?acao=edit&tarf=' . $objFuncoes->base64($_POST['tarf'], 1));
    } else {
        echo '<script type="text/javascript">alert("Erro em alterar");</script>';
    }
}

if (isset($_GET['acao'])) {
    switch ($_GET['acao']) {
        case 'edit': $func = $objFcn->querySeleciona($_GET['tarf']);
            break;
        case 'delet':
            if ($objFcn->queryDelete($_GET['tarf']) == 'ok') {
                header('location: /gerenciadorTarefas/tarefa.php');
            } else {
                echo '<script type="text/javascript">alert("Erro em deletar");</script>';
            }
            break;
    }
}
// VARIAVEIS QUE CARREGAM OS DADOS DOS CAMPOS DE LISTA NO FORMULARIO
$arrayNivel = $objFuncoes->returnNivel(2);
$arrayStatus = $objFuncoes->returnStatus(2);
$arrayTempo = $objFuncoes->returnTempoEstimado(2);
$arrayProjeto = $objProj->querySelect();
$arrayFuncionario = $objFuncionario->querySelect();


/**
 * ESTES DAOD SAO USADOS QUANDO A FUNCAO UPDATE FOR CHAADA, CARREGANDO O ARRAY FUNC
 */
$idProjeto = (isset($func['idProjeto']) ? $func['idProjeto'] : '');
$idFuncionario = isset($func['idFuncionario']) ? ($func['idFuncionario']) : ('');
$idNivel = isset($func['idNivel']) ? ($func['idNivel']) : ('');
$idTempoEstimado = isset($func['idTempoEstimado']) ? ($func['idTempoEstimado']) : ('');
$idStatus = isset($func['idStatus']) ? ($func['idStatus']) : ('');
$tarefa = $objFuncoes->tratarCaracter((isset($func['tarefa'])) ? ($func['tarefa']) : (''), 2);
$descricao = $objFuncoes->tratarCaracter((isset($func['descricao'])) ? ($func['descricao']) : (''), 2);
?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <!--head-->
    <head>

        <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
        <title>Formulário de cadastro</title>

        <link href="css/estilo.css" rel="stylesheet" type="text/css" media="all">
        <!--Bootstrap--> 
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/" rel="stylesheet" type="text/css" media="all">
        <link rel="stylesheet" href="css/blue/style.css">

        <!--jQuery (obrigatório para plugins JavaScript do Bootstrap)--> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <!--Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário--> 
        <script type="text/javascript" src="js/bootstrap.js"></script>
        <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js" crossorigin="anonymous"></script>

        <!-- jQuery e Tablesorter [ordenacao da table] -->
        <script src="js/jquery-latest.js"></script>
        <script src="js/jquery.tablesorter.min.js"></script>

        <!-- Meu script -->
        <script src="js/scripts.js"></script>
    </head>

    <script>
        $(document).ready(function () {

            //botao de fechar formulário e abrir formulario

            $("#fecharCadastro").click(function (event) {
                $("#fecharCadastro").hide();
                $("#abrirCadastro").show();
                $("#cadastro").hide("slow");

            });
            $("#abrirCadastro").click(function (event) {
                window.location.href = "tarefa.php";

            });


            $("a.editar").click(function (event) {
                $("#fecharCadastro").show();
                $("#abrirCadastro").hide();
                $("#cadastro").show("slow");

            });
//            $("a.excluir").click(function (event) {
//                var apagar = confirm('Deseja realmente excluir este registro?');
//            });
        });
    </script>
    <body>
        <!--navbar-->
        <nav class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner">
                <div class="container">
                    <!--.btn-navbar estaclasse é usada como alteranador para o contepudo colapsave-->
                    <button class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="nav-collapse">
                        <ul class="nav">
                            <li><a href="projeto.php">Projetos</a></li>
                            <li><a href="tarefa.php">Tarefas</a></li>
                            <li><a href="usuario.php">Pessoas</a></li>
                        </ul>

                    </div>

                </div>
            </div>
        </nav>
        <div><h1 class=""><small><?php echo TITLO; ?></small></h1></div>
        <p>
            <button type="button" class="btn btn-primary" name="abrirCadastro" id="abrirCadastro">Novo cadastro</button>

            <button type="button" class="btn btn-info" name="fecharCadastro" id="fecharCadastro">Fechar Formulário</button>
        </p>

        <div class="container theme-showcase" role="main">
            <form class="" name="formCad" action="" method="post" >
                <div id="cadastro" class="row" >
                    <div class="form-group">
                        <!--campo tarefa-->
                        <div class="col-md-4 col-xd-4 col-xs-6">
                            <label for="tarefa">Tarefa:</label>
                            <input type="text" name="tarefa" required="required" value="<?= $tarefa ?>"><br>
                        </div>
                    </div>
                    <!--campo projeto-->
                    <div class="form-group">
                        <div class="col-md-4 col-xd-4 col-xs-6">
                            <label for="idProjeto">Projeto:</label>
                            <select class="form-control" name="idProjeto" id="idProjeto">
                                <option value="0">Selecione...</option>                              
                                <?php
                                foreach ($arrayProjeto as $key => $value) {
                                    echo '<option value="' . $value['idProjeto'] . '"' . (($value['idProjeto'] == $idProjeto) ? ' SELECTED="true"' : '') . '>' . $value['projeto'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!--campo nivel-->
                        <div class="col-md-4 col-xd-4 col-xs-6">
                            <label for="idNivel">Nível</label>
                            <select class="form-control" id="idNivel" name="idNivel">
                                <?php
                                foreach ($arrayNivel as $key => $value) {
                                    echo '<option value="' . $key . '"' . (($key == $idNivel) ? ' SELECTED="true"' : '') . '>' . $value . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!--campo usuario-->
                        <div class="col-md-4 col-xd-4 col-xs-6">
                            <label for="idFuncionario">Colaborador:</label>
                            <select class="form-control" name="idFuncionario" id="idFuncionario">
                                <option value="0">Selecione...</option>                              
                                <?php
                                foreach ($arrayFuncionario as $key => $value) {
                                    echo '<option value="' . $value['idFuncionario'] . '"' . (($value['idFuncionario'] == $idFuncionario) ? ' SELECTED="true"' : '') . '>' . $value['nome'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!--campo tempo estimado-->
                        <div class="col-md-4 col-xd-4 col-xs-6">
                            <label for="idTempoEstimado">Tempo estimado</label>
                            <select class="form-control" id="idTempoEstimado" name="idTempoEstimado">
                                <?php
                                foreach ($arrayTempo as $key => $value) {
                                    echo '<option value="' . $key . '"' . (($key == $idTempoEstimado) ? ' SELECTED="true"' : '') . '>' . $value . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!--campo status da tarefa-->
                        <div class="col-md-4 col-xd-4 col-xs-6">
                            <label for="idStatus">Status</label>
                            <select class="form-control" id="idStatus" name="idStatus">
                                <?php
                                foreach ($arrayStatus as $key => $value) {
                                    echo '<option value="' . $key . '"' . (($key == $idStatus) ? ' SELECTED="true"' : '') . '>' . $value . '</option>';
                                }
                                ?>
                            </select>
                        </div>

                    </div>
                    <!--campo descricao-->
                    <div class="form-group">
                        <label for="descricao">Descrição:</label>
                        <textarea class="form-control" id="descricao" name="descricao" rows="3"><?= $descricao ?></textarea>
                    </div>
                    <br>
                    <input class="btn btn-success" type="submit" name="<?= (isset($_GET['acao']) == 'edit') ? ('btAlterar') : ('btCadastrar') ?>" value="<?= (isset($_GET['acao']) == 'edit') ? ('Alterar') : ('Cadastrar') ?>">
                    <input type="hidden" name="tarf" value="<?= (isset($func['idTarefa'])) ? ($objFuncoes->base64($func['idTarefa'], 1)) : ('') ?>">
                </div>
            </form>

        </div>

        <div class="">
            <table id="tabelaTarefa" class="table tablesorter table-striped tabelaTarefa">
                <thead>
                    <tr>
                        <th scope="col">Tarefa</th>
                        <th scope="col">Projeto</th>
                        <th scope="col">Tempo estimado</th>
                        <th scope="col">Nível</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($objFcn->querySelect() as $rst) {
                        ?>
                        <tr>
                            <td scope='row' ><?php echo isset($rst['tarefa']) ? $objFuncoes->tratarCaracter($rst['tarefa'], 2) : ""; ?></td>
                            <td><?php echo isset($rst['projeto']) ? $objFuncoes->tratarCaracter($rst['projeto'], 2) : ""; ?></td>
                            <td><?php echo isset($rst['idTempoEstimado']) ? $objFuncoes->returnTempoEstimado(1, $rst['idTempoEstimado']) : ""; ?></td>
                            <td><?php echo isset($rst['idNivel']) ? $objFuncoes->returnNivel(1, $rst['idNivel']) : ""; ?></td>
                            <td><?php echo isset($rst['idStatus']) ? $objFuncoes->returnStatus(1, $rst['idStatus']) : ""; ?></td>
                            <td>
                                <div class="">
                                    <a class="editar" href="?acao=edit&tarf=<?= $objFuncoes->base64($rst['idTarefa'], 1) ?>" title="Editar dados"><img src="img/ico-editar.png" width="16" height="16" alt="Editar"></a>
                                    <a class="excluir" href="?acao=delet&tarf=<?= $objFuncoes->base64($rst['idTarefa'], 1) ?>" title="Excluir esse dado"><img src="img/ico-excluir.png" width="16" height="16" alt="Excluir"></a>
                                </div>
                            </td>
                        </tr>
                    <?php }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
