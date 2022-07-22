@extends('adminlte::page')

@section('title', 'Data Member')

@section('content_header')
    <h3>
        Data Member
    </h3>
@stop

@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<style>

    body{
        background: #ccc;
    }

   #form{
        background: #fff;
        padding: 20px;
    }

    #form-import-data {

        background: #fff;
        padding: 0px 20px;
    }
    .progress {
        position:relative;
        width:100%;
    }
    .bar {
        background-color: #00ff00;
        width:0%;
        height:20px;
    }
    .percent {
        position:absolute;
        display:inline-block;
        left:50%;
        color: #040608;
    }
</style>


<div class="card">
    <div class="card-body">

        <div class="row">
                            <!-- FILTER -->
                            <div class="card card-outline card-danger collapsed-card w-100 h-3">
                                <div class="card-header">
                                    <h5 class="card-title">Filter</h5>
                                    <div class="card-tools">
                                        <!-- Collapse Button -->
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form action="" method="GET" id="formFilter">
                                        {!! csrf_field() !!}
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="customer_name">ID Member</label>
                                                    <input type="text" class="form-control" id="id_member" placeholder="ID Member" name="id_member" value="" maxlength="50">
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone_number">No HP</label>
                                                    <input type="email" class="form-control" id="no_hp" placeholder="No HP" name="no_hp" value="" maxlength="50">
                                                </div>
                                                <div class="form-group">
                                                    <label for="phone_number">Created At</label>
                                                    <input type="email" class="form-control" id="created_at" placeholder="Created At" name="created_at" value="" maxlength="50">
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label >Limit</label><br/>
                                                    <select name="limit" class="form-control" id="limit">
                                                        <option value="10">10</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                        <option value="300">300</option>
                                                        <option value="400">400</option>
                                                        <option value="500">500</option>
                                                        <option value="1000">1000</option>
                                                        <option value="5000">5000</option>
                                                        <option value="10000">10,000</option>
                                                        <option value="20000">20,000</option>
                                                        <option value="25000">25,000</option>
                                                    </select>
            
                                                </div> --}}
                                                
            
                                            </div>
                                        </div>
                                        <span id="data_reference"></span>
                                        <div class="card-footer">
                                            <div class="float-right">
                                                <button type="button" class="btn btn-flat bg-purple" id="search"><i class="fas fa-search"></i> Filter</button>
                                                <button type="submit" class="btn btn-flat bg-fuchsia" ><i class="fas fa-download"></i> Download Request</button>
                                                <a type="button" onclick="resetFilter()" class="btn btn-flat bg-secondary"><i class="fas fa-undo-alt"></i> Reset</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
            
                            </div>
        </div>

        <div class="row">
            <form  action="/export-unicharm-member" method="GET" enctype="multipart/form-data" id="members-export">
                @csrf
                {{-- <button class="btn btn-warning btn-export mx-2" type="button"><i class="fas fa-download"></i>Export Data Member</button> --}}



                <button type="submit" class="btn btn-flat bg-fuchsia" id="download"><i class="fas fa-download"></i> Export Data Sales</button>

                <div class="progress" id="progressBar" style="text-align: center;height:20px; display:none" >
                    <div class="bar" style="text-align: center;height:20px;"></div >
                    <div class="percent" style="text-align: center; height:20px; padding-top:10px;margin:none;">0%</div >
                </div>

            </form>
        </div>
       
        <div class="mb-3"></div>
        <table class="table table-bordered" id="data_member_table" style="width:100%;">
            <tr>
                <a type="text" style="margin-left: 1300px;color:#fff;" class="btn btn-primary btn-flat" id="filter-show"><i class="fas fa-search"></i> Filter</a>
            </tr>
            <thead class="thead-light text-primary">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">ID Member</th>
                    <th class="text-center">No HP </th>
                    <th class="text-center">Created At</th>
                </tr>
            </thead>
        </table>
    </div>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal-filter">
        <div class="modal-dialog modal-lg">
            <form id="search-form" role="form">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Filter</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="msisdn">ID Member</label>
                                <input type="number" name="id_member" id="id_member" class="form-control mb-2" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="msisdn">Nomer HP</label>
                                <input type="tel" name="no_hp" id="no_hp" class="form-control mb-2" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="submit-filter" class="btn btn-primary btn-flat">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('custom_js')
<script type="text/javascript" src="{{ asset('vendor/datatables/FixedHeader-3.2.1/js/dataTables.fixedHeader.js') }}"></script>
<script type="text/javascript">
$(document).ready(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var tabel = $('#data_member_table').DataTable({
        processing: true,
        ordering: true,
        serverSide: true,
        searching: false,
        ajax: {
            // url: "/ajax-unicharm-member",
            url: "{{ route('ajax-member') }}",
            type: 'POST',
            data: function (d) {
                d.id_member     = $('#id_member').val();
                d.no_hp         = $('#no_hp').val();
                d.no_hp         = $('#created_at').val();
                // d.created_at    = $('#created_at').val();
            }
        },
        deferRender: true,
        columns: [
            { "data": "id", "name": "id",
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { "data": "id_member", "name": "id_member" },
            { "data": "no_hp", "name" : "no_hp" },
            { "data": "created_at", "name" : "created_at" },
        ],
        pageLength: 50,
        lengthMenu: [
            [ 10, 50, 100, 300, 400 ],
            [ '10 rows', '50 rows', '100 rows', '300 rows', '400 rows']
        ]
    });

    $('#search').click(function(){
            tabel.draw();
        })

    $('#submit-filter').on('click',function (e) {
        console.log($('#id_member').val());
        $('#modal-filter').modal('hide');
        tabel.draw();
        e.preventDefault();
        $('.btn-reset').show();
    });

    $("#filter-show").on('click',function (e) {
        $('#modal-filter').modal('show');
    });

    $('#reset').click(function(e) {
        $("#search-form").trigger("reset");
        tabel.draw();
        e.preventDefault();
        $('.btn-reset').delay(1000).hide(0);
    });


    $(".btn-export").on('click',function (e) {

            document.getElementById('members-export').submit();
            $("#progressBar").show();
        // }
    });

});
</script>
@stop
