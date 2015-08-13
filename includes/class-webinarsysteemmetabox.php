<?php

class WebinarSysteemMetabox {

    private $_FILE_, $post_slug;

    public function __construct($file, $post_slug) {
        $this->_FILE_ = $file;
        $this->post_slug = $post_slug;
        add_action('add_meta_boxes', array($this, 'addWebinarMetaBox'));
        add_action('add_meta_boxes', array($this, 'addWebinarMetaBoxHost'));
        add_action('save_post', array($this, 'saveMetaBoxData'));
    }

    /*
     * 
     * Load the Webinar option metaboxes.
     * 
     */

    function addWebinarMetaBox() {
        add_meta_box('webinarMetaBox', __('Webinar Settings', WebinarSysteem::$lang_slug), array($this, 'webinarMetaBoxContent'), $this->post_slug, 'normal');
    }

    function addWebinarMetaBoxHost() {
        add_meta_box('webinarMetaBoxHost', __('Host Names', WebinarSysteem::$lang_slug), array($this, 'webinarMetaBoxHostContent'), $this->post_slug, 'side', 'default');
        add_meta_box('webinarMetaBoxUrl', __('Your Webinar URL', WebinarSysteem::$lang_slug), array($this, 'webinarMetaBoxUrlContent'), $this->post_slug, 'normal', 'high');
    }

    public function webinarMetaBoxUrlContent() {
        ?>
        <div class="form-field">
            <input type="text" id="wswebinar_url" value="">
        </div>

        <script>
            function loadUrlFromPreviewAnchor() {
                var u = jQuery('#view-post-btn a').attr('href');
                jQuery('#wswebinar_url').val(u);
            }
            jQuery(document).ready(function () {
                loadUrlFromPreviewAnchor();
                setInterval(function () {
                    loadUrlFromPreviewAnchor();
                }, 1000);
            });
        </script>
        <?php
    }

    /*
     * 
     * Webinar Meta box content loader
     * 
     */

    function webinarMetaBoxContent($post) {
        wp_nonce_field('webinarmetabox', 'webinarmetabox_nonce');
        
        
        ?>

        <div id="tabs">
            <ul>
                <li><a href="#tabs-6"><i class="wbn-icon wbnicon-cog"></i>&nbsp; &nbsp;<?php _e('General Options', WebinarSysteem::$lang_slug); ?></a></li>
                <li><a href="#tabs-1"><i class="wbn-icon wbnicon-registration"></i>&nbsp; &nbsp;<?php _e('Registration Page', WebinarSysteem::$lang_slug); ?></a></li>
                <li><a href="#tabs-2"><i class="wbn-icon wbnicon-thumbs-up"></i>&nbsp; &nbsp;<?php _e('Thank You Page', WebinarSysteem::$lang_slug); ?></a></li>
                <li><a href="#tabs-3"><i class="wbn-icon wbnicon-sort-by-order"></i>&nbsp; &nbsp;<?php _e('Countdown Page', WebinarSysteem::$lang_slug); ?></a></li>
                <li><a href="#tabs-4"><i class="wbn-icon wbnicon-live"></i>&nbsp; &nbsp;<?php _e('Live Page', WebinarSysteem::$lang_slug); ?></a></li>
                <li><a href="#tabs-5"><i class="wbn-icon wbnicon-facetime-video"></i>&nbsp; &nbsp;<?php _e('Replay Page', WebinarSysteem::$lang_slug); ?></a></li>
            </ul>            

            <div id="tabs-6">
                <div class="panelContent">
                    <?php $this->metaBoxTab_generalPage($post); ?>
                    <div class="webinar_clear_fix"></div>
                </div>

            </div>
            <div id="tabs-1">
                <div class="panelContent">
                    <?php $this->metaBoxTab_registerPage($post); ?>
                    <div class="webinar_clear_fix"></div>
                </div>
            </div>
            <div id="tabs-2">
                <div class="panelContent">
                    <?php $this->metaBoxTab_thankyouPage($post); ?>
                    <div class="webinar_clear_fix"></div>
                </div>
            </div>
            <div id="tabs-3" class="panelContent">
                <div class="panelContent">
                    <?php $this->metaBoxTab_countdownPage($post); ?>
                    <div class="webinar_clear_fix"></div>
                </div>
            </div>
            <div id="tabs-4" class="panelContent">
                <div class="panelContent">
                    <?php $this->metaBoxTab_livePage($post); ?>
                    <div class="webinar_clear_fix"></div>
                </div>
            </div>
            <div id="tabs-5" class="final-tab panelContent">
                <div class="panelContent">
                    <?php $this->metaBoxTab_replayPage($post); ?>
                    <div class="webinar_clear_fix"></div>
                </div>
            </div>

        </div>
        <script type="text/javascript">
            jQuery('#regp-accordian,#tnxp-accordian,#livep-accordian,#cntdwnp-accordian').accordion({heightStyle: "content"});
        </script>
        <?php
    }

