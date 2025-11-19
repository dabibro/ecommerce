"use strict";

function openRegister() {
    closeModal(app_modal);
    let content = open_modal(app_modal, 1, '')
    $.get(base_path + 'auth/register', {}, function (e) {
        content.html(e);
    });
}

function openRegisterSuccess(email) {
    closeModal(app_modal);
    let content = open_modal(app_modal, 1);
    $.get(base_path + 'auth/register-success?email=' + email, {}, function (e) {
        content.html(e);
    })
}

function openLogin() {
    closeModal(app_modal);
    let content = open_modal(app_modal, 1, '')
    $.get(base_path + 'auth/login', {}, function (e) {
        content.html(e);
    });
}


function openForgotPassword() {
    closeModal(app_modal);
    let content = open_modal(app_modal, 1, '')
    $.get(base_path + 'auth/forgot-password', {}, function (e) {
        content.html(e);
    });
}

