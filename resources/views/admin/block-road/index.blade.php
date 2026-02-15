@extends('layouts.app')
@section('content')

<div class="header dashboard_from">
    <h1 class="page-title">Block</h1>
    <ul class="breadcrumb">
        <li><a href="#"> Home</a></li>
        <li><a href="#">/ Master Data</a></li>
        <li><a href="#">/ Road According Block</a></li>
    </ul>
</div>
<div class="main-content">
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">

                <div class="card-body">

                    @foreach ($blocks as $block)

                        <p class="bg-primary text-white p-2 fw-bold">
                            Block - {{ $block->block_name }}
                        </p>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">

                                <thead class="table-light">
                                    <tr>
                                        <th>Road</th>
                                        <th class="text-center">Active Status</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($roads as $road)

                                        @php
                                            $flag = isset($blockRoads[$block->block_code]) &&
                                                    $blockRoads[$block->block_code]
                                                    ->where('road', $road->road_code)
                                                    ->count();
                                        @endphp

                                        <tr>
                                            <td>{{ $road->road_name }}</td>

                                            <td class="text-center">
                                                <input 
                                                    type="checkbox"
                                                    value="{{ $road->road_code }}"
                                                    onchange="setRoad(this.value, '{{ $block->block_code }}')"
                                                    {{ $flag ? 'checked' : '' }}
                                                    class="form-check-input"
                                                >
                                            </td>
                                        </tr>

                                    @endforeach
                                </tbody>

                            </table>
                        </div>

                        <br>

                    @endforeach

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {
    
    });
    
    function setRoad(roadCode, blockCode) {
        $.ajax({
            type: 'POST',
            url: "{{ route('admin.masterData.setRoad') }}",
            data: {
                road: roadCode,
                block: blockCode,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log(response.message);
            }
        });
    }
</script>
@endpush
