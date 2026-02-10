@extends('layouts.app')

@section('content')

<div class="header dashboard_from">
    <h1 class="page-title">
        {{ isset($data->exists) ? 'Edit Road' : 'Add Road' }}
    </h1>
</div>

<div class="main-content">
    <div class="card from_card">
        <div class="card-header">
            {{ isset($data->exists) ? 'Update Road' : 'Create Road' }}
        </div>

        <div class="card-body">

            <form action="{{ isset($data->exists) 
                        ? route('road.module.update', $data->id) 
                        : route('road.module.store') }}"
                method="POST">

                @csrf

                @if(isset($data->exists))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Road :
                        </label>

                        <input type="text"
                            name="road_name"
                            class="form-control"
                            placeholder="Road name"
                            value="{{ old('road_name', $data->road_name ?? '') }}">

                        @error('road_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Road order :
                        </label>

                        <input type="number"
                            name="road_order"
                            class="form-control"
                            placeholder="Road order"
                            value="{{ old('road_order', $data->road_order ?? '') }}">

                        @error('road_order')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">
                            Road Status :
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

                    <a href="{{ route('admin.modules.index') }}"
                       class="btn btn-outline-secondary">
                        Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
