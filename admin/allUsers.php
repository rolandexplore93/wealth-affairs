<?php
    // Connect to the database
    include "../rm/backend/dbconnection.php";

// Fetch data from "fa" table
$query_fa = "SELECT * FROM fa";
$result_fa = mysqli_query($databaseConnection, $query_fa);

// Fetch data from "rm" table
$query_rm = "SELECT * FROM rm";
$result_rm = mysqli_query($databaseConnection, $query_rm);

// Close database connection
mysqli_close($databaseConnection);
?>

<!DOCTYPE html>
<html>
<head>
    <title>All Users</title>
</head>
<body>
    <h1>All Users</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Pass</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        <?php
        // Loop through "fa" table results and display in table
        while ($row_fa = mysqli_fetch_assoc($result_fa)) {
            echo "<tr>";
            echo "<td>".$row_fa['FaID']."</td>";
            echo "<td>".$row_fa['Firstname']."</td>";
            echo "<td>".$row_fa['Lastname']."</td>";
            echo "<td>".$row_fa['Email']."</td>";
            echo "<td>".$row_fa['PhoneNo']."</td>";
            echo "<td>".$row_fa['Password']."</td>";
            echo "<td>".$row_fa['Role']."</td>";
            echo "<td><a href='editUser.php?id=".$row_fa['FaID']."&role=fa'>Edit</a></td>";
            echo "</tr>";
        }

        // Loop through "rm" table results and display in table
        while ($row_rm = mysqli_fetch_assoc($result_rm)) {
            echo "<tr>";
            echo "<td>".$row_rm['RmID']."</td>";
            echo "<td>".$row_rm['Firstname']."</td>";
            echo "<td>".$row_rm['Lastname']."</td>";
            echo "<td>".$row_rm['Email']."</td>";
            echo "<td>".$row_rm['PhoneNo']."</td>";
            echo "<td>".$row_rm['Password']."</td>";
            echo "<td>".$row_rm['Role']."</td>";
            echo "<td><a href='editUser.php?id=".$row_rm['RmID']."&role=rm'>Edit</a></td>";
            echo "</tr>";
            // allUsers.php
        }
        ?>
    </table>
    <h2>
        <a href="user.php">Create user</a>
    </h2>
</body>
</html>
