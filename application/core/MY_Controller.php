<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
	
	private $js = array();
    private $css = array();

	public function __construct(){
        parent::__construct();
        if (!$this->auth_model->is_logged_in()) {
            redirect(base_url());
        }
        $this->get_menu();
        $this->_set_default_css();
        $this->_set_default_js();
    }

    public function display($body, $data = null) {
        $data['_styles'] = $this->declare_css();
        $data['_scripts'] = $this->declare_js();
        $data['_content'] = $this->load->view($body, $data, TRUE);
        $data['_header'] = $this->load->view('template/header', $data, TRUE);
        $data['_sidebar'] = $this->load->view('template/sidebar', $data, TRUE);
        $data['_footer'] = $this->load->view('template/footer', $data, TRUE);
        $this->load->view('template/frame', $data);
    }

    private function _set_default_css() {
        $this->add_css("bootstrap.min.css");
        $this->add_css("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css", TRUE);
        $this->add_css("https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css", TRUE);
        $this->add_css("theme/AdminLTE.min.css");
        $this->add_css("theme/skins/_all-skins.min.css");

        $this->add_css("plugins/iCheck/flat/blue.css");
        $this->add_css("plugins/morris/morris.css");
        $this->add_css("plugins/jvectormap/jquery-jvectormap-1.2.2.css");
        $this->add_css("plugins/datepicker/datepicker3.css");
        $this->add_css("plugins/daterangepicker/daterangepicker.css");
        $this->add_css("plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css");
    }

    private function _set_default_js(){
        $this->add_js("plugins/jQuery/jquery-2.2.3.min.js");
        $this->add_js("https://code.jquery.com/ui/1.11.4/jquery-ui.min.js", TRUE);
        $this->add_js("$.widget.bridge('uibutton', $.ui.button);", FALSE, TRUE);
    }

    public function add_js($js, $from_url=FALSE, $is_script=FALSE) {
        if ($from_url) {
            $this->js[] = $js;
        } elseif ($is_script) {
            $this->js[] = array('script'=>$js);
        } else {
            $this->js[] = base_url().'assets/js/'.$js;
        }
    }

    public function add_static_js($js,$from_url = FALSE) {
        if ($from_url) {
            $this->js[] = $js;
        } else {
            $this->js[] = base_url().'assets/js/pages/'.$js;
        }        
    }
    
    public function add_css($css, $from_url = FALSE) {
        if ($from_url) {
            $this->css[] = $css;
        } else {
            $this->css[] = base_url().'assets/css/'.$css;
        }
    }

    public function add_static_css($css, $from_url = FALSE) {
        if ($from_url) {
            $this->css[] = $css;
        } else {
            $this->css[] = base_url().'assets/css/pages/'.$css;
        }
    }

    public function declare_css() {
        $tag = "";
        foreach ($this->css as $url) {
            $script[] = '<link rel="stylesheet" href="'.$url.'" />';
        }

        foreach ($script as $tag_html) {
            $tag.="".$tag_html;
        }
        return $tag;
    }

    public function declare_js() {
        $tag = "";
        foreach ($this->js as $url) {
            if (is_array($url)) {
                $script[] = '<script type="text/javascript">'.$url['script'].'</script>';
            } else {
                $script[] = '<script type="text/javascript" src="' .$url. '"></script>';
            }
        }

        foreach ($script as $tag_html) {
            $tag.="".$tag_html;
        }
        return $tag;
    }

    private function get_menu() {
    	$role = $this->auth_model->get_account_role();
        $this->load->model("menu_model", "menu");
		$items = $this->menu->get_menu_by_role($role);

		$this->load->library("multi_menu");
		$this->multi_menu->set_items($items);

		$this->load->library('multi_menu');

		$config["nav_tag_open"]          = '<ul class="mainnav">';		
		$config["parent_tag_open"]       = '<li class="dropdown">';			
		$config["children_tag_open"]     = '<ul class="dropdown-menu">';
		$this->multi_menu->initialize($config);
    }
}
