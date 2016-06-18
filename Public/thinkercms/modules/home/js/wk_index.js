

FOM(".backtop").click(function(){FOM('body,html').animate({scrollTop:0},1000);return false;});
+function(FOM){
	'use strict';
	var carousels=function(ele,options){
		this.FOMelement=ele,
		this.defaults={effect:"scroll",auto:"true",interval:5000,space:0,number:1,small:1,middle:1,big:1},
		this.options=FOM.extend({},this.defaults,options);
	};
	carousels.prototype.number=function(){
		var win=FOM(window).width();
		var number=this.options.number;
		if(win>760){number=this.options.small;};
		if(win>1000){number=this.options.middle;};
		if(win>1200){number=this.options.big;};
		return number;
	};
	carousels.prototype.list=function(){
		return this.FOMelement.find('.wk_item').length;
	};
	carousels.prototype.height=function(){
		var h=0;
		this.FOMelement.find('.wk_item').each(function(){
			if(FOM(this).outerHeight()>h){h=FOM(this).outerHeight();}
		});
		return h;
	//	return this.FOMelement.outerHeight();
	};
	carousels.prototype.width=function(){
		return Math.ceil((this.FOMelement.outerWidth()-(this.number()-1)*this.options.space)/this.number());
	};
	carousels.prototype.show=function(){
		var space=this.options.space;
		if(this.number()==1){space=0;};
		var outer=this.FOMelement.outerWidth()+space;
		this.FOMelement.find('.wk_carousel').css({'width':outer*3,'height':this.height(),'left':-outer});
		var items=this.FOMelement.find('.wk_item');
		items.css('width',this.width());
		items.hide();
		for(var i=0;i<this.number();i++){
			items.eq(i).show().css('left',outer+(this.width()+space)*i);
		};
	};
	carousels.prototype.page=function(){
		return Math.ceil(this.list()/this.number())-1;
	};
	carousels.prototype.nomove=function(){
		if(!this.FOMelement.find('.wk_carousel').is(":animated")){
			return true;
		}
		else{
			return false;
		};
	};
	carousels.prototype.gonext=function(){
		var that=this;
		var index=FOM(that.options.triggers).find("li.active").index()+1;
		var page=this.page();
		FOM(window).resize(function(){
			page=that.page();
		});
		if(index>page){index=0}
		this.scroll(index,2);
	};
	carousels.prototype.pointer=function(){
		if(this.options.triggers!=null){
			var that=this;
			var page=this.page();
//			var pointer='<li value="1" class="active"><span>1</span></li>';
//			for (var i=1;i<page+1;i++){
//				pointer=pointer+' <li value="'+(i+1)+'"><span>'+(i+1)+'</span></li>';
//			};
//			FOM(this.options.triggers).html(pointer);
//			FOM(this.options.triggers).css("margin-left",-FOM(this.options.triggers).outerWidth()/2);
			FOM(this.options.triggers + " li").on('click',function(){
				var index=FOM(this).index();
				var current=FOM(that.options.triggers).find("li.active").index();
				if(that.nomove()){
					if(index>current){
						that.scroll(index,2);
					}else if(index<current){
						that.scroll(index,0);
					}else{
						return false;
					};
				};
			});
		};
	};
	carousels.prototype.prev=function(){
		var that=this;
		var page=this.page();
		FOM(window).resize(function(){
			page=that.page();
		});
		FOM(this.options.prev).on('click',function(){
			var index=FOM(that.options.triggers).find("li.active").index();
			if(that.nomove()){
				if(index==0){
					that.scroll(page,0);
				}else{
					FOM(that.options.triggers).find("li.active").prev("li").trigger("click");
				};
			};
		});
	};
	carousels.prototype.next=function(){
		var that=this;
		var page=this.page();
		FOM(window).resize(function(){
			page=that.page();
		});
		FOM(this.options.next).on('click',function(){
			var index=FOM(that.options.triggers).find("li.active").index();
			if(that.nomove()){
				if(index==page){
					that.scroll(0,2);
				}else{
					FOM(that.options.triggers).find("li.active").next("li").trigger("click");
				};
			};
		});
	};
	carousels.prototype.scroll=function(page,x){
		FOM(this.options.triggers).find("li").eq(page).addClass("active").siblings().removeClass("active");
		var outer=this.FOMelement.outerWidth();
		var space=this.options.space;
		var number=this.number();
		var width=this.width();
		var items=this.FOMelement.find('.wk_item');
		if(number==1){space=0;};
		
		if(this.options.effect=="fade"){
			items.fadeOut(1000);
			for(var i=0;i<number;i++){
				items.eq((page)*number+i).css('left',(outer+space)+(width+space)*i).fadeIn(1000);
			};
		}else{
			for(var i=0;i<number;i++){
				items.eq((page)*number+i).show().css('left',(outer+space)*x+(width+space)*i);
			};
			this.FOMelement.find('.wk_carousel').animate({"left":-(outer+space)*x+"px"},this.options.scroll,function(){
				items.hide();
				for(var i=0;i<number;i++){
					items.eq((page)*number+i).show().css('left',outer+space+(width+space)*i);
				};
				FOM(this).css({left:-outer-space});
			});
		};
	};
	carousels.prototype.auto=function(){
		var that=this;
		if(this.options.auto=="true" && this.page()!=0){
			var autoScroll=setInterval(function(){
				that.gonext();
			},that.options.interval);
			var autoPlay=function(){
				autoScroll=setInterval(function(){
					that.gonext();
				},that.options.interval);
			};
			var stopPlay=function(){clearInterval(autoScroll);};
			this.FOMelement.hover(stopPlay,autoPlay);
		};
	};
	carousels.prototype.play=function(){
		var that=this;
		this.show();
		this.pointer();
		this.prev();
		this.next();
		this.auto();
		FOM(window).resize(function(){
			that.show();
			that.pointer();
		});
	};
	FOM.fn.wk_carousel=function(options){
		var carousel=new carousels(this, options);
		return carousel.play();
	};
}(jQuery);

