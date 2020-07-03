const toTopObserver = () => {
	// Hidden pixel
	const toTopRef = document.querySelector('#scrollPx');

	// If #id is display: none, return early.
	if (!toTopRef) {
		return;
	}

	const options = {
		rootMargin: '0px'
	};

	const callback = (entries, observer) => {
		entries.forEach((entry) => {
			if (entry.intersectionRatio === 0) {
				document.body.classList.add('maybe-to-top');
			} else {
				document.body.classList.remove('maybe-to-top');
			}
		});
	};

	const observer = new IntersectionObserver(callback, options);

	observer.observe(toTopRef);
};

export default toTopObserver;
