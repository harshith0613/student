<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>View Student Record</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 900px;
            margin-top: 50px;
        }

        header {
            background-color: white;
            padding: 20px 30px;
            color: black;
            border-radius: 8px;
        }

        h1 {
            font-size: 36px;
            font-weight: 700;
        }

        .btn {
            font-size: 16px;
            font-weight: 500;
        }

        .book-details {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .student-image {
            width: 230px;
            height: 250px;
            border: solid black 2px;
            border-radius: 10%;
            margin-bottom: 20px;
        }

        .back-btn {
            font-size: 16px;
            padding: 8px 20px;
        }

        .student-info h2 {
            font-size: 18px;
            font-weight: 600;
            color: #333;
        }

        .student-info p {
            font-size: 16px;
            color: #555;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <h1>Student Details</h1>
            <a href="index.php" class="btn btn-primary">Back</a>
        </header>

        <div class="book-details">
            <?php
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                include("db.php");
                $sql = "
                        SELECT 
                            student.id, 
                            student.name, 
                            student.gender,
                            student.email, 
                            student.address, 
                            classes.class_name, 
                            student.created_at,
                            student.image
                        FROM 
                            student
                        JOIN 
                            classes 
                        ON 
                            student.class_id = classes.class_id
                        WHERE 
                            student.id = $id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_array($result);
            ?>
                <div class="text-center mb-4">
                    <img src="images/<?php echo urlencode($row["image"]); ?>" alt="student image" class="student-image">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <h2>Name:</h2>
                        <p><?php echo $row["name"]; ?></p>

                        <h2>Gender:</h2>
                        <p><?php echo $row["gender"]; ?></p>

                        <h2>Email:</h2>
                        <p><?php echo $row["email"]; ?></p>

                        
                    </div>
                    <div class="col-md-6">
                        <h2>Address:</h2>
                        <p><?php echo $row["address"]; ?></p>

                        <h2>Class Name:</h2>
                        <p><?php echo $row["class_name"]; ?></p>

                        <h2>Join Date:</h2>
                        <p><?php echo date("F j, Y", strtotime($row["created_at"])); ?></p>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</body>

</html>
