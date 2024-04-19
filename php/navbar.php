
<?php

function ft_display_loged()
{
	echo "<a class='navbar-item' href='/tfg_shop/php/my_account.php'>Mi cuenta</a>";
	echo "<a class='navbar-item' href='/tfg_shop/php/product/add_product.php'>Añadir producto</a>";
	echo "<a class='navbar-item' href='/tfg_shop/php/chat/my_messages.php'>Mensajes</a>";
	echo "<a class='navbar-item' href='/tfg_shop/php/forum/all_forums.php?forum_id=null'>Forums</a>";
	if (ft_is_admin() == TRUE)
	{
		echo "<a class='navbar-item button is-infor is-small ' href='/tfg_shop/php/admin/admin_header.php'>Admin Page</a>";
	}
	echo "<a class='button is-danger is-small is-inverted' href='/tfg_shop/php/functions/logout.php'>Logout</a>";
}

function ft_display_not_loged()
{
	echo "<a class='button is-light  ' href='/tfg_shop/php/login.php'>Login</a>";
	echo "<a class='button is-primary' href='/tfg_shop/php/create_user.php'>Crear usuario</a>";
}

function ft_if_user_is_logged()
{
	if (isset($_COOKIE["user_id"]) && isset($_COOKIE["username"]) && isset($_COOKIE["name"]) && isset($_COOKIE["surname"]) && isset($_COOKIE["email"]))
		return (TRUE);
	else
		return (FALSE);
}

function ft_is_admin()
{
	if (isset($_COOKIE["admin"]) && $_COOKIE["admin"] == 1)
		return (TRUE);
	else
		return (FALSE);
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/tfg_shop/css/navbar.css">
    <link rel="stylesheet" href="/tfg_shop/css/bulma.min.css">
    <title>Barra de Navegación</title>
</head>
<body>
<div class="container is-fluid">
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="/tfg_shop/php/index.php">
                <img src="/tfg_shop/images/page/logo.png" width="60" height="60" alt="Logo">
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbar">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbar" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="/tfg_shop/php/index.php">Inicio</a>
                <a class="navbar-item" href="/tfg_shop/php/product/all_products_page.php">Productos</a>
                <?php if (ft_if_user_is_logged() == TRUE) ft_display_loged(); ?>
            </div>

            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <?php if (ft_if_user_is_logged() == FALSE) ft_display_not_loged(); ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>
</body>
<script src="/tfg_shop/js/navbar.js"></script>

</html>