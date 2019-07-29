/* jshint esversion: 6 */

class headerBlock {
  private scroll: number;
  private widthClientBrowser: number;

  private menu: object;
  private burgerMenu: object;
  private menuNav: object;
  private headerBlockLogo: object;

  constructor() {
    this.scroll = 0;
    this.widthClientBrowser =
      window.innerWidth || document.documentElement.clientWidth ||
      document.body.clientWidth;

    this.menu = document.getElementsByClassName('header-block')[0];
    this.burgerMenu = document.getElementsByClassName('menu-nav__burger')[0];
    this.menuNav = document.getElementsByClassName('menu-nav')[0];
    this.headerBlockLogo =
      document.getElementsByClassName('header-block__logo')[0];

    // **

    this.beginEvent();
  }

  // **

  private setPosition(target: any, position: string) {
    target.style.position = position;
  }

  private setTop(target: any, top: number) {
    target.style.top = top + 'rem';
  }

  private setHeight(target: any, height: number = 0) {
    target.style.height = height + 'rem';
  }

  // **

  private getScrollEvent() {
    addEventListener('scroll', (event) => {
      event.preventDefault();

      this.scroll = window.pageYOffset || document.documentElement.scrollTop;

      // NOTE: general top menu bar
      if (this.scroll > 100) {
        this.setPosition(this.menu, 'fixed');
        this.setHeight(this.menu, 4.1);
        this.setTop(this.burgerMenu, 1);
        this.setTop(this.menuNav, 2);
      } else {
        this.setPosition(this.menu, 'absolute');
        this.setHeight(this.menu, 7);
        this.setTop(this.burgerMenu, 2.3);
        this.setTop(this.menuNav, 5);
      }

      // NOTE: logo
      if (this.scroll < 100 && this.widthClientBrowser >= 1160) {
        this.setHeight(this.headerBlockLogo, 6.1);
      } else {
        this.setHeight(this.headerBlockLogo, 6.2);
      }
    })
  }

  private beginEvent() {
		this.getScrollEvent();
	}
}

new headerBlock();