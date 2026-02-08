@extends('layouts.app')

@section('content')

<div class="header">
    <h1 class="page-title">
        {{ isset($moduleGroup->exists) ? 'Edit Module Group' : 'Add Module Group' }}
    </h1>
</div>

<div class="main-content">
    <div class="panel panel-default">

    <div class="panel-heading">
        {{ isset($moduleGroup->exists) ? 'Update Module Group' : 'Create Module Group' }}
    </div>

    <div class="panel-body">

        <form class="form-horizontal"
              action="{{ isset($moduleGroup->exists) 
                    ? route('admin.module-group.update', $moduleGroup->id) 
                    : route('admin.module-group.store') }}"
              method="POST">

            @csrf

            @if(isset($moduleGroup->exists))
                @method('PUT')
            @endif


            <!-- Panel Type -->
            <div class="form-group">
                <label class="col-md-2">
                    Panel type <span class="text-danger">*</span>
                </label>

                <div class="col-md-9">
                    <select class="form-control" name="panel_type">

                        <option value="">Select Panel type</option>

                        <option value="admin"
                            {{ old('panel_type', isset($moduleGroup->panel_type)) == 'admin' ? 'selected' : '' }}>
                            Society Admin
                        </option>

                    </select>

                    @error('panel_type')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <!-- Module Group Name -->
            <div class="form-group">
                <label class="col-md-2">
                    Module group name <span class="text-danger">*</span>
                </label>

                <div class="col-md-9">
                    <input type="text"
                           name="module_group_name"
                           class="form-control"
                           value="{{ old('module_group_name', $moduleGroup->module_group_name ?? '') }}">

                    @error('module_group_name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>


            <!-- Order -->
            <div class="form-group">
                <label class="col-md-2">
                    Module group order <span class="text-danger">*</span>
                </label>

                <div class="col-md-9">
                    <input type="number"
                           name="module_group_order"
                           class="form-control"
                           value="{{ old('module_group_order', $moduleGroup->module_group_order ?? '') }}">

                    @error('module_group_order')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

    </div>

    <div class="panel-footer">
        <button class="btn btn-default btn-space from-btn">
            {{ isset($moduleGroup->exists) ? 'Update' : 'Save' }}
        </button> 

        <a href="{{ route('admin.module-group.index') }}"
           class="btn btn-default from-btn">
           Cancel
        </a>

    </div>

    </form>
</div>
</div>

@endsection
