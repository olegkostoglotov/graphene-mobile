jQuery(document).ready(function($) {
	
	// Toggle submenu
	$('.menu > .menu-item-ancestor > a').click(function(e){
		if ( $(this).next().css('display') != 'block' ) {
			e.preventDefault();
			
			$('.sub-menu').hide();
			$(this).next().toggle();
			var margin = $(this).next().height() + 20;
			$('#nav').css('margin-bottom', margin + 'px');
		}
	});
	
	// Add margin to #nav if submenu item is selected
	var margin = $('.menu-item-ancestor.current-menu-ancestor .sub-menu').height() + 20;
	if ( ! margin ) height = 0;
	$('#nav').css('margin-bottom', margin + 'px');
	
});

/* Redirect on select, for select dropdown menu */
window.onload = gmobileDropdownSelect;
function gmobileDropdownSelect(){
	var getElementsByClassName = function (a, b, c) {
		if (document.getElementsByClassName) {
			getElementsByClassName = function (a, b, c) {
				c = c || document;
				var d = c.getElementsByClassName(a),
					e = b ? new RegExp("\\b" + b + "\\b", "i") : null,
					f = [],
					g;
				for (var h = 0, i = d.length; h < i; h += 1) {
					g = d[h];
					if (!e || e.test(g.nodeName)) {
						f.push(g)
					}
				}
				return f
			}
		} else if (document.evaluate) {
			getElementsByClassName = function (a, b, c) {
				b = b || "*";
				c = c || document;
				var d = a.split(" "),
					e = "",
					f = "http://www.w3.org/1999/xhtml",
					g = document.documentElement.namespaceURI === f ? f : null,
					h = [],
					i, j;
				for (var k = 0, l = d.length; k < l; k += 1) {
					e += "[contains(concat(' ', @class, ' '), ' " + d[k] + " ')]"
				}
				try {
					i = document.evaluate(".//" + b + e, c, g, 0, null)
				} catch (m) {
					i = document.evaluate(".//" + b + e, c, null, 0, null)
				}
				while (j = i.iterateNext()) {
					h.push(j)
				}
				return h
			}
		} else {
			getElementsByClassName = function (a, b, c) {
				b = b || "*";
				c = c || document;
				var d = a.split(" "),
					e = [],
					f = b === "*" && c.all ? c.all : c.getElementsByTagName(b),
					g, h = [],
					i;
				for (var j = 0, k = d.length; j < k; j += 1) {
					e.push(new RegExp("(^|\\s)" + d[j] + "(\\s|$)"))
				}
				for (var l = 0, m = f.length; l < m; l += 1) {
					g = f[l];
					i = false;
					for (var n = 0, o = e.length; n < o; n += 1) {
						i = e[n].test(g.className);
						if (!i) {
							break
						}
					}
					if (i) {
						h.push(g)
					}
				}
				return h
			}
		}
		return getElementsByClassName(a, b, c)
	},
	dropdowns = document.getElementsByTagName('select');
	for (i = 0; i < dropdowns.length; i++)
	if (dropdowns[i].className.match('dropdown-menu')) dropdowns[i].onchange = function () {
		if (this.value != '' && this.value != '0' && this.value != '-1') document.location.href = this.value;
	}
}

/* Detects the device orientation and add .portrait and .landscape classes to the <body> element */
(function(){
	var init = function() {
	  var updateOrientation = function() {
		var orientation = window.orientation;
		switch(orientation) {
		  case 90: case -90:
			orientation = 'landscape';
		  break;
		  default:
			orientation = 'portrait';
		}
		document.body.parentNode.setAttribute('class', orientation);
	  };
	  window.addEventListener('orientationchange', updateOrientation, false);
	  updateOrientation();
	}
	window.addEventListener('DOMContentLoaded', init, false);
})();