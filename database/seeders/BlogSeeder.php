<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

// Carbon'u ekleyin

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Yabancı anahtar kısıtlamalarını geçici olarak devre dışı bırak
        Schema::disableForeignKeyConstraints();

        // 2. Tabloları boşalt (Post ilişkilerini de temizle)
        DB::table('post_tag')->truncate();
        DB::table('posts')->truncate();
        DB::table('tags')->truncate();
        DB::table('categories')->truncate();
        // Opsiyonel: Admin kullanıcısını silmek istemiyorsanız aşağıdaki satırı yorumlayın
        // DB::table('users')->truncate();

        // 3. Yabancı anahtar kısıtlamalarını tekrar aktif et
        Schema::enableForeignKeyConstraints();

        // 4. Varsayılan bir yazar oluşturalım veya bulalım
        $author = User::firstOrCreate(
            ['email' => 'admin@izokoc.com'], // E-posta adresini İzokoç'a göre güncelleyin
            [
                'name' => 'İzokoç Admin', // İsmi İzokoç'a göre güncelleyin
                'password' => Hash::make('password'), // Güvenli bir şifre kullanın
            ]
        );

        // 5. İzokoç için Kategorileri oluşturalım (Çok dilli)
        $cat1 = Category::create([
            'name' => ['tr' => 'Endüstriyel İzolasyon', 'en' => 'Industrial Insulation'],
            'slug' => Str::slug('Endüstriyel İzolasyon'),
            'is_active' => true,
        ]);
        $cat2 = Category::create([
            'name' => ['tr' => 'Enerji Verimliliği', 'en' => 'Energy Efficiency'],
            'slug' => Str::slug('Enerji Verimliliği'),
            'is_active' => true,
        ]);
        $cat3 = Category::create([
            'name' => ['tr' => 'Teknik Uygulamalar', 'en' => 'Technical Applications'],
            'slug' => Str::slug('Teknik Uygulamalar'),
            'is_active' => true,
        ]);
        $cat4 = Category::create([
            'name' => ['tr' => 'Güvenlik Standartları', 'en' => 'Safety Standards'],
            'slug' => Str::slug('Güvenlik Standartları'),
            'is_active' => true,
        ]);

        // 6. İzokoç için Etiketleri oluşturalım (Çok dilli)
        $tag1 = Tag::create(['name' => ['tr' => 'Termal Yalıtım', 'en' => 'Thermal Insulation'], 'slug' => Str::slug('Termal Yalıtım')]);
        $tag2 = Tag::create(['name' => ['tr' => 'Enerji Tasarrufu', 'en' => 'Energy Saving'], 'slug' => Str::slug('Enerji Tasarrufu')]);
        $tag3 = Tag::create(['name' => ['tr' => 'Akustik Yalıtım', 'en' => 'Acoustic Insulation'], 'slug' => Str::slug('Akustik Yalıtım')]);
        $tag4 = Tag::create(['name' => ['tr' => 'Ses Yalıtımı', 'en' => 'Soundproofing'], 'slug' => Str::slug('Ses Yalıtımı')]);
        $tag5 = Tag::create(['name' => ['tr' => 'Yangın Durdurucu', 'en' => 'Firestop'], 'slug' => Str::slug('Yangın Durdurucu')]);
        $tag6 = Tag::create(['name' => ['tr' => 'İş Güvenliği', 'en' => 'Occupational Safety'], 'slug' => Str::slug('İş Güvenliği')]);
        $tag7 = Tag::create(['name' => ['tr' => 'Soğuk İzolasyon', 'en' => 'Cold Insulation'], 'slug' => Str::slug('Soğuk İzolasyon')]);
        $tag8 = Tag::create(['name' => ['tr' => 'Maliyet Azaltma', 'en' => 'Cost Reduction'], 'slug' => Str::slug('Maliyet Azaltma')]);

        // 7. Yazıları oluşturalım (Çok dilli)

        // BLOG YAZISI 1
        $post1_content_tr = "
<p>Endüstriyel tesisler, üretim süreçlerinin kalbi konumundadır ve bu süreçler genellikle yüksek miktarda enerji tüketimi gerektirir. Isıtma, soğutma, buhar üretimi gibi operasyonlarda yaşanan enerji kayıpları, hem işletme maliyetlerini artırır hem de çevresel ayak izini büyütür. İşte bu noktada, doğru ve etkin bir endüstriyel izolasyon, enerji verimliliğini maksimize etmenin ve sürdürülebilir bir operasyon sağlamanın anahtarıdır. İzokoç İzolasyon olarak, bu kritik ihtiyaca mühendislik temelli çözümler sunuyoruz.</p>

<h5>İzolasyonun Enerji Verimliliğine Doğrudan Etkisi</h5>
<p>Endüstriyel izolasyonun temel amacı, ısı transferini kontrol altına almaktır. Boru hatları, tanklar, kazanlar, fırınlar ve diğer ekipmanlarda meydana gelen ısı kayıp veya kazançları, proses verimliliğini doğrudan etkiler. Örneğin:</p>
<ul>
    <li><strong>Isı Kaybının Önlenmesi:</strong> Sıcak akışkan taşıyan borularda veya ısıtma ekipmanlarında yalıtım olmadığında, değerli ısı enerjisi çevreye yayılır. Bu durum, istenen sıcaklığı korumak için sistemin sürekli daha fazla enerji harcamasına neden olur. Kaliteli bir termal izolasyon, bu kaybı %90'lara varan oranlarda azaltabilir. Bu, doğrudan yakıt veya elektrik tasarrufu anlamına gelir.</li>
    <li><strong>Soğuk Hatlarda Yoğuşma Kontrolü:</strong> Soğutma sistemleri veya soğuk akışkan taşıyan hatlarda yetersiz yalıtım, yüzeylerde yoğuşmaya neden olur. Bu yoğuşma, korozyona yol açarak ekipman ömrünü kısaltır, damlama nedeniyle güvenlik riskleri oluşturur ve ortamdaki nemi artırarak ek soğutma yükü getirir. Doğru kalınlıkta ve tipte uygulanan soğuk izolasyon, yoğuşmayı tamamen engelleyerek bu sorunların önüne geçer.</li>
    <li><strong>Proses Sıcaklıklarının Korunması:</strong> Birçok endüstriyel süreç, belirli sıcaklık aralıklarında çalışmayı gerektirir. İzolasyon, bu kritik sıcaklıkların korunmasına yardımcı olarak ürün kalitesini güvence altına alır ve proses tutarlılığını sağlar.</li>
