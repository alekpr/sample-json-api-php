<?php
namespace Libs\MyClass;
/**
 * Description of Session class
 *
 * @author Alek
 */
class Session {
    private static 	$initialized = false;
    public  static 	$sessionid;
    /**
	 * Function initialize
	 * 
	 * @param string $session_id
	 */
    public static function initialize($session_id = null){
    	if (self::$initialized) {
    		return;
    	}
    	if (strlen($session_id) < 1) {
    		session_start();
            self::setSession('time',time());
    	}else{
    		session_id($session_id);
    		session_start();
    		self::$sessionid = $session_id;
            self::setSession('time',time());
    	}
    	self::$initialized = true;
    	return;
    }
    /**
     * Function getSession
     *
     * @param string $sessionName - Name of the datas to get
     * @return mixed - Datas stored in session. / if session name not exist return false
     */
    public static function getSession($sessionName) {
        if( isset($_SESSION[$sessionName]) ){
            return $_SESSION[$sessionName];
        }else{
           return false; 
        }
   	}
   	/**
   	 *
   	 * Function setSession
   	 *
   	 * @param string $sessionName - Name of the datas
   	 *		  mixed $value - Your datas
   	 *
   	 */
   	public static function setSession($sessionName, $value) {
        self::initialize();
        $_SESSION[$sessionName] = $value;
   	}
   	/**
   	 *
   	 * Function closeSession - Destroys the current session.
   	 *
   	 */
   	public static function closeSession() {
   		self::$initialized = !session_destroy();
   		self::$sessionid = -1;
        unset( $_SESSION );    
        return !self::initialized ;
   	}
}