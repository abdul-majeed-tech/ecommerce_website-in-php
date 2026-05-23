<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<?php
$username=$_SESSION['username'];
$get_user="select * from `user_table` where username='$username'";
$result=mysqli_query($con,$get_user);
$row_fetch=mysqli_fetch_assoc($result);
$user_id=$row_fetch['user_id'];
//echo $user_id;
?>
    <h4 class="text-success">All my orders</h4>
    <table class="table table-bordered mt-5">
        <thead>
            <tr class="table-info">
                <th>Sl no</th>
                <th>Amount Due</th>
                <th>Total products</th>
                <th>invoice number</th>
                <th>Date</th>
                <th>Complete/Incomplete</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody >
            <?php
            $get_order_details="select * from `user_orders` where user_id=$user_id";
            $result_orders=mysqli_query($con,$get_order_details);
            while($row_order=mysqli_fetch_assoc($result_orders)){
                $order_id=$row_order['order_id'];
                $amount_due=$row_order['amount_due'];
                $invoice_number=$row_order['invoice_number'];
                $total_products=$row_order['total_products'];
                $invoice_number=$row_order['invoice_number'];
                $order_status=$row_order['order_status'];
                if($order_status=='pending'){
                    $order_status="Incomplete";
                }else{
                    $order_status="Complete";
                }
                $order_date=$row_order['order_date'];
                
                $number=1;
                echo "<tr class='table-secondary text-light'>
                <td>$number</td>
                <td>$amount_due</td>
                <td>$total_products</td>
                <td>$invoice_number</td>
                <td>$order_date</td>
                <td>$order_status</td>";
                ?>
                <?php
                if($order_status=='Complete'){
                   echo "<td>paid</td>";
                }else{
                    echo "<td><a href='confirm_payment.php?order_id=$order_id' class='text-light'>confirm</a></td>
            </tr>";
                }               
            $number++;

            }

            ?>
            
        </tbody>
    </table>
</body>

</html>