import $ from 'jquery';

export default class DOMscan {
    constructor () {
        this.initEls();
        this.initEvents();
    }

    initEls () {
        this.$els = {
            checkChildren: $('.js-check-children'),
        }
    }

    initEvents () {
        this.checkChildren();
    }

    checkChildren () {
        this.$els.checkChildren.each( (e) => {
            var $this = $(e.currentTarget);
            if ($this.children().length == 0) {
                $this.addClass('sansEnfants');
            }
        });
    }
}