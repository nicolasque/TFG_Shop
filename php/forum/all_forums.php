<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.3/css/bulma.min.css">
    <title>Forum Information</title>
</head>
<body>
    <?php include '../navbar.php'; ?>
    <section class="section">
        <div class="container">
            <a href="create_forum.php" class="button is-primary">Create Forum</a>
            <h1 class="title">Forum Information</h1>
            
            <div class="columns">
                <div class="column">
                    <div class="box">
                        <h2 class="subtitle">Forum 1</h2>
                        <p>Description of Forum 1</p>
                        <p>Active Users: 10</p>
                    </div>
                </div>
                
                <div class="column">
                    <div class="box">
                        <h2 class="subtitle">Forum 2</h2>
                        <p>Description of Forum 2</p>
                        <p>Active Users: 5</p>
                    </div>
                </div>
                
                <div class="column">
                    <div class="box">
                        <h2 class="subtitle">Forum 3</h2>
                        <p>Description of Forum 3</p>
                        <p>Active Users: 8</p>
                    </div>
                </div>
            </div>
            
        </div>
    </section>
</body>
</html>