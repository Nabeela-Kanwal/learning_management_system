@props([
    'name' => 'status', // input name
    'value' => null, // current status value (0 or 1)
])

@php
    $oldStatus = old($name, $value ?? '0');
    $checked = $oldStatus == '1' ? 'checked' : '';

    // Unique IDs to allow multiple switches on same page
    $switchId = $name . '_switch_' . uniqid();
    $labelId = $name . '_label_' . uniqid();
@endphp

<div class="form-check form-switch mb-3">
    <input type="hidden" name="{{ $name }}" value="0" />
    <input class="form-check-input" type="checkbox" name="{{ $name }}" id="{{ $switchId }}" value="1"
        {{ $checked }}>
    <label class="form-check-label" for="{{ $switchId }}" id="{{ $labelId }}">
        {{ $checked ? 'Active' : 'Inactive' }}
    </label>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const switchInput = document.getElementById('{{ $switchId }}');
        const label = document.getElementById('{{ $labelId }}');

        function updateLabel() {
            label.textContent = switchInput.checked ? 'Active' : 'Inactive';
        }

        switchInput.addEventListener('change', updateLabel);
        updateLabel();
    });
</script>
