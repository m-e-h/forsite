const staffModal = () => {
	const profileCard = document.querySelectorAll('.staff-profile');

	// If empty, return early.
	if (!profileCard) {
		return;
	}

	profileCard.forEach((card) => {
		const cardDialog = card.nextElementSibling;

		card.addEventListener(
			'click',
			() => {
				openModal();
			},
			false
		);

		window.addEventListener(
			'click',
			(event) => {
				if (
					event.target.matches('.profile-content-window') ||
					event.target.matches('.modal__close-btn')
				) {
					closeModal();
				}
			},
			false
		);

		const openModal = () => {
			document.body.classList.add('has-open-modal');
			cardDialog.dataset.open = true;
			card.setAttribute('aria-expanded', 'true');
			card.setAttribute('aria-pressed', 'true');
		};

		const closeModal = () => {
			document.body.classList.remove('has-open-modal');
			cardDialog.removeAttribute('data-open');
			card.setAttribute('aria-expanded', 'false');
			card.setAttribute('aria-pressed', 'false');
		};
	});
};

export default staffModal;
