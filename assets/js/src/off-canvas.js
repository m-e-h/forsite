const sideNav = () => {
	const { body } = document;
	const navContainers = document.querySelectorAll('.sidebar-container');

	if (!navContainers) {
		return;
	}

	const hideSideNav = () => {
		navContainers.forEach((container) => {
			container.classList.remove('side-nav--visible');
		});

		body.classList.remove('side-nav--opened');
	};

	const showSideNav = (event) => {
		let fromDirection = event.target.dataset.side;

		if (!fromDirection || !event) {
			fromDirection = 'left';
		}

		let sideContainer = document.querySelector(
			`.sidebar-container--${fromDirection}`
		);

		sideContainer.classList.add('side-nav--visible');
		body.classList.add('side-nav--opened');
	};

	window.addEventListener(
		'click',
		(event) => {
			if (
				event.target.matches('.side-toggle') ||
				event.target.matches('.table-item__btn') ||
				event.target.matches('.table-item__image') ||
				event.target.matches(
					'.table-item:not(.table-item--has-image) .table-item__close'
				)
			) {
				showSideNav(event);
			}

			if (
				event.target.matches('.sidebar-more-close') ||
				event.target.matches('.sidebar-container') ||
				event.target.matches('.product-sidebar__item') ||
				event.target.matches('.product-sidebar__image')
			) {
				hideSideNav();
			}
		},
		false
	);
};

export default sideNav;
