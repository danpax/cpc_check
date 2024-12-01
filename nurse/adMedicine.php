<?php
session_start();
if (!isset($_SESSION["id_number"])) {
    header("Location: ../login.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "clinic");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Add new medicine
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_medicine'])) {
    $medicine_name = $conn->real_escape_string($_POST['medicine_name']);
    $stock = intval($_POST['stock']);
    $description = $conn->real_escape_string($_POST['description']);
    $expiration = $conn->real_escape_string($_POST['expiration']);
    
    $sql = "INSERT INTO medicines (medicine_name, stock, description, expiration_date) VALUES ('$medicine_name', $stock, '$description', '$expiration')";
    $conn->query($sql);
}

// Fetch medicines
$sql = "SELECT * FROM medicines ORDER BY expiration_date ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

    <style>
        .expired { background-color: red; }
    </style>
<body>
    <?php include 'navbar.php';?>
    <br>
    <br>

    <div class="container mt-5">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMedicineModal" style="float: right; margin-right: 10%; height: 50px">+ Add Medicine</button>
        <input type="search" name="search" id="search" placeholder="Search" onkeyup="searchMedicines()">
        <br>
        <br>

        <table class="table table-striped table-bordered" id="medicineTable">
            <thead class="table-dark">
                <tr>
                    <th>Medicine</th>
                    <th>Stock</th>
                    <th>Description</th>
                    <th>Expiration Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        $expired = strtotime($row['expiration_date']) < time() ? 'expired' : '';
                        echo "<tr class='" . $expired . "'>";
                        echo "<td>" . htmlspecialchars($row['medicine_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['stock']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['description']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['expiration_date']) . "</td>";
                        echo "<td>" . ($expired ? 'Expired' : 'Active') . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No medicines found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Add Medicine Modal -->
        <div class="modal" id="addMedicineModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Medicine</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                            <label for="medicine_name" class="form-label">Medicine name: </label>
                            <input type="text" id="medicine_name" name="medicine_name" class="form-control" required>
                            
                            <label for="stock" class="form-label">Stock: </label>
                            <input type="number" id="stock" name="stock" class="form-control" required>
                            
                            <label for="description" class="form-label">Description: </label>
                            <input type="text" id="description" name="description" class="form-control" required>
                            
                            <label for="expiration" class="form-label">Expiration Date: </label>
                            <input type="date" id="expiration" name="expiration" class="form-control" required>
                            
                            <button type="submit" name="add_medicine" class="btn btn-primary mt-3">Add</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function searchMedicines() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("search");
            filter = input.value.toUpperCase();
            table = document.getElementById("medicineTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>
</html>