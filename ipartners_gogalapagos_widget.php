<?php
add_action( 'widgets_init', function(){
    register_widget( 'getgogalapagos_widget' );
});

class getgogalapagos_widget extends WP_Widget {
    
    // class constructor
	public function __construct() {
        $widget_ops = array( 
            'classname' => 'getgogapagos_widget',
            'description' => 'Show Go Galapagos iPartners form on widget areas',
        );
        parent::__construct( 'getgogapagos_widget', 'Go Galapagos iPartners', $widget_ops );
    }
	
	// output the widget content on the front-end
	public function widget( $args, $instance ) {
        //obtener los valores de la DB
        $theme = $instance['theme'];
        
        switch ($theme){
            case 0: $theme = 'light'; break;
            case 1: $theme = 'dark'; break;
            case 2: 
                $theme = 'custom'; 
                echo '<!-- Go Galapagos iPartner -->';
                echo '<style media="screen">'.$instance['css'].'</style>';
                break;
        }
        ?>
<div id="getgogalapagos" class="getgogalapagos <?= $theme ?>">
    <!--h2>Go travel to<br />Galapagos Island</h2-->
    <h2><?= $instance['title'] ?></h2>
    <form id="getgogalapagos-form" role="form" action="https://quote.gogalapagos.com/en/site/cruceros" method="get" target="_blank">
        <input type="hidden" name="site" value="<?= $_SERVER['SERVER_NAME'] ?>">
        <input type="hidden" name="partner" value="<?= md5('123') ?>">
        <label>How many of you?</label>
        <select name="SearchProduct[adultos]">
            <option value="1">1</option>
            <option value="2" selected>2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
            <option value="9">9</option>
        </select>
        <a class="more-departures-link" href="http://gogalapagos.sistemaskt.com/request-a-quote/" target="_blank" alt="Go Galapagos departure dates">More than 9?</a>
        <br />
        <label>Our nearly departure dates</label>
        <br />
        <select name="date">
            <option>Please choose one</option>
            <option value="1">Jun 5-8th 2018 (A) - Galapagos Legend</option>
            <option value="2">Jun 7-11th 2018 (B) - Coral Yacths</option>
            <option value="3">Jun 8-12th 2018 (B) - Galapagos Legend</option>
            <option value="4">Jun 11-14th 2018 (C) - Coral Yatchs</option>
            <option value="5">Jun 12-15th 2018 (C) - Galapagos Legend</option>
        </select>
        <a class="more-departures-link" href="https://quote.gogalapagos.com/en/site/cruceros" target="_blank" alt="Go Galapagos departure dates">Need more departure dates?</a>
        <br />
        <button type="submit">Find My Cruise Now</button>
    </form>
    <img width="120" class="getgogalapagos-logo" src="https://www.gogalapagos.com/assets/images/logo-34-anos-<?= $theme == 0 ? 'blanco' : 'blanco' ?>.png">
</div>
        <?php
    }

	// output the option form field in admin Widgets screen
	public function form( $instance ) {
        
        $title = ! empty( $instance['title'] ) ? $instance['title'] : '';     
        $theme = ! empty( $instance['theme'] ) ? $instance['theme'] : 0;     
        $custom_css = ! empty( $instance['css'] ) ? $instance['css'] : GETGOGALAPAGOS_DEFULAT_CSS;     
        
	?>
	<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
	<?php esc_attr_e( 'Title:', 'text_domain' ); ?>
	</label> 
	<input class="widefat gogalalapos" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
	</p>
	<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'theme' ) ); ?>">
	<?php esc_attr_e( 'Widget Theme:', 'text_domain' ); ?>
	</label> 
	<select id="<?php echo esc_attr( $this->get_field_id( 'theme' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'theme' ) ); ?>">
	    <option value="0" <?= $theme == 0 ? 'selected' : '' ?>>Light</option>
	    <option value="1" <?= $theme == 1 ? 'selected' : '' ?>>Dark</option>
	    <option value="2" <?= $theme == 2 ? 'selected' : '' ?>>Custom</option>
	</select>
	</p>
	<p>
	<label for="<?php echo esc_attr( $this->get_field_id( 'theme' ) ); ?>">
	<?php esc_attr_e( 'Custom CSS:', 'text_domain' ); ?>
	</label>
	<textarea rows="10" class="widefat gogalalapos" id="<?php echo esc_attr( $this->get_field_id( 'css' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'css' ) ); ?>"><?= $custom_css ?></textarea>
	</p>
	<?php
    }

	// save options
	public function update( $new_instance, $old_instance ) {
        
        $instance = $new_instance;
        
        //$instance['title'] = ( ! empty( $new_instance['getgogalapagos_title'] ) ) ? strip_tags( $new_instance['getgogalapagos_title'] ) : '';
        
        return $instance;
        
    }    
    
}