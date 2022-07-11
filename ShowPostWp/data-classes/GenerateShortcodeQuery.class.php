<?php
namespace Shortcode\Data\GenerateShortcode;
use \Shortcode\Data\Model\ShortcodeQuery as ShortcodeQuery;


class GenerateShortcodeQuery {

    private $passQueryInstance;
    private $queryArray;

    public function generateShortcodeQuerywithoutCat( Array $attributes , $page_number) {
        
        $queryInstance = new ShortcodeQuery();
        $queryInstance -> setPostType( esc_attr($attributes['post_type']) );
        $queryInstance -> setPostPerPage( esc_attr($attributes['posts_per_page']) );
        $queryInstance -> setTaxonomy( esc_attr($attributes['taxonomy']) );
        $queryInstance -> setOrder( esc_attr($attributes['order']) );
        $queryInstance -> setCategoryFilter( esc_attr($attributes['category_filter']) );
        // $queryInstance -> setPageNumber(1);

        $args = array (

        "post_type" => $queryInstance -> getPostType(),
        "posts_per_page" => $queryInstance -> getPostPerPage(),
        "order" => $queryInstance -> getOrder(),
        "paged" => $page_number,
        
        );

        $this -> queryArray = $args;


        // echo json_encode($args);

        $this -> passQueryInstance = $queryInstance;


        return $queryInstance -> fulfill( $args );

    }

    public function getQueryInstance( ) {

        return $this -> passQueryInstance;
        
    }

    public function getQueryArray() {
        return $this -> queryArray;
    }
}