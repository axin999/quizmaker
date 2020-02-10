window.onload = function(){
	console.log("wee");

	let http = new XMLHttpRequest();

	http.onreadystatechange = function(){
		if(http.readyState == 4 && http.status == 200){
			//console.log(JSON.parse(http));
			console.log(http.responseText);
		}
	}
	http.open("GET","./data/sample.json",true);
	http.send();

	//console.log(http);
} 
