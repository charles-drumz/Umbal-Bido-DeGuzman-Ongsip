<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ImportUsersController extends Controller
{
    public function import(Request $request)
    {
        // Validate file type (CSV or Excel)
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv,txt|max:2048',
        ]);

        $file = $request->file('file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $imported = 0;

        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // skip header row

            // Skip empty rows
            if (empty($row[3])) {
                continue;
            }

            User::updateOrCreate(
                ['email' => $row[3]], // unique by email
                [
                    'first_name' => $row[0] ?? '',
                    'last_name'  => $row[1] ?? '',
                    'name'       => $row[2] ?? '',
                    'email'      => $row[3] ?? '',
                    'password'   => Hash::make($row[4] ?? 'password123'), // hashed password
                ]
            );

            $imported++;
        }

        return response()->json([
            'success' => true,
            'message' => "Successfully imported {$imported} users."
        ]);
    }
}
