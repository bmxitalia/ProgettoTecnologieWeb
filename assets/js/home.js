setInterval(sliderHome, 3000);

var total_slide   = document.getElementById("homeSlider").querySelectorAll(".slide").length - 1;
var index_visible = 0;

function sliderHome() {
	var hidden  = document.getElementById("homeSlider").querySelectorAll(".hidden");
	var visible = document.getElementById("homeSlider").querySelectorAll(".visible");

	if(index_visible == total_slide){
		index_visible = 0;
	}

	visible[0].classList.add('hidden');
	visible[0].classList.remove('visible');

	hidden[index_visible].classList.add('visible');
	hidden[index_visible].classList.remove('hidden');

	index_visible++;
}