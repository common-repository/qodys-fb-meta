<?php
class FBmeta extends QodysFBmeta
{
	var $m_extra_image = null;
	
	function __construct()
	{
		parent::__construct();
		
		$fields = array();
		$fields['label'] = 'Facebook image';
		$fields['set_text'] = 'Set custom Facebook image';
		$fields['whitelisted_post_types'] = array( 'page', 'post' ); // let this be a user option in the future
		
		$this->m_extra_image = new QodyExtraFeaturedImage( $fields );
	}
	
	function GetContentTypes()
	{
		$types = array();

		$types['Activities'][] = 'activity';
		$types['Activities'][] = 'sport';
		
		$types['Businesses'][] = 'bar';
		$types['Businesses'][] = 'company';
		$types['Businesses'][] = 'cafe';
		$types['Businesses'][] = 'hotel';
		$types['Businesses'][] = 'restaurant';
		
		$types['Groups'][] = 'cause';
		$types['Groups'][] = 'sports_league';
		$types['Groups'][] = 'sports_team';
		
		$types['Organizations'][] = 'band';
		$types['Organizations'][] = 'government';
		$types['Organizations'][] = 'non_profit';
		$types['Organizations'][] = 'school';
		$types['Organizations'][] = 'university';
		
		$types['People'][] = 'actor';
		$types['People'][] = 'athlete';
		$types['People'][] = 'author';
		$types['People'][] = 'director';
		$types['People'][] = 'musician';
		$types['People'][] = 'politician';
		$types['People'][] = 'public_figure';
		
		$types['Places'][] = 'city';
		$types['Places'][] = 'country';
		$types['Places'][] = 'landmark';
		$types['Places'][] = 'state_province';
		
		$types['Products and Entertainment'][] = 'album';
		$types['Products and Entertainment'][] = 'book';
		$types['Products and Entertainment'][] = 'drink';
		$types['Products and Entertainment'][] = 'food';
		$types['Products and Entertainment'][] = 'game';
		$types['Products and Entertainment'][] = 'product';
		$types['Products and Entertainment'][] = 'song';
		$types['Products and Entertainment'][] = 'movie';
		$types['Products and Entertainment'][] = 'tv_show';
		
		$types['Websites'][] = 'blog';
		$types['Websites'][] = 'website';
		$types['Websites'][] = 'article';
		
		return $types;
	}
	
	function LoadDefaultOptions()
	{
		// General fields
		$this->update_option( 'site_type', 'website' );
		$this->update_option( 'site_name', get_bloginfo('name') );
		$this->update_option( 'site_description', get_bloginfo('tagline') );
		$this->update_option( 'admins', '' );
		$this->update_option( 'app_id', '' );
		
		// Post fields
		$this->update_option( 'preview_image', '' );

		$this->update_option( 'content_title', get_bloginfo('name').' - '.get_bloginfo('tagline') );
		$this->update_option( 'content_type', 'article' );
		$this->update_option( 'content_url', get_bloginfo('url') );
		$this->update_option( 'content_description', 'Site description.' );
		
		$this->update_option( 'video_url', '' );
		$this->update_option( 'video_width', '' );
		$this->update_option( 'video_height', '' );
		$this->update_option( 'video_type', '' );
		
		$this->update_option( 'audio_url', '' );
		$this->update_option( 'audio_title', '' );
		$this->update_option( 'audio_artist', '' );
		$this->update_option( 'audio_album', '' );
		$this->update_option( 'audio_type', '' );
		
		// Geographic fields
		$this->update_option( 'lat', '' );
		$this->update_option( 'lon', '' );
		$this->update_option( 'address', '' );
		$this->update_option( 'city', '' );
		$this->update_option( 'state', '' );
		$this->update_option( 'zipcode', '' );
		$this->update_option( 'country', '' );
		
		// Contact fields
		$this->update_option( 'email', '' );
		$this->update_option( 'phone', '' );
		$this->update_option( 'fax', '' );
	}
	
	function LoadCustomMetaboxes()
	{
		$this->AddMetabox( 'post_fields', 'FB Meta Settings', 'normal', 'post' );
		$this->AddMetabox( 'post_fields', 'FB Meta Settings', 'normal', 'page' );	
	}
	
	function SetupFBmeta()
	{
		add_action( 'wp_head', array( $this, 'CodeInsertion' ));
	}
	
