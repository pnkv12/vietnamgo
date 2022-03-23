@extends('layout')
@section('content')
<section id="form-background">
    <div class="d-flex flex-column align-items-end" style="margin-right:6rem">
        <div class="border rounded" style="width:50%; margin-top: 7rem;background-color: white">
            <h2 class="text-warning text-center" style="padding:1rem">Please fill in your contact</h2>
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

                <div class="col" style="padding:0rem 1rem 0rem 1rem">
                    <div class="row"> <input class="form-control" type="text" name="address" placeholder="Home Address*">
                    </div>
                    <br />
                    <div class="row"> <input class="form-control" type="number" name="members" placeholder="Expected members* (Only {{$data['slots']}} slots left)">
                    </div>
                    <br />
                    <div class="row">
                        <textarea class="form-control" name="notes" placeholder="Notes" rows="2"></textarea>
                    </div>
                </div>
                <br />
                <div class="d-flex justify-content-center">
                    <button class="btn btn-warning" id="submitform">Send</button>
                    <button type="reset" class="btn btn-link text-warning">Clear</button>
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
            $('#submitform').text("Sending..");
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
                            $('#submitform').text("Send")
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
                            $('#submitform').text("Send");
                        });
                    }
                }
            });
        };
    });
</script>
@endsection