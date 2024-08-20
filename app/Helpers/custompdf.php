<?php

namespace App\Helpers;

use TCPDF;

class CustomPDF extends TCPDF {
    public function Header() {
        if ($this->getPage() == 1) {
            // Establecer la posición del logo
            $this->SetXY(15, 10); // Ajusta según tus necesidades
            
            // Establecer la ruta del logo
            $logoPath = public_path('images/pdfcofasalogo.png'); // Usa public_path para obtener la ruta correcta
            
            // Agregar el logo al encabezado
            $this->Image($logoPath, 15, 10, 40, 20, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);

            // Puedes agregar más contenido al encabezado aquí si lo necesitas
        }
    }
    
}
