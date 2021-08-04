<?php

add_filter( 'wp_to_buffer_pro_publish_build_args', function( $args, $post, $profile_id, $service, $status, $action ) {

	if ( $action == 'update' && get_post_type( $post ) == 'galleries' ) {
		
		$images = get_field( 'gallery', $post );

		$count= count($images);

		if ($count > 1){
			$i = 0 - $count + 1;
		} else { 
			$i = 0;
		}

		foreach( $images as $image ): 
			$i++;
			if ($i > 0) {
				
				$args['media'] = array(
					'link'          => get_the_permalink( $post ),
					'description'   => get_the_excerpt( $post ),
					'title'         => get_the_title( $post ),
					'picture'       => strtok( $image['url'], '?' ),
				);				

			}
		endforeach;		

	}

	return $args;
}, 10, 6 );
