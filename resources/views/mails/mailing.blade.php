<!DOCTYPE html>
<html>

<body>
    <h1>E-Ticket</h1>
    <hr>
    <p>
        Name: {{$data['firstname']}} {{$data['lastname']}}
    </p>
    <p> Phone: {{$data['phone']}}</p>
    <p> Address: {{$data['address']}}</p>
    <p> You ordered: {{$data['members']}} slots</p>
    <hr>
    <p>You have made a payment successfully.</p>
    <p>We'll contact you in 1-2 business days for further tour details.</p>
</body>

</html>