</ul>

<h5>Doğru İzolasyon Malzemesi ve Uygulamasının Önemi</h5>
<p>Enerji verimliliği hedefine ulaşmak için sadece izolasyon yapmak yeterli değildir; doğru malzemenin seçilmesi ve uygulamanın uluslararası standartlara uygun yapılması şarttır. Malzeme seçiminde;</p>
<ul>
    <li><strong>Çalışma Sıcaklığı:</strong> Ekipmanın veya hattın çalıştığı minimum ve maksimum sıcaklıklar.</li>
    <li><strong>Ortam Koşulları:</strong> Nem, kimyasal maruziyet, mekanik darbe riski gibi faktörler.</li>
    <li><strong>Isıl İletkenlik Katsayısı (λ):</strong> Malzemenin ısıyı ne kadar iyi yalıttığını gösteren değer (düşük olması tercih edilir).</li>
    <li><strong>Yangın Dayanımı:</strong> Özellikle yanıcı maddelerin bulunduğu alanlarda kritik bir faktör.</li>
    <li><strong>Basınç Dayanımı:</strong> Üzerine yük binecek alanlarda önemlidir.</li>
</ul>
<p>gibi kriterler göz önünde bulundurulmalıdır. Taşyünü, camyünü, seramik yünü, poliüretan (PUR), poliizosiyanürat (PIR), elastomerik kauçuk köpüğü gibi malzemeler, farklı sıcaklık aralıkları ve uygulamalar için tercih edilir.</p>
<p>Uygulama aşamasında ise, malzemenin boşluk kalmayacak şekilde yerleştirilmesi, ısı köprülerinin oluşumunu engelleyecek detaylara dikkat edilmesi, sızdırmazlığın sağlanması ve dış etkenlere karşı uygun bir kaplama (genellikle metal ceketleme) yapılması büyük önem taşır. İzokoç İzolasyon, deneyimli uygulama ekipleri ve mühendislik denetimiyle bu standartları her projede titizlikle uygular.</p>

<h5>İzolasyon Yatırımının Geri Dönüşü (ROI)</h5>
<p>Endüstriyel izolasyon, bir maliyet kalemi olarak görülse de aslında yüksek geri dönüş potansiyeline sahip bir yatırımdır. Doğru yapılmış bir izolasyon projesi, sağladığı enerji tasarrufu sayesinde genellikle kısa bir süre içinde (projeye bağlı olarak 1-3 yıl) kendini amorti eder. Amortisman süresinden sonra ise sürekli olarak işletme maliyetlerinde net bir düşüş sağlar. Ayrıca, ekipman ömrünün uzaması, bakım maliyetlerinin azalması, iş güvenliğinin artması (sıcak yüzeylerden kaynaklanan yanma riskinin azalması gibi) ve karbon emisyonlarının düşürülmesi gibi ek faydalar da sunar.</p>
<p>Sonuç olarak, endüstriyel tesislerde enerji verimliliğini artırmanın en etkili ve ekonomik yollarından biri profesyonel izolasyon uygulamalarıdır. İzokoç İzolasyon olarak, mühendislik bilgimiz ve tecrübemizle tesislerinize özel en uygun çözümleri sunarak, enerji maliyetlerinizi düşürmenize ve daha sürdürülebilir bir işletme olmanıza katkıda bulunuyoruz.</p>
        ";
        $post1_content_en = "
Industrial facilities are the heart of production processes, and these processes often require high energy consumption. Energy losses in operations such as heating, cooling, and steam generation increase both operating costs and the environmental footprint. At this point, correct and effective industrial insulation is the key to maximizing energy efficiency and ensuring sustainable operation. As İzokoç İzolasyon, we offer engineering-based solutions for this critical need.

The Direct Impact of Insulation on Energy Efficiency
The primary purpose of industrial insulation is to control heat transfer. Heat loss or gain occurring in pipelines, tanks, boilers, furnaces, and other equipment directly affects process efficiency. For example:

    Preventing Heat Loss: When pipes carrying hot fluids or heating equipment lack insulation, valuable heat energy dissipates into the environment. This causes the system to continuously consume more energy to maintain the desired temperature. Quality thermal insulation can reduce this loss by up to 90%. This directly translates into fuel or electricity savings.
    Condensation Control in Cold Lines: Inadequate insulation in cooling systems or lines carrying cold fluids leads to condensation on surfaces. This condensation causes corrosion, shortening equipment lifespan, creates safety risks due to dripping, and increases the cooling load by raising ambient humidity. Cold insulation applied at the correct thickness and type completely prevents condensation, avoiding these problems.
    Maintaining Process Temperatures: Many industrial processes require operation within specific temperature ranges. Insulation helps maintain these critical temperatures, ensuring product quality and process consistency.


Importance of Correct Insulation Material and Application
Simply insulating is not enough to achieve energy efficiency goals; selecting the right material and ensuring the application complies with international standards are essential. Material selection criteria include:

    Operating Temperature: The minimum and maximum temperatures at which the equipment or line operates.
    Environmental Conditions: Factors such as humidity, chemical exposure, and risk of mechanical impact.
    Thermal Conductivity Coefficient (λ): A value indicating how well the material insulates heat (lower is better).
    Fire Resistance: A critical factor, especially in areas with flammable substances.
    Compressive Strength: Important in areas subjected to loads.

Materials like rock wool, glass wool, ceramic wool, polyurethane (PUR), polyisocyanurate (PIR), and elastomeric rubber foam are preferred for different temperature ranges and applications.
During application, it is crucial to install the material without gaps, pay attention to details preventing thermal bridges, ensure sealing, and apply a suitable coating (usually metal jacketing) for protection against external factors. İzokoç İzolasyon meticulously applies these standards in every project with experienced application teams and engineering supervision.

