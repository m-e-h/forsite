import navigation from './navigation';
import sideNav from './off-canvas';
import toTopObserver from './to-top-observer';
import searchToggle from './search-toggle';
import staffModal from './staff-modal';
import productSingle from './product-single';
import gallerySort from './gallery-sort';
import locateClosest from './locate-closest';

navigation();
sideNav();
searchToggle();
toTopObserver();
staffModal();
productSingle();
gallerySort();
locateClosest();

document.addEventListener('DOMContentLoaded', () => {
	if (!document.querySelector('.supcol')) {
		return;
	}

	const colOne = document.querySelector('.supcol:nth-of-type(1)');
	const colTwo = document.querySelector('.supcol:nth-of-type(2)');
	const colOneHeight = colOne.querySelector('.popbody');
	const colTwoHeight = colTwo.querySelector('.popbody');

	colOne.style.setProperty(
		'--pop-one-height',
		`${colOneHeight.offsetHeight}px`
	);
	colTwo.style.setProperty(
		'--pop-two-height',
		`${colTwoHeight.offsetHeight}px`
	);
});
