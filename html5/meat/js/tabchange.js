 function selectTab(n){
	
	
 
	 for(var i=1;i<=20;i++)
	{
		 
		document.getElementById("menu"+i).className="li2s"; 
		document.getElementById("info"+i).className="link1";
		
		 
		 
		 
	}
	document.getElementById("menu"+n).className="li2"; 
	document.getElementById("info"+n).className="link_current";
	
	
	
 
 
}  
 


/*function tab(){
	var leftMenu=document.getElementById("leftMenu").getElementsByTagName("li");
	var rightMenu=document.getElementById("rightMenu").getElementsByTagName("li");
	for (var i=0;i<leftMenu.length;i++){
		leftMenu[i].index=i;
		leftMenu[i].onclick=function(){
			for (var j=0;j<leftMenu.length;j++){
				leftMenu[j].className="li2s";
				rightMenu[j].className="link1";
			}
			var num=this.index;
			leftMenu[this.index].className="li2";
			rightMenu[num].className="link_current";
		}
	}
}*/
