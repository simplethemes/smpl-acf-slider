<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.simplethemes.com
 * @since      1.0.0
 *
 * @package    Smpl_Acf_Slider
 * @subpackage Smpl_Acf_Slider/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Smpl_Acf_Slider
 * @subpackage Smpl_Acf_Slider/public
 * @author     Casey Lee <casey@simplethemes.com>
 */
class Smpl_Acf_Slider_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_register_style( 'slick', plugin_dir_url( __FILE__ ) . 'css/slick.css', array(), $this->version, 'all' );
		wp_register_style( 'slick-theme', plugin_dir_url( __FILE__ ) . 'css/slick-theme.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_register_script( 'slick-slider', plugin_dir_url( __FILE__ ) . 'js/slick.min.js', array( 'jquery' ), $this->version, true );
		wp_register_script( 'slick-init', plugin_dir_url( __FILE__ ) . 'js/slider.init.js', array( 'jquery' ), $this->version, true );

	}


	/**
	 * Slideshow Shortcode Hook
	 * Allows shortcode to be called dynamically within themes
	 * @since    1.0.0
	 */
    public function st_do_slider( $id )
    {
        echo do_shortcode("[slideshow id='$id']");
    }


	/**
	 * Slideshow Shortcode
	 * Allows shortcode to be called dynamically within content
	 * @since    1.0.0
	 */
    public function st_slideshow_shortcode( $atts, $content = null ) {

        extract(shortcode_atts(array('id' => ''), $atts));

        $slick = array();
        $slick['slide']            = '.slide';
        $slick['speed']            = get_field('slide_transition_speed', $id);
        $slick['autoplaySpeed']    = get_field('slide_autoplayspeed', $id);
        $slick['dots']             = false;
        $slick['arrows']           = false;
        $slick['infinite']         = false;
        $slick['pauseOnHover']     = false;
        $slick['pauseOnDotsHover'] = false;
        $slick['adaptiveHeight']   = false;
        $slick['draggable']        = false;
        $slick['autoplay']         = false;
        $slick['video_autoplay']   = true;
        $slick['fade']             = false;

        $features = get_field('slider_enable_features', $id);
        foreach ($features as $feature => $value) {
            $slick[$value] = true;
        }
        $slick = apply_filters( 'slick_options', $slick );

        wp_enqueue_style( 'slick' );
        wp_enqueue_style( 'slick-theme' );
        wp_enqueue_script( 'slick-slider' );
        wp_enqueue_script( 'slick-init' );
        wp_localize_script( 'slick-init','slider_opts',json_encode($slick) );

        return $this->st_render_slides($id);

    }

	/**
	 * Slideshow Shortcode Query
	 * Allows shortcode to be called dynamically within themes
	 * @since    1.0.0
	 */
    public function st_render_slides( $slider_id )
    {
        $output = '';
        // Get The Slider Post
        $args = array (
            'p'                      => $slider_id,
            'post_type'              => array( 'slider' )
        );

        // Query
        $slider_query = new WP_Query( $args );
        // Loop
        if ( $slider_query->have_posts() ) {
            $i = 0;
            $has_video = false;

            while ( $slider_query->have_posts() ) {

                $slider_query->the_post();
                $features         = get_field('slider_enable_features');

                $slider_arrows    = (in_array('arrows',$features)) ? 'has-arrows' : false;
                $slider_container = get_field('slider_container');
                $slider_css_class = get_field('slider_css_class');
                $slider_bgcolor   = get_field('slider_container_background');
                $slider_bgimg     = get_field('slider_container_background_image');
                $slider_textcolor = get_field('slider_textcolor');
                $slider_bgrepeat  = get_field('slider_container_background_repeat');

                $container_options = array(
                    'slider_container' => $slider_container,
                    'slider_arrows'    => $slider_arrows,
                    'slider_css_class' => $slider_css_class,
                    'slider_bgcolor'   => $slider_bgcolor,
                    'slider_bgimg'     => $slider_bgimg,
                    'slider_textcolor' => $slider_textcolor,
                    'slider_bgrepeat'  => $slider_bgrepeat,
                );
                $output .= $this->orion_fullwidth_slider_start($container_options,$slider_id);

                // begin each slide
                if( have_rows('slide') ):
                    while( have_rows('slide') ): the_row();
                        $i++;
                            $slide_type                = get_sub_field('slide_type');
                            $slide_class               = get_sub_field('slide_class');
                            $slide_heading             = get_sub_field('slide_heading');
                            $slide_content             = get_sub_field('slide_content', false, false);
                            $slide_content_image       = get_sub_field('slide_content_image');
                            $slide_content_image_align = get_sub_field('slide_content_image_align');
                            $slide_fullwidth_image     = get_sub_field('slide_fullwidth_image');
                            $slide_button_text         = get_sub_field('slide_button_text');
                            $slide_url                 = get_sub_field('slide_url');
                            $slide_video               = get_sub_field('slide_video');
                            $display_caption           = get_sub_field('display_caption');
                            $slide_caption_heading     = get_sub_field('slide_caption_heading');
                            $slide_caption             = get_sub_field('slide_caption');
                            $slide_caption_button_text = get_sub_field('slide_caption_button_text');
                            $defined_size = wp_get_attachment_image_src($slide_content_image['ID'],array(200, true));
                            // add attributes to vimeo embed
                            if ($slide_type == 'video_slide' && !empty($slide_video)) {
                                $has_video    = true;
                                $the_video    = $this->format_video_src($slide_video);
                            }


                            $output .= '<div class="slide '.$slide_type.' '.$slide_class.'">';
                            $output .= '<div class="inner">';

                            switch ($slide_type) {
                                case 'content_slide':
                                    if ($slide_content_image) {
                                        $output .= '<img class="slide_thumb_'.$slide_content_image_align.'" src="'.$defined_size[0].'"/>';
                                    }
                                    if ($slide_heading) {
                                        $output .= '<h2>'.$slide_heading.'</h2>';
                                    }
                                    $output .= $slide_content;
                                    if ($slide_url && $slide_button_text) {
                                        $output .= '<div class="button-container right large"><a class="button" href="'.$slide_url.'">'.$slide_button_text.'</a></div><div class="clear"></div>';
                                    }
                                    break;
                                case 'image_slide':
                                    $hasbutton = ($slide_caption_button_text && $slide_url) ? true : false;
                                    if ($display_caption) {
                                        $output .= '<div class="slideover">';
                                        if ($slide_caption_heading) {
                                            $output .= '<h1>'.$slide_caption_heading.'</h1>';
                                        }
                                        if ($slide_caption) {
                                            $output .= '<p>'.$slide_caption.'</p>';
                                        }
                                        if ($hasbutton) {
                                            $output .= '<div class="button-container large"><a class="button" href="'.$slide_url.'">'.$slide_caption_button_text.'</a></div>';
                                        }
                                        $output .= '</div>';
                                    }
                                    if ($slide_url) {
                                        if ($hasbutton) {
                                            $output .= '<img src="'.$slide_fullwidth_image['url'].'"/>';
                                        } else {
                                            $output .= '<a href="'.$slide_url.'"><img src="'.$slide_fullwidth_image['url'].'"/></a>';
                                        }
                                    } else {
                                        $output .= '<img src="'.$slide_fullwidth_image['url'].'"/>';
                                    }
                                    break;
                                case 'video_slide':
                                    $output .= $the_video;
                                    break;
                            }
                            $output .= '</div><!-- /inner -->';
                            $output .= '</div><!-- /slide -->';
                    endwhile;
                            $output .= $this->orion_fullwidth_slider_end();
                endif;
                //end each slide
            }
        } else {
            // no slides found
        }
        // Restore original Post Data
        wp_localize_script('slick-init','slider_video',array('has_video' => $has_video));
        wp_reset_postdata();
        return $output;
    }


    /**
    * Begin Slider markup
    * @param  [string]  $container_options
    * @param  [int]     $slider_id
    */
    public function orion_fullwidth_slider_start($container_options,$slider_id)
    {

        // Get the slider classes and styles for container
        $styles  = $this->slider_styles($container_options);
        $classes = $this->slider_classes($container_options,$slider_id);

        $output = '<div id="slider" '.$styles.' '.$classes.'>'."\n"
                . '<div class="container">'."\n"
                . '<div class="sixteen columns slider">';

        return $output;
    }



    /**
    * Closing markup and javascript output
    * @return [string] closing markup
    */
    public function orion_fullwidth_slider_end()
    {
        $output = '</div></div></div>';
        return $output;
    }



    /**
     * Initialize CSS styles for the slider container
     *
     * @since    1.0.0
     * @param      array    $container_options  The array of options.
     */
    public function slider_styles($container_options)
    {
        $slider_bgcolor   = (!empty($container_options['slider_bgcolor'])) ? 'background-color:'.$container_options['slider_bgcolor'].';' : false;
        $slider_bgimg     = (!empty($container_options['slider_bgimg'])) ? 'background-image:url(\''.$container_options['slider_bgimg'].'\');' : false;
        $slider_textcolor = (!empty($container_options['slider_textcolor'])) ? 'color:'.$container_options['slider_textcolor'].';' : false;

        $styles = array(
            'slider_bgcolor'   => $slider_bgcolor,
            'slider_bgimg'     => $slider_bgimg,
            'slider_textcolor' => $slider_textcolor
        );
        // allow override via $styles [array]
        $styles = apply_filters( 'slider_custom_styles', $styles );
        $style = 'style="'.implode(' ', $styles).'"';

        return $style;
    }



    /**
     * Initialize CSS classes for the slider container
     *
     * @since    1.0.0
     * @param      array    $container_options  The array of options.
     * @param      int      $slider_id          The slider id.
     */
    public function slider_classes($container_options,$slider_id) {

        $slider_container = (!empty($container_options['slider_container'])) ? $container_options['slider_container'] : false;
        $slider_bgrepeat  = (!empty($container_options['slider_bgrepeat'])) ? $container_options['slider_bgrepeat'] : false;
        $slider_arrows    = (!empty($container_options['slider_arrows'])) ? $container_options['slider_arrows'] : false;
        $slider_css_class = (!empty($container_options['slider_css_class'])) ? $container_options['slider_css_class'] : false;

        $classes = array(
            'slider_container' => $slider_container,
            'slider_bgrepeat'  => $slider_bgrepeat,
            'slider_arrows'    => $slider_arrows,
            'custom_class'     => $slider_css_class,
            'id'               => 'slider_id_'.$slider_id
        );
        // allow override via $classes [array]
        $classes = apply_filters( 'slider_custom_classes', $classes );
        $class = 'class="'.implode(' ',$classes).'"';

        return $class;
    }



    /**
    * Add attributes for JS callbacks and better player UI
    * @param  [string] $slide_video [the embed HTML object]
    * @return [string] $slide_video [modified embed HTML object]
    */
    public static function format_video_src($slide_video) {
        // use preg_match to find iframe src
        preg_match('/src="(.+?)"/', $slide_video, $matches);
        $src = $matches[1];

        // add JS api params to video providers (vimeo/youtube)
        $is_youtube = (strpos($src,'youtube')) ? $params = array('enablejsapi'=>1,'modestbranding'=>1,'showinfo'=>0,'border'=>0,'autohide'=>1,'controls'=>2) : false ;
        $is_vimeo   = (strpos($src,'vimeo')) ? $params = array('api' => 1,'byline'=>0,'badge'=>0,'portrait'=>0,'title'=>0) : false ;

        // add extra params to iframe src
        $new_src = add_query_arg($params, $src);
        $slide_video = str_replace($src, $new_src, $slide_video);

        return $slide_video;
    }




}
