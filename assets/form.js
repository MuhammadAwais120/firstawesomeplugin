document.addEventListener('DOMContentLoaded', function(e) {

    let testimonialForm = document.getElementById('awesome-testimonial-form');

    testimonialForm.addEventListener( 'submit', (e)=> {
        e.preventDefault();
        // rest data
        resetMessages();
        // collect data

        let data = {
            name : testimonialForm.querySelector('[name="name"]').value,
            email : testimonialForm.querySelector('[name="email"]').value,
            message : testimonialForm.querySelector('[name="message"]').value,
        }
        // validate anything

        if ( ! data.name ) {
            testimonialForm.querySelector('[data-error="invalidName"]').classList.add('show');
            return;
        }

        // ajax https url

        let url = testimonialForm.dataset.url;

        let params = new URLSearchParams(new FormData(testimonialForm));

        testimonialForm.querySelector('.js-form-submission').classList.add('show');

        fetch( url, {
            method : "POST",
            body : params
        }).then(res => res.json())
            .catch(error =>{
                resetMessages();
                testimonialForm.querySelector('.js-form-error').classList.add('show');
            })
            .then(response =>{
                resetMessages();

                if (response === 0 || response === 'error') {
                    testimonialForm.querySelector('.js-form-error').classList.add('show');
                    return;
                }
                testimonialForm.querySelector('.js-form-success').classList.add('show');
                testimonialForm.querySelector('[name="name"]').value = '';
                testimonialForm.querySelector('[name="email"]').value = '';
                testimonialForm.querySelector('[name="message"]').value = '';
            })


    });


});

function resetMessages(){
    document.querySelectorAll('.field-msg').forEach(function(field){
        field.classList.remove('show');
    })
}