<link href="{{ asset('assets/extentions/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet">
<script src="{{ asset('assets/extentions/sweetalert2/sweetalert2.min.js') }}" defer></script>
{{-- <script src="{{ asset('assets/extentions/sweetalert2.js') }}" defer></script> --}}

<style>
    .alert-fade {
        transition: opacity 0.5s ease-out;
    }

    .fade-out {
        opacity: 0;
        transition: opacity 0.5s ease-out;
    }
</style>
<!-- End Alert -->

<!-- Alerts Unutuk menampilkan pemberitahuan sukses/gagal -->
@if (session()->get('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: "{{ session()->get('error') }}",
                showConfirmButton: true,
            });
        });
    </script>
@endif

@if (session()->get('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: "{{ session()->get('success') }}",
                showConfirmButton: true
            });
        });
    </script>
@endif

@if (count($errors) > 0)
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var errorMessages = @json($errors->all());

            for (var i = 0; i < errorMessages.length; i++) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: errorMessages[i],
                    showConfirmButton: true
                });
            }
        });
    </script>
@endif

{{-- delete --}}
{{-- <script>
    function confirmDelete(event, id) {
        event.preventDefault();
        Swal.fire({
            title: 'Hapus Data',
            html: `
                <center>
                    <lottie-player src="https://lottie.host/54b33864-47d1-4f30-b38c-bc2b9bdc3892/1xkjwmUkku.json"  
                        background="transparent"  speed="1"  style="width: 200px; height: 200px;"  loop autoplay>
                    </lottie-player>
                </center>
                <br>
                <h1 class="h4">Sedang menghapus data. Proses mungkin membutuhkan beberapa menit.</h1>
                <h1 class="h4">
                    <b class="text-danger">(Jangan menutup jendela ini, bisa mengakibatkan error)</b>
                </h1>
            `,
            showConfirmButton: false,
            showCancelButton: false,
            allowOutsideClick: false
        });

        setTimeout(function() {
            document.getElementById('deleteForm' + id).submit();
        }, 3000);
    }
</script> --}}

{{-- mulai_diagnosa --}}
{{-- <script>
    // Tambahkan event listener untuk tombol "Diagnosa"
    document.getElementById('diagnoseButton').addEventListener('click', function() {
        Swal.fire({
            icon: 'info',
            title: 'Diagnosa',
            html: `
                <center>
                    <lottie-player src="https://lottie.host/933bb0e2-47c0-4fa6-83f9-3330b433b883/yymyeZt49h.json"  
                        background="transparent"  speed="1"  style="width: 300px; height: 300px;"  loop autoplay>
                    </lottie-player>
                </center>
                <br>
                <h1 class="h4">Sedang memproses data. Proses mungkin membutuhkan beberapa menit.</h1>
                <h1 class="h4">
                    <b class="text-danger">(Jangan menutup jendela ini, bisa mengakibatkan error)</b>
                </h1>
            `,
            showConfirmButton: false, // Sembunyikan tombol konfirmasi
            showCancelButton: false, // Sembunyikan tombol pembatalan
            allowOutsideClick: false // Cegah penutupan dengan klik di luar
        });

        // Simulasikan proses diagnosa
        setTimeout(function() {
            // Submit form
            document.getElementById('diagnoseForm').submit();
        }, 3000); // Penundaan simulasi dalam milidetik (di sini: 3 detik)
        showDiagnoseAlert();
    });
</script> --}}
