@php
    // Replace $category->status with your actual status variable
    $oldStatus = old('status', $category->status ?? '0');
    $checked = $oldStatus == '1' ? 'checked' : '';
@endphp

<div class="form-check form-switch mb-3">
    <input type="hidden" name="status" value="0" />
    <input class="form-check-input" type="checkbox" name="status" id="statusSwitch" value="1" {{ $checked }}>
    <label class="form-check-label" for="statusSwitch" id="statusLabel">
        {{ $checked ? 'Active' : 'Inactive' }}
    </label>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const switchInput = document.getElementById('statusSwitch');
        const label = document.getElementById('statusLabel');

        function updateLabel() {
            label.textContent = switchInput.checked ? 'Active' : 'Inactive';
        }

        switchInput.addEventListener('change', updateLabel);
        updateLabel();
    });
</script>
