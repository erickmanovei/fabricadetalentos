function mascaraData(id){
	if(document.getElementById(id).value.length == 2){
		document.getElementById(id).value = document.getElementById(id).value + "/";
	}
	if(document.getElementById(id).value.length == 5){
		document.getElementById(id).value = document.getElementById(id).value + "/";
	}
}
