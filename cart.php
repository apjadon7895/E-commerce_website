<?php

//if (session_status() !== PHP_SESSION_ACTIVE) {session_start();}
if(session_id() == '' || !isset($_SESSION)){session_start();}

include 'config.php';


?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shopping Cart || Style BAZAAR</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  
  </head>
  <body>
<?php include 'header.php'; ?>


    <div class="row" style="margin-top:10px;">
      <div class="large-12">
        <?php

          echo '<p><h3>Your Shopping Cart</h3></p>';

          if(isset($_SESSION['cart'])) {

            $total = 0;
            echo '<table>';
            echo '<tr>';
            echo '<th>Code</th>';
            echo '<th>Name</th>';
            echo '<th>Quantity</th>';
            echo '<th>Cost</th>';
            echo '</tr>';
            foreach($_SESSION['cart'] as $product_id => $quantity) {

            $result = $mysqli->query("SELECT product_code, product_name, product_desc, qty, price FROM products WHERE id = ".$product_id);


            if($result){

              while($obj = $result->fetch_object()) {
                $cost = $obj->price * $quantity; //work out the line cost
                $total = $total + $cost; //add to the total cost

                echo '<tr>';
                echo '<td>'.$obj->product_code.'</td>';
                echo '<td>'.$obj->product_name.'</td>';
                echo '<td>'.$quantity.'&nbsp;<a class="button [secondary success alert]" style="padding:5px;" href="update-cart.php?action=add&id='.$product_id.'">+</a>&nbsp;<a class="button alert" style="padding:5px;" href="update-cart.php?action=remove&id='.$product_id.'">-</a></td>';
                echo '<td>'.$cost.'</td>';
                echo '</tr>';
              }
            }

          }


          echo '<tr>';
          echo '<td colspan="3" align="right">Total</td>';
          echo '<td>'.$total.'</td>';
          echo '</tr>';

          echo '<tr>';
          echo '<td colspan="4" align="right"><a href="update-cart.php?action=empty" class="button alert">Empty Cart</a>&nbsp;<a href="products.php" class="button [secondary success alert]">Continue Shopping</a>';
          if(isset($_SESSION['email'])) {
            echo '<a href="orders-update.php"><button style="float:right;">COD</button></a>';
            
            echo '<button style="float:right;" id="myButton">Pay</button>';
            
            
          }

          else {
            echo '<a href="login.php"><button style="float:right;">Login</button></a>';
          }

          echo '</td>';

          echo '</tr>';
          echo '</table>';
        }

        else {
          echo "You have no items in your shopping cart.";
        }

          echo '</div>';
          echo '</div>';
          ?>


   <?php include 'footer.php'; ?>


    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>
  </body>
   <script>
    const keyIndex = 1;
    const apiKey = '96434309-7796-489d-8924-ab56988a6076';
    const merchantId = 'PGTESTPAYUAT86';

    function base64Encode(str) {
        return btoa(str);
    }

    async function sha256(str) {
        const encoder = new TextEncoder();
        const data = encoder.encode(str);
        const hashBuffer = await crypto.subtle.digest('SHA-256', data);
        const hashArray = Array.from(new Uint8Array(hashBuffer));
        const hashHex = hashArray.map(byte => byte.toString(16).padStart(2, '0')).join('');
        return hashHex;
    }

    document.getElementById("myButton").addEventListener("click", (e) => {
        e.preventDefault();

        // const amount = document.getElementById("amount").value; // Get amount from the form input
        const paymentData = {
            "merchantId": merchantId,
            "merchantTransactionId": "MT" + Date.now(),
            "merchantUserId": "MUID123",
            "amount": 100 * 100,
            "redirectUrl": "http://localhost:8082/paymentSuccess.php",
            "redirectMode": "REDIRECT",
            "callbackUrl": "http://localhost:8082/paymentSuccess.php",
            "mobileNumber": "9999999999",
            "paymentInstrument": {
                "type": "PAY_PAGE"
            }
        };

        const jsonData = JSON.stringify(paymentData);
        const payloadMain = base64Encode(jsonData);
        const payload = payloadMain + "/pg/v1/pay" + apiKey;

        sha256(payload).then((response) => {
            const sha256 = response;
            const final_x_header = sha256 + '###' + keyIndex;

            const options = {
                method: 'POST',
                headers: {
                    'accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-VERIFY': final_x_header
                },
                body: JSON.stringify({ request: payloadMain })
            };

            fetch('https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay', options)
                .then(response => response.json())
                .then((response) => {
                    console.log(response);
                    if (response.data && response.data.instrumentResponse && response.data.instrumentResponse.redirectInfo) {
                        const url = response.data.instrumentResponse.redirectInfo.url;
                        window.location.href = url;
                    } else {
                        console.error('Invalid response format', response);
                    }
                })
                .catch(err => console.error('Fetch error', err));
        }).catch((error) => {
            console.log('SHA-256 error', error);
        });
    });
</script>
</html>
