<?php

use Illuminate\Database\Seeder;

class VendorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('vendors')->insert([
            'name' => 'Lua Pauline',
            'link' => 'luaPauline',
            'category_id' => 01,
            'searchScore' => 50,
            'email' => 'info@lua.de',
            'description' => 'Eine Glashütte im Wald mit excellenter Küche.',
            'photoPath' => '1542153269-luaPauline.jpeg',
            'street' => 'Zum Blauen Stein 35',
            'postalCode' => '52070',
            'city' => 'Aachen',
            'telephone' => '01512 5209135',
            'email' => 'info@luapauline.com',
            'website' => 'luapauline.de',
            'facebook' => 'https://www.facebook.com/luapauline.de/',
        ]);
        DB::table('vendors')->insert([
            'name' => 'Charles',
            'link' => 'charles',
            'description' => 'Für die anspruchsvollen Gäste gibt es im Charles genau das richtige.',
            'photoPath' => '1542150854-charles.jpg',
            'category_id' => 1
        ]);
        DB::table('vendors')->insert([
            'name' => 'Halle 60',
            'link' => 'halle60',
            'photoPath' => 'Halle60.jpg',
            'category_id' => 1
        ]);
        DB::table('vendors')->insert([
            'name' => 'David Jankowski',
            'link' => 'david-jankowski',
            'description' => 'Erfahrener DJ für jede Art von Veranstaltungen.',
            'category_id' => 2,
            'photoPath' => 'David.jpg',
        ]);
        DB::table('vendors')->insert([
            'name' => 'Ralf Esser',
            'link' => 'ralf-esser',
            'description' => 'Erfahrener DJ für jede Art von Veranstaltungen.',
            'category_id' => 2,
            'photoPath' => 'Ralf.jpg',
        ]);
        DB::table('vendors')->insert([
            'name' => 'Peter Müller',
            'link' => 'peter-mueller',
            'description' => 'Ein Fotograph der keine Wünsche offen lässt',
            'category_id' => 3,
            'photoPath' => 'Fotograf1.jpg',
        ]);
        DB::table('vendors')->insert([
            'name' => 'Martin Sonne',
            'link' => 'martin-sonne',
            'category_id' => 3,
            'photoPath' => 'Fotograph2.jpg',
        ]);
    }
}
