<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/select.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/editor.dataTables.min.css') }}">
    
    
    <!-- /style -->
    <!-- scripts -->
     <script type="text/javascript" src="{{ asset('/js/jquery-1.12.4.js') }}"></script>
     <script type="text/javascript" src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
     <script type="text/javascript" src="{{ asset('/js/dataTables.buttons.min.js') }}"></script>
     <script type="text/javascript" src="{{ asset('/js/dataTables.select.min.js') }}"></script> 
    {{-- <script type="text/javascript" src="{{ asset('/js/dataTables.editor.min.js') }}"></script> --}}
    
      
    
   <body>
    <div class="col-md-12">
    <div id="example_wrapper" class="dataTables_wrapper">
    <div class="dt-buttons"><a class="dt-button buttons-create" tabindex="0" aria-controls="example" href="#"><span>New</span></a>
    <a class="dt-button buttons-selected buttons-edit disabled" tabindex="0" aria-controls="example" href="#"><span>Edit</span></a>
    <a class="dt-button buttons-selected buttons-remove disabled" tabindex="0" aria-controls="example" href="#"><span>Delete</span></a>
    </div>
    <div id="example_filter" class="dataTables_filter">
        <label>Search:<input type="search" class="" placeholder="" aria-controls="example"></label>
        </div>
        <table id="example" class="display dataTable" cellspacing="0" width="100%" role="grid" aria-describedby="example_info" style="width: 100%; position: relative;">
                <thead>
                    <tr role="row">
                    <th class="reorder sorting_asc" tabindex="0" aria-controls="example" rowspan="1" colspan="1" aria-label="First Name: activate to sort column descending" style="width: 61px;" aria-sort="ascending">First Name</th>
                    <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Last name" style="width: 448px;">Last Name</th>
                    <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Email" style="width: 142px;">Email</th>
                    <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Phone" style="width: 88px;">Phone</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr><th class="reorder" rowspan="1" colspan="1">First Name</th><th rowspan="1" colspan="1">Last Name</th><th rowspan="1" colspan="1">Email</th><th rowspan="1" colspan="1">Phone</th></tr>
                </tfoot>
            <tbody><tr id="row_1" role="row" class="odd">
            <td class="reorder sorting_1">1</td>
            <td>The Final Empire: Mistborn</td>
            <td>Brandon Sanderson</td>
            <td>24h 39m</td>
            </tr>
            </tbody>
            </table>
            <div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
            <a class="paginate_button previous disabled" aria-controls="example" data-dt-idx="0" tabindex="0" id="example_previous">Previous</a>
            <span><a class="paginate_button current" aria-controls="example" data-dt-idx="1" tabindex="0">1</a>
            <a class="paginate_button " aria-controls="example" data-dt-idx="2" tabindex="0">2</a>
            <a class="paginate_button " aria-controls="example" data-dt-idx="3" tabindex="0">3</a>
            </span>
            <a class="paginate_button next" aria-controls="example" data-dt-idx="4" tabindex="0" id="example_next">Next</a>
            </div>
            </div>

</div>
    
</body>
</html>
