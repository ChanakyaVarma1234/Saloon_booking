<?php
if (isset($_POST['submit'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST['name'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phoneCode = $_POST['phoneCode'];
    $phone = $_POST['phone'];
    $slot = $_POST['slot']; // Add this line to get the selected slot

    $sql = "INSERT INTO project (name, password, gender, email, phone, slot)
            VALUES ('$name', '$password', '$gender', '$email', '$phoneCode$phone', '$slot')";

    if ($conn->query($sql) === TRUE) {
        echo "Successfully Booked Your Slot!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>


<!DOCTYPE HTML>
<html>
<head>
    <title>Saloon Slot Booking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000000;
            color: #ffffff;
            margin: 0;
            padding: 0;
        }

        #container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #1a1a1a;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
        }

        #image-container {
            max-width: 300px;
            margin-right: 20px;
            float: left;
        }

        /* Image style */
        #image-container img {
            max-width: 100%;
            border-radius: 8px;
        }

        #form-container {
            flex: 1;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #4CAF50;
        }

        table {
            width: 100%;
        }

        td {
            padding: 8px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
            box-sizing: border-box;
            color: #ffffff;
            background-color: #333333;
        }

        input[type="radio"] {
            margin-right: 5px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div id="container">
        <div id="image-container">
            <img src="hair.jpg" alt="Salon Hairstyling">
        </div>

        <div id="form-container">
            <form action="register.php" method="POST">
                <h1>Saloon Slot Booking</h1>
                <table>
                    <tr>
                        <td>Name :</td>
                        <td><input type="text" name="name" required></td>
                    </tr>
                    <tr>
                        <td>Password :</td>
                        <td><input type="password" name="password" required></td>
                    </tr>
                    <tr>
                        <td>Gender :</td>
                        <td>
                            <input type="radio" name="gender" value="m" required>Male
                            <input type="radio" name="gender" value="f" required>Female
                        </td>
                    </tr>
                    <tr>
                        <td>Email :</td>
                        <td><input type="email" name="email" required></td>
                    </tr>
                    <tr>
                        <td>Phone no :</td>
                        <td>
                            <select name="phoneCode" required>
                                <option selected hidden value="">Select Code</option>
                                <option value="91">91</option>
                            </select>
                            <input type="phone" name="phone" required>
                        </td>
                    </tr>
                    <!-- <tr>
                        <td>Bookingtime :</td>
                        <td>
                            <select name="Bookingtime" required>
                                <option selected hidden value="">Select Time</option>
                                <option value="9-9:30am">9-9:30am</option>
                                <option value="10-10:30am">10-10:30am</option>
                                <option value="11-11:30am">11-11:30am</option>
                            </select>
                        </td>
                    </tr> -->
                    <tr>
                <td>
                    <label for="datetime">Booking date:</label>
                </td>
                <td id="timestampCell">
                    <!-- JavaScript will populate this cell with the timestamp -->
                </td>
            </tr>
            <tr>
                <td>
                    <label for="slot">Select a slot:</label>
                </td>
                <td>
                    <select name="slot" id="slot">
                        <option value="9:00 AM - 10:00 AM">9:00 AM - 10:00 AM</option>
                        <option value="10:00 AM - 11:00 AM">10:00 AM - 11:00 AM</option>
                        <option value="11:00 AM - 12:00 PM">11:00 AM - 12:00 PM</option>
                        <option value="3:00 PM - 4:00 PM">3:00 PM - 4:00 PM</option>
                        <option value="4:00 PM - 5:00 PM">4:00 PM - 5:00 PM</option>
                        <option value="6:00 PM - 7:00 PM">6:00 PM - 7:00 PM</option>
                        <option value="7:00 PM - 8:00 PM">7:00 PM - 8:00 PM</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td colspan="2"><input type="submit" value="Submit" name="submit"></td>
            </tr>
        </table>
    </form>
    
    <script>
        // JavaScript to display the current timestamp in IST
        const timestampCell = document.getElementById("timestampCell");
        
        // Get the current UTC timestamp
        const currentUTCTimestamp = new Date().toISOString().slice(0, 19).replace("T", " ");
        
        // Apply the IST offset (UTC+5:30) to convert to IST
        const offsetHours = 5;
        const offsetMinutes = 30;
        const currentTimestampParts = currentUTCTimestamp.split(" ");
        const utcDateParts = currentTimestampParts[0].split("-");
        const utcTimeParts = currentTimestampParts[1].split(":");
        const utcDate = new Date(
            utcDateParts[0],
            utcDateParts[1] - 1,
            utcDateParts[2],
            utcTimeParts[0],
            utcTimeParts[1]
        );
        utcDate.setHours(utcDate.getHours() + offsetHours);
        utcDate.setMinutes(utcDate.getMinutes() + offsetMinutes);

        // Format the IST timestamp
        const ISTTimestamp = utcDate.toISOString().slice(0, 19).replace("T", " ");
        
        timestampCell.textContent = ISTTimestamp;
    // </script>
    <!-- pCell.textContent = ISTTimestamp; -->
    <!-- </script> -->
                    <!-- <tr>
                        <td colspan="2"><input type="submit" value="Submit" name="submit"></td>
                    </tr> -->
                </table>
            </form>
        </div>
    </div>
</body>
</html>
