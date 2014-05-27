//$(document).ready(function() {

		$(".menu-btn").click(function() {
			$("body").removeClass("search-open").toggleClass("menu-open");
			return false;
		});
		$(".search-btn").click(function() {
			$("body").removeClass("menu-open").toggleClass("search-open");
			$('.overlay .search-form input').focus();
			return false;
		});



		var disqus_shortname = 'soggydollar'; // required: replace example with your forum shortname

        /* * * DON'T EDIT BELOW THIS LINE * * */

        /* * * Number of comments function * * */
        (function () {
	        var s = document.createElement('script'); s.async = true;
	        s.type = 'text/javascript';
	        s.src = '//' + disqus_shortname + '.disqus.com/count.js';
	        (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
	    }());

	    /* * * Main comment section function * * */
        (function() {
            var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
            dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
            (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
        })();

//});