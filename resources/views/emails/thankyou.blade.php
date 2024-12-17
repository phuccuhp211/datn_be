<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cảm ơn bạn</title>
</head>

<body>
    <h1>Chào {{ $sponsor['name'] }}</h1>
    <p>Cảm ơn bạn rất nhiều vì đã ủng hộ dự án "{{ $sponsor['project_name'] }}".</p>
    <p>Số tiền bạn ủng hộ: {{ number_format($sponsor['amount'], 0, ',', '.') }} VND</p>
    <p>Chúng tôi rất trân trọng sự đóng góp của bạn!</p>
    <p>Trân trọng, <br> Đội ngũ dự án</p>
</body>

</html>