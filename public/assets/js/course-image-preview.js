document.querySelectorAll('[data-course-image-input]').forEach(function (container) {
    const input = container.querySelector('input');
    const preview = container.querySelector('[data-image-preview]');
    const image = preview.querySelector('img');
    const error = container.querySelector('[role="alert"]');
    const originalImage = image.getAttribute('src');
    let previewUrl = null;

    function restoreImage() {
        if (previewUrl) URL.revokeObjectURL(previewUrl);
        previewUrl = null;
        if (originalImage) image.src = originalImage;
        else image.removeAttribute('src');
        preview.hidden = !originalImage;
    }

    input.addEventListener('change', function () {
        restoreImage();
        error.hidden = true;
        error.textContent = '';
        const file = input.files[0];
        if (!file) return;

        if (!['image/jpeg', 'image/png', 'image/webp'].includes(file.type) || file.size > 2 * 1024 * 1024) {
            input.value = '';
            error.textContent = 'Choose a JPG, PNG or WebP image up to 2 MB.';
            error.hidden = false;
            return;
        }

        previewUrl = URL.createObjectURL(file);
        image.src = previewUrl;
        preview.hidden = false;
    });

    input.form.addEventListener('reset', function () {
        restoreImage();
        error.hidden = true;
        error.textContent = '';
    });
});
