const locateClosest = () => {
	const findLocationBtn = document.querySelector('.nearest-btn a');
	let nearestPR = localStorage.getItem('nearestPR');

	if (nearestPR) {
		document.body.classList.add(`nearest-${nearestPR}`);
		return;
	}

	if (!findLocationBtn) {
		return;
	}

	/**
	 *
	 * @param {object} position
	 */
	const getClosest = (position) => {
		const latitude = position.coords.latitude.toFixed(3);
		const longitude = position.coords.longitude.toFixed(3);
		const fromCharlotte = getDistance(latitude, longitude, 35.201, -80.802);
		const fromColumbia = getDistance(latitude, longitude, 33.938, -80.961);
		const fromGreensboro = getDistance(latitude, longitude, 36.072, -79.945);
		const fromRaleigh = getDistance(latitude, longitude, 35.821, -78.62);
		const fromWinston = getDistance(latitude, longitude, 36.073, -80.303);

		const isNear = [
			{ city: 'Charlotte', distance: fromCharlotte },
			{ city: 'Columbia', distance: fromColumbia },
			{ city: 'Greensboro', distance: fromGreensboro },
			{ city: 'Raleigh', distance: fromRaleigh },
			{ city: 'Winston', distance: fromWinston }
		];

		isNear.forEach((nearest) => {
			if (
				nearest.distance ===
				Math.min(fromCharlotte, fromColumbia, fromGreensboro, fromRaleigh, fromWinston)
			) {
				document.body.classList.add(`nearest-${nearest.city}`);

				localStorage.setItem('nearestPR', nearest.city);
			}
		});
	};

	/**
	 * error
	 */
	const locationError = (error) => {
		console.warn(error.code);
	};

	/**
	 * Convert degrees to radians and calculate distance.
	 * https://en.wikipedia.org/wiki/Haversine_formula
	 * @param {number} lon1
	 * @param {number} lat1
	 * @param {number} lon2
	 * @param {number} lat2
	 */
	const getDistance = (lon1, lat1, lon2, lat2) => {
		let R = 6371; // Radius of the earth in km
		let dLat = ((lat2 - lat1) * Math.PI) / 180; // Javascript functions in radians
		let dLon = ((lon2 - lon1) * Math.PI) / 180;
		let a =
			Math.sin(dLat / 2) * Math.sin(dLat / 2) +
			Math.cos((lat1 * Math.PI) / 180) *
				Math.cos((lat2 * Math.PI) / 180) *
				Math.sin(dLon / 2) *
				Math.sin(dLon / 2);
		let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
		let d = R * c; // Distance in km
		return d;
	};

	findLocationBtn.addEventListener(
		'click',
		() => {
			navigator.geolocation.getCurrentPosition(getClosest, locationError, {
				timeout: 30000
			});
		},
		false
	);
};

export default locateClosest;
