<?php

//Check if the field is Empty
function checkIfEmpty($value,$message,& $errors){
    if (empty($value)) {
		$errors[] = $message;
	}  
}

//update data in the table

//Add data in the table
function addTable($dbc,$query){
    $result = @mysqli_query ($dbc, $query); // Run the query.
    if ((mysqli_affected_rows($dbc) == 1) || (mysqli_affected_rows($dbc) == 0)) { 
        echo 'The record has been added.<br/>';								
    } else { // If query did not run OK.
        echo '<p class="error">The record could not be added due to a system error. We apologize for any inconvenience.</p>'; // Public message.
        echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $query . '</p>'; // Debugging message.
        exit();
    }
}





//print submit button
function printFormSubmit(){
    echo '<input type="hidden" name="submitted" value="TRUE" />
    <p><input type="submit" name="submit" value="Submit" /></p>';
    echo '</form></div>';
}

?>

