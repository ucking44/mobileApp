@extends('layouts.backend.app')

@section('title')
  Registered Roles
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            {{-- @include('layouts.backend.partials.msg') --}}
            <div class="card">
                <div class="card-header">
                    <h3>Edit Role</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="{{ URL::to('/update', $members->user_id) }}" method="POST">
                                @csrf
                                {{ method_field('PUT') }}
                                <div class="form-group">
                                    <lable>Name</lable>
                                    <input type="text" name="username" value="{{ $members->name }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Give Role</label>
                                    <select name="usertype" class="form-control">
                                        <option value="role">Select Role</option>
                                        <option value="admin">Admin</option>
                                        <option value="vendor">Vendor</option>
                                        <option value="">None</option>
                                    </select>
                                </div>
                                <a href="{{ URL::to('/role-register') }}" class="btn btn-danger">Cancel</a>
                                <button type="submit" class="btn btn-success">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

@endsection