+function(FOM){
	'use strict';
	var carousels=function(ele,options){
		this.FOMelement=ele,
		this.defaults={effect:"scroll",auto:"true",interval:5000,space:0,number:1,small:1,middle:1,big:1},
		this.options=FOM.extend({},this.defaults,options);
	};
	carousels.prototype.number=function(){
		var win=FOM(window).width();
		var number=this.options.number;
		if(win>760){number=this.options.small;};
		if(win>1000){number=this.options.middle;};
		if(win>1200){number=this.options.big;};
		return number;
	};
	carousels.prototype.list=function(){
		return this.FOMelement.find('.wk_item').length;
	};
	carousels.prototype.height=function(){
		var h=0;
		this.FOMelement.find('.wk_item').each(function(){
			if(FOM(this).outerHeight()>h){h=FOM(this).outerHeight();}
		});
		return h;
	//	return this.FOMelement.outerHeight();
	};
	carousels.prototype.width=function(){
		return Math.ceil((this.FOMelement.outerWidth()-(this.number()-1)*this.options.space)/this.number());
	};
	carousels.prototype.show=function(){
		var space=this.options.space;
		if(this.number()==1){space=0;};
		var outer=this.FOMelement.outerWidth()+space;
		this.FOMelement.find('.wk_bannerx').css({'width':outer*3,'height':this.height(),'left':-outer});
		var items=this.FOMelement.find('.wk_item');
		items.css('width',this.width());
		items.hide();
		for(var i=0;i<this.number();i++){
			items.eq(i).show().css('left',outer+(this.width()+space)*i);
		};
	};
	carousels.prototype.page=function(){
		return Math.ceil(this.list()/this.number())-1;
	};
	carousels.prototype.nomove=function(){
		if(!this.FOMelement.find('.wk_bannerx').is(":animated")){
			return true;
		}
		else{
			return false;
		};
	};
	carousels.prototype.gonext=function(){
		var that=this;
		var index=FOM(that.options.triggers).find("li.active").index()+1;
		var page=this.page();
		FOM(window).resize(function(){
			page=that.page();
		});
		if(index>page){index=0}
		this.scroll(index,2);
	};
	carousels.prototype.pointer=function(){
		if(this.options.triggers!=null){
			var that=this;
			var page=this.page();
			var pointer='<li value="1" class="active"><span>1</span></li>';
			for (var i=1;i<page+1;i++){
				pointer=pointer+' <li value="'+(i+1)+'"><span>'+(i+1)+'</span></li>';
			};
			FOM(this.options.triggers).html(pointer);
//			FOM(this.options.triggers).css("margin-left",-FOM(this.options.triggers).outerWidth()/2);
			FOM(this.options.triggers + " li").on('click',function(){
				var index=FOM(this).index();
				var current=FOM(that.options.triggers).find("li.active").index();
				if(that.nomove()){
					if(index>current){
						that.scroll(index,2);
					}else if(index<current){
						that.scroll(index,0);
					}else{
						return false;
					};
				};
			});
		};
	};
	carousels.prototype.prev=function(){
		var that=this;
		var page=this.page();
		FOM(window).resize(function(){
			page=that.page();
		});
		FOM(this.options.prev).on('click',function(){
			var index=FOM(that.options.triggers).find("li.active").index();
			if(that.nomove()){
				if(index==0){
					that.scroll(page,0);
				}else{
					FOM(that.options.triggers).find("li.active").prev("li").trigger("click");
				};
			};
		});
	};
	carousels.prototype.next=function(){
		var that=this;
		var page=this.page();
		FOM(window).resize(function(){
			page=that.page();
		});
		FOM(this.options.next).on('click',function(){
			var index=FOM(that.options.triggers).find("li.active").index();
			if(that.nomove()){
				if(index==page){
					that.scroll(0,2);
				}else{
					FOM(that.options.triggers).find("li.active").next("li").trigger("click");
				};
			};
		});
	};
	carousels.prototype.scroll=function(page,x){
		FOM(this.options.triggers).find("li").eq(page).addClass("active").siblings().removeClass("active");
		var outer=this.FOMelement.outerWidth();
		var space=this.options.space;
		var number=this.number();
		var width=this.width();
		var items=this.FOMelement.find('.wk_item');
		if(number==1){space=0;};
		
		if(this.options.effect=="fade"){
			items.fadeOut(1000);
			for(var i=0;i<number;i++){
				items.eq((page)*number+i).css('left',(outer+space)+(width+space)*i).fadeIn(1000);
			};
		}else{
			for(var i=0;i<number;i++){
				items.eq((page)*number+i).show().css('left',(outer+space)*x+(width+space)*i);
			};
			this.FOMelement.find('.wk_bannerx').animate({"left":-(outer+space)*x+"px"},this.options.scroll,function(){
				items.hide();
				for(var i=0;i<number;i++){
					items.eq((page)*number+i).show().css('left',outer+space+(width+space)*i);
				};
				FOM(this).css({left:-outer-space});
			});
		};
	};
	carousels.prototype.auto=function(){
		var that=this;
		if(this.options.auto=="true" && this.page()!=0){
			var autoScroll=setInterval(function(){
				that.gonext();
			},that.options.interval);
			var autoPlay=function(){
				autoScroll=setInterval(function(){
					that.gonext();
				},that.options.interval);
			};
			var stopPlay=function(){clearInterval(autoScroll);};
			this.FOMelement.hover(stopPlay,autoPlay);
		};
	};
	carousels.prototype.play=function(){
		var that=this;
		this.show();
		this.pointer();
		this.prev();
		this.next();
		this.auto();
		FOM(window).resize(function(){
			that.show();
			that.pointer();
		});
	};
	FOM.fn.wk_carouselx=function(options){
		var carouselx=new carousels(this, options);
		return carouselx.play();
	};
}(jQuery);


/*新闻TAB效果*/
 FOM(document).ready(function(){
        FOM(".wk_news-nav li").hover(function(){
        FOM(".wk_news-nav li").eq(FOM(this).index()).addClass("cur").siblings().removeClass('cur');
FOM(".wk_tabCon ul").hide().eq(FOM(this).index()).show();
       //另一种方法: FOM("div").eq(FOM(".tab li").index(this)).addClass("on").siblings().removeClass('on'); 

        });
    });
	
/*轮播与案例滚动*/
FOM(function(){
	FOM('#wk_banner').wk_carousel({
		'auto':'true',
		'triggers':'#wk_bpoint',
		'scroll':500
	});
	FOM('#wk_icase').wk_carouselx({
		'auto':'true',
		'triggers':'#wk_cpoint',
		'scroll':500
	});
		FOM(window).load(function(){
			var h1=FOM('#wk_banner-body .wk_item').outerHeight();
			var h2=FOM('#wk_case-body .wk_item').outerHeight();
			FOM('#wk_banner-body').css('height',h1);
			FOM('#wk_case-body').css('height',h2);
		});
});


