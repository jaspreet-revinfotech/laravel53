<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Laravel</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/rowreorder/1.2.0/css/rowReorder.dataTables.min.css"/>

    <script type="text/javascript"  src="js/jquery-3.1.1.min.js"></script>
    <!-- <script type="text/javascript" src="js/jquery-ui.js"></script> -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript"  src="js/jquery.dataTables.min.js"></script>
    <!-- <script type="text/javacsript"  src="js/buttons.print.min.js"></script> -->
    <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.0/js/dataTables.rowReorder.min.js"></script>
    <style type="text/css">
      @media print
      {
          #buttonRow, .dataTables_length, .dataTables_filter, #myTable_info,.dataTables_paginate { 
          visibility: hidden; 
        }
      }
    </style>
</head>
<body class="dt-example">
    <div class="container">
        <div class="row" id="buttonRow">
            <div class="col-md-12 space">
                <button type="button" class="btn btn-primary" onclick="deletePidField();" data-toggle="modal" data-target="#exampleModal">Add New</button>
                <a href="{{ url('/export-excel-records') }}"><button type="button" class="btn btn-primary">Export Excel</button></a> 
                <a href="{{ url('/export-csv-records') }}"><button type="button" class="btn btn-primary">Export Csv</button></a>
                <a href="{{ url('/export-pdf') }}"><button type="button" class="btn btn-primary">Export Pdf</button></a>
                <a href="javascript:void(0);"><button type="button" class="btn btn-primary" id="printMe">Print</button></a>

            </div> 
        </div>
    </div>
    <div class="container">
        <div class="row">
            <table id="myTable" class="display" width="100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Tenant id</th>
                        <th>Organisation id</th>
                        <th>Facility id</th>
                        <th>Slug</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Display sequence</th>
                        <th>Required</th>
                        <th>Template</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="tbodyTbody">
                    <?php foreach($data as $row) {?>
                        <tr id="tr<?php echo $row->id;?>">
                            <td>{{ $row->id  }}</td>
                            <td>{{ $row->tenant_id  }}</td>
                            <td>{{ $row->organisation_id }}</td>
                            <td>{{ $row->facility_id }}</td>
                            <td>{{ $row->slug }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->description }}</td>
                            <td>{{ $row->display_sequence }}</td>
                            <?php if($row->required == 1) {?>
                                <td>Yes</td>
                                <?php } else {?>
                                    <td>No</td>
                                    <?php } ?>
                                    <td>{{ $row->template }}</td>
                                    <td><a href="javascript:void(0);" onclick="EditRecord('<?php echo $row->id; ?>');"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;<a id="deleteID" href="javascript:void(0);" onclick="deleteData('<?php echo $row->id; ?>');"><i class="glyphicon glyphicon-trash"></i></a></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                   <th>&nbsp;</th>
                                   <th>Tenant id</th>
                                   <th>Organisation id</th>
                                   <th>Facility id</th>
                                   <th>Slug</th>
                                   <th>Name</th>
                                   <th>Description</th>
                                   <th>Display sequence</th>
                                   <th>Required</th>
                                   <th>Template</th>
                                   <th>Action</th>
                               </tr>
                           </tfoot>
                       </table>
                   </div>
               </div>
               <!--- modal form starts here -->
               <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                     <form id="addForm"  method="POST"  onsubmit="return formSubmit();"  action="{{ url('/add-new-form') }}">
                         {!! csrf_field() !!}
                         <div class="form-group" id="tenant_id_div">
                            <label class="form-control-label">Tenant Id</label>

                            <select class="form-control" name="tenant_id" id="tenant_id">
                                <option value="">Please select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>

                            <span class="help-block" id="tenant_id_span" ></span>

                        </div>
                        <div class="form-group" id="organisation_id_div">
                            <label  class="form-control-label">Organisation Id</label>

                            <select class="form-control" name="organisation_id" id="organisation_id">
                                <option value="">Please select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>

                            <span class="help-block" id="organisation_id_span"></span>
                        </div>
                        <div class="form-group" id="facility_id_div">
                            <label  class="form-control-label">Facility Id</label>

                            <select class="form-control" name="facility_id" id="facility_id">
                                <option value="">Please select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <span class="help-block" id="facility_id_span"></span>
                        </div>
                        <div class="form-group" id="slug_div">
                            <label class="form-control-label">Slug</label>
                            <input type="text" class="form-control" value="" name="slug" id="slug" />
                            <span class="help-block" id="slug_span"></span>
                        </div>
                        <div class="form-group" id="name_div">
                            <label  class="form-control-label">Name</label>
                            <input type="text" class="form-control" value="" name="name" id="name" />
                            <span class="help-block" id="name_span"></span>
                        </div>
                        <div class="form-group" id="description_div">
                            <label  class="form-control-label">Description</label>
                            <input type="text" class="form-control" value="" name="description" id="description" />
                            <span class="help-block" id="description_span"></span>
                        </div>
                        <div class="form-group" id="display_sequence_div">
                            <label class="form-control-label">Display sequence</label>

                            <select class="form-control" name="display_sequence" id="display_sequence">
                                <option value="">Please select</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <span class="help-block" id="display_sequence_span"></span>
                        </div>
                        <div class="form-group" id="required_div">
                            <label class="form-control-label">Required</label>
                            <select class="form-control" name="required" id="required">
                                <option value="">Please select</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                            <span class="help-block" id="required_span"></span>
                        </div>
                        <div class="form-group" id="template_div">
                            <label  class="form-control-label">template</label>
                            <input type="text" class="form-control" value="" name="template" id="template" />
                            <span class="help-block" id="template_span"></span>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
     {{--  <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> 
   </div> --}}
