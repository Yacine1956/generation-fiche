<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        /* CONFIGURATION FORMAT A4 PORTRAIT */
        @page {
            size: A4 portrait;
            margin: 0;
        }

        * {
            box-sizing: border-box;
            -webkit-print-color-adjust: exact;
        }

        body {
            margin: 0;
            padding: 0;
            background: #f1f5f9;
            font-family: "Segoe UI", Arial, sans-serif;
            line-height: 1.3;
            color: #1e293b;
        }

        /* BARRE DE TÉLÉCHARGEMENT (UI Web) */
        .no-print-zone {
            background: #ffffff;
            padding: 10px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 9999;
        }

        .btn-download {
            background: #1e293b;
            color: #ffffff !important;
            padding: 7px 15px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 600;
            font-size: 12px;
        }

        /* CONTENEUR PRINCIPAL (FEUILLE A4) */
        .document-container {
            background: white;
            width: 210mm;
            min-height: 297mm;
            margin: 15px auto;
            padding: 20mm;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }

        /* EN-TÊTE */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f1f5f9;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .logo {
            height: 60px;
            width: auto;
        }

        .university-name {
            font-size: 10pt;
            font-weight: 700;
            color: #0f172a;
            text-transform: uppercase;
            line-height: 1.2;
            max-width: 220px;
        }

        .date-box {
            font-size: 9pt;
            color: #64748b;
        }

        /* TITRE PRINCIPAL NORMALISÉ */
        h1 {
            text-align: center;
            font-size: 16px;
            font-weight: 700;
            color: #0f172a;
            margin: 30px 0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* TABLEAUX D'INFORMATION GÉNÉRALE (TEXTE RÉDUIT) */
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1px;
        }

        .info-table td, .info-table th {
            border: 2px solid #e2e8f0;
            padding: 8px 12px;
            font-size: 9.5pt; /* Taille normale administrative */
        }

        .info-table th {
            background: #f8fafc;
            color: #475569;
            font-weight: 600;
            width: 25%;
            text-align: left;
        }

        /* NOM DU SEMESTRE */
        .semester-title {
            text-align: center;
            font-size: 13px;
            font-weight: 700;
            color: #334155;
            margin: 25px 0 10px 0;
            text-transform: uppercase;
        }

        /* TABLEAUX DE DONNÉES */
        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1px;
        }

        .main-table th, .main-table td {
            border: 2px solid #cbd5e1;
            padding: 6px 4px;
            text-align: center;
            font-size: 8.5pt;
        }

        .main-table thead th {
            background: #f8fafc;
            color: #1e293b;
            font-weight: 700;
            font-size: 8pt;
        }

        .col-prevu { background-color: #f0fdf4 !important; }
        .col-affecte { background-color: #fffbeb !important; }
        .col-effectue { background-color: #eff6ff !important; }

        /* SIGNATURE */
        .signature-section {
            margin-top: 50px;
            display: flex;
            justify-content: flex-end;
        }

        .signature-wrapper {
            width: 180px;
            text-align: center;
        }

        .signature-text {
            font-size: 10pt;
            font-weight: 700;
            margin-bottom: 40px;
            color: #0f172a;
        }

        /* OPTIMISATION PDF */
        @media print {
            body { background: white; }
            .no-print-zone { display: none !important; }
            .document-container {
                margin: 0;
                padding: 15mm;
                width: 100%;
                box-shadow: none;
            }
            thead { display: table-header-group; }
            tr { page-break-inside: avoid; }
        }
    </style>
</head>
<body>

    <div class="no-print-zone">
        <div style="font-size: 13px; color: #64748b;">Aperçu Document PDF</div>
        <a href="{{ route('generate.pdf') }}" class="btn-download">GÉNÉRER LE PDF</a>
    </div>

    <div class="document-container">

        <div class="header">
            <div class="header-left">
                @if($logo_base64)
                    <img src="{{ $logo_base64 }}" class="logo">
                @endif
                <div class="university-name">
                    Université Iba Der Thiam de Thiès
                </div>
            </div>
            <div class="date-box">Édité le {{ date('d/m/Y') }}</div>
        </div>

        <h1>Fiche d'aide à la décision</h1>

        <table class="info-table">
            <tr>
                <th>Filière</th>
                <td>{{ $filiere['nom'] }}</td>
            </tr>
            <tr>
                <th>Niveau d'études</th>
                <td>{{ $filiere['niveau'] }}</td>
            </tr>
            <tr>
                <th>Département</th>
                <td>{{ $filiere['departement'] }}</td>
            </tr>
            <tr>
                <th>Description</th>
                <td style="font-size: 9pt; color: #475569;">{{ $filiere['description'] }}</td>
            </tr>
        </table>

        @foreach(['S1', 'S2'] as $sem)
            <div class="semester-title">
                Semestre {{ $sem == 'S1' ? '1' : '2' }}
            </div>

            <table class="main-table">
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 35%;">Enseignant & Matière</th>
                        <th colspan="3">CM (h)</th>
                        <th colspan="3">TD (h)</th>
                        <th colspan="3">TP (h)</th>
                    </tr>
                    <tr>
                        <th class="col-prevu">P</th><th class="col-affecte">A</th><th class="col-effectue">E</th>
                        <th class="col-prevu">P</th><th class="col-affecte">A</th><th class="col-effectue">E</th>
                        <th class="col-prevu">P</th><th class="col-affecte">A</th><th class="col-effectue">E</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($enseignements as $item)
                        @if($item['matiere']['semestre'] === $sem)
                            <tr>
                                <td style="text-align: left; padding-left: 8px;">
                                    <div style="font-weight: 700;">{{ $item['enseignant']['nom'] }}</div>
                                    <div style="font-size: 7.5pt; color: #64748b;">
                                        {{ $item['matiere']['code'] }} — {{ $item['matiere']['nom'] }}
                                    </div>
                                </td>
                                <td class="col-prevu">{{ $item['cm']['prevu'] }}</td>
                                <td class="col-affecte">{{ $item['cm']['affecte'] }}</td>
                                <td class="col-effectue">{{ $item['cm']['effectue'] }}</td>
                                <td class="col-prevu">{{ $item['td']['prevu'] }}</td>
                                <td class="col-affecte">{{ $item['td']['affecte'] }}</td>
                                <td class="col-effectue">{{ $item['td']['effectue'] }}</td>
                                <td class="col-prevu">{{ $item['tp']['prevu'] }}</td>
                                <td class="col-affecte">{{ $item['tp']['affecte'] }}</td>
                                <td class="col-effectue">{{ $item['tp']['effectue'] }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endforeach

        <div class="signature-section">
            <div class="signature-wrapper">
                <div class="signature-text">Signature</div>
            </div>
        </div>

    </div>
</body>
</html>
