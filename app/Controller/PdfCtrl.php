<?php


namespace Controller;


class PdfCtrl extends AbstractController
{
    public function invoiceAction()
    {
        require_once('./fpdf/fpdf.php');
        $pdf = new \FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'Hello World!');
        $pdf->Output();
    }



    //neue Pdf erstellen
    public function createPdf()
    {


    }


}