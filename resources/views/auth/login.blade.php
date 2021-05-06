    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Oblrada CRM</title>
        <link href="css/reset.css" rel="stylesheet">
    </head>

    <body>
        <section class="login_section">
            <div class="login_wrapper">
                <div class="login__header">
                    Вхід
                </div>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <input value="{{ old('uLogin') }}" id="name" placeholder="Логін" type="text" class="login_input" name="uLogin" required autofocus />
                    <input id="password" placeholder="Пароль" type="password" class="login_input" name="password" required />
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <input name="user_send" type="submit" value="Вхід" class="login_send">
                </form>
            </div>
        </section>
    </body>

    </html>

    <style>
        .login_section {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: calc(100vh - 16px);
            background: #f7fafc;
        }

        .login_wrapper {
            width: 376px;
        }

        .login_wrapper form {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .login_wrapper form input {
            width: 100%;
            font-size: 20px;
            padding: 7px 19px;
            margin-bottom: 20px;
            border-radius: 5px;
            color: #777;
            border: 1px solid;
        }

        .login_wrapper form .login_send {
            color: #fff;
            background: #182f54d6;
        }

        .login__header {
            display: none;
            text-align: center;
            margin-bottom: 25px;
            font-size: 20px;
        }
    </style>