<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function index()
	{
		$data['_title'] = "Home";
		$this->add_js('https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js', TRUE);
		$this->add_js('plugins/morris/morris.min.js');
		$this->add_js('plugins/sparkline/jquery.sparkline.min.js');
		$this->add_js('plugins/jvectormap/jquery-jvectormap-1.2.2.min.js');
		$this->add_js('plugins/jvectormap/jquery-jvectormap-world-mill-en.js');
		$this->add_js('plugins/knob/jquery.knob.js');
		$this->add_js('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js', TRUE);
		$this->add_js('plugins/daterangepicker/daterangepicker.js');
		$this->add_js('plugins/datepicker/bootstrap-datepicker.js');
		$this->add_js('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js');
		$this->add_js('plugins/slimScroll/jquery.slimscroll.min.js');
		$this->add_js('plugins/fastclick/fastclick.js');
		$this->add_js('app.min.js');
		$this->add_static_js('dashboard.js');
		$this->add_js('demo.js');
		$this->display('home', $data);
	}
}
