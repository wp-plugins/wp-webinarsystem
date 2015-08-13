<?php
defined('ABSPATH') or die(__("No script kiddies please!"));
global $post;

setup_postdata($post);
WebinarSysteem::setPostData($post->ID);

$regp_bckg_clr = get_post_meta($post->ID, '_wswebinar_regp_bckg_clr', true);
$regp_bckg_img = get_post_meta($post->ID, '_wswebinar_regp_bckg_img', true);
$regp_ctatext = get_post_meta($post->ID, '_wswebinar_regp_ctatext', true);
$reg_form_title = get_post_meta($post->ID, '_wswebinar_regp_regformtitle', true);
$reg_form_text = get_post_meta($post->ID, '_wswebinar_regp_regformtxt', true);
$regp_regformfont_clr = get_post_meta($post->ID, '_wswebinar_regp_regformfont_clr', true);
$regp_regformbckg_clr = get_post_meta($post->ID, '_wswebinar_regp_regformbckg_clr', true);
$regp_regformborder_clr = get_post_meta($post->ID, '_wswebinar_regp_regformborder_clr', true);
$regp_regformbtntxt_clr = get_post_meta($post->ID, '_wswebinar_regp_regformbtntxt_clr', true);
$regp_regformbtn_clr = get_post_meta($post->ID, '_wswebinar_regp_regformbtn_clr', true);
$regp_regformbtnborder_clr = get_post_meta($post->ID, '_wswebinar_regp_regformbtnborder_clr', true);
$regp_regtitle_clr = get_post_meta($post->ID, '_wswebinar_regp_regtitle_clr', true);
$regp_regmeta_clr = get_post_meta($post->ID, '_wswebinar_regp_regmeta_clr', true);
$regp_wbndesc_clr = get_post_meta($post->ID, '_wswebinar_regp_wbndesc_clr', true);
$regp_wbndescbck_clr = get_post_meta($post->ID, '_wswebinar_regp_wbndescbck_clr', true);
$regp_wbndescborder_clr = get_post_meta($post->ID, '_wswebinar_regp_wbndescborder_clr', true);
$registration_disabled = get_post_meta($post->ID, '_wswebinar_gener_regdisabled_yn', true);

$reg_formImgVidType = get_post_meta($post->ID, '_wswebinar_regp_vidurl_type', true);
$reg_formImgVidUrl = get_post_meta($post->ID, '_wswebinar_regp_vidurl', true);
$reg_formImgDefUrl = plugins_url('/images/womancaffeelaptopkl.jpg', __FILE__);

$the_reg_form_title = !empty($reg_form_title) ? $reg_form_title : 'Free Sign Up:';
$the_reg_form_text = !empty($reg_form_text) ? $reg_form_text : '';
$the_regp_ctatext = !empty($regp_ctatext) ? $regp_ctatext : 'And, Sign-in';
$the_regp_regformfont_clr = !empty($regp_regformfont_clr) ? 'color:' . $regp_regformfont_clr . ' !important;' : '';
$the_regp_regformbckg_clr = !empty($regp_regformbckg_clr) ? 'background-color:' . $regp_regformbckg_clr . ' !important;' : '';
$the_regp_regformborder_clr = !empty($regp_regformborder_clr) ? 'border-color:' . $regp_regformborder_clr . ' !important;' : '';
$the_regp_regformbtntxt_clr = !empty($regp_regformbtntxt_clr) ? 'color:' . $regp_regformbtntxt_clr . ' !important;' : '';
$the_regp_regformbtn_clr = !empty($regp_regformbtn_clr) ? 'background-color:' . $regp_regformbtn_clr . ' !important;' : '';
$the_regp_regformbtnborder_clr = !empty($regp_regformbtnborder_clr) ? 'border-color:' . $regp_regformbtnborder_clr . ' !important;' : '';
$the_regp_regtitle_clr = !empty($regp_regtitle_clr) ? $regp_regtitle_clr : '#C7C7C7';
$the_regp_regmeta_clr = !empty($regp_regmeta_clr) ? $regp_regmeta_clr : '#C7C7C7';
$the_regp_wbndesc_clr = !empty($regp_wbndesc_clr) ? $regp_wbndesc_clr : '#C7C7C7';
$the_regp_wbndescbck_clr = !empty($regp_wbndescbck_clr) ? $regp_wbndescbck_clr : '#000';
$the_regp_wbndescborder_clr = !empty($regp_wbndescborder_clr) ? $regp_wbndescborder_clr : '#C7C7C7';

