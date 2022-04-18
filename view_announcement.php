<?php 
include 'db_connect.php';
if(isset($_GET['id'])){
	$qry = $conn->query("SELECT * FROM announcements where id = ".$_GET['id'])->fetch_array();
	foreach($qry as $k => $v){
		$$k = $v;
	}
}
?>

<div class="col-lg-12">
<h1>Announcement</h1><br>
	<div class="card card-outline card-danger">
		<div class="card-body">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label">Title</label>
					<br><?php echo ucwords($title) ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="" class="control-label">Description</label>
					<br><?php echo html_entity_decode($description) ?>
				</div>
			</div>
		</div>
    	</div>
	</div>
</div>