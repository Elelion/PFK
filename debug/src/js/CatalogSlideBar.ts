/*jshint esversion: 6 */

class CatalogSlideBar {
  private slideBar: any;

	constructor() {
    this.slideBar =
      document.getElementsByClassName('catalog__sidebar')[0];

		this.beginEvent();
	}

	// **

	setTop(target: any, top: number) {
		target.style.marginTop = top + 'rem';
	}

	setPosition(target: any, position: string) {
		target.style.position = position;
	}

	// **

	beginEvent() {
		addEventListener('scroll', (event: any) => {
      event.preventDefault();
			let scroll = window.pageYOffset || document.documentElement.scrollTop;

      if (scroll > 100) {
        this.setTop(this.slideBar, 25);
      } else {
        this.setTop(this.slideBar, 10);
      }
		})
	}
}

new CatalogSlideBar();