<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190'],
            'subject' => ['required', 'string', 'max:190'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],

            // --- v2 KURALINI SİLİN VEYA YORUMA ALIN ---
            // 'g-recaptcha-response' => ['required', 'recaptcha'],

            // --- YENİ v3 KURALINI EKLEYİN ---
            // 0.5, varsayılan puan eşiğidir. Bot ise 0.5'ten düşük alır.
            'recaptcha-response' => ['required', 'recaptcha:0.5'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Ad Soyad zorunludur.',
            'email.email' => 'Geçerli bir e-posta girin.',
            'subject.required' => 'Konu zorunludur.',
            'message.required' => 'Mesaj zorunludur.',

            // --- v3 İÇİN GEREKLİ HATA MESAJLARI ---
            'recaptcha-response.required' => 'reCAPTCHA doğrulaması gereklidir.',
            'recaptcha-response.recaptcha' => 'reCAPTCHA doğrulaması başarısız oldu (Bot şüphesi).',
        ];
    }
}