;if(window.history&&window.history.replaceState){window.history.replaceState(null,null,window.location.href)};;document.addEventListener('DOMContentLoaded',function(){const tooltipEls=document.querySelectorAll('[data-bs-toggle="tooltip"]');tooltipEls.forEach(el=>new bootstrap.Tooltip(el))});;const KRISTAL_DEFAULT_LANGUAGE="en";const KRISTAL_LANGUAGE_KEY="Kristal_Language";const KRISTAL_TRANSLATIONS_URL_PATH="/app/public/translations/translations.json";let kristal_language;let kristal_translation_url;let kristal_translations;$(document).ready(function(){kristal_language=localStorage.getItem(KRISTAL_LANGUAGE_KEY)||getVariable("language")||KRISTAL_DEFAULT_LANGUAGE;kristal_translation_url=getVariable("baseURL")+KRISTAL_TRANSLATIONS_URL_PATH;if(getVariable("production_mode")==="false"){const random=Math.round(Math.random()*(999999-1))+1;kristal_translation_url+="?"+random};$.getJSON(kristal_translation_url,(data)=>{kristal_translations=data;kristal_initTranslations()}).fail(()=>{console.error("Failed to find translations file!\n\nTried to look at url:\n"+kristal_translation_url+"\n\nAlternatively, you may have an error in your JSON format!")})});function kristal_initTranslations(){kristal_updateTranslations();$("[switchLanguage]").click(function(t){t.preventDefault();$("#"+kristal_language+"-button").removeClass("active");kristal_language=$(t.target).attr("switchLanguage");localStorage.setItem(KRISTAL_LANGUAGE_KEY,kristal_language);kristal_updateTranslations()})};function kristal_updateTranslations(){$("#"+kristal_language+"-button").addClass("active");$("[translationKey]").each(function(){$(this).translate()});$("[tooltipTranslationKey]").each(function(){$(this).tooltipTranslate()})};function setLanguage(t){kristal_language=t;localStorage.setItem(KRISTAL_LANGUAGE_KEY,t);kristal_updateTranslations()};jQuery.fn.translate=function(t){if(!kristal_translations)return;t=t||$(this).attr("translationKey");if(kristal_translations.hasOwnProperty(t)){if($(this).is(":input")&&$(this).attr("placeholder")!==undefined){$(this).prop("placeholder",kristal_translations[t][kristal_language])}
else if($(this).is("img")){$(this).attr("alt",kristal_translations[t][kristal_language])}
else{$(this).html(kristal_translations[t][kristal_language])}}
else{console.warn("Translator was not able to translate value '"+t+"'!")}};jQuery.fn.tooltipTranslate=function(t){if(!kristal_translations)return;t=t||$(this).attr("tooltipTranslationKey");if(kristal_translations.hasOwnProperty(t)){$(this).attr("data-bs-title",kristal_translations[t][kristal_language]);kristal_reinitializeTooltip(this.get(0))}
else{console.warn("Translator was not able to translate tooltip value '"+t+"'!")}};function kristal_reinitializeTooltip(t){const bsTooltip=bootstrap.Tooltip.getInstance(t);if(bsTooltip){bsTooltip.dispose()};new bootstrap.Tooltip(t)};


/* Generated at: 30.10.2023 18:24:05 */