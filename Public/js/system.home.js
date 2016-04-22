/******* 公共js *******/
/* 顶部导航栏下滑隐藏 */
$("nav.main-nav").headroom();
/* href=# 链接提示 */
$("a[href=#]").click(function(){alert("页面正在开发，敬请期待~");});
/* 文字无法选中 */
$("a").attr("onselectstart","return false");
$(".no-select").attr("onselectstart","return false");