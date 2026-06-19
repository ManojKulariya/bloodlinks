 jQuery(function($) {
  'use strict';

  var arrayData = [];
  var arrayData2 = [];
  var joined_val='';
  var base_url ="http://bloodlinks.in/";
   //alert(base_url);
   //return false;
  arrayData=ans.split(',');

//alert(arrayData);
      // console.warn('aa',arrayData);

  console.log(ans);

  $('body').on('change','.rad-input',function(){
    joined_val=$("input[type='radio']:checked").map(function() {
        return this.value;
    }).get().join(', ');

    arrayData2=joined_val.split(',');

    if(arrayData.length===arrayData2.length){
      $('.continueRegisterationBtn').removeClass('disabledContinue');
      $('.continueRegisterationBtn').prop('disabled',false)
    }

  });

 $('body').on('click','.continueRegisterationBtn',function(){
    joined_val=$("input[type='radio']:checked").map(function() {
        return this.value;
    }).get().join(',');

    //arrayData2=joined_val.split(',');
    console.log(joined_val);
    if(ans===joined_val){
      location.href = base_url+"register";
      return false;
      // $('#continueToRegModal').modal('show');
    }else{
      $('#notcontinueToRegModal').modal('show');
    }
  });
 
});