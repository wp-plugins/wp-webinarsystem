<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of class-webinarsysteemviews
 *
 * @author Thambaru
 */
class WebinarSysteemViews {

    static function get_livepage_data($post, $status) {
        $page = ($status == 'live' || $status == 'liv') ? 'livep_' : 'replayp_';
        setup_postdata($post);
        WebinarSysteem::setPostData($post->ID);
        return array(
            'data_title_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'title_clr', true),
            'data_backg_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'bckg_clr', true),
            'data_backg_img' => get_post_meta($post->ID, '_wswebinar_' . $page . 'bckg_img', true),
            'data_imgvid_type' => get_post_meta($post->ID, '_wswebinar_' . $page . 'vidurl_type', true),
            'data_imgvid_url' => get_post_meta($post->ID, '_wswebinar_' . $page . 'vidurl', true),
            'data_show_presenter' => get_post_meta($post->ID, '_wswebinar_' . $page . 'hostbox_yn', true),
            'data_show_desc' => get_post_meta($post->ID, '_wswebinar_' . $page . 'webdes_yn', true),
            'data_show_ques' => get_post_meta($post->ID, '_wswebinar_' . $page . 'askq_yn', true),
            'data_show_incentive' => get_post_meta($post->ID, '_wswebinar_' . $page . 'incentive_yn', true),
            'data_defImgUrl' => plugins_url('/images/clapper.jpg', __FILE__),
            'data_hostnames' => WebinarSysteemHosts::getHostsArray($post->ID),
            'data_hostcount' => WebinarSysteemHosts::hostCount($post->ID),
            'data_autoplay' => get_post_meta($post->ID, '_wswebinar_' . $page . 'video_auto_play_yn', true),
            'data_askq_title_text_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'askq_title_text_clr', true),
            'data_livep_askq_bckg_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'askq_bckg_clr', true),
            'data_livep_leftbox_bckg_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'leftbox_bckg_clr', true),
            'data_livep_descbox_title_bckg_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'descbox_title_bckg_clr', true),
            'data_livep_descbox_title_text_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'descbox_title_text_clr', true),
            'data_livep_descbox_content_text_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'descbox_content_text_clr', true),
            'data_livep_hostbox_title_bckg_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'hostbox_title_bckg_clr', true),
            'data_livep_hostbox_title_text_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'hostbox_title_text_clr', true),
            'data_livep_hostbox_content_text_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'hostbox_content_text_clr', true),
            'data_livep_incentive_bckg_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'incentive_bckg_clr', true),
            'data_livep_incentive_title_clr' => get_post_meta($post->ID, '_wswebinar_' . $page . 'incentive_title_clr', true),
        );
    }

}
