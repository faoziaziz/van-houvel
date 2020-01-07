<div id="content" class="content">
    <!-- begin breadcrumb -->
    <ol class="breadcrumb pull-right">
        <li>
            <a href="javascript:;">Home</a>
        </li>
        <li>
            <a href="javascript:;">Report</a>
        </li>
    
    </ol>
    <!-- end breadcrumb -->
    <!-- begin page-header -->
   <h1 class="page-header">Report | Trumon</small></h1>
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
                    <h4 class="panel-title">Report</h4>
                </div>
                <div class="panel-body">
                   <?php 
                   $attributes = array('class' => 'form-control', 'id' => 'myform');
                   echo form_open('Transaction/export_excel','class="form-horizontal" id="myform"'); ?>
                        <div class="form-group">
							<label class="col-md-1 control-label" for="form-field-1" >Tenant</label>
							<div class="col-md-5">
								<?php echo cmb_activity3('ddTenant','Tenant','Tenant','flag', null,"id='ddTenant'") ?> 
							</div>    
							<label class="col-md-1 control-label" for="form-field-1">type of sale</label>
                            <div class="col-md-5">
								<?php echo cmb_activity4('ddJnsPnjualan','Tenant','JenisPenjualan','JenisPenjualan', null,"id='ddJnsPnjualan'") ?> 
                            </div>
							<span class="help-block"></span>
                        </div>
                        <div class="form-group">
							<label class="col-md-1 control-label" for="form-field-1" >Device</label>
							<div class="col-md-5">
								<?php echo cmb_activity('wp','Tenant','Tenant','DeviceId', null,"id='datawp1'") ?> 
							</div>    
							<label class="col-md-1 control-label" for="form-field-1">Type</label>
                            <div class="col-md-5">
								<select name="txtjenis" id="jenis" onchange="chk()"  class="form-control" required>
									<option selected="selected" disabled>Type</option>
									<option value="0">Monthly</option>
									<option value="1">Daily</option>
								</select>
                            </div>   
							<span class="help-block"></span>
                        </div>
						<span class="help-block"></span>
                        <div class="form-group">
							
                        </div>
						<div class="form-group">
							<label class="col-md-1 control-label" for="form-field-1">Start Date</label>
                            <div class="col-md-5">
								<input id="dt1" name="txtdt1"  class="month-year-input form-control" autocomplete="off">
                            </div>
							<label class="col-md-1 control-label" for="form-field-1" >End Date</label>
                            <div class="col-md-5">
								<input id="dt2" name="txtdt2"  class="month-year-input form-control" autocomplete="off">
                            </div>  
							<span class="help-block"></span>
						</div>
						<div class="form-group">
                            <div class="col-md-5">
								<div class="checkbox">
									<label><input type="checkbox" id="chkBoxCompare" value="">Compare</label>
								</div>
                            </div>
						</div>
						
						<button type="submit" class="btn btn-success">export</button></td>
                           
					</form>
                </div>
            </div>
            <!-- end panel --></div>
        <!-- end col-12 --></div>
    <!-- end row --></div>
	
<script>
/*$(document).ready(function() {
     $('#NoIconDemo').MonthPicker({ Button: false });
});*/



$('#chkBoxCompare').click(function(){
	if($("#ddTenant").val() == "" || $("#ddTenant").val() == null){
		var r = confirm("Pilih Tenant");
		if(r == true){
			$("#ddJnsPnjualan").val($("#ddJnsPnjualan option:first").val());
			$("#datawp1").val($("#datawp1 option:first").val());
		}
		return false;
	}
});

$(".dd-unique").change(function(){
	var thisVal = $(this).val();
	$(".dd-unique").val($(".dd-unique option:first").val());
	$(this).val(thisVal);
	
	if($("#ddTenant").val() == "" || $("#ddTenant").val() == null){
		$('#chkBoxCompare').prop('checked', false);
	}
	
} );

function chk(){
	var ddl = document.getElementById("jenis");
    var monthsLabels = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12']
    var today = new Date();
    var mm = today.getMonth()+1;
    var yyyy = today.getFullYear();
	if (mm <=9){
		month = "0" + mm;  
    }
    else{
		month = mm;
    }
	if(ddl.selectedIndex==1){
		$("#dt1").datepicker("remove");
		$("#dt2").datepicker("remove");
		$("#dt1").val(yyyy+'-'+month);
		$("#dt2").val(yyyy+'-'+month);
		$('#dt1').unbind();
		// $('#dt1').MonthPicker({ Button: false,format: 'yyyy-mm' });
		var picker = jQuery('#dt1').MonthPicker({
		ShowIcon: false,
			OnAfterChooseMonth: function(){
				var elts = picker.val().split('/');
				picker.val(elts[1]+'-'+monthsLabels[parseInt(elts[0])-1]);
			}
		});
		$('#dt2').unbind();
        var picker1 = jQuery('#dt2').MonthPicker({
		ShowIcon: false,
			OnAfterChooseMonth: function(){
				var elts = picker1.val().split('/');
				picker1.val(elts[1]+'-'+monthsLabels[parseInt(elts[0])-1]);
			}
		});
    }
   else if(ddl.selectedIndex==2){
		$("#dt1").datepicker("remove");
		$("#dt2").datepicker("remove");
		$('#dt1').unbind();
		$("#dt1").datepicker({format: 'yyyy-mm-dd',autoclose:true}).datepicker("setDate",new Date());
		$('#dt2').unbind();
		$("#dt2").datepicker({format: 'yyyy-mm-dd',autoclose:true}).datepicker("setDate",new Date());
	}
    else if(ddl.selectedIndex==0){
        $("#dt1").datepicker("remove");
        $("#dt2").datepicker("remove");
        $('#dt1').unbind();
        $('#dt2').unbind();
        $("#dt1").val("");
        $("#dt2").val("");
    }
}

</script>

<script>
    function loadData(){
        var wp = $('#datawp').val();
		$.ajax({
			type:"GET",
			url : '<?php echo base_url() ?>index.php/alarm/alarmDetail',
			data :'datawp='+wp,
			success:function(html){
				$("#tabel").html(html);
			}
        });
    }

    function filterData(){
        loadData();
    }
</script>
