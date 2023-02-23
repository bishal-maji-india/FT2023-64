<?php session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
<!-- link to stylesheet -->
  <link href="../styles.css" rel="stylesheet" />
<!-- link to scipt.js to fill the marks of user in table -->
  <script src="../assignment_3/script.js"></script>
<!-- this script helps in generation and creating pdf format file -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
  <title>Document</title>
</head>

<body>
  <?php
// accessing the global session varialbles
  $first_name_v = $_SESSION["first_name"];
  $last_name_v = $_SESSION["last_name"];
  $full_name_v = $first_name_v . ' ' . $last_name_v;
  $user_img_v = $_SESSION["user_image"];
  $marks_v = $_SESSION["marks"];
  $phone_no_v = "+91" . $_SESSION["phone"];
  $mail_v = $_SESSION["email"];

  $destination_path = "http://localhost/assignment_2/images/";
  $file_path = $destination_path . $user_img_v;


  // structuring the marks of user for printing in pdf

  $mark_temp_array = $sub_temp_array = array();
  $mark_sub_array = preg_split("/\-/", $marks_v, -1, PREG_SPLIT_NO_EMPTY);
  $j = sizeof($mark_sub_array);
  $i = 0;
  if (array_key_exists('button_download', $_POST)) {
    while ($i < $j) {
      $sub_and_mark = preg_split("/\*/", $mark_sub_array[$i], -1, PREG_SPLIT_NO_EMPTY);
      $sub_temp_array[$i] = $sub_and_mark[0];
      $mark_temp_array[$i] = $sub_and_mark[1];
      $i++;
    }
    DownloadPdf($full_name_v, $phone_no_v, $mail_v, $mark_temp_array, $sub_temp_array, $file_path);
  }

  // function to download the data in pdf format
  function DownloadPdf($full_name, $phone, $mail, $mark_temp_array, $sub_temp_array, $image_path)
  {
    ob_start();
    require('../fpdf/fpdf.php');
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->Image($image_path, 150, 10, 40);
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(100, 10, "Full name=$full_name");
    $pdf->Ln();
    $pdf->Cell(100, 10, "Phone number=$phone");
    $pdf->Ln();
    $pdf->Cell(100, 10, "Email=$mail");
    $pdf->Ln();
    $pdf->Cell(100, 20, "Marks Table");
    $pdf->Ln();
    $pdf->Cell(50, 10, "Subjects");
    $pdf->Cell(80, 10, "Marks");
    $pdf->Ln();

    for ($j = 0; $j < sizeof($mark_temp_array); $j++) {
      $pdf->Cell(50, 10, $sub_temp_array[$j]);
      $pdf->Cell(70, 10, $mark_temp_array[$j]);
      $pdf->Ln();
    }
    $pdf->Output('D', 'somethig.pdf');
    ob_end_flush();
  }

  echo "<div class='container' id='container'>
    <img src='" . $file_path . "' width='150px' height=auto'>
    <h2>" .
    $full_name_v .
    "</h2>
    <h4>Marks Obtained</h4>
    <table id='table_my'>
     <tr>
     <th>Subjects</th>
     <th>Marks</th>
     </tr>
    </table>
    ";
  echo "<script>fillUserMarks('$marks_v');</script>";
  echo "
    <form method='post' class='button-wrapper'>
        <input type='submit' name='button_download'
                class='button' value='Download Data' />
    </form>
    </div>";
  ?>
</body>

</html>