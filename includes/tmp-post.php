<?php
global $post;
setup_postdata($post);
$data_pagetitle_color = get_post_meta($post->ID, '_wswebinar_tnxp_pagetitle_clr', true);
$pagebkg = get_post_meta($post->ID, '_wswebinar_tnxp_bckg_clr', true);
$pagebkgimg = get_post_meta($post->ID, '_wswebinar_tnxp_bckg_img', true);
WebinarSysteem::setPostData($post->ID);
$dateFormat = get_option('date_format');
$timeFormat = get_option('time_format');
$data_imgvid_type = get_post_meta($post->ID, '_wswebinar_tnxp_vidurl_type', true);
$data_imgvid_url = get_post_meta($post->ID, '_wswebinar_tnxp_vidurl', true);
$data_defImgUrl = plugins_url('/images/macthumbsup.jpg', __FILE__);
$data_pagetitle = get_post_meta($post->ID, '_wswebinar_tnxp_pagetitle', true);

$the_tnxp_page_title_color = empty($data_pagetitle_color) ? '' : 'color:' . $data_pagetitle_color . ';';
$data_ticket_border_color = get_post_meta($post->ID, '_wswebinar_tnxp_tktbdr_clr', true);
$data_ticket_background_color = get_post_meta($post->ID, '_wswebinar_tnxp_tktbckg_clr', true);
$data_ticket_body_background_color = get_post_meta($post->ID, '_wswebinar_tnxp_tktbodybckg_clr', true);
$data_ticket_text_color = get_post_meta($post->ID, '_wswebinar_tnxp_tkttxt_clr', true);
$data_ticket_header_background_color = get_post_meta($post->ID, '_wswebinar_tnxp_tkthdrbckg_clr', true);
$data_ticket_header_text_color = get_post_meta($post->ID, '_wswebinar_tnxp_tkthdrtxt_clr', true);
$data_ticket_button_color = get_post_meta($post->ID, '_wswebinar_tnxp_tktbtn_clr', true);
$data_ticket_button_text_color = get_post_meta($post->ID, '_wswebinar_tnxp_tktbtntxt_clr', true);
$data_tnxp_link_above_clr = get_post_meta($post->ID, '_wswebinar_tnxp_link_above_clr', true);
$data_tnxp_link_below_clr = get_post_meta($post->ID, '_wswebinar_tnxp_link_below_clr', true);
$data_tnxp_socialsharing_border_clr = get_post_meta($post->ID, '_wswebinar_tnxp_socialsharing_border_clr', true);
$data_tnxp_socialsharing_bckg_clr = get_post_meta($post->ID, '_wswebinar_tnxp_socialsharing_bckg_clr', true);
$data_tnxp_calendar_border_clr = get_post_meta($post->ID, '_wswebinar_tnxp_calendar_border_clr', true);
$data_tnxp_calendar_bckg_clr = get_post_meta($post->ID, '_wswebinar_tnxp_calendar_bckg_clr', true);
$data_tnxp_calendartxt_clr = get_post_meta($post->ID, '_wswebinar_tnxp_calendartxt_clr', true) . ' !important';
$data_tnxp_calendarbtntxt_clr = get_post_meta($post->ID, '_wswebinar_tnxp_calendarbtntxt_clr', true) . ' !important';
$data_tnxp_calendarbtnbckg_clr = get_post_meta($post->ID, '_wswebinar_tnxp_calendarbtnbckg_clr', true) . ' !important';
$data_tnxp_calendarbtnborder_clr = get_post_meta($post->ID, '_wswebinar_tnxp_calendarbtnborder_clr', true) . ' !important';
$the_tnxp_ticket_border_color = empty($data_ticket_border_color) ? '#840000' : $data_ticket_border_color;
$the_tnxp_ticket_background_color = empty($data_ticket_background_color) ? '#fbd35d' : $data_ticket_background_color;
$the_tnxp_ticket_body_background_color = empty($data_ticket_body_background_color) ? '#fbd35d' : $data_ticket_body_background_color;
$the_tnxp_ticket_text_color = empty($data_ticket_text_color) ? '#840000' : $data_ticket_text_color;
$the_tnxp_ticket_header_background_color = empty($data_ticket_header_background_color) ? '#862a28' : $data_ticket_header_background_color;
$the_tnxp_ticket_header_text_color = empty($data_ticket_header_text_color) ? '#FFF' : $data_ticket_header_text_color;
$the_tnxp_ticket_button_color = empty($data_ticket_button_color) ? '' : 'background-color:' . $data_ticket_button_color . ' !important';
$the_tnxp_ticket_button_text_color = empty($data_ticket_button_text_color) ? '' : 'color:' . $data_ticket_button_text_color . ' !important';

