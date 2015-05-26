<?php
namespace Libs\MyClass;
use Libs\MyClass\Session;
/**
 * Description of Authen class
 * - Sample authentication class
 *
 * @author Alek
 */
class Authen extends Base {
    protected $_token = "";
    public function __construct($class = __CLASS__) {
        //nothing
        parent::__construct();
    }

    /**
     *
     * Function isLogin
     * Description - Sample function check currently session login status
     * @return boolean - Login status (true / false)
     */
    public function isLogin(){
        Session::initialize();
        if (Session::getSession("isLogin")) {
            $this->error = "";
            return true;
        }else{
            $this->error = "Not login !";
            return false;
        }
    }

    /**
     *
     * Function Login
     * Description - Sample function login 
     * @param   string $username 
     *          string $password
     * @return  boolean login status (true / false)
     */
    public function Login($username,$password){
        //check username is exist
        if ($username != 'demo') {
            $this->error = "Username not found !";
            return false;
        }
        //check password is correct
        if ($password != 'demo') {
            $this->error = "Password incorrect !";
            return false;
        }

        //if everything is ok , will save login status to session
        Session::initialize();
        Session::setSession("isLogin",true);
        Session::setSession("token",Session::$sessionid);
        $this->token = Session::$sessionid;
        return true;
    }

    /**
     *
     * Function Logout
     * Description - destroy all session data
     * @return void()
     */
    public function Logout(){
        $this->token = "";
        Session::closeSession();
        return;
    }

    public function get_token(){
        return $this->_token;
    }
    public function set_token($token){
        $this->_token = $token;
    }
    public function __destruct(){
    	//nothing
        parent::__destruct();
    }
}
