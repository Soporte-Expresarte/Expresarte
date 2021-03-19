<x-crowdfunding-layout>
	@section('content')
		@livewire('crowdfunding.autorizar-proyecto-component', ['proyecto' => $proyecto])
	@endsection
</x-crowdfunding-layout>