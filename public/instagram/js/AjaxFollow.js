
$(document).ready(function(){

     $('#button').click(function(e){
         e.preventDefault()
            $.ajax({
                method:'post',
                url:'/follow',
                headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                data:{
                    user_id:$('.hidden').val()
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
                     if($('#button').val()=='unfollow')
                     {
                         $('#button').val('follow')
                     }
                    else 
                     {
                        $('#button').val('unfollow');

                     }
                    
                 }
            }

     })




     



})