<?php

/**
* Instatiate the Slider Post Type
* @var CPT
*/

$slides = new CPT(
    array(
        'post_type_name' => 'slider',
    ),
    array(
        'supports'     => array('title'),
        'menu_icon'    => 'dashicons-welcome-view-site',
        'public'       => false,
        'show_ui'      => true,
        'show_in_rest' => true,
    )
);

// Add Columns to Admin

$slides->columns(array(
    'cb' => '<input type="checkbox" />',
    'title' => __('Title'),
    'shortcode' => __('Shortcode'),
    'id' => __('ID'),
    'date' => __('Date')
));

// Populate Shortcode Column

$slides->populate_column('shortcode', function($column, $post) {
    echo "<pre>[slideshow id=\"".$post->ID.'"]</pre>';
});

// Populate ID Column

$slides->populate_column('id', function($column, $post) {
    echo $post->ID;
});

// Add the ACF Fields
if ( ! class_exists( 'acf_pro' ) ) {
    include_once get_template_directory().'/inc/acf/acf.php';
}

if( function_exists('acf_add_local_field_group') ):
    // Slider Options
    acf_add_local_field_group(array (
        'key' => 'group_5625f53b88b2a',
        'title' => 'Slider Options',
        'fields' => array (
            array (
                'key' => 'field_5625f82bf1aac',
                'label' => 'UI Features',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array (
                'key' => 'field_5625f54ce518e',
                'label' => 'Enable Features',
                'name' => 'slider_enable_features',
                'type' => 'checkbox',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => 100,
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    'dots' => 'Navigation Dots',
                    'arrows' => 'Navigation Arrows',
                    'infinite' => 'Infinite Loop',
                    'pauseOnHover' => 'Pause On Hover',
                    'pauseOnDotsHover' => 'Pause On Navigation Hover',
                    'adaptiveHeight' => 'Adaptive Height',
                    'draggable' => 'Draggable',
                    'autoplay' => 'AutoPlay',
                    'fade' => 'Fade',
                ),
                'default_value' => array (
                ),
                'layout' => 'vertical',
                'toggle' => 0,
            ),
            array (
                'key' => 'field_5635ef26c90c4',
                'label' => 'Slide Transition Speed',
                'name' => 'slide_transition_speed',
                'type' => 'number',
                'instructions' => 'Speed (in ms) for transition speed.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => 50,
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 500,
                'placeholder' => '',
                'prepend' => '',
                'append' => 'ms',
                'min' => 100,
                'max' => '',
                'step' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
            array (
                'key' => 'field_5635efa0c5fb5',
                'label' => 'Slide Autoplay Speed',
                'name' => 'slide_autoplayspeed',
                'type' => 'number',
                'instructions' => 'Duration (in ms) between slides when autoplay is enabled.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => 50,
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 3000,
                'placeholder' => '',
                'prepend' => '',
                'append' => 'ms',
                'min' => 500,
                'max' => '',
                'step' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
            array (
                'key' => 'field_5625f84ef1aad',
                'label' => 'Size',
                'name' => 'size',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array (
                'key' => 'field_5625f6bdc5613',
                'label' => 'Width',
                'name' => 'slider_container',
                'type' => 'radio',
                'instructions' => 'Select a container style to display this slider.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    'full_width' => 'Full Width (Useful for image sliders)',
                    'constrained' => 'Full Width - Constrained Content',
                    'boxed' => 'Boxed   (Useful within content as shortcode)',
                ),
                'other_choice' => 0,
                'save_other_choice' => 0,
                'default_value' => 'full_width',
                'layout' => 'vertical',
            ),
            array (
                'key' => 'field_5625f861f1aae',
                'label' => 'Colors',
                'name' => '',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array (
                'key' => 'field_5625f757c5614',
                'label' => 'Background Color',
                'name' => 'slider_container_background',
                'type' => 'color_picker',
                'instructions' => 'Choose a background color for your slider.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => 50,
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '#EEEEEE',
            ),
            array (
                'key' => 'field_562b1c5b847a9',
                'label' => 'Text Color',
                'name' => 'slider_textcolor',
                'type' => 'color_picker',
                'instructions' => 'Choose a text color for your slider.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => 50,
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '#FFFFFF',
            ),
            array (
                'key' => 'field_5625f9fd8d759',
                'label' => 'Background Image',
                'name' => 'slider_container_background_image',
                'type' => 'image',
                'instructions' => 'Choose a background color for your slider.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => 50,
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'url',
                'preview_size' => 'medium',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
            ),
            array (
                'key' => 'field_562b1cac30823',
                'label' => 'Background Repeat',
                'name' => 'slider_container_background_repeat',
                'type' => 'select',
                'instructions' => 'Slider Background placement.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => 50,
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array (
                    'no-repeat' => 'Don\'t Tile',
                    'repeat' => 'Tile Horizontally and Vertically',
                    'repeat-x' => 'Tile Horizontally',
                    'repeat-y' => 'Tile Vertically',
                ),
                'default_value' => array (
                    'no-repeat' => 'no-repeat',
                ),
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'ajax' => 0,
                'placeholder' => '',
                'disabled' => 0,
                'readonly' => 0,
            ),
            array (
                'key' => 'field_5625f8f056182',
                'label' => 'Advanced',
                'name' => 'advanced',
                'type' => 'tab',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'placement' => 'top',
                'endpoint' => 0,
            ),
            array (
                'key' => 'field_5625f8fc56183',
                'label' => 'CSS Class',
                'name' => 'slider_css_class',
                'type' => 'text',
                'instructions' => 'Add a class for unique styling of this slider via CSS.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'theme-slide-example',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'slider',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'acf_after_title',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ));
    //  Slider Fields
    acf_add_local_field_group(array (
        'key' => 'group_5625c6eb50a96',
        'title' => 'Slider',
        'fields' => array (
            array (
                'key' => 'field_5625c993a9203',
                'label' => 'Slides',
                'name' => 'slide',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array (
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => 'field_5625c9a2a9204',
                'min' => '',
                'max' => '',
                'layout' => 'block',
                'button_label' => 'Add Slide',
                'sub_fields' => array (
                    array (
                        'key' => 'field_5625cafc1bb1f',
                        'label' => 'Slide Options',
                        'name' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'top',
                        'endpoint' => 0,
                    ),
                    array (
                        'key' => 'field_5625cb2b1bb21',
                        'label' => 'Slide Content Type',
                        'name' => 'slide_type',
                        'type' => 'radio',
                        'instructions' => 'Choose a slide content type. Options in the following tab will change based on the settings made here.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => 50,
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array (
                            'image_slide' => 'Image Slide',
                            'content_slide' => 'Content Slide',
                            'video_slide' => 'Video Slide',
                        ),
                        'other_choice' => 0,
                        'save_other_choice' => 0,
                        'default_value' => 'content_slide',
                        'layout' => 'vertical',
                    ),
                    array (
                        'key' => 'field_562b1e2032909',
                        'label' => 'Slide Class',
                        'name' => 'slide_class',
                        'type' => 'text',
                        'instructions' => 'Optional custom CSS to be applied for advanced styling.',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => 50,
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ),
                    array (
                        'key' => 'field_5625cb1e1bb20',
                        'label' => 'Slide Content',
                        'name' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'top',
                        'endpoint' => 0,
                    ),
                    array (
                        'key' => 'field_5625c9a2a9204',
                        'label' => 'Heading',
                        'name' => 'slide_heading',
                        'type' => 'text',
                        'instructions' => 'Title text for the slide.',
                        'required' => 0,
                        'conditional_logic' => array (
                            array (
                                array (
                                    'field' => 'field_5625cb2b1bb21',
                                    'operator' => '==',
                                    'value' => 'content_slide',
                                ),
                            ),
                        ),
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ),
                    array (
                        'key' => 'field_5625c9cda9205',
                        'label' => 'Content',
                        'name' => 'slide_content',
                        'type' => 'wysiwyg',
                        'instructions' => 'Content for this slide',
                        'required' => 0,
                        'conditional_logic' => array (
                            array (
                                array (
                                    'field' => 'field_5625cb2b1bb21',
                                    'operator' => '==',
                                    'value' => 'content_slide',
                                ),
                            ),
                        ),
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'tabs' => 'all',
                        'toolbar' => 'simple',
                        'media_upload' => 1,
                    ),
                    array (
                        'key' => 'field_5625c9f9a9206',
                        'label' => 'Image',
                        'name' => 'slide_content_image',
                        'type' => 'image',
                        'instructions' => 'Image for this slide. Best aspect ratio is 4:3 or 16:9.',
                        'required' => 0,
                        'conditional_logic' => array (
                            array (
                                array (
                                    'field' => 'field_5625cb2b1bb21',
                                    'operator' => '==',
                                    'value' => 'content_slide',
                                ),
                            ),
                        ),
                        'wrapper' => array (
                            'width' => 50,
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                        'library' => 'all',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ),
                    array (
                        'key' => 'field_5625d401faaf6',
                        'label' => 'Image Align',
                        'name' => 'slide_content_image_align',
                        'type' => 'radio',
                        'instructions' => 'For content slides with images, choose which side of the slide your image will be aligned.',
                        'required' => 0,
                        'conditional_logic' => array (
                            array (
                                array (
                                    'field' => 'field_5625cb2b1bb21',
                                    'operator' => '==',
                                    'value' => 'content_slide',
                                ),
                            ),
                        ),
                        'wrapper' => array (
                            'width' => 50,
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array (
                            'align_left' => 'Align Left',
                            'align_right' => 'Align Right',
                        ),
                        'other_choice' => 0,
                        'save_other_choice' => 0,
                        'default_value' => '',
                        'layout' => 'horizontal',
                    ),
                    array (
                        'key' => 'field_5625d5ba4c2bd',
                        'label' => 'Slide Image',
                        'name' => 'slide_fullwidth_image',
                        'type' => 'image',
                        'instructions' => 'Add a full width Image for this slide. For best results, size should be a minimum of 1400px.',
                        'required' => 0,
                        'conditional_logic' => array (
                            array (
                                array (
                                    'field' => 'field_5625cb2b1bb21',
                                    'operator' => '==',
                                    'value' => 'image_slide',
                                ),
                            ),
                        ),
                        'wrapper' => array (
                            'width' => 50,
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                        'library' => 'all',
                        'min_width' => '',
                        'min_height' => '',
                        'min_size' => '',
                        'max_width' => '',
                        'max_height' => '',
                        'max_size' => '',
                        'mime_types' => '',
                    ),
                    array (
                        'key' => 'field_5625ca19a9207',
                        'label' => 'Button',
                        'name' => 'slide_button_text',
                        'type' => 'text',
                        'instructions' => 'Optional button to appear with this slide',
                        'required' => 0,
                        'conditional_logic' => array (
                            array (
                                array (
                                    'field' => 'field_5625cb2b1bb21',
                                    'operator' => '==',
                                    'value' => 'content_slide',
                                ),
                            ),
                        ),
                        'wrapper' => array (
                            'width' => 50,
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ),
                    array (
                        'key' => 'field_5625ca4aa9208',
                        'label' => 'URL',
                        'name' => 'slide_url',
                        'type' => 'text',
                        'instructions' => 'URL to visit on when slide elements are clicked',
                        'required' => 0,
                        'conditional_logic' => array (
                            array (
                                array (
                                    'field' => 'field_5625cb2b1bb21',
                                    'operator' => '==',
                                    'value' => 'image_slide',
                                ),
                            ),
                            array (
                                array (
                                    'field' => 'field_5625cb2b1bb21',
                                    'operator' => '==',
                                    'value' => 'content_slide',
                                ),
                            ),
                        ),
                        'wrapper' => array (
                            'width' => 50,
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => 'http://',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ),
                    array (
                        'key' => 'field_56385f2e0dde1',
                        'label' => 'Display Caption',
                        'name' => 'display_caption',
                        'type' => 'true_false',
                        'instructions' => 'Displays an optional heading/caption centered above the image.',
                        'required' => 0,
                        'conditional_logic' => array (
                            array (
                                array (
                                    'field' => 'field_5625cb2b1bb21',
                                    'operator' => '==',
                                    'value' => 'image_slide',
                                ),
                            ),
                        ),
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'message' => '',
                        'default_value' => 0,
                    ),
                    array (
                        'key' => 'field_5625cd6ae1774',
                        'label' => 'Video',
                        'name' => 'slide_video',
                        'type' => 'oembed',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array (
                            array (
                                array (
                                    'field' => 'field_5625cb2b1bb21',
                                    'operator' => '==',
                                    'value' => 'video_slide',
                                ),
                            ),
                        ),
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'width' => '',
                        'height' => '',
                    ),
                    array (
                        'key' => 'field_5638612e6e522',
                        'label' => 'Caption',
                        'name' => '',
                        'type' => 'tab',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array (
                            array (
                                array (
                                    'field' => 'field_5625cb2b1bb21',
                                    'operator' => '==',
                                    'value' => 'image_slide',
                                ),
                                array (
                                    'field' => 'field_56385f2e0dde1',
                                    'operator' => '==',
                                    'value' => '1',
                                ),
                            ),
                        ),
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'placement' => 'top',
                        'endpoint' => 0,
                    ),
                    array (
                        'key' => 'field_563860c076fee',
                        'label' => 'Slide Caption Heading',
                        'name' => 'slide_caption_heading',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ),
                    array (
                        'key' => 'field_563860d576ff0',
                        'label' => 'Slide Caption',
                        'name' => 'slide_caption',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ),
                    array (
                        'key' => 'field_5638617a4b874',
                        'label' => 'Slide Button Text',
                        'name' => 'slide_caption_button_text',
                        'type' => 'text',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'default_value' => '',
                        'placeholder' => '',
                        'prepend' => '',
                        'append' => '',
                        'maxlength' => '',
                        'readonly' => 0,
                        'disabled' => 0,
                    ),
                ),
            ),
        ),
        'location' => array (
            array (
                array (
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'slider',
                ),
            ),
        ),
        'menu_order' => 1,
        'position' => 'acf_after_title',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => 1,
        'description' => '',
    ));

endif;

// Add the slider to the wp rest api

// function slider_rest_args() {
//     global $wp_post_types;
//     $wp_post_types['slider']->show_in_rest = true;
//     $wp_post_types['slider']->rest_base = 'slider';
//     $wp_post_types['slider']->rest_controller_class = 'WP_REST_Posts_Controller';
// }
// add_action( 'init', 'slider_rest_args', 30 );
