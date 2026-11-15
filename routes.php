<?php
$page_title = 'Our routes';
include 'includes/header.php';
?>

<main>

<label for="route-search">Search routes or collection centres</label>
<input type="search" id="route-search" placeholder="Type a route or centre name" aria-describedby="route-search-help">
<p id="route-search-help">Enter a route or collection centre to filter the list.</p>
<p id="route-no-results" hidden>No matching routes or centres found.</p>

<section class="route-card">
    <h2>Kiserian Route</h2>

    <p>The lorry runs from 6.30am and again from 4.00pm.</p>

    <ul>
        <li>Olepolos Centre</li>
        <li>Kandisi Centre</li>
    </ul>
</section>

<section class="route-card">
    <h2>Ngong Route</h2>

    <p>The lorry runs twice daily.</p>

    <ul>
        <li>Ngong Centre 1</li>
        <li>Ngong Centre 2</li>
    </ul>
</section>

<section class="route-card">
    <h2>Rongai Route</h2>

    <p>The lorry runs twice daily.</p>

    <ul>
        <li>Rongai Centre 1</li>
        <li>Rongai Centre 2</li>
    </ul>
</section>

</main>

<?php include 'includes/footer.php'; ?>

</body>
</html>