Return on Investment (ROI) of Insulation
Although industrial insulation is often seen as a cost item, it is actually an investment with high return potential. A well-executed insulation project typically pays for itself in a short period (1-3 years, depending on the project) through energy savings. After the payback period, it provides a continuous net reduction in operating costs. Additionally, it offers benefits such as extended equipment life, reduced maintenance costs, increased occupational safety (like reducing burn risks from hot surfaces), and lower carbon emissions.
In conclusion, professional insulation applications are one of the most effective and economical ways to increase energy efficiency in industrial facilities. As İzokoç İzolasyon, we contribute to reducing your energy costs and becoming a more sustainable business by offering the most suitable solutions tailored to your facilities with our engineering knowledge and experience.
        ";
        $post1 = Post::create([
            'title' => ['tr' => 'Endüstriyel Tesislerde Enerji Verimliliği İçin İzolasyonun Rolü', 'en' => 'The Role of Insulation in Energy Efficiency for Industrial Facilities'],
            'slug' => Str::slug('Endüstriyel Tesislerde Enerji Verimliliği İçin İzolasyonun Rolü'),
            'content' => ['tr' => $post1_content_tr, 'en' => $post1_content_en],
            'excerpt' => ['tr' => 'Endüstriyel izolasyon, enerji maliyetlerini nasıl düşürür ve tesis verimliliğini nasıl artırır? Doğru malzeme ve uygulama tekniklerinin önemi.', 'en' => 'How does industrial insulation reduce energy costs and increase facility efficiency? The importance of correct materials and application techniques.'],
            'featured_image' => 'uploads/posts/featured/izokoc-blog-1.jpg', // Placeholder veya gerçek görsel yolu
            'user_id' => $author->id,
            'category_id' => $cat2->id, // Enerji Verimliliği kategorisi
            'status' => 'published',
            'published_at' => Carbon::now()->subDays(10), // Geçmiş tarihli
        ]);

        // BLOG YAZISI 2
        $post2_content_tr = "
<p>Modern endüstriyel tesisler ve binalar, karmaşık mekanik sistemlere ev sahipliği yapar. HVAC (Isıtma, Havalandırma ve Klima), sıhhi tesisat, basınçlı hava hatları ve jeneratörler gibi bu sistemler, çalışırken kaçınılmaz olarak gürültü üretirler. Bu gürültü, hem çalışanların sağlığı ve konforu üzerinde olumsuz etkiler yaratabilir hem de çevresel gürültü kirliliğine neden olabilir. Mekanik tesisatlarda profesyonel ses yalıtımı uygulamaları, bu sorunları etkin bir şekilde çözerek daha sağlıklı, güvenli ve verimli çalışma ortamları yaratır.</p>

<h5>Mekanik Tesisat Gürültüsünün Kaynakları ve Etkileri</h5>
<p>Mekanik sistemlerde gürültü, çeşitli kaynaklardan ortaya çıkabilir:</p>
<ul>
    <li><strong>Ekipman Gürültüsü:</strong> Motorlar, fanlar, pompalar, kompresörler ve jeneratörler gibi dönen veya titreşen ekipmanların doğrudan yaydığı ses.</li>
    <li><strong>Akış Gürültüsü:</strong> Boru ve kanallardaki hava veya akışkan hareketinin neden olduğu türbülans ve sürtünme sesleri.</li>
    <li><strong>Yapısal Titreşim:</strong> Ekipmanların çalışması sırasında oluşturduğu titreşimlerin bina yapısına (duvarlar, zeminler) iletilmesi ve buradan ses olarak yayılması.</li>
</ul>
<p>Bu gürültünün etkileri ise şunlardır:</p>
<ul>
    <li><strong>İş Sağlığı ve Güvenliği Riskleri:</strong> Yüksek seviyeli gürültüye sürekli maruz kalmak, işitme kaybına, strese, yorgunluğa ve dikkat dağınıklığına yol açarak iş kazası riskini artırır. Yasal düzenlemeler genellikle belirli desibel seviyelerinin aşılmamasını zorunlu kılar.</li>
    <li><strong>Konforun Azalması:</strong> Ofisler, hastaneler, oteller gibi mekanlarda mekanik sistem gürültüsü, kullanıcıların konforunu ciddi şekilde düşürür ve rahatsızlık yaratır.</li>
    <li><strong>Çevresel Etki:</strong> Özellikle dış üniteler veya egzoz sistemlerinden yayılan gürültü, çevre sakinleri için rahatsızlık kaynağı olabilir ve yasal şikayetlere yol açabilir.</li>
    <li><strong>İletişim Zorlukları:</strong> Gürültülü ortamlarda sözlü iletişim kurmak zorlaşır, bu da operasyonel verimsizliklere neden olabilir.</li>
</ul>

<h5>Ses Yalıtımı Çözümleri ve Uygulama Teknikleri</h5>
<p>Mekanik tesisatlarda ses yalıtımı, gürültünün kaynağında azaltılması, iletim yollarının kesilmesi veya alıcıya ulaşmadan sönümlenmesi prensiplerine dayanır. İzokoç İzolasyon olarak uyguladığımız başlıca yöntemler şunlardır:</p>
<ul>
    <li><strong>Akustik İzolasyon Malzemeleri:</strong> Boru ve kanalların çevresine yüksek yoğunluklu ses yutucu malzemeler (taşyünü, camyünü, elastomerik kauçuk köpüğü vb.) sarılması, akış gürültüsünü ve sesin dışarı yayılmasını azaltır. Bu malzemeler genellikle ses bariyeri görevi gören ağır katmanlarla (örn. kurşunlu veya vinil bariyerler) birlikte kullanılır.</li>
    <li><strong>Titreşim İzolasyonu:</strong> Ekipmanların (pompalar, fanlar, chiller grupları vb.) altına veya askı sistemlerine titreşim sönümleyici takozlar, yaylı askılar veya elastomerik pedler yerleştirilerek titreşimin bina yapısına iletilmesi engellenir.</li>
    <li><strong>Akustik Kabinler ve Bariyerler:</strong> Özellikle gürültülü makineler (jeneratörler, kompresörler) için ses geçirmez kabinler veya duvarlar inşa edilerek gürültünün kaynağında hapsedilmesi sağlanır.</li>
    <li><strong>Susturucular (Silencer):</strong> Hava kanallarının giriş ve çıkışlarına yerleştirilen susturucular, fan gürültüsünün ve hava akış sesinin kanal boyunca yayılmasını azaltır.</li>
    <li><strong>Esnek Bağlantılar:</strong> Boru ve kanalların ekipmanlara veya duvar geçişlerine bağlandığı noktalarda kullanılan esnek kompansatörler veya bağlantı elemanları, titreşim ve yapısal ses iletimini keser.</li>
