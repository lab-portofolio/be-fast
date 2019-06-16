const registrationPath = "http://localhost/befast/server/registration.php"

const joinToGame = () => {
    let full_name = document.getElementById("full_name")
    if (full_name.value == "") {
        alert("Harap isi nama lengkap terlebih dahulu")
    }
    else {
        let formData = new FormData()
        formData.append("action", "join")
        formData.append("full_name", full_name.value)

        ajax(formData, registrationPath, "POST", (response) => {
            if (response == 200) location.reload();
        })
    }
}