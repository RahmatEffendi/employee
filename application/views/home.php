<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Employee</title>

	<link rel="stylesheet" href="<?php echo base_url('asset/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('asset/css/dataTables.bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('asset/css/page.css'); ?>">

	<!-- Js -->
	<script src="<?php echo base_url('asset/js/jquery-3.3.1.js'); ?>"></script>
	<script src="<?php echo base_url('asset/js/jquery.dataTables.min.js'); ?>"></script>
	<script src="<?php echo base_url('asset/js/dataTables.bootstrap.min.js'); ?>"></script>
	<script src="<?php echo base_url('asset/js/bootstrap.min.js'); ?>"></script>	
	
	<script>
		$(document).ready(function() {
			$('#example').DataTable();
		} );
	</script>
    
</head>
<body>
<div class="container"><br>
	<div class="top">
		<button type="button" class="btn btn-primary pull-right" data-toggle="modal" data-target="#addEmp"><span class="glyphicon glyphicon-plus"></span> Add Employee</button>
	</div>
	
	<div>
	<table id="example" class="table table-striped table-bordered" style="width:100%">
	<h3>Employee List</h3>
	<?php echo $this->session->flashdata('notif'); ?>
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Birthday</th>
                <th>Address</th>
                <th>Current Position</th>
				<th>KTP File</th>
				<th>Action</th>
            </tr>
        </thead>
        <tbody>
        	<?php 
                if($list_data != False){
                foreach ($list_data as $row): ?> 
            <tr>
                <td><?php echo $row->firstname .' '.$row->lastname; ?></td>
                <td><?php echo $row->phone; ?></td>
                <td><?php echo $row->birthday; ?></td>
                <td><?php echo $row->street; ?></td>
                <td><?php echo $row->crnt_positon; ?></td>
				<td>
					<img src="<?php echo base_url('upload/'.$row->att_ktp) ?>" style="width: 40%; height: auto;">
				</td>
				<td>
					<a href="#" onclick="edit(<?php echo $row->id; ?>)" class="btn btn-primary" data-toggle="modal" data-target="#editEmp"><span class="glyphicon glyphicon-edit"></span></a>
					<a href="<?php echo site_url('home/delete') ?>/<?php echo $row->id; ?>" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
				</td>
            </tr>
            <?php endforeach ?>
            <?php } ?>
        </tbody>
	</table>
	</div>


<!-- MODAL INSERT-->
<div class="modal fade" id="addEmp" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add New Employee</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" role="form" action="<?php echo site_url('home/add')?>" method="post" enctype="multipart/form-data">
                        
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Firstname</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPassword3" name="firstname" required="">
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Lastname</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPassword3" name="lastname" required="">
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Birthday</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="inputPassword3" name="birthday" required="">
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPassword3" name="phone" required="">
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPassword3" name="email" required="">
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Province</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="province" id="provinsi">
                                        <option value="">Please Select</option>
                                        <?php
                                        foreach ($provinsi as $prov) {
                                            ?>
                                            <option <?php echo $provinsi_selected == $prov->id_provinsi ? 'selected="selected"' : '' ?> 
                                                value="<?php echo $prov->id_provinsi ?>"><?php echo $prov->nama_provinsi ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">City</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="city" id="kota">
                                        <option value="">Please Select</option>
                                        <?php
                                        foreach ($kota as $kot) {
                                            ?>
                                            <!--di sini kita tambahkan class berisi id provinsi-->
                                            <option <?php echo $kota_selected == $kot->id_provinsi_fk ? 'selected="selected"' : '' ?> 
                                                class="<?php echo $kot->id_provinsi_fk ?>" value="<?php echo $kot->id_kota ?>"><?php echo $kot->nama_kota ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Street</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPassword3" name="street" required="">
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Zip Code</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPassword3" name="zipcode" required="">
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">KTP Number</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPassword3" name="ktp" required="">
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Current Position</label>
                                <div class="col-sm-10">
                                    <select name="crnt_positon" class="form-control" required>
                                        <option value="">Please Select</option>
                                        <option value="Manager">Manager</option>
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Staff">Staff</option>
                                     </select>
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Bank Name</label>
                                <div class="col-sm-10">
                                    <select name="bank_name" class="form-control" required>
                                        <option value="">Please Select</option>
                                        <option value="BCA">BCA</option>
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="BRI">BRI</option>
                                     </select>
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Bank Account</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPassword3" name="bank_acc" required="">
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Image</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="inputPassword3" name="filefoto" placeholder="Password" required="">
                                </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
        </div>
      </div>
      
    </div>
</div>
<!-- END MODAL INSERT -->

<!-- MODAL EDIT-->
<div class="modal fade" id="editEmp" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Employee</h4>
        </div>
        <div class="modal-body">
            <form id="form" class="form-horizontal" role="form" action="#" method="post" enctype="multipart/form-data">
                        <input type="hidden" value="" name="id"/>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Firstname</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPassword3" name="firstname" required="">
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Lastname</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPassword3" name="lastname" required="">
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Birthday</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" id="inputPassword3" name="birthday" required="">
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Phone</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPassword3" name="phone" required="">
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPassword3" name="email" required="">
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Province</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="province" id="provinsi">
                                        <option value="">Please Select</option>
                                        <?php
                                        foreach ($provinsi as $prov) {
                                            ?>
                                            <option <?php echo $provinsi_selected == $prov->id_provinsi ? 'selected="selected"' : '' ?> 
                                                value="<?php echo $prov->id_provinsi ?>"><?php echo $prov->nama_provinsi ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">City</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="city" id="kota">
                                        <option value="">Please Select</option>
                                        <?php
                                        foreach ($kota as $kot) {
                                            ?>
                                            <!--di sini kita tambahkan class berisi id provinsi-->
                                            <option <?php echo $kota_selected == $kot->id_provinsi_fk ? 'selected="selected"' : '' ?> 
                                                class="<?php echo $kot->id_provinsi_fk ?>" value="<?php echo $kot->id_kota ?>"><?php echo $kot->nama_kota ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Street</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPassword3" name="street" required="">
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Zip Code</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPassword3" name="zipcode" required="">
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">KTP Number</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPassword3" name="ktp" required="">
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Current Position</label>
                                <div class="col-sm-10">
                                    <select name="crnt_positon" class="form-control" required>
                                        <option value="">Please Select</option>
                                        <option value="Manager">Manager</option>
                                        <option value="Supervisor">Supervisor</option>
                                        <option value="Staff">Staff</option>
                                     </select>
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Bank Name</label>
                                <div class="col-sm-10">
                                    <select name="bank_name" class="form-control" required>
                                        <option value="">Please Select</option>
                                        <option value="BCA">BCA</option>
                                        <option value="Mandiri">Mandiri</option>
                                        <option value="BRI">BRI</option>
                                     </select>
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Bank Account</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputPassword3" name="bank_acc" required="">
                                </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label">Image</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" id="inputPassword3" name="filefoto" placeholder="Password" required="">
                                </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
          
        </div>
      </div>
      
    </div>
</div>
<!-- END MODAL EDIT-->

</div>
</body>
</html>