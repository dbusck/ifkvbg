(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/sv_SE/sdk.js#xfbml=1&appId=273167479487244&version=v2.0";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

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

		$('.player').click(function() {
			$(this).toggleClass('playercard-open');
			$('.player').not(this).removeClass('playercard-open');
		});

		$(function() {
			$('a[href*=#]:not([href=#])').click(function() {
				if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
					var target = $(this.hash);
					target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
					if (target.length) {
					$('html,body').animate({
						scrollTop: target.offset().top
					}, 500);
					return false;
					}
				}
			});
		});
});