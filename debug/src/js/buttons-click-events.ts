/*jshint esversion: 6 */

class ButtonsFollowing {
	private buttonName: string;
	private followingLink: string;

	private buttons: any;

	constructor(name: string = '', link: string = '#') {
		this.buttonName = name;
		this.followingLink = link;

		this.buttons = document.querySelectorAll('.' + this.buttonName);

		this.beginEvent();
	}

	setFollowingLink(link: string = '#') {
		document.location.href = link;
	}

	beginEvent() {
		for (let i = 0; i < this.buttons.length; i += 1) {
			this.buttons[i].addEventListener('click', (event: any) => {
				event.preventDefault();
				this.setFollowingLink(this.followingLink);
			});
		}
	}
}

new ButtonsFollowing('button-standard__extension-articles', 'all-articles.php');