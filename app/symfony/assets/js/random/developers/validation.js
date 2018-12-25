function validateForm() {
    var amountOfDevelopers = document.forms["millipede"]["amount"].value,
        checkedDevelopers = document.forms["developers"];


    if (amountOfDevelopers == "") {
        alert("Name must be filled out");
        return false;
    }
}