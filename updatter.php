<?php
/*
Plugin Name: Updatter
Plugin URI: http://arathvelazquez.com/updatter
Description: Actualiza tu estado en twitter con el nombre y URL del post.
Version: 0.1
Author: Arath Velázquez
Author URI: http://www.arathvelazquez.com
*/

function updatter($content){
	global $wp_query;
	$nombreDelPost = $wp_query->post->post_name;
	$urlDelPost = get_permalink($post->ID);
	$preTexto = "Probando Plugin: ";
	$urlToShort = "http://rod.gs/?longurl=".$urlDelPost;
	$urlCorta = curling($urlToShort);
	$comentario = $preTexto.$nombreDelPost. " " .$urlCorta;
	
	$divTweet = 
	'<div id="updatter">
		<a href="http://twitter.com/home?status='.$comentario.'" title="Com&eacute;ntalo en twitter" target="_blank">
			<img src="http://twitter-badges.s3.amazonaws.com/twitter-a.png" alt="Comentalo en twitter"/>
		</a>
	</div>';
	
	if (is_single() || is_home() ){ 
			return $content . $divTweet;
	}
	else { 	return $content;}
}

function curling($url){

	$ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url);		//set url 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 	//return the transfer as a string 
        $output = curl_exec($ch); 			//$output contains the output string 
        curl_close($ch); 				//close curl resource to free up system resources 
	return $output;
}

add_action('wp_head', 'agregar_css_al_header');
function agregar_css_al_header() {
	echo '<link type="text/css" rel="stylesheet" href="' . plugins_url('updatter/updatter.css') . '" />' . "\n";
}

add_filter('the_content','updatter');
add_filter('the_excerpt','updatter');
?>
