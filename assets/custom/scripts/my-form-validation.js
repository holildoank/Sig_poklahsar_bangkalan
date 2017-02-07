var FormValidation = function () {
    // for more info visit the official plugin documentation:
    // http://docs.jquery.com/Plugins/Validation

    // validation validate_form_department
    var validate_form_department = function() {
        var form1 = $('#form_department');
        var error1 = $('.alert-danger', form1);
        var success1 = $('.alert-success', form1);

        form1.validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block help-block-error', // default input error message class
            focusInvalid: true, // do not focus the last invalid input
            ignore: "",  // validate all fields including form hidden input
            messages: {
                select_multi: {
                    maxlength: jQuery.validator.format("Max {0} items allowed for selection"),
                    minlength: jQuery.validator.format("At least {0} items must be selected")
                }
            },
            rules: {
                department_name: {
                    required: true
                },
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                success1.hide();
                error1.show();
                App.scrollTo(error1, -200);
            },

            highlight: function (element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            unhighlight: function (element) { // revert the change done by hightlight
                $(element)
                    .closest('.form-group').removeClass('has-error'); // set error class to the control group
            },

            success: function (label) {
                label
                    .closest('.form-group').removeClass('has-error'); // set success class to the control group
            },

            submitHandler: function (form) {
                // form.submit();
                if(mode=='add'){
            		btnInsert();
            	}else if(mode=='edit'){
            		btnUpdate();
            	}
                success1.show();
                error1.hide();
            }
        });
    }

    return {
        //main function to initiate the module
        init: function () {
            // master & setting
            validate_form_department();

        }

    };


}();

jQuery(document).ready(function() {
    FormValidation.init();
});
