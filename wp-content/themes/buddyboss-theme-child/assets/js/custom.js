/* This is your custom Javascript */
jQuery(document).ready(function(){
	if(jQuery("body").hasClass("activation")){
		jQuery(".activation #activate-page a").attr("href", "https://mbmprime.com/login-2/");
	}
	if(jQuery("body").hasClass("page-id-350")){
		if(jQuery("div").hasClass("mepr_error")){
			window.location.replace("https://mbmprime.com/");
		}
	}
});