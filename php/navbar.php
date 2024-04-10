<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">


<?php

function ft_display_loged()
{
	echo "<a class='navbar-item' href='/tfg_shop/php/my_account.php'>My Account</a>";
	echo "<a class='navbar-item' href='/tfg_shop/php/add_product.php'>Add product</a>";
	echo "<a class='navbar-item' href='/tfg_shop/php/chat/my_messages.php'>Messages</a>";
	if (ft_is_admin() == true) {
		echo "<a class='navbar-item button is-infor is-small ' href='/tfg_shop/php/admin/admin_header.php'>Admin Page</a>";
	}
	echo "<a class='button is-danger is-small is-inverted' href='/tfg_shop/php/functions/logout.php'>Logout</a>";
}

function ft_display_not_loged()
{
	echo "<a class='button is-light  ' href='/tfg_shop/php/login.php'>Login</a>";
	echo "<a class='button is-primary' href='/tfg_shop/php/create_user.php'>Create user</a>";
}

function ft_if_user_is_logged()
{
	if (isset($_COOKIE["user_id"]) && isset($_COOKIE["username"]) && isset($_COOKIE["name"]) && isset($_COOKIE["surname"]) && isset($_COOKIE["email"]))
		return (true);
	else
		return (false);
}

function	ft_is_admin()
{
	if (isset($_COOKIE["admin"]) && $_COOKIE["admin"] == 1)
		return (true);
	else
		return (false);
}

?>


<div class="container is-fluid">
	<!-- <div class="notification is-primary"> -->



	<nav class="navbar" role="navigation" aria-label="main navigation">
		<div class="navbar-brand">
			<a class="navbar-item" href="/tfg_shop/php/index.php">
				<img src="/tfg_shop/images/page/ena2.png" width="60" height="190">
			</a>


			<div id="navbar" class="navbar-menu">
				<div class="navbar-start">
					<a class="navbar-item" href="/tfg_shop/php/index.php">Home</a>

					<a class="navbar-item" href="/tfg_shop/php/all_products_page.php">Products</a>


					<?php
					if (ft_if_user_is_logged() == true)
						ft_display_loged();
					?>

				</div>
				<div class="navbar-end">
					<div class="navbar-item">
						<div class="buttons">
							<?php
							if (ft_if_user_is_logged() == false)
								ft_display_not_loged();
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</nav>


</div>
</div>