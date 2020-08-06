onLoaded.push(function() {
	document.querySelectorAll('input[type=text]').forEach(function (el) {
		console.log(el)
		el.setAttribute('value', el.value || '');
		el.addEventListener('keyup', function (e) {
			this.setAttribute('value', this.value);
		})
	});
});
