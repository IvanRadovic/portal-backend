@extends('layouts.layoutMaster')

@section('vendor-style')
    {{-- editor --}}
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/typography.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/katex.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/quill/editor.css')}}" />
@endsection

@section('vendor-script')
    {{-- editor --}}
    <script src="{{asset('assets/vendor/libs/quill/katex.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/quill/quill.js')}}"></script>
@endsection

@section('vendor-script')
    {{-- editor --}}
    <script src="{{asset('assets/vendor/libs/quill/katex.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/quill/quill.js')}}"></script>
@endsection

@section('page-script')
    {{-- editor --}}
    <script>
        // Full Toolbar Editor
        // --------------------------------------------------------------------
        const fullToolbar = [
            [
                {
                    font: []
                },
                {
                    size: []
                }
            ],
            ['bold', 'italic', 'underline', 'strike'],
            [
                {
                    color: []
                },
                {
                    background: []
                }
            ],
            [
                {
                    script: 'super'
                },
                {
                    script: 'sub'
                }
            ],
            [
                {
                    header: '1'
                },
                {
                    header: '2'
                },
                'blockquote',
                'code-block'
            ],
            [
                {
                    list: 'ordered'
                },
                {
                    list: 'bullet'
                },
                {
                    indent: '-1'
                },
                {
                    indent: '+1'
                }
            ],
            [{ direction: 'rtl' }],
            ['link', 'image', 'video', 'formula'],
            ['clean']
        ];
        const quillContainer = document.querySelector('#full-editor');
        const fullEditor = new Quill(quillContainer, {
            bounds: '#full-editor',
            placeholder: 'Type Something...',
            modules: {
                formula: true,
                toolbar: fullToolbar
            },
            theme: 'snow'
        });

        document.getElementById('form').addEventListener('submit', function () {
            event.preventDefault();
            alert('asdfasdfasdf');

            const editorContent = fullEditor.root.innerHTML;
            console.log(editorContent);
            $("#hiddenArea").val(editorContent);

            document.getElementById('form').submit();
        });
    </script>
@endsection

@section('content')
    <div id="createArticleModal">
        <div class="modal-content">
            @include('_part.msg')
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h2 class="text-xl font-bold mb-4">AUTHOR: {{ $author->name }} {{ $author->lastname}}</h2>
                                    <!-- Delete Form -->
                                    <form action="{{ route('authors.destroy', $author->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </div>

                            <form action="{{ route('authors.update', $author->id) }}" method="POST" class="row g-3" id="form" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="col-12">
                                    <div class="">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Logo:</label>
                                        <input type="file" id="name" name="cover" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                        <input type="text" id="name" name="name" value="{{ $author->name }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="">
                                        <label for="name" class="block text-sm font-medium text-gray-700">Lastname</label>
                                        <input name="lastname" type="text" value="{{ $author->lastname }}"  class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="">
                                        <label for="type" class="block text-sm font-medium text-gray-700">Type of author:</label>
                                        <input type="text" id="type" name="type" value="{{ $author->type }}" class="form-control" required>
                                    </div>
                                </div>
                                <!-- Full Editor -->
                                <div class="col-12">
                                    <div class="">
                                        <h5 class="card-header">Content</h5>
                                        <div class="card-body">
                                            <div id="full-editor">{!! $author->biography !!}</div>
                                        </div>

                                        <textarea name="biography" id="hiddenArea" style="visibility: hidden"></textarea>
                                    </div>
                                </div>
                                <!-- /Full Editor -->

                                <div class="col-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <button type="submit" name="submitButton" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
