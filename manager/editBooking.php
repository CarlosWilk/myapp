while ($row = mysqli_fetch_array($result)):
    echo "<tr><td>" . htmlentities($row['description']) . "</td>";
    echo "<td>" . htmlentities($row['due_date']) . "</td>";
    $wishID = $row['id'];
    echo "<td>WishID=" . $wishID . "</td>";
    //The loop is left open
    ?>

    Hello <?php echo $_SESSION["user"]; ?><br/>
<table border="black">
    <tr><th>Item</th><th>Due Date</th></tr>
    <?php
    //Include connection to the database
    require_once("/xampp/htdocs/myapp/customer/conf.php");
    $wisherID = WishDB::getInstance()->get_wisher_id_by_name($_SESSION["user"]);
    $result = WishDB::getInstance()->get_wishes_by_wisher_id($wisherID);
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr><td>" . htmlentities($row["description"]) . "</td>";
        echo "<td>" . htmlentities($row["due_date"]) . "</td></tr>\n";
    }
    mysqli_free_result($result);
    ?>
    <td>
        <form name="editWish" action="editWish.php" method="GET">
            <input type="hidden" name="wishID" value="<?php echo $wishID; ?>">
            <input type="submit" name="editWish" value="Edit">
        </form>
    </td>
</table>