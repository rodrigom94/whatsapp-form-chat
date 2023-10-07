<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wppb.me
 * @since             1.0.0
 * @package           Whatsapp_Form_Chat
 *
 * @wordpress-plugin
 * Plugin Name:       Whatsapp Form Chat
 * Plugin URI:        https://wppb.me
 * Description:       This is a description of the plugin.
 * Version:           1.0.0
 * Author:            The Rod
 * Author URI:        https://wppb.me/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       whatsapp-form-chat
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WHATSAPP_FORM_CHAT_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-whatsapp-form-chat-activator.php
 */
function activate_whatsapp_form_chat() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-whatsapp-form-chat-activator.php';
	Whatsapp_Form_Chat_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-whatsapp-form-chat-deactivator.php
 */
function deactivate_whatsapp_form_chat() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-whatsapp-form-chat-deactivator.php';
	Whatsapp_Form_Chat_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_whatsapp_form_chat' );
register_deactivation_hook( __FILE__, 'deactivate_whatsapp_form_chat' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-whatsapp-form-chat.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_whatsapp_form_chat() {

	$plugin = new Whatsapp_Form_Chat();
	$plugin->run();

}
run_whatsapp_form_chat();

/*
Plugin Name: Botón Flotante de WhatsApp
Description: Plugin para agregar un botón flotante de WhatsApp en la esquina inferior derecha.
Version: 1.0
Author: Tu Nombre
*/
           
// Código para agregar estilos y scripts
function wfb_enqueue_scripts() {
    wp_enqueue_script('intl-tel-input', 'https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js', array(), '17.0.8', true);
    wp_enqueue_style('wfb-styles', plugin_dir_url(__FILE__) . 'styles_v001.css');
    wp_enqueue_script('wfb-scripts', plugin_dir_url(__FILE__) . 'scripts.js', array('jquery'), '1.0.14', true);
}
add_action('wp_enqueue_scripts', 'wfb_enqueue_scripts');

// Código para agregar el botón y el formulario en el pie de página
// Código para agregar el botón y el formulario en el pie de página
function wfb_add_button() {
    $whatsapp_logo_url = plugin_dir_url(__FILE__) . 'public/whatsapp_logo.png';
    ?>
    <div id="wfb-container">
        <button id="wfb-button">
            <img src="<?php echo esc_url($whatsapp_logo_url); ?>" alt="WhatsApp" width="24" height="24">
        </button>
        <form id="formulario_whatsapp-form-chat" class="formulario_whatsapp-form-chat">
            <div class="cerrar" id="formulario_whatsapp-form-chat__cerrar" >x</div>
            <div class="cabecera" style="display:none">
            </div>
            <p>Para poder atenderte es necesario nos brindes tus datos</p>
            <div class="box-input">
                <input name="nombre-wsp" id="nombre-wsp" type="text" required="" placeholder="Nombres y Apellidos*">
            </div>
            <div class="box-input">
                <input name="telefono-wsp" id="telefono-wsp" type="tel" required="" placeholder="Celular*">
            </div>
            <div class="box-input">
                <input name="email-wsp" id="email-wsp" type="email" placeholder="Correo Electrónico ">
            </div>
            <button id="submit" type="submit" class="boton"><i class="fab fa-whatsapp"></i>Iniciar chat</button>
        </form>
    </div>

    <?php
}
add_action('wp_footer', 'wfb_add_button');