/* jshint esversion: 6 */

class headerBlock {
  constructor() {
    this.scroll = 0;
    this.beginEvent();
  }

  initDOMElements() {
    this.menu = document.getElementsByClassName('header-block')[0];
  }

  // **

  getScrollEvent() {
    addEventListener('scroll', (event) => {
      event.preventDefault();

      this.scroll = window.pageYOffset || document.documentElement.scrollTop;
      this.getShowMenu(this.scroll > 100 ? 'fixed' : 'absolute');
    })
  }

  getShowMenu(position) {
    this.menu.style.position = position;
  }

  // **

  beginEvent() {
    this.initDOMElements();
    this.getScrollEvent();
  }
}

new headerBlock();