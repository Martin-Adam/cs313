function handleUpdateClick(){
	var text = document.getElementById("input").value;
	var color = document.getElementById("color").value;
	
	if (confirm("Are you sure you want ot make this change?") == true){
		appendText(text);
		updateColor(color);		
	}
}
function appendText(text){
	document.getElementById("display").innerHTML = text;
}
function updateColor(color){
	document.getElementById("display").style.backgroundColor= color;
}

var bool = 1;

function vis(){
	if(bool == 0)
	{
		bool = 1;
		document.getElementById("display").style.opacity = [bool];
	}
	else{
		bool = 0;
		document.getElementById("display").style.opacity = [bool];
	}
}
