@extends('layouts.master')

@section('content')
    <div class="container">
        <h2 class="text-center">Final Step : Confirmation</h2>

        <div class="card mt-5">
            <div class="card-body">

                <form action="" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="exampleFormControlInput1" class="form-label">An OTP has been sent this <b>name@example.com</b> mail. Please check and fillup</label>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="exampleFormControlInput1" class="form-label">OTP</label>
                            <input type="text" class="form-control" placeholder="Ex: 123456">
                        </div>

                        <div class="col-md-12 mb-3">
                            <div class="d-grid gap-2">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </div>

    </div>



@endsection
