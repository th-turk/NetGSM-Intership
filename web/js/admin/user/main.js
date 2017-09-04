/**
 * Created by tahaturk25 on 3.9.2017.
 */
    $(".dropdown-menu li a").click(function(){

        $("#dropdownMenu1").text($(this).text());
        $("#dropdownMenu1").val($(this).text());


        $('.dropdown-menu > li > a').removeClass('fa fa-check');
        $(this).addClass('fa fa-check');

    });

    $(".dropdown-menu li a").hover(function(){


    });

