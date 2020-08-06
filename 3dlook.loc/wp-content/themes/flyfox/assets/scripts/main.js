onLoaded.push(function(){
	initReviews();
	initFIP();
	initMainPageSlick();
	if (Info.mob) {
		initWCBSlider();
	}
});

var CP = []
function initReviews() {
	var elems = document.getElementsByClassName("cp-elem");
	var detailsParent = document.getElementsByClassName("cp-details");
	var rowCount = Math.floor(elems.length / 2);
	var tmp = false;
	while (CP.length < rowCount) {
		CP.push(0);
	}
	for (var i = 0; i < detailsParent.length; i++) {
		const ci = i;
		detailsParent[ci].getElementsByClassName("cp-detail")[0].classList.add("active");
		detailsParent[ci].style.height = detailsParent[ci].getElementsByClassName("cp-detail")[0].getBoundingClientRect().height + "px";
	}
	for (var i = 0; i < elems.length; i++) {
		const ci = i;
		const elem = elems[i];
		const row = Math.floor(ci / 2);
		const col = ci % 2;
		elem.onclick = function() {
			this.classList.add("active");
			this.parentNode.getElementsByClassName("cp-elem")[CP[row]].classList.remove("active");
			CP[row] = col;
		}
		elem.onmouseover = function() {
			if(CP[row] != col) {
				this.parentNode.getElementsByClassName("cp-detail")[CP[row]].classList.remove("active");
				tmp = this.parentNode.getElementsByClassName("cp-detail")[col];
				tmp.classList.add("active");
				if (Info.mob) {
					tmp.parentNode.style.height = tmp.getBoundingClientRect().height + "px";
				}
				
			}
		}
		elem.onmouseout = function() {
			if(CP[row] != col) {
				tmp = this.parentNode.getElementsByClassName("cp-detail")[CP[row]];
				tmp.classList.add("active");
				this.parentNode.getElementsByClassName("cp-detail")[col].classList.remove("active");
				if (Info.mob) {
					tmp.parentNode.style.height = tmp.getBoundingClientRect().height + "px";
				}
			}
		}
	}
}
function loadMoreReviews() {
	initReviews();
}



function initMainPageSlick() {
	$('.ms-slider').slick({
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
					dots: true,
					appendDots: $("#ms-dots")
				}
			},
		],
	});
}

function initWCBSlider() {
	$('#wcb-slider').slick({
		autoplay: false,
		// autoplaySpeed: 3000,
		// speed: 300,
		// centerMode: true,
		// centerPadding: "30px",
		swipeToSlide: true,
		slidesToShow: 2,
		arrows: false,
		dots: true,
		appendDots: $(".wcb-dots")
	});
}



var IFIP = {
	tag: {
		slider: false,
		elems: false,
		i: 77,
		n: 77, 
	},
	phone: {
		slider: false,
		elems: false,
		i: 31,
		n: 31,
	},
	coef: 1,
	isRight: false
}
function initFIP() {
	var slider = document.getElementById("fip-switch");
	// var bg = document.getElementById("fip-switch-bg");
	var left = document.getElementById("fip-left");
	var right = document.getElementById("fip-right");
	IFIP.phone.slider = document.getElementById("fip-phone-slider");
	IFIP.phone.elems = document.getElementsByClassName("fip-phone-size");
	IFIP.tag.slider = document.getElementById("fip-tag-slider");
	if (Info.mob) {
		IFIP.coef = 1;
		IFIP.tag.n = 49;
		IFIP.phone.n = 20;
		IFIP.tag.slider.style.transform = "translateX(" + (-1 * IFIP.tag.n) + "px)";
		document.getElementById("fip-arr-l").onclick = function() {
			if (IFIP.isRight) {
				slider.classList.remove("right");
				IFIP.phone.slider.style.transform = "translateX(" + (0 * IFIP.phone.n) + "px)";
				IFIP.phone.elems[1].classList.add("active");
				IFIP.phone.elems[3].classList.remove("active");
				IFIP.tag.slider.style.transform = "translateX(" + (-1 * IFIP.tag.n) + "px)";
				IFIP.isRight = false;
			}
		}
		document.getElementById("fip-arr-r").onclick = function() {
			if (!IFIP.isRight) {
				slider.classList.add("right");
				IFIP.phone.slider.style.transform = "translateX(" + (-2 * IFIP.phone.n) + "px)";
				IFIP.phone.elems[1].classList.remove("active");
				IFIP.phone.elems[3].classList.add("active");
				IFIP.tag.slider.style.transform = "translateX(" + (-3 * IFIP.tag.n) + "px)";
				IFIP.isRight = true;
			}
		}
	} else {
		resizeFIP();
		IFIP.tag.slider.style.transform = "translateX(" + (-1 * IFIP.tag.n) + "px)";

		left.onclick = function() {
			if (IFIP.isRight) {
				slider.classList.remove("right");
				IFIP.phone.slider.style.transform = "translateX(" + (0 * IFIP.phone.n) + "px)";
				IFIP.phone.elems[1].classList.add("active");
				IFIP.phone.elems[3].classList.remove("active");
				IFIP.tag.slider.style.transform = "translateX(" + (-1 * IFIP.tag.n) + "px)";
				IFIP.isRight = false;
			}
		}
		right.onclick = function() {
			if (!IFIP.isRight) {
				slider.classList.add("right");
				IFIP.phone.slider.style.transform = "translateX(" + (-2 * IFIP.phone.n) + "px)";
				IFIP.phone.elems[1].classList.remove("active");
				IFIP.phone.elems[3].classList.add("active");
				IFIP.tag.slider.style.transform = "translateX(" + (-3 * IFIP.tag.n) + "px)";
				IFIP.isRight = true;
			}
		}
	}
}
function resizeFIP() {
	IFIP.coef = Info.vw / 1920;
	IFIP.tag.n = IFIP.tag.i * IFIP.coef;
	IFIP.phone.n = IFIP.phone.i * IFIP.coef;
	if (IFIP.isRight) {
		IFIP.phone.slider.style.transform = "translateX(" + (-2 * IFIP.phone.n) + "px)";
		IFIP.tag.slider.style.transform = "translateX(" + (-3 * IFIP.tag.n) + "px)";
	} else {
		IFIP.phone.slider.style.transform = "translateX(" + (0 * IFIP.phone.n) + "px)";
		IFIP.tag.slider.style.transform = "translateX(" + (-1 * IFIP.tag.n) + "px)";
	}
}
onResize.push(resizeFIP);