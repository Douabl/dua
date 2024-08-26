const btnSignIn = document.getElementById("sign-in"),
      btnSignUp = document.getElementById("sign-up"),
      containerFormRegister = document.querySelector(".register"),
      containerFormLogin = document.querySelector(".login");

btnSignIn.addEventListener("click", e => {
    containerFormRegister.classList.add("hide");
    containerFormLogin.classList.remove("hide")
})


btnSignUp.addEventListener("click", e => {
    containerFormLogin.classList.add("hide");
    containerFormRegister.classList.remove("hide")
})
// Get the value of the 'erreur' parameter from the URL
const urlParams = new URLSearchParams(window.location.search);
const erreur = urlParams.get('erreur');

// Check if the 'erreur' parameter is 'mdp' and show the alert
if (erreur === 'mdp') {
    Swal.fire({
        icon: 'error',
        title: 'Erreur',
        text: 'Mot de passe incorrect',
        confirmButtonText: 'OK'
    });
}
if (erreur === 'email') {
    Swal.fire({
        icon: 'error',
        title: 'Erreur',
        text: "ce email n'existe pas",
        confirmButtonText: 'OK'
    });
}