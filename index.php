<?php
// Enable error reporting for debugging purposes
//php -S localhost:8000
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>QR Code Generator</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <style>
    body {
        font-family: Arial, sans-serif;
        text-align: center;
        margin: 50px;
    }

    input,
    button {
        margin: 10px;
        padding: 8px;
        font-size: 16px;
    }

    #qrcode {
        margin-top: 20px;
    }
    </style>
</head>

<body>
    <h2>QR Code Generator</h2>
    <form method="post">
        <input type="text" name="product" placeholder="Enter product name" required />
        <input type="number" name="quantity" placeholder="Enter quantity" min="1" required />
        <input type="number" name="price" placeholder="Enter price" step="0.01" required />
        <button type="submit">Generate QR Code</button>
    </form>

    <div id="qrcode"></div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form data
        $product = htmlspecialchars($_POST["product"]);
        $quantity = htmlspecialchars($_POST["quantity"]);
        $price = htmlspecialchars($_POST["price"]);

        // Prepare the string to be encoded in QR code
        $qrText = "Product: $product\nQuantity: $quantity\nPrice: \$$price";

        // Create a JSON object containing the QR text
        $jsonText = json_encode($qrText);

        // Output JavaScript to generate the QR code
        echo "<script>
            let qrText = $jsonText;
            new QRCode(document.getElementById('qrcode'), {
                text: qrText,
                width: 200,
                height: 200
            });
        </script>";
    }
    ?>
</body>


</html>