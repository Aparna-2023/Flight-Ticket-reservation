
<?php require('razorpay-php/Razorpay.php'); require_once("config.php");
      // if(!isset($_SESSION['u_id'])) 
      // {
      // 	 header('location:index.php');
      // 	 exit();
      // }
      // else 
      // {
      //   $pid=111111;
      // }

      ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PurpleFly </title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" a href="css/style.css" />
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-sm-12 form-container">
				<h1>Payment</h1>
<hr>
<?php 
include("gateway-config.php");
//Razorpay//
use Razorpay\Api\Api;
// $db = new PDO("mysql:host=localhost;dbname=afrs", "root", "");

$id=4;

$totalprice=$_SESSION['totalprice'];


$seat_no=12;
$passenger_name="TEST";
// $total_passenger=count($passenger_name);
$api = new Api($keyId, $keySecret);

// $registration_id=$_SESSION['registration_id'];
// $amount=$_SESSION['amount'];
// $seat_no=$_SESSION['seat_no'];
// $passenger_name=$_SESSION['passenger_name'];
// $total_passenger=count($passenger_name);
// $api = new Api($keyId, $keySecret);

$firstname='FirstName'; 
$lastname='LastName';
$email="abc@gmail.com";
$mobile=990000000;
$address="sss";
$note="xxx";
// $sql="SELECT * from products WHERE pid=:pid"; 
//          $stmt = $db->prepare($sql);
//            $stmt->bindParam(':pid',$pid,PDO::PARAM_INT);
//             $stmt->execute();
//            $row=$stmt->fetch();
//            $price=$row['price'];
//            $_SESSION['price']=$price;
//            $title=$row['title'];  
$price=$totalprice;
$title="xxx";
$webtitle='PurpleFly'; // Change web title
$displayCurrency='INR';
// $imageurl='https://technosmarter.com/assets/images/Avatar.png';
$imageurl='images/logo.png';
 //change logo from here
$orderData = [
    'receipt'         => 3456,
    'amount'          => $price * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];
$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'];

$_SESSION['razorpay_order_id'] = $razorpayOrderId;

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => $webtitle,
    "description"       => $title,
    "image"             => $imageurl,
    "prefill"           => [
    "name"              => $firstname.' '.$lastname,
    "email"             => $email,
    "contact"           => $mobile,
    ],
    "notes"             => [
    "address"           => $address,
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}
// fetch user details
$json = json_encode($data);
$sql="SELECT * FROM registration WHERE ID=:id";
$stmt=$db->prepare($sql);
$stmt->execute(['id'=>$id]);
$userdata = $stmt->fetch(PDO::FETCH_OBJ); 
       

 ?>
 <!-- BOOKING DETAILS -->
    <div class="row"> 
      <div class="col-8 row"> 
          <div class="col">
          <h4>Payer Details</h4>
            <div class="mb-3">
              <label  class="label">First Name </label>
              
              <?php echo $userdata->FNAME; ?>
            </div>

            <div class="mb-3">
              <label class="label">Email </label>
                <?php echo $userdata->EMAIL; ?>
            </div>
            <div class="mb-3">
              <label class="label">Phone</label>
                <?php echo $userdata->PHONE; ?>
            </div>
          </div>
          <!-- Booking  details of each passenger-->
          <!-- <div class="col">
            <h4>Booking details</h4>
          <table class="table">
            <thead>
              <tr>
                  <th>Number</th>
                  <th>Name</th>
                  <th>Seat No</th>
                  <th>Price</th>
              </tr>  
            </thead>
            <tbody>
              <?php for($i=0;$i<$n;$i++){ ?>
              <tr>
                  <td><?=$i+1;?></td>
                  <td><?=$name[$i];?></td>
                  <td><?=$seat_no[$i];?></td>
                  <td><?=$amount[$i];?></td>
              </tr>
              <?php } ?>
              <tr>
                  <td colspan="3">Total</td>
                  <td><?=$totalprice;?></td>
              </tr>
            </tbody>
          </table>
          </div> -->
          <!-- Booking  details of each passenger-->


      </div>
      <div class="col-4 text-center">
 <!-- BOOKING DETAILS END-->

					<?php 
					//  $sql="SELECT * from products WHERE pid=:pid"; 






          //          $stmt = $db->prepare($sql);
//            $stmt->bindParam(':pid',$pid,PDO::PARAM_INT);
//             $stmt->execute();
//            $row=$stmt->fetch();
//   //      echo '<div class="card" style="width: 18rem;">
//   // <img class="card-img-top" src="uploads/'.$row['image'].'" alt="Card image cap">
//   // <div class="card-body">
//   //   <h5 class="card-title">'.$row['title'].'</h5>
//   //   <p class="card-text">'.$row['price'].' INR</p>
// //   </div>
// // </div>';
// 				?> 
				<br>
     
   <form action="verify.php" method="POST">
  <script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $data['key']?>"
    data-amount="<?php echo $data['amount']?>"
    data-currency="INR"
    data-name="<?php echo $data['name']?>"
    data-image="<?php echo $data['image']?>"
    data-description="<?php echo $data['description']?>"
    data-prefill.name="<?php echo $data['prefill']['name']?>"
    data-prefill.email="<?php echo $data['prefill']['email']?>"
    data-prefill.contact="<?php echo $data['prefill']['contact']?>"
    data-notes.shopping_order_id="<?php echo $pid;?>"
    data-order_id="<?php echo $data['order_id']?>"
    <?php if ($displayCurrency !== 'INR') { ?> data-display_amount="<?php echo $data['display_amount']?>" <?php } ?>
    <?php if ($displayCurrency !== 'INR') { ?> data-display_currency="<?php echo $data['display_currency']?>" <?php } ?>
  >
  </script>
  <!-- Any extra fields to be submitted with the form but not sent to Razorpay -->
  <input type="hidden" name="shopping_order_id" value="<?php echo $payment_id;?>">
</form>


				</div>
				</div>
		</div>
	</div>
</div>
</body>
</html>