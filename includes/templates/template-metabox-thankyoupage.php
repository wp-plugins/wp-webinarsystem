<?php $this->previewButton($post, 'thankyou'); ?>
<div class="webinar_clear_fix"></div>
<div id="tnxp-accordian" class="ws-accordian">
    <h3 class="ws-accordian-title"><i class="wbn-icon wbnicon-play ws-accordian-icon"></i> <?php _e('General', WebinarSysteem::$lang_slug) ?></h3>
    <div class="ws-accordian-section">
        <div class="form-field">
            <label for="tnxp_pagetitle"><?php _e('Title text', WebinarSysteem::$lang_slug); ?></label>
            <?php $title = get_post_meta($post->ID, '_wswebinar_tnxp_pagetitle', true); ?>
            <input type="text" name="tnxp_pagetitle" id="tnxp_pagetitle" value="<?php echo empty($title) ? __('Yeah! You Are Registered For The Webinar!', WebinarSysteem::$lang_slug) : esc_attr($title); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="tnxp_pagetitle_clr"><?php _e('Title color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="tnxp_pagetitle_clr" class="color-field" id="tnxp_pagetitle_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_tnxp_pagetitle_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="tnxp_bckg_clr"><?php _e('Background color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="tnxp_bckg_clr" class="color-field" id="tnxp_bckg_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_tnxp_bckg_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="tnxp_bckg_img"><?php _e('Background image', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="tnxp_bckg_img" id="tnxp_bckg_img" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_tnxp_bckg_img', true)); ?>">
            <button class="button wswebinar_uploader" resultId="tnxp_bckg_img" uploader_title="<?php _e('Thankyou Page Background Image', WebinarSysteem::$lang_slug); ?>"><?php _e('Upload Image', WebinarSysteem::$lang_slug); ?></button>
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="tnxp_vidurl"><?php _e('Content type', WebinarSysteem::$lang_slug); ?></label>
            <?php $tnxp_vidurl_type = get_post_meta($post->ID, '_wswebinar_tnxp_vidurl_type', true); ?>
            <select class="form-control lookoutImageButton" valueField="tnxp_vidurl" imageUploadButton="tnxp_vidurl_upload_button" name="tnxp_vidurl_type" id="tnxp_vidurl_type">
                <option value="youtube" <?php echo $tnxp_vidurl_type == "youtube" ? 'selected' : ''; ?>>Hangouts / Youtube</option>
                <option value="vimeo" <?php echo $tnxp_vidurl_type == "vimeo" ? 'selected' : ''; ?>>Vimeo</option>
                <option value="image" <?php echo $tnxp_vidurl_type == "image" ? 'selected' : ''; ?>><?php _e('Image', WebinarSysteem::$lang_slug) ?></option>                
            </select>
        </div>

        <div class="form-field">
            <label for="tnxp_vidurl"><?php _e('Video or Image URL', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="tnxp_vidurl" id="tnxp_vidurl" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_tnxp_vidurl', true)); ?>">

            <button class="button wswebinar_uploader" style="<?php echo (!empty($tnxp_vidurl_type) && $tnxp_vidurl_type == 'image') ? '' : 'display:none;' ?>" id="tnxp_vidurl_upload_button" resultId="tnxp_vidurl" checktype="yes" uploader_title="<?php _e('Thanking Page Video Image', WebinarSysteem::$lang_slug); ?>"><?php _e('Upload Image', WebinarSysteem::$lang_slug); ?></button>

            <p class="description tnxp_vidurl_desc tnxp_vidurl_for_youtube" style="<?php echo (empty($tnxp_vidurl_type) || $tnxp_vidurl_type == 'youtube') ? '' : 'display:none'; ?>"><?php _e('Youtube Video URL (Eg: https://www.youtube.com/watch?v=3TkgTEfx9XM)', WebinarSysteem::$lang_slug); ?></p>
            <p class="description tnxp_vidurl_desc tnxp_vidurl_for_image" style="<?php echo $tnxp_vidurl_type == 'image' ? '' : 'display:none'; ?>"><?php _e('Image URL (Eg: https://example.com/images/the_image.jpg)', WebinarSysteem::$lang_slug); ?></p>
            <div class="webinar_clear_fix"></div>
        </div>
    </div>

    <h3 class="ws-accordian-title"><i class="wbn-icon wbnicon-play ws-accordian-icon"></i> <?php _e('Content', WebinarSysteem::$lang_slug) ?></h3>
    <div class="ws-accordian-section">
        <div class="form-field">
            <label for="tnxp_link_above_clr"><?php _e('Link above Text Color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="tnxp_link_above_clr" class="color-field" id="tnxp_link_above_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_tnxp_link_above_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>
        <div class="form-field">
            <label for="tnxp_link_below_clr"><?php _e('Link below Text Color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="tnxp_link_below_clr" class="color-field" id="tnxp_link_below_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_tnxp_link_below_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>
    </div>

    <h3 class="ws-accordian-title"><i class="wbn-icon wbnicon-play ws-accordian-icon"></i> <?php _e('Ticket', WebinarSysteem::$lang_slug) ?></h3>
    <div class="ws-accordian-section">
        <div class="form-field">
            <label for="tnxp_tktbckg_clr"><?php _e('Border color-1', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="tnxp_tktbckg_clr" class="color-field" id="tnxp_tktbckg_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_tnxp_tktbckg_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="tnxp_tktbdr_clr"><?php _e('Border color-2', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="tnxp_tktbdr_clr" class="color-field" id="tnxp_tktbckg_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_tnxp_tktbdr_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="tnxp_tkttxt_clr"><?php _e('Body Text color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="tnxp_tkttxt_clr" class="color-field" id="tnxp_tktbckg_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_tnxp_tkttxt_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="tnxp_tktbodybckg_clr"><?php _e('Body Background color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="tnxp_tktbodybckg_clr" class="color-field" id="tnxp_tktbodybckg_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_tnxp_tktbodybckg_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="tnxp_tkthdrbckg_clr"><?php _e('Header Background color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="tnxp_tkthdrbckg_clr" class="color-field" id="tnxp_tkthdrbckg_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_tnxp_tkthdrbckg_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="tnxp_tkthdrtxt_clr"><?php _e('Header Text color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="tnxp_tkthdrtxt_clr" class="color-field" id="tnxp_tkthdrtxt_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_tnxp_tkthdrtxt_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="tnxp_tktbtn_clr"><?php _e('Button color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="tnxp_tktbtn_clr" class="color-field" id="tnxp_tktbtn_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_tnxp_tktbtn_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="tnxp_tktbtntxt_clr"><?php _e('Button Text color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="tnxp_tktbtntxt_clr" class="color-field" id="tnxp_tktbtntxt_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_tnxp_tktbtntxt_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>
    </div>

    <h3 class="ws-accordian-title"><i class="wbn-icon wbnicon-play ws-accordian-icon"></i> <?php _e('Social Sharing', WebinarSysteem::$lang_slug) ?></h3>
    <div class="ws-accordian-section">
        <div class="form-field">
            <label for="tnxp_socialsharing_border_clr"><?php _e('Border color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="tnxp_socialsharing_border_clr" class="color-field" id="tnxp_socialsharing_border_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_tnxp_socialsharing_border_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>
        <div class="form-field">
            <label for="tnxp_socialsharing_bckg_clr"><?php _e('Background color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="tnxp_socialsharing_bckg_clr" class="color-field" id="tnxp_socialsharing_bckg_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_tnxp_socialsharing_bckg_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>
    </div>

    <h3 class="ws-accordian-title"><i class="wbn-icon wbnicon-play ws-accordian-icon"></i> <?php _e('Calendar', WebinarSysteem::$lang_slug) ?></h3>
    <div class="ws-accordian-section">
        <div class="form-field">
            <label for="tnxp_calendar_border_clr"><?php _e('Border color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="tnxp_calendar_border_clr" class="color-field" id="tnxp_calendar_border_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_tnxp_calendar_border_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="tnxp_calendar_bckg_clr"><?php _e('Background color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="tnxp_calendar_bckg_clr" class="color-field" id="tnxp_calendar_bckg_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_tnxp_calendar_bckg_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="tnxp_calendartxt_clr"><?php _e('Text color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="tnxp_calendartxt_clr" class="color-field" id="tnxp_calendartxt_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_tnxp_calendartxt_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>
        <div class="form-field">
            <label for="tnxp_calendarbtntxt_clr"><?php _e('Button Text color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="tnxp_calendarbtntxt_clr" class="color-field" id="tnxp_calendarbtntxt_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_tnxp_calendarbtntxt_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="tnxp_calendarbtnbckg_clr"><?php _e('Button Background color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="tnxp_calendarbtnbckg_clr" class="color-field" id="tnxp_calendarbtnbckg_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_tnxp_calendarbtnbckg_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="tnxp_calendarbtnborder_clr"><?php _e('Button Border color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="tnxp_calendarbtnborder_clr" class="color-field" id="tnxp_calendarbtnborder_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_tnxp_calendarbtnborder_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>
    </div>
</div>
