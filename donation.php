<?php
// connect to the database
require_once 'conn.php';

// Uploads files
if (isset($_POST['save'])) { // if save button on the form is clicked
    // name of the uploaded file

        $pid = $_POST['pid'];
		$d_date = $_POST['d_date'];
		$name = $_POST['name'];
        $mobile = $_POST['mobile'];
        $amount = $_POST['amount'];
        $method = $_POST['method'];
        $remarks = $_POST['remarks'];

        $char = strlen($remarks);

        if($char > 150)
        {
            echo '<script type = "text/javascript">
                            alert("Remark is Too Long!");
                        window.location = "booking.php";
                     </script>
                    ';;
        }
        else
        {
            $sql = "INSERT INTO donations (p_id, name, mobile, amount, method, remark, date) VALUES ('$pid','$name','$mobile','$amount','$method','$remarks','$d_date')";
            if (mysqli_query($conn, $sql)) 
            {

                $last_id = $conn->insert_id;
                
                echo '<script type = "text/javascript">
                            alert("Data Inserted Successfully!");
                        window.location = "print.php?pid=' .  $last_id . '";
                     </script>
                    ';;
            }
            else
            {
                
				echo '<script type = "text/javascript">
                            alert("Data Inserted Failed! Please Try Again");
                        window.location = "booking.php";
                     </script>
                    ';;
                    
            }
        }
           
    }

if (isset($_POST['edit'])) { // if save button on the form is clicked
    // name of the uploaded file

    $p_id = $_POST['p_id'];
    $p_name = $_POST['p_name'];
    $p_description = $_POST['p_description'];
    $p_rate = $_POST['p_rate'];
    $p_day = $_POST['p_day'];

    $char = strlen($p_description);

    if($char > 250)
    {
        echo '<script type = "text/javascript">
                        alert("Programme Decription is Too Long!");
                    window.location = "programmes.php";
                 </script>
                ';;
    }

    else
    {
        $sql = "UPDATE `programmes` SET `p_name` = '$p_name',  `p_description` = '$p_description', `rate` = '$p_rate',  `p_date` = '$p_day' WHERE `p_id` = '$p_id'";
            if (mysqli_query($conn, $sql)) 
            {
                
                echo '<script type = "text/javascript">
                            alert("Update Successfully!");
                        window.location = "programmes.php";
                     </script>
                    ';;
            }
            else
            {
                echo '<script type = "text/javascript">
                            alert("Update Failed");
                        window.location = "programmes.php";
                     </script>
                    ';;
            }
    }

}

if (isset($_POST['delete'])) 
{
        $id = $_POST['p_id'];

        $sql = "DELETE FROM programmes WHERE p_id = '$id'";
            if (mysqli_query($conn, $sql)) 
            {
                
                echo '<script type = "text/javascript">
                            alert("Delete Successfully!");
                        window.location = "programmes.php";
                     </script>
                    ';;
            }
            else
            {
                echo '<script type = "text/javascript">
                            alert("You Cannot Delete this");
                        window.location = "programmes.php";
                     </script>
                    ';;
            }
}