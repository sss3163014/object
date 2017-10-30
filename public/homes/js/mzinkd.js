(function(){//extract-content-all.js
var ExtractContentJS=(function(){
	if (typeof ExtractContentJS == 'undefined') {
    var ExtractContentJS = {};
	}
	if (typeof ExtractContentJS.Lib == 'undefined') {
	    ExtractContentJS.Lib = {};
	}

	ExtractContentJS.Lib.Util = (function() {
	    var Util = {};
	    Util.BenchmarkTimer = function() {
	        var now = function() {
	            var d = new Date();
	            var t = 0;
	            t = d.getHours();
	            t = t*60 + d.getMinutes();
	            t = t*60 + d.getSeconds();
	            t = t*1000 + d.getMilliseconds();
	            return t;
	        };
	        var Timer = function() {
	            var self = { elapsed: 0 };
	            self.reset = function(){ self.elapsed = 0; return self };
	            self.start = function(){ self.msec = now(); return self };
	            self.stop = function() {
	                self.elapsed += now() - self.msec;
	                return self;
	            };
	            return self.start();
	        };

	        var self = { timers: {} };
	        self.get = function(name) {
	            if (!self.timers[name]) {
	                self.timers[name] = new Timer();
	            }
	            return self.timers[name];
	        };
	        self.reset = function(name){ return self.get(name).reset(); };
	        self.start = function(name){ return self.get(name).start(); };
	        self.stop = function(name){ return self.get(name).stop(); };
	        return self;
	    };
	    Util.Token = function(word) {
	        var regex = {
	            // hiragana: /[あ-んが-ぼぁ-ょゎっー]/,
	            hiragana: /[\u3042-\u3093\u304C-\u307C\u3041-\u3087\u308E\u3063\u30FC]/,
	            // katakana: /[ア-ンガ-ボァ-ョヮッー]/,
	            katakana: /[\u30A2-\u30F3\u30AC-\u30DC\u30A1-\u30E7\u30EE\u30C3\u30FC]/,
	            kanji: { test: function(w) {
	                // return '一' <= w && w <= '龠' || w === '々';
	                return '\u4E00' <= w && w <= '\u9FA0' || w === '\u3005';
	            } },
	            alphabet: /[a-zA-Z]/,
	            digit: /[0-9]/
	        };
	        var tests = function(w){
	            var match = {};
	            for (var r in regex) {
	                if (regex[r].test(w)) {
	                    match[r] = regex[r];
	                }
	            }
	            return match;
	        };
	        var self = {
	            first: tests(word.charAt(0)),
	            last: tests(word.charAt(word.length-1))
	        };
	        self.isTokenized = function(prev, next) {
	            var p = prev.length ? prev.charAt(prev.length-1) : '';
	            var n = next.length ? next.charAt(0) : '';
	            var check = function(w, test) {
	                if (w.length) {
	                    for (var t in test) {
	                        if (test[t].test(w)) return false;
	                    }
	                }
	                return true;
	            };
	            return check(p, self.first) && check(n, self.last);
	        };

	        return self;
	    };
	    Util.inherit = function(child,parent) {
	        var obj = child || {};
	        for (var prop in parent) {
	            if (typeof obj[prop] == 'undefined') {
	                obj[prop] = parent[prop];
	            }
	        }
	        return obj;
	    };
	    Util.countMatch = function(text, regex) {
	        return text.split(regex).length - 1;
	        //             var n=0;
	        //             for (var i=0;;) {
	        //                 i = text.search(regex);
	        //                 if (i < 0) break;
	        //                 n++;
	        //                 text = text.substr(i+1);
	        //             }
	        //             return n;
	    };
	    Util.countMatchTokenized = function(text, word) {
	        var count = 0;
	        var prev = null;
	        var tok = new Util.Token(word);
	        var texts = text.split(word);
	        var len = texts.length;
	        for (var i=0; i < len; i++) {
	            if (prev && tok.isTokenized(prev, texts[i])) count++;
	            prev = texts[i]
	        }
	        return count;
	    };
	    Util.indexOfTokenized = function(text, word) {
	        var index = text.indexOf(word);
	        if (index >= 0) {
	            var tok = new Util.Token(word);
	            var p = index > 1 ? text.substr(index-1, 1) : '';
	            var n = text.substr(index+word.length, 1);
	            if (tok.isTokenized(p, n)) {
	                return index;
	            }
	        }
	        return -1;
	    };
	    Util.dump = function(obj) {
	        if (typeof obj == 'undefined')  return 'undefined';
	        if (typeof obj == 'string') return '"' + obj + '"';
	        if (typeof obj != 'object') return ''+obj;
	        if (obj === null) return 'null';
	        if (obj instanceof Array) {
	            return '['
	                + obj.map(function(v){return 'obj'/*Util.dump(v)*/;}).join(',')
	                + ']';
	        } else {
	            var arr = [];
	            for (var prop in obj) {
	                arr.push(prop + ':' + 'obj'/*Util.dump(obj[prop])*/);
	            }
	            return '{' + arr.join(',') + '}';
	        }
	    };
	    return Util;
	})();

	ExtractContentJS.Lib.A = (function() {
	    var A = {};
	    A.indexOf = Array.indexOf || function(self, elt/*, from*/) {
	        var argi = 2;
	        var len = self.length;
	        var from = Number(arguments[argi++]) || 0;
	        from = (from < 0) ? Math.ceil(from) : Math.floor(from);
	        if (from < 0) from += len;
	        for (; from < len; from++) {
	            if (from in self && self[from] === elt) return from;
	        }
	        return -1;
	    };
	    A.filter = Array.filter || function(self, fun/*, thisp*/) {
	        var argi = 2;
	        var len = self.length;
	        if (typeof fun != "function") {
	            throw new TypeError('A.filter: not a function');
	        }
	        var rv = new Array();
	        var thisp = arguments[argi++];
	        for (var i = 0; i < len; i++) {
	            if (i in self) {
	                var val = self[i]; // in case fun mutates this
	                if (fun.call(thisp, val, i, self)) rv.push(val);
	            }
	        }
	        return rv;
	    };
	    A.forEach = Array.forEach ||  function(self, fun/*, thisp*/) {
	        var argi = 2;
	        var len = self.length;
	        if (typeof fun != 'function') {
	            throw new TypeError('A.forEach: not a function');
	        }
	        var thisp = arguments[argi++];
	        for (var i=0; i < len; i++) {
	            if (i in self) fun.call(thisp, self[i], i, self);
	        }
	    };
	    A.every = Array.every || function(self, fun/*, thisp*/) {
	        var argi = 2;
	        var len = self.length;
	        if (typeof fun != 'function') {
	            throw new TypeError('A.every: not a function');
	        }
	        var thisp = arguments[argi++];
	        for (var i = 0; i < len; i++) {
	            if (i in self &&
	                !fun.call(thisp, self[i], i, self)) {
	                return false;
	            }
	        }
	        return true;
	    };
	    A.map = Array.map || function(self, fun/*, thisp*/) {
	        var argi = 2;
	        var len = self.length;
	        if (typeof fun != 'function') {
	            throw new TypeError('A.map: not a function');
	        }
	        var rv = new Array(len);
	        var thisp = arguments[argi++];
	        for (var i = 0; i < len; i++) {
	            if (i in self) {
	                rv[i] = fun.call(thisp, self[i], i, self);
	            }
	        }
	        return rv;
	    };
	    A.some = Array.some || function(self, fun/*, thisp*/) {
	        var argi = 2;
	        var len = self.length;
	        if (typeof fun != "function") {
	            throw new TypeError('A.some: not a function');
	        }
	        var thisp = arguments[argi++];
	        for (var i = 0; i < len; i++) {
	            if (i in self &&
	                fun.call(thisp, self[i], i, self)) {
	                return true;
	            }
	        }
	        return false;
	    };
	    A.reduce = Array.reduce || function(self, fun/*, initial*/) {
	        var argi = 2;
	        var len = self.length;
	        if (typeof fun != 'function') {
	            throw TypeError('A.reduce: not a function ');
	        }
	        var i = 0;
	        var prev;
	        if (arguments.length > argi) {
	            var rv = arguments[argi++];
	        } else {
	            do {
	                if (i in self) {
	                    rv = self[i++];
	                    break;
	                }
	                if (++i >= len) {
	                    throw new TypeError('A.reduce: empty array');
	                }
	            } while (true);
	        }
	        for (; i < len; i++) {
	            if (i in self) rv = fun.call(null, rv, self[i], i, self);
	        }
	        return rv;
	    };
	    A.zip = function(self) {
	        if (self[0] instanceof Array) {
	            var l = self[0].length;
	            var len = self.length;
	            var z = new Array(l);
	            for (var i=0; i < l; i++) {
	                z[i] = [];
	                for (var j=0; j < len; j++) {
	                    z[i].push(self[j][i]);
	                }
	            }
	            return z;
	        }
	        return [];
	    };
	    A.first = function(self) {
	        return self ? self[0] : null;
	    };
	    A.last = function(self) {
	        return self ? self[self.length-1] : null;
	    };
	    A.push = function(self, other) {
	        return Array.prototype.push.apply(self, other);
	    };
	    return A;
	})();

	ExtractContentJS.Lib.DOM = (function() {
	    var A = ExtractContentJS.Lib.A;
	    var DOM = {};
	    DOM.getElementStyle = function(elem, prop) {
	        var style = elem.style ? elem.style[prop] : null;
	        if (!style) {
	            var dv = elem.ownerDocument.defaultView;
	            if (dv && dv.getComputedStyle) {
	                try {
	                    var styles = dv.getComputedStyle(elem, null);
	                } catch(e) {
	                    return null;
	                }
	                prop = prop.replace(/([A-Z])/g, '-$1').toLowerCase();
	                style = styles ? styles.getPropertyValue(prop) : null;
	            } else if (elem.currentStyle) {
	                style = elem.currentStyle[prop];
	            }
	        }
	        return style;
	    };
	    DOM.text = function(node) {
	        if (typeof node.textContent != 'undefined') {
	            return node.textContent;
	        } else if (node.nodeName == '#text') {
	            return node.nodeValue;
	        } else if (typeof node.innerText != 'undefined') {
	            return node.innerText; // IE
	        }
	        return null;
	    };
	    DOM.ancestors = function(e) {
	        var body = e.ownerDocument.body;
	        var r = [];
	        var it = e;
	        while (it != body) {
	            r.push(it);
	            it = it.parentNode;
	        }
	        r.push(body);
	        return r; // [e .. document.body]
	    };
	    DOM.commonAncestor = function(e1, e2) {
	        var a1 = DOM.ancestors(e1).reverse();
	        var a2 = DOM.ancestors(e2).reverse();
	        var r = null;
	        for (var i=0; a1[i] && a2[i] && a1[i] == a2[i]; i++) {
	            r = a1[i];
	        }
	        return r;
	    };
	    DOM.countMatchTagAttr = function(node, tag, attr, regexs) {
	        var test = function(v){ return v.test(node[attr]); };
	        if ((node.tagName||'').toLowerCase()==tag && A.some(regexs,test)) {
	            return 1;
	        }
	        var n=0;
	        var children = node.childNodes;
	        for (var i=0, len=children.length; i < len; i++) {
	            n += DOM.countMatchTagAttr(children[i], tag, attr, regexs);
	        }
	        return n;
	    };
	    DOM.matchTag = function(node, pat) {
	        return A.some(pat, function(v){
	            if (typeof v == 'string') {
	                return v == (node.tagName||'').toLowerCase();
	            } else if (v instanceof Array) {
	                return v[0] == (node.tagName||'').toLowerCase()
	                    && DOM.matchAttr(node, v[1]);
	            } else {
	                return false;
	            }
	        });
	    };
	    DOM.matchAttr = function(node, pat) {
	        var test = function(pat, val) {
	            if (typeof pat == 'string') {
	                return pat == val;
	            } else if (pat instanceof RegExp) {
	                return pat.test(val);
	            } else if (pat instanceof Array) {
	                return A.some(pat,function(v){return test(v,val);});
	            } else if (pat instanceof Object) {
	                for (var prop in pat) {
	                    var n = node[prop];
	                    if (n && DOM.matchAttr(n, pat[prop])) {
	                        return true;
	                    }
	                }
	            }
	            return false;
	        };
	        for (var prop in pat) {
	            var attr = node[prop];
	            var ar = pat[prop];
	            if (attr) {
	                return test(ar, attr);
	            }
	        }
	        return false;
	    };
	    DOM.matchStyle = function(node, pat) {
	        var test = function(pat, val) {
	            if (typeof pat == 'string') {
	                return pat == val;
	            } else if (pat instanceof RegExp) {
	                return pat.test(val);
	            } else if (pat instanceof Array) {
	                return A.some(pat,function(v){return test(v,val);});
	            }
	            return false;
	        };
	        for (var prop in pat) {
	            if (test(pat[prop], DOM.getElementStyle(node, prop))) {
	                return true;
	            }
	        }
	        return false;
	    };
	    return DOM;
	})();

	if (typeof ExtractContentJS == 'undefined') {
	    var ExtractContentJS = {};
	}

	(function(ns) {
	    var Util = ns.Lib.Util;
	    var A = ns.Lib.A;
	    var DOM = ns.Lib.DOM;

	    var Leaf = Util.inherit(function(node/*, depth, inside, limit*/) {
	        var depth = arguments[1] || 0;
	        var inside = arguments[2] || {};
	        var limit = arguments[3] || 1048576;
	        var leaf = { node: node, depth: depth, inside: inside };

	        leaf.statistics = function() {
	            var t = (DOM.text(node) || '').replace(/\s+/g, ' ');
	            var l = t.length;
	            return {
	                text: t.substr(0, limit),
	                noLinkText: (inside.link || inside.form) ? '' : t,
	                listTextLength: inside.list ? l : 0,
	                noListTextLength: inside.list ? 0 : l,
	                linkCount: inside.link ? 1 : 0,
	                listCount: inside.li ? 1 : 0,
	                linkListCount: (inside.li && inside.link) ? 1 : 0
	            };
	        };

	        return leaf;
	    }, {
	        commonAncestor: function(/* leaves */) {
	            var ar = A.map(arguments, function(v){ return v.node; });
	            if (ar.length < 2) {
	                return ar[0];
	            }
	            return A.reduce(ar, function(prev, curr) {
	                return DOM.commonAncestor(prev, curr);
	            });
	        },
	        mergeStatistics: function(a, b) {
	            var r = {};
	            for (var prop in a) {
	                r[prop] = a[prop] + b[prop];
	            }
	            return r;
	        }
	    });
	    var Block = function(leaves) {
	        leaves = A.filter(leaves, function(v) {
	            var s = DOM.text(v.node) || '';
	            s = s.replace(/\s+/g, '');
	            return s.length != 0;
	        });
	        var block = { score: 0, leaves: leaves };
	        block.commonAncestor = function() {
	            return Leaf.commonAncestor.apply(null, block.leaves);
	        };
	        return block;
	    };

	    var Content = function(c) {
	        var self = { _content: c };

	        self.asLeaves = function(){ return self._content; };
	        self.asNode = function() {
	            if (self._node) return self._node;
	            self._node = Leaf.commonAncestor.apply(null, self._content);
	            return self._node;
	        };
	        self.asTextFragment = function() {
	            if (self._textFragment) return self._textFragment;
	            if (self._content.length < 1) return '';
	            self._textFragment = A.reduce(self._content, function(prev,curr) {
	                var s = DOM.text(curr.node);
	                s = s.replace(/^\s+/g,'').replace(/\s+$/g,'');
	                s = s.replace(/\s+/g,' ');
	                return prev + s;
	            }, '');
	            return self._textFragment;
	        };
	        self.asText = function() {
	            if (self._text) return self._text;
	            // covering node
	            var node = self.asNode();
	            self._text = node ? DOM.text(node) : '';
	            return self._text;
	        };
	        self.toString = function() {
	            return self.asTextFragment();
	        };

	        return self;
	    };

	    ns.LayeredExtractor = function(/* handler, filter */) {
	        var self = { handler: arguments[0] || [], filter: arguments[1] || {} };

	        self.factory = {
	            getHandler: function(name) {
	                if (typeof ns.LayeredExtractor.Handler != 'undefined') {
	                    return new ns.LayeredExtractor.Handler[name];
	                }
	                return null;
	            }
	        };

	        self.addHandler = function(handler) {
	            if (typeof handler != 'undefined') {
	                self.handler.push(handler);
	            }
	            return self;
	        };

	        self.filterFor = function(url) {
	            // TODO
	        };

	        self.extract = function(d) {
	            var url = d.location.href;
	            var res = { title: d.title, url: d.location.href };
	            var len = self.handler.length;
	            for (var i=0; i < len; i++) {
	                var content = self.handler[i].extract(d, url, res);
	                if (!content) continue;

	                var f = self.filterFor(url);
	                if (f) {
	                    content = f.filter(content);
	                }

	                content = new Content(content);
	                if (!content.toString().length) continue;
	                res.content = content;
	                res.isSuccess = true;
	                res.engine = res.engine || self.handler[i];
	                break;
	            }
	            return res;
	        };

	        return self;
	    };
	    ns.LayeredExtractor.Handler = {};

	    ns.LayeredExtractor.Handler.Heuristics = function(/*option, pattern*/) {
	        var self = {
	            name: 'Heuristics',
	            content: [],
	            opt: Util.inherit(arguments[0], {
	                threshold: 60,
	                minLength: 30,
	                factor: {
	                    decay:      0.75,
	                    noBody:     0.72,
	                    continuous: 1.16//1.62
	                },
	                punctuationWeight: 10,
	                minNoLink: 8,
	                noListRatio: 0.2,
	                limit: {
	                    leaves: 800,
	                    recursion: 20,
	                    text: 1048576
	                },
	                debug: false
	            }),
	            pat: Util.inherit(arguments[1], {
	                sep: [
	                    'div', 'center', 'td',
	                    'h1', 'h2'
	                ],
	                waste: [
	                        /Copyright|All\s*Rights?\s*Reserved?/i
	                ],
	                affiliate: [
	                        /amazon[a-z0-9\.\/\-\?&]+-22/i
	                ],
	                list: [ 'ul', 'dl', 'ol' ],
	                li:   [ 'li', 'dd' ],
	                a:    [ 'a' ],
	                form: [ /*'form'*/ ],
	                noContent: [ 'frameset' ],
	                ignore: [
	                    'iframe',
	                    'img',
	                    'script',
	                    'style',
	                    'select',
	                    'noscript',
	                    [ 'div', {
	                        id: [ /more/, /menu/, /side/, /navi/ ],
	                        className: [ /more/, /menu/, /*/side/,*/ /navi/ ]
	                    } ]
	                ],
	                ignoreStyle: {
	                    display: 'none',
	                    visibility: 'hidden'
	                },
	                // punctuations: /[。、．，！？]|\.[^A-Za-z0-9]|,[^0-9]|!|\?/
	                punctuations: /[\u3002\u3001\uFF0E\uFF0C\uFF01\uFF1F]|\.[^A-Za-z0-9]|,[^0-9]|!|\?/
	            })
	        };

	        var MyBlock = Util.inherit(function(leaves) {
	            var block = new Block(leaves);

	            block.eliminateLinks = function() {
	                var st = A.map(block.leaves, function(v){
	                    return v.statistics();
	                });
	                if (!st.length) return '';
	                if (st.length == 1) {
	                    st = st[0];
	                } else {
	                    st = A.reduce(st, function(prev, curr) {
	                        return Leaf.mergeStatistics(prev, curr);
	                    });
	                }

	                var nolinklen = st.noLinkText.length;
	                var links = st.linkCount;
	                var listlen = st.listTextLength;
	                if (nolinklen < self.opt.minNoLink * links) {
	                    return '';
	                }

	                // isLinklist
	                var rate = st.linkListCount / (st.listCount || 1);
	                rate *= rate;
	                var limit = self.opt.noListRatio * rate * listlen;
	                if (nolinklen < limit) {
	                    return '';
	                }

	                return st.noLinkText;
	            };
	            block.noBodyRate = function() {
	                var val = 0;
	                if (block.leaves.length > 0) {
	                    val += A.reduce(block.leaves, function(prev, curr) {
	                        return prev
	                            + DOM.countMatchTagAttr(curr.node, 'a', 'href',
	                                                    self.pat.affiliate);
	                    }, 0);
	                }
	                val /= 2.0;
	                val += A.reduce(self.pat.waste, function(prev,curr) {
	                    return prev + Util.countMatch(block._nolink, curr);
	                }, 0);
	                return val;
	            };

	            block.calcScore = function(factor, continuous) {
	                // ignore link list block
	                block._nolink = block.eliminateLinks();
	                if (block._nolink.length < self.opt.minLength) return 0;

	                var c = Util.countMatch(block._nolink, self.pat.punctuations);
	                c *= self.opt.punctuationWeight;
	                c += block._nolink.length;
	                c *= factor;

	                // anti-scoring factors
	                var noBodyRate = block.noBodyRate();

	                // scores
	                c *= Math.pow(self.opt.factor.noBody, noBodyRate);
	                block._c = block.score = c;
	                block._c1 = c * continuous;
	                return c;
	            };

	            block.isAccepted = function() {
	                return block._c > self.opt.threshold;
	            };

	            block.isContinuous = function() {
	                return block._c1 > self.opt.threshold;
	            };

	            block.merge = function(other) {
	                block.score += other._c1;
	                block.depth = Math.min(block.depth, other.depth);
	                A.push(block.leaves, other.leaves);
	                return block;
	            };

	            return block;
	        }, {
	            split: function(node) {
	                var r = [];
	                var buf = [];
	                var leaves = 0;
	                var limit = self.opt.limit.text;

	                var flush = function(flag) {
	                    if (flag && buf.length) {
	                        r.push(new MyBlock(buf));
	                        buf = [];
	                    }
	                };

	                var rec = function(node, depth, inside) {
	                    // depth-first recursion
	                    if (leaves >= self.opt.limit.leaves) return r;
	                    if (depth >= self.opt.limit.recursion) return r;
	                    if (node.nodeName == '#comment') return r;
	                    if (DOM.matchTag(node, self.pat.ignore)) return r;
	                    if (DOM.matchStyle(node, self.pat.ignoreStyle)) return r;
	                    var children = node.childNodes;
	                    var sep = self.pat.sep;
	                    var len = children.length;
	                    var flags = {
	                        form: inside.form || DOM.matchTag(node, self.pat.form),
	                        link: inside.link || DOM.matchTag(node, self.pat.a),
	                        list: inside.list || DOM.matchTag(node, self.pat.list),
	                        li: inside.li || DOM.matchTag(node, self.pat.li)
	                    };
	                    for (var i=0; i < len; i++) {
	                        var c = children[i];
	                        var f = DOM.matchTag(c, sep);
	                        flush(f);
	                        rec(c, depth+1, flags);
	                        flush(f);
	                    }
	                    if (!len) {
	                        leaves++;
	                        buf.push(new Leaf(node, depth, flags, limit));
	                    }
	                    return r;
	                };

	                rec(node, 0, {});
	                flush(true);

	                return r;
	            }
	        });

	        self.extract = function(d/*, url, res*/) {
	            var isNoContent = function(v){
	                return d.getElementsByTagName(v).length != 0;
	            };
	            if (A.some(self.pat.noContent, isNoContent)) return self;

	            var factor = 1.0;
	            var continuous = 1.0;
	            var score = 0;

	            var res = [];
	            var blocks = MyBlock.split(d.body);
	            var last;

	            var len = blocks.length;
	            for (var i=0; i < len; i++) {
	                var block = blocks[i];
	                if (last) {
	                    continuous /= self.opt.factor.continuous;
	                }
	                // score
	                if (!block.calcScore(factor, continuous)) continue;
	                factor *= self.opt.factor.decay;
	                // clustor scoring
	                if (block.isAccepted()) {
	                    if (block.isContinuous() && last) {
	                        last.merge(block);
	                    } else {
	                        last = block;
	                        res.push(block);
	                    }
	                    continuous = self.opt.factor.continuous;
	                } else { // rejected
	                    if (!last) {
	                        // do not decay if no block is pushed
	                        factor = 1.0
	                    }
	                }
	            }

	            self.blocks = res.sort(function(a,b){return b.score-a.score;});
	            var best = A.first(self.blocks);
	            if (best) {
	                self.content = best.leaves;
	            }

	            return self.content;
	        };

	        return self;
	    };

	    ns.LayeredExtractor.Handler.GoogleAdSection = function(/*opt*/) {
	        var self = {
	            name: 'GoogleAdSection',
	            content: [],
	            state: [],
	            opt: Util.inherit(arguments[0], {
	                limit: {
	                    leaves: 800,
	                    recursion: 20
	                },
	                debug: false
	            })
	        };

	        var pat = {
	            ignore: /google_ad_section_start\(weight=ignore\)/i,
	            section: /google_ad_section_start/i,
	            end: /google_ad_section_end/i
	        };
	        var stIgnore = 1;
	        var stSection = 2;

	        self.inSection = function(){return A.last(self.state)==stSection;};
	        self.ignore = function(){self.state.push(stIgnore);}
	        self.section = function(){self.state.push(stSection);}
	        self.end = function(){ if (self.state.length) self.state.pop(); };
	        self.parse = function(node/*, depth*/) {
	            var depth = arguments[1] || 0;
	            if (node.nodeName == '#comment') {
	                if (pat.ignore.test(node.nodeValue)) {
	                    self.ignore();
	                } else if (pat.section.test(node.nodeValue)) {
	                    self.section();
	                } else if (pat.end.test(node.nodeValue)) {
	                    self.end();
	                }
	                return;
	            }

	            if (self.content.length >= self.opt.limit.leaves) return;
	            if (depth >= self.opt.limit.recursion) return;
	            var children = node.childNodes;
	            var len = children.length;
	            for (var i=0; i < len; i++) {
	                var c = children[i];
	                self.parse(c, depth+1);
	            }
	            if (!len && self.inSection()) {
	                self.content.push(new Leaf(node, depth));
	            }
	            return;
	        };

	        self.extract = function(d/*, url, res*/) {
	            self.parse(d);
	            self.blocks = [ new Block(self.content) ];
	            return self.content;
	        };

	        return self;
	    };
	})(ExtractContentJS);
	return ExtractContentJS;
})();

/**
 * @license jQuery Text Highlighter
 * Copyright (C) 2011 - 2013 by mirz
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

(function($, window, document, undefined) {
    var nodeTypes = {
        ELEMENT_NODE: 1,
        TEXT_NODE: 3
    };

    var plugin = {
        name: 'textHighlighter'
    };

    function TextHighlighter(element, options) {
        this.context = element;
        this.$context = $(element);
        this.options = $.extend({}, $[plugin.name].defaults, options);

        this.init();
    }

    TextHighlighter.prototype = {
        init: function() {
            this.$context.addClass(this.options.contextClass);
            //this.bindEvents();
        },

        destroy: function() {
            this.unbindEvents();
            this.$context.removeClass(this.options.contextClass);
            this.$context.removeData(plugin.name);
        },

        bindEvents: function() {
            this.$context.unbind('mouseup');
            this.$context.bind('mouseup', {self: this}, this.highlightHandler);
        },

        unbindEvents: function() {
            this.$context.unbind('mouseup', this.highlightHandler);
        },
        highlightHandler: function(event) {
            //event.stopPropagation();
            //event.stopPropagation();
            //document.execCommand("Copy");
            var self = event.data.self;
            self.doHighlight();
        },
        doHighlightHandler: function(event) {
            //event.stopPropagation();
            //event.stopPropagation();
            //document.execCommand("Copy");
            //var self = event.data.self;
            this.doHighlight();
        },

        /**
         * Highlights currently selected text.
         */
        doHighlight: function() {
            var range = this.getCurrentRange();
            if (!range || range.collapsed) return;
            var rangeText = range.toString();

            if (this.options.onBeforeHighlight(range) == true) {
                var $wrapper = $.textHighlighter.createWrapper(this.options);

                var createdHighlights = this.highlightRange(range, $wrapper);
                var normalizedHighlights = this.normalizeHighlights(createdHighlights);

                this.options.onAfterHighlight(normalizedHighlights, rangeText);
            }

            this.removeAllRanges();
        },

        /**
         * Returns first range of current selection object.
         */
        getCurrentRange: function() {
            var selection = this.getCurrentSelection();

            var range;
            if (selection.rangeCount > 0) {
                range = selection.getRangeAt(0);
            }
            return range;
        },

        removeAllRanges: function() {
            var selection = this.getCurrentSelection();
            selection.removeAllRanges();
        },

        /**
         * Returns current selection object.
         */
        getCurrentSelection: function() {
            var currentWindow = this.getCurrentWindow();
            var selection;

            if (currentWindow.getSelection) {
                selection = currentWindow.getSelection();
            } else if ($('iframe').length) {
                $('iframe', top.document).each(function() {
                    if (this.contentWindow === currentWindow) {
                        selection = rangy.getIframeSelection(this);
                        return false;
                    }
                });
            } else {
                selection = rangy.getSelection();
            }

            return selection;
        },

        /**
         * Returns owner window of this.context.
         */
        getCurrentWindow: function() {
            var currentDoc = this.getCurrentDocument();
            if (currentDoc.defaultView) {
                return currentDoc.defaultView; // Non-IE
            } else {
                return currentDoc.parentWindow; // IE
            }
        },

        /**
         * Returns owner document of this.context.
         */
        getCurrentDocument: function() {
            // if ownerDocument is null then context is document
            return this.context.ownerDocument ? this.context.ownerDocument : this.context;
        },

        /**
         * Wraps given range (highlights it) object in the given wrapper.
         */
        highlightRange: function(range, $wrapper) {
            if (range.collapsed) return;
            // Don't highlight content of these tags
            var ignoreTags = ['SCRIPT', 'STYLE', 'SELECT', 'BUTTON', 'OBJECT', 'APPLET'];
            var startContainer = range.startContainer;
            var endContainer = range.endContainer;
            var ancestor = range.commonAncestorContainer;
            var goDeeper = true;

            if (range.endOffset == 0) {
                while (!endContainer.previousSibling && endContainer.parentNode != ancestor) {
                    endContainer = endContainer.parentNode;
                }
                endContainer = endContainer.previousSibling;
            } else if (endContainer.nodeType == nodeTypes.TEXT_NODE) {
                if (range.endOffset < endContainer.nodeValue.length) {
                    endContainer.splitText(range.endOffset);
                }
            } else if (range.endOffset > 0) {
                endContainer = endContainer.childNodes.item(range.endOffset - 1);
            }
            if (startContainer.nodeType == nodeTypes.TEXT_NODE) {
                if (range.startOffset == startContainer.nodeValue.length) {
                    goDeeper = false;
                } else if (range.startOffset > 0) {
                    startContainer = startContainer.splitText(range.startOffset);
                    if (endContainer == startContainer.previousSibling) endContainer = startContainer;
                }
            } else if (range.startOffset < startContainer.childNodes.length) {
                startContainer = startContainer.childNodes.item(range.startOffset);
            } else {
                startContainer = startContainer.nextSibling;
            }

            var done = false;
            var node = startContainer;
            var highlights = [];

            do {
                if (goDeeper && node.nodeType == nodeTypes.TEXT_NODE) {
                    if (/\S/.test(node.nodeValue)) {
                        var wrapper = $wrapper.clone(true).get(0);
                        var nodeParent = node.parentNode;

                        // highlight if node is inside the context
                        if ($.contains(this.context, nodeParent) || nodeParent === this.context) {
                            var highlight = $(node).wrap(wrapper).parent().get(0);
                            highlights.push(highlight);
                        }
                    }

                    goDeeper = false;
                }
                if (node == endContainer && (!endContainer.hasChildNodes() || !goDeeper)) {
                    done = true;
                }

                if ($.inArray(node.tagName, ignoreTags) != -1) {
                    goDeeper = false;
                }
                if (goDeeper && node.hasChildNodes()) {
                    node = node.firstChild;
                } else if (node.nextSibling != null) {
                    node = node.nextSibling;
                    goDeeper = true;
                } else {
                    node = node.parentNode;
                    goDeeper = false;
                }
            } while (!done);

            return highlights;
        },

        /**
         * Normalizes highlights - nested highlights are flattened and sibling higlights are merged.
         */
        normalizeHighlights: function(highlights) {
            this.flattenNestedHighlights(highlights);
            this.mergeSiblingHighlights(highlights);

            // omit removed nodes
            var normalizedHighlights = $.map(highlights, function(hl) {
                if (typeof hl.parentElement != 'undefined') { // IE
                    return hl.parentElement != null ? hl : null;
                } else {
                    return hl.parentNode != null ? hl : null;
                }
            });

            return normalizedHighlights;
        },

        flattenNestedHighlights: function(highlights) {
            var self = this;
            $.each(highlights, function(i) {
                var $highlight = $(this);
                var $parent = $highlight.parent();
                var $parentPrev = $parent.prev();
                var $parentNext = $parent.next();

                if (self.isHighlight($parent)) {
                    if ($parent.css('background-color') != $highlight.css('background-color')) {
                        if (self.isHighlight($parentPrev) && !$highlight.get(0).previousSibling
                            && $parentPrev.css('background-color') != $parent.css('background-color')
                            && $parentPrev.css('background-color') == $highlight.css('background-color')) {

                            $highlight.insertAfter($parentPrev);
                        }

                        if (self.isHighlight($parentNext) && !$highlight.get(0).nextSibling
                            && $parentNext.css('background-color') != $parent.css('background-color')
                            && $parentNext.css('background-color') == $highlight.css('background-color')) {

                            $highlight.insertBefore($parentNext);
                        }

                        if ($parent.is(':empty')) {
                            $parent.remove();
                        }
                    } else {
                        var newNode = document.createTextNode($parent.text());

                        $parent.empty();
                        $parent.append(newNode);
                        $(highlights[i]).remove();
                    }
                }
            });
        },

        mergeSiblingHighlights: function(highlights) {
            var self = this;

            function shouldMerge(current, node) {
                return node && node.nodeType == nodeTypes.ELEMENT_NODE
                    && $(current).css('background-color') == $(node).css('background-color')
                    && $(node).hasClass(self.options.highlightedClass)
                    ? true : false;
            }

            $.each(highlights, function() {
                var highlight = this;

                var prev = highlight.previousSibling;
                var next = highlight.nextSibling;

                if (shouldMerge(highlight, prev)) {
                    var mergedTxt = $(prev).text() + $(highlight).text();
                    $(highlight).text(mergedTxt);
                    $(prev).remove();
                }
                if (shouldMerge(highlight, next)) {
                    var mergedTxt = $(highlight).text() + $(next).text();
                    $(highlight).text(mergedTxt);
                    $(next).remove();
                }
            });
        },

        /**
         * Sets color of future highlights.
         */
        setColor: function(color) {
            this.options.color = color;
        },

        /**
         * Returns current highlights color.
         */
        getColor: function() {
            return this.options.color;
        },

        /**
         * Removes all highlights in given element or in context if no element given.
         */
        removeHighlights: function(element) {
            var container = (element !== undefined ? element : this.context);

            var unwrapHighlight = function(highlight) {
                return $(highlight).contents().unwrap().get(0);
            };

            var mergeSiblingTextNodes = function(textNode) {
                var prev = textNode.previousSibling;
                var next = textNode.nextSibling;

                if (prev && prev.nodeType == nodeTypes.TEXT_NODE) {
                    textNode.nodeValue = prev.nodeValue + textNode.nodeValue;
                    prev.parentNode.removeChild(prev);
                }
                if (next && next.nodeType == nodeTypes.TEXT_NODE) {
                    textNode.nodeValue = textNode.nodeValue + next.nodeValue;
                    next.parentNode.removeChild(next);
                }
            };

            var self = this;
            var $highlights = this.getAllHighlights(container, true);
            $highlights.each(function() {
                if (self.options.onRemoveHighlight(this) == true) {
                    var textNode = unwrapHighlight(this);
                    mergeSiblingTextNodes(textNode);
                }
            });
        },

        /**
         * Returns all highlights in given container. If container is a highlight itself and
         * andSelf is true, container will be also returned
         */
        getAllHighlights: function(container, andSelf) {
            var classSelectorStr = '.' + this.options.highlightedClass;
            var $highlights = $(container).find(classSelectorStr);
            if (andSelf == true && $(container).hasClass(this.options.highlightedClass)) {
                $highlights = $highlights.add(container);
            }
            return $highlights;
        },

        /**
         * Returns true if element is highlight, ie. has proper class.
         */
        isHighlight: function($el) {
            return $el.hasClass(this.options.highlightedClass);
        },

        /**
         * Serializes all highlights to stringified JSON object.
         */
        serializeHighlights: function() {
            var $highlights = this.getAllHighlights(this.context);
            var refEl = this.context;
            var hlDescriptors = [];
            var self = this;

            var getElementPath = function (el, refElement) {
                var path = [];

                do {
                    var elIndex = $.inArray(el, el.parentNode.childNodes);
                    path.unshift(elIndex);
                    el = el.parentNode;
                } while (el !== refElement);

                return path;
            };

            $highlights.each(function(i, highlight) {
                var offset = 0; // Hl offset from previous sibling within parent node.
                var length = highlight.firstChild.length;
                var hlPath = getElementPath(highlight, refEl);
                var wrapper = $(highlight).clone().empty().get(0).outerHTML;

                if (highlight.previousSibling && highlight.previousSibling.nodeType === nodeTypes.TEXT_NODE) {
                    offset = highlight.previousSibling.length;
                }

                hlDescriptors.push([
                    wrapper,
                    highlight.innerText,
                    hlPath.join(':'),
                    offset,
                    length
                ]);
            });

            return JSON.stringify(hlDescriptors);
        },

        /**
         * Deserializes highlights from stringified JSON given as parameter.
         */
        deserializeHighlights: function(json) {
            try {
                var hlDescriptors = JSON.parse(json);
            } catch (e) {
                throw "Can't parse serialized highlights: " + e;
            }
            var highlights = [];
            var self = this;

            var deserializationFn = function (hlDescriptor) {
                var wrapper = hlDescriptor[0];
                var hlText = hlDescriptor[1];
                var hlPath = hlDescriptor[2].split(':');
                var elOffset = hlDescriptor[3];
                var hlLength = hlDescriptor[4];
                var elIndex = hlPath.pop();
                var idx = null;
                var node = self.context;

                while ((idx = hlPath.shift()) !== undefined) {
                    node = node.childNodes[idx];
                }

                if (node.childNodes[elIndex-1] && node.childNodes[elIndex-1].nodeType === nodeTypes.TEXT_NODE) {
                    elIndex -= 1;
                }

                var textNode = node.childNodes[elIndex];
                var hlNode = textNode.splitText(elOffset);
                hlNode.splitText(hlLength);

                if (hlNode.nextSibling && hlNode.nextSibling.nodeValue == '') {
                    hlNode.parentNode.removeChild(hlNode.nextSibling);
                }

                if (hlNode.previousSibling && hlNode.previousSibling.nodeValue == '') {
                    hlNode.parentNode.removeChild(hlNode.previousSibling);
                }

                var highlight = $(hlNode).wrap(wrapper).parent().get(0);
                highlights.push(highlight);
            };

            $.each(hlDescriptors, function(i, hlDescriptor) {
                try {
                    deserializationFn(hlDescriptor);
                } catch (e) {
                    console && console.warn
                        && console.warn("Can't deserialize " + i + "-th descriptor. Cause: " + e);
                    return true;
                }
            });

            return highlights;
        }

    };

    /**
     * Returns TextHighlighter instance.
     */
    $.fn.getHighlighter = function() {
        return this.data(plugin.name);
    };

    $.fn[plugin.name] = function(options) {
        return this.each(function() {
            if (!$.data(this, plugin.name)) {
                $.data(this, plugin.name, new TextHighlighter(this, options));
            }
        });
    };

    $.textHighlighter = {
        /**
         * Returns HTML element to wrap selected text in.
         */
        createWrapper: function(options) {
            return $('<span></span>')
                .css('backgroundColor', options.color)
                .addClass(options.highlightedClass);
        },
        defaults: {
            color: '#ffff7b',
            highlightedClass: 'highlighted',
            contextClass: 'highlighter-context',
            onRemoveHighlight: function() { return true; },
            onBeforeHighlight: function() { return true; },
            onAfterHighlight: function() { }
        }
    };

})(jQuery, window, document);

