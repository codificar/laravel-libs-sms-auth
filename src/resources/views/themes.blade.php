@extends('layout.master')
@section('breadcrumbs')
<div class="row page-titles">
	<div class="col-md-6 col-8 align-self-center">
		<h3 class="text-themecolor m-b-0 m-t-0">{{ trans("setting.conf") }}</h3>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="javascript:void(0)">{{ trans("dashboard.home") }}</a></li>
			<li class="breadcrumb-item active">{{ trans("setting.conf") }}</li>
			<li class="breadcrumb-item active">{{ trans("setting.themes")}}</li>
		</ol>
	</div>
</div>
@stop

@section('content')
<div id="ThemeVue">
	<theme-list></theme-list>
</div>

<script src="/js/lang.trans/requests,dashboard,setting"> </script>
<!-- <script src="/js/lang.trans/detail"> </script> -->
<script src="{{asset(mix('js/app.js', 'vendor/laravel-themes'))}}"> </script>
@stop