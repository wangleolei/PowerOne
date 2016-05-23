//使图片不超过一定范围，并不改变比例	
	function ImgReSize(e,width,height)
{
        if(!arguments[2]) height = ((e.height)/e.width)*width; //如果不给高，高自动

		
		
		///alert("原来"+e.width+"|"+e.height);
		
		var rule=e.width/e.height;
		//alert(rule);
		//分两步，第一步宽大于宽，宽等于宽，高按比例，
		//然后缩放后如果高还大于预定的高，高再缩小至给定的高，宽再按比例缩小
		if(e.width>=width){
				e.width=width;
				e.height=e.width/rule;
						
		}
		//alert("1："+e.width+"|"+e.height);
		
		if(e.height>height){
				e.height=height;
				e.width=e.height*rule;
			} 
		//e.width=100.999909890809809890;会下行舍入成整数100
		//alert("2："+e.width+"|"+e.height);
		
}