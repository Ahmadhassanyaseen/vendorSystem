<?php
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['VNDR']) && !empty($_SESSION['VNDR'])) {
    ?>
    <div style="padding: 10px; text-align: right;"><a href="logout.php" title="Unlimited Charters">Logout</a></div>
    <?php
}
?>