$(document).ready(function() {

		$(".menu-btn").click(function() {
			$("body").removeClass("search-open").toggleClass("menu-open");
			return false;
		});
});