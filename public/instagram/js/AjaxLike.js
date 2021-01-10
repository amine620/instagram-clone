
$(document).ready(function(){

    $('#heart').click(function(e){
        e.preventDefault()
           $.ajax({
               method:'post',
               url:'/like',
               headers: {
                           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                       },
               data:{
                   post_id:$('.hidden').val()
               },
               dataType:'json',
               error:function(XMLHttpRequest, textStatus, errorThrown){
                   if(XMLHttpRequest.statusText=='OK')
                   {
                           isOk(true)
                   }
               },
           
           })

           function isOk(response)
           {
                if(response)
                {
                    if($('#heart').hasClass('fa fa-heart'))
                    {
                        $('.fa-heart').hide()
                    }
                   else 
                    {
                       $('#button').val('unfollow');

                    }
                   
                }
           }

    })

})