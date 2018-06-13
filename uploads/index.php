
<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Set Wet</title>
    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="https://setwetnepal.com/playinstyle/content_home/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://setwetnepal.com/playinstyle/content_home/css/fa-brands.min.css">
    <link rel="stylesheet" href="https://setwetnepal.com/playinstyle/content_home/css/stylesheet.css">
    <link rel="stylesheet" href="https://setwetnepal.com/playinstyle/content_home/css/style.css">
</head>

<body class="mnemonicpage">          
<div id="banner"><img src="https://setwetnepal.com/playinstyle/content_home/images/banner.png" width="100%"></div>

<!-- body start -->
<div class="container">
    <div class="row">
                <div class="container first">
  <div class="row">
    <div class="col-md-12">
      <div class="home h-right terms">
      <div>
        <div class="form-group text-center mnemonic">
          <p>Do you think you are a hreat football fan with extraordinary knowledge ?</p>
          <a href="https://www.setwetnepal.com/playinstyle">TEST IT HERE</a>
          <p>& provide yourself a change to win fabulous prizes.</p>          
        </div>
      </div>
    </div>
    </div>
  </div>
</div>    </div>
</div>
<!-- body end -->


<footer>
  <p>&copy; 2018 by SETWET Nepal. All Rights Reserved.</p>
</footer>
<script src="https://setwetnepal.com/playinstyle/content_home/js/jquery-1.12.1.min.js"></script>
<script src="https://setwetnepal.com/playinstyle/content_home/js/bootstrap.min.js"></script>

<script>
    function selectCountry() {
        var firstcountryname = $(".firstcountry option:selected").text();
        var secoundcountryname = $(".secondcountry option:selected").text();

       if(firstcountryname!="Select Country"){
           $('#firstcountryname').empty();
           $('#firstcountryname').append(firstcountryname);
       }
        if(secoundcountryname!="Select Country"){
            $('#secoundcountryname').empty();
            $('#secoundcountryname').append(secoundcountryname);
        }

        var firstcountryid = $(".firstcountry option:selected").val();
        var secoundcountryid = $(".secondcountry option:selected").val();
        var url = 'https://setwetnepal.com/playinstyle/getselectecountry';

        $.ajax({
            url: url,
            data: {firstcountryname:firstcountryname,firstcountry:firstcountryid ,secoundcountryname:secoundcountryname, secoundcountry:secoundcountryid },
            type:'POST',

            success:function(data){
                console.log(data);
                $('.returncountry').empty();
                $('.returncountry').append(data);
            }
        });


    }

</script></body>
</html>