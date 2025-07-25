(function ($) {
    "use strict";
    jQuery(".dropdown-icon").on("click", function () {
        jQuery(this).toggleClass("active").next("ul").slideToggle();
        jQuery(this).parent().siblings().children("ul").slideUp();
        jQuery(this).parent().siblings().children(".active").removeClass("active");
    });
    window.addEventListener("scroll", function () {
        const header = document.querySelector("header.style-1, header.style-2, header.style-3, header.style-4, header.style-5");
        header.classList.toggle("sticky", window.scrollY > 0);
    });
    $(".sidebar-button").on("click", function () {
        $(".main-menu").addClass("show-menu");
    });
    $(".menu-close-btn").on("click", function () {
        $(".main-menu").removeClass("show-menu");
    });
    $(".search-btn").on("click", function () {
        $(".mobile-search").addClass("slide");
    });
    $(".search-cross-btn").on("click", function () {
        $(".mobile-search").removeClass("slide");
    });
    $(".counter-single").each(function () {
        $(this).isInViewport(function (status) {
            if (status === "entered") {
                for (var i = 0; i < document.querySelectorAll(".odometer").length; i++) {
                    var el = document.querySelectorAll(".odometer")[i];
                    el.innerHTML = el.getAttribute("data-odometer-final");
                }
            }
        });
    });
    jQuery(window).on("load", function () {
        $(".egns-preloader").delay(1600).fadeOut("slow");
    });
    $(".grid").isotope({ itemSelector: ".grid-item" });
    $(".filter-button-group").on("click", "li", function () {
        var filterValue = $(this).attr("data-filter");
        $(".grid").isotope({ filter: filterValue });
        $(".filter-button-group li").removeClass("active");
        $(this).addClass("active");
    });
    $(".filter-button-group").on("click", "li", function () {
        var filterValue = $(this).attr("data-filter");
        $(".grid-two").isotope({ filter: filterValue });
        $(".filter-button-group li").removeClass("active");
        $(this).addClass("active");
    });
    $(".grid").masonry({ itemSelector: ".grid-item" });
    $("select").niceSelect();
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");
    if (togglePassword) {
        togglePassword.addEventListener("click", function (e) {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            this.classList.toggle("bi-eye");
        });
    }
    const togglePassword2 = document.getElementById("togglePassword2");
    const password2 = document.querySelector("#password2");
    if (togglePassword2) {
        togglePassword2.addEventListener("click", function (e) {
            const type = password2.getAttribute("type") === "password" ? "text" : "password";
            password2.setAttribute("type", type);
            this.classList.toggle("bi-eye");
        });
    }
    $(".popup-youtube").magnificPopup({ type: "iframe" });
    $('[data-fancybox="gallery"]').fancybox({ buttons: ["slideShow", "thumbs", "zoom", "fullScreen", "share", "close"], loop: false, protect: true });
    $(function () {
        $("#datepicker").datepicker();
        $("#datepicker2").datepicker();
    });
    // if ($('input[type="number').length) {
    //     $('input[type="number"]').niceNumber({ buttonDecrement: '<i class="bi bi-dash"></i>', buttonIncrement: '<i class="bi bi-plus"></i>' });
    // }
    $(function () {
        $("#datepicker").datepicker({ dateFormat: "yy-mm-dd" });
        $(".timepicker").timepicker({ timeFormat: "h:mm p", interval: 30, minTime: "06", maxTime: "23:55pm", defaultTime: "06", startTime: "01:00", dynamic: true, dropdown: true, scrollbar: false });
    });
    $("[data-countdown]").each(function () {
        var $deadline = new Date($(this).data("countdown")).getTime();
        var $dataDays = $(this).children("[data-days]");
        var $dataHours = $(this).children("[data-hours]");
        var $dataMinutes = $(this).children("[data-minutes]");
        var $dataSeconds = $(this).children("[data-seconds]");
        var x = setInterval(function () {
            var now = new Date().getTime();
            var t = $deadline - now;
            var days = Math.floor(t / (1000 * 60 * 60 * 24));
            var hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((t % (1000 * 60)) / 1000);
            $dataDays.html(`${days} <span>Days</span>`);
            $dataHours.html(`${hours} <span>Hours</span>`);
            $dataMinutes.html(`${minutes} <span>Mins</span>`);
            $dataSeconds.html(`${seconds} <span>Secs</span>`);
            if (t <= 0) {
                clearInterval(x);
                $dataDays.html("00");
                $dataHours.html("00");
                $dataMinutes.html("00");
                $dataSeconds.html("00");
            }
        }, 1000);
    });
    var swiper = new Swiper(".home1-services-slider", {
        slidesPerView: 4,
        spaceBetween: 24,
        loop: true,
        speed: 1500,
        autoplay: { delay: 2000 },
        navigation: { nextEl: ".next-btn-1", prevEl: ".prev-btn-1" },
        breakpoints: { 280: { slidesPerView: 1, spaceBetween: 15 }, 480: { slidesPerView: 1 }, 768: { slidesPerView: 2 }, 992: { slidesPerView: 3 }, 1200: { slidesPerView: 4 }, 1400: { slidesPerView: 4 }, 1600: { slidesPerView: 4 } },
    });
    var swiper = new Swiper(".h1-testimonial-slider", {
        slidesPerView: 4,
        spaceBetween: 24,
        loop: true,
        speed: 1500,
        autoplay: { delay: 1800 },
        navigation: { nextEl: ".next-btn-1", prevEl: ".prev-btn-1" },
        breakpoints: { 280: { slidesPerView: 1, spaceBetween: 15 }, 480: { slidesPerView: 2 }, 768: { slidesPerView: 2 }, 992: { slidesPerView: 3 }, 1200: { slidesPerView: 4 }, 1400: { slidesPerView: 4 }, 1600: { slidesPerView: 4 } },
    });
    var swiper = new Swiper(".team-slider-1", {
        slidesPerView: 4,
        spaceBetween: 24,
        loop: true,
        speed: 1500,
        autoplay: { delay: 2200 },
        navigation: { nextEl: ".next-btn-2", prevEl: ".prev-btn-3" },
        breakpoints: { 280: { slidesPerView: 1, spaceBetween: 15 }, 480: { slidesPerView: 2 }, 768: { slidesPerView: 3 }, 992: { slidesPerView: 3 }, 1200: { slidesPerView: 4 }, 1400: { slidesPerView: 4 }, 1600: { slidesPerView: 4 } },
    });
    var swiper = new Swiper(".gallery-1", {
        slidesPerView: 4,
        spaceBetween: 12,
        loop: true,
        speed: 1500,
        autoplay: { delay: 2200 },
        navigation: { nextEl: ".next-btn-2", prevEl: ".prev-btn-3" },
        breakpoints: { 280: { slidesPerView: 2, spaceBetween: 10 }, 480: { slidesPerView: 4 }, 768: { slidesPerView: 5 }, 992: { slidesPerView: 6 }, 1200: { slidesPerView: 7 }, 1400: { slidesPerView: 8 }, 1600: { slidesPerView: 9 } },
    });
    var swiper = new Swiper(".hero2-slider", { slidesPerView: 1, spaceBetween: 12, effect: "fade", loop: true, speed: 1500, autoplay: { delay: 3000 }, pagination: { el: ".swiper-pagination121", clickable: true } });
    var swiper = new Swiper(".h3-offer-slider", { slidesPerView: 1, spaceBetween: 12, loop: true, speed: 1500, autoplay: { delay: 3000 }, navigation: { nextEl: ".next-btn-15", prevEl: ".prev-btn-15" } });
    var swiper = new Swiper(".hero3-slider", {
        slidesPerView: 1,
        spaceBetween: 12,
        effect: "fade",
        loop: true,
        speed: 1500,
        autoplay: { delay: 3000 },
        keyboard: { enabled: true },
        navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
        pagination: {
            el: ".h3-hero-slider-pagination",
            clickable: true,
            renderBullet: function (index, className) {
                return '<span class="' + className + '">' + 0 + (index + 1) + "</span>";
            },
        },
    });
    var swiper = new Swiper(".h2-services-slider", {
        slidesPerView: 5,
        centeredSlides: true,
        loop: true,
        speed: 1500,
        autoplay: { delay: 2200 },
        navigation: { nextEl: ".next-btn-2", prevEl: ".prev-btn-3" },
        breakpoints: {
            280: { slidesPerView: 1, centeredSlides: false },
            480: { slidesPerView: 2, centeredSlides: false },
            768: { slidesPerView: 3, centeredSlides: false },
            992: { slidesPerView: 3 },
            1200: { slidesPerView: 5 },
            1400: { slidesPerView: 5 },
            1600: { slidesPerView: 5 },
        },
    });
    var swiper = new Swiper(".h2-testimonial-slider", {
        spaceBetween: 24,
        slidesPerView: 2,
        loop: true,
        speed: 2000,
        autoplay: { delay: 3000 },
        navigation: { nextEl: ".next-btn-5", prevEl: ".prev-btn-5" },
        breakpoints: { 280: { slidesPerView: 1 }, 480: { slidesPerView: 1 }, 768: { slidesPerView: 1 }, 992: { slidesPerView: 2 }, 1200: { slidesPerView: 2 }, 1400: { slidesPerView: 2 }, 1600: { slidesPerView: 2 } },
    });
    var swiper = new Swiper(".h2-team-slider", {
        spaceBetween: 24,
        slidesPerView: 2,
        loop: true,
        speed: 1500,
        autoplay: { delay: 2200 },
        pagination: { el: ".team-pagination", clickable: true },
        breakpoints: {
            280: { slidesPerView: 1 },
            480: { slidesPerView: 2 },
            768: { slidesPerView: 3 },
            992: { slidesPerView: 3 },
            1200: { slidesPerView: 4 },
            1400: { slidesPerView: 4 },
            1500: { slidesPerView: 5 },
            1600: { slidesPerView: 5 },
        },
    });
    var swiper = new Swiper(".h3-category-slider", {
        spaceBetween: 24,
        slidesPerView: 6,
        loop: true,
        speed: 1500,
        autoplay: { delay: 2200 },
        navigation: { nextEl: ".next-btn-11", prevEl: ".prev-btn-11" },
        breakpoints: { 280: { slidesPerView: 1 }, 420: { slidesPerView: 2 }, 768: { slidesPerView: 3 }, 992: { slidesPerView: 4 }, 1200: { slidesPerView: 5 }, 1400: { slidesPerView: 6 }, 1600: { slidesPerView: 6 } },
    });
    var swiper = new Swiper(".essential-items-slider", {
        spaceBetween: 24,
        slidesPerView: 6,
        loop: true,
        speed: 1500,
        autoplay: { delay: 2200 },
        navigation: { nextEl: ".next-btn-12", prevEl: ".prev-btn-12" },
        breakpoints: { 280: { slidesPerView: 1 }, 420: { slidesPerView: 2 }, 768: { slidesPerView: 3 }, 992: { slidesPerView: 3 }, 1200: { slidesPerView: 4 }, 1400: { slidesPerView: 5 }, 1600: { slidesPerView: 5 } },
    });
    var swiper = new Swiper(".h3-testimonil-slider", {
        spaceBetween: 24,
        slidesPerView: 3,
        loop: true,
        speed: 1500,
        autoplay: { delay: 2200 },
        navigation: { nextEl: ".next-btn-12", prevEl: ".prev-btn-12" },
        breakpoints: { 280: { slidesPerView: 1 }, 420: { slidesPerView: 1 }, 768: { slidesPerView: 2 }, 992: { slidesPerView: 2 }, 1200: { slidesPerView: 3 }, 1400: { slidesPerView: 3 }, 1600: { slidesPerView: 3 } },
    });
    var swiper = new Swiper(".h2-partner", {
        spaceBetween: 24,
        slidesPerView: 3,
        loop: true,
        speed: 1500,
        autoplay: { delay: 2200 },
        navigation: { nextEl: ".next-btn-12", prevEl: ".prev-btn-12" },
        breakpoints: { 280: { slidesPerView: 2 }, 420: { slidesPerView: 3 }, 768: { slidesPerView: 4 }, 992: { slidesPerView: 5 }, 1200: { slidesPerView: 6 }, 1400: { slidesPerView: 6 }, 1600: { slidesPerView: 6 } },
    });
    $("#price-range-submit").hide();
    // $("#min_price,#max_price").on("change", function () {
    //     $("#price-range-submit").show();
    //     var min_price_range = $("#min_price").val();
    //     var max_price_range = $("#max_price").val();
    //     if (min_price_range > max_price_range) {
    //         $("#max_price").val(min_price_range);
    //     }
    //     $("#slider-range").slider({ values: [min_price_range, max_price_range] });
    // });
    // $("#min_price,#max_price").on("paste keyup", function () {
    //     $("#price-range-submit").show();
    //     var min_price_range = parseInt($("#min_price").val(), 10);
    //     var max_price_range = parseInt($("#max_price").val(), 500);
    //     if (min_price_range == max_price_range) {
    //         max_price_range = min_price_range + 100;
    //         $("#min_price").val(min_price_range);
    //         $("#max_price").val(max_price_range);
    //     }
    //     $("#slider-range").slider({ values: [min_price_range, max_price_range] });
    // });
    // $(function () {
    //     $("#slider-range").slider({
    //         range: true,
    //         orientation: "horizontal",
    //         min: 0,
    //         max: 5000,
    //         values: [0, 500],
    //         step: 10,
    //         slide: function (event, ui) {
    //             if (ui.values[0] == ui.values[1]) {
    //                 return false;
    //             }
    //             $("#min_price").val(ui.values[0]);
    //             $("#max_price").val(ui.values[1]);
    //         },
    //     });
    //     $("#min_price").val($("#slider-range").slider("values", 0));
    //     $("#max_price").val($("#slider-range").slider("values", 1));
    // });
    // $("#slider-range,#price-range-submit").on("click", function () {
    //     var min_price = $("#min_price").val();
    //     var max_price = $("#max_price").val();
    //     $("#searchResults").text("Here List of products will be shown which are cost between " + min_price + " " + "and" + " " + max_price + ".");
    // });
    $(function () {
        $("#slider-range-mobile").slider({
            range: true,
            orientation: "horizontal",
            min: 0,
            max: 500,
            values: [0, 500],
            step: 10,
            slide: function (event, ui) {
                if (ui.values[0] == ui.values[1]) {
                    return false;
                }
                $("#min_price-mobile").val(ui.values[0]);
                $("#max_price-mobile").val(ui.values[1]);
            },
        });
        $("#min_price-mobile").val($("#slider-range-mobile").slider("values", 0));
        $("#max_price-mobile").val($("#slider-range-mobile").slider("values", 1));
    });
    $("#slider-range-mobile,#price-range-submit").on("click", function () {
        var min_price = $("#min_price-mobile").val();
        var max_price = $("#max_price-mobile").val();
        $("#searchResults").text("Here List of products will be shown which are cost between " + min_price + " " + "and" + " " + max_price + ".");
    });
    $(".marquee_text").marquee({ direction: "left", duration: 50000, gap: 50, delayBeforeStart: 0, duplicated: true, startVisible: true });
    $("#js-rotating").Morphext({ animation: "flipInX", separator: ",", speed: 4000, complete: function () {} });
})(jQuery);