<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Concurso;
use App\Models\Evaluacion;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class ResultadoController extends Controller
{
    public function index(Concurso $concurso)
    {
        $concurso->load('categoria');

        $resultados = Evaluacion::select(
                'participantes.id',
                'participantes.nombre',
                'participantes.cedula',
                DB::raw('SUM(evaluacions.puntaje) as total')
            )
            ->join('participantes', 'participantes.id', '=', 'evaluacions.participante_id')
            ->where('evaluacions.concurso_id', $concurso->id)
            ->groupBy('participantes.id', 'participantes.nombre', 'participantes.cedula')
            ->orderByDesc('total')
            ->get();

        $desglose = Evaluacion::with([
                'participante',
                'jurado',
                'aspecto',
                'criterio',
            ])
            ->where('concurso_id', $concurso->id)
            ->orderBy('participante_id')
            ->orderBy('aspecto_id')
            ->orderBy('criterio_id')
            ->get();

        return view('admin.resultados.index', compact(
            'concurso',
            'resultados',
            'desglose'
        ));
    }

   public function exportarResumenPDF(Concurso $concurso)
{
    $resultados = Evaluacion::select(
            'participantes.id',
            'participantes.nombre',
            'participantes.cedula',
            DB::raw('SUM(evaluacions.puntaje) as total')
        )
        ->join('participantes', 'participantes.id', '=', 'evaluacions.participante_id')
        ->where('evaluacions.concurso_id', $concurso->id)
        ->groupBy('participantes.id', 'participantes.nombre', 'participantes.cedula')
        ->orderByDesc('total')
        ->get();

    $pdf = Pdf::loadView('admin.resultados.resumen_pdf', compact('concurso', 'resultados'));
    return $pdf->download('resumen_resultados_concurso_' . $concurso->id . '.pdf');
}

    public function exportarDesgloseExcel(Concurso $concurso)
{
    $desglose = Evaluacion::with([
            'participante',
            'jurado',
            'aspecto',
            'criterio',
        ])
        ->where('concurso_id', $concurso->id)
        ->orderBy('participante_id')
        ->orderBy('aspecto_id')
        ->orderBy('criterio_id')
        ->get();

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Encabezados
    $sheet->setCellValue('A1', 'Participante');
    $sheet->setCellValue('B1', 'Cédula');
    $sheet->setCellValue('C1', 'Jurado');
    $sheet->setCellValue('D1', 'Aspecto');
    $sheet->setCellValue('E1', 'Criterio');
    $sheet->setCellValue('F1', 'Puntaje');
    $sheet->setCellValue('G1', 'Observación');
    $sheet->setCellValue('H1', 'Fecha de evaluación');

    // Datos
    foreach ($desglose as $index => $item) {
        $row = $index + 2;
        $sheet->setCellValue("A{$row}", $item->participante->nombre);
        $sheet->setCellValue("B{$row}", $item->participante->cedula ?? 'No registrada');
        $sheet->setCellValue("C{$row}", $item->jurado->name);
        $sheet->setCellValue("D{$row}", $item->aspecto->nombre);
        $sheet->setCellValue("E{$row}", $item->criterio->nombre);
        $sheet->setCellValue("F{$row}", number_format($item->puntaje, 2, '.', ''));
        $sheet->setCellValue("G{$row}", $item->observacion ?? '');
        $sheet->setCellValue("H{$row}", $item->created_at?->format('d/m/Y H:i'));
    }

    $writer = new Xlsx($spreadsheet);
    $fileName = 'desglose_votacion_concurso_' . $concurso->id . '.xlsx';

    return Response::streamDownload(function() use ($writer) {
        $writer->save('php://output');
    }, $fileName, [
        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    ]);
}
}
// 