    private function decideClassOfStatusButtons($this_status, $saved_status) {
        if (empty($saved_status)) {
            if ($this_status == 'cou')
                return 'active disabled';
            return '';
        }

        if ($saved_status == $this_status)
            return 'active disabled';
        return '';
    }

    /*
     * 
     * Metabox General Options Page tab content
     * 
     */

    private function metaBoxTab_generalPage($post) {
        include 'templates/template-metabox-generalpage.php';
    }

    /*
     * 
     * Metabox register Page tab content
     * 
     */

    private function metaBoxTab_registerPage($post) {
        $nonce = wp_create_nonce('post_preview_' . $post->ID);
        include 'templates/template-metabox-registerpage.php';
    }

    /*
     * 
     * Metabox thank you page tab content
     * 
     */

    private function metaBoxTab_thankyouPage($post) {
        include('templates/template-metabox-thankyoupage.php');
    }

    /*
     * 
     * Metabox countdown page tab content
     * 
     */

    private function metaBoxTab_countdownPage($post) {
        include('templates/template-metabox-countdownpage.php');
    }

    /*
     * 
     * Metabox live page tab content
     * 
     */

    private function metaBoxTab_livePage($post) {
        include('templates/template-metabox-livepage.php');
    }

    /*
     * 
     * Metabox replay page tab content
     * 
     */

    private function metaBoxTab_replayPage($post) {
        include('templates/template-metabox-replaypage.php');
    }

    /*
     * 
     * Save metabox options data
     * 
     */

