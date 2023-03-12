@extends('layouts.master')

@section('content')
    <div class="container">
        <h2 class="text-center">Step-1 : User Identification</h2>

        <div class="card mt-5">
            <div class="card-body">

                <form action="{{route('vaccine-registration.userIdentificationProcess')}}" method="post">
                    <div class="row">
                        @csrf
                        <div class="col-md-6 mb-3">
                            <label for="exampleFormControlInput1" class="form-label">NID</label>
                            <input type="number" class="form-control" placeholder="name@example.com">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" placeholder="name@example.com">
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
