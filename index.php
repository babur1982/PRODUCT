<!DOCTYPE html>
<html>
	<head>
		<title> PRODUCT CRUD</title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	
		<style type="text/css">
		.higlight
		{
		color:#0000FF;
		font-size:24px;
		}
		input.uppercase { text-transform: uppercase; }
		</style>
	</head>
	<body>
		<div class="container">
			<br />
			
			<h3 align="center">PRODUCT MASTER</h3>
			<br />
			
			<div align="left" style="margin-bottom:5px;">
				<button type="button" name="add_button" id="add_button" class="btn btn-success">Add New</button>
				
			
				
			</div>

			<div class="table-responsive">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>Option #</th>
							<th>Type</th>
							<th>Name</th>
							<th>Cost/Direct/Price</th>
							<th>Option Hours</th>
							<th>Weight</th>
							<th>Shopping Site Contenet</th>
							<th>Tech Talk</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody></tbody>
				</table>
			</div>
			<form role="print-report" method="post" action="product-report.php" enctype="multipart/form-data" autocomplete="off" target="_blank">
		 <div align="right" style="margin-bottom:5px;">
  			<button type="submit" class="btn btn-md btn-info" id="print" name="print">PRINT</button>
		</div>	
			<textarea id="printvalue" name="printvalue" style="display:none"></textarea>
		
		 </form>
		</div>
	
	</body>
</html>

<div id="apicrudModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" id="api_crud_form">
				<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal">&times;</button>
		        	<h4 class="modal-title">Add Data</h4>
		      	</div>
		      	<div class="modal-body">
		      		<div class="form-group">
			        	<label>Enter Option Number</label>
			        	<input type="text" name="option_number" id="option_number" class="form-control higlight uppercase" placeholder="Enter Number" maxlength="25"/>
			        </div>
			        <div class="form-group">
			        	<label>Enter Option Type</label>
			        	<input type="text" name="option_type" id="option_type" class="form-control higlight uppercase" placeholder="Enter  Type" maxlength="25"/>
			        </div> 
					<div class="form-group">
			        	<label>Enter Name</label>
			        	<input type="text" name="option_name" id="option_name" class="form-control higlight uppercase" placeholder="Enter Name" maxlength="25"/>
			        </div>
					<div class="form-group">
			        	<label>Enter Cost</label>
			        	<input type="text" name="cost_price" id="cost_price" class="form-control allow_decimal higlight" placeholder="Enter Cost" maxlength="10"/>
			        </div>
					<div class="form-group">
			        	<label>Enter Hours</label>
			        	<input type="text" name="hours" id="hours" class="form-control allow_decimal higlight" placeholder="Enter Hours"/ maxlength="10">
			        </div>
					<div class="form-group">
			        	<label>Enter Weight</label>
			        	<input type="text" name="weight" id="weight" class="form-control allow_decimal higlight" placeholder="Enter Weight" maxlength="10"/>
			        </div>
					<div class="row">
						<div class="col-md-6 form-check">
						  <input class="form-check-input" type="checkbox" value="" id="content" name="content">
						  <label class="form-check-label" for="content">
							Shopping Site Content
						  </label>
						</div>
						<div class="col-md-6 form-check">
						  <input class="form-check-input" type="checkbox" value="" id="techtalk" name="techtalk">
						  <label class="form-check-label" for="techtalk">
							Tech Talk
						  </label>
						</div>
					</div>
					
			    </div>
			    <div class="modal-footer">
			    	<input type="hidden" name="hidden_id" id="hidden_id" />
			    	<input type="hidden" name="action" id="action" value="insert" />
					
			    	<input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Insert" />
			    	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      		</div>
			</form>
		</div>
  	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){

	 $(".allow_decimal").on("input", function(evt) {
		 
			   var self = $(this);
			   self.val(self.val().replace(/[^0-9\.]/g, ''));
			   if ((evt.which != 46 || self.val().indexOf('.') != -1) && (evt.which < 48 || evt.which > 57)) 
			   {
				 evt.preventDefault();
			   }
			 
 			});
	fetch_data();
    fetch_data_report(); 
	function fetch_data()
	{
		$.ajax({
			url:"./work/fetch.php",
			success:function(data)
			{
				$('tbody').html(data);
			}
		})
	}
	
	function fetch_data_report()
	{
		$.ajax({
			url:"./work/fetchreport.php",
			success:function(data)
			{
				$('#printvalue').text(data);
			}
		})
	}

	$('#add_button').click(function(){
		$('#action').val('insert');
		$('#button_action').val('Insert');
		$('.modal-title').text('Add Data');
		$('#apicrudModal').modal('show');
	});
	
	$('#print_button').click(function(){
	
	
		var print_data = $('#printvalue').val();
			$.ajax({
				
				url:"product-report.php",
				method:"POST",
				data:{result:print_data},
				success:function(data)
				{
						alert("Data Inserted using PHP API");
				}
			});
	});

	$('#api_crud_form').on('submit', function(event){
		event.preventDefault();
		if($('#option_number').val() == '')
		{
			alert("Enter Option Number");
		}
		else if($('#option_type').val() == '')
		{
			alert("Enter Option Type");
		}
		else
		{
			var form_data = $(this).serialize();
			$.ajax({
				url:"./work/action.php",
				method:"POST",
				data:form_data,
				success:function(data)
				{
					fetch_data();
					fetch_data_report();
					$('#api_crud_form')[0].reset();
					$('#apicrudModal').modal('hide');
					if(data == 'insert')
					{
						alert("Data Inserted using PHP API");
					}
					if(data == 'update')
					{
						alert("Data Updated using PHP API");
					}
				}
			});
		}
	});

	$(document).on('click', '.edit', function(){
	
		var id = $(this).attr('id');
		var action = 'fetch_single';
		$.ajax({
		  
			url:"./work/action.php",
			method:"POST",
			data:{id:id, action:action},
			dataType:"json",
			success:function(data)
			{
				$('#hidden_id').val(id);
				$('#option_number').val(data.option_no);
				$('#option_type').val(data.option_type);
				$('#option_name').val(data.name);
				$('#cost_price').val(data.cost_price);
				$('#hours').val(data.hours);
				$('#weight').val(data.weight);
				if(data.shopping_site=='Yes')
				{
					$('input[name=content]').attr('checked', true);
				}
				else
				{
					$('input[name=content]').attr('checked', false);
				}
				if(data.tech_talk=='Yes')
				{
					$('input[name=techtalk]').attr('checked', true);
				}
				else
				{
					$('input[name=techtalk]').attr('checked', false);
				}
				$('#action').val('update');
				$('#button_action').val('Update');
				$('.modal-title').text('Edit Data');
				$('#apicrudModal').modal('show');
			}
		})
	});

	$(document).on('click', '.delete', function(){
		var id = $(this).attr("id");
		var action = 'delete';
		if(confirm("Are you sure you want to remove this data using PHP API?"))
		{
			$.ajax({
				url:"./work/action.php",
				method:"POST",
				data:{id:id, action:action},
				success:function(data)
				{
					fetch_data();
					fetch_data_report();
					alert("Data Deleted using PHP API");
				}
			});
		}
	});

});
</script>