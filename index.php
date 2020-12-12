<!DOCTYPE html>
<html lang="en">
    <head>
        <div id="loader">
            <p>Loading...</p>
        </div>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="theme-color" content="#3f51b5">
        <title>Bapa and Dara's Menu</title>
        <link rel="stylesheet" href="dialog-polyfill-master/dist/dialog-polyfill.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-amber.min.css"/>
        <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
        <script type="text/javascript" src="./davidshimjs-qrcodejs-04f46c6/qrcode.js"></script>
        <script src="foods.js"></script>
        <style>
            dialog {
                transform: scale(0);
                animation: zoomin .3s forwards;
                border-radius: 12px;
                top: 0;
                bottom: 0;
                position: fixed;
            }

            dialog#welcome {
                min-width: 300px;
                max-width: 800px;
                width: 80%;
                padding-bottom: 30px;
                text-align: center;
            }

            dialog::backdrop {
                background-color: #3d3d3d;
                animation: show .3s forwards;
            }

            dialog.hide {
                transform: scale(1);
                animation: zoomout .3s forwards;
            }

            dialog.hide::backdrop {
                animation: hide .3s forwards;
            }

            table {
                background-color: transparent !important;
                width: 100%;
            }

            td .mdl-textfield {
                width: revert;
            }

            .mdl-layout__content {
                width: 100%;
                max-width: 800px;
                background-color: rgba(255,255,255,0.8);
                backdrop-filter: blur(8px) saturate(0.5);
                margin: auto;
            }
            .mdl-cell p, .mdl-cell button{
                position: relative;
                top: 50%;
                transform: translateY(-50%);
            }

            canvas + img {
                display: block;
                margin: auto;
            }

            #loader, #error {
                position: fixed;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
                background-color: white;
            }

            #loader p, #error p {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
            }

            #error {
                color: red;
            }

            @keyframes zoomin {
                from {
                    transform: scale(0);
                }

                to {
                    transform: scale(1);
                }
            }

            @keyframes zoomout {
                from {
                    transform: scale(1);
                }

                to {
                    transform: scale(0);
                }
            }

            @keyframes show {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            @keyframes hide {
                from {
                    opacity: 1;
                }

                to {
                    opacity: 0;
                }
            }
        </style>
    </head>
    <body>
        <div id="error">
            <p>Check your network connection!
            <p>
        </div>
        <dialog id="welcome" class="mdl-dialog">
            <h6 class="mdl-dialog__title">Welcome to Bapa and Dara's Menu!</h6>
            <div class="carousel mdl-dialog__content">
                <div class="carousel-cell visible">
                    <p>Here are some information on how to use this menu</p>
                </div>
                <div class="carousel-cell">
                    <p>Input your name for identity</p>
                    <p>
                        <img src="https://angelika.me/assets/posts/custom-error-messages-for-html5-form-validation/please-fill-out-this-field-2c407b4b0434810de830cd45a1cf74e021958d4c795b4f0aec56781d1e6c0250.gif" style="width: 100px">
                    </p>
                </div>
                <div class="carousel-cell">
                    <p>Just specify the quantity of the item!</p>
                    <p>
                        <img src="./img/question.gif" style="width: 100px">
                    </p>
                </div>
                <div class="carousel-cell">
                    <p>Computations are made automatically!</p>
                    <p>
                        <img src="./img/operations(old).gif" style="width: 100px">
                    </p>
                </div>
                <div class="carousel-cell">
                    <p>Useful if a squad wants you to buy their food!</p>
                    <p>
                        <img src="./img/squad.gif" style="width: 100px">
                    </p>
                </div>
                <div class="carousel-cell">
                    <p>Checkout to get the QR code</p>
                    <p id="qrcode1"></p>
                </div>
                <div class="carousel-cell">
                    <p>Show the QR code to Bapa and Dara's crews</p>
                </div>
            </div>
            <div class="mdl-dialog__actions">
                <button id="next_btn" class='mdl-button mdl-js-button mdl-button--raised mdl-button--colored mdl-js-ripple-effect' style="display: block; margin: auto;">Next</button>
            </div>
        </dialog>
        <dialog id="qrdialog" class="mdl-dialog">
            <h6 class="mdl-dialog__title">Scan this at the eatery!</h6>
            <div class="carousel mdl-dialog__content">
                <p>Screenshot this if you want to keep it.</p>
                <div id="qrdialogout"></div>
            </div>
            <div class="mdl-dialog__actions">
                <button class="mdl-button closeqr">Close</button>
            </div>
        </dialog>
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
            <header class="mdl-layout__header">
                <div class="mdl-layout__header-row">
                    <!-- Title -->
                    <span class="mdl-layout-title">Bapa and Dara's Eatery Menu</span>
                    <!-- Add spacer, to align navigation to the right -->
                    <div class="mdl-layout-spacer"></div>
                    <!-- Navigation. We hide it in small screens. -->
                    <nav class="mdl-navigation mdl-layout--large-screen-only"></nav>
                </div>
            </header>
            <div class="mdl-layout__drawer">
                <span class="mdl-layout-title">Bapa and Dara's Eatery Menu</span>
                <nav class="mdl-navigation">
                    <a class="mdl-navigation__link">
                        <img src="./img/egg1.gif" style="width: 100%;">
                    </a>
                </nav>
            </div>
            <main class="mdl-layout__content">
                <div class="page-content"><form>
                    <div class="mdl-grid">
                        <div class="mdl-cell mdl-cell--5-col mdl-cell--12-col-phone">
                            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                <input required class="mdl-textfield__input" type="text" id="name" autocomplete="off">
                                <label class="mdl-textfield__label" for="name">Customer's name</label>
                            </div>
                        </div>
                        <div class="mdl-cell mdl-cell--5-col mdl-cell--12-col-phone">
                            <p id="total_sum">Total: <span>0</span></p>
                        </div>
                        <div class="mdl-cell mdl-cell--2-col mdl-cell--12-col-phone">
                            <button>Get QR</button>
                        </div></form>
                    </div>
                    <table class="mdl-data-table mdl-js-data-table mdl-shadow--2dp" id="available">
                        <thead>
                            <tr>
                                <th class="mdl-data-table__cell--non-numeric">Item</th>
                                <th>Unit price</th>
                                <th>Quantity</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </main>
        </div>
        <script src="dialog-polyfill-master/dist/dialog-polyfill.js"></script>
        <script src="script - Copy.js?time=<?php echo time(); ?>"></script>
    </body>
</html>
