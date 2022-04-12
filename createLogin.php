<?php
// Include config file
require "config.php";
 
// Define variables and initialize with empty values
$virksomhed = $brugernavn = $kode = $ansvarlig = "";
$virksomhed_err = $brugernavn_err = $kode_err = $ansvarlig_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate virksomhed
    $input_virksomhed = trim($_POST["virksomhed"]);
    if(empty($input_virksomhed)){
        $virksomhed_err = "Skriv virksomhed";
    } else{
        $virksomhed = $input_virksomhed;
    }
    
    // Validate brugernavn
    $input_brugernavn = trim($_POST["brugernavn"]);
    if(empty($input_brugernavn)){
        $brugernavn_err = "Skriv brugernavn";     
    } else{
        $brugernavn = $input_brugernavn;
    }

    // Validate kode
    $input_ansvarlig = trim($_POST["kode"]);
    if(empty($input_ansvarlig)){
        $kode_err = "Skriv kode";     
    } else{
        $kode = $input_ansvarlig;
    }
    
    // Validate ansvarlig
    $input_dato = trim($_POST["ansvarlig"]);
    if(empty($input_dato)){
        $ansvarlig_err = "skriv ansvarlig";    
    } else{
        $ansvarlig = $input_dato;
    }
    
    // Check input errors before inserting in database
    if(empty($virksomhed_err) && empty($brugernavn_err) && empty($kode_err) && empty($ansvarlig_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO login (virksomhed, brugernavn, kode, ansvarlig) VALUES (?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_virksomhed, $param_brugernavn, $param_kode, $param_ansvarlig);
            
            // Set parameters
            $param_virksomhed = $virksomhed;
            $param_brugernavn = $brugernavn;
            $param_kode = $kode;
            $param_ansvarlig = $ansvarlig;
            
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
                    <h2 class="mt-5">Tilføj Login</h2>
                    <p>Udfyld for at tilføje Login</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Virksomhed</label>
                            <input type="text" name="virksomhed" class="form-control <?php echo (!empty($virksomhed_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $virksomhed; ?>">
                            <span class="invalid-feedback"><?php echo $virksomhed_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Brugernavn</label>
                            <input type="text" name="brugernavn" class="form-control <?php echo (!empty($brugernavn_err)) ? 'is-invalid' : ''; ?>"><?php echo $brugernavn; ?></textarea>
                            <span class="invalid-feedback"><?php echo $brugernavn_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Kode</label>
                            <textarea name="kode" class="form-control <?php echo (!empty($kode_err)) ? 'is-invalid' : ''; ?>"><?php echo $kode; ?></textarea>
                            <span class="invalid-feedback"><?php echo $kode_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Ansvarlig</label>
                            <input type="text" name="ansvarlig" class="form-control <?php echo (!empty($ansvarlig_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $ansvarlig; ?>">
                            <span class="invalid-feedback"><?php echo $ansvarlig_err;?></span>
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