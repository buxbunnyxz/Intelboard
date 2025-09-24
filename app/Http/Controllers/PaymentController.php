<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Calculation;
use Smalot\PdfParser\Parser;

class PaymentController extends Controller
{
    public function index()
    {
        $drivers = Driver::all();
        return view('payments', compact('drivers'));
    }

    public function show($driver_id, $week)
    {
        $driver = Driver::findOrFail($driver_id);
        $weekNumber = $this->toWeekNumber($week);

        $calculation = Calculation::where('driver_id', $driver->id)
            ->where('week_number', $weekNumber)
            ->first();

        return view('paydetails', [
            'driver' => $driver,
            'week' => $week,
            'calculation' => $calculation,
        ]);
    }

    private function toWeekNumber($week)
    {
        return (int) preg_replace('/[^0-9]/', '', $week);
    }

    public function batchUpload(Request $request)
    {
        $request->validate([
            'files' => 'required',
            'files.*' => 'file|mimes:pdf|max:5120',
        ]);

        $files = $request->file('files', []);
        $files = is_array($files) ? $files : [$files];

        $parser = new Parser();
        $results = [];

        foreach ($files as $file) {
            if (!$file) {
                continue;
            }

            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            // Example: 2025-32-C0U9622-Z0X1231-MONT.pdf => U9622
            preg_match('/C0([A-Z]\d+)/i', $filename, $matches);
            $driverId = isset($matches[1]) ? strtoupper($matches[1]) : null;

            if (!$driverId) {
                continue;
            }

            $driver = Driver::where('driver_id', $driverId)->first();

            $text = '';
            try {
                $pdf = $parser->parseFile($file->getPathname());
                foreach ($pdf->getPages() as $page) {
                    $text .= "\n" . $page->getText();
                }
            } catch (\Throwable $e) {
                // keep $text empty to allow graceful fallback
            }

            $invoiceTotal = $this->extractInvoiceTotal($text);
            [$daysWithParcels, $totalParcels] = $this->extractWorkStats($text);
            $formattedInvoice = $invoiceTotal !== null ? number_format($invoiceTotal, 2, '.', '') : null;

            $results[] = [
                'driver_id' => $driverId,
                'full_name' => $driver?->full_name,
                'invoice_total' => $formattedInvoice,
                'days_with_parcels' => $daysWithParcels,
                'total_parcels' => $totalParcels,
            ];
        }

        return response()->json($results);
    }

    private function extractInvoiceTotal(string $text): ?float
    {
        if ($text === '') {
            return null;
        }

        if (preg_match_all('/Total\s+invoice[^\$]*\$([0-9,]+\.\d{2})/i', $text, $matches) && !empty($matches[1])) {
            $raw = str_replace(',', '', end($matches[1]));
            return (float) $raw;
        }

        if (preg_match_all('/\$([0-9,]+\.\d{2})/', $text, $fallback) && !empty($fallback[1])) {
            $max = 0.0;
            foreach ($fallback[1] as $value) {
                $numeric = (float) str_replace(',', '', $value);
                if ($numeric > $max) {
                    $max = $numeric;
                }
            }
            return $max ?: null;
        }

        return null;
    }

    private function extractWorkStats(string $text): array
    {
        $daysWorked = 0;
        $totalParcels = 0;

        if ($text === '') {
            return [$daysWorked, $totalParcels];
        }

        $segment = $text;
        if (preg_match('/Transaction summary(.*?)(?:Manual Fees Detail|Total Cancellation|Transaction details)/is', $text, $section)) {
            $segment = $section[1];
        }

        $lines = preg_split("/(\r\n|\r|\n)/", $segment);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || !preg_match('/^\d{4}-\d{2}-\d{2}/', $line)) {
                continue;
            }

            if (preg_match('/^\d{4}-\d{2}-\d{2}\s+\d+\s+([0-9,]+)\s+\$[0-9,]+\.\d{2}/', $line, $match)) {
                $qty = (int) str_replace(',', '', $match[1]);
                $totalParcels += $qty;
                if ($qty > 0) {
                    $daysWorked++;
                }
            }
        }

        if ($totalParcels === 0 && preg_match('/Total\s+\d+\s+([0-9,]+)/i', $segment, $totalMatch)) {
            $totalParcels = (int) str_replace(',', '', $totalMatch[1]);
        }

        return [$daysWorked, $totalParcels];
    }
}
