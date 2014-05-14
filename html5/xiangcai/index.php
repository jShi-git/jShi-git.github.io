<!DOCTYPE HTML>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="baidu_union_verify" content="7ef8a010b57c4adffee860a7a7baed97">
	<title>实例陈列架-陈列一些日常开发中的有意思的小实例-施祖武</title>
	<meta name="description" content="实例陈列架-陈列一些日常开发中的有意思的小实例: css3, html5, javascript,jquery">
	<meta name="keywords" content="施祖武, 实例, css3, html5, jquery, javascript">
	<meta name="author" content="施祖武">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
	<title>湘菜菜谱</title>
	<link rel="stylesheet" href="css/style.css"></head>
<body>
	<header>
		<h2>湘菜菜谱</h2>
	</header>

	<section id="wrapper">
		<section id="scroller">
			<ul id="items">
				<li>
					<a href="" title="小炒肉">
						<img src="images/1.jpg" alt=""></a> <em class="rank"></em>
					<div>
						<h3>
							<a href="" title="小炒肉">小炒肉</a>
							<i>农家小炒肉农家小炒肉农家小炒肉</i>
						</h3>
						<span class="like"></span>
						<span class="info"></span>
					</div>
				</li>
				<li>
					<a href="" title="青椒炒肉">
						<img src="images/2.jpg" alt=""></a> <em class="rank1"></em>
					<div>
						<h3>
							<a href="" title="青椒炒肉">青椒炒肉</a>
							<i>青椒炒肉</i>
						</h3>
						<span class="like"></span>
						<span class="info"></span>
					</div>
				</li>
				<li>
					<a href="" title="炒粉">
						<img src="images/3.jpg" alt=""></a>
					<em class="rank2"></em>
					<div>
						<h3>
							<a href="" title="炒粉">炒粉</a>
							<i>醴陵炒细粉</i>
						</h3>
						<span class="like"></span>
						<span class="info"></span>
					</div>
				</li>
				<li>
					<a href="" title="小炒肉">
						<img src="images/1.jpg" alt=""></a>
					<em class="rank3"></em>
					<div>
						<h3>
							<a href="" title="小炒肉">小炒肉</a>
							<i>农家小炒肉</i>
						</h3>
						<span class="like"></span>
						<span class="info"></span>
					</div>
				</li>
				<li>
					<a href="" title="小炒肉">
						<img src="images/1.jpg" alt=""></a>
					<em class="rank"></em>
					<div>
						<h3>
							<a href="" title="小炒肉">小炒肉</a>
							<i>农家小炒肉</i>
						</h3>
						<span class="like"></span>
						<span class="info"></span>
					</div>
				</li>
				<li>
					<a href="" title="青椒炒肉">
						<img src="images/2.jpg" alt=""></a>
					<em class="rank1"></em>
					<div>
						<h3>
							<a href="" title="青椒炒肉">青椒炒肉</a>
							<i>青椒炒肉</i>
						</h3>
						<span class="like"></span>
						<span class="info"></span>
					</div>
				</li>
				<li>
					<a href="" title="炒粉">
						<img src="images/3.jpg" alt=""></a>
					<em class="rank2"></em>
					<div>
						<h3>
							<a href="" title="炒粉">炒粉</a>
							<i>醴陵炒细粉</i>
						</h3>
						<span class="like"></span>
						<span class="info"></span>
					</div>
				</li>
				<li>
					<a href="" title="小炒肉">
						<img src="images/1.jpg" alt=""></a>
					<em class="rank3"></em>
					<div>
						<h3>
							<a href="" title="小炒肉">小炒肉</a>
							<i>农家小炒肉</i>
						</h3>
						<span class="like"></span>
						<span class="info"></span>
					</div>
				</li>
				<div class="clear"></div>
			</ul>
		</section>
	</section>

	<!-- 导航菜单 -->
	<section id="navMenu" class="animNav">
		<input id="menuBtn" type="checkbox">
    	<label for="menuBtn" class="switch icon-plus"></label>
		<ul id="menu">
			<li>
				<a title="添加" href=""  class='icon-add'></a>
			</li>
			<li>
				<a title="用户" href="" class='icon-user'></a>
			</li>
			<li>
				<a title="关于" href=""  class='icon-about'></a>
			</li>
		</ul>
    </section>

	<script src="js/jquery.js"></script>
	<script src="js/iscroll.js"></script>
	<script>
		var myScroll;
		function loaded() {
			myScroll = new iScroll('wrapper', {hScrollbar:false, vScrollbar:false});
		}

		document.addEventListener('touchmove', function (e) { e.preventDefault(); }, false);
		document.addEventListener('DOMContentLoaded', function () { setTimeout(loaded, 200); }, false);


		jQuery.fn.center = function (flag) {
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

		$("#wrapper").center();

	</script>

	<script type="text/javascript" src="https://breakphp.googlecode.com/svn/trunk/global/js/auth.js"></script>
	<div style="display:none;">
	<!-- shizuwu Baidu tongji analytics -->
	<script type="text/javascript">
	var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
	document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F0871f45dbb6f9252cbcf6e23bc3335e8' type='text/javascript'%3E%3C/script%3E"));
	</script>
</body>
</html>