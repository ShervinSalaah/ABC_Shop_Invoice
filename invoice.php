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
  <title>Invoice</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="invoice-box">

<h2><centre><?php echo $shop; ?> – Invoice </centre></h2>

<p><strong>Address:</strong> <?php echo $address; ?></p>
<p><strong>Contact:</strong> <?php echo $contact; ?></p>
<p><strong>Email:</strong> <?php echo $email; ?></p>


<h3 class="section-title">Purchased Items</h3>

<table cellpadding="5">
<tr>
  <th>Item Code</th>
  <th>Item Name</th>
  <th>Quantity</th>
  <th>Unit Price (Rs.)</th>
  <th>Total Price (Rs.)</th>
  <th>Discount (Rs.)</th>
</tr>

<?php
for ($i = 0; $i < count($itemcode); $i++) {

    if ($quantity[$i] === "" || $unitprice[$i] === "") continue;

    $code = test_input($itemcode[$i]);
    $name = test_input($itemname[$i]);
    $qty = (int)$quantity[$i];
    $price = (float)$unitprice[$i];

    $total = $qty * $price;
    $discount = 0;

    // Discount Rules ------------------------------------
    if ($qty > 10 && $qty < 21) {
        $discount = $total / 50; // 2%
    }
    elseif ($qty > 20 && $qty < 51) {
        $discount = $total / 10; // 10%
    }
    elseif ($qty > 50) {
        // 1 free item per 30 purchased → multiplied by item price
        $freeItemsValue = intval($qty / 30) * $price;
        $discount = $freeItemsValue;
    }
    // -----------------------------------------------------

    $grandTotal += $total;
    $totalDiscount += $discount;

    echo "
    <tr>
        <td>$code</td>
        <td>$name</td>
        <td>$qty</td>
        <td>$price</td>
        <td>$total</td>
        <td>$discount</td>
    </tr>";
}
?>

</table>

<div class="invoice-summary">
    <p><strong>Grand Total:</strong> Rs. <?php echo number_format($grandTotal, 2); ?></p><br>
    <p><strong>Total Discount:</strong> Rs. <?php echo number_format($totalDiscount, 2); ?></p><br>
    <p><strong>Net Payable:</strong> Rs. <?php echo number_format(($grandTotal - $totalDiscount), 2); ?></p>
</div>

</div>

</body>
</html>
