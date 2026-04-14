<?php 
include 'db.php';
include 'header.php'; 
?>

<div class="container-fluid">
    <div class="row">

        <?php include 'sidebar.php'; ?>

        <div class="col-md-10 p-4">
            <h2>Customer Bookings</h2>

            <?php
            $sql = "
    SELECT b.booking_id, c.name, c.contact, b.venue, b.guests, b.event_date, b.event_type
    FROM bookings b
    JOIN customers c ON b.customer_id = c.customer_id
";
";
            ";

            $result = $conn->query($sql);

            if (!$result) {
                die("Query Error: " . $conn->error);
            }
            ?>

            <div class="card shadow p-3 mt-3">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Venue</th>
                            <th>Guests</th>
                            <th>Event_date</th>
                            <th>Event_type</th>    
                        </tr>
                    </thead>

                    <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['booking_id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['contact']; ?></td>
                            <td><?php echo $row['venue']; ?></td>
                            <td><?php echo $row['guests']; ?></td>
                            <td><?php echo $row['event_date']; ?></td>
                             <td><?php echo $row['event_type']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No bookings yet</td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>

<?php include 'footer.php'; ?>