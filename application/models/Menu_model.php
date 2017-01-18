<?php
class Menu_model extends CI_Model {

	public function all()
	{
		return $this->db->get("menus")->result_array();
	}

	public function get_menu_by_role($role_id) {
		$this->db->select("sys__menu.menu_id, menu_parent, menu_title, menu_icon, menu_url, order_number");
		$this->db->from("sys__role_menu");
		$this->db->join("sys__menu", "sys__menu.menu_id = sys__role_menu.menu_id", "left");
		$this->db->where(array("role_id" => $role_id, "is_active"=>1));
		$result = $this->db->get()->result_array();
		if ($result) {
			return $result;
		}

		return FALSE;
	}

}