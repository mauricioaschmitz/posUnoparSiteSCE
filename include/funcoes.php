<?php

/* * ***************************************
  FUNÇÃO DE CRIAÇÃO DE DIV PARA ALERTAS
 * *************************************** */

function funcAlert($mensagem, $tipo) {
    $aux = "<div class='container'>
            <div class='row'>
            <div class='col-md-3'></div>
            <div class='alert text-center alert-".$tipo." col-md-6  col-xs-12' role='alert'>"
            . $mensagem .
            "</div>
            </div>
            </div>";
    return $aux;
}

/* * ***************************************
  FUNÇÃO: VALIDAÇÃO DE DATA
 * *************************************** */

function validaData($dataRec) {
    $data = explode('/', $dataRec);

    $dia = $data[0];
    $mes = $data[1];
    $ano = $data[2];

    if ($ano <= date('Y') && $ano > 1880) {
        return checkdate($mes, $dia, $ano);
    } else {
        return false;
    }
}

function validaDataMaior($dataEvento, $dataInscricoes) {
    $data1 = explode('/', $dataEvento);
    $data2 = explode('/', $dataInscricoes);

    $dia1 = $data1[0];
    $mes1 = $data1[1];
    $ano1 = $data1[2];
    
    $dia2 = $data2[0];
    $mes2 = $data2[1];
    $ano2 = $data2[2];

    if ($ano2 > $ano1) {
        return false;
    } 
    if ($ano2 == $ano1) {
        if($mes2 > $mes1){
            return false;
        } elseif ($mes2 == $mes1){
            if($dia2 <= $dia1){
                return true;
            }
        } else{
            return true;
        }
    }
    if ($ano2 < $ano1) {
        return true;
    }
}

/* * ***************************************
  FUNÇÃO: VALIDAÇÃO DE DATA MAIOR QUE A ATUAL
 * *************************************** */

function validaDataPosteriorAtual($dataRec) {
    $data = explode('/', $dataRec);

    $dia = $data[0];
    $mes = $data[1];
    $ano = $data[2];

    if ($ano == date('Y')) {
        if($mes == date('m')){
            if($dia > date('d')){
                return checkdate($mes, $dia, $ano);
            }else {
                return false;
            }
        } elseif ($mes > date('m')){
            return checkdate($mes, $dia, $ano);
        } else {
            return false;
        }
    } elseif ($ano > date('Y')) {
        return checkdate($mes, $dia, $ano);
    } else {
        return false;
    }
}

/* * ***************************************
  FUNÇÃO: VALIDAÇÃO DE CPF
 * *************************************** */

function validaCPF($cpfrec) {
    $cpf = preg_replace('/[^0-9]/is', '', $cpfrec);
    if (strlen($cpf) != 11) {
        return false;
    }
    $digito1 = 0;
    $digito2 = 0;
    for ($i = 0, $x = 10; $i < 9; $i++, $x--) {
        $digito1 = $digito1 + ($cpf[$i] * $x);
    }
    for ($i = 0, $x = 11; $i < 10; $i++, $x--) {
        if (str_repeat($i, 11) == $cpf) {
            return false;
        }
        $digito2 = $digito2 + ($cpf[$i] * $x);
    }
    $soma1 = (($digito1 % 11) < 2) ? 0 : 11 - ($digito1 % 11);
    $soma2 = (($digito2 % 11) < 2) ? 0 : 11 - ($digito2 % 11);

    if ($soma1 != $cpf[9] || $soma2 != $cpf[10]) {
        return false;
    } else {
        return true;
    }
}