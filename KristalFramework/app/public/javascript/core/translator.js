/**
 * 
 * HOW TO USE SWITCH LANGUAGES:
 * 
 * <div id="language-selection">
 *     <label id="fi-button" switchLanguage="fi">FI</label>
 *     <label id="en-button" switchLanguage="en">EN</label>
 * </div>
 * 
 * 
 * 
 * HOW TO USE:
 * 
 * Normal Texts:
 * <p translationKey="TRANSLATION_KEY">default text</p>
 * 
 * Button values:
 * <button type="submit" class="btn btn-primary" translationKey="TRANSLATION_KEY">default text</button>
 * 
 * Input placeholders:
 * <input type="email" translationKey="TRANSLATION_KEY" placeholder="default text">
 * 
 * Tooltips:
 * <a href="#" data-bs-toggle="tooltip" tooltipTranslationKey="TRANSLATION_KEY" data-bs-title="default text" translationKey="TRANSLATION_KEY">default text</a>
 * 
 */



const kristal_language_key = "Kristal_Language";
let kristal_language;
let kristal_translations;
let kristal_translation_url = "";


// Get translations
$(document).ready(function() {
    kristal_language = localStorage.getItem(kristal_language_key) || getVariable("language") || "en";
    kristal_translation_url = getVariable("baseURL") + "/app/public/translations/translations.json";

    if (getVariable("production_mode") === "false") {
        const random = Math.round(Math.random() * (999999 - 1)) + 1;
        kristal_translation_url += "?" + random;
    }
    
    $.getJSON(kristal_translation_url, (data) => {
        kristal_translations = data;
        kristal_initLanguage();
    }).fail(() => {
        console.error("Failed to find translations file!\n\nTried to look at url:\n" + kristal_translation_url + "\n\nAlternatively, you may have an error in your JSON format!");
    });
});


function kristal_initLanguage() {

    kristal_updateLanguages();

    $("[switchLanguage]").click(function(event) {
        event.preventDefault();
        $("#" + kristal_language + "-button").removeClass("active");
        kristal_language = $(event.target).attr("switchLanguage");
        localStorage.setItem(kristal_language_key, kristal_language);
        kristal_updateLanguages();
    });
}


function kristal_updateLanguages() {

    $("#" + kristal_language + "-button").addClass("active");

    $("[translationKey]").each(function() {
        $(this).translate();
    });

    $("[tooltipTranslationKey]").each(function() {
        $(this).tooltipTranslate();
    });
}


function setLanguage(new_language) {
    kristal_language = new_language;
    localStorage.setItem(kristal_language_key, new_language);
    kristal_updateLanguages();
}


// Translate normal texts
jQuery.fn.translate = function(key) {

    if (!kristal_translations) return;

    key = key || $(this).attr("translationKey");

    if (kristal_translations.hasOwnProperty(key)) {
        if ($(this).is(":input") && $(this).attr('placeholder') !== undefined) {
            $(this).prop("placeholder", kristal_translations[key][kristal_language]);
        } else {
            $(this).html(kristal_translations[key][kristal_language]);
        }
    } else {
        console.warn("Translator was not able to translate value '" + key + "'!");
    }
}


// Translate tooltips
jQuery.fn.tooltipTranslate = function(key) {

    if (!kristal_translations) return;

    key = key || $(this).attr("tooltipTranslationKey");
	
    if (kristal_translations.hasOwnProperty(key)) {
        $(this).attr("data-bs-title", kristal_translations[key][kristal_language]);
		kristal_reinitializeTooltip(this.get(0));
    } else {
        console.warn("Translator was not able to translate tooltip value '" + key + "'!");
    }
}


// Reinitialize tooltips after translation
function kristal_reinitializeTooltip(element) {

    const bsTooltip = bootstrap.Tooltip.getInstance(element);

    if (bsTooltip) {
        bsTooltip.dispose();
    }

    new bootstrap.Tooltip(element);
}