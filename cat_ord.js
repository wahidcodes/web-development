
function myfun(){
				if(window.XMLHttpRequest)
				{
					a=new XMLHttpRequest();
				}
				else
				{
					a=new ActiveXObject("Microsoft.XMLHTTP");
				}
				a.onreadystatechange=function(){
					if(a.readyState==4&& a.status==200)
					{
						alert(a.responseText);
					}
				}
		
	var mordby = document.getElementById("ordby").value;
	
	var url="fetch_data.php";
	var val="ordby="+mordby;	
	
				a.open("POST",url,true);
				a.setRequestHeader("content-type","application/x-www-form-urlencoded");
				a.setRequestHeader("content-length",val.length);
				a.setRequestHeader("connecion","close");
				a.send(val)
		
	}


