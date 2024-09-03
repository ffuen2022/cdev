<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>SDR-DAO</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px; /* Tamaño de fuente reducido */
            margin: 10px;
            line-height: 1.4;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
            position: relative;
            padding-bottom: 10px;
            border-bottom: 2px solid #000;
        }

        .header img {
            position: absolute;
            left: 0;
            top: 0;
            width: 50px; /* Tamaño reducido de la imagen */
            height: auto;
        }

        .header h2 {
            margin: 0;
            font-size: 16px; /* Tamaño de fuente reducido */
            font-weight: bold;
            color: #333;
        }

        .header p {
            margin: 0;
            font-size: 12px;
            color: #555;
        }

        .date {
            text-align: right;
            margin-bottom: 10px;
            font-size: 10px; /* Tamaño de fuente reducido */
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th, td {
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #5e5e5e;
            color: #fff;
            text-transform: uppercase;
            font-weight: bold;
            text-align: center;
        }

        .folio {
            text-align: right;
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 12px;
            color: #333;
        }

        .materials-table th, .materials-table td {
            width: 50%;
            text-align: left;
        }

        .materials-table td {
            height: 20px;
            font-size: 10px;
            position: relative;
            padding-left: 20px; /* Espacio para el recuadro */
        }

        .materials-table td::before {
            content: "";
            display: block;
            width: 10px;
            height: 10px;
            background-color: #5e5e5e;
            position: absolute;
            left: 5px;
            top: 50%;
            transform: translateY(-50%);
        }

        .justify td {
            text-align: justify;
            padding: 10px;
            font-size: 10px;
            line-height: 1.4;
        }

        .firma-section {
            margin-top: 20px;
            text-align: center;
            border-top: 2px solid #cacaca;
            padding-top: 10px;
            display: flex;
            justify-content: space-between; /* Alinea los elementos en los extremos opuestos */
            padding: 0 20px;
        }

        .firma-section p {
            margin: 0;
            font-size: 10px;
            color: #333;
            display: flex;
            justify-content: space-between; /* Alinea los elementos en los extremos opuestos */
        }
    .firma-left {
            align-self: flex-start;
        }

        .firma-right {
            align-self: flex-end;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="https://upload.wikimedia.org/wikipedia/commons/e/e1/Escudo_Oficial_Comuna_de_Rengo.png" style="margin-left:17%; margin-top:-3%;" alt="Municipalidad">
        <p style="margin-left: 2%">ILUSTRE MUNICIPALIDAD DE RENGO</p>
        <p style="margin-left: 2%">DIRECCIÓN DE ASEO Y ORNATO</p><br>
        <h2>SDR-DAO</h2>
    </div>

    <div class="date">
        <p>FECHA: 05-06-2024</p>
    </div>

    <table>
        <tr>
            <td><strong>SOLICITADO POR:</strong></td>
            <td> {{ $data->solicitado_por }}</td>
        </tr>
        <tr>
            <td><strong>UNIDAD:</strong></td>
            <td> {{ $data->unidad }}</td>
        </tr>
        <tr>
            <td><strong>SOLICITUD DE PEDIDO ASOCIADA:</strong></td>
            <td>   @foreach ($data->solicitud as $solicitud)
                {{ $solicitud->numero_solicitud }} |
            @endforeach</td>
        </tr>
        <tr>
            <td><strong>CUENTA PRESUPUESTARIA:</strong></td>
            <td>{{ $data->cuenta_presupuestaria }}</td>
        </tr>
    </table>

    <div class="folio">
        <p>FOLIO SDR: {{ $data->folio_sdr }}</p>
    </div>

    <table class="materials-table">
        <tr>
            <th>MATERIALES - HERRAMIENTAS - VEHÍCULOS</th>
            <th></th>
        </tr>
        <tr>
            <td>MATERIALES DE FERRETERIA</td>
            <td>REPUESTOS MAQUINARIA</td>
        </tr>
        <tr>
            <td>ÁRIDOS</td>
            <td>REPUESTOS VEHÍCULOS</td>
        </tr>
        <tr>
            <td>ESPECIES VEGETALES</td>
            <td>LUBRICANTES Y FILTROS</td>
        </tr>
        <tr>
            <td>QUÍMICOS</td>
            <td>NEUMÁTICOS</td>
        </tr>
        <tr>
            <td>ARTÍCULOS DE ASEO</td>
            <td>COMBUSTIBLE</td>
        </tr>
        <tr>
            <td>DISPONIBILIDAD PRESUPUESTARIA</td>
            <td>X</td>
        </tr>
        <tr>
            <td>HERRAMIENTAS MANUALES</td>
            <td>OTROS</td>
        </tr>
        <tr>
            <td>HERRAMIENTAS MOTORIZADAS</td>
            <td></td>
        </tr>
    </table>

    <table>
        <tr>
            <th>ITEM</th>
            <th>DESCRIPCIÓN</th>
            <th>UNIDAD</th>
            <th>CANTIDAD</th>
        </tr>
        @foreach ($data->sdrproductos as $producto )
        <tr>
            <td>{{ $producto->item }}</td>
            <td>{{ $producto->descripcion }}<</td>
            <td>{{ $producto->unidad_medida }}<</td>
            <td>{{ $producto->cantidad }}<</td>
        </tr>
        @endforeach
     
    </table>
    <p>Se adjunta término de requerimiento N°37</p>

    <table class="justify">
        <tr>
            <th colspan="4">JUSTIFICACIÓN DEL REQUERIMIENTO:</th>
        </tr>
        <tr>
            <td colspan="4">{{ $data->justificacion_del_requerimiento }}<</td>
        </tr>
    </table>
    <br><br>
    <div class="firma-section">
        <div>
            <p class="firma-left" style="margin-left:-60%;">FIRMA SDR</p>
            
            <p class="firma-right" style="margin-right:-50%; margin-top:-5%;">FIRMA DIRECTOR</p>
        </div>
    </div>
</body>
</html>
