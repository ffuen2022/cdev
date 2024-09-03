<?php

namespace App\Http\Controllers;

use App\Models\SdrDao;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generatePdf($id)
    {
        $sdrDao = SdrDao::findOrFail($id);
        $pdf = Pdf::loadView('content.pdf.sdrdao', ['data' => $sdrDao]);
      
        return $pdf->download('sdr_dao.pdf');
    }
}
