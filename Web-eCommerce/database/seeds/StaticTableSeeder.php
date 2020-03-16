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

        $producers = [
            [ 'id' => 1, 'name' => 'Gibson', 'image_ref' => '/images/producers/Gibson_logo.jpg', 
            'link' => 'gibson.com', 'details' => 'Gibson Brands, Inc. (formerly Gibson Guitar Corporation) is an American manufacturer of guitars, other musical instruments, and professional audio equipment from Kalamazoo, Michigan, and now based in Nashville, Tennessee. The company was formerly known as Gibson Guitar Corporation and renamed Gibson Brands, Inc. on June 11, 2013.' ],
            [ 'id' => 2, 'name' => 'Shure', 'image_ref' => '/images/producers/Shure_logo.png', 
            'link' => 'www.shure.com', 'details' => 'Shure Incorporated is an American audio products corporation. It was founded by Sidney N. Shure in Chicago, Illinois in 1925 as a supplier of radio parts kits. The company became a consumer and professional audio-electronics manufacturer of microphones, wireless microphone systems, phonograph cartridges, discussion systems, mixers, and digital signal processing. The company also manufactures listening products, including headphones, high-end earphones, and personal monitor systems.' ],
            [ 'id' => 3, 'name' => 'Yamaha Corporation', 'image_ref' => '/images/producers/Yamaha_logo.jpg', 
            'link' => 'yamaha.com', 'details' => 'Yamaha Corporation (ヤマハ株式会社, Yamaha Kabushiki Gaisha) (/ˈjæməˌhɑː/; Japanese pronunciation: [jamaha]) is a Japanese multinational corporation and conglomerate with a very wide range of products and services. It is one of the constituents of Nikkei 225 and is the world\'s largest piano manufacturing company. The former motorcycle division was established in 1955 as Yamaha Motor Co., Ltd., which started as an affiliated company but later became independent, although Yamaha Corporation is still a major shareholder.' ],
            [ 'id' => 4, 'name' => 'Fender Musical Instruments Corporation', 'image_ref' => '/images/producers/Fender_guitars_logo.svg.png', 
            'link' => 'fender.com', 'details' => 'Fender Musical Instruments Corporation (FMIC, or simply Fender) is an American manufacturer of stringed instruments and amplifiers. Fender produces acoustic guitars, bass amplifiers and public address equipment, but is best known for its solid-body electric guitars and bass guitars, particularly the Stratocaster, Telecaster, Precision Bass, and the Jazz Bass. The company was founded in Fullerton, California, by Clarence Leonidas "Leo" Fender in 1946. Its headquarters are in Scottsdale, Arizona.' ],
            [ 'id' => 5, 'name' => 'Steinway Musical Instruments', 'image_ref' => '/images/producers/Steinway_logo.svg.png', 
            'link' => 'steinway.com', 'details' => 'Steinway Musical Instruments, Inc. is a worldwide musical instrument manufacturing and marketing conglomerate, based in Waltham, Massachusetts, the United States. It was formed in a 1995 merger between the Selmer Industries and Steinway Musical Properties, the parent company of Steinway & Sons piano manufacturers. From 1996 to 2013, Steinway Musical Instruments was traded at the New York Stock Exchange (NYSE) under the abbreviation LVB, for Ludwig van Beethoven.[1][2] It was acquired by the Paulson & Co. private capital firm in 2013.' ],
            [ 'id' => 6, 'name' => 'Sennheiser', 'image_ref' => '/images/producers/Sennheiser_logo.jpg', 
            'link' => 'sennheiser.com', 'details' => 'Sennheiser electronic GmbH & Co. KG (/ˈzɛnhaɪzər/) is a German privately held audio company specializing in the design and production of a wide range of high fidelity products, including microphones, headphones, telephone accessories and aviation headsets for personal, professional and business applications.' ],
            [ 'id' => 7, 'name' => 'Roland Corporation', 'image_ref' => '/images/producers/Roland_logo.svg.png', 
            'link' => 'roland.com', 'details' => 'Roland Corporation (ローランド株式会社, Rōrando Kabushiki Kaisha) is a Japanese manufacturer of electronic musical instruments, electronic equipment and software. It was founded by Ikutaro Kakehashi in Osaka on April 18, 1972. In 2005, Roland\'s headquarters relocated to Hamamatsu in Shizuoka Prefecture. It has factories in Taiwan, Japan, and the USA. As of March 31, 2010, it employed 2,699 employees. In 2014, Roland was subject to a management buyout by Roland\'s CEO Junichi Miki, supported by Taiyo Pacific Partners.' ],
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
            [ 'id' => 10, 'name' => 'pink', 'attribute_id' => 2 ],
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
    }
}
