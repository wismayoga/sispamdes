<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Pendataan;
use App\Models\User;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class QRCodeController extends Controller
{
    public function generateQRCodesPDFindie(Request $request)
    {
        // Ambil pengguna dari database
        $users = User::where('id', $request->id)->get();
        $jumlahusers = User::where('status', 'Aktif')->count();

        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf::SetAuthor('Nicola Asuni');
        $pdf::SetTitle('TCPDF Example 050');
        $pdf::SetSubject('TCPDF Tutorial');
        $pdf::SetKeywords('TCPDF, PDF, example, test, guide');

        $y_axis = 20;
        $z_axis = 30;
        $page_counter = 0;

        // Loop melalui setiap pengguna dan tambahkan QR code ke PDF
        foreach ($users as $user) {
            // Buat URL khusus untuk pengguna ini
            $url = 'user/' . $user->id;

            // Tambahkan halaman baru setiap 9 QR code
            if ($page_counter % 12 === 0) {
                $pdf::AddPage();
            }
            // // Tambahkan halaman
            // $pdf::AddPage();

            // set style for barcode
            $style = array(
                'border' => 2,
                'vpadding' => 'auto',
                'hpadding' => 'auto',
                'fgcolor' => array(0, 0, 0),
                'bgcolor' => false, //array(255,255,255)
                'module_width' => 1, // width of a single module in points
                'module_height' => 1 // height of a single module in points
            );

            // QRCODE,L : QR-CODE Low error correction
            $pdf::write2DBarcode($url, 'QRCODE,L', $y_axis, $z_axis, 50, 50, $style, 'N');
            $shortenedName = mb_substr($user->nama, 0, 17);

            $pdf::Text($y_axis, $z_axis - 5, $user->id . "-" . $shortenedName);
            $z_axis += 60;
            if ($z_axis > 210) {
                $z_axis = 30;
                $y_axis += 60;
            }
            if ($y_axis > 140) {
                $y_axis = 20;
            }

            $page_counter++;
        }

        // Simpan PDF ke file
        $filename = 'QRCode-' . $users->first()->nama . '.pdf';
        $pdf::Output(public_path($filename), 'F');
        return response()->download(public_path($filename))->deleteFileAfterSend(true);
    }

    public function generateQRCodesPDF()
    {
        // Ambil semua pengguna dari database
        $users = User::where('status', 'Aktif')->where('role', 'Pelanggan')->get();
        $jumlahusers = User::where('status', 'Aktif')->count();


        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf::SetAuthor('Nicola Asuni');
        $pdf::SetTitle('TCPDF Example 050');
        $pdf::SetSubject('TCPDF Tutorial');
        $pdf::SetKeywords('TCPDF, PDF, example, test, guide');

        $y_axis = 20;
        $z_axis = 30;
        $page_counter = 0;

        // Loop melalui setiap pengguna dan tambahkan QR code ke PDF
        foreach ($users as $user) {
            // Buat URL khusus untuk pengguna ini
            $url = 'user/' . $user->id;

            // Tambahkan halaman baru setiap 9 QR code
            if ($page_counter % 12 === 0) {
                $pdf::AddPage();
            }
            // // Tambahkan halaman
            // $pdf::AddPage();

            // set style for barcode
            $style = array(
                'border' => 2,
                'vpadding' => 'auto',
                'hpadding' => 'auto',
                'fgcolor' => array(0, 0, 0),
                'bgcolor' => false, //array(255,255,255)
                'module_width' => 1, // width of a single module in points
                'module_height' => 1 // height of a single module in points
            );

            // QRCODE,L : QR-CODE Low error correction
            $pdf::write2DBarcode($url, 'QRCODE,L', $y_axis, $z_axis, 50, 50, $style, 'N');
            $shortenedName = mb_substr($user->nama, 0, 17);

            $pdf::Text($y_axis, $z_axis - 5, $user->id . "-" . $shortenedName);
            $z_axis += 60;
            if ($z_axis > 210) {
                $z_axis = 30;
                $y_axis += 60;
            }
            if ($y_axis > 140) {
                $y_axis = 20;
            }

            $page_counter++;
        }

        // Simpan PDF ke file
        $pdf::Output(public_path('QRCodeSISPAMDES.pdf'), 'F');


        return response()->download(public_path('QRCodeSISPAMDES.pdf'))->deleteFileAfterSend(true);
    }
}



// // QRCODE,L : QR-CODE Low error correction
// $pdf::write2DBarcode($url, 'QRCODE,L', 20, 30, 50, 50, $style, 'N');
// $pdf::Text(20, 25, 'QRCODE L);

// // QRCODE,M : QR-CODE Medium error correction
// $pdf::write2DBarcode($url, 'QRCODE,M', 20, 90, 50, 50, $style, 'N');
// $pdf::Text(20, 85, 'QRCODE M');

// // QRCODE,Q : QR-CODE Better error correction
// $pdf::write2DBarcode($url, 'QRCODE,Q', 20, 150, 50, 50, $style, 'N');
// $pdf::Text(20, 145, 'QRCODE Q');

// // QRCODE,H : QR-CODE Best error correction
// $pdf::write2DBarcode($url, 'QRCODE,H', 20, 210, 50, 50, $style, 'N');
// $pdf::Text(20, 205, 'QRCODE H');

// ///
// // QRCODE,L : QR-CODE Low error correction
// $pdf::write2DBarcode($url, 'QRCODE,L', 80, 30, 50, 50, $style, 'N');
// $pdf::Text(80, 25, 'QRCODE L');

// // QRCODE,M : QR-CODE Medium error correction
// $pdf::write2DBarcode($url, 'QRCODE,M', 80, 90, 50, 50, $style, 'N');
// $pdf::Text(80, 85, 'QRCODE M');

// // QRCODE,Q : QR-CODE Better error correction
// $pdf::write2DBarcode($url, 'QRCODE,Q', 80, 150, 50, 50, $style, 'N');
// $pdf::Text(80, 145, 'QRCODE Q');

// // QRCODE,H : QR-CODE Best error correction
// $pdf::write2DBarcode($url, 'QRCODE,H', 80, 210, 50, 50, $style, 'N');
// $pdf::Text(80, 205, 'QRCODE H');

// // QRCODE,L : QR-CODE Low error correction
// $pdf::write2DBarcode($url, 'QRCODE,L', 140, 30, 50, 50, $style, 'N');
// $pdf::Text(140, 25, 'QRCODE L');