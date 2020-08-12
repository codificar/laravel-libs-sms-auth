<template>
	<b-modal ref="modal" @hidden="$emit('hidden')" @ok="$emit('ok')">
		<form>
			<label for="">Cor do tema</label>
			<b-form-input type="color" v-model="theme.theme_color"></b-form-input>
			<label for="">Cor primária</label>
			<b-form-input type="color" v-model="theme.primary_color"></b-form-input>
			<label for="">Cor secundária</label>
			<b-form-input type="color" v-model="theme.secondary_color"></b-form-input>
			<label for="">Cor do hover</label>
			<b-form-input type="color" v-model="theme.hover_color"></b-form-input>
			<label for="">Cor ativa</label>
			<b-form-input type="color" v-model="theme.active_color"></b-form-input>
		</form>
	</b-modal>
</template>

<script>
import { BModal, BFormInput } from "bootstrap-vue";
export default {
	data() {
		return { }
	},
	components: {
		BModal, BFormInput
	},
	watch: {
		show: function (newValue, oldValue) {
			if(newValue) {
				this.$refs.modal.show();
			} 
		}
	},
	props: ['theme', 'show']
}
</script>

<style lang="scss">
	// @import 'css/custom.scss';
	// @import 'node_modules/bootstrap/scss/bootstrap';
	// @import 'node_modules/bootstrap-vue/src/index.scss';
	.modal-backdrop {
		opacity: 0.5;
	}
</style>