<?php

class WebinarSysteemQuestions extends WebinarSysteem {

    function __construct() {
        $this->setAttributes();
    }

    /*
     * 
     * Questions view page.
     * 
     */

    public function showPage() {
        $webs = $this->getWebinarList();
        $webinar_id = @$webs[0]->ID;
        if (!empty($_GET['webinar_id']))
            $webinar_id = (int) $_GET['webinar_id'];
        ?>
        <div class="wrap wswebinarwrap">
            <div class="wswebinarLogo">
                <img src="<?php echo plugins_url('images/WebinarSysteem-logo.png', __FILE__); ?>" />
            </div>
			<div style="clear: both"></div>
                <h2><?php _e('WP WebinarSystem Questions', WebinarSysteem::$lang_slug); ?></h2>
                <p><?php _e('Select webinar to view questions for active webinars', WebinarSysteem::$lang_slug); ?></p>
            <div class="tablenav top">
                <div class="alignleft">
                    <form method="get">
                        <input type="hidden" name="post_type" value="wswebinars">
                        <input type="hidden" name="page" value="wswbn-questions">
                        <select name="webinar_id">
                            <?php
                            if (!empty($webinar_id) && $webinar_id > 0) {
                                foreach ($webs as $web):
                                    echo '<option value="' . $web->ID . '"' . ($webinar_id == $web->ID ? "selected" : "") . '>' . $web->post_title . '</option>';
                                endforeach;
                            }
                            ?>
                        </select>
                        <input class="button" type="submit" value="Select">
                    </form>
                    <?php //echo var_dump();  ?>
                </div>
            </div>
            <table class="wp-list-table widefat fixed posts">
                <thead>
                    <?php
                    echo $header__s = '<tr><th class="column-title wsquestionid">#</th><th class="column-title wsquestionname">'.__('Name',  WebinarSysteem::$lang_slug).'</th><th class="column-title">'.__('Question',  WebinarSysteem::$lang_slug).'</th><th class="column-title wsquestiontime">'.__('Time',  WebinarSysteem::$lang_slug).'</th></tr>';
                    ?>
                </thead>
                <tfoot>
                    <?php echo $header__s; ?>
                </tfoot>
                <tbody id="loadQuestions">
                    <?php
                    if (!empty($webinar_id) && $webinar_id > 0) {
                        $res = $this->getQuestionsFromDb($webinar_id);
                        echo $res['string'];
                        $loadedQues = $res['last_id'];
                    }
                    ?>
                </tbody>
            </table>
            <input type="hidden" id="loadedQues" value="<?php echo $loadedQues; ?>">
            <input type="hidden" id="webinar_id" value="<?php echo $webinar_id; ?>">
        </div>
        <script>
            jQuery(document).ready(function() {
                setInterval(function() {
                    var datas = {action: 'retrieveQuestions', webinar_id: jQuery('#webinar_id').val(), last: jQuery('#loadedQues').val()};
                    jQuery.ajax({type: 'POST', data: datas, url: ajaxurl, dataType: 'json'
                    }).done(function(data) {
                        if (data.status) {
                            jQuery('#loadQuestions').prepend(jQuery('' + data.text).hide().fadeIn(2000));
                            jQuery('#loadedQues').val(data.id);
                        }
                    });
                }, 5000);
            });
        </script>
        <?php
    }

    /*
     * 
     * Handles the Ajax request of the questions page.
     * 
     */

    public function retrieveQuestions() {
        $webinar_id = (int) $_POST['webinar_id'];
        $last_id = $_POST['last'];
        $ret = $this->getQuestionsFromDb($webinar_id, $last_id);
        $status = false;
        if (count($ret['num_of_rows']) > 0) {
            $status = true;
        }
        echo json_encode(array('status' => $status, 'text' => $ret['string'], 'id' => $ret['last_id']));
        die();
    }

    /*
     * 
     * Create the <tr> elements for the questions page.
     * 
     */

    public function getQuestionsFromDb($webinar_id, $last_id = NULL) {
        global $wpdb;
        $table = $wpdb->prefix . $this->db_tablename_questions;
        $query = "SELECT * FROM $table WHERE webinar_id = $webinar_id";
        if (!empty($last_id))
            $query.=" AND id > $last_id";
        $query.=" ORDER BY id DESC";
        $savedQues = $wpdb->get_results($query);
        $ret = '';
        //$ret.= '<span>';
        foreach ($savedQues as $que):
            $ret.= '<tr>';
            $ret.= "<td class='wsquestionid'>$que->id</td>";
            $ret.= "<td class='wsquestionname'><a href='mailto:$que->email' target='_blank'>$que->name</a></td>";
            $ret.= "<td class='wsquestion'>$que->question</td>";
            $ret.= "<td class='wsquestiontime'>" . date("Y/m/d H:i A", strtotime($que->time)) . "</td>";
            $ret.= '</tr>';
        endforeach;
        $lastid = 0;
        if (!empty($savedQues[0]->id)) {
            $lastid = $savedQues[0]->id;
        } elseif (!empty($last_id)) {
            $lastid = $last_id;
        }
        //$ret.= '</span>';
        return array('string' => $ret, 'last_id' => $lastid, 'num_of_rows' => count($savedQues));
    }

    private function getWebinarList() {
        $args = array(
            'orderby' => 'post_date',
            'order' => 'DESC',
            //'meta_key'         => '',
            //'meta_value'       => '',
            'post_type' => 'wswebinars',
            'post_status' => 'publish',
            'suppress_filters' => true);

        $webs = get_posts($args);
        return $webs;
    }

}
