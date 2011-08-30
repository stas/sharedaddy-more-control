<?php
class SharedaddyMoreControl {
    /**
     * Static method that fires hooks
     */
    function init() {
        add_filter( 'sharing_show', array( 'SharedaddyMoreControl', 'sharing_show' ), 10, 2 );
        add_action( 'sharing_global_options', array( 'SharedaddyMoreControl', 'screen' ) );
        add_action( 'sharing_admin_update', array( 'SharedaddyMoreControl', 'update' ) );
    }
    
    /**
     * Hooks into Sharedaddy's `sharing_show` and does some checks
     * @param Bool $show, on false Sharedaddy will output nothing
     * @param Object $post, current post/page
     * @return Bool, same as $show
     */
    function sharing_show( $show, $post ) {
        $post_option = get_post_meta( $post->ID, 'sharing_disabled', false );
        $restrict_to = get_option( 'sharedaddy-mc-restrict-to' );
        
        // Check if per post option is not in conflict
        if( !empty( $restrict_to ) && empty( $post_option ) )
            if( is_object( $post ) && !in_array( $post->post_type, $restrict_to ) )
                $show = false;
            else
                $show = true;
        
        return $show;
    }
    
    /**
     * Hook to add more options
     */
    function screen() {
        $vars['show_more'] = get_option( 'sharedaddy-mc-restrict-to' );
        $vars['options'] = get_post_types( array( 'public' => true ), 'objects' );
        self::template_render( 'options', $vars );
    }
    
    /**
     * Hook to save extended options
     */
    function update() {
        $show_more = array();
        $post_types = array_keys( get_post_types( array( 'public' => true ) ) );
        
        if( isset( $_POST['show_more'] ) && count( $_POST['show_more'] ) )
            foreach( $_POST['show_more'] as $o => $v )
                if( in_array( $o, $post_types ) && $v )
                    $show_more[] = $o;
        
        update_option( 'sharedaddy-mc-restrict-to', $show_more );
    }
    
    /**
     * template_render( $name, $vars = null, $echo = true )
     *
     * Helper to load and render templates easily
     * @param String $name, the name of the template
     * @param Mixed $vars, some variables you want to pass to the template
     * @param Boolean $echo, to echo the results or return as data
     * @return String $data, the resulted data if $echo is `false`
     */
    function template_render( $name, $vars = null, $echo = true ) {
        ob_start();
        if( !empty( $vars ) )
            extract( $vars );
        
        if( !isset( $path ) )
            $path = dirname( __FILE__ ) . '/templates/';
        
        include $path . $name . '.php';
        
        $data = ob_get_clean();
        
        if( $echo )
            echo $data;
        else
            return $data;
    }
}
?>
