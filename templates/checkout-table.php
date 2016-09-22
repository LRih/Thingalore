<div class="card">
    <div class="card-content">
        <div class="row">
            <div class="col s12 m6">
                <h5>Shipping details</h5>
                <p>John Smith</p>
                <p>123 Fake St</p>
                <p>Melbourne, VIC 3000</p>
            </div>
            <div class="col s12 m6">
                <h5>Shipping method</h5>
                <p>Regular Post</p>
                <p>3-5 business days Australia wide</p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <div class="card">
            <div class="card-content">
                <h5>Item details</h5>
                <table>
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th class="center-align">Quantity</th>
                            <th class="right-align">Price</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            foreach ($_SESSION["cart"]->items as $item)
                            {
                                echo "<tr>";
                                echo "    <td><img class='cart-image vert-align' src='images/products/".$item->product->image."'></td>";
                                echo "    <td>".$item->product->name."</td>";
                                echo "    <td class='center-align'>";
                                echo "          <span class='vert-align'>".$item->qty."</span>";
                                echo "    </td>";
                                echo "    <td class='right-align'>".$item->formattedPrice()."</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
                <div class="section right-align">
                    <p>Discount: $ 0.00</p>
                    <p>Shipping cost: $ 0.00</p>
                </div>
                <div class="right-align">
                    <h5>Total: <?php echo $_SESSION["cart"]->formattedPrice() ?></h5>
                </div>
            </div>
        </div>
    </div>
</div>