<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Twilio\Rest\Client;

class CartController extends Controller
{
    protected $cart = [];

    public function add(Request $request, $id)
    {
        $product = Product::find($id);

        if ($product) {
            $this->cart[] = $product; // Sepete ekle

            // Twilio Client'ını oluştur
            $twilioSid = config('services.twilio.sid');
            $twilioToken = config('services.twilio.token');
            $twilioClient = new Client($twilioSid, $twilioToken);

            // WhatsApp mesajı gönderilecek numaralar
            $recipients = [
                'whatsapp:+994514941072', // 1. alıcı
                'whatsapp:+994514940398', // 2. alıcı
//                'whatsapp:+994505338758'  // 3. alıcı
            ];

            // Ürün bilgileriyle mesaj içeriğini hazırla
            $messageBody = "Kullanıcı ürünü sepete ekledi: \n";
            $messageBody .= "Ürün Adı: " . $product->name . "\n";
            $messageBody .= "Açıklama: " . $product->description . "\n";
            $messageBody .= "Fiyat: " . $product->price . " TL\n";

            // Mesajı tüm alıcılara gönder
            foreach ($recipients as $recipient) {
                $twilioClient->messages->create(
                    $recipient,
                    [
                        'from' => 'whatsapp:+14155238886', // Twilio WhatsApp numarası
                        'body' => $messageBody,
                        'mediaUrl' => [$product->image_url] // Ürün fotoğrafını gönder
                    ]
                );
            }

            return response()->json(['message' => 'Ürün sepete eklendi ve mesajlar gönderildi.']);
        }

        return response()->json(['message' => 'Ürün bulunamadı.'], 404);
    }
}
