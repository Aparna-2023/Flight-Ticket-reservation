
<?php 
 require 'connection.php';
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
                     $Route=$statement->fetch(PDO::FETCH_OBJ);













    
    // $sql='SELECT * FROM login_data' ;
    // $statement = $connection->prepare($sql);
    // $statement->execute();
    // $employees=$statement->fetchAll(PDO::FETCH_OBJ);




    // ndnd
    $from =$depart_name->AIRPORT_NAME; 
    $to =$arrival_name->AIRPORT_NAME; 
    $passenger="SANDEEP SIVAN S";
    $date=$Route->DEPARTURE_DATE;
    $flight=$Route->FLIGHT_ID;
    $seat="A45";
    $class="First Class";
    $boarding="4:30";
    $departure=$Route->DEPARTURE_TIME;
    $arrival=$Route->ARRIVAL_TIME;

   
?>


<?php
require 'fpdf.php';
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();



$pdf->SetFillColor(255, 0, 0);
$pdf->Image('map.jpg',0,0,200);
// $pdf->Cell(40, 10, "", 1, 0, 'C', true);
$pdf->SetFont('Arial','B',15);
$pdf->Ln(8);
$pdf->Cell(180,10,$from,0,1,'C');
$pdf->Ln(25);
$pdf->Image('flight.png',90,25,30);
// $pdf->Cell(50,10,'',0,0,'C');
$pdf->Cell(180,10,$to,0,1,'C');
// nexxt line for name and date
$pdf->Ln(7);
$pdf->SetFont('Arial','',12);
$pdf->Cell(59,10,'Passenger name:   ',0,0,'R');
$pdf->Cell(61,10,'',0,0,'C');
$pdf->Cell(60,10,'Date:   ',0,1,'L');
// db detalis here
$pdf->SetFont('Arial','B',15);
$pdf->Cell(70,10,$passenger,0,0,'R');
$pdf->Cell(50,10,'',0,0,'C');
$pdf->Cell(60,10,$date,0,1,'L');
// next line for flight number  seat class
$pdf->Ln(3);
$pdf->SetFont('Arial','',12);
$pdf->Cell(41,10,'Flight no:',0,0,'R');
$pdf->Cell(80,10,'Seats:',0,0,'C');
$pdf->Cell(50,10,'Class:   ',0,1,'L');
// db details here
$pdf->SetFont('Arial','B',15);
$pdf->Cell(41,10,$flight,0,0,'R');
$pdf->Cell(80,10, $seat,0,0,'C');
$pdf->Cell(50,10,$class,0,1,'L');
//  next line for departure  bording time departure time  arrival time
$pdf->Ln(3);
$pdf->SetFont('Arial','',12);
$pdf->Cell(50,10,'Borading time',0,0,'R');
$pdf->Cell(72,10,'Departure Time',0,0,'C');
$pdf->Cell(40,10,'Arrival Time',0,1,'L');
// db details here
$pdf->SetFont('Arial','B',15);
$pdf->Cell(40,10,$boarding  ,0,0,'R');
$pdf->Cell(85,10,$departure,0,0,'C');
$pdf->Cell(38,10,$arrival,0,1,'L');





$pdf->Output();
$pdf->Output('D', 'recipt.pdf');
?>


<form action="">

</form>


   




<?php 
    require 'header.php';
?>



<?php
    require 'footer.php';
?>