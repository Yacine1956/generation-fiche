<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class PdfController extends Controller
{

public function show()
{
    return view('pdf_template', $this->getMockData());
}
    public function generate()
    {
        $tempHtml = storage_path("app/temp_" . uniqid() . ".html");
        $tempPdf = storage_path("app/temp_" . uniqid() . ".pdf");

        try {
            $html = view('pdf_template', $this->getMockData())->render();
            File::put($tempHtml, $html);

            $process = new Process([
                $this->findNodePath(),
                base_path('scripts/generate-pdf.js'),
                $tempHtml,
                $tempPdf
            ]);

            $process->setTimeout(90);
            $process->run();

            if (!$process->isSuccessful()) throw new ProcessFailedException($process);

            return response()->download($tempPdf, 'Fiche_Aide_Decision.pdf')->deleteFileAfterSend(true);

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        } finally {
            if (File::exists($tempHtml)) File::delete($tempHtml);
        }
    }

    private function findNodePath() {
        $paths = ['C:\\Program Files\\nodejs\\node.exe', '/usr/bin/node', '/usr/local/bin/node'];
        foreach ($paths as $p) { if (File::exists($p)) return $p; }
        return 'node';
    }

    private function getMockData() {
        return [
    'logo_base64' => $this->logoBase64(),

    'filiere' => [
        'nom' => 'Informatique de Gestion',
        'niveau' => 'Master 1',
        'departement' => 'Sciences Technologiques',
        'description' => 'Ce programme vise à former des experts en pilotage de systèmes d\'information complexes.',
    ],

    'enseignements' => [

        [
            'enseignant' => [
                'nom' => 'Pr. Moussa SARR',
                'matricule' => 'UIDT-001',
                'type' => 'Permanent'
            ],
            'matiere' => [
                'code' => 'INF411',
                'nom' => 'Bases de Données Avancées',
                'semestre' => 'S1'
            ],
            'cm' => ['prevu'=>20,'affecte'=>20,'effectue'=>20],
            'td' => ['prevu'=>10,'affecte'=>10,'effectue'=>10],
            'tp' => ['prevu'=>15,'affecte'=>15,'effectue'=>15]
        ],

        [
            'enseignant' => [
                'nom' => 'Dr. Awa NDIAYE',
                'matricule' => 'UIDT-002',
                'type' => 'Permanent'
            ],
            'matiere' => [
                'code' => 'INF412',
                'nom' => 'Architecture Logicielle',
                'semestre' => 'S1'
            ],
            'cm' => ['prevu'=>18,'affecte'=>18,'effectue'=>16],
            'td' => ['prevu'=>12,'affecte'=>12,'effectue'=>10],
            'tp' => ['prevu'=>8,'affecte'=>8,'effectue'=>8]
        ],

        [
            'enseignant' => [
                'nom' => 'M. Ibrahima DIOP',
                'matricule' => 'UIDT-003',
                'type' => 'Vacataire'
            ],
            'matiere' => [
                'code' => 'INF413',
                'nom' => 'Programmation Web Avancée',
                'semestre' => 'S1'
            ],
            'cm' => ['prevu'=>15,'affecte'=>15,'effectue'=>14],
            'td' => ['prevu'=>10,'affecte'=>10,'effectue'=>10],
            'tp' => ['prevu'=>20,'affecte'=>20,'effectue'=>18]
        ],

        [
            'enseignant' => [
                'nom' => 'Pr. Fatou MBAYE',
                'matricule' => 'UIDT-004',
                'type' => 'Permanent'
            ],
            'matiere' => [
                'code' => 'INF414',
                'nom' => 'Sécurité Informatique',
                'semestre' => 'S1'
            ],
            'cm' => ['prevu'=>20,'affecte'=>20,'effectue'=>19],
            'td' => ['prevu'=>8,'affecte'=>8,'effectue'=>8],
            'tp' => ['prevu'=>12,'affecte'=>12,'effectue'=>11]
        ],

        [
            'enseignant' => [
                'nom' => 'Dr. Cheikh BA',
                'matricule' => 'UIDT-005',
                'type' => 'Permanent'
            ],
            'matiere' => [
                'code' => 'INF415',
                'nom' => 'Administration Réseau',
                'semestre' => 'S1'
            ],
            'cm' => ['prevu'=>16,'affecte'=>16,'effectue'=>16],
            'td' => ['prevu'=>10,'affecte'=>10,'effectue'=>9],
            'tp' => ['prevu'=>18,'affecte'=>18,'effectue'=>17]
        ],

        [
            'enseignant' => [
                'nom' => 'Mme Aminata FALL',
                'matricule' => 'UIDT-006',
                'type' => 'Vacataire'
            ],
            'matiere' => [
                'code' => 'INF421',
                'nom' => 'Intelligence Artificielle',
                'semestre' => 'S2'
            ],
            'cm' => ['prevu'=>25,'affecte'=>25,'effectue'=>23],
            'td' => ['prevu'=>10,'affecte'=>10,'effectue'=>10],
            'tp' => ['prevu'=>20,'affecte'=>20,'effectue'=>18]
        ],

        [
            'enseignant' => [
                'nom' => 'Pr. Ousmane GUEYE',
                'matricule' => 'UIDT-007',
                'type' => 'Permanent'
            ],
            'matiere' => [
                'code' => 'INF422',
                'nom' => 'Big Data',
                'semestre' => 'S2'
            ],
            'cm' => ['prevu'=>20,'affecte'=>20,'effectue'=>20],
            'td' => ['prevu'=>12,'affecte'=>12,'effectue'=>11],
            'tp' => ['prevu'=>15,'affecte'=>15,'effectue'=>14]
        ],

        [
            'enseignant' => [
                'nom' => 'M. Serigne TOURE',
                'matricule' => 'UIDT-008',
                'type' => 'Vacataire'
            ],
            'matiere' => [
                'code' => 'INF423',
                'nom' => 'Cloud Computing',
                'semestre' => 'S2'
            ],
            'cm' => ['prevu'=>18,'affecte'=>18,'effectue'=>17],
            'td' => ['prevu'=>8,'affecte'=>8,'effectue'=>8],
            'tp' => ['prevu'=>16,'affecte'=>16,'effectue'=>15]
        ],

        [
            'enseignant' => [
                'nom' => 'Dr. Khadija SECK',
                'matricule' => 'UIDT-009',
                'type' => 'Permanent'
            ],
            'matiere' => [
                'code' => 'INF424',
                'nom' => 'Gestion de Projet Informatique',
                'semestre' => 'S2'
            ],
            'cm' => ['prevu'=>14,'affecte'=>14,'effectue'=>14],
            'td' => ['prevu'=>12,'affecte'=>12,'effectue'=>12],
            'tp' => ['prevu'=>6,'affecte'=>6,'effectue'=>6]
        ],

        [
            'enseignant' => [
                'nom' => 'Mme Mariama DIALLO',
                'matricule' => 'UIDT-010',
                'type' => 'Permanent'
            ],
            'matiere' => [
                'code' => 'INF425',
                'nom' => 'Développement Mobile',
                'semestre' => 'S2'
            ],
            'cm' => ['prevu'=>16,'affecte'=>16,'effectue'=>15],
            'td' => ['prevu'=>10,'affecte'=>10,'effectue'=>10],
            'tp' => ['prevu'=>20,'affecte'=>20,'effectue'=>19]
        ],

        [
            'enseignant' => [
                'nom' => 'Pr. Babacar LO',
                'matricule' => 'UIDT-011',
                'type' => 'Permanent'
            ],
            'matiere' => [
                'code' => 'INF426',
                'nom' => 'Systèmes Distribués',
                'semestre' => 'S2'
            ],
            'cm' => ['prevu'=>22,'affecte'=>22,'effectue'=>21],
            'td' => ['prevu'=>10,'affecte'=>10,'effectue'=>9],
            'tp' => ['prevu'=>14,'affecte'=>14,'effectue'=>13]
        ],

    ]
];
    }

    private function logoBase64() {
        $path = public_path('images/logo.png');
        return File::exists($path) ? 'data:image/'.pathinfo($path,PATHINFO_EXTENSION).';base64,'.base64_encode(File::get($path)) : null;
    }
}
