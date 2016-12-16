<?php

$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$message = $_POST["message"];
$nombre = strip_tags($name);

$fecha = time();
$fechaFormateada = date("j/n/Y", $fecha);

$emailTo = "alexballera@gmail.com";
$subject = "Nuevo mensaje de $nombre";

$body .= "Mensaje Desde El Formulario Web Alenta.\n";
$body .= "\n";
$body .= "Nombre: " . $name ."\n";
$body .= "\n";
$body .= "Correo: " . $email ."\n";
$body .= "\n";
$body .= "Teléfono: " . $phone ."\n";
$body .= "\n";
$body .= "Mensaje: " . $message ."\n";
$body .= "\n";
$body .= "Fecha: " . $fechaFormateada ."\n";

$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
$header .= "Mime-Version: 1.0 \r\n";
$header .= "Content-Type: text/plain; charset=iso-8859-1 \r\n";
$header .= 'From:' . $email. '\r\n'; // Sender's Email
// $header .= 'Cc:' . 'direccioncomercial@acciconsultores.com' . '\r\n'; // Carbon copy to Sender
// $header .= 'Cc:' . $email. '\r\n'; // Carbon copy to Sender


// send email
$success = mail($emailTo, $subject, $body, $header);

$enlace = mysqli_connect("localhost", "aballera_alex", "Juan03:16", "aballera_formularios");

// $connection = mysql_connect("localhost", "root", ""); // Establishing Connection with Server..
// $db = mysql_select_db("aballera_formularios", $connection); // Selecting Database
// if (isset($name)) {
// $query = mysql_query("insert into form_element(name, lastname, phone, email, message) values ('$name', '$phone', '$email','$message')"); //Insert Query
// echo "Form Submitted succesfully";
// }
// mysql_close($connection); // Connection Closed

// redirect to success page
if ($success){
  echo '<script language="javascript">alert("Tu consulta ha sido enviada correctamente.");</script>';
  if (!$enlace) {
      echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
      echo "errno de depuración: " . mysqli_connect_errno() . PHP_EOL;
      echo "error de depuración: " . mysqli_connect_error() . PHP_EOL;
      exit;
  } else {
    if (isset($name)) {
    $query = mysqli_query("insert into form(name, lastname, phone, email, message) values ('$name', '$lastname', '$phone', '$email','$message')"); //Insert Query
    echo "Form Submitted succesfully";
    }
    echo "Éxito: Se realizó una conexión apropiada a MySQL! La base de datos mi_bd es genial." . PHP_EOL;
    echo "Información del host: " . mysqli_get_host_info($enlace) . PHP_EOL;

    mysqli_close($enlace);
  }
}else{
  echo '<script language="javascript">alert("Revisa los datos ingresados");</script>';
}
?>
