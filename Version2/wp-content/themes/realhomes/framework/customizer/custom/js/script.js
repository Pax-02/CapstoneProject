(function ($) {
    "use strict";

    function inspiryDragdropControl(section_id) {

        var dragSrcEl = null;

        function handleDragStart(e) {
            this.style.opacity = '0.4';

            dragSrcEl = this;

            e.dataTransfer.effectAllowed = 'move';
            e.dataTransfer.setData('text/html', this.innerHTML);
        }

        function handleDragOver(e) {
            if (e.preventDefault) {
                e.preventDefault();
            }

            e.dataTransfer.dropEffect = 'move';

            return false;
        }

        function handleDragEnter(e) {
            this.classList.add('over');
        }

        function handleDragLeave(e) {
            this.classList.remove('over');
        }

        function handleDrop(e) {

            if (e.stopPropagation) {
                e.stopPropagation();
            }

            if (dragSrcEl != this) {
                dragSrcEl.innerHTML = this.innerHTML;
                this.innerHTML = e.dataTransfer.getData('text/html');
            }

            return false;
        }

        function handleDragEnd(e) {

            this.style.opacity = '1';

            [].forEach.call(sections, function (section) {
                section.classList.remove('over');
            });

            var optionTexts = [];
            jQuery('#sections_' + section_id + ' .section').each(function () {
                optionTexts.push(jQuery(this).children('span').data('value'))
            });

            var quotedCSV = optionTexts.join(',');

            var db_input = jQuery('#' + section_id);
            db_input.val(quotedCSV).trigger('change');
        }

        var sections = document.querySelectorAll('#sections_' + section_id + ' .section');
        [].forEach.call(sections, function (section) {
            section.addEventListener('dragstart', handleDragStart, false);
            section.addEventListener('dragenter', handleDragEnter, false);
            section.addEventListener('dragover', handleDragOver, false);
            section.addEventListener('dragleave', handleDragLeave, false);
            section.addEventListener('drop', handleDrop, false);
            section.addEventListener('dragend', handleDragEnd, false);
        });
    }

    $(window).on('load', function () {
        var $inspiryDragdropControlIds = $(".inspiry-dragdrop-control-id");
        if ($inspiryDragdropControlIds.length) {
            if (typeof $inspiryDragdropControlIds === 'object') {
                $.each($inspiryDragdropControlIds, function (i, section) {
                    var id = $(section).data('id');
                    inspiryDragdropControl(id);
                });
            }
        }
    });
})(jQuery);