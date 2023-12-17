$(document).ready(function ()
{
    // Hide helper if needed
    if (localStorage.getItem("kristal_framework_helper_hidden") == "true")
    {
        $("#framework-helper").hide();
    }
    else
    {
        $("#framework-mini-helper").hide();
    }


    // Main link (Kristal Framework) restores helper back to default state
    $("#helper-title").click(function()
    {
        // Activate main links
        $("#link-documentation").show(300).removeClass("active");
        $("#link-media-library").show(300).removeClass("active");
        $("#link-actions").show(300).removeClass("active");
        $("#link-creator").show(300).removeClass("active");

        // Hide helper navigations
        $("#navigation-documentation").hide(0).removeClass("active");
        $("#navigation-actions").hide(0).removeClass("active");
        $("#navigation-creator").hide(0).removeClass("active");

        // Remove active class from child navigations
        $("#action-database-backup-link").removeClass("active");
        $("#action-import-database-link").removeClass("active");
        $("#action-clear-database-link").removeClass("active");

        // Hide child navigations
        $("#actions-database-backup").hide(0);
        $("#actions-import-database").hide(0);
        $("#actions-clear-database").hide(0);
    });



    /* ================================= 1st level of links ================================= */
    $("#link-documentation").click(function()
    {
        $(this).toggleClass("active");
        $("#navigation-documentation").slideToggle(300);
        $("#link-actions").toggle(300);
        $("#link-creator").toggle(300);
        $("#link-media-library").toggle(300);
    });

    $("#link-actions").click(function()
    {
        $(this).toggleClass("active");
        $("#navigation-actions").slideToggle(300);

        $("#action-database-backup-link").show(0);
        $("#action-import-database-link").show(0);
        $("#action-clear-database-link").show(0);

        $("#link-documentation").toggle(300);
        $("#link-creator").toggle(300);
        $("#link-media-library").toggle(300);
    });

    $("#link-creator").click(function()
    {
        $(this).toggleClass("active");
        $("#navigation-creator").slideToggle(300);
        $("#link-documentation").toggle(300);
        $("#link-actions").toggle(300);
        $("#link-media-library").toggle(300);
    });



    /* ================================= 2nd level of links ================================= */
    $("#action-database-backup-link").click(function()
    {
        $(this).toggleClass("active");
        $("#actions-database-backup").slideToggle(300);
        $("#action-import-database-link").toggle(300);
        $("#action-clear-database-link").toggle(300);
        $("#link-actions").toggle(300);
    });

    $("#action-import-database-link").click(function()
    {
        if (!$(this).hasClass("active"))
        {
            $("input[id='helper-choose-database-import']").click();
        }
        $(this).toggleClass("active");
        $("#actions-import-database").slideToggle(300);
        $("#action-database-backup-link").toggle(300);
        $("#action-clear-database-link").toggle(300);
        $("#link-actions").toggle(300);
    });

    $("#action-clear-database-link").click(function()
    {
        $(this).toggleClass("active");
        $("#actions-clear-database").slideToggle(300);
        $("#action-import-database-link").toggle(300);
        $("#action-database-backup-link").toggle(300);
        $("#link-actions").toggle(300);
    });



    /* ================================= 3rd level of links ================================= */
    $(".database-backup-action-link").click(function(event)
    {
        event.preventDefault();
        $("#form-database-backup input[name='database']").val($(this).attr("database"));
        $("#form-database-backup").submit();
    });

    $(".cancel-database-backup-action").click(function(event)
    {
        event.preventDefault();
        $("#action-database-backup-link").toggleClass("active");
        $("#actions-database-backup").slideToggle(300);
        $("#action-clear-database-link").toggle(300);
        $("#action-import-database-link").toggle(300);
        $("#link-actions").toggle(300);
    });

    $(".import-database-action-link").click(function(event)
    {
        event.preventDefault();
        if ($(this).text() == "None Selected")
        {
            $("input[id='helper-choose-database-import']").click();
            return;
        }
        $("#helper-import-database-form").submit();
    });

    $(".cancel-import-database-action").click(function(event)
    {
        event.preventDefault();
        document.getElementById("helper-choose-database-import").value = "";
        $(".import-database-action-link").text("None Selected");
        $("#action-import-database-link").toggleClass("active");
        $("#actions-import-database").slideToggle(300);
        $("#action-database-backup-link").toggle(300);
        $("#action-clear-database-link").toggle(300);
        $("#link-actions").toggle(300);
    });

    $(".clear-database-action-link").click(function(event)
    {
        event.preventDefault();
        if ($(this).attr("value") !== "cancel")
        {
            $("#form-clear-database input[name='database']").val($(this).attr("value"));
            $("#form-clear-database").submit();
        }
        else
        {
            $("#action-clear-database-link").toggleClass("active");
            $("#actions-clear-database").slideToggle(300);
            $("#action-database-backup-link").toggle(300);
            $("#action-import-database-link").toggle(300);
            $("#link-actions").toggle(300);
        }
    });



    /* ======================================= Others ======================================= */
    $("#close-framework-helper").click(function()
    {
        localStorage.setItem("kristal_framework_helper_hidden", "true");
        $("#framework-mini-helper").fadeIn(1000);
        $("#framework-helper").slideUp(500);
    });

    $("#framework-mini-helper").click(function()
    {
        localStorage.setItem("kristal_framework_helper_hidden", "false");
        $("#framework-mini-helper").fadeOut(300);
        $("#framework-helper").slideDown(500);
    });

    // Prvent enter submitting framework helper forms
    $(".framework-form input").keydown(function(event)
    {
        if (event.keyCode == 13)
        {
            event.preventDefault();
            return false;
        }
    });



    /* ===================================== Validations ==================================== */
    // Validate creating controller
    $("#controller-name").keyup(function()
    {
        $(this).val($(this).val().replace(/[^a-zA-Z]/g,''));
    });

    // Add required attribute to form inputs when needed
    $(".field-name").keyup(function()
    {
        var index = $(this).attr("name").slice(-1);
        if (isNaN(index)){ return; }

        if ($(this).val() == "")
        {
            $("#field-name-" + index).prop("required", false);
            $("#field-type-" + index).prop("required", false);
            $("#type-length-" + index).prop("required", false);
        }
        else
        {
            $("#field-name-" + index).prop("required", true);
            $("#field-type-" + index).prop("required", true);
            if ($("#field-type-" + index + " option:selected").attr("passLength") !== "true")
            {
                $("#type-length-" + index).prop("required", true);
            }
        }
    });

    // Add required attribute to form inputs when needed
    $(".field-type").change(function()
    {
        index = $(this).attr("name").slice(-1);
        if (isNaN(index)){ return; }

        if ($("#field-type-" + index + " option:selected").attr("passLength") !== "true")
        {
            $("#type-length-" + index).prop("required", true);
        }
        else
        {
            $("#type-length-" + index).prop("required", false);
        }
    });

    // Validate entity form submit
    $("#create-entity-submit").on("click", function(e)
    {
        e.preventDefault();
        if (validate_required_inputs("create-entity-form"))
        {
            $("#create-entity-form").submit();
        }
    });

    // Validate controller form submit
    $("#create-controller-submit").on("click", function(e)
    {
        e.preventDefault();
        if (validate_required_inputs("create-controller-form"))
        {
            $("#create-controller-form").submit();
        }
    });


    // Media library search
    var media_library_timeout;
    var media_library_timeout_delay = 200;
    var media_library_animation_duration = 500;
    
    
    $("#media-library-search").keyup(function()
    {
        search = $(this).val();
    
        clearTimeout(media_library_timeout);
        media_library_timeout = setTimeout(function()
        {
            filterMediaLibrary(search);
        }, media_library_timeout_delay);
    });
    
    
    // Filter events when search bar is used
    function filterMediaLibrary(search)
    {
        // Loop through all events and see if search word is found
        $('.media-library-image').each(function()
        {
            var image_name = $(this).attr("alt");
    
            if (typeof image_name != 'string') { image_name = ""; }
    
            // Check if search word matches the event name
            if (image_name.toLowerCase().includes(search.toLowerCase()))
            {
                $(this).show(media_library_animation_duration);
            }
            else
            {
                $(this).hide(media_library_animation_duration);
            }
        });
    }
});



function validate_required_inputs(form_id)
{
    var isValid = true;

    $(".framework-helper-feedback").each(function()
    {
        $(this).remove();
    });

    $("#" + form_id + " input[required]").each(function()
    {
        if ($(this).val() == "")
        {
            $(this).after("<p class = 'framework-helper-feedback' style = 'color: red;'>Required</p>");
            isValid = false;
        }
    });

    if (!isValid)
    {
        $("#" + form_id).after("<p class = 'framework-helper-feedback' style = 'color: red; text-align: center;'>Some of the required fields have been left empty!</p>");
    }

    return isValid;
}



function updateDatabaseImportFile()
{
    var fullPath = $("#helper-choose-database-import").val();

    if (fullPath)
    {
        var startIndex = (fullPath.indexOf('\\') >= 0 ? fullPath.lastIndexOf('\\') : fullPath.lastIndexOf('/'));
        var filename = fullPath.substring(startIndex);
        if (filename.indexOf('\\') === 0 || filename.indexOf('/') === 0)
        {
            filename = filename.substring(1);
        }

        $(".import-database-action-link").text("Import " + filename);
    }
    else
    {
        $(".import-database-action-link").text("None Selected");
    }
}
