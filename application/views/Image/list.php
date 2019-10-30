<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li>
            <a href="javascript:;">Home</a>
        </li>
        <li>
            <a href="javascript:;">Image</a>
        </li>
    
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
   <h1 class="page-header">Image | Trumon</h1>
    <!-- end page-header -->
    <!-- begin row -->
    <div class="row">
        <!-- begin col-12 -->
        <div class="col-md-12 ui-sortable">
            <!-- begin panel -->
            <div class="panel panel-inverse">
                <div class="panel-heading">
                    <div class="panel-heading-btn">

                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                        <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                   
                    </div>
                    <h4 class="panel-title">Image</h4>
                </div>
                <div class="panel-body" style="overflow:auto">
                   <p>Filtering Data</p>
                <table class="table table-bordered">
                    <tr>
                        <td>Tenant</td>
                        <td>
                            <?php echo cmb_dinamis('datawp','Tenant','Tenant','DeviceId', null,"id='datawp'") ?>
                        </td>
                        <td>Month</td>
                        <td>
                            <select name="txtBulan" id="txtBulan" class="form-control">
                                <option>Month</option>
                                <?php
                                            $bulan = array(1=>"Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                            $cur_month = date('m');
                                            for($bln=1; $bln<=12; $bln++){
                                              if($bln<=9) { 
                                                echo "<option value='0$bln' ";
                                                if($cur_month==$bln){
                                                    echo ' selected="selected"';
                                                }
                                                echo ">$bulan[$bln]</option>"; 
                                              }
                                                else { 

                                                echo "<option value='0$bln' ";
                                                if($cur_month==$bln){
                                                    echo ' selected="selected"';
                                                }
                                                echo ">$bulan[$bln]</option>"; 
                                               }
                                             }

                                          ?>
                            </select>
                        </td>
                        <td>
                            <label>Year</label>
                        </td>
                        <td>
                            <select name="txtTahun" id="txtTahun" class="form-control">
                                <option>Year</option>
                                <?php

                                           $starting_year = date('Y',strtotime('-1 year'));
                                            $ending_year = date('Y',strtotime('+5 year'));
                                            $curr_year = date('Y');
                                            $sel;
                                            for($starting_year; $starting_year<=$ending_year; $starting_year++){
                                               echo '<option value="'.$starting_year.'"';
                                                if($curr_year==$starting_year){
                                                   echo ' selected="selected"';
                                                   }
                                                   echo ' >'.$starting_year.'</option>';
                                             }
                                          ?>
                            </select>
                        </td>

                        <td>
                            <button id="search" class="btn btn-success">Submit</button>
                        </td>
                    </tr>

                </table>
                
                    <table class="table table-striped table-bordered table-hover table-full-width dataTable" id="mytable" aria-describedby="sample_1_info">
                        <thead>
                            <tr role="row">
									<th>Nomor</th>
									<th>DeviceId</th>
									<th>Tenant</th>
									<th>Image</th>           
									<th>Data</th> 
									<th>Action</th>
									                           
                                </tr>
                        </thead>

                    </table>
                </div>
            </div>
            <!-- end panel --></div>
        <!-- end col-12 --></div>
    <!-- end row --></div>

<div class="modal fade" id="modal-edit" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Modal Dialog</h4>
            </div>
            <div class="modal-body">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id" id="id"/>
                    <div class="form-group">
                        <div class="col-sm-12" id="image">
                            
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="form-field-1">Data</label>
                        <div class="col-sm-10">
                            <textarea id="data" rows="15" cols="40" name="data"></textarea>
                        </div>
                        
                    </div>
                    
                  
                    
                    </form>
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <div class="col-sm-1">
                            <button type="button" id="btnSave" name="submit" onclick="save()" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  

<script>
var save_method; //for save method string
$(document).ready(function(){
	var t = $('#mytable').DataTable({
		"ajax": '<?php echo site_url('Image/data');?>'+'?wp='+$('#datawp').val()+'&bln='+$("#txtBulan").val()+"&thn="+$('#txtTahun').val(),
		"columns":[
			{
				"data":null,
				"width":"50px",
				"sClass": "text-center",
				"orderable":false
			},
			{
				"data":"DeviceId",
				"orderable":false
			},
			{
				"data":"Tenant",
				"orderable":false
			},
			{
				"data": "Image",
				"sClass" : "text-center",
				"orderable":false
			},{
				"data": "teks",
				"orderable":false,
				render: function ( data, type, row ) {
					return nl2br(atob(data));
				}
			},
			{"data":"aksi","width":"90px","sClass": "text-center"},
		],
		"destroy" : true 
	});
	t.on('order.dt search.dt',function(){
		t.column(0,{search:'applied',order:'applied'}).nodes().each(function(cell,i){
			cell.innerHTML =i+1;
		});
	}).draw();
	
	$("#search").click(function(){
		$('#mytable').DataTable().ajax.url('<?php echo site_url('Image/data');?>?wp='+$('#datawp').val()+'&bln='+$("#txtBulan").val()+"&thn="+$('#txtTahun').val()).load();
	});
	
	
});

function nl2br (str, is_xhtml) {
  
  var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>'; // Adjust comment to avoid issue on phpjs.org display

  return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
}

function br2nl (str, replaceMode) {   
	
  var replaceStr = (replaceMode) ? "\n" : '';
  // Includes <br>, <BR>, <br />, </br>
  return str.replace(/<\s*\/?br\s*[\/]?>/gi, replaceStr);
}

function edit_note(obj){
	$("#id").val($(obj).attr('id'));
	$("#image").html($(obj).closest('tr').find('td:eq(3)').html());
	$("#data").html(br2nl($(obj).closest('tr').find('td:eq(4)').html()));
    $('#modal-edit').modal('show'); // show bootstrap modal when complete loaded
    $('.modal-title').text('Edit Data'); // Set title to Bootstrap modal title
} 

function save(){
		var url;
		url = "<?php echo site_url('Image/ajax_update')?>";
		
		// ajax adding data to database
		$.ajax({
			url : url,
			type: "POST",
			data: $('#form').serialize(),
			dataType: "JSON",
			success: function(data){
				$('#modal-edit').modal('hide');
                $("#search").click();
				
				$('#btnSave').text('save'); //change button text
				$('#btnSave').attr('disabled',false); //set button enable 
			},
			error: function (jqXHR, textStatus, errorThrown){
				alert('Error adding / update data');
				$('#btnSave').text('save'); //change button text
				$('#btnSave').attr('disabled',false); //set button enable 
			}
		});
	}
</script>

