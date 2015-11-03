<?php
/**
 * Clovemix Theme Customizer
 *
 * @package Clovemix
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function clovemix_customize_register( $wp_customize ) {
	
class WP_Customize_Textarea_Control extends WP_Customize_Control {
    public $type = 'textarea';
 
    public function render_content() {
        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
            </label>
        <?php
    }
}

//Add a class for titles
    class Clovemix_Info extends WP_Customize_Control {
        public $type = 'info';
        public $label = '';
        public function render_content() {
        ?>
			<h3 style="text-decoration: underline; color: #DA4141; text-transform: uppercase;"><?php echo esc_html( $this->label ); ?></h3>
        <?php
        }
    }
	
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	
	$wp_customize->remove_control('header_textcolor');
	$wp_customize->remove_section('header_image');
	
	$wp_customize->add_section(
        'logo_sec',
        array(
            'title' => __('Logo (PRO Version)', 'clovemix'),
            'priority' => 1,
            'description' => __('<strong>Logo and favicon Settings available in <a href="'.esc_url(pro_theme_url).'" target="_blank">PRO Version</a>.</strong>','clovemix'),
        )
    );  
    $wp_customize->add_setting('Clovemix_options[font-info]', array(
			'sanitize_callback' => 'sanitize_text_field',
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
        )
    );
    $wp_customize->add_control( new Clovemix_Info( $wp_customize, 'logo_section', array(
        'section' => 'logo_sec',
        'settings' => 'Clovemix_options[font-info]',
        'priority' => null
        ) )
    );
	
	$wp_customize->add_section('opacity',array(
			'title'	=> __('Background Opacity (PRO Version)','clovemix'),
			'description'	=> __('<strong>Background opacity available in <a href="'.esc_url(pro_theme_url).'">PRO Version</a></strong>'),
			'priority'	=> 2
	));
	
	$wp_customize->add_setting('bg_opacity',array(
			'sanitize_callback'	=> 'sanitize_text_field',
			'type'	=> 'info-control',
			'capability'	=> 'edit_theme_options'
	));
	
	$wp_customize->add_control(
		new Clovemix_Info(
			$wp_customize,
			'bg_opacity',
			array(
				'setting'	=> 'bg_opacity',
				'section'	=> 'opacity'
			)
		)
	);
	
	$wp_customize->add_setting('color_scheme', array(
		'default' => '#00d27f',
		'sanitize_callback'	=> 'sanitize_hex_color',
	));
	
	$wp_customize->add_control(
		new WP_Customize_Color_Control($wp_customize,'color_scheme',array(
			'label' => __('Color Scheme','clovemix'),
			'description'	=> '<strong>More color options in <a href="'.esc_url(pro_theme_url).'" target="_blank">PRO version</a></strong>',
			'section' => 'colors',
			'settings' => 'color_scheme'
		))
	);
	
	$wp_customize->add_section('social_section',array(
		'title'	=> __('Social Links','clovemix'),
		'description'	=> 'Add your social links here. <br><strong>More social links in <a href="'.esc_url(pro_theme_url).'" target="_blank">PRO version</a>.</strong>',
		'priority'		=> null
	));
	
	$wp_customize->add_setting('fb_link',array(
		'default'	=> '#facebook',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	
	$wp_customize->add_control('fb_link',array(
		'label'	=> __('Facebook Link','clovemix'),
		'section'	=> 'social_section',
		'type'		=> 'text'
	));
	
	$wp_customize->add_setting('twitt_link',array(
		'default'	=> '#twitter',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	
	$wp_customize->add_control('twitt_link',array(
		'label'	=> __('Twitter Link','clovemix'),
		'section'	=> 'social_section',
		'type'		=> 'text'
	));
	
	$wp_customize->add_setting('in_link',array(
		'default'	=> '#linkedin',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	
	$wp_customize->add_control('in_link',array(
		'label'	=> __('Linkedin Link','clovemix'),
		'section'	=> 'social_section',
		'type'		=> 'text'
	));
	
	$wp_customize->add_setting('gplus_link',array(
		'default'	=> '#gplus',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	
	$wp_customize->add_control('gplus_link',array(
		'label'	=> __('Gplus Link','clovemix'),
		'section'	=> 'social_section',
		'type'		=> 'text'
	));
	
	$wp_customize->add_setting('flickr_link',array(
		'default'	=> '#flickr',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	
	$wp_customize->add_control('flickr_link',array(
		'label'	=> __('Flickr Link','clovemix'),
		'section'	=> 'social_section',
		'type'		=> 'text'
	));
	
	$wp_customize->add_section('header_contact', array(
		'title'	=> __('Header Contact','clovemix'),
		'description' => __('Add your contact details here','clovemix'),
		'priority'	=> null
	));
	
	$wp_customize->add_setting('mail_textbox',array(
		'default'	=> 'demo@domain.com',
		'sanitize_callback'	=> 'sanitize_email',
	));
	
	$wp_customize->add_control('mail_textbox',array(
		'label'	=> __('Email','clovemix'),
		'section'	=> 'header_contact',
		'type'		=> 'text'
	));
	
	$wp_customize->add_setting('phone_textbox',array(
		'default'	=> '+91 123 456 789',
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	
	$wp_customize->add_control('phone_textbox',array(
		'label'	=> __('Phone Number','clovemix'),
		'section'	=> 'header_contact',
		'type'		=> 'text'
	));
	
	$wp_customize->add_section('slider_section',array(
		'title'	=> __('Slider Settings','clovemix'),
		'description'	=> __('Add slider images here. <br><strong>More slider settings available in <a href="'.esc_url(pro_theme_url).'" target="_blank">PRO version</a>.</strong>','clovemix'),
		'priority'		=> null
	));
	
	// Slide Image 1
	$wp_customize->add_setting('slide_image1',array(
		'default'	=> get_template_directory_uri().'/images/slides/slide_01.jpg',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	
	$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'slide_image1',
        array(
            'label' => __('Slide Image 1 (1400x457)','clovemix'),
            'section' => 'slider_section',
            'settings' => 'slide_image1'
        )
    )
);

	$wp_customize->add_setting('slide_title1',array(
		'default'	=> 'Responsive Design',
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	
	$wp_customize->add_control('slide_title1',array(
		'label'	=> __('Slide Title 1','clovemix'),
		'section'	=> 'slider_section',
		'type'	=> 'text'
	));
	
	$wp_customize->add_setting('slide_desc1',array(
		'default'	=> 'This is description for slider one.',
		'sanitize_callback'	=> 'wp_htmledit_pre',
	));
	
	$wp_customize->add_control(
		new WP_Customize_Textarea_Control(
			$wp_customize,
			'slide_desc1',
			array(
				'label' => __('Slide Description 1','clovemix'),
				'section' => 'slider_section',
				'setting'	=> 'slide_desc1'
			)
		)
	);
	
	$wp_customize->add_setting('slide_link1',array(
		'default'	=> '#link1',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	
	$wp_customize->add_control('slide_link1',array(
		'label'	=> __('Slide Link 1','clovemix'),
		'section'	=> 'slider_section',
		'type'		=> 'text'
	));
	
	// Slide Image 2
	$wp_customize->add_setting('slide_image2',array(
		'default'	=> get_template_directory_uri().'/images/slides/slide_02.jpg',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	
	$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'slide_image2',
        array(
            'label' => __('Slide Image 2 (1400x457)','clovemix'),
            'section' => 'slider_section',
            'settings' => 'slide_image2'
        )
    )
);

	$wp_customize->add_setting('slide_title2',array(
		'default'	=> 'Flexible Design',
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	
	$wp_customize->add_control('slide_title2',array(
		'label'	=> __('Slide Title 2','clovemix'),
		'section'	=> 'slider_section',
		'type'	=> 'text'
	));
	
	$wp_customize->add_setting('slide_desc2',array(
		'default'	=> 'This is description for slide two',
		'sanitize_callback'	=> 'wp_htmledit_pre',
	));
	
	$wp_customize->add_control(
		new WP_Customize_Textarea_Control(
			$wp_customize,
			'slide_desc2',
			array(
				'label' => __('Slide Description 2','clovemix'),
				'section' => 'slider_section',
				'setting'	=> 'slide_desc2'
			)
		)
	);
	
	$wp_customize->add_setting('slide_link2',array(
		'default'	=> '#link2',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	
	$wp_customize->add_control('slide_link2',array(
		'label'	=> __('Slide Link 2','clovemix'),
		'section'	=> 'slider_section',
		'type'		=> 'text'
	));
	
	// Slide Image 3
	$wp_customize->add_setting('slide_image3',array(
		'default'	=> get_template_directory_uri().'/images/slides/slide_03.jpg',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	
	$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'slide_image3',
        array(
            'label' => __('Slide Image 3 (1400x457)','clovemix'),
            'section' => 'slider_section',
            'settings' => 'slide_image3'
        )
    )
);

	$wp_customize->add_setting('slide_title3',array(
		'default'	=> 'Awesome Features',
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	
	$wp_customize->add_control('slide_title3',array(
		'label'	=> __('Slide Title 3','clovemix'),
		'section'	=> 'slider_section',
		'type'	=> 'text'
	));
	
	$wp_customize->add_setting('slide_desc3',array(
		'default'	=> 'This is description for slide three',
		'sanitize_callback'	=> 'wp_htmledit_pre',
	));
	
	$wp_customize->add_control(
		new WP_Customize_Textarea_Control(
			$wp_customize,
			'slide_desc3',
			array(
				'label' => __('Slide Description 3','clovemix'),
				'section' => 'slider_section',
				'setting'	=> 'slide_desc3'
			)
		)
	);
	
	$wp_customize->add_setting('slide_link3',array(
		'default'	=> '#link3',
		'sanitize_callback'	=> 'esc_url_raw',
	));
	
	$wp_customize->add_control('slide_link3',array(
		'label'	=> __('Slide Link 3','clovemix'),
		'section'	=> 'slider_section',
		'type'		=> 'text'
	));
	
	// Page settings 
	$wp_customize->add_section('page_boxes',array(
		'title'	=> __('Homepage Boxes','clovemix'),
		'description'	=> __('Select Pages from the dropdown','clovemix'),
		'priority'	=> null
	));
	
	$wp_customize->add_setting(
    'page-setting1',
		array(
			'sanitize_callback' => 'clovemix_sanitize_integer',
		)
	);
 
	$wp_customize->add_control(
		'page-setting1',
		array(
			'type' => 'dropdown-pages',
			'label' => __('Choose a page for box one:','clovemix'),
			'section' => 'page_boxes',
		)
	);
	
	$wp_customize->add_setting(
    'page-setting2',
		array(
			'sanitize_callback' => 'clovemix_sanitize_integer',
		)
	);
	
	$wp_customize->add_control(
		'page-setting2',
		array(
			'type' => 'dropdown-pages',
			'label' => __('Choose a page for box Two:','clovemix'),
			'section' => 'page_boxes',
		)
	);
	
	$wp_customize->add_setting(
    'page-setting3',
		array(
			'sanitize_callback' => 'clovemix_sanitize_integer',
		)
	);
	
	$wp_customize->add_control(
		'page-setting3',
		array(
			'type' => 'dropdown-pages',
			'label' => __('Choose a page for box Three:','clovemix'),
			'section' => 'page_boxes',
		)
	);
	
	$wp_customize->add_setting(
    'page-setting4',
		array(
			'sanitize_callback' => 'clovemix_sanitize_integer',
		)
	);
	
	$wp_customize->add_control(
		'page-setting4',
		array(
			'type' => 'dropdown-pages',
			'label' => __('Choose a page for box Four:','clovemix'),
			'section' => 'page_boxes',
		)
	);
	
	$wp_customize->add_section('home_sec',array(
			'title'	=> __('Homepage Sections (PRO Version)','clovemix'),
			'description'	=> __('<strong>Homepage sections available in <a href="'.esc_url(pro_theme_url).'">PRO Version</a></strong>','clovemix'),
			'priority'	=> null
	));	
	
	$wp_customize->add_setting('homepage_sec[home-info]',array(
			'sanitize_callback'	=>	'sanitize_text_field',
			'type'	=> 'info_control',
			'capability'	=> 'edit_theme_options'
	));
	
	$wp_customize->add_control(
		new Clovemix_Info(
			$wp_customize,
			'homepage_sec[home-info]',
			array(
			'setting'	=> 'homepage_sec[home-info]',
			'section'	=> 'home_sec'
			)
		)
	);
	
	
	
	$wp_customize->add_section('footer_section',array(
		'title'	=> __('Footer Text','clovemix'),
		'description'	=> __('Add some text for footer like copyright etc.','clovemix'),
		'priority'	=> null
	));
	
	$wp_customize->add_setting('footer_copy',array(
		'default'	=> __('Clovemix 2015 | All Rights Reserved.','clovemix'),
		'sanitize_callback'	=> 'sanitize_text_field',
	));
	
	$wp_customize->add_control('footer_copy',array(
		'label'	=> __('Copyright Text','clovemix'),
		'section'	=> 'footer_section',
		'type'		=> 'text'
	));
	
	$wp_customize->add_setting('Clovemix_options[credit-info]', array(
			'sanitize_callback' => 'sanitize_text_field',
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
        )
    );
    $wp_customize->add_control( new Clovemix_Info( $wp_customize, 'cred_section', array(
        'section' => 'footer_section',
		'label'	=> __('To remove credit link upgrade to pro','clovemix'),
        'settings' => 'Clovemix_options[credit-info]',
        ) )
    );
	
	$wp_customize->add_section(
        'theme_layout_sec',
        array(
            'title' => __('Layout Settings (PRO Version)', 'clovemix'),
            'priority' => null,
            'description' => __('<strong>Layout Settings available in  <a href="'.esc_url(pro_theme_url).'" target="_blank">PRO Version</a>.</strong>','clovemix'),
        )
    );  
    $wp_customize->add_setting('Clovemix_options[layout-info]', array(
			'sanitize_callback' => 'sanitize_text_field',
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
        )
    );
    $wp_customize->add_control( new Clovemix_Info( $wp_customize, 'layout_section', array(
        'section' => 'theme_layout_sec',
        'settings' => 'Clovemix_options[layout-info]',
        'priority' => null
        ) )
    );
	
	$wp_customize->add_section(
        'theme_font_sec',
        array(
            'title' => __('Fonts Settings (PRO Version)', 'clovemix'),
            'priority' => null,
            'description' => __('<strong>Font Settings available in <a href="'.esc_url(pro_theme_url).'" target="_blank">PRO Version</a>.</strong>','clovemix'),
        )
    );  
    $wp_customize->add_setting('Clovemix_options[font-info]', array(
			'sanitize_callback' => 'sanitize_text_field',
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
        )
    );
    $wp_customize->add_control( new Clovemix_Info( $wp_customize, 'font_section', array(
        'section' => 'theme_font_sec',
        'settings' => 'Clovemix_options[font-info]',
        'priority' => null
        ) )
    );
	
    $wp_customize->add_section(
        'theme_doc_sec',
        array(
            'title' => __('Documentation &amp; Support', 'clovemix'),
            'priority' => null,
            'description' => __('For documentation and support check this link : <a href="'.esc_url(theme_doc).'" target="_blank">Clovemix Documentation</a>','clovemix'),
        )
    );  
    $wp_customize->add_setting('Clovemix_options[info]', array(
			'sanitize_callback' => 'sanitize_text_field',
            'type' => 'info_control',
            'capability' => 'edit_theme_options',
        )
    );
    $wp_customize->add_control( new Clovemix_Info( $wp_customize, 'doc_section', array(
        'section' => 'theme_doc_sec',
        'settings' => 'Clovemix_options[info]',
        'priority' => 10
        ) )
    );
	
	
}
add_action( 'customize_register', 'clovemix_customize_register' );

//Integer
function clovemix_sanitize_integer( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}	

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function clovemix_customize_preview_js() {
	wp_enqueue_script( 'clovemix_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'clovemix_customize_preview_js' );

function clovemix_css(){
		?>
        <style>
				#logo h1 a, 
				.social_icons h5,
				.social_icons a,
				a, 
				.tm_client strong,
				#footer a,
				#footer ul li:hover a, 
				#footer ul li.current_page_item a,
				h6,
				h5,
				.postmeta a:hover,
				h1,
				.sidebar-area ul li a:hover,
				.blog-post h3.entry-title,
				.woocommerce ul.products li.product .price{
					color:<?php echo get_theme_mod('color_scheme','#00d27f'); ?>;
				}
				.theme-default .nivo-controlNav a.active, 
				.slide_more a, 
				.readmore:hover, .wpcf7 form input[type='submit'], 
				p.sub input[type='submit'],
				.cf_button, 
				#commentform input#submit, 
				.mobile_nav a, 
				.pagination ul li span.current, 
				.pagination ul li:hover a, 
				.pagination ul li span.current, 
				.pagination ul li:hover a,
				form.search-form input[type="submit"]:hover{
					background-color:<?php echo get_theme_mod('color_scheme','#00d27f'); ?>;
				}
		</style>
	<?php }
add_action('wp_head','clovemix_css');

function clovemix_custom_customize_enqueue() {
	wp_enqueue_script( 'clovemix-custom-customize', get_template_directory_uri() . '/js/custom.customize.js', array( 'jquery', 'customize-controls' ), false, true );
}
add_action( 'customize_controls_enqueue_scripts', 'clovemix_custom_customize_enqueue' );