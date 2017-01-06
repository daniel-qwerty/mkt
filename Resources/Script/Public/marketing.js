/**
 * Created by Suaznabar on 7/28/2016.
 */
isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
$(document).ready(function () {

});


$(window).load(function () {
    "use strict";
    $('html, body').animate({scrollTop: 0}, 1);
    //$("#preloader").fadeOut(); // will first fade out the loading animation
    //$("#preload").delay(150).fadeOut("slow");
    $(".menu-container").delay(800).slideDown();
    $(".menu-content").delay(1000).fadeIn("slow");
    updateAnimations("svg-" + 0);
    $('.intro-slicks').slick({
        dots: true,
        infinite: true,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000
    });
    $(".svg-object").last().hide();

    $('.intro-slicks').slick('slickGoTo', 0);
    $('.intro-slicks').on('setPosition', function (event, slick) {
        updateAnimations("svg-" + slick.currentSlide);
        var a = document.getElementById("svg-" + slick.currentSlide);
        var svgDoc = a.contentDocument;
        var path = svgDoc.querySelector("path");
        var length = path.getTotalLength();

        path.style.transition = path.style.WebkitTransition = 'none';
        path.style.strokeDasharray = length + ' ' + length;
        path.style.strokeDashoffset = length;
        path.getBoundingClientRect();
        path.style.transition = path.style.WebkitTransition = 'stroke-dashoffset 2s ease-in-out';
        path.style.strokeDashoffset = '0';
    });
    $('.intro-slicks').on('beforeChange', function (event, slick, currentSlide, nextSlide) {
        updateAnimations("svg-" + nextSlide);
    });
    updateHeight();
    $(window).resize(function () {
        setTimeout(updateHeight, 300)
    });
    $(".go-up").click(function () {
        $("html, body").animate({scrollTop: 0}, "slow");
        return false;
    });
    setTimeout(showBienvenido, 10000);
});

updateAnimations = function (svg_id) {
    if ($('body').hasClass('index-page')) {

        var a = document.getElementById(svg_id);
        var svgDoc = a.contentDocument;
        var path = svgDoc.querySelector("path");
        var length = path.getTotalLength();
        path.style.transition = path.style.WebkitTransition = 'none';
        path.style.strokeDasharray = 0 + ' ' + 1;
        path.style.strokeDashoffset = length;
    }
}

toogleMenu = function () {
    $(".main-menu").toggleClass("active");
}

showBienvenido = function () {
    $("#bienvenido").css('left', 0);
}

updateHeight = function () {
    if (isMobile)
        $(".insta-btn-wrap").height(60);
    else
        $(".insta-btn-wrap").height($($("a.img-thumbnail-variant-3.fancybox")[0]).height());
}

/* form validation plugin */
$.fn.goValidate = function () {
    var $form = this,
            $inputs = $form.find('input:text');

    var validators = {
        name: {
            regex: /^[A-Za-z]{3,}$/
        },
        pass: {
            regex: /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/
        },
        email: {
            regex: /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/
        },
        phone: {
            regex: /^[2-9]\d{2}-\d{3}-\d{4}$/,
        }
    };
    var validate = function (klass, value) {
        var isValid = true,
                error = '';

        if (!value && /required/.test(klass)) {
            error = 'This field is required';
            isValid = false;
        } else {
            klass = klass.split(/\s/);
            $.each(klass, function (i, k) {
                if (validators[k]) {
                    if (value && !validators[k].regex.test(value)) {
                        isValid = false;
                        error = validators[k].error;
                    }
                }
            });
        }
        return {
            isValid: isValid,
            error: error
        }
    };
    var showError = function ($input) {
        var klass = $input.attr('class'),
                value = $input.val(),
                test = validate(klass, value);

        $input.removeClass('invalid');
        $('#form-error').addClass('hide');

        if (!test.isValid) {
            $input.addClass('invalid');

            if (typeof $input.data("shown") == "undefined" || $input.data("shown") == false) {
                $input.popover('show');
            }

        } else {
            $input.popover('hide');
        }
    };

    $inputs.keyup(function () {
        showError($(this));
    });

    $inputs.on('shown.bs.popover', function () {
        $(this).data("shown", true);
    });

    $inputs.on('hidden.bs.popover', function () {
        $(this).data("shown", false);
    });

    $form.submit(function (e) {

        $inputs.each(function () { /* test each input */
            if ($(this).is('.required') || $(this).hasClass('invalid')) {
                showError($(this));
            }
        });
        if ($form.find('input.invalid').length) { /* form is not valid */
            e.preventDefault();
            $('#form-error').toggleClass('hide');
        }
    });
    return this;
};
$('form').goValidate();

