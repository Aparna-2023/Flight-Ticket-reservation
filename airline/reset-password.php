
<?php require 'connection.php'; ?>
<?php require 'header.php'; ?>
<?php
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    if(isset($_POST['pass'])&&isset(($_POST['cpass']))){
        $pass=md5($_POST['pass']);
        $cpass=md5($_POST['cpass']);
        if($pass!=$cpass){
            echo"Password not same";
        }
        else{
            $pass=$cpass;
            $sql='UPDATE registration SET PASSWORD=:pass WHERE TOKEN=:token';
            $statement=$connection->prepare($sql);
            if($statement->execute(['pass'=>$pass,'token'=>$token])){
                echo "Success";
            }
            else{
                echo "Failed";
            }
        }
    }
}
else{
    echo "Token not found";
}
?>
        <form action="" method="post" class="w-50 text-center">                                   
            <div id="pass_div" class="mt-3">
                    <input type="password" placeholder="Password" class="form-control " id="" name="pass">
                    <input type="password" placeholder="Confirm Password" class="form-control mt-2" id="" name="cpass">
                    <input type="submit" value="Submit" class="btn btn-success d-block mt-3 w-100" />                  
            </div>                                                              
        </form>
<?php require 'footer.php'; ?>		