function d() {
    b = !1
}

function i() {
    if (e) {
        window.clearTimeout(g);
        e = !1;
        f = null
    }
}

function j(a) {
    if (e) return;
    e = !0;
    f = a.changedTouches[0];
    g = window.setTimeout("doRightClick();", 800)
}

function k() {
    e = !1;
    var a = f,
        b = document.createEvent("MouseEvent");
    b.initMouseEvent("mouseup", !0, !0, window, 1, a.screenX, a.screenY, a.clientX, a.clientY, !1, !1, !1, !1, 0, null);
    a.target.dispatchEvent(b);
    b = document.createEvent("MouseEvent");
    b.initMouseEvent("mousedown", !0, !0, window, 1, a.screenX, a.screenY, a.clientX, a.clientY, !1, !1, !1, !1, 2, null);
    a.target.dispatchEvent(b);
    b = document.createEvent("MouseEvent");
    b.initMouseEvent("contextmenu", !0, !0, window, 1, a.screenX + 50, a.screenY + 5, a.clientX + 50, a.clientY + 5, !1, !1, !1, !1, 2, null);
    a.target.dispatchEvent(b);
    h = !0;
    f = null
}

function l(d) {
    var e = d.changedTouches,
        f = e[0],
        g = "mouseover",
        h = document.createEvent("MouseEvent");
    h.initMouseEvent(g, !0, !0, window, 1, f.screenX, f.screenY, f.clientX, f.clientY, !1, !1, !1, !1, 0, null);
    f.target.dispatchEvent(h);
    g = "mousedown";
    h = document.createEvent("MouseEvent");
    h.initMouseEvent(g, !0, !0, window, 1, f.screenX, f.screenY, f.clientX, f.clientY, !1, !1, !1, !1, 0, null);
    f.target.dispatchEvent(h);
    if (!b) {
        a = f.target;
        b = !0;
        c = window.setTimeout("cancelTap();", 600);
        j(d)
    } else {
        window.clearTimeout(c);
        if (f.target == a) {
            a = null;
            b = !1;
            g = "click";
            h = document.createEvent("MouseEvent");
            h.initMouseEvent(g, !0, !0, window, 1, f.screenX, f.screenY, f.clientX, f.clientY, !1, !1, !1, !1, 0, null);
            f.target.dispatchEvent(h);
            g = "dblclick";
            h = document.createEvent("MouseEvent");
            h.initMouseEvent(g, !0, !0, window, 1, f.screenX, f.screenY, f.clientX, f.clientY, !1, !1, !1, !1, 0, null);
            f.target.dispatchEvent(h)
        } else {
            a = f.target;
            b = !0;
            c = window.setTimeout("cancelTap();", 600);
            j(d)
        }
    }
}

