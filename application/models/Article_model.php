<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 文章
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class Article_model extends Yox_Model {
	public function __construct()
	{
	    // Call the CI_Model constructor
	    $this->table='article';
        parent::__construct();
	}
	public function get_article_info($condition,$fields='*')
	{
	    $result = array('status'=>0);
	    if(!empty($condition['user_id'])&&!is_numeric($condition['user_id']))
	    {
	        $result['message']='user_id 错误';
	        return $result;
	    }
	    $info = $this->db->where($condition)->select($fields)->get($this->table)->row_array();
// 	    $this->db->where($condition);
// 	    $this->db->select($fields);
// 	    $query=$this->db->get($this->table);
// 	    $info = $query->row_array();
	    
	    $result['status']=1;
	    $result['message']='获取成功';
	    $result['data']=$info;
	    return $result;
	}
	/**
	 * 添加信息
	 * @param array $article_data
	 * @return array
	 */
	public function add_article_info($article_data) 
	{
	    $result = array('status'=>0);
	    if($article_data)
	    {
	        $result['message']='数据为空';
	        return $result;
	    }
	    if(!empty($article_data['user_id'])&&!is_numeric($article_data['user_id']))
	    {
	        $result['message']='user_id 错误';
	        return $result;
	    }
	    $article_data['add_time']=time();
	    $is_insert = $this->db->insert($this->table, $article_data);
	    
	    if(!$is_insert)
	    {
	        $result['message']='插入失败';
	        return $result;
	    }
	    $result['status']=1;
	    $result['message']='插入成功';
	    $result['data']['article_id']=$is_insert;
	    return $result;
	}
	/**
	 * 获取列表
	 * @param array $condition
	 * @param string $fields
	 * @param number $page_size
	 * @return array
	 */
	public function get_article_list($condition,$fields='*',$page_size=20)
	{
        $result = array('status'=>0);
        $this->load->library('pagination');
        $count = $this->db->where($condition)->count_all_results($this->table);// 查询满足要求的总记录数
        $list  = $this->db->where($condition)->select($fields)->order_by('id desc')->limit($page_size,$this->input->get('per_page')?($this->input->get('per_page')-1)*$page_size:0)->get($this->table)->result_array();
        $config = $this->get_page_config($count,$page_size);
        $this->pagination->initialize($config['data']);
//         print_r();
	    $result['status']=1;
	    $result['message']='查询成功';
	    $result['data']['page']=array(
						'count'=>$count,//文章总数
						'page_size'=>$page_size,//每页几条
						'page'=>$this->input->get('per_page'),//当前第几页
						'page_str'=>$this->pagination->create_links(),//创建分页链接
					);
	    $result['data']['list']=$list;
	    return $result;
	}
	/**
	 * 修改
	 * @param array $condition
	 * @param array $article_data
	 * @return array
	 */
	public function update_article($condition,$article_data)
	{
	    $result = array('status'=>0);
	    if(empty($condition)||empty($article_data)){
	        $result['message']='条件为空或更新数据为空';
	        return $result;
	    }
	    $article_data['update_time']=time();
	    $is_update = $this->db->update($this->table, $article_data, $condition);
	    if(!$is_update)
	    {
	        $result['message']='修改失败';
	        return $result;
	    }
	    $result['status']=1;
	    $result['message']='修改成功';
	    $article_data['id']=$condition['id']?$condition['id']:'';
	    $result['data']=$article_data;
	    //缓存key
	    //删除缓存
	    $cache_key=__METHOD__.'_article_id_'.$condition['id'];
// 	    S($cache_key,null);
	    return $result;
	}
	public function delete_article($condition) 
	{
	    ;
	}
}