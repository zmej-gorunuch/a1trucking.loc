onLoaded.push(function() {
	document.getElementById("ba__l_count-2").innerHTML = document.getElementsByClassName("ba-l-slider-elem").length;
	var count1 = document.getElementById("ba__l_count-1");
	count1.innerHTML = 1;
	$('.ba-l-slider').slick({
		autoplay: false,
		// autoplaySpeed: 3000,
		prevArrow: "#ms-prev",
		nextArrow: "#ms-next",
		// centerMode: true,
		// centerPadding: "10px",
		// speed: 300,
		swipeToSlide: true,
		slidesToShow: 1,
		asNavFor: '.ba__l_b_slides',
	});
	$('.ba__l_b_slides').slick({
		autoplay: false,
		swipeToSlide: true,
		slidesToShow: 5,
		asNavFor: '.ba-l-slider',
		arrows: false,
		centerMode: true,
		centerPadding: "0px",
		responsive: [
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 3,
				}
			},
		],
	});
	$('.ba-l-slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
		count1.innerHTML = nextSlide + 1;
	});
})

onLoaded.push(function() {
	$('.blog_article__related_posts').slick({
		autoplay: false,
		// autoplaySpeed: 3000,
		prevArrow: "#rp-prev",
		nextArrow: "#rp-next",
		centerMode: true,
		centerPadding: "0px",
		// speed: 300,
		swipeToSlide: true,
		slidesToShow: 3,
	});
})