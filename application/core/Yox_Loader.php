<?php
 
class Yox_Loader extends CI_Loader
{
    /**
	 * List of loaded sercices
	 *
	 * @var array
	 * @access protected
	 */
	protected $_ci_logic = array();
	/**
	 * List of paths to load sercices from
	 *
	 * @var array
	 * @access protected
	 */
	protected $_ci_logic_paths		= array();
    
    /**
     * Constructor
     * 
     * Set the path to the logic files
     */
    public function __construct()
    {
        
        parent::__construct();
        load_class('logic','core');
        $this->_ci_logic_paths = array(APPPATH);
    }
    
    /**
     * logic Loader
     * 
     * This function lets users load and instantiate classes.
	 * It is designed to be called from a user's app controllers.
	 *
	 * @param	string	the name of the class
	 * @param	mixed	the optional parameters
	 * @param	string	an optional object name
	 * @return	void
     */
    public function logic($logic = '', $params = NULL, $object_name = NULL)
    {
        if(is_array($logic))
        {
            foreach($logic as $class)
            {
                $this->logic($class, $params);
            }
            
            return;
        }
        
        if($logic == '' or isset($this->_ci_logic[$logic])) {
            return FALSE;
        }
 
        if(! is_null($params) && ! is_array($params)) {
            $params = NULL;
        }
        
        $subdir = '';
 
        // Is the logic in a sub-folder? If so, parse out the filename and path.
        if (($last_slash = strrpos($logic, '/')) !== FALSE)
        {
                // The path is in front of the last slash
                $subdir = substr($logic, 0, $last_slash + 1);
 
                // And the logic name behind it
                $logic = substr($logic, $last_slash + 1);
        }
        
        foreach($this->_ci_logic_paths as $path)
        {
            
            $filepath = $path .'logic/'.$subdir.$logic.'.php';
            
            if ( ! file_exists($filepath))
            {
                continue;
            }
            
            include_once($filepath);
            
            $logic = strtolower($logic);
 
            if (empty($object_name))
            {
                $object_name = $logic;
            }
            
            $logic = ucfirst($logic);
            $CI = &get_instance();
            if($params !== NULL)
            {
                $CI->$object_name = new $logic($params);
            }
            else
            {
                $CI->$object_name = new $logic();
            }
            
            $this->_ci_logic[] = $object_name;
//             echo $filepath;
//             echo $object_name;
//             echo($logic);
//             $CI->$object_name = new $logic();
            return $this;
        }
    }
    
}