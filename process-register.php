<?php
$page_title = 'Application received';
include 'includes/header.php';

// The form sends information using POST.
$routes = [
    '1' => 'Kiserian',
    '2' => 'Ngong',
    '3' => 'Rongai'
];

echo '<main>';

if (isset($_POST['first_name'])) {

    // Receive the submitted information.
    $first = htmlspecialchars($_POST['first_name']);
    $last = htmlspecialchars($_POST['last_name']);
    $phone = htmlspecialchars($_POST['phone']);

    $route_code = $_POST['route'];
    $route = $routes[$route_code] ?? 'Unknown route';

    // Display the confirmation message.
    echo '<h2>Thank you, ' . $first . ' ' . $last . '</h2>';
    echo '<p>We have your application to join the '
         . $route . ' route.</p>';

    echo '<p>The office will call you on ' . $phone
         . ' when your member number is ready.</p>';

} else {

    // Display this message if the page is opened directly.
    echo '<h2>No application</h2>';
    echo '<p>This page answers the membership form. ';
    echo '<a href="register.php">Fill it in first.</a></p>';

}

echo '</main>';

include 'includes/footer.php';
?>