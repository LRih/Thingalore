<div class="container section">
    <h5>Shopping Cart</h5>

    <table class="bordered highlight">
        <thead>
            <tr>
                <th data-field="id">Product ID</th>
                <th data-field="name">Quantity</th>
                <th data-field="price">Price</th>
                <th data-field="price"></th>
            </tr>
        </thead>

        <tbody>
            <?php
                foreach ($_SESSION["cart"]->productIds() as $id => $count)
                {
                    echo "<tr>";
                    echo "    <td>".$id."</td>";
                    echo "    <td>".$count."</td>";
                    echo "    <td>Unknown</td>";
                    echo "    <td class='center-align'>";
                    echo "        <a href='#'><i class='material-icons red-text text-lighten-1'>cancel</i></a>";
                    echo "    </td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

    <div class="section">
        <a href="#" class="waves-effect waves-light btn-flat blue white-text right">Checkout</a>
    </div>
</div>