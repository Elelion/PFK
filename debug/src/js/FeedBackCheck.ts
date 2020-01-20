/*jshint esversion: 6 */

class ButtonsContactFeedBackCheck {
	private name: any;
	private phone: any;
	private mail: any;
	private buttons: any;

	// NOTE: for debug
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
	setCheckErrorDebug(target: any, status: boolean) {
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
			// this.setCheckErrorDebug(target, true);
		} else {
			target.style.borderBottom = '1px solid #F2F2F2';
			// this.setCheckErrorDebug(target, false);
		}
	}

	// **

	setInputCheckEmpty(event: any, target: any, length: number) {
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
				this.setInputCheckEmpty(event, this.name, 2);
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

		this.address =
      document.getElementsByClassName('feed-back__address')[0];
		this.desc =
      document.getElementsByClassName('feed-back__description')[0];
		this.question =
      document.getElementsByClassName('feed-back__message')[0];
		this.btn =
      document.querySelectorAll('.' + name);

		this.beginEventExtension();
	}

	beginEventExtension() {
		for (let i = 0; i < this.btn.length; i += 1) {
			this.btn[i].addEventListener('click', (event: any) => {
				super.setInputCheckEmpty(event, this.address, 10);
				super.setInputCheckEmpty(event, this.desc, 15);
				super.setInputCheckEmpty(event, this.question, 5);
			});
		}
	}
}

new ButtonsServiceFeedBackCheck('button-standard__extension-service');

// ----------------------------------------------------------------------------

class ButtonLogin extends ButtonsContactFeedBackCheck {
	private login: any;
	private password: any;
	private authorizationAnswer: any;
	private btn: any;

	constructor(name: string = '') {
		super(name);

		this.login =
			document.getElementsByClassName('panel-authorization__login-input')[0];

		this.password =
			document.getElementsByClassName('panel-authorization__password-input')[0];

		this.authorizationAnswer =
			document.getElementsByClassName('panel-authorization__pictcha-input')[0];

		this.btn = document.querySelectorAll('.' + name);

		this.beginEventExtension();
	}

	// **

	beginEventExtension() {
		for (let i = 0; i < this.btn.length; i += 1) {
			this.btn[i].addEventListener('click', (event: any) => {
				super.setInputPhoneOrMailCheckValidity(event, this.login, 'mail');
				super.setInputCheckEmpty(event, this.password, 2);
				super.setInputCheckEmpty(event, this.authorizationAnswer, 1);
			});
		}
	}
}

new ButtonLogin('button-standard__extension-login');

// ----------------------------------------------------------------------------

class ButtonRegistration extends ButtonsContactFeedBackCheck {
  private surnamePhys: any;
  private namePhys: any;
  private patronymicPhys: any;
  private addressPhys: any;
  private phonePhys: any;
  private emailPhys: any;
  private passwordPhys: any;

  private organizationLegal: any;
  private innLegal: any;
  private phoneLegal: any;
  private emailLegal: any;
  private cityLegal: any;
  private addressLegal: any;
  private passwordLegal: any;

  private physicalCheck: any;
  private legalCheck: any;
  private btn: any;

  constructor(name: string = '') {
    super(name);

    this.initPhysicalDOMElements();
    this.initLegalDOMElements();
    this.physicalCheck = document.getElementById('regPhysical');
    this.legalCheck = document.getElementById('regLegal');

    this.btn = document.querySelectorAll('.' + name);
    this.beginEventExtension();
  }

  initPhysicalDOMElements() {
    this.surnamePhys =
      document.getElementsByClassName('registration-form__surname-physical')[0]
    this.namePhys =
      document.getElementsByClassName('registration-form__name-physical')[0];
    this.patronymicPhys =
      document.getElementsByClassName('registration-form__patronymic-physical')[0];
    this.addressPhys =
      document.getElementsByClassName('registration-form__address-physical')[0];
    this.phonePhys =
      document.getElementsByClassName('registration-form__phone-physical')[0];
    this.emailPhys =
      document.getElementsByClassName('registration-form__email-physical')[0];
    this.passwordPhys =
      document.getElementsByClassName('registration-form__password-physical')[0];
  }