</ul>
<p>Doğru çözümün belirlenmesi, gürültünün kaynağına, frekansına, seviyesine ve hedeflenen ses azaltma miktarına göre mühendislik hesaplamaları gerektirir. Uygulamanın kalitesi de en az malzeme seçimi kadar önemlidir. Boşluksuz montaj, doğru sızdırmazlık detayları ve uygun askılama sistemleri, yalıtımın performansını doğrudan etkiler.</p>

<h5>Akustik Konforun ve Güvenliğin Sağlanması</h5>
<p>Mekanik tesisatlarda etkin bir ses yalıtımı, sadece yasal zorunlulukları yerine getirmekle kalmaz, aynı zamanda önemli faydalar sağlar:</p>
<ul>
    <li>Daha sağlıklı ve güvenli bir çalışma ortamı.</li>
    <li>Çalışan verimliliğinde ve konsantrasyonunda artış.</li>
    <li>Bina kullanıcıları için artan konfor ve memnuniyet.</li>
    <li>Çevresel gürültü yönetmeliklerine uyum.</li>
    <li>Tesisin veya binanın değerinin artması.</li>
</ul>
<p>İzokoç İzolasyon, mekanik tesisat ses yalıtımı konusunda uzman mühendisleri ve deneyimli saha ekipleriyle, projenizin ihtiyaçlarına özel, en uygun ve etkili çözümleri sunar. Gürültü ölçümlerinden başlayarak, tasarım, malzeme seçimi ve uygulamaya kadar tüm süreçlerde yanınızdayız.</p>
        ";
        $post2_content_en = "
Modern industrial facilities and buildings host complex mechanical systems. These systems, such as HVAC (Heating, Ventilation, and Air Conditioning), plumbing, compressed air lines, and generators, inevitably produce noise during operation. This noise can negatively impact employee health and comfort and contribute to environmental noise pollution. Professional acoustic insulation applications in mechanical installations effectively address these issues, creating healthier, safer, and more productive work environments.

Sources and Effects of Mechanical Installation Noise
Noise in mechanical systems can originate from various sources:

    Equipment Noise: Sound directly emitted by rotating or vibrating equipment like motors, fans, pumps, compressors, and generators.
    Flow Noise: Turbulence and friction sounds caused by air or fluid movement in pipes and ducts.
    Structural Vibration: Vibrations generated by equipment operation transmitted through the building structure (walls, floors) and radiated as sound.

The effects of this noise include:

    Occupational Health and Safety Risks: Prolonged exposure to high noise levels can lead to hearing loss, stress, fatigue, and distraction, increasing the risk of workplace accidents. Legal regulations often mandate that specific decibel levels are not exceeded.
    Reduced Comfort: In spaces like offices, hospitals, and hotels, mechanical system noise significantly reduces user comfort and causes disturbance.
    Environmental Impact: Noise emitted, especially from outdoor units or exhaust systems, can be a source of annoyance for nearby residents and may lead to legal complaints.
    Communication Difficulties: Verbal communication becomes challenging in noisy environments, leading to operational inefficiencies.


Acoustic Insulation Solutions and Application Techniques
Acoustic insulation in mechanical installations relies on principles of reducing noise at the source, blocking transmission paths, or damping sound before it reaches the receiver. Key methods applied by İzokoç İzolasyon include:

    Acoustic Insulation Materials: Wrapping pipes and ducts with high-density sound-absorbing materials (rock wool, glass wool, elastomeric rubber foam, etc.) reduces flow noise and sound radiation. These materials are often combined with heavy layers (e.g., leaded or vinyl barriers) acting as sound barriers.
    Vibration Isolation: Placing vibration damping mounts, spring hangers, or elastomeric pads under equipment (pumps, fans, chillers, etc.) or in suspension systems prevents vibration transmission to the building structure.
    Acoustic Enclosures and Barriers: Constructing soundproof enclosures or walls around particularly noisy machinery (generators, compressors) contains the noise at its source.
    Silencers: Installed at the inlets and outlets of air ducts, silencers reduce fan noise and airflow sound propagation along the ductwork.
    Flexible Connections: Using flexible expansion joints or connectors where pipes and ducts connect to equipment or pass through walls interrupts vibration and structure-borne sound transmission.

Determining the right solution requires engineering calculations based on the noise source, frequency, level, and desired sound reduction. The quality of the application is just as critical as material selection. Gap-free installation, proper sealing details, and appropriate support systems directly impact insulation performance.

Ensuring Acoustic Comfort and Safety
Effective acoustic insulation in mechanical installations not only meets legal requirements but also provides significant benefits:

    A healthier and safer working environment.
    Increased employee productivity and concentration.
    Enhanced comfort and satisfaction for building occupants.
    Compliance with environmental noise regulations.
    Increased value of the facility or building.

İzokoç İzolasyon, with its expert engineers and experienced field teams specialized in mechanical installation acoustic insulation, offers the most suitable and effective solutions tailored to your project's needs. We support you throughout the entire process, from noise measurements to design, material selection, and application.
        ";
        $post2 = Post::create([
            'title' => ['tr' => 'Mekanik Tesisatlarda Ses Yalıtımı: Konfor ve Güvenlik', 'en' => 'Acoustic Insulation in Mechanical Installations: Comfort and Safety'],
            'slug' => Str::slug('Mekanik Tesisatlarda Ses Yalıtımı Konfor ve Güvenlik'),
            'content' => ['tr' => $post2_content_tr, 'en' => $post2_content_en],
            'excerpt' => ['tr' => 'Endüstriyel gürültünün çalışan sağlığı ve çevre üzerindeki etkileri nelerdir? Mekanik tesisatlarda uygulanan ses yalıtımı çözümleri.', 'en' => 'What are the effects of industrial noise on employee health and the environment? Sound insulation solutions applied in mechanical installations.'],
            'featured_image' => 'uploads/posts/featured/izokoc-blog-2.jpg', // Placeholder veya gerçek görsel yolu
            'user_id' => $author->id,
            'category_id' => $cat3->id, // Teknik Uygulamalar kategorisi
            'status' => 'published',
            'published_at' => Carbon::now()->subDays(5),
        ]);

        // BLOG YAZISI 3
        $post3_content_tr = "
