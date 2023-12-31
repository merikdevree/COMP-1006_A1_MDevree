<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Merik de Vree - Assignment 1</title>
    <link rel="stylesheet" href="./styles/style.css" />
</head>

<body>
    <header>
        <nav>
            <a href="view.php">View Queue</a>
            <a href="index.php">Place Order</a>
        </nav>
    </header>

    <main>
        <h1>Merik's Pizza</h1>
        <h2>Order Details</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div id="pizza-configuration">
                <div>
                    <label for="size">Size:</label>
                    <input type="radio" name="size" value="small">
                    <label for="size">Small</label>
                    <input type="radio" name="size" value="medium">
                    <label for="size">Medium</label>
                    <input type="radio" name="size" value="large">
                    <label for="size">Large</label>
                </div>
                <div id="toppings">
                    <label for="toppings">Pepperoni</label>
                    <input type="checkbox" name="toppings[]" value="peperoni">
                    <label for="toppings">Mushrooms</label>
                    <input type="checkbox" name="toppings[]" value="mushrooms">
                    <label for="toppings">Onions</label>
                    <input type="checkbox" name="toppings[]" value="onions">
                    <label for="toppings">Sausage</label>
                    <input type="checkbox" name="toppings[]" value="sausage">
                    <label for="toppings">Bacon</label>
                    <input type="checkbox" name="toppings[]" value="bacon">
                    <label for="toppings">Extra Cheese</label>
                    <input type="checkbox" name="toppings[]" value="extra cheese">
                    <label for="toppings">Black Olives</label>
                    <input type="checkbox" name="toppings[]" value="black olives">
                    <label for="toppings">Green Peppers</label>
                    <input type="checkbox" name="toppings[]" value="green peppers">
                    <label for="toppings">Pineapple</label>
                    <input type="checkbox" name="toppings[]" value="pineapple">
                </div>
            </div>

            <div id="delivery">
                <div>
                    <label for="fname">First Name:</label>
                    <input type="text" id="fname" name="fname" placeholder="First Name" />
                </div>
                <div>
                    <label for="lname">Last Name:</label>
                    <input type="text" id="lname" name="lname" placeholder="Last Name" />
                </div>
                <div>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="email@example.com" />
                </div>
                <div>
                    <label for="phone">Phone:</label>
                    <input type="tel" id="phone" name="phone" placeholder="Phone Number" />
                </div>
                <div>
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" placeholder="123, Example Street" />
                </div>
            </div>
            <div id="submit-button">
                <input type="submit" value="Place Order" />
            </div>
        </form>

        <div class="form-submit">
            <?php
            require_once('database.php');
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $size = $database->sanitize($_POST['size']);
                $toppings = $database->sanitize($_POST['toppings[]']);
                $fname = $database->sanitize($_POST['fname']);
                $lname = $database->sanitize($_POST['lname']);
                $email = $database->sanitize($_POST['email']);
                $phone = $database->sanitize($_POST['phone']);
                $del_address = $database->sanitize($_POST['address']);
                foreach ($toppings as $topping) {
                    $topping = $database->sanitize($topping);
                    $result .= $topping . ", ";
                }
                //this does not work idk why
                $pizza = $size . " pizza with " . $result;
                $database->create($fname, $lname, $email, $phone, $del_address, $pizza);
                echo '<script>alert("order placed")</script>';
            } else {
                echo '<script>alert("order failed")</script>';
            }

            ?>
        </div>
    </main>
    <footer>
        <p>Merik de Vree - 2023</p>
    </footer>
</body>

</html>