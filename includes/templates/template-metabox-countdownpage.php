<?php $this->previewButton($post, 'countdown'); ?>
<div class="webinar_clear_fix"></div>
<div id="cntdwnp-accordian" class="ws-accordian">
    <h3 class="ws-accordian-title"><i class="wbn-icon wbnicon-play ws-accordian-icon"></i> <?php _e('General', WebinarSysteem::$lang_slug) ?></h3>
    <div class="ws-accordian-section">
        <div class="form-field">
            <label for="cntdwnp_title_clr"><?php _e('Title color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="cntdwnp_title_clr" class="color-field" id="cntdwnp_title_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_cntdwnp_title_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="cntdwnp_tagline_clr"><?php _e('Tagline color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="cntdwnp_tagline_clr" class="color-field" id="cntdwnp_tagline_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_cntdwnp_tagline_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="cntdwnp_desc_clr"><?php _e('Description color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="cntdwnp_desc_clr" class="color-field" id="cntdwnp_desc_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_cntdwnp_desc_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="cntdwnp_bckg_clr"><?php _e('Background color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="cntdwnp_bckg_clr" class="color-field" id="cntdwnp_bckg_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_cntdwnp_bckg_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="cntdwnp_bckg_img"><?php _e('Background image', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="cntdwnp_bckg_img" id="cntdwnp_bckg_img" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_cntdwnp_bckg_img', true)); ?>">
            <button class="button wswebinar_uploader" resultId="cntdwnp_bckg_img" uploader_title="<?php _e('Countdown Page Background Image', WebinarSysteem::$lang_slug); ?>"><?php _e('Upload Image', WebinarSysteem::$lang_slug); ?></button>
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-group">
            <label for="cntdwnp_timershow_yn"><?php _e('Show countdown timer', WebinarSysteem::$lang_slug); ?></label>
<?php $cntdwnp_timershow_yn_value = get_post_meta($post->ID, '_wswebinar_cntdwnp_timershow_yn', true); ?>
            <input type="checkbox" name="cntdwnp_timershow_yn" id="cntdwnp_timershow_yn" value="yes" <?php echo ($cntdwnp_timershow_yn_value == "yes" ) ? 'checked="checked"' : ''; ?> >
            <div class="webinar_clear_fix"></div>
        </div>
    </div>
</div>