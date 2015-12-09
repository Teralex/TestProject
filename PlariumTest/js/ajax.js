$(document).ready(function () {
    $("#btn").click(
            function () {
                sendAjaxForm('result_form', 'form', 'index.php');
                return false;
            }
    );
    $("#btn2").click(
            function () {
                sendAjaxForm('result_form2', 'form2', 'index.php');
                return false;
            }
    );
});

function sendAjaxForm(result_form, ajax_form, url) {
    jQuery.ajax({
        url: url, //url страницы (action_ajax_form.php)
        type: "POST", //метод отправки
        dataType: "html", //формат данных
        data: jQuery("#" + ajax_form).serialize(), // Сеарилизуем объект
        success: function (response) { //Данные отправлены успешно
            console.log(response);
            result = jQuery.parseJSON(response);
            console.log(result);

            var string = '';
            $.each(result, function (index, value) {
                string = string + "<br>" + index + ':' + value;
            });
            document.getElementById(result_form).innerHTML = string;
        },
        error: function (response) { // Данные не отправлены
            document.getElementById(result_form).innerHTML = "Ошибка. Данные не отправленны.";
        }
    });
}