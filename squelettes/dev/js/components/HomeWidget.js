import $ from 'jquery';
import 'slick-carousel';

export default class HomeWidget {
    constructor () {
        $(document).ready(() => {
            this.initEls();
            this.initEvents();
            
        });
    }

    initEls () {
        this.$els = {
            widget: $('.js-HomeWidget'),
            list: $('.js-HomeWidget ul')
        }
    }

    initEvents () {
        this.initSlick();
        console.log(this.$els.list);
    }

    initSlick () {
        this.$els.list.slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            autoplay: true,
            autoplaySpeed: 4000
          });
    }
}