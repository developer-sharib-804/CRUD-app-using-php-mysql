<?php
include 'config.php';
if(isset($_POST['login'])) {
    if(empty($_POST['name']) OR empty($_POST['email']) OR empty($_POST['addr']) OR
       empty($_POST['phone']) ) {
        echo "<script> alert('Some Fields are empty');</script>";
    }  else {
       
        $name = $_POST["name"];
        $email = $_POST["email"];
        $addr = $_POST["addr"];
        $phone = $_POST["phone"];
   
        
         $insert = "INSERT INTO employee (name, email, address, phone)
          VALUES ('$name', '$email', '$addr', '$phone')";
        mysqli_query($conn, $insert);

        echo "<script> alert('Successfully Submitted ');</script>";
    }
}


if(isset($_POST['edit'])) {
    $id = $_POST['edit_id'];
    $name = $_POST["nameu"];
    $email = $_POST["emailu"];
    $addr = $_POST["addru"];
    $phone = $_POST["phoneu"];

    $update = "UPDATE employee SET name='$name', email='$email', address='$addr', phone='$phone' WHERE sno=$id";
    mysqli_query($conn, $update);
    echo "<script> alert('Successfully Updated');</script>";
}

if(isset($_POST['delete'])) {
	$idd = $_POST['delete_id'];
	$delete= "DELETE FROM employee WHERE sno='$idd'";
	mysqli_query($conn, $delete);
	echo "<script> alert('Successfully deleted');</script>";

}



?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Bootstrap CRUD Data Table for Database with Modal Form</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="script.js"></script>

</head>
<body>
<div class="container-xl">
	<div class="table-responsive">
		<div class="table-wrapper">
			<div class="table-title">
				<div class="row">
					<div class="col-sm-6">
						<h2>Manage <b>Employees</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
						<a href="#deleteEmployeeModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
					</div>
				</div>
			</div>
		

			
<!-- Edit Modal HTML -->
<div id="addEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form method="post" >
	   			<div class="modal-header">						
					<h4 class="modal-title">Add Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
					<label>Name</label>
						<input type="text" name="name" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email"  class="form-control" required>
					</div>
					<div class="form-group">
						<label>Address</label>
						<textarea class="form-control" name="addr" required></textarea>
					</div>
					<div class="form-group">
						<label>Phone</label>
						<input type="text" name="phone" class="form-control" required>
					</div>					
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" name="login" class="btn btn-success" value="Add">
				</div>
			</form>
		</div>
	</div>
</div>
<div id="editEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">                      
                    <h4 class="modal-title">Edit Employee</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">                    
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="nameu" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="emailu"  class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea class="form-control" name="addru" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" name="phoneu" class="form-control" required>
                    </div>                   
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="edit_id" id="edit_id">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" name="edit" class="btn btn-info" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>

<div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post">
                <div class="modal-header">                      
                    <h4 class="modal-title">Delete Employee</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">                    
                    <p>Are you sure you want to delete this record?</p>
                    <p class="text-warning"><small>This action cannot be undone.</small></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="delete_id" id="delete_id">
                    <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                    <input type="submit" name="delete" class="btn btn-danger" value="Delete">
                </div>
            </form>
        </div>
    </div>
</div>

<style>
       

        h1 {
            text-align: center;
            color: black;
            font-size:60px;
        }

        table {
            width:100%;
            align-items:center;
            background-color: white;
            border: 2px solid black;
            color: black;
            
        }

        th, td {
            padding-left:50px;
            padding:12px;
            padding-right:50px;
            text-align: left;
            border-bottom: 1px solid black;
           font-size:12px;
        }

        th {
            background-color: #435d7d;
            color:white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table.table td a.edit {
	        color: #FFC107;
     }
        table.table td a.delete {
	      color: #F44336;
       }
    </style>
<script>
function setDeleteValues(id) {
    document.getElementById('delete_id').value = id;
}
</script>

<?php
$show = "SELECT * FROM employee";
$result = mysqli_query($conn, $show);

if ($result) {
?>
    <table class="table">
        <tr>
            <th>SNO</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Action</th>
        </tr>
           
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
            <td><?php echo $row['sno']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td>
                <a href="#editEmployeeModal" class="edit" data-toggle="modal" onclick="setEditValues(<?php echo $row['sno']; ?>)"><i class="material-icons" style="color: #FFC107;margin-left:20px;" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                <a href="#deleteEmployeeModal" class="delete" data-toggle="modal" onclick="setDeleteValues(<?php echo $row['sno']; ?>)"><i class="material-icons" style="color:red;margin-left:20px;" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
            </td>
        </tr>
    <?php } ?>
    </table>
<?php } ?>

<script>
    function setEditValues(id) {
        document.getElementById('edit_id').value = id;
        // You may need to fetch the existing values from the database and populate the form fields for editing.
    }

    function setDeleteValues(id) {
        // You may need to set the delete_id in the form for deletion.
        document.getElementById('delete_id').value = id;
    }
</script>

</body>
</html>
