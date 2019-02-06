<?php

$hostport = "localhost";            # database host
$user     = "root";                 # database user name
$password = "";                     # database password
$database = "aldfaer";              # database schema name

$conn = new mysqli($hostport, $user, $password, $database);
#$conn = mysqli_connect($hostport, $user, $password, $database);
if ($conn->connect_error)  {
  die("Connection failed: " . $conn->connect_error);
#if(!$conn)  {
  #die("Connection failed: " . mysqli_connect_error());
  #echo "no connection";
}
#######################################################################################################################
# Selecteert persoon:
$persoon = "SELECT vorname, name, birt_date, birt_plac, sex FROM person_st WHERE persID = 'I1'";
$result = $conn->query($persoon);
if (!$result) {
  echo "????";
}

if ($result->num_rows > 0)  {
  while($row = $result->fetch_assoc())  {
    echo $row["vorname"]. " " . $row["name"]. " " . $row["birt_date"]. " " . $row["birt_plac"]. " " . $row["sex"]. "<br>";
  }
} else {
  echo "geen resultaten";
  }

#######################################################################################################################
# Selecteert familie van persoon:
$famID = "SELECT famID FROM famchild WHERE child = 'I1'";
$result = $conn->query($famID);
if (!$result) {
  echo "????";
}

if ($result->num_rows > 0)  {
  while($row = $result->fetch_assoc())  {
    $familie = $row["famID"];
  }
}
#########################################################################################################################
# Selecteert vader en moeder van persoon:
$ouders = "SELECT husband, wife, marr_date FROM family WHERE famID = '$familie'";
$result = $conn->query($ouders);
if (!$result) {
  echo "????";
}

if ($result->num_rows > 0)  {
  while($row = $result->fetch_assoc())  {
    $vader = $row['husband'];
    $moeder = $row['wife'];
  }
  $persoonv = "SELECT vorname, name, birt_date, birt_plac, sex FROM person_st WHERE persID = '$vader'";
  $persoonm = "SELECT vorname, name, birt_date, birt_plac, sex FROM person_st WHERE persID = '$moeder'";

  $result = $conn->query($persoonv);
  if (!$result) {
    echo "????";
  }
  else if ($result->num_rows > 0)  {
    while($row = $result->fetch_assoc())  {
      echo $row["vorname"]. " " . $row["name"]. " " . $row["birt_date"]. " " . $row["birt_plac"]. " " . $row["sex"]. "<br>";
    }
  }
  $result = $conn->query($persoonm);
  if (!$result) {
    echo "????";
  }
  else if ($result->num_rows > 0)  {
    while($row = $result->fetch_assoc())  {
      echo $row["vorname"]. " " . $row["name"]. " " . $row["birt_date"]. " " . $row["birt_plac"]. " " . $row["sex"]. "<br>";
    }
  }
}


?>
