<input name="{{ $name }}" type="file" class="imageUpload form-control-file {{ $errors->first($name) ? 'is-invalid' : '' }}" 
id="{{ $name }}" data-id="{{ $name }}-show" >
{{--  onchange="readURL(this, '{{ $name }}-show')" --}}
<img src="{{ $value ? asset( $path. $value) : asset('uploads/no-img.png') }}" id="{{ $name }}-show" class="mt-2 img-fluid img-thumbnail" width="200px">
