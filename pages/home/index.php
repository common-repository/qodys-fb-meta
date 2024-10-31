<?php
class qodyPage_FacebookHome extends QodyPage
{
	function __construct()
	{
		$this->SetOwner( func_get_args() );
		
		$this->m_raw_file = __FILE__;
		
		$this->m_priority = 1;
		
		$this->SetTitle( $this->Owner()->m_plugin_name );
		
		parent::__construct();
	}
	
	function LoadMetaboxes()
	{
		$this->AddMetabox( 'general_fields', 'General Fields' );
		$this->AddMetabox( 'contact_fields', 'Contact Info Fields' );
		$this->AddMetabox( 'location_fields', 'Geographic Fields' );
		
		$this->AddMetabox( 'save', 'Save Settings', 'side' );
	}
}
?>