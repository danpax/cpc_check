<?php

include 'navbar.php'; 
include '../db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if (isset($_POST['submit_request'])) {
    // Get form data
    $user_id = $_SESSION['user']['id'];  // Accessing session variable
    $reason = $_POST['reason']; // Reason is the 'symptoms' textarea input
    $created_at = $_POST['created_at'];
    $status = $_POST['status']; // Default value is 'pending'
    echo($reason);
    // Prepare the SQL statement to insert the data
    $sql = "INSERT INTO requests (user_id, reason, created_at, status) 
            VALUES (?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("isss", $user_id, $reason, $created_at, $status);
        
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
    /* Custom Styling */
    .form-section {
      margin-top: 2rem;
      background: #ffffff;
      padding: 2rem;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    textarea {
      resize: none;
      font-size: 1rem;
      border: 1px solid #ced4da;
      padding: 10px;
      border-radius: 5px;
    }

    textarea:focus {
      border-color: #0d6efd;
      outline: none;
      box-shadow: 0 0 4px rgba(13, 110, 253, 0.25);
    }

    button.primary {
      background-color: #0d6efd;
      color: #ffffff;
      padding: 10px 20px;
      font-size: 1rem;
      border: none;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    button.primary:hover {
      background-color: #0056b3;
    }

    .feedback-message {
      margin-top: 1rem;
      color: #28a745;
      text-align: center;
      font-weight: bold;
    }

    h1, p {
      text-align: center;
      margin-bottom: 1.5rem;
    }
  </style>
<div class="container mt-5">
    <h2 class="mb-4 text-center">Request Treatment from the Nurse</h2>
    <p>
      Briefly describe why you need treatment. The nurse will review your request and respond accordingly.
    </p>

    <div class="form-section">
      <form method="POST" action="request.php">
        <fieldset>
          <legend><strong>Describe Your Symptoms</strong></legend>
          <div class="mb-3">
            <label for="reason" class="form-label">Symptoms or Issue</label>
            <textarea 
              id="reason" 
              name="reason" 
              class="form-control" 
              placeholder="Write your symptoms or issue here..." 
              rows="5" 
              required>
            </textarea>
          </div>
        </fieldset>

        <!-- Hidden fields -->
        <input type="hidden" name="created_at" value="<?php echo date('Y-m-d H:i:s'); ?>"> <!-- Current date-time -->
        <input type="hidden" name="status" value="pending"> <!-- Default value is 'pending' -->

        <!-- Submit button -->
        <div class="d-grid gap-2">
          <button type="submit" name="submit_request" class="primary">Submit Request</button>
        </div>
      </form>

      <?php if (isset($message)): ?>
        <p class="feedback-message"><?php echo htmlspecialchars($message); ?></p>
      <?php endif; ?>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
