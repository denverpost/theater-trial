$j=jQuery.noConflict();

function scrollDownTo(whereToScroll, scrollOffset) {
    scrollOffset = typeof scrollOffset !== 'undefined' ? scrollOffset : 60;
    $j('html,body').animate({
        scrollTop: ($j(whereToScroll).offset().top - scrollOffset)
    }, 300);
}

if (window.location.hash) {
	var hash = window.location.hash;
	scrollDownTo(hash);
}

function inIframe () {
    try {
        return window.self !== window.top;
    } catch (e) {
        return true;
    }
}

if ( inIframe() ) {
	$j(function() {
	    $j("a[href^='http://']").attr("target","_top");
	});
}