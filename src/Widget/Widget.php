<?php

namespace helloicms\Widget;
use helloicms\FileManager;

class Widget extends \WP_Widget {
    
    /**
     * @var FileManager
     */

    public function __construct( ) {


        parent::__construct(
            'helloicms_widget',  // Base ID
            __('Other widget', 'helloicms')   // Name
        );

    }


    public function widget( $args, $instance ) {

        echo $args['before_widget'];
        

        if ( ! empty( $instance['title'] ) ) {
            echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
        }        
        $color = '';
        $text = '';
        if ($instance['color'] != '0' && $instance['color']) {
            $color = 'style="color:'.$instance['color'].'"';
            $text = __('You are need color','helloicms') . ': ' . $instance['color'];
        }
        
        //Пример шоткода 
        // [tagAdd tag="a" href="/testtest" style="color:red" close="1"]Ссылка куда-то[/tagAdd]
        
        echo '<div class="textwidget" ' . $color . '>';
        echo do_shortcode($instance['text']);
        echo '</div>';
        echo $text;

        echo $args['after_widget'];

    }

    // Форма налаштувань віджета
    public function form( $instance ) {

        $title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( '', 'helloicms' );
        $text = ! empty( $instance['text'] ) ? $instance['text'] : esc_html__( '', 'helloicms' );
        $color = ! empty( $instance['color'] ) ? $instance['color'] : esc_html__( '', 'helloicms' );
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_attr_e( 'Title:', 'helloicms' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>
        <p>
            <textarea class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'text' ) ); ?>" type="text" cols="30" rows="10"><?php echo esc_attr( $text ); ?></textarea>
        </p>
        
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'color' ) ); ?>"><?php esc_attr_e( 'Color:', 'helloicms' ); ?></label>
            <select name="<?php echo esc_attr( $this->get_field_name( 'color' ) ); ?>">
                <option value="0" selected="selected"> <?php echo  __( 'No selected', 'helloicms' ) ;?></option>
                <option value="red" <?php if ($this->get_field_name( 'color' ) == 'red'):?>selected="selected"<?php endif;?> > <?php echo  __( 'red', 'helloicms' ) ;?></option>
                <option value="green" <?php if ($this->get_field_name( 'color' ) == 'green'):?>selected="selected"<?php endif;?> ><?php echo __( 'green', 'helloicms' ) ;?></option>
            </select>           
        </p>
        
        <?php

    }

    // Обробка форми віджета
    public function update( $new_instance, $old_instance ) {

        $instance = array();

        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['text'] = ( !empty( $new_instance['text'] ) ) ? $new_instance['text'] : '';
        $instance['color'] = ( !empty( $new_instance['color'] ) ) ? $new_instance['color'] : '';

        return $instance;
    }

}
