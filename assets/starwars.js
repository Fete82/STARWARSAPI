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
        })
        .catch()

}