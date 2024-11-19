<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }
        .container {
            margin-top: 50px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        header h1 {
            font-weight: 700;
        }
        header .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-weight: 500;
        }
        .form-element label {
            font-weight: 500;
        }
        .form-element input,
        .form-element select {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 10px;
        }
        .form-element img {
            border: 2px solid #ced4da;
            border-radius: 5px;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
            font-weight: 500;
        }
        .btn-success:hover {
            background-color: #218838;
        }
    </style>
    <title>Edit Student Record</title>
</head>
<body>
    <div class="container">
        <header class="d-flex justify-content-between my-4">
            <h1>Edit Student Record</h1>
            <div>
                <a href="index.php" class="btn btn-primary">Back</a>
            </div>
        </header>
        <?php
        if (isset($_GET["id"])) {
            $id = $_GET["id"];
            include("db.php");
            $sql = "SELECT * FROM student WHERE id = $id";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
        ?>

        <form action="process.php" method="post" enctype="multipart/form-data">
            <div class="form-element my-4">
                <label for="image">Current Image:</label>
                <img src="images/<?php echo urlencode($row["image"]); ?>" alt="Current Image" style="width: 100px; height: auto; margin-bottom: 10px;">
                <input type="file" class="form-control" name="image" value="<?php echo $row["image"]; ?>">
            </div>

            <div class="form-element my-4">
                <label for="name">Name:</label>
                <input type="text" class="form-control" value="<?php echo $row["name"]; ?>" name="name" placeholder="Enter Name" required>
            </div>

            <div class="form-element my-4">
                <label for="gender">Gender:</label>
                <select name="gender" class="form-control" required>
                    <option value="">Select Gender</option>
                    <option value="male" <?php if($row["gender"] == "Male") { echo " selected"; } ?>>Male</option>
                    <option value="female" <?php if($row["gender"] == "Female") { echo " selected"; } ?>>Female</option>
                </select>
            </div>

            <div class="form-element my-4">
                <label for="email">Email:</label>
                <input type="email" class="form-control" value="<?php echo $row["email"]; ?>" name="email" placeholder="Enter Email" required>
            </div>

            <div class="form-element my-4">
                <label for="address">Address:</label>
                <input type="text" class="form-control" value="<?php echo $row["address"]; ?>" name="address" placeholder="Enter Address" required>
            </div>

            <div class="form-element my-4">
                <label for="class">Class:</label>
                <select name="class" class="form-control" required>
                    <option value="">Select Class</option>
                    <option value="1" <?php if ($row["class_id"] == "1") { echo " selected"; } ?>>6</option>
                    <option value="2" <?php if ($row["class_id"] == "2") { echo " selected"; } ?>>7</option>
                    <option value="3" <?php if ($row["class_id"] == "3") { echo " selected"; } ?>>8</option>
                    <option value="4" <?php if ($row["class_id"] == "4") { echo " selected"; } ?>>9</option>
                    <option value="5" <?php if ($row["class_id"] == "5") { echo " selected"; } ?>>10</option>
                </select>
            </div>

            <div class="form-element my-4">
                <label for="date">Created At:</label>
                <input type="text" class="form-control" value="<?php echo $row["created_at"]; ?>" name="date" readonly required>
            </div>

            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">

            <div class="form-element">
                <input type="submit" class="btn btn-success" name="edit" value="Save Changes">
            </div>
        </form>

        <?php
        }
        ?>
    </div>
</body>
</html>
