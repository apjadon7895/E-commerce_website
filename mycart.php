

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
      <button id="myButton">pay</button>
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