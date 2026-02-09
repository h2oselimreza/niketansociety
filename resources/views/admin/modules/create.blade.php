@extends('layouts.app')

@section('content')

<div class="header">
    <h1 class="page-title">
        {{ isset($module->exists) ? 'Edit Module' : 'Add Module' }}
    </h1>
</div>

<div class="main-content">
    <div class="panel panel-default">
        <div class="panel-heading">
            {{ isset($module->exists) ? 'Update Module' : 'Create Module' }}
        </div>

        <div class="panel-body">

            <form class="form-horizontal"
                action="{{ isset($module->exists) 
                        ? route('admin.modules.update', $module->id) 
                        : route('admin.modules.store') }}"
                method="POST">

                @csrf

                @if(isset($module->exists))
                    @method('PUT')
                @endif

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12">
                                Select Module Panel :
                            </label>
                            <div class="col-md-12">
                                <select class="form-control" name="panel_type" id="panel_type" data-selected="{{ $module->panel_type ?? '' }}">

                                    <option value="">Select Panel type</option>

                                    <option value="admin"
                                        {{ old('panel_type', isset($module->panel_type)) == 'admin' ? 'selected' : '' }}>
                                        Society Admin
                                    </option>

                                </select>

                                @error('panel_type')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12">
                                Module group :
                            </label>
                            <div class="col-md-12">
                                <select class="form-control" name="module_group" id="module_group" data-selected="{{ $module->module_group ?? '' }}">
                                    <option value="">Select module group</option>
                                </select>

                                @error('module_group')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12">
                                Module Name :
                            </label>

                            <div class="col-md-12">
                                <input type="text"
                                    name="modules_name"
                                    class="form-control"
                                    value="{{ old('modules_name', $module->modules_name ?? '') }}">

                                @error('modules_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12">
                                Module URL :
                            </label>

                            <div class="col-md-12">
                                <input type="text"
                                    name="module_url"
                                    class="form-control"
                                    value="{{ old('module_url', $module->module_url ?? '') }}">

                                @error('module_url')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Order -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-12">
                                Module Order :
                            </label>

                            <div class="col-md-12">
                                <input type="text"
                                    name="module_order"
                                    class="form-control"
                                    value="{{ old('module_order', $module->module_order ?? '') }}">

                                @error('module_order')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <button class="btn btn-default btn-space from-btn">
                        {{ isset($module->exists) ? 'Update' : 'Save' }}
                    </button> 

                    <a href="{{ route('admin.modules.index') }}"
                    class="btn btn-default from-btn">
                    Cancel
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {

    // change event
    $('#panel_type').on('change', function () {
        let panelType = $(this).val();
        module_group_record(panelType);
    });

    function module_group_record(panelType, selectedGroup = null) {

        let groupSelect = $('#module_group');

        groupSelect.html('<option value="">Loading...</option>');

        if (!panelType) {
            groupSelect.html('<option value="">Select module group</option>');
            return;
        }

        $.ajax({
            url: `/admin/module-groups/${panelType}`,
            type: 'GET',
            success: function (data) {

                groupSelect.html('<option value="">Select module group</option>');

                $.each(data, function (index, item) {
                    let selected = selectedGroup === item.module_group_code ? 'selected' : '';
                    groupSelect.append(
                        `<option value="${item.module_group_code}" ${selected}>
                            ${item.module_group_name}
                        </option>`
                    );
                });
            },
            error: function (xhr) {
                console.error(xhr);
                groupSelect.html('<option value="">Failed to load</option>');
            }
        });
    }

    /* ===============================
       EDIT MODE SUPPORT
       =============================== */

    // these values should come from backend in edit page
    let editPanelType = $('#panel_type').data('selected'); 
    let editModuleGroup = $('#module_group').data('selected');

    if (editPanelType) {
        $('#panel_type').val(editPanelType);
        module_group_record(editPanelType, editModuleGroup);
    }

});
</script>
@endpush