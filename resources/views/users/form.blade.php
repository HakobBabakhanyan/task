@extends('layouts.app')

@section('content')
    <div class="content-container">
        <div class="px-5 py-2">
            @if ($edit)
                <div><h1 class="h2">Edit user "{{ $item['first_name'] }}"</h1></div>
            @else
                <div><h1 class="h2">New user</h1></div>
            @endif
            <div>
                @if (($status = session('status')) == 'added')
                    <p class="py-2 text-success">User added successfully.</p>
                @elseif($status == 'edited')
                    <p class="py-2 text-success">User edited successfully.</p>
                @endif
                <form action="{{ $edit?route('users.edit', ['id'=>$item['id']]):route('users.add') }}" method="post">
                    @csrf @method($edit?'patch':'put')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="form-first_name">First Name</label>
                                <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $item['first_name']??null) }}" id="form-first_name" maxlength="255">
                                @error('first_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="form-last_name">Last Name</label>
                                <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $item['last_name']??null) }}" id="form-last_name" maxlength="255">
                                @error('last_name')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="form-email">Email</label>
                                <input type="text" class="form-control" name="email" value="{{ old('email', $item['email']??null) }}" id="form-email" maxlength="255">
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="form-country_id">Country</label>
                                <select class="select2" id="form-country_id" name="country_id" style="width:100%">
                                    <option value="" disabled selected>Country</option>
                                    @php $oldCountry = old('country_id', $item['country_id']??null) @endphp
                                    @foreach($countries as $country)
                                        <option value="{{ $country['id'] }}" @if($oldCountry == $country['id']) selected @endif>{{ $country['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('country_id')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="form-roles">Roles</label>
                                <select class="select2" id="form-roles" name="role[]" style="width:100%" multiple data-tags="true" data-maximum-selection-length="5">
                                    @php
                                        $oldRole = old('role');
                                        if (!$oldRole) $oldRole = (session()->hasOldInput()?[]:($item['role']??null));
                                    @endphp
                                    @if (is_array($oldRole))
                                        @foreach($oldRole as $role)
                                            <option value="{{ $role }}" selected>{{ $role }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @error('role')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group">
                                <button class="btn btn-success" type="submit">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script>
        $('.select2').select2();
        $('input').on('input', function(){
            $(this).next('small').remove();
        });
        $('select').on('change', function(){
            $(this).nextAll('small').remove();
        });
    </script>
@endpush
@push('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
@endpush
