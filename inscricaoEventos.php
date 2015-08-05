<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once ('include/cabecalho.php'); ?>
        <link rel="stylesheet" href="include/css/bootstrap.css">
        <title>Inscrição de Eventos</title>
        <script src="include/js/inputmask.js"></script>
    </head>
    <body>
        <?php
        include_once('include/menu.php');
        require('include/bancoFunc.php');
        require('include/funcoes.php');
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        if (isset(filter_input_array(INPUT_POST)['cadastrar'])) {
            $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
            $dataInicio = filter_input(INPUT_POST, 'dataInicio', FILTER_SANITIZE_STRING);
            $dataInscricao = filter_input(INPUT_POST, 'dataInscricao', FILTER_SANITIZE_STRING);
            $tipo = filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_STRING);
            $horarioInicio = filter_input(INPUT_POST, 'horarioInicio', FILTER_SANITIZE_STRING);
            $duracao = filter_input(INPUT_POST, 'duracao', FILTER_SANITIZE_STRING);
            $numVagas = filter_input(INPUT_POST, 'numVagas', FILTER_SANITIZE_NUMBER_INT);
            $cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
            $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
            $estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
            $bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
            $endereco = filter_input(INPUT_POST, 'endereco', FILTER_SANITIZE_STRING);
            $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_NUMBER_INT);
            $complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING);
            $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING);
            if (empty($nome)) {
                echo funcAlert("O Campo Nome é obrigatório!", "warning");
            } elseif (empty($dataInicio)) {
                echo funcAlert("O Campo Data de Início é obrigatório!", "warning");
            } elseif (empty($dataInscricao)) {
                echo funcAlert("O Campo Data Limite para Inscrição é obrigatório!", "warning");
            } elseif (empty($tipo)) {
                echo funcAlert("O Campo Tipo do Evento é obrigatório!", "warning");
            } elseif (empty($horarioInicio)) {
                echo funcAlert("O Campo Horário de Início é obrigatório!", "warning");
            } elseif (empty($numVagas)) {
                echo funcAlert("O Campo Número de Vagas é obrigatório!", "warning");
            } elseif (empty($duracao)) {
                echo funcAlert("O Campo Duração é obrigatório!", "warning");
            } elseif (empty($cep)) {
                echo funcAlert("O Campo CEP é obrigatório!", "warning");
            } elseif (empty($cidade)) {
                echo funcAlert("O Campo Cidade é obrigatório!", "warning");
            } elseif (empty($estado)) {
                echo funcAlert("O Campo Estado é obrigatório!", "warning");
            } elseif (empty($bairro)) {
                echo funcAlert("O Campo Bairro é obrigatório!", "warning");
            } elseif (empty($endereco)) {
                echo funcAlert("O Campo Endereço é obrigatório!", "warning");
            } elseif (empty($numero)) {
                echo funcAlert("O Campo Número é obrigatório!", "warning");
            } elseif (empty($complemento)) {
                echo funcAlert("O Campo Complemento é obrigatório!", "warning");
            } elseif (empty($descricao)) {
                echo funcAlert("O Campo Descrição é obrigatório!", "warning");
            } else {
                
            }
        } elseif (isset(filter_input_array(INPUT_POST)['cancelar'])) {
            echo funcAlert("Saindo da página de cadastro de Eventos do SCE! Aguarde!!!", "danger");
            header("Refresh: 3;url=index.php");
            exit();
        } else {
            $nome = '';
            $dataInicio = '';
            $dataInscricao = '';
            $tipo = '';
            $horarioInicio = '';
            $duracao = '';
            $numVagas = '';
            $cep = '';
            $cidade = '';
            $estado = '';
            $bairro = '';
            $endereco = '';
            $numero = '';
            $complemento = '';
            $descricao = '';
        }
        ?>
        <div class="container">
            <div class="col-md-12 col-xs-12" style="margin-bottom: 100px;">
                <form name="evento" method="post" enctype="multipart/form-data">
                    <div class="well well-sm">
                        <p>Preencha os campos abaixo com as informações sobre o evento a ser cadastrado! <strong>Atenção!</strong> todos os campos são obrigatórios.</p>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-6 col-xs-6 form-group">
                            <label>Nome do Evento </label>
                            <input class = "form-control" type="text" name="nome" id="nome" value="<?php
                            if (isset($nome)) {
                                echo $nome;
                            }
                            ?>" placeholder="Nome"/>
                        </div> 
                        <div class="col-md-3 col-xs-6 form-group">
                            <label style="float: left">Data do Evento </label>
                            <input data-mask ="99/99/9999" class = "form-control" type="tel" name="dataEvento" id="dataEvento" value="<?php
                            if (isset($dataInicio)) {
                                echo $dataInicio;
                            }
                            ?>" placeholder="00/00/0000"/>
                        </div> 
                        <div class="col-md-3 col-xs-6 form-group">
                            <label style="float: left">Data Limite para Inscrições </label>
                            <input data-mask ="99/99/9999" class = "form-control" type="tel" name="dataInscricao" id="dataInscricao" value="<?php
                            if (isset($dataInscricao)) {
                                echo $dataInscricao;
                            }
                            ?>" placeholder="00/00/0000"/>
                        </div> 
                    </div>
                    <div class ="row">          
                        <div class="col-md-3 col-xs-6 form-group">
                            <label style="float: left">Tipo do Evento </label>
                            <select class="form-control selectpicker span10" id="tipo" name ="tipo" data-live-search="true">
                                <option value="" <?php
                                if ($tipo == "") {
                                    echo "selected";
                                }
                                ?>>Selecione</option>
                                <option value="Palestra" <?php
                                if ($tipo == "Palestra") {
                                    echo "selected";
                                }
                                ?>>Palestra</option>
                                <option value="Convenção" <?php
                                if ($tipo == "Convenção") {
                                    echo "selected";
                                }
                                ?>>Convenção</option>
                                <option value="Seminário" <?php
                                if ($tipo == "Seminário") {
                                    echo "selected";
                                }
                                ?>>Seminário</option>
                                <option value="Debate" <?php
                                if ($tipo == "Debate") {
                                    echo "selected";
                                }
                                ?>>Debate</option>
                                <option value="Conferência" <?php
                                if ($tipo == "Conferência") {
                                    echo "selected";
                                }
                                ?>>Conferência</option>
                                <option value="Simpósio" <?php
                                if ($tipo == "Simpósio") {
                                    echo "selected";
                                }
                                ?>>Simpósio</option>
                            </select> 
                        </div>
                        <div class="col-md-3 col-xs-3 form-group">
                            <label>Horário Início </label>
                            <input data-mask ="99:99" class = "form-control" type="text" name="horarioInicio" id="horarioInicio" value="<?php
                            if (isset($horarioInicio)) {
                                echo $horarioInicio;
                            }
                            ?>" placeholder="00:00"/>
                        </div>
                        <div class="col-md-3 col-xs-3 form-group">
                            <label>Duração (H:M) </label>
                            <input data-mask ="99:99" class = "form-control" type="text" name="duracao" id="duracao" value="<?php
                            if (isset($duracao)) {
                                echo $duracao;
                            }
                            ?>" placeholder="00:00"/>
                        </div>
                        <div class="col-md-3 col-xs-3 form-group">
                            <label>Número de Vagas </label>
                            <input class = "form-control" type="number" min="1" max="10000" name="numVagas" id="numVagas" value="<?php
                            if (isset($numVagas)) {
                                echo $numVagas;
                            }
                            ?>"/>
                        </div>
                    </div>
                    <div class ="row">
                        <div class="col-md-3 col-xs-6 form-group">
                            <label style="float: left">CEP</label>
                            <input data-mask ="99999-999" class="form-control" type="text" name="cep" id="cep" value="<?php
                            if (isset($cep)) {
                                echo $cep;
                            }
                            ?>" placeholder="00000-000"/>
                        </div>
                        <div class="col-md-3 col-xs-6 form-group">
                            <label>Cidade</label>    
                            <input class="form-control" type="text" name="cidade" id="cidade" value="<?php
                            if (isset($cidade)) {
                                echo $cidade;
                            }
                            ?>" placeholder="Cidade"/>                  
                        </div>
                        <div class="col-md-3 col-xs-6 form-group">
                            <label>Estado</label>    
                            <input class="form-control" type="text" name="estado" id="estado" value="<?php
                            if (isset($estado)) {
                                echo $estado;
                            }
                            ?>" placeholder="Estado"/> 
                        </div>
                        <div class="col-md-3 col-xs-6 form-group">
                            <label style="float: left">Bairro</label>
                            <input class ="form-control" type="text" name="bairro" id="bairro" value="<?php
                            if (isset($bairro)) {
                                echo $bairro;
                            }
                            ?>" placeholder="Bairro"/>
                        </div>
                    </div>
                    <div class ="row">        
                        <div class="col-md-6 col-xs-6 form-group">
                            <label>Endereço (Rua, Avenida, Outros)</label>    
                            <input class="form-control" type="text" name="endereco" id="endereco" value="<?php
                            if (isset($endereco)) {
                                echo $endereco;
                            }
                            ?>" placeholder="Endereço"/>                  
                        </div>
                        <div class="col-md-3 col-xs-6 form-group">
                            <label>Número</label>    
                            <input class="form-control" type="tel" name="numero" id="numero" value="<?php
                            if (isset($numero)) {
                                echo $numero;
                            }
                            ?>" placeholder="Número"/>                  
                        </div>
                        <div class="col-md-3 col-xs-6 form-group">
                            <label>Complemento</label>    
                            <input class="form-control" type="text" name="complemento" id="complemento" value="<?php
                            if (isset($complemento)) {
                                echo $complemento;
                            }
                            ?>" placeholder="Complemento"/>                  
                        </div>
                    </div>
                    <div class ="row">
                        <div class="col-md-12 col-xs-12 form-group">    
                            <label style="float: left" for="descricao">Descrição do Evento </label>
                            <textarea rows="5" class="form-control" name="descricao" id="descricao" placeholder="Descrição do Evento"><?php
                                if (isset($descricao)) {
                                    echo $descricao;
                                }
                                ?></textarea>
                        </div>                    
                    </div>
                    <br>
                    <button type="submit" name="cadastrar" class="btn btn-success">Cadastrar evento!</button>
                    <button type="submit" name="cancelar" class="btn btn-danger">Cancelar!</button>
                </form>
            </div>
        </div>
    </body>
</html>