<?php

namespace App\Helpers;

use TCPDF;

class custompdf extends TCPDF {
    public function Header() {
        if ($this->getPage() == 1) {
            // Establecer la posición del logo
            $this->SetXY(15, 10); // Ajusta según tus necesidades
            
            // Establecer la ruta del logo
            $logoPath = public_path('images/pdfcofasalogo.png'); // Usa public_path para obtener la ruta correcta
            
            // Agregar el logo al encabezado
            $this->Image($logoPath, 15, 10, 40, 20, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

            // Ajustar posición para el texto centrado
            $pageWidth = $this->getPageWidth(); // Obtener el ancho de la página

            $text = 'COMPAÑÍA FARMACÉUTICA S.A DE C.V';
            $this->SetFont('helvetica', 'B', 15); // Fuente: Helvetica, negrita, tamaño 16

            // Calcular la posición horizontal del texto para que esté centrado
            $textWidth = $this->GetStringWidth($text);

            $x = ($pageWidth - $textWidth) / 2;

            // Ajustar posición vertical del texto (puedes ajustar según sea necesario)
            $this->SetXY($x, 16); // Ajusta la posición vertical según sea necesario
            
            // Agregar el texto centrado en la página
            $this->Cell($textWidth, 10, $text, 0, 1, 'C'); // Texto centrado en la celda

        }
    }
    
}
