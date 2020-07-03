const gallerySort = () => {
	const { body } = document;
	const galleryContainer = document.querySelector('.filtered-gallery-grid');
	const galleryBtns = document.querySelectorAll('.filter-gallery-btn');
	const lightImg = document.querySelector('.light-img');

	if (!galleryContainer) {
		return;
	}

	document.addEventListener('DOMContentLoaded', () => {
		if (location.hash) {
			const linkHash = location.hash.slice(1);
			const filterLink = document.querySelector(`button[data-filter=${linkHash}]`);

			window.setTimeout(() => {
				if (filterLink) {
					filterLink.click();
				}
			}, 500);
		}
	});

	document.addEventListener(
		'click',
		(event) => {
			if (event.target.matches('.filter-gallery-btn')) {
				activateFilter(event);
			}

			if (event.target.matches('.filter-item--all')) {
				clearFilter();
			}

			if (event.target.matches('.filtered-gallery-image')) {
				clearModal();
				activateModal(event);
			}

			if (event.target.matches('.galbox') || event.target.matches('.galbox-close')) {
				clearModal();
			}
		},
		false
	);

	const activateFilter = (event) => {
		const imageCat = event.target.dataset.filter;

		galleryBtns.forEach((btn) => {
			btn.classList.remove('active');
		});

		event.target.classList.add('active');
		galleryContainer.dataset.show = imageCat;
	};

	const clearFilter = () => {
		galleryBtns.forEach((btn) => {
			btn.classList.remove('active');
		});

		galleryContainer.dataset.show = 'all';
	};

	const activateModal = (event) => {
		lightImg.src = event.target.src;
		body.classList.add('has-light-img');
	};

	const clearModal = () => {
		lightImg.src = '';
		body.classList.remove('has-light-img');
	};
};

export default gallerySort;