function m(c) {
    var d = "",
        e = 0;
    if (c.touches.length > 1) return;
    switch (c.type) {
    case "touchstart":
        if ($(c.changedTouches[0].target).is("select")) return;
        l(c);
        c.preventDefault();
        return !1;
    case "touchmove":
        i();
        d = "mousemove";
        c.preventDefault();
        break;
    case "touchend":
        if (h) {
            h = !1;
            c.preventDefault();
            return !1
        }
        i();
        d = "mouseup";
        break;
    default:
        return
    }
    var f = c.changedTouches,
        g = f[0],
        j = document.createEvent("MouseEvent");
    j.initMouseEvent(d, !0, !0, window, 1, g.screenX, g.screenY, g.clientX, g.clientY, !1, !1, !1, !1, e, null);
    g.target.dispatchEvent(j);
    if (d == "mouseup" && b && g.target == a) {
        j = document.createEvent("MouseEvent");
        j.initMouseEvent("click", !0, !0, window, 1, g.screenX, g.screenY, g.clientX, g.clientY, !1, !1, !1, !1, e, null);
        g.target.dispatchEvent(j)
    }
}
String.prototype.score = function(abbreviation, offset) {
    offset = offset || 0

    if (abbreviation.length == 0) return 0.9
    if (abbreviation.length > this.length) return 0.0

    for (var i = abbreviation.length; i > 0; i--) {
        var sub_abbreviation = abbreviation.substring(0, i)
        var index = this.indexOf(sub_abbreviation)

        if (index < 0) continue;
        if (index + abbreviation.length > this.length + offset) continue;

        var next_string = this.substring(index + sub_abbreviation.length)
        var next_abbreviation = null

        if (i >= abbreviation.length) next_abbreviation = ''
        else next_abbreviation = abbreviation.substring(i)

        var remaining_score = next_string.score(next_abbreviation, offset + index)

        if (remaining_score > 0) {
            var score = this.length - next_string.length;

            if (index != 0) {
                var j = 0;

                var c = this.charCodeAt(index - 1)
                if (c == 32 || c == 9) {
                    for (var j = (index - 2); j >= 0; j--) {
                        c = this.charCodeAt(j)
                        score -= ((c == 32 || c == 9) ? 1 : 0.15)
                    }
                } else {
                    score -= index
                }
            }

            score += remaining_score * next_string.length
            score /= this.length;
            return score
        }
    }
    return 0.0
}
jQuery.fn.liveUpdate = function(a) {
    function d() {
        var a = jQuery.trim(jQuery(this).val().toLowerCase()),
            d = [];
        if (!a) {
            jQuery("#search_result_wrapper").fadeOut(100);
            jQuery("#whiteSep,#noResults").fadeOut(0)
        } else {
            jQuery("#search_result_wrapper").fadeIn(100);
            b.removeClass("odd show");
            c.each(function(b) {
                var c = this.score(a);
                c > 0 && d.push([c, b])
            });
            jQuery.each(d.sort(function(a, b) {
                return b[0] - a[0]
            }), function(a) {
                jQuery(b[this[1]]).addClass("show")
            });
            jQuery(".show").each(function(a) {
                a % 2 && jQuery(this).removeClass("odd").addClass("odd")
            });
            if (jQuery(".show").length) {
                $("#whiteSep").fadeIn(100);
                $("#noResults").fadeOut(0)
            } else {
                $("#noResults").fadeIn(100);
                $("#whiteSep").fadeOut(0)
            }
        }
    }
    a = jQuery(a);
    if (a.length) {
        var b = a.children("li"),
            c = b.map(function() {
                return $(this).children(".search_str").html().toLowerCase()
            });
        this.keyup(d).keyup().parents("form").submit(function() {
            return !1
        })
    }
    return this
};
(function(a) {
    function c(a) {
        return typeof a == "object" ? a : {
            top: a,
            left: a
        }
    }
    var b = a.scrollTo = function(b, c, d) {
            a(window).scrollTo(b, c, d)
        };
    b.defaults = {
        axis: "xy",
        duration: parseFloat(a.fn.jquery) >= 1.3 ? 0 : 1
    };
    b.window = function(b) {
        return a(window)._scrollable()
    };
    a.fn._scrollable = function() {
        return this.map(function() {
            var b = this,
                c = !b.nodeName || a.inArray(b.nodeName.toLowerCase(), ["iframe", "#document", "html", "body"]) != -1;
            if (!c) return b;
            var d = (b.contentWindow || b).document || b.ownerDocument || b;
            return a.browser.safari || d.compatMode == "BackCompat" ? d.body : d.documentElement
        })
    };
    a.fn.scrollTo = function(d, e, f) {
        if (typeof e == "object") {
            f = e;
            e = 0
        }
        typeof f == "function" && (f = {
            onAfter: f
        });
        d == "max" && (d = 9e9);
        f = a.extend({}, b.defaults, f);
        e = e || f.speed || f.duration;
        f.queue = f.queue && f.axis.length > 1;
        f.queue && (e /= 2);
        f.offset = c(f.offset);
        f.over = c(f.over);
        return this._scrollable().each(function() {
            function m(a) {
                h.animate(k, e, f.easing, a &&
                function() {
                    a.call(this, d, f)
                })
            }
            var g = this,
                h = a(g),
                i = d,
                j, k = {},
                l = h.is("html,body");
            switch (typeof i) {
            case "number":
            case "string":
                if (/^([+-]=)?\d+(\.\d+)?(px|%)?$/.test(i)) {
                    i = c(i);
                    break
                }
                i = a(i, this);
            case "object":
                if (i.is || i.style) j = (i = a(i)).offset()
            }
            a.each(f.axis.split(""), function(a, c) {
                var d = c == "x" ? "Left" : "Top",
                    e = d.toLowerCase(),
                    n = "scroll" + d,
                    o = g[n],
                    p = b.max(g, c);
                if (j) {
                    k[n] = j[e] + (l ? 0 : o - h.offset()[e]);
                    if (f.margin) {
                        k[n] -= parseInt(i.css("margin" + d)) || 0;
                        k[n] -= parseInt(i.css("border" + d + "Width")) || 0
                    }
                    k[n] += f.offset[e] || 0;
                    f.over[e] && (k[n] += i[c == "x" ? "width" : "height"]() * f.over[e])
                } else {
                    var v = i[e];
                    k[n] = v.slice && v.slice(-1) == "%" ? parseFloat(v) / 100 * p : v
                }
                /^\d+$/.test(k[n]) && (k[n] = k[n] <= 0 ? 0 : Math.min(k[n], p));
                if (!a && f.queue) {
                    o != k[n] && m(f.onAfterFirst);
                    delete k[n]
                }
            });
            m(f.onAfter)
        }).end()
    };
    b.max = function(b, c) {
        var d = c == "x" ? "Width" : "Height",
            e = "scroll" + d;
        if (!a(b).is("html,body")) return b[e] - a(b)[d.toLowerCase()]();
        var f = "client" + d,
            g = b.ownerDocument.documentElement,
            h = b.ownerDocument.body;
        return Math.max(g[e], h[e]) - Math.min(g[f], h[f])
    }
})(jQuery);
jQuery.log = function(a) {
    console.log("%s: %o", a, this);
    return this
};
jQuery.extend({
    random: function(a) {
        return Math.floor(a * (Math.random() % 1))
    },
    randomBetween: function(a, b) {
        return a + jQuery.random(b - a + 1)
    }
});
(function(a) {
    function c() {
        var b = d(this);
        isNaN(b.datetime) || a(this).text(e(b.datetime));
        return this
    }

    function d(c) {
        c = a(c);
        if (!c.data("timeago")) {
            c.data("timeago", {
                datetime: b.datetime(c)
            });
            var d = a.trim(c.text());
            d.length > 0 && c.attr("title", d)
        }
        return c.data("timeago")
    }

    function e(a) {
        return b.inWords(f(a))
    }

    function f(a) {
        return (new Date).getTime() - a.getTime()
    }
    a.timeago = function(b) {
        return b instanceof Date ? e(b) : typeof b == "string" ? e(a.timeago.parse(b)) : e(a.timeago.datetime(b))
    };
    var b = a.timeago;
    a.extend(a.timeago, {
        settings: {
            refreshMillis: 6e4,
            allowFuture: !1,
            strings: {
                prefixAgo: null,
                prefixFromNow: null,
                suffixAgo: "ago",
                suffixFromNow: "from now",
                seconds: "a minute",
                minute: "a minute",
                minutes: "%d minutes",
                hour: "hour",
                hours: "%d hours",
                day: "a day",
                days: "%d days",
                month: "a month",
                months: "%d months",
                year: "a year",
                years: "%d years",
                numbers: []
            }
        },
        inWords: function(b) {
            function k(d, e) {
                var f = a.isFunction(d) ? d(e, b) : d,
                    g = c.numbers && c.numbers[e] || e;
                return f.replace(/%d/i, g)
            }
            var c = this.settings.strings,
                d = c.prefixAgo,
                e = c.suffixAgo;
            if (this.settings.allowFuture) {
                if (b < 0) {
                    d = c.prefixFromNow;
                    e = c.suffixFromNow
                }
                b = Math.abs(b)
            }
            var f = b / 1e3,
                g = f / 60,
                h = g / 60,
                i = h / 24,
                j = i / 365,
                l = f < 45 && k(c.seconds, Math.round(f)) || f < 90 && k(c.minute, 1) || g < 45 && k(c.minutes, Math.round(g)) || g < 90 && k(c.hour, 1) || h < 24 && k(c.hours, Math.round(h)) || h < 48 && k(c.day, 1) || i < 30 && k(c.days, Math.floor(i)) || i < 60 && k(c.month, 1) || i < 365 && k(c.months, Math.floor(i / 30)) || j < 2 && k(c.year, 1) || k(c.years, Math.floor(j));
            return a.trim([d, l, e].join(" "))
        },
        parse: function(b) {
            var c = a.trim(b);
            c = c.replace(/\.\d\d\d+/, "");
            c = c.replace(/-/, "/").replace(/-/, "/");
            c = c.replace(/T/, " ").replace(/Z/, " UTC");
            c = c.replace(/([\+-]\d\d)\:?(\d\d)/, " $1$2");
            return new Date(c)
        },
        datetime: function(c) {
            var d = a(c).get(0).tagName.toLowerCase() == "time",
                e = d ? a(c).attr("datetime") : a(c).attr("title");
            return b.parse(e)
        }
    });
    a.fn.timeago = function() {
        var a = this;
        a.each(c);
        var d = b.settings;
        d.refreshMillis > 0 && setInterval(function() {
            a.each(c)
        }, d.refreshMillis);
        return a
    }
})(jQuery);
(function() {
    function a(a, b) {
        var k = this,
            l;
        k.element = typeof a == "object" ? a : document.getElementById(a);
        k.wrapper = k.element.parentNode;
        k.element.style.webkitTransitionProperty = "-webkit-transform";
        k.element.style.webkitTransitionTimingFunction = "cubic-bezier(0,0,0.25,1)";
        k.element.style.webkitTransitionDuration = "0";
        k.element.style.webkitTransform = i + "0,0" + j;
        k.options = {
            bounce: c,
            momentum: c,
            checkDOMChanges: !0,
            topOnDOMChanges: !1,
            hScrollbar: c,
            vScrollbar: c,
            fadeScrollbar: d || !e,
            shrinkScrollbar: d || !e,
            desktopCompatibility: !1,
            overflow: "auto",
            snap: !1,
            bounceLock: !1,
            scrollbarColor: "rgba(0,0,0,0.5)",
            onScrollEnd: function() {},
            ischildiscroll: !1
        };
        if (typeof b == "object") for (l in b) k.options[l] = b[l];
        k.options.desktopCompatibility && (k.options.overflow = "hidden");
        k.onScrollEnd = k.options.onScrollEnd;
        delete k.options.onScrollEnd;
        k.wrapper.style.overflow = k.options.overflow;
        k.refresh();
        window.addEventListener("onorientationchange" in window ? "orientationchange" : "resize", k, !1);
        k.wheel2 = function(a) {
            k.wheel(a)
        };
        if (k.element.addEventListener) {
            k.element.addEventListener("DOMMouseScroll", k.wheel2, !1);
            k.element.addEventListener("mousewheel", k.wheel2, !1)
        } else document.attachEvent ? k.element.attachEvent("onmousewheel", k.wheel2) : k.element.onmousewheel = k.wheel2;
        if (e || k.options.desktopCompatibility) {
            k.element.addEventListener(f, k, !1);
            k.element.addEventListener(g, k, !1);
            k.element.addEventListener(h, k, !1)
        }
        k.options.checkDOMChanges && k.element.addEventListener("DOMSubtreeModified", k, !1)
    }

    function b(a, b, c, d, e) {
        var f = this,
            g = document;
        f.dir = a;
        f.fade = c;
        f.shrink = d;
        f.uid = ++k;
        f.bar = g.createElement("div");
        f.bar.style.cssText = "position:absolute;top:0;left:0;-webkit-transition-timing-function:cubic-bezier(0,0,0.25,1);pointer-events:none;-webkit-transition-duration:0;-webkit-transition-delay:0;-webkit-transition-property:-webkit-transform;z-index:10;background:" + e + ";" + "-webkit-transform:" + i + "0,0" + j + ";" + (a == "horizontal" ? "-webkit-border-radius:3px 2px;min-width:6px;min-height:5px" : "-webkit-border-radius:2px 3px;min-width:5px;min-height:6px");
        f.wrapper = g.createElement("div");
        f.wrapper.style.cssText = "-webkit-mask:-webkit-canvas(scrollbar" + f.uid + f.dir + ");position:absolute;z-index:10;pointer-events:none;overflow:hidden;opacity:0;-webkit-transition-duration:" + (c ? "300ms" : "0") + ";-webkit-transition-delay:0;-webkit-transition-property:opacity;" + (f.dir == "horizontal" ? "bottom:2px;left:2px;right:7px;height:5px" : "top:2px;right:2px;bottom:7px;width:5px;");
        f.wrapper.appendChild(f.bar);
        b.appendChild(f.wrapper)
    }
    a.prototype = {
        x: 0,
        y: 0,
        enabled: !0,
        handleEvent: function(a) {
            var b = this;
            switch (a.type) {
            case f:
                b.touchStart(a);
                break;
            case g:
                b.touchMove(a);
                break;
            case h:
                b.touchEnd(a);
                break;
            case "webkitTransitionEnd":
                b.transitionEnd();
                break;
            case "orientationchange":
            case "resize":
                b.refresh();
                break;
            case "DOMSubtreeModified":
                b.onDOMModified(a);
                break;
            case "wheel":
                b.wheel(a)
            }
        },
        onDOMModified: function(a) {
            var b = this;
            if (a.target.parentNode != b.element) return;
            setTimeout(function() {
                b.refresh()
            }, 0);
            b.options.topOnDOMChanges && (b.x != 0 || b.y != 0) && b.scrollTo(0, 0, "0")
        },
        refresh: function() {
            var a = this,
                c = a.x,
                d = a.y,
                e;
            a.scrollWidth = a.wrapper.clientWidth;
            a.scrollHeight = a.wrapper.clientHeight;
            a.scrollerWidth = a.element.offsetWidth;
            a.scrollerHeight = a.element.offsetHeight;
            a.maxScrollX = a.scrollWidth - a.scrollerWidth;
            a.maxScrollY = a.scrollHeight - a.scrollerHeight;
            a.directionX = 0;
            a.directionY = 0;
            a.scrollX && (a.maxScrollX >= 0 ? c = 0 : a.x < a.maxScrollX && (c = a.maxScrollX));
            a.scrollY && (a.maxScrollY >= 0 ? d = 0 : a.y < a.maxScrollY && (d = a.maxScrollY));
            if (a.options.snap) {
                a.maxPageX = -Math.floor(a.maxScrollX / a.scrollWidth);
                a.maxPageY = -Math.floor(a.maxScrollY / a.scrollHeight);
                e = a.snap(c, d);
                c = e.x;
                d = e.y
            }
            if (c != a.x || d != a.y) {
                a.setTransitionTime("0");
                a.setPosition(c, d, !0)
            }
            a.scrollX = a.scrollerWidth > a.scrollWidth;
            a.scrollY = !a.options.bounceLock && !a.scrollX || a.scrollerHeight > a.scrollHeight;
            if (a.options.hScrollbar && a.scrollX) {
                a.scrollBarX = a.scrollBarX || new b("horizontal", a.wrapper, a.options.fadeScrollbar, a.options.shrinkScrollbar, a.options.scrollbarColor);
                a.scrollBarX.init(a.scrollWidth, a.scrollerWidth)
            } else a.scrollBarX && (a.scrollBarX = a.scrollBarX.remove());
            if (a.options.vScrollbar && a.scrollY && a.scrollerHeight > a.scrollHeight) {
                a.scrollBarY = a.scrollBarY || new b("vertical", a.wrapper, a.options.fadeScrollbar, a.options.shrinkScrollbar, a.options.scrollbarColor);
                a.scrollBarY.init(a.scrollHeight, a.scrollerHeight)
            } else a.scrollBarY && (a.scrollBarY = a.scrollBarY.remove())
        },
        setPosition: function(a, b, c) {
            var d = this;
            d.x = a;
            d.y = b;
            d.element.style.webkitTransform = i + d.x + "px," + d.y + "px" + j;
            if (!c) {
                d.scrollBarX && d.scrollBarX.setPosition(d.x);
                d.scrollBarY && d.scrollBarY.setPosition(d.y)
            }
        },
        setTransitionTime: function(a) {
            var b = this;
            a = a || "0";
            b.element.style.webkitTransitionDuration = a;
            if (b.scrollBarX) {
                b.scrollBarX.bar.style.webkitTransitionDuration = a;
                b.scrollBarX.wrapper.style.webkitTransitionDuration = c && b.options.fadeScrollbar ? "300ms" : "0"
            }
            if (b.scrollBarY) {
                b.scrollBarY.bar.style.webkitTransitionDuration = a;
                b.scrollBarY.wrapper.style.webkitTransitionDuration = c && b.options.fadeScrollbar ? "300ms" : "0"
            }
        },
        touchStart: function(a) {
            var b = this,
                c;
            if (!b.enabled) return;
            if (!b.options.ischildiscroll) {
                a.preventDefault();
                a.stopPropagation()
            }
            b.scrolling = !0;
            b.moved = !1;
            b.distX = 0;
            b.distY = 0;
            b.setTransitionTime("0");
            if (b.options.momentum || b.options.snap) try {
                c = new WebKitCSSMatrix(window.getComputedStyle(b.element).webkitTransform);
                if (c.e != b.x || c.f != b.y) {
                    document.removeEventListener("webkitTransitionEnd", b, !1);
                    b.setPosition(c.e, c.f);
                    b.moved = !0
                }
            } catch (a) {}
            b.touchStartX = e ? a.changedTouches[0].pageX : a.pageX;
            b.scrollStartX = b.x;
            b.touchStartY = e ? a.changedTouches[0].pageY : a.pageY;
            b.scrollStartY = b.y;
            b.scrollStartTime = a.timeStamp;
            b.directionX = 0;
            b.directionY = 0
        },
        touchMove: function(a) {
            if (!this.scrolling) return;
            var b = this,
                c = e ? a.changedTouches[0].pageX : a.pageX,
                d = e ? a.changedTouches[0].pageY : a.pageY,
                f = b.scrollX ? c - b.touchStartX : 0,
                g = b.scrollY ? d - b.touchStartY : 0,
                h = b.x + f,
                i = b.y + g;
            b.touchStartX = c;
            b.touchStartY = d;
            if (h >= 0 || h < b.maxScrollX) h = b.options.bounce ? Math.round(b.x + f / 3) : h >= 0 || b.maxScrollX >= 0 ? 0 : b.maxScrollX;
            if (i >= 0 || i < b.maxScrollY) i = b.options.bounce ? Math.round(b.y + g / 3) : i >= 0 || b.maxScrollY >= 0 ? 0 : b.maxScrollY;
            if (b.distX + b.distY > 30) {
                if (b.distX - 3 > b.distY) {
                    i = b.y;
                    g = 0
                } else if (b.distY - 3 > b.distX) {
                    h = b.x;
                    f = 0
                }
                b.setPosition(h, i);
                b.moved = !0;
                b.directionX = f > 0 ? -1 : 1;
                b.directionY = g > 0 ? -1 : 1
            } else {
                b.distX += Math.abs(f);
                b.distY += Math.abs(g)
            }
        },
        touchEnd: function(a) {
            if (!this.scrolling) return;
            var b = this,
                c = a.timeStamp - b.scrollStartTime,
                d = e ? a.changedTouches[0] : a,
                f, g, h, i, j = 0,
                k = b.x,
                l = b.y,
                m;
            b.scrolling = !1;
            if (!b.moved) {
                b.resetPosition();
                if (e) {
                    f = d.target;
                    while (f.nodeType != 1) f = f.parentNode;
                    g = document.createEvent("MouseEvents");
                    g.initMouseEvent("click", !0, !0, a.view, 1, d.screenX, d.screenY, d.clientX, d.clientY, a.ctrlKey, a.altKey, a.shiftKey, a.metaKey, 0, null);
                    g._fake = !0;
                    f.dispatchEvent(g)
                }
                return
            }
            if (!b.options.snap && c > 250) {
                b.resetPosition();
                return
            }
            if (b.options.momentum) {
                h = b.scrollX === !0 ? b.momentum(b.x - b.scrollStartX, c, b.options.bounce ? -b.x + b.scrollWidth / 5 : -b.x, b.options.bounce ? b.x + b.scrollerWidth - b.scrollWidth + b.scrollWidth / 5 : b.x + b.scrollerWidth - b.scrollWidth) : {
                    dist: 0,
                    time: 0
                };
                i = b.scrollY === !0 ? b.momentum(b.y - b.scrollStartY, c, b.options.bounce ? -b.y + b.scrollHeight / 5 : -b.y, b.options.bounce ? (b.maxScrollY < 0 ? b.y + b.scrollerHeight - b.scrollHeight : 0) + b.scrollHeight / 5 : b.y + b.scrollerHeight - b.scrollHeight) : {
                    dist: 0,
                    time: 0
                };
                j = Math.max(Math.max(h.time, i.time), 1);
                k = b.x + h.dist;
                l = b.y + i.dist
            }
            if (b.options.snap) {
                m = b.snap(k, l);
                k = m.x;
                l = m.y;
                j = Math.max(m.time, j)
            }
            b.scrollTo(k, l, j + "ms")
        },
        transitionEnd: function() {
            var a = this;
            document.removeEventListener("webkitTransitionEnd", a, !1);
            a.resetPosition()
        },
        resetPosition: function() {
            var a = this,
                b = a.x,
                c = a.y;
            a.x >= 0 ? b = 0 : a.x < a.maxScrollX && (b = a.maxScrollX);
            a.y >= 0 || a.maxScrollY > 0 ? c = 0 : a.y < a.maxScrollY && (c = a.maxScrollY);
            if (b != a.x || c != a.y) a.scrollTo(b, c);
            else {
                if (a.moved) {
                    a.onScrollEnd();
                    a.moved = !1
                }
                a.scrollBarX && a.scrollBarX.hide();
                a.scrollBarY && a.scrollBarY.hide()
            }
        },
        snap: function(a, b) {
            var c = this,
                d;
            c.directionX > 0 ? a = Math.floor(a / c.scrollWidth) : c.directionX < 0 ? a = Math.ceil(a / c.scrollWidth) : a = Math.round(a / c.scrollWidth);
            c.pageX = -a;
            a *= c.scrollWidth;
            if (a > 0) a = c.pageX = 0;
            else if (a < c.maxScrollX) {
                c.pageX = c.maxPageX;
                a = c.maxScrollX
            }
            c.directionY > 0 ? b = Math.floor(b / c.scrollHeight) : c.directionY < 0 ? b = Math.ceil(b / c.scrollHeight) : b = Math.round(b / c.scrollHeight);
            c.pageY = -b;
            b *= c.scrollHeight;
            if (b > 0) b = c.pageY = 0;
            else if (b < c.maxScrollY) {
                c.pageY = c.maxPageY;
                b = c.maxScrollY
            }
            d = Math.round(Math.max(Math.abs(c.x - a) / c.scrollWidth * 500, Math.abs(c.y - b) / c.scrollHeight * 500));
            return {
                x: a,
                y: b,
                time: d
            }
        },
        scrollTo: function(a, b, c) {
            var d = this;
            if (d.x == a && d.y == b) {
                d.resetPosition();
                return
            }
            d.moved = !0;
            d.setTransitionTime(c || "350ms");
            d.setPosition(a, b);
            c === "0" || c == "0s" || c == "0ms" ? d.resetPosition() : document.addEventListener("webkitTransitionEnd", d, !1)
        },
        scrollToPage: function(a, b, c) {
            var d = this,
                e;
            if (!d.options.snap) {
                d.pageX = -Math.round(d.x / d.scrollWidth);
                d.pageY = -Math.round(d.y / d.scrollHeight)
            }
            a == "next" ? a = ++d.pageX : a == "prev" && (a = --d.pageX);
            b == "next" ? b = ++d.pageY : b == "prev" && (b = --d.pageY);
            a = -a * d.scrollWidth;
            b = -b * d.scrollHeight;
            e = d.snap(a, b);
            a = e.x;
            b = e.y;
            d.scrollTo(a, b, c || "500ms")
        },
        scrollToElement: function(a, b) {
            a = typeof a == "object" ? a : this.element.querySelector(a);
            if (!a) return;
            var c = this,
                d = c.scrollX ? -a.offsetLeft : 0,
                e = c.scrollY ? -a.offsetTop : 0;
            d >= 0 ? d = 0 : d < c.maxScrollX && (d = c.maxScrollX);
            e >= 0 ? e = 0 : e < c.maxScrollY && (e = c.maxScrollY);
            c.scrollTo(d, e, b)
        },
        momentum: function(a, b, c, d) {
            var e = 2.5,
                f = 1.2,
                g = Math.abs(a) / b * 1e3,
                h = g * g / e / 1e3,
                i = 0;
            if (a > 0 && h > c) {
                g = g * c / h / e;
                h = c
            } else if (a < 0 && h > d) {
                g = g * d / h / e;
                h = d
            }
            h *= a < 0 ? -1 : 1;
            i = g / f;
            return {
                dist: Math.round(h),
                time: Math.round(i)
            }
        },
        destroy: function(a) {
            var b = this;
            window.removeEventListener("onorientationchange" in window ? "orientationchange" : "resize", b, !1);
            b.element.removeEventListener(f, b, !1);
            b.element.removeEventListener(g, b, !1);
            b.element.removeEventListener(h, b, !1);
            document.removeEventListener("webkitTransitionEnd", b, !1);
            b.options.checkDOMChanges && b.element.removeEventListener("DOMSubtreeModified", b, !1);
            b.scrollBarX && (b.scrollBarX = b.scrollBarX.remove());
            b.scrollBarY && (b.scrollBarY = b.scrollBarY.remove());
            a && b.wrapper.parentNode.removeChild(b.wrapper);
            return null
        },
        wheel: function(a) {
            var b = this;
            if (!b.enabled) return;
            if (b.wheeld) return;
            b.wheeld = !0;
            setTimeout(function() {
                b.wheeld = !1
            }, 200);
            var c = 0;
            a || (a = window.event);
            a.wheelDelta ? c = a.wheelDelta / 120 : a.detail && (c = -a.detail / 3);
            if (b.options.vScrollbar) {
                c > 0 && b.scrollToPage("next", b.pageY);
                c < 0 && b.scrollToPage("prev", b.pageY)
            }
        }
    };
    b.prototype = {
        init: function(a, b) {
            var c = this,
                d = document,
                e = Math.PI,
                f;
            if (c.dir == "horizontal") {
                if (c.maxSize != c.wrapper.offsetWidth) {
                    c.maxSize = c.wrapper.offsetWidth;
                    f = d.getCSSCanvasContext("2d", "scrollbar" + c.uid + c.dir, c.maxSize, 5);
                    f.fillStyle = "rgb(0,0,0)";
                    f.beginPath();
                    f.arc(2.5, 2.5, 2.5, e / 2, -e / 2, !1);
                    f.lineTo(c.maxSize - 2.5, 0);
                    f.arc(c.maxSize - 2.5, 2.5, 2.5, -e / 2, e / 2, !1);
                    f.closePath();
                    f.fill()
                }
            } else if (c.maxSize != c.wrapper.offsetHeight) {
                c.maxSize = c.wrapper.offsetHeight;
                f = d.getCSSCanvasContext("2d", "scrollbar" + c.uid + c.dir, 5, c.maxSize);
                f.fillStyle = "rgb(0,0,0)";
                f.beginPath();
                f.arc(2.5, 2.5, 2.5, e, 0, !1);
                f.lineTo(5, c.maxSize - 2.5);
                f.arc(2.5, c.maxSize - 2.5, 2.5, 0, e, !1);
                f.closePath();
                f.fill()
            }
            c.size = Math.max(Math.round(c.maxSize * c.maxSize / b), 6);
            c.maxScroll = c.maxSize - c.size;
            c.toWrapperProp = c.maxScroll / (a - b);
            c.bar.style[c.dir == "horizontal" ? "width" : "height"] = c.size + "px"
        },
        setPosition: function(a) {
            var b = this;
            b.wrapper.style.opacity != "1" && b.show();
            a = Math.round(b.toWrapperProp * a);
            if (a < 0) {
                a = b.shrink ? a + a * 3 : 0;
                b.size + a < 7 && (a = -b.size + 6)
            } else if (a > b.maxScroll) {
                a = b.shrink ? a + (a - b.maxScroll) * 3 : b.maxScroll;
                b.size + b.maxScroll - a < 7 && (a = b.size + b.maxScroll - 6)
            }
            a = b.dir == "horizontal" ? i + a + "px,0" + j : i + "0," + a + "px" + j;
            b.bar.style.webkitTransform = a
        },
        show: function() {
            c && (this.wrapper.style.webkitTransitionDelay = "0");
            this.wrapper.style.opacity = "1"
        },
        hide: function() {
            c && (this.wrapper.style.webkitTransitionDelay = "350ms");
            this.wrapper.style.opacity = "0"
        },
        remove: function() {
            this.wrapper.parentNode.removeChild(this.wrapper);
            return null
        }
    };
    var c = "WebKitCSSMatrix" in window && "m11" in new WebKitCSSMatrix,
        d = /iphone|ipad/gi.test(navigator.appVersion),
        e = "ontouchstart" in window,
        f = e ? "touchstart" : "mousedown",
        g = e ? "touchmove" : "mousemove",
        h = e ? "touchend" : "mouseup",
        i = "translate" + (c ? "3d(" : "("),
        j = c ? ",0)" : ")",
        k = 0;
    window.iScroll = a
})();
(function() {
    function a(a, b) {
        var k = this,
            l;
        k.element = typeof a == "object" ? a : document.getElementById(a);
        k.wrapper = k.element.parentNode;
        k.element.style.webkitTransitionProperty = "-webkit-transform";
        k.element.style.webkitTransitionTimingFunction = "cubic-bezier(0,0,0.25,1)";
        k.element.style.webkitTransitionDuration = "0";
        k.element.style.webkitTransform = i + "0,0" + j;
        k.options = {
            bounce: c,
            momentum: c,
            checkDOMChanges: !0,
            topOnDOMChanges: !1,
            hScrollbar: c,
            vScrollbar: c,
            fadeScrollbar: d || !e,
            shrinkScrollbar: d || !e,
            desktopCompatibility: !1,
            overflow: "auto",
            snap: !1,
            bounceLock: !1,
            scrollbarColor: "rgba(0,0,0,0.5)",
            onScrollEnd: function() {},
            ischildiscroll: !1
        };
        if (typeof b == "object") for (l in b) k.options[l] = b[l];
        k.options.desktopCompatibility && (k.options.overflow = "hidden");
        k.onScrollEnd = k.options.onScrollEnd;
        delete k.options.onScrollEnd;
        k.wrapper.style.overflow = k.options.overflow;
        k.refresh();
        window.addEventListener("onorientationchange" in window ? "orientationchange" : "resize", k, !1);
        k.wheel2 = function(a) {
            k.wheel(a)
        };
        if (k.element.addEventListener) {
            k.element.addEventListener("DOMMouseScroll", k.wheel2, !1);
            k.element.addEventListener("mousewheel", k.wheel2, !1)
        } else document.attachEvent ? k.element.attachEvent("onmousewheel", k.wheel2) : k.element.onmousewheel = k.wheel2;
        if (e || k.options.desktopCompatibility) {
            k.element.addEventListener(f, k, !1);
            k.element.addEventListener(g, k, !1);
            k.element.addEventListener(h, k, !1)
        }
        k.options.checkDOMChanges && k.element.addEventListener("DOMSubtreeModified", k, !1)
    }

    function b(a, b, c, d, e) {
        var f = this,
            g = document;
        f.dir = a;
        f.fade = c;
        f.shrink = d;
        f.uid = ++k;
        f.bar = g.createElement("div");
        f.bar.style.cssText = "position:absolute;top:0;left:0;-webkit-transition-timing-function:cubic-bezier(0,0,0.25,1);pointer-events:none;-webkit-transition-duration:0;-webkit-transition-delay:0;-webkit-transition-property:-webkit-transform;z-index:10;background:" + e + ";" + "-webkit-transform:" + i + "0,0" + j + ";" + (a == "horizontal" ? "-webkit-border-radius:3px 2px;min-width:6px;min-height:5px" : "-webkit-border-radius:2px 3px;min-width:5px;min-height:6px");
        f.wrapper = g.createElement("div");
        f.wrapper.style.cssText = "-webkit-mask:-webkit-canvas(scrollbar" + f.uid + f.dir + ");position:absolute;z-index:10;pointer-events:none;overflow:hidden;opacity:0;-webkit-transition-duration:" + (c ? "300ms" : "0") + ";-webkit-transition-delay:0;-webkit-transition-property:opacity;" + (f.dir == "horizontal" ? "bottom:2px;left:2px;right:7px;height:5px" : "top:2px;right:2px;bottom:7px;width:5px;");
        f.wrapper.appendChild(f.bar);
        b.appendChild(f.wrapper)
    }
    a.prototype = {
        x: 0,
        y: 0,
        enabled: !0,
        handleEvent: function(a) {
            var b = this;
            switch (a.type) {
            case f:
                b.touchStart(a);
                break;
            case g:
                b.touchMove(a);
                break;
            case h:
                b.touchEnd(a);
                break;
            case "webkitTransitionEnd":
                b.transitionEnd();
                break;
            case "orientationchange":
            case "resize":
                b.refresh();
                break;
            case "DOMSubtreeModified":
                b.onDOMModified(a);
                break;
            case "wheel":
                b.wheel(a)
            }
        },
        onDOMModified: function(a) {
            var b = this;
            if (a.target.parentNode != b.element) return;
            setTimeout(function() {
                b.refresh()
            }, 0);
            b.options.topOnDOMChanges && (b.x != 0 || b.y != 0) && b.scrollTo(0, 0, "0")
        },
        refresh: function() {
            var a = this,
                c = a.x,
                d = a.y,
                e;
            a.scrollWidth = a.wrapper.clientWidth;
            a.scrollHeight = a.wrapper.clientHeight;
            a.scrollerWidth = a.element.offsetWidth;
            a.scrollerHeight = a.element.offsetHeight;
            a.maxScrollX = a.scrollWidth - a.scrollerWidth;
            a.maxScrollY = a.scrollHeight - a.scrollerHeight;
            a.directionX = 0;
            a.directionY = 0;
            a.scrollX && (a.maxScrollX >= 0 ? c = 0 : a.x < a.maxScrollX && (c = a.maxScrollX));
            a.scrollY && (a.maxScrollY >= 0 ? d = 0 : a.y < a.maxScrollY && (d = a.maxScrollY));
            if (a.options.snap) {
                a.maxPageX = -Math.floor(a.maxScrollX / a.scrollWidth);
                a.maxPageY = -Math.floor(a.maxScrollY / a.scrollHeight);
                e = a.snap(c, d);
                c = e.x;
                d = e.y
            }
            if (c != a.x || d != a.y) {
                a.setTransitionTime("0");
                a.setPosition(c, d, !0)
            }
            a.scrollX = a.scrollerWidth > a.scrollWidth;
            a.scrollY = !a.options.bounceLock && !a.scrollX || a.scrollerHeight > a.scrollHeight;
            if (a.options.hScrollbar && a.scrollX) {
                a.scrollBarX = a.scrollBarX || new b("horizontal", a.wrapper, a.options.fadeScrollbar, a.options.shrinkScrollbar, a.options.scrollbarColor);
                a.scrollBarX.init(a.scrollWidth, a.scrollerWidth)
            } else a.scrollBarX && (a.scrollBarX = a.scrollBarX.remove());
            if (a.options.vScrollbar && a.scrollY && a.scrollerHeight > a.scrollHeight) {
                a.scrollBarY = a.scrollBarY || new b("vertical", a.wrapper, a.options.fadeScrollbar, a.options.shrinkScrollbar, a.options.scrollbarColor);
                a.scrollBarY.init(a.scrollHeight, a.scrollerHeight)
            } else a.scrollBarY && (a.scrollBarY = a.scrollBarY.remove())
        },
        setPosition: function(a, b, c) {
            var d = this;
            d.x = a;
            d.y = b;
            d.element.style.webkitTransform = i + d.x + "px," + d.y + "px" + j;
            if (!c) {
                d.scrollBarX && d.scrollBarX.setPosition(d.x);
                d.scrollBarY && d.scrollBarY.setPosition(d.y)
            }
        },
        setTransitionTime: function(a) {
            var b = this;
            a = a || "0";
            b.element.style.webkitTransitionDuration = a;
            if (b.scrollBarX) {
                b.scrollBarX.bar.style.webkitTransitionDuration = a;
                b.scrollBarX.wrapper.style.webkitTransitionDuration = c && b.options.fadeScrollbar ? "300ms" : "0"
            }
            if (b.scrollBarY) {
                b.scrollBarY.bar.style.webkitTransitionDuration = a;
                b.scrollBarY.wrapper.style.webkitTransitionDuration = c && b.options.fadeScrollbar ? "300ms" : "0"
            }
        },
        touchStart: function(a) {
            var b = this,
                c;
            if (!b.enabled) return;
            if (!b.options.ischildiscroll) {
                a.preventDefault();
                a.stopPropagation()
            }
            b.scrolling = !0;
            b.moved = !1;
            b.distX = 0;
            b.distY = 0;
            b.setTransitionTime("0");
            if (b.options.momentum || b.options.snap) try {
                c = new WebKitCSSMatrix(window.getComputedStyle(b.element).webkitTransform);
                if (c.e != b.x || c.f != b.y) {
                    document.removeEventListener("webkitTransitionEnd", b, !1);
                    b.setPosition(c.e, c.f);
                    b.moved = !0
                }
            } catch (a) {}
            b.touchStartX = e ? a.changedTouches[0].pageX : a.pageX;
            b.scrollStartX = b.x;
            b.touchStartY = e ? a.changedTouches[0].pageY : a.pageY;
            b.scrollStartY = b.y;
            b.scrollStartTime = a.timeStamp;
            b.directionX = 0;
            b.directionY = 0
        },
        touchMove: function(a) {
            if (!this.scrolling) return;
            var b = this,
                c = e ? a.changedTouches[0].pageX : a.pageX,
                d = e ? a.changedTouches[0].pageY : a.pageY,
                f = b.scrollX ? c - b.touchStartX : 0,
                g = b.scrollY ? d - b.touchStartY : 0,
                h = b.x + f,
                i = b.y + g;
            b.touchStartX = c;
            b.touchStartY = d;
            if (h >= 0 || h < b.maxScrollX) h = b.options.bounce ? Math.round(b.x + f / 3) : h >= 0 || b.maxScrollX >= 0 ? 0 : b.maxScrollX;
            if (i >= 0 || i < b.maxScrollY) i = b.options.bounce ? Math.round(b.y + g / 3) : i >= 0 || b.maxScrollY >= 0 ? 0 : b.maxScrollY;
            if (b.distX + b.distY > 30) {
                if (b.distX - 3 > b.distY) {
                    i = b.y;
                    g = 0
                } else if (b.distY - 3 > b.distX) {
                    h = b.x;
                    f = 0
                }
                b.setPosition(h, i);
                b.moved = !0;
                b.directionX = f > 0 ? -1 : 1;
                b.directionY = g > 0 ? -1 : 1
            } else {
                b.distX += Math.abs(f);
                b.distY += Math.abs(g)
            }
        },
        touchEnd: function(a) {
            if (!this.scrolling) return;
            var b = this,
                c = a.timeStamp - b.scrollStartTime,
                d = e ? a.changedTouches[0] : a,
                f, g, h, i, j = 0,
                k = b.x,
                l = b.y,
                m;
            b.scrolling = !1;
            if (!b.moved) {
                b.resetPosition();
                if (e) {
                    f = d.target;
                    while (f.nodeType != 1) f = f.parentNode;
                    g = document.createEvent("MouseEvents");
                    g.initMouseEvent("click", !0, !0, a.view, 1, d.screenX, d.screenY, d.clientX, d.clientY, a.ctrlKey, a.altKey, a.shiftKey, a.metaKey, 0, null);
                    g._fake = !0;
                    f.dispatchEvent(g)
                }
                return
            }
            if (!b.options.snap && c > 250) {
                b.resetPosition();
                return
            }
            if (b.options.momentum) {
                h = b.scrollX === !0 ? b.momentum(b.x - b.scrollStartX, c, b.options.bounce ? -b.x + b.scrollWidth / 5 : -b.x, b.options.bounce ? b.x + b.scrollerWidth - b.scrollWidth + b.scrollWidth / 5 : b.x + b.scrollerWidth - b.scrollWidth) : {
                    dist: 0,
                    time: 0
                };
                i = b.scrollY === !0 ? b.momentum(b.y - b.scrollStartY, c, b.options.bounce ? -b.y + b.scrollHeight / 5 : -b.y, b.options.bounce ? (b.maxScrollY < 0 ? b.y + b.scrollerHeight - b.scrollHeight : 0) + b.scrollHeight / 5 : b.y + b.scrollerHeight - b.scrollHeight) : {
                    dist: 0,
                    time: 0
                };
                j = Math.max(Math.max(h.time, i.time), 1);
                k = b.x + h.dist;
                l = b.y + i.dist
            }
            if (b.options.snap) {
                m = b.snap(k, l);
                k = m.x;
                l = m.y;
                j = Math.max(m.time, j)
            }
            b.scrollTo(k, l, j + "ms")
        },
        transitionEnd: function() {
            var a = this;
            document.removeEventListener("webkitTransitionEnd", a, !1);
            a.resetPosition()
        },
        resetPosition: function() {
            var a = this,
                b = a.x,
                c = a.y;
            a.x >= 0 ? b = 0 : a.x < a.maxScrollX && (b = a.maxScrollX);
            a.y >= 0 || a.maxScrollY > 0 ? c = 0 : a.y < a.maxScrollY && (c = a.maxScrollY);
            if (b != a.x || c != a.y) a.scrollTo(b, c);
            else {
                if (a.moved) {
                    a.onScrollEnd();
                    a.moved = !1
                }
                a.scrollBarX && a.scrollBarX.hide();
                a.scrollBarY && a.scrollBarY.hide()
            }
        },
        snap: function(a, b) {
            var c = this,
                d;
            c.directionX > 0 ? a = Math.floor(a / c.scrollWidth) : c.directionX < 0 ? a = Math.ceil(a / c.scrollWidth) : a = Math.round(a / c.scrollWidth);
            c.pageX = -a;
            a *= c.scrollWidth;
            if (a > 0) a = c.pageX = 0;
            else if (a < c.maxScrollX) {
                c.pageX = c.maxPageX;
                a = c.maxScrollX
            }
            c.directionY > 0 ? b = Math.floor(b / c.scrollHeight) : c.directionY < 0 ? b = Math.ceil(b / c.scrollHeight) : b = Math.round(b / c.scrollHeight);
            c.pageY = -b;
            b *= c.scrollHeight;
            if (b > 0) b = c.pageY = 0;
            else if (b < c.maxScrollY) {
                c.pageY = c.maxPageY;
                b = c.maxScrollY
            }
            d = Math.round(Math.max(Math.abs(c.x - a) / c.scrollWidth * 500, Math.abs(c.y - b) / c.scrollHeight * 500));
            return {
                x: a,
                y: b,
                time: d
            }
        },
        scrollTo: function(a, b, c) {
            var d = this;
            if (d.x == a && d.y == b) {
                d.resetPosition();
                return
            }
            d.moved = !0;
            d.setTransitionTime(c || "350ms");
            d.setPosition(a, b);
            c === "0" || c == "0s" || c == "0ms" ? d.resetPosition() : document.addEventListener("webkitTransitionEnd", d, !1)
        },
        scrollToPage: function(a, b, c) {
            var d = this,
                e;
            if (!d.options.snap) {
                d.pageX = -Math.round(d.x / d.scrollWidth);
                d.pageY = -Math.round(d.y / d.scrollHeight)
            }
            a == "next" ? a = ++d.pageX : a == "prev" && (a = --d.pageX);
            b == "next" ? b = ++d.pageY : b == "prev" && (b = --d.pageY);
            a = -a * d.scrollWidth;
            b = -b * d.scrollHeight;
            e = d.snap(a, b);
            a = e.x;
            b = e.y;
            d.scrollTo(a, b, c || "500ms")
        },
        scrollToElement: function(a, b) {
            a = typeof a == "object" ? a : this.element.querySelector(a);
            if (!a) return;
            var c = this,
                d = c.scrollX ? -a.offsetLeft : 0,
                e = c.scrollY ? -a.offsetTop : 0;
            d >= 0 ? d = 0 : d < c.maxScrollX && (d = c.maxScrollX);
            e >= 0 ? e = 0 : e < c.maxScrollY && (e = c.maxScrollY);
            c.scrollTo(d, e, b)
        },
        momentum: function(a, b, c, d) {
            var e = 2.5,
                f = 1.2,
                g = Math.abs(a) / b * 1e3,
                h = g * g / e / 1e3,
                i = 0;
            if (a > 0 && h > c) {
                g = g * c / h / e;
                h = c
            } else if (a < 0 && h > d) {
                g = g * d / h / e;
                h = d
            }
            h *= a < 0 ? -1 : 1;
            i = g / f;
            return {
                dist: Math.round(h),
                time: Math.round(i)
            }
        },
        destroy: function(a) {
            var b = this;
            window.removeEventListener("onorientationchange" in window ? "orientationchange" : "resize", b, !1);
            b.element.removeEventListener(f, b, !1);
            b.element.removeEventListener(g, b, !1);
            b.element.removeEventListener(h, b, !1);
            document.removeEventListener("webkitTransitionEnd", b, !1);
            b.options.checkDOMChanges && b.element.removeEventListener("DOMSubtreeModified", b, !1);
            b.scrollBarX && (b.scrollBarX = b.scrollBarX.remove());
            b.scrollBarY && (b.scrollBarY = b.scrollBarY.remove());
            a && b.wrapper.parentNode.removeChild(b.wrapper);
            return null
        },
        wheel: function(a) {
            var b = this;
            if (!b.enabled) return;
            if (b.wheeld) return;
            b.wheeld = !0;
            setTimeout(function() {
                b.wheeld = !1
            }, 200);
            var c = 0;
            a || (a = window.event);
            a.wheelDelta ? c = a.wheelDelta / 120 : a.detail && (c = -a.detail / 3);
            if (b.options.vScrollbar) {
                c > 0 && b.scrollToPage("next", b.pageY);
                c < 0 && b.scrollToPage("prev", b.pageY)
            }
        }
    };
    b.prototype = {
        init: function(a, b) {
            var c = this,
                d = document,
                e = Math.PI,
                f;
            if (c.dir == "horizontal") {
                if (c.maxSize != c.wrapper.offsetWidth) {
                    c.maxSize = c.wrapper.offsetWidth;
                    f = d.getCSSCanvasContext("2d", "scrollbar" + c.uid + c.dir, c.maxSize, 5);
                    f.fillStyle = "rgb(0,0,0)";
                    f.beginPath();
                    f.arc(2.5, 2.5, 2.5, e / 2, -e / 2, !1);
                    f.lineTo(c.maxSize - 2.5, 0);
                    f.arc(c.maxSize - 2.5, 2.5, 2.5, -e / 2, e / 2, !1);
                    f.closePath();
                    f.fill()
                }
            } else if (c.maxSize != c.wrapper.offsetHeight) {
                c.maxSize = c.wrapper.offsetHeight;
                f = d.getCSSCanvasContext("2d", "scrollbar" + c.uid + c.dir, 5, c.maxSize);
                f.fillStyle = "rgb(0,0,0)";
                f.beginPath();
                f.arc(2.5, 2.5, 2.5, e, 0, !1);
                f.lineTo(5, c.maxSize - 2.5);
                f.arc(2.5, c.maxSize - 2.5, 2.5, 0, e, !1);
                f.closePath();
                f.fill()
            }
            c.size = Math.max(Math.round(c.maxSize * c.maxSize / b), 6);
            c.maxScroll = c.maxSize - c.size;
            c.toWrapperProp = c.maxScroll / (a - b);
            c.bar.style[c.dir == "horizontal" ? "width" : "height"] = c.size + "px"
        },
        setPosition: function(a) {
            var b = this;
            b.wrapper.style.opacity != "1" && b.show();
            a = Math.round(b.toWrapperProp * a);
            if (a < 0) {
                a = b.shrink ? a + a * 3 : 0;
                b.size + a < 7 && (a = -b.size + 6)
            } else if (a > b.maxScroll) {
                a = b.shrink ? a + (a - b.maxScroll) * 3 : b.maxScroll;
                b.size + b.maxScroll - a < 7 && (a = b.size + b.maxScroll - 6)
            }
            a = b.dir == "horizontal" ? i + a + "px,0" + j : i + "0," + a + "px" + j;
            b.bar.style.webkitTransform = a
        },
        show: function() {
            c && (this.wrapper.style.webkitTransitionDelay = "0");
            this.wrapper.style.opacity = "1"
        },
        hide: function() {
            c && (this.wrapper.style.webkitTransitionDelay = "350ms");
            this.wrapper.style.opacity = "0"
        },
        remove: function() {
            this.wrapper.parentNode.removeChild(this.wrapper);
            return null
        }
    };
    var c = "WebKitCSSMatrix" in window && "m11" in new WebKitCSSMatrix,
        d = /iphone|ipad/gi.test(navigator.appVersion),
        e = "ontouchstart" in window,
        f = e ? "touchstart" : "mousedown",
        g = e ? "touchmove" : "mousemove",
        h = e ? "touchend" : "mouseup",
        i = "translate" + (c ? "3d(" : "("),
        j = c ? ",0)" : ")",
        k = 0;
    window.iScroll = a
})();
getCookie = function(a) {
    var b = document.cookie.indexOf(a + "="),
        c = b + a.length + 1;
    if (!b && a != document.cookie.substring(0, a.length)) return null;
    if (b == -1) return null;
    var d = document.cookie.indexOf(";", c);
    d == -1 && (d = document.cookie.length);
    return unescape(document.cookie.substring(c, d))
};
setCookie = function(a, b, c, d, e, f) {
    var g = new Date;
    g.setTime(g.getTime());
    c && (c = c * 1e3 * 60 * 60 * 24);
    var h = new Date(g.getTime() + c);
    document.cookie = a + "=" + escape(b) + (c ? ";expires=" + h.toGMTString() : "") + (d ? ";path=" + d : "") + (e ? ";domain=" + e : "") + (f ? ";secure" : "")
};
deleteCookie = function(a, b, c) {
    getCookie(a) && (document.cookie = a + "=" + (b ? ";path=" + b : "") + (c ? ";domain=" + c : "") + ";expires=Thu, 01-Jan-1970 00:00:01 GMT")
};
jQuery.easing.jswing = jQuery.easing.swing;
jQuery.extend(jQuery.easing, {
    def: "easeOutQuad",
    swing: function(a, b, c, d, e) {
        return jQuery.easing[jQuery.easing.def](
        a, b, c, d, e)
    },
    easeInQuad: function(a, b, c, d, e) {
        return d * (b /= e) * b + c
    },
    easeOutQuad: function(a, b, c, d, e) {
        return -d * (b /= e) * (b - 2) + c
    },
    easeInOutQuad: function(a, b, c, d, e) {
        return (b /= e / 2) < 1 ? d / 2 * b * b + c : -d / 2 * (--b * (b - 2) - 1) + c
    },
    easeInCubic: function(a, b, c, d, e) {
        return d * (b /= e) * b * b + c
    },
    easeOutCubic: function(a, b, c, d, e) {
        return d * ((b = b / e - 1) * b * b + 1) + c
    },
    easeInOutCubic: function(a, b, c, d, e) {
        return (b /= e / 2) < 1 ? d / 2 * b * b * b + c : d / 2 * ((b -= 2) * b * b + 2) + c
    },
    easeInQuart: function(a, b, c, d, e) {
        return d * (b /= e) * b * b * b + c
    },
    easeOutQuart: function(a, b, c, d, e) {
        return -d * ((b = b / e - 1) * b * b * b - 1) + c
    },
    easeInOutQuart: function(a, b, c, d, e) {
        return (b /= e / 2) < 1 ? d / 2 * b * b * b * b + c : -d / 2 * ((b -= 2) * b * b * b - 2) + c
    },
    easeInQuint: function(a, b, c, d, e) {
        return d * (b /= e) * b * b * b * b + c
    },
    easeOutQuint: function(a, b, c, d, e) {
        return d * ((b = b / e - 1) * b * b * b * b + 1) + c
    },
    easeInOutQuint: function(a, b, c, d, e) {
        return (b /= e / 2) < 1 ? d / 2 * b * b * b * b * b + c : d / 2 * ((b -= 2) * b * b * b * b + 2) + c
    },
    easeInSine: function(a, b, c, d, e) {
        return -d * Math.cos(b / e * (Math.PI / 2)) + d + c
    },
    easeOutSine: function(a, b, c, d, e) {
        return d * Math.sin(b / e * (Math.PI / 2)) + c
    },
    easeInOutSine: function(a, b, c, d, e) {
        return -d / 2 * (Math.cos(Math.PI * b / e) - 1) + c
    },
    easeInExpo: function(a, b, c, d, e) {
        return b == 0 ? c : d * Math.pow(2, 10 * (b / e - 1)) + c
    },
    easeOutExpo: function(a, b, c, d, e) {
        return b == e ? c + d : d * (-Math.pow(2, -10 * b / e) + 1) + c
    },
    easeInOutExpo: function(a, b, c, d, e) {
        return b == 0 ? c : b == e ? c + d : (b /= e / 2) < 1 ? d / 2 * Math.pow(2, 10 * (b - 1)) + c : d / 2 * (-Math.pow(2, -10 * --b) + 2) + c
    },
    easeInCirc: function(a, b, c, d, e) {
        return -d * (Math.sqrt(1 - (b /= e) * b) - 1) + c
    },
    easeOutCirc: function(a, b, c, d, e) {
        return d * Math.sqrt(1 - (b = b / e - 1) * b) + c
    },
    easeInOutCirc: function(a, b, c, d, e) {
        return (b /= e / 2) < 1 ? -d / 2 * (Math.sqrt(1 - b * b) - 1) + c : d / 2 * (Math.sqrt(1 - (b -= 2) * b) + 1) + c
    },
    easeInElastic: function(a, b, c, d, e) {
        var f = 1.70158,
            g = 0,
            h = d;
        if (b == 0) return c;
        if ((b /= e) == 1) return c + d;
        g || (g = e * .3);
        if (h < Math.abs(d)) {
            h = d;
            var f = g / 4
        } else var f = g / (2 * Math.PI) * Math.asin(d / h);
        return -(h * Math.pow(2, 10 * (b -= 1)) * Math.sin((b * e - f) * 2 * Math.PI / g)) + c
    },
    easeOutElastic: function(a, b, c, d, e) {
        var f = 1.70158,
            g = 0,
            h = d;
        if (b == 0) return c;
        if ((b /= e) == 1) return c + d;
        g || (g = e * .3);
        if (h < Math.abs(d)) {
            h = d;
            var f = g / 4
        } else var f = g / (2 * Math.PI) * Math.asin(d / h);
        return h * Math.pow(2, -10 * b) * Math.sin((b * e - f) * 2 * Math.PI / g) + d + c
    },
    easeInOutElastic: function(a, b, c, d, e) {
        var f = 1.70158,
            g = 0,
            h = d;
        if (b == 0) return c;
        if ((b /= e / 2) == 2) return c + d;
        g || (g = e * .3 * 1.5);
        if (h < Math.abs(d)) {
            h = d;
            var f = g / 4
        } else var f = g / (2 * Math.PI) * Math.asin(d / h);
        return b < 1 ? -0.5 * h * Math.pow(2, 10 * (b -= 1)) * Math.sin((b * e - f) * 2 * Math.PI / g) + c : h * Math.pow(2, -10 * (b -= 1)) * Math.sin((b * e - f) * 2 * Math.PI / g) * .5 + d + c
    },
    easeInBack: function(a, b, c, d, e, f) {
        f == undefined && (f = 1.70158);
        return d * (b /= e) * b * ((f + 1) * b - f) + c
    },
    easeOutBack: function(a, b, c, d, e, f) {
        f == undefined && (f = 1.70158);
        return d * ((b = b / e - 1) * b * ((f + 1) * b + f) + 1) + c
    },
    easeInOutBack: function(a, b, c, d, e, f) {
        f == undefined && (f = 1.70158);
        return (b /= e / 2) < 1 ? d / 2 * b * b * (((f *= 1.525) + 1) * b - f) + c : d / 2 * ((b -= 2) * b * (((f *= 1.525) + 1) * b + f) + 2) + c
    },
    easeInBounce: function(a, b, c, d, e) {
        return d - jQuery.easing.easeOutBounce(a, e - b, 0, d, e) + c
    },
    easeOutBounce: function(a, b, c, d, e) {
        return (b /= e) < 1 / 2.75 ? d * 7.5625 * b * b + c : b < 2 / 2.75 ? d * (7.5625 * (b -= 1.5 / 2.75) * b + .75) + c : b < 2.5 / 2.75 ? d * (7.5625 * (b -= 2.25 / 2.75) * b + .9375) + c : d * (7.5625 * (b -= 2.625 / 2.75) * b + .984375) + c
    },
    easeInOutBounce: function(a, b, c, d, e) {
        return b < e / 2 ? jQuery.easing.easeInBounce(a, b * 2, 0, d, e) * .5 + c : jQuery.easing.easeOutBounce(a, b * 2 - e, 0, d, e) * .5 + d * .5 + c
    }
});
(function(a) {
    function b(a) {
        var b = ["transform", "WebkitTransform", "MozTransform"],
            c;
        while (c = b.shift()) if (typeof a.style[c] != "undefined") return c;
        return "transform"
    }
    var c = a.fn.css;
    a.fn.css = function(d, e) {
        typeof a.props["transform"] == "undefined" && (d == "transform" || typeof d == "object" && typeof d["transform"] != "undefined") && (a.props.transform = b(this.get(0)));
        if (a.props["transform"] != "transform") if (d == "transform") {
            d = a.props.transform;
            if (typeof e == "undefined" && jQuery.style) return jQuery.style(this.get(0), d)
        } else if (typeof d == "object" && typeof d["transform"] != "undefined") {
            d[a.props.transform] = d.transform;
            delete d.transform
        }
        return c.apply(this, arguments)
    }
})(jQuery);
(function(a) {
    var b = "deg";
    a.fn.rotate = function(c) {
        var d = a(this).css("transform") || "none";
        if (typeof c == "undefined") {
            if (d) {
                var e = d.match(/rotate\(([^)]+)\)/);
                if (e && e[1]) return e[1]
            }
            return 0
        }
        var e = c.toString().match(/^(-?\d+(\.\d+)?)(.+)?$/);
        if (e) {
            e[3] && (b = e[3]);
            a(this).css("transform", d.replace(/none|rotate\([^)]*\)/, "") + "rotate(" + e[1] + b + ")")
        }
        return this
    };
    a.fn.scale = function(b, c, d) {
        var e = a(this).css("transform");
        if (typeof b == "undefined") {
            if (e) {
                var f = e.match(/scale\(([^)]+)\)/);
                if (f && f[1]) return f[1]
            }
            return 1
        }
        a(this).css("transform", e.replace(/none|scale\([^)]*\)/, "") + "scale(" + b + ")");
        return this
    };
    var c = a.fx.prototype.cur;
    a.fx.prototype.cur = function() {
        return this.prop == "rotate" ? parseFloat(a(this.elem).rotate()) : this.prop == "scale" ? parseFloat(a(this.elem).scale()) : c.apply(this, arguments)
    };
    a.fx.step.rotate = function(c) {
        a(c.elem).rotate(c.now + b)
    };
    a.fx.step.scale = function(b) {
        a(b.elem).scale(b.now)
    };
    var d = a.fn.animate;
    a.fn.animate = function(a) {
        if (typeof a["rotate"] != "undefined") {
            var c = a.rotate.toString().match(/^(([+-]=)?(-?\d+(\.\d+)?))(.+)?$/);
            c && c[5] && (b = c[5]);
            a.rotate = c[1]
        }
        return d.apply(this, arguments)
    }
})(jQuery);
(function(a) {
    var b = "deg";
    a.fn.rotate = function(c) {
        var d = a(this).css("transform") || "none";
        if (typeof c == "undefined") {
            if (d) {
                var e = d.match(/rotate\(([^)]+)\)/);
                if (e && e[1]) return e[1]
            }
            return 0
        }
        var e = c.toString().match(/^(-?\d+(\.\d+)?)(.+)?$/);
        if (e) {
            e[3] && (b = e[3]);
            a(this).css("transform", d.replace(/none|rotate\([^)]*\)/, "") + "rotate(" + e[1] + b + ")")
        }
        return this
    };
    a.fn.scale = function(b, c, d) {
        var e = a(this).css("transform");
        if (typeof b == "undefined") {
            if (e) {
                var f = e.match(/scale\(([^)]+)\)/);
                if (f && f[1]) return f[1]
            }
            return 1
        }
        a(this).css("transform", e.replace(/none|scale\([^)]*\)/, "") + "scale(" + b + ")");
        return this
    };
    var c = a.fx.prototype.cur;
    a.fx.prototype.cur = function() {
        return this.prop == "rotate" ? parseFloat(a(this.elem).rotate()) : this.prop == "scale" ? parseFloat(a(this.elem).scale()) : c.apply(this, arguments)
    };
    a.fx.step.rotate = function(c) {
        a(c.elem).rotate(c.now + b)
    };
    a.fx.step.scale = function(b) {
        a(b.elem).scale(b.now)
    };
    var d = a.fn.animate;
    a.fn.animate = function(a) {
        if (typeof a["rotate"] != "undefined") {
            var c = a.rotate.toString().match(/^(([+-]=)?(-?\d+(\.\d+)?))(.+)?$/);
            c && c[5] && (b = c[5]);
            a.rotate = c[1]
        }
        return d.apply(this, arguments)
    }
})(jQuery);
(function(a) {
    var b = [];
    a.loadImages = function(c, d) {
        c instanceof Array || (c = [c]);
        for (var e = c.length, f = 0, g = e; g--;) {
            var h = document.createElement("img");
            h.onload = function() {
                f++;
                f >= e && a.isFunction(d) && d()
            };
            h.src = c[g];
            b.push(h)
        }
    }
})(jQuery);
$(function() {
    $.extend($.support, {
        touch: typeof Touch == "object"
    });
    if ($.support.touch) {
        document.addEventListener("touchstart", m, !1);
        document.addEventListener("touchmove", m, !1);
        document.addEventListener("touchend", m, !1);
        document.addEventListener("touchcancel", m, !1)
    }
});
var a = null,
    b = !1,
    c = null,
    e = !1,
    f = null,
    g = null,
    h = !1;