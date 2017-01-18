<?php

/**
 * cetak
 *
 * var dump code
 *
 * @access	public
 * @param	mixed
 * @return	mixed
 */
if ( ! function_exists('cetak'))
{
	function cetak(){
		if(defined('ENVIRONMENT') && ENVIRONMENT == 'development'){
			echo '<pre>';
			$args = func_get_args();
			foreach ($args as $arg) {
				var_dump($arg);
				echo '<br/>===========================================================<br/><br/>';
			}
			echo '</pre>';
		}
	}
}