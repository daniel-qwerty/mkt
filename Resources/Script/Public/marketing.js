/**
 * Created by Suaznabar on 7/28/2016.
 */
isMobile = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
$(document).ready(function () {

});


$(window).load(function () {
    "use strict";
    $('html, body').animate({scrollTop: 0}, 1);
    $("#preloader").fadeOut(); // will first fade out the loading animation
    $("#preload").delay(150).fadeOut("slow");
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
    $("#bienvenido").animate({
        left: "0"
    }, 5000, "swing", function () {
        // Animation complete.
    });
}

updateHeight = function () {
    if (isMobile)
        $(".insta-btn-wrap").height(60);
    else
        $(".insta-btn-wrap").height($($("a.img-thumbnail-variant-3.fancybox")[0]).height());
}


