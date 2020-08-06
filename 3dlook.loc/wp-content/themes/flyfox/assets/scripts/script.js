var Info = {
	vw: 0,
	vh: 0,
	mob: false,
}
document.addEventListener("DOMContentLoaded", function(event) {
	Info.vw = window.innerWidth;
	Info.vh = window.innerHeight;
	Info.mob = Info.vw <= 768;
	if (Info.mob) {
		initMobTop();
	} else {
		initSearch();
	}
	if (onLoaded.length != 0) {
		for (var i = 0; i < onLoaded.length; i++) {
			onLoaded[i]();
		}
	}
	window.addEventListener("resize", function() {
		Info.vw = window.innerWidth;
		Info.vh = window.innerHeight;
		if (onResize.length != 0) {
			for (var i = 0; i < onResize.length; i++) {
				onResize[i]();
			}
		}	
	});
});

function initMobTop() {
	var opened = false;
	var btnOpen = document.getElementById("open-mob-top");
	var btnClose = document.getElementById("close-mob-top");
	var mobTop = document.getElementById("mob-top");
	btnOpen.onclick = function() {
		if (!opened) {
			console.log("open")
			mobTop.classList.add("active");
			opened = true;
		}
	}
	btnClose.onclick = function() {
		if (opened) {
			console.log("copen")
			mobTop.classList.remove("active");
			opened = false;
		}
	}
	runMobTopAccordion(
		"mob-top-link",
		"icon-arr-t",
		"hider",
	);
}

function runMobTopAccordion(parentsName, btnName, hidingName) {
	var parents = document.getElementsByClassName(parentsName);
	for (var i = 0; i < parents.length; i++) {
		const ci = i
		var btn = parents[ci].getElementsByClassName(btnName)[0];
		var hid = parents[ci].getElementsByClassName(hidingName)[0];
		var li = hid.getElementsByTagName("li");
		var h = 0;
		for (let j = 0; j < li.length; j++) {
			const cj = j;
			h += li[cj].getBoundingClientRect().height;
		}
		hid.style.height = h + 40 + "px";
		btn.onclick = function() {
			console.log(this);
			console.log(this.closest("." + parentsName));
			this.closest("." + parentsName).classList.toggle("hidden");
		}
	}
}

function initSearch() {
	// var input = document.getElementById("search-input");
	var parent = document.getElementById("search-wrap");
	var clean = document.getElementById("search-clean");
	var search = document.getElementById("search");
	var opened = false;
	// var visibleClean = false;
	// input.onfocus = function() {
	// 	parent.classList.add("focus");
	// }
	// input.onblur = function() {
	// 	parent.classList.remove("focus");
	// }
	// input.onkeyup = function() {
	// 	if (this.value == "" && visibleClean) {
	// 		clean.classList.remove("visible");
	// 		visibleClean = false;
	// 	} else if (this.value != "" && !visibleClean) {
	// 		clean.classList.add("visible");
	// 		visibleClean = true;
	// 	}
	// }
	clean.onclick = function() {
		// input.value = "";
		// this.classList.remove("visible");
		// visibleClean = false;
		parent.classList.remove("focus");
		opened = false;

	}
	search.onclick = function(e) {
		if (!opened) {
			e.preventDefault();
			parent.classList.add("focus");
			opened = true;
		}
	}
}