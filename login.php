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
  $user=$_POST['username'];
  $pass=$_POST['password'];
       print $user;
       print $pass;
   $x=  mysql_connect('localhost','root','');
   $x=  mysql_select_db('login_details');
    $x=  mysql_query("select * from visitors WHERE username='$user'");
while ($row = mysql_fetch_array($x)) 
{
            if(strcmp($pass,$row['password'])==0)
             {
                 print "hello";
              header("Location:logsuc.html");
                           exit;
             }
            else
             {
                
                header("Location:logfail.html");
                           exit;   
             }   
              
}
   header("Location:logfail.html");
                           exit;
 
?>