<?php
namespace Shortcode\Data\Model;


class ShortcodeQuery {
    private string $post_type;
    private int $posts_per_page;
    private string $taxonomy;
    private string $order;
    private string $category_filter;
    private int $page_number;
    private string $layout;
    private array $terms;

    //------------Set Atttributes---------------
    function setPostType( string $type ) {
        $this -> post_type = $type;
    }

    function setPostPerPage( int $ppp ) {
        $this -> posts_per_page = $ppp;
    }

    function setTaxonomy( string $taxonomy) {
        $this -> taxonomy = $taxonomy;
    }

    function setOrder( string $order) {
        $this -> order = $order;
    }

    function setCategoryFilter( string $set) {
        $this -> category_filter = $set;
    }

    function setPageNumber( int $page_no ) {
        $this -> page_number = $page_no;
    }

    function setLayout( string $layout ) {
        $this -> layout = $layout;
    }
    



    //-------------End of Set Attributes---------------


    //--------------Get Attributes--------------------
    function getPostType() {

        return $this -> post_type;

    }

    function getPostPerPage() {

        return $this -> posts_per_page;

    }

    function getTaxonomy() {

        return $this -> taxonomy;

    }

    function getOrder() {

        return $this -> order;

    }

    function getCategoryFilter() {

        return $this -> category_filter;

    }

    function getPageNumber() {
        return $this -> page_number;
    }

    function getLayout() {
        return $this -> layout;
    }

    function getTerms() {
        $terms = get_terms( array(
            'taxonomy' => $this -> getTaxonomy(),
            'parent' => 0,
        ));
        return $terms;
    }

    //----------------End of Get Attributes----------------


    //Return WP_Query object
    function fulfill( Array $params) {

        $args = $params;

        $query = new \WP_Query( $args );
        return $query;

    }
}