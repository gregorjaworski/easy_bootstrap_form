(function ($) {
    $(document).ready(function () {

        /*
         * Definicje zmiennych
         */
        var fieldName = $('input[name=name]'),
            fieldMail = $('input[name=email]'),
            fieldPhone = $('input[name=phone]'),
            fieldMessage = $('textarea[name=message]');

        /*
         * Definicje tablic
         */


        /*
         * Funkcje sprawdzajace poprawnosc
         */
        function testName() {
            nameSuccess = true;
            if ($(fieldName).val() == "") {
                $(fieldName).parent().addClass('has-danger');
                $(fieldName).addClass('form-control-danger');
                $('#nameDanger').html(wsph_ebf_validation_setup.emptyName).slideDown();
                nameSuccess = false;
            } else if ($(fieldName).val() != $(fieldName).val().match(/[^0-9][a-zA-Z\s\-]*/)) {
                $(fieldName).parent().addClass('has-danger');
                $(fieldName).addClass('form-control-danger');
                $('#nameDanger').html(wsph_ebf_validation_setup.wrongName).slideDown();
                nameSuccess = false;
            } else {
                $(fieldName).parent().addClass('has-success');
                $(fieldName).addClass('form-control-success');
            }
            return nameSuccess;
        }

        function testMail() {
            var mailSuccess = true;
            if ($(fieldMail).val() == "" && $(fieldPhone).val() == "") {
                $(fieldMail).parent().addClass('has-danger');
                $(fieldMail).addClass('form-control-danger');
                $('#mailDanger').html(wsph_ebf_validation_setup.emptyContact).slideDown();
                mailSuccess = false;
            } else if ($(fieldMail).val() != "" && $(fieldMail).val().match(/^[a-zA-Z0-9\-_.]+@[a-z0-9\-.]+\.[a-z0-9]{2,4}$/) == null) {
                $(fieldMail).parent().addClass('has-danger');
                $(fieldMail).addClass('form-control-danger');
                $('#mailDanger').html(wsph_ebf_validation_setup.wrongMail).slideDown();
                mailSuccess = false;
            } else if ($(fieldMail).val() !== "" && mailSuccess) {
                $(fieldMail).parent().addClass('has-success');
                $(fieldMail).addClass('form-control-success');
            }
            return mailSuccess;


        }

        function testPhone() {
            var phoneSuccess = true;
            if ($(fieldMail).val() == "" && $(fieldPhone).val() == "") {
                $(fieldPhone).parent().addClass('has-danger');
                $(fieldPhone).addClass('form-control-danger');
                $('#phoneDanger').html(wsph_ebf_validation_setup.emptyContact).slideDown();
                phoneSuccess = false;
            } else if ($(fieldPhone).val() != "" && $(fieldPhone).val() != $(fieldPhone).val().match(/[\+]?[0-9\s]*[^a-zA-Z]/)) {
                $(fieldPhone).parent().addClass('has-danger');
                $(fieldPhone).addClass('form-control-danger');
                phoneSuccess = false;
                $('#phoneDanger').html(wsph_ebf_validation_setup.wrongPhone).slideDown();
            } else if ($(fieldPhone).val() !== "" && phoneSuccess) {
                $(fieldPhone).parent().addClass('has-success');
                $(fieldPhone).addClass('form-control-success');
            }
            return phoneSuccess;
        }

        function testMessage() {
            var messageSuccess = true;
            if ($(fieldMessage).val().length < 10) {
                $(fieldMessage).parent().addClass('has-danger');
                $(fieldMessage).addClass('form-control-danger');
                messageSuccess = false;
                $('#messageDanger').html(wsph_ebf_validation_setup.emptyMessage).slideDown();
            } else {
                $(fieldMessage).parent().addClass('has-success');
                $(fieldMessage).addClass('form-control-success');
            }
            return messageSuccess;
        }
        function resetMail() {
            if ($(fieldMail).val() == "" || $(fieldMail).val().match(/^[a-zA-Z0-9\-_.]+@[a-z0-9\-.]+\.[a-z0-9]{2,4}$/) !== null) {
                $(fieldMail).parent().removeClass('has-danger');
                $(fieldMail).removeClass('form-control-danger');
                if ($('#mailDanger').html() !== '') {
                    $('#mailDanger').slideUp();
                }
            }
        }
        function resetPhone() {
            if ($(fieldPhone).val() == "" || $(fieldPhone).val() == $(fieldPhone).val().match(/[\+]?[0-9\s]*[^a-zA-Z]/)) {
                $(fieldPhone).parent().removeClass('has-danger');
                $(fieldPhone).removeClass('form-control-danger');
                if ($('#phoneDanger').html() !== '') {
                    $('#phoneDanger').slideUp();
                }
            }
        }

        /*
         * Sprawdzanie podczas pisania
         */
        $(fieldName).blur(function () {
            testName();
        });

        $(fieldMail).on({
            blur: function () {
                testMail();
            },
            change: function () {
                resetPhone();
            }
        });

        $(fieldPhone).on({
            blur: function () {
                testPhone();
            },
            change: function () {
                resetMail();
            }
        });

        $(fieldMessage).blur(function () {
            testMessage();
        });

        $("#wsph_ebf_submit_btn").click(function () {

            /*
             * Sprawdzanie po kliknieciu przycisku
             */
            var proceed = true;
            if (!testName()) {
                proceed = false;
            }
            if (!testMail()) {
                proceed = false;
            }
            if (!testPhone()) {
                proceed = false;
            }
            if (!testMessage()) {
                proceed = false;
            }
            /*
             * Jesli ok, zaczynamy wysylke
             */
            if (proceed)
            {
//                Dane do wysłania
                        var post_data = {
                            'action': 'wsph_ebf_send',
                            'wsph_ebf_name': $(fieldName).val(),
                            'wsph_ebf_email': $(fieldMail).val(),
                            'wsph_ebf_phone': $(fieldPhone).val(),
                            'wsph_ebf_message': $(fieldMessage).val()
                        };
                //Przesłanie danych poprzez AJAX
                $.post(wsph_ebf_validation_setup.ajaxurl, post_data, function (response) {
                    //wczytanie danych zwrotnych JSON
                    if (response.success == true) {
                        output = '<div class="alert alert-success" role="alert">'
                                + response.data +
                                '</div>';
                        $('#front-contact-form input').val('');
                        $('#front-contact-form textarea').val('');
                    } else {
                        output = '<div class="alert alert-danger" role="alert">'
                                + response.data +
                                '</div>';
                    }

                    $("#result").hide().html(output).slideDown();
                }, 'json');

            }
        });

        /*
         * Reset validacji
         */
        $("#front-contact-form input, #front-contact-form textarea").focus(function () {
            $(this).parent().removeClass('has-danger has-success');
            $(this).removeClass('form-control-danger form-control-success');
            $("#result").slideUp();
            if ($(this).parent().nextUntil('span').html() !== '') {
                $(this).parent().nextUntil('span').slideUp();
            }
        });
    });
})(jQuery);