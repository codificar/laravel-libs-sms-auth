<script>
import color from './color';
import FormThemeModal from './form_theme_modal';
import { BDropdown, BDropdownItem, BButton } from "bootstrap-vue";
export default {
	data() {
		return {
			themes: [],
			selectedTheme: {},
			showModal: false
		}
	},
	components: {
		color, FormThemeModal, BDropdown, BDropdownItem, BButton
	},
	methods: {
		openModal(theme = {}) {
			this.showModal = true;
			this.selectedTheme = theme;
		},
		saveTheme() {
			this.$axios.post('theme/save', this.selectedTheme).then(response => {
				if(! this.selectedTheme.id) {
					document.location.reload(true);
				}
			}).catch(err => {
				console.log(err)
			})
		},
		applyTheme(id) {
			this.$axios.post('theme/apply', {id}).then(response => {
				document.location.reload(true);
			}).catch(err => {
				console.log(err)
			})
		},
		erase(index) {
			console.log(this.themes[index].id);
			this.$axios.delete('theme', {params: {id: this.themes[index].id}}).then(response => {
				if(response.data.success){
					this.themes.splice(index, 1);
				} else {
					console.log('ERROR')
				}
			})
		}
	},
	mounted() {
		this.$axios.get('themes/list').then(response => {
			this.themes = response.data;
		})
	}
}
</script>

<template>
	<div class="card card-outline-info">
	<div class="card-header">
		<h4 class="m-b-0 text-white">{{trans('setting.themes')}}</h4>
	</div>
	<div class="card-block">
		<table class="table">
			<thead>
				<th>ID</th>
				<th>Cor do Tema</th>
				<th>Cor Primária</th>
				<th>Cor Secundária</th>
				<th>Cor do Hover</th>
				<th>Cor Ativa</th>
				<th>Ações</th>
			</thead>
			<tbody>
				<tr v-for="(theme, index) in themes" :key="theme.id">
					<td>{{theme.id}}</td>
					<td><color :color="theme.theme_color" />{{theme.theme_color}}</td>
					<td><color :color="theme.primary_color" />{{theme.primary_color}}</td>
					<td><color :color="theme.secondary_color" />{{theme.secondary_color}}</td>
					<td><color :color="theme.hover_color" />{{theme.hover_color}}</td>
					<td><color :color="theme.active_color" />{{theme.active_color}}</td>
					<td>
						<b-dropdown id="actions-dropdown" text="Ações" variant="primary">
							<b-dropdown-item @click="applyTheme(theme.id)">Aplicar este tema</b-dropdown-item>
							<b-dropdown-item v-if="theme.id != 1" @click="openModal(theme)">Editar</b-dropdown-item>
							<b-dropdown-item v-if="theme.id != 1" @click="erase(index)">Apagar</b-dropdown-item>
						</b-dropdown>
					</td>
				</tr>
			</tbody>
		</table>
		<b-button variant="success" @click="openModal()">Novo</b-button>
		<form-theme-modal :show="showModal" :theme="selectedTheme" @hidden="showModal = false" @ok="saveTheme()"></form-theme-modal>
	</div>
</div>
</template>


<style>

</style>