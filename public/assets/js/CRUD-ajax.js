$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN':document.head.querySelector('meta[name="csrf-token"]').content,
    }
})

$('#add_task').on('click', function(event) {


    event.preventDefault()
    removeInvalidErrorsInBox( $('#modal_task'))
    $('#title').text(' ')
    $('[name=modal-btn]').text(' ')
    $('#btn_modal')[0].setAttribute('operate',' ')
    $('#btn_modal').removeClass(' btn-success')
                    .removeClass(' btn-primary')
    $('[name=priority]').val( 'choose')
    $('[name=status]').val('choose')
    $('[name=description]').val('')
    $('[name=expiration]').val('')
    $('[name=title]').val('')
    $('[name=expiration]').val('')



    $('#title').text('ایجاد')
    $('[name=modal-btn]').text('افزودن')
    $('#btn_modal')[0].setAttribute('operate','store')
    $('#btn_modal').addClass('btn btn-success')

    $('#modal_task').modal('show');

})

$('[name = edit_task]').on('click', function(event) {


    event.preventDefault();
    removeInvalidErrorsInBox( $('#modal_task'))

    $('#title').text(' ')
    $('[name=modal-btn]').text(' ')
    $('#btn_modal')[0].setAttribute('operate',' ')
    $('#btn_modal').removeClass('btn btn-success')
    $('#btn_modal').removeClass('btn btn-primary')
    $('[name=priority]').val( 'choose')
    $('[name=status]').val('choose')
    $('[name=description]').val('')
    $('[name=expiration]').val('')
    $('[name=title]').val('')
    $('[name=expiration]').val()

    const target =$(event.currentTarget)
    $('#title').text('ویرایش')
    $('[name=modal-btn]').text('بروزرسانی')
    $('#btn_modal')[0].setAttribute('operate','update')
    $('#btn_modal').removeClass('btn btn-success')
    $('#btn_modal').addClass('btn btn-primary')
    $('[name=priority]').val(target.attr('priority'))
    $('[name=status]').val(target.attr('status'))
    $('[name=description]').val(target.attr('description'))
    $('[name=title]').val(target.attr('title'))
    $('[name=expiration]').val(target.attr('expiration'))
    $('#task_id').val(target.attr('task-id'))



    $('#modal_task').modal('show');

})
$('[name = delete_task]').on('click', function(event) {
    Swal.fire({
        title: "اخطار ",
        text: "وظیفه حذف شود؟ ",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#e83e3e",
        confirmButtonText: " حذف",
        cancelButtonText: " لغو",

    }).then((result) => {

            if (result['value']==true) {

                $.ajax({
                    dataType: 'JSON',
                    type: 'DELETE',
                    url: "api/tasks/" + $(event.currentTarget).attr('task-id'),
                    success: (response) => {

                        Livewire.dispatch('LoadPage')

                        Swal.fire({
                            title: "موفق ",
                            text: "وظیفه جدید ثبت شد ",
                            icon: "info",
                            confirmButtonText: "متوجه شدم",

                        })

                    },
                    error: function (response) {
                        console.log(response)

                    }
                });
            }


    });

})

$('#btn_modal').on('click',function (event){

    event.preventDefault()


    removeInvalidErrorsInBox( $('#modal_task'))
    var isInputsValid=true;
    isInputsValid =  validateInput(  $('[name=title]'),{required:true}) &&isInputsValid  ;
    isInputsValid =  validateInput(  $('[name=description]'),{required:true})  &&isInputsValid ;
    isInputsValid =  validateInput(  $('[name=expiration]'),{required:true})  &&isInputsValid ;
    // isInputsValid =  validateInput(  $('[name=status]'),{required:true,optionValueBlocked:'choose'})   &&isInputsValid;
    // isInputsValid =  validateInput(  $('[name=priority]'),{required:true,optionValueBlocked:'choose'})   &&isInputsValid;



     if(isInputsValid)
     {

         const oprator = $('#btn_modal').attr('operate')
         const url = "api/tasks/"
         var data     = {
             title : $('[name=title]').val(),
             description : $('[name=description]').val(),
             expiration :   $('[name=expiration]').val(),
             status : $('[name=status]').val(),
             priority :  $('[name=priority]').val(),
         }


         switch (oprator) {
             case 'store':

                 $.ajax({
                     type:'post',
                     url: url,
                     dataType:'JSON',
                     data:data,

                     success: (response) => {

                         Livewire.dispatch('LoadPage')

                         Swal.fire({
                             title: "موفق ",
                             text: "وظیفه جدید ثبت شد ",
                             icon: "info",
                             confirmButtonText: "متوجه شدم",

                         }).then((result) => {

                             $('#modal_task').modal('hide');


                         });



                     },
                     error: function(response){


                     }
                 });
                 break;
             case 'update':


                 $.ajax({
                     dataType:'JSON',
                     type:'PATCH',
                     url: url+$('#task_id').val(),
                       data: data,

                     success: (response) => {

                         Livewire.dispatch('LoadPage')

                         Swal.fire({
                             title: "بروز رسانی ",
                             text: "بروزرسانی با موفقعیت انجام شد ",
                             icon: "info",
                             confirmButtonText: "متوجه شدم",

                         }).then((result) => {
                             $('#modal_task').modal('hide');

                         });

                     },
                     error: function(response){
                         console.log(response)

                     }
                 });

                 break;

         }



     }


    var isInputsValid=true;

})
