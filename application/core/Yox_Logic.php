<?php
class Yox_Logic
{
    public function __construct()
    {
        log_message('debug', "Logic Class Initialized");
    }
    function __get($key)
    {
        $CI = & get_instance();
        return $CI->$key;
    }
}