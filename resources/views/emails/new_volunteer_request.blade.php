<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            background: #007BFF;
            color: #fff;
            padding: 10px 0;
            border-radius: 8px 8px 0 0;
        }

        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .email-content {
            margin: 20px 0;
        }

        .email-content p {
            margin: 10px 0;
        }

        .email-content strong {
            color: #007BFF;
        }

        .email-footer {
            text-align: center;
            font-size: 14px;
            color: #666;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Yêu Cầu Tham Gia Tình Nguyện Mới</h1>
        </div>
        <div class="email-content">
            <p>Kính gửi Quản trị viên,</p>
            <p>Chúng tôi vừa nhận được một yêu cầu tham gia tình nguyện mới. Dưới đây là thông tin chi tiết của ứng
                viên:</p>
            <p><strong>Họ và tên:</strong> {{ $formRequest->name }}</p>
            <p><strong>Email:</strong> {{ $formRequest->email }}</p>
            <p><strong>Số điện thoại:</strong> {{ $formRequest->phone }}</p>
            <p><strong>Lời nhắn:</strong> {{ $formRequest->message }}</p>
            <p>Vui lòng xem xét thông tin ứng viên và phản hồi sớm để đảm bảo trải nghiệm tốt nhất cho các tình nguyện
                viên của chúng ta.</p>
        </div>
        <div class="email-footer">
            <p>Đây là email tự động. Vui lòng không trả lời trực tiếp.</p>
            <p>Cảm ơn bạn đã hỗ trợ hệ thống tình nguyện của chúng tôi!</p>
        </div>
    </div>
</body>

</html>