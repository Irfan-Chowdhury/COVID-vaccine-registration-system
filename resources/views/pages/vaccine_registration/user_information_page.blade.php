@extends('layouts.master')

@section('content')
    <div class="container">
        <h2 class="text-center">Step-2 : User Information</h2>

        <div class="card mt-5">
            <div class="card-body">

                <form action="{{ route('vaccine-registration.confirmation') }}" method="post">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Name</label>
                            <input type="number" class="form-control" placeholder="name@example.com">
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="mt-4 form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                                <label class="form-check-label" for="inlineRadio1">Male</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                                <label class="form-check-label" for="inlineRadio2">Female</label>
                              </div>

                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Mobile</label>
                            <input type="text" class="form-control" placeholder="0182-XXXX-XXX">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="name@example.com">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Select Center</label>
                            <select class="form-select" aria-label="Default select example">
                                <option selected>--- Select  ---</option>
                                @foreach ($vaccineCenters as $item)
                                    <option value="{{$item->id}}">{{ $item->center_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="mt-5 form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                <label class="form-check-label" for="inlineCheckbox1">I accept all term & condition</label>
                            </div>
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
