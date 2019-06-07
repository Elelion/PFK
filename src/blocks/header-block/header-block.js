/* jshint esversion: 6 */

class headerBlock {
  constructor() {
    this.scroll = 0;
    this.beginEvent();
  }

  initDOMElements() {
    this.menu = document.getElementsByClassName('header-block')[0];
    this.burgerMenu = document.getElementsByClassName('menu-nav__burger')[0];
    this.menuNav = document.getElementsByClassName('menu-nav')[0];
    this.headerBlockLogo =
      document.getElementsByClassName('header-block__logo')[0];

    this.widthClientBrowser =
        window.innerWidth || document.documentElement.clientWidth ||
        document.body.clientWidth;
  }

  // **

  getScrollEvent() {
    addEventListener('scroll', (event) => {
      event.preventDefault();

      this.scroll = window.pageYOffset || document.documentElement.scrollTop;

      // NOTE: general top menu bar
      if (this.scroll > 100) {
        this.setPosition(this.menu, 'fixed');
        this.setHeight(this.menu, '4.1rem');
        this.setTop(this.burgerMenu, '1rem');
        this.setTop(this.menuNav, '2rem');
      } else {
        this.setPosition(this.menu, 'absolute');
        this.setHeight(this.menu, '7rem');
        this.setTop(this.burgerMenu, '2.3rem');
        this.setTop(this.menuNav, '5rem');
      }

      // NOTE: logo
      if (this.scroll < 100 && this.widthClientBrowser >= 1160) {
        this.setHeight(this.headerBlockLogo, '6.1rem');
      } else {
        this.setHeight(this.headerBlockLogo, '6.2rem');
      }
    })
  }

  // **

  setPosition(target, position) {
    target.style.position = position;
  }

  setTop(target, top) {
    target.style.top = top;
  }

  setHeight(target, height) {
    target.style.height = height;
  }

  // **

  beginEvent() {
    this.initDOMElements();
    this.getScrollEvent();
  }
}

new headerBlock();