<?php
/*
Plugin Name: SSM Image Import Helper
Description: When importing images, automatically cleans up urls and creates human-friendly title and alt tags
Version: 1.0
Author: Bernard Meisler
Author URI: http://www.evili.com
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2005-2015 East Village Interactive, Inc.
*/

defined( 'ABSPATH' ) OR exit;

define('SSMIMAGEIMPORTHELPER_VERSION', '1.0');
define('SSMIMAGEIMPORTHELPER_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define('SSMIMAGEIMPORTHELPER_PLUGIN_URL', plugin_dir_url( __FILE__ ));

require_once(SSMIMAGEIMPORTHELPER_PLUGIN_DIR . 'SSMImageImportHelper.class.php');


//register activation and deactivation hooks
register_activation_hook(   __FILE__, array( '\SSMImageImportHelper\ImageImportHelper', 'ssm_imageimporthelper_on_activation' ) );
register_deactivation_hook( __FILE__, array( '\SSMImageImportHelper\ImageImportHelper', 'ssm_imageimporthelper_on_deactivation' ) );

//start me up
add_action( 'plugins_loaded', array( '\SSMImageImportHelper\ImageImportHelper', 'ssm_imageimporthelper_init' ) );