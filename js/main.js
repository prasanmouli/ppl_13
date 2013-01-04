function hide(get) {
	if (!document.getElementById) {
	return false;
	}
	var divID = document.getElementById(get);
	divID.style.display     = "none";
	divID.style.visibility  = "hidden";         
}	

		
function make_visible(get) {
	if (!document.getElementById) {
		return false;
	}
	var divID = document.getElementById(get);
	divID.style.display = "block";
	divID.style.visibility = "visible";
	
}
