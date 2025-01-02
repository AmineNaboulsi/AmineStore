<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    SIGN UP
    <form action="../Routes/MainRoute.php" method="POST">
        <label for="">Email</label>    
        <input type="text" name="email" />
        <label for="">Paassword</label>    
        <input type="text" name="password" />
        <input type="hidden" name="url" value="signup" />
        <button name="submitsugntup">Create</button>
    </form>

    <form action="../Routes/MainRoute.php" method="POST">
        <label for="">Product Name</label>    
        <input type="text" name="email" />
        <label for="">Product price</label>    
        <input type="text" name="password" />
        <input type="hidden" name="url" value="addproduct" />
        <button name="submitsugntup">Create</button>
    </form>
</body>
</html>