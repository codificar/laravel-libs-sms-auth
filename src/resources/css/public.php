<?php
$default_theme_id = \Settings::findByKey('default_theme');
$theme = Theme::find($default_theme_id);
if ($theme) {
?>

	body {
		color: #000;
	}
	.content {
		width: auto;
		margin: auto;
		height: auto;
		overflow: hidden;
		display: flex;
		align-content: center;
		flex-direction: column;
	}

	.info-charge>*,
	.row-item {
		height: 51px;
		margin-top: 7px;
		display: flex;
		align-items: center;
	}

	.row-item {
		background-color: <?= $theme->theme_color; ?>;
		padding-left: 27px;
	}

	.info-item {
		background-color: <?= $theme->theme_color; ?>;
		border-left: 1px solid #AAA;
	}

	.dark {
		background-color: <?= $theme->primary_color; ?>;
		color: #fff;
	}

	.info-item::before {
		font-family: FontAwesome;
		color: <?= $theme->active_color; ?>;
		content: "\f0d9";
		display: block;
		position: absolute;
		top: 12px;
		left: -6px;
	}

	.icon {
		font-size: 2rem;
		padding: 0 10px;
	}


	.filter {
		background: <?= $theme->theme_color; ?>;
		float: left;
		font-size: 11px;
		padding: 15px;
		width: 80%;
		margin: 0 20px;
	}

	.filter .filter-title {
		text-align: center;
		font-size: 15px;
		margin-bottom: 15px;
		padding: 10px 0;
		background: <?= $theme->active_color; ?>;
		border-radius: 4px;
	}

	.divider {
		border: solid 1px <?= $theme->primary_color; ?>;
		margin: 10px 4px;
	}

	.btn-secondary {
		color: #fff !important;
		background-color: <?= $theme->primary_color; ?> !important;
		border-color: #505050;
	}

	.btn {
		display: inline-block;
		margin-bottom: 0;
		font-weight: 400;
		text-align: center;
		vertical-align: middle;
		touch-action: manipulation;
		cursor: pointer;
		background-image: none;
		border: 0 none;
		white-space: nowrap;
		padding: 10px 15px;
		font-size: 12px;
		line-height: 1.428571429;
		border-radius: 4px;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
	}

	a.btn-secondary:hover {
		background-color: <?= $theme->primary_color; ?>;
		color: #fff;
	}

	.btn-wide {
		width: 100%;
	}

	.filter .filter-item-text {
		float: left;
		line-height: 25px;
		overflow: hidden;
		cursor: default;
	}

	.filter .filter-close {
		float: right;
		cursor: pointer;
		filter: alpha(opacity=60);
		opacity: .6;
	}

	.filter .filter-item {
		height: auto;
		padding: 3px 8px 0;
		background: <?= $theme->theme_color; ?>;
		margin-bottom: 3px;
	}

	.filter .selected-filters {
		display: flex;
		flex-direction: column;
	}

	.filter-options {
		display: flex;
		flex-direction: column;
	}

	label {
		font-size: 0.8rem;
		color: #9e9e9e;
	}

	.option:hover {
		background-color: <?= $theme->active_color; ?>;
		cursor: pointer;
	}

	.sub-options {
		padding-left: 1em;
		display: flex;
		flex-direction: column;
	}

	.sub-option {
		border-left: #9e9e9e 1px solid;
		padding-left: 5px;
	}

	.align-between {
		color: #55F;
		display: flex;
		justify-content: space-between;
	}

	.align-between button {
		border: none;
		padding: 0;
		background: none;
	}

	section {
		float: left;
	}

	<?php
		$lineHeight = '30px';
		$lineDouble = '60px';
		$mainWidth = '1029px';
	?>
	.result {
		width: <?= $mainWidth; ?>;
		height: auto;
		margin-bottom: 10px;
		background-color: <?= $theme->theme_color ?>; 
		overflow: hidden;
	}

	.result-amount {
		float: left;
		width: 749px;
		height: auto;
		padding: 12px;
		overflow: hidden;
	}

	.result-order {
		float: left;
		width: 94px;
		height: auto;
		padding: 12px 0 12px 12px;
		overflow: hidden;
	}

	.result-order-types {
		float: left;
		width: 143px;
		height: auto;
		padding: 7px 7px 7px 0;
		overflow: hidden;
	}

	.result-list-data {
		width: <?= $mainWidth; ?>;
		height: auto;
		padding: 10px 0;
		border: 0 20px;
	}

	.result-list-data-main {
		width: <?= $mainWidth; ?>;
		height: <?= $lineDouble; ?>;
		overflow: hidden;
		border-left: 1px solid $dark;
		cursor: pointer;
	}

	.data-col1 {
		float: left;
		width: 358px;
		height: <?= $lineDouble; ?>;
		overflow: hidden;
	}

	.data-col1 .data-col1-line {
		width: 303px;
		height: <?= $lineHeight; ?>;
		padding: 5px 0 5px 5px;
		overflow: hidden;
	}

	.data-col2 {
		float: left;
		width: 250px;
		height: <?= $lineDouble; ?>;
		overflow: hidden;
	}

	.data-col2 .data-col2_line {
		width: 253px;
		height: <?= $lineHeight; ?>;
		padding: 5px 0 5px 5px;
		overflow: hidden;
	}

	.data-col3 {
		float: left;
		width: 250px;
		height: <?= $lineDouble; ?>;
		overflow: hidden;
	}

	.data-col3 .data-col3_line {
		width: 253px;
		height: <?= $lineHeight; ?>;
		padding: 5px 0 5px 5px;
		overflow: hidden;
	}

	.data-col4 {
		float: left;
		width: 37px;
		height: <?= $lineDouble; ?>;
		overflow: hidden;
	}

	.data-col5 {
		float: left;
		width: 100px;
		height: <?= $lineDouble; ?>;
	}

	.col5-image {
		position: relative;
		width: 100px;
		height: <?= $lineDouble; ?>;
		top: 0;
		left: 0;
		z-index: 1;
		overflow: hidden;
	}

	.col5-frame-image {
		position: relative;
		width: 100px;
		height: 46px;
		left: -2px;
		top: -50px;
		right: -5px;
		overflow: hidden;
		z-index: 2;
		border: solid 2px $light;
	}

	.result-list-data-obs {
		width: <?= $mainWidth; ?>;
		height: <?= $lineHeight; ?>;
		overflow: hidden;
		padding: 5px;
		margin-top: 5px;
		background-color: <?= $theme->secondary_color; ?>
	}

	.modal-backdrop {
		opacity: 0.5;
	}


<?php } ?>