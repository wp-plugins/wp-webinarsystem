<?php

class WebinarSysteemPreviewMails extends WebinarSysteem {

    public static function previewMails() {

        if (empty($_GET['run'])) {
            echo 'error';
        } else {
            $run = $_GET['run'];
            $email = $_GET['email'];
            $posts = query_posts(array('post_type' => 'wswebinars'));
            $mailingFunctions = new WebinarSysteemMails();
            switch ($run) {
                case "_wswebinar_1hrb4":
                    $mailingFunctions->SendMailtoAttendee1hr_Template("this is an preview email", $email, $posts[0]->ID, TRUE);
                    echo json_encode(TRUE);
                    break;
                case "_wswebinar_24hrb4":
                    $mailingFunctions->SendMailtoAttendee24hr_Template("this is an preview email", $email, $posts[0]->ID, TRUE);
                    echo json_encode(TRUE);
                    break;
                case "_wswebinar_wbnreplay":
                    $mailingFunctions->SendMailtoAttendeeReplayLink_Template("this is an preview email", $email, $posts[0]->ID, TRUE);
                    echo json_encode(TRUE);
                    break;
                case "_wswebinar_wbnstarted":
                    $mailingFunctions->SendMailtoAttendeeStarted_Template("this is an preview email", $email, $posts[0]->ID, TRUE);
                    echo json_encode(TRUE);
                    break;
            }
            die();
        }
    }
    

}
