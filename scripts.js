console.log("pre pre s");
jQuery(document).ready(function($) {
    
    // Al hacer clic en el botón de WhatsApp
    $('#wfb-button').on('click', function() {
        // Mostrar/ocultar el formulario
        $('#wfb-form-container').toggle();
    });

    // Función para enviar el mensaje a WhatsApp
    console.log("script working 222222 !!")
    // Función para ocultar el formulario
    function ocultarFormulario() {
        $('#formulario_whatsapp-form-chat').hide();
    }

    // Función para limpiar los inputs del formulario


    function enviarMensaje(event) {
        console.log("enviarMensaje");
        event.preventDefault();

        // Capturar los valores del formulario
        var nombre = $("#formulario_whatsapp-form-chat input[name='nombre-wsp']").val();
        var email = $("#formulario_whatsapp-form-chat input[name='email-wsp']").val();
        var telefono = $("#formulario_whatsapp-form-chat input[name='telefono-wsp']").val();

        // Generar el mensaje con formato adecuado
        var mensaje = "*¡Hola!* Mi nombre es " + nombre +
            ", mi email: " + email + ", mi teléfono: " + telefono + ". Quisiera ponerme en contacto con ustedes.";

        // Generar la URL de redirección con los parámetros del mensaje
        var telefonoDestino = "+51955099599";
        var url = "https://api.whatsapp.com/send?phone=" + telefonoDestino + "&text=" + encodeURIComponent(mensaje);

        // Guardamos en un objeto
        const data = {
            nombre: nombre,
            email: email,
            telefono: telefono,
            fecha: new Date(),
        };

        // Enviar datos al webhook
        fetch('https://hook.us1.make.com/12pntsu5ax35818q91v9pyvqymgull9t', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        })
        .then(response => {
            if (response.ok) {
                console.log('Datos enviados correctamente al webhook.');
            } else {
                console.log('Ocurrió un error al enviar los datos al webhook.');
            }
        })
        .catch(error => {
            console.log('Error en la solicitud al webhook:', error);
        });
        
                // Abrir la URL de WhatsApp en una nueva pestaña
        ocultarFormulario();
        limpiarInputs();
        console.log("enviarMensaje 2");
        window.open("https://nuevalima.com/gracias-por-contactarnos/", "_blank");
    }
	
    // Función para mostrar el formulario
    $('#wfb-button').on('click', function() {
        $('#formulario_whatsapp-form-chat').toggle();
    });
	$('#formulario_whatsapp-form-chat__cerrar').on('click', function(){
    	ocultarFormulario();
    })
    function mostrarDiv() {
        var div = document.getElementById("formulario_whatsapp-form-chat");
        div.classList.toggle("mostrado");
    }
    function ocultarDiv() {
        var div = document.getElementById("formulario_whatsapp-form-chat");
        div.classList.remove("mostrado");
    }

    function limpiarInputs() {
        document.getElementById("nombre-wsp").value = "";
        document.getElementById("email-wsp").value = "";
        document.getElementById("telefono-wsp").value = "";
    }

    // Evento al enviar el formulario
    document.querySelector("#formulario_whatsapp-form-chat").addEventListener("submit",(event)=>{
    	enviarMensaje(event);
    })
    
});