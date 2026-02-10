@extends('layouts.app')

@section('content')

<div class="header dashboard_from">
    <h1 class="page-title">
        {{ isset($data->exists) ? 'Edit block' : 'Add block' }}
    </h1>
</div>

<div class="main-content">
    <div class="card from_card">
        <div class="card-header">
            {{ isset($data->exists) ? 'Update block' : 'Create block' }}
        </div>

        <div class="card-body">

            <form action="{{ isset($data->exists) 
                        ? route('admin.block.module.update', $data->id) 
                        : route('admin.block.module.store') }}"
                method="POST">

                @csrf

                @if(isset($data->exists))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Blocks :
                        </label>

                        <input type="text"
                            name="block_name"
                            class="form-control"
                            placeholder="Block name"
                            value="{{ old('block_name', $data->block_name ?? '') }}">

                        @error('block_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Block order :
                        </label>

                        <input type="number"
                            name="block_order"
                            class="form-control"
                            placeholder="Block order"
                            value="{{ old('block_order', $data->block_order ?? '') }}">

                        @error('block_order')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Block Status :
                        </label>

                        <select class="form-select"
                                name="is_active"
                                id="is_active">

                            <option value="">Select Status</option>

                            <option value="1"
                                {{ old('is_active', $data->is_active ?? '') == '1' ? 'selected' : '' }}>
                                Active
                            </option>

                            <option value="0"
                                {{ old('is_active', $data->is_active ?? '') == '0' ? 'selected' : '' }}>
                                Inactive
                            </option>

                        </select>

                        @error('is_active')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="ps-0 card-footer bg-white d-flex gap-2">
                    <button class="btn btn-primary">
                        {{ isset($data->exists) ? 'Update' : 'Save' }}
                    </button> 

                    <a href="{{ route('admin.block.module.index') }}"
                       class="btn btn-outline-secondary">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
