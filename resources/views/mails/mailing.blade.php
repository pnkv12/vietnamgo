<!DOCTYPE html>
<html>

<body>
    <h1>Confirm your booking</h1>
    <hr>
    <p>
        Name: {{$data['firstname']}} {{$data['lastname']}}
    </p>
    <p> Phone: {{$data['phone']}}</p>
    <p> Address: {{$data['address']}}</p>
    <p> You ordered: {{$data['members']}} slots</p>
    <hr>

    <p>We'll contact you in 1-2 business days to proceed with the checkout.</p>
</body>

</html>