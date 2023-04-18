<?php require 'connection.php'; ?>
<?php require 'header.php'; ?>
  

<?php 
 session_start();
if (!isset($_SESSION["user"])) {
    header("location:i.php");
}
else if(isset($_POST['airport_name'])&&($_POST['abbr'])&&($_POST['state_name'])){
  
        $state_name=$_POST['state_name'];
        $airport_name=$_POST['airport_name'];
        $abbr=$_POST['abbr'];
        // echo  $state_name;
        $sql='SELECT * FROM airport WHERE AIRPORT_NAME = :airport_name';
        $stmt = $connection->prepare($sql);
        $stmt->execute(['airport_name'=>$airport_name]);
        $check_airport= $stmt->fetch(PDO::FETCH_OBJ);

        $sql='SELECT * FROM airport WHERE ABBR = :abbr';
        $stmt = $connection->prepare($sql);
        $stmt->execute(['abbr'=>$abbr]);
        $check_abbr= $stmt->fetch(PDO::FETCH_OBJ);
        if(  $check_airport ) {
           
              $_SESSION['status'] = "Airport already exist !";
              $_SESSION['status_code'] = "error";
              $_SESSION['message'] = "oops..";
              $_SESSION['page'] = "adminhome.php";
          }
          else if( $check_abbr){
            $_SESSION['status'] = "Abbreviation already exist !";
              $_SESSION['status_code'] = "error";
              $_SESSION['message'] = "oops..";
              $_SESSION['page'] = "adminhome.php";
          }
           else {
            $sql='INSERT INTO airport(AIRPORT_NAME,STATE_ID,ABBR,CREATED_BY,UPDATED_BY,CREATED_AT,UPDATED_AT)VALUES(:airport_name,:state_id,:abbr,"admin","admin",now(),now())';
            $statement=$connection->prepare($sql);
            if($statement->execute([':airport_name'=>$airport_name,':state_id'=>$state_name,':abbr'=>$abbr]))
            {   
              $_SESSION['status'] = "Successfully Inserted.";
              $_SESSION['status_code'] = "success";
              $_SESSION['message'] = "success";
              $_SESSION['page'] = "adminhome.php";
            }
    }
    }
    // Display states
    $sql="SELECT STATE_NAME,ID FROM state"; 
    $statement=$connection->prepare($sql); 
    $statement->execute();
    $states=$statement->fetchAll(PDO::FETCH_OBJ);  
// delete table
if(isset($_POST['btn_delete'])){
    
    $airport_name=$_POST['airport_name'];
    $sql='DELETE FROM airport WHERE AIRPORT_NAME=:airport_name';
    $statement = $connection -> prepare($sql);
    $statement->execute([':airport_name'=>$airport_name]);
    if( $statement)
            {
              
                $_SESSION['status'] = "Successfully Deleted";
                $_SESSION['status_code'] = "success";
                $_SESSION['message'] = "Deleted.";
                $_SESSION['page'] = "adminhome.php";
                
            }
}
?>
<!-- code for airline -->

<!-- code for flights -->

<div
    class="container-fluid m-0 p1 min-vh-100 row justify-content-center py-5"
>
    <div class="col-12 container rounded-3 col-sm-10 p2  mx-5 text-white">
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light mb-5">
            <div class="container-fluid">
                <a class="navbar-brand text-white" href="#">
                    <div class="col-2">
                        <div class="col-6 d-flex">
                            <h4>Purple Fly.com</h4>
                        </div>
                    </div>
                    <div class="col-2"></div>
                </a>
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
        <div class="container-fluid">
                    <div class="col-12">
                        <h1 class="">WELCOME ADMIN</h1>
                    </div>
            <div class="row">
                <div class="col-12 col-lg-6 my-4">
                    
                    <div class="col-12 row">
                        <div class="col-12 col-md-6">
              
                            <form
                                action=""
                                method="post"
                            >
                                <div class="dropdown my-2">
                                

                                    <button
                                        class="btn col-12 btn-success dropdown-toggle"
                                        type="button"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                    >
                                        ADD/DELETE AIRPORT
                                    </button>
                                    <ul class="dropdown-menu p-5">
                                        <li>
                                            <input
                                                class="border border-2 border-grey my-1 dropdown-item form-control"
                                                name="airport_name"
                                                placeholder="Airport Name"
                                            />
                                        </li>
                                        <li>
                                            <input
                                                class="border border-2 border-grey my-1 dropdown-item form-control"
                                                name="abbr"
                                                placeholder="Abbr"
                                            />
                                        </li>

                                        <li>
                                            <select
                                                class="col-12 form-control"
                                                name="state_name"
                                                id="state_name"
                                            >
                                                <option>States</option>
                                                <?php foreach ($states as $state): ?>
                                                <option
                                                    value="<?= $state->ID; ?>"
                                                >
                                                    <?= $state->STATE_NAME;?>
                                                </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </li>

                                        <li>
                                            <button
                                                name="submit"
                                                class="btn btn-success"
                                            >
                                                Add
                                            </button>
                                            <button
                                                name="btn_delete"
                                                class="btn btn-danger"
                                            >
                                                Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-md-6">
                        
