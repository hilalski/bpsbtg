<script>
    Swal.fire({
        icon: '{{ $type }}',
        title: '{{ $title }}',
        text: '{{ $text }}',
        customClass: {
            confirmButton: 'status-custom-confirm-button',
            denyButton: 'status-custom-deny-button',
            cancelButton: 'status-custom-cancel-button',
        }
    });
</script>