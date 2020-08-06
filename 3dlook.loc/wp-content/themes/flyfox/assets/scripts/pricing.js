onLoaded.push(function() {
	var whichActive = 0;
	var blockswitch = document.getElementsByClassName("blockswitch-btn");
	var elems = document.getElementsByClassName("blockswitch-elem");
	var amount = blockswitch.length;
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
			}
		}
	}
});

onLoaded.push(function() {
	var checked = true;
	var triggerWrap = document.getElementsByClassName("trigger-wrap")[0];
	var trigger = document.getElementsByClassName("trigger-bg")[0];
	var pricesTime = document.getElementsByClassName("mbpt");
	var prices = document.getElementsByClassName("mbpp");
	trigger.onclick = function() {
		if (checked) {
			triggerWrap.classList.remove("active");
			for (var i = 0; i < pricesTime.length; i++) {
				const ci = i;
				pricesTime[ci].innerHTML = "year";
				prices[ci].innerHTML = prices[ci].dataset.yprice;
			}
			checked = false;
		} else {
			triggerWrap.classList.add("active");
			for (var i = 0; i < pricesTime.length; i++) {
				const ci = i;
				pricesTime[ci].innerHTML = "month";
				prices[ci].innerHTML = prices[ci].dataset.mprice;
			}
			checked = true;
		}
	}
});

onLoaded.push(function() {
	if (Info.mob) {
		var faqElem = document.getElementsByClassName("faq-elem");
		var h = 0;
		for (var i = 0; i < 3; i++) {
			const ci = i;
			h += faqElem[ci].getBoundingClientRect().height;			
		}
		h += 60;
		document.getElementsByClassName("faq")[0].getElementsByClassName("wrapl")[0].style.height = h + "px";
		document.getElementById("show-all-faq").onclick = function() {
			document.getElementsByClassName("faq")[0].getElementsByClassName("wrapl")[0].style.height = "auto";
			this.style.display = "none";
		}
	}
})