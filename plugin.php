<?php
/**
 * Plugin Name: Qody's FB Meta
 * Plugin URI: http://qody.co
 * Description: Simple configuration settings for Facebook page meta to optimize post/page sharing functionality.
 * Version: 2.0.3
 * Author: Qody LLC
 * Author URI: http://qody.co
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */
$framework_problem = false;
$framework_file = dirname(dirname(__FILE__) ).'/qodys-framework/framework.php';

// Install Qody's Framework, incase it's not uploaded already
require_once( 'frwk.php' );

if( $framework_problem )
{
	// do nothing since we are out of sync with the framework
}
else if( !file_exists( $framework_file ) )
{
	$framework_problem = true;
}
else
{
	// load up the main Qody framework
	require_once( $framework_file );
	
	if( !class_exists('QodyPlugin') )
	{
		$framework_problem = true;
	}
	else if( !class_exists('QodysFBmeta') )
	{
		class QodysFBmeta extends QodyPlugin
		{
			// general plugin variables
			//var $m_plugin_name;
		
			function __construct()
			{
				$this->m_pre = 'qfm';
				$this->m_owl_name = 'Penelope';
				$this->m_owl_image = 'http://plugins.qody.co/wp-content/uploads/2011/09/owl6a-320x320.png';
				$this->m_owl_buy_url = 'http://plugins.qody.co/owl/penelope/';
				$this->m_plugin_version = '1.0.0';
				$this->m_plugin_name = 'FB Meta';
				$this->m_plugin_slug = 'qodys-fbmeta';
				$this->m_plugin_file =  plugin_basename(__FILE__);
				$this->m_plugin_folder = dirname(__FILE__);
				$this->m_raw_file = __FILE__;
				
				// Set plugin name, slug, file, and folder
				parent::__construct();
			}
			
			function LoadClasses()
			{
				parent::LoadClasses();
				
				$this->LoadOverseers();
				$this->LoadPostTypes();
				$this->LoadAdminPages();
				$this->LoadContentControllers();
			}
			
			function LoadDefaultOptions()
			{
				$this->GetOverseer()->LoadDefaultOptions();
				
				parent::LoadDefaultOptions();
			}
		}
		
		// create an instance of the main class to start the plugin's system.
		$qodys_fbmeta = new QodysFBmeta( true );
		
		// Register the plugin with Wordpress
		$qodys_fbmeta->RegisterPlugin();
	}
}

if( !function_exists('qody_framework_warning') )
{
	function qody_framework_warning()
	{
		$data = "
<div class='updated fade'>
	<p><strong>Your plugin by Qody is almost ready.</strong> You must 
	<a class=\"thickbox\" href=\"".admin_url('plugin-install.php?tab=plugin-information&plugin=qodys-redirector&TB_iframe=true' )."\">install/update the framework plugin</a> for it to work properly.</p>
</div>";
		echo $data;
	}
}

if( $framework_problem )
	add_action('admin_notices', 'qody_framework_warning');
?>