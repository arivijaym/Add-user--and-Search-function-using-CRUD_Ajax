<?php
$con = mysqli_connect('localhost', 'root', '', 'ajax_crud');

$action = $_POST["action"];

if ($action == "Insert") {
  // Insert code here...
  {
    $name=mysqli_real_escape_string($con,$_POST["name"]);
    $gender=mysqli_real_escape_string($con,$_POST["gender"]);
    $contact=mysqli_real_escape_string($con,$_POST["contact"]);
    $email=mysqli_real_escape_string($con,$_POST["email"]);
    $city=mysqli_real_escape_string($con,$_POST["city"]);
    $pincode=mysqli_real_escape_string($con,$_POST["pincode"]);
    $sql="insert into myusers (name,gender,contact,email, city, pincode) values ('{$name}','{$gender}','{$contact}','{$email}', '{$city}', '{$pincode}') ";
    if($con->query($sql)){
      $id=$con->insert_id;
      //$con->query("SET @count = 0;");
      //$con->query("UPDATE myusers SET myusers.id = @count:= @count + 1;");

      echo "
        <tr uid='{$id}'>
          <td>{$name}</td>
          <td>{$gender}</td>
          <td>{$contact}</td>
          <td>{$email}</td>
          <td>{$city}</td>
          <td>{$pincode}</td>
          <td><a href='#' class='btn btn-primary edit'><i class='fa-solid fa-pen-to-square'></i></a>
          <a href='#' class='btn btn-danger delete'><i class='fa-solid fa-trash'></i></a></td>
        </tr>";
    }
    else{
      echo false;
    }
  }
} else if ($action == "Update") {
  // Update code here...
  {
    $id=mysqli_real_escape_string($con,$_POST["id"]);
    $name=mysqli_real_escape_string($con,$_POST["name"]);
    $gender=mysqli_real_escape_string($con,$_POST["gender"]);
    $contact=mysqli_real_escape_string($con,$_POST["contact"]);
    $email=mysqli_real_escape_string($con,$_POST["email"]);
    $city=mysqli_real_escape_string($con,$_POST["city"]);
    $pincode=mysqli_real_escape_string($con,$_POST["pincode"]);
    $sql="update users SET name='{$name}',gender='{$gender}',contact='{$contact}',email='{$email}',city='{$city}',pincode='{$pincode}' where ID='{$id}'";
    if($con->query($sql)){
      echo "
        <td>{$name}</td>
        <td>{$gender}</td>
        <td>{$contact}</td>
        <td>{$email}</td>
        <td>{$city}</td>
        <td>{$pincode}</td>
        <td><a href='#' class='btn btn-primary edit'><i class='fa-solid fa-pen-to-square'></i></a>
        <a href='#' class='btn btn-danger delete'><i class='fa-solid fa-trash'></i></a></td>";
        
    }else{
      echo false;
    }
  } 
}else if($action=="Delete"){
    $id=$_POST["uid"];
    $sql="delete from myusers where ID='{$id}'";
    if($con->query($sql)){
      //$con->query("SET @count = 0;");
      //$con->query("UPDATE myusers SET myusers.id = @count:= @count + 1;");
      echo true;
    }else{
      echo false;
    }
  } else if ($action == "Delete") {
  // Delete code here...
  {
    $id=$_POST["uid"];
    $sql="delete from myusers where ID='{$id}'";
    if($con->query($sql)){
      //$con->query("SET @count = 0;");
      //$con->query("UPDATE myusers SET myusers.id = @count:= @count + 1;");
      echo true;
    }else{
      echo false;
    }
  }
} else if ($action == "Search") {
  // Search code here...
  $search = $_POST['search'];
  $sql = "SELECT * FROM myusers WHERE `name` LIKE '%$search%' OR gender LIKE '%$search%' OR contact LIKE '%$search%' OR email LIKE '%$search%' OR city LIKE '%$search%' OR pincode LIKE '%$search%'";
  $result = mysqli_query($con, $sql);

  if ($result) {
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        echo "
        <tr uid='{$row["id"]}'>
          <td>{$row["name"]}</td>
          <td>{$row["gender"]}</td>
          <td>{$row["contact"]}</td>
          <td>{$row["email"]}</td>
          <td>{$row["city"]}</td>
          <td>{$row["pincode"]}</td>
          <td>
            <a href='#' class='btn btn-primary edit'><i class='fa-solid fa-pen-to-square'></i></a>
            <a href='#' class='btn btn-danger delete'><i class='fa-solid fa-trash'></i></a>
          </td>
        </tr>
        ";
      }
    } else {
      echo "No results found.";
    }
  } else {
    echo "Query failed.";
  }
}
?>
