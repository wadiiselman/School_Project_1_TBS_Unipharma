/* Styles for the page header */
h1 {
  font-size: 32px;
  color: #333;
  text-align: center;
  margin: 40px 0;
}

/* Styles for the medications table */
table {
  width: 80%;
  margin: 0 auto;
  border-collapse: collapse;
}

th, td {
  border: 1px solid #ccc;
  padding: 10px;
}

th {
  background-color: #eee;
  font-weight: bold;
}

/* Styles for the "Order" button */
button {
  display: block;
  margin: 20px auto;
  width: 100px;
  height: 30px;
  background-color: #4caf50;
  color: #fff;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
Copy code
<?php

// Connect to the database
$host = "localhost";
$username = "username";
$password = "password";
$dbname = "database_name";

$conn = mysqli_connect($host, $username, $password, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Get the form data
$medication = mysqli_real_escape_string($conn, $_POST['medication']);
$pharmacy = mysqli_real_escape_string($conn,$_POST['pharmacy'];




// Prepare the SQL query
$query = "SELECT m.name AS 'Medication Name', m.description AS 'Description', p.phar_name AS 'Pharmacy Name', p.location AS 'Location'
          FROM medication m
          INNER JOIN pharmacy_medication pm ON m.med_id = pm.med_id
          INNER JOIN pharmacy p ON pm.phar_id = p.phar_id
          WHERE m.name LIKE '%$medication%' AND p.phar_name LIKE '%$pharmacy%'";

// Execute the query
$result = mysqli_query($conn, $query);

// If no results were found, display a message
if (mysqli_num_rows($result) == 0) {
  echo "<p>No results found.</p>";
} else {
  // Display the results in a table
  echo "<table>";
  echo "<tr><th>Medication Name</th><th>Description</th><th>Pharmacy Name</th><th>Location</th><th>Order</th></tr>";
  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['Medication Name'] . "</td>";
    echo "<td>" . $row['Description'] . "</td>";
    echo "<td>" . $row['Pharmacy Name'] . "</td>";
    echo "<td>" . $row['Location'] . "</td>";
    echo "<td><button>Order</button></td>";
    echo "</tr>";
  }
  echo "</table>";
}

// Close the connection
mysqli_close($conn);