<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Yox_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        log_message('debug', "Yox_Model Class Initialized");
    }
    protected function get_page_config($total_rows,$per_page=20,$url='')
    {
        $result = array('status'=>0);
        $config['base_url'] = $url?$url:$_SERVER['PHP_SELF'];
        $config['total_rows'] = $total_rows;//记录总数，
        $config['per_page'] = @$_REQUEST['page_size']?intval($_REQUEST['page_size']):$per_page;////每页条数
        $config['first_link'] = '第一页';
        $config['prev_link'] = '上一页';
        $config['next_link'] = '下一页';
        $config['last_link'] = '最后一页';
        
        $config['use_page_numbers']   = true; //默认分页URL中是显示每页记录数,启用use_page_numbers后显示的是当前页码
        $config['num_links'] = 2;// 当前连接前后显示页码个数。意思就是说你当前页是第5页，那么你可以看到3、4、5、6、7页。
        $config['page_query_string']=true;//设置为 TRUE，分页链接将变成：http://example.com/index.php?c=test&m=page&per_page=20
        $config['reuse_query_string'] = true;//默认情况下你的查询字符串参数会被忽略，将这个参数设置为 TRUE ，将会将查询字符串参数添加到 URI 分段的后面 以及 URL 后缀的前面。
        // print_r($config);
        $result['status']=1;
        $result['data']=$config;
        return $result;
    }
}