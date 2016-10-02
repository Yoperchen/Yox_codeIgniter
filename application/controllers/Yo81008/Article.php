<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends CI_Controller {
    public function __construct()
    {
    
        parent::__construct();
        $this->load->logic('article_logic');
    }

	public function index()
	{
	    
		$this->load->view('article_list');
	}
	public function get_article_info()
	{
	    $condition['id']=$this->input->get('article_id');
	    
	    $get_article_info_result = $this->article_logic->get_article_info($condition);
	    
	    print_r($get_article_info_result);die();
	    
	    $this->load->view('article_info');
	}
	public function get_article_list()
	{
	    $condition['type']=$this->input->get('type');
	    $condition['store_id']=$this->input->get('store_id');
	    $page_size=$this->input->get('page_size');;
	    
	    $get_article_list_result = $this->article_logic->get_article_list($condition,'*',$page_size=20);
	    print_r($get_article_list_result);
	    $this->load->view('article_list');
	}
	public function test()
	{
	    $this->article_logic->test();
	}
}
