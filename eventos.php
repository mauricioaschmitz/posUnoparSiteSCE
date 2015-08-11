<?php 
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
require ('include/bancoFunc.php');
require ('include/funcoes.php');?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include_once('include/cabecalho.php');?>
        <title>Eventos</title>
    </head>
    <body id="eventos">
        <?php include_once ('include/menu.php');?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <div class="alert alert-info">
                        <p><strong>Faça sua matrícula!</strong> Clique sobre o evento desejado para exibir os detalhes e proceder com a inscrição.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 col-xs-6"  style="margin-left:5px;">
                    <div class="btn-toolbar">
                        <span class="glyphicon glyphicon-ok" style="color:#44d68a"></span> Inscrições Abertas
                    </div>
                </div>
                <div class="col-md-2 col-xs-6">
                    <div class="btn-toolbar">
                        <span class="glyphicon glyphicon-remove" style="color:red"></span> Inscrições Finalizadas
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <table id="tabela" class="table table-striped">
                        <thead class="alert alert-warning">
                            <tr>
                                <th style="text-align: left">Eventos</th>
                                <th style="text-align: left">Início</th>
                                <th style="text-align: left">Duração</th>
                                <th style="text-align: left">Vagas</th>
                                <th style="text-align: left"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $dados = leituraBD("id, nome, dataEvento, horarioInicio, duracao, vagas", "eventos", NULL);
                            for ($i = 0; $i < count($dados); $i++) {
                                echo "<tr>";
                                echo "<td style='text-align: left'><a href='detalhes.php?id=" . $dados[$i]['id'] . "'> " . $dados[$i]['nome'] . "</a></td>";
                                echo "<td style='text-align: left'>" . formataDataHTML($dados[$i]['dataEvento']) . " " . substr($dados[$i]['horarioInicio'], 0, 5) . "</td>";
                                echo "<td style='text-align: left'>" . substr($dados[$i]['duracao'], 0, 5) . " horas </td>";
                                echo "<td style='text-align: center'>" . $dados[$i]['vagas'] . "</td>";
                                if(!validaDataPosteriorAtual(formataDataHTML($dados[$i]['dataEvento']))){
                                echo "<td style='text-align: left'><span style='cursor:pointer; color:red' title='Inscrições Finalizadas' class='glyphicon glyphicon-remove'></span></td> ";
                                }else{
                                  echo "<td style='text-align: left'><span style='cursor:pointer; color:#44d68a' title='Inscrições Abertas' class='glyphicon glyphicon-ok'></span></td> ";  
                                }
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php include_once('include/rodape.php');?>
    </body>
</html>