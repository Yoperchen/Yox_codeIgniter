<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * 用户
 * @author Yoper 944975166@qq.com
 * http://www.linglingtang.com
 *
 */
class User_model extends Yox_Model {
	public function __construct()
	{
	    // Call the CI_Model constructor
	    $this->table='user';
	    parent::__construct();
	}
	public function test()
	{
	    # Your query goes here
	}
}