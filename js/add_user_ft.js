
$(document).ready(function () {

    //Funcion aqui TENGO QUE AÑADIR LAS FUNCINALIDAD DEL ENVIAR
    document.getElementById('add_user_form').addEventListener('submit', function(event) {
        event.preventDefault();
        ft_add_user(event);

    }, false);


});


function check_password(password, confirm_password)
{
    if (password != confirm_password)
    {
        alert("Las contraseñas no coinciden");
        return (false);
    }
    if (password.length < 8)
    {
        alert("La contraseña debe tener al menos 8 caracteres");
        return (false);
    }
    if (password.search(/[a-z]/) < 0)
    {
        alert("La contraseña debe tener al menos una letra minúscula");
        return (false);
    }
    if (password.search(/[A-Z]/) < 0)
    {
        alert("La contraseña debe tener al menos una letra mayúscula");
        return (false);
    }
    if (password.search(/[0-9]/) < 0)
    {
        alert("La contraseña debe tener al menos un número");
        return (false);
    }
    return (true);
}


function ft_add_user(event)
{ 

    var user_info = {
        "username": document.getElementById('username').value,
        "name": document.getElementById('name').value,
        "surname": document.getElementById('surname').value,
        "email": document.getElementById('email').value,
        "password": document.getElementById('password').value,
        "confirm_password": document.getElementById('confirm_password').value,
    };
    if (check_password(user_info.password, user_info.confirm_password) == false)
    {
        return;
    }
        
    $.ajax({
        type: "POST",
        url: "../php/ajax/add_user_table.php",
        data: user_info,
        success: function(data) {
            $('#message').html(data);
            // if (data == "OK")
            // {
            //     alert("Usuario añadido correctamente");

            //     // location.reload();
            // }
            // else
            // {
            //     alert("Error al añadir usuario");
            // }
        }

    });

}
