<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resumen de Resultados</title>
    <style>
        @page {
            size: letter;
            margin: 150px 35px 70px 35px; /* espacio arriba y abajo */
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 12px;
            color: #2c3e50;
        }

        header {
            position: fixed;
            top: -125px;   /* coloca el encabezado en la parte superior */
            left: 0;
            right: 0;
            height: 115px;
            text-align: center;
            border-bottom: 1px solid #ccc;
        }

        header img {
            width: 190px;
            margin-bottom: 5px;
        }

        header h2 {
            margin: 0;
            font-size: 16px;
            color: #2c3e50;
        }

        .subheader {
            margin-top: 4px;
            font-size: 11px;
            color: #7f8c8d;
        }

        footer {
            position: fixed;
            bottom: -45px;
            left: 0;
            right: 0;
            height: 35px;
            text-align: right;
            font-size: 10px;
            color: #7f8c8d;
            border-top: 1px solid #ddd;
            padding-top: 8px;
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
    </style>
</head>
<body>

    <!-- Encabezado fijo que se repite en todas las páginas -->
    <header>
        <img src="{{ public_path('images/logo.png') }}" alt="Logo">
        <h2>Resumen de Resultados - Concurso {{ $concurso->nombre }}</h2>
        <div class="subheader">Ministerio de Cultura</div>
    </header>

    <!-- Pie de página repetido -->
    <footer>
        Generado el {{ now()->format('d/m/Y H:i') }}
    </footer>

    <!-- Contenido -->
    <main>
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

        <!-- Tabla de Jurados con firma -->
        <table style="width:100%; border-collapse: collapse; margin-top:50px;">
            <thead>
                <tr>
                    <th>Jurado</th>
                    <th>Firma</th>
                </tr>
            </thead>
            <tbody>
                @foreach($juradosAsignados as $jurado)
                <tr>
                    <td style="border:1px solid #ccc; padding:8px;">{{ $jurado->name }}</td>
                    <td style="border:1px solid #ccc; padding:8px; text-align:center;">
                     
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table> 

        <!-- Tabla del Director -->
        <table style="width:100%; border-collapse: collapse; margin-top:20px;">
            <thead>
                <tr>
                    <th>Director</th>
                    <th>Firma</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border:1px solid #ccc; padding:8px;">Nombre:</td>
                    <td style="border:1px solid #ccc; padding:8px; text-align:center;">
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- Tabla del Auditor -->
        <table style="width:100%; border-collapse: collapse; margin-top:20px;">
            <thead>
                <tr>
                    <th>Auditor</th>
                    <th>Firma</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="border:1px solid #ccc; padding:8px;">Nombre:</td>
                    <td style="border:1px solid #ccc; padding:8px; text-align:center;">
                        
                    </td>
                </tr>
            </tbody>
        </table>
    </main>

</body>
</html>
