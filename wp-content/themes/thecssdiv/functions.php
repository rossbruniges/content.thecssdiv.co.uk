<?php

function add_analytics () {
	
	if (!current_user_can('manage_options')) {
	    if (defined('GA_CODE')) {
		echo "<script type='text/javascript'>
  			var _gaq = _gaq || [];
  			_gaq.push(['_setAccount', '" . GA_CODE . "']);
  			_gaq.push(['_trackPageview']);
  			(function() {
    			var ga = document.createElement('script'); ga.type = 'text/javascript';
				ga.async = true;
   	 			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    			var s = document.getElementsByTagName('script')[0];
				s.parentNode.insertBefore(ga, s);
  			})();
			</script>";
		}
	}
}

add_action('wp_head', 'add_analytics', 100);

?>