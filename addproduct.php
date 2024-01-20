<?php
require './import/hedar.php';
require './import/db.php';
require './import/navconn.php';
?>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
        $product_name = $_POST["product_name"];
        $cata = $_POST["cata"];
        $price = $_POST["price"];

        $sql = "INSERT INTO product_price (product_name, cata, price) VALUES ('$product_name', '$cata', $price)";

        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success" role="alert">
                    Product added successfully
                  </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    Error: ' . $sql . '<br>' . $conn->error . '
                  </div>';
        }
    }
    ?>
    <div class="container mt-3">
        <form class=" bg-white  border shadow rounded p-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h2 class="">Add Product</h2>
        <input type="hidden" name="add_product">
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" class="form-control" name="product_name" required>
            </div>

            <div class="form-group mt-2">
                <label for="cata">Category:</label>
                <select class="form-control" name="cata" required>
                    <option value="চাল">চাল</option>
                    <option value="মশলা">মশলা</option>
                    <option value="ওয়াশ">ওয়াশ</option>
                    <option value="খাদ্য">খাদ্য</option>
                    <option value="অন্যান্য">অন্যান্য</option>
                </select>
            </div>

            <div class="form-group mt-2">
                <label for="price">Price:</label>
                <input type="number" class="form-control" name="price" required>
            </div>

            <button type="submit" class=" mt-3 btn btn-primary">Add Product</button>
        </form>
    </div>
    <?php
// Execute a SELECT query to retrieve data from the table
$query = "SELECT * FROM product_price WHERE id ORDER BY id DESC";
$result = mysqli_query($conn, $query);
?>
<?php
// Check if the form is submitted for updating price
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_id'])) {
    $updateId = $_POST['update_id'];
    $newPrice = $_POST['new_price'];
    $updateQuery = "UPDATE product_price SET price = $newPrice WHERE id = $updateId";
    mysqli_query($conn, $updateQuery);

    // Redirect to the same page to reload
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
// Execute a SELECT query to retrieve data from the table
$query = "SELECT * FROM product_price ORDER BY id DESC";
$result = mysqli_query($conn, $query);

// Check if the form is submitted for deletion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $deleteId = $_POST['delete_id'];
    $deleteQuery = "DELETE FROM product_price WHERE id = $deleteId";
    mysqli_query($conn, $deleteQuery);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

?>
<div class="container mt-3">
    <table class="table table-striped table-bordered">
        <thead>
            <tr class="text-center fw-bold">
                <td>পণ্য</td>
                <td>ক্যাটাগরি</td>
                <td>দাম</td>
                <td>মুছুন</td>
            </tr>
        </thead>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo '
            <tr>
                <td>'.$row['product_name'].'</td>
                <td>'.$row['cata'].'</td>
                <td class="text-end"> <form method="post">
                <input type="hidden" name="update_id" value="'.$row['id'].'">
                <label for="new_price" class="sr-only">New Price</label>
                <input type="number" name="new_price" class="form-control" placeholder="New Price" value="'.$row['price'].'" required>
                <button type="submit" class="btn btn-primary mt-2">Update</button>
            </form></td>
                <td class=" text-center">
                    <form method="post">
                        <input type="hidden" name="delete_id" value="'.$row['id'].'">
                        <button type="submit" class=" bg-transparent border-0">
                            <i class="fa-solid fa-trash-can text-danger"></i>
                        </button>
                    </form>
                </td>
            </tr>';
        }?>
    </table>
</div> 
<?php
require './import/footer.php';
?>