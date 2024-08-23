// ------------------  validation inputs

function validateInput(input,rules){
    var isInputsValid=true;
    if(isInputsValid){
        // removeInvalidErrorsInBox($(document))
     }

    var isValid=true;

    var inputTextLength=input.val() ? input.val().trim().length : 0;
    var requiredRule='required' in rules && rules.required && inputTextLength==0;
    var canEmptyRule=!('required' in rules) || ('required' in rules && !rules.required);
    var canEmptyAndItIsEmpty=canEmptyRule && inputTextLength==0;
    var isMoney='isMoney' in rules && rules.isMoney;

    if(requiredRule){
        var error=`فیلد ${getInputName(input)} نمی تواند خالی باشد.`;
        input.parent().find('.invalid-feedback').remove();

        input.removeClass('is-invalid');
        addInputRuleError(input,error);
        isValid=false;
    }
    if('minLength' in rules && inputTextLength < rules.minLength && !requiredRule && !canEmptyAndItIsEmpty ){
        var error=`طول فیلد ${getInputName(input)} نمی تواند کمتر از ${rules.minLength} حرف باشد.`;
        input.parent().find('.invalid-feedback').remove();
        input.removeClass('is-invalid');
        addInputRuleError(input,error);
        isValid=false;
    }
    if('maxLength' in rules && inputTextLength > rules.maxLength && !requiredRule && !canEmptyAndItIsEmpty ){
        var error=`طول فیلد ${getInputName(input)} نمی تواند بیشتر از ${rules.maxLength} حرف باشد.`;
        input.parent().find('.invalid-feedback').remove();
        input.removeClass('is-invalid');
        addInputRuleError(input,error);
        isValid=false;
    }
    if('minValue' in rules   && !requiredRule && !canEmptyAndItIsEmpty ){
        var error=`مقدار فیلد ${getInputName(input)} نمی تواند کمتر از ${rules.minValue}  باشد.`;
        input.parent().find('.invalid-feedback').remove();
        input.removeClass('is-invalid');
        addInputRuleError(input,error);
        isValid=false;
    }
    if('maxValue' in rules &&  !requiredRule && !canEmptyAndItIsEmpty ){
        var error=`مقدار فیلد ${getInputName(input)} نمی تواند بیشتر از ${rules.maxValue}  باشد.`;
        input.parent().find('.invalid-feedback').remove();
        input.removeClass('is-invalid');
        addInputRuleError(input,error);
        isValid=false;
    }

    if('length' in rules && inputTextLength!=rules.length && !requiredRule && !canEmptyAndItIsEmpty){
        var error=` فیلد ${getInputName(input)} باید دقیقا ${rules.length} کاراکتر باشد.`;
        input.parent().find('.invalid-feedback').remove();
        input.removeClass('is-invalid');
        addInputRuleError(input,error);
        isValid=false;
    }
    if(isMoney && !$.isNumeric(ToNumber(input.val().trim()))){
        var error=`فیلد ${getInputName(input)} را تنها با عدد پر کنید.`;
        input.parent().find('.invalid-feedback').remove();
        input.removeClass('is-invalid');
        addInputRuleError(input,error);
        isValid=false;
    }else if(!isMoney &&'numeric' in rules && rules.numeric && !$.isNumeric(input.val().trim()) && !requiredRule && !canEmptyAndItIsEmpty ){
        var error=`فیلد ${getInputName(input)} را تنها با عدد پر کنید.`;
        input.parent().find('.invalid-feedback').remove();
        input.removeClass('is-invalid');
        addInputRuleError(input,error);
        isValid=false;
    }
    if('email' in rules && rules.email && !isEmail(input.val().trim()) && !canEmptyAndItIsEmpty ){
        var error=`فیلد ${getInputName(input)} با فرمت نامناسب وارد شده است.`;
        input.parent().find('.invalid-feedback').remove();
        input.removeClass('is-invalid');
        addInputRuleError(input,error);
        isValid=false;
    }

    if('optionValueBlocked' in rules && rules.optionValueBlocked==input.find('option:selected').val()){

            if (rules.selectBoxNormal){

            var name=input.siblings('label').text();
            var error=` ${name} انتخاب شده نا معتبر می باشد.`;
            input.parent().find('.invalid-feedback').remove();
            input.removeClass('is-invalid');
            addInputRuleErrorForOptions(input,error,true);
        }else {
            var name=input.parent().siblings('label').text();
            var error=` ${name} انتخاب شده نا معتبر می باشد.`;
            input.parent().find('.invalid-feedback').remove();
            input.removeClass('is-invalid');
            addInputRuleErrorForOptions(input,error,false);
        }

        isValid=false;
    }
    if (isValid){
        input.parent().find('.invalid-feedback').remove();
        input.removeClass('is-invalid');

    }

    return isValid;
}

function addInputRuleError(input,error){
    input.removeClass('is-invalid').addClass('is-invalid')
    input.after(`
        <span class="invalid-feedback" role="alert" >
            <strong>${error}</strong>
        </span>
        `);
}
function addInputRuleErrorForOptions(input,error,is_normal){
    if(is_normal){
        input.removeClass('is-invalid').addClass('is-invalid')
        input.after(`
        <span class="invalid-feedback" role="alert" style="display: block">
            <strong>${error}</strong>
        </span>
        `);
    }else {
        input.next().removeClass('is-invalid').addClass('is-invalid')
        input.next().after(`
        <span class="invalid-feedback" role="alert" style="display: block">
            <strong>${error}</strong>
        </span>
        `);
    }


}
function getInputName(input){
    return input.siblings('label').text();
}
function isEmail(email) {
    var EmailRegex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return EmailRegex.test(email);
}
function removeInvalidErrorsInBox(box){
    box.find('.invalid-feedback').remove();
    box.find('.is-invalid').removeClass('is-invalid');
}

// ------------------------------------------------------------

// isInputsValid =  validateInput(  $('#partProduct-offered-sale-percent'),{required:true,numeric:true,minValue:0,maxValue:100}    ) && isInputsValid ;
// isInputsValid =  validateInput(  $('#partProduct-name'),{required:true,minLength:2}                                             ) && isInputsValid ;
// isInputsValid =  validateInput(  $('#partProduct-unit-conversion'),{numeric:true}                                               ) && isInputsValid ;
// isInputsValid =  validateInput(  $('#partProduct-main-unit'),{optionValueBlocked:'choose'}                                      ) && isInputsValid ;

