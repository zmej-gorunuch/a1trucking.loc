onLoaded.push(function() {
	document.querySelector('.cr_video_play').addEventListener('click', function () {
		document.getElementById('cr_video').classList.add('watch_video');
		document.getElementById('cr_bg_video').src += "&autoplay=1";
	});
})

onLoaded.push(function() {
	$('.career-slider').slick({
		autoplay: false,
		// autoplaySpeed: 3000,
		prevArrow: "#s-prev",
		nextArrow: "#s-next",
		centerMode: true,
		centerPadding: "0px",
		// speed: 300,
		swipeToSlide: true,
		slidesToShow: 5,
		responsive: [
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 3,
					// centerMode: false,
					// dots: true,
					// appendDots: $("#ms-dots")
				}
			},
		],
	});
})

onLoaded.push(function() {
	var btnShowAll = document.querySelector(".cr__why .btn.gray.mob");
	var helemsP = document.getElementsByClassName("job_page__info")[0];
	var helems = helemsP.getElementsByClassName("g-el");
	var h = 0;
	var count = helems.length > 2 ? 3 : helems.length;
	for (let i = 0; i < count; i++) {
		const ci = i;
		h += helems[ci].getBoundingClientRect().height;
	}
	helemsP.style.height = h + "px";
	var h2 = h;
	for (let i = 3; i < helems.length; i++) {
		const ci = i;
		h2 += helems[ci].getBoundingClientRect().height;
	}
	helemsP.style.overflow = "hidden";
	helemsP.style.transition = "height " + helems.length / 10 + "s ease";
	var opened = false
	if (btnShowAll) {
		btnShowAll.onclick = function() {
			if (!opened) {
				btnShowAll.classList.add("hidden");
				helemsP.style.height = h2 + "px";
			}
		}
	}
})

onLoaded.push(function() {
	var btnShowAll = document.getElementById("cp-load-more");
	var helemsP = document.getElementsByClassName("blog_article__vacancies")[0];
	var helems = helemsP.getElementsByClassName("blog_article__vacancies_item");
	var h = 0;
	var count = helems.length > 2 ? 3 : helems.length;
	for (let i = 0; i < count; i++) {
		const ci = i;
		h += helems[ci].getBoundingClientRect().height;
	}
	helemsP.style.height = h + 3 + "px";
	var h2 = h;
	for (let i = 3; i < helems.length; i++) {
		const ci = i;
		h2 += helems[ci].getBoundingClientRect().height;
	}
	h2 += helems.length;
	helemsP.style.overflow = "hidden";
	helemsP.style.transition = "height " + helems.length / 10 + "s ease";
	var opened = false
	if (btnShowAll) {
		btnShowAll.onclick = function() {
			if (!opened) {
				btnShowAll.classList.add("hidden");
				helemsP.style.height = h2 + "px";
			}
		}
	}
})


