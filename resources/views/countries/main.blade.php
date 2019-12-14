@extends('layouts.app')

@section('content')
    <div class="content-container">
        <div class="p-2"><h1 class="h2">Countries | <a href="{{ route('countries.add') }}">Add</a></h1></div>
        <hr>
        @if (session('status') === 'deleted')
            <p class="p-2 text-success">Country deleted</p>
        @endif
        <div class="container bootstrap snippet">
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-box no-header clearfix">
                        <div class="main-box-body clearfix">
                            @if (count($items))
                                <div class="table-responsive">
                                    <table class="table user-list">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $item['id'] }}</td>
                                            <td>{{ $item['name'] }}</td>
                                            <td style="width: 20%;">
                                                <a href="{{ route('countries.edit', ['id'=>$item['id']]) }}" class="table-link">
                                            <span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                            </span>
                                                </a>
                                                <a href="#" data-id="{{ $item['id'] }}" data-toggle="modal" data-target="#deleteItemModal" class="table-link danger">
                                            <span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                            </span>
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-danger">EMPTY.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @component('components.modal', [
        'saveBtn' => 'Delete',
        'saveBtnClass' => 'btn-danger',
        'id' => 'deleteItemModal',
        'form' => [
            'method' => 'post',
            'action' => route('countries.delete'),
        ],
    ])
        @slot('title') Delete country? @endslot
        @csrf
        @method('delete')
        <input type="hidden" name="id" id="deleteItemId">
        Delete Country
    @endcomponent
@endsection

@push('js')
    <script>
        var deleteItemIdInput = $('#deleteItemId');
        $('#deleteItemModal').on('show.bs.modal', function(e){
            deleteItemIdInput.val($(e.relatedTarget).data('id'));
        });
    </script>
@endpush
