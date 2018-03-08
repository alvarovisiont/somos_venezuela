<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
//si no existe la función invierte_date_time la creamos
if(!function_exists('menu'))
{
    //formateamos la fecha y la hora, función de cesarcancino.com

 function menu()
 {
 	 $CI =& get_instance();
     $CI->load->library('session');

 	 $varhtml = $CI->session->userdata('menu_usuario');

     return $varhtml;
 }
}
 