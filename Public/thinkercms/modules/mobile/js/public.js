$(function() {
	var winH=$(window).height()-40;
	$('.freebj').height(winH);
	$('.baidushare').height($(window).height());

	$(window).resize(function(event) {
		var winH=$(window).height()-40;
		$('.freebj,.baidushare').height(winH);
	});

	// 右上角分类列表
	$('.category a').click(function(event) {
		$('body').css('overflow-y','hidden')
		$('.nav').fadeIn();
	});

	$('.close a,.page2,.page3').click(function(event) {
		$('.nav').hide();
		$('body').css('overflow-y','auto');
	});

	$('.page41').click(function(event) {
		$('.nav').hide();
		$('body').css('overflow-y','auto');
		$('.zqdl-content ul li').removeClass('active').eq(0).addClass('active');
	});

	$('.page42').click(function(event) {
		$('.nav').hide();
		$('body').css('overflow-y','auto');
		$('.zqdl-content ul li').removeClass('active').eq(1).addClass('active');
	});

	$('.page43').click(function(event) {
		$('.nav').hide();
		$('body').css('overflow-y','auto');
		$('.zqdl-content ul li').removeClass('active').eq(2).addClass('active');
	});

	// 关于中企tab切换
	$('.zqdl-content ul.hd li').click(function(event) {
		var _thisid=$(this).index();
		$(this).addClass('active').siblings('').removeClass('active');
		$('.zqdl-content ul.bd>li').eq(_thisid).addClass('active').siblings('').removeClass('active');
	});

	// 脚部tab
	$('footer ul li').click(function(event) {
		$(this).addClass('active').siblings('').removeClass('active');
	});
	 // 回到顶部
	$('.scrTop').click(function(event) {
		$(window).scrollTop(0);
	});

	$('.freebj .freebj-close').click(function() {
		$('body').css('overflow-y','auto');
		$('.freebj').hide();
	});

	$('footer ul li.last').click(function(event) {
		$('body').css('overflow-y','hidden');
		$('.freebj').show();
	});

	// 分享弹出
	$('.shareCon').click(function(e) {
		$('.baidushare').show();
		e.stopPropagation();
	});

	// 分享关闭
	$(document).click(function(e) {
		$('.baidushare').hide();
		e.stopPropagation();
	});

});