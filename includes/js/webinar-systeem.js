//------- Meta box tabs

jQuery(function () {
    jQuery("#tabs").tabs({heightStyle: "content"}).addClass("ui-tabs-vertical ui-helper-clearfix");
    jQuery("#tabs li").removeClass("ui-corner-top").addClass("ui-corner-left");
    jQuery("#tabs").tabs("option", "heightStyle", "content");
    jQuery('#webinarMetaBox .ui-tabs-nav').height(jQuery('#webinarMetaBox .inside').height());
});

jQuery(document).on('click', '#tabs ul li', function () {
    jQuery('#webinarMetaBox .ui-tabs-nav').height(jQuery('#webinarMetaBox .inside').height());
});



//-------------
jQuery(function () {
    jQuery('.color-field').wpColorPicker();
});


// --------------------------- Media uploader

// Uploading files
var file_frame;
jQuery('.wswebinar_uploader').live('click', function (event) {
    var resultId = jQuery(this).attr('resultId');
    var theButtonClicked = this;
    event.preventDefault();
    // If the media frame already exists, reopen it.
    if (file_frame) {
        file_frame.open();
        return;
    }
    // Create the media frame.
    file_frame = wp.media.frames.file_frame = wp.media({
        title: jQuery(this).attr('uploader_title'),
        button: {
            text: jQuery(this).attr('uploader_button_text'),
        },
        multiple: false  // Set to true to allow multiple files to be selected
    });

    // When an image is selected, run a callback.
    file_frame.on('select', function () {
        // We set multiple to false so only get one image from the uploader
        attachment = file_frame.state().get('selection').first().toJSON();
        jQuery('#' + resultId).val(attachment.url);
        var isCheckType = jQuery(theButtonClicked).attr("checktype");
        //if (isCheckType == "yes")
            //runTypeSelectionWatch('#' + resultId);

        file_frame = null;
        // Do something with attachment.id and/or attachment.url here
    });
    // Finally, open the modal
    file_frame.open();
});


function checkImageOrVideoType(theText) {
    if (theText.length < 1)
        return;
    return(theText.match(/\.(jpeg|jpg|gif|png)$/) != null);
}


setTypeSelectionWatch('#regp_vidurl');
setTypeSelectionWatch('#tnxp_tnxmsgvid');
//setTypeSelectionWatch('#replayp_vidurl');


/*
 * 
 * Add the watch for "set the type of Image or Video fields."
 * 
 */
function setTypeSelectionWatch(tThis) {
    jQuery(document).on('focusin', jQuery(tThis), function () {
        var inContent = jQuery(tThis).val();
        jQuery(document).on('focusout', tThis, function (event) {
            var theTexts = jQuery(tThis).val();
            if (inContent == theTexts)
                return;
            //runTypeSelectionWatch(tThis);
        });
    });
}

/*
 * 
 * Set the type of Image or Video fields.
 * 
 */

function runTypeSelectionWatch(tThis) {
    var tTarget = tThis + '_type';
    var theText = jQuery(tThis).val();
    var reslt = checkImageOrVideoType(theText);
    if (reslt)
        jQuery(tTarget).val('image');
    else
        jQuery(tTarget).val('video');

}

/*
 * 
 * Admin notice dismisser
 * 
 */

jQuery(document).on('click', '.wswebinar_adnotice .closeIcon', function (event) {
    jQuery.ajax("index.php?wswebinar_ajax_dismiss=1").done(function (data) {
        if (data)
            jQuery('.wswebinar_adnotice').fadeOut('slow');
    });
    event.preventDefault();
});

/*
 * 
 * Content Type select box functionality
 * 
 */

jQuery(document).on('change', '.lookoutImageButton', function () {
    var ButtnId = jQuery(this).attr('imageUploadButton');
    var ValueFieldId = jQuery(this).attr('valueField');
    if (ButtnId.length < 3)
        return;
    var selected = jQuery(this).val();
    if (selected !== 'image') {
        jQuery('#' + ButtnId).hide();
    } else {
        jQuery('#' + ButtnId).show();
    }
    jQuery('#' + ValueFieldId).val('');
    jQuery('.' + ValueFieldId + '_desc').hide();
    jQuery('.' + ValueFieldId + '_for_' + selected).show();
});

/*
 * 
 * Download attendee list CSV for a give webinar id.
 * 
 */

jQuery(document).on('click', '.exportcsv', function () {
    var thId = jQuery(this).attr('postid');
    window.open("index.php?wswebinar_createcsv=wswebinars&postid=" + thId, '_blank');
});

