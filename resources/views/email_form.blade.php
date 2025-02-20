<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Mail with PHPMailer</title>
</head>
<body>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p style="color: red;">{{ session('error') }}</p>
    @endif

    <form action="{{ route('send.mail') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label>Recipient Email:</label>
        <input type="email" name="recipient_email" required><br><br>

        <label>Subject:</label>
        <input type="text" name="subject" required><br><br>

        <label>Message:</label>
        <textarea name="message" required></textarea><br><br>

        <label>Attachment (Optional):</label>
        <input type="file" name="attachment"><br><br>

        <button type="submit">Send Email</button>
    </form>

</body>
</html>
