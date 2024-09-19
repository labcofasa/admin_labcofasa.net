<?php

namespace App\Helpers;

use TCPDF;

class custompdf extends TCPDF {
    public function Header() {
        if ($this->getPage() == 1) {
            // Establece la posición del logo
            $this->SetXY(15, 10); // Ajustar el margen
            
            // Establecer la ruta del logo
            $logoPath = public_path('images/pdfcofasalogo.png'); // Usa public_path para obtener la ruta correcta
            
            // Agrega el logo al encabezado
            $this->Image($logoPath, 15, 10, 40, 20, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

            // Ajusta la posición para el texto centrado
            $pageWidth = $this->getPageWidth(); // Obtiene el ancho de la página

            $text = 'COMPAÑÍA FARMACÉUTICA S.A DE C.V';
            $this->SetFont('helvetica', 'B', 15); // Fuente: Helvetica, negrita, tamaño 15

            // Calcula la posición horizontal del texto para que esté centrado
            $textWidth = $this->GetStringWidth($text);

            $x = ($pageWidth - $textWidth) / 2;

            // Ajusta posición vertical del texto
            $this->SetXY($x, 16); // Ajusta la posición vertical según sea necesario (16 para estar  lo más centrado con el logo en y)
            
            // Agrega el texto centrado en la página
            $this->Cell($textWidth, 10, $text, 0, 1, 'C'); // Texto centrado en la celda

        }
    }
    
}
