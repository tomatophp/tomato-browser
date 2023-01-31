<x-tomato-admin-layout>
    <x-slot name="header">
        File Browser
    </x-slot>
    <x-slot name="headerBody">
        <div class="flex justify-start">
            <x-splade-link
                method="POST"
                :data="[
                'filePath'=> $current_path
              ]"
                href="{{route('admin.browser.upload')}}"
                class="mx-2 inline-flex items-center justify-center gap-2 px-4 font-medium tracking-tight text-white transition rounded-lg shadow focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 h-9 focus:ring-white">
                Upload File
            </x-splade-link>
            <x-tomato-logout />
        </div>
    </x-slot>

    <x-splade-data default="{

    }">
        <div class="flex justify-start space-x-2">
            <Link
                href="{{route('admin.browser.index')}}"
                class="inline-flex items-center justify-center gap-2 px-4 font-medium tracking-tight text-white transition rounded-lg shadow focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 h-9 focus:ring-white"
            >
                <i class="bx bx-home"></i>
                Home
            </Link>
            @if(isset($history) && url()->current() !== route('admin.browser.index'))
                <x-splade-form action="{{route('admin.browser.index')}}" method="POST" :default="[
                    'folder_path'=> $history['back_path'],
                    'folder_name'=> $history['back_name'],
                    'type'=>'back',
                ]">
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 px-4 font-medium tracking-tight text-white transition rounded-lg shadow focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 h-9 focus:ring-white"
                    >
                    <i class="bx bx-arrow-back"></i>
                        Back
                    </button>
                </x-splade-form>
            @endif
            @if(isset($path) && isset($ex) && $ex)
                <x-splade-form confirm action="{{route('admin.browser.destroy')}}" method="DELETE" :default="[
                    'path'=>$path,
                ]">
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center gap-2 px-4 font-medium tracking-tight text-white transition rounded-lg shadow focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset bg-red-600 hover:bg-red-500 focus:bg-red-700 focus:ring-offset-red-700 h-9 focus:ring-white"
                    >
                        <i class="bx bx-trash"></i>
                        Delete
                    </button>
                </x-splade-form>
            @endif
        </div>
        @if(isset($file) && $file)
            @if(
                isset($ex ) &&
                (
                    $ex === 'png' ||
                    $ex === 'jpg' ||
                    $ex === 'jpeg' ||
                    $ex === 'svg' ||
                    $ex === 'webp'
                )
            )
                <div class="mx-auto py-4">
                    <img src="data:image/png;base64,{{$file}}" />
                </div>
            @else
            <div class="font-sans my-4">
                <x-splade-form action="{{route('admin.browser.index')}}" method="POST" :default="[
                    'content'=> $file,
                    'path'=> $path,
                    'type'=>'save',
                ]">
                    <x-splade-input name="path" type="hidden" />
                    <x-splade-input name="type" type="hidden" />
                    <x-tomato-code name="content" ex="txt" />
                    <br />
                    <button
                        type="submit"
                        class="inline-flex items-center justify-center px-4 font-medium tracking-tight text-white transition rounded-lg shadow focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 h-9 focus:ring-white"
                    >
                        Save
                    </button>
                </x-splade-form>
            </div>
            @endif
        @elseif(count($folders) || count($files))
            <div class="grid gap-1 md:grid-cols-3 sm:grid-cols-2 my-6">
                @foreach($folders as $folder)
                    <x-splade-form method="POST" action="{{route('admin.browser.index')}}" :default="[
                        'folder_path'=> $folder['path'],
                        'folder_name'=>  $folder['name'],
                        'type'=>  'folder',
                    ]">
                        <button
                            type="submit"
                            class="bg-white flex flex-col items-center justify-center w-full p-4 font-medium text-center border rounded"
                        >
                            <i
                                class="item-center text-primary-500 bx bxs-folder bx-lg"
                            ></i>
                            {{ substr($folder['name'], 0,20) }}
                        </button>
                    </x-splade-form>
                @endforeach
                @foreach($files as $file)
                    <x-splade-form preserve-scroll method="POST" action="{{route('admin.browser.index')}}" :default="[
                        'file_path'=> $file['path'],
                        'file_name'=>  $file['name'],
                        'type'=>  'file',
                    ]">
                        <button
                            type="submit"
                            class="bg-white flex flex-col items-center justify-center w-full p-4 font-medium text-center border rounded"
                        >
                            @if(
                                isset($file['ex'] ) &&
                                (
                                    $file['ex'] === 'png' ||
                                    $file['ex'] === 'jpg' ||
                                    $file['ex'] === 'jpeg' ||
                                    $file['ex'] === 'svg' ||
                                    $file['ex'] === 'webp'
                                )
                            )
                                <i class="item-center text-primary-500 bx bxs-image bx-lg"></i>
                            @else
                                <i
                                    class="
                            item-center
                            bx
                            bx-lg
                                @if(isset($file['ex'] ) && $file['ex'] === 'md')
                                bxs-file-md
                                @elseif(isset($file['ex'] ) && $file['ex'] === 'js')
                                bxs-file-js
                                @elseif(isset($file['ex'] ) && $file['ex'] === 'json')
                                bxs-file-json
                                @else
                                bxs-file
                                @endif
                            "
                                ></i>
                            @endif
                            {{ substr($file['name'], 0, 20) }}
                        </button>
                    </x-splade-form>
                @endforeach
            </div>
        @else
            <div class="px-4 py-4 text-center">
                <i
                    class="mx-auto my-2 bx bx-search bx-lg item-center text-primary-500"
                ></i>
                <h1 class="text-3xl font-bold text-center">
                    Sorry No Folders or Files!
                </h1>
            </div>
        @endif

    </x-splade-data>
</x-tomato-admin-layout>
