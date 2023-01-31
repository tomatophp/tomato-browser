<x-tomato-admin-layout>
    <x-slot name="header">
        Upload File
    </x-slot>
    <x-slot name="headerBody">
        <Link
            href="{{route('admin.browser.index')}}"
            class="inline-flex items-center justify-center gap-2 px-4 font-medium tracking-tight text-white transition rounded-lg shadow focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 h-9 focus:ring-white"
        >
        <i class="bx bx-home"></i>
            Home
        </Link>
    </x-slot>

    <x-splade-form :default="['media'=> [],'path' => $filePath]" class="flex flex-col space-y-4" action="{{route('admin.browser.store')}}" method="post">
        <x-splade-input name="path" type="hidden" />
        <x-splade-file name="media" id="file" label="Select Your File To Upload" filepond multiple />
        <x-splade-submit label="Upload" :spinner="true" />
    </x-splade-form>
</x-tomato-admin-layout>
