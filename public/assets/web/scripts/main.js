/*global $, document*/

$(document).ready(function () {

    'use strict';


    /*********************************************************
        // handle night-mood
    **********************************************************/

    // night-mood status in local storage
    if (!localStorage.nightMood || localStorage.nightMood == 'false') {

        localStorage.nightMood = 'false';

        $("body").removeClass("theme-dark");

    } else {

        localStorage.nightMood = 'true';

        $("body").addClass("theme-dark");

    }

    // night-mood toggle click 
    $("#night-mood-toggle").on("click", function (e) {

        e.preventDefault();

        if ($("body").hasClass("theme-dark")) {

            $("body").removeClass("theme-dark");

            localStorage.nightMood = 'false';

        } else {

            $("body").addClass("theme-dark");

            localStorage.nightMood = 'true';

        }
    });

    /*********************************************************
        // handle side-nav-collapse
    **********************************************************/

    // handling opening and closing drop-down in side-nav
    function openSideNavSelection() {
        $(".side-item-link.active[data-toggle= 'collapse']").removeClass("collapsed").siblings(".collapse").collapse("show");
    }

    function closeSideNavSelection() {
        $(".side-item-link[data-toggle= 'collapse']").siblings(".collapse").collapse("hide");
    }

    // side-nav status in local storage
    if (!localStorage.sideNavCollapsed || localStorage.sideNavCollapsed == 'false') {

        localStorage.sideNavCollapsed = 'false';

        if ($(window).innerWidth() > 1199) {
            $("body").removeClass("side-nav-collapsed");
        } else {
            $("body").addClass("side-nav-collapsed");
        }

        if ($(window).innerWidth() > 1199) {
            openSideNavSelection(0);
        }

    } else {

        localStorage.sideNavCollapsed = 'true';

        $("body").addClass("side-nav-collapsed");

    }


    // handling menu-toggle button
    $("#menu-toggle").on("click", function (e) {

        e.preventDefault();

        if ($("body").hasClass("side-nav-collapsed")) {

            $("body").removeClass("side-nav-collapsed");

            $(".close-side-nav-overlay").fadeIn();

            localStorage.sideNavCollapsed = 'false';

            openSideNavSelection();

        } else {

            $("body").addClass("side-nav-collapsed");

            $(".close-side-nav-overlay").fadeOut();

            localStorage.sideNavCollapsed = 'true';

            closeSideNavSelection();

        }
    });

    // handle side-nav hover on big-screens only
    $(".side-nav").on("mouseenter", function () {
        if ($("body.side-nav-collapsed").length > 0) {

            $("body").addClass("side-nav-expanded");

            openSideNavSelection();

            $(".close-side-nav-overlay").fadeIn();
        }
    });

    $(".side-nav").on("mouseleave", function () {
        if ($("body.side-nav-collapsed").length > 0) {

            closeSideNavSelection();

            $("body").removeClass("side-nav-expanded");

            $(".close-side-nav-overlay").fadeOut();
        }
    });


    // handle click on close-side-nav-overlay
    $(".close-side-nav-overlay").on("click", function () {

        $("body").addClass("side-nav-collapsed");

        $(this).fadeOut();

        localStorage.sideNavCollapsed = 'true';

        closeSideNavSelection();
    });


    // handle side-nav collapse-dropdown click in medium screens
    // $(".side-nav-collapsed .side-item.dropdown > .side-item-link").on("click", function () {
    //     if ($(window).innerWidth() > 575 && $(window).innerWidth() < 1200) {
    //         $("#menu-toggle").trigger("click");
    //     }
    // });


    /*********************************************************
        // handle email-checkbox-change when multi selection
    **********************************************************/

    $(".email-row .main-checkbox input").on("change", function () {
        if ($(this).is(":checked")) {
            $(this).parents(".email-row").addClass("email-row-checked");
        } else {
            $(this).parents(".email-row").removeClass("email-row-checked");
        }

        if ($(".email-row .main-checkbox input:checked").length > 0) {
            $(this).parents("body").find(".email-global-actions").eq(0).find(".email-actions").addClass("active");
        } else {
            $(this).parents("body").find(".email-global-actions").eq(0).find(".email-actions").removeClass("active");
        }
    });


    /*********************************************************
        // changing profile photo
    **********************************************************/

    $("#user-image-input").on("change", function (event) {
        let input = $(this),
            removedImages = $(".user-image > img");

        if (input.val() === "") {
            removedImages.remove();
        } else {
            removedImages.remove();
            $(".user-image").prepend('<img src="' + URL.createObjectURL(event.target.files[0]) + '">');
        }
    });


    /*********************************************************
        // pie circular chart
    **********************************************************/

    $(".box-circle").each(function () {
        let i = 0,
            that = $(this),
            circleBorder = that.find(".circle-border"),
            borderColor = circleBorder.data("color1"),
            animationColor = circleBorder.data("color2"),
            percentageText = that.find(".percentage"),
            percentage = percentageText.data("percentage"),
            degrees = percentage * 3.6;

        circleBorder.css({
            "background-color": animationColor
        });

        setTimeout(function () {
            loopIt();
        }, 1);

        function loopIt() {
            i = i + 1

            if (i < 0) {
                i = 0;
            }

            if (i > degrees) {
                i = degrees;
                return;
            }

            percentage = i / 3.6;
            percentageText.text(percentage.toFixed(1) + " %");

            if (i <= 180) {
                circleBorder.css('background-image', 'linear-gradient(' + (90 + i) + 'deg, transparent 50%,' + borderColor + ' 50%),linear-gradient(90deg, ' + borderColor + ' 50%, transparent 50%)');
            } else {
                circleBorder.css('background-image', 'linear-gradient(' + (i - 90) + 'deg, transparent 50%,' + animationColor + ' 50%),linear-gradient(90deg, ' + borderColor + ' 50%, transparent 50%)');
            }

            setTimeout(function () {
                loopIt();
            }, 1);
        }
    });

});


// handling events after window loading

$(window).on("load", function () {
    $("body").removeClass("no-transition");
});