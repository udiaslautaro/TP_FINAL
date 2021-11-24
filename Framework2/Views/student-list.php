<main class="py-5">
     <section id="listado" class="mb-5">
          <div class="container">
               <h2 class="mb-4">Student List</h2>
               <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/boot">
               <table class="table bg-light" border="1">

                    <thead>

                         <th>StudentId</th>
                         <th>CareerId</th>
                         <th>FirstName</th>
                         <th>LastName</th>
                         <th>Dni</th>
                         <th>FileNumber</th>
                         <th>Gender</th>
                         <th>BirthDate</th>
                         <th>Email</th>
                         <th>PhoneNumber</th>
                    </thead>
                    <tbody>

                         <?php
                         $datos = array();
                         foreach ($postulaciones as $student) : ?>
                              <tr>
                                   <?php

                                   ?>
                                   <td> <?php echo $student->getStudentId() . '<br>'; ?></td>
                                   <td><?php echo $student->getCareerId() . '<br>'; ?></td>
                                   <td> <?php echo $student->getFirstName() . '<br>'; ?></td>
                                   <td><?php echo $student->getLastName() . '<br>';  ?></td>
                                   <td> <?php echo $student->getDni() . '<br>';  ?></td>
                                   <td> <?php echo $student->getFileNumber() . '<br>';  ?></td>
                                   <td><?php echo $student->getGender() . '<br>'; ?></td>
                                   <td><?php echo $student->getBirthDate() . '<br>';  ?></td>
                                   <td> <?php echo $student->getEmail() . '<br>'; ?></td>
                                   <td> <?php echo $student->getPhoneNumber() . '<br>';  ?></td>

                                   <td>  <a class="btn btn-primary btn-block btn-lg" href=<?php echo FRONT_ROOT ?>Application\cancelarPostulacion?id_JobOfert=<?php echo $id_JobOfert ?>&studentId=<?php echo $student->getStudentId() ?> role="button">cancelar postulacion</a></td>
                              </tr>

                              <?php
                              //array_push($datos,$student); asi funciona pero solo me muestra el ultimo 
                              /*  $id=$student->getStudentId();
                              
                              array_push($datos,$id);*/
                              ?>

                         <?php endforeach;

                         ?>


                    </tbody>
               </table>
               <?php /*
ob_start();
$studiante["studentId"]=$student->getStudentId() ;

 $student->getCareerId() 
 $student->getFirstName() 
$student->getDni()
$student->getFileNumber() 
 $student->getGender() 
 $student->getBirthDate() 
 $student->getEmail() 
 $student->getPhoneNumber() 


$html=ob_get_clean();
//echo $html;


require_once "pdf/dompdf/autoload.inc.php";
use Dompdf\Dompdf;

// Introducimos HTML de prueba





// Instanciamos un objeto de la clase DOMPDF.
$pdf = new DOMPDF();
 
// Definimos el tamaño y orientación del papel que queremos.
$pdf->setPaper("latter","centre");
//$pdf->set_paper(array(0,0,104,250));
 
// Cargamos el contenido HTML.
$pdf->loadHtml(utf8_decode($html));
 
// Renderizamos el documento PDF.
$pdf->render();
ob_end_clean();
// Enviamos el fichero PDF al navegador.
$pdf->stream('reportePdf.pdf',array("Attachment"=> false));

*/

               ?>
               <div>
                    <a href=<?php echo FRONT_ROOT ?>Student\ObtenerPdf?id_JobOfert=<?php echo $id_JobOfert ?>> crear pdf</a>

                    <!--     <a href="../pdf/crearPdf.php"> crear pdf</a>-->


               </div>

</main>