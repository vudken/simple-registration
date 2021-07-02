let passStatus = document.querySelector('#pass-status');

passStatus.addEventListener('click', function () {
    let passInp = document.getElementById('password');
    let passConfirmInp = document.getElementById('password-confirm');

    if (passInp.type == 'password') {
        passInp.type = 'text';
        passConfirmInp.type = 'text';
        passStatus.className = 'fa fa-eye';
    } else {
        passInp.type = 'password';
        passConfirmInp.type = 'password';
        passStatus.className = 'fa fa-eye-slash';
    }
});
