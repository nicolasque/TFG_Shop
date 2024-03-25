document.addEventListener("DOMContentLoaded", function() {

    //Funcion aqui TENGO QUE AÑADIR LAS FUNCINALIDAD DEL ENVIAR
    document.getElementById('login_form').addEventListener('submit', function(event)
    {
        event.preventDefault();
        ft_check_login(event);
    }, false);

});

function ft_check_login(event)
{
    var login_information = {
        "username": document.getElementById('username').value,
        "password": document.getElementById('password').value,
    };
    if (username == "" || password == "")
    {
        alert("Usuario o contraseña vacíos");
        return (false);
    }

 
    $.ajax(
    {
        type: "POST",
        url: "../php/ajax/ajax_login.php",
        data: login_information,
        success: function(response)
        {
            console.log(response);
            if (response == "true")
            {
                window.location.href = "index.php";
            }
            else
            {
                alert("Usuario o contraseña incorrectos");
            }
        }
    });

    return (true);
}