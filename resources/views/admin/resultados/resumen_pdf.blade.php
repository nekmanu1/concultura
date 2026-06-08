<!DOCTYPE html>
<html>
<head>
<img src="{{ public_path('images/logo.jpg') }}" style="width: 200px; height: auto;">

    <meta charset="utf-8">
    <title>Resumen de Resultados</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Resumen de Resultados - Concurso {{ $concurso->nombre }}</h2>
    <table>
        <thead>
            <tr>
                <th>Posición</th>
                <th>Participante</th>
                <th>Cédula</th>
                <th>Puntaje Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resultados as $index => $resultado)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $resultado->nombre }}</td>
                    <td>{{ $resultado->cedula ?? 'No registrada' }}</td>
                    <td>{{ number_format($resultado->total, 2, '.', '') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
     </table>

    <!-- Espacio para firmas -->
    <div style="margin-top: 60px; width: 100%; text-align: center;">
        <table style="width: 100%; border: none; margin-top: 40px;">
            <tr>
                <td style="width: 50%; text-align: center;">
                    ___________________________<br>
                    {{ $juradosAsignados->name}}

                </td>
                <td style="width: 50%; text-align: center;">
                    ___________________________<br>
                    <strong>Firma del Auditor</strong>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>