  initLegalDOMElements() {
    this.organizationLegal =
      document.getElementsByClassName('registration-form__organization-legal')[0];
    this.innLegal =
      document.getElementsByClassName('registration-form__inn-legal')[0];
    this.phoneLegal =
      document.getElementsByClassName('registration-form__phone-legal')[0];
    this.emailLegal =
      document.getElementsByClassName('registration-form__email-legal')[0];
    this.cityLegal =
      document.getElementsByClassName('registration-form__city-legal')[0];
    this.addressLegal =
      document.getElementsByClassName('registration-form__address-legal')[0];
    this.passwordLegal =
      document.getElementsByClassName('registration-form__password-legal')[0];
  }

  // **

  resetInputPhysicalStyle() {
    super.setStyleError(this.surnamePhys);
    super.setStyleError(this.namePhys);
    super.setStyleError(this.addressPhys);
    super.setStyleError(this.phonePhys);
    super.setStyleError(this.emailPhys);
    super.setStyleError(this.passwordPhys);
  }

  resetInputPhysicalValue() {
    this.surnamePhys.value = '';
    this.namePhys.value = '';
    this.patronymicPhys.value = '';
    this.addressPhys.value = '';
    this.phonePhys.value = '';
    this.emailPhys.value = '';
    this.passwordPhys.value = '';
  }

  // **

  resetInputLegalStyle() {
    super.setStyleError(this.organizationLegal);
    super.setStyleError(this.innLegal);
    super.setStyleError(this.phoneLegal);
    super.setStyleError(this.emailLegal);
    super.setStyleError(this.cityLegal);
    super.setStyleError(this.addressLegal);
    super.setStyleError(this.passwordLegal);
  }

  resetInputLegalValue() {
    this.organizationLegal.value = '';
    this.innLegal.value = '';
    this.phoneLegal.value = '';
    this.emailLegal.value = '';
    this.cityLegal.value = '';
    this.addressLegal.value = '';
    this.passwordLegal.value = '';
  }

  // **

  resetPhysical(event: any) {
    super.setInputCheckEmpty(event, this.surnamePhys, 2);
    super.setInputCheckEmpty(event, this.namePhys, 2);
    super.setInputPhoneOrMailCheckValidity(event, this.phonePhys, 'phone');
    super.setInputPhoneOrMailCheckValidity(event, this.emailPhys, 'mail');
    super.setInputCheckEmpty(event, this.addressPhys, 20);
    super.setInputCheckEmpty(event, this.passwordPhys, 2);

    this.resetInputLegalStyle();
    this.resetInputLegalValue();
  }

  resetLegal(event: any) {
    super.setInputCheckEmpty(event, this.organizationLegal, 5);
    super.setInputCheckEmpty(event, this.innLegal, 10);
    super.setInputPhoneOrMailCheckValidity(event, this.phoneLegal, 'phone');
    super.setInputPhoneOrMailCheckValidity(event, this.emailLegal, 'mail');
    super.setInputCheckEmpty(event, this.cityLegal, 3);
    super.setInputCheckEmpty(event, this.addressLegal, 10);
    super.setInputCheckEmpty(event, this.passwordLegal, 2);

    this.resetInputPhysicalStyle();
    this.resetInputPhysicalValue();
  }

  // **

  beginEventExtension() {
    for (let i = 0; i < this.btn.length; i += 1) {
      this.btn[i].addEventListener('click', (event: any) => {
        if (this.physicalCheck.checked === true
          && this.legalCheck.checked === false
        ){
          this.resetPhysical(event);
        }

        if (this.physicalCheck.checked === false
          && this.legalCheck.checked === true
        ){
          this.resetLegal(event);
        }
      });
    }
  }
}

new ButtonRegistration('button-standard__extension-registration');
