<?php
require './import/hedar.php';
require './import/db.php';
require './import/navconn.php';
?>
<?php
// Execute a SELECT query to retrieve data from the table
$query = "SELECT * FROM product_price WHERE id ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<?php
// Execute a SELECT query to retrieve data from the table
$query = "SELECT * FROM product_price ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<div class="container mt-3">
    <table class="table table-striped table-bordered shadow">
        <thead>
            <tr class="text-center fw-bold">
                <td>পণ্য</td>
                <td>ক্যাটাগরি</td>
                <td>দাম</td>
            </tr>
        </thead>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
            <tr>
                <td>'.$row['product_name'].'</td>
                <td>'.$row['cata'].'</td>
                <td class="text-end">'.$row['price'].'</td>
            </tr>';
        }?>
    </table>
</div> 

<?php
require './import/footer.php';
?>