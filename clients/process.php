<?php

// login check
if ($_POST['fname'])    {

    if ($_POST['lname']) {

        if ($_POST['email']) {

            if($_POST['password']){

                if( $_POST['password_rpt']){

                    if ($_POST['password'] == $_POST['password_rpt']){

                        echo "Congratulations!";

                        $fname = $_POST['fname'];
                        $lname = $_POST['lname'];
                        $email = $_POST['email'];
                        $hashed_password = hash('sha512', $_POST['password']);

                        if ($fname && $lname && $email && $hashed_password){

                                                       
                            // Create a new mysqli object and connect to the database
                            $mysqli = new mysqli("localhost", "root", "", "wealthafairs");

                            // Check connection error
                            if ($mysqli->connect_errno) {
                            echo "Failed to connect to MySQL: " . $mysqli->connect_error;
                            exit();
                            }

                            // Escape user input to prevent SQL injection
                            $fname = $mysqli->real_escape_string($_POST['fname']);
                            $lname = $mysqli->real_escape_string($_POST['lname']);
                            $email = $mysqli->real_escape_string($_POST['email']);
                            $hashed_password = $mysqli->real_escape_string($_POST['password']);

                            // Insert data into the database
                            $sql = "INSERT INTO client (fName, lName, email,password) VALUES ('$fname', '$lname', '$email','')";
                            if ($mysqli->query($sql) === TRUE) {
                            $register = $mysqli->affected_rows;
                            echo "$register was inserted";
                            } else {
                            echo "Error: " . $sql . "<br>" . $mysqli->error;
                            }

                            // Close the database connection
                            $mysqli->close();


                        }else{

                            echo "Please check your details";


                        }




                        
                      }else{
                        echo "Your password does not match";
                      }
                    
                }
            }


            
        }



    }

}

// 







?>