<?php
/* Created by
 * ProgrammingHacks Youtube
 * Url: https://www.youtube.com/channel/UCqR3mOQaO4ys1atFz_ShUzg
 */
//require_once "process.php";
$mysql = new mysqli("localhost", "programminghacks",
    "admin123", "programminghacks") or
die(mysqli_error($mysql));

$result_read_query = "SELECT * FROM crud";
$result_read = $mysql->query($result_read_query);

//create
if(isset($_POST['create'])){
    $firstname = $_POST['txtFname'];
    $lastname  = $_POST['txtLname'];
    $email     = $_POST['txtEmail'];

    $query_create = "INSERT INTO crud (first_name, last_name, email) 
                    VALUES ('$firstname', '$lastname', '$email')";

    $mysql->query($query_create);
    $mysql->close();
}

//read
if (isset($_GET['id'])){
    $id = $_GET['id'];

    $query_update = "SELECT * FROM crud WHERE id = $id";
    $get_ = $mysql->query($query_update);
    if (count($row = $get_->fetch_array()) > 0){
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
    }
}

//update
if (isset($_POST['update'])){
    $id = $_POST['id'];
    $firstname = $_POST['txtFname'];
    $lastname  = $_POST['txtLname'];
    $email     = $_POST['txtEmail'];

    $update_q = "UPDATE crud SET first_name = '$firstname', 
                last_name ='$lastname', 
                email = '$email' WHERE id = $id";
    $update = $mysql->query($update_q);
}

//delete
if (isset($_POST['delete'])){
    $id = $_POST['id'];
    $delete_q = "DELETE FROM crud WHERE id = $id";
    $mysql->query($delete_q);
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD DEMO - Programming Hacks Youtube</title>
</head>
<body>
    <?php if(!isset($_GET['id'])): ?>
    <form action="" method="post">
        <input type="input" type="text" name="txtFname" placeholder="Enter your First name"><br><br>
        <input type="text" name="txtLname" placeholder="Enter your Last Name"><br><br>
        <input type="email" name="txtEmail" placeholder="Enter Email"><br><br>
        <button type="submit" name="create">Submit</button>
    </form>
    <?php else: ?>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?=$_GET['id'] ?>">
        <input type="text" value="<?=$first_name ?>" name="txtFname" placeholder="Enter your First name"><br><br>
        <input type="text" value="<?=$last_name ?>" name="txtLname" placeholder="Enter your Last Name"><br><br>
        <input type="email" value="<?=$email ?>" name="txtEmail" placeholder="Enter Email"><br><br>
        <button type="submit" name="update">Update</button>
    </form>
        <br>
        <a href="index.php">Back</a>
        <br>
    <?php endif; ?>
<br>
<table border="1" cellspacing="1">
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Delete</th>
        <th>Update</th>
    </tr>

    <?php while ($row = $result_read->fetch_assoc()): ?>
    <tr>
        <th><?=$row['first_name']; ?></th>
        <th><?=$row['last_name']; ?></th>
        <th><?=$row['email']; ?></th>
        <th>
            <form action="" method="post">
                <input type="hidden" name="id" value="<?=$row['id'] ?>">
                <button name="delete">Delete</button>
            </form>
        </th>
        <th>
            <form action="" method="get">
                <input type="hidden" name="id" value="<?=$row['id'] ?>">
                <button>Update</button>
            </form>
        </th>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>