<SpladeTable {{ $attributes->except('class') }}
    :striped="@js($striped)"
    :columns="@js($table->columns())"
    :search-debounce="@js($searchDebounce)"
    :default-visible-toggleable-columns="@js($table->defaultVisibleToggleableColumns())"
    :items-on-this-page="@js($table->totalOnThisPage())"
    :items-on-all-pages="@js($table->totalOnAllPages())"
    :base-url="@js(request()->url())"
    :pagination-scroll="@js($paginationScroll)"
    :splade-id="@js($spladeId = $table->getSpladeId())"
>
    <template #default="{!! $scope !!}">
        <div {{ $attributes->only('class') }} :class="{ 'opacity-50': table.isLoading }" data-splade-id="{{ $spladeId }}">
            @if($hasControls())
                @include('splade::table.controls')
            @endif
            <x-splade-component is="table-wrapper">
                <table class="min-w-full divide-y divide-gray-200 bg-grey">
                  @include('splade::table.head')
                    @isset($body)
                        {{ $body }}
                    @else
                        @include('splade::table.body')
                    @endisset
                </table>
            </x-splade-component>
            @if($showPaginator())
                {{ $table->resource->links($paginationView, ['table' => $table, 'hasPerPageOptions' => $hasPerPageOptions()]) }}
            @endif
        </div>
    </template>
</SpladeTable>