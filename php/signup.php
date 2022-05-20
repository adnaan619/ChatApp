<?php
    session_start();
    include_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if(!empty($fname) && !empty($lname) && !empty($email) && !empty($password)){
        //lets check if the user email is valid or not
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            // lets check if the email already exists in the database or not
            $sql = mysqli_query($conn , "SELECT email FROM users WHERE email = '{$email}'");
            if(mysqli_num_rows($sql)> 0) {
                echo "$email - already exists!"; 
            } else{
                //lets check if the user has uploaded a file or not
                if (isset($_FILES['image'])){
                    $img_name = $_FILES['image']['name'];  // getting user uploaded image name
                    $img_name = $_FILES['image']['type'];   //getting user upload image type
                    $img_name = $_FILES['image']['tmp_name'];  //this temporary name is used to save file in our folder 

                    //lets explore the image and get the extension of the file jpg/png
                    $img_explode = explode(',', $img_name);
                    $img_ext = end($img_explode); //we get the extension of the img file

                    $extensions = ['png', 'jpeg', 'jpg']; //these are some of the img ext and we are going to store them in an array
                    if(in_array($img_ext. $extensions) === true){
                        $time = time();  //this will return us the current time...
                        //lets move the image to our folder
                        $new_img_name = $time.$img_name;


                        if(move_uploaded_file($tmp_name, "images/".$new_img_name)){  //if user the user uploads an image move it to our folder
                            $status ="Active now";
                            $random_id = rand(time(), 10000000); //creating random id for user


                            //lets imsert all user data  inside the table
                            $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                                VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");
                            if ($sql2){
                                $sql3 = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}'");
                                if(mysqli_nums_rows($sql3) > 0){
                                    $row = mysqli_fetch_assoc($sql3);
                                    $SESSION['unique_id'] = $row['unique_id']; //using this session we used the users unique_id in other php files
                                    echo "success";
                                }
                            } else{
                                echo "Something went wrong!";
                            }                    
                        }
                        
                    } else{
                        echo "Please select an image file - jpeg , png , png !";
                    }

                } else{
                    echo "Please select an image file!";
                }
            }
        } else {
            echo "$email - This is not a valid email!";
        }
    }else{
        echo "All input fields are required";
    }
?>