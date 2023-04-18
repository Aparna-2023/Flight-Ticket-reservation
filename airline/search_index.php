<?php require 'connection.php'; ?>
<?php require 'header.php'; ?>



<?php
     session_start();
     
    if(isset($_POST['submit'])){
        $DEPARTURE= $_POST['DEPARTURE'];
        $ARRIVAL= $_POST['ARRIVAL'];
        $DATE= $_POST['DATE'];
        $sql='SELECT * from `route` WHERE DEPARTURE_AIRPORT_ID=:DEPARTURE AND ARRIVAL_AIRPORT_ID=:ARRIVAL AND DEPARTURE_DATE=:DATE';
        $statement=$connection->prepare($sql);
        $statement->execute([':DEPARTURE'=> $DEPARTURE,':ARRIVAL'=> $ARRIVAL,':DATE'=>$DATE]);
        $flights=$statement->fetchAll(PDO::FETCH_OBJ);  
    }
    
    ?>



<div
    class="container-fluid m-0 p1 min-vh-100 row justify-content-center py-5"
>
    <div class=" col-12 col-lg-10  rounded-3 col-sm-10 p2  text-white">
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light ">
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

        <?php                  
                        
                        $sql = 'SELECT * FROM airport WHERE ID=:id';
                        $statement = $connection->prepare($sql);
                        $statement->execute([':id' => $DEPARTURE]);
                        $depart_name = $statement->fetch(PDO::FETCH_OBJ);
                        
                        $sql = 'SELECT * FROM airport WHERE ID=:id';
                        $statement = $connection->prepare($sql);
                        $statement->execute([':id' => $ARRIVAL]);
                        $arrival_name = $statement->fetch(PDO::FETCH_OBJ);
                        ?>
                        
                        <div class="col-12 text-center text-white py-4">
                          <div class="row">
                            <div class="col-12 text-center">
                                <h2>
                               <?php 
                                $_SESSION["departure"]=$DEPARTURE;
                                $_SESSION["arrival"]=$ARRIVAL;
                                ?>
                                <?php echo $depart_name->ABBR ?> -
                              <?php echo $arrival_name->ABBR ?>
                                </h2>
                              
                            </div>
                          </div>
                        </div>
   
    <div class="container col-12 col-lg-10 bg-light p-0 my-5 ">

    <div
                    
        class="w-100  overflow-x-scroll  "
                    
                >
    <table class="table bg-success bg-opacity-75 m-0 table-hover table-responsive table-striped text-center">
        <thead>
            <tr>
            <th>
                 Sl No
                </th>
                <th>
                Name
                </th>
                <th>
                    Departure
                </th>
                <th>
                    Arrival
                </th>
                <th>
                    Date
                </th>
                
                <th colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i=1;
             foreach($flights as $flight): ?>
                <tr>
                    <td><?= $i?></td>
                    <?php 
                        $id=$flight->FLIGHT_ID;
                        
                        $sql='SELECT * FROM flight where ID=:id';
                        $statement=$connection->prepare($sql);
                        $statement->execute([':id'=>$id]);
                        $route=$statement->fetch(PDO::FETCH_OBJ);

                        $depart=$flight->DEPARTURE_AIRPORT_ID;
                        $sql='SELECT * FROM airport where ID=:id';
                        $statement=$connection->prepare($sql);
                        $statement->execute([':id'=>$depart]);
                        $depart_name=$statement->fetch(PDO::FETCH_OBJ);

                        $arrival=$flight->ARRIVAL_AIRPORT_ID;
                        $sql='SELECT * FROM airport where ID=:id';
                        $statement=$connection->prepare($sql);
                        $statement->execute([':id'=>$arrival]);
                        $arrival_name=$statement->fetch(PDO::FETCH_OBJ);?>

                        <td><?=$route->FLIGHT_NAME;?></td>
                        <td><?= $depart_name->AIRPORT_NAME; ?></td>
                        <td><?= $arrival_name->AIRPORT_NAME; ?></td>
                        <td><?= $flight->DEPARTURE_DATE; ?></td>
                        <td ><a href="bookingconfirm.php?id=<?php echo $flight->id; ?>" class="btn btn-success" target="_blank">Book</a></td>
                    
                        
                </td>
                </tr>
            <tr>
            
            <?php
            $i=$i+1;
             endforeach ?>
        </tbody>
    </table>
             </div>
    <!-- .First flight details end -->
</div>
             </div>
             </div>
             </div>
<!-- container-fluid -->
<?php require 'footer.php'; ?>
