/*jshint esversion: 6 */

let inputNumberOnly = function(name: string = '') {
	let target: any = document.getElementsByClassName(name)[0];

	target.onkeypress = function(event: any) {
		if (event.ctrlKey || event.altKey || event.metaKey) {
			return;
		}

		let char = getCharForBrowsers(event);

		if (char === null) {
			return;
		}

		if (char < '0' || char > '9') {
			return false;
		}
	}

	let getCharForBrowsers = function(event: any) {
		// NOTE: for IE
		if (event.which === null) {
			if (event.keyCode < 32) {
				return null;
			}

			return String.fromCharCode(event.keyCode)
		}

		// NOTE: for others
		if (event.which != 0 && event.charCode != 0) {
			if (event.which < 32) {
				return null;
			}

			return String.fromCharCode(event.which)
		}

		return null; // специальная клавиша
	}
}

inputNumberOnly('feed-back__phone');
// inputNumberOnly('registration-form__phone');

// **
