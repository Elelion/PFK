/*jshint esversion: 6 */

class Ripple {
	constructor(buttonName, rippleName) {
		this.xPos = 0;
		this.yPos = 0;
		this.rippleName = rippleName;
		this.buttonName = buttonName;

		this.beginEvent();
	}

	initDOMElements() {
		this.span = document.createElement('span');
		this.buttons = document.querySelectorAll('.' + this.buttonName);
	}

	getRippleEffect() {
		for (let i = 0; i < this.buttons.length; i += 1) {
			this.buttons[i].addEventListener('click', (event) => {
				event.preventDefault();
				event.stopPropagation();

				// NOTE: create element for a zone for the effect
				let rippleWidth = this.buttons[i].clientWidth;
				let rippleHeight = this.buttons[i].clientHeight;
				let rippleEffect = this.span.style;

				// NOTE: make it round. Effect stayed on the borders button
				const rippleFrame = () => {
					if (rippleWidth >= rippleHeight) {
							rippleHeight = rippleWidth;
					} else {
							rippleWidth = rippleHeight;
					}
				}

				// NOTE: get the center of the cursor event click, for current coordinates
				const rippleDefineHorizonralCoordinates = () => {
					this.xPos = event.layerX -  rippleWidth / 2;
				}

				const rippleDefineVerticalCoordinates = () => {
					this.yPos = event.layerY - rippleHeight / 2;
				}

				// NOTE:
				// the starting point from which the effect begins
				// and set its distribution
				const rippleBeginEffect = () => {
					rippleEffect.width = rippleWidth + 'px';
					rippleEffect.height = rippleHeight + 'px';
					rippleEffect.top = this.yPos + 'px';
					rippleEffect.left = this.xPos + 'px';
				}

				const rippleApplyCssEffect = () => {
					this.span.className = this.rippleName;
				}

				rippleFrame();
				rippleDefineHorizonralCoordinates();
				rippleDefineVerticalCoordinates();
				rippleBeginEffect();
				rippleApplyCssEffect();
				this.buttons[i].appendChild(this.span);

				console.log('POS (y | x): ' + this.yPos + ' | ' + this.xPos);
			});
		}
	}

	beginEvent() {
		this.initDOMElements();
		this.getRippleEffect();
	}
}

new Ripple('button-standard', 'ripple_standard');
new Ripple('button-arrow', 'ripple_arrow');