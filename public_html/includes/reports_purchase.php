<?php

include_once('../fpdf/fpdf.php');

$conn = mysqli_connect("localhost","root","","project_inventory_management","3306");
$query=mysqli_query($conn,"SELECT * FROM purchase LEFT JOIN products ON purchase.product_id = products.pid where purchase_date between '".$_GET["start_date_purchase_report"]."' and '".$_GET["end_date_purchase_report"]."' ");


$pdf = new FPDF();
$pdf->Addpage();
$pdf->Rect(7,7,195,275);
    $pdf->SetFont("Arial","",10);
    $pdf->SetX(15);
    //$pdf->Cell(10, 17, $pdf->Image($image1, $pdf->GetX(), $pdf->GetY(), 13), "T", 0,"R",false);
    $pdf->Cell(90,7,"MOB : 9321426800","TL",0,"L");
    $pdf->Cell(89,7,"Whatsapp : 9821426800","RT",1,"R");
    
    $pdf->SetX(15);
    $pdf->SetFont("Arial","B",28);
    $pdf->Cell(179,12,"Vedika Traders","LR",1,"C");
    $pdf->SetX(15);
    $pdf->SetFont("Arial","",11);
    $pdf->Cell(179,6,"Deals in Jewellery Consumables and Industrial Diamond Tools","LR",1,"C");
    $pdf->SetX(15);
    $pdf->Cell(179,6,"A-305, Sarita Bldg., Prabhat Ind. Est. Nr. Toll Naka, Dahisar (E) Mumbai - 68 ","LBR",1,"C");
    $pdf->SetX(15);
    //$pdf->Cell(122,5,"Dealers and manufacturers of Jewellery and Diamond Tools","LBR",1,"C");
    $pdf->SetX(15);
    $pdf->Cell(122,4,"",0,1);
    $pdf->SetX(15);
    $pdf->SetFont("Arial","",17);

    $pdf->Cell(179,1,"","",1);
    $pdf->SetX(15);
    $pdf->Cell(179,8,"Purchase Report","",1,"C");
    $pdf->SetX(15);
    $pdf->SetFont("Arial","",11);
    $pdf->Cell(90,4,"From: ".date("d-m-Y", strtotime($_GET["start_date_purchase_report"])),"",0,"L");
    $pdf->Cell(89,4,"To: ".date("d-m-Y", strtotime($_GET["end_date_purchase_report"])),"",1,"R");
    $pdf->SetX(15);
    $pdf->Cell(179,3,"-----------------------------------------------------------------------------------------------------------------------------------------","",1);
$pdf->Cell(179,3,"","",1);
$pdf->SetX(15);
$pdf->SetFont("Arial","",10);
$pdf->Cell(10,8,"Sr NO.","LTB",0,"C");
$pdf->Cell(40,8,"Product Name","LTB",0,"C");
$pdf->Cell(40,8,"Supplier Name","LTB",0,"C");
$pdf->Cell(20,8,"Purchase","LTB",0,"C");
$pdf->Cell(20,8,"Bill NO.","LTB",0,"C");
$pdf->Cell(21,8,"Cost Price","LTB",0,"C");
$pdf->Cell(27,8,"Date","LTBR",1,"C");

$i=0;
while($row=mysqli_fetch_array($query)) { 
        $i++;
        $pdf->SetX(15);
        $pdf->SetFont("Arial","",10);
        $pdf->Cell(10,8,$row["id"],"L",0,"C");
        $pdf->Cell(40,8,$row["product_name"],"L",0,"C");
        $pdf->Cell(40,8,$row["supplier_name"],"L",0,"C");
        $pdf->Cell(20,8,$row["stock_added"],"L",0,"C");
        $pdf->Cell(20,8,$row["bill_no"],"L",0,"C");
        $pdf->Cell(21,8,$row["price_purchase"],"L",0,"C");
        $pdf->Cell(27,8,$row["purchase_date"],"LR",1,"C");
    }

        $pdf->SetX(15);
        $pdf->SetFont("Arial","",10);
        $pdf->Cell(10,8,"","LB",0,"C");
        $pdf->Cell(40,8,"","LB",0,"C");
        $pdf->Cell(40,8,"","LB",0,"C");
        $pdf->Cell(20,8,"","LB",0,"C");
        $pdf->Cell(20,8,"","LB",0,"C");
        $pdf->Cell(21,8,"","LB",0,"C");
        $pdf->Cell(27,8,"","LBR",1,"C");
        $pdf->SetX(15);

    	$pdf->SetFont("Arial","",11);
        
        $pdf->Cell(179,5," ","",1,"C");
        $pdf->SetX(15);
        $pdf->Cell(104,8,"","",0,"R");
        $pdf->Cell(50,7,"Total Stock Purchased:","LTBR",0,"C");
        $query1=mysqli_query($conn,"SELECT sum(stock_added) as stock_added,sum(price_purchase) as purchase_price FROM purchase where purchase_date between '".$_GET["start_date_purchase_report"]."' and '".$_GET["end_date_purchase_report"]."' ");
        $row1=mysqli_fetch_array($query1);
        $pdf->Cell(20,7,$row1["stock_added"],1,0,"C");
        $pdf->Cell(5,7,"",0,1,"L"); 
        $pdf->SetX(15);
        $pdf->Cell(104,8,"","",0,"R");
        $pdf->Cell(50,7,"Total Cost:","LTBR",0,"C");
        $pdf->Cell(20,7,$row1["purchase_price"],1,0,"C");
        $pdf->Cell(5,7,"",0,1,"L");

$pdf->Output();
