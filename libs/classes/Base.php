<?php
namespace Libs\MyClass;
/**
 * Description of Base class
 *
 * @author Alek
 */
class Base {
	protected $_error = null;
    public function __construct($class = __CLASS__) {
    	//nothing
    }
    /**
	 * Use for search value in multidimensional array
	 * @param 	$array 	- The array
	 *  		$key 	- key to search in
	 *			$value 	- search value
	 * @return array - search results 
	 */
    public function array_search($array, $key, $value)
	{
	    $results = array();
	    if (is_array($array)) {
	        if (isset($array[$key]) && $array[$key] == $value) {
	            $results[] = $array;
	        }
	        foreach ($array as $subarray) {
	            $results = array_merge($results, $this->array_search($subarray, $key, $value));
	        }
	    }
	    return $results;
	}
	
	public function get_error(){
		return $this->_error;
	}
	public function set_error($error){
		$this->_error = $error;
	}
    public function __destruct(){
    	//nothing
    }
}
