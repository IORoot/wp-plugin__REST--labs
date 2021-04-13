<?php

namespace andyp\labsstack\REST;

use \WP_REST_Request;


class labs {

    public $posts;

    public $result;


    public function __construct()
    {
        $this->REST_call();
        $this->render();
    }



    /**
     * https://rudrastyh.com/wordpress/rest-api-get-posts.html
     */
    private function REST_call()
    {
        $transient = \get_transient( 'labsstack' );
        if( ! empty( $transient ) ) {
            return $transient;
        }

        $response = \wp_remote_get( add_query_arg( array(
            'per_page' => 10,
            'labs_category' => 4
        ), 'https://labs.londonparkour.com/wp-json/wp/v2/tutorial?orderby=rand' ) );


        if (is_wp_error($response)) {
            return;
        }
        
        $this->posts = json_decode( $response['body'] ); // our posts are here

        \set_transient( 'labsstack', json_decode( $this->posts ), DAY_IN_SECONDS );
    }


    public function render()
    {
        if (!isset($this->posts)){
            return;
        }

        shuffle($this->posts);

        $output = '<ul class="labs grid grid-cols-2 grid-rows-2 gap-4 iso-2">';

        foreach($this->posts as $key => $post )
        {
            // 1 = 'one', 12 = 'twelve'
            $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
            $id = $f->format($key);
            $zebra = ($key++%2==1) ? 'odd' : 'even';

            $output .= '<li class="'.$id.' '.$zebra.' w-full h-40 bg-smoke">';
                $output .= '<div class="w-full h-full mb-2">';
                    $output .= '<img class="lazyload object-cover" src="'.$post->imageURL.'" alt="'.$post->title->rendered.'">';
                $output .= '</div>';
            $output .= '</li>';
        }

        $output .= '</ul>';

        $this->result = $output;
    }



    public function out()
    {
        return $this->result;
    }

}