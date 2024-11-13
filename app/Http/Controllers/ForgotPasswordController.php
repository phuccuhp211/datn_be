<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    /**
     * Gửi token đặt lại mật khẩu qua email.
     */
    public function sendResetLinkEmail(Request $request)
    {
        // Validate email input
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Tạo liên kết reset password với URL frontend
        $status = Password::sendResetLink(
            $request->only('email'),
            function ($user, $token) {
                $resetUrl = config('app.frontend_url') . "/reset-password?token=$token&email=" . urlencode($user->email);
                $user->sendPasswordResetNotification($resetUrl);
            }
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Link đặt lại mật khẩu đã được gửi!'], 200);
        } else {
            return response()->json(['message' => 'Không thể gửi link đặt lại mật khẩu. Vui lòng thử lại sau.'], 500);
        }
    }
}