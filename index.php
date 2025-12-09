<?php
session_start();

function test_input($data){
    return htmlspecialchars(stripslashes(trim($data)));
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
  <title>Create Invoice</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

<form method="post" action="invoice.php">

<h3 class="section-title">Shop Information</h3>

<label>Shop Name:</label>
<input type="text" name="shop" value="<?php echo $values['shop']; ?>">

<label>Address:</label>
<input type="text" name="address" value="<?php echo $values['address']; ?>">

<label>Contact:</label>
<input type="text" name="contact" value="<?php echo $values['contact']; ?>">

<label>Email:</label>
<input type="email" name="email" value="<?php echo $values['email']; ?>">

<h3 class="section-title">Items</h3>

<table id="itemsTable">
<tr>
  <th>Item Code</th>
  <th>Item Name</th>
  <th>Quantity</th>
  <th>Unit Price</th>
</tr>

<tr>
  <td><input type="text" name="itemcode[]"></td>
  <td><input type="text" name="itemname[]"></td>
  <td><input type="number" name="quantity[]"></td>
  <td><input type="number" name="unitprice[]"></td>
</tr>

</table>

<button type="button" class="add-btn" onclick="addRow()">+ Add More</button>
<br><br>

<button type="submit" class="submit-btn">Submit</button>
<button type="reset" class="reset-btn">Clear</button>

</form>

</div>

<!-- JS to add more rows -->
<script>
function addRow() {
    let table = document.getElementById("itemsTable");
    let row = table.insertRow(-1);

    row.innerHTML = `
        <td><input type="text" name="itemcode[]"></td>
        <td><input type="text" name="itemname[]"></td>
        <td><input type="number" name="quantity[]"></td>
        <td><input type="number" name="unitprice[]"></td>
    `;
}
</script>

</body>
</html>