</div>
</div>
</div>
<!--  form modal ends here   -->
<!-- modal delete starts here -->
<!-- Modal --> 
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
      </button>
  </div>
  <div class="modal-body" id="myModalBody">

      Do you want to delete this ?
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    <button type="button" id="confirmButton" class="btn btn-primary">Yes</button>
</div>
</div>
</div>
</div>
<!-- delete modal ends here -->
<!-- formsubmit Ajax start here -->
<script type="text/javascript">
    function formSubmit()
    {
        $.ajax({
            method:"post",
            url:"{{ url('/add-new-form') }}",
            data:$('#addForm').serialize(),
            success:function(data){
               if(isNaN(data)) {
                alert('Oops!. Operation failed. Please try again.');
              } else if(parseInt(data) > 0){                   
                 var data= jQuery.parseJSON(JSON.stringify(data));

                 var id = data; 
                 var tenant_id       = $.trim($('#tenant_id').val());
                 var organisation_id = $.trim($('#organisation_id').val());
                 var facility_id     = $.trim($('#facility_id').val());
                 var slug            = $.trim($('#slug').val());
                 var name            = $.trim($('#name').val());
                 var description     = $.trim($('#description').val());
                 var display_sequence = $.trim($('#display_sequence').val());
                 var required         = $.trim($('#required').val());
                 var template         = $.trim($('#template').val());                 

                //$("#tbodyTbody tr:not([id])").remove();
                $('.dataTables_empty').closest('tr').remove();

                if($('#pid').length>0){
                    var pid       = $.trim($('#pid').val());
                    $('#tr'+id).html(str);
                } else{
                  var t = $('#myTable').DataTable();
               
                   //t.row.add( ['<i class="glyphicon glyphicon-option-vertical"></i>',tenant_id, organisation_id, facility_id, slug, name, description, display_sequence,'Yes',template,'<a href="javascript:void(0);" onclick="EditRecord('+id+');"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;<a id="deleteID" href="javascript:void(0);" onclick="deleteData('+id+');"><i class="glyphicon glyphicon-trash"></i></a>']).draw( false );
                    
                    //Now add id to newly added row
                    var rowIndex = $('#myTable').dataTable().fnAddData(['<i class="glyphicon glyphicon-option-vertical"></i>',tenant_id, organisation_id, facility_id, slug, name, description, display_sequence,'Yes',template,'<a href="javascript:void(0);" onclick="EditRecord('+id+');"><i class="glyphicon glyphicon-edit"></i></a>&nbsp;<a id="deleteID" href="javascript:void(0);" onclick="deleteData('+id+');"><i class="glyphicon glyphicon-trash"></i></a>']);
                    var row = $('#myTable').dataTable().fnGetNodes(rowIndex);
                    $(row).attr( 'id', 'tr'+id );     
                    //$('#tbodyTbody').prepend('<tr id="tr'+id+'">'+str+'</tr>');
                }                  

                $('#exampleModal').modal('hide');
                $('#addForm')[0].reset();

          }
    },
    error: function(data) {

        var obj = jQuery.parseJSON(data.responseText);
        if(obj.tenant_id!=null) {
            $('#tenant_id_div').addClass('has-error');
            $('#tenant_id_span').text(obj.tenant_id);
        } else {
            $('#tenant_id_div').removeClass('has-error');
            $('#tenant_id_span').text('');
        }
        if(obj.organisation_id!=null) {
            $('#organisation_id_div').addClass('has-error');
            $('#organisation_id_span').text(obj.organisation_id);
        } else {
            $('#organisation_id_div').removeClass('has-error');
            $('#organisation_id_span').text('');
        }
        if(obj.facility_id!=null) {
            $('#facility_id_div').addClass('has-error');
            $('#facility_id_span').text(obj.facility_id);
        } else {
            $('#facility_id_div').removeClass('has-error');
            $('#facility_id_span').text('');
        }
        if(obj.slug!=null) {
            $('#slug_div').addClass('has-error');
            $('#slug_span').text(obj.slug);
        } else {
            $('#slug_div').removeClass('has-error');
            $('#slug_span').text('');
        }
        if(obj.name!=null) {
            $('#name_div').addClass('has-error');
            $('#name_span').text(obj.name);
        } else {
            $('#name_div').removeClass('has-error');
            $('#name_span').text('');
        }
        if(obj.description!=null) {
            $('#description_div').addClass('has-error');
            $('#description_span').text(obj.description);
        } else {
            $('#description_div').removeClass('has-error');
            $('#description_span').text('');
        }
        if(obj.display_sequence!=null) {
            $('#display_sequence_div').addClass('has-error');
            $('#display_sequence_span').text(obj.display_sequence);
        } else {
            $('#display_sequence_div').removeClass('has-error');
            $('#display_sequence_span').text('');
        }
        if(obj.required!=null) {
            $('#required_div').addClass('has-error');
            $('#required_span').text(obj.required);
        } else {
            $('#required_div').removeClass('has-error');
            $('#required_span').text('');
        }
        if(obj.template!=null) {
            $('#template_div').addClass('has-error');
            $('#template_span').text(obj.template);
        } else {
            $('#template_div').removeClass('has-error');
            $('#template_span').text('');
        }
    }
});
return false;
}
function EditRecord(id)
{
 var id = id;
 $.ajax({
    method:"POST",
    dataType: "json",
    url:"{{ url('/edit-form') }}/"+id,
    headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
    success:function(data)
    {  
        var data= jQuery.parseJSON(JSON.stringify(data));
        if(data.tenant_id!=null) {
            $('#tenant_id').val(data.tenant_id);

        }
        if(data.organisation_id!=null) {
            $('#organisation_id').val(data.organisation_id);

        }
        if(data.facility_id!=null) {
            $('#facility_id').val(data.facility_id);

        }
        if(data.slug!=null) {
            $('#slug').val(data.slug);

        }
        if(data.name!=null) {
            $('#name').val(data.name);

        }
        if(data.description!=null) {
            $('#description').val(data.description);

        }
        if(data.display_sequence!=null) {
            $('#display_sequence').val(data.display_sequence);

        }
        if(data.required!=null) {
            $('#required').val(data.required);

        }
        if(data.template!=null) {
            $('#template').val(data.template);

        }
        $('#pid').remove();
        $('#addForm').append('<input type="hidden" name="pid" id="pid" value="'+id+'" />');
        $('#exampleModal').modal();
    }      
});
}

