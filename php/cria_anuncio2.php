<?php
session_start();
require "conexaoMysql.php";

if (!isset($_SESSION['loggedIn'])) {
    header("location: ../pages/conta.html");
    exit();
}

$email = $_SESSION['user'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Multi step form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/Alex_NavDefault-1.css">
    <link rel="stylesheet" href="../assets/css/Alex_NavDefault.css">
    <link rel="stylesheet" href="../assets/css/Multi-step-form.css">
</head>

<body>
    <div>
        <nav class="navbar navbar-dark navbar-expand-md bg-dark navigation-clean-button">
            <div class="container">
                <div><a class="navbar-brand" href="#">__BRAND </a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button></div>
                <div class="collapse navbar-collapse" id="navcol-1">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link active" href="#">__activeItem </a></li>
                        <li class="nav-item"><a class="nav-link" href="#">__inactiveItem </a></li>
                        <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#">__dropdown </a>
                            <div class="dropdown-menu"><a class="dropdown-item" href="#">__itemOne </a><a class="dropdown-item" href="#">__itemTwo </a><a class="dropdown-item" href="#">__ItemThree </a></div>
                        </li>
                    </ul>
                    <p class="ml-auto navbar-text actions" style="margin-bottom: 7px;float: right;display: block;"><a class="login" href="#">__login </a> <a class="btn btn-light action-button" role="button" href="#">_signup </a></p>
                </div>
            </div>
        </nav>
    </div>
    <section>
        <div id="multple-step-form-n" class="container overflow-hidden" style="margin-top: 0px;margin-bottom: 10px;padding-bottom: 300px;padding-top: 57px;">
            <div id="progress-bar-button" class="multisteps-form">
                <div class="row">
                    <div class="col-12 col-lg-8 ml-auto mr-auto mb-4">
                        <div class="multisteps-form__progress"><a class="btn multisteps-form__progress-btn js-active" role="button" title="User Info">User Info</a><a class="btn multisteps-form__progress-btn" role="button" title="User Info">About</a><a class="btn multisteps-form__progress-btn" role="button" title="User Info">Contact&nbsp;</a></div>
                    </div>
                </div>
            </div>
            <div id="multistep-start-row" class="row">
                <div id="multistep-start-column" class="col-12 col-lg-8 m-auto">
                    <form id="main-form" class="multisteps-form__form">
                        <div id="single-form-next" class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="scaleIn">
                            <h3 class="text-center multisteps-form__title">User Info</h3>
                            <div id="form-content" class="multisteps-form__content">
                                <div id="input-grp-double" class="form-row mt-4">
                                    <div class="col-12 col-sm-6"><input class="form-control multisteps-form__input" type="text" placeholder="First name "></div>
                                    <div class="col-12 col-sm-6 mt-4 mt-sm-0"><input class="form-control multisteps-form__input" type="text" placeholder="Last name "></div>
                                </div>
                                <div id="input-grp-single" class="form-row mt-4">
                                    <div class="col-12"><input class="form-control multisteps-form__input" type="text" placeholder="House"></div>
                                </div>
                                <div id="next-button" class="button-row d-flex mt-4"><button class="btn btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button></div>
                            </div>
                        </div>
                        <div id="single-form-next-prev" class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                            <h3 class="text-center multisteps-form__title">About</h3>
                            <div id="form-content-1" class="multisteps-form__content">
                                <div id="input-grp-double-1" class="form-row mt-4">
                                    <div class="col-12 col-sm-6"><input class="form-control multisteps-form__input" type="text" placeholder="First name "></div>
                                    <div class="col-12 col-sm-6 mt-4 mt-sm-0"><input class="form-control multisteps-form__input" type="text" placeholder="Last name "></div>
                                </div>
                                <div id="input-grp-single-1" class="form-row mt-4">
                                    <div class="col-12"><input class="form-control multisteps-form__input" type="text" placeholder="House"></div>
                                </div>
                                <div id="next-prev-buttons" class="button-row d-flex mt-4"><button class="btn btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button><button class="btn btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button></div>
                            </div>
                        </div>
                        <div id="single-form-next-prev-1" class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                            <h3 class="text-center multisteps-form__title">About</h3>
                            <div id="form-content-2" class="multisteps-form__content">
                                <div id="input-grp-double-2" class="form-row mt-4">
                                    <div class="col-12 col-sm-6"><input class="form-control multisteps-form__input" type="text" placeholder="First name "></div>
                                    <div class="col-12 col-sm-6 mt-4 mt-sm-0"><input class="form-control multisteps-form__input" type="text" placeholder="Last name "></div>
                                </div>
                                <div id="input-grp-single-2" class="form-row mt-4">
                                    <div class="col-12"><input class="form-control multisteps-form__input" type="text" placeholder="House"></div>
                                </div>
                                <div id="next-prev-buttons-1" class="button-row d-flex mt-4"><button class="btn btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button><button class="btn btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/Multi-step-form-script.js"></script>
</body>

</html>