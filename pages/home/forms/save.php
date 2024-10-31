<?php
require_once( dirname(dirname(dirname(dirname(dirname(dirname(dirname(__FILE__))))))).'/wp-load.php' );

$response = array();

if( $_POST )
{
	foreach( $_POST as $key => $value )
	{
		$qodys_fbmeta->update_option( $key, $value );
	}
	
	$response['results'][] = 'Facebook meta settings have been saved';
}
else
{
	$response['errors'][] = 'Any unexpected error occured; please try again';
}

$qodys_fbmeta->GetClass('postman')->SetMessage( $response );

$url = $qodys_fbmeta->GetClass('tools')->GetPreviousPage();

header( "Location: ".$url );
exit;
?>