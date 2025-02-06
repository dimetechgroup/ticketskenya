<?php

namespace App\Utilities;

use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

use Barryvdh\DomPDF\PDF  as ThePDF;

trait PDFHandler
{
    /**
     * Download PDF.
     *
     * @param  string  $html
     * @param  string  $fileName
     * @return \Illuminate\Http\Response
     */
    protected function downloadPDF(string $html, ?string $fileName = null,  ?string $password = null): ThePDF
    {
        if (is_null($fileName)) {
            $fileName = Str::random(32);
        }

        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

        $pdf = PDF::loadHTML($html)
            ->setPaper('a4')
            ->setWarnings(false)
            ->setOptions([
                'isPhpEnabled' => true,
                'isRemoteEnabled' => true,
                'isHtml5ParserEnabled' => true,
                'isJavascriptEnabled' => true,
            ]);
        if (!is_null($password)) {
            $pdf->setEncryption($password);
        }
        $pdf->download($fileName . '.pdf');
        return $pdf;
    }

    /**
     * Save PDF.
     *
     * @param  string  $html
     * @param  string  $fileName
     * @return string
     */
    protected function savePDF(string $html, ?string $fileName = null, ?string $path = null, ?string $password = null): string
    {
        if (is_null($fileName)) {
            $fileName = Str::random(32);
        }


        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

        $pdf = PDF::loadHTML($html)
            ->setPaper('a4')
            ->setWarnings(false)
            ->setOptions([
                'isPhpEnabled' => true,
                'isRemoteEnabled' => true,
                'isHtml5ParserEnabled' => true,
                'isJavascriptEnabled' => true,
            ]);

        if (is_null($path)) {
            $path = Storage::disk(config('filesystems.default'))->path('pdf');
            //create directory if not exist
            if (!File::exists($path)) {
                mkdir($path, 0777, true);
            }
        }
        $fullFilePath = $path . '/' . $fileName . '.pdf';
        if (!is_null($password)) {
            $pdf->setEncryption($password);
        }
        $pdf->save($fullFilePath);

        return $fullFilePath;
    }
}
