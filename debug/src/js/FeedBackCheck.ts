/*jshint esversion: 6 */

class ButtonsContactFeedBackCheck {
	private name: any;
	private phone: any;
	private mail: any;
	private buttons: any;
	private nameCheckError: boolean;
	private phoneCheckError: boolean;
	private mailCheckError: boolean;

	constructor(name: string = '') {
		this.name = document.getElementsByClassName('feed-back__name')[0];
		this.phone = document.getElementsByClassName('feed-back__phone')[0];
		this.mail = document.getElementsByClassName('feed-back__email')[0];
		this.buttons = document.querySelectorAll('.' + name);

		this.nameCheckError = false;
		this.phoneCheckError = false;
		this.mailCheckError = false;

		this.beginEvent();
	}

	// **

	// NOTE: for report debug
	setCheckError(target: any, status: boolean) {
		if (target === this.name) {
			this.nameCheckError = status;
			console.log('check name:' + this.nameCheckError);
		} else {
			if (target === this.phone) {
				this.phoneCheckError = status;
				console.log('check phone:' + this.phoneCheckError);
			} else {
				if (target === this.mail) {
					this.mailCheckError = status;
					console.log('check mail:' + this.mailCheckError);
				}
			}
		}
	}

	setStyleError(target: any, status: boolean = false) {
		if (status === true) {
			target.style.borderBottom = '1.5px solid #FFCC00';
			// this.setCheckError(target, true);
		} else {
			target.style.borderBottom = '1px solid #F2F2F2';
			// this.setCheckError(target, false);
		}
	}

	// **

	setInputNameCheckEmpty(event: any, target: any, length: number) {
		if (target.value.length < length) {
			this.setStyleError(target, true);
			event.preventDefault();
		} else {
			this.setStyleError(target);
		}
	}

	setInputPhoneOrMailCheckValidity(event: any, target: any, type: string) {
		let check = null;
		switch(type) {
			case 'mail':
				check = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
				break;
			default:
				check = /^([0-9]{11})$/;
				break;
		}

		if (check.test(target.value) === false) {
			this.setStyleError(target, true);
			event.preventDefault();
		} else {
			this.setStyleError(target);
		}
	}

	// **

	beginEvent() {
		for (let i = 0; i < this.buttons.length; i += 1) {
			this.buttons[i].addEventListener('click', (event: any) => {
				this.setInputNameCheckEmpty(event, this.name, 2);
				this.setInputPhoneOrMailCheckValidity(event, this.phone, 'phone');
				this.setInputPhoneOrMailCheckValidity(event, this.mail, 'mail');
			});
		}
	}
}

new ButtonsContactFeedBackCheck('button-standard__extension-contacts');

// ----------------------------------------------------------------------------

class ButtonsServiceFeedBackCheck extends ButtonsContactFeedBackCheck {
	private address: any;
	private desc: any;
	private question: any;
	private btn: any;

	constructor(name: string = '') {
		super(name);

		this.address = document.getElementsByClassName('feed-back__address')[0];
		this.desc = document.getElementsByClassName('feed-back__description')[0];
		this.question = document.getElementsByClassName('feed-back__message')[0];
		this.btn = document.querySelectorAll('.' + name);

		this.beginEventExtension();
	}

	beginEventExtension() {
		for (let i = 0; i < this.btn.length; i += 1) {
			this.btn[i].addEventListener('click', (event: any) => {
				super.setInputNameCheckEmpty(event, this.address, 10);
				super.setInputNameCheckEmpty(event, this.desc, 15);
				super.setInputNameCheckEmpty(event, this.question, 5);
			});
		}
	}
}

new ButtonsServiceFeedBackCheck('button-standard__extension-calculatorForm');