$(function() {
// New initialise visitor routines
var browsertype = navigator.userAgent;
var thispageUrl = document.URL;
if ((browsertype.indexOf("Googlebot") == -1) && (areCookiesEnabled())) {
// We're not Google and can store cookies, so continue

		// 1. Activate the browser detect process of jreject when no cookie 'browserDetected' is found
        if (!readCookie('browserDetected')) {
            $.reject({
                reject: {
                    //block all browsers (all: true = all browsers blocked)
                    all: false, 
                    msie5: true, msie6: true, msie7: true,
                    firefox1: true, firefox2: true, firefox3: true
                },
                //don't need to show the jreject window
                browserShow: false, 
                //done when we find a rejected browser
                afterReject: function () {
                    //set cookies
                    createCookie('browserPrevious', document.URL);
                    createCookie('browserDetected', true);
                    window.location.href = REDIRECT_URL;//redirect to browser page
					return; // exit initialise visitor routine
                },
                //done when we do not find a rejected browser
                onFail: function () {
                    //set cookie
                    createCookie('browserDetected', true, 30);
                }
            });
        }
		// Removed Welcome popup code until this is implemented

}
});