<?php

class WebinarSysteemAttendees {

    public static function wbn_attendees_list() {
        ?>
        <div class="wrap wswebinarwrap">
            <div class="wswebinarLogo">
                <img src="<?php echo plugins_url('images/WebinarSysteem-logo.png', __FILE__); ?>" />
            </div>
			<div style="clear: both"></div>
            <h2><?php _e('WP WebinarSystem Attendees', WebinarSysteem::$lang_slug); ?></h2>
            <p><?php _e('Select webinar to view attendees for active webinars', WebinarSysteem::$lang_slug); ?></p>


            <div id="wpbody">
                <div class="tablenav top">
                    <form action="edit.php">
                        <div class="actions">
                            <input type="hidden" name="post_type" value="wswebinars">
                            <input type="hidden" name="page" value="wswbn-attendees">
                            <?php
                            $loop = new WP_Query(array('post_type' => 'wswebinars'));

                            if ($loop->have_posts()) :
                                ?><select name='id' class="selectwebinar"> <?php
                                while ($loop->have_posts()) : $loop->the_post();
                                    ?>
                                        <option value="<?php the_ID(); ?>" <?php
                                        $webinarID = (isset($_GET['id']) ? $_GET['id'] : get_the_ID() );
                                        echo (get_the_ID() == $webinarID ? 'selected' : null );
                                        ?>><?php the_title(); ?></option>
                                                <?php
                                            endwhile;
                                            ?></select><?php
                            else:
                                ?>
                                <select class="selectwebinar"><option selected><?php _e('Please add webinars to listup.', WebinarSysteem::$lang_slug) ?></option></select><?php
                            endif;
                            ?>

                            <input type='submit' value='Select' class='selectwebinar button'>
                            <?php
                            if ($loop->have_posts()) :
                                $post_id = (isset($_GET["id"]) ? $_GET["id"] : get_the_ID());
                                $regs = self::getAttendies($post_id);
                                $btnsdisabled = ($regs == null ? true : false);
                            endif;
                            ?>
                            <span class="attendees-top">
                                <input postid="<?php echo $post_id; ?>" type="button" <?php echo ($btnsdisabled ? 'disabled' : NULL); ?> class="button exportbcc" value="Export BCC" />
                                <input postid="<?php echo $post_id; ?>" type="button" <?php echo ($btnsdisabled ? 'disabled' : NULL); ?> class="button exportcsv" value="Export CSV" />
                            </span>   
                        </div>
                </div>
                </form>
                <table class="wp-list-table widefat">
                    <thead><tr scope="row">
                            <th scope="col" class="manage-column">#</th>
                            <th scope="col" class="manage-column"><?php _e('Name', WebinarSysteem::$lang_slug); ?></th>
                            <th scope="col" class="manage-column"><?php _e('E-Mail', WebinarSysteem::$lang_slug); ?></th>
                            <th scope="col" class="manage-column"><?php _e('Registered Date', WebinarSysteem::$lang_slug); ?></th>
                            <th scope="col" class="manage-column"><?php _e('Edit', WebinarSysteem::$lang_slug); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($regs)) :
                            $post_id = (isset($_GET["id"]) ? $_GET["id"] : get_the_ID());
                            $count = 0;
                            $metaCount = 0;
                            if (is_array($regs)):
                                $exportdisabled = false;
                                foreach ($regs as $reg):
                                    ?>
                                    <tr scope="row" id="attendee-row-<?php echo $reg->id; ?>" class="<?php echo ( ++$count % 2 ? "alternate" : null) ?>">
                                        <td><?php echo $count ?></td>
                                        <td><?php echo $reg->name; ?></td>
                                        <td><?php echo $reg->email; ?></td>
                                        <td><?php echo date('Y-m-d', strtotime($reg->time)) ?></td>
                                        <td>
                                            <a class="button removeAttendee" data-attendeeid="<?php echo $reg->id; ?>" ><?php _e('Remove', WebinarSysteem::$lang_slug) ?></a>
                                        </td>
                                        </form>
                                    </tr>
                                    <?php
                                    $metaCount++;
                                endforeach;
                            endif;
                        else:
                            ?>
                            <tr scope="row" class="alternate"> <td id="no-attendees" colspan="4"><?php _e('No Attendees :(', WebinarSysteem::$lang_slug) ?></td> </tr>
                        <?php endif;
                        ?>
                    </tbody>
                    <tfoot><tr scope="row">
                            <th scope="col" class="manage-column">#</th>
                            <th scope="col" class="manage-column"><?php _e('Name', WebinarSysteem::$lang_slug); ?></th>
                            <th scope="col" class="manage-column"><?php _e('E-Mail', WebinarSysteem::$lang_slug); ?></th>
                            <th scope="col" class="manage-column"><?php _e('Registered Date', WebinarSysteem::$lang_slug); ?></th>
                            <th scope="col" class="manage-column"><?php _e('Edit', WebinarSysteem::$lang_slug); ?></th>
                        </tr>
                    </tfoot>
                </table>
                <div class="attendees-bottom">
                    <input postid="<?php echo $post_id; ?>" type="button" <?php echo ($btnsdisabled ? 'disabled' : NULL); ?> class="button exportbcc" value="Export BCC">
                    <input postid="<?php echo $post_id; ?>" type="button" <?php echo ($btnsdisabled ? 'disabled' : NULL); ?> class="button exportcsv" value="Export CSV">
                </div>
            </div>
        </div>
        <?php
    }

    static function getMetaIdByKey($post_id, $meta_key) {
        global $wpdb;
        $mid = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->postmeta WHERE post_id = %d AND meta_key = %s", $post_id, $meta_key));
        return $mid;
    }

    public static function getAttendies($webinar_id) {
        global $wpdb;
        $table = WSWEB_DB_TABLE_PREFIX . 'subscribers';
        $query = "SELECT * FROM $table WHERE webinar_id = $webinar_id";
        $query.=" ORDER BY id DESC";
        return $wpdb->get_results($query);
    }

    public static function getAttendiesByOccurance($webinar_id, $day, $time) {
        global $wpdb;
        $table = WSWEB_DB_TABLE_PREFIX . 'subscribers';
        $query = "SELECT * FROM $table WHERE webinar_id = $webinar_id AND watch_day = '$day' AND watch_time = '$time'";
        $query.=" ORDER BY id DESC";
        return $wpdb->get_results($query);
    }

    public static function getAttendee($webinar_id) {
        $attendee_localdata = WebinarSysteemAttendees::getAttendeeLocalData();
        if (!isset($attendee_localdata->email) || !isset($attendee_localdata->key))
            return array();
        global $wpdb;
        $table = WSWEB_DB_TABLE_PREFIX . 'subscribers';
        $query = "SELECT * FROM $table WHERE email = '" . $attendee_localdata->email . "' AND webinar_id = $webinar_id";
        if (!empty($key))
            $query.=" AND secretkey = '$key'";
        $query.=" LIMIT 1";
        return $wpdb->get_row($query);
    }

    public static function saveAttendie($array, $format = array()) {
        global $wpdb;
        $num = $wpdb->insert(WSWEB_DB_TABLE_PREFIX . "subscribers", $array, $format);
    }

    public static function getTimeDifferenceToWebinar($webinar_id) {
        $attendee = self::getAttendee($webinar_id);
        $web_time = WebinarSysteem::getWebinarTime($webinar_id, $attendee);
        return $web_time - current_time('timestamp');
    }

    public static function saveNotificationSend($attendee_id, $type) {
        global $wpdb;
        $num = $wpdb->insert(WSWEB_DB_TABLE_PREFIX . "notifications", array('attendee_id' => $attendee_id, 'notification_type' => $type), array('%d', '%d'));
    }

    public static function getNumberOfSubscriptions($webinar_id) {
        global $wpdb;
        return $wpdb->get_var("SELECT COUNT(*) FROM " . WSWEB_DB_TABLE_PREFIX . "subscribers WHERE webinar_id = $webinar_id");
    }

    public static function checkRecurringNotificationSent($attendee, $type, $is_recurring) {
        /*
         * Email Types
         * 
         * One Hour Email = 1;
         * One Day Email = 2;
         * Webinar Starting Email = 3;
         */

        if ($is_recurring) {
            global $wpdb;
            $count = $wpdb->get_var("SELECT COUNT(*) FROM " . WSWEB_DB_TABLE_PREFIX . "notifications WHERE attendee_id = $attendee->id AND notification_type = $type AND DATE(sent_at) > (NOW() - INTERVAL 6 DAY) ");
            if ($count > 0)
                return TRUE;
            return FALSE;
        }else {
            if ($type == 1) {
                if ($attendee->onehourmailsent == 1)
                    return TRUE;
                return FALSE;
            }elseif ($type == 2) {
                if ($attendee->onedaymailsent == 1)
                    return TRUE;
                return FALSE;
            }elseif ($type == 3) {
                if ($attendee->wbstartingmailsent == 1)
                    return TRUE;
                return FALSE;
            }
        }
    }

    public static function markAttendeeNotificationSend($attendee, $type, $is_recurring) {
        /*
         * Email Types
         * 
         * One Hour Email = 1;
         * One Day Email = 2;
         * Webinar Starting Email = 3;
         */

        if ($is_recurring) {
            self::saveNotificationSend($attendee->id, $type);
        } else {
            if ($type == 1) {
                self::modifyAttendee($attendee->id, array('onehourmailsent' => '1'), array('%d'));
            } elseif ($type == 2) {
                self::modifyAttendee($attendee->id, array('onedaymailsent' => '1'), array('%d'));
            } elseif ($type == 3) {
                self::modifyAttendee($attendee->id, array('wbstartingmailsent' => '1'), array('%d'));
            }
        }
    }

    /*
     * 
     * Create and let user to download attendee CSV of a requested webinar.
     * 
     */

    public static function createCsvFile() {
        if (!isset($_GET['wswebinar_createcsv']) || !isset($_GET['postid']))
            return false;

        $postid = $_GET["postid"];
        $regs = WebinarSysteemAttendees::getAttendies($postid);

        $getTitle = get_the_title($postid);
        $posttitle = !empty($getTitle) ? $getTitle : 'Unknown';

        $csvTitle = 'webinarsysteem_subscriptions_' . self::adjustAndGetTitleForFileNames($posttitle) . '_' . time() . '.csv';

        $csvArray = array();
        $csvArray[] = array('Name', 'Email', 'Registered on');
        foreach ($regs as $regw):
            $csvArray[] = array(!empty($regw->name) ? $regw->name : '', !empty($regw->email) ? $regw->email : '', !empty($regw->time) ? $regw->time : '');
        endforeach;

        self::convertToCsv($csvArray, $csvTitle, ',');

        exit();
    }

    private static function adjustAndGetTitleForFileNames($posttitle) {
        return preg_replace("/[\s_]/", "_", preg_replace("/[\s-]+/", " ", preg_replace("/[^a-z0-9_\s-]/", "", strtolower($posttitle))));
    }

    /*
     * 
     * Create and let user to download attendee BCC list of a requested webinar.
     * 
     */

    public static function createBccFile() {
        if (!isset($_GET['wswebinar_createbcc']) || !isset($_GET['postid']))
            return false;

        $postid = $_GET["postid"];
        $regs = WebinarSysteemAttendees::getAttendies($postid);

        $getTitle = get_the_title($postid);
        $posttitle = !empty($getTitle) ? $getTitle : 'Unknown';

        $textTitle = 'webinarsysteem_bcclist_' . self::adjustAndGetTitleForFileNames($posttitle) . '_' . time() . '.txt';

        $bccArray = array();
        foreach ($regs as $regw):
            $bccArray[] = $regw->name . ' <' . $regw->email . '>';
        endforeach;
        header('Content-type: text/plain; charset=utf-8');
        header('Content-Disposition: attachement; filename="' . $textTitle . '";');
        echo implode(", ", $bccArray);
        exit();
    }

    /*
     * 
     * Convert array to CSV
     * 
     */

    private static function convertToCsv($input_array, $output_file_name, $delimiter) {
        $temp_memory = fopen('php://memory', 'w');
        foreach ($input_array as $line) {
            fputcsv($temp_memory, $line, $delimiter);
        }
        fseek($temp_memory, 0);
        header('Content-Type: application/csv');
        header('Content-Disposition: attachement; filename="' . $output_file_name . '";');
        fpassthru($temp_memory);
    }

    public static function removeAttendee() {
        $retrn = array('error' => FALSE);
        if (!isset($_POST['attid']) || empty($_POST['attid'])) {
            $retrn['error'] = TRUE;
        } else {
            global $wpdb;
            $process = $wpdb->delete(WSWEB_DB_TABLE_PREFIX . 'subscribers', array('id' => ((int) $_POST['attid'])));
            if (!$process) {
                $retrn['error'] = TRUE;
            }
        }
        echo json_encode($retrn);
        wp_die();
    }

    public static function modifyAttendee($row_id, $columns, $format = array('%d')) {
        global $wpdb;
        return $wpdb->update(WSWEB_DB_TABLE_PREFIX . 'subscribers', $columns, array('id' => $row_id), $format, array('%d'));
    }

    public static function getAttendeeLocalData() {
        $obj = new stdClass();
        if (isset($_COOKIE['_wswebinar_registered_email']))
            $obj->email = $_COOKIE['_wswebinar_registered_email'];
        if (isset($_COOKIE['_wswebinar_registered_key']))
            $obj->key = $_COOKIE['_wswebinar_registered_key'];
        return $obj;
    }

}