<?php

    if(isset($_POST['AIRLINE_NAME']))
    {
       
        
        $airline_name=$_POST['AIRLINE_NAME'];
        $sql='SELECT * FROM airline WHERE AIRLINE_NAME=:AIRLINE_NAME';
        $statement=$connection->prepare($sql);
        $statement->execute(['AIRLINE_NAME' =>$airline_name]);
        $airline_data= $statement->fetch(PDO :: FETCH_OBJ);
        if($airline_data){
            $_SESSION['status'] = "Airline already exist";
            $_SESSION['status_code'] = "error";
            $_SESSION['message'] = "Oops."; 
            $_SESSION['page'] = "adminhome.php";   
                }     
        else{ 
            $sql='INSERT INTO airline(AIRLINE_NAME,CREATED_BY,UPDATED_BY,CREATED_AT,UPDATED_AT)VALUES(:AIRLINE_NAME,"admin","admin",now(),now())';
                $statement=$connection->prepare($sql);
                if($statement->execute([':AIRLINE_NAME'=>$airline_name])){    
                                   $_SESSION['status'] = "success";
                                   $_SESSION['status_code'] = "success";
                                   $_SESSION['message'] = "Data added successfully!";
                                   $_SESSION['page'] = "adminhome.php";

                 }
            }
    }
    if(isset($_POST['delete'])){
        $airline_name=$_POST['AIRLINE_NAME'];
        $sql='DELETE FROM airline WHERE AIRLINE_NAME=:AIRLINE_NAME';
        $statement=$connection->prepare($sql);
        if($statement->execute([':AIRLINE_NAME'=>$airline_name])){   
                   $_SESSION['status'] = "success";
                   $_SESSION['status_code'] = "success";
                   $_SESSION['message'] = "Data deleted successfully!";
                   $_SESSION['page'] = "adminhome.php";
        }
    }
?>
                            <form action="" method="post">
                                <div class="dropdown mt-2">
                                    <button
                                        class="btn col-12 btn-success dropdown-toggle"
                                        type="button"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                    >
                                        ADD/DELETE AIRLINES
                                    </button>
                                    <ul class="dropdown-menu p-5">
                                        <li>
                                            <input
                                                name="AIRLINE_NAME"
                                                class="col-12 border border-2 border-grey my-1 dropdown-item form-control"
                                                placeholder="Airline Name"
                                            />
                                        </li>
                                        <li>
                                            <button
                                                type="submit"
                                                name="submit"
                                                class="btn btn-success"
                                            >
                                                Add
                                            </button>
                                            <button
                                                type="submit"
                                                name="delete"
                                                class="btn btn-danger"
                                            >
                                                Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                        
                        <div class="col-12 col-md-6">



                        <?php 

    if(isset($_POST['FLIGHT_NAME'])&&($_POST['AIRLINE_NAME'])&&($_POST['TOTAL_SEAT'])){
        $FLIGHT_NAME=$_POST['FLIGHT_NAME'];
        $AIRLINE_NAME=$_POST['AIRLINE_NAME'];
        $TOTAL_SEAT=$_POST['TOTAL_SEAT'];
        $sql='SELECT * FROM flight WHERE FLIGHT_NAME=:FLIGHT_NAME';
        $statement=$connection->prepare($sql);
        $statement->execute(['FLIGHT_NAME'=>$FLIGHT_NAME]);
        $check_flight=$statement->fetch(PDO::FETCH_OBJ);
        if($check_flight){
              $_SESSION['status'] = "Oops...";
              $_SESSION['status_code'] = "error";
              $_SESSION['message'] = "Flight already exist !";
              $_SESSION['page'] = "adminhome.php";
    }
    else{
        $sql='INSERT INTO flight(FLIGHT_NAME,AIRLINE_ID,TOTAL_SEAT,CREATED_BY,UPDATED_BY,CREATED_AT,UPDATED_AT)VALUES(:FLIGHT_NAME,:AIRLINE_ID,:TOTAL_SEAT,"admin","admin",now(),now())';
        $statement=$connection->prepare($sql);
        if($statement->execute([':FLIGHT_NAME'=>$FLIGHT_NAME,'AIRLINE_ID'=>$AIRLINE_NAME,'TOTAL_SEAT'=>$TOTAL_SEAT])){
              $_SESSION['status'] = "success";
              $_SESSION['status_code'] = "success";
              $_SESSION['message'] = "Data added successfully!";
              $_SESSION['page'] = "adminhome.php";
        
         }
    }
}
    $sql='SELECT AIRLINE_NAME,ID FROM airline';
    $statement=$connection->prepare($sql);
    $statement->execute();
     $flights=$statement->fetchAll(PDO::FETCH_OBJ);
    if(isset($_POST['delete2'])){
        $FLIGHT_NAME=$_POST['FLIGHT_NAME'];
        $sql='DELETE FROM flight WHERE FLIGHT_NAME=:FLIGHT_NAME';
        $statement=$connection->prepare($sql);
        if($statement->execute([':FLIGHT_NAME'=>$FLIGHT_NAME])){
          
            $_SESSION['status'] = "success";
              $_SESSION['status_code'] = "success";
              $_SESSION['message'] = "Data deleted successfully!";
              $_SESSION['page'] = "adminhome.php";
        }     
    }
