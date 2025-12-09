<?php
session_start();

function test_input($data){
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}

$values = [
    'shop' => "",
    'address' => "",
    'contact' => "",
    'email' => ""
];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $values['shop'] = test_input($_POST['shop'] ?? "");
    $values['address'] = test_input($_POST['address'] ?? "");
    $values['contact'] = test_input($_POST['contact'] ?? "");
    $values['email'] = test_input($_POST['email'] ?? "");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
<form method="post" action="invoice.php">

<h2>Shop Information</h2>

<label>Shop Name:</label>
<input type="text" name="shop" value="<?php echo $values['shop']; ?>"><br>

<label>Address:</label>
<input type="text" name="address" value="<?php echo $values['address']; ?>"><br>

<label>Contact:</label>
<input type="text" name="contact" value="<?php echo $values['contact']; ?>"><br>

<label>Email:</label>
<input type="email" name="email" value="<?php echo $values['email']; ?>"><br>

<table  cellpadding="5">
<tr>
  <th>Item Code</th>
  <th>Item Name</th>
  <th>Quantity</th>
  <th>Unit Price</th>
</tr>

<?php for($i=0; $i<3; $i++) { ?>
<tr>
  <td><input type="text" name="itemcode[]"></td>
  <td><input type="text" name="itemname[]"></td>
  <td><input type="number" name="quantity[]"></td>
  <td><input type="number" name="unitprice[]"></td>
</tr>
<?php } ?>

</table>

<br>
<button type="submit">Submit</button>
<button type="reset">Clear</button>

</form>

</body>
</html>
