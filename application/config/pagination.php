<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$config['base_url'] = 'http://example.com/index.php/test/page/';
$config['total_rows'] = 200;//记录总数，
$config['per_page'] = 20;////每页条数
$config['first_link'] = '第一页';
$config['prev_link'] = '上一页';
$config['next_link'] = '下一页';
$config['last_link'] = '最后一页';

$config['use_page_numbers']   = TRUE; //默认分页URL中是显示每页记录数,启用use_page_numbers后显示的是当前页码
$config['num_links'] = 2;// 当前连接前后显示页码个数。意思就是说你当前页是第5页，那么你可以看到3、4、5、6、7页。