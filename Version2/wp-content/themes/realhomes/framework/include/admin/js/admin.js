(function ($, settings) {
    "use strict";

    var inspiryPlugin = {
        ajaxNonce: settings.ajax_nonce,
        l10n: settings.l10n,
        installArgs: function () {
            return {
                label: this.l10n.activateNow,
                updateMessage: this.l10n.installing,
                successMessage: this.l10n.installed,
                removeClass: 'install-now',
                addClass: 'activate-now',
            };
        },
        activateArgs: function () {
            return {
                label: this.l10n.active,
                updateMessage: this.l10n.activating,
                successMessage: this.l10n.activated,
                removeClass: 'activate-now',
                addClass: 'button-disabled',
            };
        },
        ajax: function (button, args) {
            var originalText = button.text(),
                failed = this.l10n.failed;

            $.ajax({
                type: "post",
                dataType: "json",
                url: ajaxurl,
                data: args.data,
                beforeSend: function () {
                    button.addClass('updating-message');
                    if (args.updateMessage) {
                        button.text(args.updateMessage);
                    }
                },
                success: function (response) {
                    button.removeClass('updating-message');
                    if (response.success) {
                        button.text(args.successMessage).addClass('updated-message');
                        setTimeout(function () {
                            button.removeClass('updated-message');
                            button.text(args.label).addClass(args.addClass).removeClass(args.removeClass);
                        }, 1000);
                    } else {
                        button.text(failed);
                        setTimeout(function () {
                            button.text(originalText);
                        }, 1000);
                    }
                }
            });
        },
        install: function (button) {
            var args = this.installArgs();

            args.data = {
                action: 'inspiry_install_plugin',
                slug: button.data('slug'),
                plugin: button.data('plugin'),
                source: button.data('source'),
                _ajax_nonce: this.ajaxNonce,
            };

            this.ajax(button, args);
        },
        activate: function (button) {
            var args = this.activateArgs();

            args.data = {
                action: 'inspiry_activate_plugin',
                slug: button.data('slug'),
                plugin: button.data('plugin'),
                _ajax_nonce: this.ajaxNonce,
            };

            this.ajax(button, args);
        }
    };

    $(document).ready(function () {
        var $inspiryPluginCards = $(".inspiry-plugin-card-wrapper"),
            $inspiryPluginFilter = $("#inspiry-plugin-filter");

        /**
         * Click handler for plugin install and activation.
         */
        $inspiryPluginCards.on('click', '.button', function (event) {
            var $button = $(this);

            if (!$button.hasClass('download-link')) {
                event.preventDefault();
            }

            if ($button.hasClass('download-link') || $button.hasClass('updating-message') || $button.hasClass('button-disabled')) {
                return;
            }

            if ($button.hasClass('install-now')) {
                inspiryPlugin.install($button);
            } else if ($button.hasClass('activate-now')) {
                inspiryPlugin.activate($button);
            }
        });

        /**
         * Realhomes plugin filters
         */
        $inspiryPluginFilter.on('click', 'a', function (event) {
            event.preventDefault();

            var $this = $(this),
                $filter = $this.data('filter');

            $inspiryPluginFilter.find('a').removeClass('active');
            $this.addClass('active');
            $inspiryPluginCards.hide();
            $inspiryPluginCards.filter($filter).show();
        });

        /**
         * Feedback from validation and ajax request
         */
        $("#inspiry-feedback-form").on('click', '.button', function (event) {
            event.preventDefault();
            var $response_msg = $("#inspiry-feedback-form-success"),
                $error_msg = $("#inspiry-feedback-form-error"),
                $email = $("#inspiry-feedback-form-email").val(),
                $feedback = $("#inspiry-feedback-form-textarea").val(),
                data = {
                    action: 'inspiry_send_feedback',
                    inspiry_feedback_form_nonce: $("#inspiry_feedback_form_nonce").val(),
                },
                clear = function () {
                    setTimeout(function () {
                        $response_msg.html('');
                        $error_msg.html('');
                    }, '3000');
                };

            $response_msg.html('');
            $error_msg.html('');

            if ($email) {
                data.inspiry_feedback_form_email = $email;

                if ($feedback) {
                    data.inspiry_feedback_form_textarea = $feedback;
                } else {
                    $error_msg.html('Please add your feedback before send.');
                }
            } else {
                $error_msg.html('Please provide a valid email address.');
            }

            if ($email && $feedback) {
                $.post(ajaxurl, data, function (response) {
                    if (response.success) {
                        document.getElementById("inspiry-feedback-form").reset();
                        $response_msg.html(response.message);
                    } else {
                        $error_msg.html(response.message);
                    }
                    clear();
                }, 'json');
            }
        });
    });
})(jQuery, window.inspiryPluginsSettings);