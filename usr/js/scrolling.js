// 滚屏
$(function(){
 		       var $upDown=$("#upDown")
		       ,$upBtn=$upDown.find("a.upMove")
			   ,$downBtn=$upDown.find("a.downMove")
			   ,$hdBtn=$upDown.find("a.hdMove")
			   ,intvalId
			   ,$doc=$(document)
			   ,hd=false;
			   
 			   //返回顶部
			   $upBtn.click(function(event){
									event.preventDefault();
							        clearInterval(intvalId);
 									function moveup(){
 										var cTop=$doc.scrollTop(),step=50;
										if(cTop){
										$doc.scrollTop(cTop-(10*(cTop/step)));
										}else{
											clearInterval(intvalId);
											}
										}
 									    intvalId=setInterval(moveup,100); 
									 });
			   
			  //返回底部
			   $downBtn.click(function(event){
									event.preventDefault();
									clearInterval(intvalId);
							        var maxScroll=$(document).height()-$(window).height();
 									
 									function moveDown(){
 										var cTop=$doc.scrollTop()+1,step=50;
										if(cTop<maxScroll){
										$doc.scrollTop(cTop+(10*((maxScroll-cTop)/step)));
										}else{
											clearInterval(intvalId);
											}
										}
 									    intvalId=setInterval(moveDown,100); 
									 });
			   
			   //恢复上下滚动按钮样式-------------------------------
			   function hdDefault(){
				     $hdBtn.css("background-position","left -29px").attr("title","单击跟随鼠标上下滚动");
					 $upBtn.removeClass("udHide");
					 $downBtn.removeClass("udHide"); 
					 hd=false;
					 clearInterval(intvalId);
					 $doc.unbind("mousemove");
				   }
				   
			   //切换到上下滑动
			   $hdBtn.click(function(event){
									 event.preventDefault();
 									 clearInterval(intvalId);
									 if(!hd){
 									 $(this).css("background-position","-35px -29px").attr("title","Stop");
									 $upBtn.addClass("udHide");
									 $downBtn.addClass("udHide");
									 hd=true;
									 
 									 //move---------------------
									 var maxScroll=$(document).height()-$(window).height();
									 var d=50;
									 
									 function move(d){
										    var cTop=$doc.scrollTop();
 											    $doc.scrollTop(cTop+d); 
  										 }
									 //-----------------------------------------------------
									 intvalId=setInterval(function(){
															move(d/10); 	   
															        },30);
									 
 									 $doc.mousemove(function(event){
 														var mY=event.pageY;
														 //中心点位置
									                    var o=$upDown.offset()
									                        ,oTop=o.top+$upDown.height()/2;
														    d=mY-oTop;	
  														});
   									  
									 }else{
									     hdDefault();
										 }
									 });
		    //单击右键取消上下滚动---------------------------------------------------------------------- 
			                          $("body").dblclick(function(event){
								        event.preventDefault();  
								        hdDefault();
									  });	   
 			  
		   });