	function CodeInsertion()
	{
		global $post;
		
		wp_reset_query(); 
		wp_reset_postdata();
		
		$custom = get_post_custom( $post->ID );
		
		// General fields
		$site_type 				= $this->get_option( 'site_type' );
		$site_name 				= $this->get_option( 'site_name' );
		$site_description		= $this->get_option( 'site_description' );
		$admins 				= $this->get_option( 'admins' );
		$app_id 				= $this->get_option( 'app_id' );
		
		// Post fields
		$video_url 				= $this->get_option( 'video_url' );
		$video_width 			= $this->get_option( 'video_width' );
		$video_height 			= $this->get_option( 'video_height' );
		$video_type 			= $this->get_option( 'video_type' );
		
		$audio_url 				= $this->get_option( 'audio_url' );
		$audio_title 			= $this->get_option( 'audio_title' );
		$audio_artist 			= $this->get_option( 'audio_artist' );
		$audio_album 			= $this->get_option( 'audio_album' );
		$audio_type 			= $this->get_option( 'audio_type' );
		
		// Geographic fields
		$lat 					= $this->get_option( 'lat' );
		$lon 					= $this->get_option( 'lon' );
		$address 				= $this->get_option( 'address' );
		$city 					= $this->get_option( 'city' );
		$state 					= $this->get_option( 'state' );
		$zipcode				= $this->get_option( 'zipcode' );
		$country 				= $this->get_option( 'country' );
		
		// Contact fields
		$email 					= $this->get_option( 'email' );
		$phone					= $this->get_option( 'phone' );
		$fax 					= $this->get_option( 'fax' );
		
		if( is_home() || is_front_page() )
		{
			$content_title = $site_name;
			$content_type = $site_type;
			$content_url = get_bloginfo('url');
			$content_description = $site_description;
			$preview_image = $this->get_option( 'preview_image' );
			
			if( $content_url[strlen($str)-1] != '/' )
				$content_url .= '/';
		}
		else
		{		
			// Figure out post-specific meta settings
			if( $custom['use_custom_title'][0] == 1 ) $content_title = $custom['custom_title'][0];
			else $content_title = $post->post_title;
			
			if( $custom['use_content_url'][0] == 1 ) $content_url = $custom['content_url'][0];
			else $content_url = get_permalink( $post->ID );
	
			$nextItem = 'content_type';
			if( $custom[ $nextItem ][0] ) $content_type = $custom[ $nextItem ][0];
			else $content_type = $this->get_option( $nextItem );
			
			$nextItem = 'custom_preview_image';
			switch( $custom[ $nextItem ][0] )
			{
				case '1':
					$imageData = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ) );
					
					$preview_image = $imageData[0];
					break;
					
				case '2':
					$preview_image = $custom['preview_image_from_url'][0];
					break;
					
				case '3':
					$imageData = wp_get_attachment_image_src( $custom["qody_".$post->post_type."_1_thumbnail_id"][0] );
					
					$preview_image = $imageData[0];
					break;
					
				default:
					$preview_image = '';
			}
			
			$nextItem = 'content_description';
	
			if( $custom['use_description'][0] == 1 )
			{
				$content_description = $post->post_excerpt;
			}
			else if( $custom['use_description'][0] == 2 )
			{
				$content_description = $custom[ $nextItem ][0];
			}
			else if( $this->get_option( $nextItem ) )
			{
				$content_description = $this->get_option( 'content_description' );
			}
	
			if( $custom['use_video'][0] == 1 )
			{
				$video_url = $custom['video_url'][0];
				$video_width = $custom['video_fb_width'][0];
				$video_height = $custom['video_fb_height'][0];
				$video_type = $custom['video_type'][0];
			}
			
			if( $custom['use_audio'][0] == 1 )
			{
				$audio_url = $custom['audio_url'][0];
				$audio_title = $custom['audio_title'][0];
				$audio_artist = $custom['audio_artist'][0];
				$audio_album = $custom['audio_album'][0];
				$audio_type = $custom['audio_type'][0];
			}
		}

		// Start inserting the actual meta
		$meta = array();		
		$meta['og:site_name'] = $site_name;
		
		if( $admins ) $meta['fb:admins'] = $admins;
		if( $app_id ) $meta['fb:app_id'] = $app_id;
		
		$meta['og:title'] = $content_title;
		$meta['og:type'] = $content_type;
		$meta['og:url'] = $content_url;
		
		if( $preview_image )		$meta['og:image'] = $preview_image;
		if( $content_description )	$meta['og:description'] = $content_description;
		
		if( $content_type != 'article' )
		{
			if( $video_url )
			{
				$meta['og:video'] = $video_url;
				$meta['og:video:width'] = $video_width;
				$meta['og:video:height'] = $video_height;
				$meta['og:video:type'] = $video_type;
			}
			
			if( $audio_url )
			{
				$meta['og:audio'] = $audio_url;
				$meta['og:audio:title'] = $audio_title;
				$meta['og:audio:artist'] = $audio_artist;
				$meta['og:audio:album'] = $audio_album;
				$meta['og:audio:type'] = $audio_type;
			}
			
			if( $lat )		$meta['og:latitude'] = $lat;
			if( $lon )		$meta['og:longitude'] = $lon;
			if( $address )	$meta['og:street-address'] = $address;
			if( $city )		$meta['og:locality'] = $city;
			if( $state )	$meta['og:region'] = $state;
			if( $zipcode )	$meta['og:postal-code'] = $zipcode;
			if( $country )	$meta['og:country-name'] = $country;
			
			if( $email )	$meta['og:email'] = $email;
			if( $phone )	$meta['og:phone_number'] = $phone;
			if( $fax )		$meta['og:fax_number'] = $fax;
		}
		?>
		<!-- Facebook meta created and managed by Qody's FB Meta Wordpress plugin: http://qody.co -->
		<?php
		foreach( $meta as $key => $value )
		{ ?>
		<meta property="<?php echo $key; ?>" content="<?php echo $this->GetClass('tools')->Clean( $this->ParseVariables( $value ) ); ?>"/>
		<?php
		}
	}
	
	function ParseVariables( $content )
	{
		global $post;
		
		$content = str_replace( '$post_title', $post->post_title, $content );
		$content = str_replace( '$post_excerpt', $post->post_excerpt, $content );
		$content = str_replace( '$post_permalink', get_permalink( $post->ID ), $content );
		$content = html_entity_decode( $content );
		$content = htmlspecialchars_decode( $content );
		
		return $content;
	}
}
?>