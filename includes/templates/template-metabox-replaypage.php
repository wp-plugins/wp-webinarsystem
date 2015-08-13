<?php $this->previewButton($post, 'replay'); ?>
<div class="webinar_clear_fix"></div>
<div id="livep-accordian" class="ws-accordian">
    <h3 class="ws-accordian-title"><i class="wbn-icon wbnicon-play ws-accordian-icon"></i> <?php _e('General', WebinarSysteem::$lang_slug) ?></h3>
    <div class="ws-accordian-section">
        <div class="form-field">
            <label for="replayp_title_clr"><?php _e('Title color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="replayp_title_clr" class="color-field" id="replayp_title_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_replayp_title_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="replayp_bckg_clr"><?php _e('Background color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="replayp_bckg_clr" class="color-field" id="replayp_bckg_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_replayp_bckg_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="replayp_bckg_img"><?php _e('Background image', WebinarSysteem::$lang_slug); ?></label>         
            <input type="text" name="replayp_bckg_img" id="replayp_bckg_img" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_replayp_bckg_img', true)); ?>">
            <button class="button wswebinar_uploader" resultId="replayp_bckg_img" uploader_title="<?php _e('Replay Page Background Image', WebinarSysteem::$lang_slug); ?>"><?php _e('Upload Image', WebinarSysteem::$lang_slug); ?></button>
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="wsseparator"></div>

        <div class="form-group">
            <label for="replayp_yn"><?php _e('Replay available?', WebinarSysteem::$lang_slug); ?></label>
            <?php $replayp_yn_value = get_post_meta($post->ID, '_wswebinar_replayp_yn', true); ?>
            <input type="checkbox" name="replayp_yn" id="replayp_yn" value="yes" <?php echo ($replayp_yn_value == "yes" ) ? 'checked="checked"' : ''; ?> >
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="replayp_vidurl_type"><?php _e('Webinar type', WebinarSysteem::$lang_slug); ?></label>
            <?php $replayp_vidurl_type = get_post_meta($post->ID, '_wswebinar_replayp_vidurl_type', true); ?>
            <select class="form-control lookoutImageButton" valueField="replayp_vidurl" imageUploadButton="replayp_vidurl_upload_button" name="replayp_vidurl_type" id="replayp_vidurl_type">
                <option value="youtube" <?php echo $replayp_vidurl_type == "youtube" ? 'selected' : ''; ?>>Hangouts / Youtube</option>
                <option value="vimeo" <?php echo $livep_vidurl_type == "vimeo" ? 'selected' : ''; ?>>Vimeo</option>
                <option value="image" <?php echo $replayp_vidurl_type == "image" ? 'selected' : ''; ?>><?php _e('Image', WebinarSysteem::$lang_slug) ?></option>                
            </select>
        </div>

        <div class="form-field">
            <label for="replayp_vidurl"><?php _e('Video or Image URL', WebinarSysteem::$lang_slug); ?></label>
            <!--<input type="hidden" name="replayp_vidurl_type_" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_replayp_vidurl_type', true)); ?>" id="replayp_vidurl_type_">-->
            <input type="text" name="replayp_vidurl" id="replayp_vidurl" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_replayp_vidurl', true)); ?>">
            <button id="replayp_vidurl_upload_button" class="button wswebinar_uploader" resultId="replayp_vidurl" checktype="yes" uploader_title="<?php _e('Registration Page Video Image', WebinarSysteem::$lang_slug); ?>" style="<?php echo (!empty($replayp_vidurl_type) && $replayp_vidurl_type == 'image') ? '' : 'display:none;' ?>"><?php _e('Upload Image', WebinarSysteem::$lang_slug); ?></button>
            <span class="wswaiticon"><img src="<?php echo plugin_dir_url($this->_FILE_); ?>includes/images/wait.GIF"></span>


            <p class="description replayp_vidurl_desc replayp_vidurl_for_youtube" style="<?php echo (empty($replayp_vidurl_type) || $replayp_vidurl_type == 'youtube') ? '' : 'display:none'; ?>"><?php _e('Youtube Video URL (Eg: https://www.youtube.com/watch?v=3TkgTEfx9XM)', WebinarSysteem::$lang_slug); ?></p>
            <p class="description replayp_vidurl_desc replayp_vidurl_for_image" style="<?php echo $replayp_vidurl_type == 'image' ? '' : 'display:none'; ?>"><?php _e('Image URL (Eg: https://example.com/images/the_image.jpg)', WebinarSysteem::$lang_slug); ?></p>
            <div class="webinar_clear_fix"></div>
        </div>

    </div>

    <?php WebinarSysteemMetabox::_page_styling($post, FALSE); ?>
</div>