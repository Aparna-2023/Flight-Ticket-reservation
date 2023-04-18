<?php require 'connection.php'; ?>
<?php require 'header.php'; ?>

<?Php

session_start(); 
$route=$_SESSION["routeid"]; 
$u_id= $_SESSION["uid"];

$sql='SELECT * FROM registration where ID=:id';
$statement=$connection->prepare($sql); $statement->execute([':id'=>$u_id]);
$routes=$statement->fetch(PDO::FETCH_OBJ); 

$user=$routes->FNAME;

if(isset($_POST['submit'])){ 
  $fname1=$_POST['fname']; 
  $fname2=$_POST['fname2'];
$fname3=$_POST['fname3']; 
$fname4=$_POST['fname4']; 
$select1=$_POST['select1'];
$select2=$_POST['select2']; 
$select3=$_POST['select3'];
$select4=$_POST['select4']; 
$c=array($select1,$select2,$select3,$select4);
$k=array($fname1,$fname2,$fname3,$fname4); 
$class=array(); 
$name=array(); $j=0;

for($i=0;$i<3;$i++){ if($c[$i]==0||$c[$i]==1){ $class[$j]=$c[$i];
  $name[$j]=$k[$i]; $j++; } } 
$_SESSION["name"] = $name; 
$_SESSION["class"] =
$class; 
$n=count($class);

// echo $n; 
$sql='SELECT * FROM route where ID=:ROUTE_ID'; 
$statement=$connection->prepare($sql);
$statement->execute([':ROUTE_ID'=>$route]);
$routes=$statement->fetch(PDO::FETCH_OBJ); 

$b=$routes->B_SEAT;
$e=$routes->E_SEAT;

$bf=$routes->B_FARE; 
$ef=$routes->E_FARE; 

$tot=0;
for($i=0;$i<$n;$i++)
{  
  if($class[$i]==0)
  { $b=$b-1; 
    $tot=$tot+$bf; 
    $c="business";   
} 
else
{ $e=$e-1; 
  $tot=$tot+$ef; 
  $c="economy"; } 

  
  $_SESSION['totalprice']=$tot;
 

$sql='UPDATE route SET B_SEAT=:b_seat,E_SEAT=:e_seat WHERE ID=:ROUTE_ID';
$statement=$connection->prepare($sql);
$statement->execute([':b_seat'=>$b,':e_seat'=>$e,':ROUTE_ID'=>$route]);


$sql='INSERT INTO booking(REGISTRATION_ID,ROUTE_ID,STATUS,CREATED_BY) VALUES (:uid,:route_id,0,:user)';
$statement=$connection->prepare($sql);
if($statement->execute([':uid'=>$u_id,':route_id'=>$route,':user'=>$user])) 
//updating passenger table 

$sql='INSERT INTO passenger
(USER_ID,PASSENGER_NAME,ROUTE_ID,CLASS) VALUES (:uid,:name,:route_id,:class)';
$statement=$connection->prepare($sql);
if($statement->execute([':name'=>$name[$i],':route_id'=>$route,':uid'=>$u_id,':class'=>$c]))
{ } } 




} 

if(isset($_POST['submit']))

{
$fname1=$_POST['fname']; $fname2=$_POST['fname2']; $fname3=$_POST['fname3'];
$fname4=$_POST['fname4']; $select1=$_POST['select1'];
$select2=$_POST['select2']; $select3=$_POST['select3'];
$select4=$_POST['select4']; } ?>



<div class="container-fluid m-0 p1 min-vh-100 row justify-content-center py-5">
    <div class="col-12 container rounded-3 col-sm-10 p2 text-white">
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid p-0">
                <h4>Purple Fly.com</h4>

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
                                href="#"
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

        <div class="row justify-content-center my-5">
            <div
                class="col-12 col-lg-7 bg-success bg-opacity-50 rounded-2 py-2"
            >
                <div class="row">
                    <div class="col-12 col-lg-7">
                        <h3 class="my-4">Pay Total Amount</h3>
                    </div>
                 <?php   echo $tot; ?>
                    <h5 class="my-3"><Strong>Payment Details</Strong></h5>
                    <div class="row">
                        <div class="col-7">
                            <p class="mb-1 text-grey">Booked On</p>
                            <p class="mb-1 text-grey">User name</p>

                            <p class="mb-1"><strong>Total</strong></p>
                        </div>
                        <div class="col-5">
                            <h5 class="mb-1 text-grey">PurpleFly.com</h5>
                            <p class="mb-1 text-grey"><?php echo $user ;?></p>

                            <p class="mb-1">
                                <strong> &#8377;<?php echo $tot ;?></strong>
                            </p>

                            
                                <form action="payment/pay.php">
                                <button class="btn btn-success" name="submit" type="submit">Continue</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php require "footer.php"; ?>
    </div>
</div>
