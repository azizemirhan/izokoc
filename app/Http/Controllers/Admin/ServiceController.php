<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    use ImageUploadTrait;

    public function index(Request $request)
    {
        $query = Service::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('is_active', $request->status == 'active' ? 1 : 0);
        }

        $services = $query->latest()->paginate(20);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        $service = new Service();
        $activeLanguages = $this->getActiveLanguages();
        return view('admin.services.create', compact('service', 'activeLanguages'));
    }

    /**
     * Yeni bir hizmeti, update ile aynı mantığı kullanarak kaydeder.
     */
    public function store(Request $request)
    {
        // Validasyonu merkezi metottan çağır
        $validatedData = $this->validateService($request);

        // Veri işlemeyi (repeater temizleme, resim yükleme) merkezi metottan çağır
        $this->handleServiceData($validatedData, $request);

        // Veriyi kaydet
        Service::create($validatedData);

        return redirect()->route('admin.services.index')->with('success', 'Hizmet başarıyla oluşturuldu.');
    }


    public function edit(Service $service)
    {
        $activeLanguages = $this->getActiveLanguages();
        return view('admin.services.edit', compact('service', 'activeLanguages'));
    }

    /**
     * Mevcut bir hizmeti günceller.
     */
    public function update(Request $request, Service $service)
    {
        // Validasyonu merkezi metottan çağır
        $validatedData = $this->validateService($request, $service->id);

        // Veri işlemeyi (repeater temizleme, resim yükleme) merkezi metottan çağır
        $this->handleServiceData($validatedData, $request, $service);

        // Veriyi güncelle
        $service->update($validatedData);

        return redirect()->route('admin.services.index')->with('success', 'Hizmet başarıyla güncellendi.');
    }

    private function getActiveLanguages(): array
    {
        try {
            // `setting` zaten dizi döndürüyor.
            $activeLanguageCodes = setting('active_languages', ['tr', 'en']);

            if (!is_array($activeLanguageCodes) || empty($activeLanguageCodes)) {
                $activeLanguageCodes = ['tr', 'en'];
            }

            $supportedLanguages = config('languages.supported', []);

            return collect($supportedLanguages)
                ->filter(fn($lang, $code) => in_array($code, $activeLanguageCodes))
                ->sortBy(fn($lang, $code) => array_search($code, $activeLanguageCodes))
                ->toArray();
        } catch (\Exception $e) {
            return [
                'tr' => ['name' => 'Turkish', 'native' => 'Türkçe'],
                'en' => ['name' => 'English', 'native' => 'English']
            ];
        }
    }

    /**
     * Hem store hem de update için merkezi validasyon kuralları.
     */
    private function validateService(Request $request, $id = null): array
    {
        $activeLanguages = $this->getActiveLanguages();
        $languageCodes = array_keys($activeLanguages);
        $firstLanguage = $languageCodes[0] ?? 'tr';

        $rules = [
            'title' => 'required|array',
            "title.{$firstLanguage}" => 'required|string|max:255', // Sadece ilk dil zorunlu
            'slug' => 'required|string|max:255|unique:services,slug,' . $id,
            'summary' => 'nullable|array',
            'content' => 'nullable|array',
            'expectations_content' => 'nullable|array',
            'cover_image' => ($id ? 'nullable' : 'required') . '|image|mimes:jpeg,png,jpg,webp|max:2048', // Oluştururken zorunlu
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:50048',
            'order' => 'required|integer',
            'is_active' => 'required|boolean',
            'benefits' => 'nullable|array',
            'support_items' => 'nullable|array',
            'faqs' => 'nullable|array',
        ];

        // Diğer dillerin başlıkları opsiyonel
        foreach ($languageCodes as $code) {
            $rules["title.{$code}"] = 'nullable|string|max:255';
        }

        return $request->validate($rules);
    }

    /**
     * Hem store hem de update için repeater ve resim verilerini işler.
     */
    private function handleServiceData(array &$validatedData, Request $request, ?Service $service = null): void
    {
        // Repeater'lardan gelen boş satırları temizle
        $validatedData['benefits'] = array_values(array_filter($validatedData['benefits'] ?? [], function($item) {
            return !empty($item['text']) && array_filter($item['text']);
        }));

        $validatedData['support_items'] = array_values(array_filter($validatedData['support_items'] ?? [], function($item) {
            return !empty($item['text']) && array_filter($item['text']);
        }));

        $validatedData['faqs'] = array_values(array_filter($validatedData['faqs'] ?? [], function($item) {
            return (!empty($item['question']) && array_filter($item['question'])) ||
                (!empty($item['answer']) && array_filter($item['answer']));
        }));

        // Kapak Resmi Yükleme
        if ($request->hasFile('cover_image')) {
            $validatedData['cover_image'] = $this->uploadImage($request, 'cover_image', 'uploads/services', $service->cover_image ?? null);
        }

        // Galeri Resimleri Yükleme
        $existingGallery = $service->gallery_images ?? [];
        if ($request->has('delete_gallery_images')) {
            $imagesToDelete = $request->input('delete_gallery_images');
            foreach ($imagesToDelete as $imagePath) {
                $this->deleteImage($imagePath);
            }
            $existingGallery = array_diff($existingGallery, $imagesToDelete);
        }
        if ($request->hasFile('gallery_images')) {
            $newImages = [];
            foreach ($request->file('gallery_images') as $file) {
                $newImages[] = $this->uploadSingleFile($file, 'uploads/services/gallery');
            }
            $validatedData['gallery_images'] = array_merge($existingGallery, $newImages);
        } else {
            $validatedData['gallery_images'] = $existingGallery;
        }
    }

    public function uploadEditorImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:50048',
        ]);

        // ImageUploadTrait içindeki metodu kullanarak resmi yükle
        $path = $this->uploadImage($request, 'image', 'uploads/services/editor');

        if ($path) {
            // Başarılı olursa, resmin tam URL'sini JSON olarak döndür
            return response()->json(['url' => asset($path)]);
        }

        // Başarısız olursa hata döndür
        return response()->json(['error' => 'Resim yüklenemedi.'], 500);
    }

    /**
     * Hizmeti soft delete ile siler (çöp kutusuna taşır)
     */
    public function destroy(Service $service)
    {
        try {
            $service->delete();
            return redirect()->route('admin.services.index')
                ->with('success', 'Hizmet başarıyla çöp kutusuna taşındı.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Hizmet silinirken bir hata oluştu: ' . $e->getMessage());
        }
    }

    /**
     * Çöp kutusundaki hizmetleri listeler
     */
    public function trash()
    {
        $services = Service::onlyTrashed()->latest('deleted_at')->paginate(20);
        return view('admin.services.trash', compact('services'));
    }

    /**
     * Çöp kutusundan hizmeti geri yükler
     */
    public function restore($id)
    {
        try {
            $service = Service::onlyTrashed()->findOrFail($id);
            $service->restore();
            return redirect()->route('admin.services.trash')
                ->with('success', 'Hizmet başarıyla geri yüklendi.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Hizmet geri yüklenirken bir hata oluştu: ' . $e->getMessage());
        }
    }

    /**
     * Hizmeti kalıcı olarak siler
     */
    public function forceDelete($id)
    {
        try {
            $service = Service::onlyTrashed()->findOrFail($id);

            // İlgili resimleri sil
            if ($service->cover_image) {
                $this->deleteImage($service->cover_image);
            }

            if (!empty($service->gallery_images)) {
                foreach ($service->gallery_images as $image) {
                    $this->deleteImage($image);
                }
            }

            $service->forceDelete();

            return redirect()->route('admin.services.trash')
                ->with('success', 'Hizmet kalıcı olarak silindi.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Hizmet silinirken bir hata oluştu: ' . $e->getMessage());
        }
    }

    /**
     * Toplu işlemler (silme, geri yükleme, kalıcı silme)
     */
    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:delete,restore,force-delete',
            'ids' => 'required|array',
            'ids.*' => 'exists:services,id'
        ]);

        try {
            $ids = $request->ids;
            $action = $request->action;
            $count = count($ids);

            switch ($action) {
                case 'delete':
                    Service::whereIn('id', $ids)->delete();
                    $message = "{$count} hizmet çöp kutusuna taşındı.";
                    $route = 'admin.services.index';
                    break;

                case 'restore':
                    Service::onlyTrashed()->whereIn('id', $ids)->restore();
                    $message = "{$count} hizmet geri yüklendi.";
                    $route = 'admin.services.trash';
                    break;

                case 'force-delete':
                    $services = Service::onlyTrashed()->whereIn('id', $ids)->get();

                    foreach ($services as $service) {
                        // Resimleri sil
                        if ($service->cover_image) {
                            $this->deleteImage($service->cover_image);
                        }
                        if (!empty($service->gallery_images)) {
                            foreach ($service->gallery_images as $image) {
                                $this->deleteImage($image);
                            }
                        }
                        $service->forceDelete();
                    }

                    $message = "{$count} hizmet kalıcı olarak silindi.";
                    $route = 'admin.services.trash';
                    break;

                default:
                    return redirect()->back()->with('error', 'Geçersiz işlem.');
            }

            return redirect()->route($route)->with('success', $message);

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Toplu işlem sırasında bir hata oluştu: ' . $e->getMessage());
        }
    }
}
