<?php

include 'navbar.php'; 
include '../db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST['submit_request'])) {
    // Get form data
    $student_id = $_SESSION['id_number'];  // Accessing session variable
    $reason = $_POST['reason']; // Reason is the 'symptoms' textarea input
    $request_date = $_POST['request_date'];
    $status = $_POST['status']; // Default value is 'pending'

    // Prepare the SQL statement to insert the data
    $sql = "INSERT INTO medicine_requests (student_id, reason, request_date, status) 
            VALUES (?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("isss", $student_id, $reason, $request_date, $status);
        
        if ($stmt->execute()) {
            $message = "Your request has been successfully submitted!";
        } else {
            $message = "There was an error submitting your request.";
        }

        $stmt->close();
    } else {
        $message = "SQL preparation error.";
    }

    $conn->close();
}

?>

<style>
    /* Additional Custom Styling */
    .form-section {
      margin-top: 2rem;
      background: #f8f9fa;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    textarea {
      resize: none;
      font-size: 1rem;
      border: 1px solid #ccc;
      padding: 10px;
      border-radius: 5px;
    }
    textarea:focus {
      border-color: #0d6efd;
      outline: none;
      box-shadow: 0 0 4px rgba(13, 110, 253, 0.25);
    }
   
    button.primary:hover {
      background-color: #0056b3;
    }
    h1, p {
      text-align: center;
    }
</style>
</head>
<body>
  <main class="container">
    <h1>Request Treatment from the Nurse</h1>
    <p>
      Briefly describe why you need treatment. The nurse will review your request and respond accordingly.
    </p>

    <div class="form-section">
      <form method="POST" action="">
        <label for="reason"><strong>Describe Your Symptoms</strong></label>
        <textarea 
          id="reason" 
          name="reason" 
          placeholder="Write your symptoms or issue here..." 
          rows="5" 
          required>
        </textarea>
        
        <!-- Hidden fields -->
        <input type="hidden" name="student_id" value="<?php echo $_SESSION['id_number']; ?>"> <!-- Dynamically set student_id from session -->
        <input type="hidden" name="request_date" value="<?php echo date('Y-m-d H:i:s'); ?>"> <!-- Current date-time -->
        <input type="hidden" name="status" value="pending"> <!-- Default value is 'pending' -->

        <!-- Submit button -->
        <button type="submit" name="submit_request" class="primary">Submit Request</button>
      </form>

      <?php if (isset($message)) { echo "<p>$message</p>"; } ?>
    </div>
  </main>

  <script>
    function handleFormSubmit(event) {
      event.preventDefault();
      const form = document.getElementById("nurseRequestForm");
      const symptoms = form.elements["symptoms"].value;

      alert(`Your request has been submitted with the following details:\n- Symptoms: ${symptoms}`);

      form.reset(); // Clear the form after submission
    }
  </script>
</body>
</html>
