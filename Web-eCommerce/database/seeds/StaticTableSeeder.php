<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Kalnoy\Nestedset\NodeTrait;
use App\Category;

class StaticTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name' => 'User']);
        $role2 = Role::create(['name' => 'Shipment Representative']);
        $role3 = Role::create(['name' => 'Inventory Representative']);
        $role4 = Role::create(['name' => 'Administrator']);
        
        $permission = Permission::create(['name' => 'Management products']);
        $permission = Permission::create(['name' => 'Management delivery']);
        $permission = Permission::create(['name' => 'Management users']);
        $permission = Permission::create(['name' => 'See invoices']);
        $role1->givePermissionTo($permission);


        /**
         * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! 
         * 
         * SUI RIFERIMENTI DLLE IMMAGINI VANNO MESSI GLI SLASH '/', NON I BACKSLASH '\' 
         * 
         * !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! 
         */

        $carriers = [            
            [ 'id' => 1, 'name' => 'United Parcel Service', 'image_ref' => '/images/carriers/UPS_logo.png', 
            'link' => 'www.ups.com', 'details' => 'United Parcel Service (UPS; stylized as ups) is an American multinational package delivery and supply chain management company.

            Along with the central package delivery operation, the UPS brand name (in a fashion similar to that of competitor FedEx) is used to denote many of its divisions and subsidiaries, including its cargo airline (UPS Airlines), freight-based trucking operation (UPS Freight, formerly Overnite Transportation), and its delivery drone airline (UPS Flight Forward). The global logistics company is headquartered in the U.S. city of Sandy Springs, Georgia, which is a part of the Greater Atlanta metropolitan area.'],
            [ 'id' => 2, 'name' => 'FedEx', 'image_ref' => '/images/carriers/FedEx_logo.svg.png', 
            'link' => 'www.fedex.com', 'details' => 'FedEx Corporation is an American multinational delivery services company headquartered in Memphis, Tennessee. The name "FedEx" is a syllabic abbreviation of the name of the company original air division, Federal Express (now FedEx Express), which was used from 1973 until 2000. The company is known for its overnight shipping service and pioneering a system that could track packages and provide real-time updates on package location, a feature that has now been implemented by most other carrier services. FedEx is also one of the top contractors of the US government.'],
            [ 'id' => 3, 'name' => 'XPO Logistics', 'image_ref' => '/carriers/images/XPO_logo.svg.png', 
            'link' => 'XPO.com', 'details' => 'XPO Logistics, Inc. (NYSE: XPO) is one of the 10 largest providers of transportation and logistics services in the world. It operates in 30 countries, with approximately 100,000 employees and over 50,000 customers, including 69 of the Fortune 100. XPO Logistics, Inc. is the 7th best-performing stock of the last decade on the Fortune 500, with share prices rising more than 1,000% from the time its CEO, Bradley Jacobs, took control. XPO corporate headquarters are located in Greenwich, Connecticut. Its European headquarters are located in Lyon, France.'],
            [ 'id' => 4, 'name' => 'J. B. Hunt', 'image_ref' => '/images/carriers/Hunt_logo.svg.png', 
            'link' => 'JBHunt.com', 'details' => 'J.B. Hunt Transport Services, Inc. (NASDAQ:JBHT) is a transportation and logistics company company based in Lowell, Arkansas. J.B. Hunt was founded by Johnnie Bryan Hunt and  Johnelle Hunt in Arkansas on August 10, 1961. By 1983, J.B. Hunt had grown into the 80th largest trucking firm in the U.S. and earned $623.47 million in revenue. At that time J.B. Hunt was operating 550 tractors, 1,049 trailers, and had roughly 1,050 employees. J.B. Hunt primarily operates large semi-trailer trucks and provides transportation services throughout the continental U.S., Canada and Mexico. The company currently employs over 24,000 and operates more than 12,000 trucks. Over 100,000 trailers and containers can be found in the fleet of the company.'],
            [ 'id' => 5, 'name' => 'Knight-Swift', 'image_ref' => '/images/carriers/Knight-Swift_logo.png', 
            'link' => 'KnightTrans.com', 'details' => 'Knight-Swift Transportation Holdings Inc. (referred to as Knight-Swift) is a publicly traded, American, truckload motor shipping carrier based in Phoenix, Arizona. It is the largest trucking company in the United States.'],
            [ 'id' => 6, 'name' => 'YRC Worldwide', 'image_ref' => '/images/carriers/YRC_logo.svg.png', 
            'link' => 'YRCW.com', 'details' => 'YRC Worldwide Inc. is an American holding company of freight shipping brands YRC Freight, New Penn, Holland and Reddaway. YRC Worldwide has a comprehensive network in North America, and offers shipping of industrial, commercial and retail goods. The company is headquartered in Overland Park, Kansas.'],
        ];
    
        foreach ($carriers as $carrier) {
            DB::table('carriers')->insert($carrier);
        }

        DB::table('iva_categories')->insert(['id' => 1,'category' => 'beni di lusso','value' => 22]);
        DB::table('iva_categories')->insert(['id' => 2,'category' => 'beni di prima necessità','value' => 10]);

        $producers = [
            [ 'id' => 1, 'name' => 'Gibson', 'image_ref' => '/images/producers/Gibson_logo.jpg', 
            'link' => 'https://www.gibson.com/', 'details' => 'Gibson Brands, Inc. (formerly Gibson Guitar Corporation) is an American manufacturer of guitars, other musical instruments, and professional audio equipment from Kalamazoo, Michigan, and now based in Nashville, Tennessee. The company was formerly known as Gibson Guitar Corporation and renamed Gibson Brands, Inc. on June 11, 2013.' ],
            [ 'id' => 2, 'name' => 'Shure', 'image_ref' => '/images/producers/Shure_logo.png', 
            'link' => 'https://www.www.shure.com/', 'details' => 'Shure Incorporated is an American audio products corporation. It was founded by Sidney N. Shure in Chicago, Illinois in 1925 as a supplier of radio parts kits. The company became a consumer and professional audio-electronics manufacturer of microphones, wireless microphone systems, phonograph cartridges, discussion systems, mixers, and digital signal processing. The company also manufactures listening products, including headphones, high-end earphones, and personal monitor systems.' ],
            [ 'id' => 3, 'name' => 'Yamaha Corporation', 'image_ref' => '/images/producers/Yamaha_logo.jpg', 
            'link' => 'https://www.yamaha.com/', 'details' => 'Yamaha Corporation (ヤマハ株式会社, Yamaha Kabushiki Gaisha) (/ˈjæməˌhɑː/; Japanese pronunciation: [jamaha]) is a Japanese multinational corporation and conglomerate with a very wide range of products and services. It is one of the constituents of Nikkei 225 and is the world\'s largest piano manufacturing company. The former motorcycle division was established in 1955 as Yamaha Motor Co., Ltd., which started as an affiliated company but later became independent, although Yamaha Corporation is still a major shareholder.' ],
            [ 'id' => 4, 'name' => 'Fender Musical Instruments Corporation', 'image_ref' => '/images/producers/Fender_guitars_logo.svg.png', 
            'link' => 'https://www.fender.com/', 'details' => 'Fender Musical Instruments Corporation (FMIC, or simply Fender) is an American manufacturer of stringed instruments and amplifiers. Fender produces acoustic guitars, bass amplifiers and public address equipment, but is best known for its solid-body electric guitars and bass guitars, particularly the Stratocaster, Telecaster, Precision Bass, and the Jazz Bass. The company was founded in Fullerton, California, by Clarence Leonidas "Leo" Fender in 1946. Its headquarters are in Scottsdale, Arizona.' ],
            [ 'id' => 5, 'name' => 'Steinway Musical Instruments', 'image_ref' => '/images/producers/Steinway_logo.svg.png', 
            'link' => 'https://www.steinway.com/', 'details' => 'Steinway Musical Instruments, Inc. is a worldwide musical instrument manufacturing and marketing conglomerate, based in Waltham, Massachusetts, the United States. It was formed in a 1995 merger between the Selmer Industries and Steinway Musical Properties, the parent company of Steinway & Sons piano manufacturers. From 1996 to 2013, Steinway Musical Instruments was traded at the New York Stock Exchange (NYSE) under the abbreviation LVB, for Ludwig van Beethoven.[1][2] It was acquired by the Paulson & Co. private capital firm in 2013.' ],
            [ 'id' => 6, 'name' => 'Sennheiser', 'image_ref' => '/images/producers/Sennheiser_logo.jpg', 
            'link' => 'https://www.sennheiser.com/', 'details' => 'Sennheiser electronic GmbH & Co. KG (/ˈzɛnhaɪzər/) is a German privately held audio company specializing in the design and production of a wide range of high fidelity products, including microphones, headphones, telephone accessories and aviation headsets for personal, professional and business applications.' ],
            [ 'id' => 7, 'name' => 'Roland Corporation', 'image_ref' => '/images/producers/Roland_logo.svg.png', 
            'link' => 'https://www.roland.com/', 'details' => 'Roland Corporation (ローランド株式会社, Rōrando Kabushiki Kaisha) is a Japanese manufacturer of electronic musical instruments, electronic equipment and software. It was founded by Ikutaro Kakehashi in Osaka on April 18, 1972. In 2005, Roland\'s headquarters relocated to Hamamatsu in Shizuoka Prefecture. It has factories in Taiwan, Japan, and the USA. As of March 31, 2010, it employed 2,699 employees. In 2014, Roland was subject to a management buyout by Roland\'s CEO Junichi Miki, supported by Taiyo Pacific Partners.' ],
            [ 'id' => 8, 'name' => 'Takamine ', 'image_ref' => '/images/producers/Logo_Takamine_guitar.svg.png', 
            'link' => 'https://www.takamine.com/', 'details' => 'Takamine Co., Ltd. (株式会社 高峰楽器製作所, Kabushiki-gaisha Takamine Gakki Seisakusho) is a Japanese guitar manufacturer based in Nakatsugawa, Gifu, Japan. Takamine is known for its steel-string acoustic guitars.
            The company was founded in May 1962; in 1978 they were one of the first companies to introduce acoustic-electric models, where they pioneered the design of the preamplifier-equalizer component.
            The company name is pronounced /tɑːkɑːˈmiːneɪ/ ("ta - ka - mee - nay") in Japanese; it is often pronounced /ˈtækəmaɪn/ ("ta - ka - mine") in English.[citation needed] The name comes from Mount Takamine located in Nakatsugawa.' ],
            [ 'id' => 9, 'name' => 'DigiTech ', 'image_ref' => '/images/producers/', 
            'link' => 'https://www.digitech.com/', 'details' => 'DigiTech is an American company which manufactures digital effects units.' ],
            [ 'id' => 10, 'name' => 'TC Electronic', 'image_ref' => '/images/producers/Logo-DigiTech_logo.svg.png', 
            'link' => 'https://www.tcelectronic.com/', 'details' => 'TC Electronic is a Danish audio equipment company that designs and imports guitar effects, bass amplification, computer audio interfaces, audio plug-in software, live sound equalisers, studio and post production equipment, studio effect processors, and broadcast loudness processors and meters.' ],
            [ 'id' => 11, 'name' => 'Proel', 'image_ref' => '/images/producers/logo_proel.png', 
            'link' => 'https://www.proel.com/', 'details' => 'In 1997, PROEL was already a well-organised company and decided that a key step to be taken was to create a “Made in Italy” Research, Design and Prototyping department. What was puIn 1998, the drummers arrived and everything became a bit more lively. PROEL acquires the historic Tamburo Drums brand.'],
            [ 'id' => 12, 'name' => 'Sagitter', 'image_ref' => '/images/producers/logo sagiiter.png', 
            'link' => 'https://www.sagitter.com/', 'details' => 'Founded in 1992, Sagitter was created by one of the original founders of Clay Paky Lighting company.
            In 2009 Proel Group acquired the Sagitter brand as part of the plan for strengthening its position in the professional lighting field.
            The Abruzzo based multinational began by opening a new Research and Development department, focused on reinvigorating the Sagitter product line through innovation and design to re-establish the legendary brand as a market leader.'],
        ];
    
        foreach ($producers as $producer) {
            DB::table('producers')->insert($producer);
        }

        $stats = [
            [ 'id' => 1, 'status' => 'Not Found' ],
            [ 'id' => 2, 'status' => 'In Transit' ],
            [ 'id' => 3, 'status' => 'Pick Up' ],
            [ 'id' => 4, 'status' => 'Undelivered ' ],
            [ 'id' => 5, 'status' => 'Delivered ' ],
            [ 'id' => 6, 'status' => 'Alert' ],
            [ 'id' => 7, 'status' => 'Expired' ]
        ];
    
        foreach ($stats as $stat) {
            DB::table('delivery_statuses')->insert($stat);
        }

        $attributes = [
            [ 'id' => 1, 'name' => 'Cord number' ],
            [ 'id' => 2, 'name' => 'Color' ],
            [ 'id' => 3, 'name' => 'Body' ],
            [ 'id' => 4, 'name' => 'Pick ups' ],
            [ 'id' => 5, 'name' => 'Lenght' ],
            [ 'id' => 6, 'name' => 'Weight' ],
            [ 'id' => 7, 'name' => 'Keys number' ], // piani
            [ 'id' => 8, 'name' => 'Sounds' ],
            [ 'id' => 9, 'name' => 'Interface' ],
            [ 'id' => 10, 'name' => 'Composition' ], // batterie
            [ 'id' => 11, 'name' => 'Woods' ],
            [ 'id' => 12, 'name' => 'Effect type' ], // effetti
            [ 'id' => 13, 'name' => 'Capsule' ], // microfoni
            [ 'id' => 14, 'name' => 'Polar pattern' ], 
            [ 'id' => 15, 'name' => 'Tension Type' ], // cavi e alimentatori
            [ 'id' => 16, 'name' => 'Connectors' ],
            [ 'id' => 17, 'name' => 'Woofer' ], // casse
            [ 'id' => 18, 'name' => 'Tweeter' ],
            [ 'id' => 19, 'name' => 'Watt RMS' ],
            [ 'id' => 20, 'name' => 'In. number' ], // mixer
            [ 'id' => 21, 'name' => 'Mic In.' ],
            [ 'id' => 22, 'name' => 'Multieffect' ], 
            [ 'id' => 23, 'name' => 'Light Type' ],// luci
            [ 'id' => 24, 'name' => 'LED' ],
            [ 'id' => 25, 'name' => 'Light Watt' ],
            [ 'id' => 26, 'name' => 'DMX' ],
        ];
    
        foreach ($attributes as $attribute) {
            DB::table('attributes')->insert($attribute);
        }

        $values = [
            [ 'id' => 1, 'name' => '4', 'attribute_id' => 1 ],
            [ 'id' => 2, 'name' => '5', 'attribute_id' => 1 ],
            [ 'id' => 3, 'name' => '6', 'attribute_id' => 1 ],
            [ 'id' => 4, 'name' => '7', 'attribute_id' => 1 ],
            [ 'id' => 5, 'name' => 'red', 'attribute_id' => 2 ],
            [ 'id' => 6, 'name' => 'black', 'attribute_id' => 2 ],
            [ 'id' => 7, 'name' => 'green', 'attribute_id' => 2 ],
            [ 'id' => 8, 'name' => 'white', 'attribute_id' => 2 ],
            [ 'id' => 9, 'name' => 'blue', 'attribute_id' => 2 ],
            [ 'id' => 10, 'name' => 'brown', 'attribute_id' => 2 ],
            [ 'id' => 11, 'name' => 'maple', 'attribute_id' => 3 ],
            [ 'id' => 12, 'name' => 'rosewood', 'attribute_id' => 3 ],
            [ 'id' => 13, 'name' => 'fir', 'attribute_id' => 3 ],
            [ 'id' => 14, 'name' => 'mahogany', 'attribute_id' => 3 ],
            [ 'id' => 15, 'name' => '61', 'attribute_id' => 7 ],
            [ 'id' => 16, 'name' => '88', 'attribute_id' => 7 ],
            [ 'id' => 17, 'name' => '74', 'attribute_id' => 7 ],
            [ 'id' => 18, 'name' => '10', 'attribute_id' => 8 ],
            [ 'id' => 19, 'name' => '20', 'attribute_id' => 8 ],
            [ 'id' => 20, 'name' => '30', 'attribute_id' => 8 ],
            [ 'id' => 21, 'name' => 'USB', 'attribute_id' => 9 ],
            [ 'id' => 22, 'name' => 'MIDI', 'attribute_id' => 9 ],
            [ 'id' => 23, 'name' => 'H H', 'attribute_id' => 4 ],
            [ 'id' => 24, 'name' => 'S S S', 'attribute_id' => 4 ],
            [ 'id' => 25, 'name' => 'S S H', 'attribute_id' => 4 ],
            [ 'id' => 26, 'name' => '20+10T+12T+14F+14S', 'attribute_id' => 10 ],
            [ 'id' => 27, 'name' => '20+10T+15H+15F+14S', 'attribute_id' => 10 ],
            [ 'id' => 28, 'name' => '30+20T+22T+24F+AAA', 'attribute_id' => 10 ],
            [ 'id' => 29, 'name' => 'maple', 'attribute_id' => 11 ],
            [ 'id' => 30, 'name' => 'rosewood', 'attribute_id' => 11 ],
            [ 'id' => 31, 'name' => 'fir', 'attribute_id' => 11 ],
            [ 'id' => 32, 'name' => 'phaser', 'attribute_id' => 12 ],
            [ 'id' => 33, 'name' => 'distortion', 'attribute_id' => 12 ],
            [ 'id' => 34, 'name' => 'looper', 'attribute_id' => 12 ],
            [ 'id' => 35, 'name' => 'overdrive', 'attribute_id' => 12 ],
            [ 'id' => 36, 'name' => 'static', 'attribute_id' => 13 ],
            [ 'id' => 37, 'name' => 'dynamic', 'attribute_id' => 13 ],
            [ 'id' => 38, 'name' => 'super', 'attribute_id' => 14 ],
            [ 'id' => 39, 'name' => 'hyper', 'attribute_id' => 14 ],
            [ 'id' => 40, 'name' => '5', 'attribute_id' => 5 ],
            [ 'id' => 41, 'name' => '10', 'attribute_id' => 5 ],
            [ 'id' => 42, 'name' => '15', 'attribute_id' => 5 ],
            [ 'id' => 43, 'name' => '9V', 'attribute_id' => 15 ],
            [ 'id' => 44, 'name' => '12V', 'attribute_id' => 15 ],
            [ 'id' => 45, 'name' => '18V', 'attribute_id' => 15 ],
            [ 'id' => 46, 'name' => 'MIDI-MIDI', 'attribute_id' => 16 ],
            [ 'id' => 47, 'name' => 'MALE Jack-MALE Jack ', 'attribute_id' => 16 ],
            [ 'id' => 48, 'name' => 'JACK STEREO-XLR Female', 'attribute_id' => 16 ],
            [ 'id' => 49, 'name' => 'XLR Male-XLR Female', 'attribute_id' => 16 ],
            [ 'id' => 50, 'name' => '12', 'attribute_id' => 17 ],
            [ 'id' => 51, 'name' => '15', 'attribute_id' => 17 ],
            [ 'id' => 52, 'name' => '18', 'attribute_id' => 17 ],
            [ 'id' => 53, 'name' => '1', 'attribute_id' => 18 ],
            [ 'id' => 54, 'name' => '2', 'attribute_id' => 18 ],
            [ 'id' => 55, 'name' => '3', 'attribute_id' => 18 ],
            [ 'id' => 56, 'name' => '400W', 'attribute_id' => 19 ],
            [ 'id' => 57, 'name' => '500W', 'attribute_id' => 19 ],
            [ 'id' => 58, 'name' => '20', 'attribute_id' => 20 ],
            [ 'id' => 59, 'name' => '30', 'attribute_id' => 20 ],
            [ 'id' => 60, 'name' => '8', 'attribute_id' => 21 ],
            [ 'id' => 61, 'name' => '16', 'attribute_id' => 21 ],
            [ 'id' => 62, 'name' => 'yes', 'attribute_id' => 22 ],
            [ 'id' => 63, 'name' => 'no', 'attribute_id' => 22 ],
            [ 'id' => 64, 'name' => 'PAR', 'attribute_id' => 23 ],
            [ 'id' => 65, 'name' => 'KIT', 'attribute_id' => 23 ],
            [ 'id' => 66, 'name' => '7x10W, RGBW 4in1', 'attribute_id' => 24 ],
            [ 'id' => 67, 'name' => '7x10W, RGBW', 'attribute_id' => 24 ],
            [ 'id' => 68, 'name' => '200W', 'attribute_id' => 25 ],
            [ 'id' => 69, 'name' => '300W', 'attribute_id' => 25 ],
            [ 'id' => 70, 'name' => '400W', 'attribute_id' => 25 ],
            [ 'id' => 71, 'name' => '7 channels', 'attribute_id' => 26 ],
            [ 'id' => 72, 'name' => '10 channels', 'attribute_id' => 26 ],
            [ 'id' => 73, 'name' => '18 channels', 'attribute_id' => 26 ],
        ];
    
        foreach ($values as $value) {
            DB::table('values')->insert($value);
        }

        $methods = [
            [ 'id' => 1, 'method' => 'carta di credito' ],
            [ 'id' => 2, 'method' => 'PayPal' ],
            [ 'id' => 3, 'method' => 'saldo' ],
        ];
    
        foreach ($methods as $method) {
            DB::table('payment_methods')->insert($method);
        }

        $root = new Category(['id' => 1,'name' => 'root',]);
        
        $node1 = new Category(['name' => 'Strumenti', 'image_ref' => 'https://www.musicpool.it/web/images/img2.jpg']);
        $node2 = new Category(['name' => 'Accessori e impianti', 'image_ref' => 'https://cdn.chv.me/images/nvXv7BEa.jpeg']);
        $node3 = new Category(['name' => 'Chitarre', 'image_ref' => 'https://d1t3zg51rvnesz.cloudfront.net/p/images/cms2/715/sa-leo-abrahams_product_lkp_2021_small.jpg']);
        $node4 = new Category(['name' => 'Batterie', 'image_ref' => 'https://i.udemycdn.com/course/750x422/195576_d3b9_3.jpg']);
        $node5 = new Category(['name' => 'Tastiere', 'image_ref' => 'https://cdn.schoolofrock.com/img/hero-large-750w/piano-lessons1527267213.jpg']);
        $node6 = new Category(['name' => 'Bassi', 'image_ref' => 'https://www.ibanez.com/common/product_artist_file/file/pc_main_electric_basses_eu_sp.jpg']);
        $node7 = new Category(['name' => 'Alimentazione e cavi', 'image_ref' => 'https://shop.scavino.it/files/scavino2_Files/Foto/643172_2.PNG']);
        $node8 = new Category(['name' => 'Impianti e attrezzatura', 'image_ref' => 'https://d287ku8w5owj51.cloudfront.net/images/products/hero/others/hero-creative-t30-wireless.jpg?width=800&height=800']);
        $node9 = new Category(['name' => 'Alimentatori', 'image_ref' => 'https://muzikercdn.com/uploads/products/2413/241367/thumb_d_gallery_base_bfe274af.jpg']);
        $node10 = new Category(['name' => 'Cavi', 'image_ref' => 'https://www.thomann.de/pics/bdb/457748/13896741_800.jpg']);
        $node11 = new Category(['name' => 'Impianti', 'image_ref' => 'https://rukminim1.flixcart.com/image/352/352/jz4g3gw0/speaker/laptop-desktop-speaker/h/z/y/philips-in-mms4545b-94-mms4545b-9-original-imafj7ztr2cjfgny.jpeg?q=70']);
        $node12 = new Category(['name' => 'Luci', 'image_ref' => 'https://www.strumentimusicali.net/imagesbig/B_PROEL_plledrb4.jpg']);
        $node13 = new Category(['name' => 'Microfoni', 'image_ref' => 'https://www.artskool.it/blog/wp-content/uploads/2018/08/I-tipi-di-microfono1.jpg']);
        $node14 = new Category(['name' => 'Effetti', 'image_ref' => 'https://guitar.com/wp-content/uploads/2018/09/best-multi-effects-pedals-2019@1400x1050.jpg']);
        $node15 = new Category(['name' => 'Sub', 'image_ref' => 'https://i.ebayimg.com/images/g/17UAAOSwFytaGZDP/s-l300.jpg']);
        $node16 = new Category(['name' => 'Casse', 'image_ref' => 'https://d287ku8w5owj51.cloudfront.net/images/products/hero/creative-t15-wireless/hero-creative-t15-wireless.jpg?width=750']);
        $node17 = new Category(['name' => 'Satelliti', 'image_ref' => 'https://www.gato-audio.com/pub/media/catalog/product/cache/c74f88fe0f1c29dd462a9db2ee6962ce/f/m/fm-30_persp_black_grey.jpg']);
        $node18 = new Category(['name' => 'Mixer', 'image_ref' => 'https://images-na.ssl-images-amazon.com/images/I/51J4j6-WvKL._SX425_.jpg']);
        $node19 = new Category(['name' => 'Effetti chitarre', 'image_ref' => 'https://www.thomann.de/blog/wp-content/uploads/2018/01/Header_pedals1_770x425.png']);

        $root->saveAsRoot();

        $node1->appendToNode($root)->save();
        $node2->appendToNode($root)->save();
        $node3->appendToNode($node1)->save();
        $node4->appendToNode($node1)->save();
        $node5->appendToNode($node1)->save();
        $node6->appendToNode($node1)->save();
        $node7->appendToNode($node2)->save();
        $node8->appendToNode($node2)->save();
        $node9->appendToNode($node7)->save();
        $node10->appendToNode($node7)->save();
        $node11->appendToNode($node8)->save();
        $node12->appendToNode($node8)->save();
        $node13->appendToNode($node8)->save();
        $node14->appendToNode($node8)->save();
        $node15->appendToNode($node11)->save();
        $node16->appendToNode($node11)->save();
        $node17->appendToNode($node11)->save();
        $node18->appendToNode($node11)->save();
        $node19->appendToNode($node14)->save();

        $types = [
            [ 'name' => 'Classic guitar Yamaha CG192C', 'image_ref' => '/images/product_type/cg192c.jpg', 'producer_id' => 3], // chitarre
            [ 'name' => 'Classic guitar Yamaha C40 II', 'image_ref' => '/images/product_type/c40-ii-c-40-c40ii.jpg', 'producer_id' => 3],
            [ 'name' => 'Classic guitar elettrificata Takamine TSP148NC-NS', 'image_ref' => '/images/product_type/tsp148nc-ns.jpg', 'producer_id' => 8],
            [ 'name' => 'Eletric guitar Fender strato Relic', 'image_ref' => '/images/product_type/fender-strato-relic-todd-krause.jpg', 'producer_id' => 4],
            [ 'name' => 'Eletric guitar Fender bullet stratocaster', 'image_ref' => '/images/product_type/bullet-stratocaster-lrl-artic-white.jpg', 'producer_id' => 4],
            [ 'name' => 'Eletric guitar Gibson SG STANDARD 2015', 'image_ref' => '/images/product_type/gibson-sg-standard-2015-transluced-black.jpg', 'producer_id' => 1],
            [ 'name' => 'Keyboard Roland BK3 BK', 'image_ref' => '/images/product_type/bk3-bk.jpg', 'producer_id' => 7], // tastiere
            [ 'name' => 'Keyboard Yamaha PSR630', 'image_ref' => '/images/product_type/psr630.jpg', 'producer_id' => 3],
            [ 'name' => 'Keyboard Roland EA7', 'image_ref' => '/images/product_type/ea7.jpg', 'producer_id' => 7],
            [ 'name' => 'Digital piano Roland F140R CB', 'image_ref' => '/images/product_type/f140r-cb.jpg', 'producer_id' => 7],
            [ 'name' => 'Digital piano Yamaha DGX660 BLACK', 'image_ref' => '/images/product_type/dgx660-black.jpg', 'producer_id' => 3],
            [ 'name' => 'Digital piano Roland LX17PE', 'image_ref' => '/images/product_type/lx17pe.jpg', 'producer_id' => 7],
            [ 'name' => 'Eletric Bass Fender MEXICO STD JAZZ BASS FRETLESS 3TS RW', 'image_ref' => '/images/product_type/mexico-std-jazz-bass-fretless-3ts-rw.jpg', 'producer_id' => 4], //bassi
            [ 'name' => 'Eletric Bass Yamaha TRB 1006J NATURAL', 'image_ref' => '/images/product_type/trb-1006j-natural.jpg', 'producer_id' => 3],
            [ 'name' => 'Eletric Bass Fender AMERICAN PRO JAZZ BASS 3-Color Sunb. RW', 'image_ref' => '/images/product_type/american-pro-jazz-bass-3-color-sunb-rw.jpg', 'producer_id' => 4],
            [ 'name' => 'Drum Yamaha RYDEEN 20" RD02F5', 'image_ref' => '/images/product_type/rydeen-20-22-silver-glitter-rd02f5.jpg', 'producer_id' => 3], //batterie
            [ 'name' => 'Drum Yamaha NUOVA STAGE CUSTOM BIRCH SBP0F5 20"', 'image_ref' => '/images/product_type/nuova-stage-custom-birch-sbp0f5-20-22-cherry-wood.jpg', 'producer_id' => 3],
            [ 'name' => 'Drum Yamaha RECORDING CUSTOM', 'image_ref' => '/images/product_type/nuova-recording-custom.jpg', 'producer_id' => 3],
            [ 'name' => 'Drum Yamaha RYDEEN 20" RD02F5', 'image_ref' => '/images/product_type/rydeen-20-22-hot-red-rd02f5.jpg', 'producer_id' => 3],
            [ 'name' => 'Drum elettronica Roland TD50KV + MDS50KV', 'image_ref' => '/images/product_type/td50kv-2B-mds50kv.jpg', 'producer_id' => 7],
            [ 'name' => 'Drum elettronica Roland TD1DMK', 'image_ref' => '/images/product_type/td1dmk.jpg', 'producer_id' => 7],
            [ 'name' => 'Pedals Digitech M101 PHASE 90 M 101', 'image_ref' => '/images/product_type/m101-phase-90-m-101.jpg', 'producer_id' => 9], //effetti chitarre
            [ 'name' => 'Pedals Roland V-GUITAR DISTORTION', 'image_ref' => '/images/product_type/gr-d-v-guitar-distortion.jpg', 'producer_id' => 7],
            [ 'name' => 'Pedals Digitech DONEGAN THE WEAPON', 'image_ref' => '/images/product_type/xas-donegan-the-weapon.jpg', 'producer_id' => 9],
            [ 'name' => 'Pedals Digitech TONE DRIVE', 'image_ref' => '/images/product_type/xtd-tone-drive.jpg', 'producer_id' => 9],
            [ 'name' => 'Pedals Tc Electronic VINTAGE PRE DRIVE PEDAL', 'image_ref' => '/images/product_type/vpd1-vintage-pre-drive-pedal.jpg', 'producer_id' => 10],
            [ 'name' => 'Pedals Tc Electronic XII PHASER', 'image_ref' => '/images/product_type/classic-tc-xii-phaser.jpg', 'producer_id' => 10],
            [ 'name' => 'Picrophone Shure SM58 LCE', 'image_ref' => '/images/product_type/sm58-lce.jpg', 'producer_id' => 2], //  microfoni
            [ 'name' => 'Picrophone Shure BETA58A BETA 58A', 'image_ref' => '/images/product_type/beta58a-beta-58a.jpg', 'producer_id' => 2],
            [ 'name' => 'Picrophone Shure SM57 LCE', 'image_ref' => '/images/product_type/sm57-lce.jpg', 'producer_id' => 2],
            [ 'name' => 'Picrophone Sennheiser E935', 'image_ref' => '/images/product_type/e935.jpg', 'producer_id' => 6],
            [ 'name' => 'Picrophone Shure 55SH SERIES II', 'image_ref' => '/images/product_type/55sh-series-ii.jpg', 'producer_id' => 2],
            [ 'name' => 'Picrophone Sennheiser E825S', 'image_ref' => '/images/product_type/e825s.jpg', 'producer_id' => 6],
            [ 'name' => 'Cable Proel CHL120LU5', 'image_ref' => '/images/product_type/chl120lu5-jack-jack-pipa-5m.jpg', 'producer_id' => 11], // Cavi
            [ 'name' => 'Cable Proel BULK100LU3', 'image_ref' => '/images/product_type/bulk100lu3-jack-jack-3m.jpg', 'producer_id' => 11],
            [ 'name' => 'Cable Proel BULK100LU1', 'image_ref' => '/images/product_type/bulk100lu1-j-j-mt-1.jpg', 'producer_id' => 11],
            [ 'name' => 'Cable Roland FPC/VC2', 'image_ref' => '/images/product_type/fpc-vc2.jpg', 'producer_id' => 7],
            [ 'name' => 'Cable Roland RCC-3-UAUB', 'image_ref' => '/images/product_type/rcc-3-uaub.jpg', 'producer_id' => 7],
            [ 'name' => 'Cable Roland RCC-3-UAUM', 'image_ref' => '/images/product_type/rcc-3-uaum.jpg', 'producer_id' => 7],
            [ 'name' => 'Cable Proel CHLP180LU3', 'image_ref' => '/images/product_type/chlp180lu3.jpg', 'producer_id' => 11],
            [ 'name' => 'Cable Roland SILOS SLFJJM300 J ST MS', 'image_ref' => '/images/product_type/silos-slfjjm300-j-st-ms-j-st-fm-3m.jpg', 'producer_id' => 7],
            [ 'name' => 'Cable Roland RMIDI-B5 BLACK SERIES MIDI', 'image_ref' => '/images/product_type/rmidi-b5-black-series-midi-cable-5ft-1-5m.jpg', 'producer_id' => 7],
            [ 'name' => 'Cable Proel CHL400LU5 MIDI - DIN 5P', 'image_ref' => '/images/product_type/chl400lu5-cavo-midi-din-5p-din-5p-5-mt.jpg', 'producer_id' => 11],
            [ 'name' => 'Cable Proel CHL250LU10', 'image_ref' => '/images/product_type/chl250lu10-can-can-mt10.jpg', 'producer_id' => 11],
            [ 'name' => 'Cable Proel ESO255LU10', 'image_ref' => '/images/product_type/eso255lu10.jpg', 'producer_id' => 11],
            [ 'name' => 'Cable Roland RMC', 'image_ref' => '/images/product_type/rmc-g5-1-5mt.jpg', 'producer_id' => 7],
            [ 'name' => 'Cable Alimentazione Proel SM300LU25', 'image_ref' => '/images/product_type/sm300lu25-alim-shuko-2-2C5m.jpg', 'producer_id' => 11], //  alimentazione
            [ 'name' => 'Cable Alimentazione Proel SM200LU25', 'image_ref' => '/images/product_type/silos-slfjjm300-j-st-ms-j-st-fm-3m.jpg', 'producer_id' => 11],
            [ 'name' => 'Speakers Yamaha DBR10', 'image_ref' => '/images/product_type/dbr10.jpg', 'producer_id' => 3], // casse
            [ 'name' => 'Speakers Yamaha ERGO MODULE', 'image_ref' => '/images/product_type/ergo-module.jpg', 'producer_id' => 3],
            [ 'name' => 'Speakers Yamaha DZR 315', 'image_ref' => '/images/product_type/dzr-315.jpg', 'producer_id' => 3],
            [ 'name' => 'Sub Yamaha DXS15', 'image_ref' => '/images/product_type/dxs15.jpg', 'producer_id' => 3], // sub
            [ 'name' => 'Sub Yamaha DXS15 XLF', 'image_ref' => '/images/product_type/dxs15-xlf.jpg', 'producer_id' => 3],
            [ 'name' => 'Mixer Proel  MQ12USB', 'image_ref' => '/images/product_type/mq12usb.jpg', 'producer_id' => 11], // mixer
            [ 'name' => 'Mixer Yamaha  MG12XU', 'image_ref' => '/images/product_type/mg12xu.jpg', 'producer_id' => 3],
            [ 'name' => 'Mixer Proel MI12', 'image_ref' => '/images/product_type/mi12.jpg', 'producer_id' => 11],
            [ 'name' => 'Mixer Roland V4', 'image_ref' => '/images/product_type/v4-ex.jpg', 'producer_id' => 7],
            [ 'name' => 'Mixer Roland DJ99', 'image_ref' => '/images/product_type/dj99.jpg', 'producer_id' => 7],
            [ 'name' => 'Led Sagitter SLIMPAR 12 DL', 'image_ref' => '/images/product_type/slimpar-12-dl.jpg', 'producer_id' => 12], // Luci
            [ 'name' => 'Led Sagitter LED KIT 7', 'image_ref' => '/images/product_type/led-kit-7.jpg', 'producer_id' => 12],
            [ 'name' => 'Led Sagitter COBETWO', 'image_ref' => '/images/product_type/cobetwo.jpg', 'producer_id' => 12],
            [ 'name' => 'Led Sagitter SMART DOT', 'image_ref' => '/images/product_type/smart-dot.jpg', 'producer_id' => 12],
            [ 'name' => 'Lamp Proel PLC64WS BK', 'image_ref' => '/images/product_type/plc64ws-bk-2Blamp-pllpp64a.jpg', 'producer_id' => 11],
            [ 'name' => 'Lamp Proel PLLP200016', 'image_ref' => '/images/product_type/pllp200016-2000w-230v-gy16.jpg', 'producer_id' => 11],
        ];
        foreach ($types as $type) {
            DB::table('product_types')->insert($type);
        }

        $products = [
            [ 'variant_name' => 'BROWN', 'payment' => 452, 'product_type_id' => 1 ], // chitarre
            [ 'variant_name' => 'BROWN', 'payment' => 171.11, 'product_type_id' => 2 ],
            [ 'variant_name' => 'BLACK', 'payment' => 177.12, 'product_type_id' => 2 ],
            [ 'variant_name' => 'light', 'payment' => 300.33, 'product_type_id' => 3 ],
            [ 'variant_name' => 'Todd Krouse', 'payment' => 725.25, 'product_type_id' => 4 ],
            [ 'variant_name' => 'Artic White', 'payment' => 126.00, 'product_type_id' => 5 ],
            [ 'variant_name' => 'TRANSLUCED BLACK', 'payment' => 1.335, 'product_type_id' => 6 ],//
            [ 'variant_name' => 'Black and White', 'payment' => 725.25, 'product_type_id' => 7 ], // tastiere
            [ 'variant_name' => 'Black and White', 'payment' => 126.00, 'product_type_id' => 8 ],
            [ 'variant_name' => 'Black and White', 'payment' => 725.25, 'product_type_id' => 9 ],
            [ 'variant_name' => 'Black and White', 'payment' => 126.00, 'product_type_id' => 10 ],
            [ 'variant_name' => 'Black and White', 'payment' => 126.00, 'product_type_id' => 11 ],
            [ 'variant_name' => 'Black and White', 'payment' => 254.22, 'product_type_id' => 12 ],//
            [ 'variant_name' => 'Black and Brown', 'payment' => 524.30, 'product_type_id' => 13 ], //bassi
            [ 'variant_name' => 'Brown', 'payment' => 270, 'product_type_id' => 14 ],
            [ 'variant_name' => 'Black and Brown', 'payment' => 199.99, 'product_type_id' => 15 ],//
            [ 'variant_name' => 'White Glitter', 'payment' => 725.25, 'product_type_id' => 16 ], // batterie
            [ 'variant_name' => 'Red', 'payment' => 600.40, 'product_type_id' => 17 ],
            [ 'variant_name' => 'Black', 'payment' => 300.33, 'product_type_id' => 18 ],
            [ 'variant_name' => 'Hot Red', 'payment' => 452, 'product_type_id' => 19 ],
            [ 'variant_name' => 'White', 'payment' => 524.30, 'product_type_id' => 20 ],
            [ 'variant_name' => 'Black', 'payment' => 600.65, 'product_type_id' => 21 ],//
            [ 'variant_name' => 'Mxr', 'payment' => 27.50, 'product_type_id' => 22 ], // effetti chitarre
            [ 'variant_name' => 'GR-D', 'payment' => 33.50, 'product_type_id' => 23 ],
            [ 'variant_name' => 'XAS', 'payment' => 35.50, 'product_type_id' => 24 ],
            [ 'variant_name' => 'XTD', 'payment' => 37.50, 'product_type_id' => 25 ],
            [ 'variant_name' => 'VPD.50', 'payment' => 77.50, 'product_type_id' => 26 ],
            [ 'variant_name' => 'CLASSIC TC', 'payment' => 52.50, 'product_type_id' => 27 ],//
            [ 'variant_name' => 'Basic', 'payment' => 77.50, 'product_type_id' => 28 ], // microfoni
            [ 'variant_name' => 'Basic', 'payment' => 70.50, 'product_type_id' => 29 ],
            [ 'variant_name' => 'Basic', 'payment' => 37.50, 'product_type_id' => 30 ],
            [ 'variant_name' => 'Basic', 'payment' => 90.50, 'product_type_id' => 31 ],
            [ 'variant_name' => 'Basic', 'payment' => 100, 'product_type_id' => 32 ],
            [ 'variant_name' => 'Basic', 'payment' => 46.34, 'product_type_id' => 33 ],//
            [ 'variant_name' => 'JACK JACK PIPA 5M', 'payment' => 7.50, 'product_type_id' => 34 ],// Cavi
            [ 'variant_name' => 'JACK JACK 3M', 'payment' => 8.50, 'product_type_id' => 35 ],
            [ 'variant_name' => 'J-J MT.1', 'payment' => 13.50, 'product_type_id' => 36 ],
            [ 'variant_name' => 'Basic', 'payment' => 15.50, 'product_type_id' => 37 ],
            [ 'variant_name' => 'Basic', 'payment' => 22.50, 'product_type_id' => 38 ],
            [ 'variant_name' => 'Basic', 'payment' => 31.50, 'product_type_id' => 39 ],
            [ 'variant_name' => 'Basic', 'payment' => 2.50, 'product_type_id' => 40 ],
            [ 'variant_name' => 'J ST FM 3M', 'payment' => 4.50, 'product_type_id' => 41 ],
            [ 'variant_name' => 'CABLE 5FT/1.5M', 'payment' => 6.50, 'product_type_id' => 42 ],
            [ 'variant_name' => 'DIN 5P - 5 MT', 'payment' => 9.50, 'product_type_id' => 43 ],
            [ 'variant_name' => 'CAN-CAN MT10', 'payment' => 11.50, 'product_type_id' => 44 ],
            [ 'variant_name' => 'Basic', 'payment' => 11.50, 'product_type_id' => 45 ],
            [ 'variant_name' => 'G5 1.5mt', 'payment' => 12.50, 'product_type_id' => 46 ],
            [ 'variant_name' => 'ALIM SHUKO 2,5M', 'payment' => 22.50, 'product_type_id' => 47 ], // cavi alimentazione
            [ 'variant_name' => 'ALIM ITA 2,5M', 'payment' => 33.50, 'product_type_id' => 48 ],
            [ 'variant_name' => 'Basics', 'payment' => 67.50, 'product_type_id' => 49 ], // casse
            [ 'variant_name' => 'Basics', 'payment' => 78.50, 'product_type_id' => 50 ], 
            [ 'variant_name' => 'Basics', 'payment' => 89.50, 'product_type_id' => 51 ], 
            [ 'variant_name' => 'Basics', 'payment' => 66.50, 'product_type_id' => 52 ],// sub
            [ 'variant_name' => 'Basics', 'payment' => 99.50, 'product_type_id' => 53 ],
            [ 'variant_name' => 'Vocal', 'payment' => 223.50, 'product_type_id' => 54 ],// mixer
            [ 'variant_name' => 'Digital', 'payment' => 250.50, 'product_type_id' => 55 ],
            [ 'variant_name' => 'EX', 'payment' => 290.50, 'product_type_id' => 56 ],
            [ 'variant_name' => 'Surge', 'payment' => 299.99, 'product_type_id' => 57 ],
            [ 'variant_name' => 'Hyper', 'payment' => 267.99, 'product_type_id' => 58 ],
            [ 'variant_name' => 'Hyper', 'payment' => 24.99, 'product_type_id' => 59 ],// luci
            [ 'variant_name' => 'Hyper', 'payment' => 340.99, 'product_type_id' => 60 ],
            [ 'variant_name' => 'Super', 'payment' => 450.99, 'product_type_id' => 61 ],
            [ 'variant_name' => 'Super', 'payment' => 780.99, 'product_type_id' => 62 ],
            [ 'variant_name' => 'Fine Series', 'payment' => 666.99, 'product_type_id' => 63 ],
            [ 'variant_name' => 'Fine Series', 'payment' => 66.99, 'product_type_id' => 64 ],
        ];
        foreach ($products as $product) {
            DB::table('products')->insert($product);
        }

        $images = [
            [ 'image_ref' => '/images/product_type/cg192c.jpg', 'product_id' => 1], // chitarre
            [ 'image_ref' => '/images/product_type/c40-ii-c-40-c40ii.jpg', 'product_id' => 2],
            [ 'image_ref' => '/images/product_type/c40-ii-black.jpg', 'product_id' => 3],
            [ 'image_ref' => '/images/product_type/tsp148nc-ns.jpg', 'product_id' => 4],
            [ 'image_ref' => '/images/product_type/fender-strato-relic-todd-krause.jpg', 'product_id' => 5],
            [ 'image_ref' => '/images/product_type/bullet-stratocaster-lrl-artic-white.jpg', 'product_id' => 6],
            [ 'image_ref' => '/images/product_type/gibson-sg-standard-2015-transluced-black.jpg', 'product_id' => 7],
            [ 'image_ref' => '/images/product_type/bk3-bk.jpg', 'product_id' => 8], // tastiere
            [ 'image_ref' => '/images/product_type/psr630.jpg', 'product_id' => 9],
            [ 'image_ref' => '/images/product_type/ea7.jpg', 'product_id' => 10],
            [ 'image_ref' => '/images/product_type/f140r-cb.jpg', 'product_id' => 11],
            [ 'image_ref' => '/images/product_type/dgx660-black.jpg', 'product_id' => 12],
            [ 'image_ref' => '/images/product_type/lx17pe.jpg', 'product_id' => 13],
            [ 'image_ref' => '/images/product_type/mexico-std-jazz-bass-fretless-3ts-rw.jpg', 'product_id' => 14], //bassi
            [ 'image_ref' => '/images/product_type/trb-1006j-natural.jpg', 'product_id' => 15],
            [ 'image_ref' => '/images/product_type/american-pro-jazz-bass-3-color-sunb-rw.jpg', 'product_id' => 16],
            [ 'image_ref' => '/images/product_type/rydeen-20-22-silver-glitter-rd02f5.jpg', 'product_id' => 17], //batterie
            [ 'image_ref' => '/images/product_type/nuova-stage-custom-birch-sbp0f5-20-22-cherry-wood.jpg', 'product_id' => 18],
            [ 'image_ref' => '/images/product_type/nuova-recording-custom.jpg', 'product_id' => 19],
            [ 'image_ref' => '/images/product_type/rydeen-20-22-hot-red-rd02f5.jpg', 'product_id' => 20],
            [ 'image_ref' => '/images/product_type/td50kv-2B-mds50kv.jpg', 'product_id' => 21],
            [ 'image_ref' => '/images/product_type/td1dmk.jpg', 'product_id' => 22],
            [ 'image_ref' => '/images/product_type/m101-phase-90-m-101.jpg', 'product_id' => 23], //effetti chitarre
            [ 'image_ref' => '/images/product_type/gr-d-v-guitar-distortion.jpg', 'product_id' => 24],
            [ 'image_ref' => '/images/product_type/xas-donegan-the-weapon.jpg', 'product_id' => 25],
            [ 'image_ref' => '/images/product_type/xtd-tone-drive.jpg', 'product_id' => 26],
            [ 'image_ref' => '/images/product_type/vpd1-vintage-pre-drive-pedal.jpg', 'product_id' => 27],
            [ 'image_ref' => '/images/product_type/classic-tc-xii-phaser.jpg', 'product_id' => 28],
            [ 'image_ref' => '/images/product_type/sm58-lce.jpg', 'product_id' => 29], //  microfoni
            [ 'image_ref' => '/images/product_type/beta58a-beta-58a.jpg', 'product_id' => 30],
            [ 'image_ref' => '/images/product_type/sm57-lce.jpg', 'product_id' => 31],
            [ 'image_ref' => '/images/product_type/e935.jpg', 'product_id' => 32],
            [ 'image_ref' => '/images/product_type/55sh-series-ii.jpg', 'product_id' => 33],
            [ 'image_ref' => '/images/product_type/e825s.jpg', 'product_id' => 34],
            [ 'image_ref' => '/images/product_type/chl120lu5-jack-jack-pipa-5m.jpg', 'product_id' => 35], // Cavi
            [ 'image_ref' => '/images/product_type/bulk100lu3-jack-jack-3m.jpg', 'product_id' => 36],
            [ 'image_ref' => '/images/product_type/bulk100lu1-j-j-mt-1.jpg', 'product_id' => 37],
            [ 'image_ref' => '/images/product_type/fpc-vc2.jpg', 'product_id' => 38],
            [ 'image_ref' => '/images/product_type/rcc-3-uaub.jpg', 'product_id' => 39],
            [ 'image_ref' => '/images/product_type/rcc-3-uaum.jpg', 'product_id' => 40],
            [ 'image_ref' => '/images/product_type/chlp180lu3.jpg', 'product_id' => 41],
            [ 'image_ref' => '/images/product_type/silos-slfjjm300-j-st-ms-j-st-fm-3m.jpg', 'product_id' => 42],
            [ 'image_ref' => '/images/product_type/rmidi-b5-black-series-midi-cable-5ft-1-5m.jpg', 'product_id' => 43],
            [ 'image_ref' => '/images/product_type/chl400lu5-cavo-midi-din-5p-din-5p-5-mt.jpg', 'product_id' => 44],
            [ 'image_ref' => '/images/product_type/chl250lu10-can-can-mt10.jpg', 'product_id' => 45],
            [ 'image_ref' => '/images/product_type/eso255lu10.jpg', 'product_id' => 46],
            [ 'image_ref' => '/images/product_type/rmc-g5-1-5mt.jpg', 'product_id' => 47],
            [ 'image_ref' => '/images/product_type/sm300lu25-alim-shuko-2-2C5m.jpg', 'product_id' => 48], //  alimentazione
            [ 'image_ref' => '/images/product_type/silos-slfjjm300-j-st-ms-j-st-fm-3m.jpg', 'product_id' => 49],
            [ 'image_ref' => '/images/product_type/dbr10.jpg', 'product_id' => 50], // casse
            [ 'image_ref' => '/images/product_type/ergo-module.jpg', 'product_id' => 51],
            [ 'image_ref' => '/images/product_type/dzr-315.jpg', 'product_id' => 52],
            [ 'image_ref' => '/images/product_type/dxs15.jpg', 'product_id' => 53], // sub
            [ 'image_ref' => '/images/product_type/dxs15-xlf.jpg', 'product_id' => 54],
            [ 'image_ref' => '/images/product_type/mq12usb.jpg', 'product_id' => 55], // mixer
            [ 'image_ref' => '/images/product_type/mg12xu.jpg', 'product_id' => 56],
            [ 'image_ref' => '/images/product_type/mi12.jpg', 'product_id' => 57],
            [ 'image_ref' => '/images/product_type/v4-ex.jpg', 'product_id' => 58],
            [ 'image_ref' => '/images/product_type/dj99.jpg', 'product_id' => 59],
            [ 'image_ref' => '/images/product_type/slimpar-12-dl.jpg', 'product_id' => 60], // Luci
            [ 'image_ref' => '/images/product_type/led-kit-7.jpg', 'product_id' => 61],
            [ 'image_ref' => '/images/product_type/cobetwo.jpg', 'product_id' => 62],
            [ 'image_ref' => '/images/product_type/smart-dot.jpg', 'product_id' => 63],
            [ 'image_ref' => '/images/product_type/plc64ws-bk-2Blamp-pllpp64a.jpg', 'product_id' => 64],
            [ 'image_ref' => '/images/product_type/pllp200016-2000w-230v-gy16.jpg', 'product_id' => 65],
        ];
        foreach ($images as $image) {
            DB::table('product_images')->insert($image);
        }
    }
}
