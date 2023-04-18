<?php require 'connection.php'; ?>
<?php require 'header.php'; ?>


<?php 
   session_start(); 
   $DEPARTURE=$_SESSION['departure'];
   $ARRIVAL=$_SESSION['arrival'];

                
                        $sql = 'SELECT * FROM airport WHERE ID=:id';
                        $statement = $connection->prepare($sql);
                        $statement->execute([':id' => $DEPARTURE]);
                        $depart_name = $statement->fetch(PDO::FETCH_OBJ);
                        $sql = 'SELECT * FROM airport WHERE ID=:id';
                        $statement = $connection->prepare($sql);
                        $statement->execute([':id' => $ARRIVAL]);
                        $arrival_name = $statement->fetch(PDO::FETCH_OBJ);
                        
                        $sql='SELECT * FROM route WHERE DEPARTURE_AIRPORT_ID=:id'; 
                        $statement=$connection->prepare($sql); 
                        $statement->execute([':id' => $DEPARTURE]);
                        $Route=$statement->fetch(PDO::FETCH_OBJ);?>





<div class="container-fluid m-0 p1 min-vh-100 row justify-content-center py-5">
    <div class="col-12 col-lg-10 rounded-3 col-sm-10 p2 text-white">
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
        <div class="container-fluid row text-black m-0 justify-content-center">
            <div
                class="container col-12 bg-light col-md-7 my-5 p-0 bg-opacity-75 row justify-content-center rounded-4"
            >
                <div class="row col-10 mt-5 mb-2 text-center">
                    <div class="col-4">
                        <h6 class="mt-5"><?php echo $depart_name->AIRPORT_NAME ?></h6>
                        <h5 class="color">(<?php echo $depart_name->ABBR ?>)</h5>
                    </div>
                    <div class="col-4 fs-1 text-center">
                        <i class="fa-solid fa-plane mt-5"></i>
                    </div>
                    <div class="col-4 text-center">
                        <h6 class="mt-5"><?php echo $arrival_name->AIRPORT_NAME ?></h6>
                        <h5 class="color">(<?php echo $arrival_name->ABBR ?>)</h5>
                    </div>
                </div>

                <div class="col-6 text-center">
                    <div class="my-1">
                        <h5 class="">Passenger</h5>
                        <h6 class="text-secondary">Anna</h6>
                    </div>
                    <div class="my-1">
                        <h5 class="">Seat No</h5>
                        <h6 class="text-secondary">25</h6>
                    </div>
                    <div class="my-1">
                        <h5 class="">Departure</h5>
                        <h6 class="text-secondary"><?php echo  $Route->DEPARTURE_TIME ?></h6>
                    </div>
                </div>

                <div class="col-6 text-center">
                    <div class="my-1">
                        <h5 class="">Flight Id</h5>
                        <h6 class="text-secondary"><?php echo  $Route->FLIGHT_ID ?></h6>
                    </div>
                    <div>
                        <h5 class="">Date</h5>
                        <h6 class="text-secondary"><?php echo  $Route->DEPARTURE_DATE ?></h6>
                    </div>
                    <div>
                        <h5 class="my-1">Arrival</h5>
                        <h6 class="text-secondary"><?php echo  $Route->ARRIVAL_TIME ?></h6>
                    </div>
                </div>

                <a href="fpdf/receipt.php
            " class="btn btn-success col-4 my-3">Print PDF</a> 
            </div>
        </div>
        <!-- container div closed -->
    </div>
</div>
<?php require 'footer.php'; ?>
