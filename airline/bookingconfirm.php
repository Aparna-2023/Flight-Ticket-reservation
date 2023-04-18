<?php require 'connection.php'; ?>
<?php require 'header.php'; ?>

<?php 


   session_start(); 

   
                                
   $DEPARTURE=$_SESSION['departure'];
   $ARRIVAL=$_SESSION['arrival'];            
    $sql = 'SELECT * FROM airport WHERE ID=:id';
    $statement = $connection->prepare($sql); $statement->execute([':id'
=>$DEPARTURE]); $depart_name =$statement->fetch(PDO::FETCH_OBJ); $sql = 'SELECT
* FROM airport WHERE ID=:id'; $statement = $connection->prepare($sql);
$statement->execute([':id' =>$ARRIVAL]); $arrival_name =
$statement->fetch(PDO::FETCH_OBJ); $sql='SELECT * FROM route WHERE
DEPARTURE_AIRPORT_ID=:id AND ARRIVAL_AIRPORT_ID=:idtwo';
$statement=$connection->prepare($sql);
$statement->execute([':id'=>$DEPARTURE,':idtwo'=>$ARRIVAL]);
$Route=$statement->fetch(PDO::FETCH_OBJ); ?>

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

        <div class="container col-12 col-lg-10 my-5">
            <a href="homepage.php">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="25"
                    height="25"
                    fill="white"
                    class="bi bi-arrow-left-circle"
                    viewBox="0 0 16 16"
                >
                    <path
                        fill-rule="evenodd"
                        d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"
                    />
                </svg>
            </a>
            <div class="row justify-content-center my-1">
                <div
                    class="col-12 col-lg-9 border justify-content-center row py-2 bg-success bg-opacity-50 border-dark rounded-2"
                >
                    <div class="row mb-4">
                        <div class="col-5 col-sm-5">
                            <!-- place From -->
                            <h5>From</h5>
                            <p class="mb-1 text-grey">
                                <?php echo $depart_name->AIRPORT_NAME ?>
                            </p>
                            <p><?php echo $depart_name->ABBR ?></p>
                        </div>

                        <div class="col-2 text-center col-sm-2">
                            <i class="fa-solid fa-plane"></i>
                        </div>

                        <div class="col-5 col-sm-5">
                            <!-- place To -->
                            <h5>To</h5>
                            <p class="mb-1 text-grey">
                                <?php echo $arrival_name->AIRPORT_NAME ?>
                            </p>
                            <p class="text-grey">
                                <?php echo $arrival_name->ABBR ?>
                            </p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 col-sm-7 mb-1">
                            <p class="text-grey mb-1">
                                <strong>Depart</strong>
                            </p>
                            <p class="mb-0">
                                DATE&nbsp;-&nbsp;<?php echo $Route->DEPARTURE_DATE
                                ?>
                            </p>
                            <p class="mb-0">
                                TIME&nbsp;-&nbsp;<?php echo $Route->DEPARTURE_TIME
                                ?>
                            </p>
                        </div>

                        <div class="col-12 col-sm-5 mb-1">
                            <p class="text-grey mb-1">
                                <strong>Arrival</strong>
                            </p>
                            <p class="mb-0"></p>
                            <p class="mb-0">
                                DATE&nbsp;-&nbsp;<?php echo $Route->ARRIVAL_DATE
                                ?>
                            </p>
                            <p class="mb-0">
                                TIME&nbsp;-&nbsp;<?php echo $Route->ARRIVAL_TIME
                                ?>
                            </p>
                        </div>
                    </div>
                </div>

                <div
                    class="col-12 col-lg-9 border justify-content-center row py-2 bg-success bg-opacity-50 border-dark rounded-2"
                >
                    <form action="price.php" method="POST" class="">
                        <div class="row col-12 m-0 p-0 justify-content-center">
                            <div class="col-12 row col-lg-">
                                <div class="col-9">
                                    <input
                                        type="text"
                                        name="person_count"
                                        class="form-control my-1 border rounded-3 bg-white shadow col-9 col-lg-6"
                                        placeholder="Number of Passenger"
                                        id="person_count"
                                    />
                                </div>
                                <div class="col-9">
                                    <input
                                        type="text"
                                        class="form-control border my-1 rounded-3 bg-white shadow"
                                        placeholder="FullName"
                                        name="fname"
                                        required
                                    />
                                </div>
                                <div class="col-3">
                                    <select
                                        class="form-select my-1"
                                        name="select1"
                                        aria-label="Default select example"
                                    >
                                        <option selected>Select type</option>
                                        <option value="1">Bussiness</option>
                                        <option value="2">Economy</option>
                                    </select>
                                </div>
                                <!-- second passenger -->
                                <div id="person1" class="row p-0 m-0">
                                    <div class="col-9">
                                        <input
                                            type="text"
                                            name="fname2"
                                            class="form-control border my-1 rounded-3 bg-white shadow"
                                            placeholder="FullName"
                                            id=""
                                        />
                                    </div>
                                    <div class="col-3">
                                        <select
                                            name="select2"
                                            class="form-select my-1"
                                            aria-label="Default select example"
                                        >
                                            <option selected>
                                                Select type
                                            </option>
                                            <option value="1">Bussiness</option>
                                            <option value="2">Economy</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- third passenger -->
                                <div id="person2" class="row p-0 m-0">
                                    <div class="col-9">
                                        <input
                                            type="text"
                                            class="form-control border my-1 rounded-3 bg-white shadow"
                                            placeholder="FullName"
                                            name="fname3"
                                        />
                                    </div>
                                    <div class="col-3">
                                        <select
                                            name="select3"
                                            class="form-select my-1"
                                            aria-label="Default select example"
                                        >
                                            <option selected>
                                                Select type
                                            </option>
                                            <option value="1">Bussiness</option>
                                            <option value="2">Economy</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- fourth passenger -->
                                <div id="person3" class="row p-0 m-0">
                                    <div class="col-9">
                                        <input
                                            type="text"
                                            class="form-control border my-1 rounded-3 bg-white shadow"
                                            placeholder="FullName"
                                            name="fname4"
                                        />
                                    </div>

                                    <div class="col-3">
                                        <select
                                            name="select4"
                                            class=" my-1"
                                            aria-label="Default select example"
                                        >
                                            <option selected>
                                                Select type
                                            </option>
                                            <option value="0">Bussines</option>
                                            <option value="1">Economy</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- no.of passengers end -->
                                <div
                                    class="col-12 col-lg-12 d-flex justify-content-center m-0 p-0"
                                >
                                    <input
                                        type="submit"
                                        name="submit"
                                        id=""
                                        value="BOOK"
                                        class="btn btn-success my-2"
                                    />
                                    <?php
                               
                                    $_SESSION["routeid"]=$Route->ID; ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require 'footer.php'; ?>
</div>
