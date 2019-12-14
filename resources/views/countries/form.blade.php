@extends('layouts.app')

@section('content')
    <div class="content-container">
        <div class="px-5 py-2">
            @if ($edit)
                <div><h1 class="h2">Edit country "{{ $item['name'] }}"</h1></div>
            @else
                <div><h1 class="h2">New country</h1></div>
            @endif
            <div>
                @if (($status = session('status')) == 'added')
                    <p class="py-2 text-success">Country added successfully.</p>
                @elseif($status == 'edited')
                    <p class="py-2 text-success">Country edited successfully.</p>
                @endif
                <form action="{{ $edit?route('countries.edit', ['id'=>$item['id']]):route('countries.add') }}" method="post">
                    @csrf @method($edit?'patch':'put')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="form-name">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ old('name', $item['name']??null) }}" id="form-name" maxlength="255">
                                @error('name')
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
    <script>
        $('input').on('input', function(){
            $(this).next('small').remove();
        });
    </script>
@endpush
