$(function () {

    //Torna menu atual ativo
    $("#inicio a:contains('Início')").parent().addClass('active');
    $("#eventos a:contains('Eventos')").parent().addClass('active');
    $("#contato a:contains('Contato')").parent().addClass('active');
    $("#cadastrar a:contains('Cadastrar')").parent().addClass('active');
    $("#entrar a:contains('Entrar')").parent().addClass('active');
    
    /*
    if ($("#photographer_pack a:contains('Photographer\'s Package')").parent().hasClass('active')) {
        $(".dropdown a:contains('Our Programs')").parent().addClass('active');
    }

    if ($("#joomla a:contains('Joomla Training')").parent().hasClass('active')) {
        $(".dropdown a:contains('Our Programs')").parent().addClass('active');
    }

    //make menus drop automatically
    $('ul.nav li.dropdown').hover(function () {
        $('.dropdown-menu', this).fadeIn();
    }, function () {
        $('.dropdown-menu', this).fadeOut('fast');
    });//hover
    */

});