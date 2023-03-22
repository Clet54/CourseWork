/**
 * Core JavaScript file.
 */
let forms = document.querySelectorAll('.needs-validation');
// Loop over them and prevent submission
Array.prototype.slice.call(forms).forEach(function (form)
{
    form.addEventListener('submit', function (event)
    {
        if (!form.checkValidity())
        {
            event.preventDefault();
            event.stopPropagation();
        }
        form.classList.add('was-validated');
    }, false);
});
(function ($)
{
    'use strict'
    const validateForms = function ()
    {
        let _ = this, __ = $(_), form = _.name, valid = _.checkValidity()
        if (!valid) __.addClass('was-validated');
        if (form === 'registration')
        {
            if (_.email.value !== _.confirm_email.value)
            {
                valid = false;
                $(_.confirm_email).addClass('is-invalid')
            }
            if (_.password.value !== _.confirm_password.value)
            {
                valid = false;
                $(_.confirm_password).addClass('is-invalid')
            }

        }
        console.log('valid:', valid, 'name:', _.name)
        return valid
    }
    $(document).ready(function ()
    {
        $('body').removeClass('no-js').addClass('js')
        $('form').on('submit', validateForms)
    });
})(jQuery)
