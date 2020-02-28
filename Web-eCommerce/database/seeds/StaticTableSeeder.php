<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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


        

        $carriers = [            
            [ 'id' => 1, 'name' => 'United Parcel Service', 'image_ref' => '', 
            'link' => 'www.ups.com', 'details' => 'United Parcel Service (UPS; stylized as ups) is an American multinational package delivery and supply chain management company.

            Along with the central package delivery operation, the UPS brand name (in a fashion similar to that of competitor FedEx) is used to denote many of its divisions and subsidiaries, including its cargo airline (UPS Airlines), freight-based trucking operation (UPS Freight, formerly Overnite Transportation), and its delivery drone airline (UPS Flight Forward). The global logistics company is headquartered in the U.S. city of Sandy Springs, Georgia, which is a part of the Greater Atlanta metropolitan area.'],
            [ 'id' => 2, 'name' => 'FedEx', 'image_ref' => '', 
            'link' => 'www.fedex.com', 'details' => 'FedEx Corporation is an American multinational delivery services company headquartered in Memphis, Tennessee. The name "FedEx" is a syllabic abbreviation of the name of the company original air division, Federal Express (now FedEx Express), which was used from 1973 until 2000. The company is known for its overnight shipping service and pioneering a system that could track packages and provide real-time updates on package location, a feature that has now been implemented by most other carrier services. FedEx is also one of the top contractors of the US government.'],
            [ 'id' => 3, 'name' => 'XPO Logistics', 'image_ref' => '', 
            'link' => 'XPO.com', 'details' => 'XPO Logistics, Inc. (NYSE: XPO) is one of the 10 largest providers of transportation and logistics services in the world. It operates in 30 countries, with approximately 100,000 employees and over 50,000 customers, including 69 of the Fortune 100. XPO Logistics, Inc. is the 7th best-performing stock of the last decade on the Fortune 500, with share prices rising more than 1,000% from the time its CEO, Bradley Jacobs, took control. XPO corporate headquarters are located in Greenwich, Connecticut. Its European headquarters are located in Lyon, France.'],
            [ 'id' => 4, 'name' => 'J. B. Hunt', 'image_ref' => '', 
            'link' => 'JBHunt.com', 'details' => 'J.B. Hunt Transport Services, Inc. (NASDAQ:JBHT) is a transportation and logistics company company based in Lowell, Arkansas. J.B. Hunt was founded by Johnnie Bryan Hunt and  Johnelle Hunt in Arkansas on August 10, 1961. By 1983, J.B. Hunt had grown into the 80th largest trucking firm in the U.S. and earned $623.47 million in revenue. At that time J.B. Hunt was operating 550 tractors, 1,049 trailers, and had roughly 1,050 employees. J.B. Hunt primarily operates large semi-trailer trucks and provides transportation services throughout the continental U.S., Canada and Mexico. The company currently employs over 24,000 and operates more than 12,000 trucks. Over 100,000 trailers and containers can be found in the fleet of the company.'],
            [ 'id' => 5, 'name' => 'Knight-Swift', 'image_ref' => '', 
            'link' => 'KnightTrans.com', 'details' => 'Knight-Swift Transportation Holdings Inc. (referred to as Knight-Swift) is a publicly traded, American, truckload motor shipping carrier based in Phoenix, Arizona. It is the largest trucking company in the United States.'],
            [ 'id' => 6, 'name' => 'YRC Worldwide', 'image_ref' => '', 
            'link' => 'YRCW.com', 'details' => 'YRC Worldwide Inc. is an American holding company of freight shipping brands YRC Freight, New Penn, Holland and Reddaway. YRC Worldwide has a comprehensive network in North America, and offers shipping of industrial, commercial and retail goods. The company is headquartered in Overland Park, Kansas.'],
        ];
    
        foreach ($carriers as $carrier) {
            DB::table('carriers')->insert($carrier);
        }

        $producers = [
            [ 'id' => 1, 'name' => 'Gibson', 'image_ref' => '', 
            'link' => 'gibson.com', 'details' => 'Gibson Brands, Inc. (formerly Gibson Guitar Corporation) is an American manufacturer of guitars, other musical instruments, and professional audio equipment from Kalamazoo, Michigan, and now based in Nashville, Tennessee. The company was formerly known as Gibson Guitar Corporation and renamed Gibson Brands, Inc. on June 11, 2013.' ],
            [ 'id' => 2, 'name' => 'Shure', 'image_ref' => '', 
            'link' => 'www.shure.com', 'details' => 'Shure Incorporated is an American audio products corporation. It was founded by Sidney N. Shure in Chicago, Illinois in 1925 as a supplier of radio parts kits. The company became a consumer and professional audio-electronics manufacturer of microphones, wireless microphone systems, phonograph cartridges, discussion systems, mixers, and digital signal processing. The company also manufactures listening products, including headphones, high-end earphones, and personal monitor systems.' ],
            [ 'id' => 3, 'name' => 'Yamaha Corporation', 'image_ref' => '', 
            'link' => 'yamaha.com', 'details' => 'Yamaha Corporation (ヤマハ株式会社, Yamaha Kabushiki Gaisha) (/ˈjæməˌhɑː/; Japanese pronunciation: [jamaha]) is a Japanese multinational corporation and conglomerate with a very wide range of products and services. It is one of the constituents of Nikkei 225 and is the world\'s largest piano manufacturing company. The former motorcycle division was established in 1955 as Yamaha Motor Co., Ltd., which started as an affiliated company but later became independent, although Yamaha Corporation is still a major shareholder.' ],
            [ 'id' => 4, 'name' => 'Fender Musical Instruments Corporation', 'image_ref' => '', 
            'link' => 'fender.com', 'details' => 'Fender Musical Instruments Corporation (FMIC, or simply Fender) is an American manufacturer of stringed instruments and amplifiers. Fender produces acoustic guitars, bass amplifiers and public address equipment, but is best known for its solid-body electric guitars and bass guitars, particularly the Stratocaster, Telecaster, Precision Bass, and the Jazz Bass. The company was founded in Fullerton, California, by Clarence Leonidas "Leo" Fender in 1946. Its headquarters are in Scottsdale, Arizona.' ],
            [ 'id' => 5, 'name' => 'Steinway Musical Instruments', 'image_ref' => '', 
            'link' => 'steinway.com', 'details' => 'Steinway Musical Instruments, Inc. is a worldwide musical instrument manufacturing and marketing conglomerate, based in Waltham, Massachusetts, the United States. It was formed in a 1995 merger between the Selmer Industries and Steinway Musical Properties, the parent company of Steinway & Sons piano manufacturers. From 1996 to 2013, Steinway Musical Instruments was traded at the New York Stock Exchange (NYSE) under the abbreviation LVB, for Ludwig van Beethoven.[1][2] It was acquired by the Paulson & Co. private capital firm in 2013.' ],
            [ 'id' => 6, 'name' => 'Sennheiser', 'image_ref' => '', 
            'link' => 'sennheiser.com', 'details' => 'Sennheiser electronic GmbH & Co. KG (/ˈzɛnhaɪzər/) is a German privately held audio company specializing in the design and production of a wide range of high fidelity products, including microphones, headphones, telephone accessories and aviation headsets for personal, professional and business applications.' ],
            [ 'id' => 7, 'name' => 'Roland Corporation', 'image_ref' => '', 
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


    }
}
