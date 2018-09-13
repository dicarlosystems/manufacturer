@push('top_right_buttons')
	@if ($entityType == ENTITY_PRODUCT)
        {!! DropdownButton::normal(mtrans('manufacturer', 'manufacturer'))
            ->withAttributes([
                'class'=>'manufacturersDropdown'
            ])->withContents([
                [
                    'label' => mtrans('manufacturer', 'new_manufacturer'),
                    'url' => url('/manufacturers/create')
                ],
            ])->split() !!}

        <script type="text/javascript">
            $(function() {
                $('.manufacturersDropdown:not(.dropdown-toggle')
                    .click(function(event) {
                        openUrlOnClick('{{ url('/manufacturers') }}', event);
                    });
            });
        </script>
    @endif
  @endpush 