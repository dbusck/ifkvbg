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
});