/*jshint esversion: 6 */

class BrowserType {
	private userBrowser: string;

	constructor() {
		this.userBrowser = 'null';

		this.getUserBrowser();
	}

	private getUserBrowser = () => {
		this.userBrowser = navigator.userAgent;

		if (this.userBrowser.search(/Safari/) > 0) {
			alert(`Ой!...
				Случилось что то ужасное, и Safari не поддерживается.
				Используйте любой другой браузер.`);
		}
	}
}

new BrowserType();