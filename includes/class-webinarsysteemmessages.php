<?php

Class WebinarSysteemMails extends WebinarSysteem {

    function __construct() {
        parent::setAttributes();
        add_action('wp', array($this, 'registerMailSender'));
        add_action('wswebinarsendscheduledmails', array($this, 'wswebinarsendscheduledmails'));
        add_filter('cron_schedules', array($this, 'cron_add_minute'));
    }

    public function AdminMailAddress() {
        $optionAdminemailset = get_option('_wswebinar_AdminEmailAddress');
        return $AdminMailAddress = (!empty($optionAdminemailset) ? $optionAdminemailset : get_bloginfo('admin_email') );
    }

    public function SendFromMailAddress() {
        $sender_addr = get_option('_wswebinar_email_senderAddress');
        if (empty($sender_addr)):
            update_option('_wswebinar_email_senderAddress', get_bloginfo('admin_email'));
        endif;
    }

    private function GeneralEmailTemplateTop($title, $content) {
        $hdr_Img = get_option('_wswebinar_email_headerImg');
        $logoURI = (!empty($hdr_Img) ? $hdr_Img : '');
        $bse_clr = get_option('_wswebinar_email_baseCLR');
        $basecolor = (!empty($bse_clr) ? $bse_clr : '#fff');
        $em_back_clr = get_option('_wswebinar_email_bckCLR');
        $bodybgcolor = (!empty($em_back_clr) ? $em_back_clr : '#f2f2f2');
        $bdy_clr = get_option('_wswebinar_email_bodyBck');
        $emailbodybgcolor = (!empty($bdy_clr) ? $bdy_clr : '#fff');
        $bdy_text = get_option('_wswebinar_email_bodyTXT');
        $bodyTXTcolor = (!empty($bdy_text) ? $bdy_text : 'black');

        ob_start();

        WsWebinarTemplate_EmailHeader::get($logoURI, $title, $content, $basecolor, $bodybgcolor, $emailbodybgcolor, $bodyTXTcolor);

        $MailHTMLheadPart = ob_get_contents();
        ob_end_clean();
        return $MailHTMLheadPart;
    }

    private function GeneralEmailTemplateBottom() {
        ob_start();
//        $footer = (!null == get_option('_wswebinar_email_footerTxt') ? '<hr/> ' . get_option('_wswebinar_email_footerTxt') : '');
//        echo $footer;

        WsWebinarTemplate_EmailFooter::get();


        $MailHTMLfootPart = ob_get_contents();
        ob_end_clean();
        return $MailHTMLfootPart;
    }

    public function SendMailtoAdmin($inputName, $post_id, $inputEmail) {
        ob_start();
        WsWebinarTemplate_AdminDefault::get($post_id, $inputName, $inputEmail);
        $NewReaderTemplate = ob_get_contents();
        ob_end_clean();
        $MessagetoAdmin = $this->GeneralEmailTemplateTop(__('New Registration', WebinarSysteem::$lang_slug), $NewReaderTemplate) . $this->GeneralEmailTemplateBottom();

        $WebinarEmailHeader = array();
        $WebinarEmailHeader[] = "MIME-Version: 1.0";
        $WebinarEmailHeader[] = "Content-type: text/html; charset=iso-8859-1";
        $WebinarEmailHeader[] = "From: " . esc_attr(get_option('_wswebinar_email_sentFrom')) . " <" . get_option('_wswebinar_email_senderAddress') . '>';
        return wp_mail($this->AdminMailAddress(), __('New Registration', WebinarSysteem::$lang_slug), $MessagetoAdmin, $WebinarEmailHeader);
    }

    public function SendMailtoReader($inputName, $inputEmail, $post_id) {
        ob_start();
        WsWebinarTemplate_Reader::get($inputName, $post_id);
        $NewReaderTemplate = ob_get_contents();
        ob_end_clean();
        $MessagetoAttendee = $this->GeneralEmailTemplateTop(__('Reminder', WebinarSysteem::$lang_slug), $NewReaderTemplate) . $this->GeneralEmailTemplateBottom();

        $WebinarEmailHeader = array();
        $WebinarEmailHeader[] = "MIME-Version: 1.0";
        $WebinarEmailHeader[] = "Content-type: text/html; charset=iso-8859-1";
        $WebinarEmailHeader[] = "From: " . esc_attr(get_option('_wswebinar_email_sentFrom')) . " <" . get_option('_wswebinar_email_senderAddress') . '>';

        wp_mail($inputEmail, __('You are registered for the webinar!', WebinarSysteem::$lang_slug), $MessagetoAttendee, $WebinarEmailHeader);
    }

    public function SendMailtoAttendee24hr_Template($inputName, $inputEmail, $post_id, $preview = FALSE) {
        if (get_option('_wswebinar_24hrb4enable') == 'on' || $preview) {
            $data_hour = get_post_meta($post_id, '_wswebinar_gener_hour', true);
            $data_min = get_post_meta($post_id, '_wswebinar_gener_min', true);
            $wb_time = $data_hour . ':' . $data_min . 'hrs';
            $wb24b4content = get_option('_wswebinar_24hrb4content');
            if (!empty($wb24b4content)) {
                //User customized the template
                $replaceThese = array('[receiver-name]' => $inputName, '[webinar-title]' => get_the_title($post_id), '[webinar-link]' => get_permalink($post_id, false), '[webinar-date]' => get_post_meta($post_id, '_wswebinar_gener_date', true), '[webinar-time]' => $wb_time);
                $text = str_replace("\r", "<br />", get_option('_wswebinar_24hrb4content'));
                foreach ($replaceThese as $what => $with):
                    $newText = str_replace($what, $with, $text);
                    $text = $newText;
                endforeach;
                $OneDayTemplate = $text;
            } else {
                //Use Default template
                ob_start();
                WsWebinarTemplate_Attendee24hr::get($inputName, $post_id);
                $OneDayTemplate = ob_get_contents();
                ob_end_clean();
            }
            $title_24hr = get_option('_wswebinar_24hrb4subject');
            $EmailTitle = (!empty($title_24hr) ? $title_24hr : __('Reminder', WebinarSysteem::$lang_slug));
            $MessagetoAttendee = $this->GeneralEmailTemplateTop($EmailTitle, $OneDayTemplate) . $this->GeneralEmailTemplateBottom();

            $WebinarEmailHeader = array();
            $WebinarEmailHeader[] = "MIME-Version: 1.0";
            $WebinarEmailHeader[] = "Content-type: text/html; charset=iso-8859-1";
            $WebinarEmailHeader[] = "From: " . esc_attr(get_option('_wswebinar_email_sentFrom')) . " <" . get_option('_wswebinar_email_senderAddress') . '>';

            return wp_mail($inputEmail, $EmailTitle, $MessagetoAttendee, implode("\r\n", $WebinarEmailHeader));
        }
    }

    public function SendMailtoAttendee1hr_Template($inputName, $inputEmail, $post_id, $preview = FALSE) {
        if (get_option('_wswebinar_1hrb4enable') == 'on' || $preview) {
            $data_hour = get_post_meta($post_id, '_wswebinar_gener_hour', true);
            $data_min = get_post_meta($post_id, '_wswebinar_gener_min', true);
            $wb_time = $data_hour . ':' . $data_min . 'hrs';
            $wb1hrb4content = get_option('_wswebinar_1hrb4content');
            if (!empty($wb1hrb4content)) {
                //User customized the template
                $replaceThese = array('[receiver-name]' => $inputName, '[webinar-title]' => get_the_title($post_id), '[webinar-link]' => get_permalink($post_id, false), '[webinar-date]' => get_post_meta($post_id, '_wswebinar_gener_date', true), '[webinar-time]' => $wb_time);

                $meta = str_replace("\r", "<br />", get_option('_wswebinar_1hrb4content'));
                $text = apply_filters('meta_content', $meta);

                foreach ($replaceThese as $what => $with):
                    $newText = str_replace($what, $with, $text);
                    $text = $newText;
                endforeach;
                $OneHourTemplate = $text;
            } else {
                ob_start();
                WsWebinarTemplate_Attendee1hr::get($inputName, $post_id);
                $OneHourTemplate = ob_get_contents();
                ob_end_clean();
            }
            $title_b41hr = get_option('_wswebinar_1hrb4subject');
            $EmailTitle = (!empty($title_b41hr) ? $title_b41hr : __('We are live in one hour!', WebinarSysteem::$lang_slug));
            $MessagetoAttendee = $this->GeneralEmailTemplateTop($EmailTitle, $OneHourTemplate) . $this->GeneralEmailTemplateBottom();

            $WebinarEmailHeader = array();
            $WebinarEmailHeader[] = "MIME-Version: 1.0";
            $WebinarEmailHeader[] = "Content-type: text/html; charset=iso-8859-1";
            $WebinarEmailHeader[] = "From: " . esc_attr(get_option('_wswebinar_email_sentFrom')) . " <" . get_option('_wswebinar_email_senderAddress') . '>';
            return wp_mail($inputEmail, $EmailTitle, $MessagetoAttendee, implode("\r\n", $WebinarEmailHeader));
        }
    }

    public function SendMailtoAttendeeStarted_Template($inputName, $inputEmail, $post_id, $preview = FALSE) {
        if (get_option('_wswebinar_wbnstartedenable') == 'on' || $preview) {
            $data_hour = get_post_meta($post_id, '_wswebinar_gener_hour', true);
            $data_min = get_post_meta($post_id, '_wswebinar_gener_min', true);
            $wb_time = $data_hour . ':' . $data_min . 'hrs';
            $wbstarted = get_option('_wswebinar_wbnstarted');
            if (!empty($wbstarted)) {
                //User customized the template
                $replaceThese = array('[receiver-name]' => $inputName, '[webinar-title]' => get_the_title($post_id), '[webinar-link]' => get_permalink($post_id, false), '[webinar-date]' => get_post_meta($post_id, '_wswebinar_gener_date', true), '[webinar-time]' => $wb_time);
                $text = str_replace("\r", "<br />", get_option('_wswebinar_wbnstarted'));
                foreach ($replaceThese as $what => $with):
                    $newText = str_replace($what, $with, $text);
                    $text = $newText;
                endforeach;
                $WebinarStartedTemplate = $text;
            } else {
                ob_start();
                WsWebinarTemplate_AttendeeStarted::get($inputName, $post_id);
                $WebinarStartedTemplate = ob_get_contents();
                ob_end_clean();
            }
            $title_wbnstarted = get_option('_wswebinar_wbnstartedsubject');
            $EmailTitle = (!empty($title_wbnstarted) ? $title_wbnstarted : __('We are starting the webinar!', WebinarSysteem::$lang_slug));
            $MessagetoAttendee = $this->GeneralEmailTemplateTop($EmailTitle, $WebinarStartedTemplate) . $this->GeneralEmailTemplateBottom();

            $WebinarEmailHeader = array();
            $WebinarEmailHeader[] = "MIME-Version: 1.0";
            $WebinarEmailHeader[] = "Content-type: text/html; charset=iso-8859-1";
            $WebinarEmailHeader[] = "From: " . esc_attr(get_option('_wswebinar_email_sentFrom')) . " <" . get_option('_wswebinar_email_senderAddress') . '>';
            return wp_mail($inputEmail, $EmailTitle, $MessagetoAttendee, $WebinarEmailHeader);
        }
    }

    public function SendMailtoAttendeeReplayLink_Template($inputName, $inputEmail, $post_id, $preview = FALSE) {
        if (get_option('_wswebinar_wbnreplayenable') == 'on' || $preview) {
            $data_hour = get_post_meta($post_id, '_wswebinar_gener_hour', true);
            $data_min = get_post_meta($post_id, '_wswebinar_gener_min', true);
            $wb_time = $data_hour . ':' . $data_min . 'hrs';
            $wbreplay = get_option('_wswebinar_wbnreplay');
            if (!empty($wbreplay)) {
                //User customized the template
                $replaceThese = array('[receiver-name]' => $inputName, '[webinar-title]' => get_the_title($post_id), '[webinar-link]' => get_permalink($post_id, false), '[webinar-date]' => get_post_meta($post_id, '_wswebinar_gener_date', true), '[webinar-time]' => $wb_time);
                $text = str_replace("\r", "<br />", get_option('_wswebinar_wbnreplay'));
                foreach ($replaceThese as $what => $with):
                    $newText = str_replace($what, $with, $text);
                    $text = $newText;
                endforeach;
                $ReplayTemplate = $text;
            } else {
                ob_start();
                WsWebinarTemplate_AttendeeStarted::get($inputName, $post_id);
                $ReplayTemplate = ob_get_contents();
                ob_end_clean();
            }
            $title_wbnreplay = get_option('_wswebinar_wbnreplaysubject');
            $EmailTitle = (!empty($title_wbnreplay) ? $title_wbnreplay : __('Webinar Replay Link', WebinarSysteem::$lang_slug));
            $MessagetoAttendee = $this->GeneralEmailTemplateTop($EmailTitle, $ReplayTemplate) . $this->GeneralEmailTemplateBottom();
            $WebinarEmailHeader = array();
            $WebinarEmailHeader[] = "MIME-Version: 1.0";
            $WebinarEmailHeader[] = "Content-type: text/html; charset=iso-8859-1";
            $WebinarEmailHeader[] = "From: " . esc_attr(get_option('_wswebinar_email_sentFrom')) . " <" . get_option('_wswebinar_email_senderAddress') . '>';

            return wp_mail($inputEmail, $EmailTitle, $MessagetoAttendee, $WebinarEmailHeader);
        }
    }

    public function wswebinarsendscheduledmails() {
        $loop = new WP_Query(array('post_type' => 'wswebinars'));

        if ($loop->have_posts()) :
            while ($loop->have_posts()) :
                $loop->the_post();

                if (WebinarSysteem::isRecurring(get_the_ID())) {
                    //$occrances = WebinarSysteem::getRecurringInstances(get_the_ID());
                    $occcur_times = WebinarSysteem::getRecurringInstancesInTime(get_the_ID());
                    foreach ($occcur_times as $time) {

                        if ($this->checkBeforeOneHour($time['datetime']) || ($this->checkBefore5mins($time['datetime'])) || $this->checkBetween23and26Hours($time['datetime'])) {
                            $atts = WebinarSysteemAttendees::getAttendiesByOccurance(get_the_ID(), $time['day'], $time['time']);
                            foreach ($atts as $att)
                                $this->triggerApplicableMailSender($att, $time['datetime'], get_the_ID(), TRUE);
                        }
                    }
                } else {

                    $wswebinarTime = (int) get_post_meta(get_the_id(), '_wswebinar_gener_time', true); //Get webinar time
                    $regs = WebinarSysteemAttendees::getAttendies(get_the_ID());
                    foreach ($regs as $reg)
                        $this->triggerApplicableMailSender($reg, $wswebinarTime, get_the_ID(), FALSE);
                }
            endwhile;
        endif;
    }

    private function triggerApplicableMailSender($reg, $webtime, $webinar_id, $is_recurring) {
        /*
         * Email Types
         * 
         * One Hour Email = 1;
         * One Day Email = 2;
         * Webinar Starting Email = 3;
         */

        if (!empty($reg->id)) {
            if ($this->checkBeforeOneHour($webtime) && !WebinarSysteemAttendees::checkRecurringNotificationSent($reg, 1, $is_recurring)) {
                $sentmail1hr = $this->SendMailtoAttendee1hr_Template($reg->name, $reg->email, $webinar_id);
                if ($sentmail1hr == true)
                    WebinarSysteemAttendees::markAttendeeNotificationSend($reg, 1, $is_recurring);
                //WebinarSysteemAttendees::modifyAttendee($reg->id, array('onehourmailsent' => '1'), array('%d'));
            }elseif ($this->checkBetween23and26Hours($webtime) && !WebinarSysteemAttendees::checkRecurringNotificationSent($reg, 2, $is_recurring)) {
                $sentmail1day = $this->SendMailtoAttendee24hr_Template($reg->name, $reg->email, $webinar_id);
                if ($sentmail1day == true)
                    WebinarSysteemAttendees::markAttendeeNotificationSend($reg, 2, $is_recurring);
                //WebinarSysteemAttendees::modifyAttendee($reg->id, array('onedaymailsent' => '1'), array('%d'));
            }elseif ($this->checkBefore5mins($webtime) && !WebinarSysteemAttendees::checkRecurringNotificationSent($reg, 3, $is_recurring)) {
                $wbstartingmail = $this->SendMailtoAttendeeStarted_Template($reg->name, $reg->email, $webinar_id);
                if ($wbstartingmail == true)
                    WebinarSysteemAttendees::markAttendeeNotificationSend($reg, 3, $is_recurring);
                //WebinarSysteemAttendees::modifyAttendee($reg->id, array('wbstartingmailsent' => '1'), array('%d'));
            }
        }
    }

    private function checkBeforeOneHour($time) {
        if (($time - 3600) < current_time('timestamp') && current_time('timestamp') < $time)
            return TRUE;
        return FALSE;
    }

    private function checkBetween23and26Hours($time) {
        if (($time - 60 * 60 * 23) > current_time('timestamp') && current_time('timestamp') > ($time - 60 * 60 * 26))
            return TRUE;
        return FALSE;
    }

    private function checkBefore5mins($time) {
        if ($time > current_time('timestamp') && current_time('timestamp') > ($time - 60 * 5))
            return TRUE;
        return FALSE;
    }

// add custom interval
    public function cron_add_minute($schedules) {
// Adds once every minute to the existing schedules.
        $schedules['every1minute'] = array(
            'interval' => 60,
            'display' => __('Once a minute'),
        );

        return $schedules;
    }

    public function registerMailSender() {
        if (!wp_next_scheduled('wswebinarsendscheduledmails')) {
            wp_schedule_event(time(), 'every1minute', 'wswebinarsendscheduledmails');
        }
    }

    public static function getTimeDateString($post_id, $attendee) {
        $timeFormat = get_option('time_format');
        $dateFormat = get_option('date_format');
        $time = '';
        $date = '';
        if (WebinarSysteem::isRecurring($post_id)) {
            $time_ = WebinarSysteem::getWebinarTime($post_id, $attendee);
            $time = date_i18n($timeFormat, $time_) . " (" . get_option('gmt_offset') . " GMT)";
            $date = date_i18n($dateFormat, $time_);
        } else {
            $time = get_post_meta($post_id, '_wswebinar_gener_hour', true) . ':' . get_post_meta($post_id, '_wswebinar_gener_min', true) . __('hrs', WebinarSysteem::$lang_slug);
            $date = get_post_meta($post_id, '_wswebinar_gener_date', true);
        }

        return array('time' => $time, 'date' => $date);
    }

}
