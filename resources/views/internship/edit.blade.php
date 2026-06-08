
@extends('partials.app')

@section('title', 'Internship Opportunities')

@section('content')
<div class="mx-auto max-w-2xl rounded-xl bg-white p-8 shadow-lg">
    <h2 class="mb-6 text-3xl font-semibold text-gray-900">Internship Opportunities</h2>

    <form action="{{ route('internship.update', $internship->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Internship Title:</label>
    <input
        type="text"
        name="title"
        class="input w-full"
        value="{{ old('title', $internship->title) }}"
    >

    @error('title')
        <span class="text-red-500">{{ $message }}</span>
    @enderror

    <br><br>

    <label>Description:</label>

    <textarea id="description" name="description">
{{ old('description', $internship->description) }}
    </textarea>

    @error('description')
        <span class="text-red-500">{{ $message }}</span>
    @enderror

    <br><br>

    <label>Required Skills:</label>
    <input
        type="text"
        name="required_skills"
        class="input w-full"
        value="{{ old('required_skills', $internship->required_skills) }}"
    >

    <br><br>

    <label>Location:</label>
    <input
        type="text"
        name="location"
        class="input w-full"
        value="{{ old('location', $internship->location) }}"
    >

    <br><br>

    <label>Deadline:</label>
<input
    type="date"
    name="deadline"
    class="input w-full"
    value="{{ old('deadline', isset($internship->deadline) ? date('Y-m-d', strtotime($internship->deadline)) : '') }}"
>

    <br><br>

    <button type="submit" class="btn btn-primary w-full">
        Update Internship
    </button>
</form>
    <!-- Place the first <script> tag in your HTML's <head> -->
      
      <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
        <script>
      tinymce.init({
        selector: '#description',
        plugins: [
          // Core editing features
          'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
          // Your account includes a free trial of TinyMCE premium features
          // Try the most popular premium features until Jun 16, 2026:
          'checklist', 'mediaembed', 'casechange', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'advtemplate', 'tinymceai', 'uploadcare', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
        ],
        toolbar: 'undo redo | tinymceai-chat tinymceai-quickactions tinymceai-review | blocks fontfamily fontsize | bold italic underline strikethrough | link media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography uploadcare | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
          { value: 'First.Name', title: 'First Name' },
          { value: 'Email', title: 'Email' },
        ],
        tinymceai_token_provider: async () => {
          await fetch(`https://demo.api.tiny.cloud/1/sj9g6whesejg7znyk9wjm6fm2xu5rspc8oxozeg4pss78nbc/auth/random`, { method: "POST", credentials: "include" });
          return { token: await fetch(`https://demo.api.tiny.cloud/1/sj9g6whesejg7znyk9wjm6fm2xu5rspc8oxozeg4pss78nbc/jwt/tinymceai`, { credentials: "include" }).then(r => r.text()) };
        },
        uploadcare_public_key: '2cbc95a02e8cf00527dd',
      });
    </script>
    </div>
@endsection


