<?php include('db_connect.php') ?>
<?php
$twhere ="";
if($_SESSION['login_type'] != 1)
  $twhere = "  ";
?>
<!-- Info boxes -->
 <div class="col-12">
          <div class="h1 font-weight-bold">
            Welcome, <?php echo $_SESSION['login_name']?>!👋
          </div>
  </div>
  <br>
  
  <?php 
    $where = "";
    if($_SESSION['login_type'] == 2){
      $where = " where manager_id = '{$_SESSION['login_id']}' ";
    }elseif($_SESSION['login_type'] == 3){
      $where = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
    }
     $where2 = "";
    if($_SESSION['login_type'] == 2){
      $where2 = " where p.manager_id = '{$_SESSION['login_id']}' ";
    }elseif($_SESSION['login_type'] == 3){
      $where2 = " where concat('[',REPLACE(p.user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
    }
    ?>

      <div class="row">
        <div class="col-md-3">
              <div class="col-12 col-sm-6 col-md-12">
                <div class="small-box bg-info shadow-sm border">
                  <div class="inner">
                    <h3><?php echo $conn->query("SELECT * FROM project_list $where")->num_rows; ?></h3>
                    <p>Total Projects</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-layer-group"></i>
                  </div>
                </div>
              </div>
          </div>

        <div class="col-md-3">
            <div class="col-12 col-sm-6 col-md-12">
              <div class="small-box bg-warning shadow-sm border">
                <div class="inner">
                  <h3><?php echo $conn->query("SELECT * FROM project_list WHERE status = 3")->num_rows; ?></h3>
                <p>On-hold Projects</p>
                </div>
                <div class="icon">
                  <i class="fa fa-layer-group"></i>
                </div>
              </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="col-12 col-sm-6 col-md-12">
              <div class="small-box bg-gray shadow-sm border">
                <div class="inner">
                  <h3><?php echo $conn->query("SELECT * FROM project_list WHERE status = 0")->num_rows; ?></h3>
                  <p>Pending Projects</p>
                </div>
                <div class="icon">
                  <i class="fa fa-layer-group"></i>
                </div>
              </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="col-12 col-sm-6 col-md-12">
              <div class="small-box bg-success shadow-sm border">
                <div class="inner">
                  <h3><?php echo $conn->query("SELECT * FROM project_list WHERE status = 5")->num_rows; ?></h3>
                  <p>Done Projects</p>
                </div>
                <div class="icon">
                  <i class="fa fa-layer-group"></i>
                </div>
              </div>
            </div>
        </div>  
      </div>

      <div class="row">
        <div class="col-md-3">
            <div class="col-12 col-sm-6 col-md-12">
              <div class="small-box bg-info shadow-sm border">
                <div class="inner">
                  <h3><?php echo $conn->query("SELECT t.*,p.name as pname,p.start_date,p.status as pstatus, p.end_date,p.id as pid FROM task_list t inner join project_list p on p.id = t.project_id $where2")->num_rows; ?></h3>
                  <p>Total Tasks</p>
                </div>
                <div class="icon">
                  <i class="fa fa-tasks"></i>
                </div>
              </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="col-12 col-sm-6 col-md-12">
              <div class="small-box bg-primary shadow-sm border">
                <div class="inner">
                  <h3><?php echo $conn->query("SELECT * FROM task_list WHERE status = 2")->num_rows; ?></h3>
                <p>On Progress Tasks</p>
                </div>
                <div class="icon">
                  <i class="fa fa-tasks"></i>
                </div>
              </div>
            </div>
        </div>

        <div class="col-md-3">
              <div class="col-12 col-sm-6 col-md-12">
                <div class="small-box bg-gray shadow-sm border">
                  <div class="inner">
                    <h3><?php echo $conn->query("SELECT * FROM task_list WHERE status = 1")->num_rows; ?></h3>
                    <p>Pending Tasks</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-tasks"></i>
                  </div>
                </div>
              </div>
          </div>

        <div class="col-md-3">
            <div class="col-12 col-sm-6 col-md-12">
              <div class="small-box bg-success shadow-sm border">
                <div class="inner">
                  <h3><?php echo $conn->query("SELECT * FROM task_list WHERE status = 3")->num_rows; ?></h3>
                <p>Done Tasks</p>
                </div>
                <div class="icon">
                  <i class="fa fa-tasks"></i>
                </div>
              </div>
            </div>
        </div>  
      </div>
        
      <div class="row">
        <div class="col-md-6">
        <div class="card card-outline card-success">
          <div class="card-header">
            <b>Project Progress</b>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0 table-hover">
                <colgroup>
                  <col width="5%">
                  <col width="30%">
                  <col width="35%">
                  <col width="15%">
                  <col width="15%">
                </colgroup>
                <thead>
                  <th>#</th>
                  <th>Project</th>
                  <th>Progress</th>
                  <th>Status</th>
                  <th></th>
                </thead>
                <tbody>
                <?php
                $i = 1;
                $stat = array("Pending","Started","On-Progress","On-Hold","Over Due","Done");
                $where = "";
                if($_SESSION['login_type'] == 2){
                  $where = " where manager_id = '{$_SESSION['login_id']}' ";
                }elseif($_SESSION['login_type'] == 3){
                  $where = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
                }
                $qry = $conn->query("SELECT * FROM project_list $where order by name asc");
                while($row= $qry->fetch_assoc()):
                  $prog= 0;
                $tprog = $conn->query("SELECT * FROM task_list where project_id = {$row['id']}")->num_rows;
                $cprog = $conn->query("SELECT * FROM task_list where project_id = {$row['id']} and status = 3")->num_rows;
                $prog = $tprog > 0 ? ($cprog/$tprog) * 100 : 0;
                $prog = $prog > 0 ?  number_format($prog,2) : $prog;
                $prod = $conn->query("SELECT * FROM user_productivity where project_id = {$row['id']}")->num_rows;
                if($row['status'] == 0 && strtotime(date('Y-m-d')) >= strtotime($row['start_date'])):
                if($prod  > 0  || $cprog > 0)
                  $row['status'] = 2;
                else
                  $row['status'] = 1;
                elseif($row['status'] == 0 && strtotime(date('Y-m-d')) > strtotime($row['end_date'])):
                $row['status'] = 4;
                endif;
                  ?>
                  <tr>
                      <td>
                         <?php echo $i++ ?>
                      </td>
                      <td>
                          <a>
                              <?php echo ucwords($row['name']) ?>
                          </a>
                          <br>
                          <small>
                              Due: <?php echo date("Y-m-d",strtotime($row['end_date'])) ?>
                          </small>
                      </td>
                      <td class="project_progress">
                          <div class="progress progress-sm">
                              <div class="progress-bar bg-green" role="progressbar" aria-valuenow="57" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $prog ?>%">
                              </div>
                          </div>
                          <small>
                              <?php echo $prog ?>% Complete
                          </small>
                      </td>
                      <td class="project-state">
                          <?php
                            if($stat[$row['status']] =='Pending'){
                              echo "<span class='badge badge-secondary'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='Started'){
                              echo "<span class='badge badge-primary'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='On-Progress'){
                              echo "<span class='badge badge-info'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='On-Hold'){
                              echo "<span class='badge badge-warning'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='Over Due'){
                              echo "<span class='badge badge-danger'>{$stat[$row['status']]}</span>";
                            }elseif($stat[$row['status']] =='Done'){
                              echo "<span class='badge badge-success'>{$stat[$row['status']]}</span>";
                            }
                          ?>
                      </td>
                      <td>
                        <a class="btn btn-primary btn-sm" href="./index.php?page=view_project&id=<?php echo $row['id'] ?>">
                              <i class="fas fa-folder">
                              </i>
                              View
                        </a>
                      </td>
                  </tr>
                <?php endwhile; ?>
                </tbody>  
              </table>
            </div>
          </div>
        </div>
        </div>
      
      <div class="col-md-6">
			<div class="card card-outline card-danger">
				<div class="card-header">
					<span><b>Announcements</b></span>
					<?php if($_SESSION['login_type'] != 3): ?>
					<div class="card-tools"> 
            <a class="btn btn-sm btn-danger" href="./index.php?page=new_announcement"><i class="fa fa-plus"></i> Add Announcement</a>
          </div>
				<?php endif; ?>
				</div>
				<div class="card-body p-0">
					<div class="table-responsive">
					<table class="table table-condensed m-0 table-hover">
						<colgroup>
							<col width="50%">
							<col width="50%">
						</colgroup>
						<thead>
							<th>Title</th>
							<th>Description</th>
						</thead>
						<tbody>
							<?php 
							$i = 1;
							$announcements = $conn->query("SELECT * FROM announcements");
							while($row=$announcements->fetch_assoc()):
								$trans = get_html_translation_table(HTML_ENTITIES,ENT_QUOTES);
								unset($trans["\""], $trans["<"], $trans[">"], $trans["<h2"]);
								$desc = strtr(html_entity_decode($row['description']),$trans);
								$desc=str_replace(array("<li>","</li>"), array("",", "), $desc);
							?>
								            <tr>
			                        <td class=""><b><?php echo ucwords($row['title']) ?></b></td>
			                        <td class=""><p class="truncate"><?php echo strip_tags($desc) ?></p></td>
			                        <td class="text-center">
                                <button type="button" class="btn btn-default btn-sm border-dark wave-effect text-dark dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                  Action
                                </button>
                                <div class="dropdown-menu" style="">
                                  <a class="dropdown-item view_announcement" href="./index.php?page=view_announcement&id=<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>">View</a>
                                <div class="dropdown-divider"></div>
                                  <?php if($_SESSION['login_type'] != 3): ?>
                                  <a class="dropdown-item" href="./index.php?page=edit_announcement&id=<?php echo $row['id'] ?>">Edit</a>
                                <div class="dropdown-divider"></div>
                                  <a class="dropdown-item delete_announcement" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Delete</a>
                                  <?php endif; ?>
                                </div>
									            </td>
		                    	  </tr>
							<?php 
							endwhile;
							?>
						</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
    </div>

<script>
  $(document).ready(function(){
	$('#list').dataTable()
	
  $('.delete_announcement').click(function(){
	_conf("Are you sure to delete this announcement?","delete_announcement",[$(this).attr('data-id')])
	})
	})
	function delete_announcement($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_announcement',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>
