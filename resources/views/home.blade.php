@extends('layouts.template')

@section('content')
<div class="container">
	<div class="row justify-content-center pt-5">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body text-center">
					@livewire('disponibilidad-controller')
				</div>
			</div>
		</div>
	</div>
</div>
@endsection