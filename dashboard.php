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
            <h2>Dashboard</h2>

            <div class="row mt-4">

                <div class="col-md-4">
                    <div class="card shadow p-3">
                        <h5>Total Bookings</h5>
                        <h3><?php echo $total_bookings; ?></h3>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow p-3">
                        <h5>Total Customers</h5>
                        <h3><?php echo $total_customers; ?></h3>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card shadow p-3">
                        <h5>Revenue</h5>
                        <h3>₱<?php echo number_format($total_revenue, 2); ?></h3>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<?php include 'footer.php'; ?>