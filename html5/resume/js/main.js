/**
 *---------------------------------------------------------------
 * 2013 简历公用JS
 *---------------------------------------------------------------
 * @auth break
 * @create 2013
 * @link http://www.shizuwu.cn
 */


$.fn.center = function (flag) {
	var _this = this;
	var _top = $(window).height() / 2 - this.height() / 2;
	var _left = $(window).width() / 2 - this.width() / 2;
	if (!flag) {
		_this.animate({
			marginTop:_top,
			marginLeft:_left
		}, 100, "linear");
		
		$(window).resize(function () {
			_this.center(!flag);
		})
	} else {
		_top = (_top < 0) ? 0 : _top;
		_left = (_left < 0) ? 0 : _left;
		
		_this.stop().animate({
			marginTop: _top,
			marginLeft: _left
		}, 100, "swing");
	}
};

//工作经验列表
var myScroll,
	nice = false;

function loaded() {
    myScroll = new iScroll('is-wrapper', { snap:'li',momentum: false, vScrollbar:false,
        onScrollEnd: function (opts) {
        }, onBeforeScrollStart: function (e) {
            e.preventDefault();
        }
    });

    $("#is-scroller").css({"width":$("#exp-items li").size() * 200});
    myScroll.refresh();
}

//document.getElementById("is-wrapper").addEventListener('touchmove', function (e) { e.preventDefault();}, false);
//document.addEventListener('DOMContentLoaded', function () { setTimeout(loaded, 200); }, false);

$(function() {

    //自定义滚动条
    nice = $("html").niceScroll({"cursorwidth":"6","cursoropacitymax":"0.8"});
    nice.resize();

    //工作经验详情
    $("#exp-items li").click(function() {
    	var _box = $("#exp-detail");
    	_box.hide();
    	_box.find("#detailinfo").empty().html($(this).find("code").html());
    	_box.center();
    	_box.removeClass("flip").fadeIn(100).addClass("flip");
    });
    $("#close").click(function() {
    	var _this = $("#exp-detail");
    	_this.removeClass("flip").fadeOut(200);
    	setTimeout(function() {
    		_this.find("#detailinfo").empty();
    	}, 300);
    });

    $("#figure .bar span").each(function() {
        console.log($(this).attr("year"));
        $(this).parent().css({'height': ($(this).attr("year")/5)*100 + "%", '-webkit-transition': 'all 0.8s ease-out'});
    })
})