/*  delete functionality starts here */
function deleteData(id){
    $('#delPid').remove();
    $('#myModalBody').append('<input type="hidden" id="delPid" value="'+id+'" />');
    $('#myModal').modal(); 
} 

$(document).ready(function(){
    $('#confirmButton').click(function(){
      var id = $.trim($('#delPid').val());
       $('#delteModal').modal('hide'); 
       $.ajax({
        method:"POST",
        url:"{{ url('/delete-form') }}/"+id,
        'headers': {'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        success:function(data){
            //$("#tr"+id).hide();
            $('#myModal').modal('hide');

            var table = $('#myTable').DataTable();
 
            var rows = table.rows("#tr"+id).remove().draw();
        }
    });
   });
});

function deletePidField(){
    $('#pid').remove();
    $('#addForm')[0].reset();
}
$(document).ready(function(){
    var table = $('#myTable').DataTable({
                                        rowReorder: true
                                        });
    table.on( 'row-reorder', function ( e, diff, edit ) {
    var result = 'Reorder started on row: '+edit.triggerRow.data()[1]+'<br>';
  
    for ( var i=0, ien=diff.length ; i<ien ; i++ ) {
        var rowData = table.row( diff[i].node ).data();
        //console.log(rowData);
        result += rowData[1]+' updated to be in position '+diff[i].newData+' (was '+diff[i].oldData+')<br>';
        //console.log(rowData['DT_RowId']+' updated to be in position '+diff[i].newData+' (was '+diff[i].oldData+')'); 
    }   
        console.log(result);
        //alert(result);     
        //$('#result').html( 'Event result:<br>'+result );
    } );
});

$('#printMe').click(function(){
     window.print();
});
  $( function() {
 //$("#myTable tbody").sortable().disableSelection(); 
});
</script>
<!-- ends here  -->
</body>
</html>