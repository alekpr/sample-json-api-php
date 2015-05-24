<?php
namespace Libs\MyClass;
/**
 * Description of Data class
 *
 * @author Alek
 */
class Data extends Base {
	private $data;
    public function __construct($class = __CLASS__) {
		/* Load data file into your application */
    	$this->data = require_once BASE_DIR."data/products.data.php";
    }
    /**
	 * Use for get all data 
	 * @return array -  all data  
	 */
    public function get_all(){
    	if (is_array($this->data)) {
    		$data = array();
    		foreach ($this->data as $key => $value) {
    			$val = array();
    			$val['id'] = $value['id'];
    			$val['name'] = $value['name'];
    			array_push($data, $val);
    		}
    		return $data;
    	}
    	return array();
    }
    /**
	 * Use for get data info by id
	 * @param 	$id - data id
	 * @return array - data info 
	 */
    public function get_by_id($id){
    	$data = $this->array_search($this->data,"id",$id);
    	if(is_array($data) && count($data) > 0){
    		return $data[0];
    	}else{
    		return array();
    	}
    }
    public function __destruct(){
    	//nothing
    }
}
