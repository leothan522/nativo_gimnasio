<?php
header("Pragma: public");
header("Expires: 0");
$filename = "Miembros.xls";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

$model = new \app\Models\Persona();
$modelMembresia = new \app\Models\PersonaMembresia();

$sql = "SELECT * FROM personas;";

$personas = $model->query($sql);


?>
<meta charset="utf-8">
<table border="1" lang="es">
    <tbody>
        <tr>
            <th>Nro</th>
            <th>Nombre</th>
            <th>Cédula</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Fecha de Inicio</th>
            <th>Tipo de Membresía</th>
        </tr>

        <tr>
            <td> 1 </td>
            <td> Jose perez </td>
            <td> 21256325</td>
            <td> 04128561254</td>
            <td> La Morera </td>
            <td> 22-02-2024</td>
            <td> Bronce </td>
        </tr>

        <tr>
            <td> 2 </td>
            <td> Maria Gómez </td>
            <td> 18256325</td>
            <td> 04128521254</td>
            <td> Pueblo Nuevo </td>
            <td> 22-01-2025</td>
            <td> Platino </td>
        </tr>

        <tr>
            <td> 3 </td>
            <td> Jose Hernandez </td>
            <td> 21256854</td>
            <td> 04128567845</td>
            <td> Banco Obrero </td>
            <td> 15-01-2025</td>
            <td> Plata </td>
        </tr>

        <tr>
            <td> 4 </td>
            <td> Alejandra Garcia </td>
            <td> 20256325</td>
            <td> 04148521254</td>
            <td> Las Palmas </td>
            <td> 14-01-2025</td>
            <td> Oro </td>
        </tr>
        <?php
/*        $i = 0;
        foreach($listarChoferes as $choferes){
            $getEmpresas = $empresas->find($choferes['empresas_id']);
            $getVehiculo = $vehiculos->find($choferes['vehiculos_id']);
            $getTipo = $tipos->find($getVehiculo['tipo']);
        $i++;
        */?><!--
        <tr>
        <td>
            <?php /*echo $i; */?>
        </td>
        <td>
            <?php /*echo strtoupper($choferes['nombre']); */?>
        </td>
        <td>
            <?php /*echo strtoupper($choferes['cedula']);*/?>
        </td>
        <td>
            <?php /*echo strtoupper($choferes['telefono'])  */?>
        </td>
        <td>
            <?php /*echo strtoupper($getTipo['nombre']); */?>
        </td>
        <td>
            <?php /*echo strtoupper($getVehiculo['marca']); */?>
        </td>

        <td>
            <?php /*echo strtoupper($getVehiculo['placa_batea']); */?>
        </td>

        <td>
            <?php /*echo strtoupper($getVehiculo['color']); */?>
        </td>

        <td>
            <?php /*echo strtoupper($getVehiculo['capacidad']); */?>
        </td>

        <td>
            <?php /*echo strtoupper($getEmpresas['nombre']); */?>
        </td>

        </tr>
        -->


    </tbody>
</table>