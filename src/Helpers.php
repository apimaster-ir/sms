<?php

if (!function_exists('sms')) {

    /**
     * @param       $phone
     * @param int   $pattern_id
     * @param array $vars
     * @return bool|string
     */
    function sms($phone, int $pattern_id, array $vars = array())
    {
        return \APIMaster\SMS\SMS::send($phone, $pattern_id, $vars);
    }

}
