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


if(!function_exists('menu_admin'))
{
    //formateamos la fecha y la hora, función de cesarcancino.com

 function menu_admin()
 {
 	 $varhtml = '<ul class="nav nav-list">
					<li class="">
						<a href="'.base_url().'index.php/admin">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<span class="menu-icon glyphicon glyphicon-th-large"></span>
							<span class="menu-text"> Menú</span>
							<b class="arrow fa fa-angle-down"></b>
						</a>
						<b class="arrow"></b>
						<ul class="submenu">
							<li>
								<a href="'.base_url().'index.php/menu">
									<span class="menu-icon fa fa-caret-right"></span>
									<span class="menu-text">Gestión Menú</span>
								</a>		
							</li>
						</ul>
					</li>
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-desktop"></i>
							<span class="menu-text">
								Configuración
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="'.base_url().'index.php/admin/plantilla"> 
									<i class="menu-icon fa fa-caret-right"></i>
									Logueo
								</a>
								<a href="'.base_url().'index.php/perfil/dashboard"> 
									<i class="menu-icon fa fa-caret-right"></i>
									Perfiles
								</a>
								<a href="'.base_url().'index.php/permiso/dashboard"> 
									<i class="menu-icon fa fa-caret-right"></i>
									Permisologia
								</a>
								<b class="arrow"></b>
						 	</li>
						</ul>
					</li>

				</ul><!-- /.nav-list -->';


 	 $varhtml .= '<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>';

     return $varhtml;
 }
}
 


 