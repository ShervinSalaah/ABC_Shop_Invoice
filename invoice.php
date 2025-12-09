<?php
session_start();

function test_input($data){
    return htmlspecialchars(stripslashes(trim($data)));
}

$shop = test_input($_POST['shop']);
$address = test_input($_POST['address']);
$contact = test_input($_POST['contact']);
$email = test_input($_POST['email']);

$itemcode = $_POST['itemcode'];
$itemname = $_POST['itemname'];
$quantity = $_POST['quantity'];
$unitprice = $_POST['unitprice'];

$grandTotal = 0;
$totalDiscount = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice </title>
</head>
<body>
  

<h2> <?php echo $shop; ?> -Invoice</h2>
<p><strong>Address:</strong> <?php echo $address; ?></p>
<p><strong>Contact:</strong> <?php echo $contact; ?></p>
<p><strong>Email:</strong> <?php echo $email; ?></p>

<table  cellpadding="5">
<tr>
  <th>Item Code</th>
  <th>Item Name</th>
  <th>Quantity</th>
  <th>Total Price</th>
</tr>

<?php
for ($i = 0; $i < count($itemcode); $i++) {

    if ($quantity[$i] == "" || $unitprice[$i] == "") continue;

    $qty = (int)$quantity[$i];
    $price = (float)$unitprice[$i];
    $total = $qty * $price;
    $discount = 0;

    // Discount rules
    if ($qty > 10 && $qty < 21) {
        $discount = $total / 50;
    }
    elseif ($qty > 20 && $qty < 51) {
        $discount = $total / 10;
    }
    elseif ($qty > 50) {
        $free = intval($qty / 30) * $price * 5; 
        $discount = $free;
    }

    $grandTotal += $total;
    $totalDiscount += $discount;

    echo "<tr>
            <td>{$itemcode[$i]}</td>
            <td>{$itemname[$i]}</td>
            <td>{$qty}</td>
            <td>{$total}</td>
          </tr>";
}
?>

</table>


<p><strong>Grand Total:</strong> Rs. <?php echo $grandTotal; ?></p>
<p><strong>Total Discount:</strong> Rs. <?php echo $totalDiscount; ?></p>
<p><strong>Net Payable:</strong> Rs. <?php echo $grandTotal - $totalDiscount; ?></p>

</body>
</html>