?>
                    <form action="" method="post">
                                <div class="dropdown mt-2">
                                    <button
                                        class="btn col-12 btn-success dropdown-toggle"
                                        type="button"
                                        data-bs-toggle="dropdown"
                                        aria-expanded="false"
                                    >
                                        ADD/DELETE FLIGHTS
                                    </button>
                                    <ul class="dropdown-menu p-5">
                                        <li>
                                            <input
                                                name="FLIGHT_NAME"
                                                class="col-12 border border-2  border-grey my-1 dropdown-item form-control"
                                                placeholder="Flight Name"
                                            />
                                        </li>
                                        <li>
                                            <input
                                                class="col-12 border border-2 border-grey my-1 dropdown-item form-control"  
                                                name="TOTAL_SEAT"
                                                placeholder="TOTAL SEAT"
                                            />
                                        </li>
                                        <li>
                                        <select class="form-select" name="AIRLINE_NAME">
				                            <option value disabled selected>Choose airline:</option>
                                             <?php foreach($flights as $flight):?>
				                               <option value="<?= $flight->ID; ?>" required><?= $flight->AIRLINE_NAME;?></option>		
                                            <?php endforeach;?>		
                                         </select>
                                            
                                        </li>

                                        <li>
                                            <button
                                                type="submit"
                                                name="submit"
                                                class="btn btn-success"
                                            >
                                                Add
                                            </button>
                                            <button
                                                type="submit"
                                                name="delete2"
                                                class="btn btn-danger"
                                            >
                                                Delete
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                        <div class="col-12 col-lg-6">

<?php
                         

if(isset($_POST['booking'])){
        
    $sql="SELECT * FROM booking"; 
    $statement=$connection->prepare($sql); 
    $statement->execute();
   if($bookings=$statement->fetchAll(PDO::FETCH_OBJ))  {
          
          
        }  
        else{
            $_SESSION['status'] = "success";
            $_SESSION['status_code'] = "error";
            $_SESSION['message'] = "No bookings!";
            $_SESSION['page'] = "adminhome.php";
        }   
    }?>

                            <form action="" method="post">
                                <button name="booking" class="btn col-12 my-2 btn-success">
                                    SHOW BOOKING DETAIL
                                </button>
                            </form>
                            
                        </div>                       
            <div class="col-12 row mt-2 p-0 m-0  justify-content-center">
                <div class="col-12 col-lg-6">
                    <button
                        id="button1"
                        type="submit"
                        name="airports"
                        class="btn col-12 my-2 btn-success"
                    >
                       VIEW AIRPORTS
                    </button>
                </div>
                <div class="col-12 col-lg-6">
                    <button
                        id="button2"
                        type="submit"
                        name="flight"
                        class="btn col-12 my-2 btn-success"
                    >
                    VIEW FLIGHTS
                    </button>
                </div>
                <div class="col-12 col-lg-6">
                    <button
                        id="button3"
                        type="submit"
                        name="airline"
                        class="btn col-12 my-2 btn-success"
                    >
                   VIEW AIRLINES
                    </button>
                </div>
                <div class="col-12 col-lg-6">
                    <button
                        id="button4"
                        type="submit"
                        name="Route"
                        class="btn col-12 my-2 btn-success"
                    >
                    VIEW ROUTES
                    </button>
                </div>
            </div>
            <?php 
 $query='SELECT ID,FLIGHT_NAME FROM flight';
 $stmnt=$connection->prepare($query);
 $stmnt->execute();
 $flights=$stmnt->fetchall(PDO::FETCH_OBJ);
    ?>