$dateFormat = get_option('date_format');
$timeFormat = get_option('time_format');

$wb_time = '';
$wb_date = '';
$sv_time = get_post_meta($post->ID, '_wswebinar_gener_time', true);
if (!empty($sv_time)) {
    $wb_time = date_i18n($timeFormat, $sv_time);
    $wb_date = date_i18n($dateFormat, $sv_time);
}
$wb_host = esc_attr(get_post_meta($post->ID, '_wswebinar_hostmetabox_hostname', true));
$wb_hostcount = WebinarSysteemHosts::hostCount($post->ID);
?>
<html>
    <head>
        <title><?php echo get_the_title(); ?></title>
        <meta property="og:title" content="<?php the_title(); ?>">
        <meta property="og:url" content="<?php echo get_permalink($post->ID); ?>">
        <meta property="og:description" content="<?php echo substr(get_the_content(), 0, 500); ?>">
        <style><?php
if (!empty($regp_bckg_clr)) {
    echo '.tmp-main{background-color:' . $regp_bckg_clr . ';}';
}
if (!empty($regp_bckg_img)) {
    echo '.tmp-main{background-image: url(' . $regp_bckg_img . ');}';
}
?></style>
        <?php wp_head(); ?>
    </head>
    <body class="tmp-main">
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
                <div class="col-xs-12">
                    <div>
                        <h1 class="text-center" id="reg-title" style="color:<?php echo $the_regp_regtitle_clr ?> !important"><?php the_title(); ?></h1> 
                    </div> 
                    <h4 class="text-center" id="reg-meta" style="color:<?php echo $the_regp_regmeta_clr ?> !important"><?php
                        if (!WebinarSysteem::isRecurring($post->ID)) {
                            echo (!empty($wb_date) ? __('Date', WebinarSysteem::$lang_slug) . ': ' . $wb_date . '  ' : null);
                            echo (!empty($wb_time) ? __('Time', WebinarSysteem::$lang_slug) . ': ' . $wb_time . '  ' : null);
                        }
                        echo WebinarSysteemHosts::isMultipleHosts($post->ID) ? '<br/>' : '';
                        echo (!empty($wb_host) ? _n('Host', 'Hosts', $wb_hostcount, WebinarSysteem::$lang_slug) . ': ' . $wb_host : null);
                        ?>
                    </h4>
                </div>
            </div>
            <div class="row" style="margin-top: 40px;">
                <div class="col-lg-8 col-sm-8 col-xs-12">
                    <div id="embed">
                        <?php
                        if (!empty($reg_formImgVidType) && !empty($reg_formImgVidUrl)):
                            if ($reg_formImgVidType == 'youtube'):
                                $youtubeid = WebinarSysteem::getYoutubeIdFromUrl($reg_formImgVidUrl);
                                ?>
                                <iframe width="100%" height="563" src="//www.youtube.com/embed/<?php echo $youtubeid; ?>?controls=0&rel=0&showinfo=0" frameborder="0" allowfullscreen></iframe>
                                <?php elseif ($reg_formImgVidType=='vimeo'): ?>
                                    <iframe src="<?php echo $reg_formImgVidUrl ?>" width="100%" height="563" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                            <?php else: ?>
                                <img src="<?php echo $reg_formImgVidUrl; ?>" width="100%" height="315">
                            <?php
                            endif;
                        else:
                            ?> <img src="<?php echo $reg_formImgDefUrl; ?>" width="100%" height="315" />
                        <?php endif;
                        ?>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-4 col-xs-12">
                    <?php if (empty($registration_disabled)) { ?>
                        <div class="text-center round-border signup" style="<?php echo $the_regp_regformbckg_clr . $the_regp_regformfont_clr . $the_regp_regformborder_clr; ?>">
                            <h3><?php echo $the_reg_form_title; ?></h3>
                            <p>
                                <?php echo $the_reg_form_text; ?>
                            </p>
                            <div >
                                <form method="POST">
                                    <input type="hidden" name="webinarRegForm" value="submit">
                                    <input class="form-control forminputs" name="inputname" placeholder="<?php _e('Your Name', WebinarSysteem::$lang_slug) ?>" type="text" value="<?php echo!empty($_REQUEST['inputname']) ? $_REQUEST['inputname'] : ''; ?>" />
                                    <?php if (!empty($_REQUEST['error']) && $_REQUEST['error'] == 'inputname'): ?>
                                        <span class="error">Please enter your name.</span>
                                    <?php endif; ?>
                                    <input class="form-control forminputs" name="inputemail" placeholder="<?php _e('Your Email Address', WebinarSysteem::$lang_slug) ?>" type="email" value="<?php echo!empty($_REQUEST['inputemail']) ? $_REQUEST['inputemail'] : ''; ?>" />
                                    <?php if (!empty($_REQUEST['error']) && $_REQUEST['error'] == 'inputemail'): ?>
                                        <span class="error"><?php _e('Please enter your email.', WebinarSysteem::$lang_slug) ?></span>
                                    <?php endif; ?>
                                    <?php
                                    if (WebinarSysteem::isRecurring($post->ID)):
                                        $recurr_instances = WebinarSysteem::getRecurringInstances($post->ID);
                                        ?>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <select class="form-control forminputs" name="inputday">
                                                    <option disabled="disabled" selected="selected">Select a day</option>
                                                    <?php
                                                    foreach ($recurr_instances['days'] as $day_item) {
                                                        echo "<option value='$day_item'>" . WebinarSysteemMetabox::getWeekDayArray($day_item) . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <?php if (!empty($_REQUEST['error']) && $_REQUEST['error'] == 'inputday'): ?>
                                                    <span class="error"><?php _e('Select a day to watch.', WebinarSysteem::$lang_slug) ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <div class="col-sm-12">
                                                <select class="form-control forminputs" name="inputtime">
                                                    <option disabled="disabled" selected="selected">Select a time</option>
                                                    <?php
                                                    foreach ($recurr_instances['times'] as $time) {
                                                        echo '<option value="' . $time . '">' . date('h:i A', strtotime($time)) . " (" . get_option('gmt_offset') . ' GMT)</option>';
                                                    }
                                                    ?>
                                                </select>
                                                <?php if (!empty($_REQUEST['error']) && $_REQUEST['error'] == 'inputtime'): ?>
                                                    <span class="error"><?php _e('Select a time to watch.', WebinarSysteem::$lang_slug) ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <button class="btn btn-success forminputs" style="<?php echo $the_regp_regformbtn_clr . $the_regp_regformbtntxt_clr . $the_regp_regformbtnborder_clr; ?>" type="submit"><?php
                                        $ctatext = get_post_meta($post->ID, '_wswebinar_regp_ctatext', true);
                                        echo (!empty($ctatext) ? $ctatext : __('And, Sign-in'));
                                        ?></button>
                                </form>
                                <p><?php _e('Of course we will handle your data safely.', WebinarSysteem::$lang_slug) ?></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php
            $t_cont = get_the_content();
            if (!empty($t_cont)):
                ?>
                <div class="row">
                    <div id="WebinarDescription" class="col-xs-12">
                        <div class="round-border footer" style="background-color: <?php echo $the_regp_wbndescbck_clr ?>; border-color:<?php echo $the_regp_wbndescborder_clr ?> !important;"><p style="color:<?php echo $the_regp_wbndesc_clr ?> !important;"><?php echo str_replace("\r", "<br />", get_the_content()); ?></p></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </body>
</html>