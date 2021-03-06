<?php
 if(isset($_GET['new']))
 {
   echo '<h2>Crear nueva publicación</h2>';
 }
 else if(isset($_GET['id']))
 {
   include("../lib/sql-connection.php");
   $id = $_GET['id'];
   $query = $connection->prepare("SELECT * FROM blog_posts WHERE id_post = ?");
   $query->bind_param("i", $id);
   $query->execute();
   $result = $query->get_result();
   if(!$result)
   {
     mysqli_close($connection);
     header("Location: panel.php?errorSearch");
   }
   else
   {
     $num = mysqli_num_rows($result);
     if($num > 0)
     {
       $rows = mysqli_fetch_array($result);
       echo '<h2>Modificar publicación | ID: '.$rows['id_post'] . '</h2>';

       $title = $rows['title'];
       $description = $rows['description'];
       $content = $rows['content'];
       mysqli_close($connection);
     }
   }
 }
 else
 {
   header("Location: panel.php");
 }
?>
