<?php
require_once 'classes/Funcoes.class.php';
require_once 'classes/Projeto.class.php';

$objFuncoes = new Funcoes();
$objFcn = new Projeto();

if (isset($_POST['btCadastrar'])) {

    if ($objFcn->queryInsert($_POST) == 'ok') {
        header('location: /gerenciadorTarefas/projeto');
    } else {
        echo '<script type="text/javascript">alert("Erro em cadastrar projeto");</script>';
    }
}

if (isset($_POST['btAlterar'])) {

    if ($objFcn->queryUpdate($_POST) == 'ok') {
        header('location: ?acao=edit&proj=' . $objFuncoes->base64($_POST['proj'], 1));
    } else {
        echo '<script type="text/javascript">alert("Erro em alterar");</script>';
    }
}

if (isset($_GET['acao'])) {

    switch ($_GET['acao']) {
        case 'edit': $func = $objFcn->querySeleciona($_GET['proj']);
            break;
        case 'delet':
            if ($objFcn->queryDelete($_GET['proj']) == 'ok') {
                header('location: /gerenciadorTarefas/projeto');
            } else {
                echo '<script type="text/javascript">alert("Erro em deletar");</script>';
            }
            break;
    }
}
?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">

        <title>Formulário de cadastro</title>

        <link href="css/estilo.css" rel="stylesheet" type="text/css" media="all">
        <!--Bootstrap--> 
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" media="all">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" media="all">

        <!--jQuery (obrigatório para plugins JavaScript do Bootstrap)--> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <!--Inclui todos os plugins compilados (abaixo), ou inclua arquivos separadados se necessário--> 
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/bootstrap.min.js" crossorigin="anonymous"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>

    </head>

    <script>

    </script>
    <body>
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
        <div class="container" id="formulario">
            <div class="col-md-12" >
                <form name="formCad" action="" method="post">
                    <label>Nome Projeto: </label><br>
                    <input type="text" name="projeto" required="required" value="<?= $objFuncoes->tratarCaracter((isset($func['projeto'])) ? ($func['projeto']) : (''), 2) ?>"><br>

                    <label>Breve Descrição: </label><br>
                    <input type="text" name="descricao" required="required" value="<?= $objFuncoes->tratarCaracter((isset($func['descricao'])) ? ($func['projeto']) : (''), 2) ?>"><br>

                    <br>
                    <input type="submit" name="<?= (isset($_GET['acao']) == 'edit') ? ('btAlterar') : ('btCadastrar') ?>" value="<?= (isset($_GET['acao']) == 'edit') ? ('Alterar') : ('Cadastrar') ?>">

                    <!--CRIAR BOTÃO PARA LIMPAR FORMULARIO, E VOLTAR A TELA INICIAL-->

                    <input type="hidden" name="proj" value="<?= (isset($func['idProjeto'])) ? ($objFuncoes->base64($func['idProjeto'], 1)) : ('') ?>">
                </form>
            </div>
        </div>
        <div>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Projeto</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objFcn->querySelect() as $rst) {
                        ?>
                        <tr>

                            <th scope="row"><?php echo $rst['idProjeto']; ?></th>
                            <td><?php echo $objFuncoes->tratarCaracter($rst['projeto'], 2); ?></td>
                            <td><?php echo $rst['descricao']; ?></td>
                            <td>
                                <div class="">
                                    <a class="editar" href="?acao=edit&proj=<?= $objFuncoes->base64($rst['idProjeto'], 1) ?>" title="Editar dados"><img src="img/ico-editar.png" width="16" height="16" alt="Editar"></a>
                                    <a class="excluir" href="?acao=delet&proj=<?= $objFuncoes->base64($rst['idProjeto'], 1) ?>" title="Excluir esse dado"><img src="img/ico-excluir.png" width="16" height="16" alt="Excluir"></a>
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
