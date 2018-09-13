/****** FILE: themes/bata/javascript/libs.js *****/

window.jQuery || document.write('<script src="' + themedir + '/bower_components/jquery/dist/jquery.min.js"><\/script>');
(function() {
    var method;
    var noop = function() {};
    var methods = ['assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error', 'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log', 'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd', 'timeStamp', 'trace', 'warn'];
    var length = methods.length;
    var console = (window.console = window.console || {});
    while (length--) {
        method = methods[length];
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());
;
/****** FILE: themes/bata/bower_components/modernizr/modernizr.js *****/

window.Modernizr = (function(window, document, undefined) {
        var version = '2.7.2', Modernizr = {}, enableClasses = true, docElement = document.documentElement, mod = 'modernizr', modElem = document.createElement(mod), mStyle = modElem.style, inputElem = document.createElement('input'), smile = ':)', toString = {}.toString, prefixes = ' -webkit- -moz- -o- -ms- '.split(' '), omPrefixes = 'Webkit Moz O ms', cssomPrefixes = omPrefixes.split(' '), domPrefixes = omPrefixes.toLowerCase().split(' '), ns = {
            'svg': 'http://www.w3.org/2000/svg'
        }, tests = {}, inputs = {}, attrs = {}, classes = [], slice = classes.slice, featureName, injectElementWithStyles = function(rule, callback, nodes, testnames) {
            var style, ret, node, docOverflow, div = document.createElement('div'), body = document.body, fakeBody = body || document.createElement('body');
            if (parseInt(nodes, 10)) {
                while (nodes--) {
                    node = document.createElement('div');
                    node.id = testnames ? testnames[nodes] : mod + (nodes + 1);
                    div.appendChild(node);
                }
            }
            style = ['&#173;', '<style id="s', mod, '">', rule, '</style>'].join('');
            div.id = mod;
            (body ? div : fakeBody).innerHTML += style;
            fakeBody.appendChild(div);
            if (!body) {
                fakeBody.style.background = '';
                fakeBody.style.overflow = 'hidden';
                docOverflow = docElement.style.overflow;
                docElement.style.overflow = 'hidden';
                docElement.appendChild(fakeBody);
            }
            ret = callback(div, rule);
            if (!body) {
                fakeBody.parentNode.removeChild(fakeBody);
                docElement.style.overflow = docOverflow;
            } else {
                div.parentNode.removeChild(div);
            }
            return !!ret;
        }, testMediaQuery = function(mq) {
            var matchMedia = window.matchMedia || window.msMatchMedia;
            if (matchMedia) {
                return matchMedia(mq).matches;
            }
            var bool;
            injectElementWithStyles('@media ' + mq + ' { #' + mod + ' { position: absolute; } }', function(node) {
                bool = (window.getComputedStyle ? getComputedStyle(node, null) : node.currentStyle)['position'] == 'absolute';
            });
            return bool;
        }, isEventSupported = (function() {
                var TAGNAMES = {
                    'select': 'input',
                    'change': 'input',
                    'submit': 'form',
                    'reset': 'form',
                    'error': 'img',
                    'load': 'img',
                    'abort': 'img'
                };
                function isEventSupported(eventName, element) {
                    element = element || document.createElement(TAGNAMES[eventName] || 'div');
                    eventName = 'on' + eventName;
                    var isSupported = eventName in element;
                    if (!isSupported) {
                        if (!element.setAttribute) {
                            element = document.createElement('div');
                        }
                        if (element.setAttribute && element.removeAttribute) {
                            element.setAttribute(eventName, '');
                            isSupported = is(element[eventName], 'function');
                            if (!is(element[eventName], 'undefined')) {
                                element[eventName] = undefined;
                            }
                            element.removeAttribute(eventName);
                        }
                    }
                    element = null;
                    return isSupported;
                }
                return isEventSupported;
            }
        )(), _hasOwnProperty = ({}).hasOwnProperty, hasOwnProp;
        if (!is(_hasOwnProperty, 'undefined') && !is(_hasOwnProperty.call, 'undefined')) {
            hasOwnProp = function(object, property) {
                return _hasOwnProperty.call(object, property);
            }
            ;
        } else {
            hasOwnProp = function(object, property) {
                return ((property in object) && is(object.constructor.prototype[property], 'undefined'));
            }
            ;
        }
        if (!Function.prototype.bind) {
            Function.prototype.bind = function bind(that) {
                var target = this;
                if (typeof target != "function") {
                    throw new TypeError();
                }
                var args = slice.call(arguments, 1)
                    , bound = function() {
                    if (this instanceof bound) {
                        var F = function() {};
                        F.prototype = target.prototype;
                        var self = new F();
                        var result = target.apply(self, args.concat(slice.call(arguments)));
                        if (Object(result) === result) {
                            return result;
                        }
                        return self;
                    } else {
                        return target.apply(that, args.concat(slice.call(arguments)));
                    }
                };
                return bound;
            }
            ;
        }
        function setCss(str) {
            mStyle.cssText = str;
        }
        function setCssAll(str1, str2) {
            return setCss(prefixes.join(str1 + ';') + (str2 || ''));
        }
        function is(obj, type) {
            return typeof obj === type;
        }
        function contains(str, substr) {
            return !!~('' + str).indexOf(substr);
        }
        function testProps(props, prefixed) {
            for (var i in props) {
                var prop = props[i];
                if (!contains(prop, "-") && mStyle[prop] !== undefined) {
                    return prefixed == 'pfx' ? prop : true;
                }
            }
            return false;
        }
        function testDOMProps(props, obj, elem) {
            for (var i in props) {
                var item = obj[props[i]];
                if (item !== undefined) {
                    if (elem === false)
                        return props[i];
                    if (is(item, 'function')) {
                        return item.bind(elem || obj);
                    }
                    return item;
                }
            }
            return false;
        }
        function testPropsAll(prop, prefixed, elem) {
            var ucProp = prop.charAt(0).toUpperCase() + prop.slice(1)
                , props = (prop + ' ' + cssomPrefixes.join(ucProp + ' ') + ucProp).split(' ');
            if (is(prefixed, "string") || is(prefixed, "undefined")) {
                return testProps(props, prefixed);
            } else {
                props = (prop + ' ' + (domPrefixes).join(ucProp + ' ') + ucProp).split(' ');
                return testDOMProps(props, prefixed, elem);
            }
        }
        tests['flexbox'] = function() {
            return testPropsAll('flexWrap');
        }
        ;
        tests['flexboxlegacy'] = function() {
            return testPropsAll('boxDirection');
        }
        ;
        tests['canvas'] = function() {
            var elem = document.createElement('canvas');
            return !!(elem.getContext && elem.getContext('2d'));
        }
        ;
        tests['canvastext'] = function() {
            return !!(Modernizr['canvas'] && is(document.createElement('canvas').getContext('2d').fillText, 'function'));
        }
        ;
        tests['webgl'] = function() {
            return !!window.WebGLRenderingContext;
        }
        ;
        tests['touch'] = function() {
            var bool;
            if (('ontouchstart'in window) || window.DocumentTouch && document instanceof DocumentTouch) {
                bool = true;
            } else {
                injectElementWithStyles(['@media (', prefixes.join('touch-enabled),('), mod, ')', '{#modernizr{top:9px;position:absolute}}'].join(''), function(node) {
                    bool = node.offsetTop === 9;
                });
            }
            return bool;
        }
        ;
        tests['geolocation'] = function() {
            return 'geolocation'in navigator;
        }
        ;
        tests['postmessage'] = function() {
            return !!window.postMessage;
        }
        ;
        tests['websqldatabase'] = function() {
            return !!window.openDatabase;
        }
        ;
        tests['indexedDB'] = function() {
            return !!testPropsAll("indexedDB", window);
        }
        ;
        tests['hashchange'] = function() {
            return isEventSupported('hashchange', window) && (document.documentMode === undefined || document.documentMode > 7);
        }
        ;
        tests['history'] = function() {
            return !!(window.history && history.pushState);
        }
        ;
        tests['draganddrop'] = function() {
            var div = document.createElement('div');
            return ('draggable'in div) || ('ondragstart'in div && 'ondrop'in div);
        }
        ;
        tests['websockets'] = function() {
            return 'WebSocket'in window || 'MozWebSocket'in window;
        }
        ;
        tests['rgba'] = function() {
            setCss('background-color:rgba(150,255,150,.5)');
            return contains(mStyle.backgroundColor, 'rgba');
        }
        ;
        tests['hsla'] = function() {
            setCss('background-color:hsla(120,40%,100%,.5)');
            return contains(mStyle.backgroundColor, 'rgba') || contains(mStyle.backgroundColor, 'hsla');
        }
        ;
        tests['multiplebgs'] = function() {
            setCss('background:url(https://),url(https://),red url(https://)');
            return (/(url\s*\(.*?){3}/).test(mStyle.background);
        }
        ;
        tests['backgroundsize'] = function() {
            return testPropsAll('backgroundSize');
        }
        ;
        tests['borderimage'] = function() {
            return testPropsAll('borderImage');
        }
        ;
        tests['borderradius'] = function() {
            return testPropsAll('borderRadius');
        }
        ;
        tests['boxshadow'] = function() {
            return testPropsAll('boxShadow');
        }
        ;
        tests['textshadow'] = function() {
            return document.createElement('div').style.textShadow === '';
        }
        ;
        tests['opacity'] = function() {
            setCssAll('opacity:.55');
            return (/^0.55$/).test(mStyle.opacity);
        }
        ;
        tests['cssanimations'] = function() {
            return testPropsAll('animationName');
        }
        ;
        tests['csscolumns'] = function() {
            return testPropsAll('columnCount');
        }
        ;
        tests['cssgradients'] = function() {
            var str1 = 'background-image:'
                , str2 = 'gradient(linear,left top,right bottom,from(#9f9),to(white));'
                , str3 = 'linear-gradient(left top,#9f9, white);';
            setCss((str1 + '-webkit- '.split(' ').join(str2 + str1) + prefixes.join(str3 + str1)).slice(0, -str1.length));
            return contains(mStyle.backgroundImage, 'gradient');
        }
        ;
        tests['cssreflections'] = function() {
            return testPropsAll('boxReflect');
        }
        ;
        tests['csstransforms'] = function() {
            return !!testPropsAll('transform');
        }
        ;
        tests['csstransforms3d'] = function() {
            var ret = !!testPropsAll('perspective');
            if (ret && 'webkitPerspective'in docElement.style) {
                injectElementWithStyles('@media (transform-3d),(-webkit-transform-3d){#modernizr{left:9px;position:absolute;height:3px;}}', function(node, rule) {
                    ret = node.offsetLeft === 9 && node.offsetHeight === 3;
                });
            }
            return ret;
        }
        ;
        tests['csstransitions'] = function() {
            return testPropsAll('transition');
        }
        ;
        tests['fontface'] = function() {
            var bool;
            injectElementWithStyles('@font-face {font-family:"font";src:url("https://")}', function(node, rule) {
                var style = document.getElementById('smodernizr')
                    , sheet = style.sheet || style.styleSheet
                    , cssText = sheet ? (sheet.cssRules && sheet.cssRules[0] ? sheet.cssRules[0].cssText : sheet.cssText || '') : '';
                bool = /src/i.test(cssText) && cssText.indexOf(rule.split(' ')[0]) === 0;
            });
            return bool;
        }
        ;
        tests['generatedcontent'] = function() {
            var bool;
            injectElementWithStyles(['#', mod, '{font:0/0 a}#', mod, ':after{content:"', smile, '";visibility:hidden;font:3px/1 a}'].join(''), function(node) {
                bool = node.offsetHeight >= 3;
            });
            return bool;
        }
        ;
        tests['video'] = function() {
            var elem = document.createElement('video')
                , bool = false;
            try {
                if (bool = !!elem.canPlayType) {
                    bool = new Boolean(bool);
                    bool.ogg = elem.canPlayType('video/ogg; codecs="theora"').replace(/^no$/, '');
                    bool.h264 = elem.canPlayType('video/mp4; codecs="avc1.42E01E"').replace(/^no$/, '');
                    bool.webm = elem.canPlayType('video/webm; codecs="vp8, vorbis"').replace(/^no$/, '');
                }
            } catch (e) {}
            return bool;
        }
        ;
        tests['audio'] = function() {
            var elem = document.createElement('audio')
                , bool = false;
            try {
                if (bool = !!elem.canPlayType) {
                    bool = new Boolean(bool);
                    bool.ogg = elem.canPlayType('audio/ogg; codecs="vorbis"').replace(/^no$/, '');
                    bool.mp3 = elem.canPlayType('audio/mpeg;').replace(/^no$/, '');
                    bool.wav = elem.canPlayType('audio/wav; codecs="1"').replace(/^no$/, '');
                    bool.m4a = (elem.canPlayType('audio/x-m4a;') || elem.canPlayType('audio/aac;')).replace(/^no$/, '');
                }
            } catch (e) {}
            return bool;
        }
        ;
        tests['localstorage'] = function() {
            try {
                localStorage.setItem(mod, mod);
                localStorage.removeItem(mod);
                return true;
            } catch (e) {
                return false;
            }
        }
        ;
        tests['sessionstorage'] = function() {
            try {
                sessionStorage.setItem(mod, mod);
                sessionStorage.removeItem(mod);
                return true;
            } catch (e) {
                return false;
            }
        }
        ;
        tests['webworkers'] = function() {
            return !!window.Worker;
        }
        ;
        tests['applicationcache'] = function() {
            return !!window.applicationCache;
        }
        ;
        tests['svg'] = function() {
            return !!document.createElementNS && !!document.createElementNS(ns.svg, 'svg').createSVGRect;
        }
        ;
        tests['inlinesvg'] = function() {
            var div = document.createElement('div');
            div.innerHTML = '<svg/>';
            return (div.firstChild && div.firstChild.namespaceURI) == ns.svg;
        }
        ;
        tests['smil'] = function() {
            return !!document.createElementNS && /SVGAnimate/.test(toString.call(document.createElementNS(ns.svg, 'animate')));
        }
        ;
        tests['svgclippaths'] = function() {
            return !!document.createElementNS && /SVGClipPath/.test(toString.call(document.createElementNS(ns.svg, 'clipPath')));
        }
        ;
        function webforms() {
            Modernizr['input'] = (function(props) {
                    for (var i = 0, len = props.length; i < len; i++) {
                        attrs[props[i]] = !!(props[i]in inputElem);
                    }
                    if (attrs.list) {
                        attrs.list = !!(document.createElement('datalist') && window.HTMLDataListElement);
                    }
                    return attrs;
                }
            )('autocomplete autofocus list placeholder max min multiple pattern required step'.split(' '));
            Modernizr['inputtypes'] = (function(props) {
                    for (var i = 0, bool, inputElemType, defaultView, len = props.length; i < len; i++) {
                        inputElem.setAttribute('type', inputElemType = props[i]);
                        bool = inputElem.type !== 'text';
                        if (bool) {
                            inputElem.value = smile;
                            inputElem.style.cssText = 'position:absolute;visibility:hidden;';
                            if (/^range$/.test(inputElemType) && inputElem.style.WebkitAppearance !== undefined) {
                                docElement.appendChild(inputElem);
                                defaultView = document.defaultView;
                                bool = defaultView.getComputedStyle && defaultView.getComputedStyle(inputElem, null).WebkitAppearance !== 'textfield' && (inputElem.offsetHeight !== 0);
                                docElement.removeChild(inputElem);
                            } else if (/^(search|tel)$/.test(inputElemType)) {} else if (/^(url|email)$/.test(inputElemType)) {
                                bool = inputElem.checkValidity && inputElem.checkValidity() === false;
                            } else {
                                bool = inputElem.value != smile;
                            }
                        }
                        inputs[props[i]] = !!bool;
                    }
                    return inputs;
                }
            )('search tel url email datetime date month week time datetime-local number range color'.split(' '));
        }
        for (var feature in tests) {
            if (hasOwnProp(tests, feature)) {
                featureName = feature.toLowerCase();
                Modernizr[featureName] = tests[feature]();
                classes.push((Modernizr[featureName] ? '' : 'no-') + featureName);
            }
        }
        Modernizr.input || webforms();
        Modernizr.addTest = function(feature, test) {
            if (typeof feature == 'object') {
                for (var key in feature) {
                    if (hasOwnProp(feature, key)) {
                        Modernizr.addTest(key, feature[key]);
                    }
                }
            } else {
                feature = feature.toLowerCase();
                if (Modernizr[feature] !== undefined) {
                    return Modernizr;
                }
                test = typeof test == 'function' ? test() : test;
                if (typeof enableClasses !== "undefined" && enableClasses) {
                    docElement.className += ' ' + (test ? '' : 'no-') + feature;
                }
                Modernizr[feature] = test;
            }
            return Modernizr;
        }
        ;
        setCss('');
        modElem = inputElem = null;
        ;(function(window, document) {
            var version = '3.7.0';
            var options = window.html5 || {};
            var reSkip = /^<|^(?:button|map|select|textarea|object|iframe|option|optgroup)$/i;
            var saveClones = /^(?:a|b|code|div|fieldset|h1|h2|h3|h4|h5|h6|i|label|li|ol|p|q|span|strong|style|table|tbody|td|th|tr|ul)$/i;
            var supportsHtml5Styles;
            var expando = '_html5shiv';
            var expanID = 0;
            var expandoData = {};
            var supportsUnknownElements;
            (function() {
                try {
                    var a = document.createElement('a');
                    a.innerHTML = '<xyz></xyz>';
                    supportsHtml5Styles = ('hidden'in a);
                    supportsUnknownElements = a.childNodes.length == 1 || (function() {
                            (document.createElement)('a');
                            var frag = document.createDocumentFragment();
                            return (typeof frag.cloneNode == 'undefined' || typeof frag.createDocumentFragment == 'undefined' || typeof frag.createElement == 'undefined');
                        }());
                } catch (e) {
                    supportsHtml5Styles = true;
                    supportsUnknownElements = true;
                }
            }());
            function addStyleSheet(ownerDocument, cssText) {
                var p = ownerDocument.createElement('p')
                    , parent = ownerDocument.getElementsByTagName('head')[0] || ownerDocument.documentElement;
                p.innerHTML = 'x<style>' + cssText + '</style>';
                return parent.insertBefore(p.lastChild, parent.firstChild);
            }
            function getElements() {
                var elements = html5.elements;
                return typeof elements == 'string' ? elements.split(' ') : elements;
            }
            function getExpandoData(ownerDocument) {
                var data = expandoData[ownerDocument[expando]];
                if (!data) {
                    data = {};
                    expanID++;
                    ownerDocument[expando] = expanID;
                    expandoData[expanID] = data;
                }
                return data;
            }
            function createElement(nodeName, ownerDocument, data) {
                if (!ownerDocument) {
                    ownerDocument = document;
                }
                if (supportsUnknownElements) {
                    return ownerDocument.createElement(nodeName);
                }
                if (!data) {
                    data = getExpandoData(ownerDocument);
                }
                var node;
                if (data.cache[nodeName]) {
                    node = data.cache[nodeName].cloneNode();
                } else if (saveClones.test(nodeName)) {
                    node = (data.cache[nodeName] = data.createElem(nodeName)).cloneNode();
                } else {
                    node = data.createElem(nodeName);
                }
                return node.canHaveChildren && !reSkip.test(nodeName) && !node.tagUrn ? data.frag.appendChild(node) : node;
            }
            function createDocumentFragment(ownerDocument, data) {
                if (!ownerDocument) {
                    ownerDocument = document;
                }
                if (supportsUnknownElements) {
                    return ownerDocument.createDocumentFragment();
                }
                data = data || getExpandoData(ownerDocument);
                var clone = data.frag.cloneNode()
                    , i = 0
                    , elems = getElements()
                    , l = elems.length;
                for (; i < l; i++) {
                    clone.createElement(elems[i]);
                }
                return clone;
            }
            function shivMethods(ownerDocument, data) {
                if (!data.cache) {
                    data.cache = {};
                    data.createElem = ownerDocument.createElement;
                    data.createFrag = ownerDocument.createDocumentFragment;
                    data.frag = data.createFrag();
                }
                ownerDocument.createElement = function(nodeName) {
                    if (!html5.shivMethods) {
                        return data.createElem(nodeName);
                    }
                    return createElement(nodeName, ownerDocument, data);
                }
                ;
                ownerDocument.createDocumentFragment = Function('h,f', 'return function(){' + 'var n=f.cloneNode(),c=n.createElement;' + 'h.shivMethods&&(' + getElements().join().replace(/[\w\-]+/g, function(nodeName) {
                        data.createElem(nodeName);
                        data.frag.createElement(nodeName);
                        return 'c("' + nodeName + '")';
                    }) + ');return n}')(html5, data.frag);
            }
            function shivDocument(ownerDocument) {
                if (!ownerDocument) {
                    ownerDocument = document;
                }
                var data = getExpandoData(ownerDocument);
                if (html5.shivCSS && !supportsHtml5Styles && !data.hasCSS) {
                    data.hasCSS = !!addStyleSheet(ownerDocument, 'article,aside,dialog,figcaption,figure,footer,header,hgroup,main,nav,section{display:block}' + 'mark{background:#FF0;color:#000}' + 'template{display:none}');
                }
                if (!supportsUnknownElements) {
                    shivMethods(ownerDocument, data);
                }
                return ownerDocument;
            }
            var html5 = {
                'elements': options.elements || 'abbr article aside audio bdi canvas data datalist details dialog figcaption figure footer header hgroup main mark meter nav output progress section summary template time video',
                'version': version,
                'shivCSS': (options.shivCSS !== false),
                'supportsUnknownElements': supportsUnknownElements,
                'shivMethods': (options.shivMethods !== false),
                'type': 'default',
                'shivDocument': shivDocument,
                createElement: createElement,
                createDocumentFragment: createDocumentFragment
            };
            window.html5 = html5;
            shivDocument(document);
        }(this, document));
        Modernizr._version = version;
        Modernizr._prefixes = prefixes;
        Modernizr._domPrefixes = domPrefixes;
        Modernizr._cssomPrefixes = cssomPrefixes;
        Modernizr.mq = testMediaQuery;
        Modernizr.hasEvent = isEventSupported;
        Modernizr.testProp = function(prop) {
            return testProps([prop]);
        }
        ;
        Modernizr.testAllProps = testPropsAll;
        Modernizr.testStyles = injectElementWithStyles;
        Modernizr.prefixed = function(prop, obj, elem) {
            if (!obj) {
                return testPropsAll(prop, 'pfx');
            } else {
                return testPropsAll(prop, obj, elem);
            }
        }
        ;
        docElement.className = docElement.className.replace(/(^|\s)no-js(\s|$)/, '$1$2') + (enableClasses ? ' js ' + classes.join(' ') : '');
        return Modernizr;
    }
)(this, this.document);
;
/****** FILE: themes/bata/bower_components/jquery-focuspoint/js/jquery.focuspoint.js *****/
;(function($) {
        var defaults = {
            reCalcOnWindowResize: true,
            throttleDuration: 17
        };
        var setupContainer = function($el) {
            var imageSrc = $el.find('img').attr('src');
            $el.data('imageSrc', imageSrc);
            resolveImageSize(imageSrc, function(err, dim) {
                $el.data({
                    imageW: dim.width,
                    imageH: dim.height
                });
                adjustFocus($el);
            });
        };
        var resolveImageSize = function(src, cb) {
            $('<img />').one('load', function() {
                cb(null, {
                    width: this.width,
                    height: this.height
                });
            }).attr('src', src);
        };
        var throttle = function(fn, ms) {
            var isRunning = false;
            return function() {
                var args = Array.prototype.slice.call(arguments, 0);
                if (isRunning)
                    return false;
                isRunning = true;
                setTimeout(function() {
                    isRunning = false;
                    fn.apply(null, args);
                }, ms);
            }
                ;
        };
        var calcShift = function(conToImageRatio, containerSize, imageSize, focusSize, toMinus) {
            var containerCenter = Math.floor(containerSize / 2);
            var focusFactor = (focusSize + 1) / 2;
            var scaledImage = Math.floor(imageSize / conToImageRatio);
            var focus = Math.floor(focusFactor * scaledImage);
            if (toMinus)
                focus = scaledImage - focus;
            var focusOffset = focus - containerCenter;
            var remainder = scaledImage - focus;
            var containerRemainder = containerSize - containerCenter;
            if (remainder < containerRemainder)
                focusOffset -= containerRemainder - remainder;
            if (focusOffset < 0)
                focusOffset = 0;
            return (focusOffset * -100 / containerSize) + '%';
        };
        var adjustFocus = function($el) {
            var imageW = $el.data('imageW');
            var imageH = $el.data('imageH');
            var imageSrc = $el.data('imageSrc');
            if (!imageW && !imageH && !imageSrc) {
                return setupContainer($el);
            }
            var containerW = $el.width();
            var containerH = $el.height();
            var focusX = parseFloat($el.data('focusX'));
            var focusY = parseFloat($el.data('focusY'));
            var $image = $el.find('img').first();
            var hShift = 0;
            var vShift = 0;
            if (!(containerW > 0 && containerH > 0 && imageW > 0 && imageH > 0)) {
                return false;
            }
            var wR = imageW / containerW;
            var hR = imageH / containerH;
            $image.css({
                'max-width': '',
                'max-height': ''
            });
            if (imageW > containerW && imageH > containerH) {
                $image.css((wR > hR) ? 'max-height' : 'max-width', '100%');
            }
            if (wR > hR) {
                hShift = calcShift(hR, containerW, imageW, focusX);
            } else if (wR < hR) {
                vShift = calcShift(wR, containerH, imageH, focusY, true);
            }
            $image.css({
                top: vShift,
                left: hShift
            });
        };
        var $window = $(window);
        var focusPoint = function($el, settings) {
            var thrAdjustFocus = settings.throttleDuration ? throttle(function() {
                    adjustFocus($el);
                }, settings.throttleDuration) : function() {
                    adjustFocus($el);
                }
                ;
            var isListening = false;
            adjustFocus($el);
            return {
                adjustFocus: function() {
                    return adjustFocus($el);
                },
                windowOn: function() {
                    if (isListening)
                        return;
                    $window.on('resize', thrAdjustFocus);
                    return isListening = true;
                },
                windowOff: function() {
                    if (!isListening)
                        return;
                    $window.off('resize', thrAdjustFocus);
                    isListening = false;
                    return true;
                }
            };
        };
        $.fn.focusPoint = function(optionsOrMethod) {
            if (typeof optionsOrMethod === 'string') {
                return this.each(function() {
                    var $el = $(this);
                    $el.data('focusPoint')[optionsOrMethod]();
                });
            }
            var settings = $.extend({}, defaults, optionsOrMethod);
            return this.each(function() {
                var $el = $(this);
                var fp = focusPoint($el, settings);
                if ($el.data('focusPoint'))
                    $el.data('focusPoint').windowOff();
                $el.data('focusPoint', fp);
                if (settings.reCalcOnWindowResize)
                    fp.windowOn();
            });
        }
        ;
        $.fn.adjustFocus = function() {
            return this.each(function() {
                adjustFocus($(this));
            });
        }
        ;
    }
)(jQuery);
;
/****** FILE: themes/bata/bower_components/matchHeight/dist/jquery.matchHeight.js *****/
;(function(factory) {
        'use strict';
        if (typeof define === 'function' && define.amd) {
            define(['jquery'], factory);
        } else if (typeof module !== 'undefined' && module.exports) {
            module.exports = factory(require('jquery'));
        } else {
            factory(jQuery);
        }
    }
)(function($) {
    var _previousResizeWidth = -1
        , _updateTimeout = -1;
    var _parse = function(value) {
        return parseFloat(value) || 0;
    };
    var _rows = function(elements) {
        var tolerance = 1
            , $elements = $(elements)
            , lastTop = null
            , rows = [];
        $elements.each(function() {
            var $that = $(this)
                , top = $that.offset().top - _parse($that.css('margin-top'))
                , lastRow = rows.length > 0 ? rows[rows.length - 1] : null;
            if (lastRow === null) {
                rows.push($that);
            } else {
                if (Math.floor(Math.abs(lastTop - top)) <= tolerance) {
                    rows[rows.length - 1] = lastRow.add($that);
                } else {
                    rows.push($that);
                }
            }
            lastTop = top;
        });
        return rows;
    };
    var _parseOptions = function(options) {
        var opts = {
            byRow: true,
            property: 'height',
            target: null,
            remove: false
        };
        if (typeof options === 'object') {
            return $.extend(opts, options);
        }
        if (typeof options === 'boolean') {
            opts.byRow = options;
        } else if (options === 'remove') {
            opts.remove = true;
        }
        return opts;
    };
    var matchHeight = $.fn.matchHeight = function(options) {
            var opts = _parseOptions(options);
            if (opts.remove) {
                var that = this;
                this.css(opts.property, '');
                $.each(matchHeight._groups, function(key, group) {
                    group.elements = group.elements.not(that);
                });
                return this;
            }
            if (this.length <= 1 && !opts.target) {
                return this;
            }
            matchHeight._groups.push({
                elements: this,
                options: opts
            });
            matchHeight._apply(this, opts);
            return this;
        }
        ;
    matchHeight.version = '0.7.2';
    matchHeight._groups = [];
    matchHeight._throttle = 80;
    matchHeight._maintainScroll = false;
    matchHeight._beforeUpdate = null;
    matchHeight._afterUpdate = null;
    matchHeight._rows = _rows;
    matchHeight._parse = _parse;
    matchHeight._parseOptions = _parseOptions;
    matchHeight._apply = function(elements, options) {
        var opts = _parseOptions(options)
            , $elements = $(elements)
            , rows = [$elements];
        var scrollTop = $(window).scrollTop()
            , htmlHeight = $('html').outerHeight(true);
        var $hiddenParents = $elements.parents().filter(':hidden');
        $hiddenParents.each(function() {
            var $that = $(this);
            $that.data('style-cache', $that.attr('style'));
        });
        $hiddenParents.css('display', 'block');
        if (opts.byRow && !opts.target) {
            $elements.each(function() {
                var $that = $(this)
                    , display = $that.css('display');
                if (display !== 'inline-block' && display !== 'flex' && display !== 'inline-flex') {
                    display = 'block';
                }
                $that.data('style-cache', $that.attr('style'));
                $that.css({
                    'display': display,
                    'padding-top': '0',
                    'padding-bottom': '0',
                    'margin-top': '0',
                    'margin-bottom': '0',
                    'border-top-width': '0',
                    'border-bottom-width': '0',
                    'height': '100px',
                    'overflow': 'hidden'
                });
            });
            rows = _rows($elements);
            $elements.each(function() {
                var $that = $(this);
                $that.attr('style', $that.data('style-cache') || '');
            });
        }
        $.each(rows, function(key, row) {
            var $row = $(row)
                , targetHeight = 0;
            if (!opts.target) {
                if (opts.byRow && $row.length <= 1) {
                    $row.css(opts.property, '');
                    return;
                }
                $row.each(function() {
                    var $that = $(this)
                        , style = $that.attr('style')
                        , display = $that.css('display');
                    if (display !== 'inline-block' && display !== 'flex' && display !== 'inline-flex') {
                        display = 'block';
                    }
                    var css = {
                        'display': display
                    };
                    css[opts.property] = '';
                    $that.css(css);
                    if ($that.outerHeight(false) > targetHeight) {
                        targetHeight = $that.outerHeight(false);
                    }
                    if (style) {
                        $that.attr('style', style);
                    } else {
                        $that.css('display', '');
                    }
                });
            } else {
                targetHeight = opts.target.outerHeight(false);
            }
            $row.each(function() {
                var $that = $(this)
                    , verticalPadding = 0;
                if (opts.target && $that.is(opts.target)) {
                    return;
                }
                if ($that.css('box-sizing') !== 'border-box') {
                    verticalPadding += _parse($that.css('border-top-width')) + _parse($that.css('border-bottom-width'));
                    verticalPadding += _parse($that.css('padding-top')) + _parse($that.css('padding-bottom'));
                }
                $that.css(opts.property, (targetHeight - verticalPadding) + 'px');
            });
        });
        $hiddenParents.each(function() {
            var $that = $(this);
            $that.attr('style', $that.data('style-cache') || null);
        });
        if (matchHeight._maintainScroll) {
            $(window).scrollTop((scrollTop / htmlHeight) * $('html').outerHeight(true));
        }
        return this;
    }
    ;
    matchHeight._applyDataApi = function() {
        var groups = {};
        $('[data-match-height], [data-mh]').each(function() {
            var $this = $(this)
                , groupId = $this.attr('data-mh') || $this.attr('data-match-height');
            if (groupId in groups) {
                groups[groupId] = groups[groupId].add($this);
            } else {
                groups[groupId] = $this;
            }
        });
        $.each(groups, function() {
            this.matchHeight(true);
        });
    }
    ;
    var _update = function(event) {
        if (matchHeight._beforeUpdate) {
            matchHeight._beforeUpdate(event, matchHeight._groups);
        }
        $.each(matchHeight._groups, function() {
            matchHeight._apply(this.elements, this.options);
        });
        if (matchHeight._afterUpdate) {
            matchHeight._afterUpdate(event, matchHeight._groups);
        }
    };
    matchHeight._update = function(throttle, event) {
        if (event && event.type === 'resize') {
            var windowWidth = $(window).width();
            if (windowWidth === _previousResizeWidth) {
                return;
            }
            _previousResizeWidth = windowWidth;
        }
        if (!throttle) {
            _update(event);
        } else if (_updateTimeout === -1) {
            _updateTimeout = setTimeout(function() {
                _update(event);
                _updateTimeout = -1;
            }, matchHeight._throttle);
        }
    }
    ;
    $(matchHeight._applyDataApi);
    var on = $.fn.on ? 'on' : 'bind';
    $(window)[on]('load', function(event) {
        matchHeight._update(false, event);
    });
    $(window)[on]('resize orientationchange', function(event) {
        matchHeight._update(true, event);
    });
});
;
/****** FILE: themes/bata/bower_components/imagesloaded/imagesloaded.pkgd.js *****/

(function(global, factory) {
    if (typeof define == 'function' && define.amd) {
        define('ev-emitter/ev-emitter', factory);
    } else if (typeof module == 'object' && module.exports) {
        module.exports = factory();
    } else {
        global.EvEmitter = factory();
    }
}(typeof window != 'undefined' ? window : this, function() {
    function EvEmitter() {}
    var proto = EvEmitter.prototype;
    proto.on = function(eventName, listener) {
        if (!eventName || !listener) {
            return;
        }
        var events = this._events = this._events || {};
        var listeners = events[eventName] = events[eventName] || [];
        if (listeners.indexOf(listener) == -1) {
            listeners.push(listener);
        }
        return this;
    }
    ;
    proto.once = function(eventName, listener) {
        if (!eventName || !listener) {
            return;
        }
        this.on(eventName, listener);
        var onceEvents = this._onceEvents = this._onceEvents || {};
        var onceListeners = onceEvents[eventName] = onceEvents[eventName] || {};
        onceListeners[listener] = true;
        return this;
    }
    ;
    proto.off = function(eventName, listener) {
        var listeners = this._events && this._events[eventName];
        if (!listeners || !listeners.length) {
            return;
        }
        var index = listeners.indexOf(listener);
        if (index != -1) {
            listeners.splice(index, 1);
        }
        return this;
    }
    ;
    proto.emitEvent = function(eventName, args) {
        var listeners = this._events && this._events[eventName];
        if (!listeners || !listeners.length) {
            return;
        }
        var i = 0;
        var listener = listeners[i];
        args = args || [];
        var onceListeners = this._onceEvents && this._onceEvents[eventName];
        while (listener) {
            var isOnce = onceListeners && onceListeners[listener];
            if (isOnce) {
                this.off(eventName, listener);
                delete onceListeners[listener];
            }
            listener.apply(this, args);
            i += isOnce ? 0 : 1;
            listener = listeners[i];
        }
        return this;
    }
    ;
    proto.allOff = proto.removeAllListeners = function() {
        delete this._events;
        delete this._onceEvents;
    }
    ;
    return EvEmitter;
}));
(function(window, factory) {
        'use strict';
        if (typeof define == 'function' && define.amd) {
            define(['ev-emitter/ev-emitter'], function(EvEmitter) {
                return factory(window, EvEmitter);
            });
        } else if (typeof module == 'object' && module.exports) {
            module.exports = factory(window, require('ev-emitter'));
        } else {
            window.imagesLoaded = factory(window, window.EvEmitter);
        }
    }
)(typeof window !== 'undefined' ? window : this, function factory(window, EvEmitter) {
    var $ = window.jQuery;
    var console = window.console;
    function extend(a, b) {
        for (var prop in b) {
            a[prop] = b[prop];
        }
        return a;
    }
    function makeArray(obj) {
        var ary = [];
        if (Array.isArray(obj)) {
            ary = obj;
        } else if (typeof obj.length == 'number') {
            for (var i = 0; i < obj.length; i++) {
                ary.push(obj[i]);
            }
        } else {
            ary.push(obj);
        }
        return ary;
    }
    function ImagesLoaded(elem, options, onAlways) {
        if (!(this instanceof ImagesLoaded)) {
            return new ImagesLoaded(elem,options,onAlways);
        }
        if (typeof elem == 'string') {
            elem = document.querySelectorAll(elem);
        }
        this.elements = makeArray(elem);
        this.options = extend({}, this.options);
        if (typeof options == 'function') {
            onAlways = options;
        } else {
            extend(this.options, options);
        }
        if (onAlways) {
            this.on('always', onAlways);
        }
        this.getImages();
        if ($) {
            this.jqDeferred = new $.Deferred();
        }
        setTimeout(function() {
            this.check();
        }
            .bind(this));
    }
    ImagesLoaded.prototype = Object.create(EvEmitter.prototype);
    ImagesLoaded.prototype.options = {};
    ImagesLoaded.prototype.getImages = function() {
        this.images = [];
        this.elements.forEach(this.addElementImages, this);
    }
    ;
    ImagesLoaded.prototype.addElementImages = function(elem) {
        if (elem.nodeName == 'IMG') {
            this.addImage(elem);
        }
        if (this.options.background === true) {
            this.addElementBackgroundImages(elem);
        }
        var nodeType = elem.nodeType;
        if (!nodeType || !elementNodeTypes[nodeType]) {
            return;
        }
        var childImgs = elem.querySelectorAll('img');
        for (var i = 0; i < childImgs.length; i++) {
            var img = childImgs[i];
            this.addImage(img);
        }
        if (typeof this.options.background == 'string') {
            var children = elem.querySelectorAll(this.options.background);
            for (i = 0; i < children.length; i++) {
                var child = children[i];
                this.addElementBackgroundImages(child);
            }
        }
    }
    ;
    var elementNodeTypes = {
        1: true,
        9: true,
        11: true
    };
    ImagesLoaded.prototype.addElementBackgroundImages = function(elem) {
        var style = getComputedStyle(elem);
        if (!style) {
            return;
        }
        var reURL = /url\((['"])?(.*?)\1\)/gi;
        var matches = reURL.exec(style.backgroundImage);
        while (matches !== null) {
            var url = matches && matches[2];
            if (url) {
                this.addBackground(url, elem);
            }
            matches = reURL.exec(style.backgroundImage);
        }
    }
    ;
    ImagesLoaded.prototype.addImage = function(img) {
        var loadingImage = new LoadingImage(img);
        this.images.push(loadingImage);
    }
    ;
    ImagesLoaded.prototype.addBackground = function(url, elem) {
        var background = new Background(url,elem);
        this.images.push(background);
    }
    ;
    ImagesLoaded.prototype.check = function() {
        var _this = this;
        this.progressedCount = 0;
        this.hasAnyBroken = false;
        if (!this.images.length) {
            this.complete();
            return;
        }
        function onProgress(image, elem, message) {
            setTimeout(function() {
                _this.progress(image, elem, message);
            });
        }
        this.images.forEach(function(loadingImage) {
            loadingImage.once('progress', onProgress);
            loadingImage.check();
        });
    }
    ;
    ImagesLoaded.prototype.progress = function(image, elem, message) {
        this.progressedCount++;
        this.hasAnyBroken = this.hasAnyBroken || !image.isLoaded;
        this.emitEvent('progress', [this, image, elem]);
        if (this.jqDeferred && this.jqDeferred.notify) {
            this.jqDeferred.notify(this, image);
        }
        if (this.progressedCount == this.images.length) {
            this.complete();
        }
        if (this.options.debug && console) {
            console.log('progress: ' + message, image, elem);
        }
    }
    ;
    ImagesLoaded.prototype.complete = function() {
        var eventName = this.hasAnyBroken ? 'fail' : 'done';
        this.isComplete = true;
        this.emitEvent(eventName, [this]);
        this.emitEvent('always', [this]);
        if (this.jqDeferred) {
            var jqMethod = this.hasAnyBroken ? 'reject' : 'resolve';
            this.jqDeferred[jqMethod](this);
        }
    }
    ;
    function LoadingImage(img) {
        this.img = img;
    }
    LoadingImage.prototype = Object.create(EvEmitter.prototype);
    LoadingImage.prototype.check = function() {
        var isComplete = this.getIsImageComplete();
        if (isComplete) {
            this.confirm(this.img.naturalWidth !== 0, 'naturalWidth');
            return;
        }
        this.proxyImage = new Image();
        this.proxyImage.addEventListener('load', this);
        this.proxyImage.addEventListener('error', this);
        this.img.addEventListener('load', this);
        this.img.addEventListener('error', this);
        this.proxyImage.src = this.img.src;
    }
    ;
    LoadingImage.prototype.getIsImageComplete = function() {
        return this.img.complete && this.img.naturalWidth !== undefined;
    }
    ;
    LoadingImage.prototype.confirm = function(isLoaded, message) {
        this.isLoaded = isLoaded;
        this.emitEvent('progress', [this, this.img, message]);
    }
    ;
    LoadingImage.prototype.handleEvent = function(event) {
        var method = 'on' + event.type;
        if (this[method]) {
            this[method](event);
        }
    }
    ;
    LoadingImage.prototype.onload = function() {
        this.confirm(true, 'onload');
        this.unbindEvents();
    }
    ;
    LoadingImage.prototype.onerror = function() {
        this.confirm(false, 'onerror');
        this.unbindEvents();
    }
    ;
    LoadingImage.prototype.unbindEvents = function() {
        this.proxyImage.removeEventListener('load', this);
        this.proxyImage.removeEventListener('error', this);
        this.img.removeEventListener('load', this);
        this.img.removeEventListener('error', this);
    }
    ;
    function Background(url, element) {
        this.url = url;
        this.element = element;
        this.img = new Image();
    }
    Background.prototype = Object.create(LoadingImage.prototype);
    Background.prototype.check = function() {
        this.img.addEventListener('load', this);
        this.img.addEventListener('error', this);
        this.img.src = this.url;
        var isComplete = this.getIsImageComplete();
        if (isComplete) {
            this.confirm(this.img.naturalWidth !== 0, 'naturalWidth');
            this.unbindEvents();
        }
    }
    ;
    Background.prototype.unbindEvents = function() {
        this.img.removeEventListener('load', this);
        this.img.removeEventListener('error', this);
    }
    ;
    Background.prototype.confirm = function(isLoaded, message) {
        this.isLoaded = isLoaded;
        this.emitEvent('progress', [this, this.element, message]);
    }
    ;
    ImagesLoaded.makeJQueryPlugin = function(jQuery) {
        jQuery = jQuery || window.jQuery;
        if (!jQuery) {
            return;
        }
        $ = jQuery;
        $.fn.imagesLoaded = function(options, callback) {
            var instance = new ImagesLoaded(this,options,callback);
            return instance.jqDeferred.promise($(this));
        }
        ;
    }
    ;
    ImagesLoaded.makeJQueryPlugin();
    return ImagesLoaded;
});
;
/****** FILE: themes/bata/bower_components/bootstrap/js/affix.js *****/

+function($) {
    'use strict';
    var Affix = function(element, options) {
        this.options = $.extend({}, Affix.DEFAULTS, options)
        this.$target = $(this.options.target).on('scroll.bs.affix.data-api', $.proxy(this.checkPosition, this)).on('click.bs.affix.data-api', $.proxy(this.checkPositionWithEventLoop, this))
        this.$element = $(element)
        this.affixed = null
        this.unpin = null
        this.pinnedOffset = null
        this.checkPosition()
    }
    Affix.VERSION = '3.3.7'
    Affix.RESET = 'affix affix-top affix-bottom'
    Affix.DEFAULTS = {
        offset: 0,
        target: window
    }
    Affix.prototype.getState = function(scrollHeight, height, offsetTop, offsetBottom) {
        var scrollTop = this.$target.scrollTop()
        var position = this.$element.offset()
        var targetHeight = this.$target.height()
        if (offsetTop != null && this.affixed == 'top')
            return scrollTop < offsetTop ? 'top' : false
        if (this.affixed == 'bottom') {
            if (offsetTop != null)
                return (scrollTop + this.unpin <= position.top) ? false : 'bottom'
            return (scrollTop + targetHeight <= scrollHeight - offsetBottom) ? false : 'bottom'
        }
        var initializing = this.affixed == null
        var colliderTop = initializing ? scrollTop : position.top
        var colliderHeight = initializing ? targetHeight : height
        if (offsetTop != null && scrollTop <= offsetTop)
            return 'top'
        if (offsetBottom != null && (colliderTop + colliderHeight >= scrollHeight - offsetBottom))
            return 'bottom'
        return false
    }
    Affix.prototype.getPinnedOffset = function() {
        if (this.pinnedOffset)
            return this.pinnedOffset
        this.$element.removeClass(Affix.RESET).addClass('affix')
        var scrollTop = this.$target.scrollTop()
        var position = this.$element.offset()
        return (this.pinnedOffset = position.top - scrollTop)
    }
    Affix.prototype.checkPositionWithEventLoop = function() {
        setTimeout($.proxy(this.checkPosition, this), 1)
    }
    Affix.prototype.checkPosition = function() {
        if (!this.$element.is(':visible'))
            return
        var height = this.$element.height()
        var offset = this.options.offset
        var offsetTop = offset.top
        var offsetBottom = offset.bottom
        var scrollHeight = Math.max($(document).height(), $(document.body).height())
        if (typeof offset != 'object')
            offsetBottom = offsetTop = offset
        if (typeof offsetTop == 'function')
            offsetTop = offset.top(this.$element)
        if (typeof offsetBottom == 'function')
            offsetBottom = offset.bottom(this.$element)
        var affix = this.getState(scrollHeight, height, offsetTop, offsetBottom)
        if (this.affixed != affix) {
            if (this.unpin != null)
                this.$element.css('top', '')
            var affixType = 'affix' + (affix ? '-' + affix : '')
            var e = $.Event(affixType + '.bs.affix')
            this.$element.trigger(e)
            if (e.isDefaultPrevented())
                return
            this.affixed = affix
            this.unpin = affix == 'bottom' ? this.getPinnedOffset() : null
            this.$element.removeClass(Affix.RESET).addClass(affixType).trigger(affixType.replace('affix', 'affixed') + '.bs.affix')
        }
        if (affix == 'bottom') {
            this.$element.offset({
                top: scrollHeight - height - offsetBottom
            })
        }
    }
    function Plugin(option) {
        return this.each(function() {
            var $this = $(this)
            var data = $this.data('bs.affix')
            var options = typeof option == 'object' && option
            if (!data)
                $this.data('bs.affix', (data = new Affix(this,options)))
            if (typeof option == 'string')
                data[option]()
        })
    }
    var old = $.fn.affix
    $.fn.affix = Plugin
    $.fn.affix.Constructor = Affix
    $.fn.affix.noConflict = function() {
        $.fn.affix = old
        return this
    }
    $(window).on('load', function() {
        $('[data-spy="affix"]').each(function() {
            var $spy = $(this)
            var data = $spy.data()
            data.offset = data.offset || {}
            if (data.offsetBottom != null)
                data.offset.bottom = data.offsetBottom
            if (data.offsetTop != null)
                data.offset.top = data.offsetTop
            Plugin.call($spy, data)
        })
    })
}(jQuery);
;
/****** FILE: themes/bata/bower_components/bootstrap/js/alert.js *****/

+function($) {
    'use strict';
    var dismiss = '[data-dismiss="alert"]'
    var Alert = function(el) {
        $(el).on('click', dismiss, this.close)
    }
    Alert.VERSION = '3.3.7'
    Alert.TRANSITION_DURATION = 150
    Alert.prototype.close = function(e) {
        var $this = $(this)
        var selector = $this.attr('data-target')
        if (!selector) {
            selector = $this.attr('href')
            selector = selector && selector.replace(/.*(?=#[^\s]*$)/, '')
        }
        var $parent = $(selector === '#' ? [] : selector)
        if (e)
            e.preventDefault()
        if (!$parent.length) {
            $parent = $this.closest('.alert')
        }
        $parent.trigger(e = $.Event('close.bs.alert'))
        if (e.isDefaultPrevented())
            return
        $parent.removeClass('in')
        function removeElement() {
            $parent.detach().trigger('closed.bs.alert').remove()
        }
        $.support.transition && $parent.hasClass('fade') ? $parent.one('bsTransitionEnd', removeElement).emulateTransitionEnd(Alert.TRANSITION_DURATION) : removeElement()
    }
    function Plugin(option) {
        return this.each(function() {
            var $this = $(this)
            var data = $this.data('bs.alert')
            if (!data)
                $this.data('bs.alert', (data = new Alert(this)))
            if (typeof option == 'string')
                data[option].call($this)
        })
    }
    var old = $.fn.alert
    $.fn.alert = Plugin
    $.fn.alert.Constructor = Alert
    $.fn.alert.noConflict = function() {
        $.fn.alert = old
        return this
    }
    $(document).on('click.bs.alert.data-api', dismiss, Alert.prototype.close)
}(jQuery);
;
/****** FILE: themes/bata/bower_components/bootstrap/js/button.js *****/

+function($) {
    'use strict';
    var Button = function(element, options) {
        this.$element = $(element)
        this.options = $.extend({}, Button.DEFAULTS, options)
        this.isLoading = false
    }
    Button.VERSION = '3.3.7'
    Button.DEFAULTS = {
        loadingText: 'loading...'
    }
    Button.prototype.setState = function(state) {
        var d = 'disabled'
        var $el = this.$element
        var val = $el.is('input') ? 'val' : 'html'
        var data = $el.data()
        state += 'Text'
        if (data.resetText == null)
            $el.data('resetText', $el[val]())
        setTimeout($.proxy(function() {
            $el[val](data[state] == null ? this.options[state] : data[state])
            if (state == 'loadingText') {
                this.isLoading = true
                $el.addClass(d).attr(d, d).prop(d, true)
            } else if (this.isLoading) {
                this.isLoading = false
                $el.removeClass(d).removeAttr(d).prop(d, false)
            }
        }, this), 0)
    }
    Button.prototype.toggle = function() {
        var changed = true
        var $parent = this.$element.closest('[data-toggle="buttons"]')
        if ($parent.length) {
            var $input = this.$element.find('input')
            if ($input.prop('type') == 'radio') {
                if ($input.prop('checked'))
                    changed = false
                $parent.find('.active').removeClass('active')
                this.$element.addClass('active')
            } else if ($input.prop('type') == 'checkbox') {
                if (($input.prop('checked')) !== this.$element.hasClass('active'))
                    changed = false
                this.$element.toggleClass('active')
            }
            $input.prop('checked', this.$element.hasClass('active'))
            if (changed)
                $input.trigger('change')
        } else {
            this.$element.attr('aria-pressed', !this.$element.hasClass('active'))
            this.$element.toggleClass('active')
        }
    }
    function Plugin(option) {
        return this.each(function() {
            var $this = $(this)
            var data = $this.data('bs.button')
            var options = typeof option == 'object' && option
            if (!data)
                $this.data('bs.button', (data = new Button(this,options)))
            if (option == 'toggle')
                data.toggle()
            else if (option)
                data.setState(option)
        })
    }
    var old = $.fn.button
    $.fn.button = Plugin
    $.fn.button.Constructor = Button
    $.fn.button.noConflict = function() {
        $.fn.button = old
        return this
    }
    $(document).on('click.bs.button.data-api', '[data-toggle^="button"]', function(e) {
        var $btn = $(e.target).closest('.btn')
        Plugin.call($btn, 'toggle')
        if (!($(e.target).is('input[type="radio"], input[type="checkbox"]'))) {
            e.preventDefault()
            if ($btn.is('input,button'))
                $btn.trigger('focus')
            else
                $btn.find('input:visible,button:visible').first().trigger('focus')
        }
    }).on('focus.bs.button.data-api blur.bs.button.data-api', '[data-toggle^="button"]', function(e) {
        $(e.target).closest('.btn').toggleClass('focus', /^focus(in)?$/.test(e.type))
    })
}(jQuery);
;
/****** FILE: themes/bata/bower_components/bootstrap/js/carousel.js *****/

+function($) {
    'use strict';
    var Carousel = function(element, options) {
        this.$element = $(element)
        this.$indicators = this.$element.find('.carousel-indicators')
        this.options = options
        this.paused = null
        this.sliding = null
        this.interval = null
        this.$active = null
        this.$items = null
        this.options.keyboard && this.$element.on('keydown.bs.carousel', $.proxy(this.keydown, this))
        this.options.pause == 'hover' && !('ontouchstart'in document.documentElement) && this.$element.on('mouseenter.bs.carousel', $.proxy(this.pause, this)).on('mouseleave.bs.carousel', $.proxy(this.cycle, this))
    }
    Carousel.VERSION = '3.3.7'
    Carousel.TRANSITION_DURATION = 600
    Carousel.DEFAULTS = {
        interval: 5000,
        pause: 'hover',
        wrap: true,
        keyboard: true
    }
    Carousel.prototype.keydown = function(e) {
        if (/input|textarea/i.test(e.target.tagName))
            return
        switch (e.which) {
            case 37:
                this.prev();
                break
            case 39:
                this.next();
                break
            default:
                return
        }
        e.preventDefault()
    }
    Carousel.prototype.cycle = function(e) {
        e || (this.paused = false)
        this.interval && clearInterval(this.interval)
        this.options.interval && !this.paused && (this.interval = setInterval($.proxy(this.next, this), this.options.interval))
        return this
    }
    Carousel.prototype.getItemIndex = function(item) {
        this.$items = item.parent().children('.item')
        return this.$items.index(item || this.$active)
    }
    Carousel.prototype.getItemForDirection = function(direction, active) {
        var activeIndex = this.getItemIndex(active)
        var willWrap = (direction == 'prev' && activeIndex === 0) || (direction == 'next' && activeIndex == (this.$items.length - 1))
        if (willWrap && !this.options.wrap)
            return active
        var delta = direction == 'prev' ? -1 : 1
        var itemIndex = (activeIndex + delta) % this.$items.length
        return this.$items.eq(itemIndex)
    }
    Carousel.prototype.to = function(pos) {
        var that = this
        var activeIndex = this.getItemIndex(this.$active = this.$element.find('.item.active'))
        if (pos > (this.$items.length - 1) || pos < 0)
            return
        if (this.sliding)
            return this.$element.one('slid.bs.carousel', function() {
                that.to(pos)
            })
        if (activeIndex == pos)
            return this.pause().cycle()
        return this.slide(pos > activeIndex ? 'next' : 'prev', this.$items.eq(pos))
    }
    Carousel.prototype.pause = function(e) {
        e || (this.paused = true)
        if (this.$element.find('.next, .prev').length && $.support.transition) {
            this.$element.trigger($.support.transition.end)
            this.cycle(true)
        }
        this.interval = clearInterval(this.interval)
        return this
    }
    Carousel.prototype.next = function() {
        if (this.sliding)
            return
        return this.slide('next')
    }
    Carousel.prototype.prev = function() {
        if (this.sliding)
            return
        return this.slide('prev')
    }
    Carousel.prototype.slide = function(type, next) {
        var $active = this.$element.find('.item.active')
        var $next = next || this.getItemForDirection(type, $active)
        var isCycling = this.interval
        var direction = type == 'next' ? 'left' : 'right'
        var that = this
        if ($next.hasClass('active'))
            return (this.sliding = false)
        var relatedTarget = $next[0]
        var slideEvent = $.Event('slide.bs.carousel', {
            relatedTarget: relatedTarget,
            direction: direction
        })
        this.$element.trigger(slideEvent)
        if (slideEvent.isDefaultPrevented())
            return
        this.sliding = true
        isCycling && this.pause()
        if (this.$indicators.length) {
            this.$indicators.find('.active').removeClass('active')
            var $nextIndicator = $(this.$indicators.children()[this.getItemIndex($next)])
            $nextIndicator && $nextIndicator.addClass('active')
        }
        var slidEvent = $.Event('slid.bs.carousel', {
            relatedTarget: relatedTarget,
            direction: direction
        })
        if ($.support.transition && this.$element.hasClass('slide')) {
            $next.addClass(type)
            $next[0].offsetWidth
            $active.addClass(direction)
            $next.addClass(direction)
            $active.one('bsTransitionEnd', function() {
                $next.removeClass([type, direction].join(' ')).addClass('active')
                $active.removeClass(['active', direction].join(' '))
                that.sliding = false
                setTimeout(function() {
                    that.$element.trigger(slidEvent)
                }, 0)
            }).emulateTransitionEnd(Carousel.TRANSITION_DURATION)
        } else {
            $active.removeClass('active')
            $next.addClass('active')
            this.sliding = false
            this.$element.trigger(slidEvent)
        }
        isCycling && this.cycle()
        return this
    }
    function Plugin(option) {
        return this.each(function() {
            var $this = $(this)
            var data = $this.data('bs.carousel')
            var options = $.extend({}, Carousel.DEFAULTS, $this.data(), typeof option == 'object' && option)
            var action = typeof option == 'string' ? option : options.slide
            if (!data)
                $this.data('bs.carousel', (data = new Carousel(this,options)))
            if (typeof option == 'number')
                data.to(option)
            else if (action)
                data[action]()
            else if (options.interval)
                data.pause().cycle()
        })
    }
    var old = $.fn.carousel
    $.fn.carousel = Plugin
    $.fn.carousel.Constructor = Carousel
    $.fn.carousel.noConflict = function() {
        $.fn.carousel = old
        return this
    }
    var clickHandler = function(e) {
        var href
        var $this = $(this)
        var $target = $($this.attr('data-target') || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, ''))
        if (!$target.hasClass('carousel'))
            return
        var options = $.extend({}, $target.data(), $this.data())
        var slideIndex = $this.attr('data-slide-to')
        if (slideIndex)
            options.interval = false
        Plugin.call($target, options)
        if (slideIndex) {
            $target.data('bs.carousel').to(slideIndex)
        }
        e.preventDefault()
    }
    $(document).on('click.bs.carousel.data-api', '[data-slide]', clickHandler).on('click.bs.carousel.data-api', '[data-slide-to]', clickHandler)
    $(window).on('load', function() {
        $('[data-ride="carousel"]').each(function() {
            var $carousel = $(this)
            Plugin.call($carousel, $carousel.data())
        })
    })
}(jQuery);
;
/****** FILE: themes/bata/bower_components/bootstrap/js/collapse.js *****/

+function($) {
    'use strict';
    var Collapse = function(element, options) {
        this.$element = $(element)
        this.options = $.extend({}, Collapse.DEFAULTS, options)
        this.$trigger = $('[data-toggle="collapse"][href="#' + element.id + '"],' + '[data-toggle="collapse"][data-target="#' + element.id + '"]')
        this.transitioning = null
        if (this.options.parent) {
            this.$parent = this.getParent()
        } else {
            this.addAriaAndCollapsedClass(this.$element, this.$trigger)
        }
        if (this.options.toggle)
            this.toggle()
    }
    Collapse.VERSION = '3.3.7'
    Collapse.TRANSITION_DURATION = 350
    Collapse.DEFAULTS = {
        toggle: true
    }
    Collapse.prototype.dimension = function() {
        var hasWidth = this.$element.hasClass('width')
        return hasWidth ? 'width' : 'height'
    }
    Collapse.prototype.show = function() {
        if (this.transitioning || this.$element.hasClass('in'))
            return
        var activesData
        var actives = this.$parent && this.$parent.children('.panel').children('.in, .collapsing')
        if (actives && actives.length) {
            activesData = actives.data('bs.collapse')
            if (activesData && activesData.transitioning)
                return
        }
        var startEvent = $.Event('show.bs.collapse')
        this.$element.trigger(startEvent)
        if (startEvent.isDefaultPrevented())
            return
        if (actives && actives.length) {
            Plugin.call(actives, 'hide')
            activesData || actives.data('bs.collapse', null)
        }
        var dimension = this.dimension()
        this.$element.removeClass('collapse').addClass('collapsing')[dimension](0).attr('aria-expanded', true)
        this.$trigger.removeClass('collapsed').attr('aria-expanded', true)
        this.transitioning = 1
        var complete = function() {
            this.$element.removeClass('collapsing').addClass('collapse in')[dimension]('')
            this.transitioning = 0
            this.$element.trigger('shown.bs.collapse')
        }
        if (!$.support.transition)
            return complete.call(this)
        var scrollSize = $.camelCase(['scroll', dimension].join('-'))
        this.$element.one('bsTransitionEnd', $.proxy(complete, this)).emulateTransitionEnd(Collapse.TRANSITION_DURATION)[dimension](this.$element[0][scrollSize])
    }
    Collapse.prototype.hide = function() {
        if (this.transitioning || !this.$element.hasClass('in'))
            return
        var startEvent = $.Event('hide.bs.collapse')
        this.$element.trigger(startEvent)
        if (startEvent.isDefaultPrevented())
            return
        var dimension = this.dimension()
        this.$element[dimension](this.$element[dimension]())[0].offsetHeight
        this.$element.addClass('collapsing').removeClass('collapse in').attr('aria-expanded', false)
        this.$trigger.addClass('collapsed').attr('aria-expanded', false)
        this.transitioning = 1
        var complete = function() {
            this.transitioning = 0
            this.$element.removeClass('collapsing').addClass('collapse').trigger('hidden.bs.collapse')
        }
        if (!$.support.transition)
            return complete.call(this)
        this.$element[dimension](0).one('bsTransitionEnd', $.proxy(complete, this)).emulateTransitionEnd(Collapse.TRANSITION_DURATION)
    }
    Collapse.prototype.toggle = function() {
        this[this.$element.hasClass('in') ? 'hide' : 'show']()
    }
    Collapse.prototype.getParent = function() {
        return $(this.options.parent).find('[data-toggle="collapse"][data-parent="' + this.options.parent + '"]').each($.proxy(function(i, element) {
            var $element = $(element)
            this.addAriaAndCollapsedClass(getTargetFromTrigger($element), $element)
        }, this)).end()
    }
    Collapse.prototype.addAriaAndCollapsedClass = function($element, $trigger) {
        var isOpen = $element.hasClass('in')
        $element.attr('aria-expanded', isOpen)
        $trigger.toggleClass('collapsed', !isOpen).attr('aria-expanded', isOpen)
    }
    function getTargetFromTrigger($trigger) {
        var href
        var target = $trigger.attr('data-target') || (href = $trigger.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '')
        return $(target)
    }
    function Plugin(option) {
        return this.each(function() {
            var $this = $(this)
            var data = $this.data('bs.collapse')
            var options = $.extend({}, Collapse.DEFAULTS, $this.data(), typeof option == 'object' && option)
            if (!data && options.toggle && /show|hide/.test(option))
                options.toggle = false
            if (!data)
                $this.data('bs.collapse', (data = new Collapse(this,options)))
            if (typeof option == 'string')
                data[option]()
        })
    }
    var old = $.fn.collapse
    $.fn.collapse = Plugin
    $.fn.collapse.Constructor = Collapse
    $.fn.collapse.noConflict = function() {
        $.fn.collapse = old
        return this
    }
    $(document).on('click.bs.collapse.data-api', '[data-toggle="collapse"]', function(e) {
        var $this = $(this)
        if (!$this.attr('data-target'))
            e.preventDefault()
        var $target = getTargetFromTrigger($this)
        var data = $target.data('bs.collapse')
        var option = data ? 'toggle' : $this.data()
        Plugin.call($target, option)
    })
}(jQuery);
;
/****** FILE: themes/bata/bower_components/bootstrap/js/dropdown.js *****/

+function($) {
    'use strict';
    var backdrop = '.dropdown-backdrop'
    var toggle = '[data-toggle="dropdown"]'
    var Dropdown = function(element) {
        $(element).on('click.bs.dropdown', this.toggle)
    }
    Dropdown.VERSION = '3.3.7'
    function getParent($this) {
        var selector = $this.attr('data-target')
        if (!selector) {
            selector = $this.attr('href')
            selector = selector && /#[A-Za-z]/.test(selector) && selector.replace(/.*(?=#[^\s]*$)/, '')
        }
        var $parent = selector && $(selector)
        return $parent && $parent.length ? $parent : $this.parent()
    }
    function clearMenus(e) {
        if (e && e.which === 3)
            return
        $(backdrop).remove()
        $(toggle).each(function() {
            var $this = $(this)
            var $parent = getParent($this)
            var relatedTarget = {
                relatedTarget: this
            }
            if (!$parent.hasClass('open'))
                return
            if (e && e.type == 'click' && /input|textarea/i.test(e.target.tagName) && $.contains($parent[0], e.target))
                return
            $parent.trigger(e = $.Event('hide.bs.dropdown', relatedTarget))
            if (e.isDefaultPrevented())
                return
            $this.attr('aria-expanded', 'false')
            $parent.removeClass('open').trigger($.Event('hidden.bs.dropdown', relatedTarget))
        })
    }
    Dropdown.prototype.toggle = function(e) {
        var $this = $(this)
        if ($this.is('.disabled, :disabled'))
            return
        var $parent = getParent($this)
        var isActive = $parent.hasClass('open')
        clearMenus()
        if (!isActive) {
            if ('ontouchstart'in document.documentElement && !$parent.closest('.navbar-nav').length) {
                $(document.createElement('div')).addClass('dropdown-backdrop').insertAfter($(this)).on('click', clearMenus)
            }
            var relatedTarget = {
                relatedTarget: this
            }
            $parent.trigger(e = $.Event('show.bs.dropdown', relatedTarget))
            if (e.isDefaultPrevented())
                return
            $this.trigger('focus').attr('aria-expanded', 'true')
            $parent.toggleClass('open').trigger($.Event('shown.bs.dropdown', relatedTarget))
        }
        return false
    }
    Dropdown.prototype.keydown = function(e) {
        if (!/(38|40|27|32)/.test(e.which) || /input|textarea/i.test(e.target.tagName))
            return
        var $this = $(this)
        e.preventDefault()
        e.stopPropagation()
        if ($this.is('.disabled, :disabled'))
            return
        var $parent = getParent($this)
        var isActive = $parent.hasClass('open')
        if (!isActive && e.which != 27 || isActive && e.which == 27) {
            if (e.which == 27)
                $parent.find(toggle).trigger('focus')
            return $this.trigger('click')
        }
        var desc = ' li:not(.disabled):visible a'
        var $items = $parent.find('.dropdown-menu' + desc)
        if (!$items.length)
            return
        var index = $items.index(e.target)
        if (e.which == 38 && index > 0)
            index--
        if (e.which == 40 && index < $items.length - 1)
            index++
        if (!~index)
            index = 0
        $items.eq(index).trigger('focus')
    }
    function Plugin(option) {
        return this.each(function() {
            var $this = $(this)
            var data = $this.data('bs.dropdown')
            if (!data)
                $this.data('bs.dropdown', (data = new Dropdown(this)))
            if (typeof option == 'string')
                data[option].call($this)
        })
    }
    var old = $.fn.dropdown
    $.fn.dropdown = Plugin
    $.fn.dropdown.Constructor = Dropdown
    $.fn.dropdown.noConflict = function() {
        $.fn.dropdown = old
        return this
    }
    $(document).on('click.bs.dropdown.data-api', clearMenus).on('click.bs.dropdown.data-api', '.dropdown form', function(e) {
        e.stopPropagation()
    }).on('click.bs.dropdown.data-api', toggle, Dropdown.prototype.toggle).on('keydown.bs.dropdown.data-api', toggle, Dropdown.prototype.keydown).on('keydown.bs.dropdown.data-api', '.dropdown-menu', Dropdown.prototype.keydown)
}(jQuery);
;
/****** FILE: themes/bata/bower_components/bootstrap/js/modal.js *****/

+function($) {
    'use strict';
    var Modal = function(element, options) {
        this.options = options
        this.$body = $(document.body)
        this.$element = $(element)
        this.$dialog = this.$element.find('.modal-dialog')
        this.$backdrop = null
        this.isShown = null
        this.originalBodyPad = null
        this.scrollbarWidth = 0
        this.ignoreBackdropClick = false
        if (this.options.remote) {
            this.$element.find('.modal-content').load(this.options.remote, $.proxy(function() {
                this.$element.trigger('loaded.bs.modal')
            }, this))
        }
    }
    Modal.VERSION = '3.3.7'
    Modal.TRANSITION_DURATION = 300
    Modal.BACKDROP_TRANSITION_DURATION = 150
    Modal.DEFAULTS = {
        backdrop: true,
        keyboard: true,
        show: true
    }
    Modal.prototype.toggle = function(_relatedTarget) {
        return this.isShown ? this.hide() : this.show(_relatedTarget)
    }
    Modal.prototype.show = function(_relatedTarget) {
        var that = this
        var e = $.Event('show.bs.modal', {
            relatedTarget: _relatedTarget
        })
        this.$element.trigger(e)
        if (this.isShown || e.isDefaultPrevented())
            return
        this.isShown = true
        this.checkScrollbar()
        this.setScrollbar()
        this.$body.addClass('modal-open')
        this.escape()
        this.resize()
        this.$element.on('click.dismiss.bs.modal', '[data-dismiss="modal"]', $.proxy(this.hide, this))
        this.$dialog.on('mousedown.dismiss.bs.modal', function() {
            that.$element.one('mouseup.dismiss.bs.modal', function(e) {
                if ($(e.target).is(that.$element))
                    that.ignoreBackdropClick = true
            })
        })
        this.backdrop(function() {
            var transition = $.support.transition && that.$element.hasClass('fade')
            if (!that.$element.parent().length) {
                that.$element.appendTo(that.$body)
            }
            that.$element.show().scrollTop(0)
            that.adjustDialog()
            if (transition) {
                that.$element[0].offsetWidth
            }
            that.$element.addClass('in')
            that.enforceFocus()
            var e = $.Event('shown.bs.modal', {
                relatedTarget: _relatedTarget
            })
            transition ? that.$dialog.one('bsTransitionEnd', function() {
                that.$element.trigger('focus').trigger(e)
            }).emulateTransitionEnd(Modal.TRANSITION_DURATION) : that.$element.trigger('focus').trigger(e)
        })
    }
    Modal.prototype.hide = function(e) {
        if (e)
            e.preventDefault()
        e = $.Event('hide.bs.modal')
        this.$element.trigger(e)
        if (!this.isShown || e.isDefaultPrevented())
            return
        this.isShown = false
        this.escape()
        this.resize()
        $(document).off('focusin.bs.modal')
        this.$element.removeClass('in').off('click.dismiss.bs.modal').off('mouseup.dismiss.bs.modal')
        this.$dialog.off('mousedown.dismiss.bs.modal')
        $.support.transition && this.$element.hasClass('fade') ? this.$element.one('bsTransitionEnd', $.proxy(this.hideModal, this)).emulateTransitionEnd(Modal.TRANSITION_DURATION) : this.hideModal()
    }
    Modal.prototype.enforceFocus = function() {
        $(document).off('focusin.bs.modal').on('focusin.bs.modal', $.proxy(function(e) {
            if (document !== e.target && this.$element[0] !== e.target && !this.$element.has(e.target).length) {
                this.$element.trigger('focus')
            }
        }, this))
    }
    Modal.prototype.escape = function() {
        if (this.isShown && this.options.keyboard) {
            this.$element.on('keydown.dismiss.bs.modal', $.proxy(function(e) {
                e.which == 27 && this.hide()
            }, this))
        } else if (!this.isShown) {
            this.$element.off('keydown.dismiss.bs.modal')
        }
    }
    Modal.prototype.resize = function() {
        if (this.isShown) {
            $(window).on('resize.bs.modal', $.proxy(this.handleUpdate, this))
        } else {
            $(window).off('resize.bs.modal')
        }
    }
    Modal.prototype.hideModal = function() {
        var that = this
        this.$element.hide()
        this.backdrop(function() {
            that.$body.removeClass('modal-open')
            that.resetAdjustments()
            that.resetScrollbar()
            that.$element.trigger('hidden.bs.modal')
        })
    }
    Modal.prototype.removeBackdrop = function() {
        this.$backdrop && this.$backdrop.remove()
        this.$backdrop = null
    }
    Modal.prototype.backdrop = function(callback) {
        var that = this
        var animate = this.$element.hasClass('fade') ? 'fade' : ''
        if (this.isShown && this.options.backdrop) {
            var doAnimate = $.support.transition && animate
            this.$backdrop = $(document.createElement('div')).addClass('modal-backdrop ' + animate).appendTo(this.$body)
            this.$element.on('click.dismiss.bs.modal', $.proxy(function(e) {
                if (this.ignoreBackdropClick) {
                    this.ignoreBackdropClick = false
                    return
                }
                if (e.target !== e.currentTarget)
                    return
                this.options.backdrop == 'static' ? this.$element[0].focus() : this.hide()
            }, this))
            if (doAnimate)
                this.$backdrop[0].offsetWidth
            this.$backdrop.addClass('in')
            if (!callback)
                return
            doAnimate ? this.$backdrop.one('bsTransitionEnd', callback).emulateTransitionEnd(Modal.BACKDROP_TRANSITION_DURATION) : callback()
        } else if (!this.isShown && this.$backdrop) {
            this.$backdrop.removeClass('in')
            var callbackRemove = function() {
                that.removeBackdrop()
                callback && callback()
            }
            $.support.transition && this.$element.hasClass('fade') ? this.$backdrop.one('bsTransitionEnd', callbackRemove).emulateTransitionEnd(Modal.BACKDROP_TRANSITION_DURATION) : callbackRemove()
        } else if (callback) {
            callback()
        }
    }
    Modal.prototype.handleUpdate = function() {
        this.adjustDialog()
    }
    Modal.prototype.adjustDialog = function() {
        var modalIsOverflowing = this.$element[0].scrollHeight > document.documentElement.clientHeight
        this.$element.css({
            paddingLeft: !this.bodyIsOverflowing && modalIsOverflowing ? this.scrollbarWidth : '',
            paddingRight: this.bodyIsOverflowing && !modalIsOverflowing ? this.scrollbarWidth : ''
        })
    }
    Modal.prototype.resetAdjustments = function() {
        this.$element.css({
            paddingLeft: '',
            paddingRight: ''
        })
    }
    Modal.prototype.checkScrollbar = function() {
        var fullWindowWidth = window.innerWidth
        if (!fullWindowWidth) {
            var documentElementRect = document.documentElement.getBoundingClientRect()
            fullWindowWidth = documentElementRect.right - Math.abs(documentElementRect.left)
        }
        this.bodyIsOverflowing = document.body.clientWidth < fullWindowWidth
        this.scrollbarWidth = this.measureScrollbar()
    }
    Modal.prototype.setScrollbar = function() {
        var bodyPad = parseInt((this.$body.css('padding-right') || 0), 10)
        this.originalBodyPad = document.body.style.paddingRight || ''
        if (this.bodyIsOverflowing)
            this.$body.css('padding-right', bodyPad + this.scrollbarWidth)
    }
    Modal.prototype.resetScrollbar = function() {
        this.$body.css('padding-right', this.originalBodyPad)
    }
    Modal.prototype.measureScrollbar = function() {
        var scrollDiv = document.createElement('div')
        scrollDiv.className = 'modal-scrollbar-measure'
        this.$body.append(scrollDiv)
        var scrollbarWidth = scrollDiv.offsetWidth - scrollDiv.clientWidth
        this.$body[0].removeChild(scrollDiv)
        return scrollbarWidth
    }
    function Plugin(option, _relatedTarget) {
        return this.each(function() {
            var $this = $(this)
            var data = $this.data('bs.modal')
            var options = $.extend({}, Modal.DEFAULTS, $this.data(), typeof option == 'object' && option)
            if (!data)
                $this.data('bs.modal', (data = new Modal(this,options)))
            if (typeof option == 'string')
                data[option](_relatedTarget)
            else if (options.show)
                data.show(_relatedTarget)
        })
    }
    var old = $.fn.modal
    $.fn.modal = Plugin
    $.fn.modal.Constructor = Modal
    $.fn.modal.noConflict = function() {
        $.fn.modal = old
        return this
    }
    $(document).on('click.bs.modal.data-api', '[data-toggle="modal"]', function(e) {
        var $this = $(this)
        var href = $this.attr('href')
        var $target = $($this.attr('data-target') || (href && href.replace(/.*(?=#[^\s]+$)/, '')))
        var option = $target.data('bs.modal') ? 'toggle' : $.extend({
            remote: !/#/.test(href) && href
        }, $target.data(), $this.data())
        if ($this.is('a'))
            e.preventDefault()
        $target.one('show.bs.modal', function(showEvent) {
            if (showEvent.isDefaultPrevented())
                return
            $target.one('hidden.bs.modal', function() {
                $this.is(':visible') && $this.trigger('focus')
            })
        })
        Plugin.call($target, option, this)
    })
}(jQuery);
;
/****** FILE: themes/bata/bower_components/bootstrap/js/tooltip.js *****/

+function($) {
    'use strict';
    var Tooltip = function(element, options) {
        this.type = null
        this.options = null
        this.enabled = null
        this.timeout = null
        this.hoverState = null
        this.$element = null
        this.inState = null
        this.init('tooltip', element, options)
    }
    Tooltip.VERSION = '3.3.7'
    Tooltip.TRANSITION_DURATION = 150
    Tooltip.DEFAULTS = {
        animation: true,
        placement: 'top',
        selector: false,
        template: '<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
        trigger: 'hover focus',
        title: '',
        delay: 0,
        html: false,
        container: false,
        viewport: {
            selector: 'body',
            padding: 0
        }
    }
    Tooltip.prototype.init = function(type, element, options) {
        this.enabled = true
        this.type = type
        this.$element = $(element)
        this.options = this.getOptions(options)
        this.$viewport = this.options.viewport && $($.isFunction(this.options.viewport) ? this.options.viewport.call(this, this.$element) : (this.options.viewport.selector || this.options.viewport))
        this.inState = {
            click: false,
            hover: false,
            focus: false
        }
        if (this.$element[0]instanceof document.constructor && !this.options.selector) {
            throw new Error('`selector` option must be specified when initializing ' + this.type + ' on the window.document object!')
        }
        var triggers = this.options.trigger.split(' ')
        for (var i = triggers.length; i--; ) {
            var trigger = triggers[i]
            if (trigger == 'click') {
                this.$element.on('click.' + this.type, this.options.selector, $.proxy(this.toggle, this))
            } else if (trigger != 'manual') {
                var eventIn = trigger == 'hover' ? 'mouseenter' : 'focusin'
                var eventOut = trigger == 'hover' ? 'mouseleave' : 'focusout'
                this.$element.on(eventIn + '.' + this.type, this.options.selector, $.proxy(this.enter, this))
                this.$element.on(eventOut + '.' + this.type, this.options.selector, $.proxy(this.leave, this))
            }
        }
        this.options.selector ? (this._options = $.extend({}, this.options, {
            trigger: 'manual',
            selector: ''
        })) : this.fixTitle()
    }
    Tooltip.prototype.getDefaults = function() {
        return Tooltip.DEFAULTS
    }
    Tooltip.prototype.getOptions = function(options) {
        options = $.extend({}, this.getDefaults(), this.$element.data(), options)
        if (options.delay && typeof options.delay == 'number') {
            options.delay = {
                show: options.delay,
                hide: options.delay
            }
        }
        return options
    }
    Tooltip.prototype.getDelegateOptions = function() {
        var options = {}
        var defaults = this.getDefaults()
        this._options && $.each(this._options, function(key, value) {
            if (defaults[key] != value)
                options[key] = value
        })
        return options
    }
    Tooltip.prototype.enter = function(obj) {
        var self = obj instanceof this.constructor ? obj : $(obj.currentTarget).data('bs.' + this.type)
        if (!self) {
            self = new this.constructor(obj.currentTarget,this.getDelegateOptions())
            $(obj.currentTarget).data('bs.' + this.type, self)
        }
        if (obj instanceof $.Event) {
            self.inState[obj.type == 'focusin' ? 'focus' : 'hover'] = true
        }
        if (self.tip().hasClass('in') || self.hoverState == 'in') {
            self.hoverState = 'in'
            return
        }
        clearTimeout(self.timeout)
        self.hoverState = 'in'
        if (!self.options.delay || !self.options.delay.show)
            return self.show()
        self.timeout = setTimeout(function() {
            if (self.hoverState == 'in')
                self.show()
        }, self.options.delay.show)
    }
    Tooltip.prototype.isInStateTrue = function() {
        for (var key in this.inState) {
            if (this.inState[key])
                return true
        }
        return false
    }
    Tooltip.prototype.leave = function(obj) {
        var self = obj instanceof this.constructor ? obj : $(obj.currentTarget).data('bs.' + this.type)
        if (!self) {
            self = new this.constructor(obj.currentTarget,this.getDelegateOptions())
            $(obj.currentTarget).data('bs.' + this.type, self)
        }
        if (obj instanceof $.Event) {
            self.inState[obj.type == 'focusout' ? 'focus' : 'hover'] = false
        }
        if (self.isInStateTrue())
            return
        clearTimeout(self.timeout)
        self.hoverState = 'out'
        if (!self.options.delay || !self.options.delay.hide)
            return self.hide()
        self.timeout = setTimeout(function() {
            if (self.hoverState == 'out')
                self.hide()
        }, self.options.delay.hide)
    }
    Tooltip.prototype.show = function() {
        var e = $.Event('show.bs.' + this.type)
        if (this.hasContent() && this.enabled) {
            this.$element.trigger(e)
            var inDom = $.contains(this.$element[0].ownerDocument.documentElement, this.$element[0])
            if (e.isDefaultPrevented() || !inDom)
                return
            var that = this
            var $tip = this.tip()
            var tipId = this.getUID(this.type)
            this.setContent()
            $tip.attr('id', tipId)
            this.$element.attr('aria-describedby', tipId)
            if (this.options.animation)
                $tip.addClass('fade')
            var placement = typeof this.options.placement == 'function' ? this.options.placement.call(this, $tip[0], this.$element[0]) : this.options.placement
            var autoToken = /\s?auto?\s?/i
            var autoPlace = autoToken.test(placement)
            if (autoPlace)
                placement = placement.replace(autoToken, '') || 'top'
            $tip.detach().css({
                top: 0,
                left: 0,
                display: 'block'
            }).addClass(placement).data('bs.' + this.type, this)
            this.options.container ? $tip.appendTo(this.options.container) : $tip.insertAfter(this.$element)
            this.$element.trigger('inserted.bs.' + this.type)
            var pos = this.getPosition()
            var actualWidth = $tip[0].offsetWidth
            var actualHeight = $tip[0].offsetHeight
            if (autoPlace) {
                var orgPlacement = placement
                var viewportDim = this.getPosition(this.$viewport)
                placement = placement == 'bottom' && pos.bottom + actualHeight > viewportDim.bottom ? 'top' : placement == 'top' && pos.top - actualHeight < viewportDim.top ? 'bottom' : placement == 'right' && pos.right + actualWidth > viewportDim.width ? 'left' : placement == 'left' && pos.left - actualWidth < viewportDim.left ? 'right' : placement
                $tip.removeClass(orgPlacement).addClass(placement)
            }
            var calculatedOffset = this.getCalculatedOffset(placement, pos, actualWidth, actualHeight)
            this.applyPlacement(calculatedOffset, placement)
            var complete = function() {
                var prevHoverState = that.hoverState
                that.$element.trigger('shown.bs.' + that.type)
                that.hoverState = null
                if (prevHoverState == 'out')
                    that.leave(that)
            }
            $.support.transition && this.$tip.hasClass('fade') ? $tip.one('bsTransitionEnd', complete).emulateTransitionEnd(Tooltip.TRANSITION_DURATION) : complete()
        }
    }
    Tooltip.prototype.applyPlacement = function(offset, placement) {
        var $tip = this.tip()
        var width = $tip[0].offsetWidth
        var height = $tip[0].offsetHeight
        var marginTop = parseInt($tip.css('margin-top'), 10)
        var marginLeft = parseInt($tip.css('margin-left'), 10)
        if (isNaN(marginTop))
            marginTop = 0
        if (isNaN(marginLeft))
            marginLeft = 0
        offset.top += marginTop
        offset.left += marginLeft
        $.offset.setOffset($tip[0], $.extend({
            using: function(props) {
                $tip.css({
                    top: Math.round(props.top),
                    left: Math.round(props.left)
                })
            }
        }, offset), 0)
        $tip.addClass('in')
        var actualWidth = $tip[0].offsetWidth
        var actualHeight = $tip[0].offsetHeight
        if (placement == 'top' && actualHeight != height) {
            offset.top = offset.top + height - actualHeight
        }
        var delta = this.getViewportAdjustedDelta(placement, offset, actualWidth, actualHeight)
        if (delta.left)
            offset.left += delta.left
        else
            offset.top += delta.top
        var isVertical = /top|bottom/.test(placement)
        var arrowDelta = isVertical ? delta.left * 2 - width + actualWidth : delta.top * 2 - height + actualHeight
        var arrowOffsetPosition = isVertical ? 'offsetWidth' : 'offsetHeight'
        $tip.offset(offset)
        this.replaceArrow(arrowDelta, $tip[0][arrowOffsetPosition], isVertical)
    }
    Tooltip.prototype.replaceArrow = function(delta, dimension, isVertical) {
        this.arrow().css(isVertical ? 'left' : 'top', 50 * (1 - delta / dimension) + '%').css(isVertical ? 'top' : 'left', '')
    }
    Tooltip.prototype.setContent = function() {
        var $tip = this.tip()
        var title = this.getTitle()
        $tip.find('.tooltip-inner')[this.options.html ? 'html' : 'text'](title)
        $tip.removeClass('fade in top bottom left right')
    }
    Tooltip.prototype.hide = function(callback) {
        var that = this
        var $tip = $(this.$tip)
        var e = $.Event('hide.bs.' + this.type)
        function complete() {
            if (that.hoverState != 'in')
                $tip.detach()
            if (that.$element) {
                that.$element.removeAttr('aria-describedby').trigger('hidden.bs.' + that.type)
            }
            callback && callback()
        }
        this.$element.trigger(e)
        if (e.isDefaultPrevented())
            return
        $tip.removeClass('in')
        $.support.transition && $tip.hasClass('fade') ? $tip.one('bsTransitionEnd', complete).emulateTransitionEnd(Tooltip.TRANSITION_DURATION) : complete()
        this.hoverState = null
        return this
    }
    Tooltip.prototype.fixTitle = function() {
        var $e = this.$element
        if ($e.attr('title') || typeof $e.attr('data-original-title') != 'string') {
            $e.attr('data-original-title', $e.attr('title') || '').attr('title', '')
        }
    }
    Tooltip.prototype.hasContent = function() {
        return this.getTitle()
    }
    Tooltip.prototype.getPosition = function($element) {
        $element = $element || this.$element
        var el = $element[0]
        var isBody = el.tagName == 'BODY'
        var elRect = el.getBoundingClientRect()
        if (elRect.width == null) {
            elRect = $.extend({}, elRect, {
                width: elRect.right - elRect.left,
                height: elRect.bottom - elRect.top
            })
        }
        var isSvg = window.SVGElement && el instanceof window.SVGElement
        var elOffset = isBody ? {
            top: 0,
            left: 0
        } : (isSvg ? null : $element.offset())
        var scroll = {
            scroll: isBody ? document.documentElement.scrollTop || document.body.scrollTop : $element.scrollTop()
        }
        var outerDims = isBody ? {
            width: $(window).width(),
            height: $(window).height()
        } : null
        return $.extend({}, elRect, scroll, outerDims, elOffset)
    }
    Tooltip.prototype.getCalculatedOffset = function(placement, pos, actualWidth, actualHeight) {
        return placement == 'bottom' ? {
            top: pos.top + pos.height,
            left: pos.left + pos.width / 2 - actualWidth / 2
        } : placement == 'top' ? {
            top: pos.top - actualHeight,
            left: pos.left + pos.width / 2 - actualWidth / 2
        } : placement == 'left' ? {
            top: pos.top + pos.height / 2 - actualHeight / 2,
            left: pos.left - actualWidth
        } : {
            top: pos.top + pos.height / 2 - actualHeight / 2,
            left: pos.left + pos.width
        }
    }
    Tooltip.prototype.getViewportAdjustedDelta = function(placement, pos, actualWidth, actualHeight) {
        var delta = {
            top: 0,
            left: 0
        }
        if (!this.$viewport)
            return delta
        var viewportPadding = this.options.viewport && this.options.viewport.padding || 0
        var viewportDimensions = this.getPosition(this.$viewport)
        if (/right|left/.test(placement)) {
            var topEdgeOffset = pos.top - viewportPadding - viewportDimensions.scroll
            var bottomEdgeOffset = pos.top + viewportPadding - viewportDimensions.scroll + actualHeight
            if (topEdgeOffset < viewportDimensions.top) {
                delta.top = viewportDimensions.top - topEdgeOffset
            } else if (bottomEdgeOffset > viewportDimensions.top + viewportDimensions.height) {
                delta.top = viewportDimensions.top + viewportDimensions.height - bottomEdgeOffset
            }
        } else {
            var leftEdgeOffset = pos.left - viewportPadding
            var rightEdgeOffset = pos.left + viewportPadding + actualWidth
            if (leftEdgeOffset < viewportDimensions.left) {
                delta.left = viewportDimensions.left - leftEdgeOffset
            } else if (rightEdgeOffset > viewportDimensions.right) {
                delta.left = viewportDimensions.left + viewportDimensions.width - rightEdgeOffset
            }
        }
        return delta
    }
    Tooltip.prototype.getTitle = function() {
        var title
        var $e = this.$element
        var o = this.options
        title = $e.attr('data-original-title') || (typeof o.title == 'function' ? o.title.call($e[0]) : o.title)
        return title
    }
    Tooltip.prototype.getUID = function(prefix) {
        do
            prefix += ~~(Math.random() * 1000000)
        while (document.getElementById(prefix))return prefix
    }
    Tooltip.prototype.tip = function() {
        if (!this.$tip) {
            this.$tip = $(this.options.template)
            if (this.$tip.length != 1) {
                throw new Error(this.type + ' `template` option must consist of exactly 1 top-level element!')
            }
        }
        return this.$tip
    }
    Tooltip.prototype.arrow = function() {
        return (this.$arrow = this.$arrow || this.tip().find('.tooltip-arrow'))
    }
    Tooltip.prototype.enable = function() {
        this.enabled = true
    }
    Tooltip.prototype.disable = function() {
        this.enabled = false
    }
    Tooltip.prototype.toggleEnabled = function() {
        this.enabled = !this.enabled
    }
    Tooltip.prototype.toggle = function(e) {
        var self = this
        if (e) {
            self = $(e.currentTarget).data('bs.' + this.type)
            if (!self) {
                self = new this.constructor(e.currentTarget,this.getDelegateOptions())
                $(e.currentTarget).data('bs.' + this.type, self)
            }
        }
        if (e) {
            self.inState.click = !self.inState.click
            if (self.isInStateTrue())
                self.enter(self)
            else
                self.leave(self)
        } else {
            self.tip().hasClass('in') ? self.leave(self) : self.enter(self)
        }
    }
    Tooltip.prototype.destroy = function() {
        var that = this
        clearTimeout(this.timeout)
        this.hide(function() {
            that.$element.off('.' + that.type).removeData('bs.' + that.type)
            if (that.$tip) {
                that.$tip.detach()
            }
            that.$tip = null
            that.$arrow = null
            that.$viewport = null
            that.$element = null
        })
    }
    function Plugin(option) {
        return this.each(function() {
            var $this = $(this)
            var data = $this.data('bs.tooltip')
            var options = typeof option == 'object' && option
            if (!data && /destroy|hide/.test(option))
                return
            if (!data)
                $this.data('bs.tooltip', (data = new Tooltip(this,options)))
            if (typeof option == 'string')
                data[option]()
        })
    }
    var old = $.fn.tooltip
    $.fn.tooltip = Plugin
    $.fn.tooltip.Constructor = Tooltip
    $.fn.tooltip.noConflict = function() {
        $.fn.tooltip = old
        return this
    }
}(jQuery);
;
/****** FILE: themes/bata/bower_components/bootstrap/js/popover.js *****/

+function($) {
    'use strict';
    var Popover = function(element, options) {
        this.init('popover', element, options)
    }
    if (!$.fn.tooltip)
        throw new Error('Popover requires tooltip.js')
    Popover.VERSION = '3.3.7'
    Popover.DEFAULTS = $.extend({}, $.fn.tooltip.Constructor.DEFAULTS, {
        placement: 'right',
        trigger: 'click',
        content: '',
        template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
    })
    Popover.prototype = $.extend({}, $.fn.tooltip.Constructor.prototype)
    Popover.prototype.constructor = Popover
    Popover.prototype.getDefaults = function() {
        return Popover.DEFAULTS
    }
    Popover.prototype.setContent = function() {
        var $tip = this.tip()
        var title = this.getTitle()
        var content = this.getContent()
        $tip.find('.popover-title')[this.options.html ? 'html' : 'text'](title)
        $tip.find('.popover-content').children().detach().end()[this.options.html ? (typeof content == 'string' ? 'html' : 'append') : 'text'](content)
        $tip.removeClass('fade top bottom left right in')
        if (!$tip.find('.popover-title').html())
            $tip.find('.popover-title').hide()
    }
    Popover.prototype.hasContent = function() {
        return this.getTitle() || this.getContent()
    }
    Popover.prototype.getContent = function() {
        var $e = this.$element
        var o = this.options
        return $e.attr('data-content') || (typeof o.content == 'function' ? o.content.call($e[0]) : o.content)
    }
    Popover.prototype.arrow = function() {
        return (this.$arrow = this.$arrow || this.tip().find('.arrow'))
    }
    function Plugin(option) {
        return this.each(function() {
            var $this = $(this)
            var data = $this.data('bs.popover')
            var options = typeof option == 'object' && option
            if (!data && /destroy|hide/.test(option))
                return
            if (!data)
                $this.data('bs.popover', (data = new Popover(this,options)))
            if (typeof option == 'string')
                data[option]()
        })
    }
    var old = $.fn.popover
    $.fn.popover = Plugin
    $.fn.popover.Constructor = Popover
    $.fn.popover.noConflict = function() {
        $.fn.popover = old
        return this
    }
}(jQuery);
;
/****** FILE: themes/bata/bower_components/bootstrap/js/scrollspy.js *****/

+function($) {
    'use strict';
    function ScrollSpy(element, options) {
        this.$body = $(document.body)
        this.$scrollElement = $(element).is(document.body) ? $(window) : $(element)
        this.options = $.extend({}, ScrollSpy.DEFAULTS, options)
        this.selector = (this.options.target || '') + ' .nav li > a'
        this.offsets = []
        this.targets = []
        this.activeTarget = null
        this.scrollHeight = 0
        this.$scrollElement.on('scroll.bs.scrollspy', $.proxy(this.process, this))
        this.refresh()
        this.process()
    }
    ScrollSpy.VERSION = '3.3.7'
    ScrollSpy.DEFAULTS = {
        offset: 10
    }
    ScrollSpy.prototype.getScrollHeight = function() {
        return this.$scrollElement[0].scrollHeight || Math.max(this.$body[0].scrollHeight, document.documentElement.scrollHeight)
    }
    ScrollSpy.prototype.refresh = function() {
        var that = this
        var offsetMethod = 'offset'
        var offsetBase = 0
        this.offsets = []
        this.targets = []
        this.scrollHeight = this.getScrollHeight()
        if (!$.isWindow(this.$scrollElement[0])) {
            offsetMethod = 'position'
            offsetBase = this.$scrollElement.scrollTop()
        }
        this.$body.find(this.selector).map(function() {
            var $el = $(this)
            var href = $el.data('target') || $el.attr('href')
            var $href = /^#./.test(href) && $(href)
            return ($href && $href.length && $href.is(':visible') && [[$href[offsetMethod]().top + offsetBase, href]]) || null
        }).sort(function(a, b) {
            return a[0] - b[0]
        }).each(function() {
            that.offsets.push(this[0])
            that.targets.push(this[1])
        })
    }
    ScrollSpy.prototype.process = function() {
        var scrollTop = this.$scrollElement.scrollTop() + this.options.offset
        var scrollHeight = this.getScrollHeight()
        var maxScroll = this.options.offset + scrollHeight - this.$scrollElement.height()
        var offsets = this.offsets
        var targets = this.targets
        var activeTarget = this.activeTarget
        var i
        if (this.scrollHeight != scrollHeight) {
            this.refresh()
        }
        if (scrollTop >= maxScroll) {
            return activeTarget != (i = targets[targets.length - 1]) && this.activate(i)
        }
        if (activeTarget && scrollTop < offsets[0]) {
            this.activeTarget = null
            return this.clear()
        }
        for (i = offsets.length; i--; ) {
            activeTarget != targets[i] && scrollTop >= offsets[i] && (offsets[i + 1] === undefined || scrollTop < offsets[i + 1]) && this.activate(targets[i])
        }
    }
    ScrollSpy.prototype.activate = function(target) {
        this.activeTarget = target
        this.clear()
        var selector = this.selector + '[data-target="' + target + '"],' + this.selector + '[href="' + target + '"]'
        var active = $(selector).parents('li').addClass('active')
        if (active.parent('.dropdown-menu').length) {
            active = active.closest('li.dropdown').addClass('active')
        }
        active.trigger('activate.bs.scrollspy')
    }
    ScrollSpy.prototype.clear = function() {
        $(this.selector).parentsUntil(this.options.target, '.active').removeClass('active')
    }
    function Plugin(option) {
        return this.each(function() {
            var $this = $(this)
            var data = $this.data('bs.scrollspy')
            var options = typeof option == 'object' && option
            if (!data)
                $this.data('bs.scrollspy', (data = new ScrollSpy(this,options)))
            if (typeof option == 'string')
                data[option]()
        })
    }
    var old = $.fn.scrollspy
    $.fn.scrollspy = Plugin
    $.fn.scrollspy.Constructor = ScrollSpy
    $.fn.scrollspy.noConflict = function() {
        $.fn.scrollspy = old
        return this
    }
    $(window).on('load.bs.scrollspy.data-api', function() {
        $('[data-spy="scroll"]').each(function() {
            var $spy = $(this)
            Plugin.call($spy, $spy.data())
        })
    })
}(jQuery);
;
/****** FILE: themes/bata/bower_components/bootstrap/js/tab.js *****/

+function($) {
    'use strict';
    var Tab = function(element) {
        this.element = $(element)
    }
    Tab.VERSION = '3.3.7'
    Tab.TRANSITION_DURATION = 150
    Tab.prototype.show = function() {
        var $this = this.element
        var $ul = $this.closest('ul:not(.dropdown-menu)')
        var selector = $this.data('target')
        if (!selector) {
            selector = $this.attr('href')
            selector = selector && selector.replace(/.*(?=#[^\s]*$)/, '')
        }
        if ($this.parent('li').hasClass('active'))
            return
        var $previous = $ul.find('.active:last a')
        var hideEvent = $.Event('hide.bs.tab', {
            relatedTarget: $this[0]
        })
        var showEvent = $.Event('show.bs.tab', {
            relatedTarget: $previous[0]
        })
        $previous.trigger(hideEvent)
        $this.trigger(showEvent)
        if (showEvent.isDefaultPrevented() || hideEvent.isDefaultPrevented())
            return
        var $target = $(selector)
        this.activate($this.closest('li'), $ul)
        this.activate($target, $target.parent(), function() {
            $previous.trigger({
                type: 'hidden.bs.tab',
                relatedTarget: $this[0]
            })
            $this.trigger({
                type: 'shown.bs.tab',
                relatedTarget: $previous[0]
            })
        })
    }
    Tab.prototype.activate = function(element, container, callback) {
        var $active = container.find('> .active')
        var transition = callback && $.support.transition && ($active.length && $active.hasClass('fade') || !!container.find('> .fade').length)
        function next() {
            $active.removeClass('active').find('> .dropdown-menu > .active').removeClass('active').end().find('[data-toggle="tab"]').attr('aria-expanded', false)
            element.addClass('active').find('[data-toggle="tab"]').attr('aria-expanded', true)
            if (transition) {
                element[0].offsetWidth
                element.addClass('in')
            } else {
                element.removeClass('fade')
            }
            if (element.parent('.dropdown-menu').length) {
                element.closest('li.dropdown').addClass('active').end().find('[data-toggle="tab"]').attr('aria-expanded', true)
            }
            callback && callback()
        }
        $active.length && transition ? $active.one('bsTransitionEnd', next).emulateTransitionEnd(Tab.TRANSITION_DURATION) : next()
        $active.removeClass('in')
    }
    function Plugin(option) {
        return this.each(function() {
            var $this = $(this)
            var data = $this.data('bs.tab')
            if (!data)
                $this.data('bs.tab', (data = new Tab(this)))
            if (typeof option == 'string')
                data[option]()
        })
    }
    var old = $.fn.tab
    $.fn.tab = Plugin
    $.fn.tab.Constructor = Tab
    $.fn.tab.noConflict = function() {
        $.fn.tab = old
        return this
    }
    var clickHandler = function(e) {
        e.preventDefault()
        Plugin.call($(this), 'show')
    }
    $(document).on('click.bs.tab.data-api', '[data-toggle="tab"]', clickHandler).on('click.bs.tab.data-api', '[data-toggle="pill"]', clickHandler)
}(jQuery);
;
/****** FILE: themes/bata/bower_components/bootstrap/js/transition.js *****/

+function($) {
    'use strict';
    function transitionEnd() {
        var el = document.createElement('bootstrap')
        var transEndEventNames = {
            WebkitTransition: 'webkitTransitionEnd',
            MozTransition: 'transitionend',
            OTransition: 'oTransitionEnd otransitionend',
            transition: 'transitionend'
        }
        for (var name in transEndEventNames) {
            if (el.style[name] !== undefined) {
                return {
                    end: transEndEventNames[name]
                }
            }
        }
        return false
    }
    $.fn.emulateTransitionEnd = function(duration) {
        var called = false
        var $el = this
        $(this).one('bsTransitionEnd', function() {
            called = true
        })
        var callback = function() {
            if (!called)
                $($el).trigger($.support.transition.end)
        }
        setTimeout(callback, duration)
        return this
    }
    $(function() {
        $.support.transition = transitionEnd()
        if (!$.support.transition)
            return
        $.event.special.bsTransitionEnd = {
            bindType: $.support.transition.end,
            delegateType: $.support.transition.end,
            handle: function(e) {
                if ($(e.target).is(this))
                    return e.handleObj.handler.apply(this, arguments)
            }
        }
    })
}(jQuery);
;
/****** FILE: themes/bata/javascript/main.js *****/

(function($) {
    function checkHeight($image) {
        $overlay = $image.find('.overlay-content');
        if ($overlay.length == 0) {
            $overlay = $image.closest('.page, .link, .staff, .event, .animated').find('.hover-overlay .overlay-content .center-v');
            if ($overlay.length > 0) {
                if ($overlay.outerHeight() > $image.outerHeight()) {
                    $image.css('min-height', $overlay.outerHeight());
                } else {
                    $image.css('min-height', "");
                }
            }
        } else if ($overlay.length > 0) {
            if ($overlay.outerHeight() > $image.outerHeight()) {
                $image.css('min-height', $overlay.outerHeight());
            } else {
                $image.css('min-height', "");
            }
        }
    }
    function loadDeferred() {
        var imgDefer = document.getElementsByTagName('img');
        for (var i = 0; i < imgDefer.length; i++) {
            if (imgDefer[i].getAttribute('data-src')) {
                imgDefer[i].setAttribute('src', imgDefer[i].getAttribute('data-src'));
                imgDefer[i].removeAttribute('data-src');
                if ($(imgDefer[i]).closest('.focuspoint').length > 0) {
                    $(imgDefer[i]).closest('.focuspoint').focusPoint('adjustFocus');
                }
            }
        }
    }
    function calibrateTimeline() {
        $('.timeline .event').each(function() {
            if (!$(this).hasClass('chapter')) {
                $(this).removeClass('left-event');
                $(this).removeClass('right-event');
                $(this).removeClass('middle-event');
                if ($(this).offset().left == 0) {
                    $(this).addClass('left-event');
                } else if (($(this).offset().left + $(this).outerWidth() + 1) >= $(window).width()) {
                    $(this).addClass('right-event');
                } else {
                    $(this).addClass('middle-event');
                }
            }
        });
    }
    function updateTimelineNav() {
        $header = $('header');
        $nav = $('#TimelineNav .nav');
        $chapters = $('.event.chapter');
        $chapters.each(function() {
            var navHeight = 0;
            if ($nav.parent().hasClass("affix")) {
                navHeight = $nav.height();
            }
            if ($(this).offset().top <= ($('html,body').scrollTop() + navHeight + $header.height())) {
                var li = $nav.find('a[href="#' + $(this).attr('id') + '"]').closest('li');
                if (!li.hasClass("active")) {
                    $nav.find('li.active').removeClass('active');
                    $nav.find('a[href="#' + $(this).attr('id') + '"]').closest('li').addClass('active');
                }
            }
        });
    }
    function scrollTimeline($target) {
        $header = $('header');
        $nav = $('#TimelineNav .nav');
        $object = $($target);
        if ($object.length == 0) {} else {
            var navHeight = $nav.height();
            if ($nav.parent().hasClass("affix-top")) {
                if (window.innerWidth > 768) {
                    navHeight = navHeight - 150;
                }
            }
            $("html, body").animate({
                scrollTop: ($object.offset().top - ($header.height() + navHeight - 1))
            }, 1000);
            $('.focuspoint').imagesLoaded(function() {
                $("html, body").animate({
                    scrollTop: ($object.offset().top - ($header.height() + navHeight - 1))
                }, 1000);
                $('.preloader-holder').addClass('out');
                $('.timeline-preloader').addClass('out');
            });
        }
    }
    function loadTimeline() {
        return new Promise(function(resolve, reject) {
                var loader = $('.timeline-loader');
                if (loader.length) {
                    var target = loader.attr('href');
                    if (!loader.hasClass('loading')) {
                        loader.addClass('loading');
                        $.get(target, function($data) {
                            var items = $($data).find('.event');
                            items.each(function() {
                                $(this).addClass('out new');
                            });
                            var container = $('.events > .row');
                            container.append(items);
                            loader.remove();
                            var new_link = $($data).find('.timeline-loader');
                            if (new_link.length > 0) {
                                $('.events').append(new_link);
                            }
                        }).done(function() {
                            $('.new').each(function() {
                                $(this).find('.focuspoint').focusPoint();
                                $(this).find('.focuspoint').imagesLoaded(function() {
                                    loadDeferred();
                                    $(this.elements).each(function() {
                                        if ($('html').hasClass('no-touch')) {
                                            checkHeight($(this));
                                        }
                                        $(this).focusPoint('adjustFocus');
                                    });
                                    $('.new').matchHeight();
                                    $('[data-spy="scroll"]').each(function() {
                                        var $spy = $(this).scrollspy('refresh')
                                    });
                                });
                                $(this).removeClass('new');
                            })
                            calibrateTimeline();
                            animateTimeline();
                            $('.timeline .event').each(function() {
                                var fimage = $(this).find('.focuspoint');
                                if (fimage.length > 0) {
                                    fimage.focusPoint('adjustFocus');
                                }
                            });
                            resolve();
                        })
                    }
                } else {
                    reject();
                }
            }
        );
    }
    function animateTimeline() {
        $('.timeline .event').each(function() {
            $pos = ($(this).outerHeight() / 3) + $(this).offset().top;
            if (($(window).scrollTop() + $(window).outerHeight()) > $pos) {
                $(this).removeClass('out');
            } else {
                $(this).addClass('out');
            }
        });
    }
    var matchHeight = function(selector) {
        var parents = {};
        var elements = document.querySelectorAll(selector);
        for (var i = 0; i < elements.length; i++) {
            var el = elements[i];
            var parent = el.parentNode;
            var className = parent.className.replace(/ /, ".") + " " + selector;
            if (!parents[className]) {
                parents[className] = [];
            }
            el.style = "";
            parents[className].push(el);
        }
        var arr = Object.keys(parents);
        for (var p = 0; p < arr.length; p++) {
            var height = 0;
            var parentKey = arr[p];
            var parent = parents[parentKey];
            var els = parent;
            for (var i = 0; i < els.length; i++) {
                var el = els[i];
                var rect = el.getBoundingClientRect();
                if (rect.height > height) {
                    height = rect.height;
                }
            }
            for (var i = 0; i < els.length; i++) {
                var el = els[i];
                el.style.height = height + "px";
            }
        }
    };
    $(document).ready(function() {
        if (window.location.href.indexOf("beyond-business-as-usual") > -1) {
            $("body").addClass("sustainability");
        }
    });
    var scrollHeader = function() {
        var y = window.scrollY;
        var header = $("header");
        var rect = header.get(0).getBoundingClientRect();
        if (y <= rect.height) {
            if (header.hasClass("scroll")) {
                header.removeClass("scroll");
            }
        } else {
            if (!header.hasClass("scroll")) {
                header.addClass("scroll");
            }
        }
    };
    $(document).ready(function() {
        $(window).resize(function() {
            $('.focuspoint').each(function() {
                checkHeight($(this));
            });
            $('#TimelineNav').affix('checkPosition');
            if ($('#TimelinePage').length) {
                calibrateTimeline();
                animateTimeline();
                matchHeight('#TimelinePage .nav-tabs .matchheight');
            }
        });
        scrollHeader();
        $(window).scroll(function() {
            scrollHeader();
            if ($('#TimelinePage').length) {
                updateTimelineNav();
                animateTimeline();
                matchHeight('#TimelinePage .nav-tabs .matchheight');
            }
        });
        var loadTimelinePart = function() {
            if ($("#TimelinePage").length) {
                loadTimeline().then(function() {
                    loadTimelinePart();
                }, function() {
                    console.error("end");
                });
            }
        };
        loadTimelinePart();
        $('#TimelineNav').affix({
            offset: {
                top: function() {
                    return ($('#Timeline').offset().top);
                }
            }
        })
        $(document).on('click', '#TimelineNav a', function(e) {
            e.preventDefault();
            $target = $(this).attr('href');
            $('.preloader-holder').removeClass('out');
            $(this).find('.timeline-preloader').removeClass('out');
            scrollTimeline($target);
        });
        $('.matchheight-summary').matchHeight();
        $('.focuspoint').focusPoint();
        $('.focuspoint').imagesLoaded(function() {
            loadDeferred();
            $(this.elements).each(function() {
                if ($('html').hasClass('no-touch')) {
                    checkHeight($(this));
                }
                $(this).focusPoint('adjustFocus');
            });
            matchHeight('.matchheight');
        });
        calibrateTimeline();
        animateTimeline();
        $('a.scroll-link').click(function(e) {
            e.preventDefault();
            target = $(this).attr('href');
            offset = $(target).offset().top;
            $('html, body').animate({
                scrollTop: offset
            });
            return false;
        });
        $('#back-to-top a').click(function() {
            $('html, body').animate({
                scrollTop: 0
            });
            return false;
        });
        $('ul.navbar-nav li:last-child a').attr('target', '_blank');
    });
    (function() {
            var pages = $("#HomePage .pages, #ContactPage .pages").find(".page");
            for (var i = 0; i < pages.length; i++) {
                var page = pages.eq(i);
                page.on("click", {
                    page: page
                }, function(e) {
                    var a = e.data.page.find("a");
                    if (a.length) {
                        var href = a.attr("href");
                        if (/https?/.test(href)) {
                            document.location.href = href;
                        } else {
                            document.location.pathname = href;
                        }
                    }
                });
            }
        }
    )();
}(jQuery));
;