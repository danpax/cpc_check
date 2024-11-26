

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

</head>
  <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .sidebar {
            background-color: grey;
            height: 100vh;
            width: 250px;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
        }

        .sidebar h2 {
            color: #333;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar li {
            margin-bottom: 15px;
        }

        .sidebar a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
            background-color: #fff;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .sidebar a:hover {
            background-color: #ddd;
        }

        .container{
            margin-left: 17%;
        }
        input[type="search"] {
            margin-left: 20%;
            width: 500px;
            padding: 10px;
            font-size: 16px;
            border: 2px solid black;
            border-radius: 10px;
            outline: none;
            transition: all 0.3s ease;
        }

        /* Change border color and add shadow on focus */
        input[type="search"]:focus {
            border-color: #007BFF;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }

        /* Styling the placeholder text */
        input[type="search"]::placeholder {
            color: #888;
            font-style: italic;
        }

        /* Customizing the clear button in WebKit browsers */
        input[type="search"]::-webkit-search-cancel-button {
            -webkit-appearance: none;
            height: 16px;
            width: 16px;
            background-image: url('../img/cancel.png'); /* Customize with your own image */
            background-size: contain;
            cursor: pointer;
        }
        
    </style>
<body>
    <div class="sidebar">
    <center><a href="adDashboard.php"><img src="../img/phoenix.jpg" alt="" style="width: 180px; height: 80px; border-radius: 5px;"></a></center>
        <h3>CPC CHECK</h3>
        <h5>Nurse Panel</h5>
        <br>
        <ul>
            <li><a href="adInventory.php" class="text-decoration-none">Inventory</a></li>
            <li><a href="adRequest.php" class="text-decoration-none">Student Request</a></li>
            <li><a href="adHistory.php" class="text-decoration-none">Student History</a></li>
            <li><a href="adRecord.php" class="text-decoration-none">Student Record</a></li>
            <li><a href="adMonitoring.php" class="text-decoration-none">Monitored Student</a></li>
        </ul>
    </div>
    <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#myModal" style="float: right; margin-right: 10%; height: 50px">+ Add Medicine</button>
    <input type="search" name="search" id="search" placeholder="Search" onkeyup="searchMedicines()">

    <div class="container mt-5">
        <table class="table table-striped table-bordered" id="medicineTable">
            <thead class="table-dark">
                <tr>
                    <th>Medicine</th>
                    <th>Stock</th>
                    <th>Description</th>
                    <th>Expiration Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Rows will be added here -->
            </tbody>
        </table>

        <div class="modal" id="myModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add New Medicine</h4>
                    </div>
                    <div class="modal-body">
                        <label for="medicine" class="form-label">Medicine: </label>
                        <input type="text" id="medicine" class="form-control">
                        <label for="stock" class="form-label">Stock: </label>
                        <input type="text" id="stock" class="form-control">
                        <label for="description" class="form-label">Description: </label>
                        <input type="text" id="description" class="form-control">
                        <label for="expiration" class="form-label">Expiration Date: </label>
                        <input type="date" id="expiration" class="form-control">
                        <button type="button" class="btn btn-primary mt-3" id="addMedicineBtn">Add</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script>
        document.getElementById('addMedicineBtn').addEventListener('click', function() {
            const medicine = document.getElementById('medicine').value;
            const stock = document.getElementById('stock').value;
            const description = document.getElementById('description').value;
            const expiration = document.getElementById('expiration').value;

            if (medicine && stock && description && expiration) {
                const xhr = new XMLHttpRequest();
                xhr.open("POST", "add_medicine.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onload = function() {
                    if (this.status === 200) {
                        const response = JSON.parse(this.responseText);
                        if (response.success) {
                            addMedicineToTable(response.data);
                            // Clear the input fields
                            document.getElementById('medicine').value = '';
                            document.getElementById('stock').value = '';
                            document.getElementById('description').value = '';
                            document.getElementById('expiration').value = '';
                            // Close the modal
                            var myModalEl = document.getElementById('myModal');
                            var modal = bootstrap.Modal.getInstance(myModalEl);
                            modal.hide();
                        } else {
                            alert('Failed to add medicine!');
                        }
                    }
                };
                xhr.send(`medicine=${medicine}&stock=${stock}&description=${description}&expiration=${expiration}`);
            } else {
                alert(' Please fill in all fields!');
            }
        });

        function searchMedicines() {
            const searchInput = document.getElementById('search').value.toLowerCase();
            const tableRows = document.querySelectorAll('#medicineTable tbody tr');

            tableRows.forEach((row) => {
                const medicine = row.cells[0].textContent.toLowerCase();
                const stock = row.cells[1].textContent.toLowerCase();
                const description = row.cells[2].textContent.toLowerCase();
                const expiration = row.cells[3].textContent.toLowerCase();

                if (medicine.includes(searchInput) || stock.includes(searchInput) || description.includes(searchInput) || expiration.includes(searchInput)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        function addMedicineToTable(medicineData) {
            const tableBody = document.querySelector('#medicineTable tbody');
            const newRow = `
                <tr ${medicineData.expiration < new Date().toISOString().split('T')[0] ? 'class="expired"' : ''}>
                    <td>${medicineData.medicine}</td>
                    <td>${medicineData.stock}</td>
                    <td>${medicineData.description}</td>
                    <td>${medicineData.expiration}</td>
                    <td><button class="btn btn-danger w-50">Delete</button></td>
                </tr>
            `;
            tableBody.insertAdjacentHTML('beforeend', newRow);
        }
    </script> -->

</body>
</html>