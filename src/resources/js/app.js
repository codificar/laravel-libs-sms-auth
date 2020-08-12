window.vue = require('vue');
import "vue-methods";

require('lodash');

import Vue from 'vue';

import ThemeList from './components/theme_list.vue';

//Main vue instance
new Vue({
	el: '#ThemeVue',

	components: {
		ThemeList
	},

	created: function () {
	}
})