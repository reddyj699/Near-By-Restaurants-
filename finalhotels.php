<?php
include 'connect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beverages</title>
    <style>
        /* CSS styles for desktop */
        body {
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            text-align: center; /* Center align all text within the container */
        }

        h1 {
            margin-top: 20px; /* Add some spacing above the heading */
        }

        .beverage {
            padding: 20px;
            margin-bottom: 10px;
            border-radius: 10px;
            position: relative; /* Positioning context for absolute positioning of price */
        }

        .beverage:nth-child(odd) {
            background-color: lightgrey; /* Apply light grey background to odd numbered items */
        }

        .beverage:nth-child(even) {
            background-color: #222; /* Apply black background to even numbered items */
            color: white; /* Change text color to white for better contrast */
        }

        .beverage h2 {
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .beverage .description {
            margin-bottom: 10px;
            color: #000; /* Text color for description */
        }

        .beverage .pricing {
            position: absolute;
            bottom: 10px; /* Adjust this value as needed */
            right: 20px; /* Adjust this value as needed */
            font-weight: bold;
        }

        .beverage .flex {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .beverage .flex .items-center {
            display: flex;
            align-items: center;
        }

        .beverage .flex .items-center .bg-white {
            background-color: #fff;
            border-radius: 50%;
            padding: 3px;
            margin-right: 10px;
        }

        .beverage .font-medium {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .beverage .text-sm {
            font-size: 14px;
        }

        .beverage .font-semibold {
            font-weight: bold;
        }

        /* Media query for mobile devices */
        @media screen and (max-width: 768px) {
            .container {
                width: 100%; /* Full width for mobile devices */
            }

            .beverage {
                /* Mobile-specific styles */
                border-radius: 0px;
            }

            .beverage .pricing {
                /* Mobile-specific styles */
            }

            /* Add more mobile-specific styles as needed */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 id="heading"></h1>
        <script>
            // Retrieve hotelname from local storage
            
            var hotelname = localStorage.getItem('hotelname');
            document.getElementById('heading').textContent = hotelname;
            console.log('Hotel Name:', hotelname);

            // Function to handle the redirection to finalhotels.php
        </script>
        <?php
        // Debugging: Output the contents of $_GET array
    

        // Check if eateryName is set in the URL
        if (isset($_GET['eateryName'])) {
            // Retrieve eateryName from the URL and sanitize input
            $eateryName = mysqli_real_escape_string($conn, $_GET['eateryName']);
            echo '<script>console.log("Eatery Name:", "' . $eateryName . '");</script>'; // Log eatery name
            // Fetch data from the database
            $sql = "SELECT * FROM $eateryName ORDER BY category";
            $result = mysqli_query($conn, $sql);

            // Check if query executed successfully
            if ($result && mysqli_num_rows($result) > 0) {
                // Loop through each row in the result set
                $currentCategory = "";
                $count = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['category'] !== $currentCategory) {
                        $currentCategory = $row['category'];
                        echo '<h2>' . $currentCategory . '</h2>';
                    }
                    $count++;
                    ?>
                    <div class="beverage <?php echo $count % 2 == 0 ? 'even' : 'odd'; ?>">
                        <div class="flex">
                            <div class="items-center">
                                <span class="bg-white rounded-full p-1.5 mr-3"></span>
                                <div>
                                    <p class="font-medium"><?php echo $row['name']; ?></p>
                                    <p class="text-sm text-gray-400"><?php echo $row['description']; ?></p>
                                </div>
                            </div>
                            <p class="font-semibold">₹ <?php echo $row['price']; ?></p>
                        </div>
                    </div>
                <?php
                }
            } else {
                // No records found
                echo "<p>No beverages available.</p>";
            }

            // Close the database connection
            mysqli_close($conn);
        } else {
            // Debugging: Output a message if eateryName is not set in the URL
            echo '<script>console.log("Eatery Name not found in URL");</script>';
        }
        ?>
    </div>
</body>

</html>
