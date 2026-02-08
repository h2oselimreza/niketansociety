<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <!-- <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> -->
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="{{ asset('assets/select_bo/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/select_bo/css/bootstrap-select.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/select_bo/css/custom-select.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/font-awesome.css') }}">

        <script src="{{ asset('assets/select_bo/js/jquery-1.11.1.min.js') }}"></script>
        <script src="{{ asset('assets/select_bo/js/jquery.knob.js') }}"></script>
        <script src="{{ asset('assets/select_bo/js/myScript.js') }}"></script>

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css"/>
        <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.10/js/dataTables.bootstrap.min.js"></script>


        <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>


        <!-- Scripts -->
         @vite(['resources/css/app.css', 'resources/js/app.js'])

         <script src="{{ asset('assets/select_bo/js/bootstrap-select.js') }}" type="text/javascript"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
        <script type="text/javascript" src="{{ asset('assets/select_bo/js/tinymce.js') }}"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

        <script src="{{ asset('assets/select_client/js/sweetalert.min.js') }}"></script>
        <link href="{{ asset('assets/select_client/css/sweetalert.css') }}" rel="stylesheet" />

        <script src="{{ asset('assets/select_bo/js/bootstrap-datepicker.js') }}"></script>
        <link href="{{ asset('assets/select_bo/css/bootstrap-datepicker3.standalone.min.css') }}" rel="stylesheet" />

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/select_bo/css/theme.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/select_bo/css/myStyle.css') }}">

        <script src="{{ asset('assets/select_bo/js/font-awesome.js') }}"></script>

        <script>
            function hideSideBar() {
                if ($('#sideNavBar').css('display') != 'none') {
                    $('#sideNavBar').hide();
                    $('#contentDiv').css('margin-left', '0px');
                } else if ($('#sideNavBar').css('display') == 'none') {
                    $('#contentDiv').css('margin-left', '240px');
                    $('#sideNavBar').show();
                }
            }

            $(document).ready(function () {
                $('.dataTable').DataTable({
                    //"bPaginate": false,
                    initComplete: function () {
                        this.api().columns().every(function () {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                    .appendTo($(column.footer()).empty())
                                    .on('change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                                $(this).val()
                                                );

                                        column
                                                .search(val ? '^' + val + '$' : '', true, false)
                                                .draw();
                                    });

                            column.data().unique().sort().each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>')
                            });
                        });
                    }
                });
            });
            
            $(document).ready(function () {
                $('#dataTable').DataTable({
                    //"bPaginate": false,
                    initComplete: function () {
                        this.api().columns().every(function () {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                    .appendTo($(column.footer()).empty())
                                    .on('change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                                $(this).val()
                                                );

                                        column
                                                .search(val ? '^' + val + '$' : '', true, false)
                                                .draw();
                                    });

                            column.data().unique().sort().each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>')
                            });
                        });
                    }
                });
            });

            $(document).ready(function () {
                $('#dataTableWithoutPagging').DataTable({
                    "bPaginate": false,
                    "columnDefs": [{
                            "targets": 'no-sort',
                            "orderable": false,
                            "order": []
                        }],
                    initComplete: function () {
                        this.api().columns().every(function () {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                    .appendTo($(column.footer()).empty())
                                    .on('change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                                $(this).val()
                                                );

                                        column
                                                .search(val ? '^' + val + '$' : '', true, false)
                                                .draw();
                                    });

                            column.data().unique().sort().each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>')
                            });
                        });
                    }
                });
            });

            $(document).ready(function () {
                $('#dataTableCheckBox').DataTable({
                    "bPaginate": false,
                    "columnDefs": [{
                            "targets": 'no-sort',
                            "orderable": false,
                            "order": []
                        }],
                
                    initComplete: function () {
                        this.api().columns().every(function () {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                    .appendTo($(column.footer()).empty())
                                    .on('change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                                $(this).val()
                                                );

                                        column
                                                .search(val ? '^' + val + '$' : '', true, false)
                                                .draw();
                                    });

                            column.data().unique().sort().each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>')
                            });
                        });
                    }
                });
            });
            
            $(document).ready(function () {
    $('#dataTableCheckBoxWithDownload').DataTable({
        "bPaginate": true,
        "lengthMenu": [
            [10, 25, 100, -1],
            [10, 25, 100, "All"]
        ],
        "columnDefs": [{
            "targets": 'no-sort',
            "orderable": false,
            "order": []
        }],
        dom: 'lBfrtip', // Added 'l' to show length menu
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        initComplete: function () {
            this.api().columns().every(function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex($(this).val());

                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
                    });

                column.data().unique().sort().each(function (d, j) {
                    select.append('<option value="' + d + '">' + d + '</option>')
                });
            });
        }
    });
});

/*

            $(document).ready(function () {
                $('#dataTableCheckBoxWithDownload').DataTable({
                    "bPaginate": true,
                   
                     "lengthMenu": [
                          [10, 25, 100, -1],
                        [10, 25, 100, "All"]
                    ],
                    "columnDefs": [{
                            "targets": 'no-sort',
                            "orderable": false,
                            "order": []
                        }],
                    dom: 'Bfrtip', // Enable Buttons
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print' // Buttons for export
                    ],
                    initComplete: function () {
                        this.api().columns().every(function () {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                    .appendTo($(column.footer()).empty())
                                    .on('change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                                $(this).val()
                                                );

                                        column
                                                .search(val ? '^' + val + '$' : '', true, false)
                                                .draw();
                                    });

                            column.data().unique().sort().each(function (d, j) {
                                select.append('<option value="' + d + '">' + d + '</option>')
                            });
                        });
                    }
                });
            });
*/
            tinyMCE.init({
                mode: "specific_textareas",
                editor_selector: "tinyMcTextArea"
            });
        </script>

        <!---exsisting code-->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">
    </head>
    <body class="theme-blue">
        <form id="delete-form" method="POST" style="display:none;">
            @csrf
            @method('DELETE')
        </form>
        <div class="min-h-screen">
            <div class="navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <div class="mobileNav" style="display:none">
                        </i><a class="navbar-brand" href="">COMPANY_NAME</a>
                    </div>
                </div>
                <div class="navbar-collapse collapse" style="height: 1px;">
                    <div id="sideNavigation" class="sideNavigation">
                        <i class=" navbar-brand fa fa-bars" onclick="hideSideBar()" aria-hidden="true"></i><a class="navbar-brand" href="">COMPANY_NAME</a>
                    </div>
                    <ul id="main-menu" class="nav navbar-nav navbar-right">
                        <li class="dropdown ">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="glyphicon glyphicon-user padding-right-small" style="position:relative;top: 3px;"></span> <?php /*echo $this->session->userdata('fullName');*/ ?>
                                <i class="fa fa-caret-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a target="_blank" href="">Change Password</a></li>
                                <li class="divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a style="padding-left:20px" tabindex="-1" href="route('logout')"
                                                onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            @include('layouts.navigation')
            <div class="content" id="contentDiv">
                <div id="divTop">
                    <div>
                        @yield('content')
                        <div id="overlay" style="display: none">
                            <div class="spinner"></div> 
                        </div>
                    </div>
                    <footer>
                        <hr>
                        <p class="pull-right">A <a href="" target="_blank">Developed</a> by <a href="" target="_blank"><b>ArrowLink™ Soft</b></a></p>
                        <p>© 2016 <a href="" target="_blank"><b>ArrowLink™ Soft</b></a></p>
                        <script src="{{ asset('assets/select_bo/js/bootstrap.js') }}"></script>
                        {{-- PAGE-SPECIFIC SCRIPTS --}}
                        @stack('scripts')
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
