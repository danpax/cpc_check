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

?><style>
/* General Styles */


/* Form Section Styling */
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
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

textarea:focus {
    border-color: #0d6efd;
    outline: none;
    box-shadow: 0 0 6px rgba(13, 110, 253, 0.4);
}

/* Button Styling */
.primary {
    background-color: #0d6efd;
    color: #ffffff;
    padding: 12px 24px;
    font-size: 1rem;
    border: none;
    border-radius: 5px;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

.primary:hover {
    background-color: #0056b3;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.primary:focus {
    outline: none;
    box-shadow: 0 0 6px rgba(13, 110, 253, 0.4);
}

/* Feedback Message Styling */
.feedback-message {
    margin-top: 1rem;
    color: #28a745;
    text-align: center;
    font-weight: bold;
}

/* Typography */
h2 {
    text-align: center;
    margin-bottom: 1.5rem;
    font-size: 1.75rem;
    color: #0d6efd;
}

p {
    text-align: center;
    margin-bottom: 2rem;
    color: #6c757d;
}

/* Responsive Design */
@media (max-width: 768px) {
    .form-section {
        padding: 1.5rem;
    }

    h2 {
        font-size: 1.5rem;
    }

    .primary {
        font-size: 0.9rem;
    }
}
</style>

<div class="container mt-5">
<h2>Request Treatment from the Nurse</h2>
<p>
    Briefly describe why you need treatment. The nurse will review your request and respond accordingly.
</p>

<div class="form-section">
    <form method="POST" action="request.php">
        <fieldset>
            <legend class="mb-3"><strong>Describe Your Symptoms</strong></legend>
            <div class="mb-3">
                <label for="reason" class="form-label">Symptoms or Issue</label>
                <textarea
                    id="reason"
                    name="reason"
                    class="form-control"
                    placeholder="Write your symptoms or issue here..."
                    rows="5"
                    required></textarea>
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
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>