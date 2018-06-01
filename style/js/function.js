window.onload = function() {
	let input = document.querySelectorAll(".md-form input");
	for (let i = 0; i < input.length; i++) {
		input[i].addEventListener("focusin", function(){setClass(i)}, false);
		input[i],addEventListener("focusout", function(){unSetClass(i, input[i].value), flase});
	}
};

function setClass(i) {
	let label = document.querySelectorAll(".md-form label");
	label[i].className = "active";
}

function unSetClass(i, value) {
	let label = document.querySelectorAll(".md-form label");
	if (value.length == 0)
		label[i].className = " ";
}