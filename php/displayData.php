<?php 
include "db.php";

function number() {
    global $db;
    $sql = "SELECT * FROM `employees`";

if ($result = mysqli_query($db, $sql)) {

    // Return the number of rows in result set
    $rowcount = mysqli_num_rows( $result );
    
    // Display result
    printf($rowcount);
 }
}


function displaydata()
{
    global $db;

			/* get all columns  data*/
            $query = "SELECT * FROM `employees`";
            $result = mysqli_query ($db,$query);

            /* all row */
            while ($all_rows = mysqli_fetch_assoc($result))
            {
                echo '
                <tr>
                <td>
                    <span class="custom-checkbox">
                        <input class="groupA" type="checkbox" id="checkbox5" value="1">
                        <label for="checkbox5"></label>
                    </span>
                </td>
                <td>'.$all_rows["id"].'</td>
                <td id="name">'.$all_rows["name"].'</td>
                <td id="education">'.$all_rows["education"].'</td>
                <td id="email">'.$all_rows["Email"].'</td>
                <td>'.$all_rows["Adress"].'</td>
                <td>
                    <a href="#editEmployeeModal" data-id="'.$all_rows["id"].'" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                    <a href="#deleteEmployeeModal" data-id="'.$all_rows["id"].'" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
                </td>
            </tr>
                ';
            }
}



function addItem(){
    global $db;
    if (isset($_POST["add"])){
        $name=$_POST['name'];
        $email=$_POST['email'];
        $address=$_POST['address'];
        $education=$_POST['education'];
        $educations=implode(",",$education);
        $query_name = "insert into employees (name,email,adress,education) value ('$name','$email','$address','$educations')";
        mysqli_query($db,$query_name);
        header("Refresh:0");
    }
     
    }
    addItem();




    function select_user ($idEmp){
        global $db;
        $query_name = "select * from employees where id='$idEmp'";
        $result =  mysqli_query($db,$query_name);
        return mysqli_fetch_assoc($result);

    }


    /*show box model for update data */
    if (isset($_POST["userid"])){
        $user = select_user($_POST["userid"]);
        echo '	
        <input type="hidden" name="id" value="'.$user["id"].'"> 				
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" value="'.$user["name"].'" name="name" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" class="form-control" value="'.$user["Email"].'" name="email" required>
        </div>
        <div class="form-group">
            <label>Address</label>
            <input class="form-control" value="'.$user["Adress"].'" name="address" required>
        </div>
				
    ';
    }
    


    
    /*show box model for confirmer delete data */

    if (isset($_POST["delete_id"])){
        $user = select_user($_POST["delete_id"]);
        echo '					
        <input type="hidden" name="id" value="'.$user["id"].'">         
        <p>Are you sure you want to delete '.$user["name"].'</p>
        <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" value="'.$user["name"].'" name="name" readonly>
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control" value="'.$user["Email"].'" name="email" readonly>
    </div>	
        <p class="text-warning"><small>This action cannot be undone.</small></p>
        ';
    }
    /*update data and save button*/

    if(isset($_POST["save"])){
            $id=$_POST["id"];
            $name=$_POST['name'];
            $email=$_POST['email'];
            $address=$_POST['address'];
            $query_name = "update employees set name='$name',adress='$address',email='$email' where id =$id";
            mysqli_query($db,$query_name);
            
    }

        /*delete data onclick button*/

    if(isset($_POST["delete"])){
        $id=$_POST["id"];
        $query_name = "DELETE FROM employees WHERE id=$id";
        mysqli_query($db,$query_name);
        
}




?>