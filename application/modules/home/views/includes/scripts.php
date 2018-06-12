<script src="<?php echo base_url(); ?>content_home/js/jquery-1.12.1.min.js"></script>
<script src="<?php echo base_url(); ?>content_home/js/bootstrap.min.js"></script>

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
        var url = '<?php echo base_url('getselectecountry');?>';

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

</script>