<script src="<?php echo base_url(); ?>content_home/js/jquery-1.12.1.min.js"></script>
<script src="<?php echo base_url(); ?>content_home/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>content_admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>content_admin/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script type="text/javascript" charset="utf-8">
/*$(document).ready(function(){
    $("area[rel^='prettyPhoto']").prettyPhoto();
});*/
/*$(function () {
    $('.user_register').DataTable({
      "lengthMenu": [[ 50, 100, -1], [50,100, "All"]],
      "order": [[ 3, 'desc' ]],
    });
});*/ 

$(document).ready(function() {
    /*$('.user_register').DataTable( {
        "order": [[ 2, 'desc' ]],
        "lengthMenu": [[ 10, 25, 50, 100, -1], ['Top 10','Top 25','Top 50','Top 100', "All"]]
    } );*/
    $('.user_register').DataTable( {
        "order": [[ 2, 'desc' ]],
        "lengthMenu": [[ 50, 100, -1], ['Top 50','Top 100', "All"]]
    } );
} );
</script>
<script>
    function showhide(parameter){
        //alert(parameter);
        if(parameter=='group_stage'){
            $("#group_stage").fadeToggle();;
        }
        if(parameter=='round_of_16'){
            $("#round_of_16").fadeToggle();
        }
    }
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


        if(!$('.secondcountry').find("option:contains('" + firstcountryid  + "')").length){
            $(".secondcountry option").removeAttr("disabled","disabled");
            $(".secondcountry option[value=" + firstcountryid + "]").attr("disabled","disabled");
        }

        if(!$('.firstcountry').find("option:contains('" + secoundcountryid  + "')").length){
            $(".firstcountry option").removeAttr("disabled","disabled");
            $(".firstcountry option[value=" + secoundcountryid + "]").attr("disabled","disabled");
        }


        var url = '<?php echo base_url('getselectecountry');?>';

        $.ajax({
            url: url,
            data: {firstcountryname:firstcountryname,firstcountry:firstcountryid ,secoundcountryname:secoundcountryname, secoundcountry:secoundcountryid },
            type:'POST',

            success:function(data){
                $('.returncountry').empty();
                $('.returncountry').append(data);
            }
        });


    }

    function handleClick(myRadio) {
        var firstteam = myRadio.value;
        var url = '<?php echo base_url('getfirstteamplayer');?>';
//        alert('Selected Team: ' + selCountry);

        $.ajax({
           url: url,
            data: {firstteam:firstteam },
            type : 'POST',
            success: function(data){
                $('.firstteamplayer').empty();
                $('.firstteamplayer').append(data);
            }
        });
    }

    function bestplayer(){
        var bestcountryid = $(".bestplayercountry option:selected").val();
        var url = '<?php echo base_url('getfirstteamplayer');?>';

        $.ajax({
            url: url,
            data: {firstteam:bestcountryid },
            type : 'POST',
            success: function(data){
                //console.log(data);
                $('.bestplayer').empty();
                $('.bestplayer').append(data);
            }
        });


    }

    function highestscore(){
        var highestcountryid = $(".highestscorecountry option:selected").val();

        var url = '<?php echo base_url('getfirstteamplayer');?>';

        $.ajax({
            url: url,
            data: {firstteam:highestcountryid },
            type : 'POST',
            success: function(data){
                //console.log(data);
                $('.highestscore').empty();
                $('.highestscore').append(data);
            }
        });
    }
</script>