<p>Endüstriyel tesisler, doğaları gereği yangın riski taşıyan birçok unsuru barındırır. Yanıcı maddeler, yüksek sıcaklıkta çalışan ekipmanlar, elektrik sistemleri ve karmaşık prosesler, potansiyel tehlike kaynaklarıdır. Bu nedenle, can ve mal güvenliğini sağlamak, üretimin sürekliliğini korumak ve yasal yükümlülükleri yerine getirmek için etkin yangın güvenliği önlemleri almak hayati önem taşır. Pasif yangın koruma sistemlerinin önemli bir parçası olan yangın durdurucu izolasyon çözümleri, bu güvenliğin sağlanmasında kritik bir rol oynar.</p>

<h5>Yangın Güvenliği Standartları ve Yasal Zorunluluklar</h5>
<p>Türkiye'de ve dünyada, endüstriyel tesislerin yangın güvenliği ile ilgili sıkı standartlar ve yönetmelikler bulunmaktadır. Türkiye'de 'Binaların Yangından Korunması Hakkında Yönetmelik' temel düzenlemeyi oluştururken, uluslararası alanda NFPA (National Fire Protection Association), FM Global, EN (Avrupa Normları) gibi standartlar referans alınmaktadır. Bu standartlar, yapı elemanlarının (duvarlar, döşemeler, çatılar) yangına dayanım sürelerini, yangın bölmeleri (kompartımanlar) oluşturulmasını, geçiş noktalarının (kablo, boru, havalandırma kanalı geçişleri) sızdırmazlığını ve kullanılan malzemelerin yanmazlık sınıflarını belirler.</p>
<p>Yangın durdurucu izolasyon sistemleri, özellikle bu standartların gerekliliklerini karşılamak üzere tasarlanmıştır:</p>
<ul>
    <li><strong>Yangın Kompartımanlarının Bütünlüğünü Korumak:</strong> Yangının çıktığı bölgede sınırlı kalmasını sağlamak, yangın güvenliğinin temel prensibidir. Duvar ve döşeme geçişlerinden alev, duman ve sıcak gazların diğer bölmelere yayılmasını engellemek için yangın durdurucu harçlar, mastikler, yastıklar, kelepçeler ve sargılar kullanılır. Bu ürünler, belirli bir süre boyunca (örn. 30, 60, 90, 120 dakika) yangına dayanarak kaçış yollarının açık kalmasına ve yangınla müdahale ekiplerinin güvenli çalışmasına olanak tanır.</li>
    <li><strong>Yapısal Elemanların Stabilitesini Artırmak:</strong> Çelik taşıyıcı sistemler gibi yapısal elemanlar, yüksek sıcaklıkta mukavemetlerini kaybedebilir ve çökme riski oluşturabilir. Yangına dayanıklı boyalar, levhalar veya püskürtme malzemelerle yapılan kaplamalar, çeliğin kritik sıcaklığa ulaşma süresini geciktirerek binanın yapısal bütünlüğünü korur.</li>
    <li><strong>Havalandırma Kanallarının Korunması:</strong> Yangın sırasında havalandırma kanalları, alev ve dumanın hızla yayılmasına neden olabilir. Kanalların yangına dayanıklı malzemelerle (örn. kalsiyum silikat levhalar, özel yalıtım yünleri) kaplanması veya kanal içlerine yangın damperi takılması, bu riski ortadan kaldırır.</li>
</ul>

<h5>Yangın Durdurucu İzolasyon Malzemeleri ve Sistemleri</h5>
<p>Yangın durdurucu çözümlerde kullanılan malzemeler, yüksek sıcaklıklara dayanıklı ve genellikle endotermik (ısıyı emerek genleşen veya su buharı salan) özelliklere sahiptir. Başlıca ürün grupları şunlardır:</p>
<ul>
    <li><strong>Yangın Durdurucu Mastikler ve Silikonlar:</strong> Derzlerde, küçük boşluklarda ve kablo/boru etrafındaki sızdırmazlığı sağlamak için kullanılır. Yangın anında genleşerek (intümesan) veya ısıyı emerek bariyer oluştururlar.</li>
    <li><strong>Yangın Durdurucu Harçlar ve Sıvalar:</strong> Daha büyük duvar ve döşeme boşluklarını doldurmak için kullanılır. Çimento veya alçı bazlıdırlar ve yüksek yangın dayanımı sağlarlar.</li>
    <li><strong>Yangın Durdurucu Yastıklar ve Sargılar:</strong> Özellikle sık sık değişiklik yapılan kablo tavaları veya geçişler için modüler çözümler sunar. Yangında genleşerek boşlukları kapatırlar.</li>
    <li><strong>Yangın Durdurucu Kelepçeler:</strong> Plastik boru geçişlerinde kullanılır. Yangın anında borunun erimesiyle oluşan boşluğu, içindeki intümesan malzemenin şişmesiyle kapatarak alev ve duman geçişini engeller.</li>
    <li><strong>Yangına Dayanıklı Levhalar:</strong> Kalsiyum silikat, alçı veya özel kompozit levhalar, havalandırma kanallarını, kablo kanallarını veya yapısal elemanları kaplamak için kullanılır.</li>
    <li><strong>Yangına Dayanıklı Boyalar (İntümesan Boyalar):</strong> Çelik taşıyıcı elemanlara uygulanır. Yangın ısısıyla birlikte köpürerek karbonlaşmış bir yalıtım katmanı oluşturur ve çeliğin ısınmasını geciktirir.</li>
</ul>
<p>Doğru ürünün ve sistemin seçimi, geçişin tipi, boşluğun boyutu, içinden geçen tesisat elemanları ve istenen yangın dayanım süresine göre uzmanlık gerektirir. İzokoç İzolasyon, uluslararası sertifikalı ürünler ve test edilmiş sistem detayları kullanarak projenize en uygun çözümü belirler ve uygular.</p>

