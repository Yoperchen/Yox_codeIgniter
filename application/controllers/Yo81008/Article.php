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
	/**
	 * view-source:http://codeigniter_3_1_0_yo.me/index.php/Yo81008/Article/get_article_info?article_id=30
	 */
	public function get_article_info()
	{
	    $condition['id']=$this->input->get('article_id');
	    
	    $get_article_info_result = $this->article_logic->get_article_info($condition);
	    
	    print_r($get_article_info_result);die();
	    
	    $this->load->view('article_info');
	}
	public function add_article_info()
	{
	    
	}
	/**
	 * view-source:http://codeigniter_3_1_0_yo.me/index.php/Yo81008/Article/get_article_list?type=2
	 */
	public function get_article_list()
	{
	    $condition['type']=$this->input->get('type');//1:公告;2:普通文章;3:论坛贴;4日志;5说说;6:新闻
	    $condition['store_id']=$this->input->get('store_id');
	    $page_size=$this->input->get('page_size');;
// 	    print_r($condition);
// 	    die();
	    $get_article_list_result = $this->article_logic->get_article_list($condition,'*',$page_size=20);
	    
	    print_r($get_article_list_result);die();
	    
	    $this->load->view('article_list');
	}
	public function test()
	{
	    $this->article_logic->test();
	}
}
