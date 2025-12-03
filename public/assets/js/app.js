let base_path = document.getElementById('base_path');
const app_modal_loader = "app-modal-loader";
const app_modal = "app-modal";
const app_modal_sm = "app-modal-sm";
const app_modal_lg = "app-modal-lg";
const app_modal_extend = "app-modal-extend";
const cropper_modal = "cropper_modal";
const app_loader = '<div style="position:relative;" class="text-center" id="content-loader"><div class="loader-container"><div class="loader"></div></div></div>';
const alert_response = "#alert-response";
const ajax_response = "#ajax-response";

if (base_path) {
    base_path = base_path.value;
}

$(function () {
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    $('.AppForm').bootstrap5Validate(function (e, data) {
        "use strict";
        e.preventDefault();
        let form_id = "#" + this.id;
        let button = $(form_id + ' .form-button');
        let text = button.html();
        button.html('<i class="ri-loader-4-line icon-spin ri ri-mr"></i> Processing...');
        button.attr('disabled', 'disabled');
        $.ajax({
            url: this.action,
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (e) {
                $(form_id + ' .form-response').html(e);
                button.html(text);
                button.removeAttr('disabled');
            },
            error: function () {
            }
        });
    });

    $(".checkbox_toggle").on('click', function () {
        if (this.checked) {
            $("." + this.id).val(1);
        } else {
            $("." + this.id).val(0);
        }
    });

    let date_input = $('.datepicker-input');
    let bootstrap = $('.bootstrap-iso form');
    let container = bootstrap.length > 0 ? bootstrap.parent() : "body";
    date_input.datepicker({
        format: 'yyyy-mm-dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
    });
});

function ToastAlert(params) {
    $(document).Toasts('create', {
        class: 'bg-' + params.alert,
        title: params.title,
        subtitle: params.subtitle,
        body: params.message
    })
}

function passwordToggle(elem, btn) {
    var x = document.getElementById(elem);
    if (x.type === "password") {
        x.type = "text";
        $(btn).html('<i class="ri-eye-line"></i>');
    } else {
        $(btn).html('<i class="ri-eye-off-line"></i>');
        x.type = "password";
    }
}

function alertModal() {
    $(app_modal).modal('show');
    let content = $(app_modal + " #content");
    content.html(app_loader);
    return content;
}

function open_modal(modal_type, backdrop = 0, modal_title = '') {
    const options = {
        show: true,
        backdrop: "static"
    }
    if (backdrop === 0) {
        options.backdrop = true;
    }
    let myModal = new bootstrap.Modal(document.getElementById(modal_type), options)
    myModal.show();
    if (modal_title !== '') {
        $("#" + modal_type + " .modal-title").html(modal_title);
    }
    let content = $("#" + modal_type + " #content");
    content.html(app_loader);
    return content;
}

function closeModal(modal_id) {
    const modalElement = document.getElementById(modal_id);
    const modalInstance = bootstrap.Modal.getInstance(modalElement)
        || new bootstrap.Modal(modalElement);
    modalInstance.hide();
}

function staticLoader() {
    open_modal(app_modal_loader, 1);
}

function openNotification(params) {
    let backdrop = 0;
    if (params.backdrop) {
        backdrop = 1;
    }
    let content = open_modal(app_modal, backdrop);
    $.post(base_path + 'openNotification', params, function (e) {
        content.html(e);
    });
}

function pleaseWait() {
    let content = open_modal(app_modal, '1');
    $(app_modal + " .modal-header").hide();
    $(app_modal + " .modal-content").css('background', 'unset');
    $(app_modal + " .modal-content").css('border', 'unset');
    $(app_modal + " .modal-content").css('box-shadow', 'unset');
    $(app_modal + " .modal-content").css('padding', 'unset');
}

function closePleaseWait(modal = "app_modal") {
    $(modal).modal('hide');
}

function confirm_alert(path) {
    let button = $('.confirm-button');
    let text = button.html();
    button.html('<i class="ri-loader-4-line icon-spin mr-2 icon"></i> Loading ...');
    button.attr('disabled', 'disabled');
    $.post(path, {}, function (resp) {
        $(alert_response).html(resp);
        button.html(text);
        button.removeAttr('disabled');
    })
}

function viewReceipt(params) {
    let content = open_modal(app_modal);
    $.post(base_path + 'viewReceipt', params, function (e) {
        content.html(e);
    });
}

function supportTicket(params) {
    let content = open_modal(app_modal, 1);
    $.post(base_path + 'disputeForm', params, function (e) {
        content.html(e);
    });
}

function convertToWords(amount) {
    const units = ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
    const teens = ['eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
    const tens = ['', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
    const scales = ['', 'thousand', 'hundred thousand', 'million'];

    function convertToWordsLessThanThousand(n) {
        if (n < 10) {
            return units[n];
        } else if (n < 20) {
            return teens[n - 11];
        } else if (n < 100) {
            return tens[Math.floor(n / 10)] + (n % 10 !== 0 ? ' ' + units[n % 10] : '');
        } else {
            return units[Math.floor(n / 100)] + ' hundred' + (n % 100 !== 0 ? ' and ' + convertToWordsLessThanThousand(n % 100) : '');
        }
    }

    function convertAmountToWords(amount) {
        let wholePart = Math.floor(amount);
        const decimalPart = Math.round((amount - wholePart) * 100); // considering up to two decimal places

        const wholeWords = convertToWordsLessThanThousand(wholePart);
        const decimalWords = decimalPart > 0 ? 'and ' + convertToWordsLessThanThousand(decimalPart) + ' kobo' : '';

        if (wholeWords === 'zero') {
            return 'zero naira only';
        }
        const words = [];
        let scaleIndex = 0;

        while (wholePart > 0) {
            const chunk = wholePart % 1000;
            if (chunk !== 0) {
                words.unshift(convertToWordsLessThanThousand(chunk) + ' ' + scales[scaleIndex]);
            }
            wholePart = Math.floor(wholePart / 1000);
            scaleIndex++;
        }

        return words.join(' ') + ' naira ' + decimalWords + ' only';
    }

    return convertAmountToWords(amount);
}

$(".copy-text").on("click", function (e) {
    alert(true);
    let elem = $("#" + this.id);
    let src = elem.attr("data-src");
    alert(src);
    copyText(src);
});

function copyText(src) {
    let text = document.getElementById(src).innerText;
    navigator.clipboard.writeText(text)
        .then(() => alert("Text copied: " + text))
        .catch(err => console.error("Error copying text:", err));
}

function printDiv(div) {
    let divContent = document.getElementById(div).outerHTML;
    let printWindow = window.open("", "_blank");
    let styles = document.head.innerHTML;
    printWindow.document.write(`
        <html lang="en">
        <head>${styles}<title>Printing</title></head>
        <body onload="window.print(); window.close();">
            ${divContent}
        </body>
        </html>
    `);
    printWindow.document.close();
}

function navigate(path) {
    location.replace(path);
}

function viewDocument(filename) {
    window.open(filename, '_blank');
}

function states_local(state, dst) {
    $.post(base_path + 'state-locals', {
        state: state
    }, function (response) {
        $(dst).html(response);
    });
}
