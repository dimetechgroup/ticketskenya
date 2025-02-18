<?php

namespace App\Utilities;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;


trait PDFHandler
{
    /**
     * Download PDF.
     *
     * @return \Illuminate\Http\Response
     */
    protected function downloadPDF(string $html, ?string $fileName = null)
    {
        if (is_null($fileName)) {
            $fileName = Str::random(32);
        }

        $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');


        return PDF::loadHTML($html)
            // paper size landscape A6  in pixels 595.276 x 841.89
            ->setPaper("a5", 'landscape')
            ->setOptions([
                'isPhpEnabled' => true,
                'isRemoteEnabled' => true,
                'isHtml5ParserEnabled' => true,
                'isJavascriptEnabled' => true,
            ])
            ->setOption('margin-top', 0)
            ->setOption('margin-bottom', 0)
            ->setOption('margin-left', 10)
            ->setOption('margin-right', 10)

            ->download($fileName . '.pdf');
    }

    /**
     * Download PDF.
     *
     * @param  string  $html
     * @param  string  $fileName
     * @return \Illuminate\Http\Response
     */
    // protected function downloadPDF(string $html, ?string $fileName = null,  ?string $password = null)
    // {
    //     if (is_null($fileName)) {
    //         $fileName = Str::random(32);
    //     }

    //     $html = mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8');

    //     $pdf = PDF::loadHTML($html)
    //         ->setPaper('a4')
    //         ->setWarnings(false)
    //         ->setOptions([
    //             'isPhpEnabled' => true,
    //             'isRemoteEnabled' => true,
    //             'isHtml5ParserEnabled' => true,
    //             'isJavascriptEnabled' => true,
    //         ]);
    //     if (!is_null($password)) {
    //         $pdf->setEncryption($password);
    //     }
    //     $pdf->download($fileName . '.pdf');
    //     return $pdf;
    // }

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
            ])
            ->setOption('margin-top', 0)
            ->setOption('margin-bottom', 0)
            ->setOption('margin-left', 10)
            ->setOption('margin-right', 10);

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
