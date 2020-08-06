onLoaded.push(function() {
	var mob = Info.mob;
	var parent = document.getElementsByClassName("blockswitch-btns-mob")[0];
	var whichActive = 0;
	var blockswitch = document.getElementsByClassName("blockswitch-btn");
	var elems = document.getElementsByClassName("blockswitch-elem");
	var amount = blockswitch.length;
	var totalH = 0;
	var oneH = 0;
	var opened = false;
	if (mob) {
		oneH = blockswitch[0].getBoundingClientRect().height;
		parent.style.height = oneH + "px";
		for (var i = 0; i < elems.length; i++) {
			totalH += oneH;
		}
	}
	for (var i = 0; i < amount; i++) {
		const ci = i;
		blockswitch[ci].onclick = function() {
			if (whichActive != ci) {
				for (let j = 0; j < amount; j++) {
					const cj = j;
					elems[cj].classList.remove("active");
					blockswitch[cj].classList.remove("active");
				}
				elems[ci].classList.add("active");
				blockswitch[ci].classList.add("active");
				whichActive = ci;
				if (mob) {
					if (opened) {
						parent.style.height = oneH + "px";
						parent.classList.remove("active");
						opened = false;
					} else {
						parent.style.height = totalH + "px";
						parent.classList.add("active");
						opened = true;
					}
				}
			} else {
				if (mob) {
					if (opened) {
						parent.style.height = oneH + "px";
						parent.classList.remove("active");
						opened = false;
					} else {
						parent.style.height = totalH + "px";
						parent.classList.add("active");
						opened = true;
					}
				}
			}
		}
	}
});


onLoaded.push(function() {
	setTextShadow();
})
onResize.push(function() {
	setTextShadow();
})
function setTextShadow() {
	if(Info.mob) return;
	var parents = document.getElementsByClassName("blog-blsw-title-elem");
	var blacks = document.getElementsByClassName("bbte-blck");
	var whites = document.getElementsByClassName("bbte-wht");
	for (var i = 0; i < parents.length; i++) {
		const ci = i;
		var parent = parents[ci];
		var black = blacks[ci];
		var white = whites[ci];
		var pw = parent.getBoundingClientRect().width + 30 * (Info.vw / 1920);
		// var bw = black.getBoundingClientRect().width;
		// var ww = white.getBoundingClientRect().width;
		var bsh = "";
		var wsh = ""; 
		for (var j = 1; j < 26; j++) {
			const cj = j;
			bsh += (cj * pw) + "px 0px 0px #FFFFFF"
			wsh += (cj * pw) + "px 0px 0px #1D252D"
			if (cj < 25) {
				bsh += ","
				wsh += ","
			}
		}
		black.style.textShadow = bsh;
		white.style.textShadow = wsh;
	}
}

onLoaded.push(function() {
	var count = document.getElementsByClassName("blog-blsw-slider").length
	for (var i = 1; i <= count; i++) {
		const ci = i;
		console.log()
		$("#blog-blsw-slider-" + ci).slick({
			autoplay: false,
			// autoplaySpeed: 3000,
			arrows: false,
			prevArrow: "#s-prev-" + ci,
			nextArrow: "#s-next-" + ci,
			// speed: 300,
			swipeToSlide: true,
			slidesToShow: 1,
			dots: true,
			appendDots: $("#s-dots-" + ci),
			responsive: [
				{
					breakpoint: 768,
					settings: {
						// centerMode: true,
						// centerPadding: "0px",
						slidesToShow: 2,
						arrows: true,
					}
				},
			],
		});
	}
})
