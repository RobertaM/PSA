<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Json result helper
 *
 * Features:
 * - Sends json results
 */
/**
 * @author  Martynas Maciulevičius
 */
if (!function_exists('send_json_result')) {

    function send_json_message($message, $status) {

        echo json_encode(array(
            "success" => $status,
            "message" => $message
        ));
        exit();
    }

}