mostraBottoni();

function mostraBottoni(){
	//mostrare tutti i bottoni e far scomparire tutti i link
	listLink=document.getElementsByClassName("linkMostra");
	list=document.getElementsByClassName("showButton");
	for(i=0;i<list.length;i++){
		listLink[i].style.display="none";
		list[i].style.display="block";
	}
}

function mostraTutto(id) {
	document.getElementById("button"+id).style.display="none";
	document.getElementById("paragraph"+id).innerHTML= document.getElementById("article" + id).innerHTML;
}