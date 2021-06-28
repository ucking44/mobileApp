@extends('layouts.backend.app')

@section('title', 'Registered-Roles')

{{-- @section('title')
  Registered Roles
@endsection --}}

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            @include('layouts.backend.partials.msg')
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Registered Roles</h4>
                    {{-- @if (session('status'))
                        <div class="alert alert-succes" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif --}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="table table-striped table-bordered" style="width:100%">
                            <thead class="text-primary">
                                <th>ID</th>
                                <th style="text-align: center;">Name</th>
                                <th style="text-align: center;">Phone</th>
                                <th style="text-align: center;">Email</th>
                                <th style="text-align: center;">Usertype</th>
                                <th style="text-align: center;">Edit</th>
                                <th style="text-align: center;">Delete</th>
                            </thead>
                            <tbody>
                                @foreach ($members as $member)

                                <tr>
                                    <td>{{ $member->user_id }}</td>
                                    <td>{{ $member->name }}</td>
                                    <td>{{ $member->phone }}</td>
                                    <td>{{ $member->email }}</td>
                                    <td>{{ $member->usertype }}</td>
                                    <td>
                                        {{-- <a href="{{ URL::to('/edit', $member->user_id) }}" class="btn btn-default">Edit</a> --}}
                                        <a href="{{ URL::to('/edit', $member->user_id) }}" class="btn btn-info btn-sm"><i class="material-icons">Edit</i> </a>
                                    </td>
                                    <td>
                                        <form id="delete-form-{{ $member->user_id }}" method="POST" action="{{ URL::to('/delete', $member->user_id) }}" style="display: none;">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="if(confirm('Are you sure you want to delete this data?')) {
                                            event.preventDefault();
                                            document.getElementById('delete-form-{{ $member->user_id }}').submit();
                                        }
                                        else {
                                            event.preventDefault();
                                        }">
                                        <i class="material-icons">Delete</i></button>
                                    </td>
                                    {{-- <td>
                                        <form action="{{ URL::to('/delete', $member->user_id) }}" method="post">
                                            @csrf
                                            {{ method_field('delete') }}
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection


