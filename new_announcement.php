<?php if(!isset($conn)){ include 'db_connect.php'; } ?>

<div class="col-lg-12">
<h1>Announcement</h1><br>
	<div class="card card-outline card-danger">
		<div class="card-body">
			<form action="" id="manage-announcement">

        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label">Title</label>
					<input type="text" class="form-control form-control-sm" name="title" value="<?php echo isset($title) ? $title : '' ?>">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="" class="control-label">Description</label>
					<textarea name="description" id="" cols="30" rows="10" class="summernote form-control">
						<?php echo isset($description) ? $description : '' ?>
					</textarea>
				</div>
			</div>
		</div>
        </form>
    	</div>
    	<div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    			<button class="btn bg-primary mx-2" form="manage-announcement">Save</button>
    			<button class="btn bg-secondary mx-2" type="button" onclick="location.href='index.php?page=home'">Cancel</button>
    		</div>
    	</div>
	</div>
</div>
<script>
	$('#manage-announcement').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_announcement',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved',"success");
					setTimeout(function(){
						location.href = 'index.php?page=home'
					},2000)
				}
			}
		})
	})
</script>