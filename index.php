<?php
//variables 
$values = [
'shop' => "" , 
  'address' => "",
  'contact' => "" , 
  'email' => "" ,
  'itemcode' => "",
  'itemname' => "", 
  'quantity' => "" , 
  'unitprice' => "",
  'totalprice' => "", 
  'discount' => "",
  'totaldiscount' => "",
  'free' => ""

];
//clean function
function test_input($data){
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
}

//process form
if($_SERVER["REQUEST_METHOD"]==="POST"){

  $values['shop'] = test_input($_POST['shop'] ?? "");

  $values['address'] = test_input($_POST['address'] ?? "");

  $values['contact'] = test_input($_POST['contact'] ?? "" );

  $values['email'] = test_input($_POST['email'] ?? "");

  $values['itemcode'] = test_input($_POST['itemcode'] ?? "");

  $values['itemname'] = test_input($_POST['itemname'] ?? "");

  $values['quantity'] = test_input($_POST['quantity'] ?? "");

  $values['unitprice'] = test_input($_POST['unitprice'] ?? "");


}


?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ABC Shop Invoice</title>
</head>
<body>
 <div class="container">
  <form method = "post" action = "invoice.ph" >
  <div class = "field">
    <label> Shop Name: </label>
    <input type = "text"  name = "shop" value = " <?php echo $values['shop']; ?> ">
</div>

<div class = "field">
  <label> Address: </label>
  <input type = "text" name = "address" value = "<?php echo $values['address']; ?> " >
</div>

<div class = "field">
  <label> Contact Number: </label>
  <input type = "text" name ="contact" value = "<?php echo $values['contact']; ?> ">
</div>

<div class = "field">
  <label>Email Address: </label>
  <input type = "email" name = "email" value = " <?php echo $values['email']; ?> ">
</div>

<table>
<tr>   
  <th> Item Code </th>
  <th> Item Name </th>
  <th> Quantity </th>
  <th> Unit Price (Rs.) </th>
</tr>
<?php 
for($i=0; $i<3; $i++){?>
<tr>
  <td> <input type = "text" name = "itemcode" value = "<?php echo $values['itemcode']; ?> " > </td>
  <td> <input type = "text" name = "itemname" value = " <?php echo $values['itemname']; ?> ">  </td>
  <td> <input type = "number" name = "quantity" value = " <?php echo $values['quantity']; ?> "> </td>
  <td> <input type = "number" name = "unitprice" value = " <?php echo $values['unitprice']; ?> "> </td>
</tr>  

<?php  
if($_SERVER["REQUEST_METHOD"] === "POST"){
$values['totalprice'] = $values['quanity'] * $values['unitprice'];
if($values['quantity'] > 10 && $values ['quantity'] <21){
  
  $values['discount'] =  $values['totalprice']/50 ; 
}
elseif($values['quantity'] >20 && $values ['quanitity'] < 51){
 
  $values['discount'] = $values['totalprice']/10; 
}
elseif($values['quantity'] >50){
  $values['free'] = int($values['quantity']/30);
  $values['free'] *= $values['unitprice'];
  $values['discount'] = $values['free']; 
}
$values['totaldiscount'] += $values['discount'];
?>
<?php }
}
?>

</table>
<button type = ""> Add more item </button> 
<button type = "submit" > Submit </button> <button type = "clear" > Clear </button>


</body>
</html>