<h5>Neden Profesyonel Uygulama Şart?</h5>
<p>Yangın durdurucu sistemlerin etkinliği, doğru malzeme kadar doğru uygulamaya da bağlıdır. Uygulama hataları, sistemin yangın anında beklenen performansı gösterememesine ve felaketle sonuçlanabilecek durumlara yol açabilir. Bu nedenle, uygulamaların mutlaka eğitimli ve sertifikalı personel tarafından, üretici talimatlarına ve test edilmiş detaylara uygun olarak yapılması zorunludur. İzokoç İzolasyon, bu alandaki uzmanlığı ve sertifikalı uygulama ekipleriyle, tesislerinizin yangın güvenliğini en üst düzeyde sağlamayı taahhüt eder.</p>
<p>Unutmayın, yangın güvenliği ihmale gelmez. Pasif yangın koruma ve yangın durdurucu izolasyon çözümleri, olası bir yangın durumunda hayat kurtaran, mal kaybını önleyen ve işletmenizin devamlılığını sağlayan kritik yatırımlardır.</p>
        ";
        $post3_content_en = "
Industrial facilities inherently contain many elements that pose a fire risk. Flammable materials, high-temperature operating equipment, electrical systems, and complex processes are potential sources of danger. Therefore, taking effective fire safety measures is vital to ensure life and property safety, maintain production continuity, and fulfill legal obligations. Firestop insulation solutions, a crucial part of passive fire protection systems, play a critical role in providing this security.

Fire Safety Standards and Legal Requirements
Strict standards and regulations regarding the fire safety of industrial facilities exist in Turkey and globally. In Turkey, the 'Regulation on the Fire Protection of Buildings' forms the basic regulation, while international standards such as NFPA (National Fire Protection Association), FM Global, and EN (European Norms) are referenced. These standards specify the fire resistance periods of structural elements (walls, floors, roofs), the creation of fire compartments, the sealing of penetration points (cable, pipe, ventilation duct penetrations), and the flammability classes of materials used.
Firestop insulation systems are specifically designed to meet the requirements of these standards:

    Maintaining the Integrity of Fire Compartments: Confining the fire to the area of origin is a fundamental principle of fire safety. Firestop mortars, sealants, pillows, collars, and wraps are used to prevent the spread of flames, smoke, and hot gases through wall and floor penetrations to other compartments. These products resist fire for a specific duration (e.g., 30, 60, 90, 120 minutes), allowing escape routes to remain clear and enabling firefighting teams to work safely.
    Increasing Stability of Structural Elements: Structural elements like steel support systems can lose their strength at high temperatures, posing a risk of collapse. Coatings made with fire-resistant paints, boards, or spray materials delay the steel from reaching its critical temperature, thus preserving the building's structural integrity.
    Protecting Ventilation Ducts: During a fire, ventilation ducts can facilitate the rapid spread of flames and smoke. Cladding ducts with fire-resistant materials (e.g., calcium silicate boards, special insulation wools) or installing fire dampers inside the ducts eliminates this risk.


Firestop Insulation Materials and Systems
Materials used in firestop solutions are resistant to high temperatures and often have endothermic properties (expanding or releasing water vapor upon absorbing heat). The main product groups include:

    Firestop Sealants and Silicones: Used to seal joints, small gaps, and around cables/pipes. They expand (intumescent) or absorb heat during a fire to form a barrier.
    Firestop Mortars and Plasters: Used to fill larger wall and floor penetrations. They are cement or gypsum-based and provide high fire resistance.
    Firestop Pillows and Wraps: Offer modular solutions, especially for cable trays or penetrations that undergo frequent changes. They expand in a fire to seal openings.
    Firestop Collars: Used for plastic pipe penetrations. In a fire, as the pipe melts, the intumescent material inside the collar swells to close the resulting gap, preventing flame and smoke passage.
    Fire-Resistant Boards: Calcium silicate, gypsum, or special composite boards used to clad ventilation ducts, cable trays, or structural elements.
    Fire-Resistant Paints (Intumescent Paints): Applied to steel support elements. They foam and char when exposed to fire heat, forming an insulating layer that delays the heating of the steel.

Selecting the correct product and system requires expertise based on the type of penetration, the size of the opening, the penetrating services, and the required fire resistance rating. İzokoç İzolasyon determines and applies the most suitable solution for your project using internationally certified products and tested system details.

Why is Professional Application Essential?
The effectiveness of firestop systems depends as much on proper application as on the right materials. Application errors can lead to the system failing to perform as expected in a fire, potentially resulting in catastrophic consequences. Therefore, it is mandatory that applications are carried out by trained and certified personnel, strictly following manufacturer instructions and tested details. İzokoç İzolasyon, with its expertise in this field and certified application teams, is committed to ensuring the highest level of fire safety for your facilities.
Remember, fire safety cannot be neglected. Passive fire protection and firestop insulation solutions are critical investments that save lives, prevent property loss, and ensure the continuity of your business in the event of a fire.
        ";
        $post3 = Post::create([
            'title' => ['tr' => 'Endüstriyel Tesislerde Yangın Güvenliği ve İzolasyon Çözümleri', 'en' => 'Fire Safety in Industrial Facilities and Insulation Solutions'],
            'slug' => Str::slug('Endüstriyel Tesislerde Yangın Güvenliği ve İzolasyon Çözümleri'),
            'content' => ['tr' => $post3_content_tr, 'en' => $post3_content_en],
            'excerpt' => ['tr' => 'Pasif yangın koruma neden önemlidir? Yangın durdurucu izolasyon malzemeleri, standartlar ve doğru uygulama teknikleri.', 'en' => 'Why is passive fire protection important? Firestop insulation materials, standards, and correct application techniques.'],
            'featured_image' => 'uploads/posts/featured/izokoc-blog-3.jpg', // Placeholder veya gerçek görsel yolu
            'user_id' => $author->id,
            'category_id' => $cat4->id, // Güvenlik Standartları kategorisi
            'status' => 'published',
            'published_at' => Carbon::now()->subDays(2),
        ]);

        // BLOG YAZISI 4
        $post4_content_tr = "
