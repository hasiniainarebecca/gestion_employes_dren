<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function exportExcel()
    {
        // Créer une instance de Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Ajouter des en-têtes de colonne
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'IM');
        $sheet->setCellValue('C1', 'Nom');
        $sheet->setCellValue('D1', 'Prénom');
        $sheet->setCellValue('E1', 'Date de naissance');
        $sheet->setCellValue('F1', 'Email');
        $sheet->setCellValue('G1', 'Contact');
        $sheet->setCellValue('H1', 'Fonction');
        $sheet->setCellValue('I1', 'Photo');
        $sheet->setCellValue('J1', 'Service ID');
        $sheet->setCellValue('K1', 'Date de création');

        // Récupérer les données des employés depuis la base de données
        $employes = DB::table('employes')->get();
        $row = 2;

        foreach ($employes as $employe) {
            $sheet->setCellValue('A' . $row, $employe->id);
            $sheet->setCellValue('B' . $row, $employe->montant_journalier);
            $sheet->setCellValue('C' . $row, $employe->nom);
            $sheet->setCellValue('D' . $row, $employe->prenom);
            $sheet->setCellValue('E' . $row, $employe->date_naissance);
            $sheet->setCellValue('F' . $row, $employe->email);
            $sheet->setCellValue('G' . $row, $employe->contact);
            $sheet->setCellValue('H' . $row, $employe->sexe);
            $sheet->setCellValue('I' . $row, $employe->photo);
            $sheet->setCellValue('J' . $row, $employe->service_id);
            $sheet->setCellValue('K' . $row, $employe->created_at);
            $row++;
        }

        // Retourner le fichier Excel en réponse
        $response = new StreamedResponse(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        });

        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="employes.xlsx"');
        $response->headers->set('Cache-Control', 'max-age=0');

        return $response;
    }

    public function importExcel(Request $request)
    {
        // Validation du fichier
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        // Charger le fichier Excel
        $file = $request->file('excel_file');
        $spreadsheet = IOFactory::load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        // Boucle sur les lignes (en sautant la ligne des en-têtes)
        foreach ($rows as $index => $row) {
            if ($index === 0) continue; // Sauter la première ligne

            $id = $row[0];
            $montant_journalier = $row[1];
            $nom = $row[2];
            $prenom = $row[3];
            $date_naissance = $row[4];           
            $email = $row[5];
            $contact = $row[6];
            $sexe = $row[7];
            $photo = $row[8];
            $service_id = $row[9];

            // Vérifier si l'employé existe dans la base de données
            $employe = DB::table('employes')->where('id', $id)->first();

            if ($employe) {
                // Mise à jour des informations de l'employé existant
                DB::table('employes')->where('id', $id)->update([
                    'montant_journalier' => $montant_journalier,
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'date_naissance' => $date_naissance,
                    'contact' => $contact,
                    'email' => $email,
                    'sexe' => $sexe,
                    'photo' => $photo,
                    'service_id' => $service_id,
                ]);
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                continue; // Sauter la ligne si l'email est invalide
            }
            
            if (!is_numeric($contact)) {
                continue; // Sauter la ligne si le contact n'est pas un nombre
            }
        }

        return redirect()->back()->with('success', 'Les données ont été importées et mises à jour avec succès.');
    }
}
