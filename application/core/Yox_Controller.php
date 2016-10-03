<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Yox_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        log_message('debug', "Yox_Controller Class Initialized");
    }
    /**
     * 成功跳转
     * @param array $data
     * @param url $jumpUrl
     */
    protected function success($data,$jumpUrl)
    {
        empty($jumpUrl) || $jumpUrl=$_SERVER["HTTP_REFERER"];
        $waitSecond=3;
        $this->load->view('success');
        die();
    }
    /**
     * 失败跳转
     * @param array $data
     * @param url $jumpUrl
     */
    protected function error($data,$jumpUrl)
    {
        empty($jumpUrl) || $jumpUrl=$_SERVER["HTTP_REFERER"];
        $waitSecond=3;
        $this->load->view('error');
        die();
    }
}