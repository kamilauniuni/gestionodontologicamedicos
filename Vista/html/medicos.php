<!DOCTYPE html>
<html>

<head>
    <title>Sistema de Gestión Odontológica</title>
    <link rel="stylesheet" type="text/css" href="Vista/css/estilos.css">
    <script type="text/javascript" src="Vista/jquery/jquery-3.2.1-min.js"></script>
    <script src="Vista/jquery/jquery-ui-1.13.2.custom/jquery-ui.js" type="text/javascript"></script>
    <link href="Vista/jquery/jquery-ui-1.13.2.custom/jquery-ui.min.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="Vista/js/script.js"></script>

</head>

<body>
    <div id="contenedor">
        <div id="encabezado">
            <h1>Sistema de Gestión Odontológica</h1>
        </div>
        <ul id="menu">
            <li><a href="index.php">inicio</a> </li>
            <li><a href="index.php?accion=asignar">Asignar</a> </li>
            <li><a href="index.php?accion=consultar">Consultar Cita</a> </li>
            <li><a href="index.php?accion=cancelar">Cancelar Cita</a> </li>
            <li><a href="index.php?accion=medicos">Medicos</a></li>
        </ul>
        <div id="contenido">
            <h2>Registro de Médicos</h2>
            <form id="RegistrarMedicoForm" action="index.php?accion=guardarMedico" method="post">
                <table>
                    <tr>
                        <td>Documento</td>
                        <td><input type="text" name="MedIdentificacion" id="MedIdentificacion"></td>
                    </tr>
                    <tr>
                        <td>Nombres</td>
                        <td><input type="text" name="MedNombres" id="MedNombres"></td>
                    </tr>
                    <tr>
                        <td>Apellidos</td>
                        <td><input type="text" name="MedApellidos" id="MedApellidos"></td>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="submit" value="Registrar Médico"></td>
                    </tr>
                </table>
            </form>
            <?php
            require_once 'Modelo/GestorCita.php';
            $gestorCita = new GestorCita();
            $resultMedicos = $gestorCita->consultarMedicos();
            ?>
            <?php
            session_start();
            require_once 'Controlador/Controlador.php';
            $controlador = new Controlador();

            if (isset($_SESSION['mensaje'])) {
                echo "<p>{$_SESSION['mensaje']}</p>";
                unset($_SESSION['mensaje']);
            }
            ?>
            <h2>Listado de Médicos Registrados</h2>
            <table>
                <tr>
                    <th>Identificacion</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                </tr>
                <?php
                if (isset($resultMedicos)) {
                    while ($fila = $resultMedicos->fetch_object()) {
                ?>
                        <tr>
                            <td><?php echo $fila->MedIdentificacion; ?></td>
                            <td><?php echo $fila->MedNombres; ?></td>
                            <td><?php echo $fila->MedApellidos; ?></td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='3'>No hay datos de médicos disponibles.</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>

</body>

</html>