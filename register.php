<?php

  print "Integer is valid";
  $con = mysql_connect("localhost","");
  if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
  else
  {
    print "connection successfull";
  }
  $user=$_POST['user'];
  $pass=$_POST['pass'];
  $email=$_POST['email'];
  $phone=$_POST['phone'];
       print $user;
       print $pass;
   $con=  mysql_connect('localhost','root','');
   $x=  mysql_select_db('login_details');
    $y=mysql_query("INSERT INTO  `login_details`.`visitors` (`username` ,`password` ,`email` ,`phone`)VALUES ('$user','$pass','$email','$phone');");
         if(!$y)
           {
              header("Location:regfail.html");
                           exit;  
               $t=1;
           }
        else
         {  
                   header("Location:regsuc.html");
                           exit;  
         }
        mysql_close($con);
        header("Location:regfail.html");
                           exit;  
?>