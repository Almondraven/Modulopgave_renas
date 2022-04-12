<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper{
            width: 600px;
            margin: 30px;
        }
        table tr td:last-child{
            width: 120px;
        }
    </style>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Klage oversigt</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tilføj ny klage</a>
                    </div>
                    <?php
                    // Include config file
                    require "config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM klager";
                    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Virksomhed</th>";
                                        echo "<th>Emne</th>";
                                        echo "<th>Dato</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['id'] . "</td>";
                                        echo "<td>" . $row['virksomhed'] . "</td>";
                                        echo "<td>" . $row['emne'] . "</td>";
                                        echo "<td>" . $row['dato'] . "</td>";
                                        echo "<td>";
                                            echo '<a href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                            
                                            echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    ?>
                </div>
            </div>
            
            </br>
                    <?php
            $searchErr = '';
            $klagedetaljer='';
            if(isset($_POST['save']))
            {
                if(!empty($_POST['search']))
                {
                    $search = $_POST['search'];
                    $stmt = $con->prepare("select * from klager where virksomhed like '%$search%' or id like '%$search%' or dato like '%$search%'");
                    $stmt->execute();
                    $klagedetaljer = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    
                    
                }
                else
                {
                    $searchErr = "Please enter the information";
                }
            
            }
            
            ?>
            <br/>
            <br/>
            <h2 class="pull-left">Klage søgning</h2>
            <br/><br/>
            <form class="form-horizontal" action="#" method="post">
                           
              <div class="form-group">
                <label class="control-label col-md-6" for="email"><b>Søg efter klage</b>:</label>
                   <div class="col-sm-4">
                     <input type="text" class="form-control" name="search" placeholder="søg">
                   </div>
                   <br/>
                   <div class="col-md-2">
                     <button type="submit" name="save" class="btn btn-success btn-md">Submit</button>
                   </div>
              </div>
            </form>
            <h4>Søgeresultat</h4><br/>
            <div class="table-responsive">          
              <table class="table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Virksomhed</th>
                    <th>Emne</th>
                    <th>Dato</th>
                  </tr>
                </thead>
                <tbody>
                        <?php
                         if(!$klagedetaljer)
                         {
                            echo '<tr>Søgning gav ingen resultater</tr>';
                         }
                         else{
                            foreach($klagedetaljer as $key=>$value)
                            {
                                ?>
                            <tr>
                                <td><?php echo $key+1;?></td>
                                <td><?php echo $value['virksomhed'];?></td>
                                <td><?php echo $value['emne'];?></td>
                                <td><?php echo $value['dato'];?></td>
                            </tr>
                                 
                            <?php
                            }
                             
                         }
                        ?>
                     
                 </tbody>
              </table>
            </div>
            <script src="jquery-3.2.1.min.js"></script>
            <script src="bootstrap.min.js"></script>
            </br>
            <h2 class="pull-left">Relevante wireframes</h2>
            </br>
            </br>
            <img src="https://i.imgur.com/PCuiV5U.jpg" alt="Wireframe for opret ny klage" width="350">        
        </div> 
    </div>

<!---------------------------------------------------------------------------------------------------------------------------------------->
<!rengøringstabel opdeling>

    <hr style="height:5px; border:none; background-color:#333;" />


<!---------------------------------------------------------------------------------------------------------------------------------------->
    
    <?php
    $searchErr = '';
    $klagedetaljer='';
    if(isset($_POST['save']))
    {
        if(!empty($_POST['search']))
        {
            $search = $_POST['search'];
            $stmt = $con->prepare("select * from rengøringsplan where virksomhed like '%$search%' or ansvarlig like '%$search%' or dato like '%$search%'");
            $stmt->execute();
            $klagedetaljer = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //print_r($klagedetaljer);
            
        }
        else
        {
            $searchErr = "Please enter the information";
        }
    
    }
    
    ?>
    <br/>
    <br/>
    <div class="container">
    <h2>Rengøringsplan</h2>
    <br/><br/>
    <form class="form-horizontal" action="#" method="post">
        <div class="form-group">
            <label class="control-label col-md-4" for="email"><b>Søg efter rengøringsplan</b>:</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="search" placeholder="søg">
            </div>
            <br/>
            <div class="col-md-2">
              <button type="submit" name="save" class="btn btn-success btn-md">Submit</button>
            </div>
        </div>
    </form>
    <br/><br/>
    <h3><u>Search Result</u></h3><br/>
    <div class="table-responsive">          
      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Dato</th>
            <th>Virksomhed</th>
            <th>Opgaver</th>
            <th>Ansvarlig</th>
          </tr>
        </thead>
        <tbody>
                <?php
                 if(!$klagedetaljer)
                 {
                    echo '<tr>No data found</tr>';
                 }
                 else{
                    foreach($klagedetaljer as $key=>$value)
                    {
                        ?>
                    <tr>
                        <td><?php echo $key+1;?></td>
                        <td><?php echo $value['dato'];?></td>
                        <td><?php echo $value['virksomhed'];?></td>
                        <td><?php echo $value['opgaver'];?></td>
                        <td><?php echo $value['ansvarlig'];?></td>
                    </tr>
                         
                    <?php
                    }
                     
                 }
                ?>
             
         </tbody>
      </table>
    </div>
    </div>
    <script src="jquery-3.2.1.min.js"></script>
    <script src="bootstrap.min.js"></script>

<!---------------------------------------------------------------------------------------------------------------------------------------->
<!login opdeling>

    <hr style="height:5px; border:none; background-color:#333;" />


<!---------------------------------------------------------------------------------------------------------------------------------------->
<div class="wrapper">
    <div class="container">    
        <div class="row">
            <div class="col-md-12">
                <div class="mt-5 mb-3 clearfix">
                    <h2 class="pull-left">Login oversigt</h2>
                    <a href="createLogin.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Tilføj nyt login</a>
                </div>
                <?php
                
                // Attempt select query execution
                $sql = "SELECT * FROM login";
                if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>Virksomhed</th>";
                                    echo "<th>Brugernavn</th>";
                                    echo "<th>Kode</th>";
                                    echo "<th>ansvarlig</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                    echo "<td>" . $row['virksomhed'] . "</td>";
                                    echo "<td>" . $row['brugernavn'] . "</td>";
                                    echo "<td>" . $row['kode'] . "</td>";
                                    echo "<td>" . $row['ansvarlig'] . "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";                            
                        echo "</table>";
                        // Free result set
                        mysqli_free_result($result);
                    } else{
                        echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                    }
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }
                // Close connection
                mysqli_close($link);
                ?>
            </div>
        </div>
    </div> 
</div>
</body>
</html>