jQuery(document).on('click', '.exportbcc', function () {
    var thId = jQuery(this).attr('postid');
    window.open("index.php?wswebinar_createbcc=wswebinars&postid=" + thId, '_blank');
});

jQuery(document).on('change', '.quickstatusupdater', function () {
    var webid = jQuery(this).attr('webinar');
    var stat = jQuery(this).val();
    var datas = {action: 'quickchangestatus', webinar_id: webid, status: stat};
    jQuery('#waitingIcon_' + webid).show();
    jQuery.ajax({type: 'POST', data: datas, url: ajaxurl, dataType: 'json'
    }).done(function (data) {
        if (data.status) {
            jQuery('#waitingIcon_' + webid).hide();
            jQuery('#checkIcon_' + webid).fadeIn('slow');
            setTimeout(function () {
                jQuery('#checkIcon_' + webid).fadeOut('slow');
            }, 3000);
        } else {

        }
    });
});

/*
 * 
 * Send Preview Mails - Webinar Settings
 * 
 */
jQuery(function () {
    var previewEmailisInvalid = 1;
    jQuery(".preview-email-textbox").keyup(function () {
        jQuery(".preview-email-textbox").val(jQuery(this).val());
        IsEmail(jQuery(this).val());
    });

    jQuery(".button[data-mail-type='_wswebinar_24hrb4']").click(function () {
        sendPreviewEmailRequest(jQuery(this).data("mail-type"), jQuery("input[type='email'][data-mail-type='_wswebinar_24hrb4']").val(), this);
    });

    jQuery(".button[data-mail-type='_wswebinar_1hrb4']").click(function () {
        sendPreviewEmailRequest(jQuery(this).data("mail-type"), jQuery("input[type='email'][data-mail-type='_wswebinar_1hrb4']").val(), this);
    });

    jQuery(".button[data-mail-type='_wswebinar_wbnreplay']").click(function () {
        sendPreviewEmailRequest(jQuery(this).data("mail-type"), jQuery("input[type='email'][data-mail-type='_wswebinar_wbnreplay']").val(), this);
    });

    jQuery(".button[data-mail-type='_wswebinar_wbnstarted']").click(function () {
        sendPreviewEmailRequest(jQuery(this).data("mail-type"), jQuery("input[type='email'][data-mail-type='_wswebinar_wbnstarted']").val(), this);
    });

    function sendPreviewEmailRequest(whatToRun, emailToSendPreviewEmail, buttonClicked) {
        if (previewEmailisInvalid == 0) {
            jQuery(buttonClicked).attr('disabled', 'disabled');
            jQuery.ajax({
                url: ajaxurl,
                data: {action: 'previewemails', run: whatToRun, email: emailToSendPreviewEmail},
                success: function (data) {
                    animateSendPreviewEmailButton(buttonClicked);
                },
                error: function (a, b, c) {
                    animateSendPreviewEmailButton(buttonClicked, c);
                },
            });
        } else {
            animateSendPreviewEmailButton(buttonClicked);
        }
    }
    function animateSendPreviewEmailButton(buttonToAnimate, status) {
        jQuery(buttonToAnimate).fadeOut(200).delay(300).fadeIn(300).delay(500).fadeOut(200).delay(200).fadeIn(200);
        setTimeout(
                function () {
                    if (previewEmailisInvalid == 1) {
                        jQuery(buttonToAnimate).val("Invalid Email");
                    } else {
                        if (status != undefined) {
                            jQuery(buttonToAnimate).val("ERROR: " + status);
                        } else {
                            jQuery(buttonToAnimate).val("Preview Sent");
                        }
                    }
                }
        , 250);
        setTimeout(
                function () {
                    jQuery(buttonToAnimate).val("Send Preview");
                    jQuery(buttonToAnimate).removeAttr('disabled');
                }
        , 1500);
    }

    function IsEmail(email) {
        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if (regex.test(email)) {
            previewEmailisInvalid = 0;
        } else {
            previewEmailisInvalid = 1;
        }
    }

    jQuery(document).on('keypress', '.preview-email-textbox', function (e) {
        var emailType = jQuery(this).data("mail-type");
        var email = jQuery(this).val();
        var button = jQuery(".button[data-mail-type='" + emailType + "']");
        if (e.which == 13) {
            e.preventDefault();
            sendPreviewEmailRequest(emailType, email, button);
        }
    });

    /*
     * 
     * Mailing list provider and option relation
     * 
     */

    jQuery(document).on('change', '#_wswebinar_mailinglist_provider_selector', function () {
        var selection = jQuery(this).val();
        jQuery('.mailing-provider-options').fadeOut();
        jQuery('.mailing-provider-' + selection).fadeIn();
    });

});
/*
 * Check API Enomail API key
 */
