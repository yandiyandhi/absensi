<!-- ========= JS Files =========  -->
<!-- Bootstrap -->
<script src="{{ asset('assets/js/lib/bootstrap.bundle.min.js') }}"></script>
<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@7/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7/dist/ionicons/ionicons.js"></script>
<!-- Splide -->
<script src="{{ asset('assets/js/plugins/splide/splide.min.js') }}"></script>
<!-- Base Js File -->
<script src="{{ asset('assets/js/base.js') }}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const alertBox = document.getElementById('floating-alert');

        if (alertBox) {
            // tampilkan
            setTimeout(() => {
                alertBox.classList.add('show-custom');
            }, 100);

            // auto hide setelah 3 detik
            setTimeout(() => {
                alertBox.classList.remove('show-custom');

                // hapus dari DOM biar bersih
                setTimeout(() => {
                    alertBox.remove();
                }, 400);
            }, 3000);
        }
    });
</script>
