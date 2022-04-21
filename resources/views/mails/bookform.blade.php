@extends('layout')
@section('content')

<section id="form-background">
    <div class="d-flex flex-column align-items-end" style="margin-right:6rem">
        <div class="border rounded" style="width:50%; margin-top: 7rem;background-color: white">
            <h4 class="text-warning text-center" style="padding:10px">YOUR CONTACT</h4>
            <form id="form-data" style="margin:1rem">
                @csrf
                <input type="text" name="id" value="{{$data['id']}}" hidden>

                <div class="row">
                    <div class="col col-md-6">
                        <input class="form-control" type="text" name="firstname" placeholder="First Name*">
                    </div>
                    <div class="col col-md-6">
                        <input class="form-control" type="text" name="lastname" placeholder="Last Name*">
                    </div>
                </div>
                <br />

                <div class="row">
                    <div class="col col-md-6">
                        <input class="form-control" type="email" name="email" placeholder="Email*">
                    </div>
                    <div class="col col-md-6">
                        <input class="form-control" type="tel" name="phone" placeholder="Phone*">
                    </div>
                </div>
                <br />
                <div class="row">
                    <div class="col col-md-6">
                        <input class="form-control" type="text" name="address" placeholder="Home Address*">
                    </div>
                    <div class="col col-md-6">
                        <input class="form-control" type="number" name="members" placeholder="Expected slots* (Only {{$data['slots']}} slots left)">
                    </div>
                </div>

                <div class="col">
                    <div class="row" style="padding:10px">
                        <textarea class="form-control" name="notes" placeholder="Notes" rows="2"></textarea>
                    </div>

                    <script src="https://js.stripe.com/v3/"></script>

                    <script>
                        const stripe = Stripe('pk_test_51Kr0cwHtLOwXlcIZzkGeCpNtpPMOFFlm5lzoz3y94cV3JO4T3tzJhvUgMscDOy8UHv6y8lSMlaBEtYGAE65en72E00cYlE11E');

                        const elements = stripe.elements();
                        const cardElement = elements.create('card');

                        cardElement.mount('#card-element');
                    </script>
                    <h6 class="text-warning">Credit Card Infomation <span><small><em>(You must complete this in order to book this tour)</em></small></span></h6>

                    <div id="card-element">
                        <div class="row">
                            <div class="col col-md-6">
                                <input class="form-control" type="text" placeholder="Card Number*" required>
                            </div>
                            <div class="col col-md-6">
                                <input class="form-control" type="text" placeholder="Cardholder's Name*" required>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col col-md-6">
                                <label for="date" style="font-size: smaller;">Expired Date*</label>
                                <input class="form-control" type="month" id="date" required>
                            </div>
                            <div class="col col-md-3">
                                <label for="date" style="font-size: smaller;">CVC*</label>

                                <input class="form-control" type="number" placeholder="Your CVC" maxlength="3" required>
                            </div>
                        </div>
                    </div>
                </div>
                <br />
                <div class="d-flex justify-content-center">
                    <button class="btn btn-warning" id="submitform">Book Your Place</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>
    window.jQuery || document.write('<script src="{{ asset('
        assets / js / vendor / jquery - slim.min.js ') }}"><\/script>')
</script>
<script src="{{ asset('assets/js/vendor/popper.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
@section('after_script')
<script type="text/javascript">
    //trigger button submit
    $('#submitform').click(function() {
        //trigger form data
        var form = $('#form-data');

        //setup csrf for ajax
        $.ajaxSetup({
            headers: {
                //get csrf from content of meta tag
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        form.validate({
            rules: {
                firstname: {
                    required: true,
                },
                lastname: {
                    required: true,
                },
                email: {
                    required: true,
                },
                phone: {
                    required: true,
                    digits: 10
                },
                address: {
                    required: true,
                },
                members: {
                    required: true,
                    min: 0
                },
            },
            messages: {
                firstname: {
                    required: 'First name is required',
                },
                lastname: {
                    required: 'Last name is required',
                },
                email: {
                    required: 'Email is required'
                },
                phone: {
                    required: 'Phone is required',
                    digits: 'Must be 10 digits'
                },
                address: {
                    required: 'Home address is missing',
                },
                members: {
                    required: 'This field is required',
                    min: 'No negative allowed'
                },
            },
            highlight: function(element) {
                $(element).parent().addClass('text-danger');

            },
            unhighlight: function(element) {
                $(element).parent().removeClass('text-danger')
            }
        })

        //if form valid -> call ajax
        if (form.valid()) {
            $('#submitform').attr('disabled', true);
            $('#submitform').text("Making payment...");
            $.ajax({
                url: '{{ route("travel.confirm") }}',
                type: 'POST',
                data: form.serialize(),
                success: function(res) {
                    if (res.error === false) {
                        swal.fire(res.message, '', "success").then(function() {
                            window.location.href = "{{ route('travel.details', $data['id'] )}}";
                        });
                    } else {
                        swal.fire(res.message, '', "error").then(function() {
                            $('#submitform').attr('disabled', false);
                            $('#submitform').text("Book Your Place")
                        });
                    }
                },
                error: function(res) {
                    if (res.responseJSON != undefined) {
                        var mess_error = '';
                        $.map(res.responseJSON.errors, function(a) {
                            mess_error = mess_error.concat(a + '<br/>');
                        });
                        swal.fire('Form failed to send!', mess_error, "error").then(function() {
                            $('#submitform').attr('disabled', false);
                            $('#submitform').text("Book Your Place");
                        });
                    }
                }
            });
        };
    });
</script>
@endsection