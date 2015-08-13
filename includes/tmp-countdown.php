<?php
global $post;
setup_postdata($post);
WebinarSysteem::setPostData($post->ID);
$data_title_clr = get_post_meta($post->ID, '_wswebinar_cntdwnp_title_clr', true);
$data_tagline_clr = get_post_meta($post->ID, '_wswebinar_cntdwnp_tagline_clr', true);
$data_desc_clr = get_post_meta($post->ID, '_wswebinar_cntdwnp_desc_clr', true);
$data_backg_clr = get_post_meta($post->ID, '_wswebinar_cntdwnp_bckg_clr', true);
$data_backg_img = get_post_meta($post->ID, '_wswebinar_cntdwnp_bckg_img', true);
$attendee = WebinarSysteemAttendees::getAttendee($post->ID);
$data_timer = WebinarSysteem::getWebinarTime($post->ID, $attendee);
$data_show_countdown = get_post_meta($post->ID, '_wswebinar_cntdwnp_timershow_yn', true);
$data_hr = get_post_meta($post->ID, '_wswebinar_gener_hour', true);
$data_min = get_post_meta($post->ID, '_wswebinar_gener_min', true);

$dateFormat = get_option('date_format');
$timeFormat = get_option('time_format');

$date_date = date_i18n($dateFormat, $data_timer);
$wb_time = date_i18n($timeFormat, $data_timer); ?>
<html>

    <head>
        <title><?php echo get_the_title(); ?></title>
        <meta property="og:title" content="<?php the_title(); ?>">
        <meta property="og:url" content="<?php echo get_permalink($post->ID); ?>">
        <meta property="og:description" content="<?php echo substr(get_the_content(), 0, 500); ?>">
        <style>
            body.tmp-countdown{
                <?php echo (empty($data_backg_clr)) ? '' : 'background-color:' . $data_backg_clr . ';'; ?>
                <?php echo (empty($data_backg_img)) ? '' : 'background-image: url(' . $data_backg_img . '); background-size: cover;'; ?>                
            }
        </style>
        <?php wp_head(); ?>
    </head>
    <body class="tmp-countdown">
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

            <div class="row">
                <div class="col-lg-12">
                    <?php if ($data_show_countdown == 'yes') { ?>
                        <h2 class="countdown" style="color:<?php echo $data_title_clr ?>;">

                            <?php the_title(); ?>
                            <span class="hideIfCountdownStop"><?php _e('will begin in', WebinarSysteem::$lang_slug) ?></span>
                            <span class="showIfCountdownStop"><?php _e('will begin shortly', WebinarSysteem::$lang_slug) ?></span>
                        </h2>
                    <?php } else { ?>
                        <h2 class="countdown" style="color:<?php echo $data_title_clr ?>;">
                            <?php the_title(); ?>
                            <?php _e('will start', WebinarSysteem::$lang_slug);
                            echo (!empty($date_date) ? '<br>' . __('on', WebinarSysteem::$lang_slug) . ' ' . $date_date . '  ' : null);
                            echo (!empty($data_min) || !empty($data_hr) ? __('at', WebinarSysteem::$lang_slug) . ' ' . $wb_time : NULL );
                            ?>
                        </h2>
                    <h3 class="text-center" style="color:<?php echo $data_tagline_clr ?>;">
                        <?php _e('Please come back at this time. Thank you for your patience', WebinarSysteem::$lang_slug) ?>
                    </h3>

                <?php } ?>

            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 col-lg-offset-2 text-center">
                <div class="clock" style="margin:2em;"></div>
                <h3 class="refreshNotice" style="color:<?php echo empty($data_desc_clr)? '#AB27CC' : $data_desc_clr; ?>;"><?php _e('Just a second, we are starting the broadcast. This page will refresh automatically...', WebinarSysteem::$lang_slug) ?></h3>
                <div class="message"></div>

            </div>
        </div>
	</div>
        


        <script type="text/javascript">
            var clock;           
            
            jQuery(document).ready(function () {
                var currentDate = new Date("<?php echo date("Y/m/d H:i:s", current_time('timestamp')) ?>"); 
                var futureDate = new Date("<?php echo date("Y/m/d H:i:s", $data_timer) ?>");

                if (currentDate > futureDate) {
                    countdownStopCallback();
                    return;
                }

                var diff = futureDate.getTime() / 1000 - currentDate.getTime() / 1000;
                clock = jQuery('.clock').FlipClock(diff, {
                    clockFace: 'DailyCounter',
                    countdown: true,
                    callbacks: {stop: function () {
                            countdownStopCallback();
                        }}
                });
				
				
<?php if ($data_show_countdown !== 'yes'): ?>
                jQuery('.clock').hide();
<?php endif; ?>
        });
		
		
        function countdownStopCallback() {
            jQuery('.hideIfCountdownStop').hide();
            jQuery('.showIfCountdownStop').show();
            jQuery('.clock').fadeOut('slow');
            jQuery('.refreshNotice').fadeIn('slow');

            setInterval(function () {
                jQuery.ajax({
                    url: ajaxurl,
                    data: {action: 'checkWebinarStatus', post_id: <?php echo $post->ID; ?>},
                    dataType: 'json',
                    type: 'POST',
                }).done(function (response) {
                    console.log(JSON.stringify(response));
                    if (response) {
                        location.reload();
                    }
                });
            }, 10000);
        }
    </script>
    <?php wp_footer(); ?> 
</body>
</html>