onLoaded.push(function() {
	if (Info.mob) {
		$('.thank__wrap').slick({
			autoplay: false,
			// autoplaySpeed: 3000,
			prevArrow: "#ms-prev",
			nextArrow: "#ms-next",
			// centerMode: true,
			// centerPadding: "10px",
			// speed: 300,
			swipeToSlide: true,
			slidesToShow: 2,
		});
	}
});