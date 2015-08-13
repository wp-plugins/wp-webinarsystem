<?php

class WebinarSysteemHosts extends WebinarSysteem {

    public static function getHostsArray($postID) {
        $string = get_post_meta($postID, '_wswebinar_hostmetabox_hostname', true);
        return $hosts = explode(',', $string);
    }

    public static function isMultipleHosts($postID) {
        $hosts = self::getHostsArray($postID);
        if (count($hosts) > 1)
            return TRUE;
        return FALSE;
    }

    public static function hostCount($postID) {
        $hosts = self::getHostsArray($postID);
        return count($hosts);
    }

}
