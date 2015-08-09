<?php if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}?>
<script src="include/js/scripts.js"></script>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="border-top: 5px solid #000090;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#menuNavbarCollapse" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">SCE</a>
        </div>
        <div class="collapse navbar-collapse" id="menuNavbarCollapse">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Início</a></li>
                <li><a href="eventos.php">Eventos</a></li>
                <li><a href="contato.php">Contato</a></li>
            </ul><?php if (!isset($_SESSION['cpf'])) {?>
            <ul class="nav navbar-nav navbar-right">
                    <li><a href="cadastrar.php"><span class="glyphicon glyphicon-user"></span> Cadastrar</a></li>
                    <li><a href="entrar.php"><span class="glyphicon glyphicon-log-in"></span> Entrar</a></li>
                </ul><?php } else {?>
                <ul class="nav navbar-nav navbar-right">
                <li><a href="cadastrarEvento.php"><span class="glyphicon glyphicon-plus"></span> Cadastrar Evento</a></li>
                <li><a href="dados.php"><span class="glyphicon glyphicon-cog"></span> Alterar Dados</a></li>
                <li><a href="sair.php"><span class="glyphicon glyphicon-log-out"></span> Sair</a></li>
                </ul><?php }?>
                </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<br>
<br>
<br>
<br>