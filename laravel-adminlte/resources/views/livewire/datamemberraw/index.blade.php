@extends('adminlte::page')

@section('title', 'Data Member Raw')

@section('content_header')
    <h3>
        Data Member Raw
    </h3>
@stop

@section('content')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<style>

    body{
        background: #ccc;
    }

    #memberraw-import {
        background: #fff;
        padding: 20px;
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
<!-- FILTER -->
<div class="card card-outline card-danger collapsed-card" >
    <div class="card-header">
        <h3 class="card-title">Filter</h3>
        <div class="card-tools">
            <!-- Collapsß Button -->
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i></button>

        </div>
    </div>

            <div class="card-body" >
                <form action="#" method="post"  id="search-form">
                    {!! csrf_field() !!}
                    <div class="row">
                        <div class="col-md-6">

                            <label for="id_member">ID Member</label>
                            <input type="tel" name="id_member" id="id_member" class="form-control mb-2" />

                            <label for="no_hp">Nomer HP</label>
                            <input type="tel" name="no_hp" id="no_hp" class="form-control mb-2" />
                            
                            <label for="poin">Status Cek Data</label>
                            <select name="status_cek_data" class="form-control" id="status_cek_data">
                                <option value="">-- Pilih --</option>
                                <option value="1">Aktif</option>
                                <option value="0">InActive</option>
                            </select>
                            
                            <label for="no_hp">Created At</label>
                            <input type="tel" name="created_at" id="created_at" class="form-control mb-2" />

                        </div>
                    </div>
                 
                {{-- </form> --}}
            </div>

            <div class="card-footer">
                <div class="float-left">
                    <a type="button" class="btn btn-flat bg-primary" id="search"><i class="fas fa-search"></i> Filter</a>
                    <a class="btn btn-warning mr-2" href="" ><i class="fas fa-download"></i> Export Member Raw</a>
                    <a type="button" id="reset" class="btn btn-flat bg-secondary  btn-reset"><i class="fas fa-undo-alt"></i> Reset</a>
                </div>
            </div>

</div>
<div class="card">
    <div class="card-body">
        <div class="row float-right">
           

           
                
                {{-- <a type="text"   class="btn btn-primary btn-flat text-white" id="filter-show"><i class="fas fa-search"></i> Filter</a> --}}
                
                <button class="btn btn-success btn-import mx-2" type="button" id="btn-import"><i class="fas fa-upload" style="margin-right: 5px"></i>Import Member Raw</button>

                

                <div class="progress" id="progressBar" style="text-align: center;height:20px; display:none" >
                    <div class="bar" style="text-align: center;height:20px;"></div >
                    <div class="percent" style="text-align: center; height:20px; padding-top:10px;margin:none;">0%</div >
                </div>

          
        </div>
        
        <div class="mb-4"></div>

        <br />
        @if(count($errors) > 0)
         <div class="alert alert-danger">
          Upload Validation Error<br><br>
          <ul>
           @foreach($errors->all() as $error)
           <li>{{ $error }}</li>
           @endforeach
          </ul>
         </div>
        @endif

        @if($message = Session::get('success'))
        <div class="alert alert-success alert-block">
         <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        @endif

        <table class="table table-bordered" id="data_member_raw_table" style="width:100%;">
           
            
            <thead class="thead-light text-primary">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">ID Member</th>
                    <th class="text-center">No HP</th>
                    <th class="text-center">Status Cek</th>
                    <th class="text-center">Created At</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modal-filter">
    <div class="modal-dialog modal-md">
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

                                    <label for="id_member">ID Member</label>
                                    <input type="tel" name="id_member" id="id_member" class="form-control mb-2" />

                                    <label for="no_hp">Nomer HP</label>
                                    <input type="tel" name="no_hp" id="no_hp" class="form-control mb-2" />

                                    <label for="poin">Status Cek Data</label>
                                    <select name="status_cek_data" class="form-control" id="status_cek_data">
                                        <option value="">-- Pilih --</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">InActive</option>
                                    </select>

                                    <button id="submit-filter" class="btn btn-primary btn-flat mt-2">Submit</button>
                                </div>

                    </div>
                </div>
                {{-- <div class="modal-footer">
                </div> --}}
            </div>
        </form>
    </div>
