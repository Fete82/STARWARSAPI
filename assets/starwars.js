const submittedForm = document.querySelector('.sw_import_form');

submittedForm.addEventListener('submit', submitFormAjax);

function submitFormAjax(event){

    const formData = new FormData(submittedForm);

    console.log(formData);
    /*
    fetch()
        .then()
        .then()
        .catch()
    */
}