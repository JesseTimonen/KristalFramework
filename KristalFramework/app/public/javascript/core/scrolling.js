/*============================================================*\
HOW TO USE

<button id = "scroll-button" onclick = "scrollUp()">Scroll Up</button>
\*============================================================*/


var scroll_time = 500;		// Desired time to scroll, in milliseconds
var required_scroll = 200;	// Amount of pixels needed to scroll down until [scrollup] button appears


// Display [scrollup] button when page has been scrolled down
window.onscroll = function()
{
	if (document.body.scrollTop > required_scroll || document.documentElement.scrollTop > required_scroll)
	{
		$("#scroll-button").fadeIn();
	}
	else
	{
		$("#scroll-button").fadeOut();
	}
};


// Scroll the page to the top after [scrollup] button has been clicked
function scrollUp()
{
	$("html, body").animate({ scrollTop: "0px"}, scroll_time);
}