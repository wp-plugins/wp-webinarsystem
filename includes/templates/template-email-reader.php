<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of template-email-reader
 *
 * @author Thambaru Wijesekara
 */
class WsWebinarTemplate_Reader {

    public static function get($inputName, $post_id) {
        $attendee = WebinarSysteemAttendees::getAttendee($post_id);
        $time = WebinarSysteemMails::getTimeDateString($post_id, $attendee);
        ?> <p><?php _e('Hi', WebinarSysteem::$lang_slug) ?> <?php echo $inputName; ?>,</p>
        <p style="margin:25px 0px;"><?php _e('Thank you for your registration for the webinar. Below you will find the details of the webinar.', WebinarSysteem::$lang_slug) ?> </p>
        <p><?php _e('Webinar name:', WebinarSysteem::$lang_slug) ?> <?php echo get_the_title($post_id); ?></p>
        <p><?php _e('Date:', WebinarSysteem::$lang_slug) ?> <?php echo $time['date']; ?></p>
        <p><?php _e('Time:', WebinarSysteem::$lang_slug) ?> <?php echo $time['time']; ?></p>
        <p><a style="background-color: green; border-radius: 3px; border: 1px solid transparent; padding: 3px 20px; text-decoration: none;  color:white;" href="<?php echo get_permalink($post_id, false); ?>"><?php _e('Go to Webinar', WebinarSysteem::$lang_slug) ?></a></p>
        <p><?php _e('See you then!', WebinarSysteem::$lang_slug) ?> </p> 
        <p><?php _e('Regards', WebinarSysteem::$lang_slug) ?>,</p>
        <p><i><?php echo get_bloginfo('name'); ?></i></p>
        <?php
    }

}
