<template>
	<span class="block-color" :style="style"></span>
</template>

<script>
export default {
	data() {
		return{
		}
	},
	props: ['color'],
	computed: {
		style() {
			return 'background-color: ' + this.color;
		}
	}
}
</script>

<style scoped>
	.block-color {
		display: inline-block;
		width: 15px;
		height: 15px;
	}
</style>