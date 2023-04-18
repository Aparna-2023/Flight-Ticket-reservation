<?php require 'connection.php'; ?>
<?php require 'header.php'; ?>

<?php session_start();
if (!isset($_SESSION["user"])) {
    header("location:i.php");
}
else 
{
$sql = 'SELECT * FROM airport ';
$statement = $connection->prepare($sql); 
$statement->execute(); 
$airports =$statement->fetchAll(PDO::FETCH_OBJ);}?>
<!-- main div -->
<div
    class="container-fluid m-0 p1 min-vh-100 row justify-content-center py-5"
>
    <div class="col-12 container rounded-3 col-sm-10 p2 px-5 mx-5 text-white">
        <!-- navbar -->
        <nav class="navbar navbar-expand-lg navbar-light mb-5">
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
        <div class="row ">
            <div class="col-12 col-lg-6 my-4">
                <div class="text-white mb-3">
                    <h1>WHERE WOULD YOU</h1>
                    <h1>LIKE TO GO ?</h1>
                </div>   
                <div class="row container my-4">    
                </div>
                <form action="search_index.php" class="" method="POST">
                    <div class="my-3">
                        <select
                            class="form-select"
                            name="DEPARTURE"
                            aria-label="Default select example"
                        >
                            <option selected>FROM</option>
                            <?php 
                              foreach ($airports as $airport)  :?>
                            <option value="<?=$airport->ID;?>">
                                <?=$airport->AIRPORT_NAME;?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="my-3">
                        <select
                            class="form-select"
                            name="ARRIVAL"
                            aria-label="Default select example"
                        >
                            <option selected>To</option>
                            <?php 
                          foreach ($airports as $airport)  :?>
                            <option value="<?=$airport->ID;?>">
                                <?=$airport->AIRPORT_NAME;?>
                            </option>
                            <?php endforeach ?>
                        </select>
                    </div>                   
                    <div class=" my-3">
                        <div class="col ">
                            <input
                                class="form-control "
                                type="date"
                                name="DATE"
                                id="from"
                                placeholder="Date"
                            />
                        </div>
                       
                    </div>
                    <button
                        href="
                    "
                        class="btn btn-success my-1" type="submit" name="submit"
                    >
                        Search
                    </button>
                </form>
            </div>
            <div class="col-12 col-lg-6 my-4">
                <img src="images/blue.gif" class="img-fluid rounded-5" alt="" />
            </div>
        </div>
    </div>
</div>
<?php require "footer.php"; ?>
