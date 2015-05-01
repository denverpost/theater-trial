$j=jQuery.noConflict();

function scrollDownTo(whereToScroll, scrollOffset) {
    scrollOffset = typeof scrollOffset !== 'undefined' ? scrollOffset : 60;
    if ($j(whereToScroll).length) {
        $j('html,body').animate({
            scrollTop: ($j(whereToScroll).offset().top - scrollOffset)
        }, 300);
    } else {
        var new_url = window.location.href.split('#')[0];
        window.history.replaceState('', document.title, new_url);
    }
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

var dirPath = window.location.protocol + '//' + window.location.hostname + window.location.pathname;
var pathRoot = dirPath.substring(0, dirPath.lastIndexOf('/')) + '/';
var titleRoot = document.title;
var current = '';

function load_omniture() {
    var omni = $j('#omniture').html();
    $j('#omniture').after('<div id="new_omni">' + omni + '</div>');
}
function build_url(pageNum) {
    var url = pathRoot + '#page' + pageNum;
    return url;
}
function build_title(pageNum) {
    var title = titleRoot + ' - Page ' + pageNum;
    return title;
}
function rewrite_url(pageNum) {
    var url = build_url(pageNum);
    var new_title = build_title(pageNum);
    document.title = new_title;
    window.history.replaceState('', new_title, url);
}
function new_view(pageNum,callback) {
    rewrite_url(pageNum);
    if (typeof callback === "function") {
        callback();
    }
}