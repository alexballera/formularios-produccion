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

if ($success){
  echo '<script language="javascript">alert("Tu consulta ha sido enviada correctamente.");</script>';
  $enlace = mysqli_connect("localhost", "aballera_alex", "Juan03:16", "aballera_formularios");
  if (mysqli_connect_errno()) {
      echo "Error: No se pudo conectar a MySQL. \r\n" . "\r\n";
      echo "errno de depuración: " . mysqli_connect_errno() . "\r\n";
      echo "error de depuración: " . mysqli_connect_error() . "\r\n";
      exit;
  } else {
    // if (isset($name)) {
    mysqli_query($enlace, "INSERT INTO form_element (name, phone, email, message) VALUES ('$name', '$phone', '$email','$message')"); //Insert Query
    echo "Form Submitted succesfully \r\n";
    // }
    echo "Éxito: Se realizó una conexión apropiada a MySQL! La base de datos mi_bd es genial. \r\n" . PHP_EOL;
    echo "Información del host: \r\n" . mysqli_get_host_info($enlace) . PHP_EOL;

    mysqli_close($enlace);
  }
}else{
  echo '<script language="javascript">alert("Revisa los datos ingresados");</script>';
}
?>
