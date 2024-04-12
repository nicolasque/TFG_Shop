<!DOCTYPE html>
<html>

<head>
  <title>Welcome to Your Website</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
  <header>
    <?php include 'navbar.php'; ?>
    <h1>Welcome to Your Website</h1>

  </header>

  <main>
    <section>
      <h2>About Us</h2>
      <p>Add some information about your website here.</p>
    </section>

    <section>
      <h2>Services</h2>
      <p>Describe the services you offer on your website.</p>
    </section>

    <section>
      <h2>Contact Us</h2>
      <p>Provide contact information for users to reach out to you.</p>
    </section>

    <?php
    if (isset($_COOKIE["user_id"]) && isset($_COOKIE["username"]) && isset($_COOKIE["name"]) && isset($_COOKIE["surname"]) && isset($_COOKIE["email"]))
    {
      echo "Cookies are set!<br>";
      echo "user_id: " . $_COOKIE["user_id"] . "<br>";
      echo "username: " . $_COOKIE["username"] . "<br>";
      echo "name: " . $_COOKIE["name"] . "<br>";
      echo "surname: " . $_COOKIE["surname"] . "<br>";
      echo "email: " . $_COOKIE["email"] . "<br>";
    }
    else
    {
      echo "Cookies are not set!";

    } ?>

  </main>
</body>
<?php include 'footer.php'; ?>

</html>