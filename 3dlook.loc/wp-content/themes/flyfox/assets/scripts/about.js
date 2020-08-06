var HWG = {
	years: {
		elem: false,
		prev: false,
		next: false,
		w: 57 + 18,
		nw: 75,
	},
	timeline: {
		hider: false,
		elems: false,
		elem: false,
		h: false,
		normalH: 0,
	},
	which: {
		pre: 0,
		now: 0,
		count: 0,
	},
	more: {
		elem: false,
	},
}
onLoaded.push(function() {
	HWG.years.elems = document.getElementsByClassName("tb-years-elems")[0];
	HWG.years.elem = document.getElementsByClassName("tb-years-elem");
	HWG.years.prev = document.getElementById("yprev");
	HWG.years.next = document.getElementById("ynext");
	HWG.timeline.hider = document.getElementsByClassName("tb-elems-hider")[0];
	HWG.timeline.elems = document.getElementsByClassName("tb-elems-slider")[0];
	HWG.timeline.elem = document.getElementsByClassName("tb-elems");
	HWG.which.count = HWG.years.elem.length;
	HWG.timeline.h = new Array(HWG.which.count);
	HWG.more.elem = document.getElementById("cp-load-more");

	if (HWG.which.count != HWG.timeline.elem.length) {
		console.error("Timeline slider initialisation stopped: different elements count in 'year' slider and vertical slider");
		return;
	}
	hwgResize();
	for (var i = 0; i < HWG.which.count; i++) {
		const ci = i;
		if (ci == 0) {
			HWG.timeline.elem[ci].classList.remove("opacity");
		} else {
			HWG.timeline.elem[ci].classList.add("opacity");
		}
	}
	HWG.more.elem.onclick = function() {
		hwgNext();
	}
	HWG.years.next.onclick = function() {
		hwgNext();
	}
	HWG.years.prev.onclick = function() {
		hwgPrev();
	}
	for (var i = 0; i < HWG.years.elem.length; i++) {
		const ci = i;
		HWG.years.elem[ci].onclick = function() {
			HWG.which.now = ci;
			HWG.years.elem[HWG.which.pre].classList.remove("active");
			HWG.years.elem[HWG.which.now].classList.add("active");
			if (HWG.which.now + 1 == HWG.which.count) {
				HWG.years.next.classList.add("hidden");
			} else {
				HWG.years.next.classList.remove("hidden");
			}
			if (HWG.which.now != 0) {
				HWG.years.prev.classList.remove("hidden");
			} else {
				HWG.years.prev.classList.add("hidden");
			}
			hwgTransform();	
		}
	}
})
function hwgPrev() {
	if (HWG.which.now > 0) {
		HWG.which.now -= 1;
		HWG.years.elem[HWG.which.pre].classList.remove("active");
		HWG.years.elem[HWG.which.now].classList.add("active");
		if (HWG.which.now + 1 < HWG.which.count) {
			HWG.years.next.classList.remove("hidden");
		}
		if (HWG.which.now == 0) {
			HWG.years.prev.classList.add("hidden");
		}
		hwgTransform();
	}
}
function hwgNext() {
	if (HWG.which.now + 1 < HWG.which.count) {
		HWG.which.now += 1;
		HWG.years.elem[HWG.which.pre].classList.remove("active");
		HWG.years.elem[HWG.which.now].classList.add("active");
		if (HWG.which.now + 1 == HWG.which.count) {
			HWG.years.next.classList.add("hidden");
		}
		if (HWG.which.now != 0) {
			HWG.years.prev.classList.remove("hidden");
		}
		hwgTransform();
	}
}

onResize.push(hwgResize)
function hwgResize() {
	for (var i = 0; i < HWG.timeline.elem.length; i++) {
		const ci = i;
		HWG.timeline.h[ci] = HWG.timeline.elem[ci].getBoundingClientRect().height;
		// HWG.timeline.h[ci] -= 130;
	}
	if (Info.mob) {
		HWG.years.nw = HWG.years.w;
		HWG.timeline.normalH = 3321;
	} else {
		HWG.years.nw = HWG.years.w * (Info.vw / 1920);
		HWG.timeline.normalH = 2068 * (Info.vw / 1920);
	}
	hwgTransform();
}

function hwgTransform(){
	HWG.years.elems.style.transform = "translateX(" + (-HWG.years.nw * HWG.which.now) + "px)";
	var h = 0;
	for (let i = 0; i < HWG.which.now; i++) {
		h += HWG.timeline.h[i];
	}
	if (HWG.which.now + 1 == HWG.which.count) {
		HWG.timeline.hider.style.height = HWG.timeline.h[HWG.which.now] + "px";
		HWG.more.elem.classList.add("hidden");
	} else {
		HWG.more.elem.classList.remove("hidden");
		HWG.timeline.hider.style.height = HWG.timeline.normalH + "px";
	}
	HWG.timeline.elem[HWG.which.now].classList.remove("opacity");
	HWG.timeline.elem[HWG.which.pre].classList.add("opacity");
	HWG.timeline.elems.style.transform = "translateY(" + (-h) + "px)";
	HWG.which.pre = HWG.which.now;
}