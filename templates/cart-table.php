<div class="container section">
    <h5>Shopping Cart</h5>

    <table class="bordered">
        <thead>
            <tr>
                <th data-field="id">Product ID</th>
                <th class="center-align" data-field="name">Quantity</th>
                <th class="right-align" data-field="price">Price</th>
                <th data-field="price"></th>
            </tr>
        </thead>

        <tbody>
            <?php
                foreach ($_SESSION["cart"]->productIds() as $id => $qty)
                {
                    echo "<tr>";
                    echo "    <td>".$id."</td>";
                    echo "    <td class='center-align'>";
                    echo "         <a href='#'><i class='cart-icon material-icons grey-text text-lighten-1'>chevron_left</i></a>";
                    echo "             <span class='cart-icon'>$qty</span>";
                    echo "         <a href='#'><i class='cart-icon material-icons grey-text text-lighten-1'>chevron_right</i></a>";
                    echo "    </td>";
                    echo "    <td class='right-align'>Unknown</td>";
                    echo "    <td class='right-align'>";
                    echo "        <a href='#'><i class='cart-icon material-icons grey-text text-lighten-1'>clear</i></a>";
                    echo "    </td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

    <div class="section right-align">
        <h5>Total: $XX.YY</h5>
    </div>

    <div class="section">
        <a href="#" class="waves-effect waves-light btn-flat blue white-text right">Checkout</a>
    </div>
</div>