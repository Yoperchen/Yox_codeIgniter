<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Article extends Yox_Controller {
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
	 * 获取信息
	 * view-source:http://codeigniter_3_1_0_yo.me/index.php/Yo81008/Article/get_article_info?article_id=30
	 */
	public function get_article_info()
	{
	    $condition['id']=$this->input->get('article_id');
	    
	    $get_article_info_result = $this->article_logic->get_article_info($condition);
	    
	    print_r($get_article_info_result);die();
	    
	    $this->load->view('article_info');
	}
	/**
	 * 添加
	 */
	public function add_article_info()
	{
	    $article_data['user_id']=$this->input->get('user_id');
	    $article_data['store_id']=$this->input->get('store_id');
	    $article_data['title']=$this->input->get('title');
	    $article_data['type']=$this->input->get('type');
	    $article_data['category_id']=$this->input->get('category_id');//分类id
	    $article_data['desc']=$this->input->get('desc');
	    $article_data['content']=$this->input->get('content');
	    $article_data['sort']=$this->input->get('sort');
	    $article_data['from_url']=$this->input->get('from_url');
	    $article_data['author']=$this->input->get('author');
	    $article_data['community_id']=$this->input->get('community_id');
	    $article_data['up']=$this->input->get('up');
	    $article_data['down']=$this->input->get('down');
	    $article_data['like']=$this->input->get('like');
	    $article_data['status']=$this->input->get('status');
	    $article_data['view']=$this->input->get('view');
	    $article_data['img1']=$this->input->get('img1');
	    $article_data['img2']=$this->input->get('img2');
	    $article_data['img3']=$this->input->get('img3');
	    if(!empty($article_data))
	    {
	        $add_result=$this->article_logic->add_article_info($article_data);
	        if(Yox_is_ajax())
	        {
	            die(json_encode($add_result));
	        }
	        if($add_result['status']>0){
	            $this->success($add_result['message']);
	        }else {
	            $this->error($add_result['message']);
	        }
	    }
	    
	    $this->load->view('article_info');
	}
	/**
	 * 获取列表
	 * view-source:http://codeigniter_3_1_0_yo.me/index.php/Yo81008/Article/get_article_list?type=2
	 */
	public function get_article_list()
	{
	    $condition['type']=$this->input->get('type');//1:公告;2:普通文章;3:论坛贴;4日志;5说说;6:新闻
	    $condition['store_id']=$this->input->get('store_id');
	    $page_size=$this->input->get('page_size')?$this->input->get('page_size'):20;
// 	    print_r($condition);
// 	    die();
	    $get_article_list_result = $this->article_logic->get_article_list($condition,'*',$page_size);
	    foreach($get_article_list_result['data']['list'] as $article){
	        echo '<br/>'.$article['id'];
	    }print_r($get_article_list_result['data']['page']);die();
// 	    print_r($get_article_list_result);die();
	    
	    $this->load->view('article_list');
	}
	/**
	 * 修改
	 */
	public function update_article()
	{
	    $condition['id']=$this->input->get('article_id');
	    $article_data['user_id']=$this->input->get('user_id');
	    $article_data['store_id']=$this->input->get('store_id');
	    $article_data['title']=$this->input->get('title');
	    $article_data['type']=$this->input->get('type');
	    $article_data['category_id']=$this->input->get('category_id');//分类id
	    $article_data['desc']=$this->input->get('desc');
	    $article_data['content']=$this->input->get('content');
	    $article_data['sort']=$this->input->get('sort');
	    $article_data['from_url']=$this->input->get('from_url');
	    $article_data['author']=$this->input->get('author');
	    $article_data['community_id']=$this->input->get('community_id');
	    $article_data['up']=$this->input->get('up');
	    $article_data['down']=$this->input->get('down');
	    $article_data['like']=$this->input->get('like');
	    $article_data['status']=$this->input->get('status');
	    $article_data['view']=$this->input->get('view');
	    $article_data['img1']=$this->input->get('img1');
	    $article_data['img2']=$this->input->get('img2');
	    $article_data['img3']=$this->input->get('img3');
	    
	    $update_result = $this->article_logic->update_article($condition,$article_data);
	    if(Yox_is_ajax())
	    {
	        die(json_encode($update_result));
	    }
	}
	public function delete_article()
	{
	    
	}
	public function test()
	{
	    $this->article_logic->test();
	}
}