<?php
     $sql='SELECT ID,AIRPORT_NAME FROM airport ';
     $statement=$connection->prepare($sql);
     $statement->execute();
     $airports=$statement->fetchAll(PDO::FETCH_OBJ);

   ?>
    <form action="" method="POST">
        <div>
        <select class="form-select my-5 mb-1" name="flight_name">
				<option value disabled selected>FLIGHT_NAME:</option>
                <?php foreach($flights as $flight):?>
				<option value="<?=$flight->ID; ?>" required><?= $flight->FLIGHT_NAME;?></option>		
                <?php endforeach;?>		
             </select>
        </div>
        <div class="row ">
            <div class="col-sm">
            <select class="form-select" name="departure_name">
				<option value disabled selected>FROM:</option>
                <?php foreach($airports as $airport):?>
				<option value="<?= $airport->ID; ?>" required><?= $airport->AIRPORT_NAME;?></option>		
                <?php endforeach;?>	
             </select>
            </div>
            <div class="col-sm">
            <select class="form-select" name="arrival_name">
				<option value disabled selected>TO:</option>
                <?php foreach($airports as $airport):?>
				<option value="<?= $airport->ID; ?>" required><?= $airport->AIRPORT_NAME;?></option>		
                <?php endforeach;?>		
             </select>
            </div>
        </div>
           <div class="row mb-4">
                <div class="col-sm">
                    <label>Departure_date</label>
                    <input type="date" name="departure_date"   class="form-control">
                </div>
                <div class="col-sm">
                    <label>Arrival_date</label>
                    <input type="date" name="arrival_date"  class="form-control">
                </div>
           </div>
           <div class="row mb-4">
            <div class="col-sm">
                <label>Departure_Time</label>
                <input type="time" name="departure_time"  class="form-control">
            </div>
            <div class="col-sm">
                <label>Arrival_Time</label>
                <input type="time" name="arrival_time"  class="form-control">
            </div>
       </div>  
            <input type="submit" name="add_route" value="ADD ROUTE" class="btn btn-info">
            <input type="btn" name="delete_route" value="DELETE ROUTE" class="btn btn-warning">
    </form>
           
            </div>
        </div>
        <div class="col-12 col-lg-6 my-4">
                <?php 
                    
          
                $sql='SELECT * FROM airport';
                $statement=$connection->prepare($sql); $statement->execute();
                $airport=$statement->fetchAll(PDO::FETCH_OBJ);?>
                <div
                    id="p"
                    class="w-100 rounded overflow-scroll"
                    style="height:400px"
                >
                    <table
                        class="table table-hover table-dark table-responsive table-bordered text-center"
                    >
                        <thead>
                            <tr>
                                <th>Airport id</th>

                                <th>Airport Name</th>

                                <th>State id</th>

                                <th>Abbr</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <tr></tr>
                            <tr>
                                <?php
                        
                           
                            foreach($airport as $air): ?>
                            </tr>

                           
                            <tr>
                                <td><?= $air->ID; ?></td>
                                <td><?= $air->AIRPORT_NAME; ?></td>
                                <td><?= $air->STATE_ID; ?></td>
                                <td><?=$air->ABBR; ?></td>
                               
                            </tr>
                            <?php
                       
                         endforeach ?>
                        </tbody>
                    </table>
                </div>

                <?php 
     
     
          $sql='SELECT * FROM flight'; 
          $statement=$connection->prepare($sql); $statement->execute();
                $flight=$statement->fetchAll(PDO::FETCH_OBJ);?>
                <div
                    id="myDiv"
                    class="w-100 rounded overflow-scroll "
                    style="height: 200px"
                >
                    <table
                        class="table table-hover table-dark table-responsive table-bordered text-center"
                    >
                        <thead>
                           
                            <tr>
                                <th>Flight id</th>
                                <th>Flight Name</th>
                                <th>Airline Id</th>
                                <th>Total Seat</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <tr></tr>
                            <tr>
                                <?php
             foreach($flight as $fly): ?>
                            </tr>

                            <tr>
                                <td><?= $fly->ID; ?></td>

                                <td><?= $fly->FLIGHT_NAME; ?></td>
                                <td><?= $fly->AIRLINE_ID; ?></td>
                                <td><?= $fly->TOTAL_SEAT; ?></td>
                             
                            </tr>
                            <?php
        
          endforeach ?>
                        </tbody>
                    </table>
                </div>

                <?php 
     
                
                     $sql='SELECT * FROM airline'; 
                     $statement=$connection->prepare($sql);
                $statement->execute();
                $airlines=$statement->fetchAll(PDO::FETCH_OBJ);?>
                <div
                    class="w-100 rounded overflow-scroll "
                    style="height: 200px"
                    id="my"
                >
                    <table
                        class="table table-hover table-dark table-responsive table-bordered text-center"
                    >
                        <thead>
                            <tr>
                                <th>Airline id</th>

                                <th>Airline Name</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr></tr>
                            <tr>
                                <?php
                        foreach($airlines as $airline): ?>
                            </tr>

                            <tr>
                                <td><?= $airline->ID; ?></td>
                                <td><?= $airline->AIRLINE_NAME; ?></td>
                                
                            </tr>
                            <?php
                   
                     endforeach ?>
                        </tbody>
                    </table>
                </div>

                <!-- code for routess -->

                <?php 
                $sql='SELECT * FROM route'; 
                $statement=$connection->prepare($sql); $statement->execute();
                $Routes=$statement->fetchAll(PDO::FETCH_OBJ);?>
                <div
                    class="w-100 rounded overflow-scroll "
                    style="height: 200px"
                    id="myroute"
                >
                    
                    <table
                        class="table table-hover table-dark table-responsive table-bordered text-center"
                    >
                        <thead>
                            <tr>
                                <th>Route id</th>
                                <th>Fight id</th>
                                <th>Departure Name</th>
                                <th>Arrival Name</th>
                                <th>Departure Date</th>
                                <th>Arrival Date</th>
                                <th>Departure time</th>
                                <th>Arrival time</th>
                              
                            </tr>
                        </thead>
                        <tbody>
                            <tr></tr>
                            <tr>
                                <?php
                        foreach($Routes as $Route): ?>
                            </tr>

                            <tr>
                                <td><?= $Route->ID; ?></td>
                                <td><?= $Route->FLIGHT_ID; ?></td>
                                <td><?= $Route->DEPARTURE_AIRPORT_ID; ?></td>
                                <td><?= $Route->ARRIVAL_AIRPORT_ID; ?></td>
                                <td><?= $Route->ARRIVAL_TIME; ?></td>
                                <td><?= $Route->DEPARTURE_TIME; ?></td>
                                <td><?= $Route->ARRIVAL_DATE; ?></td>
                                <td><?= $Route->DEPARTURE_DATE; ?></td>
                             
                            </tr>
                            <?php
                   
                     endforeach ?>
                        </tbody>
                    </table>
                </div>
