<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of template-email-attendee1hr
 *
 * @author Thambaru Wijesekara
 */
class WsWebinarTemplate_Attendee1hr {

    public static function get($inputName, $post_id) {
        $attendee = WebinarSysteemAttendees::getAttendee($post_id);
        $time_st = WebinarSysteemMails::getTimeDateString($post_id, $attendee);
        $wb_date = $time_st['date'];
        $wb_time = $time_st['time'];
        ?>
        <p><?php _e('Hi', WebinarSysteem::$lang_slug)
        ?> <?php echo $inputName ?>,</p>
        <p style="margin:25px 0px;"><?php _e('The webinar you signed up for starts in one hour. Below you will find the link to attend the webinar.', WebinarSysteem::$lang_slug) ?></p>
        <p><b><?php _e('Webinar name:', WebinarSysteem::$lang_slug) ?></b> <?php echo get_the_title($post_id) ?></p>
        <p><b><?php _e('Date:', WebinarSysteem::$lang_slug) ?></b> <?php echo $wb_date; ?></p>
        <p><b><?php _e('Time:', WebinarSysteem::$lang_slug) ?></b> <?php echo $wb_time; ?></p>
        <p><a style="background-color: green; border-radius: 3px; border: 1px solid transparent; padding: 3px 20px; text-decoration: none;  color:white;" href="<?php echo get_permalink($post_id, false); ?>"><?php _e('Go to Webinar', WebinarSysteem::$lang_slug) ?></a></p>
        <p><?php _e('See you then!', WebinarSysteem::$lang_slug) ?></p>
        <p><?php _e('Regards', WebinarSysteem::$lang_slug) ?>,</p>
        <p><i><?php echo get_bloginfo('name'); ?></i></p>    
        <?php
    }

}
