<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <?php include_once ('include/cabecalho.php');?>
        <title>Contato</title>
    </head>
    <body>
        <?php include_once ('include/menu.php');?>
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-xs-12">
                    <table id="tabela" class="table table-striped">
                        <thead class="alert alert-warning">
                            <tr>
                                <th style="text-align: left">Campo</th>
                                <th style="text-align: left">Valor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $campos = array_keys($dados[0]);
                            for ($i = 0; $i < count($campos); $i++) {
                                echo "<tr class=\"\">";
                                echo "<td style=\"text-align: left\">" . $campos[$i] . "</td>";
                                echo "<td style=\"text-align: left\">" . $dados[0][$campos[$i]] . "</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class='row'>
                <div class='col-md-4 col-xs-12'>
                    <form method="POST" action='eventos.php'>
                        <button type="submit" class="btn btn-default" id="voltar">Voltar</button>
                    </form>
                </div>
            </div>
        </div>
        <?php include_once('include/rodape.php');?>
    </body>
</html>