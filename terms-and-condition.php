
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

<body>
          
<div id="banner"><a href="https://setwetnepal.com/playinstyle/dashboard"> <img src="https://setwetnepal.com/playinstyle/content_home/images/banner.png" width="100%"></a> </div>

<!-- body start -->
<div class="container">
    <div class="row">
                <div class="container first">
  <div class="row">
    <div class="col-md-12">
      <div class="home h-right terms">
      <div class="up">
        <h3>TERMS & CONDITIONS</h3>
      </div>
      <div class="down">
        <div class="form-group">
          <p>Following Terms & Conditions are applicable to all the candidates those who wants to participate in the contest.</p>
          <ol>
            <li>This contest is brought to you by SetWet Nepal and is open for all Nepalese nationals staying in Nepal.</li>
            <li>The contest will run from 13th of June to 15th July.</li>
            <li><strong>How to participate:</strong><br>You need to register by filling a form through our official website to be a valid participant in this contest, where you will find 3 different contests:<br>
            a) Match Day Contest: <br>
            • Participants should provide their answer for questions (only one time) before the each match begins.<br>
            • Answers after the match won't be considered/valid.<br>
            • Points will awarded with each right answer.<br>

            b) Knockout Contest:<br>
            • Participants have to answer the questions (only one time) before the end of Quarter finals.
            •   Answers after the Quarter finals won't be considered/valid.<br>
            • Points will be provided as per right answer.<br>

            c) Test Your Football Knowledge Contest: <br>
            • This contest will be accessible from 14th June to the final game.<br>
            • Participants have to answer the questions (only one time) before the end of final match.<br>
            • Total 120 No. of questions will be published throughout the period.<br>
            • Questions will be related to previous World Cups.<br>
            • Points will be provided as per right answer.<br>
            </li>
            <li>With each correct answer, you will gain points.</li>
            <li>You can regularly check your score in our website from your registered ID at any time you want.</li>
            <li>Participants should visit our Facebook page to know the leading board which will publish in certain intervals only.</li>
            <li>Top 10 winners will be selected through following basis:<br>
            • Phase 1: The participant with the highest pointed earned in all 3 contest will be declared the winner.<br>
            • Phase 2: Incase of tie/draw between 2 or participants, we will do lucky draw to select the winners.</li>
            <li>a) The Winner will win a laptop.<br>
            b) The 1st Runner up will win a Smart TV.<br>
            c) The 2nd Runner up will win a Smart phone.<br>
            d) The remaining 7 from Top 10 winners will win branded football.<br>
            e) Top 50 participants will win SetWet gift hamper.</li>
            <li>The winners must collect their prizes within 10days after the winner announcement. If the gift did not collect within that period, it will not be valid and company will not be liable to give gift thereafter.</li>
            <li>Winners must inbox their contact details to Set Wet Nepal Facebook page after the declaration of winning through a post in Set Wet Nepal Facebook page.Winners will be announce after the end of the Final Match.</li>
            <li>The Winners and participants must visit Digbijay Complex 6th floor (Opposite of Rio Apartment), Jwagal, Lalitpur within 10 days (From 11 am to 4 pm - Map: http://bit.ly/Digitalin-Location) to collect your gift. In case if the winner is not from Kathmandu and unable to visit, s/he must nominate somebody by sending their details on our Facebook Page to collect their prizes on their behalf with a valid ID of the winner as well as the receiver.</li>
            <li>The prizes are non-transferable, non-exchangeable and non-redeemable for cash.</li>
            <li>SetWet Nepal may use the picture of the winners and participants with the prize/gift taken at the time of collecting the prize/gift for any promotional/ marketing purpose of the company.</li>
            <li>Any tax or other liabilities or charges payable to the government or any other authority or any, which may arise or accrue to the winner as a result of winning the prize, shall be borne byWinners.</li>
            <li>Employees of SetWetNepal, Agency and SetWet Dealers are not eligible to participate in the contest.</li>
            <li>SetWet reserves the right to change their decision at any time and it shall be final and binding with respect to the contest.</li>
            <li>SetWet Nepal reserves the right to alter/withdraw the contest at any time without prior intimation, including the right to amend, cancel, or withdraw in part or full all the conditions of this contest.</li>
            <li>Any post or comment that are false, defamatory, inaccurate, abusive will be deleted immediately with no clarification given by the company.</li>
            <li>Any dispute arising on account of the above contest would fall under the jurisdiction of Nepal courts only.This offer is subject to Force Majeure.</li>
            <li>Participation in this contest implies acceptance of all the terms and conditions mentioned herein.</li>
            <li>For further details you may send in your queries to our Inbox.</li>
          </ol>
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