<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pesan Baru dari Pengunjung</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f0f2f5; padding: 20px; color: #333;">
    <div style="max-width: 600px; margin: auto; background-color: #ffffff; border-radius: 8px; padding: 30px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        <h2 style="color: #dc3545; border-bottom: 1px solid #eee; padding-bottom: 10px;">📬 Pesan Baru dari {{ $data['name'] }}</h2>

        <p><strong>📧 Email:</strong> {{ $data['email'] }}</p>
        <p><strong>📝 Subjek:</strong> {{ $data['subject'] }}</p>

        <p style="margin-top: 20px;"><strong>💬 Pesan:</strong></p>
        <blockquote style="border-left: 4px solid #dc3545; padding-left: 15px; color: #555; background-color: #f8f9fa; margin: 15px 0;">
            {{ $data['message'] }}
        </blockquote>

        <hr style="margin-top: 30px;">
        <p style="font-size: 12px; color: #888;">
            Pesan ini dikirim melalui formulir kontak di website Laundry.
        </p>
    </div>
</body>
</html>
