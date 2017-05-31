window.onload = function() {
	var h = 2000;

	function c(r, s) {
		if(!r) {
			return []
		}
		var k = [];
		var q = new RegExp("(^| )" + s + "( |\\d|$)");
		var p = r.getElementsByTagName("*");
		for(var o = 0, n = p.length; o < n; o++) {
			if(q.test(p[o].className)) {
				k.push(p[o])
			}
		}
		return k
	}

	function l(o, n, q) {
		var p = c(o, n);
		for(var j in p) {
			if(!p[j] || (q && j == 0)) {
				continue
			} else {
				p[j].parentNode ? p[j].parentNode.removeChild(p[j]) : p[j]
			}
		}
		return o
	}

	function i(p, o) {
		if(!p) {
			return
		}
		if(Object.prototype.toString.call(p) === "[object Array]") {
			for(var j in p) {
				if(p[j]) {
					for(var q in o) {
						p[j].style[q] = o[q]
					}
				}
			}
		} else {
			for(var j in o) {
				p.style[j] = o[j]
			}
		}
		return p
	}

	function g(k, n, j) {
		if(!k) {
			return
		}
		if(k.addEventListener) {
			k.addEventListener(n, j, false)
		} else {
			if(k.attachEvent) {
				k.attachEvent("on" + n, j)
			} else {
				k[n] = j
			}
		}
	}

	function e(n, k, j) {
		i(j ? n : k, {
			display: "none",
			opacity: 0
		});
		i(j ? k : n, {
			display: "block",
			opacity: 1
		})
	}

	function m() {
		var q = this,
			o = 0,
			p = 0,
			n = 0;
		q.init = function(t) {
			q.slider = t;
			q.autoPlayState = !((" " + q.slider.className + " ").indexOf(" no-autoplay ") > -1);
			q.slides = c(q.slider.getElementsByTagName("ul")[0], "num");
			q.playPause = c(q.slider, "cs_play_pause")[0];
			q.btnPlay = c(q.playPause, "cs_play")[0];
			q.btnPause = c(q.playPause, "cs_pause")[0];
			q.arrowPrev = l(c(q.slider, "cs_arrowprev")[0], "num", true);
			q.arrowNext = l(c(q.slider, "cs_arrownext")[0], "num", true);
			q.bullets = c(q.slider, "cs_bullets")[0];
			q.description = c(c(q.slider, "cs_description")[0], "num");
			s();
			k()
		};

		function s() {
			l(q.slider, "cs_anchor", false);
			i(q.slider, {
				overflow: "hidden"
			});
			i([q.playPause, q.autoPlayState ? q.btnPause : q.btnPlay, q.arrowPrev, q.arrowNext, q.arrowPrev.getElementsByTagName("label")[0], q.arrowNext.getElementsByTagName("label")[0]], {
				display: "block",
				opacity: 1
			});
			i(q.slides.concat(q.description), {
				display: "none",
				zIndex: 0,
				opacity: 0,
				filter: "alpha(opacity=0)"
			});
			var u = [];
			for(var t in q.description) {
				var w = c(q.description[t], "cs_title")[0],
					v = c(q.description[t], "cs_descr")[0];
				if(w) {
					u.push(w);
					u.push(c(w, "cs_wrapper")[0])
				}
				if(v) {
					u.push(v);
					u.push(c(v, "cs_wrapper")[0])
				}
			}
			i(u, {
				"-ms-transform": "none",
				transform: "none",
				opacity: 1,
				visibility: "visible",
				filter: "alpha(opacity=100)"
			});
			i(q.slides, {
				left: "0px",
				top: "0px"
			});
			i([q.slides[p], q.description[p]], {
				display: "block",
				zIndex: 3,
				opacity: 1,
				filter: "alpha(opacity=100)"
			});
			i([q.playPause, q.arrowPrev, q.arrowNext], {
				"-ms-transform": "none",
				transform: "none"
			});
			e(q.btnPlay, q.btnPause, q.autoPlayState);
			if(q.autoPlayState) {
				j()
			}
		}

		function k() {
			g(q.arrowPrev, "click", function() {
				r(n - 1 < 0 ? q.slides.length - 1 : n - 1)
			});
			g(q.arrowNext, "click", function() {
				r(n + 1 >= q.slides.length ? 0 : n + 1)
			});
			g(q.bullets, "click", function(t) {
				if(t.srcElement) {
					var u = t.srcElement.className.replace(/num/, "")
				} else {
					if(t.target) {
						var u = t.target.className.replace(/num/, "")
					}
				}
				r(parseInt(u))
			});
			g(q.playPause, "click", function() {
				q.autoPlayState = !q.autoPlayState;
				if(q.autoPlayState) {
					j()
				}
				e(q.btnPlay, q.btnPause, q.autoPlayState)
			})
		}

		function r(v) {
			if(o || v == n) {
				return
			}
			o = 1;
			p = n;
			n = v;
			i(q.slides.concat(q.description), {
				display: "none",
				opacity: 0,
				zIndex: 0,
				filter: "alpha(opacity=0)",
				"-ms-transform": "none",
				transform: "none"
			});
			i(q.slides[p], {
				display: "block",
				zIndex: 1,
				opacity: 1,
				filter: "alpha(opacity=100)"
			});
			i(q.slides[n], {
				zIndex: 2
			});
			i(q.description[n], {
				display: "block",
				zIndex: 3,
				opacity: 1,
				filter: "alpha(opacity=100)"
			});
			var t = 0;
			(function u() {
				if(t > 1) {
					t = 1
				}
				i(q.slides[n], {
					display: "block",
					opacity: t,
					filter: "alpha(opacity=" + t * 100 + ")"
				});
				if(t == 1) {
					i(q.slides[p], {
						display: "none",
						zIndex: 0,
						opacity: 0,
						filter: "alpha(opacity=0)"
					});
					o = 0
				} else {
					setTimeout(u, 15)
				}
				t += 0.05
			})()
		}

		function j() {
			setTimeout(function() {
				if(q.autoPlayState) {
					r(n + 1 >= q.slides.length ? 0 : n + 1);
					j()
				}
			}, h)
		}
	}
	var a = c(document.body, "csslider");
	for(var d = 0, f = a.length; d < f; d++) {
		var b = new m();
		b.init(a[d])
	}
};