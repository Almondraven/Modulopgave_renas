<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$virksomhed = $emne = $klageinfo = $dato = "";
$virksomhed_err = $emne_err = $klaginfor_err = $dato_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate virksomhed
    $input_virksomhed = trim($_POST["virksomhed"]);
    if(empty($input_virksomhed)){
        $virksomhed_err = "Skriv virksomhed";
    } else{
        $virksomhed = $input_virksomhed;
    }
    
    // Validate emne
    $input_emne = trim($_POST["emne"]);
    if(empty($input_emne)){
        $emne_err = "Skriv emne";     
    } else{
        $emne = $input_emne;
    }

    // Validate klageinfo
    $input_klageinfo = trim($_POST["klageinfo"]);
    if(empty($input_klageinfo)){
        $klageinfo_err = "Skriv klageinfo";     
    } else{
        $klageinfo = $input_klageinfo;
    }
    
    // Validate dato
    $input_dato = trim($_POST["dato"]);
    if(empty($input_dato)){
        $dato_err = "skriv dato";    
    } else{
        $dato = $input_dato;
    }
    
    // Check input errors before inserting in database
    if(empty($virksomhed_err) && empty($emne_err) && empty($klageinfo_err) && empty($dato_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO klager (virksomhed, emne, klageinfo, dato) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_virksomhed, $param_emne, $param_klageinfo, $param_dato);
            
            // Set parameters
            $param_virksomhed = $virksomhed;
            $param_emne = $emne;
            $param_klageinfo = $klageinfo;
            $param_dato = $dato;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
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
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                    <h2 class="mt-5">Tilføj klage</h2>
                    <p>Udfyld for at tilføje klage</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Virksomhed</label>
                            <input type="text" name="virksomhed" class="form-control <?php echo (!empty($virksomhed_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $virksomhed; ?>">
                            <span class="invalid-feedback"><?php echo $virksomhed_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Emne</label>
                            <input type="text" name="emne" class="form-control <?php echo (!empty($emne_err)) ? 'is-invalid' : ''; ?>"><?php echo $emne; ?></textarea>
                            <span class="invalid-feedback"><?php echo $emne_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Klageinfo</label>
                            <textarea name="klageinfo" class="form-control <?php echo (!empty($klageinfo_err)) ? 'is-invalid' : ''; ?>"><?php echo $klageinfo; ?></textarea>
                            <span class="invalid-feedback"><?php echo $klageinfo_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Dato</label>
                            <input type="text" name="dato" class="form-control <?php echo (!empty($dato_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $dato; ?>">
                            <span class="invalid-feedback"><?php echo $dato_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>