function updateViewsAd(ide) {

    $.ajax({
        type: "POST",
        url: "http://localhost:8080/mkt/mkt/Service/Clients/AdViews",
        data: {AdId: ide}
    }).done(function (data) {
        if (data) {
            console.log("view registrado");
        } else {
            console.log("view error");
        }

        //modal.open();
    }).error(function () {
        //loadingModal.close();

        console.log("error service ad");
    }
    );
}
function updatePrintsAd(ide) {

    $.ajax({
        type: "POST",
        url: "http://localhost/mkt/mkt/Service/Clients/AdPrints",
        data: {AdId: ide}
    }).done(function (data) {
        if (data) {
            console.log("print registrado");
        } else {
            console.log("print error");
        }

        //modal.open();
    }).error(function () {
        //loadingModal.close();

        console.log("error service ad");
    }
    );
}

function saveCompra() {
    var venId = $('#formCompra #idVenta').val();
    var cedula = $('#formCompra #cedula').val();
    var nombre = $('#formCompra #nombre').val();
    var email = $('#formCompra #email').val();
    var telefono = $('#formCompra #celular').val();
    var pais = $('#formCompra #pais').val();
    var ciudad = $('#formCompra #ciudad').val();
    var codpostal = $('#formCompra #codpostal').val();
    var direccion1 = $('#formCompra #direccion').val();
    var direccion2 = $('#formCompra #direccion2').val();
    var pais2 = $('#formCompra #pais2').val();
    var ciudad2 = $('#formCompra #ciudad2').val();
    var codpostal2 = $('#formCompra #codpostal2').val();
    var descripcion = $('#formCompra #descripcion').val();
    var total = $('#formCompra #total').val();
    var metodo = $('input[name=metodo]:checked').val();



    if (cedula === "" || cedula === "" || email === "" || telefono === "" || pais === "" || ciudad === "" || direccion1 === "") {
        swal("Info", "Por favor revise los datos del formulario !!!", "warning");
    } else {
        if (metodo) {
            $.ajax({
                type: "POST",
                url: "http://localhost:8080/mkt/mkt/Service/Clients/SaveCompra",
                data: {
                    VenId: venId,
                    Nombre: nombre,
                    Cedula: cedula,
                    Email: email,
                    Telefono: telefono,
                    Pais: pais,
                    Ciudad: ciudad,
                    CodPostal: codpostal,
                    Direccion: direccion1,
                    Direccion2: direccion2,
                    Pais2: pais2,
                    Ciudad2: ciudad2,
                    CodPostal2: codpostal2,
                    Descripcion: descripcion,
                    Total: total,
                    Metodo: 'cheque'}
            }).done(function (data) {

                swal("Exito", "Su perfil ha sido actualizado!!!", "success");
            }).error(function () {

            });
        } else {
            swal("Info", "Seleccione un metedo de pago", "warning");
        }

    }
}

function sendContact() {
    var name = $('#formContact #name').val();
    var message = $('#formContact #message').val();
    var email = $('#formContact #email').val();
    var phone = $('#formContact #phone').val();

    if (name === "" || email === "" || message === "" || phone === "") {
        swal("", "Por favor revise los datos del formulario !!!", "warning");
        console.log("Por favor revise los datos del formulario !!!");
    } else {

        $.ajax({
            type: "POST",
            url: "http://localhost:8080/mkt/mkt/Service/Contact/Save",
            data: {
                Name: name,
                Email: email,
                Phone: phone,
                Message: message
            }
        }).done(function (data) {
            console.log("Exito");
            swal("", "Su mensaje fue enviado con exito", "success");
            $('#formContact #name').val("");
            $('#formContact #message').val("");
            $('#formContact #email').val("");
            $('#formContact #phone').val("");
        }).error(function () {

        });


    }
}


      





