onLoaded.push(function() {
	$('.slider').slick({
		autoplay: false,
		// autoplaySpeed: 3000,
		prevArrow: "#ms-prev",
		nextArrow: "#ms-next",
		// centerMode: true,
		// centerPadding: "10px",
		// speed: 300,
		swipeToSlide: true,
		slidesToShow: 3,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 1,
				}
			},
		],
	});
})

onLoaded.push(function() {
	$('.op-slider').slick({
		autoplay: false,
		// autoplaySpeed: 3000,
		// prevArrow: "#ms-prev",
		// nextArrow: "#ms-next",
		sliderArrows: false,
		arrows: false,
		// centerMode: true,
		// centerPadding: "10px",
		// speed: 300,
		swipeToSlide: true,
		slidesToShow: 6,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 2,
				}
			},
		],
	});
})

onLoaded.push(function() {
	var wrap = document.getElementById("op-wrap");
	var title = document.getElementById("op-title");
	var subtitle = document.getElementById("op-subtitle");
	var text = document.getElementById("op-text");
	var elems = document.getElementsByClassName("op-slide");
	for (var i = 0; i < elems.length; i++) {
		const ci = i;
		elems[ci].onmouseover = function() {
			title.innerHTML = elems[ci].dataset.title;
			subtitle.innerHTML = elems[ci].dataset.subtitle;
			text.innerHTML = elems[ci].dataset.text;
		}
	}
})