
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('contents')
        }
    });


    var setChecker = null;

    $("#btn-verify").click(function(e){
       // e.preventDefault();
        //var _token   = $('meta[name="csrf-token"]').attr('contents');

        var orderingAccount = $("input[name=ordering_account]").val();
        var getReferenceCode = $(".ref_id").val()
        //var VerificationURL = 'checkVerification/'+referenceCode;

        var matchURL = 'http://192.168.1.100/fingerprint/scan/_u.php?account_number='+orderingAccount+'&reference_code='+getReferenceCode
        //alert(orderingAccount+' ----- '+referenceCode );

        $.ajax({
           type:'GET',
           url:"{{ route('getUserInfo') }}",
           data:{orderingAccount:orderingAccount,referenceCode:getReferenceCode},
           success:function(data){
              //alert(matchURL);
              window.open(matchURL,'popUpWindow','height=600,width=1200,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
              setChecker = setInterval(checkVerification,3000,getReferenceCode);
              setTimeout(stopVerification,120000);
           }
        });

    });

    $("#b-btn-verify").click(function(e){
        // e.preventDefault();
         //var _token   = $('meta[name="csrf-token"]').attr('contents');

         var beneficiaryAccount = $("#beneficiary_account").val();
         var getReferenceCode2 = $(".ref_id").val()
         var VerificationURL2 = 'http://192.168.1.100/autocheck/getBeneficiaryInfo/'+getReferenceCode2;

         var matchURL = 'http://192.168.1.100/fingerprint/scan/_u.php?account_number='+beneficiaryAccount+'&reference_code='+getReferenceCode2;
         //alert(orderingAccount+' ----- '+referenceCode );

         $.ajax({
            type:'GET',
            url:VerificationURL2,
            data:{beneficiaryAccount:beneficiaryAccount,referenceCode:getReferenceCode2},
            success:function(data){
               var response = JSON.parse(data);
               //alert(response.responseCode);

            $('img#BPhoto').attr('src', 'data:image/jpeg;base64,'+response.b_photo);
            $('img#BSig').attr('src', 'data:image/jpeg;base64,'+response.b_signature);
            $("#beneficiary_name").val(response.b_customer_name)

             //   window.open(matchURL,'popUpWindow','height=600,width=1200,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no, status=yes');
             //   setChecker = setInterval(checkVerification,3000,getReferenceCode);
             //   setTimeout(stopVerification,120000);
            }
         });

     });

    function checkVerification(refCode){
        $.ajax({
            type: 'GET',
            url: "http://192.168.1.100/autocheck/checkVerification/"+refCode,
            success: function(response){
               response = JSON.parse(response);
                // Perform operation on the return value
                if(response.responseCode == '000' ){
                    clearInterval(setChecker);
                    console.log(response.matched);
                    $('img#OPhoto').attr('src', 'data:image/jpeg;base64,'+response.photo);
                    $('img#OSig').attr('src', 'data:image/jpeg;base64,'+response.signature);
                    $("#ordering_by").val(response.customerName)
                }else{
                    console.log(response.responseCode);
                }
            }
        });
    }

    function stopVerification() {
        clearInterval(setChecker);
    }