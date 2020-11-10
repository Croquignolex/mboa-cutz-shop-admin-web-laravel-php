$(document).ready(function() {
    /*======== START SCROLLBAR SIDEBAR ========*/
    let sidebarScrollbar = $(".sidebar-scrollbar");
    // Innit scrollbar
    if (sidebarScrollbar.length !== 0) {
        sidebarScrollbar
            .slimScroll({
                opacity: 0,
                height: `${$(window).height() - 100}px`,
                color: "#808080",
                size: "5px",
                touchScrollStep: 50
            })
            .mouseover(function () {
                $(this).next(".slimScrollBar").css("opacity", 0.7);
            });
    }
    /*======== END SCROLLBAR SIDEBAR ========*/

    /*========  START BACKDROP ========*/
    if ($(window).width() < 768) {
        // Show black drop
        $(".sidebar-toggle").on("click", function () {
            $('body').prepend('<div class="mobile-sticky-body-overlay"></div>');

            let shadowClass = $(".mobile-sticky-body-overlay");
            shadowClass.addClass("active");
            $("body").css("overflow", "hidden");
        });
        // Remove black drop
        $(document).on("click", '.mobile-sticky-body-overlay', function (e) {
            $(this).remove();
            $("#body").removeClass("sidebar-minified").addClass("sidebar-minified-out");
            $("body").css("overflow", "auto");
        });
    }
    /*======== END BACKDROP ========*/

    /*======== START SIDEBAR MENU ========*/
    $(".sidebar .nav > .has-sub > a").click(function() {
        // CLode drawer
        $(this).parent().siblings().removeClass('expand')
        $(this).parent().toggleClass('expand')
    })

    $(".sidebar .nav > .has-sub .has-sub > a").click(function(){
        // Toggle drawer
        $(this).parent().toggleClass('expand')
    })
    /*======== END SIDEBAR MENU ========*/

    /*======== START SIDEBAR TOGGLE FOR MOBILE ========*/
    if ($(window).width() < 768) {
        // Manage side bar toggle depending on black drop
        $(document).on("click", ".sidebar-toggle", function(e) {
            e.preventDefault();

            let body = "#body";
            let min = "sidebar-minified";
            let min_out = "sidebar-minified-out";

            $(body).hasClass(min)
                ? $(body).removeClass(min).addClass(min_out)
                : $(body).addClass(min).removeClass(min_out)
        });
    }
    /*======== END SIDEBAR TOGGLE FOR MOBILE ========*/

    /*======== START SIDEBAR TOGGLE ========*/
    let body = $("#body");
    if ($(window).width() >= 768) {
        window.isMinified = false;
        window.isCollapsed = false;

        $("#sidebar-toggler").on("click", function () {
            if (
                body.hasClass("sidebar-fixed-offcanvas") ||
                body.hasClass("sidebar-static-offcanvas")
            ) {
                $(this)
                    .addClass("sidebar-offcanvas-toggle")
                    .removeClass("sidebar-toggle");
                if (window.isCollapsed === false) {
                    body.addClass("sidebar-collapse");
                    window.isCollapsed = true;
                    window.isMinified = false;
                } else {
                    body.removeClass("sidebar-collapse");
                    body.addClass("sidebar-collapse-out");
                    setTimeout(function () {
                        body.removeClass("sidebar-collapse-out");
                    }, 300);
                    window.isCollapsed = false;
                }
            }

            if (
                body.hasClass("sidebar-fixed") ||
                body.hasClass("sidebar-static")
            ) {
                $(this)
                    .addClass("sidebar-toggle")
                    .removeClass("sidebar-offcanvas-toggle");
                if (window.isMinified === false) {
                    body
                        .removeClass("sidebar-collapse sidebar-minified-out")
                        .addClass("sidebar-minified");
                    window.isMinified = true;
                    window.isCollapsed = false;
                } else {
                    body.removeClass("sidebar-minified");
                    body.addClass("sidebar-minified-out");
                    window.isMinified = false;
                }
            }
        });
    }

    if ($(window).width() >= 768 && $(window).width() < 992) {
        if (
            body.hasClass("sidebar-fixed") ||
            body.hasClass("sidebar-static")
        ) {
            body
                .removeClass("sidebar-collapse sidebar-minified-out")
                .addClass("sidebar-minified");
            window.isMinified = true;
        }
    }
    /*======== END SIDEBAR TOGGLE ========*/
});
