<?php require_once("./01_head.php") ?>

<link rel="stylesheet" type="text/css" href="./css/products.css">
<link rel="stylesheet" type="text/css" href="./css/products_show.css">

<main>
    <ul class="subul">
        <li><a href="./products_show.php" class="sublink">Show Products</a></li>
        <li><a href="./products_update.php" class="sublink">Update Products</a></li>
        <li><a href="./products_create.php" class="sublink">Create Products</a></li>
    </ul>
    <div class="main-section">
        <form method="post">
            <table>
                <tr>
                    <td>
                        <label for="">Search by:</label>
                    </td>
                    <td>
                        <select name="serch_by">
                            <option value="select">Select</option>
                            <option value="item_id">Item id</option>
                            <option value="name">Name</option>
                            <option value="type">Type</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Input keyword</label>
                    </td>
                    <td>
                        <input type="text" name="key_word">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" value="Search">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</main>

<?php require_once("./02_foot.php") ?>