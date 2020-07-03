/**
 * SINGLE PRODUCT PAGE
 * Used on custom form for handling multiple variations at once.
 * Enable/disable add to quote button if any quantity is greater than zero.
 */
const productSingle = () => {
	// Custom form for adding multiple variations at once
	const addProductsForm = document.querySelector('#add-multiple-variations');
	// Add to quote button
	const addButton = document.querySelector('.add-multiple-to-quote');

	// If elements do not exist, return early.
	if (!addProductsForm || !addButton) {
		return;
	}

	/**
	 * Toggle button as enabled or disabled, depending on if any variations have a quantity.
	 */
	const toggleButtonIfQuantity = () => {
		const quantityElements = addProductsForm.querySelectorAll('input[type="number"]');

		// Find total quantity of all number inputs
		var totalQuantity = 0;
		if (quantityElements) {
			quantityElements.forEach((element) => {
				totalQuantity += parseInt(element.value);
			});
		}

		// Remove or add disabled class
		if (totalQuantity > 0) {
			addButton.classList.remove('disabled');
		} else {
			addButton.classList.add('disabled');
		}
	};

	// Run check once on DOM ready and load
	// (Including "load" fixes issue of navigating back and button being disabled, while some already have quantities.)
	document.addEventListener('DOMContentLoaded', () => {
		toggleButtonIfQuantity();
	});
	window.addEventListener('load', () => {
		toggleButtonIfQuantity();
	});

	// Re-check disabled/enable when quantities change
	const quantityElements = addProductsForm.querySelectorAll('input[type="number"]');
	if (quantityElements) {
		quantityElements.forEach((element) => {
			element.addEventListener('input', toggleButtonIfQuantity);
		});
	}

	/**
	 * Click on Add to Quote button submits the form.
	 */
	addButton.addEventListener(
		'click',
		(e) => {
			if (!addButton.classList.contains('disabled')) {
				//e.preventDefault();
				addProductsForm.submit();
			}
		},
		true
	);
};

export default productSingle;
