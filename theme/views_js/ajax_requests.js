

    var chkMoneytowords = 'false';
    var referenceCode = (Math.random().toString(36).substr(2, 9)).toUpperCase();
    if ($("#get_Ref_ID").length) {
        $('#get_Ref_ID').val(referenceCode);
    }

    /*New Fund Transfer Request Starts*/
    $('#submitTransferRequest').submit(function(e) {
        e.preventDefault();
        let url = $("#post_url").val();
        let r_type = $("#r_type").val();
        let type = 'POST';
        let formData = new FormData($(this)[0]);

        moneytowordsConfirmed = moneytowords();
        //moneytowordsConfirmed != 'true' ??  : ajaxRequest(url, type, formData)
        if(moneytowordsConfirmed == 'true'){
            ajaxRequest(url, type, formData)
        }
    });
    /*New Fund Transfer Request Ends*/



    
    /*var report_type = '';
    $(document).on('click', '.report_type_btn', function(e) {
        report_type = $(this).attr('report_type');
        toastr.info(report_type);

        if (report_type === 'all_requests') {
            $('.report_title').text('Run Reports For Requests Approved');
            $('.status_flag').val(report_type);
        }
        if (report_type === 'all_approved') {
            $('.report_title').text('Run Reports For Requests Approved');
            $('.status_flag').val(report_type);
        }
        if (report_type === 'all_declined') {
            $('.report_title').text('Run Reports For Transaction');
            $('.status_flag').val(report_type);
        }
        if (report_type === 'all_in_process') {
            $('.report_title').text('Run Reports For Approved Transactions');
            $('.status_flag').val(report_type);
        }

        /*  if(report_type ==='stage_zero'){
             $('.report_title').text('Run Reports For All Declined');
             $('.stage_type').val(report_type);
         }*/

        /*$('#reportsModal').modal('show');
    });*/


    var action_type = '';
    var report_type ='';
    var app_type = $('#app_type_value').val();
    $(document).on('click', '.report_type_btn', function(e){
         report_type = $(this).attr('report_type');
         $('.app_type').val(app_type);
         toastr.info(report_type);

        if(report_type ==='all_requests'){
            $('.report_title').text('Run Reports For Requests Approved');
            $('.status_flag').val(report_type);
        }
        if(report_type ==='all_approved'){
            $('.report_title').text('Run Reports For Requests Approved');
            $('.status_flag').val(report_type);
        }
        if(report_type ==='all_declined'){
            $('.report_title').text('Run Reports For Transaction');
            $('.status_flag').val(report_type);
        }
       if(report_type ==='all_in_process'){
            $('.report_title').text('Run Reports For Approved Transactions');
            $('.status_flag').val(report_type);
        }

        $('#reportsModal').modal('show');
    });




    $(document).on('click', '.comment_btn', function(e) {
        action_type = $(this).attr('action_type');

        if (action_type === 'DECLINE') {
            $("#decline-main").remove();
            $("#decline-selector").append(
                '<div id="decline-main" class="form-group">' +
                '<select name="decline_type" class="form-control custom-select select2" required>' +
                '<option selected value="">Select Decline Type</option>' +
                '<option value="REJECT">Reject For Amendment</option>' +
                '<option value="DECLINE">Decline Request</option>' +
                '</select>' +
                '<br>' +
                '<select name="decline_unit" class="form-control custom-select select2" required>' +
                '<option selected value="">Reject to Selected Unit</option>' +
                '<option value="stage_zero">Reject To CSO</option>' +
                '<option value="stage_one">Reject To BM</option>' +
                '<option value="stage_two">Reject TO CPU</option>' +
                '</select>' +
                '</div>');

            $('.comment_title').text('Decline Request (Add a comment if any)');
        }
        if (action_type === 'REVIEW') {
            $("#decline-main").remove();
            $('.comment_title').text('Review Request (Add a comment if any)');
        }
        if (action_type === 'PROCESS') {
            $("#decline-main").remove();
            $('.comment_title').text('Process Request (Add a comment if any)');
        }
        if (action_type === 'APPROVE') {
            $("#decline-main").remove();
            $('.comment_title').text('Approve Request (Add a comment if any)');
        }

        $('#commentModal').modal('show');
    });


    function appender(attributes_data, t_data) {
        if (attributes_data['name']) {


        }

    }


    // $(document).on('submit', '#updateRequest', function(e){

    $('#updateRequest').submit(function(e) {
        $('#action_type').val(action_type);
        $(this).attr("action", $('#update_url').val());
        let url = $('#update_url').val();
        let type = 'POST';
        let formData = new FormData($(this)[0]);
        $('#commentModal').modal('hide');
        // e.preventDefault();
        // $('#action_type').val(action_type);
        // let url = $('#update_url').val();
        // let type = 'POST';
        // let formData = new FormData($(this)[0]);
        // ajaxRequest(url, type, formData);
        // toastr.success('Request Approved Successfully!');
        // $('#commentModal').modal('hide');


        //// let base_url = $('#base_url').val();
        ////history.go(-2);
        





        // if (action_type === 'DECLINE') {
        //     window.location.replace('http://192.168.1.100/autocheck/workspace/requests/stage_one');
        // }
        // if (action_type === 'REVIEW') {
        //     window.location.replace('http://192.168.1.100/autocheck/workspace/requests/stage_one');
        // }
        // if (action_type === 'PROCESS') {
        //     window.location.replace('http://192.168.1.100/autocheck/workspace/requests/stage_two');
        // }
        // if (action_type === 'APPROVE') {
        //     window.location.replace('http://192.168.1.100/autocheck/workspace/requests/stage_three');
        // }


    });




    function ajaxRequest(url, type, formData) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: 'POST',
            url: url,
            data: formData,
            cache: false,
            contentType: false,
            processData: false,

            beforeSend: function() {
                $('#but_submit').html('Please Wait...');
                $("#but_submit").attr('disabled', false);
            },

            success: (response) => {

                // this.reset();
                console.log(response);

                if (response.type === 'liquidation_approval') {
                    window.location.replace('http://192.168.1.100/autocheck/workspace/deal-liquidation');
                }
                if (response.type === 'fd_approval') {
                    window.location.replace('http://192.168.1.100/autocheck/workspace/fixed-deposit');
                }
                if (response.type ==='transfer_approval') {
                    window.location.replace('http://192.168.1.100/autocheck/workspace/funds-transfer/home');
                }

                if (response.type ==='susu_approval') {
                    window.location.replace('http://192.168.1.100/autocheck/workspace/susu-passbook');
                }
                history.back();
                //window.location.reload();


                /*history.back();*/
            },
            error: function(response) {
                console.log(response);
                // toastr.error('Something Happened.');
                $('#but_submit').html('Please Try Again.');
            }
        });
    }

    function moneytowords(){
        let digits = $('.res').text();
        let words = $('.words').val();
        $('.r').moneyinwords(digits,'US','USD');
        let awords = $('.amount-words-verify').val().trim();
        let adigits = $('.r').text().trim();

        if(awords.toUpperCase().replace(' GHANA','') === adigits.toUpperCase()){
            toastr.success('okay');
            $('.hide-recommendation').hide();
            chkMoneytowords = 'true';
            
        }else{
            $('.awords').val(awords);
            $('.adigits').val(adigits);
            toastr.error('Please, check the fixed deposit amount in words field.');
            $('.hide-recommendation').show();
            $('.recommendation2').text('Try using this words below to confirm with the figures you provided.');
            $('.recommendation').text(adigits.toUpperCase());
            chkMoneytowords = 'false';
            // toastr.info("tttt",adigits);
        }
        return chkMoneytowords;
    }

