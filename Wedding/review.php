<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission for new reviews
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['name']) && isset($_POST['rating']) && isset($_POST['review'])) {
        $name = $_POST['name'];
        $rating = intval($_POST['rating']);
        $review = $_POST['review'];

        // Insert the review into the database
        $sql = "INSERT INTO review (name, rating, message, datetime) VALUES ('$name', $rating, '$review', NOW())";

        if (mysqli_query($conn, $sql)) {
            // Review added successfully, you can redirect to a thank-you page if needed.
            // header("Location: thank_you_page.php");
            // exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

// Retrieve existing reviews from the database
$sql = "SELECT * FROM review ORDER BY datetime DESC";
$result = mysqli_query($conn, $sql);

$reviews = array();
while ($row = mysqli_fetch_assoc($result)) {
    $reviews[] = $row;
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<!-- swiper css link  -->
<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
<link rel="stylesheet" href="css/style.css"> 
<title>Wedding Reviews</title>
    <style>
        /* CSS for Wedding Review System */

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
         
            background-size: cover;
            background-attachment: fixed; /* Keeps the background image fixed when scrolling */
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: wheat;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 30px;
        }

        form label {
            display: block;
            margin-bottom: 5px;
        }

        form input[type="text"],
        form select,
        form textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        form textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        h2 {
            margin-bottom: 15px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 5px;
        }

        li strong {
            font-size: 18px;
        }

        li small {
            color: #666;
        }

        .star-rating {
            color: #f7c547;
        }

        .star-light {
            color: #ccc;
        }

        .review-section {
            display: none; /* Hide the review section by default */
            padding-top: 20px;
        }

        .review-section.show {
            display: block; /* Show the review section when triggered */
        }

        /* Custom Styling */
        .review-form-container {
            background-color: #f8f8f8;
            padding: 20px;
            border-radius: 10px;
        }

        .existing-reviews {
            background-color: rgb(427,137,0);
            padding: 20px;
            border-radius: 10px;
        }

        .review-item {
            border: 2px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        #sub small{
         color:white;
        }
    </style>
</head>

<body>
   
<?php @include 'header.php'; ?>
    <div class="container">
        <h1>Wedding Reviews</h1>
        <!-- Display review submission form -->
        <div class="review-form-container">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required><br>
                
                <label for="rating">Rating:</label>
                <select id="rating" name="rating" required>
                    <option value="5">5 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="2">2 Stars</option>
                    <option value="1">1 Star</option>
                </select><br>

                <label for="review">Your Review:</label>
                <textarea id="review" name="review" required></textarea><br>

                <input type="submit" value="Submit Review">
            </form>
        </div>

        <!-- Display existing reviews -->
        <div class="existing-reviews">
            <?php if (!empty($reviews)) : ?>
                <h2>Existing Reviews</h2>
                <ul>
                    <?php foreach ($reviews as $review) : ?>
                        <li class="review-item">
                            <strong><?php echo $review['name']; ?></strong><br>
                            Rating: <?php echo $review['rating']; ?>/5<br>
                            <?php echo $review['message']; ?><br>
                            <div id="sub">  
                               <small>Submitted on <?php echo $review['datetime']; ?></small>
                              </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else : ?>
                <p>No reviews yet.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
<?php @include 'footer.php'; ?>
</html>
