<div class="row container section">
    <h5>Shopping Cart</h5>

    <table class="bordered">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th class="center-align">Quantity</th>
                <th class="right-align">Price</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php
                foreach ($_SESSION["cart"]->items as $item)
                {
                    echo "<tr>";
                    echo "    <td><img class='cart-image cart-icon' src='images/products/".$item->product->image."'></td>";
                    echo "    <td>".$item->product->name."</td>";
                    echo "    <td class='center-align'>";
                    echo "         <a href='#'><i class='cart-icon material-icons grey-text text-lighten-1'>chevron_left</i></a>";
                    echo "             <span class='cart-icon'>".$item->qty."</span>";
                    echo "         <a href='#'><i class='cart-icon material-icons grey-text text-lighten-1'>chevron_right</i></a>";
                    echo "    </td>";
                    echo "    <td class='right-align'>$".$item->formattedPrice()."</td>";
                    echo "    <td class='right-align'>";
                    echo "        <a href='#'><i class='cart-icon material-icons grey-text text-lighten-1'>clear</i></a>";
                    echo "    </td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

    <div class="section right-align">
        <h5>Total: $<?php echo $_SESSION["cart"]->formattedPrice() ?></h5>
    </div>

    <div class="section">
        <a href="mock-paypal.php" class="waves-effect waves-light btn-flat blue white-text right">Checkout</a>
    </div>
</div>