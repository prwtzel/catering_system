<?php
include 'db.php';
include 'header.php';

// Total bookings
$booking_result = $conn->query("SELECT COUNT(*) as total FROM bookings");
$booking_data = $booking_result->fetch_assoc();
$total_bookings = $booking_data['total'];

// Total customers
$customer_result = $conn->query("SELECT COUNT(*) as total FROM customers");
$customer_data = $customer_result->fetch_assoc();
$total_customers = $customer_data['total'];

// Revenue
$revenue_result = $conn->query("SELECT SUM(guests * 500) as total FROM bookings");
$revenue_data = $revenue_result->fetch_assoc();
$total_revenue = $revenue_data['total'] ?? 0;
?>

<div class="container-fluid">
    <div class="row">

        <?php include 'sidebar.php'; ?>

        <div class="col-md-10 p-4">

            <h2 class="mb-4">📊 Dashboard Overview</h2>

            <!-- STATS CARDS -->
            <div class="row g-4">

                <div class="col-md-4">
                    <div class="card shadow border-0 text-white bg-primary p-3">
                        <h5>📅 Total Bookings</h5>
                        <h2><?php echo $total_bookings; ?></h2>
                        <small>All customer bookings</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow border-0 text-white bg-success p-3">
                        <h5>👥 Total Customers</h5>
                        <h2><?php echo $total_customers; ?></h2>
                        <small>Registered clients</small>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow border-0 text-white bg-warning p-3">
                        <h5>💰 Total Revenue</h5>
                        <h2>₱<?php echo number_format($total_revenue, 2); ?></h2>
                        <small>Estimated earnings</small>
                    </div>
                </div>

            </div>

            <!-- QUICK INSIGHTS -->
            <div class="row mt-5">

                <div class="col-md-6">
                    <div class="card shadow p-4">
                        <h5>📈 Business Status</h5>

                        <?php
                        if ($total_bookings > 10) {
                            echo "<p class='text-success'>🔥 Your business is growing!</p>";
                        } else {
                            echo "<p class='text-warning'>📊 Keep promoting your service</p>";
                        }
                        ?>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card shadow p-4">
                        <h5>📌 Quick Actions</h5>

                        <a href="book.php" class="btn btn-primary w-100 mb-2">➕ Add Booking</a>
                        <a href="bookings.php" class="btn btn-dark w-100 mb-2">📋 View Bookings</a>
                        <a href="report.php="btn btn-success w-100">📊 View Reports</a>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>