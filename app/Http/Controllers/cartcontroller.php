<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Twilio\Rest\Client;

class CartController extends Controller
{
    // Sepete ürün ekle
    public function add(Request $request, $id)
    {
        $product = Product::find($id);

        if ($product) {
            // Mevcut sepeti oturumdan al
            $cart = session()->get('cart', []);

            // Sepete ürünü ekle veya miktarını artır
            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'quantity' => 1,
                    'image_url' => $product->image_url,
                ];
            }

            // Sepeti oturuma kaydet
            session()->put('cart', $cart);
            return response()->json(['message' => 'Ürün sepete eklendi.']);
        }

        return response()->json(['message' => 'Ürün bulunamadı.'], 404);
    }

    // Sepeti görüntüle
    public function viewCart()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart')); // 'cart.index' görünümüne yönlendir
    }

    // Sepeti onayla ve WhatsApp mesajı gönder

    // Sepeti onayla ve WhatsApp mesajı gönder
    public function confirmCart()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Sepetiniz boş.');
        }

        // WhatsApp mesajı göndermek için Twilio yapılandırması
        $twilioSid = config('services.twilio.sid');
        $twilioToken = config('services.twilio.token');
        $twilioClient = new Client($twilioSid, $twilioToken);

        $recipients = [
            'whatsapp:+994514940398', // Alıcı numarası
        ];

        try {
            foreach ($recipients as $recipient) {
                foreach ($cart as $product) {
                    // Mesaj metnini oluştur
                    $messageBody = "🛒 *Ürün Adı:* {$product['name']}\n";
                    $messageBody .= "💲 *Fiyat:* {$product['price']} TL\n";
                    $messageBody .= "-----------------------------------\n"; // Ürünler arasında ayrım için

                    // Önce resmi gönder
                    if (!empty($product['image_url'])) {
                        $twilioClient->messages->create(
                            $recipient,
                            [
                                'from' => 'whatsapp:+14155238886', // Twilio WhatsApp numarası
                                'mediaUrl' => [$product['image_url']], // Ürün fotoğrafını gönder
                                'body' => $messageBody // Mesajı aynı anda ekliyoruz
                            ]
                        );
                    } else {
                        // Eğer ürün resmi yoksa, yalnızca metin mesajını gönder
                        $twilioClient->messages->create(
                            $recipient,
                            [
                                'from' => 'whatsapp:+14155238886', // Twilio WhatsApp numarası
                                'body' => $messageBody
                            ]
                        );
                    }
                }
            }

            // Sepeti boşalt
            session()->forget('cart');
            return redirect()->route('products')->with('success', 'Sepet onaylandı ve mesaj gönderildi.');
        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', 'Mesaj gönderilirken bir hata oluştu: ' . $e->getMessage());
        }
    }










    // Sepetten ürün silme
    public function remove($id)
    {
        // Sepet verisini alın
        $cart = session('cart', []);

        // Ürünü sepetten sil
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
            return response()->json(['message' => 'Ürün sepetten silindi.']);
        }

        return response()->json(['message' => 'Ürün bulunamadı.'], 404);
    }



}