(function($){
	var Descente=Descente||{};
	var isIE6 = !-[1, ] && !window.XMLHttpRequest;
	function addEvent(oTarget, sEventType, fnHandler) {
	    if (oTarget.addEventListener) {
	        oTarget.addEventListener(sEventType, fnHandler, false)
	    } else if (oTarget.attachEvent) {
	        oTarget.attachEvent("on" + sEventType, fnHandler)
	    } else {
	        oTarget["on" + sEventType] = fnHandler
	    }
	};
	function removeEvent(oTarget, sEventType, fnHandler) {
	    if (oTarget.removeEventListener) {
	        oTarget.removeEventListener(sEventType, fnHandler, false)
	    } else if (oTarget.detachEvent) {
	        oTarget.detachEvent("on" + sEventType, fnHandler)
	    } else {
	        oTarget["on" + sEventType] = null
	    }
	};
	//遮罩
	var OverLay=function($obj){
		var _options={
			lay: null,
            color: "#000",
            opacity: 60,
            zIndex: 100001,
			fade:false,
			speed:100
		};
		var _resize,opacity,zIndex,lay;
		function _init(){
			_options=$.extend(_options,$obj||{});
			lay = _options.lay || document.body.insertBefore(document.createElement("div"), document.body.childNodes[0]);
			lay=$(lay);
			opacity = _options.opacity/100;
       		zIndex = parseInt(_options.zIndex);
			lay.css({
				display:"none",
				zIndex : zIndex,
				left :0,
				top:0,
				opacity:opacity,
				backgroundColor:_options.color,
				position : "fixed",
				width :"100%",
				height : "100%"
			});
			if (isIE6) {
				lay.css('position',"absolute");
				_resize=function(){
					lay.css({'width':Math.max(document.documentElement.scrollWidth, document.documentElement.clientWidth),
							 'height':Math.max(document.documentElement.scrollHeight, document.documentElement.clientHeight)});
				};
				lay.html('<iframe style="position:absolute;top:0;left:0;width:100%;height:100%;filter:alpha(opacity=0);"></iframe>');
			};
		};
		function show(callback) {
			callback=callback||function(){};
			if (isIE6) {
				_resize();
				addEvent(window,"resize",_resize);
			};
			if (_options.fade){
				lay.fadeIn(_options.speed,function(){
					callback();	
				})
			}else {
				lay.show();
				callback();	
			};
   		 };
		 function close(callback) {
			callback=callback||function(){};
			if (isIE6) {
				removeEvent(window,"resize",_resize);
			};
			if (_options.fade){
				lay.fadeOut(_options.speed,function(){
					callback();	
				});
			}else {
				lay.hide();
				callback();
			};
		 };
		 function dispose(isNow) {
			 if (isNow){_options.fade=false;}
			 close(function(){
			 	lay.remove();
				lay=null;
			 });				
		 };
		 _init();
		 var result={
			self:lay,
			dispose:dispose,
			close:close,
			show:show,
			color:_options.color,
			zIndex:zIndex
		 };
		 return result;
	};
	var ns = Descente;
	ns.overLay = OverLay;
	//弹出层
	$.fn.lightBox=function(options){
		var _options = {
			over: true,
            center: true,
			position:'absolute',
			closeEle:"a.close",
            onShow: function() {},
            onClose: function() {}
		};
 		var opts = $.extend({}, _options, options);
 		function LightBox(othis){
 			var el=$(othis),overLay,zIndex,status;
 			function _init(){
				overLay=new Descente.overLay(opts);
				if (isIE6){opts.position='relative';}
				zIndex=overLay.zIndex+1;
				status="hide";
				el.css('display','none');
				if(opts.closeEle){
					el.find(opts.closeEle).bind('click',function(){
						close();
					})
				}
			};
			function setCenter(){
				el.css({
	            	left:"50%",
	            	marginLeft: - el.outerWidth() / 2,
	           		top : "50%",
	            	marginTop : - el.outerHeight() / 2
				});
				if (opts.position=='absolute'){
					el.css({
	            		marginLeft:Math.max(document.body.scrollLeft, document.documentElement.scrollLeft) - el.outerWidth() / 2,
	            		marginTop : Math.max(document.body.scrollTop, document.documentElement.scrollTop) - el.outerHeight() / 2
					});
				};
				return this;
	        };
			function show(options) {
				opts.over && overLay.show();
				el.css({
					'position':opts.position,
					'zIndex':zIndex
				});
				if (opts.fade){
					el.fadeIn(opts.speed);
				}else{
					el.show();
				};
				if (opts.center) {
					setCenter();
					if (opts.position=='absolute'){
						addEvent(window, "resize", setCenter)
					}
				};
				status="show";
				opts.onShow();
				return this;
	    	};
			function close() {
				removeEvent(window, "resize", setCenter);
				if (opts.fade){
					el.fadeOut(opts.speed);
				}else{
					el.hide();
				};
				status="hide";
				overLay.close();
				opts.onClose();
				return this;
			};
			function dispose() {
				close();
				overLay.dispose();
				overLay=null;
				el=null;
				return this;
			};
			function attr(obj){
				for(var i in obj){
					opts[i]=obj[i]
				}
				return this;
			}
			function getStatus(){
				return status;
			};
			_init();
			return {
				self:el,
				lay:overLay,
				zIndex:zIndex,
				getStatus:getStatus,
				center:opts.center,
				over:opts.over,

				attr:attr,
				setCenter:setCenter,
				show:show,
				hide:close,
				dispose:dispose
			};
 		};
		return this.map(function(){
			if (!$.data(this, 'lightBox')) {
				var _lightBox=new LightBox(this)
	            $.data(this, 'lightBox',_lightBox);
	            return _lightBox;
	        }else{
	        	return  $.data(this, 'lightBox');
	        }
	     }).get(0);
    };
})(jQuery);

