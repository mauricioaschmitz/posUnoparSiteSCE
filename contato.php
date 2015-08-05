<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once ('include/cabecalho.php');?>
        <title>Contato</title>
        <script src="include/js/inputmask.js"></script>
    </head>
    <body id="contato">
        <?php
        include_once('include/menu.php');
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-xs-12">
                    <form id="form_contato" action="<?php
                    if (isset(filter_input_array(INPUT_POST)['gravar'])) {
                        echo "email.php";
                    }
                    ?>" method="post">
                        <div class ="row">
                            <div class="col-md-6 form-group">
                                <div class = "alert alert-info">
                                    <p>Envie sua dúvida ou entre em contato pelo email <strong>mauricioantonioli@gmail.com</strong></p>
                                </div>
                            </div>                   
                        </div>    
                        <div class ="row">
                            <div class="col-md-6 form-group">
                                <label style="float: left">Nome</label>
                                <input class = "form-control" type="text" name="nome" id="nome" value=""/>
                            </div>                   
                        </div>
                        <div class ="row">
                            <div class="col-md-6 form-group">
                                <label style="float: left">E-mail</label>
                                <input class = "form-control" type="text" name="email" id="email" value=""/>
                            </div>                    
                        </div>
                        <div class ="row">
                            <div class="col-md-6 form-group">
                                <label style="float: left">Telefone</label>
                                <input data-mask ="(99)9999-9999" class = "form-control" type="text" name="fone" id="fone" value=""/>
                            </div>                    
                        </div>
                        <div class ="row">
                            <div class="col-md-6 form-group">
                                <label style="float: left">Assunto</label>
                                <input class = "form-control" type="text" name="assunto" id="assunto" value=""/>
                            </div>                    
                        </div>
                        <div class ="row">
                            <div class="col-md-6 form-group">    
                                <label style="float: left" for="mensagem">Mensagem: </label>
                                <textarea rows="6" class="form-control" name="mensagem" id="mensagem"></textarea>
                            </div>                    
                        </div>
                        <button type="submit" name="gravar" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
