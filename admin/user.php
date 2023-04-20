<!DOCTYPE html>
<html>
<head>
    <title>FA and RM Registration Form</title>
    <!-- Add any styles or CSS here -->
    <style>
        /* Example CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }
        .form-container {
            width: 500px;
            margin: 20px auto;
            padding: 50px;
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            border: 1px solid red;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>FA and RM Registration Form</h1>
        <form action="createUser.php" method="post">
            <label for="FirstName">First Name:</label>
            <input type="text" name="FirstName" id="firstName" required>
            <label for="LastName">Last Name:</label>
            <input type="text" name="LastName" id="lastName" required>
            <label for="Email">Email:</label>
            <input type="email" name="Email" id="email" required>
            <label for="PhoneNo">Phone Number:</label>
            <input type="tel" name="PhoneNo" id="phoneNo" required>
            <label for="Password">Password:</label>
            <input type="password" name="Password" id="password" required>
            <div>
                <label for="Role">Role:</label>
                <select id= "Role" name="Role">
                    <option value="">Select a Risk Level</option>
                    <option value="FA">Funds Administrator</option>
                    <option value="RM">Relationship Manager</option>
                </select>
            </div>
            <input type="submit" value="Submit">
        </form>
    </div>
    <h3>
        <a href="allUsers.php">All users</a>
    </h3>
</body>
</html>