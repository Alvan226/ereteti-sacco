<?php
require_once 'includes/db.php';

$page_title = 'Our routes';

$sql = "SELECT route_name, collection_centre FROM route ORDER BY route_id";
$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Error retrieving routes: ' . mysqli_error($conn));
}

include 'includes/header.php';
?>

<main>

<label for="route-search">Search routes or collection centres</label>
<input type="search" id="route-search" placeholder="Type a route or centre name" aria-describedby="route-search-help">

<p id="route-search-help">Enter a route or collection centre to filter the list.</p>
<p id="route-no-results" hidden>No matching routes or centres found.</p>

<?php while ($row = mysqli_fetch_assoc($result)): ?>

<section class="route-card">

    <h2><?php echo htmlspecialchars($row['route_name']); ?> Route</h2>

    <p>Milk is cooled at <?php echo htmlspecialchars($row['collection_centre']); ?>.</p>

</section>

<?php endwhile; ?>

</main>

<?php include 'includes/footer.php'; ?>