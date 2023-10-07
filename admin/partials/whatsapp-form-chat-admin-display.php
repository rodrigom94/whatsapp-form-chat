<?php

// Verifica si el usuario tiene los permisos adecuados
if ( ! current_user_can( 'manage_options' ) ) {
    return;
}

?>

<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    <form method="post" action="options.php">
        <?php
            // Agrega campos de configuración aquí
            settings_fields( 'whatsapp_form_chat_options_group' );
            do_settings_sections( 'whatsapp_form_chat' );
            submit_button();
        ?>
    </form>
</div>