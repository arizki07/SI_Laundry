<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Pesan Anda</title>
</head>

<body style="font-family: Arial, sans-serif; color: #333; background-color: #f8f9fa; padding: 20px;">
    <div
        style="max-width: 600px; margin: auto; background-color: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
        <h2 style="color: #007bff;">Halo {{ $data['name'] }},</h2>

        <p>Terima kasih telah menghubungi <strong>Admin Laundry</strong>. Kami sangat menghargai waktu dan perhatian
            Anda.</p>

        <p>
            Kami telah menerima pesan Anda dengan subjek:
            <br>
            <strong style="color: #495057;">“{{ $data['subject'] }}”</strong>
        </p>

        <p>Berikut ini adalah salinan pesan Anda:</p>
        <blockquote style="border-left: 4px solid #007bff; padding-left: 15px; margin: 15px 0; color: #555;">
            {{ $data['message'] }}
        </blockquote>

        <p>Tim kami akan segera meninjau pesan Anda dan menghubungi Anda sesegera mungkin.</p>

        <p style="margin-top: 40px;">Salam hangat,</p>
        <p style="font-weight: bold; color: #007bff;">Admin Laundry</p>

        <hr style="margin-top: 40px;">
        <p style="font-size: 12px; color: #888;">
            Email ini dikirim secara otomatis. Mohon tidak membalas email ini secara langsung.
        </p>
    </div>
</body>

</html>
