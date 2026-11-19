<?php
require_once 'includes/db.php';

$page_title = 'Deliveries';

// Retrieve milk deliveries for 12 October 2026
$sql = "SELECT f.member_no, f.first_name, f.last_name,
               d.session, d.litres, d.accepted
        FROM milk_delivery d
        INNER JOIN farmer f ON d.farmer_id = f.farmer_id
        WHERE d.delivery_date = '2026-10-12'
        ORDER BY f.member_no, d.session";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die('Error retrieving deliveries: ' . mysqli_error($conn));
}

$accepted_total = 0;

include 'includes/header.php';
?>

<main>
    <p>Milk received at the Olepolos centre on the Kiserian route,
    Monday 12 October 2026. Both morning and evening sessions are listed.</p>

<h2>Record a delivery</h2>

<form id="delivery-form" action="#" method="post">

    <label for="member">Member number</label>
    <input type="text" id="member" name="member_no"
           placeholder="ER-0000" required>

    <p id="member-message" class="message"
       aria-live="polite"></p>

    <label for="session">Session</label>
    <select id="session" name="session" required>
        <option value="">Choose a session</option>
        <option value="MORNING">Morning</option>
        <option value="EVENING">Evening</option>
    </select>

    <label for="litres">Litres</label>
    <input type="number" id="litres" name="litres"
           step="0.01" required>

    <p id="litres-message" class="message"
       aria-live="polite"></p>

    <button type="submit">Record delivery</button>
    <p id="form-message" aria-live="polite"></p>

</form>

<div class="table-scroll">
    <table>
        <caption>Milk received, Monday 12 October 2026</caption>

        <thead>
            <tr>
                <th scope="col">Member</th>
                <th scope="col">Farmer</th>
                <th scope="col">Session</th>
                <th scope="col">Litres</th>
                <th scope="col">Accepted</th>
            </tr>
        </thead>

        <tbody>

            <?php while ($row = mysqli_fetch_assoc($result)): ?>

                <tr>
                    <td><?php echo htmlspecialchars($row['member_no']); ?></td>

                    <td>
                        <?php
                        echo htmlspecialchars($row['first_name'] . ' ' . $row['last_name']);
                        ?>
                    </td>

                    <td><?php echo htmlspecialchars($row['session']); ?></td>

                    <td><?php echo number_format((float)$row['litres'], 2); ?></td>

                    <td>
                        <?php
                        if ($row['accepted']) {
                            echo 'Yes';
                            $accepted_total += (float)$row['litres'];
                        } else {
                            echo 'No';
                        }
                        ?>
                    </td>
                </tr>

            <?php endwhile; ?>

        </tbody>

        <tfoot>
            <tr>
                <th colspan="4" scope="row">Accepted today</th>
                <td><?php echo number_format($accepted_total, 2); ?></td>
            </tr>
        </tfoot>

    </table>
</div>

<p>Rejected milk deliveries are also displayed in the records.
They are not included in the accepted milk total.</p>

</main>

<aside>
    <h2>Notices</h2>

<ul>
    <li>Milk is paid at <strong>KSh 52.00 a litre</strong> from
        1 October 2026.</li>

    <li>Annual General Meeting: Saturday 17 October, 10 a.m.,
        at the Kiserian collection centre.</li>

    <li>New members: <a href="register.php">apply to join</a>.
        You need a national ID and a bank account.</li>
</ul>

</aside>

<?php include 'includes/footer.php'; ?>

</body>
</html>