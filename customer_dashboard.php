<?php
session_start();
include 'db.php';

if (!isset($_SESSION['customer_id'])) {
    header("Location: customer_login.php");
    header("location:book.php");
    exit();
}

$customer_id = $_SESSION['customer_id'];

// BOOKINGS
$bookings = $conn->query("
    SELECT * FROM bookings 
    WHERE customer_id='$customer_id'
    ORDER BY event_date DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard - Event Booker</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
        }

        .header {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 20px;
            border-radius: 0 0 20px 20px;
        }

        .card-box {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .btn-book {
            background: #667eea;
            color: white;
        }

        .btn-book:hover {
            background: #5a67d8;
            color: white;
        }
    </style>
</head>

<body>

<!-- HEADER -->
<div class="header">
    <div class="container">
        <h3>👋 Welcome, <?php echo $_SESSION['customer_name']; ?></h3>
        <p>Book your events easily</p>

        <!-- OPEN MODAL BUTTON -->
        <button class="btn btn-light mt-2" data-bs-toggle="modal" data-bs-target="#bookModal">
            ➕ Book Event
        </button>
    </div>
</div>

<div class="container mt-4">

    <!-- BOOKINGS TABLE -->
    <div class="card card-box p-4">

        <h5 class="mb-3">📋 My Bookings</h5>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Venue</th>
                    <th>Guests</th>
                    <th>Date</th>
                    <th>Type</th>
                </tr>
            </thead>

            <tbody>
                <?php if ($bookings->num_rows > 0): ?>
                    <?php while ($row = $bookings->fetch_assoc()): ?>
                        <tr>
                            <td><?= $row['venue'] ?></td>
                            <td><?= $row['guests'] ?></td>
                            <td><?= $row['event_date'] ?></td>
                            <td><?= $row['event_type'] ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No bookings yet</td>
                    </tr>
                <?php endif; ?>
            </tbody>

        </table>

    </div>

</div>

<!-- BOOKING MODAL -->
<div class="modal fade" id="bookModal" tabindex="-1">

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title">📅 Book Event</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <form action="save_booking.php" method="post">

            <input type="hidden" name="customer_id" value="<?= $customer_id ?>">

            <div class="mb-2">
                <label>Venue</label>
                <input name="venue" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Guests</label>
                <input name="guests" type="number" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Event Date</label>
                <input name="event_date" type="date" class="form-control" required>
            </div>

            <div class="mb-2">
                <label>Event Type</label>
                <select name="event_type" class="form-control">
                    <option>Birthday</option>
                    <option>Wedding</option>
                    <option>Corporate</option>
                    <option>Others</option>
                </select>
            </div>

            <button class="btn btn-primary w-100 mt-2">
                🎉 Submit Booking
            </button>

        </form>

      </div>

    </div>

  </div>

</div>

<!-- BOOTSTRAP JS (IMPORTANT FOR MODAL) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>