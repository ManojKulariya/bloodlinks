jQuery(function($) {
  'use strict';


  $('body').on('change','.donation_time_selection',function(){
    var selected=$("input[type='radio'][name=donation_time_selection]:checked").val();

    if(selected=='today'){
      $('.well_feeling_div').css('display','block');      
    }else{
      $('.well_feeling_div').css('display','none'); 
    }
  });

  $('body').on('change','.has_perm_differ',function(){
  	var selected=$("input[type='radio'][name=has_perm_differ]:checked").val();

  	if(selected=='yes'){
      $('#differs_div .check_box').removeAttr('disabled');  		
  	}else{
  		$('#differs_div .check_box').prop("checked",false);

      $('#differs_div .check_box').prop("disabled",true);
  	}
  });

  $('body').on('change','#differs_div .check_box',function(){


    show_defer_form($(this).data('defer_name'));


  });

  $('body').on('click','#modify_data',function(){
    $('#differs_div .check_box').prop("checked",false);
    $('#differs_div .check_box').prop("disabled",true);
    $('#has_perm_differ_no').prop('checked',true);
    var dt=$(this).attr('data-tochange');
    console.log(dt);
    $('#'+dt).prop('checked',true);
  });


  $('body').on('change','.has_safe_sex',function(){
    var selected=$("input[type='radio'][name=has_safe_sex]:checked").val();

    if(selected==='no'){
      show_defer_form($(this).data('defer_name'),$(this).data('id_name'));
      
    }
  });

  $('body').on('change','.has_hiv_positive',function(){
    var selected=$("input[type='radio'][name=has_hiv_positive]:checked").val();

    if(selected==='yes'){
      show_defer_form($(this).data('defer_name'),$(this).data('id_name'));
    }
  });

  $('body').on('change','.has_sex_with_money',function(){
    var selected=$("input[type='radio'][name=has_sex_with_money]:checked").val();

    if(selected==='yes'){
      show_defer_form($(this).data('defer_name'),$(this).data('id_name'));
    }
  });

  $('body').on('change','.has_multiple_sex_partner',function(){
    var selected=$("input[type='radio'][name=has_multiple_sex_partner]:checked").val();

    if(selected==='yes'){
      show_defer_form($(this).data('defer_name'),$(this).data('id_name'));
    }
  });


  $('body').on('change','.has_consider_self_safe_transfusion',function(){
    var selected=$("input[type='radio'][name=has_consider_self_safe_transfusion]:checked").val();

    if(selected==='no'){
      show_defer_form($(this).data('defer_name'),$(this).data('id_name'));
    }
  });

  $('body').on('change','.has_thinking_above_questions_true',function(){
    var selected=$("input[type='radio'][name=has_thinking_above_questions_true]:checked").val();

    if(selected==='yes'){
      show_defer_form($(this).data('defer_name'),$(this).data('id_name'));
    }
  });

  $('body').on('change','.has_injected_drugs',function(){
    var selected=$("input[type='radio'][name=has_injected_drugs]:checked").val();

    if(selected==='yes'){
      show_defer_form($(this).data('defer_name'),$(this).data('id_name'));
    }
  });


  $('body').on('change','.has_sexually_transmitted_disease',function(){
    var selected=$("input[type='radio'][name=has_sexually_transmitted_disease]:checked").val();

    if(selected==='yes'){
      show_defer_form($(this).data('defer_name'),$(this).data('id_name'));
    }
  });


  $('body').on('change','.has_multiple_sex_partner',function(){
    var selected=$("input[type='radio'][name=has_multiple_sex_partner]:checked").val();

    if(selected==='yes'){
      show_defer_form($(this).data('defer_name'),$(this).data('id_name'));
    }
  });


  $('body').on('change','.has_sex_with_stranger',function(){
    var selected=$("input[type='radio'][name=has_sex_with_stranger]:checked").val();

    if(selected==='yes'){
      show_defer_form($(this).data('defer_name'),$(this).data('id_name'));
    }
  });

  $('#modifyModal').on('hidden.bs.modal', function () {
    $('#modifyModal').find('#modify_data').removeAttr('data-tochange');
  });


  $('body').on('change','.has_recent_difers',function(){
    var selected=$("input[type='radio'][name=has_recent_difers]:checked").val();

    if(selected=='yes'){
      $('#recent_differs_div .check_box').removeAttr('disabled');      
    }else{
      $('#recent_differs_div .check_box').prop("checked",false);
      $('#recent_differs_div .check_box').prop("disabled",true);
    }
  });

  $('body').on('change','.has_prev_donation',function(){
    var selected=$("input[type='radio'][name=has_prev_donation]:checked").val();

    if(selected=='yes'){
      $('#prev_donation').css('display','block');
    }else{
      $('#prev_donation').css('display','none');
    }
  });


  $('body').on('change','.has_general_differs',function(){
    var selected=$("input[type='radio'][name=has_general_differs]:checked").val();

    if(selected=='yes'){
      $('#general_differs_div .check_box').removeAttr('disabled');      
    }else{
      $('#general_differs_div .check_box').prop("checked",false);
      $('#general_differs_div .check_box').prop("disabled",true);
    }
  });



  $('body').on('change','.has_taken_medicines',function(){
    var selected=$("input[type='radio'][name=has_taken_medicines]:checked").val();

    if(selected=='yes'){
      $('#medicines_div .check_box').removeAttr('disabled');      
    }else{
      $('#medicines_div .check_box').prop("checked",false);
      $('#medicines_div .check_box').prop("disabled",true);
    }
  });


  $('body').on('change','.has_vaccinated',function(){
    var selected=$("input[type='radio'][name=has_vaccinated]:checked").val();

    if(selected=='yes'){
      $('#vaccines_div .check_box').removeAttr('disabled');      
    }else{
      $('#vaccines_div .check_box').prop("checked",false);
      $('#vaccines_div .check_box').prop("disabled",true);
    }
  });


  $('body').on('change','.has_last_2_week_differs',function(){
    var selected=$("input[type='radio'][name=has_last_2_week_differs]:checked").val();

    if(selected=='yes'){
      $('#last_2_week_differs_div .check_box').removeAttr('disabled');      
    }else{
      $('#last_2_week_differs_div .check_box').prop("checked",false);
      $('#last_2_week_differs_div .check_box').prop("disabled",true);
    }
  });


  $('body').on('change','.has_last_3_month_differs',function(){
    var selected=$("input[type='radio'][name=has_last_3_month_differs]:checked").val();

    if(selected=='yes'){
      $('#last_3_month_differs_div .check_box').removeAttr('disabled');      
    }else{
      $('#last_3_month_differs_div .check_box').prop("checked",false);
      $('#last_3_month_differs_div .check_box').prop("disabled",true);
    }
  });


  $('body').on('change','.has_last_12_month_differs',function(){
    var selected=$("input[type='radio'][name=has_last_12_month_differs]:checked").val();

    if(selected=='yes'){
      $('#last_12_month_differs_div .check_box').removeAttr('disabled');      
    }else{
      $('#last_12_month_differs_div .check_box').prop("checked",false);
      $('#last_12_month_differs_div .check_box').prop("disabled",true);
    }
  });

  load_forms('step_1');

  // $('body').on('click','#next_form',function(){
  //   var form_type=$(this).data('form_type');
  //   load_forms(form_type);
  //   jQuery('html,body').animate({scrollTop:500},0);   
  // });

  $('body').on('click','#prev_form',function(){
    var form_type=$(this).data('form_type');
    load_forms(form_type);    
  });


  

});
 // $('body').on('click','#prev_form',function(){
 //    var form_type=$(this).data('form_type');
 //    load_forms(form_type);    
 //  });
function show_defer_form(reason,datatochange=''){

      var demsg='<div class="alert alert-danger">Sorry you are not eligible to donate blood for the following reason:<b>'+reason+'</b><br>You can refer someone else to donate blood.</div>';

      if(datatochange!=''){
        $('#modifyModal').find('#modify_modal_msg').html(demsg);
        $('#modifyModal').find('#modify_data').attr('data-tochange',datatochange);
      }else{
        $('#modifyModal').find('#modify_modal_msg').html(demsg);
      }


      $('#modifyModal').modal('show');

}

function load_forms(form_type){

    $.ajax({
      type:'POST',
      url:form_load_url,
      data:{[csrf_name]:csrf_hash,form_type:form_type},
      success:function(d){

        $('#step_forms').html(d.html);
      }
    });
  }