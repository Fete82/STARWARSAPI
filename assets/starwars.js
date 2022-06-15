const submittedForm = document.querySelector('.sw_import_form');

submittedForm.addEventListener('submit', submitFormAjax);

function submitFormAjax(event){

    event.preventDefault();

    const formData = new FormData(submittedForm);

    console.log(event);
    /*
    fetch()
        .then()
        .then()
        .catch()
    */
}