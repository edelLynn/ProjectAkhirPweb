/* Eventra: jQuery untuk interaksi sederhana di sisi tampilan. */
$(function () {

    // 1. Tampilkan / sembunyikan password
    $('.toggle-password').on('click', function () {
        var $btn = $(this);
        var $input = $($btn.data('target'));
        var show = $input.attr('type') === 'password';

        $input.attr('type', show ? 'text' : 'password');
        $btn.attr('aria-pressed', show)
            .attr('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
        $btn.find('i').toggleClass('bi-eye', !show).toggleClass('bi-eye-slash', show);
    });

    // 2. Kolom NIM dan No HP hanya boleh angka
    $('.digits-only').on('input', function () {
        this.value = this.value.replace(/\D/g, '');
    });

    // 3. Konfirmasi hapus: isi modal sesuai peserta yang dipilih
    $('.btn-delete').on('click', function () {
        var $btn = $(this);
        var count = parseInt($btn.data('count'), 10) || 0;

        $('#deleteForm').attr('action', $btn.data('action'));
        $('#deleteName').text($btn.data('name'));

        var $warning = $('#deleteWarning');
        if (count > 0) {
            $warning.text('Peserta ini terdaftar di ' + count + ' kegiatan. Data pendaftaran dan kehadirannya ikut terhapus.')
                    .removeClass('d-none');
        } else {
            $warning.addClass('d-none');
        }
    });
});
