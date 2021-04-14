@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('global.user.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("myusers.store") }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="cars">Title:</label>
                        <select name="title">
                            <option value="Mr">Mr.</option>
                            <option value="Mrs">Mrs.</option>
                            <option value="Miss">Miss</option>
                        </select>
                        <br>
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ trans('global.user.fields.name') }}*</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name', isset($user) ? $user->name : '') }}">
                            @if($errors->has('name'))
                                <p class="help-block">
                                    {{ $errors->first('name') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.user.fields.name_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                            <label for="email">{{ trans('global.user.fields.email') }}*</label>
                            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', isset($user) ? $user->email : '') }}">
                            @if($errors->has('email'))
                                <p class="help-block">
                                    {{ $errors->first('email') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.user.fields.email_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('roles') ? 'has-error' : '' }}">
                            <label for="roles">Appellative*
                            </label>
                            <select name="roles[]" id="roles" class="form-control select2" multiple="multiple">
                                @foreach($roles as $id => $roles)
                                    <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>
                                        {{ $roles }}
                                    </option>
                                @endforeach
                            </select>
                            @if($errors->has('roles'))
                                <p class="help-block">
                                    {{ $errors->first('roles') }}
                                </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.user.fields.roles_helper') }}
                            </p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Phone Number</label>
                            <input type="number" name="phone" class="form-control" placeholder="Enter phone number">
                          </div>
                        <div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Birthday</label>
                                <input type="date" name="dob" class="form-control" placeholder="Select DOB">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Bank</label>
                                <input type="text" name="bank" class="form-control" placeholder="Enter Bank Name">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Bank Account</label>
                                <input type="number" name="bank_account" class="form-control" placeholder="Enter Account Number">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Notes</label>
                                <textarea name="notes" placeholder="Enter notes" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Address</label>
                                <textarea name="address" placeholder="Enter your address" class="form-control"></textarea>
                            </div>
                        <div>
                            <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection




<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    
    /* Firefox */
    input[type=number] {
      -moz-appearance: textfield;
    }
    </style>