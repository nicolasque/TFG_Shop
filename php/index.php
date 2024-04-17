<?php

include 'create_conexion.php';

function ft_send_report($name, $email, $message)
{
	$connexion = ft_create_conexion();
	$sql = "INSERT INTO admin_report (name, email, message) VALUES (?, ?, ?)";
	$stmt = $connexion->prepare($sql);
	$stmt->bind_param("sss", $name, $email, $message);
	$stmt->execute();
	$connexion->close();
	if ($stmt->affected_rows > 0)
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}


if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$name = $_POST['name'];
	$email = $_POST['email'];
	$message = $_POST['message'];

	if (ft_send_report($name, $email, $message) == TRUE)
	{
		header("Location: index.php");
		echo "Mensaje enviado con exito";
	}
	else
	{
		echo "Error al enviar mensjae";
	}
}


?>


<!DOCTYPE html>
<html>

<head>
	<title>Welcome to Your Website</title>
</head>

<body>
	<?php include 'navbar.php'; ?>
	<section class="hero is-primary is-bold">
		<div class="hero-body">
			<div class="container">
				<h1 class="title">Bien benido In shop</h1>
				<h2 class="subtitle">La tienda donde todo se puede compar y vender!</h2>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<h2 class="title">Caracteristicas</h2>
			<div class="columns">
				<div class="column">
					<h3 class="subtitle">Compra con confianza</h3>
					<p>Dispones de un chat para conocer a los vendeodres.</p>
				</div>
				<div class="column">
					<h3 class="subtitle">Reutiliza</h3>
					<p>Da le una nueva vida a productos que ya no utilices en tu casa.</p>
				</div>
			</div>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<h2 class="title">Opiniones de clientes</h2>
			<article class="message">
				<div class="message-body">
					Esta pagina es la mejor del secto -Un cliente sadisfecho :)
				</div>
			</article>
		</div>
	</section>

	<section class="section">
		<div class="container">
			<h2 class="title">Contacta con nosotros</h2>
			<form method="POST" >
				<div class="field">
					<label class="label" for="name">Nombre</label>
					<div class="control">
						<input class="input" type="text" id="name" name="name">
					</div>
				</div>
				<div class="field">
					<label class="label" for="email">Email</label>
					<div class="control">
						<input class="input" type="email" id="email" name="email">
					</div>
				</div>
				<div class="field">
					<label class="label" for="message">Mensaje</label>
					<div class="control">
						<textarea class="textarea" id="message" name="message"></textarea>
					</div>
				</div>
				<div class="field">
					<div class="control">
						<button class="button is-link">Enviar</button>
					</div>
				</div>
			</form>
		</div>
	</section>

	<?php include 'footer.php'; ?>
</body>

</html>