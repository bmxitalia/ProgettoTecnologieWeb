removeNoJsMenu();

function loadResponsiveMenu() {
    var x = document.getElementById("mainNav");

    if (x.className === "nav") {
        x.className += " responsive";
    }
    else {
        x.className = "nav";
    }
}

// remove the noJs menu alternative
function removeNoJsMenu() {
	var noJsNav = document.getElementById("noJsNav");

	noJsNav.className += " hidden";
	noJsNav.remove();
}