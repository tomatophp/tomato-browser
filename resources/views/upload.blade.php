<x-tomato-admin-container label="{{trans('tomato-browser::global.upload-title')}}">
    <x-splade-form :default="['media'=> [],'path' => $filePath]" class="flex flex-col gap-4" action="{{route('admin.browser.store')}}" method="post">
        <x-splade-input name="path" type="hidden" />
        <x-splade-file name="media" id="file" :label="trans('tomato-browser::global.upload-input')" filepond multiple />

        <div class="flex justify-start gap-2 pt-3">
            <x-tomato-admin-submit  label="{{__('Upload')}}" :spinner="true" />
            <x-tomato-admin-button secondary :href="route('admin.browser.index')" label="{{__('Cancel')}}"/>
        </div>
    </x-splade-form>
</x-tomato-admin-container>
