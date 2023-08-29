<?php
class Validation
{
    // to check if the method is post or get
    function sanitize($method)
    {
        if ($method == "POST") {
            return true;
        } else {
            return false;
        }
    }
    //to check if we write in inputs and remove white spaces 
    function check_written($value)
    {
        if (isset($value)) {
            return true;
        } else {
            return false;
        }
    }
    //redirect function  
    function redirect($path)
    {
        return header("location:$path");
    }
    // check input is written or not 
    public function required_VALIDATION($input)
    {
        if (empty($input)) {
            return true;
        } else {
            return false;
        }
    }
    //  check input characters is grater than 3 or not 
    public function min_VALIDATION($input)
    {
        if (!(strlen($input)  > 3)) {
            return true;
        } else {
            return false;
        }
    }
    //  check input characters is lower than 25 or not 
    public function max_VALIDATION($input)
    {
        if (!(strlen($input)  < 25)) {
            return true;
        } else {
            return false;
        }
    }
    // check if Email is a Valid Email or not 
    public function valid_email_VALIDATION($input)
    {
        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
    //check email exist function
    public function check_existing($hostname, $username, $password, $database, $table_name, $email)
    {
        $conn = mysqli_connect($hostname, $username, $password,  $database);
        if (!$conn) {
            return "connect error" . mysqli_connect_error($conn);
        }
        $sql = "SELECT email FROM $table_name";
        $result = mysqli_query($conn, $sql);
        $res  = $result->fetch_all();
        foreach ($res as  $array) {
            foreach ($array as $email_exist) {
                if (
                    $email_exist == $email
                ) {
                    return "this email is already in use , please try again";
                    die();
                } else {
                    return false;
                }
            }
        }
    }
    //  check Password characters is greater than 8 or not 
    public function min_password_VALIDATION($input)
    {
        if (!(strlen($input)  > 8)) {
            return true;
        } else {
            return false;
        }
    }
    // check password characters is lower than 25 or not 
    public function max_passwprd_VALIDATION($input)
    {
        if (!(strlen($input)  < 25)) {
            return true;
        } else {
            return false;
        }
    }
    // get type of image function 
    public function get_image_type($image)
    {
        $explode_image_file = explode(".", $image);
        $type_of_image = end($explode_image_file);
        if ($type_of_image == "jpg") {
            return true;
        } else {
            return false;
        }
    }
    // get user id function 
    function get_id($hostname, $username, $password, $database, $table_name,  $email)
    {
        $conn = mysqli_connect($hostname, $username, $password, $database);
        if (!$conn) {
            return "connect error" . mysqli_connect_error($conn);
        }
        $sql = "SELECT id FROM $table_name  WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $res  = $result->fetch_all();
        $id = $res[0][0];
        return $id;
    }
    // get users function 
    function get_users($hostname, $username, $password, $database, $table_name)
    {
        $conn = mysqli_connect($hostname, $username, $password, $database);
        if (!$conn) {
            return "connect error" . mysqli_connect_error($conn);
        }
        $sql = "SELECT * FROM $table_name";
        $result = mysqli_query($conn, $sql);
        $res  = $result->fetch_all();
        return $res;
    }
    // get user name function 
    function get_name($hostname, $username, $password, $database, $table_name, $email)
    {
        $conn = mysqli_connect($hostname, $username, $password, $database);
        if (!$conn) {
            return "connect error" . mysqli_connect_error($conn);
        }
        $sql = "SELECT name FROM $table_name WHERE email = '$email'";
        $result = mysqli_query(
            $conn,
            $sql
        );
        $res = $result->fetch_all();
        $name = $res[0][0];
        return $name;
    }
}
