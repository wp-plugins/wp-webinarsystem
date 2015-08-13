<?php $this->previewButton($post, 'register'); ?>
<div class="webinar_clear_fix"></div>
<div id="regp-accordian" class="ws-accordian">
    <h3 class="ws-accordian-title"><i class="wbn-icon wbnicon-play ws-accordian-icon"></i> <?php _e('General', WebinarSysteem::$lang_slug) ?></h3>
    <div class="ws-accordian-section">
        <div class="form-field">
            <label for="regp_bckg_clr"><?php _e('Page Background color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="regp_bckg_clr" class="color-field" id="regp_bckg_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_regp_bckg_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="regp_bckg_img"><?php _e('Page Background image', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="regp_bckg_img" id="regp_bckg_img" class="upload_image_button" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_regp_bckg_img', true)); ?>">
            <button class="button wswebinar_uploader" resultId="regp_bckg_img" uploader_title="<?php _e('Registration Page Background Image', WebinarSysteem::$lang_slug); ?>"><?php _e('Upload Image', WebinarSysteem::$lang_slug); ?></button>
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="regp_vidurl_type"><?php _e('Content type', WebinarSysteem::$lang_slug); ?></label>
            <?php $regp_vidurl_type = get_post_meta($post->ID, '_wswebinar_regp_vidurl_type', true); ?>
            <select class="form-control lookoutImageButton" valueField="regp_vidurl" imageUploadButton="regp_vidurl_upload_button" name="regp_vidurl_type" id="regp_vidurl_type">
                <option value="youtube" <?php echo $regp_vidurl_type == "youtube" ? 'selected' : ''; ?>>Hangouts / Youtube</option>
                <option value="vimeo" <?php echo $livep_vidurl_type == "vimeo" ? 'selected' : ''; ?>>Vimeo</option>
                <option value="image" <?php echo $regp_vidurl_type == "image" ? 'selected' : ''; ?>><?php _e('Image', WebinarSysteem::$lang_slug); ?></option>                
            </select>
        </div>

        <div class="form-field">
            <label for="regp_vidurl"><?php _e('Video or Image URL', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="regp_vidurl" id="regp_vidurl" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_regp_vidurl', true)); ?>">
            <button class="button wswebinar_uploader" id="regp_vidurl_upload_button" checktype="yes" resultId="regp_vidurl" uploader_title="<?php _e('Registration Page Video Image', WebinarSysteem::$lang_slug); ?>"><?php _e('Upload Image', WebinarSysteem::$lang_slug); ?></button>
            <span class="wswaiticon"><img src="<?php echo plugin_dir_url($this->_FILE_); ?>includes/images/wait.GIF"></span>
            <p class="description"><?php _e('Provide an image url or a Youtube Video ID', WebinarSysteem::$lang_slug); ?></p>
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="wsseparator"></div>

        <div class="form-field">
            <label for="regp_regtitle_clr"><?php _e('Title Color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="regp_regtitle_clr" class="color-field" id="regp_regtitle_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_regp_regtitle_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>
        <div class="form-field">
            <label for="regp_regmeta_clr"><?php _e('Date/Time Color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="regp_regmeta_clr" class="color-field" id="regp_regmeta_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_regp_regmeta_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>
    </div>

    <h3 class="ws-accordian-title"><i class="wbn-icon wbnicon-play ws-accordian-icon"></i> <?php _e('Registration Form', WebinarSysteem::$lang_slug) ?></h3>
    <div style="clear: both;" class="ws-accordian-section">
        <div class="form-field">
            <label for="regp_regformbckg_clr"><?php _e('Background color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="regp_regformbckg_clr" class="color-field" id="regp_regformbckg_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_regp_regformbckg_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>
        <div class="form-field">
            <label for="regp_regformborder_clr"><?php _e('Border color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="regp_regformborder_clr" class="color-field" id="regp_regformborder_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_regp_regformborder_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="regp_regformfont_clr"><?php _e('Font color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="regp_regformfont_clr" class="color-field" id="regp_regformfont_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_regp_regformfont_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="regp_regformtitle"><?php _e('Title', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="regp_regformtitle" id="regp_regformtitle" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_regp_regformtitle', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="regp_regformtxt"><?php _e('Text', WebinarSysteem::$lang_slug); ?></label>
            <textarea name="regp_regformtxt" id="regp_regformtxt"><?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_regp_regformtxt', true)); ?></textarea>
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="regp_regformbtn_clr"><?php _e('Button Background color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="regp_regformbtn_clr" class="color-field" id="regp_regformbtn_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_regp_regformbtn_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="regp_regformbtnborder_clr"><?php _e('Button Border color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="regp_regformbtnborder_clr" class="color-field" id="regp_regformbtnborder_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_regp_regformbtnborder_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="regp_regformbtntxt_clr"><?php _e('Button Text color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="regp_regformbtntxt_clr" class="color-field" id="regp_regformbtntxt_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_regp_regformbtntxt_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

        <div class="form-field">
            <label for="regp_ctatext"><?php _e('CTA Button Text', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="regp_ctatext" id="regp_ctatext" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_regp_ctatext', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>

    </div>

    <h3 class="ws-accordian-title"><i class="wbn-icon wbnicon-play ws-accordian-icon"></i> <?php _e('Description', WebinarSysteem::$lang_slug) ?></h3>
    <div class="ws-accordian-section">
        <div class="form-field">
            <label for="regp_wbndesc_clr"><?php _e('Description text color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="regp_wbndesc_clr" class="color-field" id="regp_wbndesc_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_regp_wbndesc_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>
        <div class="form-field">
            <label for="regp_wbndescbck_clr"><?php _e('Description background color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="regp_wbndescbck_clr" class="color-field" id="regp_wbndescbck_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_regp_wbndescbck_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>
        <div class="form-field">
            <label for="regp_wbndescborder_clr"><?php _e('Description border color', WebinarSysteem::$lang_slug); ?></label>
            <input type="text" name="regp_wbndescborder_clr" class="color-field" id="regp_wbndescborder_clr" value="<?php echo esc_attr(get_post_meta($post->ID, '_wswebinar_regp_wbndescborder_clr', true)); ?>">
            <div class="webinar_clear_fix"></div>
        </div>
    </div>
</div>