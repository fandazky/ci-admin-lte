<?php if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}

    public function is_logged_in(){
        if ($this->session->userdata("account_id")) {
            return TRUE;
        }
        return FALSE;
    }

    public function authenticate($username, $password) {
        $member_account = $this->db->get_where("member__account", array("account_username" => $username))->result_array();

        if (empty($member_account)){
            return array(
                "status" => 400,
                "message" => "username not found"
            );
        }

        $saved_password = $member_account[0]['account_password'];
        if (!$this->is_password_match($username, $password, $saved_password)) {
            return array(
                "status" => 400,
                "message" => "username or password doesn't match"
            );
        }

        $account_role = $this->db->get_where("sys__auth_account_role", array("account_id"=>$member_account[0]["account_id"]))->result_array();
        $member_profile = $this->db->get_where("member__profile", array("account_id"=>$member_account[0]["account_id"]))->result_array();

        $this->session->set_userdata("account_id", $member_account[0]["account_id"]);
        $this->session->set_userdata("account_username", $username);
        $this->session->set_userdata("account_role", $account_role[0]["role_id"]);
        if($account_role[0]["role_id"] > 2) {
            $this->session->set_userdata("branch_id",$member_account[0]["branch_id"]);
        }

        return array(
            "status" => 200,
            "message" => "login success"
        );

    }

    public function is_password_match($username, $password, $saved_password){
        $encrypted_password = $this->encrypt_password($password, $username);

        if ($encrypted_password == $saved_password) {
            return TRUE;  
        } 
        return FALSE;
    }

    public function encrypt_password($password, $username) {
        $salt = "R4h4s1A";
        return sha1($password. $salt . $username);
    }

    public function get_account_role() {
        return $this->session->userdata("account_role");
    }
}	