<!-- closing table -->
<?php 
    if(isset($_POST['add_route'])){
        $flight_id=$_POST['flight_name'];
        $departure_id=$_POST['departure_name'];
        $arrival_id=$_POST['arrival_name'];
        $departure_date=$_POST['departure_date'];
        $arrival_date=$_POST['arrival_date'];
        $departure_time=$_POST['departure_time'];
        $arrival_time=$_POST['arrival_time'];
       
                $route_sql='INSERT INTO route(FLIGHT_ID,ARRIVAL_AIRPORT_ID,DEPARTURE_AIRPORT_ID,DEPARTURE_DATE,ARRIVAL_DATE,DEPARTURE_TIME,ARRIVAL_TIME,CREATED_BY,UPDATED_BY,CREATED_AT,UPDATED_AT)VALUES(:FLIGHT_ID,:ARRIVAL_AIRPORT_ID,:DEPARTURE_AIRPORT_ID,:DEPARTURE_DATE,:ARRIVAL_DATE,:DEPARTURE_TIME,:ARRIVAL_TIME,"admin","admin",now(),now())';
                $statement=$connection->prepare($route_sql);
                if($statement->execute([':FLIGHT_ID'=>$flight_id,':ARRIVAL_AIRPORT_ID'=>$arrival_id,':DEPARTURE_AIRPORT_ID'=> $departure_id,':DEPARTURE_DATE'=>$departure_date,':ARRIVAL_DATE'=>$arrival_date,':DEPARTURE_TIME'=> $departure_time,':ARRIVAL_TIME'=>$arrival_time])){
                   

                    $_SESSION['status'] = "success";
                    $_SESSION['status_code'] = "success";
                    $_SESSION['message'] = "Route added successfully!";
                    
                   
                   
            
                
                }
             }
?>

</div>


    
</div>
                </div>

               
            </div>
        </div>



    </div>
    
</div>
<?php require 'footer.php'; ?>


