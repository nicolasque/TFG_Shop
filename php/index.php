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
  </main>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> Your Website. All rights reserved.</p>
  </footer>
</body>
</html>