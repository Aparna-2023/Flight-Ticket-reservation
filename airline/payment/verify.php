<?php require('razorpay-php/Razorpay.php'); require_once("config.php");

        $payment_id=$_SESSION['payment_id'];
      ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PurpleFly</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" a href="css/style.css" />
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-sm-12 form-container">
				<h1>Payment Status</h1>
<hr>


				<div class="row"> 
					<div class="col-8"> 
            <?php 
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
$success = true;
include("gateway-config.php");
$error = "Payment Failed";
if (empty($_POST['razorpay_payment_id']) === false)
{
    $api = new Api($keyId, $keySecret);

    try
    {
        // Please note that the razorpay order ID must
        // come from a trusted source (session here, but
        // could be database or something else)
        $attributes = array(
            'razorpay_order_id' => $_SESSION['razorpay_order_id'],
            'razorpay_payment_id' => $_POST['razorpay_payment_id'],
            'razorpay_signature' => $_POST['razorpay_signature']
        );

        $api->utility->verifyPaymentSignature($attributes);
    }
    catch(SignatureVerificationError $e)
    {
        $success = false;
        $error = 'Razorpay Error : ' . $e->getMessage();
    }
}
if ($success === true)
{
// $firstname=$_SESSION['fname']; 
// $lastname=$_SESSION['lname'];
// $email=$_SESSION['email'];
// $mobile=$_SESSION['mobile'];
// $address=$_SESSION['address'];
// $note=$_SESSION['note'];
// $productinfo='Payment';  
// $u_id=$_SESSION['u_id'];
// $amt=$_SESSION['amt'];
// $tot=$_SESSION['tot'];
// $seat_no=$_SESSION['seat_no'];
// $name=$_SESSION['name'];
// $b_id=$_SESSION['b_id'];
// $n=count($name);



$posted_hash = $_SESSION['razorpay_order_id'];
    if(isset($_POST['razorpay_payment_id']))
        
    $txnid = $_POST['razorpay_payment_id'];
    $amount = $_SESSION['price'];
    $status='success'; 
  $eid=$_POST['shopping_order_id']; 
$subject='Your payment has been successful..';
       $key_value='okpmt'; 
  
$currency='INR';
// $date = new DateTime(null, new DateTimezone("Asia/Kolkata"));
// $payment_date=$date->format('Y-m-d H:i:s');
//      $sql="SELECT count(*) from payments WHERE txnid=:txnid"; 
//        $stmt = $db->prepare($sql);
//            $stmt->bindParam(':txnid', $txnid, PDO::PARAM_STR);
//            $stmt->execute();
//           $countts=$stmt->fetchcolumn();

// status
  $s=1;
  // $booking_id=$_SESSION['booking_id'];
  $booking_id=1;
  $totalprice=$_SESSION['totalprice'];
  // if($txnid!=''){
  //   if($countts<=0)
  //   {

// inserting Payment details to payment table

      $sql="INSERT INTO payment(BOOKING_ID,AMOUNT,STATUS) VALUES(:booking_id,:amount,:status)"; 
       $stmt = $db->prepare($sql);
       if($stmt->execute(['amount'=>$totalprice,'status'=>$s,'booking_id'=>$booking_id])){
          echo"<script>alert('Success');</script>";
          $_SESSION['status']=$s;
          header("Location:success.php");
       }





          //  $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
          //  $stmt->bindParam(':lastname', $lastname, PDO::PARAM_STR);
          //  $stmt->bindParam(':amount', $amount, PDO::PARAM_STR);
          //  $stmt->bindParam(':status', $status, PDO::PARAM_STR);
          //  $stmt->bindParam(':txnid', $txnid, PDO::PARAM_STR);
          //  $stmt->bindParam(':pid', $pid, PDO::PARAM_INT);
          //  $stmt->bindParam(':payer_email', $email, PDO::PARAM_STR);
          //  $stmt->bindParam(':currency', $currency, PDO::PARAM_STR);
          //  $stmt->bindParam(':mobile', $mobile, PDO::PARAM_STR);
          // $stmt->bindParam(':address', $address, PDO::PARAM_STR);
          //  $stmt->bindParam(':note', $note, PDO::PARAM_STR);
          //   $stmt->bindParam(':payment_date', $payment_date, PDO::PARAM_STR);
          //  $stmt->execute();

 // start 
        echo ' <h2 style="color:#33FF00";>'.$subject.'</h2>   <hr>';

        echo '<table class="table">'; 
        echo '<tr> '; 
$rows= $sql="SELECT * from payments WHERE txnid=:txnid"; 
         $stmt = $db->prepare($sql);
           $stmt->bindParam(':txnid',$txnid,PDO::PARAM_STR);
            $stmt->execute();
           $rows=$stmt->fetchAll();
foreach($rows as $row)
{
    $dbdate = $row['payment_date'];
}
echo '<tr>  
          <th>Transaction ID:</th>
        <td>'.$txnid.'</td> 
    </tr>
     <tr> 
        <th>Paid Amount:</th>
        <td>'.$amount.' '. $currency.'</td> 
    </tr>
    <tr>
       <th>Payment Status:</th>
        <td>'.$status.'</td> 
   </tr>
   <tr> 
       <th>Payer Email:</th>
       <td>'.$email.'</td> 
   </tr>
    <tr> 
       <th>Name:</th>
       <td>'.$firstname.' '.$lastname.'</td>
   </tr>
   <tr> 
       <th>Address:</th>
       <td>'.$address.'</td>
   </tr>
   <tr> 
       <th>Note:</th>
       <td>'.$note.'</td>
   </tr>

   <tr>
       <th>Date :</th>
       <td>'.$dbdate.'</td> 
  </tr>
  </table>';
}
 else 
 {
  $s=0;
  $sql="INSERT INTO payment(amount,status,booking_id) VALUES(:amt,:sts,:b_id)"; 
  $stmt = $db->prepare($sql);
  if($stmt->execute(['amt'=>$tot,'sts'=>$s,'b_id'=>$b_id])){
     echo"<script>alert('Success');</script>";
     $_SESSION['status']=$s;
     header("Location:success.php");
  } 
 }    
// }
// else
// {
//     $html = "<p><div class='errmsg'>Invalid Transaction. Please Try Again</div></p>
//              <p>{$error}</p>";
//              $error_found=1;
// }
if(isset($html)){
echo $html;
}
?>
					</div>
					<div class="col-4 text-center">
					<?php 
          if(!isset($error_found)){
					 $sql="SELECT * from products WHERE pid=:pid"; 
         $stmt = $db->prepare($sql);
           $stmt->bindParam(':pid',$pid,PDO::PARAM_INT);
            $stmt->execute();
           $row=$stmt->fetch();
       echo '<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="uploads/'.$row['image'].'" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">'.$row['title'].'</h5>
  </div>
</div>';
}
				?> 
				<br> 
				</div>
				</div>
		</div>
	</div>	
</div>
</body>
</html>