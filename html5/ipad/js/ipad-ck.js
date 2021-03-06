function c() {
    var a = new Date;
    datestring = d(a.getHours()) + ":" + d(a.getMinutes());
    $(".time").html(datestring)
}
function d(a) {
    return a < 10 ? a = "0" + a: a
}
function e(a) {
    if (canScroll && a >= 0 && a <= _pages) {
        canScroll = !1;
        $("#drag").draggable("disable");
        $("#pages li").removeClass("active").eq(a).addClass("active");
        a == 0 ? $("#black,.corner").animate({
            opacity: 1
        },
        300, "easeOutQuad", 
        function() {
            $("#search").focus()
        }) : $("#black,.corner").animate({
            opacity: 0
        },
        100, "easeOutQuad");
        $("#general_wrap").scrollTo("#page" + a, 800, {
            easing: "easeOutQuint",
            onAfter: function() {
                canScroll = !0;
                $("#drag").draggable("enable");
                _page = a
            }
        })
    }
}
function f() {
    $("#general_wrap").scrollTo("#page1", 0);
    $("#lockscreen").addClass("hidden").delay(200).fadeOut();
    $("#content").removeClass("hide_spring");
    $("#slider").css("left", 0);
    n("in")
}
function g() {
    if (isDblClick) return;
    $(".asleep").length && $(".asleep").removeClass("asleep").removeClass("hidden");
    if ($("body").hasClass("multitaskMode")) l();
    else if ($("body").hasClass("editMode")) {
        $("body").removeClass("editMode");
        $(".apps").sortable("destroy")
    } else if ($("#window").is(".out")) p();
    else if (folder_open) s();
    else {
        $("#drag").css("left", 0);
        e(1)
    }
}
function h() {
    isDblClick = !0;
    $(".asleep").length && (isDblClick = !1);
    k();
    t = setTimeout("isDblClick = false;", 200);
    return ! 1
}
function i() {
    can_run_apps = !1;
    clearTimeout(a);
    $("body").addClass("editMode");
    $(".apps").sortable({
        distance: 100,
        revert: !0,
        handle: ".app_logo",
        connectWith: ".apps",
        appendTo: "#content",
        helper: "clone",
        distance: 0,
        over: function(a, b) {
            $(b.placeholder).parents("#drag").length && e($("#drag ul").index($(b.placeholder).parent()))
        },
        change: function(a, b) {
            $(b.placeholder).css({
                width: 0,
                "margin-left": 0,
                "margin-right": 0
            }).animate({
                width: 75,
                "margin-right": 50,
                "margin-left": 50
            },
            150)
        },
        start: function(a, b) {
            $(b.placeholder).animate({
                width: 1,
                "margin-right": 0,
                "margin-left": 0,
                overflow: "hidden"
            },
            150)
        },
        stop: function(a, b) {
            m();
            $(b.item).removeClass("mousedown")
        }
    });
    $(".folder").droppable({
        tolerance: "pointer",
        revert: !1,
        drop: function(a, b) {
            b.helper.css("display", "none").remove();
            b.draggable.clone(!0).attr("data-id", b.draggable.attr("id")).attr("id", "").removeClass("mousedown").appendTo($(a.target).find("ul")).show().css({
                position: "relative"
            });
            b.draggable.css("display", "none").remove();
            $(a.target).removeClass("over");
            $(b.helper).appendTo($(a.target).find("ul"))
        },
        over: function(a, b) {
            folder_timeout = setTimeout(function() {
                $(a.target).addClass("over");
                $(b.helper).addClass("overFolder")
            },
            500)
        },
        out: function(a, b) {
            clearTimeout(folder_timeout);
            $(a.target).removeClass("over");
            $(b.helper).removeClass("overFolder")
        }
    });
    window.clearInterval(a)
}
function j() {
    can_run_apps = !1;
    clearTimeout(a);
    $("#multitask_bar").addClass("editMode")
}
function k() {
    can_run_apps = !1;
    $("#window").is(".out") ? $("#multitask_bar #" + active_app).hide().siblings().show() : $("#multitask_bar li").show();
    $("#content").animate({
        bottom: 120
    },
    200);
    $(".page,#dock").animate({
        opacity: .5
    },
    200);
    $(".topbar, #pages").fadeOut(200);
    $("body").addClass("multitaskMode")
}
function l(a) {
    var b = a || 200;
    $("#content").removeClass("multitask").animate({
        bottom: 0
    },
    b);
    $(".page,#dock").animate({
        opacity: 1
    },
    b);
    $(".topbar, #pages").fadeIn(b);
    $("body").removeClass("multitaskMode");
    $("#multitask_bar").removeClass("editMode")
}
function m() {
    $(".reflection").remove();
    $("#dock li .app_logo").each(function() {
        $(this).clone().addClass("reflection").appendTo($(this).parent())
    })
}
function n(a) {
    $("#page" + _page + ".apps>li").each(function() {
        _origLeft = $(this).position().left;
        _origTop = $(this).position().top;
        switch (_origLeft) {
        case 0:
        case - 200: _newLeft = -200;
            break;
        case 174:
        case - 250: _newLeft = -250;
            break;
        case 348:
        case 0:
            _newLeft = 0;
            break;
        case 522:
        case 250:
            _newLeft = 250;
            break;
        case 696:
        case 200:
            _newLeft = 200
        }
        switch (_origTop) {
        case 10:
        case - 450: _newTop = -450;
            break;
        case 136:
        case - 450: _newTop = -450;
            break;
        case 262:
        case 450:
            _newTop = 450;
            break;
        case 388:
        case 450:
            _newTop = 450
        }
        switch (a) {
        case "in":
            $(this).css({
                left:
                _newLeft,
                top: _newTop,
                position: "relative"
            }).animate({
                left: 0,
                top: 0
            },
            500, "easeOutQuad");
            break;
        case "outin":
            $(this).animate({
                left:
                0,
                top: 0
            },
            500, "easeOutQuad");
            break;
        default:
            $(this).css({
                position:
                "relative"
            }).animate({
                left:
                _newLeft,
                top: _newTop
            },
            500, "easeOutQuad")
        }
    });
    switch (a) {
    case "out":
        $("#dock,#pages").animate({
            bottom:
            -120
        },
        500, "easeOutQuad");
        break;
    case "in":
    case "outin":
        $("#dock").animate({
            bottom:
            0
        },
        500, "easeOutQuad");
        $("#pages").animate({
            bottom: 120
        },
        500, "easeOutQuad")
    }
}
function o(a) {
    if (a == active_app) return ! 1;
    l(0);
    $("#" + active_app + "_app").addClass("flip_top");
    $("#" + a + "_app").addClass("flip_bottom");
    var b = $("#" + active_app + "_app")[0];
    $(b).bind("webkitAnimationEnd", 
    function() {
        $("#" + a + "_app").removeClass("flip_bottom").addClass("onFront").siblings().removeClass("flip_top onFront");
        $("#iframe_holder iframe").unbind("webkitAnimationEnd")
    },
    !1);
    if (!$.browser.webkit) {
        $("#" + a + "_app").removeClass("flip_bottom").addClass("onFront").siblings().removeClass("flip_top onFront");
        $("#iframe_holder iframe").unbind("webkitAnimationEnd")
    }
    active_app = a
}
function p() {
    $("#iframe_holder").css({
        opacity: 0,
        display: "none"
    });
    $("#window").removeClass("out").stop().html("").animate({
        left: "50%",
        width: 1,
        top: "50%",
        height: 1,
        opacity: 0
    },
    "easeInQuint", 
    function() {});
    folder_open || n("outin");
    $(".topbar").removeClass("inapp");
    window.location.hash = "#spring"
}
function q(a) {
    if (folder_open && !$("#" + a).is("#folder_cont li")) {
        s();
        return ! 1
    }
    if ($("#" + a).is(".folder")) {
        r(a);
        return ! 1
    }
    if (!can_run_apps) return ! 1;
    if (a == "Safari") {
        flag = confirm("!! important !! in order to simulate a browser in browser, I'm parsing all websites you may try to access, please DO NOT post any personal info via this simulator! (your browser may warn you about this site being reported phishing attac, this is because I use techniques that may be used for harm, again DO NOT POST any PERSONAL info!");
        if (!flag) return ! 1
    }
    folder_open || n("out");
    _appToLaunch = "?appid=" + a || null;
    $("#window").addClass("out").stop().animate({
        left: "0%",
        width: 885,
        top: "0%",
        height: 662,
        opacity: 1
    },
    "easeInQuint", 
    function() {
        $("#iframe_holder").css({
            opacity: 1,
            display: "block"
        });
        if (!$("#" + a + "_app").length) {
            $("#iframe_holder iframe").removeClass("onFront");
            $("#iframe_holder").append('<iframe id="' + a + '_app" class="app_iframe" src="app.html' + _appToLaunch + '" scrolling="no" width="884" height="641"></iframe>');
            $("#" + a + "_app").addClass("onFront");
            $("#" + a).clone().prependTo("#multitask_bar ul").find(".delete").html("&ndash;");
            $("#multitask_bar li").length > 4 && $("#multitask_bar li").last().remove()
        } else {
            $("#" + a + "_app").addClass("onFront").siblings().removeClass("onFront");
            $("#multitask_bar #" + a).prependTo("#multitask_bar ul")
        }
    });
    active_app = a;
    window.location.hash = "!" + active_app;
    $(".topbar").addClass("inapp")
}
function r(a) {
    var b = $("#" + a),
    c = b.find("ul").html(),
    d = b.find("ul li").length,
    e = d < 6 ? 180: d < 11 ? 360: d < 3 ? 520: 700,
    f = b.parent().children().index(b),
    g = f < 5 ? 0: f < 10 ? -125: f < 15 ? -251: -376;
    b.addClass("open_folder");
    $("#drag").animate({
        top: g
    },
    200, "easeOutQuad", 
    function() {});
    $("#folder_cont").empty().append('<ul class="apps page"></ul>').find("ul").append(c).end().addClass("folder_open").animate({
        height: e
    },
    500, "easeOutQuad");
    $.each($("#folder_cont").find(".app"), 
    function() {
        $(this).attr("id", $(this).attr("data-id"))
    });
    u();
    folder_open = !0;
    canScroll = !1
}
function s() {
    u();
    $(".open_folder").removeClass("open_folder");
    $("#drag").animate({
        top: 0
    },
    200, "easeOutQuad");
    $("#folder_cont").empty().animate({
        height: 0
    },
    500, "easeOutQuad", 
    function() {
        $(this).removeClass("folder_open")
    });
    folder_open = !1;
    canScroll = !0
}
function u() {
    if (!folder_open) $("#dock,#pages").animate({
        bottom: -120
    },
    500, "easeOutQuad");
    else {
        $("#pages").animate({
            bottom: 120
        },
        500, "easeOutQuad");
        $("#dock").animate({
            bottom: 0
        },
        500, "easeOutQuad")
    }
}
var a = 0;
can_run_apps = !1,
folder_open = !1,
tick = "",
doubleclickthreshhold = 200,
isDblClick = !1,
canScroll = !0,
active_app = "";
$(".page .delete,#dock .delete").live("click", 
function(a) {
    a.stopPropagation();
    a.stopImmediatePropagation();
    if (confirm("Are you sure you want to delete this app from you iPad?")) {
        $(this).parent().css({
            width: 74,
            height: 99
        }).children(".delete, span").hide();
        $(this).siblings(".app_logo").stop().css("position", "absolute").animate({
            left: "50%",
            width: 1,
            top: "50%",
            height: 1
        },
        "easeInQuint", 
        function() {
            $(this).parent().remove()
        })
    }
});
$("#multitask_bar .delete").live("mousedown ", 
function(a) {
    a.stopPropagation();
    a.stopImmediatePropagation();
    $(this).parent().css({
        width: 74,
        height: 99
    }).children(".delete, span").hide();
    $(this).siblings(".app_logo").stop().css("position", "absolute").animate({
        left: "50%",
        width: 1,
        top: "50%",
        height: 1
    },
    "easeInQuint", 
    function() {
        _id = $(this).parent().attr("id");
        $("#" + _id + "_app").remove();
        $(this).parent().remove();
        $("#multitask_bar li").length || l(200)
    })
});
$(".page.apps>li,#dock li").live("mousedown mouseup", 
function(b) {
    if (b.type == "mousedown") {
        $(this).addClass("mousedown");
        if (!$("#drag").is(".ui-draggable-dragging") && !$("body").is(".editMode")) {
            can_run_apps = !0;
            a = setTimeout(i, "1000")
        } else if ($(this).hasClass("folder") && $("body").is(".editMode")) {
            r($(this).attr("id"));
            return ! 1
        }
    } else {
        $(this).removeClass("mousedown");
        clearTimeout(a);
        can_run_apps ? !$("#drag").is(".ui-draggable-dragging") && !$("body").is(".editMode") && !$("body").is(".multitaskMode") && q($(this).attr("id")) : clearTimeout(a)
    }
});
$("#search_result li.show").live("click", 
function() {
    can_run_apps = !0;
    var a = $(this).find(".search_str").html();
    q(a)
});
$("#multitask_bar li").live("mousedown mouseup", 
function(b) {
    if (b.type == "mousedown") {
        $(this).addClass("mousedown");
        if (!$("#multitask_bar").is(".editMode")) {
            can_run_apps = !0;
            a = setTimeout("multitask_edit_mode()", "2000")
        }
    } else {
        $(this).removeClass("mousedown");
        clearTimeout(a);
        if (!can_run_apps) clearTimeout(a);
        else if (!$("#multitask_bar").is(".editMode")) {
            o($(this).attr("id"));
            if (!$("#window").is(".out")) {
                can_run_apps = !0;
                l(0);
                q($(this).attr("id"))
            }
        }
    }
});
$("#slider").live("mousedown mouseup", 
function(a) {
    a.type == "mousedown" ? $("#slide_here").css("background-position", "1500px 1500px") : $("#slide_here").css("background-position", "right 50%")
});
$("#home").live("click", 
function(a) {
    b = setTimeout(g, doubleclickthreshhold)
});
$("#home").live("dblclick", h);
$("#content").live("click", 
function(a) {
    $("body").is(".multitaskMode") && l()
});
$("#sleep").live("click", 
function() {
    $("#lockscreen").addClass("hidden").addClass("asleep").show();
    $("#content").addClass("hide_spring")
});
$(document).ready(function() {
    _page = 1;
    _pages = $("ul.page").length;
    m();
    $(".page.apps li,#dock li").each(function() {
        if ($(this).attr("id") != "") {
            _img = $(".app_logo", this).css("background-image").replace('"', "'");
            _elm = $('<li><div class="app_logo" style="background-image:' + _img + '"></div><span class="search_str">' + $(this).attr("id") + "</span> </li>");
            _elm.appendTo("#search_result");
            if ("#!" + $(this).attr("id") == window.location.hash) {
                can_run_apps = !0;
                q($(this).attr("id"))
            }
        }
    });
    $("#search").liveUpdate($("#search_result"));
    $("#search_result").draggable({
        axis: "y",
        distance: 20,
        revert: "invalid"
    });
    tick = setInterval(function() {
        c()
    },
    1e3);
    $("#slider").draggable({
        axis: "x",
        containment: "parent",
        revert: "invalid"
    });
    $("#drop").droppable({
        drop: f
    });
    $("#drag").draggable({
        axis: "x",
        distance: 50,
        start: function() {
            if (!canScroll) return ! 1;
            window._dragStart = $("#drag").css("left")
        },
        stop: function() {
            window._dragEnd = $("#drag").css("left");
            parseInt(window._dragStart) < parseInt(window._dragEnd) ? _page > 0 ? e(_page - 1) : e(_page) : _page < _pages ? e(_page + 1) : e(_page)
        }
    }).click(function(a) {
        if (folder_open && $(a.target).parents(".folder").length == 0) {
            s();
            return ! 1
        }
    });
    $(document).keydown(function(a) {
        a.keyCode == 39 ? e(_page + 1) : a.keyCode == 37 ? e(_page - 1) : a.keyCode == 27 && g()
    })
});