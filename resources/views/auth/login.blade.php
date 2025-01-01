<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0-beta20
* @link https://tabler.io
* Copyright 2018-2023 The Tabler Authors
* Copyright 2018-2023 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ !empty($judul) ? $judul : '' }} - INDAH LAUNDRY (Stand Alone).</title>
    <!-- CSS files -->
    <link href="assets/dist/css/tabler.min.css?1692870487" rel="stylesheet" />
    <link href="assets/dist/css/tabler-flags.min.css?1692870487" rel="stylesheet" />
    <link href="assets/dist/css/tabler-payments.min.css?1692870487" rel="stylesheet" />
    <link href="assets/dist/css/tabler-vendors.min.css?1692870487" rel="stylesheet" />
    <link href="assets/dist/css/demo.min.css?1692870487" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
            --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
            font-feature-settings: "cv03", "cv04", "cv11";
        }
    </style>
</head>

<body class=" d-flex flex-column bg-azure-lt">
    <style>
        body {
            margin: auto;
            font-family: -apple-system, BlinkMacSystemFont, sans-serif;
            overflow: auto;
            background: linear-gradient(315deg, rgba(101, 0, 94, 1) 3%, rgb(4, 0, 255) 38%, rgb(101, 0, 94, 1) 68%, rgba(255, 25, 25, 1) 98%);
            animation: gradient 15s ease infinite;
            background-size: 400% 400%;
            background-attachment: fixed;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 0%;
            }

            50% {
                background-position: 100% 100%;
            }

            100% {
                background-position: 0% 0%;
            }
        }

        .wave {
            background: rgb(255 255 255 / 25%);
            border-radius: 1000% 1000% 0 0;
            position: fixed;
            width: 200%;
            height: 12em;
            animation: wave 10s -3s linear infinite;
            transform: translate3d(0, 0, 0);
            opacity: 0.8;
            bottom: 0;
            left: 0;
            z-index: -1;
        }

        .wave:nth-of-type(2) {
            bottom: -1.25em;
            animation: wave 18s linear reverse infinite;
            opacity: 0.8;
        }

        .wave:nth-of-type(3) {
            bottom: -2.5em;
            animation: wave 20s -1s reverse infinite;
            opacity: 0.9;
        }

        @keyframes wave {
            2% {
                transform: translateX(1);
            }

            25% {
                transform: translateX(-25%);
            }

            50% {
                transform: translateX(-50%);
            }

            75% {
                transform: translateX(-25%);
            }

            100% {
                transform: translateX(1);
            }
        }
    </style>
    <div>
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
    </div>
    <script src="assets/dist/js/demo-theme.min.js?1692870487"></script>
    <div class="page page-center">
        <div class="container container-tight py-4">
            {{-- <div class="text-center mb-4">
            <a href="." class="navbar-brand navbar-brand-autodark">
                <img src="assets/static/logo.png" width="50" height="100" alt="Tabler">
            </a>
        </div> --}}
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Login to your account</h2>
                    <form action="{{ route('post.login') }}" method="POST" id="handleajax" autocomplete="off"
                        novalidate>
                        @csrf
                        <div id="errors-list"></div>
                        <input type="hidden" name="cf-turnstile-response" id="cf-turnstile-response">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" placeholder="Your username"
                                autocomplete="off">
                            @if ($errors->has('username'))
                                <span class="text-danger">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                Password
                                <span class="form-label-description">
                                    <a href="{{ url('reset') }}">I forgot password</a>
                                </span>
                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" name="password" class="form-control" placeholder="Your password"
                                    autocomplete="off">
                                @if ($errors->has('password'))
                                    <span class="text-danger">{{ $errors->first('password') }}</span>
                                @endif
                                <span class="input-group-text">
                                    <a href="#" class="link-secondary" title="Show password"
                                        data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                            height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>
                                    </a>
                                </span>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input" />
                                <span class="form-check-label">Remember me on this device</span>
                            </label>
                        </div>
                        <div class="form-footer">
                            <button type="submit" id="submitLogin" class="btn btn-primary w-100 mb-3">Sign in</button>
                            {{-- <div class="d-flex justify-content-center">
                                <x-turnstile data-sitekey="{{ env('TURNSTILE_SITE_KEY') }}" data-action="login"
                                    data-callback="callback" data-expired-callback="expiredCallback"
                                    data-error-callback="errorCallback" data-theme="dark" data-tabindex="1" />
                            </div> --}}
                        </div>
                    </form>
                </div>
                <div class="hr-text">or</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col"><a href="#" class="btn w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-brand-google">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M20.945 11a9 9 0 1 1 -3.284 -5.997l-2.655 2.392a5.5 5.5 0 1 0 2.119 6.605h-4.125v-3h7.945z" />
                                </svg>
                                Login with Google
                            </a></div>
                        <div class="col"><a href="#" class="btn w-100">
                                <!-- Download SVG icon from http://tabler-icons.io/i/brand-twitter -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon text-twitter" width="24"
                                    height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M22 4.01c-1 .49 -1.98 .689 -3 .99c-1.121 -1.265 -2.783 -1.335 -4.38 -.737s-2.643 2.06 -2.62 3.737v1c-3.245 .083 -6.135 -1.395 -8 -4c0 0 -4.182 7.433 4 11c-1.872 1.247 -3.739 2.088 -6 2c3.308 1.803 6.913 2.423 10.034 1.517c3.58 -1.04 6.522 -3.723 7.651 -7.742a13.84 13.84 0 0 0 .497 -3.753c0 -.249 1.51 -2.772 1.818 -4.013z" />
                                </svg>
                                Login with Twitter
                            </a></div>
                    </div>
                </div>
            </div>
            {{-- <div class="text-center mt-3">
                <span>Don't have an account yet?</span>
                <a href="{{ url('register') }}" tabindex="-1" class="text-danger"> Sign up</a>
            </div> --}}
        </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="assets/dist/js/tabler.min.js?1692870487" defer></script>
    <script src="assets/dist/js/demo.min.js?1692870487" defer></script>
    <script src="{{ asset('assets/extentions/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/extentions/jquery.validate.min.js') }}"></script>
    <script type="text/javascript">
        $(document).on("submit", "#handleajax", function(e) {
            e.preventDefault();

            var form = this;
            var submitButton = $(form).find("[type='submit']");
            var spinnerHtml =
                "<span class='spinner-border spinner-border-sm me-2' role='status' aria-hidden='true'></span>";

            submitButton.html(spinnerHtml + "Logging in...");
            submitButton.prop("disabled", true);

            $.ajax({
                url: $(form).attr("action"),
                data: $(form).serialize(),
                type: "POST",
                dataType: "json",
                success: function(response) {
                    if (response.status) {
                        submitButton.html(spinnerHtml + "Redirecting to dashboard...");

                        setTimeout(function() {
                            window.location.href = response.redirect;
                        }, 2000);
                    } else {
                        $("#errors-list").empty();
                        $.each(response.message, function(key, val) {
                            $("#errors-list").append(
                                "<div class='alert alert-danger'>" + val + "</div>"
                            );
                        });
                        submitButton.html("Sign in");
                        submitButton.prop("disabled", false);
                    }
                },
                error: function() {
                    $("#errors-list").html(
                        "<div class='alert alert-danger'>Something went wrong. Please try again later.</div>"
                    );
                    submitButton.html("Sign in");
                    submitButton.prop("disabled", false);
                },
            });

            return false;
        });
    </script>
</body>

</html>
