"use strict";
var headerBlock = (function () {
    function headerBlock() {
        this.scroll = 0;
        this.widthClientBrowser =
            window.innerWidth || document.documentElement.clientWidth ||
                document.body.clientWidth;
        this.menu = document.getElementsByClassName('header-block')[0];
        this.burgerMenu = document.getElementsByClassName('menu-nav__burger')[0];
        this.menuNav = document.getElementsByClassName('menu-nav')[0];
        this.headerBlockLogo =
            document.getElementsByClassName('header-block__logo')[0];
        this.beginEvent();
    }
    headerBlock.prototype.setPosition = function (target, position) {
        target.style.position = position;
    };
    headerBlock.prototype.setTop = function (target, top) {
        target.style.top = top + 'rem';
    };
    headerBlock.prototype.setHeight = function (target, height) {
        if (height === void 0) { height = 0; }
        target.style.height = height + 'rem';
    };
    headerBlock.prototype.getScrollEvent = function () {
        var _this = this;
        addEventListener('scroll', function (event) {
            event.preventDefault();
            _this.scroll = window.pageYOffset || document.documentElement.scrollTop;
            if (_this.scroll > 100) {
                _this.setPosition(_this.menu, 'fixed');
                _this.setHeight(_this.menu, 4.1);
                _this.setTop(_this.burgerMenu, 1);
                _this.setTop(_this.menuNav, 2);
            }
            else {
                _this.setPosition(_this.menu, 'absolute');
                _this.setHeight(_this.menu, 7);
                _this.setTop(_this.burgerMenu, 2.3);
                _this.setTop(_this.menuNav, 5);
            }
            if (_this.scroll < 100 && _this.widthClientBrowser >= 1160) {
                _this.setHeight(_this.headerBlockLogo, 6.1);
            }
            else {
                _this.setHeight(_this.headerBlockLogo, 6.2);
            }
        });
    };
    headerBlock.prototype.beginEvent = function () {
        this.getScrollEvent();
    };
    return headerBlock;
}());
new headerBlock();
var BrowserType = (function () {
    function BrowserType() {
        var _this = this;
        this.getUserBrowser = function () {
            _this.userBrowser = navigator.userAgent;
            if (_this.userBrowser.search(/Safari/) > 0) {
                alert("\u041E\u0439!...\n\t\t\t\t\u0421\u043B\u0443\u0447\u0438\u043B\u043E\u0441\u044C \u0447\u0442\u043E \u0442\u043E \u0443\u0436\u0430\u0441\u043D\u043E\u0435, \u0438 Safari \u043D\u0435 \u043F\u043E\u0434\u0434\u0435\u0440\u0436\u0438\u0432\u0430\u0435\u0442\u0441\u044F.\n\t\t\t\t\u0418\u0441\u043F\u043E\u043B\u044C\u0437\u0443\u0439\u0442\u0435 \u043B\u044E\u0431\u043E\u0439 \u0434\u0440\u0443\u0433\u043E\u0439 \u0431\u0440\u0430\u0443\u0437\u0435\u0440.");
            }
        };
        this.userBrowser = 'null';
        this.getUserBrowser();
    }
    return BrowserType;
}());
new BrowserType();
var Ripple = (function () {
    function Ripple(buttonName, rippleName) {
        if (buttonName === void 0) { buttonName = ''; }
        if (rippleName === void 0) { rippleName = ''; }
        this.xPos = 0;
        this.yPos = 0;
        this.rippleName = rippleName;
        this.buttonName = buttonName;
        this.span = document.createElement('span');
        this.buttons = document.querySelectorAll('.' + this.buttonName);
        this.beginEvent();
    }
    Ripple.prototype.getRippleEffect = function () {
        var _this = this;
        var _loop_1 = function (i) {
            this_1.buttons[i].addEventListener('click', function (event) {
                event.preventDefault();
                event.stopPropagation();
                var rippleWidth = _this.buttons[i].clientWidth;
                var rippleHeight = _this.buttons[i].clientHeight;
                var rippleEffect = _this.span.style;
                var rippleFrame = function () {
                    if (rippleWidth >= rippleHeight) {
                        rippleHeight = rippleWidth;
                    }
                    else {
                        rippleWidth = rippleHeight;
                    }
                };
                var rippleDefineHorizonralCoordinates = function () {
                    _this.xPos = event.layerX - rippleWidth / 2;
                };
                var rippleDefineVerticalCoordinates = function () {
                    _this.yPos = event.layerY - rippleHeight / 2;
                };
                var rippleBeginEffect = function () {
                    rippleEffect.width = rippleWidth + 'px';
                    rippleEffect.height = rippleHeight + 'px';
                    rippleEffect.top = _this.yPos + 'px';
                    rippleEffect.left = _this.xPos + 'px';
                };
                var rippleApplyCssEffect = function () {
                    _this.span.className = _this.rippleName;
                };
                rippleFrame();
                rippleDefineHorizonralCoordinates();
                rippleDefineVerticalCoordinates();
                rippleBeginEffect();
                rippleApplyCssEffect();
                _this.buttons[i].appendChild(_this.span);
                console.log('POS (y | x): ' + _this.yPos + ' | ' + _this.xPos);
            });
        };
        var this_1 = this;
        for (var i = 0; i < this.buttons.length; i += 1) {
            _loop_1(i);
        }
    };
    Ripple.prototype.beginEvent = function () {
        this.getRippleEffect();
    };
    return Ripple;
}());
new Ripple('button-standard', 'ripple_standard');
new Ripple('button-arrow', 'ripple_arrow');