jQuery(document).on('click', '#webinar_enormail_check', function () {
    var APIKEY = jQuery('#enormail_api_key').val();
    jQuery('#webinar_enormail_check').attr('style', 'display: none;');
    jQuery('#webinar_enormail_loader').attr('style', 'display: block;');
    jQuery.ajax({
        url: ajaxurl,
        type: "GET",
        data: {
            action: 'checkEnomailAPIkey',
            key: APIKEY
        },
        success: function (returned) {
            jQuery('#webinar_enormail_loader').fadeOut();
            var object = JSON.parse(returned);
            if (object['error']) {
                setTimeout(function () {
                    jQuery('#webinar_enormail_error').fadeIn();
                    jQuery('#webinar_enormail_user_name').html(object['content']);
                }, 200);

            } else {
                setTimeout(function () {
                    jQuery('#webinar_enormail_correct').fadeIn();
                    jQuery('#webinar_enormail_user_name').html(object['content']);
                }, 200);
            }
        },
        error: function (jqXHR, text, status) {
            alert(JSON.stringify(jqXHR) + " Error");
        }});
});
jQuery(document).on('click', '#enormail_api_key', function () {
    jQuery('#webinar_enormail_user_name').html('');
    jQuery('#webinar_enormail_check').attr('style', 'display: block;');
    jQuery('#webinar_enormail_loader').attr('style', 'display: none;');
    jQuery('#webinar_enormail_correct').hide();
    jQuery('#webinar_enormail_error').hide();
});

/*
 * Generate system report.
 */
jQuery(document).on('click', '.webinar_debug_report', function () {
    var debug_classes = ["WordPress Environment", "Server Environment", "Server Locale", "Active Plugins", "Theme"];
    var parse_report = "";
    for (var loopvar = 0; loopvar < debug_classes.length; loopvar++) {
        var cur_prop = debug_classes[loopvar];
        var count = true;
        jQuery("tr[data-info='" + cur_prop + "']").each(function () {

            if (count) {
                count = false;
                parse_report = parse_report + "\n\n----" + cur_prop + "---- \n";
            }

            if (jQuery(this).attr('data-has-a') === 'true') {
                var data_value = jQuery(this).find('td').find('a').html();
            } else {
                var data_value = jQuery(this).find('td').html().replace(/\s/g, "");
            }
            var data_head = jQuery(this).find('th').html().replace(/\s/g, "");
            parse_report = parse_report + (data_head + " : " + data_value) + "\n";
        });
    }
    jQuery(".webinar_systeem_sys_report_textarea").html(parse_report);
    jQuery(".webinar_systeem_sys_report_textarea").slideDown();
    jQuery(".webinar_systeem_sys_report_copy_btn").slideDown();
    jQuery(".webinar_debug_report").slideUp();
    jQuery(".webinar_systeem_sys_report_textarea").select();
});

jQuery(document).on('click', '.webinar_systeem_sys_report_copy_btn', function () {
    copy(jQuery(".webinar_systeem_sys_report_textarea").html());
    jQuery('.webinar_systeem_sys_report_copy_status').fadeIn();
    setTimeout(function () {
        jQuery('.webinar_systeem_sys_report_copy_status').fadeOut();
    }, 2000);
});

function copy(value) {
    var input = jQuery(".webinar_systeem_sys_report_textarea");
    input.value = value;
    input.focus();
    input.select();
    document.execCommand('Copy');
}



/*
 * 
 * Remove attendee 
 * 
 */

jQuery(document).on('click', '.removeAttendee', function (e) {
    jQuery(this).parents("tr").addClass('deleteSelected');
    if(!confirm("Are you sure to delete this attendee?")){
        jQuery(this).parents("tr").removeClass('deleteSelected');
        return false;
    }
    
    var attendeeId = jQuery(this).data('attendeeid');
    
    jQuery.ajax({
        'url': ajaxurl,
        'data': {'action': 'remove_attendee', 'attid': attendeeId},
        'dataType': 'json',
        'type': 'POST'
    }).done(function (data) {
        if (!data.error) {
            jQuery("tr#attendee-row-" + attendeeId).fadeOut();
        }
        jQuery(this).parents("tr").removeClass('deleteSelected');
    });
    e.preventDefault();
});