<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$virksomhed = $emne = $dato = "";
$virksomhed_err = $emne_err = $dato_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
    // Validate virksomhed
    $input__virksomhed = trim($_POST["virksomhed"]);
    if(empty($input__virksomhed)){
        $virksomhed_err = "Skriv virksomhed.";
    } else{
        $virksomhed = $input__virksomhed;
    }
    
    // Validate emne
    $input_emne = trim($_POST["emne"]);
    if(empty($input_emne)){
        $emne_err = "Skriv emne";     
    } else{
        $emne = $input_emne;
    }
    
    // Validate dato
    $input_dato = trim($_POST["dato"]);
    if(empty($input_dato)){
        $dato_err = "skriv dato";     
    } else{
        $dato = $input_dato;
    }
    
    // Check input errors before inserting in database
    if(empty($virksomhed_err) && empty($emne_err) && empty($dato_err)){
        // Prepare an update statement
        $sql = "UPDATE klager SET virksomhed=?, emne=?, dato=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_virksomhed, $param_emne, $param_dato, $param_id);
            
            // Set parameters
            $param_virksomhed = $virksomhed;
            $param_emne = $emne;
            $param_dato = $dato;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM klager WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $virksomhed = $row["virksomhed"];
                    $emne = $row["emne"];
                    $dato = $row["dato"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Opdater klage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Opdater klage</h2>
                    <p>Rediger klage og submit for at opdatere.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Virksomhed</label>
                            <input type="text" name="virksomhed" class="form-control <?php echo (!empty($virksomhed_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $virksomhed; ?>">
                            <span class="invalid-feedback"><?php echo $virksomhed_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Emne</label>
                            <textarea name="emne" class="form-control <?php echo (!empty($emne_err)) ? 'is-invalid' : ''; ?>"><?php echo $emne; ?></textarea>
                            <span class="invalid-feedback"><?php echo $emne_err;?></span>
                        </div>
                        
                        <div class="form-group">
                            <label>Dato</label>
                            <input type="text" name="dato" class="form-control <?php echo (!empty($dato_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $dato; ?>">
                            <span class="invalid-feedback"><?php echo $dato_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>