<p>Soğuk hava depoları, gıda işleme tesisleri, ilaç endüstrisi ve kimyasal depolama gibi birçok sektör için hayati öneme sahiptir. Bu tesislerde, ürünlerin kalitesini, güvenliğini ve raf ömrünü korumak için belirli düşük sıcaklıkların hassas bir şekilde kontrol edilmesi gerekir. Bu kontrolün en kritik unsurlarından biri, şüphesiz ki etkin bir soğuk izolasyondur. Yetersiz veya yanlış yapılmış bir izolasyon, sadece enerji maliyetlerini fırlatmakla kalmaz, aynı zamanda ciddi operasyonel sorunlara ve ürün kayıplarına yol açabilir.</p>

<h5>Soğuk İzolasyonun Temel Amaçları</h5>
<p>Soğuk hava depoları ve soğutma sistemlerinde izolasyonun birden fazla kritik görevi vardır:</p>
<ul>
    <li><strong>Isı Kazancını Engellemek:</strong> En temel amaç, dış ortamdaki sıcak havanın soğutulmuş alana girmesini engellemektir. Dışarıdan gelen her ısı birimi, soğutma sisteminin daha fazla çalışması ve dolayısıyla daha fazla enerji tüketmesi anlamına gelir. Kalın ve düşük ısıl iletkenliğe sahip izolasyon malzemeleri, bu ısı köprüsünü minimize eder.</li>
    <li><strong>Yoğuşmayı Önlemek:</strong> Soğuk yüzeyler (boru hatları, depo duvarları, tavanlar) ile temas eden daha sıcak ve nemli hava, yoğuşmaya neden olur. Bu su damlacıkları;
        <ul>
            <li>Yüzeylerde buzlanmaya yol açarak izolasyonun etkinliğini düşürebilir.</li>
            <li>Metal yüzeylerde korozyona neden olarak ekipman ve yapı ömrünü kısaltabilir.</li>
            <li>Zeminlerde birikerek kayma tehlikesi yaratabilir.</li>
            <li>Tavanlardan damlayarak depolanan ürünlere zarar verebilir.</li>
            <li>Bakteri ve küf oluşumu için uygun bir ortam yaratabilir.</li>
        </ul>
        Doğru kalınlıkta ve özellikle buhar kesici katmana sahip bir izolasyon sistemi, yüzey sıcaklığını çiğlenme noktasının üzerinde tutarak yoğuşmayı engeller.</li>
    <li><strong>Sıcaklık Stabilitesini Sağlamak:</strong> Ürünlerin kalitesinin korunması için depo içindeki sıcaklığın belirli bir aralıkta sabit kalması gerekir. Etkin izolasyon, dış sıcaklık dalgalanmalarının iç ortam üzerindeki etkisini azaltarak sıcaklık stabilitesine katkıda bulunur.</li>
</ul>

<h5>Soğuk İzolasyonda Kullanılan Malzemeler ve Sistem Detayları</h5>
<p>Soğuk izolasyon uygulamalarında, düşük sıcaklıklara dayanıklı, düşük ısıl iletkenliğe sahip ve özellikle düşük su buharı geçirgenliğine sahip malzemeler tercih edilir. Yaygın olarak kullanılan malzemeler şunlardır:</p>
<ul>
    <li><strong>Poliüretan (PUR) ve Poliizosiyanürat (PIR) Köpükler:</strong> Levha veya sprey formunda uygulanabilen bu malzemeler, çok düşük ısıl iletkenlik değerleri sunar ve mükemmel yalıtım performansı sağlarlar. Özellikle sandviç panel yapımında ve yerinde sprey uygulamalarında sıkça kullanılırlar.</li>
    <li><strong>Ekstrüde Polistiren (XPS) Köpük:</strong> Yüksek basınç dayanımı ve düşük su emme özelliği ile özellikle zemin ve temel yalıtımlarında tercih edilir.</li>
    <li><strong>Elastomerik Kauçuk Köpüğü:</strong> Esnek yapısı sayesinde özellikle boru ve vana yalıtımlarında kolay uygulama sağlar. Kapalı hücre yapısı iyi bir buhar direnci sunar.</li>
    <li><strong>Camyünü ve Taşyünü:</strong> Genellikle daha yüksek sıcaklık uygulamalarında kullanılsa da, doğru yoğunlukta ve buhar kesici ile birlikte soğuk uygulamalarda da kullanılabilirler. Ancak nemden korunmaları çok önemlidir.</li>
</ul>
<p>Soğuk izolasyon sisteminin başarısındaki en kritik faktörlerden biri **buhar kesici (vapour barrier)** katmandır. Bu katman, sıcak ve nemli havanın izolasyon malzemesinin içine sızmasını ve orada yoğuşmasını engeller. Buhar kesicinin eksiksiz ve sızdırmaz bir şekilde uygulanması (tüm ek yerlerinin ve bitiş noktalarının özel bantlarla veya yapıştırıcılarla kapatılması) hayati önem taşır. Aksi takdirde, izolasyon malzemesi içinde biriken nem ve buz, malzemenin yalıtım özelliğini kaybetmesine ve zamanla tamamen bozulmasına neden olur.</p>
<p>Ayrıca, taşıyıcı sistemler, askı elemanları ve diğer yapısal bağlantı noktalarında ısı köprülerinin oluşmasını engellemek için özel detaylar ve yalıtımlı destek elemanları kullanılmalıdır.</p>

<h5>İzokoç İzolasyon ile Güvenilir Soğuk Zincir</h5>
<p>Soğuk hava depoları ve soğutma sistemleri, hassas operasyonlardır ve izolasyon hataları büyük maliyetlere yol açabilir. İzokoç İzolasyon olarak, bu alandaki derin tecrübemiz ve mühendislik birikimimizle;</p>
<ul>
    <li>Doğru malzeme ve sistem seçimini yapıyoruz.</li>
    <li>Hassas mühendislik hesaplamaları ile optimum izolasyon kalınlığını belirliyoruz.</li>
    <li>Buhar kesici uygulamasını ve sızdırmazlık detaylarını titizlikle uyguluyoruz.</li>
    <li>Isı köprülerini minimize edecek detay çözümleri üretiyoruz.</li>
    <li>Uygulamalarımızı uluslararası standartlara ve kalite kontrol prosedürlerine uygun olarak gerçekleştiriyoruz.</li>
