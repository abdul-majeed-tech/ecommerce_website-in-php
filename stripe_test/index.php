<!DOCTYPE html>
<html>

<head>
    <title>Stripe Test</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>

<body>
    <div style="text-align:center; margin-top:50px;">
        <h2>PHP Stripe Integration</h2>
        <button id="pay-btn"
            style="padding:15px 30px; background:#6772e5; color:white; border:none; border-radius:4px; cursor:pointer;">
            Pay $20 Now
        </button>
    </div>

    <script>
        var stripe = Stripe('pk_test_51T29caJAb3R3ZttKMrcAgnSz9aEBEbi1xhb21PySOC70BWFj4SIpnWayNkbOp926L0KsWSQG6XRS3r8vOxeSvEcg00QnCeRC99');
        var btn = document.getElementById('pay-btn');

        btn.addEventListener('click', function () {
            fetch('create-session.php', { method: 'POST' })
                .then(res => res.json())
                .then(session => {
                    if (session.id) {
                        return stripe.redirectToCheckout({ sessionId: session.id });
                    } else {
                        alert('Error: ' + session.error);
                    }
                });
        });
    </script>
</body>

</html>