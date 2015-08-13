<?php

class WsWebinarTemplate_AdminDefault {

    public static function get($post_id,$inputName,$inputEmail) {
        ?>
        <p><?php _e('Howdy', WebinarSysteem::$lang_slug) ?>,</p>
        <p style="margin:25px 0px;"><?php echo $inputName; ?> (<?php echo $inputEmail; ?>) <?php _e('just signed up for your webinar', WebinarSysteem::$lang_slug) ?> <i><?php echo get_the_title($post_id) ?></i></p>
        <p><?php _e('Regards', WebinarSysteem::$lang_slug) ?>,</p>
        <p><i><?php echo get_bloginfo('name'); ?></i></p>
        <?php
    }

}