</ul>
<p>Sonuç olarak, soğuk hava depolarında ve soğutma sistemlerinde doğru tasarlanmış ve uygulanmış bir izolasyon, enerji tasarrufu sağlamanın, ürün kalitesini korumanın, işletme güvenliğini artırmanın ve tesis ömrünü uzatmanın vazgeçilmez bir parçasıdır. İzokoç İzolasyon, soğuk zincirinizin her halkasında güvenilir yalıtım ortağınızdır.</p>
        ";
        $post4_content_en = "
Cold storage facilities, food processing plants, the pharmaceutical industry, and chemical storage are vital for many sectors. In these facilities, precise control of specific low temperatures is required to maintain product quality, safety, and shelf life. One of the most critical elements of this control is undoubtedly effective cold insulation. Insufficient or improperly installed insulation not only skyrockets energy costs but can also lead to serious operational problems and product losses.

Primary Objectives of Cold Insulation
Insulation in cold storage and refrigeration systems serves multiple critical functions:

    Preventing Heat Gain: The most fundamental goal is to prevent warm ambient air from entering the cooled space. Every unit of heat ingress means the cooling system must work harder, thus consuming more energy. Thick insulation materials with low thermal conductivity minimize this heat bridge.
    Preventing Condensation: Warmer, humid air coming into contact with cold surfaces (pipelines, warehouse walls, ceilings) causes condensation. These water droplets can:
        
            Lead to icing on surfaces, reducing insulation effectiveness.
            Cause corrosion on metal surfaces, shortening the lifespan of equipment and structures.
            Accumulate on floors, creating slip hazards.
            Drip from ceilings, potentially damaging stored products.
            Create a favorable environment for bacteria and mold growth.
        
        An insulation system of the correct thickness, especially one incorporating a vapor barrier, keeps the surface temperature above the dew point, preventing condensation.
    Ensuring Temperature Stability: Maintaining a stable temperature within a specific range inside the storage is crucial for preserving product quality. Effective insulation reduces the impact of external temperature fluctuations on the internal environment, contributing to temperature stability.


Materials and System Details Used in Cold Insulation
For cold insulation applications, materials resistant to low temperatures, with low thermal conductivity, and particularly low water vapor permeability are preferred. Commonly used materials include:

    Polyurethane (PUR) and Polyisocyanurate (PIR) Foams: Available in board or spray form, these materials offer very low thermal conductivity values and provide excellent insulation performance. They are frequently used in sandwich panel construction and on-site spray applications.
    Extruded Polystyrene (XPS) Foam: Preferred especially for floor and foundation insulation due to its high compressive strength and low water absorption.
    Elastomeric Rubber Foam: Its flexible nature allows for easy application, particularly on pipes and valves. Its closed-cell structure offers good vapor resistance.
    Glass Wool and Rock Wool: Although generally used in higher temperature applications, they can be used in cold applications with the correct density and vapor barrier. However, protecting them from moisture is crucial.

One of the most critical factors for the success of a cold insulation system is the **vapor barrier**. This layer prevents warm, moist air from penetrating the insulation material and condensing within it. The complete and sealed application of the vapor barrier (sealing all joints and termination points with special tapes or adhesives) is vital. Otherwise, moisture and ice accumulating inside the insulation material will cause it to lose its insulating properties and eventually degrade completely.
Furthermore, special details and insulated support elements must be used at structural connections, hangers, and other points to prevent the formation of thermal bridges.

Reliable Cold Chain with İzokoç İzolasyon
Cold storage facilities and refrigeration systems are sensitive operations, and insulation failures can lead to significant costs. As İzokoç İzolasyon, with our deep experience and engineering knowledge in this field, we:

    Select the correct materials and systems.
    Determine the optimal insulation thickness through precise engineering calculations.
    Meticulously apply vapor barriers and sealing details.
    Develop detailed solutions to minimize thermal bridges.
    Execute our applications in compliance with international standards and quality control procedures.

In conclusion, properly designed and installed insulation in cold storage and refrigeration systems is an indispensable part of saving energy, preserving product quality, enhancing operational safety, and extending facility lifespan. İzokoç İzolasyon is your reliable insulation partner in every link of your cold chain.
        ";
        $post4 = Post::create([
            'title' => ['tr' => 'Soğuk Hava Depolarında İzolasyonun Kritik Önemi', 'en' => 'The Critical Importance of Insulation in Cold Storage'],
            'slug' => Str::slug('Soğuk Hava Depolarında İzolasyonun Kritik Önemi'),
            'content' => ['tr' => $post4_content_tr, 'en' => $post4_content_en],
            'excerpt' => ['tr' => 'Soğuk zincirin korunmasında izolasyon neden hayati? Yoğuşma kontrolü, enerji tasarrufu ve doğru malzeme seçimi hakkında bilgiler.', 'en' => 'Why is insulation vital in maintaining the cold chain? Information on condensation control, energy savings, and proper material selection.'],
            'featured_image' => 'uploads/posts/featured/izokoc-blog-4.jpg', // Placeholder veya gerçek görsel yolu
            'user_id' => $author->id,
            'category_id' => $cat1->id, // Endüstriyel İzolasyon kategorisi
            'status' => 'published',
            'published_at' => Carbon::now(), // En güncel yazı
        ]);

        // 8. Yazılar ve etiketler arasındaki ilişkiyi kuralım (Eloquent ile)
        $post1->tags()->attach([$tag1->id, $tag2->id, $tag8->id]); // Termal Yalıtım, Enerji Tasarrufu, Maliyet Azaltma
        $post2->tags()->attach([$tag3->id, $tag4->id, $tag6->id]); // Akustik Yalıtım, Ses Yalıtımı, İş Güvenliği
        $post3->tags()->attach([$tag5->id, $tag6->id, $cat4->id]); // Yangın Durdurucu, İş Güvenliği, Güvenlik Standartları (Kategori ID'si etiket gibi kullanılabilir mi? Genelde ayrı tutulur, ama örnekte böyle yapmışsınız)
        // Eğer kategori ID'sini etiket olarak kullanmak istemiyorsanız, $cat4->id yerine uygun bir etiket ID'si (örn: $tag6->id) kullanın.
        $post4->tags()->attach([$tag7->id, $tag2->id, $tag8->id]); // Soğuk İzolasyon, Enerji Tasarrufu, Maliyet Azaltma
    }
}