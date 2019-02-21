<?php
include("topo.php");
include("menu-lateral.php");
?>

<!-- Painel de Demandas -->
<div class="container conteudo">

    <?php
    //CASO TENHA MENSAGEM VIA POST, ENTÃO MOSTRAR NA TELA AO USUÁRIO
    if (isset($_POST['mensagem']) && @$_SESSION['mensagem'] == "OK") {
        @$_SESSION['mensagem'] = "NO";
        echo '<div id="div_success" class="alert alert-success" style="display: none;"><button class="close" data-dismiss="alert"></button><b>Sucesso:</b> ' . $_POST['mensagem'] . '</div>';
    }
    ?>

    <form id="formulario_imprimir" action="" method="post" target="_blank">
        <div class="botoes-acao">
            <a id="" href="usuario-cadastro.php" title="Adicionar" class="adicionar"></a>
            <a id="mostrar-busca"  href="#" title="Filtrar" class="filtrar"></a>
        </div>
        <br/>
        <div id="filtro" class="filtro" style="display: none">
            <!-- linha -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="nome">Nome de Usuário</label>
                        <input onkeyup="pesquisa()" type="text" name="nome" id="nome" class="form-control" placeholder="Nome de Usuário" />
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="cadastro">
        <h1>Lista de Usuários</h1>
        <table class="tabela tb-usuarios">
            <thead>
                <tr>
                    <th>Nome<th>Login<th>Situação<th>Nível<th>
            <tbody id="pagina">
                <?php
                $sql_grupo = $db->prepare("SELECT * FROM tb_bsc_usuario ORDER BY Nome ASC");
                $sql_grupo->execute();
                while ($usuario = $sql_grupo->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                    <tr>
                        <td data-th="Nome"><?php echo utf8_encode($usuario['Nome']); ?>
                        <td data-th="Login"><?php echo $usuario['login']; ?>
                        <td data-th="Situação"><?php echo status($usuario['Status']); ?>
                        <td data-th="Nível"><?php echo utf8_encode(nivel($usuario['IdAcesso'])); ?>
                        <td data-th=""><a href="usuario-cadastro.php?id=<?php echo $usuario['IdUsuario']; ?>" title="Editar" class="editar-lista">Editar</a>	
                            <?php
                        }
                        ?>
        </table>
    </div>
</div>

<?php include("rodape.php") ?>

<script type="text/javascript" src="js/configuracoes/usuarios-painel.js"></script>

<script>

                            var headertext = [];
                            var headers = document.querySelectorAll(".tabela th"),
                                    tablerows = document.querySelectorAll(".tabela th"),
                                    tablebody = document.querySelector(".tabela tbody");
                            for (var i = 0; i < headers.length; i++) {
                                var current = headers[i];
                                headertext.push(current.textContent.replace(/\r?\n|\r/, ""));
                            }
                            for (var i = 0, row; row = tablebody.rows[i]; i++) {
                                for (var j = 0, col; col = row.cells[j]; j++) {
                                    col.setAttribute("data-th", headertext[j]);
                                }
                            }
</script>

<!-- JS UTIL -->
<script src="utils/utils.js" type="text/javascript"></script>
<script src="utils/projeto.utils.js" type="text/javascript"></script>

