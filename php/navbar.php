<link rel="stylesheet" href="/tfg_shop/css/navbar.css">


<?php

	function ft_display_loged()
	{
		echo "<li class='nav-item'>";
		echo "<a class='nav-link' href='/tfg_shop/php/account.php'>Account</a>";
		echo "</li>";
		echo "<li class='nav-item'>";
		echo "<a class='nav-link' href='/tfg_shop/php/functions/logout.php'>Logout</a>";
		echo "</li>";
		if(ft_is_admin() == true)
		{
			echo "<li class='nav-item'>";
			echo "<a class='nav-link' href='/tfg_shop/php/admin/admin_page.php'>Admin Page</a>";
			echo "</li>";
		}
	}

	function ft_display_not_loged()
	{
		echo "<li class='nav-item'>";
		echo "<a class='nav-link' href='/tfg_shop/php/login.php'>Login</a>";
		echo "</li>";
		echo "<li class='nav-item'>";
		echo "<a class='nav-link' href='/tfg_shop/php/create_user.php'>Create user</a>";
	 	echo "</li>";
	}

	function ft_if_user_is_logged()
	{
		if(isset($_COOKIE["user_id"]) && isset($_COOKIE["username"]) && isset($_COOKIE["name"]) && isset($_COOKIE["surname"]) && isset($_COOKIE["email"]))
			return (true);
		else
			return (false);
	}

	function	ft_is_admin()
	{
		if(isset($_COOKIE["admin"]) && $_COOKIE["admin"] == 1)
			return (true);
		else
			return (false);
	}

?>

<nav class="navbar">
	<div class="navbar-container">
	  <a class="navbar-brand" href="#">In shop</a>
	  <div class="navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav">
		  <li class="nav-item">
			<a class="nav-link" href="#">Home</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="/tfg_shop/php/index.php">Products</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="#">Contact</a>
		  </li>

		  <?php
			if(ft_if_user_is_logged() == true)
				ft_display_loged();
			else
				ft_display_not_loged();
		  ?>
		</ul>
	  </div>
	</div>
</nav>
  </nav>
