<?php
if(isset($_POST["updateProfileSubmit"])){
        session_start();
        $sql = new mysqli("localhost", "root", "password", "Facebook");
        if($sql->connect_errno) {
                printf("Connection Failed: %s\n", $sql->connect_error);
                exit;
        }

        if(isset($_SESSION['current_user'])){
        $query = "SELECT Name, Email, Password FROM Users WHERE Username=?";
	$currProfile = mysqli_fetch_array($query);

        $name = (isset($_POST["updateName"]) ? $_POST["updateName"]:$currProfile["Name"]);
        $email = (isset($_POST["updateEmail"]) ? $_POST["updateEmail"]:$currProfile["Email"]);
        $password = (isset($_POST["updatePassword"]) ? $_POST["updatePassword"]:$currProfile["Password"]);
	
                $stmt = $sql->prepare("UPDATE Users SET Name=$name, Email=$email, Password=$Password WHERE Username=?");
                if(!$stmt){
                        printf("Query Prep Failed: %s\n", $sql->error);
                        exit;
                }
                $stmt->bind_param('sss', mysql_real_escape_string($name), mysql_real_escape_string($password), mysql_real_escape_string($email));
                $stmt->execute();
                $stmt->close();

                header("Location: index.php");
                die();

        }

}
?>
