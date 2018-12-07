/**
 * Customize preview script.
 *
 * This file handles the JavaScript for the live preview frame in the customizer.
 * Any includes or imports should be handled in this file. The final result gets
 * saved back into `dist/js/customize-preview.js`.
 *
 * @package   Forsite
 * @author    Marty Helmick <info@martyhelmick.com>
 * @copyright 2018 Marty Helmick
 * @license   https://www.gnu.org/licenses/gpl-2.0.html GPL-2.0-or-later
 * @link      https://github.com/m-e-h/forsite
 */

// https://googlechrome.github.io/samples/css-custom-properties/

const siteHeader = document.querySelector( '.app-header' );
const siteTitle = document.querySelector( '.app-header__title' );
const siteDesc = document.querySelector( '.app-header__description' );

// Site title.
wp.customize( 'blogname', value => {
	value.bind( to => {
		siteTitle.textContent = to;
	});
});

// Site description.
wp.customize( 'blogdescription', value => {
	value.bind( to => {
		siteDesc.textContent = to;
	});
});

// Header text color.
wp.customize( 'header_textcolor', value => {
	value.bind( to => {
		document.documentElement.style.setProperty( '--header-text-color', to );

		let headerText = [ siteTitle, siteDesc ];

		headerText.forEach( text => {
			if ( 'blank' === to ) {
				text.style.clip = 'rect(0 0 0 0)';
				text.style.position = 'absolute';
			} else {
				text.style.clip = null;
				text.style.position = null;
			}
		});
	});
});

// document.body.onload = () => {
// 	const redBtn = document.querySelector( '#toggle-red' );
// 	const blueBtn = document.querySelector( '#toggle-blue' );
// 	const greenBtn = document.querySelector( '#toggle-green' );

// 	redBtn.addEventListener( 'click', e => {
// 		console.log( 'red' );
// 		document.documentElement.style.setProperty( '--main-hue', 360 );
// 	});

// 	blueBtn.addEventListener( 'click', e => {
// 		document.documentElement.style.setProperty( '--main-hue', 240 );
// 	});

// 	greenBtn.addEventListener( 'click', e => {
// 		document.documentElement.style.setProperty( '--main-hue', 120 );
// 	});
// };
