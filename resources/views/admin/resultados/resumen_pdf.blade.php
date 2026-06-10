<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen de Resultados</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #2c3e50;
            margin: 20px;
        }
        h2 {
            margin: 0;
            color: #2c3e50;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 120px;
            margin-bottom: 10px;
        }
        .subheader {
            font-size: 12px;
            color: #7f8c8d;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: center;
        }
        td {
            text-align: left;
        }
        .total {
            font-weight: bold;
            text-align: center;
        }
        .firmas {
            margin-top: 60px;
            width: 100%;
        }
        .firma {
            text-align: center;
            padding: 20px;
        }
        .linea {
            margin-bottom: 5px;
        }
        .footer {
            text-align: right;
            font-size: 10px;
            color: #7f8c8d;
            margin-top: 30px;
        }
    </style>
</head>
<body>

    <!-- Encabezado -->
    <div class="header">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo" style="width: 220px; margin-bottom: 10px;">
        <h2>Resumen de Resultados - Concurso {{ $concurso->nombre }}</h2>
        <p class="subheader">Ministerio de Cultura</p>
    </div>
    <hr>

    <!-- Tabla de resultados -->
    <table>
        <thead>
            <tr>
                <th>Participante</th>
                <th>Cédula</th>
                <th>Total Puntaje</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resultados as $resultado)
            <tr>
                <td>{{ $resultado->nombre }}</td>
                <td>{{ $resultado->cedula }}</td>
                <td class="total">{{ number_format($resultado->total, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Firmas -->
    <table class="firmas">
        <tr>
            <td class="firma" style="width: 50%;">
                @foreach($juradosAsignados as $jurado)
                    <div class="linea">___________________________</div>
                    <strong>Firma del Jurado</strong><br>
                    {{ $jurado->name }}<br><br>
                @endforeach
            </td>
            <td class="firma" style="width: 50%;">
                <div class="linea">___________________________</div>
                <strong>Firma del Auditor</strong><br>
            </td>
        </tr>
    </table>

    <!-- Pie de página -->
    <div class="footer">
        Generado el {{ now()->format('d/m/Y H:i') }}
    </div>

</body>
</html>
