
window.onload = function()
{
    
    ft_send_message();
    var chatBox = document.getElementById('chat-box');
    chatBox.scrollTop = chatBox.scrollHeight;

    ft_get_chat_messages();
    setInterval(function() {
        ft_get_chat_messages();
    }, 1000);


};



function ft_send_message()
{
    document.getElementById('send-button').addEventListener('click', function() {
        var messageText = document.getElementById('message-text').value;
        // Aquí puedes añadir el código para enviar el mensaje

        var message = {
            "chat_id": document.getElementById('chat_id').textContent,
            "user_id_buyer": document.getElementById('user_id_buyer').textContent,
            // "user_id_seller": document.getElementById('user_id_seller').textContent,
            "message": messageText
        };
        if (messageText == "")
        {
            return (false);
        }
        $.ajax(
                {
                    type: "POST",
                    url: "/tfg_shop/php/ajax/ajax_send_message.php",
                    data: message,
                    success: function(response)
                    {
                        console.log(response);
                        if (response == "true")
                        {
                            // alert("Mensaje enviado");
                            document.getElementById('message-text').value = "";
                            location.reload();
      

                        }
                        else
                        {
                            // Que recoja el mensaje de error que devuelve el servidor
                            alert("Error al enviar mensaje");
                        }
                    }
                });
    });
}


function ft_get_chat_messages()
{
        $.ajax({
            url: '/tfg_shop/php/ajax/ajax_get_messages.php', // Ruta al archivo PHP que ejecuta ft_get_chat_messages
            type: 'POST',
            data: {
                chat_id: $('#chat_id').text() // Pasa el ID del chat al archivo PHP
            },
            success: function(data) {
                console.log(data);
                $('#chat-box').html(data); // Actualiza el contenido del chat con los nuevos mensajes
                var chatBox = document.getElementById('chat-box');
                chatBox.scrollTop = chatBox.scrollHeight; // Desplaza el chat hasta el final
            }
        });
}