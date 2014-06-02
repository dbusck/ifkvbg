$(document).ready(function() {

		$(".search-btn").click(function() {
			$("body").removeClass("menu-open").toggleClass("search-open");
			$(".search-open .search-form .search-field").focus();
			$('.search-btn .fi-magnifying-glass').toggleClass('fi-x');
			return false;
		});

		$(".menu-btn").click(function() {
			$("body").removeClass("search-open").toggleClass("menu-open");
			return false;
		});

		$(function() {
			$('a[href*=#]:not([href=#])').click(function() {
				if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
					var target = $(this.hash);
					target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
					if (target.length) {
					$('html,body').animate({
						scrollTop: target.offset().top
					}, 1000);
					return false;
					}
				}
			});
		});
});