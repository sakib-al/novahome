import store from './store';

import Vue from 'vue'

import vSelect from 'vue-select'
Vue.component('v-select', vSelect)

Vue.component('create-purchase', require('./components/purchase/CreateComponent').default);

Vue.component('section-add-component', require('./components/section/SectionAddComponent').default);
Vue.component('section-add-main-component', require('./components/section/SectionAddMain').default);
Vue.component('section-update-main-component', require('./components/section/SectionUpdateMain').default);

Vue.component('slider-create', require('./components/slider/SliderCreate').default);
Vue.component('slider-update', require('./components/slider/SliderUpdate').default);

Vue.component('vote-create', require('../front/components/Vote').default);

Vue.component('event-form', require('../front/components/EventForm').default);
Vue.component('join-type', require('./components/event/JoinType').default);
Vue.component('join-type-update', require('./components/event/JoinTypeUpdate').default);
Vue.component('event-member-table', require('./components/event/memberTable').default);


Vue.component('fund-raiser-donation', require('./components/fundRaiser/Donation').default);
Vue.component('donation-form', require('./components/donation/DonationForm').default);

Vue.component('member-type-add', require('./components/member/MemberType').default);
Vue.component('member-type-update', require('./components/member/MemberUpdate').default);
Vue.component('member-form-create', require('./components/member/MemberForm').default);
Vue.component('member-form-frontend', require('../front/components/MemberForm').default);

const app = new Vue({
    store,
    el: '#app',
});

