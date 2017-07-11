<?php

require_once '../configs/admin_configs.php';
require_once _ROOT . '/admin/controllers/session.php';
require_once _ROOT . '/admin/functions/service_setup.php';


// Check the privilegies of the logged user before proceeding
check_service("addUserEmail_service.php", $_SESSION['role'], 1);

if(isset($_POST['addNewUser'])){
    // Check for empty fields
    if(empty($_POST['set_email']) || empty($_POST['set_username']) || !filter_var($_POST['set_email'],FILTER_VALIDATE_EMAIL)){
        echo "No arguments Provided!";
        return false;
    }

    // Generate unique password
    $password = "bu" . substr(uniqid(), 0, 5) . substr(uniqid(), 10, 11);

    $connection = dbConnect();
    $data_1 = array();
    $data_2 = array();

    $data_1['username'] = mysqli_real_escape_string($connection, $_POST['set_username']);
    $data_1['password'] = mysqli_real_escape_string($connection, md5($password));
    $data_1['email'] = mysqli_real_escape_string($connection, $_POST['set_email']);
    $id = insertRecord("users", $data_1);

    $data_2['userId'] = $id;
    $data_2['groupId'] = 4;
    insertRecord("user_role", $data_2);


    // Sending email with login details
    $email_receiver = strip_tags(htmlspecialchars($_POST['set_email']));
    $username = strip_tags(htmlspecialchars($_POST['set_username']));
    $link = "loginpagelink";

    // Create the email and send the message
    $to = $email_receiver; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
    $email_subject = "24CinL Blog: membership requested.";
    $email_body = "24CinL team has the pleasure to inform you that your requested to participate in the Blog has been accepted.\n\n"."Here are the login details:\n\n Username: $username\n\nPassword: $password\n\nTo access to the login page click the following link: $link";
    $headers = "From: noreply@24cinlstaff.org\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
    $headers .= "Reply-To: $email";
    if(mail($to, $email_subject, $email_body, $headers))
        redirect("../allUsers.php", true);
    else
        redirect("../error_page.php?typeError=500&message=Mail impossible to send.", true);
}else{
    redirect("../error_page.php?typeError=500&message=Cannot perform the requested operation. Data was not sent.");
}
?>
