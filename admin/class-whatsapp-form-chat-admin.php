<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wppb.me
 * @since      1.0.0
 *
 * @package    Whatsapp_Form_Chat
 * @subpackage Whatsapp_Form_Chat/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Whatsapp_Form_Chat
 * @subpackage Whatsapp_Form_Chat/admin
 * @author     The Rod <rod@gmail.com>
 */
class Whatsapp_Form_Chat_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'register_plugin_settings' ) );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Whatsapp_Form_Chat_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Whatsapp_Form_Chat_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/whatsapp-form-chat-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Whatsapp_Form_Chat_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Whatsapp_Form_Chat_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/whatsapp-form-chat-admin.js', array( 'jquery' ), $this->version, false );

	}
    public function add_plugin_admin_menu() {
        add_options_page(
            'Configuración de Whatsapp Form Chat', // Título de la página
            'Whatsapp Form Chat', // Título del menú
            'manage_options', // Capacidad
            $this->plugin_name, // Slug del menú
            array( $this, 'display_plugin_admin_page' ) // Función de callback
        );
    }

    public function display_plugin_admin_page() {
        include_once( 'partials/' . $this->plugin_name . '-admin-display.php' );
    }

	public function register_plugin_settings() {
		register_setting( 'whatsapp_form_chat_options_group', 'whatsapp_form_chat_option_name' );

		// Opciones Configuración ----------------------------
		add_settings_section(
			'whatsapp_form_chat_options_section',
			'Modificación de campos',
			array( $this, 'whatsapp_form_chat_options_section_callback' ),
			'whatsapp_form_chat'
		);
		
		// Nombre de Empresa
		add_settings_field(
			'whatsapp_form_chat_option_name',
			'Nombre de Empresa',
			array( $this, 'whatsapp_form_chat_option_name_callback' ),
			'whatsapp_form_chat',
			'whatsapp_form_chat_options_section'
		);

		// Número de Teléfono
		add_settings_field(
			'whatsapp_form_chat_option_telefono_destino',
			'Número de Whatsapp<br>(incluir prefijo país como 51)',
			array( $this, 'whatsapp_form_chat_option_telefono_destino_callback' ),
			'whatsapp_form_chat',
			'whatsapp_form_chat_options_section'
		);

		// Opciones Form ----------------------------

		// Texto en Campo Nombre
		add_settings_field(
			'whatsapp_form_chat_option_form_nombre',
			'Texto en Nombre',
			array( $this, 'whatsapp_form_chat_option_form_nombre_callback' ),
			'whatsapp_form_chat',
			'whatsapp_form_chat_options_section'
		);
		// Texto en Campo Celular
		add_settings_field(
			'whatsapp_form_chat_option_form_telefono',
			'Texto en Celular',
			array( $this, 'whatsapp_form_chat_option_form_telefono_callback' ),
			'whatsapp_form_chat',
			'whatsapp_form_chat_options_section'
		);
		// Texto en Campo Email
		add_settings_field(
			'whatsapp_form_chat_option_form_email',
			'Texto en Email',
			array( $this, 'whatsapp_form_chat_option_form_email_callback' ),
			'whatsapp_form_chat',
			'whatsapp_form_chat_options_section'
		);

	}

	// Opciones Configuración
	public function whatsapp_form_chat_options_section_callback() {
		echo 'Actualice y guarde los siguientes campos del formulario flotante.';
	}
	
	public function whatsapp_form_chat_option_name_callback() {
		$option_value = get_option( 'whatsapp_form_chat_option_name' );
		echo '<input type="text" name="whatsapp_form_chat_option_name" value="' . esc_attr( $option_value ) . '">';
	}

	public function whatsapp_form_chat_option_telefono_destino_callback() {
		$option_value = get_option( 'whatsapp_form_chat_option_telefono_destino' );
		echo '<input type="text" name="whatsapp_form_chat_option_telefono_destino" value="' . esc_attr( $option_value ) . '">';
	}

	// Opciones Form
	public function whatsapp_form_chat_option_form_nombre_callback() {
		$option_value = get_option( 'whatsapp_form_chat_option_form_nombre' );
		echo '<input type="text" name="whatsapp_form_chat_option_form_nombre" placeholder="Nombre" value="' . esc_attr( $option_value ) . '">';
	}
	public function whatsapp_form_chat_option_form_telefono_callback() {
		$option_value = get_option( 'whatsapp_form_chat_option_form_telefono' );
		echo '<input type="text" name="whatsapp_form_chat_option_form_telefono" placeholder="Celular" value="' . esc_attr( $option_value ) . '">';
	}
	public function whatsapp_form_chat_option_form_email_callback() {
		$option_value = get_option( 'whatsapp_form_chat_option_form_email' );
		echo '<input type="text" name="whatsapp_form_chat_option_form_email" placeholder="Email" value="' . esc_attr( $option_value ) . '">';
	}
}