    function saveMetaBoxData($post_id) {
        if (!isset($_POST['webinarmetabox_nonce'])) {
            return;
        }

        if (!wp_verify_nonce($_POST['webinarmetabox_nonce'], 'webinarmetabox')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

// Check the user's permissions.
        if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {

            if (!current_user_can('edit_page', $post_id)) {
                return;
            }
        } else {

            if (!current_user_can('edit_post', $post_id)) {
                return;
            }
        }

        /* OK, it's safe for us to save the data now. */

// Make sure that it is set.
        /* if (!isset($_POST['myplugin_new_field'])) {
          return;
          } */

        $datestring = '';
        if (!empty($_POST['gener_date'])) {
            $datestring.= $_POST['gener_date'];
            $datestring.= ' ' . $_POST['gener_hour'] . $_POST['gener_min'];
        }
        $_POST['gener_time'] = strtotime($datestring);

        $field_array = array(
            array('sanitize' => true, 'slug' => 'gener_min'),
            array('sanitize' => true, 'slug' => 'gener_hour'),
            array('sanitize' => true, 'slug' => 'gener_date'),
            array('sanitize' => true, 'slug' => 'gener_time'),
            array('sanitize' => true, 'slug' => 'gener_webinar_status'),
            array('sanitize' => true, 'slug' => 'gener_regdisabled_yn'),
            array('sanitize' => true, 'slug' => 'gener_air_type'),
            array('sanitize' => true, 'slug' => 'gener_time_occur'),
            array('sanitize' => true, 'slug' => 'gener_rec_days'),
            array('sanitize' => true, 'slug' => 'gener_rec_times'),
            array('sanitize' => true, 'slug' => 'gener_duration'),
            array('sanitize' => true, 'slug' => 'gener_onetimeregist'),
            array('sanitize' => true, 'slug' => 'livep_askq_yn'),
            array('sanitize' => true, 'slug' => 'livep_askq_title_text_clr'),
            array('sanitize' => true, 'slug' => 'livep_askq_bckg_clr'),
            array('sanitize' => true, 'slug' => 'livep_askq_border_clr'),
            array('sanitize' => true, 'slug' => 'livep_webdes_yn'),
            array('sanitize' => true, 'slug' => 'livep_hostbox_yn'),
            array('sanitize' => true, 'slug' => 'livep_leftbox_bckg_clr'),
            array('sanitize' => true, 'slug' => 'livep_leftbox_border_clr'),
            array('sanitize' => true, 'slug' => 'livep_hostbox_title_text_clr'),
            array('sanitize' => true, 'slug' => 'livep_hostbox_title_bckg_clr'),
            array('sanitize' => true, 'slug' => 'livep_hostbox_content_text_clr'),
            array('sanitize' => true, 'slug' => 'livep_descbox_title_text_clr'),
            array('sanitize' => true, 'slug' => 'livep_descbox_title_bckg_clr'),
            array('sanitize' => true, 'slug' => 'livep_descbox_content_text_clr'),
            array('sanitize' => true, 'slug' => 'livep_title_clr'),
            array('sanitize' => true, 'slug' => 'livep_bckg_clr'),
            array('sanitize' => true, 'slug' => 'livep_bckg_img'),
            array('sanitize' => true, 'slug' => 'livep_vidurl'),
            array('sanitize' => true, 'slug' => 'livep_vidurl_type'),
            array('sanitize' => true, 'slug' => 'livep_video_auto_play_yn'),
            array('sanitize' => true, 'slug' => 'livep_incentive_yn'),
            array('sanitize' => true, 'slug' => 'livep_incentive_title'),
            array('sanitize' => true, 'slug' => 'livep_incentive_title_clr'),
            array('sanitize' => true, 'slug' => 'livep_incentive_title_bckg_clr'),
            array('sanitize' => true, 'slug' => 'livep_incentive_bckg_clr'),
            array('sanitize' => true, 'slug' => 'livep_incentive_border_clr'),
            array('sanitize' => true, 'slug' => 'regp_bckg_clr'),
            array('sanitize' => true, 'slug' => 'regp_bckg_img'),
            array('sanitize' => true, 'slug' => 'regp_vidurl'),
            array('sanitize' => true, 'slug' => 'regp_vidurl_type'),
            array('sanitize' => true, 'slug' => 'regp_regformtitle'),
            array('sanitize' => true, 'slug' => 'regp_regformtxt'),
            array('sanitize' => true, 'slug' => 'regp_ctatext'),
            array('sanitize' => true, 'slug' => 'regp_regformfont_clr'),
            array('sanitize' => true, 'slug' => 'regp_regformbckg_clr'),
            array('sanitize' => true, 'slug' => 'regp_regformborder_clr'),
            array('sanitize' => true, 'slug' => 'regp_regformbtn_clr'),
            array('sanitize' => true, 'slug' => 'regp_regformbtnborder_clr'),
            array('sanitize' => true, 'slug' => 'regp_regformbtntxt_clr'),
            array('sanitize' => true, 'slug' => 'regp_regtitle_clr'),
            array('sanitize' => true, 'slug' => 'regp_regmeta_clr'),
            array('sanitize' => true, 'slug' => 'regp_wbndesc_clr'),
            array('sanitize' => true, 'slug' => 'regp_wbndescbck_clr'),
            array('sanitize' => true, 'slug' => 'regp_wbndescborder_clr'),
            array('sanitize' => true, 'slug' => 'tnxp_vidurl'),
            array('sanitize' => true, 'slug' => 'tnxp_vidurl_type'),
            array('sanitize' => true, 'slug' => 'tnxp_pagetitle'),
            array('sanitize' => true, 'slug' => 'tnxp_pagetitle_clr'),
            array('sanitize' => true, 'slug' => 'tnxp_bckg_clr'),
            array('sanitize' => true, 'slug' => 'tnxp_bckg_img'),
            array('sanitize' => true, 'slug' => 'tnxp_tktbckg_clr'),
            array('sanitize' => true, 'slug' => 'tnxp_tktbdr_clr'),
            array('sanitize' => true, 'slug' => 'tnxp_tkttxt_clr'),
            array('sanitize' => true, 'slug' => 'tnxp_tktbodybckg_clr'),
            array('sanitize' => true, 'slug' => 'tnxp_tkthdrbckg_clr'),
            array('sanitize' => true, 'slug' => 'tnxp_tkthdrtxt_clr'),
            array('sanitize' => true, 'slug' => 'tnxp_tktbtn_clr'),
            array('sanitize' => true, 'slug' => 'tnxp_tktbtntxt_clr'),
            array('sanitize' => true, 'slug' => 'tnxp_link_above_clr'),
            array('sanitize' => true, 'slug' => 'tnxp_link_below_clr'),
            array('sanitize' => true, 'slug' => 'tnxp_socialsharing_border_clr'),
            array('sanitize' => true, 'slug' => 'tnxp_socialsharing_bckg_clr'),
            array('sanitize' => true, 'slug' => 'tnxp_calendar_border_clr'),
            array('sanitize' => true, 'slug' => 'tnxp_calendar_bckg_clr'),
            array('sanitize' => true, 'slug' => 'tnxp_calendartxt_clr'),
            array('sanitize' => true, 'slug' => 'tnxp_calendarbtntxt_clr'),
            array('sanitize' => true, 'slug' => 'tnxp_calendarbtnbckg_clr'),
            array('sanitize' => true, 'slug' => 'tnxp_calendarbtnborder_clr'),
            array('sanitize' => true, 'slug' => 'cntdwnp_title_clr'),
            array('sanitize' => true, 'slug' => 'cntdwnp_tagline_clr'),
            array('sanitize' => true, 'slug' => 'cntdwnp_desc_clr'),
            array('sanitize' => true, 'slug' => 'cntdwnp_bckg_clr'),
            array('sanitize' => true, 'slug' => 'cntdwnp_bckg_img'),
            array('sanitize' => true, 'slug' => 'cntdwnp_timershow_yn'),
            array('sanitize' => true, 'slug' => 'replayp_title_clr'),
            array('sanitize' => true, 'slug' => 'replayp_bckg_clr'),
            array('sanitize' => true, 'slug' => 'replayp_bckg_img'),
            array('sanitize' => true, 'slug' => 'replayp_askq_yn'),
            array('sanitize' => true, 'slug' => 'replayp_askq_bckg_clr'),
            array('sanitize' => true, 'slug' => 'replayp_askq_title_text_clr'),
            array('sanitize' => true, 'slug' => 'replayp_webdes_yn'),
            array('sanitize' => true, 'slug' => 'replayp_hostbox_yn'),
            array('sanitize' => true, 'slug' => 'replayp_yn'),
            array('sanitize' => true, 'slug' => 'replayp_vidurl'),
            array('sanitize' => true, 'slug' => 'replayp_vidurl_type'),
            array('sanitize' => true, 'slug' => 'replayp_incentive_yn'),
            array('sanitize' => true, 'slug' => 'replayp_leftbox_bckg_clr'),
            array('sanitize' => true, 'slug' => 'replayp_hostbox_title_text_clr'),
            array('sanitize' => true, 'slug' => 'replayp_hostbox_title_bckg_clr'),
            array('sanitize' => true, 'slug' => 'replayp_hostbox_content_text_clr'),
            array('sanitize' => true, 'slug' => 'replayp_descbox_title_text_clr'),
            array('sanitize' => true, 'slug' => 'replayp_descbox_title_bckg_clr'),
            array('sanitize' => true, 'slug' => 'replayp_descbox_content_text_clr'),
            array('sanitize' => true, 'slug' => 'replayp_title_clr'),
            array('sanitize' => true, 'slug' => 'replayp_bckg_clr'),
            array('sanitize' => true, 'slug' => 'replayp_bckg_img'),
            array('sanitize' => true, 'slug' => 'replayp_vidurl'),
            array('sanitize' => true, 'slug' => 'replayp_vidurl_type'),
            array('sanitize' => true, 'slug' => 'replayp_video_auto_play_yn'),
            array('sanitize' => true, 'slug' => 'replayp_incentive_yn'),
            array('sanitize' => true, 'slug' => 'replayp_incentive_title'),
            array('sanitize' => true, 'slug' => 'replayp_incentive_title_clr'),
            array('sanitize' => true, 'slug' => 'replayp_incentive_bckg_clr'),
            array('sanitize' => true, 'slug' => 'hostmetabox_hostname'),
        );

        foreach ($field_array as $field) {

            $slug = $field['slug'];
            $dataToSave = '';
            if (isset($_POST[$slug])) {
                $dataToSave = $_POST[$slug];
            } elseif (isset($field['def'])) {
                $dataToSave = $field['def'];
            }

            if ($field['sanitize'])
                $dataToSave = sanitize_text_field($dataToSave);
            update_post_meta($post_id, '_wswebinar_' . $slug, $dataToSave);
        }
        wpautop(stripslashes(update_post_meta($post_id, '_wswebinar_livep_incentive_content', $_POST['livep_incentive_content'])));
        wpautop(stripslashes(update_post_meta($post_id, '_wswebinar_replayp_incentive_content', $_POST['replayp_incentive_content'])));
        $regs = WebinarSysteemAttendees::getAttendies($post_id);
        if (get_post_meta($post_id, '_wswebinar_gener_webinar_status', true) == 'rep') {
            foreach ($regs as $reg):
                if ($reg->replaymailsent == 0) {
                    $sendreplaymail = new WebinarSysteemMails;
                    $wbreplaymail = $sendreplaymail->SendMailtoAttendeeReplayLink_Template($reg->name, $reg->email, $post_id);
                    if ($wbreplaymail == true):
                        WebinarSysteemAttendees::modifyAttendee($reg->id, array('replaymailsent' => '1'), array('%d'));
                    endif;
                }
            endforeach;
        }
    }

    /*
     * 
     * Hostname meta box
     *  
     */

    function webinarMetaBoxHostContent($post) {
        wp_nonce_field('webinarmetaboxhost', 'webinarmetaboxhost_nonce');
        ?>
        <div class="form-field">
            <label for="hostmetabox_hostname"><?php _e('Webinar will be presented by:', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="hostmetabox_hostname" id="hostmetabox_hostname" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_hostmetabox_hostname', true)); ?>">
            <p class="description"><?php _e('Separate each by commas', WebinarSysteem::$lang_slug); ?></p>
            <div class="webinar_clear_fix"></div>
        </div>
        <?php
    }

    /*
     * 
     * Content Stylings for Live and Replay pages
     * 
     */

    static function _page_styling($post, $live = TRUE) {
        $page = $live ? 'livep' : 'replayp';
        ?>
        <h3 class="ws-accordian-title"><i class="wbn-icon wbnicon-play ws-accordian-icon"></i> <?php _e('Host & Description Box', WebinarSysteem::$lang_slug) ?></h3>
        <div class="ws-accordian-section">

            <div class="form-field">
                <label for="<?php echo $page ?>_leftbox_bckg_clr"><?php _e('Background color', WebinarSysteem::$lang_slug); ?></label>
                <input type="text" name="<?php echo $page ?>_leftbox_bckg_clr" class="color-field" id="<?php echo $page ?>_leftbox_bckg_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_' . $page . '_leftbox_bckg_clr', true)); ?>">
                <div class="webinar_clear_fix"></div>
            </div>

            <div class="wsseparator"></div>

            <div class="form-group">
                <label for="<?php echo $page ?>_hostbox_yn"><?php _e('Show Host Box', WebinarSysteem::$lang_slug); ?></label>
                <?php $livep_hostbox_yn_value = get_post_meta($post->ID, '_wswebinar_' . $page . '_hostbox_yn', true); ?>
                <input type="checkbox" name="<?php echo $page ?>_hostbox_yn" id="<?php echo $page ?>_hostbox_yn" value="yes" <?php echo ($livep_hostbox_yn_value == "yes" ) ? 'checked="checked"' : ''; ?> >
                <div class="webinar_clear_fix"></div>
            </div>

            <div class="form-field">
                <label for="<?php echo $page ?>_hostbox_title_bckg_clr"><?php _e('Host Title Background color', WebinarSysteem::$lang_slug); ?></label>
                <input type="text" name="<?php echo $page ?>_hostbox_title_bckg_clr" class="color-field" id="<?php echo $page ?>_hostbox_title_bckg_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_' . $page . '_hostbox_title_bckg_clr', true)); ?>">
                <div class="webinar_clear_fix"></div>
            </div>

            <div class="form-field">
                <label for="<?php echo $page ?>_hostbox_title_text_clr"><?php _e('Host Title Text color', WebinarSysteem::$lang_slug); ?></label>
                <input type="text" name="<?php echo $page ?>_hostbox_title_text_clr" class="color-field" id="<?php echo $page ?>_hostbox_title_text_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_' . $page . '_hostbox_title_text_clr', true)); ?>">
                <div class="webinar_clear_fix"></div>
            </div>

            <div class="form-field">
                <label for="<?php echo $page ?>_hostbox_content_text_clr"><?php _e('Host Text color', WebinarSysteem::$lang_slug); ?></label>
                <input type="text" name="<?php echo $page ?>_hostbox_content_text_clr" class="color-field" id="<?php echo $page ?>_hostbox_content_text_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_' . $page . '_hostbox_content_text_clr', true)); ?>">
                <div class="webinar_clear_fix"></div>
            </div>

            <div class="wsseparator"></div>

            <div class="form-group">
                <label for="<?php echo $page ?>_webdes_yn"><?php _e('Show Description Box', WebinarSysteem::$lang_slug); ?></label>
                <?php $livep_webdes_yn_value = get_post_meta($post->ID, '_wswebinar_' . $page . '_webdes_yn', true); ?>
                <input type="checkbox" name="<?php echo $page ?>_webdes_yn" id="<?php echo $page ?>_webdes_yn" value="yes" <?php echo ($livep_webdes_yn_value == "yes" ) ? 'checked="checked"' : ''; ?> >
                <div class="webinar_clear_fix"></div>
            </div>

            <div class="form-field">
                <label for="<?php echo $page ?>_descbox_title_bckg_clr"><?php _e('Description Title Background color', WebinarSysteem::$lang_slug); ?></label>
                <input type="text" name="<?php echo $page ?>_descbox_title_bckg_clr" class="color-field" id="<?php echo $page ?>_descbox_title_bckg_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_' . $page . '_descbox_title_bckg_clr', true)); ?>">
                <div class="webinar_clear_fix"></div>
            </div>

            <div class="form-field">
                <label for="<?php echo $page ?>_descbox_title_text_clr"><?php _e('Description Title Text color', WebinarSysteem::$lang_slug); ?></label>
                <input type="text" name="<?php echo $page ?>_descbox_title_text_clr" class="color-field" id="<?php echo $page ?>_descbox_title_text_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_' . $page . '_descbox_title_text_clr', true)); ?>">
                <div class="webinar_clear_fix"></div>
            </div>

            <div class="form-field">
                <label for="<?php echo $page ?>_descbox_content_text_clr"><?php _e('Description Text color', WebinarSysteem::$lang_slug); ?></label>
                <input type="text" name="<?php echo $page ?>_descbox_content_text_clr" class="color-field" id="<?php echo $page ?>_descbox_content_text_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_' . $page . '_descbox_content_text_clr', true)); ?>">
                <div class="webinar_clear_fix"></div>
            </div>


        </div>

        <h3 class="ws-accordian-title"><i class="wbn-icon wbnicon-play ws-accordian-icon"></i> <?php _e('Question Box', WebinarSysteem::$lang_slug) ?></h3>
        <div class="ws-accordian-section">

            <div class="form-group">
                <label for="<?php echo $page ?>_askq_yn"><?php _e('Show Question box', WebinarSysteem::$lang_slug); ?></label>
                <?php $livep_askq_yn_value = get_post_meta($post->ID, '_wswebinar_' . $page . '_askq_yn', true); ?>
                <input type="checkbox" name="<?php echo $page ?>_askq_yn" id="<?php echo $page ?>_askq_yn" value="yes" <?php echo ($livep_askq_yn_value == "yes" ) ? 'checked="checked"' : ''; ?> >
                <div class="webinar_clear_fix"></div>
            </div>

            <div class="form-field">
                <label for="<?php echo $page ?>_askq_bckg_clr"><?php _e('Background color', WebinarSysteem::$lang_slug); ?></label>
                <input type="text" name="<?php echo $page ?>_askq_bckg_clr" class="color-field" id="<?php echo $page ?>_askq_bckg_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_' . $page . '_askq_bckg_clr', true)); ?>">
                <div class="webinar_clear_fix"></div>
            </div>

            <div class="form-field">
                <label for="<?php echo $page ?>_askq_title_text_clr"><?php _e('Title Text color', WebinarSysteem::$lang_slug); ?></label>
                <input type="text" name="<?php echo $page ?>_askq_title_text_clr" class="color-field" id="<?php echo $page ?>_askq_title_text_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_' . $page . '_askq_title_text_clr', true)); ?>">
                <div class="webinar_clear_fix"></div>
            </div>

        </div>

        <h3 class="ws-accordian-title"><i class="wbn-icon wbnicon-play ws-accordian-icon"></i> <?php _e('Incentive Box', WebinarSysteem::$lang_slug) ?></h3>
        <div class="ws-accordian-section">

            <div class="form-field">
                <label for="<?php echo $page ?>_incentive_bckg_clr"><?php _e('Background color', WebinarSysteem::$lang_slug); ?></label>
                <input type="text" name="<?php echo $page ?>_incentive_bckg_clr" class="color-field" id="<?php echo $page ?>_incentive_bckg_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_' . $page . '_incentive_bckg_clr', true)); ?>">
                <div class="webinar_clear_fix"></div>
            </div>

            <div class="form-group">
                <label for="<?php echo $page ?>_incentive_yn"><?php _e('Show Incentive Box', WebinarSysteem::$lang_slug); ?></label>
                <?php $livep_incentive_yn_value = get_post_meta($post->ID, '_wswebinar_' . $page . '_incentive_yn', true); ?>
                <input type="checkbox" name="<?php echo $page ?>_incentive_yn" id="<?php echo $page ?>_incentive_yn" value="yes" <?php echo ($livep_incentive_yn_value == "yes" ) ? 'checked="checked"' : ''; ?> >
                <div class="webinar_clear_fix"></div>
            </div>

            <div class="form-field">
                <label for="<?php echo $page ?>_incentive_title"><?php _e('Incentive Title', WebinarSysteem::$lang_slug); ?></label>
                <input type="text" name="<?php echo $page ?>_incentive_title" id="<?php echo $page ?>_incentive_title" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_' . $page . '_incentive_title', true)); ?>">
                <div class="webinar_clear_fix"></div>
            </div>

            <div class="form-field">
                <label for="<?php echo $page ?>_incentive_title_clr"><?php _e('Title Text color', WebinarSysteem::$lang_slug); ?></label>
                <input type="text" name="<?php echo $page ?>_incentive_title_clr" class="color-field" id="<?php echo $page ?>_incentive_title_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_' . $page . '_incentive_title_clr', true)); ?>">
                <div class="webinar_clear_fix"></div>
            </div>

            <div class="form-group">
                <label for="<?php echo $page ?>_incentive_content"><?php _e('Incentive box content', WebinarSysteem::$lang_slug); ?></label>
                <?php
                $meta = get_post_meta($post->ID, '_wswebinar_' . $page . '_incentive_content', true);
                $content = apply_filters('meta_content', $meta);
                wp_editor($content, $page . '_incentive_content');
                ?>
                <div class="webinar_clear_fix"></div>
            </div>
        </div>
        <?php
    }

    function previewButton($post, $page = 'register') {
        ?>
        <a target="wp-preview-<?php echo $post->ID; ?>" class="preview button wswebinar_button" href="<?php echo add_query_arg(array('force_show' => $page), get_post_permalink($post->ID)); ?>"><?php _e('Preview Page', WebinarSysteem::$lang_slug) ?></a>
        <span class="description"><?php _e('Only use this generated link for test purposes', WebinarSysteem::$lang_slug); ?></span>
        <?php
    }

}
