<div class="form-group">
    <label for="{{ $name }}">{{ ucfirst(str_replace('_', ' ',$name)) }} @if($required) <span class="text-danger">*</span> @endif</label>
    <input type="{{ $type }}" class="form-control" id="{{ $name }}" name="{{ $name }}" placeholder="{{ $placeholder }}" value="{{$value}}" @if($required) required @endif @if($disabled) disabled @endif>
</div>
