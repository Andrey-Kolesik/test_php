
$('.login-btn').click(function(e) {
    e.preventDefault();

    $('input').removeClass('error');
    let login = $('input[name="login"]').val();
    let password = $('input[name="password"]').val();

    $.ajax({
        url: 'controllers/signin.php',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login,
            password: password
        },
        success (data) {
            if(data.status) {
                document.location.href = '/index.php';
            } else {
                if(data.type === 1) {
                    data.fields.forEach(function(el) {
                        $(`input[name="${el}"]`).addClass('error');
                    })
                }
                $('.msg').removeClass('none').text(data.message);
            }
        }
    })
});

$('.register-btn').click(function(e) {
    e.preventDefault();

    $('.err').addClass('none');
    $('input').removeClass('error');
    let login = $('input[name="login"]').val();
    let password = $('input[name="password"]').val();
    let password_confirm = $('input[name="password_confirm"]').val();
    let email = $('input[name="email"]').val();
    let name = $('input[name="name"]').val();

    $.ajax({
        url: 'controllers/signup.php',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login,
            password: password,
            password_confirm: password_confirm,
            email: email,
            name: name

        },
        success (data) {
            if(data.status) {
                document.location.href = '/login.php';
            } else {
                if(data.type === 1) {
                    data.fields.forEach(function(el) {
                        $(`input[name="${el}"]`).addClass('error');
                    })
                } else if (data.type === 2) {
                    data.fields.forEach(function (el) {
                        $(`.err-${el}`).removeClass('none');
                    })
                }
                $('.msg').removeClass('none').text(data.message);
            }
        }
    })
})