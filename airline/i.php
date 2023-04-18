<?php require 'connection.php'; ?>
<?php require 'header.php'; ?>
<div
    class="container-fluid m-0 p1 min-vh-100 row justify-content-center py-5"
>
    <div class="col-12 container rounded-3 col-sm-10 p2 px-5 mx-5 text-white">
	<!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light ">
            <div class="container-fluid p-0 ">
                <h4 class="text-white">Purple Fly.com</h4>
                <button
                    class="navbar-toggler"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div
                    class="collapse navbar-collapse"
                    id="navbarSupportedContent"
                >
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a
                                class="nav-link active text-white"
                                aria-current="page"
                                href="index.php"
                                >Home</a
                            >
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="#"
                                >About</a
                            >
                        </li>
                        <li class="nav-item">
                            <a
                                class="nav-link active text-white"
                                href="logout.php"
                                >Login/Signup</a
                            >
                        </li>
                    </ul>                  
                </div>
            </div>
        </nav>



    <div class=" row   justify-content-center">
        <!-- div for plane image -->
        <div class="px-0 col-12 col-lg-6 my-4 my-lg-5 rounded-4 text-center">
            <img src="images/plane 2.png" class="img-fluid rounded-4 " alt="" />
        </div>
        <!-- div for login -->
        <div class="col-12 col-lg-4 my-0 my-lg-5 rounded-4  rounded-4 p2">
        <h3 class="my-4 text-center text-white ">Welcome to Purple Fly.com</h3>
        <?php 
        if (isset($_POST['log'])) {
            $email = $_POST['email'];
            $password =md5( $_POST['password']);
                    // selecting data from database
            $sql = "SELECT * FROM registration WHERE EMAIL = :email";
            $statement = $connection->prepare($sql);
            $statement->execute([':email' => $email]); 
            $user=$statement->fetch(PDO::FETCH_ASSOC); 
            if ($user !== false)
            { 
            $a=$user['ROLE'] ;
            $u=$user['ID'] ;
            $p =$user['PASSWORD']; 
            if ($password == $p) 
            {            
            if($a=='USER'){ 
            session_start(); 
            $_SESSION["uid"]=$u;
            $_SESSION["user"]=$email;
            header("Location:homepage.php"); } 
            else if($a=='ADMIN'){
            session_start(); 
            $_SESSION["user"]=$email;
            header("Location:adminhome.php");
            }
        }
            else{ echo "<div class='alert alert-danger'>Invalid password</div>
            "; } } 
            else { echo "<div class='alert alert-danger'>Invalid user</div>
            "; } }?>
            <form action="" method="post">
                <div class="my-4">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="email"
                        required
                        id=""
                        name="email"
                    />
                </div>
                <div class="my-4">
                    <input
                        type="password"
                        class="form-control"
                        placeholder="password"
                        id=""
                        required
                        name="password"
                    />
                </div>
                <div class="text-center my-4">
                    <button type="submit" name="log" class="btn  btn-success">
                        Sign in
                    </button>
                </div>
                <div class="row">
                    <div class="col-6 text-start">
                        <button
                            type="button"
                            class="border-0 p2 text-white  text-decoration-underline"
                            data-bs-toggle="modal"
                            data-bs-target="#exampleModal"
                        >
                            Forgot password
                        </button>
                    </div>
                    <div class="col-6 mb-5 text-center">
                        <a
                            href="signup.php"
                            class="text-white   text-decoration-underline"
                            >Sign Up</a
                        >
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
            </div>
<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);
$token = bin2hex(random_bytes(32));
if(isset($_POST['password-reset-token']) && $_POST['email'])
{
    $email_address = $_POST['email'];
    $query = $connection->prepare("UPDATE registration   SET TOKEN=:token WHERE EMAIL=:email");
    $query->execute(array(':token' => $token, ':email' => $email_address));
    $reset_url = "http://localhost/Group/AIRLINE/reset-password.php?token=" . $token;
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'arfsairline@gmail.com';                     //SMTP username
        $mail->Password   = 'gaycnpamyrhohkbr';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        //Recipients
        $mail->setFrom('arfsairline@gmail.com', 'ARFS');
        $mail->addAddress($email_address);     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');
        //Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'password reset';
        $mail->Body    = 'To reset your password, please click the following link:'.$reset_url;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();
        echo '<script>alert("Message sent");</script>';
    } catch (Exception $e) {
        echo '<script>alert("Message not sent");</script>';
    }
}
?>
<!-- Modal -->
<div
    class="modal fade"
    id="exampleModal"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                    Forgot Password
                </h1>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <div class="modal-body border-0">
                    <div class="container">
                        <div class="card">
                            
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1"
                                            >Email address</label
                                        >
                                        <input
                                            type="email"
                                            name="email"
                                            class="form-control"
                                            id="email"
                                            aria-describedby="emailHelp"
                                        />
                                        <small
                                            id="emailHelp"
                                            class="form-text text-muted"
                                            >We'll never share your email.</small
                                        >
                                    </div>
                                    <input
                                        type="submit"
                                        name="password-reset-token"
                                        class="btn btn-success"
                                    />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>          
        </div>
    </div>
</div>
<!-- container-fluid div closed -->
<?php require 'footer.php'; ?>
