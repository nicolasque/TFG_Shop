

window.onload = function() {
    
    // var message = {
    //     "chat_id": document.getElementById('chat_id').textContent,
    //     "user_id_buyer": document.getElementById('user_id_buyer').textContent,
    //     "user_id_seller": document.getElementById('user_id_seller').textContent,
    //     // "message": messageText
    // };
    // console.log(message);
    ft_send_message();

    // document.addEventListener('DOMContentLoaded', (event) =>
    // {
    //     let chatBox = document.getElementById('chat-box');
    //     chatBox.scrollTop = chatBox.scrollHeight;
    // });
};



function ft_send_message()
{
    document.getElementById('send-button').addEventListener('click', function() {
        var messageText = document.getElementById('message-text').value;
        // Aquí puedes añadir el código para enviar el mensaje

        var message = {
            "chat_id": document.getElementById('chat_id').textContent,
            "user_id_buyer": document.getElementById('user_id_buyer').textContent,
            "user_id_seller": document.getElementById('user_id_seller').textContent,
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