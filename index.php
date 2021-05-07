<?php
  $Summary="";
  $error="";
  if(array_key_exists("city",$_GET)){
    $SearchedCity=urlencode($_GET["city"]);
    $urlContents=file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$SearchedCity."&appid=f10fc4aa56749595a456fca6dde7bff5");
    $weatherArray=json_decode($urlContents,true);
    #print_r($weatherArray);
    if($weatherArray['cod']==200){
      $temp_curr=$weatherArray['main']['temp']-273.15;
      $temp_feels_like=$weatherArray['main']['feels_like']-273.15;
      $temp_min=$weatherArray['main']['temp_min']-273.15;
      $temp_max=$weatherArray['main']['temp_max']-273.15;
      $windSpeed=$weatherArray['wind']['speed'];
      $Summary="The Weather in ".$_GET['city']." is currently <strong>'".$weatherArray['weather']['0']['description']."'</strong>.";
      $Summary.="<div class='alert alert-info' role='alert'>&nbsp;&nbsp;&nbsp;&nbsp;<strong>Temperature Details :</strong>
                <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Current : ".$temp_curr."&deg;C
                <br>&nbsp;&nbsp;&nbsp;&nbsp;Feels Like : ".$temp_feels_like."&deg;C
                <br>Minimum : ".$temp_min."&deg;C
                <br>Maximum : ".$temp_max."&deg;C</div>";
      $Summary.="<div class='alert alert-info' role='alert'><strong>Wind Speed : </strong>".$windSpeed." m/s</div>";
    }else{
      $error="The Searched City doesn't exist in the records !";
    }
  }

?>




<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

  <title>Weather Scraper</title>
  <style type="text/css">
   
body { 
  background: url("https://images.unsplash.com/photo-1530908295418-a12e326966ba?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=600&q=60") no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
  .container{
    text-align:center;
  }
  
  </style>

</head>

<body>

    <div class="container" style="width:600px;margin-top:10px;">
      <h1>Welcome to Weather Scraper ! </h1>
      <form>  
        <div class="form-group">
          <label style="color:#6969FF;font-weight:900;font-size:130%;" for="city"><p>Enter the name of a City ?</p></label>
          <input type="text" class="form-control" name="city" id="city" aria-describedby="helpId" placeholder="Ex. London,Tokyo,Delhi,etc" value="<?php 
              if(array_key_exists('city', $_GET)){      
                 echo $_GET['city'];
            } ?>">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <div style="margin-top:20px;">
        <?php 
            if($Summary){              
              echo "<div class='alert alert-success' role='alert'>".$Summary."</div>";
            }else if($error){ 
              echo "<div class='alert alert-danger' role='alert'>".$error."</div>"; 
            }
        ?>
      </div>
    </div>




  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
    crossorigin="anonymous"></script>
    <script type="text/javascript">
      
    </script>
</body>

</html>