</div>

<!-- Import Excel -->
<div class="modal fade" id="importExcel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="post" action="" id="memberraws-import" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Excel</h5>
                </div>
                <div class="modal-body">
                    @csrf

                    @if (session('error'))
                        <div class="alert alert-success">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="">File (.xls, .xlsx)</label>
                        <input type="file" class="form-control file" name="file">
                        <p class="text-danger">{{ $errors->first('file') }}</p>
                        
                        <a href="" class="btn btn-info" ><i class="fas fa-download"></i>Download Template Excel</a>

                    </div>

                    <span id="data_reference_import"></span>
                    <input id="reference_import" type="hidden" name="reference_import" value="">
                    <input id="type_input" type="hidden" name="type_input" value="import">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                    <button id="btnImport" type="button" class="btn bg-lime btn-flat"><i class="fas fa-upload"></i> Import</button>
                </div>
            </div>
        </form>
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

    var tabel = $('#data_member_raw_table').DataTable({
        processing: true,
        ordering: true,
        serverSide: true,
        // searching: false,
        ajax: {
            url: "",
            type: 'POST',
            data: function (d) {
                d.id_member           = $('#id_member').val();
                d.no_hp               = $('#no_hp').val();
                d.status_cek_data     = $('#status_cek_data').val();
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
            { "data": "status_cek_data", "name": "status_cek_data" },
            { "data": "created_at", "name" : "created_at" },
        ],
        pageLength: 50,
        lengthMenu: [
            [ 10, 50, 100, 300, 400 ],
            [ '10 rows', '50 rows', '100 rows', '300 rows', '400 rows']
        ]
    });

    $('#search').on('click',function (e) {
       
        tabel.draw();
        
    });

    $("#filter-show").on('click',function (e) {
        $('#modal-filter').modal('show');
    });

    $('#reset').click(function(e) {
        $("#search-form").trigger("reset");
        tabel.draw();
        e.preventDefault();
    });

    // $('#export_excel').on('click',function () {
    //     var id_member           = $('#id_member').val();
    //     var no_hp               = $('#no_hp').val();
    //     var status_cek_data     = $('#status_cek_data').val();

    //     var download_url    = "{{ url('data-member-raw/action-excel') }}";

    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });

    //     jQuery.ajax({
    //         url:"{{ url('data-member-raw/export-excel') }}",
    //         type:"POST",
    //         data:{
    //             id_member : id_member,
    //             no_hp : no_hp,
    //             status_cek_data: status_cek_data
    //         },
    //         success: function (result) {
    //             console.log(result);
    //             window.location.href = download_url + '/' +result;
    //         }
    //     });
    // });

});
</script>



 <script type="text/javascript">
     var SITEURL = "{{URL('/')}}";
     $(function () {
         $(document).ready(function () {
             var bar = $('.bar');
             var percent = $('.percent');
             $('form').ajaxForm({
                 beforeSend: function () {
                     var percentVal = '0%';
                     bar.width(percentVal)
                     percent.html(percentVal);
                 },
                 uploadProgress: function (event, position, total, percentComplete) {
                     var percentVal = percentComplete + '%';
                     bar.width(percentVal)
                     percent.html(percentVal);
                 },
                 complete: function (xhr) {
                     alert('File Has Been Uploaded Successfully');
                     window.location.href = SITEURL + "/" + "data-member-raw";
                 }
             });
         });
     });

    // //  Button sumbit
    // $(".btn-import").on('click',function (e) {
    //     const file = $('.file').val();
    //     if(file == ""){
    //         alert('Please choose file');
    //         return false;
    //     }
    //     document.getElementById('memberraw-import').submit();
    //     $("#progressBar").show();
    // });


   

    // Import Excel
    $("#btn-import").click(function() {
            $("#importExcel").modal('show');
        });

        $("#btnImport").on('click',function (e) {
        const file = $('.file').val();
        if(file == ""){
            alert('Please choose file');
            return false;
        }
        document.getElementById('memberraws-import').submit();
        $("#progressBar").show();
    });

 </script>
@stop
