<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login_form.php');
}
$query="SELECT * FROM contact_form";
$result=mysqli_query($conn,$query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Page</title>

   <style>
      body {
         background-image:url('background-img.png');
         font-family: Arial, sans-serif;
         margin: 0;
         padding: 0;
      }

      .container {
         display: flex;
         flex-direction: column;
         align-items: center;
         justify-content: center;
         height: 100vh;
         background-size: cover;
      background-position: center;

        }

      .content {
         text-align: center;
         padding: 20px;
         background-color: #fff;
         box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
         border-radius: 10px;
         max-width: 600px;
         width: 90%;
      }

      h1 {
         color: #009879;
         margin-bottom: 10px;
      }

      h1 span {
         color: #ff0055;
      }

      a.buy {
         display: block;
         color: #fff;
         background-color: #009879;
         padding: 10px 20px;
         border-radius: 5px;
         text-decoration: none;
         margin-top: 20px;
      }

      a.buy:hover {
         background-color: #ff0055;
      }

      table {
         border-collapse: collapse;
         position:relative;
        top:-168px;
         margin-top: 40px;
         width: 90%;
         display:none;
         max-width: 1000px;
         background-color: #fff;
         box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
         border-radius: 10px;
      }

      th, td {
         padding: 12px 15px;
         text-align: left;
         border-bottom: 1px solid #dddddd;
      }

      th {
         background-color: #009879;
         color: #fff;
      }

      tr:nth-of-type(even) {
         background-color: #f3f3f3;
      }

      tr:last-of-type {
         border-bottom: 2px solid #009879;
      }

      span {
         color: red;
      }

      #po {
         color: green;
      }
  .ko{
    background-color:green;
color:white;
  }
  button#toggleButton:hover {
         background-color: #ff0055;
      }
  .buy a{
         color: #f90;
         text-decoration: underline;
  }
      a.buy {
         position: relative;
         top: 90px;
         right: 0px;
      }

      a.buy:hover {
         color: #f90;
         text-decoration: underline;
      }
      #u{
        position:relative;
        top:-168px;
       
      }
   </style>
</head>
<body>
   
<div class="container">
      <div class="content">
         <h1>Hi, <span>Admin</span></h1>
         <h1>Welcome, <span><?php echo $_SESSION['admin_name'] ?></span></h1>
         <h1 id="po">This is an Admin Page</h1>
         <a href="logout.php" class="buy">Log Out</a>
         <button id="toggleButton" class="ko">Show Data</button>
      </div>
   </div>

   <div id="t">
      <center>
      <h1 id="u" style="display: none;">All Data Entered by Users</h1>
          <table id="dataTable">
            <thead>
               <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Number</th>
                  <th>Plan</th>
                  <th>Address</th>
                  <th>Message</th>
               </tr>
            </thead>
            <tbody>
               <?php
               while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr>";
                  echo "<td>" . $row['name'] . "</td>";
                  echo "<td>" . $row['email'] . "</td>";
                  echo "<td>" . $row['number'] . "</td>";
                  echo "<td>" . $row['plan'] . "</td>";
                  echo "<td>" . $row['address'] . "</td>";
                  echo "<td>" . $row['message'] . "</td>";
                  echo "</tr>";
               }
               ?>
            </tbody>
      </center>
   </div>

</body>
<script>
      // JavaScript to toggle table visibility
      document.getElementById('toggleButton').addEventListener('click', function() {
         var table = document.getElementById('dataTable');
         var header = document.getElementById('u');
         
         if (table.style.display === 'none') {
            table.style.display = 'table';
            header.style.display = 'block';
        } else {
            table.style.display = 'none';
            header.style.display='none';
         }
      });
   </script>
</html>
