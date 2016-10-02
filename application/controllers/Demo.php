<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Demo extends CI_Controller {

	 public function Index()
    {
        //调用对应的服务
        $this->load->logic('demo_logic');
        
        //执行服务方法
        echo $this->index->Hello();
    }
}
