<?php
/**
 * 文章
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class Article_model extends CI_Model {
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
	public function get_article_list($condition,$fields,$page_size=20)
	{
        $result = array('status'=>0);
	    $list = $this->db->where($condition)->select($fields)->order_by('id desc')->get($this->table)->result_array(); 
	    $result['status']=1;
	    $result['data']['list']=$list;
	}
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
}