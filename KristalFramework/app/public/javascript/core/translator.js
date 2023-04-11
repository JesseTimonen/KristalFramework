/* =======================================================================================================================
HOW TO USE

PHP
	?><script>document.addEventListener('DOMContentLoaded', function(){ $("#ELEMENT_ID").html("<p translationKey = 'TRANSLATION_KEY'>Loading...</p>"); });</script><?php

JAVASCRIPT
	$("#ELEMENT_ID").html("<p translationKey = 'TRANSLATION_KEY'>Loading...</p>");
	$("#ELEMENT_ID").translate("TRANSLATION_KEY"); // TRANSLATION_KEY is optional, if left empty translation uses the element's translationKey attribute

HTML
	<h2 translationKey = "TRANSLATION_KEY">Loading...</h2>
	<label><label translationKey = "TRANSLATION_KEY">this is two translations</label> <a href = "#" translationKey = "TRANSLATION_KEY">in one element</a></label>

CHANGE LANGUAGES
	<ul class = "navbar-nav ml-auto nav-flex-icons">
		<li class = "nav-item"><a class = "nav-link" switchLanguage = "fi">FI</a></li>
		<li class = "nav-item"><a class = "nav-link" switchLanguage = "en">EN</a></li>
	</ul>

\*======================================================================================================================= */


const language_key = "Kristal_Language";  // Language settings are saved under this name to local storage
let language;                             // Language used to translate texts
let translations;                         // Contains the data received from translations.json
let url = "";


$(document).ready(function()
{
	language = localStorage[language_key] || getVariable("language") || "en";
	url = getVariable("baseURL") + "/app/public/translations/translations.json";

	// Prevent cache if production mode is disable
	if (getVariable("production_mode") === "false")
	{
		const random = Math.round(Math.random() * (999999 - 1)) + 1;
		url += "?" + random;
	}
	
	// Get translations from json file
	$.getJSON(url, (data) => {
		translations = data;
		initLanguage();
	}).fail(() => {
		console.error("Failed to find translations file!\n\nTried to look at url:\n" + url + "\n\nAlternatively you may have an error in your json format!");
	});
});


function initLanguage()
{
	updateLanguages();

	$("[switchLanguage]").click(function(event)
	{
		event.preventDefault();
		$("#" + language + "-button").removeClass("active");	// Remove active class from previous language
		language = $(event.target).attr("switchLanguage");		// Get new language
		localStorage[language_key] = language;					// Store language to local storage
		updateLanguages();
	});
}


// Update language and texts
function updateLanguages()
{
	// Add active class to the new language
	$("#" + language + "-button").addClass("active");

	// Loop through every element with [translationKey] attribute
	$("[translationKey]").each(function()
	{
		$(this).translate();
	});
}


// Set language for custom language controllers
function setLanguage(new_language)
{
	language = new_language;
	localStorage[language_key] = new_language;
	updateLanguages();
}


// Translate texts
jQuery.fn.translate = function(key)
{
	// Return if there are no translations
	if (!translations) return;

	// Get translation key
	key = (key != null) ? key : $(this).attr("translationKey");

	// Make sure translation for requested key exists
	if (translations.hasOwnProperty(key))
	{
		if (($(this).is(":input") && $(this).attr('placeholder') !== undefined))
		{
			$(this).prop("placeholder", translations[key][language]);
		}
		else {
			$(this).html(translations[key][language]);
		}
	}
	else
	{
		console.warn("Translator was not able to translate value '" + key + "'!");
	}
}