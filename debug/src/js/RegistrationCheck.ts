/*jshint esversion: 6 */

class RegistrationCheck {
  private physical: any;
  private physicalBlock: any;
  private physicalImg: any;
  private physicalForm: any;

  private legal: any;
  private legalBlock: any;
  private legalImg: any;
  private legalForm: any;

  constructor() {
    this.initPhysicalDOMElements();
    this.initLegalDOMElements();

    this.beginEvent();
  }

  initPhysicalDOMElements() {
    this.physical =
      document.getElementById('regPhysical');
    this.physicalBlock =
      document.getElementsByClassName('registration-type__physical')[0];
    this.physicalImg =
      document.getElementsByClassName('registration-type__physical-image')[0];
    this.physicalForm =
      document.getElementsByClassName('registration-form__form-physical')[0];
  }

  initLegalDOMElements() {
    this.legal =
      document.getElementById('regLegal');
    this.legalBlock =
      document.getElementsByClassName('registration-type__legal')[0];
    this.legalImg =
      document.getElementsByClassName('registration-type__legal-image')[0];
    this.legalForm =
      document.getElementsByClassName('registration-form__form-legal')[0];
  }

  // **

  setCheckStatus(target: any, statusCheck: boolean) {
    target.checked = statusCheck;
  }

  setCheckStyleSelect(target: any, statusSelect: boolean = false) {
    if (statusSelect === true) {
      target.style.borderBottom = '1.5px solid #1883B3';
      target.style.borderRadius = '7px';
    } else {
      target.style.borderBottom = '0px solid #FFFFFF';
      target.style.borderRadius = '0px';
      target.style.borderColor = 'transparent';
    }
  }

  setCheckImg(target: any, nameImg: string = 'none') {
    target.src = './src/images/registration/' + nameImg + '.webp';
  }

  setFormStyleDisplay(target: any, display: string = 'none') {
    target.style.display = (display === 'none') ? 'none' : 'block';
  }

  // **

  physicalActive() {
    this.setCheckStatus(this.physical, true);
    this.setCheckStatus(this.legal, false);

    this.setCheckStyleSelect(this.physicalBlock, true);
    this.setCheckStyleSelect(this.legalBlock);

    this.setCheckImg(this.physicalImg, 'physical');
    this.setCheckImg(this.legalImg, 'legal-disable');

    this.setFormStyleDisplay(this.physicalForm, 'block');
    this.setFormStyleDisplay(this.legalForm);

    // NOTE: for debug
    // console.log('physicalCheck: ' + true);
    // console.log('legalCheck: ' + false);
  }

  legalActive() {
    this.setCheckStatus(this.legal, true);
    this.setCheckStatus(this.physical, false);

    this.setCheckStyleSelect(this.legalBlock, true);
    this.setCheckStyleSelect(this.physicalBlock);

    this.setCheckImg(this.legalImg, 'legal');
    this.setCheckImg(this.physicalImg, 'physical-disable');

    this.setFormStyleDisplay(this.legalForm, 'block');
    this.setFormStyleDisplay(this.physicalForm);

    // NOTE: for debug
    // console.log('physicalCheck: ' + false);
    // console.log('legalCheck: ' + true);
  }

  // **

  beginEvent() {
    this.physicalActive();

    this.physical.onclick = () => { this.physicalActive(); }
    this.physicalImg.onclick = () => { this.physicalActive(); }

    this.legal.onclick = () => { this.legalActive(); }
    this.legalImg.onclick = () => { this.legalActive(); }
  }
}

new RegistrationCheck();
