<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Website Name - Products</title>
  <script src="../js/jquery.js"></script>
  <!-- <script src="../js/script.js"></script> -->


  <style>
        .col ,table {
            border-collapse: collapse;
            width: 100%;
        }
        #col th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
<?php include 'navbar.php'; ?>


  <main class="container mt-3">
    <h2>Our Productsaaaaaa</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
      <div class="col">
        <div class="card">
          <img src="product1.jpg" class="card-img-top" alt="Product 1">
          <div class="card-body">
            <h5 class="card-title">Product 1</h5>
            <p class="card-text">A short description of product 1.</p>
            <a href="#" class="btn btn-primary">View Details</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="product2.jpg" class="card-img-top" alt="Product 2">
          <div class="card-body">
            <h5 class="class="card-title">Product 2</h5>
            <p class="card-text">A short description of product 2.</p>
            <a href="#" class="btn btn-primary">View Details</a>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <img src="product3.jpg" class="card-img-top" alt="Product 3">
          <div class="card-body">
            <h5 class="card-title">Product 3</h5>
            <p class="card-text">A short description of product 3.</p>
            <a href="#" class="btn btn-primary">View Details</a>
          </div>
        </div>
      </div>
      </div>

      <?php
    if(isset($_COOKIE["user_id"]) && isset($_COOKIE["username"]) && isset($_COOKIE["name"]) && isset($_COOKIE["surname"]) && isset($_COOKIE["email"]))
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

    }
    ?>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVFQWjxhNqjvETaGhwjtC0zI9IjtgBsVlhRPVmIk0sF81tZNyWuh" crossorigin="anonymous"></script>


</body>
</
