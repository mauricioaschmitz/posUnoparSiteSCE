<?php include_once('include/menu.php');?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include_once('include/cabecalho.php');?>
        <title>Eventos</title>
    </head>
    <body id="inicio">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <center><h1 class="text-primary">Bem Vindo ao Sistema de Cadastro para Eventos (SCE)</h1></center>
                    <br>
                </div>
                <div class="col-md-12 col-xs-12">
                    <h2 class="text-info text-justify">Sobre o SCE</h2>
                </div>
                <div class="col-md-12 col-xs-12">
                    <h4 class="text-muted text-justify">O Sistema de Cadastro para Eventos tem por finalidade
                        centralizar em um único ambiente um local para cadastrar as pessoas em determinados eventos.
                        Esses eventos podem ser palestras, workshops, seminários, etc...</h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-xs-12">
                </div>
                <div class="col-md-8 col-xs-12">
                    <div id="myCarousel" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ol class="carousel-indicators">
                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#myCarousel" data-slide-to="1"></li>
                            <li data-target="#myCarousel" data-slide-to="2"></li>
                            <li data-target="#myCarousel" data-slide-to="3"></li>
                        </ol>

                        <!-- Wrapper for slides -->
                        <div class="carousel-inner" role="listbox">
                            <div class="item active">
                                <img src="include/img/1.jpg" alt=""/>
                            </div>

                            <div class="item">
                                <img src="include/img/2.jpg" alt=""/>
                            </div>

                            <div class="item">
                                <img src="include/img/3.jpg" alt=""/>
                            </div>

                            <div class="item">
                                <img src="include/img/4.jpg" alt=""/>
                            </div>
                        </div>
                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php include_once('include/rodape.php');?>
    </body>
</html>