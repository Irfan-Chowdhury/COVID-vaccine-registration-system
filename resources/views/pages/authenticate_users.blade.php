@extends('layouts.master')

@section('content')
<div class="container">
    <h2 class="text-center">Authenticate Users</h2>

    <div class="mt-5 row">
        <div class="col-12">
            <table id="dataTable" class="table">
                <thead>
                <tr>
                    <th scope="col">#SL</th>
                    <th scope="col">NID No</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Date of Birth</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Address</th>
                </tr>
                </thead>
                <tbody>
                    @forelse ($authenticateUsers as $key => $item)
                        <tr>
                            <th scope="row">{{$key+1}}</th>
                            <td>{{$item->nid}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td>{{$item->date_of_birth}}</td>
                            <td>{{$item->gender}}</td>
                            <td>{{$item->address}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td></td>
                            <td class="text-danger">No Data Found</td>
                            <td></td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')

    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>

@endpush
