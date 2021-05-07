<?php
  $Summary="";
  $error="";
  if(array_key_exists("city",$_GET)){
    $SearchedCity=str_replace(" ","",$_GET["city"]);
    $file_headers = @get_headers("http://www.weather-forecast.com/locations/".$SearchedCity."/forecasts/latest");
  #  $url="http://completewebdevelopercourse.com/locations/".$SearchedCity;
  #  $headers = @get_headers($url);
  #  if($headers[0] == 'HTTP/1.1 404 Not Found'){
    if($file_headers[18] == 'HTTP/1.0 404 Not Found') {
      $error="The Searched City is Out of Records!!";
    }else{      
     # $externalSource=file_get_contents($url);
     # $Reqd=explode('<span class="read-more-small"><span class="read-more-content"> <span class="phrase">',$externalSource);
      $forecastPage = file_get_contents("https://www.weather-forecast.com/locations/".$SearchedCity."/forecasts/latest");
      $pageArr = explode('(1–3 days)</div><p class="b-forecast__table-description-content"><span class="phrase">', $forecastPage);
      if(sizeof($pageArr)>1){
        # $Required=explode("</span></span></span>",$Reqd[1]);
        $secondPageArr = explode('</span></p></td><td class="b-forecast__table-description-cell--js" colspan="9">', $pageArr[1]);
        if(sizeof($secondPageArr)>1){
         # $Summary=$Required[0];
          $Summary=$secondPageArr[0];
        }else{
          $error="Page Could Not be found!!";
        }
      }else{
        $error="Page Could Not be found!!";
      }      
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

    <div class="container" style="width:600px;margin-top:120px;">
      <h1>Welcome to Weather Scraper ! </h1>
      <form>  
        <div class="form-group">
          <label style="color:#FFFFFF;font-weight:900;font-size:130%;" for="city"><p>Enter the name of a City ?</p></label>
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
              echo "<div class='alert alert-info' role='alert'>".$Summary."</div>";
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