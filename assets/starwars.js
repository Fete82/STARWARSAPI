const submittedForms = document.querySelectorAll('.sw_import_form');
submittedForms.forEach(function(form){
    form.addEventListener('submit', submitFormAjax);
})

function submitFormAjax(event){

    event.preventDefault();

    const url = event.currentTarget.getAttribute('action');
    const formData = new FormData(event.target);

    fetch(url, {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(body => {
            console.log(body);
            // Prints message to <p> tag in admin page, to display status.
            const list = document.getElementById("sw_message");
            list.innerHTML = body.data.message;
        })
        .catch()

}