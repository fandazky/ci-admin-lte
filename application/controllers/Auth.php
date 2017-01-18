<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index(){
		if ($this->auth_model->is_logged_in()) {
			redirect("Welcome");
		} else {
			redirect("auth/login");
		}
	}

	public function login()
	{
		$this->load->library("form_validation");
		$this->data["_title"] = "Login";

		$this->form_validation->set_rules("username", "Username", "required");
		$this->form_validation->set_rules("password", "Password", "required");

		if ($this->form_validation->run() == TRUE) {
			$this->do_login();
		} else {
			$this->load->view("login", $this->data);
		}
	}

	private function do_login(){
		$username = trim($this->input->post("username"));
		$password = $this->input->post("password");

		$login_data = $this->auth_model->authenticate($username, $password);
				
		if (empty($login_data["status"]) || $login_data["status"] != 200 ) {
			$failed_message = "login failed, please try again !";
			if (!empty($login_data["message"])) {
				$failed_message = $login_data["message"];
			}
			$this->session->set_flashdata("error_login", $failed_message);
			redirect("auth/login", "refresh");
		}
		else {
			redirect("home");
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect("auth/login");
	}
}
