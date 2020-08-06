onLoaded.push(function() {
	if (Info.mob) {
		$('.slider').slick({
			autoplay: false,
			// autoplaySpeed: 3000,
			prevArrow: "#ms-prev",
			nextArrow: "#ms-next",
			// centerMode: true,
			// centerPadding: "10px",
			// speed: 300,
			swipeToSlide: true,
			slidesToShow: 1,
		});
	}
})

onLoaded.push(function() {
	var whichActive = 0;
	var blockswitch = document.getElementsByClassName("blockswitch-btn");
	var elems = document.getElementsByClassName("blockswitch-elem");
	var amount = blockswitch.length;
	for (var i = 0; i < amount; i++) {
		const ci = i;
		blockswitch[ci].onclick = function() {
			console.log(ci, whichActive);
			if (whichActive != ci) {
				for (let j = 0; j < amount; j++) {
					const cj = j;
					elems[cj].classList.remove("active");
					blockswitch[cj].classList.remove("active");
				}
				elems[ci].classList.add("active");
				blockswitch[ci].classList.add("active");
				whichActive = ci;
			}
		}
	}
});