function KDMZ_init(){
	var KDMZ=(function(){
		var User=false;
		var ex,
			cancelSelect={},
			select_node={},
			pluginCon,
			isFireEvent=false,
			contentNode,
			commentid=null,
			select_lighter,
			Url,
			isUpdate,
			hasContent=false,
			mouseOffset=null,
			eTarget,
			appearPlace="right",
			timeout=null,
			isAddSearch=false;
		var locationUrl={
			exclude:[
				"special.kcis.cn",
				'http://mz.kcis.cn'
			]
		};
		/*
		// * getRandom 取随机数
		// * @params  a(开始),b(结束)
		// */
		function getRandom(a, b) {
			return Math.round(Math.random() * (b - a) + a);
		};
		var kdPlugin={
			str_controller:function(){
				var kd_controller="";
				kd_controller+='<div class="kdmz-tipsfun inkdnet">';
				kd_controller+='<div class="kdmz-tipsfun-cat"><span></span><div class="kdmz-tipsfun-cat-cont"><b>猫爪</b>-让批注成为习惯<br/><small>凯迪网络出品</small></div></div>';
				kd_controller+='<div class="kdmz-tipsfun-cat-text">悦读更私密，分享更安全，一键安装，即插即用，一插就懂。更有机会赢取十万现金大奖！</div>';
				kd_controller+='<a class="kdmz-tipsfun-cat-btn" target="_blank" href="';
				kd_controller+=lbox_cat.url;
				kd_controller+='">立即安装</a>'
				kd_controller+='<span class="kdmz-tipsfun-arrow"></span>';
				kd_controller+='</div>';
				return kd_controller;
			},
			init:function(){
				var _ele_controller=$(kdPlugin.str_controller()).appendTo('body');
			 	$(_ele_controller).bind('mousedown',function(e){
			 		e.preventDefault();
			 		e.stopPropagation();
			 	}).bind('mouseup',function(e){
			 		e.preventDefault();
			 		e.stopPropagation();
			 	});
			 	_ele_controller=$(_ele_controller).lightBox({opacity:0,center:false,over:false});
			 	return {
			 		ele_controller:_ele_controller
			 	};
			}
		}
		function kdPluginInit(){
			return kdPlugin.init();
		};
		function pageEvent(){
		 	$('body').bind('mousedown',function(e){
		 		eTarget=e.target;
		 		//将导致右键无法复制
		 		//if($(contentNode).getHighlighter()){$(contentNode).getHighlighter().removeAllRanges()};
				pluginCon.ele_controller.hide();
		 		//isFireEvent=true;
				mouseOffset={
					top:e.pageY,
					left:e.pageX
				};
			});
		}
		function init(){
			ex= new ExtractContentJS.LayeredExtractor();
			ex.addHandler( ex.factory.getHandler('Heuristics') );
			var res = ex.extract(document);
			if (res.isSuccess) {
				//console.log(res)
				//var _html=escape(res.content.asNode().innerHTML);
				//console.log(unescape(_html))
			 	//res.url;   // URL string
			  	//res.title; // title string
			  	//res.engine; // 抽出に用いたハンドラそのもの
			  	//res.content; // コンテンツクラスのインスタンス(後述)
			  	contentNode=res.content.asNode();
			  	if(contentNode.nodeName.toLowerCase()=="#text"){return;}
			  	hasContent=true;
			  	bindWinResize();
			  	$(contentNode).find('img').each(function(){$(this).attr('src',this.src);});
			  	$(contentNode).find('link').each(function(){$(this).attr('href',this.href);});
			  	Url=res.url;
			  	var _url_index=Url.indexOf('#');
			  	if(_url_index>=0){
			  		Url=Url.substring(0,_url_index)
			  	};
			}
		};
		function bindHighlight(){
			$.textHighlighter.createWrapper = function(options) {
			  	//return $('<span></span>').addClass(options.highlightedClass).css('background', "#ffff7b");
			  	return $('<span></span>').addClass(options.highlightedClass).css('borderBottom', "2px solid #e55c65");
			};
		  	$(contentNode).textHighlighter({
		  		onBeforeHighlight:function(range){
		  			reductionBefore();
		  			if(range.toString().length<5){
		  				return false
		  			}
		  			else{
		  				return true;
		  			};
		  		},
		  		onAfterHighlight:function(highlights,range,e){
		  			e=e||window.event;
		 			var date=new Date();
		 			var _time=date.getTime()+getRandom(100,999).toString();
		 			for(i=0,m=highlights.length;i<m;i++){	
		 				var _highlights=$(highlights[i]);
		 				_highlights.addClass('kd'+_time);
		 				_highlights.attr('data','kd'+_time);
		 			};
		 			select_node={
		 				id:'kd'+_time,
		 				highlights:highlights,
		 				range:range
		 			};
		 			commentid=select_node.id;
		  		}
		  	})
		  	$('body').bind('mouseup',function(e){
		  		clearTimeout(timeout);
		  		timeout=setTimeout(function(e){
		  			if($('body').attr('kdmzLoad') && $('body').attr('kdmzLoad').toString()=='1'){		  			
			  			$('body').unbind('mouseup');
			  			$('body').unbind('mousedown');
			  			return;
			  		}
		 			select_node={};
		 			var range = getSelectionText();
		 			if(range.toString().length<5 || (!$(contentNode).has($(eTarget)).length && contentNode!=eTarget)){
		 				pluginCon.ele_controller.hide();
		 				return;
		 			};
		 			isFireEvent=false;
		 			$('#kdmz-tipsfun-btnCancel span').html('取消');
		 			showCcontroller(e);
		  		},50)
		  	});
		}
	
		function getSelectionText() {
			if(window.getSelection()) {
				return window.getSelection().toString();
			} else if(document.selection && document.selection.createRange) {
			  	return document.selection.createRange().text;
			}
			return '';
		}
		//还原上次标注
		function reductionBefore(){
			cancelSelect={};
			select_node={};
			/*
			if(cancelSelect.highlights){
				//alert(cancelSelect.highlights)
				$(contentNode).getHighlighter().removeHighlights(cancelSelect.highlights);
		 		//fixBind();
		 	}
		 	*/
		}
		function showCcontroller(){
			var contentNodeOffset=getContentNodeOffset();
			if($('body').width()-(contentNodeOffset.left+contentNodeOffset.width+10)<340){
				appearPlace="left";
				pluginCon.ele_controller.self.addClass('kd-onleft');
				pluginCon.ele_controller.self.css({
				//left:e.pageX-75,
					left:contentNodeOffset.left-80,
					top:(mouseOffset.top||0)-10
				});
			}else{
				appearPlace="right";
				pluginCon.ele_controller.self.removeClass('kd-onleft');
				pluginCon.ele_controller.self.css({
				//left:e.pageX-75,
					left:contentNodeOffset.left+contentNodeOffset.width+10,
					top:mouseOffset.top-10
				});
			}
			
			pluginCon.ele_controller.show();
		}
		function getContentNodeOffset(){
			var _offset=$(contentNode).offset();
			if(!_offset){return};
		  	var contentNodeOffset={
		  		left:_offset.left||0,
		  		top:_offset.top||0,
		  		width:$(contentNode).width()||0,
		  		height:$(contentNode).height()||0
		  	};
		  	return contentNodeOffset;
		}
		function doWindResize(){
			var contentNodeOffset=getContentNodeOffset();
			if(pluginCon && mouseOffset){
				if($('body').width()-(contentNodeOffset.left+contentNodeOffset.width+10)<340){
					appearPlace="left";
					pluginCon.ele_controller.self.addClass('kd-onleft');
					pluginCon.ele_controller.self.css({
					//left:e.pageX-75,
						left:contentNodeOffset.left-80,
						top:(mouseOffset.top||0)-10
					});
				}else{
					appearPlace="right";
					pluginCon.ele_controller.self.removeClass('kd-onleft');
					pluginCon.ele_controller.self.css({
					//left:e.pageX-75,
						left:contentNodeOffset.left+contentNodeOffset.width+10,
						top:(mouseOffset.top||0)-10
					});
				}
		  		
		  	}
		}
		function bindWinResize(){
			//getContentNodeOffset();
			var _avoidfn=avoidfn(doWindResize,100);
			$(window).bind('resize',function(){
				_avoidfn();
			})
		}
		//延时触发
		function avoidfn(fn,delay){
		    var timer= null;  
		    return function(){  
		        var args = arguments,othis = this;
		        clearTimeout(timer);  
		        timer = setTimeout(function(){  
		            fn.apply(othis, args);  
		        }, delay);  
		    };  
		}
		function pageInit(){
			init();
			if(hasContent){
				pluginCon=kdPluginInit();
				bindHighlight();
				pageEvent();
			}
		};
		return {pageInit:pageInit}
	})()
	return KDMZ;
}
function document_ready(){
	if(!lbox_cat.browser){return}
	var KMMZ_OBJ=KDMZ_init();
	KMMZ_OBJ.pageInit();
}
$(function(){
	document_ready();
})


var lbox_cat=(function(){
  var ua = navigator.userAgent.toLowerCase();
  var is360se = ua.indexOf('360se')>-1 ? true : false;
  var isSogouse=ua.indexOf('se 2.x')>-1 ? true : false;
  var isChrome =ua.indexOf('chrome')>-1 ? true : false;
  var _browser_name,_browser_id=false,_url="https://chrome.google.com/webstore/detail/猫爪/opbkdongomddkidjiciheaflkbiclhpo";
  if(is360se){
    _browser_name="360浏览器";
    _browser_id="360";
    _url='https://ext.se.360.cn/webstore/detail/kkohceeegimhjofdkdfdpjmgmeomgkng';
  }else if(isSogouse){
     _browser_name="搜狗浏览器";
     _browser_id="sogou";
     _url='http://ie.sogou.com/app/app_4163.html';
  }else if(isChrome){
  	 _browser_id="chrome";
     _browser_name="谷歌Chrome浏览器";
  }
 return {
 	browser:_browser_id,
 	url:_url
 }
})(jQuery)
})();