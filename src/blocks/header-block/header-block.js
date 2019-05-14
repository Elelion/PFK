/* jshint esversion: 6 */

class headerBlock {
  constructor() {
    this.scroll = 0;
    this.beginEvent();
  }

  initDOMElements() {
    this.menu = document.getElementsByClassName('header-block')[0];
    this.logo = document.getElementsByClassName('header-block__logo')[0];
    this.wrapper = document.getElementsByClassName('header-block__wrapper')[0];
  }

  // **

  getScrollEvent() {
    addEventListener('scroll', (event) => {
      event.preventDefault();

      this.scroll = window.pageYOffset || document.documentElement.scrollTop;

      if (this.scroll > 100) {
        this.getShowMenu('fixed');
        this.getHeightMenu('4.1rem');
        this.getDisplayLogo('none');
        this.getFlex('block');
      } else {
        this.getShowMenu('absolute');
        this.getHeightMenu('8rem');
        this.getDisplayLogo('block');
        this.getFlex('flex');
      }
    })
  }

  // **

  getShowMenu(position) {
    this.menu.style.position = position;
  }

  getHeightMenu(height) {
    this.menu.style.height = height;
  }

  getDisplayLogo(display) {
    this.logo.style.display = display;
  }

  getFlex(value) {
    this.wrapper.style.display = value;
  }

  // **

  beginEvent() {
    this.initDOMElements();
    this.getScrollEvent();
  }
}

new headerBlock();