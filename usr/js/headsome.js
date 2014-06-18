//<!--友情链接图标favicon-->
jQuery(document).ready(function($){ 
$(".link_page ul li a").each(function(e){
$(this).prepend("<img src=http://www.google.com/s2/favicons?domain="+this.href.replace(/^(http:\/\/[^\/]+).*$/, '$1').replace( 'http://', '' )+" s					tyle=float:left;padding:5px;>");
}); 
});
//<!--end 友情链接图标favicon-->
//<!--搜索弹性菜单-->
$(document).ready(function(){
$(".field").focus(function(){
$(this).stop(true,false).animate({width:"175px"},"slow");
})
//移动后还原
.blur(function(){
$(this).animate({width:"72px"},"slow");
});
});
//<!--end 搜索弹性菜单-->
//<!--Page loading-->
jQuery(function(){
jQuery('#loading-one').empty().append('页面加载完毕.').parent().fadeOut('slow');
});   
//<!--end Page loading-->
//<!--图片显隐-->
$(function () {
$('img').hover(
function() {$(this).fadeTo("fast", 0.5);},
function() {$(this).fadeTo("fast", 1);
});
});
//<!--end 图片显隐-->