$attendee = WebinarSysteemAttendees::getAttendee($post->ID);
$attend_time = WebinarSysteem::getWebinarTime($post->ID, $attendee);
?>
<html>

    <head>   
        <link rel="stylesheet" type="text/css" href="<?php echo plugins_url('./css/webinar.css', __FILE__); ?>"> 
        <link rel="stylesheet" type="text/css" href="<?php echo plugins_url('./css/bootstrap.css', __FILE__); ?>">

        <meta property="og:title" content="<?php the_title(); ?>">
        <meta property="og:url" content="<?php echo get_permalink($post->ID); ?>">
        <meta property="og:description" content="<?php echo substr(get_the_content(), 0, 500); ?>">

        <script src="<?php echo plugins_url('./js/jquery-1.11.1.min.js', __FILE__); ?>"></script>
        <script src="<?php echo plugins_url('./js/jquery-ui.min.js', __FILE__); ?>"></script>
        <script src="<?php echo plugins_url('./js/ZeroClipboard.min.js', __FILE__); ?>"></script>
        <script src="<?php echo plugins_url('./js/addEvent.js', __FILE__); ?>"></script>
        <title><?php echo get_the_title(); ?> | <?php _e('Powered by WP WebinarSystem', WebinarSysteem::$lang_slug); ?></title>

        <style>
            .clipbaordfade{background: #000; height: 70px;}
            .copyToClip{cursor: pointer;}
            .zeroclipboard-is-hover{background-color: #E9D4D4;cursor: pointer;}
            .zeroclipboard-is-active{background: #C09DEC;}
            <?php echo empty($pagebkg) ? '' : '.tmp-post{background-color:' . $pagebkg . ';}' ?>
            <?php echo empty($pagebkgimg) ? '' : '.tmp-post{background-image: url(' . $pagebkgimg . ');}' ?>
        </style>
        <script src="https://apis.google.com/js/platform.js" async defer></script>
    </head>
    <body class="tmp-post">

        <div id="fb-root"></div>
        <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.3&appId=101090596631952";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
        <script>
            !function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                if (!d.getElementById(id)) {
                    js = d.createElement(s);
                    js.id = id;
                    js.src = p + '://platform.twitter.com/widgets.js';
                    fjs.parentNode.insertBefore(js, fjs);
                }
            }(document, 'script', 'twitter-wjs');
        </script>

        <div class="container" style="margin-top: 40px;">
            <!--[if lt IE 9]>
                <div style='row'>
                    <div class="col-xs-6 col-xs-offset-2">
                        <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx">
                          <img src="<?php echo plugins_url('./images/iecheck.jpg', __FILE__); ?>" border="0" height="42" width="820" alt="" />
                        </a>
                    </div>
                </div>
            <![endif]-->
            <div class="row" style="margin-bottom: 30px;">
                <div class="col-xs-12 col-lg-12 col-sm-12">
                    <div> <h1 class="text-center" style="font-weight: 800; <?php echo $the_tnxp_page_title_color; ?>">
                            <?php echo esc_attr($data_pagetitle); ?></h1> </div> 
                </div>
            </div>
            <div class="row" style="padding: 6px;">
                <div class="tmp-post-container">
                    <div id="leftcol" class="col-lg-7 col-sm-6 col-md-7 col-xs-12">
                        <div class="row">
                            <div id="embed">
                                <?php if (empty($data_imgvid_url)) { ?>
                                    <img src="<?php echo $data_defImgUrl; ?>" width="100%" height="315">
                                    <?php
                                } else {
                                    switch ($data_imgvid_type):
                                        case 'image':
                                            echo '<img src="' . $data_imgvid_url . '" width="100%" height="315">';
                                            break;
                                        case 'youtube':
                                            $link = $data_imgvid_url;
                                            $youtubeid = WebinarSysteem::getYoutubeIdFromUrl($link);
                                            if ($youtubeid !== false) {
                                                echo '<iframe width="100%" height="315" src="//youtube.com/embed/' . $youtubeid . '?controls=0&rel=0&showinfo=0" frameborder="0" allowfullscreen></iframe>';
                                            } elseif (!empty($link)) {
                                                echo '<iframe width="100%" height="315" src="//youtube.com/embed/' . $link . '?controls=0" frameborder="0&rel=0&showinfo=0" allowfullscreen></iframe>';
                                            }
                                            break;
                                        case 'vimeo':
                                            echo '<iframe src="' . $data_imgvid_url . '" width="100%" height="563" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
                                            break;
                                    endswitch;
                                }
                                ?>
                            </div>
                            <div style="padding:20px;">
                                <h4 style="color:<?php echo $data_tnxp_link_above_clr ?>;"><?php _e('Here is the webinar URL...', WebinarSysteem::$lang_slug) ?></h4>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="theWebinarUrl" value="<?php echo get_permalink($post->ID); ?>"/>
                                        <div style="top:0px;" data-clipboard-text="<?php echo get_permalink($post->ID); ?>" class="input-group-addon glyphicon glyphicon-link" id="copyToClip"></div></div></div>

                                <h5 style="color:<?php echo $data_tnxp_link_below_clr ?>;"><?php _e('Save and bookmark this URL so you can get access the live webinar replay...', WebinarSysteem::$lang_slug) ?></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-sm-6 col-md-5 col-xs-12">
                        <div class="tickets" style="border: 2px <?php echo $the_tnxp_ticket_border_color ?> dashed; background-color: <?php echo $the_tnxp_ticket_background_color ?>;">
                            <div class="ticket-top" style="color:<?php echo $the_tnxp_ticket_header_text_color ?>;  background-color: <?php echo $the_tnxp_ticket_header_background_color ?>;">

                                <div style="font-size: 40pt;margin: 5px 10px;" class="pull-left glyphicon glyphicon-film"></div>
                                <div class="pull-left">
                                    <h4><?php _e('Your Webinar Ticket', WebinarSysteem::$lang_slug) ?></h4>
                                    <h6><?php _e('The Webinar Event Information...', WebinarSysteem::$lang_slug) ?></h6>
                                </div> <br/>

                            </div>
                            <div class="ticket-bottom" style="background-color: #fbd35d;">
                                <div class="ticket-bottom" style="background-color: <?php echo $the_tnxp_ticket_body_background_color ?>;">
                                    <div style="color: <?php echo $the_tnxp_ticket_text_color ?>; padding: 25px;">
                                        <div class="ticket-info"><span class="glyphicon glyphicon-facetime-video"></span>&nbsp;&nbsp;<span class="tick-left"><?php _e('Webinar', WebinarSysteem::$lang_slug) ?></span><span class="tick-right"><?php echo get_the_title(); ?></span></div>
                                        <div class="ticket-info"><span class="glyphicon glyphicon-bullhorn"></span>&nbsp;&nbsp;<span class="tick-left"><?php _e('Host', WebinarSysteem::$lang_slug) ?></span><span class="tick-right"><?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_hostmetabox_hostname', true)); ?></span></div>
                                        <div class="ticket-info"><span class="glyphicon glyphicon-calendar"></span>&nbsp;&nbsp;<span class="tick-left"><?php _e('Date', WebinarSysteem::$lang_slug) ?></span><span class="tick-right"><?php echo date_i18n($dateFormat, $attend_time); ?></span></div>
                                        <div class="ticket-info"><span class="glyphicon glyphicon-time"></span>&nbsp;&nbsp;<span class="tick-left"><?php _e('Time', WebinarSysteem::$lang_slug) ?></span><span class="tick-right"><?php echo date_i18n($timeFormat, $attend_time). " (" . get_option('gmt_offset') . " GMT)"; ?></span></div>
                                    </div>


                                    <?php
                                    $wbstatus = get_post_meta($post->ID, '_wswebinar_gener_webinar_status', true);
                                    $hide = TRUE;
                                    if ($wbstatus == 'liv' || $wbstatus == 'cou' || $wbstatus == 'rep')
                                        $hide = FALSE;
                                    ?>
                                    <div style="padding:10px;"><a id="view-webinar-button" href="#" style="width:100%; <?php echo $the_tnxp_ticket_button_color ?>;" class="btn btn-success <?php echo ($hide ? 'hidden' : '') ?>">
                                            <?php
                                            switch ($wbstatus):
                                                case 'liv':
                                                    _e('Webinar Is In Progress...', WebinarSysteem::$lang_slug);
                                                    break;
                                                case 'cou':
                                                    _e('Go to Webinar', WebinarSysteem::$lang_slug);
                                                    break;
                                                case 'rep':
                                                    _e('View Webinar Replay', WebinarSysteem::$lang_slug);
                                                    break;
                                            endswitch;
                                            ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tnxp-box" style="background-color: <?php echo $data_tnxp_socialsharing_bckg_clr?>;border-color: <?php echo $data_tnxp_socialsharing_border_clr?>;">
                            <div class="social-buttons">
                                <a href="#" onclick="window.open('http://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink($post->ID); ?>', 'webinar-fb', 'width=500,height=500')"><img src="<?php echo plugins_url('./images/ui/fb.png', __FILE__); ?>"/></a>
                                <span>
                                    <a href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?>&url=<?php echo get_permalink($post->ID); ?>" target="_blank"><img src="<?php echo plugins_url('./images/ui/tw.png', __FILE__); ?>"/></a>
                                </span>
                                <span>
                                    <a href="#" onclick="window.open('https://plus.google.com/share?url=<?php echo get_permalink($post->ID); ?>', 'webinar-gplus', 'width=500,height=500')"><img src="<?php echo plugins_url('./images/ui/gp.png', __FILE__); ?>"/></a>
                                </span>
                                <span>
                                    <a href="#" onclick="window.open('http://www.linkedin.com/shareArticle?mini=true&url=<?php echo get_permalink($post->ID); ?>&title=<?php echo get_the_title(); ?>&summary=<?php echo get_the_content(); ?>', 'webinar-linkedin', 'width=500,height=500')"><img src="<?php echo plugins_url('./images/ui/li.png', __FILE__); ?>"/></a>
                                </span>
                            </div>
                        </div>

                        <div class="tnxp-box" style="color:<?php echo $data_tnxp_calendartxt_clr ?>; background-color: <?php echo $data_tnxp_calendar_bckg_clr?>;border-color: <?php echo $data_tnxp_calendar_border_clr?>;">
                            <div style="font-size: 40pt;margin: 5px 10px;" class="pull-left glyphicon glyphicon-calendar"></div>
                            <div class="pull-left">
                                <h4><?php _e('Add To Your Calendar', WebinarSysteem::$lang_slug) ?></h4>
                                <h6><?php _e('Remind Yourself Of The Event', WebinarSysteem::$lang_slug) ?></h6>
                            </div><br/>
                            <div style="border-top: 2px dotted #e7e4e0; margin-top: 43px;"></div>
                            <div style="width:100%;">
                                <a target="_blank" href="http://www.google.com/calendar/event?action=TEMPLATE&text=<?php echo urlencode(get_the_title()) ?>&dates=<?php echo date("Ymd", $attend_time); ?>T<?php echo date("His", $attend_time); ?>/<?php echo date("Ymd", strtotime("2014-08-09 18:00:00")); ?>T<?php echo date("His", $attend_time); ?>&details=Webinar" class="btn btn-default btm-btn" style="color:<?php echo $data_tnxp_calendarbtntxt_clr ?>;background-color:<?php echo $data_tnxp_calendarbtnbckg_clr ?>;border-color:<?php echo $data_tnxp_calendarbtnborder_clr ?>;"><span class="glyphicon glyphicon-plus-sign"></span> &nbsp; <?php _e('Google Calendar', WebinarSysteem::$lang_slug); ?></a>
                                <a class="btn btn-default btm-btn addthisevent" style="color:<?php echo $data_tnxp_calendarbtntxt_clr ?>;background-color:<?php echo $data_tnxp_calendarbtnbckg_clr ?>;border-color:<?php echo $data_tnxp_calendarbtnborder_clr ?>;">
                                    <span class="glyphicon glyphicon-plus-sign"></span> &nbsp; <?php _e('iCal / Outlook', WebinarSysteem::$lang_slug); ?>

                                    <span class="_start"><?php echo gmdate('d-m-Y H:i:s', $attend_time); ?></span>
                                    <span class="_summary"><?php echo get_the_title(); ?></span>
                                    <span class="_description"><?php echo get_the_content(); ?></span>
                                    <span class="_location"><?php echo get_permalink($post->ID); ?></span>
                                    <span class="_organizer"><?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_hostmetabox_hostname', true)); ?></span>
                                    <span class="_date_format">DD/MM/YYYY</span>

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var client = new ZeroClipboard(document.getElementById("copyToClip"));

            client.on("ready", function (readyEvent) {
                client.on("aftercopy", function (event) {
                    jQuery("#theWebinarUrl").animate("clipbaordfade", 1000);
                });
            });
            jQuery(function () {
                jQuery(document).on('click', 'input[type=text]', function () {
                    this.select();
                });
                jQuery(document).on('click', '#view-webinar-button', function () {
                    location.reload();
                });
            });
            addthisevent.settings({
                mouse: false,
                css: false,
                outlook: {show: true, text: "Outlook Calendar"},
                ical: {show: true, text: "iCal Calendar"}
            });

        </script>


    </body>
</html>