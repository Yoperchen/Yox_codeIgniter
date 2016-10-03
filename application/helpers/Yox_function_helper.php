<?php
/**
 * Yox系统通用函数
 * @author   Yoper <944975166@qq.com>
 */
 
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('Yox_write_log'))
{
    /**
     * 写日志
     * @return boolean
     */
	function Yox_write_log($method,$log_data,$level='debug')
	{
		log_message($level, $method.var_export($log_data,true));
	}
}

if (!function_exists('Yox_is_mobile'))
{
    /**
     * 判断是否手机访问
     * @return boolean
     */
    function Yox_is_mobile(){
        $result = array('status'=>0);
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $mobile_agents = Array("240x320","acer","acoon","acs-","abacho","ahong","airness","alcatel","amoi","android","anywhereyougo.com","applewebkit/525","applewebkit/532","asus","audio","au-mic","avantogo","becker","benq","bilbo","bird","blackberry","blazer","bleu","cdm-","compal","coolpad","danger","dbtel","dopod","elaine","eric","etouch","fly ","fly_","fly-","go.web","goodaccess","gradiente","grundig","haier","hedy","hitachi","htc","huawei","hutchison","inno","ipad","ipaq","ipod","jbrowser","kddi","kgt","kwc","lenovo","lg ","lg2","lg3","lg4","lg5","lg7","lg8","lg9","lg-","lge-","lge9","longcos","maemo","mercator","meridian","micromax","midp","mini","mitsu","mmm","mmp","mobi","mot-","moto","nec-","netfront","newgen","nexian","nf-browser","nintendo","nitro","nokia","nook","novarra","obigo","palm","panasonic","pantech","philips","phone","pg-","playstation","pocket","pt-","qc-","qtek","rover","sagem","sama","samu","sanyo","samsung","sch-","scooter","sec-","sendo","sgh-","sharp","siemens","sie-","softbank","sony","spice","sprint","spv","symbian","tablet","talkabout","tcl-","teleca","telit","tianyu","tim-","toshiba","tsm","up.browser","utec","utstar","verykool","virgin","vk-","voda","voxtel","vx","wap","wellco","wig browser","wii","windows ce","wireless","xda","xde","zte");
        $is_mobile = false;
        foreach ($mobile_agents as $device) {//这里把值遍历一遍，用于查找是否有上述字符串出现过
            if (stristr($user_agent, $device)) { //stristr 查找访客端信息是否在上述数组中，不存在即为PC端。
                $is_mobile = true;
                break;
            }
        }
        return $is_mobile;
    }
}

if (!function_exists('Yox_random_string'))
{
    /**
     * 随机字符串
     * @param unknown_type $len
     * @return multitype:number string multitype:string
     */
    function Yox_random_string($len)
    {
        $pattern = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLOMNOPQRSTUVWXYZ';    //字符池
        $random_string='';
        for($i=0; $i<$len; $i++)
        {
            $random_string .= $pattern{mt_rand(0,35)};    //生成php随机数
        }
        return array('status'=>1,'message'=>'成功',
            'data'=>array('random_string'=>$random_string));
    }
}

if (!function_exists('Yox_get_qrcode'))
{
    /**
     * 获取信息二维码
     * @param string $data
     */
    function Yox_get_qrcode($data)
    {
        require_once(COMMON_PATH."Library/Qrcode/phpqrcode/phpqrcode.php");
        $data = urldecode($data);
        QRcode::png($data);die();
    }
}
if (!function_exists('Yox_is_ajax'))
{
    /**
     * 是否AJAX请求
     * @access protected
     * @return bool
     */
    function Yox_is_ajax() {
        if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) ) {
            if('xmlhttprequest' == strtolower($_SERVER['HTTP_X_REQUESTED_WITH']))
                return true;
        }
        if(!empty($_POST[C('VAR_AJAX_SUBMIT')]) || !empty($_GET[C('VAR_AJAX_SUBMIT')]))
            // 判断Ajax方式提交
            return true;
        return false;
    }
}