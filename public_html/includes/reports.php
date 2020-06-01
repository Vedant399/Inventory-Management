<?php

include_once('../fpdf/fpdf.php');

$conn = mysqli_connect("localhost","root","","project_inventory_management","3306");
$query=mysqli_query($conn,"SELECT * FROM invoice where order_date between '".$_GET["start_date_sales_report"]."' and '".$_GET["end_date_sales_report"]."' ");


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
    $pdf->Cell(179,8,"Sales Report","",1,"C");
    $pdf->SetX(15);
    $pdf->SetFont("Arial","",11);
    $pdf->Cell(90,4,"From: ".date("d-m-Y", strtotime($_GET["start_date_sales_report"])),"",0,"L");
    $pdf->Cell(89,4,"To: ".date("d-m-Y", strtotime($_GET["end_date_sales_report"])),"",1,"R");
    $pdf->SetX(15);
    $pdf->Cell(179,3,"-----------------------------------------------------------------------------------------------------------------------------------------","",1);
$pdf->Cell(179,3,"","",1);
$pdf->SetX(15);
$pdf->SetFont("Arial","",10);
$pdf->Cell(22,8,"Chalan NO.","LTB",0,"C");
$pdf->Cell(40,8,"Customer Name","LTB",0,"C");
$pdf->Cell(24,8,"Date","LTB",0,"C");
$pdf->Cell(20,8,"Sub Total","LTB",0,"C");
$pdf->Cell(16,8,"Freight","LTB",0,"C");
$pdf->Cell(21,8,"Net Total","LTB",0,"C");
$pdf->Cell(17,8,"Paid","LTB",0,"C");
$pdf->Cell(18,8,"Due","LTBR",1,"C");

$i=0;
while($row=mysqli_fetch_array($query)) { 
        $i++;
        $pdf->SetX(15);
        $pdf->Cell(22,8," ".$row["invoice_no"],"LR",0,"");    
        $pdf->Cell(40,8," ".$row["customer_name"],"LR",0,"");    
        $pdf->Cell(24,8,$row["order_date"],"LR",0,"");
        $pdf->Cell(20,8," ".$row["sub_total"],"LR",0,"");
        $pdf->Cell(16,8," ".$row["gst"],"LR",0,"");
        $pdf->Cell(21,8," ".$row["net_total"],"LR",0,"");
        $pdf->Cell(17,8," ".$row["paid"],"LR",0,"");
        $pdf->Cell(18,8," ".$row["due"],"LR",1,"");
    }

        $pdf->SetX(15);
        $pdf->Cell(22,8," ","LBR",0,"C");    
        $pdf->Cell(40,8," ","LBR",0,"C");    
        $pdf->Cell(24,8," ","LBR",0,"C");
        $pdf->Cell(20,8," ","LBR",0,"C");
        $pdf->Cell(16,8," ","LBR",0,"C");
        $pdf->Cell(21,8," ","LBR",0,"C");
        $pdf->Cell(17,8," ","LBR",0,"C");
        $pdf->Cell(18,8," ","LBR",1,"C");
        $pdf->Cell(179,5," ","",1,"C");
        $pdf->SetX(15);

    	$pdf->SetFont("Arial","",11);
        
        $pdf->Cell(179,5," ","",1,"C");
        $pdf->SetX(15);
        $pdf->Cell(119,8,"","",0,"R");
        $pdf->Cell(40,7,"Total Profit:","LTBR",0,"C");
        $query1=mysqli_query($conn,"SELECT sum(sub_total) as sub_total,sum(paid) as paid,sum(due) as due FROM invoice where order_date between '".$_GET["start_date_sales_report"]."' and '".$_GET["end_date_sales_report"]."' ");
        $row1=mysqli_fetch_array($query1);
        $pdf->Cell(15,7,$row1["sub_total"],1,0,"L");
        $pdf->Cell(5,7,"",0,1,"L"); 
        $pdf->SetX(15);
        $pdf->Cell(119,8,"","",0,"R");
        $pdf->Cell(40,7,"Paid:","LTBR",0,"C");
        $pdf->Cell(15,7,$row1["paid"],1,0,"L");
        $pdf->Cell(5,7,"",0,1,"L");
        $pdf->SetX(15);
        $pdf->Cell(119,8,"","",0,"R");
        $pdf->Cell(40,7,"Due:","LTBR",0,"C");
        $pdf->Cell(15,7,$row1["due"],1,0,"L");
        $pdf->Cell(5,7,"",0,1,"L");


$pdf->Output();
