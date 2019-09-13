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

// **

class ButtonsFeedBackCheck {
	private name: any;
	private phone: any;
	private mail: any;
	private message: any;
	private buttons: any;

	// **

	constructor(name: string = '') {
		this.name = document.getElementsByClassName('feed-back__name')[0];
		this.phone = document.getElementsByClassName('feed-back__phone')[0];
		this.mail = document.getElementsByClassName('feed-back__email')[0];
		this.message = document.getElementsByClassName('feed-back__message')[0];

		this.buttons = document.querySelectorAll('.' + name);

		this.beginEvent();
	}

	// **

	setStyleError(target: any, status: boolean = false) {
		target.style.borderBottom =
			(status === true) ? '1.5px solid #FFCC00' : '1px solid #F2F2F2'
	}

	// **

	setCheckEmptyInput(event: any, target: any) {
		if (target.value === '') {
			this.setStyleError(target, true);
			event.preventDefault();
		} else {
			this.setStyleError(target);
		}
	}

	getcheckMailValidity(event: any) {
		let check = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

		if (check.test(this.mail.value) === false) {
			this.setStyleError(this.mail, true);
			event.preventDefault();
		} else {
			this.setStyleError(this.mail);
		}
	}

	// **

	beginEvent() {
		for (let i = 0; i < this.buttons.length; i += 1) {
			this.buttons[i].addEventListener('click', (event: any) => {
				this.setCheckEmptyInput(event, this.name);
				this.setCheckEmptyInput(event, this.phone);
				this.getcheckMailValidity(event);
				this.setCheckEmptyInput(event, this.message);
			});
		}
	}
}

new ButtonsFeedBackCheck('button-standard__extension-contacts');