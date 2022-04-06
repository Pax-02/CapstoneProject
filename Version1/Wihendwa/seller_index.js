document.getElementById('button').addEventListener("click", function() {
	document.querySelector('.pop-out').style.display = "flex";
});

document.querySelector('.close').addEventListener("click", function() {
	document.querySelector('.pop-out').style.display = "none";
});