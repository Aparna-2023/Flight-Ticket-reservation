<?php require 'connection.php'; ?>
<?php require 'header.php'; ?>

<?php session_start(); 
?>
<!-- main div -->
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
        <div class="row justify-content-center">
            <div class="col-6 row mt-5 justify-content-center">
                <div class="col-12">
                    <button
                        id="button1"
                        type="submit"
                        name="airports"
                        class="btn col-12 my-2 btn-success"
                    >
                        Airports
                    </button>
                </div>
                <div class="col-12 col-lg-6">
                    <button
                        id="button2"
                        type="submit"
                        name="flight"
                        class="btn col-12 my-2 btn-success"
                    >
                        Flights
                    </button>
                </div>
                <div class="col-12 col-lg-6">
                    <button
                        id="button3"
                        type="submit"
                        name="airline"
                        class="btn col-12 my-2 btn-success"
                    >
                        Airline
                    </button>
                </div>
                <div class="col-12 col-lg-6">
                    <button
                        id="button4"
                        type="submit"
                        name="Route"
                        class="btn col-12 my-2 btn-success"
                    >
                        Routes
                    </button>
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
                    style="height:250px"
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
            </div>
        </div>
    </div>
</div>

<?php require "footer.php"; ?>
